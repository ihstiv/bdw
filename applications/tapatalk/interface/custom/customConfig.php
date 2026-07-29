<?php

defined('MBQ_IN_IT') or exit;

function mbqInitGetConfigValues($isTTServerCall = false)
{
/**
 * user custom config,to replace some config of MbqMain::$oMbqConfig->cfg.
 * you can change any config if you need,please refer to MbqConfig.php for more details.
 */

$tapatalkAppEnabled = \IPS\Application::appIsEnabled('tapatalk') || \IPS\Application::appIsEnabled('Tapatalk');
MbqMain::$customConfig['base']['is_open'] = ($tapatalkAppEnabled && \IPS\Settings::i()->site_online) ? MbqBaseFdt::getFdt('MbqFdtConfig.base.is_open.range.yes') :  MbqBaseFdt::getFdt('MbqFdtConfig.base.is_open.range.no');
MbqMain::$customConfig['base']['version'] = 'ip42_1.6.6';
MbqMain::$customConfig['base']['api_level'] = 4;
MbqMain::$customConfig['base']['json_support'] = MbqBaseFdt::getFdt('MbqFdtConfig.base.json_support.range.yes');
MbqMain::$customConfig['base']['inbox_stat'] = MbqBaseFdt::getFdt('MbqFdtConfig.base.inbox_stat.range.support');
$oMbqRdCommon = MbqMain::$oClk->newObj('MbqRdCommon');
$apiKey = $oMbqRdCommon->getApiKey();
if(!empty($apiKey))
{
    MbqMain::$customConfig['base']['api_key'] = md5($oMbqRdCommon->getApiKey());
}
else
{
    MbqMain::$customConfig['base']['api_key'] = "";
}

MbqMain::$customConfig['base']['sys_version'] = \IPS\Application::load('forums')->version;
MbqMain::$customConfig['base']['announcement'] = MbqBaseFdt::getFdt('MbqFdtConfig.base.announcement.range.support');
MbqMain::$customConfig['base']['push'] = 1;
MbqMain::$customConfig['base']['push_type'] = 'conv,sub,quote,newtopic,tag,newsub,like';
MbqMain::$customConfig['base']['ads_disabled_group'] = \IPS\Settings::i()->tapatalk_disableadsforgroup;

if($isTTServerCall)
{
    MbqMain::$customConfig['base']['hook_version'] = MbqMain::$customConfig['base']['version'];
    MbqMain::$customConfig['base']['release_timestamp'] = 1595471257;
    $oMbqRdCommon = MbqMain::$oClk->newObj('MbqRdCommon');
    MbqMain::$customConfig['base']['smartbanner_info'] = json_encode($oMbqRdCommon->getSmartbannerInfo());
    MbqMain::$customConfig['base']['push_slug'] =json_encode($oMbqRdCommon->getPushSlug());
    $topicsCount = \IPS\Db::i()->select( 'COUNT(*)', 'forums_topics')->first();
    $messagesCount = \IPS\Db::i()->select( 'COUNT(*)', 'core_message_topic_user_map')->first();
    $usersCount = \IPS\Db::i()->select( 'COUNT(*)', 'core_members')->first();
    MbqMain::$customConfig['custom']['stats'] = array(
          'topic'    => $topicsCount,
          'messages' => $messagesCount,
          'user'     => $usersCount,
      );
}
MbqMain::$customConfig['base']['set_api_key'] = 1;
MbqMain::$customConfig['base']['set_forum_info'] = 1;
MbqMain::$customConfig['base']['push_content_check'] = 1;
MbqMain::$customConfig['user']['login_with_email'] = MbqBaseFdt::getFdt('MbqFdtConfig.user.login_with_email.range.support');

MbqMain::$customConfig['subscribe']['module_enable'] = MbqBaseFdt::getFdt('MbqFdtConfig.subscribe.module_enable.range.enable');

MbqMain::$customConfig['user']['user_id'] = MbqBaseFdt::getFdt('MbqFdtConfig.user.user_id.range.support');

//MbqMain::$customConfig['user']['guest_okay'] = \IPS\Settings::i()->disable_anonymous == 0 ? MbqBaseFdt::getFdt('MbqFdtConfig.user.guest_okay.range.support') : MbqBaseFdt::getFdt('MbqFdtConfig.user.guest_okay.range.notSupport');
//$guest_pems = \IPS\Db::i()->select( 'g_view_board', 'core_groups', array( 'g_id=2') )->first();
//MbqMain::$customConfig['user']['guest_okay'] = $guest_pems;
MbqMain::$customConfig['user']['guest_okay'] = \IPS\Member::loggedIn()->group['g_view_board'] ? MbqBaseFdt::getFdt('MbqFdtConfig.user.guest_okay.range.support') : MbqBaseFdt::getFdt('MbqFdtConfig.user.guest_okay.range.notSupport');

MbqMain::$customConfig['user']['search_user'] = MbqBaseFdt::getFdt('MbqFdtConfig.user.search_user.range.support');
MbqMain::$customConfig['user']['ignore_user'] = MbqBaseFdt::getFdt('MbqFdtConfig.user.ignore_user.range.support');
MbqMain::$customConfig['user']['emoji_support'] = MbqBaseFdt::getFdt('MbqFdtConfig.user.emoji_support.range.support');
MbqMain::$customConfig['user']['advanced_online_users'] = MbqBaseFdt::getFdt('MbqFdtConfig.user.advanced_online_users.range.support');
MbqMain::$customConfig['user']['guest_whosonline'] =
        (\IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'online' ))) ?
            MbqBaseFdt::getFdt('MbqFdtConfig.user.guest_whosonline.range.support') : MbqBaseFdt::getFdt('MbqFdtConfig.user.guest_whosonline.range.notSupport')  ;
