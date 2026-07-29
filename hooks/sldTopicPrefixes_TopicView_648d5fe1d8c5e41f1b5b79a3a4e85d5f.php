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
 * Display the prefix on the topic page [in the
 * header and the title].
 */
 
IPSDebug::fireBug( 'info', array( 'Loaded sldTopicPrefixes_TopicView' ) );

class sldTopicPrefixes_TopicView
{
	protected $registry;
	protected $settings;
	protected $topic;
	protected $lang;
	
	public function __construct()
	{
		$this->registry		= ipsRegistry::instance();
		$this->settings		= $this->registry->settings();
		$this->topic		= $this->registry->output->getTemplate('topic')->functionData['topicViewTemplate'][0]['topic'];
		$this->lang			= $this->registry->getClass('class_localization');
	}
	
	public function getOutput()
	{
		return '';
	}
	
	/**
	 * Webkit doesn't want to put elements left-floated before the contents
	 * of the line they're currently on--so we have to plant it the hard way...
	 */
	public function replaceOutput( $output, $key )
	{
		if( $this->topic['tags']['prefix'] ) {
			$pos = strpos( $output, "<h1 itemprop=\"name\" class='ipsType_pagetitle'>" );
			$pos = $pos > 26 ? $pos : strpos( $output, "h2>" ) + 3;
			
			if( $pos > 26 ) {
				$insert = '<div style="float:left;padding:9px 5px 0 0;">' . $this->topic['tags']['formatted']['prefix'] . '</div>';
				$output = substr_replace( $output, $insert, $pos, 0 );
			}
			
			if( $this->settings['prefix_in_title'] ) {
				$this->lang->loadLanguageFile( array( 'public_global' ), 'advancedtagsprefixes' );
				$output = str_replace( '<title>', sprintf( '<title>'.$this->lang->words['pre_title_format'], $this->topic['tags']['prefix'] ), $output );
			}
		}
		
		return $output;
	}
}
