//<?php
  /* To prevent PHP errors (extending class does not exist) revealing path */
  if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
  {
      exit;
  }
  class tapatalk_hook_comment extends _HOOK_CLASS_
  {
      /**
       * Do stuff after creating (abstracted as comments and reviews need to do different things)
       *
       * @return	void
       */
      public function postCreate()
      {
          try
          {
              if(!class_exists('TapatalkPush'))
              {
                  $tapatalk_dir = 'applications/tapatalk/interface';
                  $tapatalk_dir_url = dirname(__FILE__) . '/' .  $tapatalk_dir;
                  include_once($tapatalk_dir_url . '/push/TapatalkPush.php');
              }
              $TapatalkPush = new \TapatalkPush();
              $TapatalkPush->proccessPush($this);
              return call_user_func_array( 'parent::postCreate', func_get_args() );
          }
          catch ( \RuntimeException $e )
          {
              if ( method_exists( get_parent_class(), __FUNCTION__ ) )
              {
                  return call_user_func_array( 'parent::' . __FUNCTION__, func_get_args() );
              }
              else
              {
                  throw $e;
              }
          }
      }

      /**
       * Give reputation
       *
       * @param	int					$type	1 for positive, -1 for negative
       * @param	\IPS\Member|NULL	$member	The member to check for (NULL for currently logged in member)
       * @return	void
       * @throws	\DomainException|\BadMethodCallException
       */
      public function giveReputation( $type, \IPS\Member $member=NULL )
      {

          try
          {
              if($type == 1)
              {
                  if(!class_exists('TapatalkPush'))
                  {
                      $tapatalk_dir = 'applications/tapatalk/interface';
                      $tapatalk_dir_url = dirname(__FILE__) . '/' .  $tapatalk_dir;
                      include_once($tapatalk_dir_url . '/push/TapatalkPush.php');
                  }
                  $TapatalkPush = new \TapatalkPush();
                  $TapatalkPush->proccessPush($this, array('action'=>'like'));
              }
              return call_user_func_array( 'parent::giveReputation', func_get_args() );
          }
          catch ( \RuntimeException $e )
          {
              if ( method_exists( get_parent_class(), __FUNCTION__ ) )
              {
                  return call_user_func_array( 'parent::' . __FUNCTION__, func_get_args() );
              }
              else
              {
                  throw $e;
              }
          }

      }
      /**
       * Returns the content
       *
       * @return	string
       */
      public function content()
      {

          try
          {
              $content = call_user_func_array( 'parent::content', func_get_args() );
              try
              {
                  if(!defined('IN_MOBIQUO'))
                  {
                      $protocol = 'http';
                      if(\IPS\Request::i()->isSecure()){$protocol = 'https';}
                      $originalcontent = $content;
                      $content = preg_replace('/\[emoji(\d+)\]/i', '<img src="'.$protocol.'://emoji.tapatalk-cdn.com/emoji\1.png" />', $content);
                      if(!\IPS\Settings::i()->remote_image_proxy)
                      {
                          $content = preg_replace('/(?!imageproxy\.php\?img=)https?:\/\/cloud\.tapatalk\.com/i',  $protocol . '://cloud.tapatalk.com', $content);
                          $content = preg_replace('/(?!imageproxy\.php\?img=)https?:\/\/uploads\.tapatalk-cdn\.com/i',  $protocol . '://uploads.tapatalk-cdn.com', $content);
                          $content = preg_replace('/(?!imageproxy\.php\?img=)https?:\/\/images\.tapatalk-cdn\.com/i',  $protocol . '://images.tapatalk-cdn.com', $content);
                      }
                      if(empty($content))
                      {
                          return $originalcontent;
                      }
                  }
              }
              catch ( \RuntimeException $e )
              {

              }
              return $content;
          }
          catch ( \RuntimeException $e )
          {
              if ( method_exists( get_parent_class(), __FUNCTION__ ) )
              {
                  return call_user_func_array( 'parent::' . __FUNCTION__, func_get_args() );
              }
              else
              {
                  throw $e;
              }
          }
      }
  }
?>