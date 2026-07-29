<?php

defined('MBQ_IN_IT') or exit;

MbqMain::$oClk->includeClass('MbqBaseWrEtForumTopic');

/**
 * forum topic write class
 */
Class MbqWrEtForumTopic extends MbqBaseWrEtForumTopic {

    public function __construct() {
    }
    /**
     * add forum topic view num
     */
    public function addForumTopicViewNum($oMbqEtForumTopic) {

    }
    /**
     * add forum topic
     */
    public function addMbqEtForumTopic($oMbqEtForumTopic) {

        $container=$oMbqEtForumTopic->oMbqEtForum->mbqBind;
        $subject    = $oMbqEtForumTopic->topicTitle->oriValue;
        $text_body  = $oMbqEtForumTopic->topicContent->oriValue;
        $container = \IPS\forums\Forum::load( $oMbqEtForumTopic->forumId->oriValue );

        //$attach_list = $oMbqEtForumTopic->attachmentIdArray->hasSetOriValue() ? $oMbqEtForumTopic->attachmentIdArray->oriValue : array();
        //$attachment_data = $oMbqEtForumTopic->groupId->hasSetOriValue() ? $oMbqEtForumTopic->groupId->oriValue : array();
        $content = TT_convertBBCodeForSave($text_body, $oMbqEtForumTopic->attachmentIdArray->oriValue);
        $content = '<p>' . $content .'</p>';
        $values = array('topic_content' => $content, 'topic_auto_follow' => \IPS\Member::loggedIn()->auto_follow['content'], 'topic_title'=>$subject);
        if($oMbqEtForumTopic->prefixId->hasSetOriValue())
        {
            $values['topic_tags'] = array('prefix'=>$oMbqEtForumTopic->prefixId->oriValue);
        }
        $topic = \IPS\forums\Topic::createFromForm($values, $container);
        $topicId = $topic->__get('tid');
        $postId = $topic->__get('topic_firstpost');
        if($oMbqEtForumTopic->groupId->hasSetOriValue())
        {
            \IPS\File::claimAttachments($oMbqEtForumTopic->groupId->oriValue, $topicId ,$postId);
        }

        try{
            $topic->markRead();
        }catch(OutOfRangeException $ex){
        }
        if($topic->__get('approved') == 0)
        {
            $oMbqEtForumTopic->state->setOriValue(1);
        }
        $oMbqEtForumTopic->topicId->setOriValue($topicId);
        return $oMbqEtForumTopic;
    }
    /**
     * mark forum topic read
     */
    public function markForumTopicRead($oMbqEtForumTopic) {
        try{
            $oMbqEtForumTopic->mbqBind->markRead();
            return true;
        }
        catch ( \UnderflowException $e )
        {
            return false;
        }
    }

    public function subscribeTopic($oMbqEtForumTopic, $receiveEmail) {
        $topic_id = $oMbqEtForumTopic->topicId->oriValue;
        if (\IPS\Member::loggedIn()->member_id)
		{
            try
		    {
                $current = \IPS\Db::i()->select( '*', 'core_follow', array( 'follow_app=? AND follow_area=? AND follow_rel_id=? AND follow_member_id=?', 'forums', 'topic', $topic_id, \IPS\Member::loggedIn()->member_id ) )->first();
            }
		    catch ( \UnderflowException $e )
		    {
			    $current = FALSE;
		    }

            $save = array(
				'follow_id'			=> md5( 'forums' . ';' . 'topic' . ';' . $topic_id . ';' .  \IPS\Member::loggedIn()->member_id ),
				'follow_app'			=> 'forums',
				'follow_area'			=> 'topic',
				'follow_rel_id'		=> $topic_id,
				'follow_member_id'	=> \IPS\Member::loggedIn()->member_id,
				'follow_is_anon'		=> false,
				'follow_added'		=> time(),
				'follow_notify_do'	=> 0,
				'follow_notify_meta'	=> '',
				'follow_notify_freq'	=> 'immediate',
				'follow_notify_sent'	=> 0,
				'follow_visible'		=> 1
			);
			if ( $current )
			{
				\IPS\Db::i()->update( 'core_follow', $save, array( 'follow_id=?', $current['follow_id'] ) );
			}
			else
			{
				\IPS\Db::i()->insert( 'core_follow', $save );
			}

            return true;
        }
        return 'You are not allowed to do this operation';
    }

    public function unsubscribeTopic($oMbqEtForumTopic)
    {
        $topic_id = $oMbqEtForumTopic->topicId->oriValue;
        if (\IPS\Member::loggedIn()->member_id)
		{
            try
		    {
                $follow = \IPS\Db::i()->select( '*', 'core_follow', array( 'follow_app=? AND follow_area=? AND follow_rel_id=? AND follow_member_id=?', 'forums', 'topic', $topic_id, \IPS\Member::loggedIn()->member_id ) )->first();
            }
		    catch ( \UnderflowException $e )
		    {
			    $follow = FALSE;
		    }
            if($follow)
            {
                \IPS\Db::i()->delete( 'core_follow', array( 'follow_id=? AND follow_member_id=?', $follow['follow_id'], \IPS\Member::loggedIn()->member_id ) );
            }
        }
        return true;
    }
    /**
     * reset forum topic subscription
     */
    public function resetForumTopicSubscription($oMbqEtForumTopic) {

    }

    /**
     * m_stick_topic
     */
    public function mStickTopic($oMbqEtForumTopic, $mode) {
        if($mode == 1)//Stick
        {
            $IPB4OriginalTopicObject = $oMbqEtForumTopic->mbqBind;
            $IPB4OriginalTopicObject->modAction('pin');
        }
        else if($mode == 2)//unstick
        {
            $IPB4OriginalTopicObject = $oMbqEtForumTopic->mbqBind;
            $IPB4OriginalTopicObject->modAction('unpin');
        }
        return true;

    }

    /**
     * m_close_topic
     */
    public function mCloseTopic($oMbqEtForumTopic, $mode) {
        if($mode == 1)//reopen
        {
            $IPB4OriginalTopicObject = $oMbqEtForumTopic->mbqBind;
            $IPB4OriginalTopicObject->modAction('unlock');
        }
        else if($mode == 2)//close
        {
            $IPB4OriginalTopicObject = $oMbqEtForumTopic->mbqBind;
            $IPB4OriginalTopicObject->modAction('lock');
        }
        return true;

    }

    /**
     * m_delete_topic
     */
    public function mDeleteTopic($oMbqEtForumTopic, $mode, $reason) {
        if($mode == 1)//soft_delete
        {
            if(!isset($reason)) $reason = NULL;
            $IPB4OriginalTopicObject = $oMbqEtForumTopic->mbqBind;
            $IPB4OriginalTopicObject->modAction('hide', NULL, $reason);
        }
        else if($mode == 2)//hard_delete
        {
            $IPB4OriginalTopicObject = $oMbqEtForumTopic->mbqBind;
            $IPB4OriginalTopicObject->modAction('delete');
        }
        return true;

    }

    /**
     * m_undelete_topic
     */
    public function mUndeleteTopic($oMbqEtForumTopic) {
        $IPB4OriginalTopicObject = $oMbqEtForumTopic->mbqBind;
        $IPB4OriginalTopicObject->modAction('unhide');
        return true;

    }

    /**
     * m_rename_topic
     */
    public function mRenameTopic($oMbqEtForumTopic, $title) {
        $IPB4OriginalTopicObject = $oMbqEtForumTopic->mbqBind;
        $values = array('topic_title' => $title);
        $IPB4OriginalTopicObject->processForm( $values );
        $IPB4OriginalTopicObject->save();
        return true;

    }

    /**
     * m_move_topic
     */
    public function mMoveTopic($oMbqEtForumTopic, $oMbqEtForum, $redirect) {
        $IPB4OriginalTopicObject = $oMbqEtForumTopic->mbqBind;
        $IPB4OriginalForumObject = $oMbqEtForum->mbqBind;
        $IPB4OriginalTopicObject->move($IPB4OriginalForumObject,$redirect);
        return true;

    }

    /**
     * m_merge_topic
     */
    public function mMergeTopic($oMbqEtForumTopicFrom, $oMbqEtForumTopicTo ,$redirect) {
        $IPB4OriginalTopicFromObject = $oMbqEtForumTopicFrom->mbqBind;
        $IPB4OriginalTopicToObject   = $oMbqEtForumTopicTo->mbqBind;
        $IPB4OriginalTopicToObject->mergeIn( array($IPB4OriginalTopicFromObject) );
        return true;

    }

    /**
     * m_approve_topic
     */
    public function mApproveTopic($oMbqEtForumTopic, $mode) {
        $IPB4OriginalTopicObject = $oMbqEtForumTopic->mbqBind;
        if($mode == 1) $IPB4OriginalTopicObject->modAction('approve');
        else if($mode == 2) $IPB4OriginalTopicObject->modAction('hide');

        return true;
    }
}
