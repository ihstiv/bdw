<?php

/*
+---------------------------------------------------------------------------
|   IP.Board v3.4.5
|   ========================================
|   by Matthew Mecham
|   (c) 2008 Invision Power Services
|   http://www.invisionpower.com
|   ========================================
+---------------------------------------------------------------------------
|   Invision Power Board IS NOT FREE SOFTWARE!
+---------------------------------------------------------------------------
|   http://www.invisionpower.com/
|   > $Id: galleryRebuild4_php.php 11352 2012-09-19 22:02:05Z bfarber $
|   > $Revision: 11352 $
|   > $Date: 2012-09-19 18:02:05 -0400 (Wed, 19 Sep 2012) $
+---------------------------------------------------------------------------
*/
@set_time_limit( 3600 );
define( 'IMAGES_PER_GO', 25 );
define( 'ALBUMS_PER_GO', 100 );

/**
* Main public executable wrapper.
*
* Set-up and load module to run
*
* @package	IP.Board
* @author   Matt Mecham
* @version	3.0
*/

if ( is_file( './initdata.php' ) )
{
	require_once( './initdata.php' );/*noLibHook*/
}
else
{
	require_once( '../initdata.php' );/*noLibHook*/
}

require_once( IPS_ROOT_PATH . 'sources/base/ipsRegistry.php' );/*noLibHook*/

$reg = ipsRegistry::instance();
$reg->init();

$moo = new moo( $reg );

class moo
{
	private $processed = 0;
	private $parser;
	private $oldparser;
	private $start     = 0;
	private $end       = 0;
	
	function __construct( ipsRegistry $registry )
	{
		$this->registry   =  $registry;
		$this->DB         =  $this->registry->DB();
		$this->settings   =& $this->registry->fetchSettings();
		$this->request    =& $this->registry->fetchRequest();
		$this->cache      =  $this->registry->cache();
		$this->caches     =& $this->registry->cache()->fetchCaches();
		$this->memberData = array();

		/* Gallery Object */
		require_once( IPSLib::getAppDir('gallery') . '/sources/classes/gallery.php' );/*noLibHook*/
		$this->registry->setClass( 'gallery', new ipsGallery( $this->registry ) );
		$this->images = $this->registry->gallery->helper('image');
		$this->albums = $this->registry->gallery->helper('albums');
		
		switch( $this->request['do'] )
		{
			case 'images':
				$this->convertImages();
			break;
			case 'resync':
				$this->resyncAlbums();
			break;
			default:
				$this->splash();
			break;
		}
	}
	
	function show( $content, $url='' )
	{
		if ( $url )
		{
			$firstBit = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'];
			$refresh = "<meta http-equiv='refresh' content='0; url={$firstBit}?{$url}'>";
		}
		
		if ( is_array( $content ) )
		{
			$content = implode( "<br />", $content );
		}
		
		$html = <<<EOF
		<html>
			<head>
				<title>Gallery Rebuild</title>
				$refresh
			</head>
			<body>
				{$content}
			</body>
		</html>			
EOF;

		print $html; exit();
	}
	
	/**
	 * SPLASH
	 */
	function splash()
	{
		$html = <<<EOF
		Do you want to:<br />
		<a href="?do=resync">Resync Albums</a><br />
		<a href="?do=images">Rebuild Images</a>
		<br />
EOF;
	
		$this->show( $html );
	}
	
	/**
	 * Convert images
	 */
	function convertImages()
	{
		$id         = intval( $this->request['id'] );
		$lastId     = 0;
		$done  		= intval( $this->request['done'] );
		$cycleDone  = 0;
		$content    = array();

		/* skipping? */
		$total = $this->DB->buildAndFetch( array( 'select' => 'count(*) as count',
										          'from'   => 'gallery_images' ) );
		
		/* Fetch batch */
		$this->DB->build( array( 'select' => '*',
								 'from'   => 'gallery_images',
								 'where'  => 'image_id > ' . $id,
								 'limit'  => array( 0, IMAGES_PER_GO ),
								 'order'  => 'image_id ASC' )  );
								
		$o = $this->DB->execute();
		
		while( $row = $this->DB->fetch( $o ) )
		{
			$cycleDone++;
			$lastId = $row['image_id'];
			
			$content[] = "Rebuilding image " . ( $done + $cycleDone ) . " (id: " . $row['image_id'] . ") of " . $total['count'];
			
			$this->images->resync( $row );
			$this->images->buildSizedCopies( $row );
		}
		
		/* More? */
		if ( $cycleDone )
		{
			/* Reset */
			$done += $cycleDone;
			
			$this->show( $content, "do=images&id=" . $lastId . "&done=" . $done );
		}
		else
		{
			$this->show( "All images rebuilt" );
			return;
		}
	}
	
	/**
	 * resync albums
	 */
	function resyncAlbums()
	{
		$id         = intval( $this->request['id'] );
		$lastId     = 0;
		$done  		= intval( $this->request['done'] );
		$cycleDone  = 0;
		$content    = array();
		
		/* skipping? */
		$total = $this->DB->buildAndFetch( array( 'select' => 'count(*) as count',
										          'from'   => 'gallery_albums' ) );
		
		/* Fetch batch */
		$this->DB->build( array( 'select' => '*',
								 'from'   => 'gallery_albums',
								 'where'  => 'album_id > ' . $id,
								 'limit'  => array( 0, ALBUMS_PER_GO ),
								 'order'  => 'album_id ASC' )  );
								
		$o = $this->DB->execute();
		
		while( $row = $this->DB->fetch( $o ) )
		{
			$cycleDone++;
			$lastId = $row['album_id'];
			
			$content[] = "Rebuilding album " . ( $done + $cycleDone ) . " (id: " . $row['album_id'] . ") of " . $total['count'];
			
			$this->albums->resync( $row );
		}
		
		/* More? */
		if ( $cycleDone )
		{
			/* Reset */
			$done += $cycleDone;
			
			$this->show( $content, "do=resync&id=" . $lastId . "&done=" . $done );
		}
		else
		{
			$this->show( "All albums resynchronized" );
			return;
		}
	}
}

