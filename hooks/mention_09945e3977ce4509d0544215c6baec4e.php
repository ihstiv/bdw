<?php

class mention extends tapatalk_classPostForms
{

	public $ass;
	
	public function formatPost( $postContent )
	{
		$original = parent::formatPost( $postContent );

		$safeword = "/(?: ?){$this->settings['booty_call_character']}([^\s?!.,<]*)([?!.~:])?(?: ?)/i";
		
		if ( stristr( $original, $this->settings['booty_call_character'] ) )
		{
			preg_match_all( $safeword, $original, $whereMahPussyAt );
			
			$tooManyPussies = array_unique( $whereMahPussyAt[1] );
			$boobies = '';
			
			foreach ( $tooManyPussies as $pussy )
			{
				$sand = stripos( $pussy, "'" );
				if ( intval($sand) )
				{
					$pussy = substr( $pussy, 0, $sand );
				}
				if ( strlen( $pussy ) < 3 || empty( $pussy ))
				{
					continue;
				}
				$boobies .= "members_display_name LIKE '" . $pussy . "%' OR members_display_name LIKE '" . $pussy . " %' OR " ;
			}
						
			$boobies = substr( $boobies, 0, -4 );
			
			if ( empty( $boobies ) )
			{
				return $original;
			}
			
			$this->DB->build( array(
										'select' => 'member_id, members_display_name',
										'from' => 'members',
										'where' => $boobies,
										'order' => 'members_display_name DESC'
									) );
			
			$this->DB->execute();

			$dicks = array();
			while( $r = $this->DB->fetch() )
			{
				$dicks[] = $r;
			}		
			
			if( is_array( $dicks ) && count( $dicks ) )
			{
				$tits = array();
				foreach ( $dicks as $dick )
				{
					if ( $this->memberData['member_id'] == $dick['member_id'] )
					{
						continue; 
					}
					$nipples = $this->settings['booty_call_character'] . $dick['members_display_name'];
					$nipples = str_replace( "&#39;" , "'" , $nipples );
					if( stristr ( $original, $nipples ) )
					{
						$original = str_ireplace( $nipples, "{$this->settings['booty_call_character']}[member=\"{$dick['members_display_name']}\"]", $original );
						$tits[] = $dick['member_id'];
					}
					
					
				}
				if ( is_array( $tits ) AND count( $tits ) )
				{
					$this->ass = array_unique( $tits );
				}
			}
										
			return $original;
		}
		else
		{
			return $original;
		}
	}
	
	public function addReply()
	{
		if ( parent::getIsPreview() )
		{
			return parent::addReply();
		}
			
		$return = parent::addReply();
		
		if ( $return )
		{
			$this->bootyCall( $this->getPostData() );
		}
		
	}
	
	public function addTopic()
	{
		if ( parent::getIsPreview() )
		{
			return parent::addTopic();
		}	
	
		$return = parent::addTopic();
		
		if ( $return )
		{
			$this->bootyCall( $this->getPostData() );
		}

	}
	
	public function editPost()
	{
		if ( parent::getIsPreview() )
		{
			return parent::editPost();
		}
		
		$return = parent::editPost();
		
		if ( $return )
		{
			$this->bootyCall( $this->getPostData() );
		}
	}		
	
	public function bootyCall( $fuck )
	{
		if ( !is_array( $this->ass ) || !count( $this->ass ) || !$this->memberData['member_id'] )
		{
			return;
		}
		
		$classToLoad		= IPSLib::loadLibrary( IPS_ROOT_PATH . '/sources/classes/member/notifications.php', 'notifications' );
		$notifyLibrary		= new $classToLoad( $this->registry );

		$topic = $this->registry->getClass('topics')->getTopicById( $fuck['topic_id'] );
		
		$whores = IPSMember::load( $this->ass, 'all' );

		foreach( $whores as $whore )
		{
			if ( $whore['member_id'] && $this->registry->getClass('topics')->canView( $topic, $whore ) && !$fuck['queued'] )
			{
				if ( $whore['ignored_users'] )
				{
					$bitch = @unserialize( $whore['ignored_users'] );
					if ( $bitch[$this->memberData['member_id']]['ignore_topics'] )
					{
						continue; 
					}
				}
					
				$whore['language'] = $whore['language'] == "" ? IPSLib::getDefaultLanguage() : $whore['language'];
				
				IPSText::getTextClass('email')->setPlainTextTemplate( IPSText::getTextClass('email')->getTemplate( 'booty_call', $whore['language'] ) );
				
				IPSText::getTextClass('email')->buildMessage( array( 'MEMBER_NAME' => $this->memberData['members_display_name'], 'POST_LINK' => $this->registry->output->buildSEOUrl( "showtopic={$fuck['topic_id']}&amp;view=findpost&amp;p={$fuck['pid']}", 'publicNoSession', $topic['title_seo'], 'showtopic' ), 'POST' => $fuck['post'] ) );
		
				$notifyLibrary->setMember( $whore );
		
				$notifyLibrary->setFrom( $this->memberData );
		
				$notifyLibrary->setNotificationKey( 'booty_call' );
		
				$notifyLibrary->setNotificationUrl( $this->registry->output->buildSEOUrl( "showtopic={$fuck['topic_id']}&amp;view=findpost&amp;p={$fuck['pid']}", 'publicNoSession', $topic['title_seo'], 'showtopic' ) );
		
				$notifyLibrary->setNotificationText( IPSText::getTextClass('email')->getPlainTextContent() );
		
				$title	= sprintf( IPSText::getTextClass('email')->subject, $this->registry->output->buildSEOUrl( 'showuser=' . $this->getAuthor('member_id'), 'publicNoSession', $this->getAuthor('members_seo_name'), 'showuser' ), $this->getAuthor('members_display_name'), $this->registry->output->buildSEOUrl( "showtopic={$fuck['topic_id']}&amp;view=findpost&amp;p={$fuck['pid']}", 'publicNoSession', $topic['title_seo'], 'showtopic' ) );
				
				$notifyLibrary->setNotificationTitle( $title );
		
				try
				{
					$notifyLibrary->sendNotification();
				}
				catch( Exception $e ){ }				

			}
		}		
	}
	
}