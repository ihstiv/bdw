//<?php

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	exit;
}

class reviews_hook_ReviewsSearch extends _HOOK_CLASS_
{
    /**
     * Get Results
     *
     * @return	void
     */
    protected function _results()
    {
	try
	{
	        \IPS\Output::i()->cssFiles = array_merge( \IPS\Output::i()->cssFiles, \IPS\Theme::i()->css( 'reviews.css', 'reviews', 'front' ) );
	
	        parent::_results();
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
