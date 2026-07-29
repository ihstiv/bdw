<?php

defined('MBQ_IN_IT') or exit;

MbqMain::$oClk->includeClass('MbqBaseRdEtSocial');

/**
 * Social read class
 */
Class MbqRdEtSocial extends MbqBaseRdEtSocial {
    
    public function __construct() {
    }
    
    /**
     * get social objs
     *
     * @return  Array
     */
    public function getObjsMbqEtSocial($var, $mbqOpt) {
        if($mbqOpt['case'] == 'alert')
        {
            $oMbqDataPage = $mbqOpt['oMbqDataPage'];
            $urlObject	= \IPS\Http\Url::internal( 'app=core&module=system&controller=notifications', 'front', 'notifications' );
            $output = new \IPS\Notification\Table($urlObject);
            $output->setMember( \IPS\Member::loggedIn() );		
            $output->page = $oMbqDataPage->curPage;
            $output->limit = $oMbqDataPage->numPerPage;
            $advancedSearchValues = array();
            $notifications = $output->getRows($advancedSearchValues);
            
            \IPS\Db::i()->update( 'core_notifications', array( 'read_time' => time() ), array( 'member=?', \IPS\Member::loggedIn()->member_id ) );
            \IPS\Member::loggedIn()->recountNotifications();
            
            $oMbqDataPage->datas = array();
            foreach($notifications as $notificationRow)
            {
                $notif = $this->initOMbqEtSocial($notificationRow, $mbqOpt);
                if($notif != null)
                {
                    $oMbqDataPage->datas[] = $notif;
                }
            }
             
            //they do not return count, only num of pages so we need to play with it
            if($output->pages == 0)
            {
                $oMbqDataPage->totalNum =0;
            }
            else if($output->page = $output->pages)
            {
                $oMbqDataPage->totalNum = (($output->pages-1) * $output->limit) + sizeof($oMbqDataPage->datas);
            }
            else
            {
                $oMbqDataPage->totalNum = (($output->pages-1) * $output->limit) + 1;
            }
           
            return $oMbqDataPage;
        }
        else
        {
            MbqError::alert('', __METHOD__ . ',line:' . __LINE__ . '.' . MBQ_ERR_INFO_UNKNOWN_CASE);
        }
    }
    
    /**
     * init one social by condition
     *
     * @return  Mixed
     */
    public function initOMbqEtSocial($var, $mbqOpt) {
        if($mbqOpt['case'] == 'alert')
        {
            $row = $var;
            $notification = $row['notification'];
            $data = $row['data'];
            $lang = array(
		        'reply_to_you' => "%s replied to \"%s\"",
		        'quote_to_you' => '%s quoted your post in thread "%s"',
	            'tag_to_you' => '%s mentioned you in thread "%s"',
	            'post_new_topic' => '%s started a new thread "%s"',
	            'like_your_thread' => '%s liked your post in thread "%s"',
		        'pm_to_you' => '%s sent you a message "%s"',
	        );
            $oMbqRdEtUser = MbqMain::$oClk->newObj('MbqRdEtUser');
            $oMbqEtAlert = MbqMain::$oClk->newObj('MbqEtAlert');
          
            switch ($notification->__get('notification_key'))
            {
                case 'follower_content':
                    return null;
                    break;
                case 'member_follow':
                    return null;
                    break;
                case 'mention':
                    return null;
                    break;
                case 'new_comment':
                    $author = $data['author'];
                    $authorMbqEtUser = $oMbqRdEtUser->initOMbqEtUser($author->__get('member_id'), array('case' => 'byUserId'));
                    $oMbqEtAlert->userId->setOriValue($author->__get('member_id'));
                    $oMbqEtAlert->username->setOriValue($authorMbqEtUser->userName->oriValue);
                    $oMbqEtAlert->iconUrl->setOriValue($authorMbqEtUser->iconUrl->oriValue);
                    \IPS\Member::loggedIn()->language()->parseOutputForDisplay($data['title']);
                    $oMbqEtAlert->message->setOriValue(sprintf($lang['reply_to_you'],$authorMbqEtUser->userName->oriValue, $data['title']));
                    $oMbqEtAlert->contentType->setOriValue('sub');
                    $oMbqEtAlert->topicId->setOriValue($notification->__get('item_id'));
                    $oMbqEtAlert->contentId->setOriValue($notification->__get('item_sub_id'));
                     break;
                case 'new_content':
                    return null;
                    break;
                case 'new_likes':
                    return null;
                    break;
                case 'new_private_message':
                    $message = \IPS\core\Messenger\Message::load($notification->__get('item_sub_id'));
                    $author = \IPS\Member::load($message->__get('author_id'));
                    $authorMbqEtUser = $oMbqRdEtUser->initOMbqEtUser($author->__get('member_id'), array('case' => 'byUserId'));
                    $oMbqEtAlert->userId->setOriValue($author->__get('member_id'));
                    $oMbqEtAlert->username->setOriValue($authorMbqEtUser->userName->oriValue);
                    $oMbqEtAlert->iconUrl->setOriValue($authorMbqEtUser->iconUrl->oriValue);
                    $oMbqEtAlert->message->setOriValue(sprintf($lang['pm_to_you'],$authorMbqEtUser->userName->oriValue, TT_process_short_content($message->__get('post'))));
                    $oMbqEtAlert->contentType->setOriValue('pm');
                    $oMbqEtAlert->contentId->setOriValue($notification->__get('item_id'));
                    
                    break;
                case 'new_review':
                    return null;
                    break;
                case 'new_status':
                    return null;
                    break;
                case 'private_message_added':
                    return null;
                    break;
                case 'profile_comment':
                    return null;
                    break;
                case 'quote':
                    return null;
                    break;
                case 'report_center':
                    return null;
                    break;
                case 'unapproved_content':
                    return null;
                    break;
                case 'warning_mods':
                    return null;
                    break;
                case 'follower_content':
                    return null;
                    break;
            }
            $oMbqEtAlert->timestamp->setOriValue($notification->__get('sent_time'));
            $oMbqEtAlert->isUnread->setOriValue($data['unread']);
            return $oMbqEtAlert;
        }
        else
        {
            MbqError::alert('', __METHOD__ . ',line:' . __LINE__ . '.' . MBQ_ERR_INFO_UNKNOWN_CASE);
        }
        
    }
    
}

