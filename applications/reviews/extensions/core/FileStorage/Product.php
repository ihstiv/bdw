<?php
/**
 * @brief		File Storage Extension: Product
 * @author		<a href='http://www.invisionpower.com'>Invision Power Services, Inc.</a>
 * @copyright	(c) 2001 - 2016 Invision Power Services, Inc.
 * @license		http://www.invisionpower.com/legal/standards/
 * @package		IPS Community Suite
 * @subpackage	Member Reviews
 * @since		19 Jun 2017
 * @version		SVN_VERSION_NUMBER
 */

namespace IPS\reviews\extensions\core\FileStorage;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * File Storage Extension: Product
 */
class _Product
{
	/**
	 * Count stored files
	 *
	 * @return	int
	 */
	public function count()
	{
		return (int)\IPS\Db::i()->select( 'count(product_id)', 'reviews_products', 'product_image is not null' )->first();
	}
	
	/**
	 * Move stored files
	 *
	 * @param	int			$offset					This will be sent starting with 0, increasing to get all files stored by this extension
	 * @param	int			$storageConfiguration	New storage configuration ID
	 * @param	int|NULL	$oldConfiguration		Old storage configuration ID
	 * @throws	\UnderflowException					When file record doesn't exist. Indicating there are no more files to move
	 * @return	void|int							An offset integer to use on the next cycle, or nothing
	 */
	public function move( $offset, $storageConfiguration, $oldConfiguration=NULL )
	{
        $row = \IPS\Db::i()->select( 'product_id, product_image', 'reviews_products', 'product_image is not null', 'product_id', array( $offset, 1  ) )->first();
        try
        {
            $file = \IPS\File::get( $oldConfiguration ?: 'reviews_Product', $row['product_image'] )->move( $storageConfiguration );
            if( (string)$file != $row['product_image'] )
            {
                \IPS\Db::i()->update( 'reviews_products', array( 'product_image' => (string)$file ), array( 'product_id=?', $row['product_id'] ) );
            }
        }
        catch( \OutOfRangeException $e ){}
	}

	/**
	 * Check if a file is valid
	 *
	 * @param	string	$file		The file path to check
	 * @return	bool
	 */
	public function isValidFile( $file )
	{
	    try
        {
            $test = \IPS\Db::i()->select( 'product_id', 'reviews_products', array( 'product_image=?', (string)$file ) )->first();
            return true;
        }
        catch( \UnderflowException $e )
        {
            return false;
        }
	}

	/**
	 * Delete all stored files
	 *
	 * @return	void
	 */
	public function delete()
	{
	    foreach( \IPS\Db::i()->select( 'product_id, product_image', 'reviews_products', 'product_image is not null', 'product_id' ) as $row )
        {
            try
            {
                \IPS\File::get( 'reviews_Product', $row['product_image'] )->delete();
            }
            catch( \OutOfRangeException $e ){}
        }
	}
}