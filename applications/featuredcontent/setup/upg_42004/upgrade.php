<?php


namespace IPS\featuredcontent\setup\upg_42004;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * 4.2.4 Upgrade Code
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
		
		\IPS\Db::i()->delete( 'core_sys_conf_settings', "conf_key IN ('fcontent_on')" );
			
		@unlink( \IPS\ROOT_PATH . "/applications/featuredcontent/interface/jquery.bxsliderfixed.min.js" );
		@unlink( \IPS\ROOT_PATH . "/applications/featuredcontent/interface/jquery.imageslider.js" );
		return TRUE;
	}
	
	// You can create as many additional methods (step2, step3, etc.) as is necessary.
	// Each step will be executed in a new HTTP request
}