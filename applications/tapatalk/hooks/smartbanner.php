//<?php
/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	exit;
}
class tapatalk_hook_smartbanner extends _HOOK_CLASS_
{
    /* !Hook Data - DO NOT REMOVE */
    public static function hookData() {
        return array_merge_recursive( array (
         'globalTemplate' =>
         array (
           0 =>
           array (
             'selector' => 'html > head',
             'type' => 'add_inside_end',
             'content' => '{template="tapatalk_smartbanner" group="tapatalk" location="front" app="tapatalk"}',
           ),
         ),
       ), parent::hookData() );
    }
    /* End Hook Data */
}
?>