<?php

defined('MBQ_IN_IT') or exit;

MbqMain::$oClk->includeClass('MbqBaseRdEtForumPost');

/**
 * forum post read class
 */
Class MbqRdEtForumPost extends MbqBaseRdEtForumPost {

    public function __construct() {
    }

    public function makeProperty(&$oMbqEtForumPost, $pName, $mbqOpt = array()) {
        switch ($pName) {
            default:
            MbqError::alert('', __METHOD__ . ',line:' . __LINE__ . '.' . MBQ_ERR_INFO_UNKNOWN_PNAME . ':' . $pName . '.');
            break;
        }
    }
    /**
     * get forum post objs
     *
     * @param  Mixed  $var
     * @param  Array  $mbqOpt
     * $mbqOpt['case'] = 'byTopic' means get data by forum topic obj.$var is the forum topic obj.
     * $mbqOpt['case'] = 'byPostIds' means get data by post ids.$var is the ids.
     * $mbqOpt['case'] = 'byReplyUser' means get data by reply user.$var is the MbqEtUser obj.
     * @return  Mixed
     */
    public function getObjsMbqEtForumPost($var, $mbqOpt) {
        switch($mbqOpt['case'])
        {
            case 'byTopic':
                {

                    $oMbqEtForumTopic = $var;
                    $topic = $oMbqEtForumTopic->mbqBind;
                    $oMbqDataPage = $mbqOpt['oMbqDataPage'];
                    $posts = $topic->comments($oMbqDataPage->numPerPage, $oMbqDataPage->startNum, 'date', 'asc', NULL, false);
                    $newMbqOpt['case'] = 'byRow';
                    $newMbqOpt['oMbqEtForum'] = $oMbqEtForumTopic->oMbqEtForum;
                    $newMbqOpt['oMbqEtForumTopic'] = $oMbqEtForumTopic;
                    $newMbqOpt['oMbqDataPage'] = $oMbqDataPage;
                    $newMbqOpt['oMbqEtUser'] = true;
                    $objsMbqEtForumPost = array();
                    foreach($posts as $post)
                    {
                        if($post != null)
                        {
                            $objsMbqEtForumPost[] = $this->initOMbqEtForumPost($post, $newMbqOpt);
                        }
                    }
                    /* common end */
                    if (isset($mbqOpt['oMbqDataPage'])) {
                        $oMbqDataPage = $mbqOpt['oMbqDataPage'];
                        $oMbqDataPage->datas = $objsMbqEtForumPost;
                        return $oMbqDataPage;
                    } else {
                        return $objsMbqEtForumPost;
                    }

                    break;
                }
            case 'byPostId':
                {
                    $id = $var;
                    $oMbqDataPage = $mbqOpt['oMbqDataPage'];

                    $requestedpost = \IPS\forums\Topic\Post::load($id);
                    $oMbqRdEtForumTopic = MbqMain::$oClk->newObj('MbqRdEtForumTopic');
                    $oMbqEtForumTopic = $oMbqRdEtForumTopic->initOMbqEtForumTopic($requestedpost->__get('topic_id'), array('case' => 'byTopicId'));
                    $topic = $oMbqEtForumTopic->mbqBind;

                    $select = \IPS\Db::i()->select( 'COUNT(*) as cnt', 'forums_posts', 'post_date <= ' . $requestedpost->__get('post_date') . ' AND topic_id = ' . $requestedpost->__get('topic_id'), NULL, NULL, NULL, NULL, NULL);
                    $positionInTopic = $select->first();
                    $page = $positionInTopic / $oMbqDataPage->numPerPage;
                    $offset = $page * $oMbqDataPage->perPage;
                    $posts = $topic->comments($oMbqDataPage->numPerPage,$offset, 'date', 'asc', NULL, false);
                    $newMbqOpt['case'] = 'byRow';
                    $newMbqOpt['oMbqEtForum'] = $oMbqEtForumTopic->oMbqEtForum;
                    $newMbqOpt['oMbqEtForumTopic'] = $oMbqEtForumTopic;
                    $newMbqOpt['oMbqDataPage'] = $oMbqDataPage;
                    $newMbqOpt['oMbqEtUser'] = true;
                    $objsMbqEtForumPost = array();
                    foreach($posts as $post)
                    {
                        $oMbqEtForumPost = $this->initOMbqEtForumPost($post, $newMbqOpt);
                        if($oMbqEtForumPost->postId->oriValue == $id)
                        {
                            $oMbqEtForumPost->position->setOriValue($positionInTopic);
                        }
                        $objsMbqEtForumPost[] = $oMbqEtForumPost;

                    }
                    /* common end */
                    if (isset($mbqOpt['oMbqDataPage'])) {
                        $oMbqDataPage = $mbqOpt['oMbqDataPage'];
                        $oMbqDataPage->datas = $objsMbqEtForumPost;
                        return $oMbqDataPage;
                    } else {
                        return $objsMbqEtForumPost;
                    }

                    break;
                }
            case 'byPostIds':
                {
                    $arrPids = explode(',', $var);
                    $arrPids = is_array($arrPids) ? $arrPids : array($arrPids);
                    $objsMbqEtForumPost = array();
                    $oMbqRdEtForumPost = MbqMain::$oClk->newObj('MbqRdEtForumPost');
                    foreach ($arrPids as $pid) {
                        $objsMbqEtForumPost[] = $oMbqRdEtForumPost->initOMbqEtForumPost($pid, array('case' => 'byPostId'));
                    }
                    return $objsMbqEtForumPost;


                    break;
                }
            case 'byReplyUser':
                {
                    $oMbqDataPage = $mbqOpt['oMbqDataPage'];
                    $oMbqEtUser = $var;
                    $where = array();
                    $hiddenWhere = mobiquo_hide_forum_topicWhere();
                    if($hiddenWhere != null)
                    {
                            $where[] = $hiddenWhere;
                    }
                    $where[] = array("forums_posts.author_id = ?",$oMbqEtUser->userId->oriValue);
                    $joinComments = TRUE;

                    $totalNum = \IPS\forums\Topic\Post::getItemsWithPermission($where, 'last_real_post desc',
                                    array($oMbqDataPage->startNum, $oMbqDataPage->lastNum+1), 'view', false, 0,NULL, FALSE, $joinComments, FALSE, TRUE);
                    $it = \IPS\forums\Topic\Post::getItemsWithPermission($where, 'last_real_post desc',
                                    array($oMbqDataPage->startNum, $oMbqDataPage->lastNum+1), 'view', false, 0,NULL, FALSE, $joinComments);
                    $searchResults = iterator_to_array( $it );


                    $oMbqRdEtForumPost = MbqMain::$oClk->newObj('MbqRdEtForumPost');
                    $newMbqOpt['case'] = 'byRow';
                    $newMbqOpt['oMbqEtForum'] = true;
                    $newMbqOpt['oMbqEtForumTopic'] = true;
                    $newMbqOpt['oMbqEtUser'] = true;
                    $newMbqOpt['oMbqDataPage'] = $oMbqDataPage;
                    $newMbqOpt['oMbqEtForumTopic'] = true;
                    $newMbqOpt['oMbqEtUser'] = true;
                    foreach($searchResults as $item)
                    {
                        $oMbqDataPage->datas[] = $oMbqRdEtForumPost->initOMbqEtForumPost($item, $newMbqOpt);
                    }
                    $oMbqDataPage->totalNum = $totalNum;
                    return $oMbqDataPage;
                }
            case 'awaitingModeration':
                {
                    $oMbqDataPage = $mbqOpt['oMbqDataPage'];

                    $totalNum = 0;
                    $objsMbqEtForumPosts= array();
                    $where = array();
                    $hiddenWhere = mobiquo_hide_forum_topicWhere();
                    if($hiddenWhere != null)
                    {
                            $where[] = $hiddenWhere;
                        }
                    $totalNum = \IPS\forums\Topic\Post::getItemsWithPermission(array_merge(array(array('forums_posts.queued=?', 1)), $where) , 'forums_topics.pinned DESC, last_real_post desc', null, 'view', false, 0, false, false, false, true);
                    $it = \IPS\forums\Topic\Post::getItemsWithPermission(array_merge(array(array('forums_posts.queued=?', 1)), $where) , 'forums_topics.pinned DESC, last_real_post desc', array($oMbqDataPage->startNum, $oMbqDataPage->lastNum+1 ), 'view');
		            $rows = iterator_to_array( $it );

		             foreach($rows as $row)
                    {
                        $objsMbqEtForumPosts[] = $this->initOMbqEtForumPost($row, array('case' => 'byRow', 'oMbqEtUser' => true));
                    }
                   if (isset($mbqOpt['oMbqDataPage'])) {
                        $oMbqDataPage = $mbqOpt['oMbqDataPage'];
                        $oMbqDataPage->totalNum = $totalNum;
                        $oMbqDataPage->datas = $objsMbqEtForumPosts;
                        return $oMbqDataPage;
                    } else {
                        return $objsMbqEtForumPosts;
                    }
                }
            case 'deleted':
                {
                    $oMbqDataPage = $mbqOpt['oMbqDataPage'];

                    $totalNum = 0;
                    $objsMbqEtForumPosts= array();
                    $where = array();
                    $hiddenWhere = mobiquo_hide_forum_topicWhere();
                    if($hiddenWhere != null)
                    {
                            $where[] = $hiddenWhere;
                        }
                    $totalNum = \IPS\forums\Topic\Post::getItemsWithPermission(array_merge(array(array('forums_posts.queued=?', "-1")), $where) , 'forums_topics.pinned DESC, last_real_post desc', null, 'view', false, 0, false, false, false, true);
		            $it = \IPS\forums\Topic\Post::getItemsWithPermission(array_merge(array(array('forums_posts.queued=?', "-1")), $where) , 'forums_topics.pinned DESC, last_real_post desc', array($oMbqDataPage->startNum, $oMbqDataPage->lastNum+1 ), 'view');
		            $rows = iterator_to_array( $it );

                    foreach($rows as $row)
                    {
                        $objsMbqEtForumPosts[] = $this->initOMbqEtForumPost($row, array('case' => 'byRow', 'oMbqEtUser' => true));
                    }
                   if (isset($mbqOpt['oMbqDataPage'])) {
                        $oMbqDataPage = $mbqOpt['oMbqDataPage'];
                        $oMbqDataPage->totalNum = $totalNum;
                        $oMbqDataPage->datas = $objsMbqEtForumPosts;
                        return $oMbqDataPage;
                    } else {
                        return $objsMbqEtForumPosts;
                    }
                }
            case 'reported':
                {
                    $oMbqDataPage = $mbqOpt['oMbqDataPage'];

                    $totalNum = 0;
                    $objsMbqEtForumPosts= array();
                    $where = array();
                    $hiddenWhere = mobiquo_hide_forum_topicWhere();
                    if($hiddenWhere != null)
                    {
                            $where[] = $hiddenWhere;
                    }
                    $where = '( perm_id IN (?) OR perm_id IS NULL )';
                    $table = new \IPS\Helpers\Table\Content( '\IPS\core\Reports\Report', \IPS\Http\Url::internal( 'app=core&module=modcp&controller=modcp&tab=reports', NULL, 'modcp_reports' ), array( array( $where, \IPS\Db::i()->select( 'perm_id', 'core_permission_index', \IPS\Db::i()->findInSet( 'perm_view', array_merge( array( \IPS\Member::loggedIn()->member_group_id ), array_filter( explode( ',', \IPS\Member::loggedIn()->mgroup_others ) ) ) ) . " OR perm_view='*'" ) ) ) );
                    $table->sortBy = 'first_report_date';
                    $table->sortDirection = 'desc';
                    $table->limit = $oMbqDataPage->numPerPage;
                    $table->page = $oMbqDataPage->curPage;
                    $table->filters = array( 'report_status_1' => array( 'status=1' ), 'report_status_2' => array( 'status=2' ), 'report_status_3' => array( 'status=3' ) );
                    $posts = $table->getRows(array());
                    foreach($posts as $post)
                    {
                        $oMbqDataPage->datas[] = $this->initOMbqEtForumPost($post->__get('content_id'), array('case' => 'byPostId', 'oMbqEtForum' => true));
                    }
                    $oMbqDataPage->totalNum = $table->count;
                    return $oMbqDataPage;
                }
            //case 'byObjs':
            //    {
            //        $postList = $var;
            //        $objsMbqEtForumPost = array();
            //        $authorUserIds = array();
            //        $forumIds = array();
            //        $topicIds = array();
            //        foreach ($postList
            //            as $postNode) {
            //                $objsMbqEtForumPost[] = $postNode;
            //            }
            //        foreach ($objsMbqEtForumPost as $oMbqEtForumPost) {
            //            $authorUserIds[$oMbqEtForumPost->postAuthorId->oriValue] = $oMbqEtForumPost->postAuthorId->oriValue;
            //            $forumIds[$oMbqEtForumPost->forumId->oriValue] = $oMbqEtForumPost->forumId->oriValue;
            //            $topicIds[$oMbqEtForumPost->topicId->oriValue] = $oMbqEtForumPost->topicId->oriValue;
            //        }
            //        /* load oMbqEtForum property */
            //        $oMbqRdEtForum = MbqMain::$oClk->newObj('MbqRdEtForum');
            //        $objsMbqEtForum = $oMbqRdEtForum->getObjsMbqEtForum($forumIds, array('case' => 'byForumIds'));
            //        foreach ($objsMbqEtForum as $oNewMbqEtForum) {
            //            foreach ($objsMbqEtForumPost as &$oMbqEtForumPost) {
            //                if ($oNewMbqEtForum->forumId->oriValue == $oMbqEtForumPost->forumId->oriValue) {
            //                    $oMbqEtForumPost->oMbqEtForum = $oNewMbqEtForum;
            //                }
            //            }
            //        }
            //        /* load oMbqEtForumTopic property */
            //        $oMbqRdEtForumTopic = MbqMain::$oClk->newObj('MbqRdEtForumTopic');
            //        $objsMbqEtFroumTopic = $oMbqRdEtForumTopic->getObjsMbqEtForumTopic($topicIds, array('case' => 'byTopicIds', 'oFirstMbqEtForumPost' => false));  /* must set 'oFirstMbqEtForumPost' to false,otherwise will cause infinite recursion call for get oMbqEtForumTopic and oFirstMbqEtForumPost and make memory depleted!!! */
            //        foreach ($objsMbqEtFroumTopic as $oNewMbqEtFroumTopic) {
            //            foreach ($objsMbqEtForumPost as &$oMbqEtForumPost) {
            //                if ($oNewMbqEtFroumTopic->topicId->oriValue == $oMbqEtForumPost->topicId->oriValue) {
            //                    $oMbqEtForumPost->oMbqEtForumTopic = $oNewMbqEtFroumTopic;
            //                }
            //            }
            //        }
            //        /* load post author */
            //        $oMbqRdEtUser = MbqMain::$oClk->newObj('MbqRdEtUser');
            //        $objsAuthorMbqEtUser = $oMbqRdEtUser->getObjsMbqEtUser($authorUserIds, array('case' => 'byUserIds'));
            //        $postIds = array();
            //        foreach ($objsMbqEtForumPost as &$oMbqEtForumPost) {
            //            $postIds[] = $oMbqEtForumPost->postId->oriValue;
            //            foreach ($objsAuthorMbqEtUser as $oAuthorMbqEtUser) {
            //                if ($oMbqEtForumPost->postAuthorId->oriValue == $oAuthorMbqEtUser->userId->oriValue) {
            //                    $oMbqEtForumPost->oAuthorMbqEtUser = $oAuthorMbqEtUser;
            //                    break;
            //                }
            //            }
            //        }
            //        ///* load attachment */
            //        //$oMbqRdEtAtt = MbqMain::$oClk->newObj('MbqRdEtAtt');
            //        //$objsMbqEtAtt = $oMbqRdEtAtt->getObjsMbqEtAtt($postIds, array('case' => 'byForumPostIds'));
            //        //foreach ($objsMbqEtAtt as $oMbqEtAtt) {
            //        //    foreach ($objsMbqEtForumPost as &$oMbqEtForumPost) {
            //        //        if ($oMbqEtAtt->isForumPostAtt() && ($oMbqEtAtt->postId->oriValue == $oMbqEtForumPost->postId->oriValue)) {
            //        //            $oMbqEtForumPost->objsMbqEtAtt[] = $oMbqEtAtt;
            //        //            break;
            //        //        }
            //        //    }
            //        //}
            //        ///* load objsNotInContentMbqEtAtt */
            //        //foreach ($objsMbqEtForumPost as &$oMbqEtForumPost) {
            //        //    $this->makeProperty($oMbqEtForumPost, 'objsNotInContentMbqEtAtt');
            //        //}
            //        //foreach ($objsMbqEtForumPost as &$oMbqEtForumPost) {
            //        //    $this->makeProperty($oMbqEtForumPost, 'byOAuthorMbqEtUser');
            //        //}
            //        ///* load objsMbqEtThank property and make related properties/flags */
            //        //$oMbqRdEtThank = MbqMain::$oClk->newObj('MbqRdEtThank');
            //        //$objsMbqEtThank = $oMbqRdEtThank->getObjsMbqEtThank($postIds, array('case' => 'byForumPostIds'));
            //        //foreach ($objsMbqEtThank as $oMbqEtThank) {
            //        //    foreach ($objsMbqEtForumPost as &$oMbqEtForumPost) {
            //        //        if ($oMbqEtThank->key->oriValue == $oMbqEtForumPost->postId->oriValue) {
            //        //            $oMbqEtForumPost->objsMbqEtThank[] = $oMbqEtThank;
            //        //            break;
            //        //        }
            //        //    }
            //        //}
            //        //foreach ($objsMbqEtForumPost as &$oMbqEtForumPost) {
            //        //    $oMbqEtForumPost->thankCount->setOriValue(count($oMbqEtForumPost->objsMbqEtThank));
            //        //    $isThankedByMe = false;
            //        //    if (MbqMain::hasLogin()) {
            //        //        foreach ($oMbqEtForumPost->objsMbqEtThank as $oMbqEtThank) {
            //        //            if ($oMbqEtThank->userId->oriValue == MbqMain::$oCurMbqEtUser->userId->oriValue) {
            //        //                $isThankedByMe = true;
            //        //            }
            //        //        }
            //        //    }
            //        //    if ($oMbqEtForumPost->mbqBind['oKunenaForumMessage']->authorise('thankyou') && !$isThankedByMe) {
            //        //        $oMbqEtForumPost->canThank->setOriValue(MbqBaseFdt::getFdt('MbqFdtForum.MbqEtForumPost.canThank.range.yes'));
            //        //    } else {
            //        //        $oMbqEtForumPost->canThank->setOriValue(MbqBaseFdt::getFdt('MbqFdtForum.MbqEtForumPost.canThank.range.no'));
            //        //    }
            //        //}
            //        /* common end */
            //        if ($mbqOpt['oMbqDataPage'] != null) {
            //            $oMbqDataPage = $mbqOpt['oMbqDataPage'];
            //            $oMbqDataPage->datas = $objsMbqEtForumPost;
            //            return $oMbqDataPage;
            //        } else {
            //            return $objsMbqEtForumPost;
            //        }
            //        break;
            //    }
        }
    }
    /**
     * init one forum post by condition
     *
     * @param  Mixed  $var
     * @param  Array  $mbqOpt
     * $mbqOpt['case'] = 'byObj' means init forum post by obj from viewtopic.php page
     * $mbqOpt['case'] = 'byPostId' means init forum post by post id
     * $mbqOpt['withAuthor'] = true means load post author,default is true
     * $mbqOpt['withAtt'] = true means load post attachments,default is true
     * $mbqOpt['withObjsNotInContentMbqEtAtt'] = true means load the attachement objs not in the content,default is true
     * $mbqOpt['oMbqEtForum'] = true means load oMbqEtForum property of this post,default is true
     * $mbqOpt['oMbqEtForumTopic'] = true means load oMbqEtForumTopic property of this post,default is true
     * $mbqOpt['objsMbqEtThank'] = true means load objsMbqEtThank property of this post,default is true
     * @return  Mixed
     */
    public function initOMbqEtForumPost($var, $mbqOpt) {
        if($mbqOpt['case'] == 'byPostId') {
            $id = $var;
            try
            {
                $requestedpost = \IPS\forums\Topic\Post::load($id);
            }
            catch(Exception $ex)
            {
                return null;
            }
            if($requestedpost == null)
            {
                return null;
            }
            $oMbqRdEtForumTopic = MbqMain::$oClk->newObj('MbqRdEtForumTopic');
            $oMbqEtForumTopic = $oMbqRdEtForumTopic->initOMbqEtForumTopic($requestedpost->__get('topic_id'), array('case' => 'byTopicId'));
            $mbqOpt['oMbqEtForum'] = $oMbqEtForumTopic->oMbqEtForum;
            $mbqOpt['oMbqEtForumTopic'] = $oMbqEtForumTopic;
            $select = \IPS\Db::i()->select( 'COUNT(*) as cnt', 'forums_posts', 'post_date <= ' . $requestedpost->__get('post_date') . ' AND topic_id = ' . $requestedpost->__get('topic_id'), NULL, NULL, NULL, NULL, NULL);
            $positionInTopic = $select->first();
            $newMbqOpt['case'] = 'byRow';
            $newMbqOpt['oMbqEtForum'] = $oMbqEtForumTopic->oMbqEtForum;
            $newMbqOpt['oMbqEtForumTopic'] = $oMbqEtForumTopic;
            $newMbqOpt['oMbqEtUser'] = true;
            $oMbqEtForumPost = $this->initOMbqEtForumPost($requestedpost, $newMbqOpt);
            $oMbqEtForumPost->position->setOriValue($positionInTopic);

            return $oMbqEtForumPost;
        }
        else if($mbqOpt['case'] == 'byRow') {

            $post = $var;
            $oMbqEtForumPost = MbqMain::$oClk->newObj('MbqEtForumPost');
            $oMbqEtForumPost->oMbqEtForumTopic = $mbqOpt['oMbqEtForumTopic'];
            $oMbqEtForumPost->oMbqEtForum = $mbqOpt['oMbqEtForum'];

            if($oMbqEtForumPost->oMbqEtForumTopic === true)
            {
                $oMbqRdEtForumTopic = MbqMain::$oClk->newObj('MbqRdEtForumTopic');
                $oMbqEtForumPost->oMbqEtForumTopic = $oMbqRdEtForumTopic->initOMbqEtForumTopic($post->__get('topic_id'), array('case' => 'byTopicId'));
                $oMbqEtForumPost->oMbqEtForum =  $oMbqEtForumPost->oMbqEtForumTopic->oMbqEtForum;
            }

            $forumId = $oMbqEtForumPost->oMbqEtForum->forumId->oriValue;
            $topicId = $oMbqEtForumPost->oMbqEtForumTopic->topicId->oriValue;

            $oMbqEtForumPost->postId->setOriValue($post->__get('pid'));
            $oMbqEtForumPost->forumId->setOriValue($forumId);
            $oMbqEtForumPost->topicId->setOriValue($topicId);
            $oMbqEtForumPost->postTitle->setOriValue('');
            $postContent = $post->__get('post');
            $oMbqEtForumPost->postContent->setOriValue($postContent);
            $postContentBBCode = TT_convertToTapatalkBBCode($postContent);
            if(MbqCM::checkIfUserIsIgnored($post->__get('author_id')))
            {
                $postContentBBCode = '[spoiler]'. $postContentBBCode. '[/spoiler]';
            }
            $oMbqEtForumPost->postContent->setAppDisplayValue($postContentBBCode);
            $oMbqEtForumPost->postContent->setTmlDisplayValue($postContentBBCode);
            $oMbqEtForumPost->postContent->setTmlDisplayValueNoHtml($postContentBBCode);

            $oMbqEtForumPost->shortContent->setOriValue(TT_process_short_content($postContent));
            $oMbqEtForumPost->postAuthorId->setOriValue($post->__get('author_id'));
            $oMbqEtForumPost->postTime->setOriValue(mobiquo_format_date($post->__get('post_date')));
            //$oMbqEtForumPost->allowSmilies->setOriValue(false);
            $oMbqEtForumPost->canEdit->setOriValue($post->canEdit());
            $oMbqEtForumPost->canAddEditReason->setOriValue($post->canEdit() && MbqMain::isActiveMember());
            //$oMbqEtForumPost->canThank->setOriValue($row['bind']['can_thank']);
            //$oMbqEtForumPost->thankCount->setOriValue($row['bind']['post_author_id']);
            $oMbqEtForumPost->canLike->setOriValue(($post->canReact() && !$post->reacted()) && MbqMain::isActiveMember() && \IPS\Settings::i()->reputation_enabled);
            $oMbqEtForumPost->isLiked->setOriValue($post->reacted() !== FALSE);
            $oMbqEtForumPost->canUnlike->setOriValue(($post->canReact() && $post->reacted()) && MbqMain::isActiveMember());
            $oMbqEtForumPost->likeCount->setOriValue($post->reactionCount());
            //$oMbqEtForumPost->isThanked->setOriValue(isset($row['bind']['thanks_info']));
            $oMbqEtForumPost->isDeleted->setOriValue($post->__get('pdelete_time') != 0);
            $oMbqEtForumPost->canDelete->setOriValue($post->canDelete() && MbqMain::isActiveMember());
            //$oMbqEtForumPost->isApproved->setOriValue($row['bind']['post_visibility'] == ITEM_APPROVED);
            //$oMbqEtForumPost->canApprove->setOriValue($auth->acl_get('m_approve', $forum_id) && !$oMbqEtForumPost->isApproved->oriValue);
            //$oMbqEtForumPost->canMove->setOriValue($auth->acl_get('m_split', $forum_id));
            $oMbqEtForumPost->canReport->setOriValue($post->canReport() && MbqMain::isActiveMember());
            //$oMbqEtForumPost->modByUserId->setOriValue($var['post_author_id']);
            //$oMbqEtForumPost->deleteByUserId->setOriValue($var['post_author_id']);
            //$oMbqEtForumPost->deleteReason->setOriValue($var['post_author_id']);
            //$oMbqEtForumPost->authorIconUrl->setOriValue($row['POSTER_AVATAR']);
             //$oMbqEtForumPost->canUnthank->setOriValue($var['post_author_id']);
            //if(!empty($row['EDITER_UID']) && $config['display_last_edited'])
            //{
            //    $oMbqEtForumPost->modByUserId->setOriValue($row['EDITER_UID']);
            //}
            $attachmentIds = $post->attachmentIds();
            $oMbqRdAtt = MbqMain::$oClk->newObj('MbqRdEtAtt');
            $attachments = $oMbqRdAtt->getObjsMbqEtAtt($attachmentIds, array('case' => 'byAttachentIds', 'location' => 'forums_Forums'));
            foreach($attachments as $attachment)
            {
                $attachment->forumId->setOriValue($forumId);
                $attachment->postId->setOriValue($post->__get('pid'));
                if(stripos($postContentBBCode,$attachment->url->oriValue) == false)
                {
                    $oMbqEtForumPost->objsNotInContentMbqEtAtt[] = $attachment;
                }
                else
                {
                    $oMbqEtForumPost->objsMbqEtAtt[] = $attachment;
                }
            }
            $oMbqRdEtUser = MbqMain::$oClk->newObj('MbqRdEtUser');
            if($mbqOpt['oMbqEtUser'])
            {
                if($oAuthorMbqEtUser = $oMbqRdEtUser->initOMbqEtUser($oMbqEtForumPost->postAuthorId->oriValue, array('case' => 'byUserId')))
                {
                    $oMbqEtForumPost->oAuthorMbqEtUser = $oAuthorMbqEtUser;
                    $oMbqEtForumPost->isOnline->setOriValue($oMbqEtForumPost->oAuthorMbqEtUser->isOnline->oriValue);
                }
            }
            if(\IPS\Member::loggedIn()->group['gbw_view_reps'] && $post->canView())
            {
                $reputationTable = $post->reactionTable();
                $likes = $reputationTable->getRows(array());

                foreach($likes as $like)
                {
                    if(isset($like['rep_rating']) && $like['rep_rating'] == 1)
                    {
                        $oMbqEtLike = MbqMain::$oClk->newObj('MbqEtLike');

                        $oMbqEtLike->key->setOriValue($oMbqEtForumPost->postId->oriValue);
                        $oMbqEtLike->userId->setOriValue($like['member_id']);
                        $oMbqEtLike->type->setOriValue('post');
                        $oMbqEtLike->postTime->setOriValue($like['rep_date']);
                        if($oLikeEtUser = $oMbqRdEtUser->initOMbqEtUser($like['member_id'], array('case' => 'byUserId')))
                        {
                            $oMbqEtLike->oMbqEtUser = $oLikeEtUser;
                        }
                        $oMbqEtLike->mbqBind = $like;
                        $oMbqEtForumPost->objsMbqEtLike[] = $oMbqEtLike;
                    }
                }
            }
            $oMbqEtForumPost->mbqBind = $post;
            return $oMbqEtForumPost;
        }

    }
    /**
     * return raw post content
     *
     * @return  String
     */
    public function getRawPostContent($oMbqEtForumPost) {
        $postContentForEdit = $oMbqEtForumPost->postContent->appDisplayValue;
        $postContentForEdit = str_replace('<br>', PHP_EOL, $postContentForEdit);
        $postContentForEdit = str_replace('<br/>',PHP_EOL, $postContentForEdit);
        $postContentForEdit = str_replace('<br />',PHP_EOL, $postContentForEdit);
        return $postContentForEdit;
    }
     /**
     * return raw post content
     *
     * @return  String
     */
    public function getRawPostContentOriginal($oMbqEtForumPost) {
        $postContentForEdit = $oMbqEtForumPost->postContent->oriValue;
        return $postContentForEdit;
    }

    /**
     * return raw post content
     *
     * @return  String
     */
    public function getQuotePostContent($oMbqEtForumPost)
    {
        $quotedContent = TT_deleteDeeplevelsQuotedContents(TT_convertToTapatalkBBCode($oMbqEtForumPost->postContent->oriValue));
        $quotedContent = str_replace('<br>', PHP_EOL, $quotedContent);
        $quotedContent = str_replace('<br/>',PHP_EOL, $quotedContent);
        $quotedContent = str_replace('<br />',PHP_EOL, $quotedContent);
        $quote = '[quote post="' . $oMbqEtForumPost->postId->oriValue . '" timestamp="' . $oMbqEtForumPost->postTime->oriValue .'" name="' . $oMbqEtForumPost->oAuthorMbqEtUser->userName->oriValue . '" userid="' . $oMbqEtForumPost->oAuthorMbqEtUser->userId->oriValue . '"]' . $quotedContent . '[/quote]';
        /*$quote = '<blockquote class="ipsQuote" data-ipsquote-username="' . $oMbqEtForumPost->oAuthorMbqEtUser->userName->oriValue . '" '
            . ' data-ipsquote-userid="' . $oMbqEtForumPost->oAuthorMbqEtUser->userId->oriValue . '" '
            . ' data-ipsquote-timestamp="' . $oMbqEtForumPost->postTime->oriValue . '" '
            . ' data-ipsquote-contentid="' . $oMbqEtForumPost->topicId->oriValue . '" '
            . ' data-ipsquote-contentcommentid="' . $oMbqEtForumPost->postId->oriValue . '" '
            . ' data-ipsquote-contenttype="forums" data-ipsquote-contentclass="forums_Topic"'
            . '>'
            . $oMbqEtForumPost->postContent->oriValue . "</blockquote>";*/
        return $quote;
    }
    public function getUrl($oMbqEtForumPost)
    {
        return (string)$oMbqEtForumPost->mbqBind->url();
    }
}
