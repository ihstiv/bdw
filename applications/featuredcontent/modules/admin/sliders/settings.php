<?php


namespace IPS\featuredcontent\modules\admin\sliders;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * settings
 */
class _settings extends \IPS\Dispatcher\Controller
{
	/**
	 * Execute
	 *
	 * @return	void
	 */
	public function execute()
	{
		\IPS\Dispatcher::i()->checkAcpPermission( 'settings_manage' );
		parent::execute();
	}

	/**
	 * Manage Settings
	 *
	 * @return	void
	 */
	protected function manage()
	{
		\IPS\Output::i()->title = \IPS\Member::loggedIn()->language()->addToStack('settings');

		$form = new \IPS\Helpers\Form;

		$options = array( 'none' => 'fcc_resizer_no', 'buildin' => 'fcc_resizer_internalfunction', 'script' => 'fcc_resizer_externalscript'	);
		$toggles = array( 'script' => array( 'fcontent_imageOnTheFly' ) );
		$form->add( new \IPS\Helpers\Form\Select( 'fcontent_resizerMode', \IPS\Settings::i()->fcontent_resizerMode ? \IPS\Settings::i()->fcontent_resizerMode : 'none', FALSE, array( 'options' => $options, 'toggles' => $toggles ) ) );	
		$form->add( new \IPS\Helpers\Form\Text( 'fcontent_imageOnTheFly', \IPS\Settings::i()->fcontent_imageOnTheFly, FALSE, array(), NULL, NULL, NULL, 'fcontent_imageOnTheFly' ) );
		
		$form->add( new \IPS\Helpers\Form\TextArea( 'fcontent_ignoreurls', \IPS\Settings::i()->fcontent_ignoreurls, FALSE, array('rows' => 5), NULL, NULL, NULL, 'fcontent_ignoreurls' ) );
		
		
		if ( $values = $form->values() )
		{
			$form->saveAsSettings();
		}

		\IPS\Output::i()->output = $form;
	}
}