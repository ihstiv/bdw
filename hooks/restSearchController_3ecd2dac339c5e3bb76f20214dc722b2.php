<?php

class restSearchController extends IPSSearch
{
    public function __construct(ipsRegistry $registry, $engine, $app)
	{
	    // EME: We need to override the controller here because we do multiple searches in a single call
        // This means we attempt to redeclare classes that are already loaded
        // To work around this, we do a class_exists check before each require_once
        
	    if(IPS_APP_COMPONENT != 'REST_Service')
        {
            return parent::__construct($registry, $engine, $app);
        }
        
		/* Make object */
		$this->registry   =  $registry;
		$this->DB         =  $this->registry->DB();
		$this->settings   =& $this->registry->fetchSettings();
		$this->request    =& $this->registry->fetchRequest();
		$this->lang       =  $this->registry->getClass('class_localization');
		$this->member     =  $this->registry->member();
		$this->memberData =& $this->registry->member()->fetchMemberData();
		$this->cache      =  $this->registry->cache();
		$this->caches     =& $this->registry->cache()->fetchCaches();
		
		/* Set engine */
		$this->_engine = strtolower( IPSText::alphanumericalClean( $engine ) );
		
		/* Set app */
		$this->_app       = IPSText::alphanumericalClean( $app );
		
		/* Quick check */
		if ( ! is_file( IPS_ROOT_PATH . 'sources/classes/search/engines/' . $this->_engine . '.php' ) )
		{
			/* Try SQL */
			if ( $this->_engine != 'sql' )
			{
				$this->_engine = 'sql';
				
				if ( ! is_file( IPS_ROOT_PATH . 'sources/classes/search/engines/' . $this->_engine . '.php' ) )
				{
					throw new Exception( "NO_SUCH_ENGINE" );
				}
			}
			else
			{
				throw new Exception( "NO_SUCH_ENGINE" );
			}
		}
		
		if ( ! isset( ipsRegistry::$applications[ $this->_app ] ) )
		{
			throw new Exception( "NO_SUCH_APP" );
		}
		
		/* Set in registry */
		IPSSearchRegistry::set( 'global.engine', $this->_engine );
		IPSSearchRegistry::set( 'global.app'   , $this->_app );
		
		/* Load up the relevant engines */
		if(!class_exists('search_format'))
        {
            require( IPS_ROOT_PATH . 'sources/classes/search/format.php' );/*noLibHook*/
        }
		
		/* Got an app specific file? Lets hope so */
		if ( is_file( IPSLib::getAppDir( $this->_app ) . '/extensions/search/format.php' ) )
		{
			/* We may not have sphinx specific stuff, so... */
			if ( ! is_file( IPSLib::getAppDir( $this->_app ) . '/extensions/search/engines/' . $this->_engine . '.php' ) )
			{
				$this->_engine = 'sql';

				IPSSearchRegistry::set( 'global.engine', $this->_engine );
				
				if ( ! is_file( IPSLib::getAppDir( $this->_app ) . '/extensions/search/engines/' . $this->_engine . '.php' ) )
				{
					throw new Exception( "NO_SUCH_APP_ENGINE" );
				}
			}
			
			/* SEARCH file */
			if(!class_exists('search_engine'))
            {
                require( IPS_ROOT_PATH . 'sources/classes/search/engines/' . $this->_engine . '.php' );/*noLibHook*/
            }
			$classToLoad  = IPSLib::loadLibrary( IPSLib::getAppDir( $this->_app ) . '/extensions/search/engines/' . $this->_engine . '.php', 'search_engine_' . $this->_app, $this->_app );
			$this->SEARCH = new $classToLoad( $registry );
			
			/* FORMAT file */
			$classToLoad  = IPSLib::loadLibrary( IPSLib::getAppDir( $this->_app ) . '/extensions/search/format.php', 'search_format_' . $this->_app, $this->_app );
			$this->FORMAT = new $classToLoad( $registry );
			
			/* Grab config */
			$CONFIG = array();
			require( IPSLib::getAppDir( $this->_app ) . '/extensions/search/config.php' );/*noLibHook*/
			
			if ( is_array( $CONFIG ) && count( $CONFIG ) )
			{
				foreach( $CONFIG as $k => $v )
				{
					IPSSearchRegistry::set( 'config.' . $k, $v );
				}
			}
		}
		else
		{
			throw new Exception( "NO_SUCH_APP_ENGINE" );
		}
		
		/* Multi content types */
		if ( IPSSearchRegistry::get( 'config.contentTypes' ) )
		{
			$c = IPSSearchRegistry::get( 'config.contentTypes' );

			if ( is_array( $c ) AND count( $c ) )
			{
				/* Set up default content type if supported */
				IPSSearchRegistry::set( $this->_app . '.searchInKey' , $c[0] );
				
				/* Filter specific search */
				if ( isset( $this->request['search_app_filters'][ $this->_app ]['searchInKey'] ) )
				{
					IPSSearchRegistry::set( $this->_app . '.searchInKey', $this->request['search_app_filters'][ $this->_app ]['searchInKey'] );
				}
			}
		}
	}
}