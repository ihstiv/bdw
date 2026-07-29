//<?php

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	exit;
}

class hook656 extends _HOOK_CLASS_
{

/* !Hook Data - DO NOT REMOVE */
public static function hookData() {
 return array_merge_recursive( array (
  'postContainer' => 
  array (
    0 => 
    array (
      'selector' => 'ul.cAuthorPane_info',
      'type' => 'add_inside_end',
      'content' => '{{$wedding = $comment->author()->wedding;}}
{{if $wedding[\'wedding_date\']}}
<li>
  {lang="wedding_date"}: {datetime="\strtotime( $wedding[\'wedding_date\'] )"}
</li>
{{endif}}
{{if $wedding[\'wedding_location\']}}
<li>
  {lang="wedding_location"}: {$wedding[\'wedding_location\']}
</li>
{{endif}}',
    ),
  ),
), parent::hookData() );
}
/* End Hook Data */


}
