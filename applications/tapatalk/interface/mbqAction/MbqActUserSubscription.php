<?php

defined('MBQ_IN_IT') or exit;

MbqMain::$oClk->includeClass('MbqBaseActUserSubscription');

Class MbqActUserSubscription extends MbqBaseActUserSubscription {

    public function __construct() {
        parent::__construct();
    }

    /**
     * action implement
     */
    public function actionImplement($in) {
        $forums = array();
        $topics = array();
        $iterator	= \IPS\Db::i()->select(
					'core_follow.follow_rel_id',
					'core_follow',
					array( 'follow_member_id = ? AND follow_app = ? AND follow_area = ?', (int)$in->userId, "forums", "forum"));
        foreach($iterator as $forum)
        {
            $forums[] = $forum;
        }
        $iterator	= \IPS\Db::i()->select(
                   'core_follow.follow_rel_id',
                   'core_follow',
                   array( 'follow_member_id = ? AND follow_app = ? AND follow_area = ?', (int)$in->userId, "forums", "forum" ));
        foreach($iterator as $topic)
        {
            $topics[] = $topic;
        }

        $this->data = array(
             'result'      => true,
             'forums'      => $forums,
             'topics'       => $topics,
         );
    }

}
