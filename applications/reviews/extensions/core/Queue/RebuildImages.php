<?php
/**
 * @brief		Background Task
 * @author		<a href='https://www.invisioncommunity.com'>Invision Power Services, Inc.</a>
 * @copyright	(c) Invision Power Services, Inc.
 * @license		https://www.invisioncommunity.com/legal/standards/
 * @package		Invision Community
 * @subpackage	Reviews
 * @since		03 Apr 2018
 */

namespace IPS\reviews\extensions\core\Queue;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * Background Task
 */
class _RebuildImages
{
	/**
	 * Parse data before queuing
	 *
	 * @param	array	$data
	 * @return	array
	 */
	public function preQueueData( $data )
	{
        $data['count'] = (int)\IPS\Db::i()->select( 'count(image_id)', 'gallery_images' )->first();
		return $data;
	}

	/**
	 * Run Background Task
	 *
	 * @param	mixed						$data	Data as it was passed to \IPS\Task::queue()
	 * @param	int							$offset	Offset
	 * @return	int							New offset
	 * @throws	\IPS\Task\Queue\OutOfRangeException	Indicates offset doesn't exist and thus task is complete
	 */
	public function run( $data, $offset )
	{
		$limit = 20;
		foreach( \IPS\Db::i()->select( '*', 'gallery_images', array(), 'image_id', array( $offset, $limit ) ) as $row )
        {
            try
            {
                $image	= \IPS\gallery\Image::constructFromData( $row );
                $image->deleteThumbnails();
                $image->buildThumbnails();
                $image->save();
            }
            catch ( \Exception $e ) {}
        }

        $offset += $limit;
		if( $offset >= $data['count'] )
        {
            throw new \IPS\Task\Queue\OutOfRangeException;
        }

        return $offset;
	}
	
	/**
	 * Get Progress
	 *
	 * @param	mixed					$data	Data as it was passed to \IPS\Task::queue()
	 * @param	int						$offset	Offset
	 * @return	array( 'text' => 'Doing something...', 'complete' => 50 )	Text explaining task and percentage complete
	 * @throws	\OutOfRangeException	Indicates offset doesn't exist and thus task is complete
	 */
	public function getProgress( $data, $offset )
	{
	    $complete = $offset ? ( round( 100 / $data['count'] * $offset, 2 ) ) : 0;
		return array( 'text' => 'Rebuilding Gallery Images', 'complete' => $complete );
	}

	/**
	 * Perform post-completion processing
	 *
	 * @param	array	$data
	 * @return	void
	 */
	public function postComplete( $data )
	{

	}
}