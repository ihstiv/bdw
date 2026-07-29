<?php

/*
+--------------------------------------------------------------------------
|   Reviews
|   =============================================
|   by Esther Eisner
|   6/19/2017 6:40 PM
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

class _Product  extends \IPS\Content\Item implements \IPS\Content\Views,
    \IPS\Content\Hideable,
    \IPS\Content\Searchable
{
     /**
     * @brief       Application
     */
    public static $application = 'reviews';

    /**
     * @brief       Module
     */
    public static $module = 'products';

    /**
     * @brief       Database Table
     */
    public static $databaseTable = 'reviews_products';

    /**
     * @brief       Database Prefix
     */
    public static $databasePrefix = 'product_';

    /**
     * @brief       Multiton Store
     */
    protected static $multitons;

    /**
     * @brief       Default Values
     */
    protected static $defaultValues = NULL;

    /**
     * @brief       Node Class
     */
    public static $containerNodeClass = 'IPS\reviews\Category';

    /**
     * @brief       Database Column Map
     */
    public static $databaseColumnMap = array(
        'container' => 'category',
        'views' => 'views',
        'title' => 'name',
        'content' => 'description',
        'approved' => 'enabled',
        'author' => 'owner_id'
    );

    /**
     * @brief       Title
     */
    public static $title = 'reviews_products';

    /**
     * @brief       Icon
     */
    public static $icon = '';

    /**
     * @brief       Form Lang Prefix
     */
    public static $formLangPrefix = 'product_';

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
     * @return \IPS\Patterns\ActiveRecordIterator
     */
    public function get_pros()
    {
        if( !$this->total_reviews )
        {
            return null;
        }

        return new \IPS\Patterns\ActiveRecordIterator( \IPS\Db::i()->select( '*', 'reviews_reviews', array( 'review_product_id=? and review_approved=? and length(review_pros) > ?', $this->id, 1, 0 ), 'rand()', 2 ), 'IPS\reviews\Review' );
    }

    /**
     * @return \IPS\Patterns\ActiveRecordIterator
     */
    public function get_cons()
    {
        if( !$this->total_reviews )
        {
            return null;
        }

        return new \IPS\Patterns\ActiveRecordIterator( \IPS\Db::i()->select( '*', 'reviews_reviews', array( 'review_product_id=? and review_approved=? and length(review_cons) > ?', $this->id, 1, 0 ), 'rand()', 2 ), 'IPS\reviews\Review' );
    }

    /**
     * @param string $val
     */
    public function set_name( $val )
    {
        $this->_data['name'] = $val;
        $this->name_seo = \IPS\Http\Url\Friendly::seoTitle( $val );
    }

    /**
     * Returns the root level category
     *
     * @return \IPS\reviews\Category
     */
    public function root()
    {
        return $this->container()->root();
    }

    /**
     * @return \IPS\Member|null
     */
    public function owner()
    {
        if( $this->owner_id )
        {
            return \IPS\Member::load( $this->owner_id );
        }

        return null;
    }

    /**
     * Get URL
     *
     * @param       string|NULL $action Action
     * @return      \IPS\Http\Url
     */
    public function url($action = NULL)
    {
        $url = \IPS\Http\Url::internal(
            "app=reviews&module=reviews&controller=product&id={$this->id}",
            'front', 
            'reviews_product',
            \IPS\Http\Url\Internal::seoTitle( $this->name )
        );
        
        if ($action) {
            $url = $url->setQueryString('do', $action);
        }

        return $url;
    }

	/**
	 * Get items with permission check
	 *
	 * @param	array		$where				Where clause
	 * @param	string		$order				MySQL ORDER BY clause (NULL to order by date)
	 * @param	int|array	$limit				Limit clause
	 * @param	string|NULL	$permissionKey		A key which has a value in the permission map (either of the container or of this class) matching a column ID in core_permission_index or NULL to ignore permissions
	 * @param	mixed		$includeHiddenItems	Include hidden items? NULL to detect if currently logged in member has permission, -1 to return public content only, TRUE to return unapproved content and FALSE to only return unapproved content the viewing member submitted
	 * @param	int			$queryFlags			Select bitwise flags
	 * @param	\IPS\Member	$member				The member (NULL to use currently logged in member)
	 * @param	bool		$joinContainer		If true, will join container data (set to TRUE if your $where clause depends on this data)
	 * @param	bool		$joinComments		If true, will join comment data (set to TRUE if your $where clause depends on this data)
	 * @param	bool		$joinReviews		If true, will join review data (set to TRUE if your $where clause depends on this data)
	 * @param	bool		$countOnly			If true will return the count
	 * @param	array|null	$joins				Additional arbitrary joins for the query
	 * @param	mixed		$skipPermission		If you are getting records from a specific container, pass the container to reduce the number of permission checks necessary or pass TRUE to skip container-based permission. You must still specify this in the $where clause
	 * @param	bool		$joinTags			If true, will join the tags table
	 * @param	bool		$joinAuthor			If true, will join the members table for the author
	 * @param	bool		$joinLastCommenter	If true, will join the members table for the last commenter
	 * @param	bool		$showMovedLinks		If true, moved item links are included in the results
	 * @param	array|null	$location			Array of item lat and long
	 * @return	\IPS\Patterns\ActiveRecordIterator|int
	 */
	public static function getItemsWithPermission( $where=array(), $order=NULL, $limit=10, $permissionKey='read', $includeHiddenItems=\IPS\Content\Hideable::FILTER_AUTOMATIC, $queryFlags=0, \IPS\Member $member=NULL, $joinContainer=FALSE, $joinComments=FALSE, $joinReviews=FALSE, $countOnly=FALSE, $joins=NULL, $skipPermission=FALSE, $joinTags=TRUE, $joinAuthor=TRUE, $joinLastCommenter=TRUE, $showMovedLinks=FALSE, $location=NULL )
    {
        if( $order === null )
        {
            $order = 'product_name';
        }

        if( $order != 'product_name' && $order != 'product_name desc' )
        {
            $order .= ', product_name';
        }

        return parent::getItemsWithPermission( $where, $order, $limit, $permissionKey, $includeHiddenItems, $queryFlags, $member, $joinContainer, $joinComments, $joinReviews, $countOnly, $joins, $skipPermission, $joinTags, $joinAuthor, $joinLastCommenter, $showMovedLinks, $location );
    }

    /**
     * Should new items be moderated?
     *
     * @param	\IPS\Member		$member		The member posting
     * @param	\IPS\Node\Model	$container	The container
     * @param	bool			$considerPostBeforeRegistering	If TRUE, and $member is a guest, will check if a newly registered member would be moderated
     * @return	bool
     */
    public static function moderateNewItems( \IPS\Member $member, \IPS\Node\Model $container = NULL, $considerPostBeforeRegistering = FALSE )
    {
        if ($container and $container->bitoptions['moderation'] and !static::modPermission('unhide', $member, $container)) {
            return TRUE;
        }

        return parent::moderateNewItems($member, $container, $considerPostBeforeRegistering);
    }

    /**
     * Get elements for add/edit form
     *
     * @param	\IPS\Content\Item|NULL	$item		The current item if editing or NULL if creating
     * @param	\IPS\Node\Model|NULL	$container	Container (e.g. forum), if appropriate
     * @return	array
     */
    public static function formElements( $item=NULL, \IPS\Node\Model $container=NULL )
    {
        $return = parent::formElements( $item, $container );

        // we cannot change the container outside of the ACP
        if( \IPS\Dispatcher::i()->controllerLocation == 'admin' )
        {
            $return['container'] = new \IPS\Helpers\Form\Node( 'product_category', $item !== null ? $item->category : null, true, array(
                'class' => static::$containerNodeClass,
                'multiple' => false,
                'permissionCheck' => 'add'
            ) );
        }

        $return['description'] = new \IPS\Helpers\Form\Editor( 'product_description', $item !== null ? $item->description : null, false, array(
            'app' => 'reviews',
            'key' => "Product",
            'autoSaveKey' => 'reviews-Product-' . ( $item !== null && $item->id ? $item->id : 0 )
        ) );
        $return['image'] = new \IPS\Helpers\Form\Upload( 'product_image', ( $item !== null && $item->image ? \IPS\File::get( 'reviews_Product', $item->image ) : null ), false, array(
            'storageExtension' => 'reviews_Product',
            'multiple' => false,
            'image' => true
        ) );
        $return['image_description'] = new \IPS\Helpers\Form\TextArea( 'product_image_description', $item->image_description, false );

        return $return;
    }

    /**
     * Process create/edit form
     *
     * @param	array				$values	Values from form
     * @return	void
     */
    public function processForm( $values )
    {
        parent::processForm( $values );

        if( isset( $values['product_category'] ) )
        {
            $this->category = $values['product_category']->_id;
        }

        $this->description = $values['product_description'];
        $this->image = $values['product_image'] !== null ? (string)$values['product_image'] : null;
        $this->image_description = $values['product_image_description'];

        if( $this->_new )
        {
            $this->enabled = true;
        }
    }

    /**
     * Check permissions
     *
     * @param	mixed								$permission						A key which has a value in the permission map (either of the container or of this class) matching a column ID in core_permission_index
     * @param	\IPS\Member|\IPS\Member\Group|NULL	$member							The member or group to check (NULL for currently logged in member)
     * @param	bool								$considerPostBeforeRegistering	If TRUE, and $member is a guest, will return TRUE if "Post Before Registering" feature is enabled
     * @return	bool
     * @throws	\OutOfBoundsException	If $permission does not exist in map
     */
    public function can( $permission, $member=NULL, $considerPostBeforeRegistering=TRUE )
    {
        $member = $member ?: \IPS\Member::loggedIn();
        $data = json_decode( $member->group['g_member_reviews'], true );

        switch( $permission )
        {
            case 'moderate':
                return $member->isAdmin() || $data['moderate'];
                break;

            default:
                return parent::can( $permission, $member, $considerPostBeforeRegistering );
                break;
        }
    }

    /**
     * Can edit?
     *
     * @param	\IPS\Member|NULL	$member	The member to check for (NULL for currently logged in member)
     * @return	bool
     */
    public function canEdit( $member = NULL )
    {
        $member = $member ?: \IPS\Member::loggedIn();
        $data = json_decode( $member->group['g_member_reviews'], true );

        // are we the product owner?
        if( $this->owner_id && $this->owner_id == $member->member_id )
        {
            return true;
        }

        // if we have moderate permissions, we're good
        if( $data['moderate'] )
        {
            return true;
        }

        return parent::canEdit( $member );
    }

    /**
     * Can review?
     *
     * @param	\IPS\Member\NULL	$member							The member (NULL for currently logged in member)
     * @param	bool				$considerPostBeforeRegistering	If TRUE, and $member is a guest, will return TRUE if "Post Before Registering" feature is enabled
     * @return	bool
     */
    public function canReview( $member=NULL, $considerPostBeforeRegistering = TRUE )
    {
        $member = $member ?: \IPS\Member::loggedIn();
        $data = json_decode( $member->group['g_member_reviews'], true );

        // owners cannot review their own product
        if( $this->owner_id && $this->owner_id == $member->member_id )
        {
            return false;
        }

        return $data['review'];
    }

    /**
     * Get average rating
     *
     * @return	float
     * @throws	\BadMethodCallException
     */
    public function averageRating()
    {
        return round( \IPS\Db::i()->select( 'AVG(review_overall)', 'reviews_reviews', array( 'review_product_id=? and review_approved=?', $this->id, 1 ) )->first(), 1 );
    }

    /**
     * Returns the rating distribution for this product
     *
     * @return array
     */
    public function ratingDistribution()
    {
        // init the array
        $ratings = array();
		$totals = array();
        for( $i=5; $i>=0; $i-- )
        {
            $ratings[$i] = 0;
			$totals[$i] = 0;
        }

        foreach( \IPS\Db::i()->select( 'count(review_id) as total, review_overall', 'reviews_reviews', array( 'review_product_id=? and review_approved=?', $this->id, 1 ), null, null, 'review_overall' ) as $row )
        {
            $rating = floor( $row['review_overall'] );

            // put the total in the array so that we can calculate it properly
            // we might have more than one record for each rating
            $totals[$rating] += $row['total'];

            // calculate the percentage
            $ratings[$rating] = round( ( $totals[$rating] / $this->total_reviews ) * 100 );
        }

        return $ratings;
    }

    /**
     * Returns the breakdown for the detailed ratings
     *
     * @return array|null
     */
    public function detailedRatings()
    {
        // make sure we have a breakdown
        $categories = $this->container()->ratings;
        if( !\is_array( $categories ) || !\count( $categories ) )
        {
            $categories = $this->root()->ratings;
            if( !\is_array( $categories ) || !\count( $categories ) )
            {
                return null;
            }
        }

        // averages!
        $ratings = array();
        $select = \IPS\Db::i()->select( 'avg(rating_score) as score, d.rating_name', array( 'reviews_detailed_ratings', 'd' ), array( 'd.catid=? and r.review_approved=?', $this->id, 1 ), 'rating_name', null, 'rating_name' )
            ->join( array( 'reviews_reviews', 'r' ), 'd.revid=r.review_id' );
        foreach( $select as $row )
        {
            // if the rating no longer exists, skip it
            if( !\in_array( $row['rating_name'], $categories ) )
            {
                continue;
            }

            $score = floor( $row['score'] );
			if( !isset( $ratings[$row['rating_name']] ) )
			{
				$ratings[$row['rating_name']] = 0;
			}
            $ratings[$row['rating_name']] += $score;
        }

        return $ratings;
    }

    /**
     * Calculates the category ranking based on weighted ratings
     *
     * @return int
     */
    public function categoryRanking()
    {
        if( $this->weighted > 0 )
        {
            $ranking = (int)\IPS\Db::i()->select( 'count(product_id)', 'reviews_products', array( 'product_category=? and product_enabled=? and product_weighted > ?', $this->category, 1, $this->weighted ) )->first();
            return $ranking + 1;
        }

        return 0;
    }

    /**
     * Returns the current product as a node
     *
     * @return \IPS\reviews\Product\Node
     */
    public function asNode()
    {
        return \IPS\reviews\Product\Node::constructFromData( $this->_data );
    }

    /**
     * Get snippet HTML for search result display
     *
     * @param	array		$indexData		Data from the search index
     * @param	array		$authorData		Basic data about the author. Only includes columns returned by \IPS\Member::columnsForPhoto()
     * @param	array		$itemData		Basic data about the item. Only includes columns returned by item::basicDataColumns()
     * @param	array|NULL	$containerData	Basic data about the container. Only includes columns returned by container::basicDataColumns()
     * @param	array		$reputationData	Array of people who have given reputation and the reputation they gave
     * @param	int|NULL	$reviewRating	If this is a review, the rating
     * @param	string		$view			'expanded' or 'condensed'
     * @return	callable
     */
    public static function searchResultSnippet( array $indexData, array $authorData, array $itemData, array $containerData = NULL, array $reputationData, $reviewRating, $view )
    {
        $product = static::load( $indexData['index_item_id'] );
        return \IPS\Theme::i()->getTemplate( 'global', 'reviews' )->searchResultProductSnippet( $product, ( $view == 'condensed' ) );
    }
}