//<?php

$form->add( new \IPS\Helpers\Form\Node( 'wedding_calendar_id', \IPS\Settings::i()->wedding_calendar_id, false, array(
    'class' => 'IPS\calendar\Calendar',
    'multiple' => false
) ) );

if ( $values = $form->values() )
{
    $values['wedding_calendar_id'] = ( $values['wedding_calendar_id'] instanceof \IPS\calendar\Calendar ) ? $values['wedding_calendar_id']->_id : null;

	$form->saveAsSettings( $values );
	return TRUE;
}

return $form;