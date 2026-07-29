//<?php

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	exit;
}

class hook655 extends _HOOK_CLASS_
{
    /**
     * Build Edit Form
     *
     * @return \IPS\Helpers\Form
     */
    protected function buildEditForm()
    {
	try
	{
	        $form = parent::buildEditForm();
	
	        $weddingInfo = \IPS\Member::loggedIn()->wedding;
	
	        if( $weddingInfo['wedding_date'] )
	        {
	            $bits = explode( "-", mb_substr( $weddingInfo['wedding_date'], 0, mb_strpos( $weddingInfo['wedding_date'], ' ' ) ) );
	            $ts = mktime( 12, 0, 0, $bits[1], $bits[2], $bits[0] );
	            $date = \IPS\DateTime::ts( $ts );
	        }
	        else
	        {
	            $date = null;
	        }
	
	        $form->add( new \IPS\Helpers\Form\Date( 'wedding_date', $date, false ), 'bday');
	        $form->add( new \IPS\Helpers\Form\Text( 'wedding_location', $weddingInfo['wedding_location'], false ), 'wedding_date' );
	
	        return $form;
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

    /**
     * Save Member
     *
     * @param $form
     * @param array $values
     */
    protected function _saveMember( $form, array $values )
    {
	try
	{
	        $wedding = \IPS\Member::loggedIn()->wedding;
	        $wedding['wedding_date'] = ( $values['wedding_date'] instanceof \IPS\DateTime ) ? $values['wedding_date']->format( 'Y-m-d H:i:s' ) : null;
	        $wedding['wedding_location'] = $values['wedding_location'];
	
        // if we removed the date and we have an event, remove the event
	        if( $wedding['wedding_date'] === null )
	        {
	            if( $wedding['wedding_event_id'] )
	            {
	                try
	                {
	                    \IPS\calendar\Event::load( $wedding['wedding_event_id'] )->delete();
	                }
	                catch( \OutOfRangeException $e ){}
	            }
	        }
	        else
	        {
            // load the event, if it exists
	            $event = null;
	            if( $wedding['wedding_event_id'] )
	            {
	                try
	                {
	                    $event = \IPS\calendar\Event::load( $wedding['wedding_event_id'] );
	                }
	                catch( \OutOfRangeException $e ){}
	            }
	
            // create a new one
	            if( $event == null )
	            {
	                $event = new \IPS\calendar\Event;
	                $event->member_id = \IPS\Member::loggedIn()->member_id;
	                $event->calendar_id = \IPS\Settings::i()->wedding_calendar_id;
	                $event->title = \sprintf( \IPS\Member::loggedIn()->language()->get( 'wedding_calendar_title' ), \IPS\Member::loggedIn()->name );
	                $event->approved = true;
	                $event->saved = time();
	                $event->all_day = true;
	            }
	
	            $event->lastupdated = time();
	            $event->start_date = $wedding['wedding_date'];
	            if( $wedding['wedding_location'] )
	            {
	                $event->content = \sprintf( \IPS\Member::loggedIn()->language()->get( 'wedding_calendar_content' ), $wedding['wedding_location'] );
	            }
	            else
	            {
	                $event->content = '';
	            }
	
	            $event->save();
	
	            $wedding['wedding_event_id'] = $event->id;
	        }
	
	        \IPS\Db::i()->replace( 'weddings_weddings', $wedding );
	
	        return parent::_saveMember( $form, $values );
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
