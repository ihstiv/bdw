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
 
IPSDebug::fireBug( 'info', array( 'Loaded sldTopicPrefixes_ForumDesc' ) );

class sldTopicPrefixes_ForumDesc extends skin_boards(~id~)
{
	function boardIndexTemplate($lastvisit="", $stats=array(), $cat_data=array(), $show_side_blocks=true, $side_blocks=array())
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
		
		foreach( $cat_data as $id => $c ) {
			foreach( $c['forum_data'] as $f_id => $f ) {
				if( !$f['show_prefix_in_desc'] )
					continue;
				
				$tags = array_filter( explode( ',', $cat_data[$id]['forum_data'][$f_id]['tag_predefined'] ) );
				if( count($tags) ) {
					$prefixes = array();
					foreach( $tags as $tag ) {
						if( $p = $this->prefixesByName[ IPSText::mbstrtolower( trim($tag) ) ] ) {
							$title = $p['prefix_showtitle'] ? $p['prefix_title'] : $p['prefix_pre'] . $p['prefix_post'];
							
							$prefixes[ $p['prefix_title'] ] = "<a href=\"" . $this->registry->getClass('output')->formatUrl( $this->registry->getClass('output')->buildUrl( "app=core&amp;module=search&amp;do=search&amp;search_tags=" . urlencode($p['prefix_title']) . "&amp;search_app=forums&amp;search_app_filters[forums][forums][]=" . $f_id, "public",'' ), "false", "tags" ) . "\" data-tooltip=\"" . sprintf( $this->lang->words['find_more_tags'], $p['prefix_title'] ) . "\">{$title}</a>";
						}
					}
					
					ksort( $prefixes );
					
					if( !empty($cat_data[$id]['forum_data'][$f_id]['description']) )
						$cat_data[$id]['forum_data'][$f_id]['description'] .= '<br />' . $this->lang->words['pre_cats'] . ' ' . implode( ' &bull; ', $prefixes );
					else
						$cat_data[$id]['forum_data'][$f_id]['description'] = $this->lang->words['pre_cats'] . ' ' . implode( ' &bull; ', $prefixes );
				}
			}
		}
		
		return parent::boardIndexTemplate( $lastvisit, $stats, $cat_data, $show_side_blocks, $side_blocks );
	}
}
