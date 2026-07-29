<?php

defined('MBQ_IN_IT') or exit;

MbqMain::$oClk->includeClass('MbqBaseAclEtForumPost');

/**
 * forum post acl class
 */
Class MbqAclEtForumPost extends MbqBaseAclEtForumPost {

    public function __construct() {
    }
    /**
     * judge can reply post
     *
     * @param  Object  $oMbqEtForumPost
     * @return  Boolean
     */
    public function canAclReplyPost($oMbqEtForumTopic) {
        return $oMbqEtForumTopic->canReply->oriValue && MbqMain::isActiveMember();
    }

    /**
     * judge can get quote post
     *
     * @param  Object  $oMbqEtForumPost
     * @return  Boolean
     */
    public function canAclGetQuotePost($oMbqEtForumPost) {
        return $oMbqEtForumPost->oMbqEtForumTopic->canReply->oriValue;
    }

    /**
     * judge can search_post
     *
     * @return  Boolean
     */
    public function canAclSearchPost() {
        if (MbqMain::$oMbqConfig->getCfg('forum.guest_search')->oriValue == MbqBaseFdt::getFdt('MbqFdtConfig.forum.guest_search.range.support')) {
            return true;
        } else {
            return MbqMain::hasLogin();
        }
    }

    /**
     * judge can get_raw_post
     *
     * @param  Object  $oMbqEtForumPost
     * @return  Boolean
     */
    public function canAclGetRawPost($oMbqEtForumPost) {
        return $oMbqEtForumPost->canEdit->oriValue;
    }

    /**
     * judge can save_raw_post
     *
     * @param  Object  $oMbqEtForumPost
     * @return  Boolean
     */
    public function canAclSaveRawPost($oMbqEtForumPost) {
        return $oMbqEtForumPost->canEdit->oriValue;
    }

    /**
     * judge can get_user_reply_post
     *
     * @return  Boolean
     */
    public function canAclGetUserReplyPost() {
        return true;
    }

    /**
     * judge can report_post
     *
     * @param  Object  $oMbqEtForumPost
     * @return  Boolean
     */
    public function canAclReportPost($oMbqEtForumPost) {
        return $oMbqEtForumPost->canReport->hasSetOriValue() && $oMbqEtForumPost->canReport->oriValue;
    }

    /**
     * judge can thank_post
     *
     * @param  Object  $oMbqEtForumPost
     * @return  Boolean
     */
    public function canAclThankPost($oMbqEtForumPost) {
        return $oMbqEtForumPost->canThank()->oriValue;
    }

    /**
     * judge can m_delete_post
     *
     * @param  Object  $oMbqEtForumPost
     * @param  Integer  $mode
     * @return  Boolean
     */
    public function canAclMDeletePost($oMbqEtForumPost, $mode) {
        if($mode == 1)
        {
            $IPB4OriginalPostObject = $oMbqEtForumPost->mbqBind;
            return $IPB4OriginalPostObject->canHide();
        }
        else if($mode == 2)
        {
            $IPB4OriginalPostObject = $oMbqEtForumPost->mbqBind;
            return $IPB4OriginalPostObject->canDelete();
        }
    }

    /**
     * judge can m_undelete_post
     *
     * @param  Object  $oMbqEtForumPost
     * @return  Boolean
     */
    public function canAclMUndeletePost($oMbqEtForumPost) {
        $IPB4OriginalPostObject = $oMbqEtForumPost->mbqBind;
        return $IPB4OriginalPostObject->canUnhide();
    }

    /**
     * judge can m_move_post
     *
     * @param  Object  $oMbqEtForumPost
     * @param  Mixed  $oMbqEtForum
     * @param  Mixed  $oMbqEtForumTopic
     * @return  Boolean
     */
    public function canAclMMovePost($oMbqEtForumPosts, $oMbqEtForum, $oMbqEtForumTopic) {
        $flag = true;
        foreach ($oMbqEtForumPosts as $oMbqEtForumPost) {
            $IPB4OriginalPostObject = $oMbqEtForumPost->mbqBind;
            if($IPB4OriginalPostObject->canSplit() == false) $flag = false;
        }
        return $flag;
    }



    /**
     * judge can m_approve_post
     *
     * @param  Object  $oMbqEtForumPost
     * @param  Integer  $mode
     * @return  Boolean
     */
    public function canAclMApprovePost($oMbqEtForumPost, $mode) {
        $IPB4OriginalPostObject = $oMbqEtForumPost->mbqBind;
        if($mode == 1) return $IPB4OriginalPostObject->canUnhide();
        else if($mode == 2) return $IPB4OriginalPostObject->canHide();
        else MbqError::alert('', "Wrong mode value!", '', MBQ_ERR_APP);
    }

    /**
     * judge can m_merge_post
     *
     * @param  Object  $oMbqEtForumPost
     * @return  Boolean
     */
    public function canAclMMergePost($oMbqEtForumPost) {
        $IPB4OriginalPostObject = $oMbqEtForumPost->mbqBind;
        return $IPB4OriginalPostObject->modPermission('split_merge');
        // return $IPB4OriginalPostObject->modPermission('view_hidden');
    }

    /**
     * judge can m_get_moderate_topic
     *
     * @return  Boolean
     */
    public function canAclMGetModeratePost() {
        return \IPS\Member::loggedIn()->modPermission() != null;
    }
    /**
     * judge can m_get_delete_topic
     *
     * @return  Boolean
     */
    public function canAclMGetDeletePost() {
        return \IPS\Member::loggedIn()->modPermission() != null;
    }

    /**
     * judge can m_close_report
     */
    public function canAclMCloseReport($oMbqEtForumPost) {
        return MbqMain::hasLogin() && \IPS\Member::loggedIn()->modPermission();
    }

    /**
     * judge can can like
     *
     * @return  Boolean
     */
    public function canAclLikePost($oMbqEtForumPost) {
        return $oMbqEtForumPost->canLike->oriValue;
    }

    /**
     * judge can can unlike
     *
     * @return  Boolean
     */
    public function canAclUnlikePost($oMbqEtForumPost) {
        return $oMbqEtForumPost->canUnlike->oriValue;
    }
}
