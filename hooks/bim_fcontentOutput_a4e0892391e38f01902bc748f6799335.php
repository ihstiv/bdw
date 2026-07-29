<?php
class bim_fcontentOutput extends class_localization
{
	public function loadLanguageFile( $load = array(), $app = '', $lang = '', $forceReload = false )
	{
		$this->loadFclass();
		parent::loadLanguageFile( $load, $app, $lang, $forceReload );
	}

	protected function loadFclass()
	{
		$this->registry   = ipsRegistry::instance();
		require_once( IPSLib::getAppDir( 'featuredcontent' ) . '/sources/fcontent_show.php' );
		$this->registry->setClass( 'fshow', new fcontent_show( $this->registry ) );		
	}
}
?>