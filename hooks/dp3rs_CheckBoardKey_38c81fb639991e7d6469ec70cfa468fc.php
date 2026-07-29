<?php
      
//-----------------------------------------------
// (DP3) Referrals System
//-----------------------------------------------
//-----------------------------------------------
// Class Overload
//-----------------------------------------------
// Author: DawPi
// Site: http://www.ipslink.pl
// Written on: 26 / 05 / 2011
// Updated on: 07 / 10 / 2011
//-----------------------------------------------
// Copyright (C) 2010-2011 DawPi
// All Rights Reserved
//-----------------------------------------------   

class dp3rs_CheckBoardKey extends public_forums_forums_boards
{
	
	/**
	 * Main Execution Function
	 *
	 * @access	public
	 * @param	object		Registry reference
	 * @return	void		[Outputs to screen/redirects]
	 */
	public function doExecute( ipsRegistry $registry )
	{
		/* Load library */
				
		$classToLoad = IPSLib::loadLibrary( IPSLib::getAppDir( 'referrals' ) . '/sources/classes/library.php', 'referralsSystemLibrary', 'referrals' );
		$this->referralsSystemLibrary = new $classToLoad( $this->registry );	
	
		/* Do not count validating members */
		
		if( ! $this->memberData['member_group_id'] || ( $this->memberData['member_group_id'] == $this->settings['auth_group'] ) )
		{
			parent::doExecute( $registry );
		}
		
		/* Check access */

		if( $this->settings['dp3_rs_enable'] && $this->memberData['member_id'] && ! $this->settings['dp3_rs_min_posts'] || ( $this->settings['dp3_rs_min_posts'] && ( $this->settings['dp3_rs_min_posts'] <= $this->memberData['posts'] ) ) )
		{
			$this->referralsSystemLibrary->playWithCheckKey();
		}
		
		# Run parent function! O.o
		
		parent::doExecute( $registry );
	}
} // End of class