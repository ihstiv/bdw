<?php

defined('MBQ_IN_IT') or exit;

MbqMain::$oClk->includeClass('MbqBaseRdEtPc');

/**
 * private conversation read class
 */
Class MbqRdEtPc extends MbqBaseRdEtPc {

    public function __construct() {
    }

    public function makeProperty(&$oMbqEtPc, $pName, $mbqOpt = array()) {
        switch ($pName) {
            default:
            MbqError::alert('', __METHOD__ . ',line:' . __LINE__ . '.' . MBQ_ERR_INFO_UNKNOWN_PNAME . ':' . $pName . '.');
            break;
        }
    }
    /**
     * get unread private conversations number
     *
     * @return  Integer
     */
    public function getUnreadPcNum() {
        try {
            $latestConversationMap = \IPS\Db::i()->select( 'map_id', 'core_message_topic_user_map', array( 'map_user_id=? AND map_user_active=1 AND map_has_unread=1 AND map_ignore_notification=0', \IPS\Member::loggedIn()->member_id ), 'map_last_topic_reply DESC', array(1,1), null, null, \IPS\Db::SELECT_SQL_CALC_FOUND_ROWS);

            return $latestConversationMap->count(true);
        }
        catch (Exception $e) {
            MbqError::alert('', __METHOD__ . ',line:' . __LINE__ . '.' . "Can not get unread pm number.");
        }
    }

    public function getSubcribedUnreadPcNum()
    {
        try {
            $latestConversationMap = \IPS\Db::i()->select( 'map_id', 'core_message_topic_user_map', array( 'map_user_id=? AND map_user_active=1 AND map_has_unread=1 AND map_ignore_notification=0', \IPS\Member::loggedIn()->member_id ), 'map_last_topic_reply DESC' , array(1,1), null, null, \IPS\Db::SELECT_SQL_CALC_FOUND_ROWS);

            return $latestConversationMap->count(true);
        }
        catch (Exception $e) {
            MbqError::alert('', __METHOD__ . ',line:' . __LINE__ . '.' . "Can not get unread pm number.");
        }
    }
    /**
     * get private conversation objs
     *
     * $mbqOpt['case'] = 'all' means get my all data.
     * $mbqOpt['case'] = 'byConvIds' means get data by conversation ids.$var is the ids.
     * $mbqOpt['case'] = 'byObjsStdPc' means get data by objsStdPc.$var is the objsStdPc.
     * @return  Mixed
     */
    public function getObjsMbqEtPc($var, $mbqOpt) {
        if ($mbqOpt['case'] == 'all') {
            $oMbqDataPage = $mbqOpt['oMbqDataPage'];
            $where = array( array( 'map_user_id=? AND map_user_active=1', \IPS\Member::loggedIn()->member_id ) );
		//	$where[] = array( 'map_is_starter=1' );
            /* Get a count */
			$count = \IPS\Db::i()->select( 'COUNT(*)', 'core_message_topic_user_map', $where )->first();

			/* Get iterator */
			$iterator	= \IPS\Db::i()->select(
					'core_message_topic_user_map.*, core_message_topics.*',
					'core_message_topic_user_map',
					$where,
					( in_array( \IPS\Request::i()->sortBy, array( 'mt_last_post_time', 'mt_start_time', 'mt_replies' ) ) ? \IPS\Request::i()->sortBy : 'mt_last_post_time' ) . ' DESC',
					array( ( intval( \IPS\Request::i()->listPage ?: 1 ) - 1 ) * 25, 25 )
				)->join(
					'core_message_topics',
					'core_message_topic_user_map.map_topic_id=core_message_topics.mt_id'
				);

            /* Build the message list */
            $oMbqDataPage->totalNum = $count;
            foreach ( $iterator as $row )
            {
                $conversationRow = \IPS\core\Messenger\Conversation::load( $row['mt_id'] );
                $oMbqDataPage->datas[] = $this->initOMbqEtPc($conversationRow, array('case'=>'byRow'));
            }

            /* Note the last time we looked at the message list */
            \IPS\Member::loggedIn()->msg_count_reset = time();
            \IPS\core\Messenger\Conversation::rebuildMessageCounts( \IPS\Member::loggedIn() );
           return $oMbqDataPage;

        } elseif ($mbqOpt['case'] == 'byConvIds') {
            $where = array( array( 'map_user_id=? AND map_user_active=1', \IPS\Member::loggedIn()->member_id ) );
            $where[] = array( 'map_id in (?)',  implode(',',$var));

			/* Get iterator */
			$iterator	= \IPS\Db::i()->select(
					'core_message_topic_user_map.*, core_message_topics.*',
					'core_message_topic_user_map',
					$where,
					( in_array( \IPS\Request::i()->sortBy, array( 'mt_last_post_time', 'mt_start_time', 'mt_replies' ) ) ? \IPS\Request::i()->sortBy : 'mt_last_post_time' ) . ' DESC',
					array( ( intval( \IPS\Request::i()->listPage ?: 1 ) - 1 ) * 25, 25 )
				)->join(
					'core_message_topics',
					'core_message_topic_user_map.map_topic_id=core_message_topics.mt_id'
				);

            /* Build the message list */
            $result = array();
            foreach ( $iterator as $row )
            {
                $conversationRow = \IPS\core\Messenger\Conversation::load( $row['mt_id'] );
                $result[] = $this->initOMbqEtPc($conversationRow, array('case'=>'byRow'));
            }

            /* Note the last time we looked at the message list */
            \IPS\Member::loggedIn()->msg_count_reset = time();
            \IPS\core\Messenger\Conversation::rebuildMessageCounts( \IPS\Member::loggedIn() );
            return $result;
        }
        MbqError::alert('', __METHOD__ . ',line:' . __LINE__ . '.' . MBQ_ERR_INFO_UNKNOWN_CASE);
    }
    function initOMbqEtPc($var, $mbqOpt)
    {
        if($mbqOpt['case'] == 'byRow')
        {
            $oMbqEtPc = MbqMain::$oClk->newObj('MbqEtPc');
            $conversation = $var;
            $oMbqEtPc->mbqBind = $conversation;
            $oMbqEtPc->convId->setOriValue($conversation->__get('id'));
            $oMbqEtPc->convTitle->setOriValue($conversation->__get('title'));
            $oMbqEtPc->totalMessageNum->setOriValue($conversation->__get('replies'));
            $oMbqEtPc->participantCount->setOriValue($conversation->__get('to_count'));
            $oMbqEtPc->startUserId->setOriValue($conversation->__get('starter_id'));
            $oMbqEtPc->startConvTime->setOriValue($conversation->__get('start_time'));
            $oMbqEtPc->lastUserId->setOriValue($conversation->__get('starter_id'));
            $oMbqEtPc->lastConvTime->setOriValue($conversation->__get('last_post_time'));
            try
            {
                $map = $conversation->get_map();
            }
            catch(Exception $ex)
            {
                return null;
            }
            $oMbqEtPc->newPost->setOriValue(isset($map['map_has_unread']) && $map['map_has_unread'] == 1);
            $oMbqEtPc->firstMsgId->setOriValue($conversation->__get('first_msg_id'));
            $oMbqEtPc->deleteMode->setOriValue(MbqBaseFdt::getFdt('MbqFdtPc.MbqEtPc.deleteMode.range.soft-delete'));
            $userIds = array();
            $oMbqEtPc->canUpload->setOriValue($this->canUpload());
            foreach($conversation->comments() as $comment)
            {
                $userId = $comment->__get('author_id');
                if(!in_array($userId, $userIds))
                {
                    $userIds[] = $userId;
                }
            }
            $oMbqRdEtUser = MbqMain::$oClk->newObj('MbqRdEtUser');
            $objsRecipientMbqEtUser = $oMbqRdEtUser->getObjsMbqEtUser($userIds, array('case' => 'byUserIds'));
            foreach ($objsRecipientMbqEtUser as $oRecipientMbqEtUser) {
                if($oRecipientMbqEtUser != null)
                {
                    if(!isset($oMbqEtPc->objsRecipientMbqEtUser[$oRecipientMbqEtUser->userId->oriValue]))
                    {
                        $oMbqEtPc->objsRecipientMbqEtUser[$oRecipientMbqEtUser->userId->oriValue] = $oRecipientMbqEtUser;
                    }
                }
            }
            return $oMbqEtPc;
        }
        if($mbqOpt['case'] == "byConvId")
        {
            try
            {
                $conversation = \IPS\core\Messenger\Conversation::load($var);
            }
            catch(Exception $ex)
            {
                return null;
            }
        	return $this->initOMbqEtPc($conversation, array('case'=>'byRow'));
        }
    }
    public function canUpload()
    {
        /** @var \IPS\Member $loggedMember */
        $loggedMember = \IPS\Member::loggedIn();
        $mSetting = $loggedMember->get_group();
        if (!$mSetting || !isset($mSetting['g_can_msg_attach'])) {
            return false;
        }
        $canUpload = $mSetting['g_can_msg_attach'] === 0 ? false : true;
        return $canUpload;
    }
    public function getUrl($oMbqEtPc)
    {
        return (string)$oMbqEtPc->mbqBind->url();
    }
}
