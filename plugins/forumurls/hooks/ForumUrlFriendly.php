//<?php

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	exit;
}

class hook260 extends _HOOK_CLASS_
{
    /**
     * Build the friendly URL definition
     *
     * @param	string		$friendly		Friendly URL pattern
     * @param	string		$real			Non-friendly URL pattern
     * @param	NULL|string	$appTopLevel	FURL slug if the app is not the default app
     * @param	bool		$appIsDefault	Flag to indicate if the app is default or not
     * @param	NULL|string	$alias			Friendly URL alias
     * @param	bool		$custom			Flag to indicate if this is a custom FURL definition
     * @param	string		$verify			The name of a class that contains a loadFromUrl() and an url() method for verifying the friendly URL is correct
     * @param	array		$seoTitles		The class, query param and property to load from to rebuild seo titles
     * @param	bool|null	$seoPagination	Whether to use SEO-friendly pagination (e.g. /page/2/) or not
     * @return	array
     */
    public static function buildFurlDefinition( $friendly, $real, $appTopLevel = NULL, $appIsDefault = FALSE, $alias = NULL, $custom = FALSE, $verify = NULL, $seoTitles = NULL, $seoPagination = NULL )
    {
	try
	{
	        $args = \func_get_args();
	        if( $args[2] == 'forums' && $args[0] && $args[0] != 'submit' && $args[0] != 'startTopic' )
	        {
	            $args[2] = null;
	        }
	
	        return \call_user_func_array( 'parent::buildFurlDefinition', $args );
	}
	catch ( \RuntimeException $e )
	{
		if ( method_exists( get_parent_class(), __FUNCTION__ ) )
		{
			return \call_user_func_array( 'parent::' . __FUNCTION__, \func_get_args() );
		}
		else
		{
			throw $e;
		}
	}
    }
}
