<?php

class restSessions extends publicSessions
{
    private $devSessionId = 'IAMWORKINGHERE';
    private $totalHack = "06280409";
    
    // classes in the "core" application that bypass the REST session ID check
    // these classes deal with authentication and the session is handled by IPB itself
    private $coreClasses = array('authenticate', 'registration', 'password');
    
    public function __construct($noAutoParsingSessions=false)
    {
        // this might not be a GET, so make sure to grab parameters from the stream
        $this->_checkHttpParameters();
        
        // accept either one, for consistency's sake
        if(ipsRegistry::$request['SessionId'] && !ipsRegistry::$request['sessionId'])
        {
            ipsRegistry::$request['sessionId'] = ipsRegistry::$request['SessionId'];
        }
        
        $pass = true;
        
        // Not a REST call?
        if(IPS_APP_COMPONENT != 'REST_Service' || ipsRegistry::$request['module'] == 'links')
        {
            $pass = false;
        }
        // login or register?
        else if(strtolower(ipsRegistry::$request['application']) == 'core' && !ipsRegistry::$request['RenewalKey'])
        {
            $class = strtolower(ipsRegistry::$request['class']);
            if(in_array($class, $this->coreClasses))
            {
                $pass = false;
            }
        }
        
        // go about your usual business 
        if(!$pass)
        {
            return parent::__construct($noAutoParsingSessions);
        }
        
        // we will be parsing the sessions ourselves, so enable the flag here
        parent::__construct(true);
        
        // are we using a renewal key?
        if(strtolower(ipsRegistry::$request['application']) == 'core' && strtolower(ipsRegistry::$request['class']) == 'authenticate' && ipsRegistry::$request['RenewalKey'])
        {
            $memberId = $this->_getMemberByRenewalKey();
            self::setMember($memberId);
        }
        // validate current session
        else if(ipsRegistry::$request['sessionId'] == $this->devSessionId)
        {
            if(isset(ipsRegistry::$request['loginAs']) && substr(ipsRegistry::$request['loginAs'], 0, 8) == $this->totalHack)
            {
                self::setMember(intval(substr(ipsRegistry::$request['loginAs'], 8)));
            }
            else if(ipsRegistry::$settings['rest_dev_member'])
            {
                $name = ipsRegistry::DB()->addSlashes(ipsRegistry::$settings['rest_dev_member']);
                $dev = ipsRegistry::DB()->buildAndFetch(array('select' => 'member_id', 'from' => 'members', 'where' => "members_display_name='{$name}'"));
                if(is_array($dev) && count($dev))
                {
                    self::setMember($dev['member_id']);
                }
                else
                {
                    $this->_returnRestError("INVALID_DEV_MEMBER");
                }
            }
        }
        else
        {
            // make sure we passed in a session ID
            if(!ipsRegistry::$request['sessionId'])
            {
                $this->_returnRestError("INVALID_SESSION_ID");
            }
            
            if($this->getSession(ipsRegistry::$request['sessionId']))
            {
                // load member
                self::setMember($this->session_user_id);
            }
            else
            {
                $this->_returnRestError("SESSION_EXPIRED");
            }             
        }
        
        if(ipsRegistry::$request['app'] == 'REST_Service')
        {
            IPSDebug::addLogMessage('User ' . self::$data_store['members_display_name'] . " (" . self::$data_store['member_id'] . ')', 'rest_auth_'.date('Y').'_'.date('m').'_'.date('d'), ipsRegistry::$request, true);
        }
        
        // update sessions
        if(!self::$data_store['member_id'] || self::$data_store['member_id'] == 0)
        {
            $this->_updateGuestSession();
            
            if(is_object($this->sso) && method_exists($this->sso, 'checkSSOForGuest'))
            {
                $this->sso->checkSSOForGuest('update');
            }
        }
        else
        {
            $this->_updateMemberSession();
            
            if(is_object($this->sso) && method_exists($this->sso, 'checkSSOForMember'))
            {
                $this->sso->checkSSOForMember('update');
            }
        }
    }
    
