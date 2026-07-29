<?php

class webFonts
{
	public function getOutput()
	{
	$html = ipsRegistry::getClass('output')->getTemplate('tomchristian')->tctc91_webFonts();
	return $html;
	}
}