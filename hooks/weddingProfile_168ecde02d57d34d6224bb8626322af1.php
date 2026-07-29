<?php

class weddingProfile
{
    public function __construct()
    {
        $this->registry = ipsRegistry::instance();
    }
    
    public function getOutput()
    {
        $member = $this->registry->output->getTemplate('profile')->functionData['profileModern'][0]['member'];
        
        $html = '';
        
        // wedding date
        if($member['wedding_date'])
        {
            $format = (strtoupper(substr(PHP_OS, 0, 3)) == 'WIN') ? '%B %#d, %Y' : '%B %e, %Y';
            $weddingDate = strftime($format, $member['wedding_date']);
            
            $html .= <<<HTML
            <li class='clear clearfix'>
              <span class='row_title'>Wedding Date</span>
              <span class='row_data'>{$weddingDate}</span>
            </li>
HTML;
        }
        
        if($member['wedding_location'])
        {
            $html .= <<<HTML
            <li class='clear clearfix'>
              <span class='row_title'>Wedding Location</span>
              <span class='row_data'>{$member['wedding_location']}</span>
            </li>
HTML;
        }
        
        return $html;
    }
}