<?php

class tapatalk_like_forums_topics_composite extends like_forums_topics_composite
{
  public function add( $relId, $memberId, array $notifyOpts, $isAnon=0 )
  {
    if ( empty( $relId ) OR empty( $memberId ) )
    {
      trigger_error( "Data missing in " . __CLASS__ . '::' . __FUNCTION__, E_USER_WARNING  );
    }
    
    /* first check to ensure we've not already like'd this item */
    if ( $this->isLiked( $relId, $memberId, true ) )
    {
      /* if any one cares to check, then we're all good */
      return false;
    }
    
    $memberData = IPSMember::load( $memberId );
    
    /* Build */
    $save = array(  
            'like_id'          => classes_like_registry::getKey( $relId, $memberId ),
            'like_lookup_id'   => classes_like_registry::getKey( $relId ),
            'like_lookup_area' => classes_like_registry::getKey( null, $memberId ),
            'like_app'         => $this->_app,
            'like_area'        => $this->_area,
            'like_rel_id'      => $relId,
            'like_member_id'   => $memberId,
            'like_added'       => IPS_UNIX_TIME_NOW,
            'like_is_anon'     => intval($isAnon),
            'like_notify_do'   => $notifyOpts['like_notify_do'],
            'like_notify_meta' => $notifyOpts['like_notify_meta'],
            'like_notify_freq' => ( $notifyOpts['like_notify_do'] ) ? $notifyOpts['like_notify_freq'] : '',
            'like_visible'     => 1,
            'like_notify_sent' => 0 );
    
    /* Do we have permission ? */
    if ( ! $this->notificationCanSend( array_merge( $save, $memberData ) ) )
    {
      return false;
    }
    
    $notifyOpts = $this->_cleanNotifyOptions($notifyOpts);
    
    /* Save to deebee */
    $this->DB->insert( 'core_like', $save );
    
    /* Flag cache as stale */
    $this->likeCache->isNowStale( $relId );
    
    $this->send_tapatalk_newsub_push( array_merge( $save, $memberData ) );
    
    return true;
  }

  public function send_tapatalk_newsub_push( $metaData )
  {
    $push_status = false;
    if((function_exists('curl_init') || ini_get('allow_url_fopen'))
        && file_exists( DOC_IPS_ROOT_PATH . $this->settings['tapatalk_directory'] . '/lib/class_push.php' ))
    {
        $push_status = true;
    }

    $topic = $this->registry->getClass('topics')->getTopicById( $metaData['like_rel_id'] );
    if(!empty($topic))
    {
      $forum = $this->registry->getClass('class_forums')->getForumById( $topic['forum_id'] );
      $post  = $this->DB->buildAndFetch( array( 'select' => '*',
                                      'from'   => 'posts',
                                      'where'  => "topic_id =  ".$metaData['like_rel_id']." AND new_topic = 1" )  );

      if(!empty($post) && $this->DB->checkForTable( 'tapatalk_users' ))
      {
        $touids = array($post['author_id']);
        $post['forum_id'] = $topic['forum_id'];
        $post['title']    = $topic['title'];
        $post['sub_forum_name'] = $forum['name'];
        $classToLoad    = IPSLib::loadLibrary( DOC_IPS_ROOT_PATH . $this->settings['tapatalk_directory'] . '/lib/class_push.php', 'tapatalk_push' );
        $notifyLibrary  = new $classToLoad( $this->registry );

        $notifyLibrary->notifyPost( $post, $touids, 'newsub', $push_status);
      }
    }                               
  }
}

?>