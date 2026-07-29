<?php
/**
 * @brief		fcontentWidget Widget
 * @author		<a href='http://www.invisionpower.com'>Invision Power Services, Inc.</a>
 * @copyright	(c) 2001 - SVN_YYYY Invision Power Services, Inc.
 * @license		http://www.invisionpower.com/legal/standards/
 * @package		IPS Social Suite
 * @subpackage	featuredcontent
 * @since		13 Dec 2014
 * @version		SVN_VERSION_NUMBER
 */

namespace IPS\featuredcontent\widgets;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * fcontentWidget Widget
 */
class _fcontentWidget extends \IPS\Widget
{
	/**
	 * @brief	Widget Key
	 */
	public $key = 'fcontentWidget';
	
	/**
	 * @brief	App
	 */
	public $app = 'featuredcontent';
		
	/**
	 * @brief	Plugin
	 */
	public $plugin = '';
	
	public static $loadedJSandCSS = false;
	/**
	 * Initialise this widget
	 *
	 * @return void
	 */ 
	public function init()
	{
		if ( ! self::$loadedJSandCSS )
		{
			self::$loadedJSandCSS = true;
			\IPS\Output::i()->jsFiles = array_merge( \IPS\Output::i()->jsFiles, \IPS\Output::i()->js( 'front_slider.js', 'featuredcontent', 'front' ) );
			\IPS\Output::i()->cssFiles = array_merge( \IPS\Output::i()->cssFiles, \IPS\Theme::i()->css( 'slider.css', 'featuredcontent', 'front' ) );
		}
		parent::init();
	}
	
	/**
	 * Specify widget configuration
	 *
	 * @param	null|\IPS\Helpers\Form	$form	Form object
	 * @return	null|\IPS\Helpers\Form
	 */
	public function configuration( &$form=null )
	{
 		if ( $form === null )
		{
	 		$form = new \IPS\Helpers\Form;
 		}

		$form->add( new \IPS\Helpers\Form\YesNo( 'fcontent_use_wrapper', $this->configuration['fcontent_use_wrapper'], TRUE, array() ) );	

		$options = array();
		
		foreach( \IPS\featuredcontent\Slider::roots() as $sd )
		{
			if ( $sd->enabled == 1 )
			{
				$options[ $sd->id ]	= $sd->title;
			}
		}

		$form->add( new \IPS\Helpers\Form\Select( 'sliderID_to_show', isset( $this->configuration['sliderID_to_show'] ) ? \intval( $this->configuration['sliderID_to_show'] ) : 0, TRUE, array( 'options' => $options, 'parse' => 'normal' ) ) );	
		
		$form->add( new \IPS\Helpers\Form\Radio( 'fcontent_where_to_show', $this->configuration['fcontent_where_to_show'], TRUE, array(
			'options' => array( 'all' => 'fcontent_where_to_show_all', 'pages' => 'fcontent_where_to_show_pages' ),
			'toggles' => array(
				'pages'	=> array( 'fcontent_pages' )
			)
		) ) );		
		
		$form->add( new \IPS\Helpers\Form\TextArea( 'fcontent_pages', isset( $this->configuration['fcontent_pages'] ) ? $this->configuration['fcontent_pages'] : $_SERVER["HTTP_REFERER"], FALSE, array('rows' => 3), null, null, null, 'fcontent_pages' ) );	
				
 		return $form;
 	} 
 
 	
 	 /**
 	 * Ran before saving widget configuration
 	 *
 	 * @param	array	$values	Values from form
 	 * @return	array
 	 */
 	public function preConfig( $values )
 	{	
 		return $values;
 	}
	
	public function render()
	{
		if ( $this->configuration['fcontent_where_to_show'] == 'pages' && $this->configuration['fcontent_pages'])
		{
			$currentpageURL = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			$pages = explode("\n", str_replace("\r", '', $this->configuration['fcontent_pages']));
			foreach( $pages as $page )
			{
				$page = explode("://", $page);
				$pagelist[] = $page[1];
			}
			if ( !\in_array( $currentpageURL, $pagelist ) )
			{
				return '';
			}
		}
		
		try
		{
			$slider = \IPS\featuredcontent\Slider::loadAndCheckPerms( $this->configuration['sliderID_to_show'], 'view' );

			return $this->output( $slider, $this->configuration );				
		}
		catch( \OutOfRangeException $e )
		{
			return '';
		}			
	}	
}