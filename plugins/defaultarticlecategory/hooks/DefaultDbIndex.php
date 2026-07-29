//<?php

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	exit;
}

class hook259 extends _HOOK_CLASS_
{
    /**
     * Execute
     *
     * @return	void
     */
    public function execute()
    {
	try
	{
	        parent::execute();
	
	        if( \IPS\cms\Databases\Dispatcher::i()->databaseId )
	        {
            // if no category is set, redirect to the first one
	            try
	            {
	                $first = \IPS\Db::i()->select( '*', 'cms_database_categories', array( 'category_database_id=?', \IPS\cms\Databases\Dispatcher::i()->databaseId ), 'category_position', array( 0, 1 ) )->first();
	                $catClass = 'IPS\cms\Categories' . \IPS\cms\Databases\Dispatcher::i()->databaseId;
	                \IPS\Output::i()->redirect( $catClass::constructFromData( $first )->url() );
	            }
	            catch( \UnderflowException $e ){}
	        }
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
