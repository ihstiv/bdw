<?php
/**
 * @brief		ReviewFeed Widget
 * @author		<a href='http://www.invisionpower.com'>Invision Power Services, Inc.</a>
 * @copyright	(c) 2001 - 2016 Invision Power Services, Inc.
 * @license		http://www.invisionpower.com/legal/standards/
 * @package		IPS Community Suite
 * @subpackage	reviews
 * @since		13 Jul 2017
 * @version		SVN_VERSION_NUMBER
 */

namespace IPS\reviews\widgets;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * ReviewFeed Widget
 */
class _ReviewFeed extends \IPS\Content\Widget
{
	/**
	 * @brief	Widget Key
	 */
	public $key = 'ReviewFeed';
	
	/**
	 * @brief	App
	 */
	public $app = 'reviews';
		
	/**
	 * @brief	Plugin
	 */
	public $plugin = '';

    /**
     * Class
     */
    protected static $class = 'IPS\reviews\Review';

    /**
     * @brief	Prevent caching for this block
     */
    public $neverCache = true;
	
	/**
	 * Initialise this widget
	 *
	 * @return void
	 */ 
	public function init()
	{
		$this->template( array( \IPS\Theme::i()->getTemplate( 'widgets', 'reviews', 'front' ), 'reviewFeed' ) );
	}

    /**
     * Specify widget configuration
     *
     * @param	null|\IPS\Helpers\Form	$form	Form object
     * @return	\IPS\Helpers\Form
     */
    public function configuration( &$form=null )
    {
        $form = parent::configuration( $form );

        $form->elements['']['widget_feed_container_review_review'] = new \IPS\Helpers\Form\Node( 'widget_feed_container_review_review', $this->configuration['widget_feed_container'] ?? 0, false, array(
            'class' => 'IPS\reviews\Category',
            'zeroVal' => 'all',
            'multiple' => true
        ) );

        return $form;
    }

    /**
     * Get where clause
     *
     * @return	array
     */
    protected function buildWhere()
    {
		$categories = null;
		if( isset( $this->configuration['widget_feed_container'] ) )
		{
			$categories = $this->configuration['widget_feed_container'];
			unset( $this->configuration['widget_feed_container'] );
		}

        $where = parent::buildWhere();

        // if we have no categories, and this is a review page, use the category root
        if( empty( $categories ) && \IPS\Dispatcher::i()->application->directory == 'reviews' && \IPS\Dispatcher::i()->controller == 'category' )
        {
            try
            {
                $category = \IPS\reviews\Category::load( \IPS\Request::i()->id );
                $categories = array( $category->root()->_id );
            }
            catch( \OutOfRangeException $e ){}
        }

        if( !empty( $categories ) )
        {
            // get all products in these categories
            $ids = array();
            foreach( $categories as $category )
            {
                $ids = array_merge( $ids, \IPS\reviews\Category::load( $category )->_descendants );
            }

            $products = iterator_to_array( \IPS\Db::i()->select( 'product_id', 'reviews_products', \IPS\Db::i()->in( 'product_category', $ids ) ) );
            if( \count( $products ) )
            {
                $where[] = array( \IPS\Db::i()->in( 'review_product_id', $products ) );
            }
        }

        return $where;
    }

    /**
     * Render a widget
     *
     * @return	string
     */
    public function render()
    {
        // if we are on the category controller, use the root title
        if( \IPS\Dispatcher::i()->application->directory == 'reviews' && \IPS\Dispatcher::i()->controller == 'category' )
        {
            try
            {
                $category = \IPS\reviews\Category::load( \IPS\Request::i()->id );
                $this->configuration['widget_feed_title'] = "New " . $category->root()->_title;
                unset( $this->configuration['language_key'] );
            }
            catch( \OutOfRangeException $e ){}
        }

        return parent::render();
    }
}