<?php
      
//-----------------------------------------------
// (DP34) Referrals System
//-----------------------------------------------
//-----------------------------------------------
// Library Overload
//-----------------------------------------------
// Author: DawPi
// Site: http://www.ipslink.pl
// Written on: 25 / 05 / 2011
// Updated on: 07 / 10 / 2011
//-----------------------------------------------
// Copyright (C) 2010-2011 DawPi
// All Rights Reserved
//-----------------------------------------------     

class dp3rs_OverloadClassPost extends classPostForms
{							
	public function addTopic()
	{		
		/* Run parent */
		
		$result = parent::addTopic();
				
		/* Counting is enabled? */
		
		if( $this->settings['dp3_rs_enable'] && $this->memberData['dp3_rs_referred_by'] && $this->settings['dp3_rs_add_topic_points'] )
		{
			/* Load library */
					
			$classToLoad = IPSLib::loadLibrary( IPSLib::getAppDir( 'referrals' ) . '/sources/classes/library.php', 'referralsSystemLibrary', 'referrals' );
			$this->referralsSystemLibrary = new $classToLoad( $this->registry );	
						
			/* Get info */

			$forum = $this->getForumData();
					
			/* Add points */
			
			if( ( $result === TRUE ) && $forum['inc_postcount'] )
			{
				$this->referralsSystemLibrary->addPoints( $this->memberData['dp3_rs_referred_by'], false, $this->settings['dp3_rs_add_topic_points'] );
			}					
		}
		
		/* Return */
		
		return $result;
	}
	
	public function addReply()
	{		
		/* Run parent */
		
		$result = parent::addReply();
				
		/* Counting is enabled? */
		
		if( $this->settings['dp3_rs_enable'] && $this->memberData['dp3_rs_referred_by'] && $this->settings['dp3_rs_add_reply_points'] )
		{
			/* Load library */
					
			$classToLoad = IPSLib::loadLibrary( IPSLib::getAppDir( 'referrals' ) . '/sources/classes/library.php', 'referralsSystemLibrary', 'referrals' );
			$this->referralsSystemLibrary = new $classToLoad( $this->registry );	
						
			/* Get info */

			$forum = $this->getForumData();
					
			/* Add points */
			
			if( ( $result === TRUE ) && $forum['inc_postcount'] )
			{
				$this->referralsSystemLibrary->addPoints( $this->memberData['dp3_rs_referred_by'], false, $this->settings['dp3_rs_add_reply_points'] );
			}					
		}
		
		/* Return */
		
		return $result;
	}
	
	
	/**
	 * Increments the users post count
	 *
	 * @param	int		Number of posts to increment by (default 1)
	 * @return	void
	 */
	public function incrementUsersPostCount( $inc=1 )
	{
		/* Run parent */

		parent::incrementUsersPostCount( $inc );
				
		/* Fast check */
		
		if( $this->memberData['dp3_rs_padded'] )
		{
			return true;
		}
		
		/* Load library */
				
		$classToLoad = IPSLib::loadLibrary( IPSLib::getAppDir( 'referrals' ) . '/sources/classes/library.php', 'referralsSystemLibrary', 'referrals' );
		$this->referralsSystemLibrary = new $classToLoad( $this->registry );	
		
		/* System is enabled and function too? */
		
		if( $this->settings['dp3_rs_enable'] && $this->settings['dp3_rs_post_ref_required'] )
		{
			/* Member is reffered by someone? */

			if( $this->memberData['dp3_rs_referred_by'] )
			{
				/* Points wasn't be added to the referrer account? */

				if( ! $this->memberData['dp3_rs_padded'] )
				{
					/* Member has exact or more points than set? */

					if( $this->settings['dp3_rs_post_ref_required'] <= $this->memberData['posts'] )
					{
						/* App is enabled? */

						if( $this->caches['app_cache']['referrals']['app_enabled'] )
						{					
							/* Update referred member marker */

							$this->DB->update( 'members', array( 'dp3_rs_padded' => 1 ), 'member_id = ' . $this->memberData['member_id'] );
							
							/* Add points to the referrer account */
							
							$this->referralsSystemLibrary->addPoints( $this->memberData['dp3_rs_referred_by'] );	
						}					
					}
				}
			}	
		}
	}	
} // End of class