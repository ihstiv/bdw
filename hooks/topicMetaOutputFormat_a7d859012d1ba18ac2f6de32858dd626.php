<?php

class topicMetaOutputFormat extends htmlOutput
{
    /**
	 * Add meta tag
	 * <code>$output->addMetaTag( 'description', 'This is a short description' );</code>
	 *
	 * @param	string		$tag		Tag name
	 * @param	string		$content	Tag content
	 * @param	boolean		$encode		Encode content
	 * @param	integer		$trimLen	Length to trim to (default 500)
	 * @return	@e void
	 * @link	http://community.invisionpower.com/tracker/issue-22826-case-sensitivity-in-meta-tags/
	 * @link	http://community.invisionpower.com/tracker/issue-32572-bbcode-included-in-meta-description
	 */
	public function addMetaTag( $tag, $content, $encode=true, $trimLen=500 )
    {
        parent::addMetaTag($tag, $content, $encode, $trimLen);
        
        // is this a topic page?
        if($tag == 'description' && IPS_APP_COMPONENT == 'forums' && $this->request['section'] == 'topics' && isset($this->request['t']))
        {
            $this->_metaTags[ $tag ][0] .= " ({$this->request['t']})";
        }
    }
}