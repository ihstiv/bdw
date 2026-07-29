<?php
/**
 * @brief		Featured Content Application Class
 * @author		<a href='http://ipsviet.com'>onlyME</a>
 * @copyright	(c) 2014 onlyME
 * @package		IPS Social Suite
 * @subpackage	Featured Content
 * @since		11 Dec 2014
 * @version		
 */
 
namespace IPS\featuredcontent;

/**
 * Featured Content Application Class
 */
class _Application extends \IPS\Application
{
	/**
	 * [Node] Get Icon for tree
	 *
	 * @note	Return the class for the icon (e.g. 'globe')
	 * @return	string|null
	 */
	protected function get__icon()
	{
		return 'star';
	}
	
	public static $loadedJSandCSS = false;
	
	public static function show( $id, $conf=NULL )
	{
		if ( ! self::$loadedJSandCSS )
		{
			self::$loadedJSandCSS = true;
			\IPS\Output::i()->jsFiles = array_merge( \IPS\Output::i()->jsFiles, \IPS\Output::i()->js( 'front_slider.js', 'featuredcontent', 'front' ) );
			\IPS\Output::i()->cssFiles = array_merge( \IPS\Output::i()->cssFiles, \IPS\Theme::i()->css( 'slider.css', 'featuredcontent', 'front' ) );
		}
			
		try
		{
			
			$slider = \IPS\featuredcontent\Slider::loadAndCheckPerms( $id, 'view' );
			
			if ( $slider->enabled != 1 || \count( $slider->getContents() ) == 0 )
			{
				return \IPS\Theme::i()->getTemplate( 'embed', 'featuredcontent', 'front' )->noContent( $slider );
			}
			
			if ( $slider->style == 'grid' )
			{
				$html = \IPS\Theme::i()->getTemplate( 'embed', 'featuredcontent', 'front' )->showGrid( $slider, $slider->getContents(), $conf );
			}
			else
			{
				$html = \IPS\Theme::i()->getTemplate( 'embed', 'featuredcontent', 'front' )->showSlider( $slider, $slider->getContents(), $conf );
			}
			
			return "<ul class='ipsList_reset'>" . $html . "</ul>";
		}
		catch( \OutOfRangeException $e )
		{
			return '';
		}			
	}
	
	public static function easingList()
	{
		$data = array(  'none', 'swing', 'easeInQuad', 'easeOutQuad', 'easeInOutQuad', 'easeInCubic', 'easeOutCubic', 'easeInOutCubic', 'easeInQuart', 'easeOutQuart',
						'easeInOutQuart', 'easeInQuint', 'easeOutQuint', 'easeInOutQuint', 'easeInSine', 'easeOutSine', 'easeInOutSine', 'easeInExpo', 'easeOutExpo',
						'easeInOutExpo', 'easeInCirc', 'easeOutCirc', 'easeInOutCirc', 'easeInElastic', 'easeOutElastic', 'easeInOutElastic', 'easeInBack',
						'easeOutBack', 'easeInOutBack', 'easeInBounce', 'easeOutBounce', 'easeInOutBounce' );

		foreach( $data as $v )
		{
			$easing[$v] = $v;
		}
		
		return $easing;
	}	
}