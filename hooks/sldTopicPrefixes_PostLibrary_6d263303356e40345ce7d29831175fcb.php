<?php
/**
 * @package		Advanced Tags & Prefixes
 * @author		Ryan Hoerr
 * @copyright	(c) 2012 Ryan Hoerr / Sublime Development
 * @license		http://www.sublimism.com/products/terms-of-use
 * @version		$Id: topic_prefixes.xml 40 2013-07-30 04:12:33Z No1_1000 $
 * @updated		$Date: 2013-07-30 00:12:33 -0400 (Tue, 30 Jul 2013) $
 */

/**
 * When submitting a new/edited topic: Check to
 * see that the prefix is valid; if so, make sure
 * that it gets saved.
 */

IPSDebug::fireBug( 'info', array( 'Loaded sldTopicPrefixes_PostLibrary' ) );

class sldTopicPrefixes_PostLibrary extends dp3rs_OverloadClassPost
{
	protected $request;
	
	/**
	 * Adding a topic: Check if a prefix is required,
	 * and whether they entered a valid one.
	 */
	public function addTopic() //:1407
	{
		/**
		 * Did we enter a valid prefix? Is one required?
		 */
		$this->checkRequired();
		
		/**
		 * Update the topic prefix
		 */
		if( !empty( $_REQUEST['prefix'] ) ) {
			$_POST['ipsTags'] = $_REQUEST['prefix'] . ',' . $_POST['ipsTags'];
		}
		else {
			$_REQUEST['ipsTags_prefix'] = 0;
		}
		
		return parent::addTopic();
	}
	
	/**
	 * Editing a topic: Run the required/valid check
	 * like above, then do the update ourselves.
	 *
	 * The 'update topic' data hook only fires when
	 * the title or desc is changed--if they only
	 * touch the prefix, no go. Hence this.
	 */
	public function editPost() //:1764
	{
		/**
		 * Try to get the existing topic data.
		 */
		$topic = $this->getTopicData();
		
		if( isset( $this->request['TopicTitle'] ) && $topic['topic_firstpost'] == $this->request['p'] ) {
			/**
			 * Did we enter a valid prefix? Is one required?
			 */
			$this->checkRequired();
			
			/**
			 * Update the topic prefix
			 */
			if( !empty( $this->request['prefix'] ) ) {
				$_POST['ipsTags'] = $this->request['prefix'] . ',' . $_POST['ipsTags'];

				/**
				 * Update last post info?
				 */
				$forum = $this->DB->buildAndFetch( array(	'select'	=> 'last_id',
															'from'		=> 'forums',
															'where'		=> 'id='.$topic['forum_id'] ) );
				
				if( $forum['last_id'] == $topic['tid'] ) {
					$formatted = $this->registry->output->getTemplate( 'global_other' )->tagPrefix( $this->request['prefix'] );
					$this->DB->update( 'forums', array( 'newest_prefix' => $formatted ), 'id=' . $topic['forum_id'] );
				}
			}
			else {
				$_REQUEST['ipsTags_prefix'] = 0;
			}
		}
		
		return parent::editPost();
	}
	
	/**
	 * Prefix field validation
	 */
	protected function checkRequired()
	{
		$this->registry =  ipsRegistry::instance();
		$this->request	=& $this->registry->fetchRequest();
		$this->prefixes	=  $this->registry->cache()->getCache('topic_prefixes');
		$this->lang		=  $this->registry->getClass('class_localization');
		$this->lang->loadLanguageFile( array( 'public_global' ), 'advancedtagsprefixes' );

		if( !isset($this->prefixesByName) && count($this->prefixes) > 0 ) {
			foreach( $this->prefixes as $prefix ) {
				$this->prefixesByName[ IPSText::mbstrtolower( $prefix['prefix_title'] ) ] = $prefix;
			}
		}
		
		/**
		 * Find prefixes we're allowed to use.
		 */
		$forum 		= $this->getForumData();
		$this->memb = $this->registry->member()->fetchMemberData();
		$tags		= array_filter( explode( ",", $forum['tag_predefined'] ) );
		
		$allowed_prefixes = array();
		if( count($tags) ) {
			foreach( $tags as $tag ) {
				if( is_array( $this->prefixesByName[ IPSText::mbstrtolower( trim($tag) ) ] ) ) {
					$prefix_allowed	= array_filter( explode( ',', $this->prefixesByName[ IPSText::mbstrtolower( trim($tag) ) ]['prefix_groups'] ) );

					if( !count($prefix_allowed) || IPSMember::isInGroup( $this->memb, $prefix_allowed ) ) {
						$allowed_prefixes[] = IPSText::mbstrtolower( trim($tag) );
					}
				}
			}
		}

		/**
		 * If we chose a prefix, is it one of them?
		 */
		if( array_search( IPSText::mbstrtolower( $this->request['prefix'] ), $allowed_prefixes ) === false ) {
			$this->request['prefix'] = '';
		}
		
		/**
		 * Did we enter one if we're required to?
		 */
		if(	$forum['require_prefix'] == 1
			&& empty( $this->request['prefix'] )
			&& !( $this->settings['prefix_exclude_supers'] == 1 && $this->getAuthor('g_is_supmod') )
		  ) {
			$this->setPostError( 'pre_none_entered' );
		}
	}
}
