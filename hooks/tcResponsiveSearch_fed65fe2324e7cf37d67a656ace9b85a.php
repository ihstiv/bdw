<?php

class tcResponsiveSearch 
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
    if ( strstr(  ",{$this->settings['tcResponsive_group']},", ",{$this->memberData['member_group_id']}," ) )
    {
      $html = ipsRegistry::getClass('output')->getTemplate('tomchristian')->tctc91_responsiveSearch();
      return $html;
    }
  }
}