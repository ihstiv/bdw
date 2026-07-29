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
 * Display the prefix on board/forum indices.
 */
 
IPSDebug::fireBug( 'info', array( 'Loaded sldTopicPrefixes_BoardIndex' ) );

class sldTopicPrefixes_BoardIndex
{
	protected $registry;
	protected $settings;
	protected $topic;
	
	public function __construct()
	{
		$this->registry		= ipsRegistry::instance();
		$this->settings		= $this->registry->settings();

		if( !empty($this->registry->output->getTemplate('boards')->functionData['boardIndexTemplate']) )
			$this->forums		= $this->registry->output->getTemplate('boards')->functionData['boardIndexTemplate'][0]['cat_data'];
		else
			$this->forums		= $this->registry->output->getTemplate('forum')->functionData['forumIndexTemplate'][0]['sub_forum_data'];
	}
	
	public function getOutput()
	{
	}
	
	/**
	 * If you have a better way of doing this, please let me know.
	 * I gave up on trying to regex it away.
	 */
	public function replaceOutput( $output, $key )
	{
		if( $this->settings['prefix_on_index'] ) {
			$key = '<!--hook.'.$key.'-->';
			$keylen = strlen($key);
			$prelen = 0;
			$pos1 = 0;
			$pos2 = 0;

			/**
			 * Iterate through each forum. Search for next hook key,
			 * find the prior <li>, and insert the prefix after.
			 */
			if( count($this->forums) ) {
				foreach( $this->forums as $id => $c ) {
					if( count($c['forum_data']) ) {
						foreach( $c['forum_data'] as $f_id => $f ) {
							if( intval( $f['last_post'] ) < 1 || $f['hide_last_info'] ) {
								continue;
							}

							$pos2_o = $pos2;
							$pos2	= strpos( $output, $key, $pos2 + $keylen + $prelen );

							if( empty( $f['newest_prefix'] ) || intval( $f['last_topic_id'] ) < 1 ) {
								continue;
							}

							$pos1	= strrpos( substr( $output, $pos2_o, $pos2-$pos2_o ), '<li>' );
							$output	= substr_replace( $output, $f['newest_prefix'].' ', $pos2_o + $pos1 + 4, 0 );
							$prelen = strlen($f['newest_prefix']);
						}
					}
				}
			}
		}

		return $output;
	}
}
