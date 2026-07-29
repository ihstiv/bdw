//<?
/**
 * @package		Advanced Tags & Prefixes
 * @author		Ryan Hoerr
 * @copyright	(c) 2012 Ryan Hoerr / Sublime Development
 * @license		http://www.sublimism.com/products/terms-of-use
 * @version		$Id: topic_prefixes.xml 40 2013-07-30 04:12:33Z No1_1000 $
 * @updated		$Date: 2013-07-30 00:12:33 -0400 (Tue, 30 Jul 2013) $
 */

/**
 * Show prefixes in forum descriptions as subcategories
 */
 
IPSDebug::fireBug( 'info', array( 'Loaded sldTopicPrefixes_SubforumDesc' ) );

class sldTopicPrefixes_SubforumDesc extends skin_forum(~id~)
{
	function forumIndexTemplate($forum_data, $announce_data, $topic_data, $other_data, $multi_mod_data, $sub_forum_data, $footer_filter, $active_user_data, $mod_data, $inforum=1)
	{
		$this->lang->loadLanguageFile( array( 'public_global' ), 'advancedtagsprefixes' );
		
		/**
		 * Preload all the prefixes so we needn't fetch them later.
		 */
		$this->prefixes = $this->cache->getCache('topic_prefixes');
		if( count($this->prefixes) ) {
			foreach( $this->prefixes as $prefix ) {
				$this->prefixesByName[ IPSText::mbstrtolower( $prefix['prefix_title'] ) ] = $prefix;
			}
		}
		
		foreach( $sub_forum_data as $id => $c ) {
			foreach( $c['forum_data'] as $f_id => $f ) {
				if( !$f['show_prefix_in_desc'] )
					continue;
				
				$tags = array_filter( explode( ',', $sub_forum_data[$id]['forum_data'][$f_id]['tag_predefined'] ) );
				if( count($tags) ) {
					$prefixes = array();
					foreach( $tags as $tag ) {
						if( $p = $this->prefixesByName[ IPSText::mbstrtolower( trim($tag) ) ] ) {
							$title = $p['prefix_showtitle'] ? $p['prefix_title'] : $p['prefix_pre'] . $p['prefix_post'];
							
							$prefixes[ $p['prefix_title'] ] = "<a href=\"" . $this->registry->getClass('output')->formatUrl( $this->registry->getClass('output')->buildUrl( "app=core&amp;module=search&amp;do=search&amp;search_tags=" . urlencode($p['prefix_title']) . "&amp;search_app=forums&amp;search_app_filters[forums][forums][]=" . $f_id, "public",'' ), "false", "tags" ) . "\" data-tooltip=\"" . sprintf( $this->lang->words['find_more_tags'], $p['prefix_title'] ) . "\">{$title}</a>";
						}
					}
					
					ksort( $prefixes );
					
					$sub_forum_data[$id]['forum_data'][$f_id]['description'] .= '<br />'.$this->lang->words['pre_cats'].' '.implode( ' &bull; ', $prefixes );
				}
			}
		}

		/**
		 * Add prefixes for the mobile skin
		 */
		if( $this->registry->output->skin['set_master_key'] == 'mobile' && count($topic_data) ) {
			foreach( $topic_data as $id => $t ) {
				$tags = $this->registry->tags->getTagsByMetaId( array( 'meta_id' => $id ) );
				if( !empty( $tags['formatted']['prefix'] ) ) {
					$topic_data[$id]['prefix'] = '<div style="float:left;padding-right:5px;">' . $tags['formatted']['prefix'] . '</div>' . $topic_data[$id]['prefix'];
				}
			}
		}
		
		return parent::forumIndexTemplate($forum_data, $announce_data, $topic_data, $other_data, $multi_mod_data, $sub_forum_data, $footer_filter, $active_user_data, $mod_data, $inforum=1);
	}
}
