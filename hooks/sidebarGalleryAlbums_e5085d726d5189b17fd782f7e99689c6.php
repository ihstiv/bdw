//<?php

class sidebarGalleryAlbums extends (~extends~)
{
    public function albumView($cover, $images, $album, $follow='', $recentAlbums=array())
    {
        ipsRegistry::getAppClass('sidebar');
        
        $sidebarContent = $this->registry->class_sidebar->getSidebarContent(array('cover' => $cover,
                                                            'images' => $images,
                                                            'album' => $album,
                                                            'follow' => $follow,
                                                            'recentAlbumts' => $recentAlbums));
        
        $output = parent::albumView($cover, $images, $album, $follow, $recentAlbums);
        
        return $this->registry->class_sidebar->renderSidebar($output, $sidebarContent);
    }
}