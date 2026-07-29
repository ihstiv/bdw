<?php

class weddingUCPForm
{
    public function __construct()
    {
        $this->registry = ipsRegistry::instance();
        $this->DB = $this->registry->DB();
        $this->memberData =& $this->registry->member()->fetchMemberData();
    }
    
    public function getOutput()
    {
        if(intval($this->memberData['wedding_event_id']))
        {
            $event = $this->DB->buildAndFetch(array('select' => 'event_start_date', 'from' => 'cal_events', 'where' => 'event_id=' . intval($this->memberData['wedding_event_id'])));
            $wYear = substr($event['event_start_date'], 0, 4);
            $wMonth = substr($event['event_start_date'], 5, 2);
            $wDay = substr($event['event_start_date'], 8, 2);
        }
        
        $months = "<option value=''>--</option>";
        for($i=1;$i<=12;$i++)
        {
            $selected = ($this->memberData['wedding_event_id'] && $wMonth == $i) ? 'selected' : '';
            $time = mktime(12, 0, 0, $i, 1, date('Y'));
            $months .= "<option value='{$i}' {$selected}>" . strftime('%B', $time) . "</option>";
        }
        
        $days = "<option value=''>--</option>";
        for($i=1;$i<=31;$i++)
        {
            $selected = ($this->memberData['wedding_event_id'] && $wDay == $i) ? 'selected' : '';
            $days .= "<option value='{$i}' {$selected}>{$i}</option>";
        }
        
        $latest = date('Y') + 5;
        $years = "<option value=''>--</option>";
        for($i=2007;$i<=$latest;$i++)
        {
            $selected = ($this->memberData['wedding_event_id'] && $wYear == $i) ? 'selected' : '';
            $years .= "<option value='{$i}' {$selected}>{$i}</option>";
        }
        
        return <<<HTML
        <br />
        <ul>
          <li>
            <label for='wedding_date' class='ipsSettings_fieldtitle'>Wedding Date</label>
            <select name="wdate_month">&nbsp;{$months}</select>
            <select name="wdate_day">&nbsp;{$days}</select>
            <select name="wdate_year">&nbsp;{$years}</select>
            <br />
          </li>
          <li>
            <label for='wedding_location' class='ipsSettings_fieldtitle'>Wedding Location</label>
            <input type='text' name='wedding_location' value='{$this->memberData['wedding_location']}' class='input_text' size='40'/>
          </li>
        </ul>
HTML;
    }
}