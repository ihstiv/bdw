<?php
/**
 * @brief		Admin CP Group Form
 * @author		<a href='http://www.invisionpower.com'>Invision Power Services, Inc.</a>
 * @copyright	(c) 2001 - 2016 Invision Power Services, Inc.
 * @license		http://www.invisionpower.com/legal/standards/
 * @package		IPS Community Suite
 * @subpackage	Member Reviews
 * @since		10 Jul 2017
 * @version		SVN_VERSION_NUMBER
 */

namespace IPS\reviews\extensions\core\GroupForm;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * Admin CP Group Form
 */
class _Reviews
{
	/**
	 * Process Form
	 *
	 * @param	\IPS\Helpers\Form		$form	The form
	 * @param	\IPS\Member\Group		$group	Existing Group
	 * @return	void
	 */
	public function process( &$form, $group )
	{
	    // @todo add more permissions
        /*Request
Request Offer
Question
Answer
Add Deal
Rate
Bypass Approval
Bypass Category Approval*/

        $current = json_decode( $group->g_member_reviews, true );
        $current = \is_array( $current ) ? $current : array(
            'view' => 0,
            'moderate' => 0,
            'review' => 0,
            'product' => 0,
            'comment' => 0
        );

		$form->add( new \IPS\Helpers\Form\YesNo( 'g_view_reviews',  $current['view'], false, array(
		    'togglesOn' => array( 'g_moderate_reviews', 'g_review_reviews', 'g_product_reviews', 'g_comment_reviews' )
        ) ) );
		$form->add( new \IPS\Helpers\Form\YesNo( 'g_moderate_reviews', $current['moderate'], false, array(), null, null, null, 'g_moderate_reviews' ) );
        $form->add( new \IPS\Helpers\Form\YesNo( 'g_review_reviews', $current['review'], false, array(), null, null, null, 'g_review_reviews' ) );
        $form->add( new \IPS\Helpers\Form\YesNo( 'g_product_reviews', $current['product'], false, array(), null, null, null, 'g_product_reviews' ) );
        $form->add( new \IPS\Helpers\Form\YesNo( 'g_comment_reviews', $current['comment'], false, array(), null, null, null, 'g_comment_reviews' ) );
	}
	
	/**
	 * Save
	 *
	 * @param	array				$values	Values from form
	 * @param	\IPS\Member\Group	$group	The group
	 * @return	void
	 */
	public function save( $values, &$group )
	{
	    $data = array(
	        'view' => $values['g_view_reviews'],
            'moderate' => $values['g_moderate_reviews'],
            'review' => $values['g_review_reviews'],
            'product' => $values['g_product_reviews'],
            'comment' => $values['g_comment_reviews']
        );
	    $group->g_member_reviews = json_encode( $data );
	}
}