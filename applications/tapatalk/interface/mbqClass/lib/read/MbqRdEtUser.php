<?php

defined('MBQ_IN_IT') or exit;

MbqMain::$oClk->includeClass('MbqBaseRdEtUser');

/**
 * user read class
 */
Class MbqRdEtUser extends MbqBaseRdEtUser {

    public function __construct() {
    }
    public function makeProperty(&$oMbqEtUser, $pName, $mbqOpt = array()) {
        switch ($pName) {
            default:
                MbqError::alert('', __METHOD__ . ',line:' . __LINE__ . '.' . MBQ_ERR_INFO_UNKNOWN_PNAME . ':' . $pName . '.');
                break;
        }
    }
    public function login($login, $password, $anonymous = 0, $push=0) {


        $loginClass = new \IPS\Login(new \IPS\Http\Url(""));
        if(method_exists($loginClass, 'forms'))
        {
            $values = array();
            $values['auth'] = $login;
            $values['password'] = $password;
            $values['signin_anonymous'] = $anonymous;
            $forms = $loginClass->forms();
            $handlers = $loginClass::handlers();
            //code copied from system/login/login.php
            foreach ( $forms as $handler => $form )
            {
                if($handler != "_standard")
                {
                    continue;
                }
				/* Authenticate */
				$member = NULL;
				try
				{
					if ( $handler === '_standard' )
					{
						$values['auth'] = mb_strtolower( $values['auth'] );
						$member = $loginClass->authenticateStandard( $values );
					}
					else
					{
						$member = $handlers[ $handler ]->authenticate( is_object( $form ) ? $values : $this->url );
					}
				}
				catch ( \IPS\Login\Exception $e )
				{
					/* Check if the account is locked and throw that error rather than a bad password error first */
                    if ( $e->getCode() === \IPS\Login\Exception::BAD_PASSWORD )
                    {
                        $error = $this->checkIfAccountIsLocked( $e->member );
                        if(!$error)
                        {
                            $error = \IPS\Member::loggedIn()->language()->get( 'login_err_bad_password' );
                        }
                    }
                    else{
                        $error = $e->getMessage();
                    }
                    /* If we're still here, throw the error we got */
                    return $error;
				}

				/* If we passed, log in! */
				if ( $member->member_id )
				{
					/* Set which handler processed it */
					if ( $handler !== '_standard' ) // If _standard, is set in authenticateStandard()
					{
						$loginClass->usedHandler = $handler;
					}

					/* http://community.invisionpower.com/4bugtrack/upgrading-within-admincp-r3097 - we can't find any reason not checking this is desired at this time */
					//if( \IPS\Dispatcher::hasInstance() AND \IPS\Dispatcher::i()->controllerLocation != 'setup' )
					//{
                    /* Check if the account is locked */
                    $this->checkIfAccountIsLocked( $member );

                    /* Remove old failed login attempts */
                    if ( \IPS\Settings::i()->ipb_bruteforce_period and ( \IPS\Settings::i()->ipb_bruteforce_unlock or !isset( $member->failed_logins[ \IPS\Request::i()->ipAddress() ] ) or $member->failed_logins[ \IPS\Request::i()->ipAddress() ] < \IPS\Settings::i()->ipb_bruteforce_attempts ) )
                    {
                        $removeLoginsOlderThan = \IPS\DateTime::create()->sub( new \DateInterval( 'PT' . \IPS\Settings::i()->ipb_bruteforce_period . 'M' ) );
                        $failedLogins = $member->failed_logins;

                        /* The failed login data could potentially not be an array (i.e. a float) but as this code executes during the first
                        step of upgrading to 4.0 if we don't force it to be an array here we could end up with an error exception we can't
                        get past when attempting to upgrade. */
                        if( !is_array( $failedLogins ) )
                        {
                            $failedLogins = array();
                        }

                        if ( is_array( $failedLogins ) )
                        {
                            foreach ( $failedLogins as $ipAddress => $times )
                            {
                                foreach ( $times as $k => $v )
                                {
                                    if ( $v < $removeLoginsOlderThan->getTimestamp() )
                                    {
                                        unset( $failedLogins[ $ipAddress ][ $k ] );
                                    }
                                }
                            }
                            $member->failed_logins = $failedLogins;
                        }
                        else
                        {
                            $member->failed_logins = array();
                        }
                        $member->save();
                    }

                    /* If we're still here, the login was fine, so we can reset the count and process login */
                    if ( isset( $member->failed_logins[ \IPS\Request::i()->ipAddress() ] ) )
                    {
                        $failedLogins = $member->failed_logins;
                        unset( $failedLogins[ \IPS\Request::i()->ipAddress() ] );
                        $member->failed_logins = $failedLogins;
                    }
                    $member->last_visit = time();
                    $member->save();
					//}


                    MbqMain::$oMbqAppEnv->currentUserInfo = $member;

                    return $this->doLogin();
				}
            }
        }
        else
        {

            $leastOffensiveException = NULL;
            $success = NULL;
            $fails = array();

            foreach ( $loginClass->usernamePasswordMethods() as $method )
            {

                try
                {
                    if ( $loginClass->type === 4) //static::LOGIN_REAUTHENTICATE = 4
                    {
                        if ( $method->authenticatePasswordForMember( $loginClass->reauthenticateAs, $password ) )
                        {
                            $member = $loginClass->reauthenticateAs;
                        }
                        else
                        {
                            throw new \IPS\Login\Exception( 'login_err_bad_password', \IPS\Login\Exception::BAD_PASSWORD, NULL, $this->reauthenticateAs );
                        }
                    }
                    else
                    {
                        $member = $method->authenticateUsernamePassword( $loginClass, $login, $password );
                        if ( $member === TRUE )
                        {
                            $member = $loginClass->reauthenticateAs;
                        }
                    }

                    if ( $member )
                    {
                        static::checkIfAccountIsLocked( $member, TRUE );
                        $success = new \IPS\Login\Success( $member, $method, false, $anonymous );
                        break;
                    }
                }
                catch ( \IPS\Login\Exception $e )
                {
                    if ( $e->getCode() === \IPS\Login\Exception::BAD_PASSWORD and $e->member )
                    {
                        $fails[ $e->member->member_id ] = $e->member;
                    }

                    if ( $leastOffensiveException === NULL or $leastOffensiveException->getCode() < $e->getCode() )
                    {
                        $leastOffensiveException = $e;
                    }
                }

            }

            foreach ( $fails as $failedMember )
            {
                if ( !$success or $success->member->member_id != $failedMember->member_id )
                {
                    $failedLogins = is_array( $failedMember->failed_logins ) ? $failedMember->failed_logins : array();
                    $failedLogins[ \IPS\Request::i()->ipAddress() ][] = time();
                    $failedMember->failed_logins = $failedLogins;
                    $failedMember->save();
                }
            }

            if ( $success )
            {
                MbqMain::$oMbqAppEnv->currentUserInfo = $success->member;

                return $this->doLogin();
            }
            elseif ( $leastOffensiveException )
            {
                return false;
            }
            else
            {
                return false;
		    }

        }

        return false;
    }
    public function isIPB43()
    {
        return class_exists('\IPS\Login\Success');
    }
    public function loginDirectly($oMbqEtUser, $trustCode) {
        $member = \IPS\Member::load($oMbqEtUser->userId->oriValue);
        if(!isIPB43())
        {
            /* If we're still here, the login was fine, so we can reset the count and process login */
            if ( isset( $member->failed_logins[ \IPS\Request::i()->ipAddress() ] ) )
            {
                $failedLogins = $member->failed_logins;
                unset( $failedLogins[ \IPS\Request::i()->ipAddress() ] );
                $member->failed_logins = $failedLogins;
            }
            $member->last_visit = time();
            $member->save();
            //}
        }
        //setup cookies

        $expire = new \IPS\DateTime;
        $expire->add( new \DateInterval( 'P7D' ) );
        \IPS\Request::i()->setCookie( 'member_id', $member->member_id, $expire );
        \IPS\Request::i()->setCookie( 'pass_hash', $member->member_login_key, $expire );

        //  $member->memberSync( 'onLogin', array( \IPS\Login::getDestination() ) );


        MbqMain::$oMbqAppEnv->currentUserInfo = $member;

        return $this->doLogin();
    }
    private function doLogin()
    {
        $member = MbqMain::$oMbqAppEnv->currentUserInfo;
        if(!isIPB43())
        {
            $loginHandler = '_standard';
            $rememberMe = true;
            $anonymous = false;
            $bypass2FA = true;
            $destination = false;

            /* Get destination */
		    if ( !$destination )
		    {
			    $destination = \IPS\Http\Url::internal( '' );
		    }

		    /* Is this a known device? */
		    $device = \IPS\Member\Device::loadOrCreate( $member );

		    /* Do we need to do 2FA? */
            /*
		    if ( !$bypass2FA and $output = \IPS\MFA\MFAHandler::accessToArea( 'core', $device->known ? 'AuthenticateFrontKnown' : 'AuthenticateFront', \IPS\Http\Url::internal( '' ), $member ) )
		    {
            $_SESSION['processing2FA'] = array( 'memberId' => $member->member_id, 'anonymous' => $anonymous, 'remember' => $rememberMe, 'destination' => (string) $destination, 'handler' => $loginHandler );
            \IPS\Output::i()->redirect( $destination->setQueryString( '_mfaLogin', 1 ) );
		    }
             */
		    /* Log in */
		    \IPS\Session::i()->setMember( $member );
		    if ( $anonymous and !\IPS\Settings::i()->disable_anonymous )
		    {
			    \IPS\Session::i()->setAnon();
		    }

		    /* Log device */
		    $device->anonymous = $anonymous and !\IPS\Settings::i()->disable_anonymous;
		    $device->updateAfterAuthentication( $rememberMe, $loginHandler );

            $expire = new \IPS\DateTime;
            $expire->add( new \DateInterval( 'P7D' ) );
            \IPS\Request::i()->setCookie( 'member_id', $member->member_id, $expire );
            \IPS\Request::i()->setCookie( 'pass_hash', $member->member_login_key, $expire );
        }
        else
        {
            $success = new \IPS\Login\Success($member, new \IPS\Login\Handler\Standard(), true, false);
            $success->process();
        }

		$this->initOCurMbqEtUser(MbqMain::$oMbqAppEnv->currentUserInfo->member_id);
        return true;
    }
    public function initOCurMbqEtUser($userId) {
        if (MbqMain::$oMbqAppEnv->currentUserInfo) {
            MbqMain::$oCurMbqEtUser = $this->initOMbqEtUser(MbqMain::$oMbqAppEnv->currentUserInfo, array('case'=>'user_row','loggedUser'=>true));
        }
    }
    /**
     * get user objs
     *
     * @param  Mixed  $var
     * @param  Array  $mbqOpt
     * $mbqOpt['case'] = 'byUserIds' means get data by user ids.$var is the ids.
     * @mbqOpt['case'] = 'online' means get online user.
     * @return  Array
     */
    public function getObjsMbqEtUser($var, $mbqOpt) {
        if ($mbqOpt['case'] == 'byUserIds') {
            $result = array();
            foreach($var as $userId)
            {
                $result[] = $this->initOMbqEtUser($userId, array('case'=>'byUserId'));
            }
            return $result;
        } elseif ($mbqOpt['case'] == 'online') {

            $oMbqDataPage = $mbqOpt['oMbqDataPage'];

            /*COPY FROM applications\core\modules\front\online\online.php*/
            /* Sessions are written on shutdown so let's do it now instead */
            session_write_close();

            /* Initial filters */
            $where = array(
                array( "core_sessions.running_time>?", \IPS\DateTime::create()->sub( new \DateInterval( 'PT30M' ) )->getTimeStamp() ),
                array( "core_sessions.login_type!=?", \IPS\Session\Front::LOGIN_TYPE_SPIDER )
            );
            if ( !\IPS\Member::loggedIn()->isAdmin() )
            {
                $where[] = array( "core_sessions.login_type!=?", \IPS\Session\Front::LOGIN_TYPE_ANONYMOUS );
            }
            $where[] = array( "core_sessions.login_type!=?", \IPS\Session\Front::LOGIN_TYPE_GUEST );

            $where[] = "core_groups.g_hide_online_list=0";

            /* Create the table */
            $table = new \IPS\Helpers\Table\Db( 'core_sessions', \IPS\Http\Url::internal( 'app=core&module=online&controller=online', 'front', 'online' ), $where );
            //     $table->tableTemplate = array( \IPS\Theme::i()->getTemplate( 'online', 'core', 'front' ), 'onlineUsersTable' );
            //     $table->rowsTemplate	  = array( \IPS\Theme::i()->getTemplate( 'online', 'core', 'front' ), 'onlineUsersRow' );
            $table->langPrefix = 'online_users_';
            $table->include = array( 'member_id', 'photo', 'member_name', 'location_lang', 'running_time', 'ip_address', 'login_type' );
            $table->noSort	= array( 'photo', 'location_lang' );

            /* Joins */
            $table->joins = array(
                    array(
                        'select' => 'm.member_id',
                        'from' => array( 'core_members', 'm' ),
                        'where' => 'm.member_id=core_sessions.member_id'
                    ),
                    array(
                        'from' => 'core_groups',
                        'where' => 'core_sessions.member_group=core_groups.g_id'
                    ),
            );

            /* Custom parsers */
            $table->parsers = array(
                    'location_lang'	=> function( $val, $row )
                    {
                        return \IPS\Session\Front::getLocation( $row );
                    },
                    'photo' => function( $val, $row )
                    {
                        return \IPS\Theme::i()->getTemplate( 'global', 'core' )->userPhoto( \IPS\Member::load( $row['member_id'] ), 'mini' );
                    },
                    'running_time' => function( $val, $row )
                    {
                        return \IPS\DateTime::ts( $val )->relative();
                    },
                    'member_name' => function( $val, $row )
                    {
                        if( $row['member_id'] )
                        {
                            return \IPS\Theme::i()->getTemplate( 'global', 'core' )->userLink( \IPS\Member::load( $row['member_id'] ) );
                        }
                        else
                        {
                            return \IPS\Member::loggedIn()->language()->addToStack( 'guest' );
                        }
                    },
            );

            $table->filters = array(
                    'filter_loggedin'	=> 'm.member_id <> 0',
            );

            foreach ( \IPS\Member\Group::groups() as $group )
            {
                /* Hiding from online list? */
                if( $group->g_hide_online_list )
                {
                    continue;
                }

                /* Alias the lang keys */
                $realLangKey = "core_group_{$group->g_id}";
                $fakeLangKey = "online_users_group_{$group->g_id}";
                \IPS\Member::loggedIn()->language()->words[ $fakeLangKey ] = \IPS\Member::loggedIn()->language()->addToStack( $realLangKey, FALSE );

                if( $group->g_id == \IPS\Settings::i()->guest_group )
                {
                    $table->filters[ 'group_' . $group->g_id ] = 'm.member_id IS NULL';
                }
                else
                {
                    $table->filters[ 'group_' . $group->g_id ] = 'm.member_group_id=' . $group->g_id;
                }
            }

            $table->sortBy = $table->sortBy ?: 'running_time';
            $table->sortDirection = $table->sortDirection ?: 'desc';

            /* Get the count */
            $counter = \IPS\Db::i()->select( 'COUNT(*)', 'core_sessions', $where );

            foreach( $table->joins as $join )
            {
                $counter = $counter->join( $join['from'], $join['where'] );
            }
            $oMbqDataPage->totalNum = $counter->first();
            $table->page = $oMbqDataPage->curPage;
            $table->limit = $oMbqDataPage->numPerPage;
            $advancedSearchValues = array();
            $members = $table->getRows($advancedSearchValues);
            foreach($members as $member)
            {
                $oMbqDataPage->datas[] = $this->initOMbqEtUser($member['member_id'], array('case'=>'byUserId'));
            }
            return $oMbqDataPage;
        }
        elseif ($mbqOpt['case'] == 'recommended') {
            $oMbqDataPage = $mbqOpt['oMbqDataPage'];
            $where = array(  );
            $order = "name ASC";

            $select	= \IPS\Db::i()->select( 'core_members.*', 'core_members', $where, $order, array( ( $oMbqDataPage->curPage - 1 ) * $oMbqDataPage->numPerPage, $oMbqDataPage->numPerPage ), NULL, NULL, \IPS\Db::SELECT_SQL_CALC_FOUND_ROWS );

            $results	= new \IPS\Patterns\ActiveRecordIterator( $select, 'IPS\Member' );

            $members = array();
            $oMbqDataPage->totalNum = $results->count( TRUE );
            foreach($results as $member)
            {
                $members[] = $this->initOMbqEtUser($member, array('case'=>'user_row'));
            }
            $oMbqDataPage->datas = $members;
            return $oMbqDataPage;
        }
        elseif ($mbqOpt['case'] == 'searchByName') {
            $keywords = $var;
            $oMbqDataPage = $mbqOpt['oMbqDataPage'];
            $where = array( array( 'LOWER(core_members.name) LIKE ?', '%' . mb_strtolower( $keywords ) . '%' ) );
            $order = "name ASC";

            $select	= \IPS\Db::i()->select( 'core_members.*', 'core_members', $where, $order, array( ( $oMbqDataPage->curPage - 1 ) * $oMbqDataPage->numPerPage, $oMbqDataPage->numPerPage ), NULL, NULL, \IPS\Db::SELECT_SQL_CALC_FOUND_ROWS );

            $results	= new \IPS\Patterns\ActiveRecordIterator( $select, 'IPS\Member' );

            $members = array();
            $oMbqDataPage->totalNum = $results->count( TRUE );
            foreach($results as $member)
            {
                $members[] = $this->initOMbqEtUser($member, array('case'=>'user_row'));
            }
            $oMbqDataPage->datas = $members;
            return $oMbqDataPage;
        }
        elseif($mbqOpt['case'] == 'byLoginName')
        {
            $loginName = $var;
            $member = \IPS\Member::load($loginName,'name');
            return $this->initOMbqEtUser($member, array('case'=>'user_row'));
        }
        elseif($mbqOpt['case'] == 'byEmail')
        {
            $email = $var;
            $member = \IPS\Member::load($email,'email');
            return $this->initOMbqEtUser($member, array('case'=>'user_row'));
        }
        elseif($mbqOpt['case'] == 'ignored')
        {
            $oMbqDataPage = $var;
            $members = array();
            if(MbqMain::$oCurMbqEtUser != null && MbqMain::$oCurMbqEtUser->ignoredUids->oriValue != '')
            {
                $ignoredUids = explode(',',MbqMain::$oCurMbqEtUser->ignoredUids->oriValue);
                foreach($ignoredUids as $ignoredUserId)
                {
                    $members[] = $this->initOMbqEtUser($ignoredUserId, array('case'=>'byUserId'));
                }
            }
            $oMbqDataPage->totalNum = sizeof($members);
            $oMbqDataPage->datas = $members;
            return $oMbqDataPage;
        }
        MbqError::alert('', __METHOD__ . ',line:' . __LINE__ . '.' . MBQ_ERR_INFO_UNKNOWN_CASE);
    }

    public function initOMbqEtUser($var, $mbqOpt) {
        if($mbqOpt['case'] == 'user_row')
        {
            if($var == false)
            {
                return null;
            }
            $member = $var;
            $isCurrentLoggedUser = false;
            $memberId = $member->__get('member_id');
            if($memberId == null)
            {
                return null;
            }
            $loggedMember = \IPS\Member::loggedIn();
            $loggedMemberId = $loggedMember->member_id;

            if($memberId == $loggedMemberId || (isset($mbqOpt['loggedUser']) && $mbqOpt['loggedUser'] ))
            {
                $isCurrentLoggedUser = true;
            }
            $oMbqEtUser = MbqMain::$oClk->newObj('MbqEtUser');
            $oMbqEtUser->userId->setOriValue($memberId);
            $oMbqEtUser->loginName->setOriValue($member->get_name());
            $oMbqEtUser->userName->setOriValue($member->get_name());
            $oMbqEtUser->userGroupIds->setOriValue($member->get_groups());
            $oMbqEtUser->userEmail->setOriValue($member->__get('email'));
            if(method_exists($member,'get_pp_photo_type'))
            {
                $oMbqEtUser->iconUrl->setOriValue(get_user_avatar_url($member->get_photo(false),$member->get_pp_photo_type()));
            }
            else
            {
                $oMbqEtUser->iconUrl->setOriValue(get_user_avatar_url($member->get_photo(false)));
            }
            $oMbqEtUser->postCount->setOriValue($member->__get('member_posts'));
            $oMbqEtUser->userType->setOriValue(check_return_user_type($member));
            $oMbqEtUser->canBan->setOriValue($loggedMember->modPermission());
            $oMbqEtUser->isBan->setOriValue($member->isBanned());

            $isOnline = false;
            if(MbqMain::$Cache->Exists('membersOnline',$memberId))
            {
                $isOnline = MbqMain::$Cache->Get('membersOnline',$memberId);
            }
            else
            {
                $isOnline = $member->isOnline();
                MbqMain::$Cache->Set('membersOnline',$memberId,$isOnline);
            }
            $oMbqEtUser->isOnline->setOriValue($isOnline);
            if($isCurrentLoggedUser)
            {
                $oMbqEtUser->canPm->setOriValue($member->__get('members_disable_pm') == 0 && $member->canAccessModule( \IPS\Application\Module::get( 'core', 'messaging' ) ) );
                $oMbqEtUser->canSendPm->setOriValue($member->__get('members_disable_pm') == 0 && $member->canAccessModule( \IPS\Application\Module::get( 'core', 'messaging' ) ));
                $oMbqEtUser->acceptPm->setOriValue($member->__get('members_disable_pm') == 0 && $member->canAccessModule( \IPS\Application\Module::get( 'core', 'messaging' ) ));
                $oMbqEtUser->canModerate->setOriValue($member->modPermission() != null);
                $oMbqEtUser->canSearch->setOriValue(true);
                $oMbqEtUser->canWhosonline->setOriValue(true);
                $oMbqEtUser->canProfile->setOriValue(true);
                $photoVars = explode( ':', $member->group['g_photo_max_vars'] );
                if ( $photoVars[0] )
                {
                    $oMbqEtUser->canUploadAvatar->setOriValue(true);
                    //$tapatalkUploadClass = new \Tapatalk\IPS\Upload('member_photo_upload', NULL, FALSE, array( 'image' => array( 'maxWidth' => $photoVars[1], 'maxHeight' => $photoVars[2] ), 'storageExtension' => 'core_Profile', 'maxFileSize' => $photoVars[0] ? $photoVars[0] / 1024 : NULL ), NULL, NULL, NULL, 'member_photo_upload' );
                    $oMbqEtUser->maxAvatarSize->setOriValue($photoVars[0]*1024);
                    $oMbqEtUser->maxAvatarWidth->setOriValue($photoVars[1]);
                    $oMbqEtUser->maxAvatarHeight->setOriValue($photoVars[2]);
                }
                if($member->group['g_attach_max'] == -1)
                {
                    $oMbqEtUser->maxAttachment->setOriValue(100);
                }
                else
                {
                    $oMbqEtUser->maxAttachment->setOriValue($member->group->g_attach_max);
                }
                $attach_types = \IPS\Settings::i()->attach_allowed_types;
                if($attach_types == "all")
                {
                    $attach_extensions = \IPS\Settings::i()->attach_allowed_extensions;
                    if(!empty($attach_extensions))
                    {
                        $oMbqEtUser->allowedExtensions->setOriValue($attach_extensions);
                    }
                    else
                    {
                        $oMbqEtUser->allowedExtensions->setOriValue('jpg','jpeg','png','gif','pdf','doc','zip','txt','rar');
                    }
                }
                else if($attach_types == "images")
                {
                    $oMbqEtUser->allowedExtensions->setOriValue(array('jpg','jpeg','png','gif'));
                }
                else if($attach_types == "none")
                {
                    $oMbqEtUser->maxAttachment->setOriValue(0);
                }
                $oMbqEtUser->maxAttachmentSize->setOriValue(10485760);
                $oMbqEtUser->maxPngSize->setOriValue(10485760);
                $oMbqEtUser->maxJpgSize->setOriValue(10485760);

                if(isset($member->members_bitoptions['has_no_ignored_users']) && !$member->members_bitoptions['has_no_ignored_users'])
                {
                    $ignorePreferences = iterator_to_array( \IPS\Db::i()->select( '*', 'core_ignored_users', array( 'ignore_owner_id=?', $member->member_id ) )->setKeyField( 'ignore_ignore_id' ) );
                    if ( empty( $ignorePreferences ) )
                    {
                        $member->members_bitoptions['has_no_ignored_users'] = TRUE;
                        $member->save();
                    }
                    $oMbqEtUser->ignoredUids->setOriValue(implode(',', array_keys($ignorePreferences)));
                }
                $oMbqEtUser->isIgnored->setOriValue(false);
            }
            else
            {
                $oMbqEtUser->isIgnored->setOriValue(MbqCM::checkIfUserIsIgnored($memberId));
            }
            $oMbqEtUser->postCountdown->setOriValue(0);

            $oMbqEtUser->regTime->setOriValue($member->__get('joined'));
            $oMbqEtUser->lastActivityTime->setOriValue($member->__get('last_activity'));

            $oMbqEtUser->mbqBind = $var;
            return $oMbqEtUser;
        }
        else if($mbqOpt['case'] == 'byLoginName')
        {
            $username = $var;
            $member = \IPS\Member::load($username,'name');
            return $this->initOMbqEtUser($member, array('case'=>'user_row'));
        }
        else if($mbqOpt['case'] == 'byEmail')
        {
            $email = $var;
            $member = \IPS\Member::load($email,'email');
            return $this->initOMbqEtUser($member, array('case'=>'user_row'));
        }
        else if($mbqOpt['case'] == 'byUserId')
        {
            $userId = $var;
            if(MbqMain::$Cache->Exists('MbqEtUser',$userId))
            {
                return MbqMain::$Cache->Get('MbqEtUser',$userId);
            }
            $member = \IPS\Member::load($userId);
            $oMbqEtUser = $this->initOMbqEtUser($member, array('case'=>'user_row'));
            if(!isset($oMbqEtUser) && isset($mbqOpt['guest_if_null']) && $mbqOpt['guest_if_null'])
            {
                $oMbqEtUser = MbqMain::$oClk->newObj('MbqEtUser');
                $oMbqEtUser->userId->setOriValue(0);
                $oMbqEtUser->loginName->setOriValue("guest");
                $oMbqEtUser->userName->setOriValue("guest");
                $oMbqEtUser->iconUrl->setOriValue("");
            }
            MbqMain::$Cache->Set('MbqEtUser',$userId, $oMbqEtUser);
            return $oMbqEtUser;
        }
    }
    public function getCustomRegisterFields()
    {
        $required_custom_fields = array();
        foreach ( \IPS\core\ProfileFields\Field::fields( array(), \IPS\core\ProfileFields\REG ) as $group => $fields )
        {
            foreach ( $fields as $id => $field )
            {
                $name = $field->__get('name');
                $type = get_class($field);
                if($type == 'IPS\Helpers\Form\Address')
                {
                    continue;
                }

                if($field->required || $type == 'IPS\Helpers\Form\Radio' || $type == 'IPS\Helpers\Form\Checkbox' || $type == 'IPS\Helpers\Form\YesNo')
                {
                    $field_id =  $id;
                    $custom_field_data = array(
                        'name'          => \IPS\Member::loggedIn()->language()->get('core_pfield_' . $id),
                        'description'   => \IPS\Member::loggedIn()->language()->get('core_pfield_' . $id . '_desc' ),
                        'key'           => $name,
                        'default'       => $field->defaultValue,
                    );
                    switch($type)
                    {
                        case 'IPS\Helpers\Form\Address':
                            {
                                //$custom_field_data['type'] ='input';
                                //$custom_field_data['default'] = null;
                                break;
                            }
                        case 'IPS\Helpers\Form\Codemirror':
                        case 'IPS\Helpers\Form\Color':
                        case 'IPS\Helpers\Form\Date':
                        case 'IPS\Helpers\Form\Editor':
                        case 'IPS\Helpers\Form\Member':
                        case 'IPS\Helpers\Form\Poll':
                        case 'IPS\Helpers\Form\Rating':
                        case 'IPS\Helpers\Form\Tel':
                        case 'IPS\Helpers\Form\Url':
                        case 'IPS\Helpers\Form\Upload':
                            {
                                $custom_field_data['type'] ='input';
                                break;
                            }
                        case 'IPS\Helpers\Form\Checkbox':
                        case 'IPS\Helpers\Form\YesNo':
                            {
                                $custom_field_data['type'] ='cbox';
                                $custom_field_data['options'] = '1=yes|0=no';
                                break;
                            }
                        case 'IPS\Helpers\Form\Select':
                        case 'IPS\Helpers\Form\CheckboxSet':
                            {
                                $custom_field_data['type'] ='drop';
                                $option_str = '';
                                foreach ($field->options['options'] as $index=>$option)
                                {
                                    $option_str .= ($option_str == ''? '':'|') . $index."=".$option;
                                }
                                if(!empty($option_str)) $custom_field_data['options'] = $option_str;
                                break;
                            }
                        case 'IPS\Helpers\Form\Radio':
                            {
                                $custom_field_data['type'] ='radio';
                                $option_str = '';
                                foreach ($field->options['options'] as $index=>$option)
                                {
                                    $option_str .= ($option_str == ''? '':'|') . $index."=".$option;
                                }
                                if(!empty($option_str)) $custom_field_data['options'] = $option_str;
                                break;
                            }
                        case 'IPS\Helpers\Form\TextArea':
                            {
                                $custom_field_data['type'] ='textarea';
                                break;
                            }
                        default:
                            {
                                $custom_field_data['type'] ='input';
                                break;
                            }
                    }

                    $option_str = '';
                    if(isset($field->options['options']))
                    {
                        foreach ($field->options['options'] as $index=>$option)
                        {
                            $option_str .= ($option_str == ''? '':'|') . $index."=".$option;
                        }
                    }
                    if(!empty($option_str)) $custom_field_data['options'] = $option_str;

                    $required_custom_fields[] = $custom_field_data;

                }

            }
        }

        return $required_custom_fields;
    }
    /**
     * forget_password this function should send the email password change to this user
     *
     * @return Array
     */
    public function forgetPassword($oMbqEtUser) {

        /* Load the member */
        $member = \IPS\Member::load( $oMbqEtUser->userEmail->oriValue, 'email' );

        /* Make a validation key */
        $vid = md5( $member->members_pass_hash . uniqid( mt_rand(), TRUE ) );

        /* Get rid of old entries for this member */
        \IPS\DB::i()->delete( 'core_validating', array( 'member_id=? AND lost_pass=1', $member->member_id ) );

        /* Update the DB for this member. */
        $validating = array(
            'vid'         => $vid,
            'member_id'   => $member->member_id,
            'entry_date'  => time(),
            'lost_pass'   => 1,
            'ip_address'  => $member->ip_address,
        );

        \IPS\Db::i()->insert( 'core_validating', $validating );

        /* Send email */
        \IPS\Email::buildFromTemplate( 'core', 'lost_password_init', array( $member, $vid ) )->send( $member );

        return true;
    }
    public function logout()
    {
        \IPS\Request::i()->setCookie( 'member_id', NULL );
        \IPS\Request::i()->setCookie( 'pass_hash', NULL );
        \IPS\Request::i()->setCookie( 'anon_login', NULL );

        foreach( \IPS\Request::i()->cookie as $name => $value )
        {
            if( mb_strpos( $name, "ipbforumpass_" ) !== FALSE )
            {
                \IPS\Request::i()->setCookie( $name, NULL );
            }
        }

        $redirectUrl	= ( !empty( $_SERVER['HTTP_REFERER'] ) ) ? \IPS\Http\Url::external( $_SERVER['HTTP_REFERER'] ) : \IPS\Http\Url::internal( '' );
        $member			= \IPS\Member::loggedIn();

        /* Are we logging out back to an admin user? */
        if( isset( $_SESSION['logged_in_as_key'] ) )
        {
            $key = $_SESSION['logged_in_as_key'];
            unset( \IPS\Data\Store::i()->$key );
            unset( $_SESSION['logged_in_as_key'] );
            unset( $_SESSION['logged_in_from'] );

            \IPS\Output::i()->redirect( $redirectUrl );
        }

        session_destroy();

        /* Login handler callback */
        foreach ( \IPS\Login::handlers( TRUE ) as $k => $handler )
        {
            try
            {
                $handler->logoutAccount( $member, $redirectUrl );
            }
            catch( \BadMethodCallException $e ) {}
        }

        /* Member sync callback */
        //   $member->memberSync( 'onLogout', array( $redirectUrl ) );
    }


    public function getDisplayName($oMbqEtUser) {
        //return $oMbqEtUser->loginName->oriValue;
        return htmlspecialchars_decode($oMbqEtUser->loginName->oriValue);
    }


    /**
     * Check if an account is locked
     *
     * @param	\IPS\Member	$member	The account
     * @return	void
     * @throws	\Exception
     */
    protected function checkIfAccountIsLocked( $member )
    {
        if ( \IPS\Settings::i()->ipb_bruteforce_attempts and isset( $member->failed_logins[ \IPS\Request::i()->ipAddress() ] ) and count( $member->failed_logins[ \IPS\Request::i()->ipAddress() ] ) >= \IPS\Settings::i()->ipb_bruteforce_attempts )
        {
            if ( \IPS\Settings::i()->ipb_bruteforce_period and \IPS\Settings::i()->ipb_bruteforce_unlock )
			{
				$failedLogins = $member->failed_logins[ \IPS\Request::i()->ipAddress() ];
				sort( $failedLogins );

				while ( count( $failedLogins ) > \IPS\Settings::i()->ipb_bruteforce_attempts )
				{
					array_pop( $failedLogins );
				}
				$unlockTime = \IPS\DateTime::ts( array_pop( $failedLogins ) );
				$unlockTime->add( new \DateInterval( 'PT' . \IPS\Settings::i()->ipb_bruteforce_period . 'M' ) );
				$timeToUnlock = $unlockTime->diff( new DateTime() );

				/* If Unlock Time is in the past, return FALSE to avoid the exception and allow login */
				if ( $unlockTime->getTimestamp() < time() )
				{
					return false;
				}
			}

			/* Notify the member if they've been locked */
			if( count( $member->failed_logins[ \IPS\Request::i()->ipAddress() ] ) == \IPS\Settings::i()->ipb_bruteforce_attempts )
			{
				/* Can we get a physical location */
				try
				{
					$location = \IPS\GeoLocation::getByIp( \IPS\Request::i()->ipAddress() );
				}
				catch ( \Exception $e )
				{
					$location = \IPS\Request::i()->ipAddress();
				}
				\IPS\Email::buildFromTemplate( 'core', 'account_locked', array( $member, $location, isset( $unlockTime ) ? $unlockTime : NULL ), \IPS\Email::TYPE_TRANSACTIONAL )->send( $member );
			}
            if ( \IPS\Settings::i()->ipb_bruteforce_period and \IPS\Settings::i()->ipb_bruteforce_unlock )
			{
                $message = \IPS\Member::loggedIn()->language()->get( 'login_err_locked_unlock');
                return \IPS\Member::loggedIn()->language()->pluralize($message, array( 'pluralize' => array( $timeToUnlock->format('%i') ) ) ) ;
            }
            else
            {
                return \IPS\Member::loggedIn()->language()->get( 'login_err_locked_nounlock' );
            }
        }
        return false;
    }
    /**
     * the response should be bool to indicate if the username meet the forum requirement
     *
     * @param string $username
     */
    public function validateUsername($username){
        $member = \IPS\Member::load($username,'name');
        return $member->__get('member_id') == null;
    }

    /**
     * the response should be bool to indicate if the password meet the forum requirement
     *
     * @param string $password
     */
    public function validatePassword($password){
        if(trim($password) == '')
        {
            return false;
        }
        if(mb_strlen( $password ) < 3)
        {
            return false;
        }
        return true;
    }
}
