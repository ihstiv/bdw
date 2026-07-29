<?php

defined('MBQ_IN_IT') or exit;

MbqMain::$oClk->includeClass('MbqBaseAclEtForum');

/**
 * forum acl class
 */
Class MbqAclEtForum extends MbqBaseAclEtForum {

    public function __construct() {
    }

    /**
     * judge can get subscribed forum
     *
     * @return  Boolean
     */
    public function canAclGetSubscribedForum() {
        return MbqMain::hasLogin();
    }

    /**
     * judge can subscribe forum
     *
     * @param  Object  $oMbqEtForum
     * @return  Boolean
     */
    public function canAclSubscribeForum($oMbqEtForum, $receiveEmail) {
        return $oMbqEtForum->canSubscribe->oriValue;
    }

    /**
     * judge can unsubscribe forum
     *
     * @param  Object  $oMbqEtForum
     * @return  Boolean
     */
    public function canAclUnsubscribeForum($oMbqEtForum) {
        return $oMbqEtForum->isSubscribed->oriValue;
    }

    public function canAclMarkAllAsRead($oMbqEtForum)
    {
        return MbqMain::hasLogin();
    }
}
