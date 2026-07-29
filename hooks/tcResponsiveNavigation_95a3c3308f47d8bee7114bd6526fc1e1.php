<?php

class tcResponsiveNavigation 
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
      $html = ipsRegistry::getClass('output')->getTemplate('tomchristian')->tctc91_responsiveNavigation();
    }
    return $html;
  }
  public function replaceOutput( $output, $key )
  {
    if ( strstr(  ",{$this->settings['tcResponsive_group']},", ",{$this->memberData['member_group_id']}," ) )
    {
      $search = "nav_other_apps";
      $replace = "nav_other_apps_killed";
      $output = str_replace($search, $replace, $output);
    }
    return $output;
  }
}