//<?php

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	exit;
}

class reviews_hook_ReviewsSearchIndex extends _HOOK_CLASS_
{
    /**
     * Get index data
     *
     * @param	\IPS\Content\Searchable	$object	Item to add
     * @return	array|NULL
     */
    public function indexData( \IPS\Content\Searchable $object )
    {
	try
	{
	        $index = parent::indexData( $object );
	
	        if( $object instanceof \IPS\reviews\Review )
	        {
	            $productString = "<!--:: " . $object->product()->name . " ::-->";
	            $index['index_content'] .= $productString;
	        }
	        elseif( $object instanceof \IPS\reviews\Product )
	        {
	            $index['index_hidden'] = ( $object->enabled ? 0 : 1 );
	            $index['index_date_updated'] = time();
	            if( !$index['index_date_created'] )
	            {
	                $index['index_date_created'] = time();
	            }
	
	            if( \IPS\IN_DEV )
	            {
	                $index['index_author'] = 1;
	            }
	            elseif( !$index['index_author'] )
	            {
	                $index['index_author'] = \IPS\Member::load( 'SteveW', 'name' )->member_id;
	            }
	        }
	
	        return $index;
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
