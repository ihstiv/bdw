<?php
class tcResponsiveKillMobileSkin extends tapatalk_output
{
  protected function _fetchUserSkin()
  {
    $skinId = parent::_fetchUserSkin();
    $allSkins = parent::_fetchAllSkins();
    
    $groups = explode(',', $this->settings['tcResponsive_group']);
    
    if($this->settings['tcResponsive_enabled'] && IPSMember::isInGroup($this->memberData, $groups) && $allSkins[$skinId]['set_key'] == 'mobile')
    {
      $skinId = parent::_fetchSkinByDefault();
    }
    
    return $skinId;
  }
}