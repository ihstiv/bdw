<?php

defined('MBQ_IN_IT') or exit;

MbqMain::$oClk->includeClass('MbqBaseAclEtPcMsg');

/**
 * private conversation message acl class
 */
Class MbqAclEtPcMsg extends MbqBaseAclEtPcMsg {

    public function __construct() {
    }
    /**
     * judge can reply_conversation
     *
     * @return  Boolean
     */
    public function canAclReplyConversation($oMbqEtPcMsg, $oMbqEtPc) {
        return MbqMain::hasLogin()  && MbqMain::isActiveMember();
    }

    /**
     * judge can get_quote_conversation
     *
     * @return  Boolean
     */
    public function canAclGetQuoteConversation($oMbqEtPcMsg, $oMbqEtPc) {
        return MbqMain::hasLogin()  && MbqMain::isActiveMember();
    }
}
