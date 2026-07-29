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


class tapatalk_moderatorLibrary extends sldTopicPrefixes_ModLibrary
{
  //delpost push 
  public function postDelete($id)
  {
    try{
      if(!empty($id) && file_exists( DOC_IPS_ROOT_PATH . $this->settings['tapatalk_directory'] . '/lib/class_push.php' ))
      {
          $classToLoad = IPSLib::loadLibrary( DOC_IPS_ROOT_PATH . $this->settings['tapatalk_directory'] . '/lib/class_push.php', 'tapatalk_push' );
          $notifyLibrary = new $classToLoad( $this->registry );
          $tt_pids = $id;
          if(is_array($tt_pids)) $tt_pids = implode(",", $tt_pids);
          $notifyLibrary->sendDeletePush("delpost", $tt_pids);
      }
    }catch ( Exception $e ) { }
    parent::postDelete($id);
  }

  //deltopic push 
  public function topicDelete( $id, $nostats=0 )
  {
    try{
      if(!empty($id) && file_exists( DOC_IPS_ROOT_PATH . $this->settings['tapatalk_directory'] . '/lib/class_push.php' ))
      {
          $classToLoad = IPSLib::loadLibrary( DOC_IPS_ROOT_PATH . $this->settings['tapatalk_directory'] . '/lib/class_push.php', 'tapatalk_push' );
          $notifyLibrary = new $classToLoad( $this->registry );
          $tt_tids = $id;
          if(is_array($tt_tids)) $tt_tids = implode(",", $tt_tids);
          $notifyLibrary->sendDeletePush("deltopic", $tt_tids);
      }
    }catch ( Exception $e ) { }
    parent::topicDelete( $id, $nostats=0 );
  }
}

?>