//<?php

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	exit;
}

class tapatalk_hook_output extends _HOOK_CLASS_
{


	/**
	 * Show Banned
	 *
	 * @return	void
	 */
	public function showBanned()
	{
        if(\IPS\Dispatcher::i()->controller == "mobiquo")
        {
            return null;
        }
		return call_user_func_array( 'parent::showBanned', func_get_args() );
	}

}
