<?php

/*
+--------------------------------------------------------------------------
|   Reviews
|   =============================================
|   by Esther Eisner
|   6/26/2017 11:43 PM
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

class _Review  extends \IPS\Content\Item implements \IPS\Content\Hideable,
    \IPS\Content\Lockable,
    //\IPS\Content\Pinnable,
    \IPS\Content\Views,
    \IPS\Content\Searchable,
    \IPS\Content\ReadMarkers,
    \IPS\Content\Followable
{
     /**
     * @brief       Application
     */
    public static $application = 'reviews';

    /**
     * @brief       Module
     */
    public static $module = 'reviews';

    /**
     * @brief       Database Table
     */
    public static $databaseTable = 'reviews_reviews';

    /**
     * @brief       Database Prefix
     */
    public static $databasePrefix = 'review_';

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
    public static $containerNodeClass = 'IPS\reviews\Product\Node';

    /**
     * @brief       Comment Class
     */
    public static $commentClass = 'IPS\reviews\Review\Comment';

    /**
     * @brief	URL Base
     */
    public static $urlBase = 'app=reviews&module=reviews&controller=review&id=';

    /**
     * @brief	URL Base
     */
    public static $urlTemplate = 'reviews_review';

    /**
     * @brief	SEO Title Column
     */
    public static $seoTitleColumn = 'seo_title';

    /**
     * @brief       Database Column Map
     */
    public static $databaseColumnMap = array(
        'author' => 'member_id',
        'container' => 'product_id',
        'views' => 'views',
        'title' => 'title',
        'content' => 'content',
        'num_comments' => 'total_comments',
        'date' => 'date',
        'updated' => 'edit_time',
        'rating' => 'overall',
        'approved' => 'approved',
        //'pinned' => 'pinned',
        'locked' => 'locked'
    );

    /**
     * @brief       Title
     */
    public static $title = 'review_review';

    /**
     * @brief       Icon
     */
    public static $icon = 'star';

    /**
     * @brief       Form Lang Prefix
     */
    public static $formLangPrefix = 'review_';

    /**
     * @brief       Follow Area Key
     */
    public static $followArea = 'review';

    /**
     * @brief       Force the products to be followed
     */
    //public static $containerFollowClasses = array( 'IPS\reviews\Product' );

    /**
     * @return string
     */
    public function get_seo_title()
    {
        return \IPS\Http\Url\Friendly::seoTitle( $this->title );
    }

    /**
     * @return \IPS\DateTime
     */
    public function get__date()
    {
        return \IPS\DateTime::ts( \strtotime( $this->_data['date'] ) );
    }

    /**
     * @param \IPS\DateTime|int    $val
     */
    public function set_date( $val )
    {
        if( $val instanceof \IPS\DateTime )
        {
            $this->_data['date'] = $val->format( 'Y-m-d H:i:s' );
        }
        elseif( \is_numeric( $val ) )
        {
            $this->_data['date'] = \IPS\DateTime::ts( $val )->format( 'Y-m-d H:i:s' );
        }
        else
        {
            $this->_data['date'] = null;
        }
    }

    /**
     * @param \IPS\DateTime|int    $val
     */
    public function set_edit_time( $val )
    {
        if( $val instanceof \IPS\DateTime )
        {
            $this->_data['edit_time'] = $val->format( 'Y-m-d H:i:s' );
        }
        elseif( \is_numeric( $val ) )
        {
            $this->_data['edit_time'] = \IPS\DateTime::ts( $val )->format( 'Y-m-d H:i:s' );
        }
        else
        {
            $this->_data['edit_time'] = null;
        }
    }

    /**
     * @return \IPS\reviews\Product
     */
    public function product()
    {
        return \IPS\reviews\Product::load( $this->product_id );
    }

    /**
     * Returns detailed ratings for this review
     *
     * @return array
     */
    public function detailedRatings()
    {
        $ratings = array();
        foreach( \IPS\Db::i()->select( 'rating_name, rating_score', 'reviews_detailed_ratings', array( 'revid=?', $this->id ), 'rating_name' ) as $rating )
        {
            $rating['rating_score'] = \IPS\Member::loggedIn()->language()->formatNumber( $rating['rating_score'], 1 );
            $ratings[$rating['rating_name']] = $rating;
        }
        return $ratings;
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
            "app=reviews&module=reviews&controller=review&id={$this->id}",
            'front', 
            'reviews_review',
            \IPS\Http\Url\Internal::seoTitle( $this->title )
        );
        
        if( $action )
        {
            $url = $url->setQueryString( 'do', $action );
        }

        return $url;
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
     * Should new comments be moderated?
     *
     * @param	\IPS\Member	$member							The member posting
     * @param	bool		$considerPostBeforeRegistering	If TRUE, and $member is a guest, will check if a newly registered member would be moderated
     * @return	bool
     */
    public function moderateNewComments( \IPS\Member $member, $considerPostBeforeRegistering = FALSE )
    {
        return false;
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
        $return = parent::formElements($item, $container);

        $return['rating'] = new \IPS\Helpers\Form\Rating( 'review_rating', $item !== null ? $item->overall : null, true );
        $return['content'] = new \IPS\Helpers\Form\Editor( 'review_content', $item !== null ? $item->content : null, true, array(
            'app' => 'reviews',
            'key' => 'Reviews',
            'autoSaveKey' => 'reviews-Reviews-' . ( $item !== null ? $item->id : 0 )
        ) );
        $return['pros'] = new \IPS\Helpers\Form\Text( 'review_pros', $item !== null ? $item->pros : null, false );
        $return['cons'] = new \IPS\Helpers\Form\Text( 'review_cons', $item !== null ? $item->cons : null, false );

        // detailed ratings
        $ratingCategories = ( $container !== null ) ? $container->ratingCategories() : array();
        $currentRatings = ( $item !== null ) ? $item->detailedRatings() : array();
        if( \count( $ratingCategories ) )
        {
            foreach( $ratingCategories as $cat )
            {
                $name = 'review_detail_' . \IPS\Http\Url\Internal::seoTitle( $cat );
                $field = new \IPS\Helpers\Form\Rating( $name, isset( $currentRatings[$cat] ) ? $currentRatings[$cat]['rating_score'] : null, true );
                $field->label = $cat;
                $return[$name] = $field;
            }
        }

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
        $this->overall = $values['review_rating'];
        $this->content = $values['review_content'];
        $this->pros = $values['review_pros'];
        $this->cons = $values['review_cons'];
    }

    /**
     * Process created object AFTER the object has been created
     *
     * @param	\IPS\Content\Comment|NULL	$comment	The first comment
     * @param	array						$values		Values from form
     * @return	void
     */
    protected function processAfterCreate( $comment, $values )
    {
        parent::processAfterCreate( $comment, $values );

        \IPS\File::claimAttachments( 'reviews-Reviews-0', $this->id );

        $this->updateDetailedRatings( $values );
    }

    /**
     * Process after the object has been edited on the front-end
     *
     * @param	array	$values		Values from form
     * @return	void
     */
    public function processAfterEdit( $values )
    {
        parent::processAfterEdit( $values );

        \IPS\File::claimAttachments( 'reviews-Reviews-' . $this->id, $this->id );

        $this->updateDetailedRatings( $values );
    }

    /**
     * Updates the detailed ratings for this review
     *
     * @param array $values
     * @return void
     */
    protected function updateDetailedRatings( $values )
    {
        $ratingCategories = $this->container()->ratingCategories();
        if( !\count( $ratingCategories ) )
        {
            return;
        }

        $currentRatings = $this->detailedRatings();
        foreach( $ratingCategories as $cat )
        {
            $seoCat = \IPS\Http\Url\Internal::seoTitle( $cat );
            $name = 'review_detail_' . $seoCat;
            if( isset( $values[$name] ) )
            {
                if( isset( $currentRatings[$cat] ) )
                {
                    \IPS\Db::i()->update( 'reviews_detailed_ratings', array( 'rating_score' => $values[$name] ), array( 'revid=? and rating_name=?', $this->id, $cat ) );
                }
                else
                {
                    \IPS\Db::i()->insert( 'reviews_detailed_ratings', array(
                        'revid' => $this->id,
                        'catid' => $this->product_id,
                        'rootid' => $this->product()->root()->_id,
                        'rating_name' => $cat,
                        'rrname' => $seoCat,
                        'rating_score' => $values[$name]
                    ) );
                }
            }
            else
            {
                \IPS\Db::i()->delete( 'reviews_detailed_ratings', array( 'revid=? and rating_name=?', $this->id, $cat ) );
            }
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

        // admins can edit
        if( $member->isAdmin() || $data['moderate'] )
        {
            return true;
        }

        // review authors can edit
        if( $this->member_id == $member->member_id )
        {
            return true;
        }

        return false;
    }

    /**
     * Can comment?
     *
     * @param	\IPS\Member\NULL	$member							The member (NULL for currently logged in member)
     * @param	bool				$considerPostBeforeRegistering	If TRUE, and $member is a guest, will return TRUE if "Post Before Registering" feature is enabled
     * @return	bool
     */
    public function canComment( $member=NULL, $considerPostBeforeRegistering = TRUE )
    {
        // if we have no comment permissions, stop here
        $member = $member ?: \IPS\Member::loggedIn();
        $data = json_decode( $member->group['g_member_reviews'], true );
        if( !$data['comment'] )
        {
            return false;
        }

        // run parent
        return parent::canComment( $member, $considerPostBeforeRegistering );
    }

    /**
     * Get template for content tables
     *
     * @return	callable
     */
    public static function contentTableTemplate()
    {
        \IPS\Output::i()->cssFiles = array_merge( \IPS\Output::i()->cssFiles, \IPS\Theme::i()->css( 'reviews.css', 'reviews', 'front' ) );

        return array( \IPS\Theme::i()->getTemplate( 'global', 'reviews' ), 'reviewRows' );
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
        $review = \IPS\reviews\Review::load( $indexData['index_item_id'] );
        return \IPS\Theme::i()->getTemplate( 'global', 'reviews' )->searchResultReviewSnippet( $review, ( $view == 'condensed' ) );
    }

    /**
     * Save Changed Columns
     *
     * @return	void
     */
    public function save()
    {
        $updateItems = ( $this->_new || isset( $this->changed['approved'] ) );
        $updateRatings = ( $this->_new || isset( $this->changed['overall'] ) );

        parent::save();

        if( $updateItems )
        {
            $this->container()->updateItemCount();
        }
        if( $updateRatings )
        {
            $this->container()->calculateProductRatings();
        }
    }

    /**
     * [ActiveRecord] Delete Record
     *
     * @return	void
     */
    public function delete()
    {
        parent::delete();

        \IPS\Db::i()->delete( 'reviews_detailed_ratings', array( 'revid=?', $this->id ) );

        $this->container()->updateItemCount();
        $this->container()->calculateProductRatings();
    }
}