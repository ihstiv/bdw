<?php

class bim_fcontentmana
{
	protected $registry;
	
	public function __construct()
	{
		$this->registry	= ipsRegistry::instance();
		$this->request  =& $this->registry->fetchRequest();
     	$this->DB           	=  $this->registry->DB();
		$this->settings =& $this->registry->fetchSettings();
		$this->memberData =& $this->registry->member()->fetchMemberData();
		$this->lang			= $this->registry->getClass('class_localization');
		$this->lang->loadLanguageFile(array("public_featuredcontent"), 'featuredcontent');	
	}
	
	public function getOutput()
	{
		if( $this->settings['bim_fcontent_on'] == 1 && $this->registry->output->skin['set_key']!='mobile')
		{
			if( is_array($this->registry->output->getTemplate('topic')->functionData['post']) AND count($this->registry->output->getTemplate('topic')->functionData['post']) )
			{		
				$tid = $this->request['t'];
				$row = $this->DB->buildAndFetch( array( 'select' => '*', 'from'   => 'fcontent', 'where'  => 'f_tid='.$tid ) );
				
				if ( (!$row['id'] && $this->memberData['g_fcontent_canAdd_topic'] != 1) || ($row['id']>0 && $this->memberData['g_fcontent_canEdit_topic'] != 1) )
				{
					return;
				}
				if (!$row['id']) { 
					$btext = "<img src=\"{$this->settings['board_url']}/fcontent/add.png\"> {$this->lang->words['featurec_add']}"; 
				} else { 
					$btext = "<img src=\"{$this->settings['board_url']}/fcontent/remove.png\"> {$this->lang->words['featurec_edit']}"; 
				}
				$output	= "<li><a href='#' onclick='popup_fcon_promote()'>{$btext}</a></li>
							<script type='text/javascript'>
								function popup_fcon_promote(){
									new ipb.Popup( 'popup_window', 
									{
										type: 'pane', modal: true, w: '400px', h: '400px',
										ajaxURL: \"{$this->settings['board_url']}/?app=featuredcontent&cmd=addTopic&id={$tid}\",
										hideAtStart: false, close: 'a[rel=\"close\"]' 
									} ) } 
								</script>
							";
			}
		}
		return $output;	
	}

}