MbqMain::$customConfig['user']['unban'] = MbqBaseFdt::getFdt('MbqFdtConfig.user.unban.range.support');
MbqMain::$customConfig['user']['guest_group_id'] = "2";
MbqMain::$customConfig['user']['get_ignored_users'] = MbqBaseFdt::getFdt('MbqFdtConfig.user.get_ignored_users.range.support');

MbqMain::$customConfig['user']['anonymous'] = MbqBaseFdt::getFdt('MbqFdtConfig.user.anonymous.range.support');
MbqMain::$customConfig['user']['avatar'] = MbqBaseFdt::getFdt('MbqFdtConfig.user.avatar.range.support');
MbqMain::$customConfig['user']['upload_avatar'] = MbqBaseFdt::getFdt('MbqFdtConfig.user.upload_avatar.range.support');
MbqMain::$customConfig['forum']['no_refresh_on_post'] = MbqBaseFdt::getFdt('MbqFdtConfig.forum.no_refresh_on_post.range.support');
MbqMain::$customConfig['forum']['get_latest_topic'] = MbqBaseFdt::getFdt('MbqFdtConfig.forum.get_latest_topic.range.support');
MbqMain::$customConfig['forum']['guest_search'] =
        (\IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'search' ))) ?
            MbqBaseFdt::getFdt('MbqFdtConfig.forum.guest_search.range.support') :  MbqBaseFdt::getFdt('MbqFdtConfig.forum.guest_search.range.notSupport') ; MbqMain::$customConfig['forum']['mark_read'] = MbqBaseFdt::getFdt('MbqFdtConfig.forum.mark_read.range.support');
MbqMain::$customConfig['forum']['mark_topic_read'] = MbqBaseFdt::getFdt('MbqFdtConfig.forum.mark_topic_read.range.support');
MbqMain::$customConfig['forum']['report_post'] = MbqBaseFdt::getFdt('MbqFdtConfig.forum.report_post.range.support');
MbqMain::$customConfig['forum']['goto_post'] = MbqBaseFdt::getFdt('MbqFdtConfig.forum.report_post.range.support');
MbqMain::$customConfig['forum']['goto_unread'] = MbqBaseFdt::getFdt('MbqFdtConfig.forum.goto_unread.range.support');
MbqMain::$customConfig['forum']['can_unread'] = MbqBaseFdt::getFdt('MbqFdtConfig.forum.can_unread.range.support');
MbqMain::$customConfig['forum']['first_unread'] = MbqBaseFdt::getFdt('MbqFdtConfig.forum.first_unread.range.support');
MbqMain::$customConfig['forum']['get_id_by_url'] = MbqBaseFdt::getFdt('MbqFdtConfig.forum.get_id_by_url.range.support');
MbqMain::$customConfig['forum']['get_url_by_id'] = MbqBaseFdt::getFdt('MbqFdtConfig.forum.get_url_by_id.range.support');
MbqMain::$customConfig['forum']['mark_forum'] = MbqBaseFdt::getFdt('MbqFdtConfig.forum.mark_forum.range.support');
MbqMain::$customConfig['forum']['mod_approve'] = MbqBaseFdt::getFdt('MbqFdtConfig.forum.mod_approve.range.support');
MbqMain::$customConfig['forum']['mod_report'] = MbqBaseFdt::getFdt('MbqFdtConfig.forum.mod_report.range.support');
MbqMain::$customConfig['forum']['mod_delete'] = MbqBaseFdt::getFdt('MbqFdtConfig.forum.mod_delete.range.support');
MbqMain::$customConfig['forum']['multi_quote'] = MbqBaseFdt::getFdt('MbqFdtConfig.forum.multi_quote.range.support');
MbqMain::$customConfig['forum']['advanced_move'] = MbqBaseFdt::getFdt('MbqFdtConfig.forum.advanced_move.range.support');
MbqMain::$customConfig['forum']['get_participated_forum'] = MbqBaseFdt::getFdt('MbqFdtConfig.forum.get_participated_forum.range.support');
MbqMain::$customConfig['forum']['advanced_delete'] = MbqBaseFdt::getFdt('MbqFdtConfig.forum.advanced_delete.range.support');
MbqMain::$customConfig['forum']['get_topic_by_ids'] = MbqBaseFdt::getFdt('MbqFdtConfig.forum.get_topic_by_ids.range.support');
MbqMain::$customConfig['forum']['search_started_by'] = MbqBaseFdt::getFdt('MbqFdtConfig.forum.search_started_by.range.support');

