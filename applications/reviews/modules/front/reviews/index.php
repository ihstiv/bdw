<?php


namespace IPS\reviews\modules\front\reviews;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * index
 */
class _index extends \IPS\Dispatcher\Controller
{
	/**
	 * Execute
	 *
	 * @return	void
	 */
	public function execute()
	{
		parent::execute();
	}

	/**
	 * ...
	 *
	 * @return	void
	 */
	protected function manage()
	{
		$roots = \IPS\reviews\Category::roots();

		\IPS\Output::i()->title = \IPS\Member::loggedIn()->language()->addToStack( 'reviews' );

		if( \count( $roots ) <= 2 )
        {
            \IPS\Output::i()->output = \IPS\Theme::i()->getTemplate( 'browse' )->columnLayout( $roots );
        }
        else
        {
            \IPS\Output::i()->output = \IPS\Theme::i()->getTemplate( 'browse' )->listLayout( $roots );
        }
	}
}