//<?php

class sidebarForumIndex extends sldTopicPrefixes_ForumDesc
{
    public function boardIndexTemplate($lastvisit="", $stats=array(), $cat_data=array(), $show_side_blocks=true, $side_blocks=array())
    {
        // run the output
        $output = parent::boardIndexTemplate($lastvisit, $stats, $cat_data, $show_side_blocks, $side_blocks);
        
        // get the sidebar
        ipsRegistry::getAppClass('sidebar');
        
        $sidebarContent = $this->registry->class_sidebar->getSidebarContent(array('lastvisit' => $lastvisit,
                                                                                'stats' => $stats,
                                                                                'cat_data' => $cat_data,
                                                                                'show_side_blocks' => $show_side_blocks,
                                                                                'side_blocks' => $side_blocks));
                                                                                
        return $this->registry->class_sidebar->renderSidebar($output, $sidebarContent);
    }
}