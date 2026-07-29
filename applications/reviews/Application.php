<?php
/**
 * @brief		Reviews Application Class
 * @author		<a href=''>Esther Eisner</a>
 * @copyright	(c) 2017 Esther Eisner
 * @package		IPS Community Suite
 * @subpackage	Reviews
 * @since		19 Jun 2017
 * @version		
 */
 
namespace IPS\reviews;

/**
 * Reviews Application Class
 */
class _Application extends \IPS\Application
{
    /**
     * Can the user access this application?
     *
     * @param	\IPS\Member|\IPS\Member\Group|NULL	$memberOrGroup		Member/group we are checking against or NULL for currently logged on user
     * @return	bool
     */
    public function canAccess( $memberOrGroup = NULL )
    {
        if( !parent::canAccess( $memberOrGroup ) )
        {
            return false;
        }

        if( \IPS\Dispatcher::hasInstance() && \IPS\Dispatcher::i()->controllerLocation == 'front' )
        {
            if ( $memberOrGroup instanceof \IPS\Member\Group )
            {
                $data = json_decode( $memberOrGroup->g_member_reviews, true );
                return $data['view'];
            }
            else
            {
                $member	= ( $memberOrGroup === NULL ) ? \IPS\Member::loggedIn() : $memberOrGroup;
                $data = json_decode( $member->group['g_member_reviews'], true );
                return $data['view'];
            }
        }

        return true;
    }

    /**
     * Install database changes from the schema.json file
     *
     * @param	bool	$skipInserts	Skip inserts
     * @throws \Exception
     */
    public function installDatabaseSchema( $skipInserts=FALSE )
    {
        // if this is an upgrade from v3, then rename the category table first
        if( !\IPS\Db::i()->checkForTable( 'reviews_categories_v3' ) )
        {
            \IPS\Db::i()->renameTable( 'reviews_categories', 'reviews_categories_v3' );
        }

        return parent::installDatabaseSchema( $skipInserts );
    }

    /**
     * Install 'other' items. Left blank here so that application classes can override for app
     *  specific installation needs. Always run as the last step.
     *
     * @return void
     */
    public function installOther()
    {
        // group permissions
        foreach( \IPS\Member\Group::groups( true, true ) as $group )
        {
            $data = array(
                'view' => 1,
                'moderate' => ( $group->g_id == \IPS\Settings::i()->admin_group ? 1 : 0 ),
                'review' => ( $group->g_id == \IPS\Settings::i()->guest_group ? 0 : 1 ),
                'product' => ( $group->g_id == \IPS\Settings::i()->admin_group ? 1 : 0 ),
                'comment' => ( $group->g_id == \IPS\Settings::i()->guest_group ? 0 : 1 )
            );
            $group->g_member_reviews = json_encode( $data );
            $group->save();
        }

        // if we do not have a categories table, stop here
        if( !\IPS\Db::i()->checkForTable( 'reviews_categories_v3' ) )
        {
            return;
        }

        // import categories
        foreach( \IPS\Db::i()->select( '*', 'reviews_categories_v3', array( '`allow`<>?', 1 ), 'cparent, cid' ) as $cat )
        {
            $this->updateLegacyCategory( $cat );
        }

        // import products
        foreach( \IPS\Db::i()->select( '*', 'reviews_categories_v3', array( '`allow`=?', 1 ), 'cid' ) as $cat )
        {
            $this->updateLegacyProduct( $cat );
        }

        // import reviews
        foreach( \IPS\Db::i()->select( '*', 'reviews', array( 'cid > ?', 0 ), 'id' ) as $row )
        {
            $this->updateLegacyReview( $row );
        }

        // update product review totals
        foreach( \IPS\Db::i()->select( 'count(review_id) as total, review_product_id', 'reviews_reviews', array( 'review_approved=?', 1 ), null, null, 'review_product_id' ) as $row )
        {
            \IPS\Db::i()->update( 'reviews_products', array( 'product_total_reviews' => $row['total'] ), array( 'product_id=?', $row['review_product_id'] ) );
        }
    }

