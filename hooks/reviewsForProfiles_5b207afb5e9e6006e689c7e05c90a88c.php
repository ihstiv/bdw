<?php

class reviewsForProfiles
{
	public $registry;
	public $settings;

	public function __construct()
	{
		$this->registry   =  ipsRegistry::instance();
		$this->settings   =& $this->registry->fetchSettings();
		$this->DB         =  $this->registry->DB();
		$this->lang		  =  $this->registry->getClass('class_localization');
		$this->registry->class_localization->loadLanguageFile( array( 'public_reviews' ), 'reviews' );
	}

	public function getOutput()
	{
		$reviews = "";
		$stuff = "";

        if( $this->settings['mr_status'] == '1' && $this->settings['mr_view_profile'] == '1' ){

		$member	    = $this->registry->output->getTemplate('profile')->functionData['profileModern'][0]['member'];

					if ( isset( $member['reviews'] ) )
					{
                         /* The Count */
                         $reviews = intval($member['reviews']);

                         /* The new HTML */
                         $stuff = $this->registry->output->getTemplate('reviews_hooks')->reviewsInProfile($reviews);
                    }
        }

		return $stuff;
	}
}