<?php

class reviewsMerger
{
	public function handleData( $data )
	{
               // Apparently settings is not yet set up...
		  $this->registry   =  ipsRegistry::instance();
		  $this->settings   =& $this->registry->fetchSettings();
               //

                if( $this->settings['mr_status'] == '1' && $this->settings['mr_view_topic'] == '1' ){
		$data['members'] = array_merge( $data['members'], array( "reviews" ) );
		return $data;
                }
	}
}