<?php
/**
 * @brief		Content Router extension: Reviews
 * @author		<a href='http://www.invisionpower.com'>Invision Power Services, Inc.</a>
 * @copyright	(c) 2001 - 2016 Invision Power Services, Inc.
 * @license		http://www.invisionpower.com/legal/standards/
 * @package		IPS Community Suite
 * @subpackage	Member Reviews
 * @since		10 Jul 2017
 * @version		SVN_VERSION_NUMBER
 */

namespace IPS\reviews\extensions\core\ContentRouter;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * @brief	Content Router extension: Reviews
 */
class _Reviews
{
	/**
	 * @brief	Content Item Classes
	 */
	public $classes = array();
	
	/**
	 * Constructor
	 *
	 * @param	\IPS\Member|\IPS\Member\Group|NULL	$memberOrGroup		If checking access, the member/group to check for, or NULL to not check access
	 */
	public function __construct( $memberOrGroup = NULL )
	{
		if ( $memberOrGroup === NULL or $memberOrGroup->canAccessModule( \IPS\Application\Module::get( 'reviews', 'reviews', 'front' ) ) )
		{
			$this->classes[] = 'IPS\reviews\Review';

			if( \IPS\Dispatcher::hasInstance() && \IPS\Dispatcher::i()->controllerLocation == 'front' )
            {
                $this->classes[] = 'IPS\reviews\Product';
            }
		}
	}

	/**
	 * Use a custom table helper when building content item tables
	 *
	 * @param	string			$className	The content item class
	 * @param	\IPS\Http\Url	$url		The URL to use for the table
	 * @param	array			$where		Custom where clause to pass to the table helper
	 * @return	\IPS\Helpers\Table|void		Custom table helper class to use
	 */
	public function customTableHelper( $className, $url, $where=array() )
	{
		if( $className == 'IPS\reviews\Product' )
		{
			return new \IPS\reviews\Product\Table( $url, $where );
		}
	}
}