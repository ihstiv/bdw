<?php

class bim_fcontentCSS
{
	public function __construct()
	{
		$this->registry   = ipsRegistry::instance();
		$this->settings =& $this->registry->fetchSettings();
	}
	
	public function getOutput()
	{
		if( $this->settings['bim_fcontent_on'] == 1 )
		{
			return $this->registry->getClass('output')->getTemplate('featuredcontent')->fcontent_css();
		}
	}
}