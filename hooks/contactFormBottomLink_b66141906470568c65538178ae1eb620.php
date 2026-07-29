<?php

 /**
 * @author -RAW-
 * @copyright 2012
 * @link http://rawcodes.net
 * @filesource Contact Form
 * @version 2.2.2
 */
 
class contactFormBottomLink
{
	public $registry;
	public $settings;		
	public $memberData;	

	public function __construct()
	{
		$this->registry   = ipsRegistry::instance();
		$this->settings =& $this->registry->fetchSettings();
		$this->member   = $this->registry->member();
		$this->memberData =& $this->registry->member()->fetchMemberData();
	}

	public function getOutput()
	{
		if ( in_array( $this->memberData['member_group_id'], explode( ',', $this->settings['contato_grupos'] ) ) )
		{
			return $this->registry->getClass('output')->getTemplate( 'global' )->contactFormButtonLink();
		}	
	}
}