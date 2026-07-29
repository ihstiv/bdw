<?php
      
//-----------------------------------------------
// (DP34) Referrals System
//-----------------------------------------------
//-----------------------------------------------
// Template Hook
//-----------------------------------------------
// Author: DawPi
// Site: http://www.ipslink.pl
// Written on: 11 / 11 / 2010
// Updated on: 14 / 06 / 2011
//-----------------------------------------------
// Copyright (C) 2010-2011 DawPi
// All Rights Reserved
//-----------------------------------------------     

class dp3rs_SidebarShowReferrLink
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
      	/* INIT */
      	
      	$refLink	= '';
      	
		/* Load library */
				
		$classToLoad = IPSLib::loadLibrary( IPSLib::getAppDir( 'referrals' ) . '/sources/classes/library.php', 'referralsSystemLibrary', 'referrals' );
		$this->referralsSystemLibrary = new $classToLoad( $this->registry );	
	
		/* Load lang */
		
		$this->registry->getClass('class_localization')->loadLanguageFile( array( 'public_referrals' ), 'referrals' );
						
		/* System is enabled? */
		
		if( ! $this->referralsSystemLibrary->checkAccess() || ! $this->memberData['member_id'] )
		{
			return false;
		}
		
		/* Member isn't banned and has referrals enabled? */
		
		if( ! in_array( $this->memberData['member_group_id'], explode(',', IPSText::cleanPermString( $this->settings['dp3_rs_groups'] ) ) ) || $this->memberData['dp3_rs_banned'] )
		{
			return false;
		}
		
		/* Sidebar link is disabled? */
		
		if( ! $this->settings['dp3_rs_sidebar_ref_link_enable'] )
		{
			return false;
		}
		
		/* Invite mode only? */
		
		if ( $this->settings['dp3_rs_type'] == 'invite' )
		{
			return false;
		}
		
		/* Generate refferal link */
		
		$refLink 	= $this->settings['base_url'] . 'app=referrals&reff=' . $this->memberData['member_id'];	

		/* Masks are enabled? */
		
		if( $this->settings['dp3_rs_enable_masks'] )
		{
			$refMaskedLink	= $this->registry->output->buildSEOUrl( 'app=referrals&amp;reff=' . $this->memberData['member_id'], 'public', 'reff', 'reff_mask' );
		}
										        									
		/* Return data */
	
		return $this->registry->output->getTemplate( 'referrals' )->hooks_dp3rsSidebarReferrerLink( $refLink, $refMaskedLink );
	}
} // End of class