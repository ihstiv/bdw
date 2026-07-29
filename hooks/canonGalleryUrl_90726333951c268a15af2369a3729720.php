//<?php

class canonGalleryUrl extends skin_gallery_home(~id~)
{
    public function homeSocial($categories, $featuredImages, $recentImages, $recentAlbums, $recentComments, $tagCloud, $stats)
    {
        $this->registry->output->addCanonicalTag("app=gallery", 'gallery', 'app=gallery');
        
        return parent::homeSocial($categories, $featuredImages, $recentImages, $recentAlbums, $recentComments, $tagCloud, $stats);
    }
    
    public function homeTraditional($categories, $featuredImages, $recentImages, $recentComments, $tagCloud, $stats)
    {
        $this->registry->output->addCanonicalTag("app=gallery", 'gallery', 'app=gallery');
        
        return parent::homeTraditional($categories, $featuredImages, $recentImages, $recentComments, $tagCloud, $stats);
    }
}