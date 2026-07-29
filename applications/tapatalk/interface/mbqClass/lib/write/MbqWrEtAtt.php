<?php

defined('MBQ_IN_IT') or exit;

MbqMain::$oClk->includeClass('MbqBaseWrEtAtt');

/**
 * attachment write class
 */
Class MbqWrEtAtt extends MbqBaseWrEtAtt {

    public function __construct() {
    }
    public function uploadAttachment($oMbqEtForumOrConvPm, $groupId, $type) {

        $oMbqEtAtt = null;
        $uploadedFiles =  \IPS\File::createFromUploads('core_Attachment','attachment');
        $locationKey = is_a($oMbqEtForumOrConvPm,'MbqEtForum') ? "forums_Forums" : "core_Messaging";
        foreach ($uploadedFiles as $uploadedFile)
        {
            if(empty($groupId))
            {
                $groupId = uniqid();
            }
            $attachment =  $uploadedFile->makeAttachment($groupId, \IPS\Member::loggedIn());
            $inserts = array();
            $inserts[] = array(
							'attachment_id'	=> $attachment['attach_id'],
							'location_key'	=> $locationKey,
							'id1'			=> NULL,
							'id2'			=> NULL,
							'id3'			=> NULL,
							'temp'			=> md5($groupId)
						);
            \IPS\Db::i()->insert( 'core_attachments_map', $inserts, TRUE );
            $oMbqEtAtt = MbqMain::$oClk->newObj('MbqEtAtt');
            $oMbqEtAtt->attId->setOriValue($attachment['attach_id']);
            $oMbqEtAtt->groupId->setOriValue($groupId);
            $oMbqEtAtt->uploadFileName->setOriValue($attachment['attach_file']);

        }
        return $oMbqEtAtt;
    }
    /**
     * delete attachment
     */
    public function deleteAttachment($oMbqEtAtt) {
        $attachmentId = $oMbqEtAtt->attId->oriValue;
        if(is_numeric($attachmentId))
        {
            \IPS\Db::i()->delete( 'core_attachments', array( 'attach_id=?', $attachmentId ) );
            \IPS\Db::i()->delete( 'core_attachments_map', array( 'attachment_id=?', $attachmentId ) );
        }
        return $oMbqEtAtt->groupId->oriValue;
    }
}