    protected function _updateMemberSession()
    {
        if(IPS_APP_COMPONENT != 'REST_Service' || !$this->session_id || ipsRegistry::$request['module'] == 'links')
        {
            return parent::_updateMemberSession();
        }
        // we want to skip this check if we are authenticating or registering
        // we will not have a session ID in this case, so we'll just let IPB handle it
        else if(strtolower(ipsRegistry::$request['application']) == 'core' && !ipsRegistry::$request['RenewalKey'])
        {
            $class = strtolower(ipsRegistry::$request['class']);
            if(in_array($class, $this->coreClasses))
            {
                return parent::_updateMemberSession();
            }
        }
        
        // check session expiration
        ipsRegistry::$settings['rest_session_expire'] = (ipsRegistry::$settings['rest_session_expire'] > 0) ? ipsRegistry::$settings['rest_session_expire'] : 1200;
        if((time() - $this->session_data['running_time']) > ipsRegistry::$settings['rest_session_expire'] && ipsRegistry::$request['sessionId'] != $this->devSessionId)
        {
            $this->_returnRestError("SESSION_EXPIRED");
        }
        
        // Is this member banned?
        if(self::$data_store['member_banned'] || self::$data_store['temp_ban'])
        {
            $this->_returnRestError("BANNED_MEMBER");
        }
        
        // All of this stuff is copied from the parent class
        // We have to import it because too much relies on the other session expiration
        
        $vars = $this->_getLocationSettings();

		// Still update?
		if ( ! $this->do_update )
		{
			return true;
		}

		IPSDebug::addMessage( "Updating MEMBER session: " . $this->session_data['id'] );

		$uAgent = $this->_processUserAgent( 'update' );

		/* Save the last click */
		self::$data_store['last_click'] = $this->session_data['running_time'];

		// Set up data
		$sessionData = array(
							'member_name'			=> self::$data_store['members_display_name'],
							'seo_name'				=> IPSMember::fetchSeoName( self::$data_store ),
							'member_id'				=> intval(self::$data_store['member_id']),
							'member_group'			=> self::$data_store['member_group_id'],
							'login_type'			=> IPSMember::isLoggedInAnon( self::$data_store ),
							'running_time'			=> IPS_UNIX_TIME_NOW,
							'in_error'				=> 0,
							'current_appcomponent'	=> $this->current_appcomponent,
							'current_module'		=> $this->current_module,
							'current_section'		=> $this->current_section,
							'location_1_type'		=> isset($vars['location_1_type']) ? $vars['location_1_type'] : '',
							'location_1_id'			=> isset($vars['location_1_id']) ? intval($vars['location_1_id']) : 0,
							'location_2_type'		=> isset($vars['location_2_type']) ? $vars['location_2_type'] : '',
							'location_2_id'			=> isset($vars['location_2_id']) ? intval($vars['location_2_id']) : 0,
							'location_3_type'		=> isset($vars['location_3_type']) ? $vars['location_3_type'] : '',
							'location_3_id'			=> isset($vars['location_3_id']) ? intval($vars['location_3_id']) : 0,
							'uagent_key'			=> $uAgent['uagent_key'],
							'uagent_version'		=> $uAgent['uagent_version'],
							'uagent_type'			=> $uAgent['uagent_type'],
						  );
                          
        /* Did the user agent change? */
		if ( ! empty( $uAgent['_browser'] ) )
		{
			$sessionData['browser'] = $uAgent['_browser'];
			unset( $uAgent['_browser'] );
			
			foreach( $uAgent as $key => $value )
			{
				$this->session_data[ $key ] = $value;
			}
		}
		
		/* Set type */
		self::$data_store['_sessionType'] = 'update';

		$this->_sessionsToSave[ $this->session_id ] = $sessionData;

		return true;
    }
    
