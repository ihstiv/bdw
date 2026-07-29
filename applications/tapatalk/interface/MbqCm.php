<?php

defined('MBQ_IN_IT') or exit;

/**
 * common method class
 */
Class MbqCm extends MbqBaseCm {
    
    public function __construct() {
        parent::__construct();
    }
    /**
     * transform timestamp to iso8601 format
     */
    public function datetimeIso8601Encode($timeStamp) {
        if($timeStamp instanceof \IPS\DateTime)
        {
            $datetime = $timeStamp->getTimestamp() + $timeStamp->getOffset();
        }
        else
        {
            $timeStamp = \IPS\DateTime::ts($timeStamp);
            $datetime = $timeStamp->getTimestamp() + $timeStamp->getOffset();
        }
        if(MbqMain::isJsonProtocol())
        {		
            return date('Y-m-d\TH:i:s', $datetime).'+00:00';
        }
        else
        {
            return date('Ymd\TH:i:s', $datetime).'+00:00';
        }
    }
}

