<?php

class tapatalk_permissions extends classPublicPermissions
{
    public function check( $perm, $row, $otherMasks=array() )
    {
        if (defined('IN_MOBIQUO'))
        {
            global $mobiquo_config;
            if (($perm == 'read' || $perm == 'view') && isset($row['sub_can_post']) 
                && isset($row['id']) && isset($mobiquo_config['hide_forum_id']) && is_array($mobiquo_config['hide_forum_id'])
                && in_array($row['id'], $mobiquo_config['hide_forum_id']))
            {
                return false;
            }
        }
        
        return parent::check( $perm, $row, $otherMasks );
    }
}

?>