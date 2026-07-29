<?php

class reviewsForPane
{
	public $registry;
	public $settings;

	public function __construct()
	{
		$this->registry   =  ipsRegistry::instance();
		$this->memberData =& $this->registry->member()->fetchMemberData();
		$this->settings   =& $this->registry->fetchSettings();
		$this->DB         =  $this->registry->DB();
		$this->lang		  =  $this->registry->getClass('class_localization');
		$this->registry->class_localization->loadLanguageFile( array( 'public_reviews' ), 'reviews' );
	}

	public function getOutput()
	{
		return "";
	}

	public function replaceOutput( $output, $key )
	{
		if( is_array($this->registry->output->getTemplate('global')->functionData['userInfoPane']) AND count($this->registry->output->getTemplate('global')->functionData['userInfoPane']) )
		{
		  $tag	= '<!--hook.' . $key . '-->';
		  $last   = 0;
		  foreach( $this->registry->output->getTemplate('global')->functionData['userInfoPane'] as $k => $v )
		  {
			$pos = strpos( $output, $tag, $last );
		    $reviews = 0;
                    $stuff = "";
		     if( $pos !== FALSE )
		     {
                if( $this->settings['mr_status'] == '1' && isset( $v['author']['reviews'] ) )
                {
		             $reviews = $v['author']['reviews'];
                     $stuff = $this->registry->output->getTemplate('reviews_hooks')->reviewsInPane($reviews);
		        }
			$output = substr_replace( $output, $stuff . $tag, $pos, strlen( $tag ) );
			$last   = $pos + strlen( $tag . $stuff );
		    $reviews = 0;
                    $stuff = "";
		    }
         }
		}
		return $output;
	}
}