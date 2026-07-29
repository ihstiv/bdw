//<?php

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	exit;
}

class reviews_hook_ReviewsOutput extends _HOOK_CLASS_
{
    /**
     * Fetch meta tags for the current page.  Must be called before sendOutput() in order to reset title.
     *
     * @return	void
     */
    public function buildMetaTags()
    {
	try
	{
	        parent::buildMetaTags();
	
	        $this->title = \str_ireplace( " - " . \IPS\Settings::i()->board_name, " | " . \IPS\Settings::i()->board_name, $this->title );
	}
	catch ( \Error | \RuntimeException $e )
	{
		if( \defined( '\IPS\DEBUG_HOOKS' ) AND \IPS\DEBUG_HOOKS )
		{
			\IPS\Log::log( $e, 'hook_exception' );
		}

		if ( method_exists( get_parent_class(), __FUNCTION__ ) )
		{
			return \call_user_func_array( 'parent::' . __FUNCTION__, \func_get_args() );
		}
		else
		{
			throw $e;
		}
	}
    }

}
