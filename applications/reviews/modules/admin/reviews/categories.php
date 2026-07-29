<?php


namespace IPS\reviews\modules\admin\reviews;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * categories
 */
class _categories extends \IPS\Node\Controller
{
    public static $csrfProtected = true;

	/**
	 * Node Class
	 */
	protected $nodeClass = 'IPS\reviews\Category';
	
	/**
	 * Execute
	 *
	 * @return	void
	 */
	public function execute()
	{
		
		parent::execute();
	}
}