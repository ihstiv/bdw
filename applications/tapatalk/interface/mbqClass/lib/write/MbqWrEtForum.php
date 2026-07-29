<?php

defined('MBQ_IN_IT') or exit;

MbqMain::$oClk->includeClass('MbqBaseWrEtForum');

/**
 * forum write class
 */
Class MbqWrEtForum extends MbqBaseWrEtForum {

    public function __construct() {
    }


    /**
     * subscribe forum
     */
    public function subscribeForum($oMbqEtForum, $receiveEmail) {

        $forum_id = $oMbqEtForum->forumId->oriValue;
        if (\IPS\Member::loggedIn()->member_id)
		{
            try
		    {
                $current = \IPS\Db::i()->select( '*', 'core_follow', array( 'follow_app=? AND follow_area=? AND follow_rel_id=? AND follow_member_id=?', 'forums', 'forum', $forum_id, \IPS\Member::loggedIn()->member_id ) )->first();
            }
		    catch ( \UnderflowException $e )
		    {
			    $current = FALSE;
		    }

            $save = array(
				'follow_id'			=> md5( 'forums' . ';' . 'forum' . ';' . $forum_id . ';' .  \IPS\Member::loggedIn()->member_id ),
				'follow_app'			=> 'forums',
				'follow_area'			=> 'forum',
				'follow_rel_id'		=> $forum_id,
				'follow_member_id'	=> \IPS\Member::loggedIn()->member_id,
				'follow_is_anon'		=> false,
				'follow_added'		=> time(),
				'follow_notify_do'	=> 0,
				'follow_notify_meta'	=> '',
				'follow_notify_freq'	=> 'immediate',
				'follow_notify_sent'	=> 0,
				'follow_visible'		=> 1
			);
			if ( $current )
			{
				\IPS\Db::i()->update( 'core_follow', $save, array( 'follow_id=?', $current['follow_id'] ) );
			}
			else
			{
				\IPS\Db::i()->insert( 'core_follow', $save );
			}

            return true;
        }
        return 'You are not allowed to do this operation';
    }

    /**
     * unsubscribe forum
     */
    public function unsubscribeForum($oMbqEtForum) {


        $forum_id = $oMbqEtForum->forumId->oriValue;
        if (\IPS\Member::loggedIn()->member_id)
		{
            try
		    {
                $follow = \IPS\Db::i()->select( '*', 'core_follow', array( 'follow_app=? AND follow_area=? AND follow_rel_id=? AND follow_member_id=?', 'forums', 'forum', $forum_id, \IPS\Member::loggedIn()->member_id ) )->first();
            }
		    catch ( \UnderflowException $e )
		    {
			    $follow = FALSE;
		    }
            if($follow)
            {
                \IPS\Db::i()->delete( 'core_follow', array( 'follow_id=? AND follow_member_id=?', $follow['follow_id'], \IPS\Member::loggedIn()->member_id ) );
            }
        }
        return true;
    }

    public function markForumRead($oMbqEtForum){
        if($oMbqEtForum != null)
        {
            \IPS\forums\Topic::markContainerRead( $oMbqEtForum->mbqBind );
        }
        else
        {
            \IPS\Member::loggedIn()->markAllAsRead();
        }
        return true;
    }

}
