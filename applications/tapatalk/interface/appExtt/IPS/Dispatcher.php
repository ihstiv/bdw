<?php
namespace Tapatalk\IPS;

/**
 * Tapatalk_Dispatcher short summary.
 *
 * Tapatalk_Dispatcher description.
 *
 * @version 1.0
 * @author moled_000
 */
class Dispatcher extends \IPS\Dispatcher\Standard
{
    public function __construct() {
        
    }
    /**
     * Controller Location
     */
	public $controllerLocation = 'front';
	
	/**
     * Init
     *
     * @return	void
     */
	public function init()
	{
		/* Set up in progress? */
		if ( isset( \IPS\Settings::i()->setup_in_progress ) AND \IPS\Settings::i()->setup_in_progress )
		{
			if( isset( $_SERVER['SERVER_PROTOCOL'] ) and \strstr( $_SERVER['SERVER_PROTOCOL'], '/1.0' ) !== false )
			{
				header( "HTTP/1.0 503 Service Unavailable" );
			}
			else
			{
				header( "HTTP/1.1 503 Service Unavailable" );
			}
            
			exit;
		}

		
		/* Sync stuff when in developer mode */
		if ( \IPS\IN_DEV )
		{
            \IPS\Developer::sync();
		}
		
		
		/* FURLs only apply when calling to index.php */
		$_calledScript	= str_replace( '\\', '/', $_SERVER['SCRIPT_FILENAME'] );
		$_scriptParts	= explode( '/', $_calledScript );
		array_pop( $_scriptParts );
		$_calledScript	= implode( '/', $_scriptParts );

		/* If script_filename was /index.php then calledscript will be empty */
		if( $_calledScript === '' )
		{
			$_calledScript = '/';
		}

		

		/* Run global init */
		try
		{
			parent::init();
		}
		catch ( \DomainException $e )
		{	
            //// If this is a "no permission", and they're validating - show the validating screen instead
            //if( $e->getCode() === 6 and \IPS\Member::loggedIn()->member_id and \IPS\Member::loggedIn()->members_bitoptions['validating'] )
            //{
				
            //}
            //// Otherwise show the error
            //else
            //{
            //    \IPS\Output::i()->error( $e->getMessage(), '2S100/' . $e->getCode(), $e->getCode() === 4 ? 403 : 404, '' );
            //}
		}

		
        
		/* Permission Check */
        //if ( !\IPS\Member::loggedIn()->canAccessModule( $this->module ) )
        //{
        //    \IPS\Output::i()->error( ( \IPS\Member::loggedIn()->member_id ? 'no_module_permission' : 'no_module_permission_guest' ), '2S100/2', 403, 'no_module_permission_admin' );
        //}
        
	}

	
	/**
     * Perform some legacy URL parameter conversions
     *
     * @return	void
     */
	public static function convertLegacyParameters()
	{
		/* Convert &section= to &controller= */
		if ( isset( \IPS\Request::i()->section ) AND !isset( \IPS\Request::i()->controller ) )
		{
			\IPS\Request::i()->controller = \IPS\Request::i()->section;
		}

		/* Convert &showtopic= @link https://community.invisionpower.com/4bugtrack/active-reports/double-redirects-in-legacyredirect-method-may-cause-seo-issues-r8934/ */
		if ( isset( \IPS\Request::i()->showtopic ) and is_numeric( \IPS\Request::i()->showtopic ) )
		{
			$base        = NULL;
			$seoTemplate = NULL;
			$seoTitles   = array();
			
			try
			{
				$topic = \IPS\forums\Topic::load( \IPS\Request::i()->showtopic );
				
				if ( $topic->canView() )
				{
					$base        = 'front';
					$seoTemplate = 'forums_topic';
					$seoTitles   = array( $topic->title_seo );
				}
			} catch( \Exception $e ) {}
			
			$url = \IPS\Http\Url::internal( 'app=forums&module=forums&controller=topic&id=' . \IPS\Request::i()->showtopic, $base, $seoTemplate, $seoTitles );

			if ( isset( \IPS\Request::i()->p ) or isset( \IPS\Request::i()->findpost ) )
			{
				$url = $url->setQueryString( array( 'do' => 'findComment', 'comment' => \IPS\Request::i()->p ?: \IPS\Request::i()->findpost ) );
			}
			elseif ( isset( \IPS\Request::i()->page ) )
			{
				$url = $url->setQueryString( array( 'page' => \IPS\Request::i()->page ) );
			}
			\IPS\Output::i()->redirect( $url );
		}

		/* Convert &showforum= */
		if ( isset( \IPS\Request::i()->showforum ) and is_numeric( \IPS\Request::i()->showforum ) )
		{
			$base        = NULL;
			$seoTemplate = NULL;
			$seoTitles   = array();
			
			try
			{
				$forum = \IPS\forums\Forum::load( \IPS\Request::i()->showforum );
				
				if ( $forum->can( 'view' ) )
				{
					$base        = 'front';
					$seoTemplate = 'forums_forum';
					$seoTitles   = array( $forum->name_seo );
				}	
			} catch ( \Exception $e ) {}
			
			$url = \IPS\Http\Url::internal( 'app=forums&module=forums&controller=forums&id=' . \IPS\Request::i()->showforum, $base, $seoTemplate, $seoTitles );
			\IPS\Output::i()->redirect( $url );
		}

		/* Convert &showuser= */
		if ( isset( \IPS\Request::i()->showuser ) and is_numeric( \IPS\Request::i()->showuser ) )
		{
			\IPS\Output::i()->redirect( \IPS\Http\Url::internal( 'app=core&module=members&controller=profile&id=' . \IPS\Request::i()->showuser ) );
		}

		/* Support legacy subscriptions */
		if( isset( \IPS\Request::i()->app ) AND \IPS\Request::i()->app == 'subscriptions' )
		{
			/* Redirecting isn't necessary, we just need to route the payment to the appropriate area.
            @see \IPS\nexus\Application */
			\IPS\Request::i()->app			= 'nexus';
			\IPS\Request::i()->module		= 'payments';
			\IPS\Request::i()->section		= 'receive';	/* It actually looks for section=receive, so make sure we set that */
			\IPS\Request::i()->controller	= 'receive';	/* We set this just to be complete in case anywhere else only looks at controller */
			\IPS\Request::i()->validate		= 'paypal';
		}
	}
}
