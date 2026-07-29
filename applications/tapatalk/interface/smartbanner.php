<?php

$request = \IPS\Request::i();
$board_url = \IPS\Settings::i()->base_url;
$app_forum_name = \IPS\Settings::i()->board_name;
$tapatalk_dir = isset(\IPS\Settings::i()->tapatalk_plugindir) ? \IPS\Settings::i()->tapatalk_plugindir : 'mobiquo';
$api_key = \IPS\Settings::i()->tapatalk_apikey;
$page_type = \IPS\Dispatcher\Front::i()->controller;
require_once 'helper.php';
$TT_AllowSmartbanner = true;
switch($page_type)
{
    case 'index':
        {
            $page_type='home';
            break;
        }
    case 'forums':
        {
            $page_type='forum';
            $TT_forum_id = $request->__get('id');
            break;
        }
    case 'topic':
        {
            try
            {
                $page_type='topic';
                $topic = \IPS\forums\Topic::load( $request->__get('id'));
                $twc_title = $topic->__get('title');
                $firstPost = \IPS\forums\Topic\Post::load( $topic->topic_firstpost );
                if(isset($firstPost))
                {
                    $short_content = TT_process_short_content($firstPost->__get('post'));
                    $twc_description = $short_content;
                    $TT_forum_id = $topic->__get('forum_id');
                }
                $app_sharelink_location = 'topic';
            }
            catch(Exception $ex)
            {}
            break;
        }
    default:
        {
            $page_type='other';
            break;
        }
}

$TT_bannerControlData = isset(\IPS\Settings::i()->tapatalk_banner_data) ? unserialize(\IPS\Settings::i()->tapatalk_banner_data) : false;
$TT_expireTime = isset(\IPS\Settings::i()->tapatalk_banner_expire) ? \IPS\Settings::i()->tapatalk_banner_expire : 0;

$app_banner_version_id = isset($TT_bannerControlData['banner_version']) ? $TT_bannerControlData['banner_version'] : 0 ;
if(isset($TT_bannerControlData['piwik_id'])){
    $app_piwik_id = $TT_bannerControlData['piwik_id'];
}
if(isset($TT_bannerControlData['piwik_id'])){
    $app_piwik_id = $TT_bannerControlData['piwik_id'];
}
if(isset($TT_bannerControlData['forum_id'])){
    $app_sharelink_ttforumid =  $TT_bannerControlData['forum_id'];
}
if(isset($TT_forum_id)){
    $app_sharelink_fid = $TT_forum_id;
}
if(isset($topic)){
    $app_sharelink_tid = $request->__get('id');
}
//if(isset($TT_forum_id)){
//    $app_sharelink_pid = $TT_forum_id;
//}

$google_indexing_enabled = $TT_bannerControlData['google_enable'];
$facebook_indexing_enabled = $TT_bannerControlData['facebook_enable'];
$twitter_indexing_enabled = $TT_bannerControlData['twitter_enable'];

if(\IPS\Request::i()->url()->data){
    $app_sharelink_url = \IPS\Request::i()->url()->data['scheme'] . '://' . \IPS\Request::i()->url()->data['host'] . \IPS\Request::i()->url()->data['path'] ;
}

$app_banner_enable = isset(\IPS\Settings::i()->tapatalk_mobilesmartbanner) ? \IPS\Settings::i()->tapatalk_mobilesmartbanner : 1;
$google_indexing_enabled = isset(\IPS\Settings::i()->tapatalk_mobilegoogle) ? \IPS\Settings::i()->tapatalk_mobilegoogle : 1;
$facebook_indexing_enabled = 0;//\IPS\Settings::i()->tapatalk_mobilefacebook;
$twitter_indexing_enabled = 0;//\IPS\Settings::i()->tapatalk_mobiletwitter;

if(is_array($TT_bannerControlData)== false){
    $TT_bannerControlData = array('banner_enable' => -1);
}
if(isset($TT_bannerControlData['banner_enable']) && $TT_bannerControlData['banner_enable'] != -1) //can connect to tt server and not get empty data
{
    $app_banner_enable = isset($TT_bannerControlData['banner_enable']) ? $TT_bannerControlData['banner_enable'] : 1;
}

if(isset($TT_bannerControlData['google_enable']) && $TT_bannerControlData['google_enable'] != -1) //can connect to tt server and not get empty data
{
    $google_indexing_enabled = isset($TT_bannerControlData['google_enable']) ? $TT_bannerControlData['google_enable'] : 1;
}

if(isset($TT_bannerControlData['byo_info']) && !empty($TT_bannerControlData['byo_info']))
{
    $app_rebranding_id = $TT_bannerControlData['byo_info']['app_rebranding_id'];
    $app_url_scheme = $TT_bannerControlData['byo_info']['app_url_scheme'];

    $app_android_id = $TT_bannerControlData['byo_info']['app_android_id'];

    $app_ios_id = $TT_bannerControlData['byo_info']['app_ios_id'];
}

if(file_exists(\IPS\ROOT_PATH . "/" . $tapatalk_dir . "/helper.php")){
    include_once(\IPS\ROOT_PATH . "/" . $tapatalk_dir . "/helper.php");
    if(isset($TT_forum_id) && function_exists('mobiquo_hide_forum_array'))
    {
        $TT_hiddenForums = mobiquo_hide_forum_array();
        if(is_array($TT_hiddenForums)&& in_array($TT_forum_id,$TT_hiddenForums))
        {
            $TT_AllowSmartbanner = false;
        }
    }
}

$app_location = get_tapatalk_location($request,$page_type);
$distpatcher = \IPS\Dispatcher\Front::i()->dispatcherController;

if($TT_AllowSmartbanner && file_exists(\IPS\ROOT_PATH . "/" . $tapatalk_dir . "/smartbanner/head.inc.php"))
{
    include_once(\IPS\ROOT_PATH . "/" . $tapatalk_dir . "/smartbanner/head.inc.php");
}
