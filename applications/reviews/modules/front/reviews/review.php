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
 * review
 */
class _review extends \IPS\Content\Controller
{
    protected static $contentModel = 'IPS\reviews\Review';
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
		$review = parent::manage();
		$product = $review->product();

		$title = $review->title . " | " . $product->name;
		$root = $product->container()->root();
		if( $root !== null )
        {
            if( $root->_id == 1 )
            {
                $title .= " | " . $product->container()->_title . " Destination Wedding Resort Review";
            }
            else
            {
                $title .= " | Destination Wedding " . $product->container()->_title;
            }
        }

        \IPS\Output::i()->jsonLd['review'] = array(
            '@context'		=> "http://schema.org",
            '@type' => 'Review',
            'itemReviewed' => array(
                '@type' => $product->container()->schemaname,
                'image' => ( $product->image ? (string)\IPS\File::get( 'reviews_Product', $product->image )->url : "" ),
                'name' => $product->name
            ),
            'author' => array(
                '@type' => 'Person',
                'name' => $review->author()->name
            ),
            'reviewRating' => array(
                '@type' => 'Rating',
                'ratingValue' => $review->overall,
                'bestRating' => 5
            ),
            'publisher' => array(
                '@type' => 'Organization',
                'name' => 'Best Destination Wedding'
            ),
            'name' => $review->title,
            'reviewBody' => \strip_tags( $review->content ),
            'datePublished' => $review->_date->rfc3339()
        );

        \IPS\Output::i()->title = $title;
		\IPS\Output::i()->cssFiles = array_merge( \IPS\Output::i()->cssFiles, \IPS\Theme::i()->css( 'reviews.css', 'reviews', 'front' ) );
		\IPS\Output::i()->output = \IPS\Theme::i()->getTemplate( 'review' )->view( $review );
	}

    /**
     * Set the breadcrumb and title
     *
     * @param	\IPS\Content\Item	$item	Content item
     * @param	bool				$link	Link the content item element in the breadcrumb
     * @return	void
     */
	protected function _setBreadcrumbAndTitle( $item, $link = TRUE )
    {
        $product = $item->product();
        foreach( $product->container()->parents() as $parent )
        {
            \IPS\Output::i()->breadcrumb[] = array( $parent->url(), $parent->name );
        }
        \IPS\Output::i()->breadcrumb[] = array( $product->url(), $product->name );
        \IPS\Output::i()->breadcrumb[] = array( null, $item->title );
        \IPS\Output::i()->title = $item->title;
    }

    /**
     * Move
     *
     * @return    void
     * @throws \IPS\Node\BadMethodCallException
     */
    protected function move()
    {
        try
        {
            $review = \IPS\reviews\Review::load( \IPS\Request::i()->id );
            if( !$review->canMove() )
            {
                throw new \DomainException;
            }
            $product = $review->container();

            $form = new \IPS\Helpers\Form( 'form', \IPS\Member::loggedIn()->language()->addToStack( 'move_send_to_container', FALSE, array( 'sprintf' => $product->_title ) ), NULL, array( 'data-bypassValidation' => true ) );
            $form->actionButtons[] = \IPS\Theme::i()->getTemplate( 'forms', 'core', 'global' )->button( \IPS\Member::loggedIn()->language()->addToStack( 'move_send_to_item', FALSE, array( 'sprintf' => $review->definiteArticle() ) ), 'submit', null, 'ipsButton ipsButton_link', array( 'tabindex' => '3', 'accesskey' => 'i', 'value' => 'item', 'name' => 'returnto' ) );
            $form->class = 'ipsForm_vertical';
            $form->add( new \IPS\Helpers\Form\Item( 'move_to', null, true, array(
                'class' => 'IPS\reviews\Product',
                'maxItems' => 1
            ) ) );

            if ( $values = $form->values() )
            {
                if( \is_array( $values['move_to'] ) )
                {
                    $newProduct = array_shift( $values['move_to'] );
                    $newContainer = $newProduct->asNode();
                    if( !$newContainer->can( 'add' ) || $newContainer->id == $product->id )
                    {
                        \IPS\Output::i()->error( 'node_move_invalid', '1S136/L', 403, '' );
                    }
                }

                /* If this item is read, we need to re-mark it as such after moving */
                $unread = $review->unread();

                $review->move( $newContainer, false );

                /* Mark it as read */
                if( $unread == 0 )
                {
                    $review->markRead();
                }

                \IPS\Session::i()->modLog( 'modlog__action_move', array( $review::$title => TRUE, $review->url()->__toString() => FALSE, $review->mapped( 'title' ) ?: ( method_exists( $review, 'item' ) ? $review->item()->mapped( 'title' ) : NULL ) => FALSE ),  $review );

                \IPS\Output::i()->redirect( ( isset( \IPS\Request::i()->returnto ) AND \IPS\Request::i()->returnto == 'item' ) ? $review->url() : $product->url() );
            }

            $this->_setBreadcrumbAndTitle( $review);
            \IPS\Output::i()->title = \IPS\Member::loggedIn()->language()->addToStack( 'move_item', FALSE, array( 'sprintf' => array( \IPS\Member::loggedIn()->language()->addToStack( \IPS\reviews\Review::$title ) ) ) );
            \IPS\Output::i()->output = $form->customTemplate( array( \call_user_func_array( array( \IPS\Theme::i(), 'getTemplate' ), array( 'forms', 'core' ) ), 'popupTemplate' ) );

        }
        catch ( \Exception $e )
        {
            \IPS\Output::i()->error( 'node_error', '2S136/D', 403, '' );
        }
    }
}