//<?php

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	exit;
}

class hook654 extends _HOOK_CLASS_
{
    /**
     * @brief   Holder for wedding data
     */
    protected $_wedding = null;

    /**
     * Return the wedding information
     *
     * @return array
     */
    public function get_wedding()
    {
	try
	{
	        if( $this->_wedding === null )
	        {
	            try
	            {
	                $this->_wedding = \IPS\Db::i()->select( '*','weddings_weddings', array( 'wedding_member_id=?', $this->member_id ) )->first();
	            }
	            catch( \UnderflowException $e )
	            {
	                $this->_wedding = array(
	                    'wedding_member_id' => $this->member_id,
	                    'wedding_event_id' => null,
	                    'wedding_date' => null,
	                    'wedding_location' => null
	                );
	            }
	        }
	
	        return $this->_wedding;
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
