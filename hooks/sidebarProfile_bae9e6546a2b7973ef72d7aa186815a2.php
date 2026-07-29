//<?php

class sidebarProfile extends canonProfileUrl
{
    public function profileModern($tabs=array(), $member=array(), $visitors=array(), $default_tab='status', $default_tab_content='', $friends=array(), $status=array(), $warns=array(), $show_contact='') 
    {
        ipsRegistry::getAppClass('sidebar');
        
        $sidebarContent = $this->registry->class_sidebar->getSidebarContent(array('tabs' => $tabs,
                                                            'member' => $member,
                                                            'visitors' => $visitors,
                                                            'default_tab' => $default_tab,
                                                            'default_tab_content' => $default_tab_content,
                                                            'friends' => $friends,
                                                            'status' => $status,
                                                            'warns' => $warns, 
                                                            'show_contact' => $show_contact));
                                                            
        $output = parent::profileModern($tabs, $member, $visitors, $default_tab, $default_tab_content, $friends, $status, $warns, $show_contact);
        
        return $this->registry->class_sidebar->renderSidebar($output, $sidebarContent);
    }
}