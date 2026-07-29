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
 * Display prefixes with the appropriate styles, and
 * add the prefix dropdown to the new topic form.
 */
 
IPSDebug::fireBug( 'info', array( 'Loaded sldTopicPrefixes_SkinGlobal' ) );

class sldTopicPrefixes_SkinGlobal extends skin_global_other(~id~)
{
	/**
	 * Add formatting to the prefix on output [if available].
	 */
	function tagPrefix($tag, $app='', $section='') {
		/**
		 * Load prefixes.
		 */
		$this->prefixes = $this->cache->getCache('topic_prefixes');
		
		if( !isset($this->prefixesByName) && count($this->prefixes) ) {
			foreach( $this->prefixes as $prefix ) {
				$this->prefixesByName[ IPSText::mbstrtolower( $prefix['prefix_title'] ) ] = $prefix;
			}
		}
		
		/**
		 * Find and prepare prefix formatting.
		 */
		if( $p = $this->prefixesByName[ IPSText::mbstrtolower( $tag ) ] ) {
			$tagF	= $p['prefix_pre'] . ($p['prefix_showtitle'] ? $p['prefix_title'] : '') . $p['prefix_post'];
			$style	= '';
		}
		else {
			$tagF	= $tag;
			$style	= " class='ipsBadge ipsBadge_lightgrey'";
		}
		
		/**
		 * Output.
		 */
		return "<a href=\"" . $this->registry->getClass('output')->formatUrl( $this->registry->getClass('output')->buildUrl( "app=core&amp;module=search&amp;do=search&amp;search_tags=" . urlencode($tag) . "&amp;search_app=" . ((isset($this->request['search_app']) AND $this->request['search_app']) ? ("{$this->request['search_app']}") : ("{$app}")) . "" . (($section) ? ("&amp;search_app_filters[" . ((isset($this->request['search_app']) AND $this->request['search_app']) ? ("{$this->request['search_app']}") : ("{$app}")) . "][searchInKey]={$section}") : ("")) . "", "public",'' ), "false", "tags" ) . "\" " . $style . " data-tooltip=\"" . sprintf( $this->lang->words['find_more_tags'], ($p ? $p['prefix_title'] : $tag) ) . "\">{$tagF}</a>";
	}
	
	/**
	 * Modify the tag entry box within the Forum app: Adds a
	 * separate 'prefix' dropdown according to forum settings.
	 */
	function tagTextEntryBox($tags, $options, $where)
	{
		if( $where['meta_app'] == 'forums' ) {
			/**
			 * Get the forum tags mode
			 */
			if ( !empty($where['meta_parent_id']) ) {
				$forum = $this->registry->class_forums->getForumById( $where['meta_parent_id'] );
			}

			/**
			 * 'Disable' prefixes to remove those form elements.
			 */
			$options['prefixesEnabled'] = false;

			/**
			 * If we are editing, remove any existing prefix from tag list.
			 */
			if( $tags['prefix'] ) {
				foreach( $tags['tags'] as $k => $tag ) {
					if( $tag == $tags['prefix'] ) {
						unset( $tags['tags'][ $k ] );
						break;
					}
				}
				$tags['tags'] = array_values($tags['tags']);
			}
			$prefix_select = $this->_getPrefixSelect( $tags );

			/**
			 * Set default tags when appropriate.
			 */
			$tags['tags'] = $this->_getTags( $tags['tags'] );

			if( !$options['isOpenSystem'] && empty($options['predefinedTags']) ) {
				$options['predefinedTags'] = array();
				$forum['tag_mode'] = 'prefix';
			}

			/**
			 * IP.Board 3.3.0 ONLY: Invert logic for allowing prefixes, because it went backwards somewhere.
			 */
			if( $ver['long'] <= 33010 ) {
				$this->memberData['gbw_disable_prefixes'] = !$this->memberData['gbw_disable_prefixes'];
			}
		}

		/**
		 * Return with prefix select appended.
		 */
		if( !empty($forum) && $forum['tag_mode'] == 'prefix' ) {
			$this->lang->loadLanguageFile( array( 'public_global' ), 'advancedtagsprefixes' );
			$this->lang->words['topic_tags'] = '';
			return '<style type="text/css">li.tag_field{display:none}</style>' . $prefix_select;
		}
		else if( !empty($forum) ) {
			return parent::tagTextEntryBox($tags, $options, $where) . $prefix_select;
		}
		else {
			return parent::tagTextEntryBox($tags, $options, $where);
		}
	}
	
