<?php

class inlineAttachments extends plugin_post
{
    public function renderAttachment( $attach_ids, $rel_ids=array(), $attach_post_key=0 )
    {
        $rows = parent::renderAttachment($attach_ids, $rel_ids, $attach_post_key);
        
        // get the post content
        $posts = $this->DB->buildAndFetchAll(array('select' => 'pid, post', 'from' => 'posts', 'where' => 'pid in (' . implode(",", $rel_ids) . ')'), 'pid');
        // sanity check
        if(!is_array($posts) || !count($posts))
        {
            return $rows;
        }
        
        // loop through all posts to figure out which attachments are inline
        // then unset the thumbnail properties so that we can trick the controller into thinking it only has full size available
        foreach($posts as $pid => $post)
        {
            preg_match_all('#\[attachment=(\d+?)\:(?:[^\]]+?)\]#is', $post['post'], $matches);
            if(is_array($matches[0]) && count($matches[0]))
            {
                foreach($matches[1] as $id)
                {
                    unset($rows[$id]['attach_thumb_location']);
                }
            }
        }
        
        return $rows;
    }
}