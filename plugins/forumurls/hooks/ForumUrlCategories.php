//<?php

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	exit;
}

class hook261 extends _HOOK_CLASS_
{
    /**
     * [ActiveRecord] Save Changed Columns
     *
     * @return	void
     */
    public function save()
    {
	try
	{
        // make each category start with "c/"
	        if( isset( $this->changed['full_path'] ) )
	        {
	            if( mb_substr( $this->full_path, 0, 2 ) != 'c/' )
	            {
	                $this->full_path = 'c/' . $this->full_path;
	            }
	        }
	
	        parent::save();
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
