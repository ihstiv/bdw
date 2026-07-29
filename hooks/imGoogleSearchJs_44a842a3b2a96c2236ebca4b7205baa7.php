<?php


class imGoogleSearchJs
{
	public function __construct()
	{
		$this->registry 	=  ipsRegistry::instance();
		$this->memberData 	=& $this->registry->member()->fetchMemberData();
	}
	
	public function getOutput()
	{
		ipsRegistry::$settings['im_googleSearch-cseKey']	= trim( ipsRegistry::$settings['im_googleSearch-cseKey'] );
		
		if ( ! IPSMember::isInGroup( $this->memberData, explode( ',', ipsRegistry::$settings['im_googleSearch-groupPerm'] ) ) )
		{
			return false;
		}
		
		return $this->registry->output->getTemplate( 'global' )->imGoogleSearchJs();
	}
}