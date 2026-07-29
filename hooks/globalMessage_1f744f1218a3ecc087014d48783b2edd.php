<?php
include (IPS_ROOT_PATH . '../conf_global.php');

class globalMessage
{
    public $registry;
    
    public function __construct()
    {
        $this->registry = ipsRegistry::instance();
		$this->settings =& $this->registry->fetchSettings();
		$this->memberData =& $this->registry->member()->fetchMemberData();
    }
    
    public function getOutput()
    {
		//check our page
		$page = $_SERVER['REQUEST_URI'] ? $_SERVER['REQUEST_URI'] : "/";
		
		
		/* Grab our current parsing flags */
		$parse = array( 'html'    => IPSText::getTextClass('bbcode')->parse_html,
						  'nl2br'   => IPSText::getTextClass('bbcode')->parse_nl2br,
						  'smilies' => IPSText::getTextClass('bbcode')->parse_smilies,
						  'bbcode'  => IPSText::getTextClass('bbcode')->parse_bbcode,
						);
			
		/* Turn on all parsing */
		IPSText::getTextClass('bbcode')->parse_html    = $this->settings['globalmess_html'];
		IPSText::getTextClass('bbcode')->parse_nl2br   = $this->settings['globalmess_linebreaks'];
		IPSText::getTextClass('bbcode')->parse_smilies = $this->settings['globalmess_smilies'];
		IPSText::getTextClass('bbcode')->parse_bbcode  = $this->settings['globalmess_bbcode'];
		
		/* Parse everything */
		$this->settings['globalmess_content'] = IPSText::getTextClass('bbcode')->preDisplayParse( IPSText::getTextClass('bbcode')->preDbParse( $this->settings['globalmess_content'] ) );
			
		/* Reset the parsing flags to what they were */
		IPSText::getTextClass('bbcode')->parse_html    = $parse['html'];
		IPSText::getTextClass('bbcode')->parse_nl2br   = $parse['nl2br'];
		IPSText::getTextClass('bbcode')->parse_smilies = $parse['smilies'];
		IPSText::getTextClass('bbcode')->parse_bbcode  = $parse['bbcode'];
		
		/* If we only want to display this on the index */
		if($this->settings['globalmess_display_mode'] == 'index')
		{
			//this is a pain, because of how many ways the URL can look...
			if($INFO['use_friendly_urls'] == 1)
			{
				if(!strstr($page, 'index'))
				{
					return;
				}
			}
			if($INFO['use_friendly_urls'] == 0)
			{
				if( !strstr($page, 'act=idx') && (substr($page, strlen($page) - 1) != '/'))
				{
					return;
				}
			}
		}
		#end index edit

		/* system enabled? */
		if($this->settings['globalmess_system_on'] == 1)
		{
			/* user can view message? */
			if(in_array($this->memberData['member_group_id'], explode(",", $this->settings['globalmess_groups'])))
			{
				
				/* return the template */
				$return .= $this->registry->output->getTemplate('global')->hookGlobalMess();
				
			}
		}
		
		return $return;
	}
}