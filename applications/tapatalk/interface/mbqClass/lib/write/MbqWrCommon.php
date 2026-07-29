<?php

defined('MBQ_IN_IT') or exit;

MbqMain::$oClk->includeClass('MbqBaseWrCommon');


Class MbqWrCommon extends MbqBaseWrCommon {

    public function __construct() {
    }
    public function setApiKey($apiKey)
    {
        $form = new \IPS\Helpers\Form();
        $form->saveAsSettings(array('tapatalk_apikey'=> $apiKey));
        \IPS\Settings::i()->tapatalk_apikey	= $apiKey;
        unset( \IPS\Data\Store::i()->settings );
        if ($apiKey == \IPS\Settings::i()->tapatalk_apikey){
            return true;
        }
        return false;
    }
    public function SetSmartbannerInfo($smartbannerInfo)
    {
        $form = new \IPS\Helpers\Form();
        $form->saveAsSettings(array('tapatalk_banner_data'=> serialize($smartbannerInfo), 'tapatalk_banner_expire' => time()));
        \IPS\Settings::i()->tapatalk_banner_data = serialize($smartbannerInfo);
        unset( \IPS\Data\Store::i()->settings );
        if (serialize($smartbannerInfo) == \IPS\Settings::i()->tapatalk_banner_data){
            return true;
        }
        return false;
    }
}
