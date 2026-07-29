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
  * Various alterations to default forum tag settings and behavior.
  */
 
IPSDebug::fireBug( 'info', array( 'Loaded sldTopicPrefixes_ForumTagsExt' ) );

class sldTopicPrefixes_ForumTagsExt extends tags_forums_topics
{
	/**
	 * By default, IP.Board sets tags to closed if there are
	 * any predefined for a forum. We don't want that.
	 * We've added a forum 'tag_mode' setting to determine this.
	 */
	public function render( $what, $where )
	{
		if ( ! empty( $where['meta_parent_id'] ) ) {
			$forum = $this->registry->class_forums->getForumById( $where['meta_parent_id'] );
			
			if( $forum['tag_mode'] == 'open' || ( $forum['tag_mode'] == 'inherit' && $this->settings['tags_open_system'] ) ) {
				$this->settings['tags_open_system'] = true;
			}
			else {
				$this->settings['tags_open_system'] = false;
			}
		}

		return classes_tag_abstract::render( $what, $where );
	}

	/**
	 * We don't want prefixes included in the tag list.
	 */
	protected function _formatCachedData( $tags )
	{
		if ( ! is_array( $tags ) OR ! count( $tags ) OR empty( $tags['tag_cache_text'] ) )
		{
			return null;
		}
		
		/* Unserialise */
		if ( ! IPSLib::isSerialized( $tags['tag_cache_text'] ) )
		{
			return null;
		}
		
		$tagData = unserialize( $tags['tag_cache_text'] );
		
		$tagData['formatted']           = array();

		if( is_array($tagData['tags']) AND count($tagData['tags']) )
		{
			if( !$this->settings['prefix_tags_on_topic_list'] && $this->request['section'] == 'forums' ) {
				$tagData['formatted']       = $this->formatTagsForDisplay( array() );
			}
			else {
				$tagData['formatted']       = $this->formatTagsForDisplay( $tagData['tags'], $tags['tag_cache_key'] );
			}

			if( $this->settings['prefix_in_tags'] ) {
				$str						= $tagData['formatted']['string'];
				$tagData['formatted']       = $this->formatTagsForDisplay( array_diff( $tagData['tags'], array($tagData['prefix']) ), $tags['tag_cache_key'] );
				$tagData['formatted']['string'] = $str;
			}

			$tagData['formatted']['prefix']	= false;
		}
		else {
			return null;
		}
		
		if( ! empty( $tagData['prefix'] ) )
		{
			$tagData['formatted']['prefix'] = $this->registry->output->getTemplate( $this->skin() )->tagPrefix( $tagData['prefix'], $this->getApp(), $this->getSearchSection() );
		}
		
		return $tagData;
	}
}
