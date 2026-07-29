<?php

defined('MBQ_IN_IT') or exit;

MbqMain::$oClk->includeClass('MbqBaseAclEtForumTopic');

/**
 * forum topic acl class
 */
Class MbqAclEtForumTopic extends MbqBaseAclEtForumTopic {

    public function __construct() {
    }

    /**
     * judge can get topic from the forum
     *
     * @param  Object  $oMbqEtForum
     * @return  Boolean
     */
    public function canAclGetTopic($oMbqEtForum) {
      return $oMbqEtForum->mbqBind->can('view');
    }

    /**
     * judge can get thread
     *
     * @param  Object  $oMbqEtForumTopic
     * @return  Boolean
     */
    public function canAclGetThread($oMbqEtForumTopic) {
        return $oMbqEtForumTopic->mbqBind->canView();
    }

    /**
     * judge can new topic
     *
     * @param  Object  $oMbqEtForum
     * @return  Boolean
     */
    public function canAclNewTopic($oMbqEtForum) {
        return $oMbqEtForum->mbqBind->can('add') && MbqMain::isActiveMember();
    }
    /**
     * judge can get topics by ids
     *
     * @return  Boolean
     */
    public function canAclGetTopicByIds() {
        return true;
    }
    /**
     * judge can get subscribed topic
     *
     * @return  Boolean
     */
    public function canAclGetSubscribedTopic() {
        return MbqMain::hasLogin();
    }

    /**
     * judge can mark all my unread topics as read
     *
     * @return  Boolean
     */
    public function canAclMarkTopicRead($oMbqEtForumTopic) {
        return MbqMain::hasLogin();
    }

    /**
     * judge can get_unread_topic
     *
     * @return  Boolean
     */
    public function canAclGetUnreadTopic() {
        return MbqMain::hasLogin();
    }

    /**
     * judge can get_participated_topic
     *
     * @return  Boolean
     */
    public function canAclGetParticipatedTopic() {
        return MbqMain::hasLogin();
    }

    /**
     * judge can get_latest_topic
     *
     * @return  Boolean
     */
    public function canAclGetLatestTopic() {
        return true;
    }

    /**
     * judge can search_topic
     *
     * @return  Boolean
     */
    public function canAclSearchTopic() {
        return true;
    }

    /**
     * judge can subscribe_topic
     *
     * @param  Object  $oMbqEtForumTopic
     * @return  Boolean
     */
    public function canAclSubscribeTopic($oMbqEtForumTopic, $receiveEmail) {
        return $oMbqEtForumTopic->canSubscribe->oriValue;
    }

    /**
     * judge can unsubscribe_topic
     *
     * @param  Object  $oMbqEtForumTopic
     * @return  Boolean
     */
    public function canAclUnsubscribeTopic($oMbqEtForumTopic) {
        return $oMbqEtForumTopic->canSubscribe->oriValue;
    }

    /**
     * judge can get_user_topic
     *
     * @return  Boolean
     */
    public function canAclGetUserTopic() {
        return MbqMain::hasLogin();
    }

    /**
     * judge can m_stick_topic
     *
     * @param  Object  $oMbqEtForumTopic
     * @param  Integer  $mode
     * @return  Boolean
     */
    public function canAclMStickTopic($oMbqEtForumTopic, $mode) {
        if($mode == 1)
        {
            $IPB4OriginalTopicObject = $oMbqEtForumTopic->mbqBind;
            return $IPB4OriginalTopicObject->canPin();
        }
        else if($mode == 2)
        {
            $IPB4OriginalTopicObject = $oMbqEtForumTopic->mbqBind;
            return $IPB4OriginalTopicObject->canUnpin();
        }
    }

    /**
     * judge can m_close_topic
     *
     * @param  Object  $oMbqEtForumTopic
     * @param  Integer  $mode
     * @return  Boolean
     */
    public function canAclMCloseTopic($oMbqEtForumTopic, $mode) {
        if($mode == 1)
        {
            $IPB4OriginalTopicObject = $oMbqEtForumTopic->mbqBind;
            return $IPB4OriginalTopicObject->canUnlock();
        }
        else if($mode == 2)
        {
            $IPB4OriginalTopicObject = $oMbqEtForumTopic->mbqBind;
            return $IPB4OriginalTopicObject->canlock();
        }
    }

    /**
     * judge can m_delete_topic
     *
     * @param  Object  $oMbqEtForumTopic
     * @param  Integer  $mode
     * @return  Boolean
     */
    public function canAclMDeleteTopic($oMbqEtForumTopic, $mode) {
        if($mode == 1)
        {
            $IPB4OriginalTopicObject = $oMbqEtForumTopic->mbqBind;
            return $IPB4OriginalTopicObject->canHide();
        }
        else if($mode == 2)
        {
            $IPB4OriginalTopicObject = $oMbqEtForumTopic->mbqBind;
            return $IPB4OriginalTopicObject->canDelete();
        }
    }

    /**
     * judge can m_undelete_topic
     *
     * @param  Object  $oMbqEtForumTopic
     * @return  Boolean
     */
    public function canAclMUndeleteTopic($oMbqEtForumTopic) {
       $IPB4OriginalTopicObject = $oMbqEtForumTopic->mbqBind;
       return $IPB4OriginalTopicObject->canUnhide();
    }

    /**
     * judge can m_move_topic
     *
     * @param  Object  $oMbqEtForumTopic
     * @param  Object  $oMbqEtForum
     * @return  Boolean
     */
    public function canAclMMoveTopic($oMbqEtForumTopic, $oMbqEtForum) {
        $IPB4OriginalTopicObject = $oMbqEtForumTopic->mbqBind;
        return $IPB4OriginalTopicObject->canMove();
    }

    /**
     * judge can m_rename_topic
     *
     * @param  Object  $oMbqEtForumTopic
     * @return  Boolean
     */
    public function canAclMRenameTopic($oMbqEtForumTopic) {
        $IPB4OriginalTopicObject = $oMbqEtForumTopic->mbqBind;
        $class = get_class($IPB4OriginalTopicObject);
        $forum = $IPB4OriginalTopicObject->container();
        return $IPB4OriginalTopicObject->canedit() && $class::modPermission( 'edit', NULL, $forum );
    }

    /**
     * judge can m_approve_topic
     *
     * @param  Object  $oMbqEtForumTopic
     * @param  Integer  $mode
     * @return  Boolean
     */
    public function canAclMApproveTopic($oMbqEtForumTopic, $mode) {
        $IPB4OriginalTopicObject = $oMbqEtForumTopic->mbqBind;
        if($mode == 1) return $IPB4OriginalTopicObject->canUnhide();
        else if($mode == 2) return $IPB4OriginalTopicObject->canHide();
        else MbqError::alert('', "Wrong mode value!", '', MBQ_ERR_APP);
    }

    /**
     * judge can m_merge_topic
     *
     * @param  Object  $oMbqEtForumTopic
     * @param  Object  $oMbqEtForumTopic
     * @return  Boolean
     */
    public function canAclMMergeTopic($oMbqEtForumTopicFrom, $oMbqEtForumTopicTo) {
        $IPB4OriginalTopicToObject = $oMbqEtForumTopicTo->mbqBind;
        return $IPB4OriginalTopicToObject->canMerge();
    }

    /**
     * judge can m_get_moderate_topic
     *
     * @return  Boolean
     */
    public function canAclMGetModerateTopic() {
        return \IPS\Member::loggedIn()->modPermission() != null;
    }
    /**
     * judge can m_get_delete_topic
     *
     * @return  Boolean
     */
    public function canAclMGetDeleteTopic() {
        return \IPS\Member::loggedIn()->modPermission() != null;
    }
}
