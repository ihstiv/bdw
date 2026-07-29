<?php

class restOutput extends topicMetaOutput
{
    public function showError($message, $code=0, $logError=FALSE, $logExtra='', $header=401)
    {
        if(IPS_APP_COMPONENT != 'REST_Service')
        {
            return parent::showError($message, $code, $logError, $logExtra, $header);
        }
        
        IPSDebug::addLogMessage("showError {$code}: {$message}", 'rest2_'.date('Y').'_'.date('m').'_'.date('d'), false, true);
        require_once(IPSLib::getAppDir('REST_Service') . '/sources/base/responses.php');
            
        $response = new RestFailure(new RestError($code, $message));
            
        // print output
        @header('Content-type: application/json');
        print @json_encode($response); 
        
        exit();
    }
    
    public function silentRedirect($url, $seoTitle='', $send301=FALSE, $seoTemplate='')
    {
        if(IPS_APP_COMPONENT != 'REST_Service')
        {
            return parent::silentRedirect($url, $seoTitle, $send301, $seoTemplate);
        }
        
        IPSDebug::addLogMessage("silentRedirect to {$url}", 'rest2_'.date('Y').'_'.date('m').'_'.date('d'), false, true);
        require_once(IPSLib::getAppDir('REST_Service') . '/sources/base/responses.php');
            
        $response = new RestFailure(new RestError('REDIRECT_ATTEMPT'));
            
        // print output
        @header('Content-type: application/json');
        print @json_encode($response); 
        
        exit();
    }
    
    public function sendOutput($return=false)
    {
        switch(ipsRegistry::$current_application)
        {
            case 'forums':
                $this->_insertForumAppLinks();
                break;
        }
        
        return parent::sendOutput($return);
    }
    
    protected function _insertForumAppLinks()
    {
        // make sure we are in the forums module or do nothing
        if(ipsRegistry::$current_module != 'forums')
        {
            return;
        }
        
        // now... what are we looking at?
        switch(ipsRegistry::$current_section)
        {
            case 'boards':
                break;
                
            case 'forums':
                break;
                
            case 'topics':
                $this->registry->output->addMetaTag("al:ios:url", "bariatricpal://topic/" . intval($this->request['t']));
                $this->registry->output->addMetaTag("al:ios:app_store_id", "12345");
                $this->registry->output->addMetaTag("al:ios:app_name", "BariatricPal Pro");
                $this->registry->output->addMetaTag("al:android:url", "bariatricpal://topic/" . intval($this->request['t']));
                $this->registry->output->addMetaTag("al:android:app_name", "BariatricPal Pro");
                $this->registry->output->addMetaTag("al:android:package", "");
                
                // get the topic title
                $topic = $this->DB->buildAndFetch(array('select' => 'title_seo', 'from' => 'topics', 'where' => 'tid=' . $this->request['t']));
                $this->registry->output->addMetaTag("al:web:url", $this->buildSEOUrl("showtopic={$this->request['t']}", 'publicNoSession', $topic['title_seo'], 'showtopic'));
                break;
        }
    }
}