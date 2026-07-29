<?php


class mentionNotification extends forums_notifications
{
	public function getConfiguration()
	{
		$_NOTIFY = parent::getConfiguration();

		$_NOTIFY[] = array( 'key' => 'booty_call', 'default' => array( 'inline' ), 'disabled' => array( '' ), 'icon' => 'notify_newreply' );

		return $_NOTIFY;
	}
}