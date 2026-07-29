<?php
/**
 * @brief		File Storage Extension: featuredcontent_Image
 * @author		<a href='http://www.invisionpower.com'>Invision Power Services, Inc.</a>
 * @copyright	(c) 2001 - SVN_YYYY Invision Power Services, Inc.
 * @license		http://www.invisionpower.com/legal/standards/
 * @package		IPS Social Suite
 * @subpackage	Featured Content
 * @since		20 Jul 2015
 * @version		SVN_VERSION_NUMBER
 */

namespace IPS\featuredcontent\extensions\core\FileStorage;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * File Storage Extension: featuredcontent_Image
 */
class _Image
{
	/**
	 * Count stored files
	 *
	 * @return	int
	 */
	public function count()
	{
		return \IPS\Db::i()->select( 'COUNT(*)', 'featuredcontent_contents', "fcc_uploadimg IS NOT NULL" )->first();
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
		$record = \IPS\Db::i()->select( '*', 'featuredcontent_contents', "fcc_uploadimg IS NOT NULL", 'fcc_id', array( $offset, 1 ) )->first();

		try
		{
			$file = \IPS\File::get( $oldConfiguration ?: 'featuredcontent_Image', $record['fcc_uploadimg'] )->move( $storageConfiguration );
			
			if ( (string) $file != $record['fcc_uploadimg'] )
			{
				\IPS\Db::i()->update( 'featuredcontent_contents', array( 'fcc_uploadimg' => (string) $file ), array( 'fcc_id=?', $record['fcc_id'] ) );
			}
		}
		catch( \Exception $e )
		{
			/* Any issues are logged */
		}
	}
	
	/**
	 * Fix all URLs
	 *
	 * @param	int			$offset					This will be sent starting with 0, increasing to get all files stored by this extension
	 * @return void
	 */
	public function fixUrls( $offset )
	{
		$record = \IPS\Db::i()->select( '*', 'featuredcontent_contents', "fcc_uploadimg IS NOT NULL", 'fcc_id', array( $offset, 1 ) )->first();
		
		if ( $new = \IPS\File::repairUrl( $record['fcc_uploadimg'] ) )
		{
			\IPS\Db::i()->update( 'featuredcontent_contents', array( 'fcc_uploadimg' => $new ), array( 'fcc_id=?', $record['fcc_id'] ) );
		}
	}
	
	/**
	 * Check if a file is valid
	 *
	 * @param	\IPS\Http\Url	$file		The file to check
	 * @return	bool
	 */
	public function isValidFile( $file )
	{
		try
		{
			$record	= \IPS\Db::i()->select( '*', 'featuredcontent_contents', array( 'fcc_uploadimg=?', (string) $file ) )->first();

			return TRUE;
		}
		catch ( \UnderflowException $e )
		{
			return FALSE;
		}
	}

	/**
	 * Delete all stored files
	 *
	 * @return	void
	 */
	public function delete()
	{
		foreach( \IPS\Db::i()->select( '*', 'featuredcontent_contents', "fcc_uploadimg IS NOT NULL" ) as $file )
		{
			try
			{
				\IPS\File::get( 'featuredcontent_Image', $file['fcc_uploadimg'] )->delete();
			}
			catch( \Exception $e ){}
		}
	}
}