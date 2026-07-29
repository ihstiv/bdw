<?php

class topicMetaOutput extends output
{
    /**
	 * Set the title of the document
	 *
	 * @access	public
	 * @param	string		Title
	 * @return	@e void
	 */
	public function setTitle( $title )
    {
        parent::setTitle( $title );
        
        // is this a topic?
        if(IPS_APP_COMPONENT == 'forums' && $this->request['section'] == 'topics' && isset($this->request['t']))
        {
            $this->_title .= " ({$this->request['t']})";
        }
    }
}