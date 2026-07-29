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
 * Add the prefix dropdown to the edit title moderator form.
 */
 
IPSDebug::fireBug( 'info', array( 'Loaded sldTopicPrefixes_EditTitleView' ) );

class sldTopicPrefixes_EditTitleView extends skin_mod(~id~)
{
	function editTopicTitle( $forum, $topic )
	{
		$this->registry		= ipsRegistry::instance();
		$this->DB			= $this->registry->DB();
		$this->request  	=& $this->registry->fetchRequest();
		$this->lang			= $this->registry->getClass('class_localization');
		$this->lang->loadLanguageFile( array( 'public_global' ), 'advancedtagsprefixes' );
		$this->memb			= $this->registry->member()->fetchMemberData();
		$this->prefixes		= $this->registry->cache()->getCache('topic_prefixes');

		$output = parent::editTopicTitle( $forum, $topic );
		
		if( !isset($this->prefixesByName) && count($this->prefixes) ) {
			foreach( $this->prefixes as $prefix ) {
				$this->prefixesByName[ IPSText::mbstrtolower( $prefix['prefix_title'] ) ] = $prefix;
			}
		}
		
		/**
		 * Fetch the prefix, if any.
		 */
		$topic_prefix	= $this->DB->buildAndFetch(	array(	'select'	=> '*',
															'from'		=> 'core_tags',
															'where'		=> "tag_prefix=1 and tag_aai_lookup='" . md5( 'forums;topics;' . $topic['tid'] ) . "'" ) );
		
		/**
		 * Build an array of prefixes we're allowed to use
		 */
		$forum_allowed	= explode( ',', $forum['tag_predefined'] );
		$prefixes		= array();
		
		if( count($forum_allowed) ) {
			foreach( $forum_allowed as $k => $prefix ) {
				if( $r = $this->prefixesByName[ IPSText::mbstrtolower( trim($prefix) ) ] ) {
					$prefix_allowed = array_filter( explode( ',', $r['prefix_groups'] ) );
					
					if( !count($prefix_allowed) || IPSMember::isInGroup( $this->memb, $prefix_allowed ) ) {
						$selected	= ( $topic_prefix && IPSText::mbstrtolower( $r['prefix_title'] ) == IPSText::mbstrtolower( $topic_prefix['tag_text'] ) ) ? ' selected="selected"' : '';
						$prefixes[ $r['prefix_title'] ]	= '<option value="' . $r['prefix_title'] . '"' . $selected . '>' . $r['prefix_title'] . '</option>' . "\n";
					}
				}
			}
		}
		
		if( !count($prefixes) ) {
			return $output;
		}
		else {
			/**
			 * Build the tag and output
			 */
			ksort($prefixes);
			$prefixes	= implode( '', $prefixes );
			$loco		= strpos( $output, '<ul>' ) + 4;
			
			if( $loco < 10 ) {
				$loco = strpos( $output, 'ipsField' ) + 10;
			}
			
			$HTML = <<<HTML
				<li class='field'>
					<label for='prefix' class='ipsField_title'>{$this->lang->words['pre_topic_prefix']}</label>
					<p class='ipsField_content'>
						<input type='hidden' name='ipsTags_prefix' value='1' />
						<select name='prefix' id='prefix' class='input_select'>
							<option value="0">{$this->lang->words['pre_none']}</option>
							{$prefixes}
						</select>
					</p>
				</li>
HTML;

			return substr_replace( $output, $HTML, $loco, 0 );
		}
	}
}
