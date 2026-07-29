<?php

defined('MBQ_IN_IT') or exit;

/**
 * application environment class
 */
Class MbqAppEnv extends MbqBaseAppEnv {
    
    /* this class fully relys on the application,so you can define the properties what you need come from the application. */
    
    public function __construct() {
        parent::__construct();
    }
    public static $membersOnline = array();
    /**
     * application environment init
     */
    public function init() {
        $member = \IPS\Member::loggedIn();
        if($member != null && $member->member_id)
        {
            MbqMain::$oMbqAppEnv->currentUserInfo = $member;
            $oMbqRdEtUser = MbqMain::$oClk->newObj('MbqRdEtUser');
            $oMbqRdEtUser->initOCurMbqEtUser($member->member_id);
        }
    }
    
}

