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
 * Adds processing for prefix/tag multimod settings.
 */
 
IPSDebug::fireBug( 'info', array( 'Loaded sldTopicPrefixes_MultiModAdmin' ) );

class sldTopicPrefixes_MultiModAdmin extends admin_forums_forums_multimods
{
	public function multiModerationSaveForm( $type='new' )
	{
		/* INI */
		$forums = array();

		/* Make sure we have a title */
		if( ! $this->request['mm_title'] )
		{
			$this->registry->output->showError( $this->lang->words['mm_valtitle'], 11333 );
		}
		
		/* Check for forums */
		$forums = $this->_getSelectedForums();
		
		/* Check forums */
		if( ! $forums )
		{
			$this->registry->output->showError( $this->lang->words['mm_forums'], 11334 );
		}
		
		/* Check move location */
		if( $this->request['topic_move'] == 'n' )
		{
			$this->registry->output->showError( $this->lang->words['mm_wrong'], 11335 );
		}
		
		/* Build the insert array */
		$save = array(
						'mm_title'              => $this->request['mm_title'],
						'mm_enabled'            => 1,
						'topic_state'           => $this->request['topic_state'],
						'topic_pin'	            => $this->request['topic_pin'],
						'topic_move'            => intval( $this->request['topic_move'] ),
						'topic_move_link'       => intval( $this->request['topic_move_link'] ),
						'topic_title_st'        => IPSText::stripslashes( $_POST['topic_title_st'] ),
						'topic_title_end'       => IPSText::stripslashes( $_POST['topic_title_end'] ),
						'topic_reply'           => intval( $this->request['topic_reply'] ),
						'topic_reply_content'   => IPSText::stripslashes( $_POST['topic_reply_content'] ),
						'topic_reply_postcount' => intval( $this->request['topic_reply_postcount'] ),
						'mm_forums'             => $forums,
						'topic_approve'         => intval( $this->request['topic_approve'] ),
		/** Start Advanced Tags & Prefixes code **/
                        'topic_prefix'          => intval( $this->request['topic_prefix'] ),
                        'topic_add_tags'		=> IPSText::stripslashes( $_POST['topic_add_tags'] ),
		/** End Advanced Tags & Prefixes code **/
					 );
		 
		/* Edit */
		if ( $type == 'edit' )
		{
			/* ID */
			$id = intval( $this->request['id'] );
			
			if( ! $id )
			{
				$this->registry->output->showError( $this->lang->words['mm_valid'] );
			}
			
			/* Update the multi mod */			
			$this->DB->update( 'topic_mmod', $save, 'mm_id='.$id );
		}
		/* New */
		else
		{
			/* Insert the new multi mod */
			$this->DB->insert( 'topic_mmod', $save );
		}
		
		/* Log, Cache, and Bounce */
		$this->registry->adminFunctions->saveAdminLog( sprintf( $this->lang->words['mm_update'], $type ) );
		$this->multiModerationRebuildCache();		
		$this->registry->output->silentRedirect( $this->settings['base_url'] . $this->html->form_code );
	}
	
