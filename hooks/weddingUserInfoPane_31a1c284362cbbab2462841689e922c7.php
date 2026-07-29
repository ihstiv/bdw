<?php

class weddingUserInfoPane
{
    public function __construct()
    {
        $this->registry = ipsRegistry::instance();
        $this->DB = $this->registry->DB();
    }
    
    public function getOutput()
    {
        return;
    }
    
    public function replaceOutput($output, $key)
    {
        if(!is_array($this->registry->output->getTemplate('global')->functionData['userInfoPane']) || !count($this->registry->output->getTemplate('global')->functionData['userInfoPane']))
        {
            return $output;
        }
        
        // first get all the authors on this page
        $authorIds = array();
        foreach ($this->registry->output->getTemplate('global')->functionData['userInfoPane'] as $k => $v)
        {
            if(intval($v['author']['author_id']) && !in_array($v['author']['author_id'], $authorIds))
            {
                $authorIds[] = $v['author']['author_id'];
            }
        }
        
        if(!is_array($authorIds) || !count($authorIds))
        {
            return $output;
        }
        
        // now load up the wedding fields
        $weddingData = array();
        $weddingData = $this->DB->buildAndFetchAll(array(
            'select' => 'member_id, wedding_date, wedding_location',
            'from' => 'members',
            'where' => 'member_id in (' . implode(',', $authorIds) . ')'
        ), 'member_id');
        
		$tag = '<!--hook.' . $key . '-->';
        $last = 0;
        $format = (strtoupper(substr(PHP_OS, 0, 3)) == 'WIN') ? '%B %#d, %Y' : '%B %e, %Y';

		foreach ($this->registry->output->getTemplate('global')->functionData['userInfoPane'] as $k => $v)
        {
            $pos = strpos($output, $tag, $last);
            if($pos !== false && intval($v['author']['author_id']) || intval($v['author']['member_id']))
            {
                $data = $weddingData[$v['author']['author_id']];
                
                $html = '';
                if(is_array($data) && count($data))
                {
                    $html .= "<ul class='custom_fields'>";
                    if($data['wedding_date'])
                    {
                        $html .= "<li><span class='ft'>Wedding Date:</span><span class='fc'>" . strftime($format, $data['wedding_date']) . "</span></li>";
                    }
                    if($data['wedding_location'])
                    {
                        $html .= "<li><span class='ft'>Wedding Location:</span><span class='fc'>{$data['wedding_location']}</span></li>";
                    }
                    $html .= "</ul>";
                }
                
                $output = substr_replace($output, $html . $tag, $pos, strlen($tag));
                $last = $pos + strlen($tag . $html);
            }
        }
        
        return $output;
    }
}