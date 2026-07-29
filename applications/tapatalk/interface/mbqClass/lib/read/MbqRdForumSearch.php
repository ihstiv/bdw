<?php

defined('MBQ_IN_IT') or exit;

MbqMain::$oClk->includeClass('MbqBaseRdForumSearch');

/**
 * forum search class
 */
Class MbqRdForumSearch extends MbqBaseRdForumSearch {

    const USEFAKECOUNT = false;

    public function __construct() {
    }
    /**
     * forum advanced search
     *
     * @param  Array  $filter  search filter
     * @param  Object  $oMbqDataPage
     * @param  Array  $mbqOpt
     * $mbqOpt['case'] = 'advanced' means advanced search
     * $mbqOpt['participated'] = true means get participated data
     * $mbqOpt['unread'] = true means get unread data
     * @return  Object  $oMbqDataPage
     */
    public function forumAdvancedSearch($filter, $oMbqDataPage, $mbqOpt) {
        if ($mbqOpt['case'] == 'getLatestTopic') {
            $oMbqDataPage = MbqMain::$oClk->newObj('MbqDataPage');
            $oMbqDataPage->initByPageAndPerPage($filter['page'], $filter['perpage']);

            $oMbqRdEtForumTopic = MbqMain::$oClk->newObj('MbqRdEtForumTopic');

            $objsMbqEtForumTopics = array();

            $flags = \IPS\Content\Search\Query::TERM_OR_TAGS;
            $query = \IPS\Content\Search\Query::init();
            $query->setLimit($oMbqDataPage->numPerPage);
            $query->setPage($oMbqDataPage->curPage);
            $query->setOrder(\IPS\Content\Search\Query::ORDER_NEWEST_CREATED);
            $excludeForums = mobiquo_hide_forum_array();
            $contentFilter = \IPS\Content\Search\ContentFilter::init('\IPS\forums\Topic');
            if(!empty($excludeForums)){
                $contentFilter->excludeInContainers($excludeForums);
            }
            $contentFilter->onlyLastComment();
            $filters[] = $contentFilter;
            $query->filterByContent( $filters, TRUE );
            $results = $query->search(
			    NULL,
			    NULL,
			    $flags + \IPS\Content\Search\Query::TAGS_MATCH_ITEMS_ONLY
		    );
            if(self::USEFAKECOUNT){
                $count = ($oMbqDataPage->numPerPage * $oMbqDataPage->curPage) +1;
            }
            else
            {
                $count = $results->count( TRUE );
            }
            $rows = $results->getArrayCopy();

            foreach($rows as $row)
            {
                $objsMbqEtForumTopics[] = $oMbqRdEtForumTopic->initOMbqEtForumTopic($row['index_item_id'], array('case' => 'byTopicId', 'oMbqEtUser' => true, 'oMbqEtForum' => true));
            }
            $oMbqDataPage->totalNum = $count;
            $oMbqDataPage->datas = $objsMbqEtForumTopics;

            return $oMbqDataPage;
        }
        elseif ($mbqOpt['case'] == 'getUnreadTopic')
        {
            $oMbqDataPage = MbqMain::$oClk->newObj('MbqDataPage');
            $oMbqDataPage->initByPageAndPerPage($filter['page'], $filter['perpage']);

            $oMbqRdEtForumTopic = MbqMain::$oClk->newObj('MbqRdEtForumTopic');

            $objsMbqEtForumTopics = array();

            $flags = \IPS\Content\Search\Query::TERM_OR_TAGS;
            $query = \IPS\Content\Search\Query::init();
            $query->setLimit($oMbqDataPage->numPerPage);
            $query->setPage($oMbqDataPage->curPage);
            $query->setOrder(\IPS\Content\Search\Query::ORDER_NEWEST_CREATED);
            $excludeForums = mobiquo_hide_forum_array();
            $contentFilter = \IPS\Content\Search\ContentFilter::init('\IPS\forums\Topic');
            if(!empty($excludeForums)){
                $contentFilter->excludeInContainers($excludeForums);
            }
            $contentFilter->onlyLastComment();
            $filters[] = $contentFilter;
            $query->filterByUnread();
            $query->filterByContent( $filters, TRUE );
            $results = $query->search(
			    NULL,
			    NULL,
			    $flags + \IPS\Content\Search\Query::TAGS_MATCH_ITEMS_ONLY
		    );
            if(self::USEFAKECOUNT){
                $count = ($oMbqDataPage->numPerPage * $oMbqDataPage->curPage) +1;
            }
            else
            {
                $count = $results->count( TRUE );
            }
            $rows = $results->getArrayCopy();

            foreach($rows as $row)
            {
                $objsMbqEtForumTopics[] = $oMbqRdEtForumTopic->initOMbqEtForumTopic($row['index_item_id'], array('case' => 'byTopicId', 'oMbqEtUser' => true, 'oMbqEtForum' => true));
            }
            $oMbqDataPage->totalNum = $count;
            $oMbqDataPage->datas = $objsMbqEtForumTopics;

            return $oMbqDataPage;
        }
        elseif ($mbqOpt['case'] == 'getParticipatedTopic')
        {
            $oMbqDataPage = MbqMain::$oClk->newObj('MbqDataPage');
            $oMbqDataPage->initByPageAndPerPage($filter['page'], $filter['perpage']);

            $oMbqRdEtForumTopic = MbqMain::$oClk->newObj('MbqRdEtForumTopic');

            $topic_list = array();
            $topic_num = 0;
            $objsMbqEtForumTopics = array();
            $joinComments = FALSE;
            $where = array();
            if (isset($filter['userid']) && $filter['userid']) {
                $where[] = array('forums_posts.author_id=?',$filter['userid']);
                $joinComments = TRUE;

            } else if (isset($filter['searchuser']) && $filter['searchuser']) {
                //   $request->overwrite('author', $filter['searchuser']);
            } else {
                $where[] = array('forums_posts.author_id=?',\IPS\Member::loggedIn()->member_id);
                $joinComments = TRUE;
            }
            $hiddenWhere = mobiquo_hide_forum_topicWhere();
            if($hiddenWhere != null)
            {
                $where[] = $hiddenWhere;
            }
            $topic_num = \IPS\forums\Topic::getItemsWithPermission($where, 'last_real_post desc', null, 'view', false, 0 ,NULL, FALSE, $joinComments, FALSE, TRUE);
            $it = \IPS\forums\Topic::getItemsWithPermission($where, 'last_real_post desc', array($oMbqDataPage->startNum, $oMbqDataPage->numPerPage ), 'view', false, 0, NULL, FALSE, $joinComments, FALSE, FALSE, NULL );
            $rows = iterator_to_array( $it );

            /* Pull in extra data */
            \IPS\forums\Topic::tableGetRows( $rows );
            foreach($rows as $row)
            {
                $objsMbqEtForumTopics[] = $oMbqRdEtForumTopic->initOMbqEtForumTopic($row, array('case' => 'byRow', 'oMbqEtUser' => true, 'oMbqEtForum' => true));
            }
            $oMbqDataPage->totalNum = $topic_num;
            $oMbqDataPage->datas = $objsMbqEtForumTopics;
            return $oMbqDataPage;
        }
        elseif ($mbqOpt['case'] == 'getSubscribedTopic')
        {

            $oMbqDataPage = MbqMain::$oClk->newObj('MbqDataPage');
            $oMbqDataPage->initByPageAndPerPage($filter['page'], $filter['perpage']);

            $oMbqRdEtForumTopic = MbqMain::$oClk->newObj('MbqRdEtForumTopic');
            $objsMbqEtForumTopics = array();

            $it = new \IPS\core\Followed\Table( "IPS\\forums\\Topic", explode( '_', "forums_topic" ) );
            $topic_num = $it->count( TRUE );
            $rows = $it->getRows();
            foreach($rows as $row)
            {
                $objsMbqEtForumTopics[] = $oMbqRdEtForumTopic->initOMbqEtForumTopic($row, array('case' => 'byRow', 'oMbqEtUser' => true, 'oMbqEtForum' => true));
            }
            $oMbqDataPage->totalNum = $topic_num;
            $oMbqDataPage->datas = $objsMbqEtForumTopics;
            return $oMbqDataPage;
        }
        elseif ($mbqOpt['case'] == 'searchTopic')
        {
            $oMbqDataPage = MbqMain::$oClk->newObj('MbqDataPage');
            $oMbqDataPage->initByPageAndPerPage($filter['page'], $filter['perpage']);

            $keywords = $filter['keywords'];
            $keywords = str_replace('"','',$keywords);

                     $oMbqRdEtForumTopic = MbqMain::$oClk->newObj('MbqRdEtForumTopic');
            $objsMbqEtForumTopics = array();
            $flags = \IPS\Content\Search\Query::TERM_OR_TAGS;
            $query = \IPS\Content\Search\Query::init();
            $query->setLimit($oMbqDataPage->numPerPage);
            $query->setPage($oMbqDataPage->curPage);
            $query->setOrder(\IPS\Content\Search\Query::ORDER_NEWEST_CREATED);
            $excludeForums = mobiquo_hide_forum_array();
            $contentFilter = \IPS\Content\Search\ContentFilter::init('\IPS\forums\Topic');
            if(!empty($excludeForums)){
                $contentFilter->excludeInContainers($excludeForums);
            }
            $contentFilter->onlyLastComment();
            $filters[] = $contentFilter;
            $query->filterByContent( $filters, TRUE );
            $results = $query->search(
			    $keywords,
			    NULL,
			    $flags + \IPS\Content\Search\Query::TAGS_MATCH_ITEMS_ONLY
		    );
            if(self::USEFAKECOUNT){
                $count = ($oMbqDataPage->numPerPage * $oMbqDataPage->curPage) +1;
            }
            else
            {
                $count = $results->count( TRUE );
            }
            $rows = $results->getArrayCopy();

            foreach($rows as $row)
            {
                $objsMbqEtForumTopics[] = $oMbqRdEtForumTopic->initOMbqEtForumTopic($row['index_item_id'], array('case' => 'byTopicId', 'oMbqEtUser' => true, 'oMbqEtForum' => true));
            }
            $oMbqDataPage->totalNum = $count;
            $oMbqDataPage->datas = $objsMbqEtForumTopics;
            return $oMbqDataPage;
        } elseif ($mbqOpt['case'] == 'searchPost') {
            $oMbqDataPage = MbqMain::$oClk->newObj('MbqDataPage');
            $oMbqDataPage->initByPageAndPerPage($filter['page'], $filter['perpage']);

            $oMbqRdEtForumTopic = MbqMain::$oClk->newObj('MbqRdEtForumTopic');

            $topic_num = 0;
            $objsMbqEtForumPosts = array();
            $keywords = $filter['keywords'];
            $keywords = str_replace('"','',$keywords);
            
            $flags = \IPS\Content\Search\Query::TERM_OR_TAGS;
            $query = \IPS\Content\Search\Query::init();
            $query->setLimit($oMbqDataPage->numPerPage);
            $query->setPage($oMbqDataPage->curPage);
            $query->setOrder(\IPS\Content\Search\Query::ORDER_NEWEST_CREATED);
            $excludeForums = mobiquo_hide_forum_array();
            $contentFilter = \IPS\Content\Search\ContentFilter::init('\IPS\forums\Topic');
            if(!empty($excludeForums)){
                $contentFilter->excludeInContainers($excludeForums);
            }
            $filters[] = $contentFilter;
            $query->filterByContent( $filters, TRUE );
            $results = $query->search(
			    $keywords,
			    NULL,
			    $flags + \IPS\Content\Search\Query::TAGS_MATCH_ITEMS_ONLY
		    );
            if(self::USEFAKECOUNT){
                $count = ($oMbqDataPage->numPerPage * $oMbqDataPage->curPage) +1;
            }
            else
            {
                $count = $results->count( TRUE );
            }
            $rows = $results->getArrayCopy();

            $oMbqRdEtForumPost = MbqMain::$oClk->newObj('MbqRdEtForumPost');
            foreach($rows as $row)
            {
                $objsMbqEtForumPosts[] = $oMbqRdEtForumPost->initOMbqEtForumPost($row['index_object_id'], array('case' => 'byPostId', 'oMbqEtUser' => true, 'oMbqEtForum' => true));
            }
            $oMbqDataPage->totalNum = $count;
            $oMbqDataPage->datas = $objsMbqEtForumPosts;
            return $oMbqDataPage;
        } elseif ($mbqOpt['case'] == 'search') {

            //$filter->showPosts;
            //$filter->titleOnly;
            //$filter->userId;
            //$filter->searchUser;

            //$filter->searchId;
            //$filter->keywords;
            //$filter->searchUser;
            //$filter->userId;
            //$filter->forumId;
            //$filter->topicId;
            //$filter->searchTime;
            //$filter->onlyIn;
            //$filter->notIn;

            $oMbqRdEtForumTopic = MbqMain::$oClk->newObj('MbqRdEtForumTopic');
            $oMbqRdEtForumPost = MbqMain::$oClk->newObj('MbqRdEtForumPost');

            $objsMbqEtForumTopicsOrPosts = array();
            $flags = \IPS\Content\Search\Query::TERM_OR_TAGS;
            $query = \IPS\Content\Search\Query::init();
            $query->setLimit($oMbqDataPage->numPerPage);
            $query->setPage($oMbqDataPage->curPage);
            $query->setOrder(\IPS\Content\Search\Query::ORDER_NEWEST_CREATED);
            $excludeForums =  mobiquo_hide_forum_array();
            $includeForums = array();
            $keywords = null;
            $filters = array();
            if(isset($filter->keywords))
            {
                $keywords = $filter->keywords;
                $keywords = str_replace('"','',$keywords);
            }
            if(isset($filter->searchUser))
            {
                $query->filterByItemAuthor(\IPS\Member::load($filter->searchUser,'name'));
            }
            if(isset($filter->userId))
            {
                $query->filterByItemAuthor(\IPS\Member::load($filter->userId));
            }
            if(isset($filter->forumId))
            {
                $includeForums[] = $filter->forumId;
            }
            if(isset($filter->topicId))
            {
                $where[] = array("forums_topics.tid = ?",$filter->topicId);
            }
            if(isset($filter->searchTime))
            {
                $query->filterByCreateDate(\IPS\DateTime::ts($filter->searchTime), null);
            }
            if(isset($filter->onlyIn))
            {
                $includeForums = array_merge($includeForums, $filter->onlyIn);
            }
            if(isset($filter->notIn))
            {
                $excludeForums = array_merge($excludeForums, $filter->notIn);
            }
            if(isset($filter->titleOnly) && $filter->titleOnly == true)
            {
                $flags = $flags | \IPS\Content\Search\Query::TERM_TITLES_ONLY;
            }
            $contentFilter = \IPS\Content\Search\ContentFilter::init('\IPS\forums\Topic');
            if(!empty($includeForums))
            {
                $contentFilter->onlyInContainers($includeForums);
            }
            else if(!empty($excludeForums))
            {
                $contentFilter->excludeInContainers($excludeForums);
            }
            $filters[] = $contentFilter;
            $query->filterByContent( $filters, TRUE );

            if($filter->topicId){
                try
                {
                    $query->filterByContent( array( \IPS\Content\Search\ContentFilter::init( 'IPS\forums\Topic' )->onlyInItems( array( $filter->topicId ) ) ) );
                }
                catch ( \OutOfRangeException $e ) { }
            }

            if(isset($filter->showPosts) && $filter->showPosts)
            {

                $results = $query->search(
                    $keywords,
                    NULL,
                    $flags + \IPS\Content\Search\Query::TAGS_MATCH_ITEMS_ONLY
                );

                if(self::USEFAKECOUNT){
                    $count = ($oMbqDataPage->numPerPage * $oMbqDataPage->curPage) +1;
                }
                else
                {
                    $count = $results->count( TRUE );
                }
                $rows = $results->getArrayCopy();

                foreach($rows as $row)
                {
                    $objsMbqEtForumTopicsOrPosts[] = $oMbqRdEtForumPost->initOMbqEtForumPost($row['index_object_id'], array('case' => 'byPostId', 'oMbqEtUser' => true, 'oMbqEtForum' => true));
                }
                $oMbqDataPage->totalNum = $count;
                $oMbqDataPage->datas = $objsMbqEtForumTopicsOrPosts;
            }
            else
            {
                $results = $query->search(
                    $keywords,
                    NULL,
                    $flags + \IPS\Content\Search\Query::TAGS_MATCH_ITEMS_ONLY
                );

                if(self::USEFAKECOUNT){
                    $count = ($oMbqDataPage->numPerPage * $oMbqDataPage->curPage) +1;
                }
                else
                {
                    $count = $results->count( TRUE );
                }
                $rows = $results->getArrayCopy();

                foreach($rows as $row)
                {
                    $objsMbqEtForumTopicsOrPosts[] = $oMbqRdEtForumTopic->initOMbqEtForumTopic($row['index_item_id'], array('case' => 'byTopicId', 'oMbqEtUser' => true, 'oMbqEtForum' => true));
                }
                $oMbqDataPage->totalNum = $count;
                $oMbqDataPage->datas = $objsMbqEtForumTopicsOrPosts;
            }

            return $oMbqDataPage;
        }
        MbqError::alert('', __METHOD__ . ',line:' . __LINE__ . '.' . MBQ_ERR_INFO_UNKNOWN_CASE);
    }
}
