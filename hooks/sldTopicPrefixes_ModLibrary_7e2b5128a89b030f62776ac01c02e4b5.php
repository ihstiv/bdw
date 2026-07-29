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
 * Recache the 'Last Post Info' prefixes when performing
 * a moderation action.
 */
 
IPSDebug::fireBug( 'info', array( 'Loaded sldTopicPrefixes_ModLibrary' ) );

class sldTopicPrefixes_ModLibrary extends moderatorLibrary
{
	public function forumRecount( $fid="" )
	{
		if( $return = parent::forumRecount( $fid ) ) {
			/* Load tagging stuff */
			if ( ! $this->registry->isClassLoaded('tags') )
			{
				require_once( IPS_ROOT_PATH . 'sources/classes/tags/bootstrap.php' );/*noLibHook*/
				$this->registry->setClass( 'tags', classes_tags_bootstrap::run( 'forums', 'topics' )  );
			}

			/**
			 * Grab and format the prefix, then add it to the forum.
			 */
			$last_post	= $this->DB->buildAndFetch( array(	'select'	=> 'tid',
															'from'		=> 'topics',
															'where'		=> $this->registry->getClass('class_forums')->fetchTopicHiddenQuery( array( 'visible' ), '' ) . " and forum_id={$fid}",
															'order'		=> 'last_post DESC',
															'limit'		=> array( 1 ) ) );
			if( !empty($last_post) ) {
				$tags = $this->registry->getClass('tags')->getTagsByMetaId( array( 'meta_id' => $last_post['tid'] ) );
				$args['newest_prefix'] = $tags['formatted']['prefix'];
			}
			else {
				$args['newest_prefix'] = '';
			}
			
			$this->DB->update( 'forums', $args, "id=" . $fid );
		}

		return $return;
	}
}
