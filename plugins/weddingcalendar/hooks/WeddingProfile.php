//<?php

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	exit;
}

class hook657 extends _HOOK_CLASS_
{

/* !Hook Data - DO NOT REMOVE */
public static function hookData() {
 return array_merge_recursive( array (
  'profile' => 
  array (
    0 => 
    array (
      'selector' => 'div[data-controller=\'core.front.profile.main\'].ipsBox > div[data-role=\'profileContent\']',
      'type' => 'add_before',
      'content' => '',
    ),
  ),
), parent::hookData() );
}
/* End Hook Data */

public function profile( $member, $mainContent, $visitors, $sidebarFields, $followers, $addWarningUrl, $solutions )
{
	try
	{
	    $args = \func_get_args();
	
    // add the wedding fields
	    $wedding = $args[0]->wedding;
	    $args[3]['wedding_info'] = array();
	    if( \is_array( $wedding ) )
		{
			if( isset( $wedding['wedding_date'] ) && $wedding['wedding_date'] )
			{
				$args[3]['wedding_info']['wedding_date']['value'] = \IPS\DateTime::ts( \strtotime( $wedding['wedding_date'] ) )->format( 'F d, Y' );
				$args[3]['wedding_info']['wedding_date']['custom'] = null;
			}
			if( isset( $wedding['wedding_location'] ) && $wedding['wedding_location'] )
			{
				$args[3]['wedding_info']['wedding_location']['value'] = $wedding['wedding_location'];
				$args[3]['wedding_info']['wedding_location']['custom'] = null;
			}
	    }
	
	    return \call_user_func_array( 'parent::profile', $args );
	}
	catch ( \Error | \RuntimeException $e )
	{
		if( \defined( '\IPS\DEBUG_HOOKS' ) AND \IPS\DEBUG_HOOKS )
		{
			\IPS\Log::log( $e, 'hook_exception' );
		}

		if ( method_exists( get_parent_class(), __FUNCTION__ ) )
		{
			return \call_user_func_array( 'parent::' . __FUNCTION__, \func_get_args() );
		}
		else
		{
			throw $e;
		}
	}
}

}
