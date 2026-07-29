//<?php

class weddingRatings extends skin_calendar(~id~)
{
    public function showEventSimple($event)
    {
        // if we have a wedding location, put it at the start of the content
        if($event['wedding_location'])
        {
            $event['event_content'] = "Wedding Location: {$event['wedding_location']}<br />" . $event['event_content'];
        }
        
        $output = parent::showEventSimple($event);
        
        if($event['event_calendar_id'] == $this->settings['wedding_calendar'])
        {
            $disableRating = <<<CSS
            <style type='text/css'>
              .rating {display: none;}
            </style>
CSS;

            $output = $disableRating . $output;
        }
        
        return $output;
    }
    
    public function showEvent($event, $member, $typeInfo, $like='')
    {
        // if we have a wedding location, put it at the start of the content
        if($event['wedding_location'])
        {
            $event['event_content'] = "Wedding Location: {$event['wedding_location']}<br />" . $event['event_content'];
        }
        
        $output = parent::showEvent($event, $member, $typeInfo, $like);
        
        if($event['event_calendar_id'] == $this->settings['wedding_calendar'])
        {
            $disableRating = <<<CSS
            <style type='text/css'>
              .rating {display: none;}
            </style>
CSS;

            $output = $disableRating . $output;
        }
        
        return $output;
    }
    
    public function cal_events_wrap($event, $type='month')
    {
        if($type == 'month' && $event['event_calendar_id'] == $this->settings['wedding_calendar'])
        {
            $event['event_title'] = str_ireplace("'s Wedding", '', $event['event_title']);
        }
        
        return parent::cal_events_wrap($event, $type);
    }
    
    public function eventsWrapper($events)
    {
        if($events && ($this->request['cal_id'] == $this->settings['wedding_calendar'] || !$this->request['cal_id']))
        {
            $events = "<li style='font-size:12px;'>Today's Weddings:</li>" . $events;
        }
        
        return parent::eventsWrapper($events);
    }
}