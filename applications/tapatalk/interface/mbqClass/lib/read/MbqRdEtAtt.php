<?php

defined('MBQ_IN_IT') or exit;

MbqMain::$oClk->includeClass('MbqBaseRdEtAtt');

/**
 * attachment read class
 */
Class MbqRdEtAtt extends MbqBaseRdEtAtt {

    public function __construct() {
    }

    public function makeProperty(&$oMbqEtAtt, $pName, $mbqOpt = array()) {
        switch ($pName) {
            default:
            MbqError::alert('', __METHOD__ . ',line:' . __LINE__ . '.' . MBQ_ERR_INFO_UNKNOWN_PNAME . ':' . $pName . '.');
            break;
        }
    }
    public function getObjsMbqEtAtt($var, $mbqOpt) {
        if ($mbqOpt['case'] == 'byAttachentIds') {
            if(isset($mbqOpt['location']))
            {
                $where = array( array( 'location_key=?', $mbqOpt['location'] ) );
            }
            else
            {
                $where = array( array( 'location_key=?', 'forums_Forums' ) );
            }
			$i = 1;
			foreach ( $var as $id )
			{
				$where[] = array( "id{$i}=?", $id );
				$i++;
			}
			$attachments = iterator_to_array( \IPS\Db::i()->select( '*', 'core_attachments_map', $where )->setKeyField( 'attachment_id' ) );
            $oMbqAttrs = array();
            foreach($attachments as $attachment)
            {
                $oMbqAttrs[] = $this->initOMbqEtAtt($attachment['attachment_id'], array('case' => 'byAttId'));
            }
            return $oMbqAttrs;
        }
    }

    public function initOMbqEtAtt($var = null, $mbqOpt = array()) {
         if ($mbqOpt['case'] == 'byAttId') {
            $attachment = \IPS\Db::i()->select( '*', 'core_attachments', array( 'attach_id=?', $var ) )->first();
            $oMbqAttr = $this->initOMbqEtAtt($attachment, array('case' => 'byRow'));
            return $oMbqAttr;
        }
        else if ($mbqOpt['case'] == 'byRow') {
            $attachment = $var;

            $type = isset($attachment['attach_ext']) ? $attachment['attach_ext'] : pathinfo($attachment['attach_file'], PATHINFO_EXTENSION);;

            switch($type){
                case 'gif':
                case 'jpg':
                case 'png':
                    $type = MbqBaseFdt::getFdt('MbqFdtAtt.MbqEtAtt.contentType.range.image');;
                    break;
                case 'pdf':
                    $type =  MbqBaseFdt::getFdt('MbqFdtAtt.MbqEtAtt.contentType.range.pdf');
                    break;
            }

            $url = '';
            $thumbnail = '';
            $attachmentBaseUrl = \IPS\File::getClass('core_Attachment' )->baseUrl();
            $attachmentBaseUrl = TT_fixBaseUrl($attachmentBaseUrl);

            if ($attachment['attach_is_image'])
			{
				$url = \IPS\Http\Url::external($attachmentBaseUrl .$attachment['attach_location']);
                if(!empty($attachment['attach_thumb_location']))
                {
                    $thumbnail = \IPS\Http\Url::external($attachmentBaseUrl .$attachment['attach_thumb_location']);
                }
			}
			else
			{
				$url = \IPS\Http\Url::external( \IPS\Settings::i()->base_url . "applications/core/interface/file/attachment.php" )->setQueryString( 'id', $attachment['attach_id'] );
            }

            $attachmentMap = \IPS\Db::i()->select( '*', 'core_attachments_map', array( 'attachment_id=?', $attachment['attach_id'] ) )->first();

            $oMbqEtAtt = MbqMain::$oClk->newObj('MbqEtAtt');
            $oMbqEtAtt->attId->setOriValue($attachment['attach_id']);
            $oMbqEtAtt->filtersSize->setOriValue($attachment['attach_filesize']);
            $oMbqEtAtt->uploadFileName->setOriValue($attachment['attach_file']);
            $oMbqEtAtt->contentType->setOriValue($type);
            $oMbqEtAtt->url->setOriValue((string)$url);
            if(!empty($thumbnail))
            {
                $oMbqEtAtt->thumbnailUrl->setOriValue((string)$thumbnail);
                $oMbqEtAtt->canViewThumbnailUrl->setOriValue(true);
            }
            if ($attachment['attach_is_image'])
			{
                $oMbqEtAtt->canViewUrl->setOriValue(true);
            }
            else
            {
                $forums = new \IPS\forums\extensions\core\EditorLocations\Forums();
                $canViewAttach = $forums->attachmentPermissionCheck(\IPS\Member::loggedIn(), $attachmentMap['id1'],$attachmentMap['id2'],$attachmentMap['id3'],$attachment);
                $oMbqEtAtt->canViewUrl->setOriValue($canViewAttach);
            }
             //$oMbqEtAtt->userId->setOriValue($attachment['poster_id']);
            //$oMbqRdEtUser = MbqMain::$oClk->newObj('MbqRdEtUser');
            //$oMbqEtAtt->oMbqEtUser = $oMbqRdEtUser->initOMbqEtUSer($attachment['poster_id'], array('case' => 'byUserId'));;
            $oMbqEtAtt->mbqBind = $attachment;
            return $oMbqEtAtt;
        }
    }
}
