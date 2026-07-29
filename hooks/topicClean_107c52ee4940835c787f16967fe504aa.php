//<?php

class topicClean extends skin_topic(~id~)
{
    public function post($post, $displayData, $topic, $forum=array())
    {
        $pattern = "/<span rel='lightbox'><img class='bbc_img'(.+?)src=\"\/img\/forum(.+?)><\/span>/is";
        $post['post']['post'] = preg_replace($pattern, "", $post['post']['post']);
        
        return parent::post($post, $displayData, $topic, $forum);
    }
}