<?php

defined('MBQ_IN_IT') or exit;

MbqMain::$oClk->includeClass('MbqBaseRdEtForumTopic');

/**
 * forum topic read class
 */
Class MbqRdEtForumTopic extends MbqBaseRdEtForumTopic {

    public function __construct() {
    }

    public function makeProperty(&$oMbqEtForumTopic, $pName, $mbqOpt = array()) {
        switch ($pName) {
            default:
                MbqError::alert('', __METHOD__ . ',line:' . __LINE__ . '.' . MBQ_ERR_INFO_UNKNOWN_PNAME . ':' . $pName . '.');
                break;
        }
    }
    /**
     * get forum topic objs
     *
     * @param  Mixed  $var
     * @param  Array  $mbqOpt
     * $mbqOpt['case'] = 'byForum' means get data by forum obj.$var is the forum obj.
     * $mbqOpt['case'] = 'subscribed' means get subscribed data.$var is the user id.
     * $mbqOpt['case'] = 'byTopicIds' means get data by topic ids.$var is the ids.
     * $mbqOpt['case'] = 'byAuthor' means get data by author.$var is the MbqEtUser obj.
     * $mbqOpt['top'] = true means get sticky data.
     * $mbqOpt['notIncludeTop'] = true means get not sticky data.
     * $mbqOpt['oMbqDataPage'] = pagination class info.
     * $mbqOpt['ann'] = true means get anouncement data.
     * $mbqOpt['oFirstMbqEtForumPost'] = true means load oFirstMbqEtForumPost property of topic,default is true.This param used to prevent infinite recursion call for get oMbqEtForumTopic and oFirstMbqEtForumPost and make memory depleted
     * @return  Mixed
     */
    public function getObjsMbqEtForumTopic($var, $mbqOpt) {

        switch($mbqOpt['case'])
        {
            case 'byForum':
                {
                    $oMbqEtForum = $var;
                    $oMbqDataPage = $mbqOpt['oMbqDataPage'];
                    $topic_list = array();
                    $topic_num = 0;
                    $objsMbqEtForumTopic = array();
                    $where = array();
                    if ( isset( \IPS\forums\Topic::$databaseColumnMap['hidden'] ) )
                    {
                        $where[] = array( \IPS\forums\Topic::$databasePrefix . \IPS\forums\Topic::$databaseColumnMap['hidden'] . '=0' );
                    }
                    else
                    {
                        $where[] = array( \IPS\forums\Topic::$databasePrefix . \IPS\forums\Topic::$databaseColumnMap['approved'] . '=1' );
				    }
                    if (isset($mbqOpt['top']) && $mbqOpt['top'] == true)
                    {
                        $where[] = array('forums_topics.featured=?','0');
                        $where[] = array('forums_topics.pinned=?','1');
                    }
                    // check if need announce topic only
                    else if (isset($mbqOpt['ann']) && $mbqOpt['ann'] == true)
                    {
                        $where[] = array('forums_topics.featured=?','1');
                    }
                    else
                    {
                        $where[] = array('forums_topics.pinned=?','0');
                        $where[] = array('forums_topics.featured=?','0');
                    }
                    $hiddenWhere = mobiquo_hide_forum_topicWhere();
                    if($hiddenWhere != null)
                    {
                        $where[] = $hiddenWhere;
                    }
                    $where[] = array('forums_topics.forum_id='. $oMbqEtForum->forumId->oriValue);
                    $topic_num = \IPS\forums\Topic::getItemsWithPermission($where, 'last_real_post desc', null, 'view', \IPS\Content\Hideable::FILTER_AUTOMATIC, 0, null, false, false, false, true);
		            $it = \IPS\forums\Topic::getItemsWithPermission($where, 'last_real_post desc', array($oMbqDataPage->startNum, $oMbqDataPage->lastNum+1 ), 'view', \IPS\Content\Hideable::FILTER_AUTOMATIC);
		            $rows = iterator_to_array( $it );

		            /* Pull in extra data */
		            \IPS\forums\Topic::tableGetRows( $rows );
		            foreach($rows as $row)
                    {
                        $objsMbqEtForumTopic[] = $this->initOMbqEtForumTopic($row, array('case' => 'byRow','oMbqEtForum' => $oMbqEtForum, 'oMbqEtUser' => true));
                    }
                    if (isset($mbqOpt['oMbqDataPage'])) {
                        $oMbqDataPage = $mbqOpt['oMbqDataPage'];
                        $oMbqDataPage->totalNum = $topic_num;
                        $oMbqDataPage->datas = $objsMbqEtForumTopic;
                        return $oMbqDataPage;
                    } else {
                        return $objsMbqEtForumTopic;
                    }
                    break;
                }
            case 'byTopicIds':
                {
                    $topicIds = $var;
                    if(!is_array($topicIds))
                    {
                        $topicIds = explode(',',$topicIds);
                    }
                    $objsMbqEtForumTopic = array();
                    foreach($topicIds as $topicId)
                    {
                        try
                        {
                            $topic = \IPS\forums\Topic::load($topicId);
                        }
                        catch(OutOfRangeException $ex)
                        {
                            continue;
                        }
                        if(mobiquo_hide_forum($topic->__get('forum_id')))
                        {
                            continue;
                        }
                        $objsMbqEtForumTopic[] = $this->initOMbqEtForumTopic($topic, array('case' => 'byRow', 'oMbqEtForum' => true, 'oMbqEtUser' => true));
                    }
                    if (isset($mbqOpt['oMbqDataPage']))
                    {
                        $oMbqDataPage = $mbqOpt['oMbqDataPage'];
                        $oMbqDataPage->totalNum = sizeof($objsMbqEtForumTopic);
                        $oMbqDataPage->datas = $objsMbqEtForumTopic;
                        return $oMbqDataPage;
                    }
                    else
                    {
                        return $objsMbqEtForumTopic;
                    }
                }
            case 'subscribed':
                {
                    $oMbqDataPage = $mbqOpt['oMbqDataPage'];
                    $output = new \IPS\core\Followed\Table( "IPS\\forums\\Topic", explode( '_', "forums_topic" ) );
                    $output->page = $oMbqDataPage->curPage;
                    $output->limit = $oMbqDataPage->numPerPage;
                    $advancedSearchValues = array();
                    $topics = $output->getRows($advancedSearchValues);
                    foreach($topics as $topic)
                    {
                        if(mobiquo_hide_forum($topic->__get('forum_id')))
                        {
                            continue;
                        }
                        $oMbqDataPage->datas[] = $this->initOMbqEtForumTopic($topic, array('case' => 'byRow', 'oMbqEtForum' => true, 'oMbqEtUser' => true));
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
            case 'awaitingModeration':
                {
                    $oMbqEtUser = $var;
                    $oMbqDataPage = $mbqOpt['oMbqDataPage'];

                    $topic_list = array();
                    $topic_num = 0;
                    $objsMbqEtForumTopic = array();
                    $where = array();
                    $hiddenWhere = mobiquo_hide_forum_topicWhere();
                    if($hiddenWhere != null)
                    {
                        $where[] = $hiddenWhere;
                    }
                    $topic_num = \IPS\forums\Topic::getItemsWithPermission(array_merge(array(array('forums_topics.approved=?', 0)), $where) , 'last_real_post desc', null, 'view', false, 0, null, false, false, false, true);
		            $it = \IPS\forums\Topic::getItemsWithPermission(array_merge(array(array('forums_topics.approved=?', 0)), $where) , 'last_real_post desc', array($oMbqDataPage->startNum, $oMbqDataPage->lastNum+1 ), 'view');
		            $rows = iterator_to_array( $it );

		            /* Pull in extra data */
		            \IPS\forums\Topic::tableGetRows( $rows );
		            foreach($rows as $row)
                    {
                        $objsMbqEtForumTopic[] = $this->initOMbqEtForumTopic($row, array('case' => 'byRow', 'oMbqEtUser' => true));
                    }
                    if (isset($mbqOpt['oMbqDataPage'])) {
                        $oMbqDataPage = $mbqOpt['oMbqDataPage'];
                        $oMbqDataPage->totalNum = $topic_num;
                        $oMbqDataPage->datas = $objsMbqEtForumTopic;
                        return $oMbqDataPage;
                    } else {
                        return $objsMbqEtForumTopic;
                    }
                }
            case 'deleted':
                {
                    $oMbqEtUser = $var;
                    $oMbqDataPage = $mbqOpt['oMbqDataPage'];

                    $topic_list = array();
                    $topic_num = 0;
                    $objsMbqEtForumTopic = array();
                    $where = array();
                    $hiddenWhere = mobiquo_hide_forum_topicWhere();
                    if($hiddenWhere != null)
                    {
                        $where[] = $hiddenWhere;
                    }
                    $topic_num = \IPS\forums\Topic::getItemsWithPermission(array_merge(array(array('forums_topics.approved=?', "-1")), $where) , 'last_real_post desc', array($oMbqDataPage->startNum, $oMbqDataPage->lastNum+1 ), 'view', false, 0, null, false, false, false, true);
                    $it = \IPS\forums\Topic::getItemsWithPermission(array_merge(array(array('forums_topics.approved=?', "-1")), $where) , 'last_real_post desc', array($oMbqDataPage->startNum, $oMbqDataPage->lastNum+1 ), 'view');
		            $rows = iterator_to_array( $it );

		            /* Pull in extra data */
		            \IPS\forums\Topic::tableGetRows( $rows );
		            foreach($rows as $row)
                    {
                        $objsMbqEtForumTopic[] = $this->initOMbqEtForumTopic($row, array('case' => 'byRow', 'oMbqEtUser' => true));
                    }
                    if (isset($mbqOpt['oMbqDataPage'])) {
                        $oMbqDataPage = $mbqOpt['oMbqDataPage'];
                        $oMbqDataPage->totalNum = $topic_num;
                        $oMbqDataPage->datas = $objsMbqEtForumTopic;
                        return $oMbqDataPage;
                    } else {
                        return $objsMbqEtForumTopic;
                    }
                }
            case 'byAuthor':
                {
                    $oMbqEtUser = $var;
                    $oMbqDataPage = $mbqOpt['oMbqDataPage'];

                    $topic_list = array();
                    $topic_num = 0;
                    $objsMbqEtForumTopic = array();
                    $where = array();
                    $hiddenWhere = mobiquo_hide_forum_topicWhere();
                    if($hiddenWhere != null)
                    {
                        $where[] = $hiddenWhere;
                    }
                    $topic_num = \IPS\forums\Topic::getItemsWithPermission(array_merge(array(array('forums_topics.starter_id=?', $oMbqEtUser->userId->oriValue)), $where) , 'last_real_post desc', array($oMbqDataPage->startNum, $oMbqDataPage->lastNum+1 ),  'view', false, 0, null, false, false, false, true);
		            $it = \IPS\forums\Topic::getItemsWithPermission(array_merge(array(array('forums_topics.starter_id=?', $oMbqEtUser->userId->oriValue)), $where) , 'last_real_post desc', array($oMbqDataPage->startNum, $oMbqDataPage->lastNum+1 ), 'view');
		            $rows = iterator_to_array( $it );

		            /* Pull in extra data */
		            \IPS\forums\Topic::tableGetRows( $rows );
		            foreach($rows as $row)
                    {
                        $objsMbqEtForumTopic[] = $this->initOMbqEtForumTopic($row, array('case' => 'byRow', 'oMbqEtUser' => true));
                    }
                    if (isset($mbqOpt['oMbqDataPage'])) {
                        $oMbqDataPage = $mbqOpt['oMbqDataPage'];
                        $oMbqDataPage->totalNum = $topic_num;
                        $oMbqDataPage->datas = $objsMbqEtForumTopic;
                        return $oMbqDataPage;
                    } else {
                        return $objsMbqEtForumTopic;
                    }
                }
        }
    }
    /**
     * init one forum topic by condition
     *
     * @return  Mixed
     */
    public function initOMbqEtForumTopic($var, $mbqOpt) {
        global $db, $auth, $user, $config;
        if ($mbqOpt['case'] == 'byRow')
        {
            $topic = $var;



            $oMbqEtForumTopic = MbqMain::$oClk->newObj('MbqEtForumTopic');
            $oMbqEtForumTopic->totalPostNum->setOriValue($topic->__get('posts'));
            $oMbqEtForumTopic->topicId->setOriValue($topic->__get('tid'));
            $oMbqEtForumTopic->forumId->setOriValue($topic->__get('forum_id'));
            $oMbqEtForumTopic->firstPostId->setOriValue($topic->__get('topic_fistpost'));

            $oMbqEtForumTopic->topicTitle->setOriValue(html_entity_decode(strip_tags($topic->__get('title')), ENT_QUOTES, 'UTF-8'));
            if($oMbqEtForumTopic->topicTitle->oriValue == '')
            {
                $oMbqEtForumTopic->topicTitle->setOriValue('--');
            }
            $oMbqRdEtUser = MbqMain::$oClk->newObj('MbqRdEtUser');
            $oMbqEtForumTopic->oAuthorMbqEtUser = $oMbqRdEtUser->initOMbqEtUser($topic->__get('starter_id'), array('case' => 'byUserId', 'guest_if_null'=>true));
            $oMbqEtForumTopic->oLastReplyMbqEtUser = $oMbqRdEtUser->initOMbqEtUser($topic->__get('last_poster_id'), array('case' => 'byUserId', 'guest_if_null'=>true));
            $oMbqEtForumTopic->authorIconUrl->setOriValue($oMbqEtForumTopic->oAuthorMbqEtUser->iconUrl->oriValue);
            $firstPost = $topic->comments( 1, 0, 'date', 'ASC', null, true );
            if($firstPost != null)
            {
                $oMbqEtForumTopic->topicContent->setOriValue($firstPost->__get('post'));
                if(MbqMain::$cmd =='get_topic'){
                    $short_content = TT_process_short_content($firstPost->__get('post'));
                    $oMbqEtForumTopic->shortContent->setOriValue($short_content);
                    $oMbqEtForumTopic->postTime->setOriValue($firstPost->__get('post_date'));
                }else{
                    if ( $topic->posts > 1 )
                    {
                        $latestPost = $topic->comments( 1, 0, 'date', 'DESC', null, true  );
                    }
                    else
                    {
                        $latestPost = $firstPost;
                    }
                    $short_content = TT_process_short_content($latestPost->__get('post'));
                    $oMbqEtForumTopic->shortContent->setOriValue($short_content);
                    $oMbqEtForumTopic->postTime->setOriValue($latestPost->__get('post_date'));
                }
            }
            else
            {
                $oMbqEtForumTopic->topicContent->setOriValue(' ');
            }
            $oMbqEtForumTopic->topicAuthorId->setOriValue($topic->__get('starter_id'));
            $oMbqEtForumTopic->lastReplyAuthorId->setOriValue($topic->__get('last_poster_id'));
            $oMbqEtForumTopic->lastReplyTime->setOriValue(mobiquo_format_date($topic->__get('last_post')));
            $oMbqEtForumTopic->replyNumber->setOriValue($topic->__get('posts')-1);
            $oMbqEtForumTopic->newPost->setOriValue($topic->unread());
            $oMbqEtForumTopic->canRename->setOriValue($topic->canEdit() && MbqMain::isActiveMember());
            $oMbqEtForumTopic->canReply->setOriValue($topic->canComment() && MbqMain::isActiveMember());
            $topicState = $topic->__get('state');
            $oMbqEtForumTopic->isSticky->setOriValue($topic->__get('pinned'));
            $oMbqEtForumTopic->canStick->setOriValue($topic->__get('pinned') ? $topic->canUnpin() : $topic->canPin());
            $oMbqEtForumTopic->isDeleted->setOriValue($topicState == 'hidden');
            $oMbqEtForumTopic->canDelete->setOriValue($topic->canDelete() || $topic->canHide());
            $oMbqEtForumTopic->isClosed->setOriValue($topic->locked());
            $oMbqEtForumTopic->canClose->setOriValue($topic->locked() ? $topic->canUnlock() : $topic->canLock());
            $oMbqEtForumTopic->isApproved->setOriValue($topicState != 'unapproved' && $topic->__get('approved') == 1);
            $oMbqEtForumTopic->canApprove->setOriValue($topic->canPublish());
            $oMbqEtForumTopic->canMove->setOriValue($topic->canMove());
            $saveActions = $topic->availableSavedActions();
            if(MbqMain::hasLogin() && MbqMain::isActiveMember())
            {
                $isFollowing = \IPS\Member::loggedIn()->following('forums','topic', $topic->__get('tid'));
                $oMbqEtForumTopic->isSubscribed->setOriValue($isFollowing);
                $oMbqEtForumTopic->canSubscribe->setOriValue(true);
            }
            else
            {
                $oMbqEtForumTopic->isSubscribed->setOriValue(false);
                $oMbqEtForumTopic->canSubscribe->setOriValue(false);
            }
            $oMbqEtForumTopic->viewNumber->setOriValue($topic->__get('views'));
            $oMbqEtForumTopic->isMoved->setOriValue($topic->__get('moved_on') != 0);
            $oMbqEtForumTopic->realTopicId->setOriValue($topic->__get('moved_to'));
            if($prefix = $topic->prefix())
            {
                $oMbqEtForumTopic->prefixId->setOriValue($prefix);
                $oMbqEtForumTopic->prefixName->setOriValue($prefix);
            }


            //$oMbqEtForumTopic->canBan->setOriValue();
            if(isset($mbqOpt['oMbqEtForum']))
            {
                if(is_a($mbqOpt['oMbqEtForum'],'MbqEtForum'))
                {
                    $oMbqEtForumTopic->oMbqEtForum = $mbqOpt['oMbqEtForum'];
                }
                else
                {
                    $oMbqRdEtForum = MbqMain::$oClk->newObj('MbqRdEtForum');
                    $oMbqEtForumTopic->oMbqEtForum = $oMbqRdEtForum->initOMbqEtForum($oMbqEtForumTopic->forumId->oriValue, array('case' => 'byForumId'));
                }

            }

            if (
                  $oMbqEtForumTopic->oMbqEtForum->mbqBind->__get('password') // There is a password
                  and !\IPS\Member::loggedIn()->inGroup( explode( ',', $oMbqEtForumTopic->oMbqEtForum->mbqBind->__get('password_override') ) ) // We can't bypass it
                  and (
                      !isset( \IPS\Request::i()->cookie[ 'ipbforumpass_' . $oMbqEtForumTopic->oMbqEtForum->mbqBind->__get('id') ] )
                      or
                      !\IPS\Login::compareHashes( md5( $oMbqEtForumTopic->oMbqEtForum->mbqBind->__get('password') ), \IPS\Request::i()->cookie[ 'ipbforumpass_' . $oMbqEtForumTopic->oMbqEtForum->mbqBind->__get('id') ] )
                  ) // We don't have the correct password
              )
            {
                $oMbqEtForumTopic->topicTitle->setOriValue(\IPS\Member::loggedIn()->language()->get('no_perm_post_password'));
                $oMbqEtForumTopic->shortContent->setOriValue("");
                $oMbqEtForumTopic->topicContent->setOriValue("");
            }

            /* Minimum posts */
            elseif ( $oMbqEtForumTopic->oMbqEtForum->mbqBind->__get('min_posts_view') and $oMbqEtForumTopic->oMbqEtForum->mbqBind->__get('min_posts_view') >= \IPS\Member::loggedIn()->member_posts )
		    {
                $oMbqEtForumTopic->topicTitle->setOriValue(\IPS\Member::loggedIn()->language()->get('no_perm_post_min_posts'));
                $oMbqEtForumTopic->shortContent->setOriValue("");
                $oMbqEtForumTopic->topicContent->setOriValue("");
		    }

            $oMbqEtForumTopic->mbqBind = $topic;

            return $oMbqEtForumTopic;
        }
        elseif ($mbqOpt['case'] == 'byTopicId') {
            $objsMbqEtForumTopic = $this->getObjsMbqEtForumTopic($var, array('case' => 'byTopicIds'));
            if(is_array($objsMbqEtForumTopic) && sizeof($objsMbqEtForumTopic) == 1)
            {
                $objMbqEtForumTopic = $objsMbqEtForumTopic[0];
                $position = 0;
                if($objMbqEtForumTopic->mbqBind->unread() != 0)
                {
                    $position = $objMbqEtForumTopic->totalPostNum->oriValue;
                    try
                    {
                        $timeLastRead = $objMbqEtForumTopic->mbqBind->timeLastRead();
                        $unreadComments = $objMbqEtForumTopic->mbqBind->comments(10000, null, 'date', 'asc', null, null, $timeLastRead);
                        if($unreadComments != null)
                        {
                            $position = $position - sizeof($unreadComments) +1;
                        }
                    }
                    catch(\OutOfRangeException $ex)
                    {
                    }
                }
                else
                {
                    $position = $objMbqEtForumTopic->totalPostNum->oriValue;
                }
                $objMbqEtForumTopic->firstUnreadPosition->setOriValue($position);
                return $objMbqEtForumTopic;
            }
            return false;
        }
    }
    public function getUrl($oMbqEtForumTopic)
    {
        return (string)$oMbqEtForumTopic->mbqBind->url();
    }
}