    /**
     * Updates a legacy category to the new structure
     *
     * @param array $cat
     * @return void
     */
    protected function updateLegacyCategory( $cat )
    {
        $data = array(
            'category_id' => $cat['cid'],
            'category_parent' => ( $cat['cparent'] > 0 ? $cat['cparent'] : 0 ),
            'category_root' => ( $cat['root'] == $cat['cid'] ? null : $cat['root'] ),
            'category_name' => $cat['cname'],
            'category_name_seo' => $cat['fname'],
            'category_ratings' => ( $cat['cratings'] ? json_encode( explode( "<br />", $cat['cratings'] ) ) : null ),
            'category_enabled' => ( $cat['hidden'] ? 0 : 1 ),
            'category_schemaname' => $cat['schemaname']
        );

        \IPS\Db::i()->replace( 'reviews_categories', $data );
    }

    /**
     * Updates a legacy product to the new structure
     *
     * @param array $cat
     * @return void
     */
    protected function updateLegacyProduct( $cat )
    {
        $extra = null;
        if( isset( $cat['extra_rate'] ) && $cat['extra_rate'] )
        {
            $extra = array(
                'title' => $cat['extra_rate'],
                'desc' => $cat['extradesc'],
                'eratings' => explode( "<br />", $cat['eratings'] )
            );
        }

        $data = array(
            'product_id' => $cat['cid'],
            'product_category' => $cat['cparent'],
            'product_name' => $cat['cname'],
            'product_name_seo' => \IPS\Http\Url\Friendly::seoTitle( $cat['cname'] ),
            'product_description' => html_entity_decode( $cat['longdesc'] ),
            'product_image' => $cat['cimg'] ?: null,
            'product_image_description' => $cat['imgdesc'] ?: null,
            'product_extra' => ( $extra !== null ? json_encode( $extra ) : null ),
            'product_fav' => $cat['extra_fav'] ?: null,
            'product_owned' => $cat['extra_owned'] ?: null,
            'product_mustbuy' => $cat['mustbuy'],
            'product_owner_id' => $cat['owner_id'],
            'product_total_favs' => $cat['favs'],
            'product_total_wishes' => $cat['wishes'],
            'product_total_owned' => $cat['owned'],
            'product_total_tracked' => $cat['tracked'],
            'product_views' => $cat['views'],
            'product_bayesian' => $cat['bayesian_rating'],
            'product_weighted' => $cat['weighted_rating'],
            'product_enabled' => ( $cat['hidden'] ? 0 : 1 )
        );
        \IPS\Db::i()->replace( 'reviews_products', $data );
    }

    /**
     * Updates a legacy review to the new structure
     *
     * @param array $row
     * @return void
     */
    protected function updateLegacyReview( $row )
    {
        $data = array(
            'review_id' => $row['id'],
            'review_member_id' => $row['mid'],
            'review_product_id' => $row['cid'],
            'review_title' => $row['title'],
            'review_content' => $row['content'],
            'review_conclusion' => $row['conclusion'],
            'review_pros' => $row['pros'],
            'review_cons' => $row['cons'],
            'review_overall' => $row['overall'],
            'review_approved' => $row['approved'],
            'review_locked' => $row['locked'],
            'review_date' => \IPS\DateTime::ts( $row['time'] )->format( 'Y-m-d H:i:s' ),
            'review_edit_time' => \IPS\DateTime::ts( $row['edit_time'] )->format( 'Y-m-d H:i:s' ),
            'review_buy' => $row['buy'],
            'review_status' => $row['status'],
            'review_awards' => $row['awards'],
            'review_points' => $row['points'],
            'review_views' => $row['views'],
            'review_tracked' => $row['tracked'],
            'review_total_comments' => $row['rcomments'],
            'review_fills' => $row['fills'],
            'review_worth' => $row['worth']
        );

        \IPS\Db::i()->replace( 'reviews_reviews', $data );
    }
}