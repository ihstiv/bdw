<?php


namespace IPS\reviews\setup\upg_10003;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * 1.0.3 Upgrade Code
 */
class _Upgrade
{
	/**
	 * ...
	 *
	 * @return	array|bool	If returns TRUE, upgrader will proceed to next step. If it returns any other value, it will set this as the value of the 'extra' GET parameter and rerun this step (useful for loops)
	 */
	public function step1()
	{
	    foreach( \IPS\Db::i()->select( 'category_id, category_name', 'reviews_categories' ) as $row )
        {
            \IPS\Db::i()->update( 'reviews_categories', array(
                'category_name_seo' => \IPS\Http\Url\Friendly::seoTitle( $row['category_name'] )
            ), array( 'category_id=?', $row['category_id'] ) );
        }

        return true;
	}

    /***
     * Re-index the products
     *
     * @return bool
     */
	public function step2()
    {
        \IPS\Task::queue( 'core', 'RebuildSearchIndex', array( 'class' => 'IPS\reviews\Product' ), 5 );

        return TRUE;
    }
}