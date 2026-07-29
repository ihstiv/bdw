<?php

class canonPageUrl extends public_ccs_pages_pages
{
    protected function _getPageContent( $page )
    {
        $url = $this->registry->ccsFunctions->returnPageUrl($page);
        $this->registry->output->addToDocumentHead("raw", '<link id="ipsCanonical" rel="canonical" href="' . $url . '"/>');
        
        return parent::_getPageContent($page);
    }
}