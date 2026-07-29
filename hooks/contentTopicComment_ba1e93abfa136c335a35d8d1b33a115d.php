<?php

class contentTopicComment
{
	/**
	 * Constructor
	 *
	 * @return	@e void
	 */
	public function __construct()
	{
	}

	/**
	 * Execute data hook
	 *
	 * @param	array 		Post data to insert
	 * @return	@e void
	 */
	public function handleData( $insert )
	{
		$classToLoad = IPSLib::loadLibrary( IPSLib::getAppDir( 'ccs' ) . '/sources/databases/topics.php', 'topicsLibrary', 'ccs' );
		$_topics	 = new $classToLoad( ipsRegistry::instance() );
		$_topics->checkAndIncrementComments( $insert );
	}
}