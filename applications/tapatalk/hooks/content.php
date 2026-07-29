//<?php
  /* To prevent PHP errors (extending class does not exist) revealing path */
  if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
  {
      exit;
  }
  class tapatalk_hook_content extends _HOOK_CLASS_
  {
      public function delete()
      {
          try
          {
              try
              {
                  if( $this instanceof \IPS\forums\Topic || $this instanceof \IPS\forums\Topic\Post )
                  {
                      if(!class_exists('TapatalkPush'))
                      {
                          $tapatalk_dir = "applications/tapatalk/interface";
                          $tapatalk_dir_url = dirname(__FILE__) . '/' .  $tapatalk_dir;
                          include_once($tapatalk_dir_url . '/push/TapatalkPush.php');
                      }
                      $TapatalkPush = new \TapatalkPush();
                      $TapatalkPush->proccessPush($this->_data, array('action'=>'delete'));
                  }
                  return call_user_func_array( 'parent::delete', func_get_args() );
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