<?php
define('MBQ_PROTOCOL','web');
global $tapatalk_cmd;
$tapatalk_cmd = 'update';
define('IN_MOBIQUO', true);
define('TT_ROOT', getcwd() . DIRECTORY_SEPARATOR);

require_once('mobiquoCommon.php');

MbqMain::init(); // frame init
MbqMain::input(); // handle input data
require_once(MBQ_PATH.'IncludeBeforeMbqAppEnv.php');
MbqMain::initAppEnv(); // application environment init
MbqMain::$oMbqConfig->calCfg();
@ ob_start();
require_once(MBQ_PATH . '/logger.php');
require_once(MBQ_FRAME_PATH . '/MbqBaseStatus.php');
class MbqStatus extends MbqBaseStatus
{

    public function GetLoggedUserName()
    {
        if(MbqMain::$oCurMbqEtUser != null)
        {
            return MbqMain::$oCurMbqEtUser->loginName->oriValue;
        }
        return 'anonymous';
    }
    protected function GetMobiquoFileSytemDir()
    {
        return TT_ROOT;
    }
    protected function GetMobiquoDir()
    {
        return \IPS\Settings::i()->tapatalk_plugindir;
    }
    protected function GetApiKey()
    {
        return \IPS\Settings::i()->tapatalk_apikey;
    }
    protected function GetForumUrl()
    {
        return \IPS\Settings::i()->base_url;
    }
    protected function GetPushSlug()
    {
        return \IPS\Settings::i()->tapatalk_push_slug;
    }

    protected function ResetPushSlug()
    {
        $form = new \IPS\Helpers\Form();
        $form->saveAsSettings(array('tapatalk_push_slug'=> ''));
        //unset( \IPS\Data\Store::i()->settings );
    }

    protected function GetBYOInfo()
    {
        $app_banner_enable =  \IPS\Settings::i()->tapatalk_mobilesmartbanner;
        $google_indexing_enabled = \IPS\Settings::i()->tapatalk_mobilegoogle;
        $facebook_indexing_enabled = 0;//\IPS\Settings::i()->tapatalk_mobilefacebook;
        $twitter_indexing_enabled = 0;//\IPS\Settings::i()->tapatalk_mobiletwitter;

        $TT_bannerControlData = isset(\IPS\Settings::i()->tapatalk_banner_data) ? unserialize(\IPS\Settings::i()->tapatalk_banner_data) : false;
        $TT_expireTime = isset(\IPS\Settings::i()->tapatalk_banner_expire) ? \IPS\Settings::i()->tapatalk_banner_expire : 0;

        if (file_exists(MBQ_3RD_LIB_PATH .'/classTTConnection.php')){
             include_once(MBQ_3RD_LIB_PATH .'/classTTConnection.php');
        }
        $TT_connection = new classTTConnection();
        $TT_connection->calcSwitchOptions($TT_bannerControlData, $app_banner_enable, $google_indexing_enabled, $facebook_indexing_enabled, $twitter_indexing_enabled);
        $TT_bannerControlData['update'] = $TT_expireTime;
        $TT_bannerControlData['banner_enable'] = $app_banner_enable;
        $TT_bannerControlData['google_enable'] = $google_indexing_enabled;
        $TT_bannerControlData['facebook_enable'] = $facebook_indexing_enabled;
        $TT_bannerControlData['twitter_enable'] = $twitter_indexing_enabled;
        return $TT_bannerControlData;
    }

   
    protected function GetOtherPlugins()
    {
        $addOns = \IPS\Plugin::plugins();
        $result = array();
        foreach ($addOns as $addOn) {
            $result[] = array('name'=>$addOn->__get('name'), 'version'=>$addOn->__get('version_human'));
        }
        return $result;
    }

}
$mbqStatus = new MbqStatus();

die();