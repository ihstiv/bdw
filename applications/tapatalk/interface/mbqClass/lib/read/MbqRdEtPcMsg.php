<?php

defined('MBQ_IN_IT') or exit;

MbqMain::$oClk->includeClass('MbqBaseRdEtPcMsg');

/**
 * private conversation message read class
 */
Class MbqRdEtPcMsg extends MbqBaseRdEtPcMsg {

    public function __construct() {
    }

    public function makeProperty(&$oMbqEtPcMsg, $pName, $mbqOpt = array()) {
        switch ($pName) {
            default:
            MbqError::alert('', __METHOD__ . ',line:' . __LINE__ . '.' . MBQ_ERR_INFO_UNKNOWN_PNAME . ':' . $pName . '.');
            break;
        }
    }
    /**
     * get private conversation message objs
     *
     * @param  Mixed  $var
     * @param  Array  $mbqOpt
     * $mbqOpt['case'] = 'byPc' means get data by private conversation obj.$var is the private conversation obj
     * $mbqOpt['case'] = 'byMsgIds' means get data by conversation message ids.$var is the ids.
     * @return  Mixed
     */
    public function getObjsMbqEtPcMsg($var, $mbqOpt) {
        if ($mbqOpt['case'] == 'byPc') {
            $oMbqEtPc = $var;
            $oMbqDataPage = $mbqOpt['oMbqDataPage'];
            $comments = $oMbqEtPc->mbqBind->comments($oMbqDataPage->numPerPage, $oMbqDataPage->startNum, 'date', 'asc', NULL, false);
            $oMbqDataPage->totalNum = $oMbqEtPc->totalMessageNum->oriValue;
            foreach($comments as $comment)
            {
                $oMbqDataPage->datas[] = $this->initOMbqEtPcMsg($comment, array('case'=>'byRow'));
            }
            return $oMbqDataPage;
        }
        MbqError::alert('', __METHOD__ . ',line:' . __LINE__ . '.' . MBQ_ERR_INFO_UNKNOWN_CASE);
    }
    function initOMbqEtPcMsg($var, $mbqOpt)
    {
        if($mbqOpt['case'] == 'byRow')
        {
            $oMbqEtPcMsg = MbqMain::$oClk->newObj('MbqEtPcMsg');
            $comment = $var;
            $oMbqEtPcMsg->mbqBind = $comment;
            $oMbqEtPcMsg->msgId->setOriValue($comment->__get('id'));
            $oMbqEtPcMsg->convId->setOriValue($comment->__get('topic_id'));
            $oMbqEtPcMsg->msgTitle->setOriValue('');
            $content = $comment->__get('post');
            $contentParsed = TT_convertToTapatalkBBCode($content);
            $oMbqEtPcMsg->msgContent->setOriValue($content);
            $oMbqEtPcMsg->msgContent->setAppDisplayValue($contentParsed);
            $oMbqEtPcMsg->msgContent->setTmlDisplayValue($contentParsed);
            $oMbqEtPcMsg->msgContent->setTmlDisplayValueNoHtml($content);
            $oMbqEtPcMsg->msgAuthorId->setOriValue($comment->__get('author_id'));
            $oMbqEtPcMsg->postTime->setOriValue($comment->__get('date'));
            $oMbqRdEtUser = MbqMain::$oClk->newObj('MbqRdEtUser');
            $oMbqEtPcMsg->oAuthorMbqEtUser = $oMbqRdEtUser->initOMbqEtUser($comment->__get('author_id'), array('case' => 'byUserId'));
            $attachmentIds = $comment->attachmentIds();
            $oMbqRdAtt = MbqMain::$oClk->newObj('MbqRdEtAtt');
            $attachments = $oMbqRdAtt->getObjsMbqEtAtt($attachmentIds, array('case' => 'byAttachentIds', 'location' => 'core_Messaging'));
            foreach($attachments as $attachment)
            {
                if(stripos($contentParsed,$attachment->url->oriValue) == false)
                {
                    $oMbqEtPcMsg->objsNotInContentMbqEtAtt[] = $attachment;
                }
                else
                {
                    $oMbqEtPcMsg->objsMbqEtAtt[] = $attachment;
                }
            }
            return $oMbqEtPcMsg;
        }
        else if($mbqOpt['case'] == 'byPcMsgId')
        {
            $oMbqEtPc = $var;
            if($oMbqEtPc->mbqBind == null)
            {
                $oMbqRdEtPc = MbqMain::$oClk->newObj('MbqRdEtPc');
                $oMbqEtPc =  $oMbqRdEtPc->initOMbqEtPc($oMbqEtPc->convId->oriValue,  array('case'=>'byConvId'));
            }
            $msgId = $mbqOpt['pcMsgId'];
            $comments = $oMbqEtPc->mbqBind->comments();
            foreach($comments as $comment)
            {
                if($comment->__get('id') == $msgId)
                {
                    return $this->initOMbqEtPcMsg($comment, array('case'=>'byRow'));
                }
            }
            return null;
        }
    }
    function getQuoteConversation($oMbqEtPcMsg)
    {
        $userName = $oMbqEtPcMsg->oAuthorMbqEtUser->userName->oriValue;
        $date = $oMbqEtPcMsg->postTime->oriValue;
        $quote = '<blockquote class="ipsBlockquote" data-ipsquote-username="' . $userName . '" data-ipsquote-timestamp="' . $date . '">' . $oMbqEtPcMsg->msgContent->oriValue . "</blockquote>";
        return $quote;
    }
}
