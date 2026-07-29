<?php

defined('MBQ_IN_IT') or exit;

MbqMain::$oClk->includeClass('MbqBaseAclEtAtt');

/**
 * attachment acl class
 */
Class MbqAclEtAtt extends MbqBaseAclEtAtt {
    
    public function __construct() {
    }
    /**
     * judge can upload attachment
     *
     * @param  Object  $oMbqEtForum
     * @return  Boolean
     */
    public function canAclUploadAttach($oMbqEtForumOrConvPm, $groupId, $type) {

        return MbqMain::hasLogin() && \IPS\Settings::i()->attach_allowed_types != 'none';
    }
    
    /**
     * judge can remove attachment
     *
     * @param  Object  $oMbqEtAtt
     * @param  Object  $oMbqEtForum
     * @return  Boolean
     */
    public function canAclRemoveAttachment($oMbqEtAtt, $oMbqEtForum) {
         return MbqMain::hasLogin() && \IPS\Settings::i()->attach_allowed_types != 'none';
    }
}
