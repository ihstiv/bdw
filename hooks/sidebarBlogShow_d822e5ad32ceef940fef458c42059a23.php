//<?php

class sidebarBlogShow extends canonBlogUrl
{
    public function blogView($blog, $links, $entries=array(), $dates=array(), $cblocks=array(), $followData="")
    {
        ipsRegistry::getAppClass('sidebar');
        
        $sidebarContent = $this->registry->class_sidebar->getSidebarContent(array('blog' => $blog,
                                                            'links' => $links,
                                                            'entries' => $entries,
                                                            'dates' => $dates,
                                                            'cblocks' => $cblocks,
                                                            'followData' => $followData));
                                                            
        if($cblocks['right'])
        {
            // cut off the last div tag
            $cblocks['right'] = substr($cblocks['right'], 0, strlen($cblocks['right']) - strlen('</div>'));
            $cblocks['right'] .= "<br class='clear'/>";
            $cblocks['right'] .= $sidebarContent;
            $cblocks['right'] .= '</div>';
        }
        else
        {
            $cblocks['right'] = "<div id='cblock_right' class='cblock'>" . $sidebarContent . "</div>";
        }
        
        return parent::blogView($blog, $links, $entries, $dates, $cblocks, $followData);
    }
    
    public function blogEntryView($blog, $comments_html, $header, $entry, $poll_html, $trackbacks_html, $links, $cblocks, $follow, $tags=array())
    {
        ipsRegistry::getAppClass('sidebar');
        
        $sidebarContent = $this->registry->class_sidebar->getSidebarContent(array('blog' => $blog,
                                                            'comments_html' => $comments_html,
                                                            'header' => $header,
                                                            'entry' => $entry,
                                                            'poll_html' => $poll_html,
                                                            'trackbacks_html' => $trackbacks_html,
                                                            'links' => $links,
                                                            'cblocks' => $cblocks,
                                                            'follow' => $follow,
                                                            'tags' => $tags));
                                                            
        if($cblocks['right'])
        {
            // cut off the last div tag
            $cblocks['right'] = substr($cblocks['right'], 0, strlen($cblocks['right']) - strlen('</div>'));
            $cblocks['right'] .= "<br class='clear'/>";
            $cblocks['right'] .= $sidebarContent;
            $cblocks['right'] .= '</div>';
        }
        else
        {
            $cblocks['right'] = "<div id='cblock_right' class='cblock'>" . $sidebarContent . "</div>";
        }
        
        return parent::blogEntryView($blog, $comments_html, $header, $entry, $poll_html, $trackbacks_html, $links, $cblocks, $follow, $tags);
    }    
}