//MbqMain::$customConfig['forum']['min_search_length'] = (int)$config['fulltext_native_min_chars'];
MbqMain::$customConfig['forum']['advanced_search'] = MbqBaseFdt::getFdt('MbqFdtConfig.forum.advanced_search.range.support');
MbqMain::$customConfig['forum']['subscribe_forum'] = MbqBaseFdt::getFdt('MbqFdtConfig.forum.subscribe_forum.range.support');
MbqMain::$customConfig['forum']['subscribe_load'] = MbqBaseFdt::getFdt('MbqFdtConfig.forum.subscribe_load.range.support');
MbqMain::$customConfig['forum']['alert'] = MbqBaseFdt::getFdt('MbqFdtConfig.forum.alert.range.support');

MbqMain::$customConfig['pc']['module_enable'] = MbqBaseFdt::getFdt('MbqFdtConfig.pc.module_enable.range.enable');
//$moduleConv = \IPS\Application\Module::get( 'core', 'messaging', 'front');
MbqMain::$customConfig['pc']['conversation'] = MbqBaseFdt::getFdt('MbqFdtConfig.pc.conversation.range.support');


$mobiquo_config['sign_in'] = 1;
$mobiquo_config['inappreg'] = 1;
$mobiquo_config['sso_login'] = 1;
$mobiquo_config['sso_signin'] = 1;
$mobiquo_config['sso_register'] = 1;
$mobiquo_config['native_register'] = 1;
if(\IPS\Settings::i()->allow_reg === 0 || \IPS\Settings::i()->allow_reg == 'disabled' || \IPS\Settings::i()->allow_reg == 'redirect')
{
    $mobiquo_config['inappreg'] = 0;
    $mobiquo_config['sso_signin'] = 0;
    $mobiquo_config['sso_register'] = 0;
    $mobiquo_config['native_register'] = 0;
}
if (!function_exists('curl_init') && !@ini_get('allow_url_fopen'))
{
    $mobiquo_config['inappreg'] = 0;
    $mobiquo_config['sso_login'] = 0;
    $mobiquo_config['sso_signin'] = 0;
    $mobiquo_config['sso_register'] = 0;
}
if (\IPS\Settings::i()->tapatalk_inappreg == 0)
{
    $mobiquo_config['inappreg'] = 0;
    $mobiquo_config['sso_signin'] = 0;
    $mobiquo_config['native_register'] = 0;
    $mobiquo_config['sso_register'] = 0;
}

MbqMain::$customConfig['user']['sign_in'] = $mobiquo_config['sign_in'] == 0 ? MbqBaseFdt::getFdt('MbqFdtConfig.user.sign_in.range.notSupport') : MbqBaseFdt::getFdt('MbqFdtConfig.user.sign_in.range.support');
MbqMain::$customConfig['user']['inappreg'] = $mobiquo_config['inappreg'] == 0 ? MbqBaseFdt::getFdt('MbqFdtConfig.user.inappreg.range.notSupport') : MbqBaseFdt::getFdt('MbqFdtConfig.user.inappreg.range.support');
MbqMain::$customConfig['user']['sso_login'] = $mobiquo_config['sso_login'] == 0 ? MbqBaseFdt::getFdt('MbqFdtConfig.user.sso_login.range.notSupport') : MbqBaseFdt::getFdt('MbqFdtConfig.user.sso_login.range.support');
MbqMain::$customConfig['user']['sso_signin'] = $mobiquo_config['sso_signin'] == 0 ? MbqBaseFdt::getFdt('MbqFdtConfig.user.sso_signin.range.notSupport') : MbqBaseFdt::getFdt('MbqFdtConfig.user.sso_signin.range.support');
MbqMain::$customConfig['user']['sso_register'] = $mobiquo_config['sso_register'] == 0 ? MbqBaseFdt::getFdt('MbqFdtConfig.user.sso_register.range.notSupport') : MbqBaseFdt::getFdt('MbqFdtConfig.user.sso_register.range.support');
MbqMain::$customConfig['user']['native_register'] = $mobiquo_config['native_register'] == 0 ? MbqBaseFdt::getFdt('MbqFdtConfig.user.native_register.range.notSupport') : MbqBaseFdt::getFdt('MbqFdtConfig.user.native_register.range.support');
$mobiquo_config['hide_forum_id'] = mobiquo_hide_forum_array();
}