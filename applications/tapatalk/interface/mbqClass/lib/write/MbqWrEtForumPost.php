<?php

defined('MBQ_IN_IT') or exit;

MbqMain::$oClk->includeClass('MbqBaseWrEtForumPost');

/**
 * forum post write class
 */
Class MbqWrEtForumPost extends MbqBaseWrEtForumPost {

    public function __construct() {
    }
    /**
     * add forum post
     */
    public function addMbqEtForumPost($oMbqEtForumPost) {

        $topic_id   = $oMbqEtForumPost->topicId->oriValue;
        $subject    = $oMbqEtForumPost->postTitle->oriValue;
        $text_body  = $oMbqEtForumPost->postContent->oriValue;
        $text_body = '<p>' . $text_body .'</p>';
        $text_bodyParsed = TT_convertBBCodeForSave($text_body, $oMbqEtForumPost->attachmentIdArray->oriValue);
        $oMbqEtForumPost->postContent->setOriValue($text_bodyParsed);
        $container = \IPS\forums\Forum::load( $oMbqEtForumPost->forumId->oriValue );
        $topic = \IPS\forums\Topic::load($topic_id);

        if (method_exists($topic,'mergeConcurrentComment') && $lastComment = $topic->mergeConcurrentComment() )
        {
            $valueField = $lastComment::$databaseColumnMap['content'];
            $newContent = $lastComment->$valueField . $text_bodyParsed;
            $lastComment->editContents( $newContent );
            if($oMbqEtForumPost->groupId->hasSetOriValue())
            {
                call_user_func_array( array( 'IPS\File', 'claimAttachments' ), array_merge( array( $oMbqEtForumPost->groupId->oriValue ), $lastComment->attachmentIds() ) );
            }
            $oMbqEtForumPost->postId->setOriValue($lastComment->__get('pid'));
        }
        else
        {
            $reply = $topic->processCommentForm(array('topic_comment_' . $topic_id => $text_bodyParsed, 'topic_auto_follow' => (bool) ( \IPS\Member::loggedIn()->auto_follow['comments'] or \IPS\Member::loggedIn()->following('forums', 'topic', $topic_id ) ), '_contentReply'=>true));
            if($oMbqEtForumPost->groupId->hasSetOriValue())
            {
                call_user_func_array( array( 'IPS\File', 'claimAttachments' ), array_merge( array( $oMbqEtForumPost->groupId->oriValue ), $reply->attachmentIds() ) );
            }
            if($reply->__get('queued') != 0)
            {
                $oMbqEtForumPost->state->setOriValue(1);
            }
            $oMbqEtForumPost->postId->setOriValue($reply->__get('pid'));
        }
        $topic->save();
        try{
            $topic->markRead();
        }catch(OutOfRangeException $ex){
        }
        return $oMbqEtForumPost;
    }

    /**
     * modify forum post
     */
    public function mdfMbqEtForumPost($oMbqEtForumPost, $mbqOpt) {
        $reason = $mbqOpt['in']->reason;
        $subject    = $oMbqEtForumPost->postTitle->oriValue;
        $text_body  = $oMbqEtForumPost->postContent->oriValue;
        $text_body = '<p>' . $text_body .'</p>';
        $text_bodyParsed = TT_convertBBCodeForSave($text_body, $oMbqEtForumPost->attachmentIdArray->oriValue);
        $post = \IPS\forums\Topic\Post::load($oMbqEtForumPost->postId->oriValue);
        if(!empty($reason))
        {
            $post->__set('post_edit_reason', $reason);
        }
        $post->editContents( $text_bodyParsed );
        $post->save();
        if($post->__get('queued') != 0)
        {
            $oMbqEtForumPost->state->setOriValue(1);
        }
        return $oMbqEtForumPost;
    }

    /**
     * m_delete_post
     */
    public function mDeletePost($oMbqEtForumPost, $mode, $reason) {
        if($mode == 1)//soft_delete
        {
            if(!isset($reason)) $reason = NULL;
            $IPB4OriginalPostObject = $oMbqEtForumPost->mbqBind;
            $IPB4OriginalPostObject->modAction('hide', NULL, $reason);
        }
        else if($mode == 2)//hard_delete
        {
            $IPB4OriginalPostObject = $oMbqEtForumPost->mbqBind;
            $IPB4OriginalPostObject->modAction('delete');
        }
        return true;

    }

    /**
     * m_undelete_post
     */
    public function mUndeletePost($oMbqEtForumPost) {
        $IPB4OriginalPostObject = $oMbqEtForumPost->mbqBind;
        $IPB4OriginalPostObject->modAction('unhide');
        return true;

    }

    /**
     * m_move_post
     */
    public function mMovePost($oMbqEtForumPosts, $oMbqEtForum, $oMbqEtForumTopic, $topicTitle) {
        if($oMbqEtForumTopic == null && !empty($topicTitle) && !empty($oMbqEtForum)){
            $values['topic_title']     = $topicTitle;
            $values['topic_container'] = $oMbqEtForum->mbqBind;
            $IPB4OriginalForumObject   = $oMbqEtForum->mbqBind;
            $IPB4OriginalPostObject    = $oMbqEtForumPosts[0]->mbqBind;
            $IPB4TopicObject = IPS\forums\Topic::createItem( $IPB4OriginalPostObject->author(), $IPB4OriginalPostObject->mapped('ip_address'), \IPS\DateTime::ts( $IPB4OriginalPostObject->mapped('date') ), $IPB4OriginalForumObject );
            $IPB4TopicObject->processForm( $values );
            $firstPostId = $IPB4OriginalPostObject->pid;
            $IPB4TopicObject->save();
            foreach ($oMbqEtForumPosts as $oMbqEtForumPost) {
                $oMbqEtForumPost->mbqBind->move( $IPB4TopicObject );
            }
        }else if(!empty($oMbqEtForumTopic)){
            $IPB4OriginalTopicObject = $oMbqEtForumTopic->mbqBind;
            foreach ($oMbqEtForumPosts as $oMbqEtForumPost) {
                $oMbqEtForumPost->mbqBind->move( $IPB4OriginalTopicObject );
            }
        }
        return true;

    }

    /**
     * m_merge_post
     */
    public function mMergePost($objsMbqEtForumPost, $oMbqEtForumPost) {
        $IPB4OriginalPostObject = $oMbqEtForumPost->mbqBind;
        $post = '';
        foreach ($objsMbqEtForumPost as $PostObject) {
            $OriginalPostObject = $PostObject->mbqBind;
            $post = $post.'</br>'.$OriginalPostObject->post;
            \IPS\Db::i()->update( 'core_attachments_map', array(
                'id1'   => $IPB4OriginalPostObject->topic_id,
                'id2'   => $IPB4OriginalPostObject->pid,
            ), array( 'location_key=? AND id1=? AND id2=?', 'forums' . '_' . ucfirst( 'forums' ), $IPB4OriginalPostObject->topic_id, $OriginalPostObject->pid ) );
            $OriginalPostObject->delete();
        }
        $IPB4OriginalPostObject->post .= $post;
        $IPB4OriginalPostObject->save();

        return true;
    }

    /**
     * m_approve_post
     */
    public function mApprovePost($oMbqEtForumPost, $mode) {
        $IPB4OriginalPostObject = $oMbqEtForumPost->mbqBind;
        if($mode == 1) $IPB4OriginalPostObject->modAction('approve');
        else if($mode == 2) $IPB4OriginalPostObject->modAction('hide');

        return true;
    }

    /**
     * m_close_report
     */
    public function mCloseReport($oMbqEtForumPost) {
        $pid = $oMbqEtForumPost->postId->oriValue;
        $rid = \IPS\Db::i()->select('id', 'core_rc_index', 'content_id = '.$pid)->first();
        if($rid){
            $result = \IPS\Db::i()->update('core_rc_index','status = 3','id = '.$rid);
            if($result == 1)
                return true;
            else
                return false;
        }else{
            return false;
        }
    }

    /**
     * thank post
     */
    public function likePost($oMbqEtForumPost) {
        $oMbqEtForumPost->mbqBind->react(\IPS\Content\Reaction::load( 1 ));
        return true;
    }

    /**
     * thank post
     */
    public function unlikePost($oMbqEtForumPost) {
        $oMbqEtForumPost->mbqBind->removeReaction();
        return true;
    }

    public function reportPost($oMbqEtForumPost, $reason)
    {
        $oMbqEtForumPost->mbqBind->report($reason);
        return true;
    }
}
