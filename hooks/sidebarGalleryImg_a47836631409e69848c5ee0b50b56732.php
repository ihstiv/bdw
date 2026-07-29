//<?php

class sidebarGalleryImg extends (~extends~)
{
    public function show_image($info=array(), $author=array(), $photostrip='', $comments='', $nextPrev=array(), $follow='')
    {
        ipsRegistry::getAppClass('sidebar');
        
        $sidebarContent = $this->registry->class_sidebar->getSidebarContent(array('info' => $info,
                                                            'author' => $author,
                                                            'photostrip' => $photostrip,
                                                            'comments' => $comments,
                                                            'nextPrev' => $nextPrev,
                                                            'follow' => $follow));
        
        $output = parent::show_image($info, $author, $photostrip, $comments, $nextPrev, $follow);
        
        return $this->registry->class_sidebar->renderSidebar($output, $sidebarContent);
    }    
}