<?php


namespace IPS\reviews\modules\front\reviews;

/* To prevent PHP errors (extending class does not exist) revealing path */
use IPS\_Theme;
use IPS\Helpers\Table\Content;

if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * product
 */
class _product extends \IPS\Content\Controller
{
    protected static $contentModel = 'IPS\reviews\Product';

	/**
	 * Execute
	 *
	 * @return	void
	 */
	public function execute()
	{
		parent::execute();
	}

	/**
	 * ...
	 *
	 * @return	void
	 */
	protected function manage()
	{
		$product = parent::manage();
		if( $product === null )
        {
            \IPS\Output::i()->error( 'node_error', '1FREVP/4', 404 );
        }

		// build the reviews table
        $table = new \IPS\Helpers\Table\Content( 'IPS\reviews\Review', $product->url(), array( array( 'review_product_id=?', $product->id ) ) );
        $table->tableTemplate = array( \IPS\Theme::i()->getTemplate( 'product' ), 'reviewTable' );
        $table->rowsTemplate = array( \IPS\Theme::i()->getTemplate( 'product' ), 'reviewRows' );
        $table->sortBy = $table->sortBy ?: 'review_date';
        $table->sortOptions = array(
            'date' => 'review_date'
        );
        $table->sortDirection = $table->sortDirection ?: 'desc';
        $table->noModerate = true;

        $title = $product->name . ' Product Overview';
        $root = $product->container()->root();
        if( $root !== null )
        {
            if( $root->_id == 1 )
            {
                $title .= " | " . $product->container()->_title . ' Destination Wedding Resort Review';
            }
            else
            {
                $title .= " | Destination Wedding " . $product->container()->_title;
            }
        }

        \IPS\Output::i()->jsonLd['product'] = array(
            '@context'		=> "http://schema.org",
            '@type' => $product->container()->schemaname,
            'name' => $product->name,
            'image' => ( $product->image ? (string)\IPS\File::get( 'reviews_Product', $product->image )->url : "" ),
            'description' => \strip_tags( $product->content() ),
            'aggregateRating' => array(
                '@type' => 'AggregateRating',
                'ratingValue' => $product->averageRating(),
                'ratingCount' => $product->total_reviews
            )
        );

        \IPS\Output::i()->title = $title;
		\IPS\Output::i()->cssFiles = array_merge( \IPS\Output::i()->cssFiles, \IPS\Theme::i()->css( 'reviews.css', 'reviews', 'front' ) );
		\IPS\Output::i()->output = \IPS\Theme::i()->getTemplate( 'product' )->view( $product, (string)$table );
	}

    /**
     * Write a review for this product
     */
	protected function writeReview()
    {
        try
        {
            $product = \IPS\reviews\Product::load( \IPS\Request::i()->id );
        }
        catch( \OutOfRangeException $e )
        {
            \IPS\Output::i()->error( 'node_error', '1FREVP/1', 404 );
        }

        if( !$product->canReview() )
        {
            \IPS\Output::i()->error( 'No Permission', '1FREVP/2' );
        }

        $form = \IPS\reviews\Review::create( $product->asNode() );

        \IPS\Output::i()->title = \IPS\Member::loggedIn()->language()->addToStack( 'write_review' );
        foreach( $product->container()->parents() as $parent )
        {
            \IPS\Output::i()->breadcrumb[] = array( $parent->url(), $parent->_title );
        }
        \IPS\Output::i()->breadcrumb[] = array( $product->url(), $product->name );
        \IPS\Output::i()->breadcrumb[] = array( null, \IPS\Member::loggedIn()->language()->addToStack( 'write_review' ) );
        \IPS\Output::i()->output = \IPS\Theme::i()->getTemplate( 'product' )->reviewForm( $product, (string)$form );
    }

    /***
     * Assign an owner to the product
     */
    protected function assign()
    {
        try
        {
            $product = \IPS\reviews\Product::load( \IPS\Request::i()->id );
        }
        catch( \OutOfRangeException $e )
        {
            \IPS\Output::i()->error( 'node_error', '1FREVP/3', 404 );
        }

        $form = new \IPS\Helpers\Form;
        $form->class = 'ipsPad';
        $form->add( new \IPS\Helpers\Form\Member( 'product_owner', ( $product->owner_id ? \IPS\Member::load( $product->owner_id ) : null ), false, array(
            'multiple' => 1
        ) ) );

        if( $values = $form->values() )
        {
            if( $values['product_owner'] instanceof \IPS\Member && $values['product_owner']->member_id )
            {
                $product->owner_id = $values['product_owner']->member_id;
            }
            else
            {
                $product->owner_id = 0;
            }

            $product->save();

            \IPS\Output::i()->redirect( $product->url() );
        }

        \IPS\Output::i()->output = (string)$form;
    }
}