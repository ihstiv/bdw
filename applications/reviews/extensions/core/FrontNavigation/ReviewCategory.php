<?php
/**
 * @brief		Front Navigation Extension: ReviewCategory
 * @author		<a href='http://www.invisionpower.com'>Invision Power Services, Inc.</a>
 * @copyright	(c) 2001 - 2016 Invision Power Services, Inc.
 * @license		http://www.invisionpower.com/legal/standards/
 * @package		IPS Community Suite
 * @subpackage	Member Reviews
 * @since		10 Jul 2017
 * @version		SVN_VERSION_NUMBER
 */

namespace IPS\reviews\extensions\core\FrontNavigation;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * Front Navigation Extension: ReviewCategory
 */
class _ReviewCategory extends \IPS\core\FrontNavigation\FrontNavigationAbstract
{
	/**
	 * Get Type Title which will display in the AdminCP Menu Manager
	 *
	 * @return	string
	 */
	public static function typeTitle()
	{
		return \IPS\Member::loggedIn()->language()->addToStack( 'frontnavigation_reviews' );
	}
	
	/**
	 * Can this item be used at all?
	 * For example, if this will link to a particular feature which has been diabled, it should
	 * not be available, even if the user has permission
	 *
	 * @return	bool
	 */
	public static function isEnabled()
	{
		return TRUE;
	}
	
	/**
	 * Can the currently logged in user access the content this item links to?
	 *
	 * @return	bool
	 */
	public function canAccessContent()
	{
		return TRUE;
	}

    /**
     * Allow multiple instances?
     *
     * @return	string
     */
    public static function allowMultiple()
    {
        return true;
    }

    /**
     * Get configuration fields
     *
     * @param	array	$configuration	The existing configuration, if editing an existing item
     * @param	int		$id				The ID number of the existing item, if editing
     * @return	array
     */
    public static function configuration( $existingConfiguration, $id = NULL )
    {
        return array(
            'id' => new \IPS\Helpers\Form\Node( 'reviews_category_id', isset( $existingConfiguration['id'] ) ? $existingConfiguration['id'] : null, true, array(
                'class' => 'IPS\reviews\Category',
                'multiple' => false,
                'permissionCheck' => function( $val ){
                    if( $val instanceof \IPS\reviews\Category )
                    {
                        return $val->enabled;
                    }
                    return false;
                }
            ) ),
            'use_default' => new \IPS\Helpers\Form\YesNo( 'reviews_use_default', isset( $existingConfiguration['title'] ) && $existingConfiguration['title'] ? 0 : 1, false, array(
                'togglesOff' => array( 'reviews_block_title' )
            ) ),
            'title' => new \IPS\Helpers\Form\Text( 'reviews_block_title', isset( $existingConfiguration['title'] ) ? $existingConfiguration['title'] : null, false, array(), null, null, null, 'reviews_block_title' )
        );
    }

    /**
     * Parse configuration fields
     *
     * @param	array	$configuration	The values received from the form
     * @return	array
     */
    public static function parseConfiguration( $configuration, $id )
    {
        return array(
            'id' => $configuration['reviews_category_id']->_id,
            'title' => ( $configuration['reviews_use_default'] || !$configuration['reviews_block_title'] ) ? null : $configuration['reviews_block_title']
        );
    }
	
	/**
	 * Get Title
	 *
	 * @return	string
	 */
	public function title()
    {
        if( isset( $this->configuration['title'] ) && $this->configuration['title'] )
        {
            return $this->configuration['title'];
        }

        return \IPS\reviews\Category::load( $this->configuration['id'] )->_title;
	}
	
	/**
	 * Get Link
	 *
	 * @return	\IPS\Http\Url
	 */
	public function link()
	{
	    return \IPS\reviews\Category::load( $this->configuration['id'] )->url();
	}
	
	/**
	 * Is Active?
	 *
	 * @return	bool
	 */
	public function active()
	{
		if( \IPS\Dispatcher::i()->application->directory != 'reviews' )
        {
            return false;
        }

        try
        {
            switch( \IPS\Dispatcher::i()->controller )
            {
                case 'category':
                    if( \IPS\Request::i()->id == $this->configuration['id'] )
                    {
                        return true;
                    }

                    return \IPS\reviews\Category::load( \IPS\Request::i()->id )->root == $this->configuration['id'];
                    break;

                case 'product':
                    return \IPS\reviews\Product::load( \IPS\Request::i()->id )->root()->_id == $this->configuration['id'];
                    break;

                case 'review':
                    return \IPS\reviews\Review::load( \IPS\Request::i()->id )->product()->root()->_id == $this->configuration['id'];
                    break;
            }
        }
        catch( \OutOfRangeException $e ){}

        return false;
	}

	/**
	 * Children
	 *
	 * @param	bool	$noStore	If true, will skip datastore and get from DB (used for ACP preview)
	 * @return	array
	 */
	public function children( $noStore=FALSE )
	{
		return NULL;
	}
}