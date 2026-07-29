//<?php

class sidebarGalleryIndex extends (~extends~)
{
    public function home($feature, $sidebars, $albums, $pages='', $stats)
    {
        ipsRegistry::getAppClass('sidebar');
        
        $sidebarContent = $this->registry->class_sidebar->getSidebarContent(array('feature' => $feature, 
                                                            'sidebars' => $sidebars,
                                                            'albums' => $albums,
                                                            'pages' => $pages,
                                                            'stats' => $stats));
        
        $output = parent::home($feature, array(), $albums, $pages, $stats);
            
        return $this->registry->class_sidebar->renderSidebar($output, $sidebarContent);
    }
}