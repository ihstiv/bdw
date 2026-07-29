<?php

class breadcrumbDesigns 
{
	protected $registry;

	public function __construct()
	{
		$this->registry	= ipsRegistry::instance();
	}

	public function getOutput()
	{
		$html = ipsRegistry::getClass('output')->getTemplate('tomchristian')->tctc91_breadcrumbDesigns();
		return $html;
	}
	public function replaceOutput( $output, $key )
	{
		if (ipsRegistry::$settings['tcBc_homeEnabled'] !== '0') {
			$search = "secondary_navigation' class='clearfix";
			$replace = "secondary_navigation' class='clearfix homeIcon";
			$output = str_replace($search, $replace, $output);
		}
		return $output;
	}
}