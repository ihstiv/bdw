<?php

class galleryPageTitles extends tcResponsiveKillMobileSkin
{
    public function setTitle($title)
    {
        if(IPS_APP_COMPONENT != 'gallery')
        {
            return parent::setTitle($title);
        }
        
        $bits = explode("-", $title);
        
        // clean the array
        foreach($bits as $k => $v)
        {
            $bits[$k] = trim($v);
        }
        
        // is the title too long?
        if(strlen($title) > 70)
        {
            // truncate the image and album titles
            $bits[0] = IPSText::truncate($bits[0], 25);
            $bits[1] = IPSText::truncate($bits[1], 25);
        }
        
        $title = implode(" | ", $bits);
        
        // now put the image ID in. We do this after the truncation because otherwise the ID gets cut off
        if(intval($this->request['image']))
        {
            $title .= ' (' . $this->request['image'] . ')';
        }
        
        return parent::setTitle($title);
    }
}