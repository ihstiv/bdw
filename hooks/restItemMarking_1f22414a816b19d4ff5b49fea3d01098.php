<?php

class restItemMarking extends classItemMarking
{    
    protected function _fetchModule( $app='' )
    {
        if(IPS_APP_COMPONENT == 'REST_Service' && $this->request['application'])
        {
            $app = $this->_getRestApp();
        }
        
        return parent::_fetchModule($app);
    }
    
    public function getSqlJoin( $data, $app='' )
    {
        if(IPS_APP_COMPONENT == 'REST_Service' && $this->request['application'])
        {
            $app = $this->_getRestApp();
        }
        
        return parent::getSqlJoin($data, $app);
    }
    
    public function setFromSqlJoin( $data, $app='' )
    {
        if(IPS_APP_COMPONENT == 'REST_Service' && $this->request['application'])
        {
            $app = $this->_getRestApp();
        }
        
        return parent::setFromSqlJoin($data, $app);
    }
    
    public function isRead( $data, $app='' )
    {
        if(IPS_APP_COMPONENT == 'REST_Service' && $this->request['application'])
        {
            $app = $this->_getRestApp();
        }
        
        return parent::isRead($data, $app);
    }
    
    public function markRead( $data, $app='' )
    {
        if(IPS_APP_COMPONENT == 'REST_Service' && $this->request['application'])
        {
            $app = $this->_getRestApp();
        }
        
        return parent::markRead($data, $app);
    }
    
    public function markAppAsRead( $app='' )
    {
        if(IPS_APP_COMPONENT == 'REST_Service' && $this->request['application'])
        {
            $app = $this->_getRestApp();
        }
        
        return parent::markAppAsRead($app);
    }
    
    public function fetchTimeLastMarked( $data, $app='' )
    {
        if(IPS_APP_COMPONENT == 'REST_Service' && $this->request['application'])
        {
            $app = $this->_getRestApp();
        }
        
        return parent::fetchTimeLastMarked($data, $app);
    }
    
    public function fetchUnreadCount( $data, $app='' )
    {
        if(IPS_APP_COMPONENT == 'REST_Service' && $this->request['application'])
        {
            $app = $this->_getRestApp();
        }
        
        return parent::fetchUnreadCount($data, $app);
    }
    
    public function fetchOldestUnreadTimestamp( $data, $app='' )
    {
        if(IPS_APP_COMPONENT == 'REST_Service' && $this->request['application'])
        {
            $app = $this->_getRestApp();
        }
        
        return parent::fetchOldestUnreadTimestamp($data, $app);
    }
    
    public function fetchReadIds( $data, $app='', $keysOnly=true )
    {
        if(IPS_APP_COMPONENT == 'REST_Service' && $this->request['application'])
        {
            $app = $this->_getRestApp();
        }
        
        return parent::fetchReadIds($data, $app, $keysOnly);
    }
    
    public function fetchItemReadTime( $data, $app='' )
    {
        if(IPS_APP_COMPONENT == 'REST_Service' && $this->request['application'])
        {
            $app = $this->_getRestApp();
        }
        
        return parent::fetchItemReadTime($data, $app);
    }
    
    protected function _getRestApp()
    {
        $app = strtolower($this->request['application']);
        
        switch($app)
        {
            case 'users':
                return 'members';
                break;
                
            // this is a search request for /REST/search/global and should default to 'forums'
            case 'global':
                return 'forums';
                break;
                
            default:
                return $app;
                break;
        }
    }
}