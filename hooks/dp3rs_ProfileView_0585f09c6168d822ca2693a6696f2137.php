<?php
      
//-----------------------------------------------
// (DP34) Referrals System
//-----------------------------------------------
//-----------------------------------------------
// Template Hook
//-----------------------------------------------
// Author: DawPi
// Site: http://www.ipslink.pl
// Written on: 13 / 09 / 2010
// Updated on: 14 / 06 / 2011
//-----------------------------------------------
// Copyright (C) 2010-2011 DawPi
// All Rights Reserved
//-----------------------------------------------     

class dp3rs_ProfileView
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
		
		$name = '';
		
		/* System is enabled? */
		
		if( ! $this->settings['dp3_rs_enable'] )
		{
			return false;
		}
		
		/* Block is disabled? */
		
		if( ! $this->settings['dp3_rs_show_in_profile'] )
		{
			return false;
		}
				
		/* Load lang */
		
		$this->registry->getClass('class_localization')->loadLanguageFile( array( 'public_referrals' ), 'referrals' );		
		
		/* Load refferer name */
		
		$profileMember = IPSMember::load( $this->request['id'] );

		if( $profileMember['dp3_rs_referred_by'] )
		{
			$referrer = IPSMember::load( $profileMember['dp3_rs_referred_by'] );
		}

		if( IPSText::mbstrlen( $referrer['members_display_name'] ) )
		{			
			$referrer['members_display_name'] 	= IPSMember::makeNameFormatted( $referrer['members_display_name'], $referrer['member_group_id'] );
			$name 								= $this->registry->output->getTemplate('global')->userHoverCard( $referrer );
		}
		else
		{
			return false;
		}
															
		/* Return data */

		return $this->registry->output->getTemplate( 'referrals' )->hooks_dp3rs_profile_view( $name );
	}
} // End of class