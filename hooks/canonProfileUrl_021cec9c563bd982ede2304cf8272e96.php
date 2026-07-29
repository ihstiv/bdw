//<?php

class canonProfileUrl extends skin_profile(~id~)
{
    public function profileModern($tabs=array(), $member=array(), $visitors=array(), $default_tab='status', $default_tab_content='', $friends=array(), $status=array(), $warns=array(), $show_contact='')
    {
        $this->registry->output->addCanonicalTag("showuser={$member['member_id']}", $member['members_seo_name'], 'showuser');
        
        return parent::profileModern($tabs, $member, $visitors, $default_tab, $default_tab_content, $friends, $status, $warns, $show_contact);
    }
}