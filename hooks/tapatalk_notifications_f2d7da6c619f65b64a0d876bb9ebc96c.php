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

class tapatalk_notifications extends notifications
{
  private   $_parser  = null;
  static public $post = array();
  static public $alreadyNotifiedUids = array();
  
  public function sendNotification()
  {
      parent::sendNotification();
      $classToLoad = IPSLib::loadLibrary( DOC_IPS_ROOT_PATH . $this->settings['tapatalk_directory'] . '/lib/class_push.php', 'tapatalk_push' );
      $notifyLibrary = new $classToLoad( $this->registry );
      $notifyLibrary->sendLikeAndPmPush($this->_recipients, $this->_member, $this->_notificationKey, $this->request, $this->_metaData, $this->_notificationUrl);
  }
}



?>