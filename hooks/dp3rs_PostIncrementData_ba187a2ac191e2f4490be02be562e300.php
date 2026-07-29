<?php
      
//-----------------------------------------------
// (DP34) Referrals System
//-----------------------------------------------
//-----------------------------------------------
// Class Overload
//-----------------------------------------------
// Author: DawPi
// Site: http://www.ipslink.pl
// Written on: 20 / 06 / 2011
// Updated on: 07 / 10 / 2011
//-----------------------------------------------
// Copyright (C) 2010-2011 DawPi
// All Rights Reserved
//----------------------------------------------- 

class dp3rs_PostIncrementData
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
		
	public function handleData( $data )
	{
		/* Load library */
		
		$classToLoad = IPSLib::loadLibrary( IPSLib::getAppDir( 'referrals' ) . '/sources/classes/library.php', 'referralsSystemLibrary', 'referrals' );
		$this->referralsSystemLibrary = new $classToLoad( $this->registry );	
				
		/* Check access */

		if( $this->settings['dp3_rs_enable'] && $this->memberData['member_id'] && ! $this->settings['dp3_rs_min_posts'] )
		{
			return $data;
		}
		
		/* Cdn... */
		
		if( $this->settings['dp3_rs_min_posts'] && ( $data['author_data']['posts'] < $this->settings['dp3_rs_min_posts'] ) )
		{
			return $data;
		}

		/* Member is referred by someone? */
		
		if( $data['author_data']['dp3_rs_referred_by'] )
		{
			/* Not incremented? */
			
			if( ! $data['author_data']['dp3_rs_incr'] )
			{
				/* Play with it */
				
				$this->referralsSystemLibrary->playWithCheckKey();	
				
				/* Update the increment status */

				IPSMember::save( $data['author_data']['member_id'], array( 'core' => array( 'dp3_rs_incr' => 1 ) ) ); 		
			}		
		}
			
		/* Return */
				                                                                                                   
		return $data;
	}
} // End of class