	public function multiModerationForm( $type='new' )
	{
		if( $type == 'new' )
		{
			/* Setup */
			$form_code   = 'donew';
			$id			 = 0;
			$description = $this->lang->words['mm_addnew'];
			$button      = $this->lang->words['mm_addnew'];
			
			/* Default Values */
			$topic_mm	 = array( 
									'mm_forums'             => '', 
									'mm_title'              => '', 
									'topic_title_st'        => '',
									'topic_title_end'       => '', 
									'topic_state'           => '', 
									'topic_pin'             => '',
									'topic_approve'         => '', 
									'topic_move'            => '', 
									'topic_move_link'       => '',
									'topic_reply'           => '', 
									'topic_reply_content'   => '', 
									'topic_reply_postcount' => '' 
								);
		}
		else
		{
			/* Setup */
			$id = intval( $this->request['id'] );
			$form_code   = 'doedit';
			$description = $this->lang->words['mm_edit'];
			$button      = $this->lang->words['mm_edit'];
			
			/* Default Values */			
			$this->DB->build( array(	'select'	=> '*',
										'from'		=> 'topic_mmod',
										'where'		=> "mm_id=" . $id ) );
			$this->DB->execute();
		
			if ( ! $topic_mm = $this->DB->fetch() )
			{
				$this->registry->output->showError( sprintf( $this->lang->words['mm_noinfo'], $id ), 11337 );
			}
		}
		
		/* State Drop Options */
		$state_dd = array(
						  0 => array( 'leave', $this->lang->words['mm_leave'] ),
						  1 => array( 'close', $this->lang->words['mm_close'] ),
						  2 => array( 'open' , $this->lang->words['mm_open']  ),
					   );
		
		/* Pinned Drop Down Options */
		$pin_dd   = array(
						  0 => array( 'leave', $this->lang->words['mm_leave'] ),
						  1 => array( 'pin'  , $this->lang->words['mm_pin']   ),
						  2 => array( 'unpin', $this->lang->words['mm_unpin'] ),
					    );
		
		/* Approved Drop Down Options */
		$app_dd   = array(
						  0 => array( '0', $this->lang->words['mm_leave']     ),
						  1 => array( '1', $this->lang->words['mm_approve']   ),
						  2 => array( '2', $this->lang->words['mm_unapprove'] ),
					    );
		
		/* Build forum multiselect */
		$topic_mm['forums'] = "<select name='forums[]' class='textinput' size='15' multiple='multiple'>\n";
		
		$topic_mm['forums'] .= $topic_mm['mm_forums'] == '*' ? "<option value='all' selected='selected'>{$this->lang->words['mm_allforums']}</option>\n" : "<option value='all'>{$this->lang->words['mm_allforums']}</option>\n";		    
		
		$forum_jump = $this->forumfunc->adForumsForumData();
			
		foreach( $forum_jump as $i )
		{
			if( strstr( "," . $topic_mm['mm_forums'] . ",", "," . $i['id'] . "," ) and $topic_mm['mm_forums'] != '*' )
			{
				$selected = ' selected="selected"';
			}
			else
			{
				$selected = "";
			}
			
			if( !empty( $i['redirect_on'] ) )
			{
				continue;
			}
			
			$fporum_jump[] = array( $i['id'], $i['depthed_name'] );
			
			$topic_mm['forums']  .= "<option value=\"{$i['id']}\" $selected>{$i['depthed_name']}</option>\n";
		}
		
		$topic_mm['forums'] .= "</select>";
		
		/* Build Form Fields */
		$topic_mm['mm_title']              = $this->registry->output->formInput("mm_title", $topic_mm['mm_title'] );
		$topic_mm['topic_title_st']        = $this->registry->output->formInput("topic_title_st", $topic_mm['topic_title_st'] );
		$topic_mm['topic_title_end']       = $this->registry->output->formInput("topic_title_end", $topic_mm['topic_title_end'] );
		$topic_mm['topic_state']           = $this->registry->output->formDropdown("topic_state", $state_dd, $topic_mm['topic_state'] );
		$topic_mm['topic_pin']             = $this->registry->output->formDropdown("topic_pin", $pin_dd, $topic_mm['topic_pin'] );
		$topic_mm['topic_approve']         = $this->registry->output->formDropdown("topic_approve", $app_dd, $topic_mm['topic_approve'] );
		$topic_mm['topic_move']            = $this->registry->output->formDropdown("topic_move", array_merge( array( 0 => array('-1', $this->lang->words['mm_nobodymovenobodygethurt'] ) ), $fporum_jump ), $topic_mm['topic_move'] );
		$topic_mm['topic_move_link']       = $this->registry->output->formCheckbox('topic_move_link', $topic_mm['topic_move_link'] );
		$topic_mm['topic_reply']           = $this->registry->output->formYesNo('topic_reply', $topic_mm['topic_reply'] );
		$topic_mm['topic_reply_content']   = $this->registry->output->formTextarea("topic_reply_content", $topic_mm['topic_reply_content'] );
		$topic_mm['topic_reply_postcount'] = $this->registry->output->formCheckbox('topic_reply_postcount', $topic_mm['topic_reply_postcount'] );

		/** Start Advanced Tags & Prefixes code **/
		$this->lang->loadLanguageFile( array( 'admin_global' ), 'advancedtagsprefixes' );
		$prefixes		= $this->registry->cache()->getCache('topic_prefixes');
		$prefixes_dd	= array(	array('-1', $this->lang->words['mm_leave']),
									array('0' , $this->lang->words['pre_remove_prefix']) );

		foreach( $prefixes as $prefix ) {
		    $prefixes_dd[] = array( $prefix['prefix_id'], $prefix['prefix_title'] );
		}
		$topic_mm['topic_prefix']          = $this->registry->output->formDropdown("topic_prefix", $prefixes_dd, $topic_mm['topic_prefix'] );
		$topic_mm['topic_add_tags']        = $this->registry->output->formInput("topic_add_tags", $topic_mm['topic_add_tags'] );
		/** End Advanced Tags & Prefixes code **/

		/* Output */
		$this->registry->output->html .= $this->html->multiModerationForm( $id, $form_code, $description, $topic_mm, $button );
	}
}
