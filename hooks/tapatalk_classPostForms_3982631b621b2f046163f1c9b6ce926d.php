<?php

if(!defined('IN_MOBIQUO'))
{
  if(!defined('IN_PUSH'))
  {
      define('IN_PUSH', true);
  }
  $commonPath = DOC_IPS_ROOT_PATH . ipsRegistry::$settings['tapatalk_directory'] . '/mobiquo_common.php';
  include_once( $commonPath );
}


class tapatalk_classPostForms extends sldTopicPrefixes_PostLibrary
{
  public function sendOutQuoteNotifications( $post, $subscriptionSentTo )
  {
    parent::sendOutQuoteNotifications( $post, $subscriptionSentTo );
    try
    {
      $classToLoad = IPSLib::loadLibrary( DOC_IPS_ROOT_PATH . $this->settings['tapatalk_directory'] . '/lib/class_push.php', 'tapatalk_push' );
      $notifyLibrary = new $classToLoad( $this->registry );
      $notifyLibrary->sendTTPush($post['topic_id'], $post['post'], 'sub', $subscriptionSentTo);
    }
    catch(Exception $exc)
    {    
    }
  }
  
  public function getPostEditReason()
  {
      if ( isset( $this->moderator['edit_post'] ) && $this->moderator['edit_post'] OR $this->getAuthor('g_is_supmod') )
          return isset($this->_originalPost['post_edit_reason']) ? $this->_originalPost['post_edit_reason'] : '';
      else
          return false;
  }

  // newtopic push 
  public function sendOutNewTopicNoticeToAutoSubGroups( $forum, $topic, $content, $skipMemberIds=array() )
  {
    parent::sendOutNewTopicNoticeToAutoSubGroups( $forum, $topic, $content, $skipMemberIds );
    try
    {
      $classToLoad = IPSLib::loadLibrary( DOC_IPS_ROOT_PATH . $this->settings['tapatalk_directory'] . '/lib/class_push.php', 'tapatalk_push' );
      $notifyLibrary = new $classToLoad( $this->registry );
      $notifyLibrary->sendTTPush($topic['tid'], $content, 'newtopic', $skipMemberIds);
    }
    catch(Exception $exc)
    {
    }
  }
}

?>