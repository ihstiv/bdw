<?php

class boardIndexNexusDonations
{
	private $hookGateway;
	
	public function __construct()
	{
		$registry    =  ipsRegistry::instance();
		
		require_once( IPSLib::getAppDir( 'nexus' ) . '/sources/hooks.php' );
		$this->hookGateway = new nexusHooks( $registry );
	}
	
	public function getOutput()
	{
		return $this->hookGateway->donationBlock();
	}	
}