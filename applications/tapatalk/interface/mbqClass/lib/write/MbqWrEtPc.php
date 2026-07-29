<?php

defined('MBQ_IN_IT') or exit;

MbqMain::$oClk->includeClass('MbqBaseWrEtPc');

/**
 * private conversation write class
 */
Class MbqWrEtPc extends MbqBaseWrEtPc {

    public function __construct() {
    }
    /**
     * add private conversation
     *
     * @param  Object  $oMbqEtPc
     */
    public function addMbqEtPc($oMbqEtPc) {
        $participants = $oMbqEtPc->userNames->oriValue;
        $title = $oMbqEtPc->convTitle->oriValue;
        $text_body  = $oMbqEtPc->convContent->oriValue;
        $text_bodyParsed = TT_convertBBCodeForSave($text_body, $oMbqEtPc->attachmentIdArray->oriValue);
        $values = array();

        if(!is_array($participants))
        {
            $participants = array($participants);
        }
        foreach($participants as $participant)
        {
            $values['messenger_to'][] = \IPS\Member::load($participant,'name');
        }
        $values['messenger_title'] = $title;
        $values['messenger_content'] = $text_bodyParsed;
        $newConversation = \IPS\core\Messenger\Conversation::createFromForm($values);
        if($oMbqEtPc->groupId->hasSetOriValue())
        {
            \IPS\File::claimAttachments($oMbqEtPc->groupId->oriValue, $newConversation->__get('id'), $newConversation->__get('first_msg_id'));
        }
        $oMbqRdEtPc = MbqMain::$oClk->newObj('MbqRdEtPc');
        $oMbqEtPc =  $oMbqRdEtPc->initOMbqEtPc($newConversation->__get('id'),  array('case'=>'byConvId'));
        return $oMbqEtPc;
    }
    public function inviteParticipant($oMbqEtPcInviteParticipant) {

        $conversation = $oMbqEtPcInviteParticipant->oMbqEtPc->mbqBind;
        $maps = $conversation->maps( TRUE );
        /* Authorize each of the members */
        foreach ($oMbqEtPcInviteParticipant->objsMbqEtUser as $objsMbqEtUser)
        {
            $member = $objsMbqEtUser->mbqBind;
            if ( array_key_exists( $member->member_id, $maps ) and !$maps[$member->member_id]['map_user_active'] and !\IPS\Request::i()->unblock )
            {
	            throw new \InvalidArgumentException( \IPS\Member::loggedIn()->language()->addToStack('messenger_member_left', FALSE, array( 'sprintf' => array( $member->name ) ) ) );
            }

            $maps = $conversation->authorize( $member );
            $ids[] = $member->member_id;

            $notification = new \IPS\Notification( \IPS\Application::load('core'), 'private_message_added', $conversation, array( $conversation, \IPS\Member::loggedIn() ) );
            $notification->send();
        }
    }
    /**
     * delete conversation
     *
     * @param  Object  $oMbqEtPc
     * @param  Integer  $mode
     */
    public function deleteConversation($oMbqEtPc, $mode) {
        if ($mode ==1 || $mode == 2) {
            try {
                if($mode==2){
                    $oMbqEtPc->mbqBind->deauthorize(\IPS\Member::loggedIn());
                }
                else{
                    $oMbqEtPc->mbqBind->deauthorize(\IPS\Member::loggedIn());
                }
            }
            catch (Exception $e) {
                MbqError::alert('', "Can not delete conversation!", '', MBQ_ERR_APP);
            }
        } else {
            MbqError::alert('', "Need valid mode id!", '', MBQ_ERR_APP);
        }
    }
    /**
     * mark private conversation read
     */
    public function markPcRead($oMbqEtPc) {
        $oMbqEtPc->mbqBind->markRead(\IPS\Member::loggedIn());
        $time = time();
        $id = $oMbqEtPc->convId->oriValue;
        try {
            \IPS\Db::i()->update( 'core_message_topic_user_map', array( 'map_read_time' => $time,'map_has_unread' => 0 ),array('map_user_id=? AND map_user_active=1 AND map_has_unread= 1 AND map_ignore_notification=0 AND map_topic_id=?', \IPS\Member::loggedIn()->member_id,$id) );

        }
        catch (Exception $e) {
            MbqError::alert('', __METHOD__ . ',line:' . __LINE__ . '.' . "Can not mark pc read.");
        }
    }
    /**
     * mark all private conversations read
     */
    public function markAllPcRead(){
        \IPS\core\Messenger\Conversation::markContainerRead();

    }
}
