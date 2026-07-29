<?php


namespace IPS\reviews\modules\front\reviews;

/* To prevent PHP errors (extending class does not exist) revealing path */
use IPS\Output;

if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * category
 */
class _category extends \IPS\Dispatcher\Controller
{
    /**
     * @var \IPS\reviews\Category
     */
    protected $category = null;

	/**
	 * Execute
	 *
	 * @return	void
	 */
	public function execute()
	{
		try
        {
            $this->category = \IPS\reviews\Category::load( \IPS\Request::i()->id );
        }
        catch( \OutOfRangeException $e )
        {
            \IPS\Output::i()->error( 'node_error', '1FRRC/1' );
        }

		parent::execute();

        \IPS\Output::i()->cssFiles = array_merge( \IPS\Output::i()->cssFiles, \IPS\Theme::i()->css( 'reviews.css', 'reviews', 'front' ) );
	}

	/**
	 * ...
	 *
	 * @return	void
	 */
	protected function manage()
	{
	    // if this is a product parent, show the product list
        if( !$this->category->hasChildren() )
        {
            $this->products();
            return;
        }

        $title = $this->category->name;
        $root = $this->category->root();
        if( $root !== null && $root->_id != $this->category->_id )
        {
            if( $root->_id == 1 )
            {
                $title .= " Destination Wedding Resort Review";
            }
            else
            {
                $title = "Destination Wedding " . $title;
            }
        }

        \IPS\Output::i()->title = $title;
        foreach( $this->category->parents() as $parent )
        {
            \IPS\Output::i()->breadcrumb[] = array( $parent->url(), $parent->name );
        }
        \IPS\Output::i()->breadcrumb[] = array( null, $this->category->name );
        \IPS\Output::i()->output = \IPS\Theme::i()->getTemplate( 'browse' )->category( $this->category );
	}

    /**
     * Show the products in the category
     */
	protected function products()
    {
		$table = new \IPS\reviews\Product\Table( $this->category->url(), array(), $this->category );

        if( \IPS\Request::i()->isAjax() )
        {
            \IPS\Output::i()->sendOutput( (string)$table );
        }

        $title = $this->category->name;
        $root = $this->category->root();
        if( $root !== null && $root->_id != $this->category->_id )
        {
            if( $root->_id == 1 )
            {
                $title .= " Destination Wedding Resort Review";
            }
            else
            {
                $title = "Destination Wedding " . $title;
            }
        }

        \IPS\Output::i()->title = $title;
        \IPS\Output::i()->output = \IPS\Theme::i()->getTemplate( 'category' )->view( $this->category, (string)$table );
    }
}