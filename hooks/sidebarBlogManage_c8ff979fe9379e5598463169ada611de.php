//<?php

class sidebarBlogManage extends skin_blog_manage(~id~)
{
    public function manageDashboard($currentBlogs='', $comments='', $error='', $dropdown='')
    {
        ipsRegistry::getAppClass('sidebar');
        
        $sidebarContent = $this->registry->class_sidebar->getSidebarContent(array('currentBlogs' => $currentBlogs,
                                                            'comments' => $comments,
                                                            'error' => $error,
                                                            'dropdown' => $dropdown));
        
        $output = parent::manageDashboard($currentBlogs, $comments, $error, $dropdown);
        
        return $this->registry->class_sidebar->renderSidebar($output, $sidebarContent);
    }
    
    public function settingsForm($blog, $error='')
    {
        ipsRegistry::getAppClass('sidebar');
        
        $sidebarContent = $this->registry->class_sidebar->getSidebarContent(array('blog' => $blog,
                                                            'error' => $error));
        
        $output = parent::settingsForm($blog, $error);
        
        return $this->registry->class_sidebar->renderSidebar($output, $sidebarContent);
    }
    
    public function create2($blog=array(),$errors='')
    {
        ipsRegistry::getAppClass('sidebar');
        
        $sidebarContent = $this->registry->class_sidebar->getSidebarContent(array('blog' => $blog,
                                                            'errors' => $errors));
        
        $output = parent::create2($blog, $errors);
        
        return $this->registry->class_sidebar->renderSidebar($output, $sidebarContent);
    }
    
    public function listBlogs($blogs, $dropdown)
    {
        ipsRegistry::getAppClass('sidebar');
        
        $sidebarContent = $this->registry->class_sidebar->getSidebarContent(array('blogs' => $blogs,
                                                            'dropdown' => $dropdown));
        
        $output = parent::listBlogs($blogs, $dropdown);
        
        return $this->registry->class_sidebar->renderSidebar($output, $sidebarContent);
    }
    
    public function listCategories($blog=array())
    {
        ipsRegistry::getAppClass('sidebar');
        
        $sidebarContent = $this->registry->class_sidebar->getSidebarContent(array('blog' => $blog));
        
        $output = parent::listCategories($blog);
        
        return $this->registry->class_sidebar->renderSidebar($output, $sidebarContent);
    }    
}

//?>