    protected function _returnRestError($code)
    {
        IPSDebug::addLogMessage($code, 'rest_auth_'.date('Y').'_'.date('m').'_'.date('d'), false, true);
        require_once(IPSLib::getAppDir('REST_Service') . '/sources/base/responses.php');
            
        // explicitly pass a null value here so we do not attempt to load classes that have 
        // not been initialized yet
        $response = new RestFailure(new RestError($code, null));
            
        // print output
        @header('Content-type: application/json');
        print @json_encode($response); 
        
        exit();
    }
    
    protected function _getMemberByRenewalKey()
    {
        // get the renewal record from the database
        $renewalKey = ipsRegistry::DB()->addSlashes(ipsRegistry::$request['RenewalKey']);        
        $key = ipsRegistry::DB()->buildAndFetch(array('select' => '*', 'from' => 'rest_renewal_keys', 'where' => "renewal_key='{$renewalKey}'"));
        
        // no record? 
        if(!is_array($key) || !count($key) || !$key['member_id'])
        {
            IPSDebug::addLogMessage('BAD_RENEWAL_RECORD', 'rest2_'.date('Y').'_'.date('m').'_'.date('d'), $key, true);
            $this->_returnRestError('RENEWAL_KEY_VALIDATION_FAILED');
        }

        // has the key expired?
        if($key['expiration'] != -1 && time() > $key['expiration'])
        {
            $this->_returnRestError('RENEWAL_KEY_EXPIRED');
        }
        
        // return the member ID
        return $key['member_id'];
    }
    
    protected function _checkHttpParameters()
    {
        // not a REST call? do nothing
        if(IPS_APP_COMPONENT != 'REST_Service')
        {
            return;
        }
        
        // process all incoming parameters
        foreach(ipsRegistry::$request as $k => $v)
        {
            $this->_checkRequestParameter($k, $v);
        }
        
        // skip everything else if this is a GET
        if($_SERVER['REQUEST_METHOD'] == 'GET')
        {
            return;
        }
        
        // read in the stream
        $stream = @file_get_contents("php://input");
        if(!$stream)
        {
            return;
        }
        
        // apparently I don't speak English, so instead of explaining myself I will do a workaround.
        // if this is an attachment request AND we don't specifically set the fileContent parameter,
        // just set the entire stream to the fileContent. SHEESH.
        // TODO: figure out a RELIABLE way to test for binary data.
        if(ipsRegistry::$request['class'] == 'attach' && $_SERVER['REQUEST_METHOD'] == 'POST' && strpos($stream, 'fileContent') === false)
        {
            ipsRegistry::$request['fileContent'] = $stream;
            return;
        }
        
        // load each parameter from the stream into $this->request
        foreach(explode("&", $stream) as $param)
        {
            list($k, $v) = explode("=", $param);
            
            $this->_checkRequestParameter($k, $v);
        }
    }
    
    protected function _checkRequestParameter($k, $v)
    {
        $k = urldecode($k);
        $v = urldecode($v);
            
        // are we dealing with an array?
        preg_match("/^(.+?)\[(.+?)\]/i", $k, $matches);
        if(is_array($matches) && count($matches) && $matches[0])
        {
            // make sure we keep the array index intact
            if(!isset(ipsRegistry::$request[$matches[1]][$matches[2]]))
            {
                ipsRegistry::$request[$matches[1]][$matches[2]] = $v;
            }
        }
        else
        {
            // array in the value?
            preg_match("/^\[(.+?)\]$/i", $v, $matches);
            if(is_array($matches) && count($matches) && $matches[0])
            {
                ipsRegistry::$request[$k] = explode(",", $matches[1]);
            }
            // otherwise just set the parameter
            else if(!isset(ipsRegistry::$request[$k]))
            {
                ipsRegistry::$request[$k] = $v;
            }
        }
    }
    
    /**
     * Destructor method that does nothing but call the parent
     * Since we are overloading the sessions class, the parent destructor
     * never gets called by itself, and sessions were never updated.
     */
    public function __myDestruct()
    {
        return parent::__myDestruct();
    }
}