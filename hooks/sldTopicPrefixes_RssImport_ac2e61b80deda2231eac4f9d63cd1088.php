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
 * Add the [real] prefix when importing RSS feeds.
 */
 
IPSDebug::fireBug( 'info', array( 'Loaded sldTopicPrefixes_RssImport' ) );

class sldTopicPrefixes_RssImport extends admin_forums_rss_import
{
	public function rssImportRebuildCache( $rss_import_id, $return=true, $id_is_array=false )
	{
		/* INIT */
		$errors             = array();
		$affected_forum_ids = array();
		$rss_error         	= array();
		$rss_import_ids		= array();
		$items_imported     = 0;
		
		/* Check the ID */
		if ( ! $rss_import_id )
		{
			$rss_import_id = $this->request['rss_import_id'] == 'all' ? 'all' : intval( $this->request['rss_import_id'] );
		}

		/* No ID Found */
		if ( ! $rss_import_id )
		{
			$this->registry->output->global_error = $this->lang->words['im_noid'];
			$this->rssImportOverview();
			return;
		}
		
		/* Create an array of ids */
		if( $id_is_array == 1 )
		{
			$rss_import_ids = explode( ",", $rss_import_id );
		}
		
		/* Load the classes we need */
		if ( ! $this->classes_loaded )
		{
			/* Get the RSS Class */
			if ( ! is_object( $this->class_rss ) )
			{
				$classToLoad = IPSLib::loadLibrary( IPS_KERNEL_PATH . 'classRss.php', 'classRss' );
				$this->class_rss               = new $classToLoad();
				$this->class_rss->rss_max_show = 100;
			}

			/* Get the post class */
			require_once(IPSLib::getAppDir('forums') .'/sources/classes/post/classPost.php' );/*noLibHook*/
			$classToLoad = IPSLib::loadLibrary( IPSLib::getAppDir( 'forums' ) . '/sources/classes/post/classPostForms.php', 'classPostForms', 'forums' );
			
			$this->post = new $classToLoad( $this->registry );

			/* Load the mod libarry */
			if ( ! $this->func_mod )
			{
				$classToLoad = IPSLib::loadLibrary( IPSLib::getAppDir( 'forums' ) . '/sources/classes/moderate.php', 'moderatorLibrary', 'forums' );
				$this->func_mod = new $classToLoad( $this->registry );
			}
			
			$this->classes_loaded = 1;
		}
		
		/* INIT Forums */
		if ( ! is_array( $this->registry->class_forums->forum_by_id ) OR !count( $this->registry->class_forums->forum_by_id ) )
		{
			$this->registry->class_forums->forumsInit();
		}
		
		/* Sort out which IDs to load.. */
		if ( $rss_import_id == 'all' )
		{
			$where = 'rss_import_enabled=1'; // Update only enabled ones!
		}
		elseif( $id_is_array == 1 )
		{
			$where = 'rss_import_id IN (' . implode(',', $rss_import_ids) . ')';
		}
		else
		{
			$where = 'rss_import_id=' . $rss_import_id;
		}
		
		/* Query the RSS imports */
		$this->DB->build( array( 'select' => '*', 'from' => 'rss_import', 'where' => $where ) );
		$outer = $this->DB->execute();
		
		/* Loop through and build cache */
		while( $row = $this->DB->fetch( $outer ) )
		{
			/* Skip non-existent forums - bad stuff happens */
			if ( empty($this->registry->class_forums->forum_by_id[ $row['rss_import_forum_id'] ]) )
			{
				continue;
			}
			
			/* Allowing badwords? */
			IPSText::getTextClass('bbcode')->bypass_badwords = $row['rss_import_allow_html'];
			
			/* Set this import's doctype */
			$this->class_rss->doc_type 		= strtoupper(IPS_DOC_CHAR_SET);
			
			/* Set this import's authentication */
			$this->class_rss->auth_req 	= $row['rss_import_auth'];
			$this->class_rss->auth_user = $row['rss_import_auth_user'];
			$this->class_rss->auth_pass = $row['rss_import_auth_pass'];

			/* Clear RSS object's error cache first */
			$this->class_rss->errors 	= array();
			$this->class_rss->rss_items = array();
			
			/* Reset the rss count as this is a new feed */
			$this->class_rss->rss_count 	= 0;
			$this->class_rss->rss_max_show 	= $row['rss_import_pergo'];
			
			/* Parse RSS */
			$this->class_rss->parseFeedFromUrl( $row['rss_import_url'] );
			
			/* Check for errors */
			if ( is_array( $this->class_rss->errors ) and count( $this->class_rss->errors ) )
			{
				$rss_error = array_merge( $rss_error,  $this->class_rss->errors );
				continue;
			}
			
			if ( ! is_array( $this->class_rss->rss_channels ) or ! count( $this->class_rss->rss_channels ) )
			{
				$rss_error[] = sprintf( $this->lang->words['im_noopen'], $row['rss_import_url'] );
				continue;
			}
			
			/* Update last check time */
			$this->DB->update( 'rss_import', array( 'rss_import_last_import' => IPS_UNIX_TIME_NOW ), 'rss_import_id='.$row['rss_import_id'] );
			
			/* Apparently so: Parse feeds and check for already imported GUIDs */
			$final_items = array();
			$items       = array();
			$check_guids = array();
			$final_guids = array();
			$count       = 0;
			
			if ( ! is_array( $this->class_rss->rss_items ) or ! count( $this->class_rss->rss_items ) )
			{
				$rss_error[] = $row['rss_import_url'] . $this->lang->words['im_noimport'];
				continue;
			}
				
			/* Loop through the channels */
			foreach ( $this->class_rss->rss_channels as $channel_id => $channel_data )
			{
				if ( is_array( $this->class_rss->rss_items[ $channel_id ] ) and count ($this->class_rss->rss_items[ $channel_id ] ) )
				{			
					/* Loop through the items in this channel */
					foreach( $this->class_rss->rss_items[ $channel_id ] as $item_data )
					{
						/* Item Data */
						$item_data['content']  = $item_data['content']   ? $item_data['content']  : $item_data['description'];
						$item_data['guid']     = md5( $row['rss_import_id'] . ( $item_data['guid'] ? $item_data['guid']     : preg_replace( '#\s|\r|\n#is', "", $item_data['title'].$item_data['link'].$item_data['description'] ) ) );
						$item_data['unixdate'] = intval($item_data['unixdate'])  ? intval($item_data['unixdate']) : IPS_UNIX_TIME_NOW;

						/*  If feed charset doesn't match original, we converted to utf-8 and need to convert back now */
						if ( $this->class_rss->doc_type != $this->class_rss->orig_doc_type )
						{
							$item_data['title']   = IPSText::convertCharsets( $item_data['title']  , "UTF-8", IPS_DOC_CHAR_SET );
							$item_data['content'] = IPSText::convertCharsets( $item_data['content'], "UTF-8", IPS_DOC_CHAR_SET );
						}
						
						/* Error check */
						if ( ! $item_data['title'] OR ! $item_data['content'] )
						{
						 	$rss_error[] = sprintf( $this->lang->words['im_notitle'], $item_data['title'] );
							continue;
						}
						
						/* Dates */
						if ( $item_data['unixdate'] < 1 )
						{
							$item_data['unixdate'] = IPS_UNIX_TIME_NOW;
						}
						else if ( $item_data['unixdate'] > IPS_UNIX_TIME_NOW )
						{
							$item_data['unixdate'] = IPS_UNIX_TIME_NOW;
						}
						
						/* Add to array */
						$items[ $item_data['guid'] ] = $item_data;
						$check_guids[]               = $item_data['guid'];
					}
				}
			}
			
			/* Check GUIDs */
			if ( ! count( $check_guids ) )
			{
				$rss_error[] = $this->lang->words['im_noitems'];
				continue;
			}
			
			$this->DB->build( array( 'select' => '*', 'from' => 'rss_imported', 'where' => "rss_imported_guid IN ('".implode( "','", $check_guids )."')" ) );
			$this->DB->execute();
			
			while ( $guid = $this->DB->fetch() )
			{
				$final_guids[ $guid['rss_imported_guid'] ] = $guid['rss_imported_guid'];
			}
			
			/* Compare GUIDs */
			$item_count = 0;
			
			foreach( $items as $guid => $data )
			{
				if ( in_array( $guid, $final_guids ) )
				{
					continue;
				}
				else
				{
					$item_count++;
					
					/* Make sure each item has a unique date */
					$final_items[ $data['unixdate'].$item_count ] = $data;
				}
			}

			/* Sort Array */
			krsort( $final_items );
			
			/* Pick off last X */
			$count           = 1;
			$tmp_final_items = $final_items;
			$final_items     = array();
			
			foreach( $tmp_final_items as $date => $data )
			{
				$final_items[ $date ] = $data;
				
				if ( $count >= $row['rss_import_pergo'] )
				{
					break;
				}
					
				$count++;
			}

			/* Anything left? */
			if ( ! count( $final_items ) )
			{
				continue;
			}
			
			/* Figure out MID */
			$member = $this->DB->buildAndFetch( array( 'select' => 'member_id, name, members_display_name, ip_address', 'from' => 'members', 'where' => "member_id={$row['rss_import_mid']}" ) );
			
			if ( ! $member['member_id'] )
			{
				continue;
			}
			
			/* Set member in post class */
			$this->post->setAuthor( $member['member_id'] );
			$this->post->setForumData( $this->registry->getClass('class_forums')->forum_by_id[ $row['rss_import_forum_id'] ] );
			$this->post->setBypassPermissionCheck( true );
			$this->post->setForumID( $row['rss_import_forum_id'] );
			
			/* Make 'dem posts */
			$affected_forum_ids[] = $row['rss_import_forum_id'];
			
			/* Get editor */
			$classToLoad	= IPSLib::loadLibrary( IPS_ROOT_PATH . 'sources/classes/editor/composite.php', 'classes_editor_composite' );
			$editor			= new $classToLoad();
			
			/* Force RTE */
			$editor->setForceRte( true );
			$editor->setRteEnabled( true );
			$editor->setLegacyMode( false );
				
			foreach( $final_items as $topic_item )
			{
				/* Fix &amp; */
				$topic_item['title'] = str_replace( '&amp;', '&', $topic_item['title'] );
				$topic_item['title'] = str_replace( array( "\r", "\n" ), ' ', $topic_item['title'] );
				$topic_item['title'] = str_replace( array( "<br />", "<br>" ), ' ', $topic_item['title'] );
				$topic_item['title'] = trim( $topic_item['title'] );
				$topic_item['title'] = strip_tags( $topic_item['title'] );
				$topic_item['title'] = IPSText::parseCleanValue( $topic_item['title'] );
			
				/* Fix up &amp;reg; */
				$topic_item['title'] = str_replace( '&amp;reg;', '&reg;', $topic_item['title'] );
				
				// if ( $row['rss_import_topic_pre'] )
				// {
				// 	$topic_item['title'] = str_replace( '&nbsp;', ' ', str_replace( '&amp;nbsp;', '&nbsp;', $row['rss_import_topic_pre'] ) ) .' '. $topic_item['title'];
				// }
				
				$this->post->setTopicTitle( IPSText::mbsubstr( $topic_item['title'], 0, $this->settings['topic_title_max_len'] ) );
				$this->post->setDate( $topic_item['unixdate'] );
				$this->post->setPublished( ( $row['rss_import_topic_hide'] ) ? false : true );
				$this->post->setPublishedRedirectSkip( true );
				
				/* Clean up.. */
				$topic_item['content'] = preg_replace( "#<br />(\r)?\n#is", "<br />", $topic_item['content'] );
				
				if ( ! $row['rss_import_allow_html'] )
				{
					$topic_item['content'] = stripslashes($topic_item['content']);
					
					$post_content = $editor->process( $topic_item['content'] );
				}
				else
				{
					$post_content = stripslashes($topic_item['content']);
				}
				
				/* Add in Show link... */
				if ( $row['rss_import_showlink'] AND $topic_item['link'] )
				{
					$the_link = str_replace( '{url}', trim($topic_item['link']), $row['rss_import_showlink'] );
					$the_link = "<br /><br />" . stripslashes($the_link);
					
					$post_content .= $the_link;
				}
				
				/* Make sure HTML mode is enabled correctly */
				$this->request['post_htmlstatus'] = 1;
				
				/* Prevent invalid img extensions from breaking */
				$_hack = $this->settings['img_ext'];
				$_zack = $this->settings['max_quotes_per_post'];
				$this->settings['img_ext']             = null;
				$this->settings['max_quotes_per_post'] = 500;
				
				$tmpForum  = $this->post->getForumData();
				$tmpAuthor = $this->post->getAuthor();
				
				$this->post->setForumData( array_merge( $tmpForum, array( 'use_html' => 1 ) ) );
				$this->post->setAuthor( array_merge( $tmpAuthor, array( 'g_dohtml' => 1 ) ) );
				
				$this->post->setPostContentPreFormatted( $post_content );
				
/** Advanced Tags & Prefixes Start **/
				/* Add prefix [if any] */
				if( !empty( $row['rss_import_topic_pre'] ) )
				{
					$_REQUEST['ipsTags_prefix']	= 1;
					$_REQUEST['prefix']			= $row['rss_import_topic_pre'];
					$_POST['ipsTags'] 			= $row['rss_import_topic_pre'];
					
					// Hack to trick the permissions test... yeah, we've got permission. What could possibly go wrong?
					if( !defined( 'IN_CONVERTER' ) ) {
						define( 'IN_CONVERTER', 1 );
					}
				}
				else
				{
					$_REQUEST['ipsTags_prefix'] = 0;
					$_REQUEST['prefix']			= '';
					$_POST['ipsTags']			= '';
				}
/** Advanced Tags & Prefixes End **/

				/* Insert */
				try
				{
					$this->post->addTopic();
				}
				catch ( Exception $e )
				{
				}
								
				/* Reset */
				$this->settings['img_ext']             = $_hack;
				$this->settings['max_quotes_per_post'] = $_zack;
				$this->request['post_htmlstatus']      = 0;
				$this->post->setForumData( $tmpForum );
				$this->post->setAuthor( $tmpAuthor );
				
				if ( !$row['rss_import_topic_open'] )
				{
					if( !$this->modLibrary )
					{
						$classToLoad = IPSLib::loadLibrary( IPSLib::getAppDir( 'forums' ) . '/sources/classes/moderate.php', 'moderatorLibrary', 'forums' );
						$this->modLibrary = new $classToLoad( $this->registry );
					}
					
					$this->modLibrary->init( $row['rss_import_forum_id'] );
					
					$this->modLibrary->topicClose( $this->post->getTopicData('tid') );	
				}
												
				/* Insert GUID match */
				$this->DB->insert( 'rss_imported', array( 'rss_imported_impid' => $row['rss_import_id'],
														  'rss_imported_guid'  => $topic_item['guid'],
														  'rss_imported_tid'   => $this->post->getTopicData('tid') ) );
				
				$this->import_count++;
			}
		}
		
		/* Uncomment when testing imports */
		//$this->DB->delete( 'rss_imported', '1=1');
		
		/* Recount Stats */		
		if ( count( $affected_forum_ids ) )
		{
			foreach( $affected_forum_ids as $fid )
			{
				$this->func_mod->forumRecount( $fid );
			}
			
			$this->cache->rebuildCache( 'stats', 'global' );
		}
		
		/* Return */
		if ( $return )
		{
			$this->registry->output->global_message = $this->lang->words['im_recached'];
			
			if ( count( $rss_error ) )
			{
				$this->registry->output->global_message .= "<br />".implode( "<br />", $rss_error );
			}
			
			$this->rssImportOverview();
			return;
		}
		else
		{
			return TRUE;
		}
	}
}
