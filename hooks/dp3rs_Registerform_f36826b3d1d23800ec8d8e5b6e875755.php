<?php
      
//-----------------------------------------------
// (DP34) Referrals System
//-----------------------------------------------
//-----------------------------------------------
// Template Hook
//-----------------------------------------------
// Author: DawPi
// Site: http://www.ipslink.pl
// Written on: 16 / 08 / 2010
// Updated on: 07 / 10 / 2011
//-----------------------------------------------
// Copyright (C) 2010-2011 DawPi
// All Rights Reserved
//-----------------------------------------------     

class dp3rs_Registerform
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
		
		$value 		= '';
		$disable	= false;
		
		/* Load library */
				
		$classToLoad = IPSLib::loadLibrary( IPSLib::getAppDir( 'referrals' ) . '/sources/classes/library.php', 'referralsSystemLibrary', 'referrals' );
		$this->referralsSystemLibrary = new $classToLoad( $this->registry );	
				
		/* Load lang */
		
		$this->registry->getClass('class_localization')->loadLanguageFile( array( 'public_referrals' ), 'referrals' );
		  
		/* System is enabled? */
		
		if( ! $this->settings['dp3_rs_enable'] )
		{
			return false;
		}
		 
		/* Invite mode only? */
		
		if ( $this->settings['dp3_rs_type'] == 'invite' )
		{
			return false;
		}
		
		/* Check the same IP is disabled to register */
		
		if( ! $this->referralsSystemLibrary->checkActIp() )
		{
			return false;
		} 		
		 
		/* Cookie setting? */
		
		$refID 		= IPSCookie::get( $this->referralsSystemLibrary->invite_reff_id );
		$refHash	= IPSCookie::get( $this->referralsSystemLibrary->invite_reff_hash );
		 
		if( intval( $refID ) )
		{
			$member = IPSMember::load( $refID );
		}
		elseif( $refHash && ( $refHash != '-' ) )
		{
			$data	= $this->DB->buildAndFetch( array(
												'select'	=> 'i_inviter_id',
												'from'		=> 'dp3_rs_referrals',
												'where'		=> 'i_secure_key = "' . $refHash . '"'
			) );
			
			$member = IPSMember::load( $data['i_inviter_id'] );	
			
			/* Disable */
			
			$disable = true;		
		}
		
		if( IPSText::mbstrlen( $member['members_display_name'] ) )
		{
			$value = $member['members_display_name'];
		}
		elseif( isset( $this->request['referral_name'] ) && IPSText::mbstrlen( $this->request['referral_name'] ) )
		{
			$value = $this->request['referral_name'];
		}
		
		/* Return data */
		 
		return $this->registry->output->getTemplate( 'referrals' )->hooks_dp3rsRegisterForm( $value, $disable );
	}
} // End of class