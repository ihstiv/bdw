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
 * Change the prefix after submitting the edit title mod form
 * or a multi-mod.
 */
 
IPSDebug::fireBug( 'info', array( 'Loaded sldTopicPrefixes_EditTitle' ) );

class sldTopicPrefixes_EditTitle extends public_forums_moderate_moderate
{
	/**
	 * Topic title edit?
	 */
	protected function _doEdit()
	{
		$this->_genericPermissionCheck( 'edit_topic' );

		$this->request['t']	= intval($this->request['t']);
		$this->request['f']	= intval($this->request['f']);

		/**
		 * Get topic tags
		 */
		$tags	= $this->registry->tags->getTagsByMetaId( array( 'meta_id' => $this->request['t'] ) );
		$prefix = IPSText::safeslashes( $this->request['prefix'] );

		if( !count($tags) ) {
			$tags = array( 'tags' => array() );
		}

		/**
		 * Prepend or remove and send back.
		 */
		$tags['tags'] = array_diff( $tags['tags'], array($tags['prefix']) );

		if( !empty($prefix) ) {
			array_unshift( $tags['tags'], $prefix );
		}
		else {
			$_REQUEST['ipsTags_prefix'] = 0;
		}

		$this->registry->tags->replace( $tags['tags'], array(	'meta_id'			=> $this->request['t'],
																'meta_parent_id'	=> $this->request['f'] ) );

		parent::_doEdit();
	}
	
	/**
	 * Multi-mod?
	 */
	protected function _multiTopicMmod()
	{
		parent::_multiTopicMmod();
		
		$mm_id		= intval( str_replace( 't_', '', $this->request['tact'] ) );
		$mm_data	= $this->caches['multimod'][ $mm_id ];
		$prefixes	= $this->registry->cache()->getCache('topic_prefixes');
		
		if( count($this->tids) && ( $mm_data['topic_prefix'] >= 0 || !empty($mm_data['topic_add_tags']) ) ) {
			$prefix	= $prefixes[ $mm_data['topic_prefix'] ]['prefix_title'];
			
			foreach( $this->tids as $t_id ) {
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
				$this->registry->tags->replace( $tags['tags'], array(	'meta_id'	=> $t_id ) );
			}
		}
	}
}
