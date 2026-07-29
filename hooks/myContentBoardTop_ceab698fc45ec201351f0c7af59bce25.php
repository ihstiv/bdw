<?php

class myContentBoardTop
{
	public $registry;
	public $member;
	
	public function __construct()
	{
		$this->registry   =  ipsRegistry::instance();
		$this->memberData =& $this->registry->member()->fetchMemberData();
		$this->settings   =& $this->registry->fetchSettings();
		$this->DB         =  $this->registry->DB();
		$this->lang		  =  $this->registry->getClass('class_localization');
		$this->cache	  =& $this->registry->cache()->fetchCaches();
		$this->request    =& $this->registry->fetchRequest();
	}
	
	public function getOutput()
	{
		if ( $this->memberData['member_id'] )
		{
			$this->lang->loadLanguageFile( array( "public_global" ), 'core' );

			$link = $this->registry->getClass( 'output' )->buildUrl( "app=core&module=search&do=user_activity&mid={$this->memberData['member_id']}&userMode=title", 'public' );

			return $this->registry->getClass('output')->getTemplate('global')->myContentLink( $link );
		}
	}	
}?>