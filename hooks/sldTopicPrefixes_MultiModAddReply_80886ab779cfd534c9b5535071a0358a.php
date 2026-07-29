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
 * When adding a reply via multimod, don't reset the topic state.
 * When we set a prefix first, some wierd caching happens and
 * overwrites the state and pin status set by the multimod.
 */
 
IPSDebug::fireBug( 'info', array( 'Loaded sldTopicPrefixes_MultiModAddReply' ) );

class sldTopicPrefixes_MultiModAddReply
{
	protected $registry;

	public function __construct()
	{
		$this->registry = ipsRegistry::instance();
		$this->request  =& $this->registry->fetchRequest();
	}

	public function handleData( $args )
	{
		/**
		 * If this is a multimod, don't unset things. Rudimentary, but effective.
		 */
		if( intval($this->request['mm_id']) > 0 ) {
			unset( $args['state'] );
			unset( $args['pinned'] );
		}

		return $args;
	}
}
