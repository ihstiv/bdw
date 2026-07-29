<?php
class overloadTopicMetaTagsTopics extends forumPostLightbox {
  public function doExecute( ipsRegistry $registry ) {
    //-----------------------------------------
    // INIT
    //-----------------------------------------

    $post_data = array();
    $poll_data = '';
    $function  = '';

    /* Print CSS */
    $this->registry->output->addToDocumentHead( 'raw', "<link rel='stylesheet' type='text/css' title='Main' media='print' href='{$this->settings['css_base_url']}style_css/{$this->registry->output->skin['_csscacheid']}/ipb_print.css' />" );

    /* Followed stuffs */
    require_once( IPS_ROOT_PATH . 'sources/classes/like/composite.php' );/*noLibHook*/
    $this->_like = classes_like::bootstrap( 'forums', 'topics' );

    /* Init */
    if ( ! $this->registry->isClassLoaded('topics') )
    {
      $classToLoad = IPSLib::loadLibrary( IPSLib::getAppDir( 'forums' ) . "/sources/classes/topics.php", 'app_forums_classes_topics', 'forums' );
      $this->registry->setClass( 'topics', new $classToLoad( $this->registry ) );
    }

    try
    {
      /* Load up the data dudes */
      $this->registry->getClass('topics')->autoPopulate( null, false );
    }
    catch( Exception $crowdCheers )
    {
      $msg = str_replace( 'EX_', '', $crowdCheers->getMessage() );

      $this->registry->output->showError( $msg, 10340, null, null, 404 );
    }


    /* Shortcut */
    $this->forumClass = $this->registry->getClass('class_forums');

    /* Setup basics for this method */
    $topicData      = $this->registry->getClass('topics')->getTopicData();

    $forumData      = $this->forumClass->getForumById( $topicData['forum_id'] );

    /* VigLink */
    if ( !$forumData['viglink'] )
    {
      $this->settings['viglink_enabled'] = FALSE;
    }

    /* Rating */
    $this->can_rate = $this->memberData['member_id'] ? intval( $this->memberData['g_topic_rate_setting'] ) : 0;

    /* Set up topic */
    $topicData = $this->topicSetUp( $topicData );

    /* Get Posts */
    $_NOW = IPSDebug::getMemoryDebugFlag();

    if ( $this->registry->getClass('topics')->isArchived( $topicData ) && $this->registry->class_forums->fetchArchiveTopicType( $topicData ) != 'working' )
    {
      /* Load up archive class */
      $classToLoad = IPSLib::loadLibrary( IPS_ROOT_PATH . 'sources/classes/archive/reader.php', 'classes_archive_reader' );
      $this->archiveReader = new $classToLoad();

      $this->archiveReader->setApp('forums');

      $postData = $this->archiveReader->get( array( 'parentData'  => $topicData,
                                                    'goNative'    => true,
                                                    'offset'      => intval( $this->registry->getClass('topics')->pageToSt( $this->request['page'] ) ),
                                                    'limit'       => intval( $this->settings['display_max_posts'] ),
                                                    'sortKey'     => $this->settings['post_order_column'],
                                                    'sortOrder'   => $this->settings['post_order_sort'] ) );
    }
    else
    {
      $postData = $this->_getPosts();
    }

    /* Finish off post Data */
    if ( count( $postData ) )
    {
      foreach( $postData as $pid => $data )
      {
        $postData[ $pid ] = $this->parsePostRow( $data );
      }
    }


    // ---------------------------------
    // Everything above this point is a straight copy from the IPS public_forums_forums_topics
    // It is just necessary to load the proper data.
    // ---------------------------------


    // ---------------------------------
    // Other parts from public_forums_forums_topics we need
    // ---------------------------------
    /* Add Meta Content */
    if ( $this->_firstPostContent )
    {
      /* Strip tags on title to ensure multi-mod added code isn't displayed */
      $this->registry->output->addMetaTag( 'keywords', strip_tags( trim( $topicData['title'] ) . ' ' . str_replace( "\n", " ", str_replace( "\r", "", strip_tags( $this->_firstPostContent ) ) ) ), TRUE );
    }

    $pageData = $this->registry->output->getPaginationProcessedData();
    $pageMeta = ( $pageData['pages'] > 1 ) ? sprintf( $this->lang->words['topic_meta_pages'], $pageData['current_page'], $pageData['pages'] ) .' ' : '';


    // ---------------------------------
    // Modded code only
    // ---------------------------------

    // Set the title with a concatenated topic id
    $this->registry->output->setTitle( strip_tags( $topicData['title'] ) . ' | ' . $this->settings['board_name'] . " ({$topicData['tid']})" );
    $this->registry->output->addMetaTag( 'description', substr(strip_tags( IPSText::stripAttachTag(trim( $pageMeta . sprintf( $this->lang->words['topic_meta_description'], strip_tags( $topicData['title'] ), $forumData['name'], str_replace( "\r", "", $this->_firstPostContent ) ) ))), 0, 500 - (strlen($topicData['tid']) + 10)) . " ({$topicData['tid']})", FALSE );

    return parent::doExecute($registry);
  }
}