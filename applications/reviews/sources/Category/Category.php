<?php

/*
+--------------------------------------------------------------------------
|   Reviews
|   =============================================
|   by Esther Eisner
|   6/19/2017 6:18 PM
|   Copyright 2017 HeadStand Consulting
|   esther@headstandconsulting.com
+--------------------------------------------------------------------------
*/

namespace IPS\reviews;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

class _Category extends \IPS\Node\Model
{
    /**
     * @brief       [ActiveRecord] Multiton Store
     */
    protected static $multitons;
       
    /**
     * @brief       [ActiveRecord] Default Values
     */
    protected static $defaultValues = NULL;
       
    /**
     * @brief       [ActiveRecord] Database Table
     */
    public static $databaseTable = 'reviews_categories';
       
    /**
     * @brief       [ActiveRecord] Database Prefix
     */
    public static $databasePrefix = 'category_';
       
    /**
     * @brief       [Node] Parent ID Database Column
     */
    public static $databaseColumnParent = 'parent';

    /**
     * @brief	[Node] Enabled/Disabled Column
     */
    public static $databaseColumnEnabledDisabled = 'enabled';

    /**
     * @brief	Content Item Class
     */
    public static $contentItemClass = 'IPS\reviews\Product';
       
    /**
     * @brief       [Node] Node Title
     */
    public static $nodeTitle = 'reviews_categories';

    /**
     * @brief	URL Base
     */
    public static $urlBase = 'app=reviews&module=reviews&controller=category&id=';

    /**
     * @brief	URL Base
     */
    public static $urlTemplate = 'reviews_cat';

    /**
     * @brief	SEO Title Column
     */
    public static $seoTitleColumn = 'name_seo';
       
    /**
     * @brief       Bitwise values for members_bitoptions field
     */
    public static $bitOptions = array(
        'bitoptions' => array(
            'bitoptions' => array(
            )
        )
    );
 
    /**
     * [Node] Get title
     *
     * @return      string
     */
    protected function get__title()
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function get_ratings()
    {
        return isset( $this->_data['ratings'] ) ? json_decode( $this->_data['ratings'] ) : array();
    }

    /**
     * @return array
     */
    public function get__descendants()
    {
        $return = array();
        if( $this->hasChildren() )
        {
            foreach( $this->children() as $child )
            {
                $return[] = $child->_id;
                $return = array_merge( $return, $child->_descendants );
            }
        }
        return $return;
    }

	public function get__sortBy()
	{
		return 'rating';
	}

    /**
     * @param array $val
     */
    public function set_ratings( $val )
    {
        $this->_data['ratings'] = json_encode( $val );
    }

    /**
     * Returns the root category
     *
     * @return \IPS\reviews\Category
     */
    public function root()
    {
        if( $this->root === null )
        {
            return $this;
        }

        return static::load( $this->root );
    }

    /**
     * Total reviews in this category and its descendants
     *
     * @return int
     */
    public function totalReviews()
    {
        $cats = array_merge( array( $this->id ), $this->_descendants );
        return (int)\IPS\Db::i()->select( 'count(r.review_id)', array( 'reviews_reviews', 'r' ), \IPS\Db::i()->in( 'p.product_category', $cats ) )
            ->join( array( 'reviews_products', 'p' ), array( 'r.review_product_id=p.product_id' ) )
            ->first();
    }
       
    /**
     * [Node] Add/Edit Form
     *
     * @param       \IPS\Helpers\Form       $form   The form
     * @return      void
     */
    public function form( &$form )
    {
        $form->add( new \IPS\Helpers\Form\Text( 'category_name', $this->name, true ) );
        $form->add( new \IPS\Helpers\Form\Stack( 'category_ratings', $this->ratings, false ) );
        $form->add( new \IPS\Helpers\Form\Text( 'category_schemaname', $this->schemaname, false ) );
    }

    /**
     * [Node] Format form values from add/edit form for save
     *
     * @param	array	$values	Values from the form
     * @return	array
     */
    public function formatFormValues( $values )
    {
        $values['category_name_seo'] = \IPS\Http\Url\Friendly::seoTitle( $values['category_name'] );
        if( $this->parent )
        {
            $values['category_root'] = $this->parent()->root ?: $this->parent;
        }

        return $values;
    }

    /**
     * Check permissions
     *
     * @param	mixed								$permission						A key which has a value in static::$permissionMap['view'] matching a column ID in core_permission_index
     * @param	\IPS\Member|\IPS\Member\Group|NULL	$member							The member or group to check (NULL for currently logged in member)
     * @param	bool								$considerPostBeforeRegistering	If TRUE, and $member is a guest, will return TRUE if "Post Before Registering" feature is enabled
     * @return	bool
     * @throws	\OutOfBoundsException	If $permission does not exist in static::$permissionMap
     */
    public function can( $permission, $member=NULL, $considerPostBeforeRegistering = TRUE )
    {
        // we cannot add products to parent categories
        if( $permission == 'add' && $this->hasChildren() )
        {
            return false;
        }

        return parent::can( $permission, $member, $considerPostBeforeRegistering );
    }

    /**
     * Get title from index data
     *
     * @param	array		$indexData		Data from the search index
     * @param	array		$itemData		Basic data about the item. Only includes columns returned by item::basicDataColumns()
     * @param	array|NULL	$containerData	Basic data about the container. Only includes columns returned by container::basicDataColumns()
     * @param	bool		$escape			If the title should be escaped for HTML output
     * @return	\IPS\Http\Url
     */
    public static function titleFromIndexData( $indexData, $itemData, $containerData, $escape = TRUE )
    {
        return static::load( $indexData['index_container_id'] )->name;
    }

    /**
     * Get URL
     *
     * @return      \IPS\Http\Url
     */
    public function url()
    {
        return \IPS\Http\Url::internal( "app=reviews&module=reviews&controller=category&id={$this->id}", "front", "reviews_cat", \IPS\Http\Url\Internal::seoTitle( $this->name ) );
    }
}