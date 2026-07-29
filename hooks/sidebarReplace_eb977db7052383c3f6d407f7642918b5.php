<?php

class sidebarReplace extends galleryPageTitles
{
    public function replaceMacros($text)
    {
        $output = parent::replaceMacros($text);
        
        ipsRegistry::getAppClass('sidebar');
        
        // check if we are inside a Social Groups forum
        // if so, the sidebar will be rendered later on, along with the group navigation block
        $skip = false;
        if(IPSLib::appIsInstalled('groups') && IPS_APP_COMPONENT == 'forums' && intval($this->request['f']))
        {
            ipsRegistry::getAppClass('groups');
            $classToLoad = IPSLib::loadLibrary(IPSLib::getAppDir('groups') . '/addons/official/forums/sources/groupForumLib.php', 'groupForumLib', 'groups');
            $this->registry->setClass('groupForumLib', new $classToLoad($this->registry));
            $forum = $this->registry->groupForumLib->getGroupForum($this->request['f']);
            
            if(is_array($forum) && count($forum))
            {
                $skip = true;
            }
        }
        
        if(!$skip && strpos($output, 'mainpageContent') !== false && ipsRegistry::getClass('class_sidebar')->showSidebar($output))
        {
            $sidebarContent = ipsRegistry::getClass('class_sidebar')->getSidebarContent();
            $sidebarContent = parent::replaceMacros($sidebarContent);
            
            $output = ipsRegistry::getClass('class_sidebar')->renderSidebar($output, $sidebarContent);
        }
        
        if(strpos($output, SIDEBAR_REPLACE) !== false)
        {
            $output = ipsRegistry::getClass('class_sidebar')->runReplacements($output);
        }
        
        if($this->getTitle())
        {
            $output = str_replace('<!--__PAGE_TITLE__-->', $this->getTitle(), $output);
        }
        
        return $output;
    }
}