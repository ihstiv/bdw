//<?php

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	exit;
}

class reviews_hook_ReviewsGallerySettings extends _HOOK_CLASS_
{
    /**
     * Rebuild gallery images
     *
     * @return	void
     */
    protected function rebuildImages()
    {
	try
	{
	        \IPS\Task::queue( 'reviews', 'RebuildImages', array(), 3 );
	
	        \IPS\Output::i()->redirect( \IPS\Http\Url::internal( 'app=gallery&module=gallery&controller=settings' ), 'gallery_rebuild_queued' );
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
