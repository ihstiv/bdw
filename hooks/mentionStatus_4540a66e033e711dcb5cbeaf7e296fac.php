<?php

class mentionStatus extends memberStatus
{
	protected function _cleanContent( $content )
	{
		$original = parent::_parseContent( $content );
		
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
				if ( strlen( $pussy ) < 3 || empty( $pussy ) )
				{
					continue;
				}
				$boobies .= "members_display_name LIKE '" . $pussy . "%' OR members_display_name LIKE '" . $pussy . " %' OR " ;
			}
						
			$boobies = substr( $boobies, 0, -4 );
			
			if( empty( $boobies ) )
			{
				return $original;
			}
			
			$this->DB->build( array(
										'select' => 'member_id, members_display_name, members_seo_name',
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
					//$nipples = str_replace( "&#39;" , "'" , $nipples );
					if( stristr ( $original, $nipples ) )
					{
						$url = $this->registry->output->buildSEOUrl( "showuser={$dick['member_id']}", 'public', $dick['members_seo_name'], "showuser" );
						$link = "<a href='" . $url . "'>" . $dick['members_display_name'] . "</a>";
						$original = str_ireplace( $nipples, "{$this->settings['booty_call_character']}{$link}", $original );
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
	
	public function create( $author=null, $owner=null )
	{
		$data = parent::create( $author, $owner );
		if ( $data )
		{
			$this->bootyCall( $data, $author );
			return $data;
		}
		else
		{
			return $data;
		}
	}
	
	public function reply( $author=null, $status=null )
	{
		$data = parent::reply( $author, $status );
		if ( $data )
		{
			$this->bootyCall( $data, $author, $status );
			return $data;
		}
		else
		{
			return $data;
		}
	}	
	
	public function bootyCall( $fuck, $author, $status = null )
	{
		if ( !is_array( $this->ass ) || !count( $this->ass ) || !$this->memberData['member_id'] )
		{
			return;
		}

		$classToLoad		= IPSLib::loadLibrary( IPS_ROOT_PATH . '/sources/classes/member/notifications.php', 'notifications' );
		$notifyLibrary		= new $classToLoad( $this->registry );

		$whores = IPSMember::load( $this->ass, 'all' );
		
		if ( !$fuck['status_id'] )
		{
			$fuck['status_id'] = $fuck['reply_status_id'];
			$fuck['status_content'] = $fuck['reply_content'];
		}
		foreach( $whores as $whore )
		{
			if ( $whore['member_id'] )
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
				
				IPSText::getTextClass('email')->setPlainTextTemplate( IPSText::getTextClass('email')->getTemplate( 'booty_status_call', $whore['language'] ) );
				
				IPSText::getTextClass('email')->buildMessage( array( 'MEMBER_NAME' => $this->memberData['members_display_name'], 'STATUS' => $fuck['status_content'] ) );
		
				$notifyLibrary->setMember( $whore );
		
				$notifyLibrary->setFrom( $this->memberData );
		
				$notifyLibrary->setNotificationKey( 'booty_call' );
		
				$notifyLibrary->setNotificationUrl( $this->registry->output->buildSEOUrl( 'app=members&amp;module=profile&amp;section=status&amp;type=single&amp;status_id=' . $fuck['status_id'], 'publicNoSession', array( $owner['member_id'], $owner['members_seo_name'] ), 'members_status_single' ) );
		
				$notifyLibrary->setNotificationText( IPSText::getTextClass('email')->getPlainTextContent() );
		
				$title	= sprintf( IPSText::getTextClass('email')->subject, $this->registry->output->buildSEOUrl( 'showuser=' . $this->memberData['member_id'], 'publicNoSession', $this->memberData['members_seo_name'], 'showuser' ), $this->memberData['members_display_name'], $this->registry->output->buildSEOUrl( 'app=members&amp;module=profile&amp;section=status&amp;type=single&amp;status_id=' . $fuck['status_id'], 'publicNoSession', array( $this->memberData['member_id'], $this->memberData['members_seo_name'] ), 'members_status_single' ) );
				
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