<?php

class tapatalk_register_protection extends stopForumSpam
{
    public function registerProcessForm()
    {
        $in_email = strtolower( trim( $this->request['EmailAddress'] ) );
        
        if ($this->settings['tapatalk_spam_option'] > 1 && $in_email)
        {
            /* Get the file managemnet class */
            $TT_classToLoad = IPSLib::loadLibrary( IPS_KERNEL_PATH . 'classFileManagement.php', 'classFileManagement' );
            $TT_query = new $TT_classToLoad();
            $TT_query->timeout = ipsRegistry::$settings['spam_service_timeout'];
            
            $TT_ip = $this->member->ip_address;
            $TT_ipcheck = $TT_ip ? "&ip={$TT_ip}" : '';
            
            /* Query the service */
            if(!class_exists('classTTConnection'))
            {
                $TT_tapatalk_dir_name = isset(ipsRegistry::$settings['tapatalk_directory']) && !empty(ipsRegistry::$settings['tapatalk_directory']) ? ipsRegistry::$settings['tapatalk_directory'] : 'mobiquo';
                $TT_tapatalk_dir = DOC_IPS_ROOT_PATH . $TT_tapatalk_dir_name;
                include_once($TT_tapatalk_dir.'/lib/classTTConnection.php');
            } 

            $TT_connection = new classTTConnection();
            if($TT_connection->checkSpam($in_email,$TT_ipcheck))
                $this->registry->output->showError( 'spam_denied_account', '100x001', FALSE, '', 200 );
        }
        
        parent::registerProcessForm();
    }
}