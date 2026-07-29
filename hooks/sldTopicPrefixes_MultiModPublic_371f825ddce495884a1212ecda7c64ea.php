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
 * Change the prefix/tags after submitting a public in-topic multimod
 * Requires plugin: http://community.invisionpower.com/files/file/5180-sos33-public-topic-multi-moderation/
 */

IPSDebug::fireBug( 'info', array( 'Loaded sldTopicPrefixes_MultiModPublic' ) );

class sldTopicPrefixes_MultiModPublic extends public_forums_moderate_publicmultimod
{
	/**
	 * Multi-mod?
	 */
	public function doExecute( ipsRegistry $registry )
	{
		/* Load tagging stuff */
		if ( ! $this->registry->isClassLoaded('tags') )
		{
			require_once( IPS_ROOT_PATH . 'sources/classes/tags/bootstrap.php' );/*noLibHook*/
			$this->registry->setClass( 'tags', classes_tags_bootstrap::run( 'forums', 'topics' )  );
		}

		$mm_id	 = intval( $this->request['mm_id'] );
		$mm_data = $this->caches['multimod'][ $mm_id ];
		$t_id    = intval( $this->request['t'] );
		
		if( $mm_data['topic_prefix'] >= 0 || !empty($mm_data['topic_add_tags']) ) {
			/**
			 * Get topic tags.
			 */
			$tags	= $this->registry->getClass('tags')->getTagsByMetaId( array( 'meta_id' => $t_id ) );
			if( !count($tags) ) {
				$tags = array( 'tags' => array() );
			}

			/**
			 * Amend tag list.
			 */
			$prefixes	= $this->registry->cache()->getCache('topic_prefixes');

			if( $mm_data['topic_prefix'] > 0 ) {
				$tags['tags'] = array_diff( $tags['tags'], array($tags['prefix']) );

				$prefix	= $prefixes[ $mm_data['topic_prefix'] ]['prefix_title'];
				$prefix = $this->settings['tags_force_lower'] ? IPSText::mbstrtolower( $prefix ) : $prefix;

				array_unshift( $tags['tags'], $prefix );
				$_REQUEST['ipsTags_prefix'] = 1;
			}
			else if( $mm_data['topic_prefix'] == 0 ) {
				$tags['tags'] = array_diff( $tags['tags'], array($tags['prefix']) );
				$_REQUEST['ipsTags_prefix'] = 0;
			}
			else if( !empty($tags['prefix']) ) {
				$_REQUEST['ipsTags_prefix'] = 1;
			}

			if( !empty($mm_data['topic_add_tags']) ) {
				$add = array_filter( explode( ',', $mm_data['topic_add_tags'] ) );
				foreach( $add as $k => $v ) {
					$add[ $k ] = $this->settings['tags_force_lower'] ? IPSText::mbstrtolower( trim($v) ) : trim($v);
				}

				$tags['tags'] = array_merge( $tags['tags'], $add );
			}

			/**
			 * Save the tags back to DB and cache.
			 */
			$this->registry->getClass('tags')->replace( $tags['tags'], array(	'meta_id'			=> $this->request['t'],
																				'meta_parent_id'	=> $this->request['f'] ) );
		}

		parent::doExecute( $this->registry );
	}
}
