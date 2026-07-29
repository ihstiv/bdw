#!/usr/local/bin/php
<?php

/**
 * <pre>
 * Invision Power Services
 * IP.Board v3.4.5
 * Main public executable wrapper.
 * Set-up and load module to run
 * Last Updated: $Date: 2012-07-12 16:42:58 -0400 (Thu, 12 Jul 2012) $
 * </pre>
 *
 * @author 		$Author: bfarber $
 * @copyright	(c) 2001 - 2009 Invision Power Services, Inc.
 * @license		http://www.invisionpower.com/company/standards.php#license
 * @package		IP.Board
 * @link		http://www.invisionpower.com
 * @version		$Rev: 11073 $
 *
 */

define( 'IPS_IS_SHELL', TRUE );
define( 'IPB_THIS_SCRIPT', 'admin' );

if ( is_file( './initdata.php' ) )
{
	require_once( './initdata.php' );/*noLibHook*/
}
else
{
	require_once( '../initdata.php' );/*noLibHook*/
}

require_once( IPS_ROOT_PATH . 'sources/base/ipsRegistry.php' );/*noLibHook*/
require_once( IPS_ROOT_PATH . 'sources/base/ipsController.php' );/*noLibHook*/

$reg = ipsRegistry::instance();
$reg->init();

/* Ensure it's CLI */
$cli = php_sapi_name() === 'cli';

if ( ! $cli )
{
      print "<html><head><title>Warning</title></head>\n";
      print "<body style='text-align:center'>\n";
      print "This script is meant to be run via command line<br />\n";
      print "More information:<br />\n";
      print "<a href=\"http://www.google.com/search?hl=en&q=php+cli+windows\" target=\"_blank\">http://www.google.com/search?hl=en&q=php+cli+windows</a><br />\n";
      print "This script will not run through a webserver.<br />\n";
      print "</body></html>\n";
      exit();
}


print "\n                   ";
print "\n (_) _ __   ____   ";
print "\n | || '_ \ / ___'  ";
print "\n | || |_) |  \__.  ";
print "\n | || .__/.\___  \ ";
print "\n |_||_|  |_______/  \n\n";

$moo = new moo( $reg );

class moo
{
	function __construct( ipsRegistry $registry )
	{
		$this->registry   =  $registry;
		$this->DB         =  $this->registry->DB();
		$this->settings   =& $this->registry->fetchSettings();
		$this->request    =& $this->registry->fetchRequest();
		$this->cache      =  $this->registry->cache();
		$this->caches     =& $this->registry->cache()->fetchCaches();
		$this->stdin      =  fopen('php://stdin', 'r');
		
		/* Gallery Object */
		require_once( IPSLib::getAppDir('gallery') . '/sources/classes/gallery.php' );/*noLibHook*/
		$registry->setClass( 'gallery', new ipsGallery( $registry ) );
		
		$this->albums   = $this->registry->gallery->helper('albums');
		$this->images   = $this->registry->gallery->helper('image');
		$this->moderate = $this->registry->gallery->helper('moderate');
		
		/* Load up gallery boyo */
		$this->_print( "--------------------------------------------\nWelcome to the IP.Gallery Rebuild Tool\n--------------------------------------------\n" );
		$this->_print( "[1] Rebuild Album Data (Cover image, comment counts, etc)" );
		$this->_print( "[2] Rebuild Image Data (Thumbnail images, etc)" );
		$this->_print( "[3] Rebuild Image SEO Data" );
		
		$this->_print( "Enter Choice: ", "" );

		$option = $this->_fetchOption();
		
		if ( stristr( $option, 'look' ) )
		{
			$this->_print("\nYou see a forest full of shadows. In the distance smoke rises from a small building. There is a troll here." );
			exit;
		}
			
		switch( $option )
		{
			case 1:
				$this->_albumData();
			break;
			case 2:
				$this->_images();
			break;
			case 3:
				$this->_seoImages();
			break;
			case 99:
				$this->_print("\n100!");
			break;
			default:
				$this->_print("\nThat wasn't a real option and I strongly believe you knew that");
			break;
		}
	}

	/**
	 * Rebuild All Album Data
	 */
	private function _albumData()
	{
		$this->DB->build( array( 'select' => '*',
								 'from'   => 'gallery_albums' ) );
		
		$o = $this->DB->execute();
		
		while( $row = $this->DB->fetch( $o ) )
		{
			$this->albums->resync( $row );
		}
		
		$this->_print("Album Data rebuilt");
		exit();
	}

	/**
	 * Rebuild Images
	 */
	private function _images()
	{
		/* INIT */
		$start = time();
		$done  = 0;
		
		$this->DB->build( array( 'select' => '*',
								 'from'   => 'gallery_images',
								 'order'  => 'image_id ASC' )  );
								
		$o = $this->DB->execute();
		
		while( $row = $this->DB->fetch( $o ) )
		{
			$done++;
			
			$this->images->resync( $row );
			$this->images->buildSizedCopies( $row );
			
			if ( $done % 50 == 0 )
			{
				$this->_print( "Completed... " . $done . " (IMG ID=" . $row['image_id'] . " total=" . ( $done ) . ")" );
			}
			
			/* Clear cached queries */
			$this->DB->obj['cached_queries'] = array();
		}
		
		$end = time();
		$tkn = ( $end - $start) / 60;
		
		$this->_print( "Finished Images. Took " . $tkn . "m\n" );
	}
	
	/**
	 * Rebuild Images
	 */
	private function _seoImages()
	{
		/* INIT */
		$start = time();
		$done  = 0;
		
		$this->DB->build( array( 'select' => '*',
								 'from'   => 'gallery_images',
								 'order'  => 'image_id ASC' )  );
								
		$o = $this->DB->execute();
		
		while( $row = $this->DB->fetch( $o ) )
		{
			$done++;
			
			$this->DB->update( 'gallery_images', array( 'image_caption_seo' => IPSText::makeSeoTitle( $row['image_caption'] ) ), 'image_id=' . $row['image_id'] );
			
			if ( $done % 50 == 0 )
			{
				$this->_print( "Completed... " . $done . " (IMG ID=" . $row['image_id'] . " total=" . ( $done ) . ")" );
			}
			
			/* Clear cached queries */
			$this->DB->obj['cached_queries'] = array();
		}
		
		$end = time();
		$tkn = ( $end - $start) / 60;
		
		$this->_print( "Finished Images. Took " . $tkn . "m\n" );
	}


	/**
	 * Out to stdout
	 */
	private function _print( $message, $newline="\n" )
	{
		$stdout = fopen('php://stdout', 'w');
		fwrite( $stdout, $message . $newline );
		fclose( $stdout );
	}
	
	/* Fetch option
	 *
	 */
	private function _fetchOption()
	{
		return trim( fgets( $this->stdin ) );
	}
}

exit();