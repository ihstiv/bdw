<?php
/**
 * @package		Advanced Tags & Prefixes
 * @author		Ryan Hoerr
 * @copyright	(c) 2012 Ryan Hoerr / Sublime Development
 * @license		http://www.sublimism.com/products/terms-of-use
 * @version		$Id: topic_prefixes.xml 40 2013-07-30 04:12:33Z No1_1000 $
 * @updated		$Date: 2013-07-30 00:12:33 -0400 (Tue, 30 Jul 2013) $
 */

/**
 * Hide the tag icon on the topic list if there
 * are no tags to display...
 */
 
IPSDebug::fireBug( 'info', array( 'Loaded sldTopicPrefixes_TopicList' ) );

class sldTopicPrefixes_TopicList
{
	protected $settings;

	public function __construct()
	{
		$this->settings = IPSRegistry::settings();
	}
	
	public function getOutput()
	{
		return '';
	}

	public function replaceOutput( $output, $key )
	{
		$output = str_replace( "<img src='{$this->settings['img_url']}/icon_tag.png' /> \n", '', $output );
		
		return $output;
	}
}
