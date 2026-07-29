//<?php

class canonBlogUrl extends skin_blog_show(~id~)
{
    public function blogView($blog, $links, $entries=array(), $dates=array(), $cblocks=array(), $followData="")
    {
        $this->registry->output->addCanonicalTag("app=blog&amp;module=display&amp;section=blog&amp;blogid={$blog['blog_id']}", $blog['blog_seo_name'], 'showblog');
        
        return parent::blogView($blog, $links, $entries, $dates, $cblocks, $followData);
    }
}