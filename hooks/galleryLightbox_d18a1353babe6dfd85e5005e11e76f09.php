<?php

class galleryLightbox extends sidebarReplace
{	
	public function sendOutput( $return=false )
	{
		if( strpos( $this->_html, "<!-- bbcodeImage-js (do not remove or edit this tag) -->" ) !== false )
		{
			$this->_html = $this->getTemplate('gallery_global')->listingLightbox( 1, 1 ) . $this->_html;
		}

		return parent::sendOutput( $return );
	}
}