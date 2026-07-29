<?php

class mentionLink
{
	public function __construct()
	{
		$this->registry		=  ipsRegistry::instance();
		$this->settings		=& $this->registry->fetchSettings();
		$this->lang		=  $this->registry->getClass('class_localization');
		$this->member		=  $this->registry->member();
		$this->memberData	=& $this->registry->member()->fetchMemberData();
		$this->request		=& $this->registry->fetchRequest();
	}
	
	public function getOutput()
	{
		return;
	}
	
	public function replaceOutput( $output, $key )
	{
		if ( !$this->settings['booty_call_display'] || !( $this->request['app'] == 'forums' && $this->request['module'] == 'forums' && $this->request['section'] == 'topics' ) )
		{
			return $output;
		}
		
		if ( !$this->memberData['member_id'] )
		{
			return $output;
		}
		
		/* Got some data? */
		if ( is_array( $this->registry->output->getTemplate('global')->functionData['userInfoPane'] ) && count( $this->registry->output->getTemplate('global')->functionData['userInfoPane'] ) )
		{
			/* Init some vars */
			$tag  = '<!--hook.' . $key . '-->';
			$last = 0;
			
			/* Loop through each template call */
			foreach ( $this->registry->output->getTemplate('global')->functionData['userInfoPane'] as $k => $v )
			{
				if( !$v['author']['member_id'] )
				{
					continue;	
				}	
							
				$name = str_replace( "&#39;", "\\'", $v['author']['members_display_name'] );
				/* See if we can find this hook point */
				$pos = strpos( $output, $tag, $last );
				
				/* Found? */
				if ( $pos !== FALSE )
				{
					/* Start swapping it out */
					$string = "<li><a href=\"#\" onClick=\"ipb.textEditor.getEditor( ipb.textEditor.getCurrentEditorId() ).insert( '{$this->settings['booty_call_character']}{$name}' ); return false;\" title=\"{$this->settings['booty_call_character']}{$name}\">{$this->settings['booty_call_character']}{$this->lang->words['booty_call_link']}</a></li>";
					$output = substr_replace( $output, $string . $tag, $pos, strlen( $tag ) ); 
					$last   = $pos + strlen( $tag . $string );
				}
			}
		}
		
		/* Return */
		return $output;		
	}
}