<?php
class sodChangeTopicTitles_pfft extends overloadTopicMetaTagsTopics {
	public function doExecute( ipsRegistry $registry ) {
		//-----------------------------------------
		// INIT
		//-----------------------------------------

		$post_data = array();
		$poll_data = '';
		$function  = '';
		
		/* Print CSS */
		$this->registry->output->addToDocumentHead( 'raw', "<link rel='stylesheet' type='text/css' title='Main' media='print' href='{$this->settings['css_base_url']}style_css/{$this->registry->output->skin['_csscacheid']}/ipb_print.css' />" );
		
		/* Followed stuffs */
		require_once( IPS_ROOT_PATH . 'sources/classes/like/composite.php' );/*noLibHook*/
		$this->_like = classes_like::bootstrap( 'forums', 'topics' );
		
		/* Init */
		if ( ! $this->registry->isClassLoaded('topics') )
		{
			$classToLoad = IPSLib::loadLibrary( IPSLib::getAppDir( 'forums' ) . "/sources/classes/topics.php", 'app_forums_classes_topics', 'forums' );
			$this->registry->setClass( 'topics', new $classToLoad( $this->registry ) );
		}
		
		try
		{
			/* Load up the data dudes */
			$this->registry->getClass('topics')->autoPopulate( null, false );
		}
		catch( Exception $crowdCheers )
		{
			$msg = str_replace( 'EX_', '', $crowdCheers->getMessage() );
			
			$this->registry->output->showError( $msg, 10340, null, null, 404 );
		}
		
		$this->forumClass = $this->registry->getClass('class_forums');
		$topicData      = $registry->getClass('topics')->getTopicData();
		$forumData      = $this->forumClass->getForumById( $topicData['forum_id'] );
		
		//set title
		$this->registry->output->setTitle( strip_tags( $topicData['title'] ) . '<%pageNumber%> | ' . $this->settings['board_name'] );
		//lock the setTitle function
		$registry->output->__sodTogglesSetTitle();
	
		return parent::doExecute($registry);
	}
}