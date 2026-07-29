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
 * Adds input fields for prefix/tag multimod settings.
 */
 
IPSDebug::fireBug( 'info', array( 'Loaded sldTopicPrefixes_MultiModSkinCp' ) );

class sldTopicPrefixes_MultiModSkinCp extends cp_skin_multimods
{
	public function multiModerationForm( $id, $do, $description, $form, $button ) {
		$html	= parent::multiModerationForm( $id, $do, $description, $form, $button );
		$this->lang->loadLanguageFile( array( 'admin_global' ), 'advancedtagsprefixes' );

		/**
		 * Find position of </tr> after input mm_link.
		 * Failure is not an option!
		 */
		$pos	= strpos( $html, '</tr>', strpos( $html, 'topic_move_link' ) ) + 5;

		$fields = <<<BLK
<!-- Start Advanced Tags & Prefixes code -->
				<tr>
					<th colspan='2'>{$this->lang->words['pre_app_title']}</th>
				</tr>
				<tr>
					<td class='field_title'>
						<strong class='title'>{$this->lang->words['pre_alter']}</strong>
					</td>
					<td class='field_field'>
						{$form['topic_prefix']}
					</td>
				</tr>
				<tr>
					<td class='field_title'>
						<strong class='title'>{$this->lang->words['pre_add_tags']}</strong>
					</td>
					<td class='field_field'>
						{$form['topic_add_tags']}<br />
						<span class='desctext'>{$this->lang->words['pre_add_tags_desc']}</span>
					</td>
				</tr>
<!-- End Advanced Tags & Prefixes code -->
BLK;

		/**
		 * Insert the additional fields and return.
		 */
		return substr_replace( $html, $fields, $pos, 0 );
	}
}
