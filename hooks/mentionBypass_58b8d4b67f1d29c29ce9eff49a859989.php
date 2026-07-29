<?php

class mentionBypass extends tapatalk_notifications
{
	public function getMemberNotificationConfig( $member )
	{
		$return = parent::getMemberNotificationConfig( $member );

		if( $this->settings['booty_call_bypass'] AND $this->request['area'] != 'notifications' )
		{
			$rape = array( 0 => 'inline' );
			if ( is_array( $return['booty_call']['selected'] ) )
			{
				$return['booty_call']['selected'] = array_merge( $return['booty_call']['selected'], $rape );
				$return['booty_call']['selected'] = array_unique( $return['booty_call']['selected'] );
			}
			else
			{
				$return['booty_call']['selected'] = $rape;
			}
			return $return;
		}
		else
		{
			return $return;
		}
	}
}