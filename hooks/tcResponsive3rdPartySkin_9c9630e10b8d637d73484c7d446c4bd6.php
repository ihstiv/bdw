<?php

class tcResponsive3rdPartySkin 
{
  protected $registry;

  public function __construct()
  {
    $this->registry   =  ipsRegistry::instance();
    $this->memberData   =& $this->registry->member()->fetchMemberData();
    $this->settings   =& $this->registry->fetchSettings();
  }
  public function getOutput()
  {
  }
  public function replaceOutput( $output, $key )
  {
    if ( strstr(  ",{$this->settings['tcResponsive_group']},", ",{$this->memberData['member_group_id']}," ) )
    {
      $skins = ipsRegistry::$settings['tcResponsive_installedSkins'];
      $search = "<html";
      $replace = "<html class='$skins'";
      $output = str_replace($search, $replace, $output);
    }
    return $output;
  }
}