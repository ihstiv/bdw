<?php


namespace IPS\reviews\modules\admin\reviews;

/* To prevent PHP errors (extending class does not exist) revealing path */
use IPS\Member;
use IPS\Output;

if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * products
 */
class _products extends \IPS\Dispatcher\Controller
{
    public static $csrfProtected = true;

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
	 * Manage
	 *
	 * @return	void
	 */
	protected function manage()
	{		
		/* Create the table */
		$table = new \IPS\Helpers\Table\Db( 'reviews_products', \IPS\Http\Url::internal( 'app=reviews&module=reviews&controller=products' ) );
		$table->include = array( 'product_image', 'product_name', 'product_category', 'product_enabled' );
		$table->sortBy = $table->sortBy ?: 'product_name';
		$table->sortDirection = $table->sortDirection ?: 'asc';
		$table->noSort = array( 'product_image', 'product_enabled' );
		$table->quickSearch = 'product_name';
		$table->mainColumn = 'product_name';

		$table->parsers = array(
		    'product_image' => function( $val ){
                if( $val !== null )
                {
                    try
                    {
                        $image = \IPS\File::get( 'reviews_Product', $val );
                        return "<img src='{$image->url}' class='ipsThumb ipsThumb_tiny'>";
                    }
                    catch( \OutOfRangeException $e ){}
                }
            },
            'product_category' => function( $val ){
		        try
                {
                    return \trim( \IPS\reviews\Category::load( $val )->name );
                }
                catch( \OutOfRangeException $e ){}
            },
            'product_enabled' => function( $val, $row ){
                $url = \IPS\Http\Url::internal( "app=reviews&module=reviews&controller=products&do=enableToggle&id={$row['product_id']}" );
                $class = ( $val ) ? 'ipsBadge_positive' : 'ipsBadge_negative';
                return "<a href='{$url}' class='ipsBadge {$class} ipsBadge_medium' data-action='toggleProduct'>" . \IPS\Member::loggedIn()->language()->addToStack( $val ? 'enabled' : 'disabled' ) . "</a>";
            }
        );

		$table->rootButtons = array(
		    'plus' => array(
		        'icon' => 'plus',
                'title' => 'new_product',
                'link' => \IPS\Http\Url::internal( "app=reviews&module=reviews&controller=products&do=add" )
            )
        );

		$table->rowButtons = function( $row ){
		    return array(
		        array(
		            'icon' => 'pencil',
                    'title' => 'edit_product',
                    'link' => \IPS\Http\Url::internal( "app=reviews&module=reviews&controller=products&do=edit&id={$row['product_id']}" )
                ),
                array(
                    'icon' => 'times-circle',
                    'title' => 'delete_product',
                    'link' => \IPS\Http\Url::internal( "app=reviews&module=reviews&controller=products&do=delete&id={$row['product_id']}" )->csrf(),
                    'data' => array( 'confirm' => '' )
                )
            );
        };

		$table->advancedSearch = array(
		    'product_category' => array(
		        \IPS\Helpers\Table\SEARCH_NODE,
                array( 'class' => 'IPS\reviews\Category' ),
                function( $val ){
		            try
                    {
                        $cat = \IPS\reviews\Category::load( $val->_id );
                        $descendants = array( $cat->_id );
                        $descendants = array_merge( $descendants, $cat->_descendants );
                        return array( \IPS\Db::i()->in( 'product_category', $descendants ) );
                    }
                    catch( \OutOfRangeException $e ){}
                }
            )
        );

		\IPS\Output::i()->jsFiles = array_merge( \IPS\Output::i()->jsFiles, \IPS\Output::i()->js( 'admin_products.js', 'reviews', 'admin' ) );
		\IPS\Output::i()->globalControllers[] = 'reviews.admin.products.products';
		\IPS\Output::i()->title = \IPS\Member::loggedIn()->language()->addToStack( 'menu__reviews_reviews_products' );
		\IPS\Output::i()->output = (string)$table;
	}

    /**
     * New product
     */
	protected function add()
    {
        $form = new \IPS\Helpers\Form;
        foreach( \IPS\reviews\Product::formElements() as $field )
        {
            $form->add( $field );
        }

        if( $values = $form->values() )
        {
            $product = \IPS\reviews\Product::createFromForm( $values, $values['product_category'], false );

            \IPS\Output::i()->redirect( \IPS\Http\Url::internal( "app=reviews&module=reviews&controller=products" ) );
        }

        \IPS\Output::i()->title = \IPS\Member::loggedIn()->language()->addToStack( 'new_product' );
        \IPS\Output::i()->output = (string)$form;
    }

	protected function edit()
    {
        try
        {
            $product = \IPS\reviews\Product::load( \IPS\Request::i()->id );
        }
        catch( \OutOfRangeException $e )
        {
            \IPS\Output::i()->error( 'Invalid Product ID', '1ARRP/1' );
        }

        $form = new \IPS\Helpers\Form;
        foreach( $product::formElements( $product ) as $field )
        {
            $form->add( $field );
        }

        if( $values = $form->values() )
        {
            $product->processForm( $values );
            $product->processAfterEdit( $values );
            $product->save();

            \IPS\Output::i()->redirect( \IPS\Http\Url::internal( "app=reviews&module=reviews&controller=products" ) );
        }

        \IPS\Output::i()->title = \IPS\Member::loggedIn()->language()->addToStack( 'edit_product' );
        \IPS\Output::i()->output = (string)$form;
    }


    protected function delete()
    {
        \IPS\Request::i()->confirmedDelete();

        try
        {
            $product = \IPS\reviews\Product::load( \IPS\Request::i()->id );
            $product->delete();
        }
        catch( \OutOfRangeException $e ){}

        \IPS\Output::i()->redirect( \IPS\Http\Url::internal( "app=reviews&module=reviews&controller=products" ) );
    }

    protected function enableToggle()
    {
        \IPS\Session::i()->csrfCheck();

        try
        {
            $product = \IPS\reviews\Product::load( \IPS\Request::i()->id );
            if( $product->enabled )
            {
                $product->enabled = false;
            }
            else
            {
                $product->enabled = true;
            }
            $product->save();

            \IPS\Content\Search\Index::i()->index( $product );
        }
        catch( \OutOfRangeException $e ){}

        if( \IPS\Request::i()->isAjax() )
        {
            \IPS\Output::i()->json( array( 'enabled' => (int)$product->enabled ) );
        }

        \IPS\Output::i()->redirect( \IPS\Http\Url::internal( "app=reviews&module=reviews&controller=products" ) );
    }

}