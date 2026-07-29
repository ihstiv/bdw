<?php

/*
+--------------------------------------------------------------------------
|   Reviews
|   =============================================
|   by Esther Eisner
|   7/3/2017 11:36 PM
|   Copyright 2017 HeadStand Consulting
|   esther@headstandconsulting.com
+--------------------------------------------------------------------------
*/

namespace IPS\reviews\Review;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

class _Comment extends \IPS\Content\Comment implements \IPS\Content\Hideable,
    \IPS\Content\Searchable
{

    use \IPS\Content\Reactable;
    use \IPS\Content\Reportable;

    /**
     * @brief	[ActiveRecord] Multiton Store
     */
    protected static $multitons;

    /**
     * @brief	[Content\Comment]	Item Class
     */
    public static $itemClass = 'IPS\reviews\Review';

    /**
     * @brief	[ActiveRecord] Database Table
     */
    public static $databaseTable = 'reviews_comments';

    /**
     * @brief	[ActiveRecord] Database Prefix
     */
    public static $databasePrefix = '';

    /**
     * @brief	Database Column Map
     */
    public static $databaseColumnMap = array(
        'item'				=> 'rid',
        'author'			=> 'mid',
        'author_name'		=> 'mem_name',
        'content'			=> 'comment',
        'date'				=> 'time',
        'approved'			=> 'approved'
    );

    /**
     * @brief	Application
     */
    public static $application = 'reviews';

    /**
     * @brief	Title
     */
    public static $title = 'review_comment';

    /**
     * @brief	Icon
     */
    public static $icon = 'comment';

    /**
     * @brief	[Content]	Key for hide reasons
     */
    public static $hideLogKey = 'reviews-reviews';

    /**
     * Reaction Type
     *
     * @return	string
     */
    public static function reactionType()
    {
        return 'comment_id';
    }
}