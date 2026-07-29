<?php

class forumPostLightbox extends public_forums_forums_topics
{
    public function _getPosts()
    {
        $posts = parent::_getPosts();
        
        if(is_array($posts) && count($posts))
        {
            foreach($posts as $pid => $post)
            {
                // fix the lightboxes
                $posts[$pid]['post'] = preg_replace("/<a data-ipb='nomediaparse'(.+?)><img(.+?)><\/a>/i", '<img$2>', $post['post']);
                
                // fix the annoying character!
                $search = array('Â', 'Ã', '‚');
                $replace = array('', '', '');
                $posts[$pid]['post'] = str_replace($search, $replace, $posts[$pid]['post']);
            }
        }
        
        return $posts;
    }
}