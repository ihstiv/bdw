<?php

class weddingUCPSave extends usercpForms_core
{
    public function saveProfileInfo()
    {
        // make sure we filled in enough fields
        $count = 0;
        foreach(array('wdate_day', 'wdate_month', 'wdate_year') as $v)
        {
            if(intval($this->request[$v]))
            {
                $count++;
            }
        }
        
        if($count == 1)
        {
            $this->registry->output->showError('Invalid Wedding Date');
        }
        else if(intval($count))
        {
            // validate the date
            $year = (intval($this->request['wdate_year'])) ? $this->request['wdate_year'] : 2000;
            if(!checkdate($this->request['wdate_month'], $this->request['wdate_day'], $this->request['wdate_year']))
            {
                $this->registry->output->showError('Invalid Wedding Date');
            } 
        }
        
        // save the date!
        $weddingDate = (intval($count)) ? mktime(12, 0, 0, intval($this->request['wdate_month']), intval($this->request['wdate_day']), intval($this->request['wdate_year'])) : 0;
        
        if(!intval($weddingDate) && intval($this->memberData['wedding_event_id']))
        {
            $this->_deleteWedding();
        }
        else if(intval($weddingDate))
        {
            if($this->memberData['wedding_event_id'])
            {
                $this->_updateWedding($weddingDate);
            }
            else
            {
                $this->_createWedding($weddingDate);
            }
        }
        
        return parent::saveProfileInfo();
    }
    
    protected function _createWedding($weddingDate)
    {
        // initial data
        $core = array('wedding_date' => $weddingDate, 'wedding_location' => $this->DB->addSlashes($this->request['wedding_location']));
        
        // insert an event record into the database
        $data = array(
            'event_calendar_id' => $this->settings['wedding_calendar'],
            'event_member_id' => $this->memberData['member_id'],
            'event_content' => '<!-- DUMMY PLACEHOLDER -->',
            'event_title' => $this->memberData['members_display_name'] . "'s Wedding",
            'event_smilies' => 1,
            'event_perms' => '*',
            'event_approved' => 1,
            'event_saved' => time(),
            'event_lastupdated' => time(),
            'event_start_date' => strftime('%Y-%m-%d 00:00:00', $weddingDate),
            'event_title_seo' => IPSText::makeSeoTitle($this->memberData['members_display_name'] . "'s Wedding"),
            'event_post_key' => md5(uniqid(microtime())),
            'event_all_day' => 1
        );
        
        $this->DB->insert('cal_events', $data);
        
        // link the member to the event
        $core['wedding_event_id'] = $this->DB->getInsertId();
        IPSMember::save($this->memberData['member_id'], array('core' => $core));
        
        $this->cache->rebuildCache('calendar_events', 'calendar');
    }
    
    protected function _updateWedding($weddingDate)
    {
        // update the wedding date
        $data = array(
            'event_lastupdated' => time(),
            'event_start_date' => strftime('%Y-%m-%d 00:00:00', $weddingDate)
        );
        
        $this->DB->update('cal_events', $data, 'event_id=' . $this->memberData['wedding_event_id']);
        
        // update member data
        $core = array('wedding_date' => $weddingDate, 'wedding_location' => $this->DB->addSlashes($this->request['wedding_location']));
        IPSMember::save($this->memberData['member_id'], array('core' => $core));
        
        // rebuild cache
        $this->cache->rebuildCache('calendar_events', 'calendar');
    }
    
    protected function _deleteWedding()
    {
        // clear all event tables for this event
        // most will not be in use, but just in case
        $this->DB->delete('cal_event_comments', 'comment_eid=' . intval($this->memberData['wedding_event_id']));
        $this->DB->delete('cal_event_ratings', 'rating_eid=' . intval($this->memberData['wedding_event_id']));
        $this->DB->delete('cal_event_rsvp', 'rsvp_event_id=' . intval($this->memberData['wedding_event_id']));
        $this->DB->delete('cal_events', 'event_id=' . intval($this->memberData['wedding_event_id']));
        
        $this->cache->rebuildCache('calendar_events', 'calendar');
        
        // clear member fields
        IPSMember::save($this->memberData['member_id'], array('core' => array('wedding_event_id' => 0, 'wedding_date' => 0, 'wedding_location' => $this->DB->addSlashes($this->request['wedding_location']))));
    }
}