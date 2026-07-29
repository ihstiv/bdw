<?php

defined('MBQ_IN_IT') or exit;

MbqMain::$oClk->includeClass('MbqBaseRdEtForum');

/**
 * forum read class
 */
Class MbqRdEtForum extends MbqBaseRdEtForum {

    public function __construct() {
    }

    public function makeProperty(&$oMbqEtForum, $pName, $mbqOpt = array()) {
        switch ($pName) {
            default:
            MbqError::alert('', __METHOD__ . ',line:' . __LINE__ . '.' . MBQ_ERR_INFO_UNKNOWN_PNAME . ':' . $pName . '.');
            break;
        }
    }

    public function getForumTree($return_description = 0, $root_forum_id = 0) {
        //include_once MBQ_APPEXTENTION_PATH . 'forum.php';
        if($root_forum_id == 0)
        {
            $forums = \IPS\forums\Forum::roots('view');
            return $this->parseForumTree(null, $forums);
        }
    }
    /**
     * get forum objs
     *
     * @param  Mixed  $var
     * @param  Array  $mbqOpt
     * $mbqOpt['case'] = 'byForumIds' means get data by forum ids.$var is the ids.
     * $mbqOpt['case'] = 'subscribed' means get subscribed data.$var is the user id.
     * @return  Array
     */
    public function getObjsMbqEtForum($var, $mbqOpt) {
        if ($mbqOpt['case'] == 'byForumIds') {
            $forumIds = $var;
            if(!is_array($forumIds))
            {
                $forumIds = array($forumIds);
            }
            $objsMbqEtForum = array();
            foreach($forumIds as $forumId)
            {
                if(mobiquo_hide_forum($forumId))
                {
                    continue;
                }
                $forum = \IPS\forums\Forum::load($forumId);
                $objsMbqEtForum[] = $this->initOMbqEtForum($forum, array('case'=>'byRow'));
            }
            return $objsMbqEtForum;
        } elseif ($mbqOpt['case'] == 'subscribed') {
            $output = new \IPS\core\Followed\Table( "IPS\\forums\\Forum", explode( '_', "forums_forum" ) );
            $advancedSearchValues = array();
            $forums = $output->getRows($advancedSearchValues);
            $forum_list = array();
            foreach($forums as $forum)
            {
                $forumId = $forum->__get('id');
                if(mobiquo_hide_forum($forumId))
                {
                    continue;
                }
                $forum_list[] = $this->initOMbqEtForum($forumId, array('case'=>'byForumId','ignorecache' => true));
            }
            return $forum_list;
        }
        MbqError::alert('', __METHOD__ . ',line:' . __LINE__ . '.' . MBQ_ERR_INFO_UNKNOWN_CASE);
    }
    function parseForumTree($parentForum, $forums)
    {
        $result = array();
        foreach($forums as $forum)
        {
            $oMbqEtForum = $this->initOMbqEtForum($forum, array('case'=>'byRow'));
            if(mobiquo_hide_forum($oMbqEtForum->forumId->oriValue))
            {
                continue;
            }
            if($forum->hasChildren())
            {
                $oMbqEtForum->objsSubMbqEtForum = $this->parseForumTree($oMbqEtForum, $forum->children());
            }
            $result[] = $oMbqEtForum;
        }
        return $result;
    }
    public function initOMbqEtForum($var, $mbqOpt)
    {
        if ($mbqOpt['case'] == 'byForumId') {
            $forumId = $var;
            if(!isset($mbqOpt['ignorecache']) && MbqMain::$Cache->Exists('MbqEtForum',$forumId))
            {
                return MbqMain::$Cache->Get('MbqEtForum',$forumId);
            }
            //$forum = \IPS\forums\Forum::load($forumId);
            try{

                $forum = \IPS\forums\Forum::load($forumId);
            }catch(\InvalidArgumentException $e){
                MbqError::alert('',"Idfield not exists! ",'',MBQ_ERR_APP);

            }catch(\UnderflowException $e){
                MbqError::alert('',"Data underflow! ",'',MBQ_ERR_APP);

            }catch(\OutOfRangeException $e){
                MbqError::alert('',"Wrong forum id! ",'',MBQ_ERR_APP);
            }
            $objsMbqEtForum = $this->initOMbqEtForum($forum, array('case'=>'byRow'));
            MbqMain::$Cache->Set('MbqEtForum',$forumId,$objsMbqEtForum);
            return $objsMbqEtForum;
        }
        else if($mbqOpt['case'] == 'byRow')
        {
            $forum = $var;
            $forum_id = $forum->_id;
            //$read_only_forums = explode(",", $config['tapatalk_forum_read_only']);
            //$can_post = true;
            //$can_upload = true;
            //if(empty($read_only_forums) || !is_array($read_only_forums))
            //{
            //    $read_only_forums = array();
            //}
            //if(!$auth->acl_get('f_post', $forum_id) || in_array($forum_id, $read_only_forums))
            //{
            //    $can_post = false;
            //}
            //if(!$can_post||!$auth->acl_get('u_attach'))
            //{
            //    $can_upload = false;
            //}
            $oMbqEtForum = MbqMain::$oClk->newObj('MbqEtForum');
            $oMbqEtForum->forumId->setOriValue($forum_id);
            $oMbqEtForum->forumName->setOriValue(html_entity_decode(self::getForumTitle($forum)));
            $oMbqEtForum->parentId->setOriValue($forum->__get('parent_id'));
            $oMbqEtForum->description->setOriValue(TT_process_short_content(self::getForumDescription($forum)));
            $oMbqEtForum->logoUrl->setOriValue($forum->__get('icon'));
            $oMbqEtForum->newPost->setOriValue(\IPS\forums\Topic::containerUnread( $forum ));
            $oMbqEtForum->isProtected->setOriValue($forum->__get('password') != null);
            if(MbqMain::hasLogin())
            {
                $isFollowing = \IPS\Member::loggedIn()->following('forums','forum', $forum_id);
                $oMbqEtForum->isSubscribed->setOriValue($isFollowing);
                $oMbqEtForum->canSubscribe->setOriValue(MbqMain::isActiveMember());
            }
            else
            {
                $oMbqEtForum->isSubscribed->setOriValue(false);
                $oMbqEtForum->canSubscribe->setOriValue(false);
            }
            $oMbqEtForum->url->setOriValue($forum->__get('redirect_url'));
            $oMbqEtForum->subOnly->setOriValue(!$forum->__get('sub_can_post'));
            $oMbqEtForum->canPost->setOriValue($forum->can('add') && $forum->can('reply') &&  MbqMain::isActiveMember());
            if(\IPS\Settings::i()->attach_allowed_types != 'none')
            {
                $oMbqEtForum->canUpload->setOriValue(true);
            }
            $oMbqEtForum->requirePrefix->setOriValue(false);

            $disallow_forumid = explode(',',\IPS\Settings::i()->tapatalk_disablenewtopic);
            if(in_array($forum_id,$disallow_forumid)){
                $oMbqEtForum->canPost->setOriValue(false);
            }

            if($tagsField = \IPS\forums\Topic::tagsFormField( null, $forum ))
            {
                if($tagsField->required)
                {
                    $oMbqEtForum->requirePrefix->setOriValue(true);
                    $prefixes =array();
                    foreach($tagsField->options['autocomplete']['source'] as $prefix)
                    {
                        $prefixes[] = array('id'=>$prefix, 'name'=>$prefix);
                    }
                    $oMbqEtForum->prefixes->setOriValue($prefixes);
                }

            }

            $oMbqEtForum->mbqBind = $forum;
            return $oMbqEtForum;
        }
        return null;
    }
    /**
     * login forum
     *
     * @return Array
     */
    public function loginForum($oMbqEtForum, $password) {
        if($oMbqEtForum->mbqBind->__get('password') == $password)
        {
        	\IPS\Request::i()->setCookie( 'ipbforumpass_' . $oMbqEtForum->forumId->oriValue, md5( $password ), \IPS\DateTime::create()->add( new \DateInterval( 'P7D' ) ) );
            return true;
        }
        return false;
    }

    public function getUrl($oMbqEtForum)
    {
        return (string)$oMbqEtForum->mbqBind->url();
    }
    public function getForumTitle($forum)
    {
        try
        {
          return \IPS\Member::loggedIn()->language()->get(\IPS\forums\forum::$titleLangPrefix .  $forum->_id);
        }
        catch(Exception $ex)
        {
        }
        return $forum->_title;
    }
    public function getForumDescription($forum)
    {
        try
        {
            return \IPS\Member::loggedIn()->language()->get(\IPS\forums\forum::$titleLangPrefix .  $forum->_id  . \IPS\forums\forum::$descriptionLangSuffix);
        }
        catch(Exception $ex)
        {
        }
        return "";
    }
}
