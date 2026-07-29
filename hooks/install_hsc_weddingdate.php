<?php

/*
+--------------------------------------------------------------------------
|   Wedding Date
|   =============================================
|   by Esther Eisner
|   11/6/2014 12:41:52 PM
|   Copyright 2014 HeadStand Consulting
|   esther@headstandconsulting.com
+--------------------------------------------------------------------------
*/

if ( ! defined( 'IN_IPB' ) )
{
	print "<h1>Incorrect access</h1>You cannot access this file directly. If you have recently upgraded, make sure you upgraded all the relevant files.";
	exit();
}

class hsc_weddingdate
{
    protected $DB;
    
    public function __construct(ipsRegistry $registry)
    {
        $this->DB = $registry->DB();
    }
    
    public function pre_install()
    {
        if(!$this->DB->checkForField('wedding_event_id', 'members'))
        {
            $this->DB->addField('members', 'wedding_event_id', 'int(10)', 0);
        }
        if(!$this->DB->checkForField('wedding_date', 'members'))
        {
            $this->DB->addField('members', 'wedding_date', 'int(10)', 0);
        }
        if(!$this->DB->checkForField('wedding_location', 'members'))
        {
            $this->DB->addField('members', 'wedding_location', 'varchar(255)');
        }
    }
    
    public function uninstall()
    {
        if($this->DB->checkForField('wedding_event_id', 'members'))
        {
            $this->DB->dropField('members', 'wedding_event_id');
        }
        if($this->DB->checkForField('wedding_date', 'members'))
        {
            $this->DB->dropField('members', 'wedding_date');
        }
        if($this->DB->checkForField('wedding_location', 'members'))
        {
            $this->DB->dropField('members', 'wedding_location');
        }
    }
}