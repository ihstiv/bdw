<?php

defined('MBQ_IN_IT') or exit;

MbqMain::$oClk->includeClass('MbqBaseWrEtPcMsg');

/**
 * private conversation message write class
 */
Class MbqWrEtPcMsg extends MbqBaseWrEtPcMsg {

    public function __construct() {
    }
    /**
     * add private conversation message
     *
     * @param  Object  $oMbqEtPcMsg
     * @param  Object  $oMbqEtPc
     */
    public function addMbqEtPcMsg($oMbqEtPcMsg, $oMbqEtPc) {
        $convId = $oMbqEtPc->convId->oriValue;
        $text_body  = $oMbqEtPcMsg->msgContent->oriValue;
        $text_bodyParsed = TT_convertBBCodeForSave($text_body, $oMbqEtPcMsg->attachmentIdArray->oriValue);
        $conversation = \IPS\core\Messenger\Conversation::load($convId);
        $reply = \IPS\core\Messenger\Message::create( $conversation, $text_bodyParsed, FALSE, NULL);
        if($oMbqEtPcMsg->groupId->hasSetOriValue())
        {
            \IPS\File::claimAttachments($oMbqEtPcMsg->groupId->oriValue, $convId ,$reply->__get('id'));
        }
        $oMbqEtPcMsg->msgId->setOriValue($reply->__get('id'));
        return $oMbqEtPcMsg;
    }

}
