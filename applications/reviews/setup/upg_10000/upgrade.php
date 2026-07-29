<?php


namespace IPS\reviews\setup\upg_10000;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * 1.0.0 Upgrade Code
 */
class _Upgrade
{
	/**
	 * ...
	 *
	 * @return	array	If returns TRUE, upgrader will proceed to next step. If it returns any other value, it will set this as the value of the 'extra' GET parameter and rerun this step (useful for loops)
	 */
	public function step1()
	{
        // if this is an upgrade from v3, then rename the category table first
        if( !\IPS\Db::i()->checkForTable( 'reviews_categories_v3' ) )
        {
            \IPS\Db::i()->renameTable( 'reviews_categories', 'reviews_categories_v3' );
        }

		return TRUE;
	}

    /**
     *
     */
	public function step2()
    {
        \IPS\Application::load( 'reviews' )->installOther();
        return true;
    }
}