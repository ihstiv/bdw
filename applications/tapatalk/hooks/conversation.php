//<?php
/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	exit;
}
class tapatalk_hook_conversation extends _HOOK_CLASS_
{
     /**
       * Process created object AFTER the object has been created
       *
       * @param	\IPS\Content\Comment|NULL	$comment	The first comment
       * @param	array						$values		Values from form
       * @return	void
       */
	protected function processAfterCreate($comment, $values )
	{
		  try
		  {
				    if(!class_exists('TapatalkPush'))
				    {
				        $tapatalk_dir = "applications/tapatalk/interface";
				        $tapatalk_dir_url = dirname(__FILE__) . '/' .  $tapatalk_dir;
				        include_once($tapatalk_dir_url . '/push/TapatalkPush.php');
				    }
				    $TapatalkPush = new \TapatalkPush();
				    $TapatalkPush->proccessPush($comment, $values);
				    return call_user_func_array( 'parent::processAfterCreate', func_get_args() );
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
	public function authorize( $members )
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
			$TapatalkPush->proccessPush($this, array('action'=>'invite', 'members'=>$members));
			return call_user_func_array( 'parent::' . __FUNCTION__, func_get_args() );
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