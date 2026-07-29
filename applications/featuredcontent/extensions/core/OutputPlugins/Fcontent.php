<?php

namespace IPS\featuredcontent\extensions\core\OutputPlugins;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * Template Plugin
 */
class _Fcontent
{
	/**
	 * @brief	Can be used when compiling CSS
	 */
	public static $canBeUsedInCss = FALSE;
	
	/**
	 * Run the plug-in
	 *
	 * @param	string 		$data	  The initial data from the tag
	 * @param	array		$options    Array of options
	 * @return	string		Code to eval
	 */
	 
	public static $loadedJSandCSS = false;
	
	public static function runPlugin( $data, $options )
	{
		if ( ! self::$loadedJSandCSS )
		{
			self::$loadedJSandCSS = true;
			\IPS\Output::i()->jsFiles = array_merge( \IPS\Output::i()->jsFiles, \IPS\Output::i()->js( 'front_slider.js', 'featuredcontent', 'front' ) );
			\IPS\Output::i()->cssFiles = array_merge( \IPS\Output::i()->cssFiles, \IPS\Theme::i()->css( 'slider.css', 'featuredcontent', 'front' ) );
		}		
		return "\IPS\Application::load('featuredcontent')->show( \"$data\" )";
	}
}