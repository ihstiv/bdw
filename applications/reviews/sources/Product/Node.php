<?php

/*
+--------------------------------------------------------------------------
|   Reviews
|   =============================================
|   by Esther Eisner
|   7/6/2017 12:47 PM
|   Copyright 2017 HeadStand Consulting
|   esther@headstandconsulting.com
+--------------------------------------------------------------------------
*/

namespace IPS\reviews\Product;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

class _Node extends \IPS\Node\Model
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
    public static $databaseTable = 'reviews_products';
       
    /**
     * @brief       [ActiveRecord] Database Prefix
     */
    public static $databasePrefix = 'product_';
       
    /**
     * @brief       [Node] Node Title
     */
    public static $nodeTitle = '';

    /**
     * @brief	Content Item Class
     */
    public static $contentItemClass = 'IPS\reviews\Review';

    /**
     * @brief   Parent Node Class
     */
    public static $parentNodeClass = 'IPS\reviews\Category';

    /**
     * @brief   Parent Node ID
     */
    public static $parentNodeColumnId = 'category';

    /**
     * @brief	[Node] Order Database Column
     */
    public static $databaseColumnOrder = 'name';

    /**
     * @brief	[Node] Sortable?
     */
    public static $nodeSortable = false;

    /**
     * @brief	[Node] Automatically set position for new nodes
     */
    public static $automaticPositionDetermination = false;

    /**
     * @brief	URL Base
     */
    public static $urlBase = 'app=reviews&module=reviews&controller=product&id=';

    /**
     * @brief	URL Base
     */
    public static $urlTemplate = 'reviews_product';

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
     * Returns the rating categories for this product
     *
     * @return array
     */
    public function ratingCategories()
    {
        $ratings = array();
        $parent = $this->parent();
        while( !\count( $ratings ) && $parent !== null )
        {
            $ratings = $parent->ratings;
            $parent = $parent->parent();
        }
        return $ratings;
    }

    /**
     * Updates the total reviews for this product
     *
     * @return void
     */
    public function updateItemCount()
    {
        $total = (int)\IPS\Db::i()->select( 'count(review_id)', 'reviews_reviews', array( 'review_product_id=? and review_approved=?', $this->id, 1 ) )->first();
        $this->total_reviews = $total;
        $this->save();
    }

    /**
     * Calculates the rating values for this product
     *
     * @return void
     */
    public function calculateProductRatings()
    {
        // first get the average overall rating for all products in this category
        $allProducts = \IPS\Db::i()->select( 'count(r.review_id) as total_reviews, avg(r.review_overall) as overall', array( 'reviews_reviews', 'r' ), array( 'r.review_approved=? and p.product_enabled=? and p.product_category=?', 1, 1, $this->category ) )
            ->join( array( 'reviews_products', 'p' ), 'r.review_product_id=p.product_id' )->first();

        // we also need the average number of votes for all products - so get a count of all products in this category
        $totalProducts = (int)\IPS\Db::i()->select( 'count(product_id)', 'reviews_products', array( 'product_enabled=? and product_category=?', 1, $this->category ) )->first();

        // and now the total and average for this product
        $thisProduct = \IPS\Db::i()->select( 'count(review_id) as total_reviews, avg(review_overall) as overall', 'reviews_reviews', array( 'review_approved=? and review_product_id=?', 1, $this->id ) )->first();

        $avgNumVotes = $allProducts['total_reviews'] / $totalProducts;
        $avgRating = $allProducts['overall'];

        // if we have no votes or ratings, stop here
        if( !$thisProduct['total_reviews'] || !$thisProduct['overall'] )
        {
            $this->bayesian = 0;
            $this->weighted = 0;
            $this->save();
            return;
        }

        // bayesian rating calucation
        $this->bayesian = ( ( $avgNumVotes * $avgRating ) + ( $thisProduct['total_reviews'] * $thisProduct['overall'] ) ) / ( $avgNumVotes + $thisProduct['total_reviews'] );

        // now we do the weighted ratings... start with getting the total votes for each rating value
        $groupedRatings = iterator_to_array( \IPS\Db::i()->select( 'count(review_id) as total_reviews, round(review_overall) as overall', 'reviews_reviews', array( 'review_approved=? and review_product_id=?', 1, $this->id ), null, null, 'review_overall' )->setKeyField( 'overall' ) );
        $ratings = 9;
        $votes = 3;

        // multiply the total number of votes by the value of the rating
        // this means that higher ratings count for more
        foreach( $groupedRatings as $gr )
        {
            $ratings += ( $gr['overall'] * $gr['total_reviews'] );
            $votes += $gr['total_reviews'];
        }

        // now divide ratings by votes
        $this->weighted = $ratings / $votes;

        $this->save();
    }

    /**
     * Set the comment/approved/hidden counts
     *
     * @return void
     */
    public function resetCommentCounts()
    {
        parent::resetCommentCounts();

        $this->updateItemCount();
        $this->calculateProductRatings();
    }
       
    /**
     * Get URL
     *
     * @return      \IPS\Http\Url
     */
    public function url()
    {
        return \IPS\Http\Url::internal(
            "app=reviews&module=reviews&controller=product&id={$this->id}",
            'front',
            'reviews_product',
            $this->name_seo
        );
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
        if ( $indexData['index_club_id'] and isset( $containerData['_club'] ) )
        {
            return parent::titleFromIndexData( $indexData, $itemData, $containerData, $escape );
        }

        return static::load( $indexData['index_container_id'] )->name;
    }
}