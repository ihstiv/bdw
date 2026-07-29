<?php

defined('MBQ_IN_IT') or exit;

MbqMain::$oClk->includeClass('MbqBaseAclEtPc');

/**
 * private conversation acl class
 */
Class MbqAclEtPc extends MbqBaseAclEtPc {

    public function __construct() {
    }

    /**
     * According to the function execute() of IPS\core\modules\front\messaging\messenger
     *
     * @return Boolean
     */
    function hasLoginAndEnablePm(){
        if(MbqMain::hasLogin()  && MbqMain::isActiveMember() && !\IPS\Member::loggedIn()->members_disable_pm
         && \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'messaging' ))
        ){
            return true;
        }else{
            return false;
        }

    }

    /**
     * judge can get_inbox_stat
     *
     * @return  Boolean
     */
    public function canAclGetInboxStat() {
        return $this->hasLoginAndEnablePm();
    }

    /**
     * judge can get_conversations
     *
     * @return  Boolean
     */
    public function canAclGetConversations() {
        return $this->hasLoginAndEnablePm();
    }

    /**
     * judge can get_conversation
     *
     * @return  Boolean
     */
    public function canAclGetConversation($oMbqEtPc) {
        return $this->hasLoginAndEnablePm();
    }

    /**
     * judge can new_conversation
     *
     * @return  Boolean
     */
    public function canAclNewConversation($oMbqEtPc) {
        return $this->hasLoginAndEnablePm();
    }

    /**
     * judge can invite_participant
     *
     * @return  Boolean
     */
    public function canAclInviteParticipant($oMbqEtPcInviteParticipant) {
        return $this->hasLoginAndEnablePm();
    }

    /**
     * judge can delete_conversation
     *
     * @return  Boolean
     */
    public function canAclDeleteConversation($oMbqEtPc, $mode) {
        return $this->hasLoginAndEnablePm();
    }
}
