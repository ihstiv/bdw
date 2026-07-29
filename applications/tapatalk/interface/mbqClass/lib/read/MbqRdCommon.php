<?php

defined('MBQ_IN_IT') or exit;

MbqMain::$oClk->includeClass('MbqBaseRdCommon');

Class MbqRdCommon extends MbqBaseRdCommon {

    public function __construct() {
    }

    public function getApiKey()
    {
        return \IPS\Settings::i()->tapatalk_apikey;
    }
    public function getForumUrl()
    {
        return \IPS\Settings::i()->base_url;
    }
    public function getCheckSpam()
    {
        return false;
    }

    public function get_id_by_url($url)
    {
        $fid = $tid = $pid = null;

        $ipsUrl = \IPS\Http\Url::createFromString($url);
        $urlData = $ipsUrl->getFriendlyUrlData();
        switch($urlData['controller'])
        {
            case 'forums';
                {
                    $fid = $urlData['id'];
                    break;
                }
            case 'topic';
                {
                    if(isset($ipsUrl->data['fragment']))
                    {
                        $pid = str_replace('comment-','',$ipsUrl->data['fragment']);
                    }
                    else
                    {
                        $tid = $urlData['id'];
                    }
                    break;
                }
        }
        if (!empty($pid))
        {
            $oMbqRdEtForumPost = MbqMain::$oClk->newObj('MbqRdEtForumPost');
            return $oMbqRdEtForumPost->initOMbqEtForumPost($pid, array('case'=>'byPostId'));
        }
        if (!empty($tid))
        {
            $oMbqRdEtForumTopic = MbqMain::$oClk->newObj('MbqRdEtForumTopic');
            return $oMbqRdEtForumTopic->initOMbqEtForumTopic($tid, array('case'=>'byTopicId'));
        }
        if (!empty($fid))
        {
            $oMbqRdEtForum = MbqMain::$oClk->newObj('MbqRdEtForum');
            return $oMbqRdEtForum->initOMbqEtForum($fid, array('case'=>'byForumId'));
        }
        return null;
    }
    public function getPushSlug()
    {
        return \IPS\Settings::i()->tapatalk_push_slug;
    }
    public function getSmartbannerInfo()
    {
        return isset(\IPS\Settings::i()->tapatalk_banner_data) ? unserialize(\IPS\Settings::i()->tapatalk_banner_data) : null;
    }
}
