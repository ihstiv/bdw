<?php

class tapatalk_login extends public_core_global_login
{
    public function loginForm( $message="", $replacement='' )
    {
        if (defined('IN_MOBIQUO'))
        {
            if ($message == 'admin_force_log_in')
            {
                $this->registry->getClass('output')->showError($message);
            }
        }
        
        parent::loginForm($message, $replacement);
    }
}