	/**
	 * Build a dropdown of prefixes according to forum
	 * settings and user permissions.
	 */
	protected function _getPrefixSelect( $tags )
	{
		$this->prefixes = $this->cache->getCache('topic_prefixes');
		$this->lang->loadLanguageFile( array( 'public_global' ), 'advancedtagsprefixes' );
		
		if( !isset($this->prefixesByName) && count($this->prefixes) ) {
			foreach( $this->prefixes as $prefix ) {
				$this->prefixesByName[ IPSText::mbstrtolower( $prefix['prefix_title'] ) ] = $prefix;
			}
		}
		
		/**
		 * Retain the prefix if we're previewing
		 */
		$existing_prefix = false;
		if( isset($this->request['prefix']) ) {
			$existing_prefix = $this->request['prefix'];
		}
		
		/**
		 * Get the prefix if we're editing the topic
		 */
		if( $existing_prefix === false && !empty($tags['prefix']) ) {
			$existing_prefix = $tags['prefix'];
		}
		
		/**
		 * Build an array of prefixes we're allowed to use
		 */
		$f	= $this->DB->buildAndFetch( array(	'select'	=> 'tag_predefined, default_prefix, default_tags, require_prefix',
												'from'		=> 'forums',
												'where'		=> 'id=' . intval($this->request['f']) ) );
		$this->f = $f;
		$forum_allowed = explode( ',', $f['tag_predefined'] );
		
		if( $existing_prefix === false && !empty($f['default_prefix']) ) {
			$existing_prefix = $f['default_prefix'];
		}
		
		$this->memb = $this->registry->member()->fetchMemberData();
		$prefixes	= array();
		
		if( count($forum_allowed) ) {
			foreach( $forum_allowed as $k => $prefix ) {
				if( $r = $this->prefixesByName[ IPSText::mbstrtolower( trim($prefix) ) ] ) {
					$prefix_allowed = array_filter( explode( ',', $r['prefix_groups'] ) );
					
					if( !count($prefix_allowed) || IPSMember::isInGroup( $this->memb, $prefix_allowed ) ) {
						$selected	= ($existing_prefix && IPSText::mbstrtolower($r['prefix_title']) == IPSText::mbstrtolower($existing_prefix) ) ? ' selected="selected"' : '';
						$prefixes[ $r['prefix_title'] ]	= '<option value="' . $r['prefix_title'] . '"' . $selected . '>' . $r['prefix_title'] . '</option>' . "\n";
					}
				}
			}
		}
		
		/**
		 * If there are any prefixes left, send them back.
		 * If there's only one prefix and it's required, don't show the input.
		 */
		if( !count($prefixes) ) {
			return '';
		}
		else if( count($prefixes) == 1 && $f['require_prefix'] ) {
			$prefix = implode( '', array_keys( $prefixes ) );

			return <<<HTML
				<input type='hidden' name='ipsTags_prefix' value='1' />
				<input type='hidden' name='prefix' value='{$prefix}' />
HTML;
		}
		else {
			ksort($prefixes);
			$prefixes = implode( '', $prefixes );
			
			$null = ( $f['require_prefix'] ) ? $this->lang->words['pre_select'] : $this->lang->words['pre_none'];
			
			return <<<HTML
				<li class='ipsField'>
					<label for='prefix' class='ipsField_title'>{$this->lang->words['pre_topic_prefix']}</label>
					<p class='ipsField_content'>
						<input type='hidden' name='ipsTags_prefix' value='1' />
						<select name='prefix' id='prefix' class='input_select' style="font-size: 1.2em;">
							<option value="0">{$null}</option>
							{$prefixes}
						</select>
					</p>
				</li>
HTML;
		}
	}

	protected function _getTags( $tags ) {
		if( $this->request['do'] == 'new_post' && !empty($this->f['default_tags']) ) {
			$tags = array_filter( explode( ',', $this->f['default_tags'] ) );
		}

		return $tags;
	}
}
