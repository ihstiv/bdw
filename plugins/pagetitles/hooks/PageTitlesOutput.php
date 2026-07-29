//<?php

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	exit;
}

class hook262 extends _HOOK_CLASS_
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
        // replace titles for specific pages
	        if( \IPS\Dispatcher::i()->controllerLocation == 'front' )
	        {
	            switch( \IPS\Dispatcher::i()->application->directory )
	            {
	                case 'forums':
	                    if( $this->title == \IPS\Member::loggedIn()->language()->addToStack( 'forums' ) )
	                    {
	                        $this->title = 'Destination Wedding Forum';
	                    }
	                    break;
	                case 'blog':
	                    if( $this->title == \IPS\Member::loggedIn()->language()->addToStack( 'blogs' ) )
	                    {
	                        $this->title = 'Destination Wedding Bride Blogs';
	                    }
	                    break;
	                case 'gallery':
	                    if( $this->title == \IPS\Member::loggedIn()->language()->addToStack( 'gallery_title' ) )
	                    {
	                        $this->title = 'Destination Wedding Pictures';
	                    }
	                    break;
	            }
	        }
	
	        return parent::buildMetaTags();
	}
	catch ( \RuntimeException $e )
	{
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
