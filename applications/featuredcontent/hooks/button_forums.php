//<?php

class featuredcontent_hook_button_forums extends _HOOK_CLASS_
{

/* !Hook Data - DO NOT REMOVE */
public static $hookData = array (
  'topic' => 
  array (
    0 => 
    array (
      'selector' => '.ipsToolList.ipsToolList_horizontal',
      'type' => 'add_inside_end',
      'content' => '{template="button" app="featuredcontent" group="manage" location="front" params="$from=\'forums\',$topic->tid"}',
    ),
  ),
);
/* End Hook Data */








}