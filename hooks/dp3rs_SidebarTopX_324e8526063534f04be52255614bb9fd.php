<?php
      
//-----------------------------------------------
// (DP34) Referrals System
//-----------------------------------------------
//-----------------------------------------------
// Template Hook
//-----------------------------------------------
// Author: DawPi
// Site: http://www.ipslink.pl
// Written on: 27 / 09 / 2010
// Updated on: 14 / 06 / 2011
//-----------------------------------------------
// Copyright (C) 2010-2011 DawPi
// All Rights Reserved
//-----------------------------------------------     

class dp3rs_SidebarTopX
{
	public $registry;	
				
	public function __construct()
	{
		$this->registry   = ipsRegistry::instance();
		$this->DB	    = $this->registry->DB();
		$this->settings =& $this->registry->fetchSettings();
		$this->request  =& $this->registry->fetchRequest();
		$this->member   = $this->registry->member();
		$this->memberData =& $this->registry->member()->fetchMemberData();
		$this->lang		=  $this->registry->getClass('class_localization');
		$this->cache	= $this->registry->cache();
		$this->caches   =& $this->registry->cache()->fetchCaches();	
	}
	
	
	public function getOutput()
	{     	
		/* Load library */
				
		$classToLoad = IPSLib::loadLibrary( IPSLib::getAppDir( 'referrals' ) . '/sources/classes/library.php', 'referralsSystemLibrary', 'referrals' );
		$this->referralsSystemLibrary = new $classToLoad( $this->registry );	
		
		/* System is enabled? */
		
		if( ! $this->referralsSystemLibrary->checkAccess() )
		{
			return false;
		}
		
		/* Sidebar top X is enabled? */
		
		if( ! $this->settings['dp3_rs_sidebar_limit'] )
		{
			return false;
		}

		/* Convert %s to how many users should be show... */
		
		$this->lang->words['dp3_rs_sidebar_title'] = str_replace( '%s', $this->settings['dp3_rs_sidebar_limit'], $this->lang->words['dp3_rs_sidebar_title'] );
						        									
		/* Return data */

		return $this->registry->output->getTemplate( 'referrals' )->hooks_dp3rsSidebar( $this->referralsSystemLibrary->getTopXReferrers() );
	}
} // End of class