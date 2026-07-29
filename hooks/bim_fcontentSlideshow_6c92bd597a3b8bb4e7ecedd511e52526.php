<?php

class bim_fcontentSlideshow
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
			require_once( IPSLib::getAppDir( 'featuredcontent' ) . '/sources/fcontent_show.php' );
			$this->registry->setClass( 'fshow', new fcontent_show( $this->registry ) );			
			$this->_html = $this->registry->fshow->_start($gid='');
			return $this->_html;
		}
	}
}