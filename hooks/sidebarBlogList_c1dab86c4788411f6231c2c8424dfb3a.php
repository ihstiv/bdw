//<?php

class sidebarBlogList extends skin_blog_list(~id~)
{
    public function blogIndexPage($pages, $featured=array(), $blogs=array(), $extra='', $type='dash', $sorting='', $pinned=array())
    {
        ipsRegistry::getAppClass('sidebar');
        
        $sidebarContent = $this->registry->class_sidebar->getSidebarContent(array('pages' => $pages,
                                                            'featured' => $featured,
                                                            'blogs' => $blogs,
                                                            'extra' => $extra,
                                                            'type' => $type,
                                                            'sorting' => $sorting, 
                                                            'pinned' => $pinned));
        
        $output = parent::blogIndexPage($pages, $featured, $blogs, $extra, $type, $sorting, $pinned);
        
        return $this->registry->class_sidebar->renderSidebar($output, $sidebarContent);
    }    
}

//?>