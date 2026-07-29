<?php

class nexusContactUs
{
	public $registry;
	
	public function __construct()
	{
		$this->registry = ipsRegistry::instance();
		$this->lang		= $this->registry->getClass('class_localization');
	}
	
	public function getOutput()
	{
		if ( IPSLib::appIsInstalled('nexus') )
		{
			$caches = $this->registry->cache()->fetchCaches();
			if ( !empty( $caches['support_departments'] ) )
			{
				$this->lang->loadLanguageFile( array( 'public_nexus' ), 'nexus' );
				return "<li><a href='{$this->registry->output->buildUrl( 'app=nexus&module=support&section=new' )}'>{$this->lang->words['contact_us']}</a></li>";
			}
		}
	}	
}