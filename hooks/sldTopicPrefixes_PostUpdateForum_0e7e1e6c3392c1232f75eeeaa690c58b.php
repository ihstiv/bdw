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
 * Add the topic prefix to cached forum data when
 * adding a new topic or reply.
 */
 
IPSDebug::fireBug( 'info', array( 'Loaded sldTopicPrefixes_PostUpdateForum' ) );

class sldTopicPrefixes_PostUpdateForum
{
	protected $registry;

	public function __construct()
	{
		$this->registry = ipsRegistry::instance();
	}

	public function handleData( $args )
	{
		/**
		 * If the 'newest' topic is changing...
		 */
		if( isset($args['last_id']) ) {
			/* Load tagging stuff */
			if ( ! $this->registry->isClassLoaded('tags') )
			{
				require_once( IPS_ROOT_PATH . 'sources/classes/tags/bootstrap.php' );/*noLibHook*/
				$this->registry->setClass( 'tags', classes_tags_bootstrap::run( 'forums', 'topics' )  );
			}

			/**
			 * Grab the topic prefix and add it to the data
			 */
			$tags = $this->registry->getClass('tags')->getTagsByMetaId( array( 'meta_id' => $args['last_id'] ) );
			$args['newest_prefix'] = $tags['formatted']['prefix'];
		}

		return $args;
	}
}
