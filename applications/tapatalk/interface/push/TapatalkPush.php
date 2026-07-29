<?php

define('MBQ_PUSH_BLOCK_TIME', 60);    /* push block time(minutes) */
if(!class_exists('TapatalkBasePush'))
{
    require_once(dirname(__FILE__) . '/../mbqFrame/basePush/TapatalkBasePush.php');
}
require_once dirname(__FILE__) . '/../helper.php';

/**
 * push class

 */
Class TapatalkPush extends TapatalkBasePush {

    //init
    public function __construct() {
        parent::__construct($this);

    }
    function get_push_slug()
    {
        return \IPS\Settings::i()->tapatalk_push_slug;
    }
    function set_push_slug($slug = null)
    {
        $form = new \IPS\Helpers\Form();
        $form->saveAsSettings(array('tapatalk_push_slug'=> $slug));
        \IPS\Settings::i()->tapatalk_push_slug	= $slug;
		unset( \IPS\Data\Store::i()->settings );
        return true;
    }
    function doAfterAppLogin($userId)
    {
        TT_set_tapatalk_member($userId);
    }
    function TT_getBoardUrl()
    {
        $board_url = \IPS\Settings::i()->base_url;
        $board_url = $board_url . (substr($board_url , -1)=='/' ? '' : '/') . 'applications/tapatalk/';
        return $board_url;
    }
    public function proccessPush($data, $values = NULL)
    {

        try
        {
            if(isset($values) && isset($values['action']) && $values['action'] == 'delete')
            {
                $this->doPushDelete($data);
            }
            elseif($data instanceof IPS\forums\Topic\Post)
            {
                if(isset($values) && isset($values['action']) && $values['action'] == 'like')
                {
                    $this->doPushLike($data);
                }
                else
                {
                    $qm = array( 'quotes' => array(), 'mentions' => array() );
                    $document = new \DOMDocument;
                    libxml_use_internal_errors(TRUE);
                    $postMessage = $data->__get('post');
                    if ( @$document->loadHTML( '<div>' . $postMessage . '</div>' ) !== FALSE )
                    {
                        /* Quotes */
                        foreach( $document->getElementsByTagName('blockquote') as $quote )
                        {
                            if ( $quote->getAttribute('data-ipsquote-userid') and (int) $quote->getAttribute('data-ipsquote-userid') > 0 )
                            {
                                $qm['quotes'][] = $quote->getAttribute('data-ipsquote-userid');
                            }
                            else
                            {
                                if($quote->getAttribute('data-ipsquote-username'))
                                {
                                    $member = \IPS\Member::load( $quote->getAttribute('data-ipsquote-username'), 'name');
                                    if($member != null)
                                    {
                                        $qm['quotes'][] = $member->__get('member_id');
                                    }
                                }
                            }
                        }

                        /* Mentions */
                        if (preg_match_all( '/(?<=^@|\s@|>@)(#(.{1,50})#|\S{1,50}(?=[,\.;!\?]|\s|$))/U', $postMessage, $tags ) )
                        {
                            foreach ($tags[2] as $index => $tag)
                            {
                                if ($tag) $tags[1][$index] = $tag;
                            }
                            $tagged_usernames =  array_unique($tags[1]);
                            foreach($tagged_usernames as $tagged_username)
                            {
                                $member = \IPS\Member::load($tagged_username, 'name');
                                if($member != null)
                                {
                                    $qm['mentions'][] = $member->__get('member_id');
                                }
                            }
                        }

                        foreach( $document->getElementsByTagName('a') as $link )
                        {
                            if ( $link->getAttribute('data-mentionid') )
                            {
                                $path = explode( '/', $link->getNodePath() );
                                if ( !in_array( 'blockquote', $path ) && !in_array($link->getAttribute('data-mentionid'), $qm['mentions']))
                                {
                                    $qm['mentions'][] = $link->getAttribute('data-mentionid');
                                }
                            }
                        }
                    }
                    if ( !empty( $qm['mentions'] ) )
                    {
                        $this->doPushTag($data, $qm['mentions']);
                    }
                    else if ( !empty( $qm['quotes'] ) )
                    {
                        $this->doPushQuote($data, $qm['quotes']);
                    }
                    else if($data->__get('new_topic'))
                    {
                        $this->doPushNewTopic($data);
                    }
                    else
                    {
                        $this->doPushReply($data);
                    }
                }
            }
            else if($data instanceof IPS\core\Messenger\Message)
            {
                $this->doPushConv($data, $values);
            }
            else if($data instanceof IPS\core\modules\front\system\notifications)
            {
                $this->doPushNewSub($data);
            }
            else if($data instanceof IPS\core\Messenger\Conversation && isset($values) && isset($values['action']) && $values['action'] == 'invite')
            {
                $this->doPushConvInvite($data, $values['members']);
            }
        }
        catch(Exception $ex){}
        return true;
    }
    public function doPushLike($data)
    {
        $pushKey = \IPS\Settings::i()->tapatalk_apikey;
        if(empty($pushKey))
        {
            return;
        }
        $post = $data;
        $topic = \IPS\forums\Topic::load($post->__get('topic_id'));
        $forum = \IPS\forums\Forum::load($topic->__get('forum_id'));
        $member = \IPS\Member::load($post->__get('author_id'));
        $loggedMember = \IPS\Member::loggedIn();
        $forumTitle = '';
        try
        {
            $forumTitle = \IPS\Member::loggedIn()->language()->get(\IPS\forums\forum::$titleLangPrefix .  $forum->_id);
        }
        catch(Exception $ex)
        {
            $forumTitle = $forum->_id;
        }
        $ttp_data = array(
                    'url'       => $this->TT_getBoardUrl(),
                    'key'       => $pushKey,
                    'type'      => 'like',
                    'id'        => $post->__get('topic_id'),
                    'subid'     => $post->__get('pid'),
                    'subfid'    => $topic->__get('forum_id'),
                    'sub_forum_name' => self::push_clean($forumTitle),
                    'title'     => self::push_clean($topic->__get('title')),
                    'content'     => self::push_clean(TT_convertToTapatalkBBCode($post->__get('post'))),
                    'author'    => self::push_clean($loggedMember->get_name()),
                    'authorid'  => $loggedMember->__get('member_id'),
                    'dateline'  => time(),
                    'author_ua' => self::getClienUserAgent(),
                    'author_type' => check_return_user_type($loggedMember),
                    'from_app'  => self::getIsFromApp(),

            );

        if(TT_is_tapatalk_member($member->__get('member_id')))
        {
             $ttp_data['push'] =  1;
             $ttp_data['userid'] =  $member->__get('member_id');
        }
        else
        {
            $ttp_data['push'] =  0;
        }
        self::do_push_request($ttp_data);

    }
    public function doPushConvInvite($data, $members)
    {
        $pushKey = \IPS\Settings::i()->tapatalk_apikey;
        if(empty($pushKey))
        {
            return;
        }
        $message = $data;
        $userIds = array();
        if(is_array($members))
        {
            foreach($members as $member)
            {
                if(is_numeric($member))
                {
                    $userIds[] = $member;
                }
                else{
                    $userIds[] = $member->__get('member_id');
                }
            }
        }
        else
        {
            $userIds[] = $members->__get('member_id');
        }
        $authorId =	$message->author()->__get('member_id');
        if(sizeof($userIds) && in_array($authorId, $userIds) == false)
        {
            $ttp_data = array(
                        'push'      => 1,
                        'url'       => $this->TT_getBoardUrl(),
                        'key'       => $pushKey,
                        'userid'    => implode(',', $userIds),
                        'type'      => 'conv',
                        'invite'    => 1,
                        'id'        => $message->__get('id'),
                        'mid'       => $message->__get('first_msg_id'),
                        'title'     => self::push_clean($message->__get('title')),
                        'content'     => self::push_clean(TT_convertToTapatalkBBCode($message->__get('post'))),
                        'author'    => self::push_clean($message->author()->__get('name')),
                        'authorid'  => $authorId,
                        'dateline'  => time(),
                        'author_ua' => self::getClienUserAgent(),
                        'author_type' => check_return_user_type(\IPS\Member::load($authorId)),
                        'from_app' => self::getIsFromApp(),
                );
            self::do_push_request($ttp_data);
        }

    }
    public function doPushConv($data, $values)
    {
        $pushKey = \IPS\Settings::i()->tapatalk_apikey;
        if(empty($pushKey))
        {
            return;
        }
        $message = $data;
        if($message->__get('is_first_post') && empty($values))
        {
            return;
        }
        $conversation = \IPS\core\Messenger\Conversation::load($message->__get('topic_id'));
        $userIds = array();
        foreach($conversation->maps() as $participants)
        {
            $userId = $participants['map_user_id'];
            if(!in_array($userId, $userIds) && $message->__get('author_id') != $userId && $participants['map_user_active'])
            {
                $member = \IPS\Member::load($userId);
                $userIds[] = $userId;
            }
        }
        if(is_array($values['messenger_to']))
        {
            foreach($values['messenger_to'] as $member)
            {
                $userId = $member->__get('member_id');
                if(!in_array($userId, $userIds) && $message->__get('author_id') != $userId && TT_is_tapatalk_member($userId))
                {
                    $userIds[] = $userId;
                }
            }
        }
        if(sizeof($userIds))
        {
            $ttp_data = array(
                        'push'      => 1,
                        'url'       => $this->TT_getBoardUrl(),
                        'key'       => $pushKey,
                        'userid'    => implode(',', $userIds),
                        'type'      => 'conv',
                        'id'        => $message->__get('topic_id'),
                        'mid'       => $message->__get('id'),
                        'title'     => self::push_clean($conversation->__get('title')),
                        'content'     => self::push_clean(TT_convertToTapatalkBBCode($message->__get('post'))),
                        'author'    => self::push_clean($message->author()->__get('name')),
                        'authorid'  => $message->__get('author_id'),
                        'dateline'  => time(),
                        'author_ua' => self::getClienUserAgent(),
                        'author_type' => check_return_user_type(\IPS\Member::load($message->__get('author_id'))),
                        'from_app' => self::getIsFromApp(),
                );
            self::do_push_request($ttp_data);
        }
    }
    public function doPushNewTopic($data)
    {
        $pushKey = \IPS\Settings::i()->tapatalk_apikey;
        if(empty($pushKey))
        {
            return;
        }
        $post = $data;
        $topic = \IPS\forums\Topic::load($post->__get('topic_id'));
        $forum = \IPS\forums\Forum::load($topic->__get('forum_id'));

        $subscribedUsers = array();
        $followers = $topic->notificationRecipients(array(0,100000));
    	foreach ( $followers as $follower )
        {
        	$member = \IPS\Member::load( $follower['follow_member_id'] );
			if ( $member != $data->author() and $data->canView( $member ) and TT_is_tapatalk_member($member->__get('member_id')))
			{
				$subscribedUsers[] = $follower['follow_member_id'];
			}
        }
        $forumTitle = '';
        try
        {
            $forumTitle = \IPS\Member::loggedIn()->language()->get(\IPS\forums\forum::$titleLangPrefix .  $forum->_id);
        }
        catch(Exception $ex)
        {
            $forumTitle = $forum->_id;
        }
        $ttp_data = array(
                    'url'       => $this->TT_getBoardUrl(),
                    'key'       => $pushKey,
                    'type'      => 'newtopic',
                    'id'        => $post->__get('topic_id'),
                    'subid'     => $post->__get('pid'),
                    'subfid'    => $topic->__get('forum_id'),
                    'sub_forum_name' => self::push_clean($forumTitle),
                    'title'     => self::push_clean($topic->__get('title')),
                    'content'     => self::push_clean(TT_convertToTapatalkBBCode($post->__get('post'))),
                    'author'    => self::push_clean($post->__get('author_name')),
                    'authorid'  => $post->__get('author_id'),
                    'dateline'  => time(),
                    'author_ua' => self::getClienUserAgent(),
                    'author_type' => check_return_user_type(\IPS\Member::load($post->__get('author_id'))),
                    'from_app' => self::getIsFromApp(),
            );

        if(sizeof($subscribedUsers))
        {
            $ttp_data['userid'] = implode(',', $subscribedUsers);
            $ttp_data['push'] = 1;
        }
        else
        {
            if($topic->__get('approved') != 1)
            {
                return;
            }
            $ttp_data['push'] = 0;
        }
        self::do_push_request($ttp_data);
    }

    public function doPushReply($data, $excludeUsers = array())
    {
        $pushKey = \IPS\Settings::i()->tapatalk_apikey;
        if(empty($pushKey))
        {
            return;
        }
        $post = $data;
        $topic = \IPS\forums\Topic::load($post->__get('topic_id'));
        $forum = \IPS\forums\Forum::load($topic->__get('forum_id'));

        $subscribedUsers = array();
        $followers = $data->notificationRecipients(array(0,100000));
    	foreach ( $followers as $follower )
        {
        	$member = \IPS\Member::load( $follower['follow_member_id'] );
			if ( $member != $data->author() and $data->canView( $member ) and TT_is_tapatalk_member($member->__get('member_id')) and !in_array($member->__get('member_id'), $excludeUsers))
			{
				$subscribedUsers[] = $follower['follow_member_id'];
			}
        }
        $forumTitle = '';
        try
        {
            $forumTitle = \IPS\Member::loggedIn()->language()->get(\IPS\forums\forum::$titleLangPrefix .  $forum->_id);
        }
        catch(Exception $ex)
        {
            $forumTitle = $forum->_id;
        }
        $ttp_data = array(
                    'url'       => $this->TT_getBoardUrl(),
                    'key'       => $pushKey,
                    'type'      => 'sub',
                    'id'        => $post->__get('topic_id'),
                    'subid'     => $post->__get('pid'),
                    'subfid'    => $topic->__get('forum_id'),
                    'sub_forum_name' => self::push_clean($forumTitle),
                    'title'     => self::push_clean($topic->__get('title')),
                    'content'     => self::push_clean(TT_convertToTapatalkBBCode($post->__get('post'))),
                    'author'    => self::push_clean($post->__get('author_name')),
                    'authorid'  => $post->__get('author_id'),
                    'dateline'  => time(),
                    'author_ua' => self::getClienUserAgent(),
                    'author_type' => check_return_user_type(\IPS\Member::load($post->__get('author_id'))),
                    'from_app' => self::getIsFromApp(),
            );

        if(sizeof($subscribedUsers))
        {
            $ttp_data['userid'] = implode(',', $subscribedUsers);
            $ttp_data['push'] = 1;
        }
        else
        {
            if($topic->__get('approved') != 1)
            {
                return;
            }
            $ttp_data['push'] = 0;
        }
        self::do_push_request($ttp_data);
    }
    public function doPushNewSub($data)
    {
        $pushKey = \IPS\Settings::i()->tapatalk_apikey;
        if(empty($pushKey))
        {
            return;
        }
        if($data instanceof MbqEtForumTopic)
        {
            $followId = $data->topicId->oriValue;
            $followArea = 'topic';
            $followSubmitted = '1';
        }
        else
        {
            $followId = \IPS\Request::i()->follow_id;
            $followArea = \IPS\Request::i()->follow_area;
            $followSubmitted = \IPS\Request::i()->follow_submitted;
        }
         if(isset($followSubmitted) && $followArea == 'topic')
        {
            $userId = \IPS\Member::loggedIn();
            $topic = \IPS\forums\Topic::load($followId);
            $forum = \IPS\forums\Forum::load($topic->__get('forum_id'));
            $post = $topic->comments(1);
            $topicAuthoMmember = \IPS\Member::load( $topic->__get('starter_id') );
            if (TT_is_tapatalk_member($topicAuthoMmember->__get('member_id')) && $topicAuthoMmember->member_id != \IPS\Member::loggedIn()->member_id)
            {

                $forumTitle = '';
                try
                {
                    $forumTitle = \IPS\Member::loggedIn()->language()->get(\IPS\forums\forum::$titleLangPrefix .  $forum->_id);
                }
                catch(Exception $ex)
                {
                    $forumTitle = $forum->_id;
                }
                $ttp_data = array(
                            'url'       => $this->TT_getBoardUrl(),
                            'key'       => $pushKey,
                            'type'      => 'newsub',
                            'id'        => $post->__get('topic_id'),
                            'subid'        => $post->__get('post_id'),
                            'subfid'    => $topic->__get('forum_id'),
                            'sub_forum_name' => self::push_clean($forumTitle),
                            'title'     => self::push_clean($topic->__get('title')),
                            'content'     => self::push_clean(TT_convertToTapatalkBBCode($post->__get('post'))),
                            'author'    => self::push_clean(\IPS\Member::loggedIn()->get_name()),
                            'authorid'  => \IPS\Member::loggedIn()->member_id,
                            'dateline'  => time(),
                            'author_ua' => self::getClienUserAgent(),
                            'author_type' => check_return_user_type(\IPS\Member::loggedIn()),
                            'from_app' => self::getIsFromApp(),
                    );

                $ttp_data['userid'] = $topicAuthoMmember->member_id;
                $ttp_data['push'] = 1;
                self::do_push_request($ttp_data);
            }
        }
    }
    public function doPushQuote($data, $quotedUsers)
    {
        $pushKey = \IPS\Settings::i()->tapatalk_apikey;
        if(empty($pushKey))
        {
            return;
        }
        $post = $data;
        $topic = \IPS\forums\Topic::load($post->__get('topic_id'));
        $forum = \IPS\forums\Forum::load($topic->__get('forum_id'));
        foreach($quotedUsers as $key=> $quotedUser)
        {
            $member = \IPS\Member::load($quotedUser);
            if(!TT_is_tapatalk_member($member->__get('member_id')))
            {
                unset($quotedUsers[$key]);
            }
            if(!$topic->canView($member))
            {
                unset($quotedUsers[$key]);
            }
        }
        $forumTitle = '';
        try
        {
            $forumTitle = \IPS\Member::loggedIn()->language()->get(\IPS\forums\forum::$titleLangPrefix .  $forum->_id);
        }
        catch(Exception $ex)
        {
            $forumTitle = $forum->_id;
        }
        $ttp_data = array(
                    'url'       => $this->TT_getBoardUrl(),
                    'key'       => $pushKey,
                    'type'      => 'quote',
                    'id'        => $post->__get('topic_id'),
                    'subid'     => $post->__get('pid'),
                    'subfid'    => $topic->__get('forum_id'),
                    'sub_forum_name' => self::push_clean($forumTitle),
                    'title'     => self::push_clean($topic->__get('title')),
                    'content'     => self::push_clean(TT_convertToTapatalkBBCode($post->__get('post'))),
                    'author'    => self::push_clean($post->__get('author_name')),
                    'authorid'  => $post->__get('author_id'),
                    'dateline'  => time(),
                    'author_ua' => self::getClienUserAgent(),
                    'author_type' => check_return_user_type(\IPS\Member::load($post->__get('author_id'))),
                    'from_app' => self::getIsFromApp(),
            );

        if(sizeof($quotedUsers))
        {
            $ttp_data['userid'] = implode(',', $quotedUsers);
            $ttp_data['push'] = 1;
            self::do_push_request($ttp_data);
        }
        self::doPushReply($data, $quotedUsers);
    }
    public function doPushTag($data, $taggedUsers)
    {
        $pushKey = \IPS\Settings::i()->tapatalk_apikey;
        if(empty($pushKey))
        {
            return;
        }

        $post = $data;
        $topic = \IPS\forums\Topic::load($post->__get('topic_id'));
        $forum = \IPS\forums\Forum::load($topic->__get('forum_id'));
        foreach($taggedUsers as $key=> $taggedUser)
        {
            $member = \IPS\Member::load($taggedUser);
            if(!TT_is_tapatalk_member($member->__get('member_id')))
            {
                unset($taggedUsers[$key]);
            }
            if(!$topic->canView($member))
            {
                unset($taggedUsers[$key]);
            }
        }
        $forumTitle = '';
        try
        {
            $forumTitle = \IPS\Member::loggedIn()->language()->get(\IPS\forums\forum::$titleLangPrefix .  $forum->_id);
        }
        catch(Exception $ex)
        {
            $forumTitle = $forum->_id;
        }
        $ttp_data = array(
                    'url'       => $this->TT_getBoardUrl(),
                    'key'       => $pushKey,
                    'type'      => 'tag',
                    'id'        => $post->__get('topic_id'),
                    'subid'     => $post->__get('pid'),
                    'subfid'    => $topic->__get('forum_id'),
                    'sub_forum_name' => self::push_clean($forumTitle),
                    'title'     => self::push_clean($topic->__get('title')),
                    'content'     => self::push_clean(TT_convertToTapatalkBBCode($post->__get('post'))),
                    'author'    => self::push_clean($post->__get('author_name')),
                    'authorid'  => $post->__get('author_id'),
                    'dateline'  => time(),
                    'author_ua' => self::getClienUserAgent(),
                    'author_type' => check_return_user_type(\IPS\Member::load($post->__get('author_id'))),
                    'from_app' => self::getIsFromApp(),
            );

        if(sizeof($taggedUsers))
        {
            $ttp_data['userid'] = implode(',', $taggedUsers);
            $ttp_data['push'] = 1;
            self::do_push_request($ttp_data);
        }
        self::doPushReply($data, $taggedUsers);
    }
    public function doPushDelete($data)
    {
        $pushKey = \IPS\Settings::i()->tapatalk_apikey;
        if(!empty($data['tid']))
        {
            $id   = $data['tid'];

            $ttp_data = array(
                  'url'       => $this->TT_getBoardUrl(),
                  'key'       => $pushKey,
                  'type'      => 'deltopic',
                  'id'        => $id,
                  'from_app' => self::getIsFromApp(),
          );


            self::do_push_request($ttp_data);


        } elseif ($data['pid'] && $data['topic_id'])
        {
            $id          = $data['pid'];
            $ttp_data = array(
              'url'       => $this->TT_getBoardUrl(),
              'key'       => $pushKey,
              'type'      => 'delpost',
              'id'        => $id,
              'from_app' => self::getIsFromApp(),
      );


            self::do_push_request($ttp_data);

        } else
        {
          return;
        }
    }

    protected function doInternalPushThank($p){}

    protected function doInternalPushReply($p){}

    protected function doInternalPushReplyConversation($p){}

    protected function doInternalPushNewTopic($p){}

    protected function doInternalPushNewConversation($p){}

    protected function doInternalPushNewMessage($p){}

    protected function doInternalPushLike($p){}

    protected function doInternalPushNewSubscription($p){

        $this->doPushNewSub($p['oMbqEtForumTopic']);
    }

    protected function doInternalPushDeleteTopic($p) {}

    protected function doInternalPushDeletePost($p) {}
}
