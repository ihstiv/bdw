<?php

defined('MBQ_IN_IT') or exit;

MbqMain::$oClk->includeClass('MbqBaseAclEtUser');

/**
 * user acl class
 */
Class MbqAclEtUser extends MbqBaseAclEtUser {

    public function __construct() {
    }

    /**
     * judge can get online users
     *
     * @return  Boolean
     */
    public function canAclGetOnlineUsers() {
        return true;
    }

    /**
     * judge can m_ban_user
     * here,this function is just the same to m_mark_as_spam
     * @param  Object  $oMbqEtUser
     * @param  Integer  $mode
     * @return  Boolean
     */
    public function canAclMBanUser($oMbqEtUser, $mode) {
        $OriginalMember = $oMbqEtUser->mbqBind;
        return $OriginalMember->member_id != \IPS\Member::loggedIn()->member_id and \IPS\Member::loggedIn()->modPermission('can_flag_as_spammer') and !$OriginalMember->modPermission() and !$OriginalMember->isAdmin();

    }

    /**
     * judge can m_mark_as_spam
     *
     * @return  Boolean
     */
    public function canAclMMarkAsSpam($oMbqEtUser) {
        $OriginalMember = $oMbqEtUser->mbqBind;
        return $OriginalMember->member_id != \IPS\Member::loggedIn()->member_id and \IPS\Member::loggedIn()->modPermission('member_ban');

    }

    /**
     * judge can m_ban_user
     *
     * @return  Boolean
     */
    public function canAclMUnbanUser($oMbqEtUser) {
        $OriginalMember = $oMbqEtUser->mbqBind;
        return $OriginalMember->member_id != \IPS\Member::loggedIn()->member_id and \IPS\Member::loggedIn()->modPermission('member_ban');

    }

    /**
     * judge can update_password
     *
     * @return Boolean
     */
    public function canAclUpdatePassword() {
        $canChangeEmail = FALSE;
		$canChangePassword = FALSE;
		$canChangeUsername = FALSE;
        if(isIPB43())
        {
            foreach ( \IPS\Login::methods() as $method )
            {
                if ( $method->canChangePassword(\IPS\Member::loggedIn() ) )
                {
                    $canChangePassword = TRUE;
                }
            }
        }
        else
        {
           foreach ( \IPS\Login::handlers( TRUE ) as $k => $handler )
            {
                if ( $handler->canChange( 'password', \IPS\Member::loggedIn() ) )
                {
                    $canChangePassword = TRUE;
                }
            }

        }
        return $canChangePassword;
    }

    /**
     * judge can update_email
     *
     * @return Boolean
     */
    public function canAclUpdateEmail() {
        $canChangeEmail = FALSE;
        if(isIPB43())
        {
            if ( \IPS\Settings::i()->allow_email_changes == 'redirect' )
            {
                return false;
            }

            if( \IPS\Member::loggedIn()->isAdmin() )
            {
                return false;
            }

            $mfaOutput = \IPS\MFA\MFAHandler::accessToArea( 'core', 'EmailChange', \IPS\Http\Url::internal( 'app=core&module=system&controller=settings&area=email', 'front', 'settings_email' ) );
            if ( $mfaOutput )
            {
                return false;
            }

            return true;
        }
        else
        {
            foreach ( \IPS\Login::handlers( TRUE ) as $k => $handler )
            {
                if ( $handler->canChange( 'email', \IPS\Member::loggedIn() ) )
                {
                    $canChangeEmail = TRUE;
                }
            }
        }
        return $canChangeEmail;
    }

    /**
     * judge can upload avatar
     *
     * @return Boolean
     */
    public function canAclUploadAvatar() {
        return MbqMain::hasLogin();
    }

    /**
     * judge can searc_user
     *
     * @return Boolean
     */
    public function canAclSearchUser() {
        return true;
    }

    /**
     * judge can get_recommended_user
     *
     * @return Boolean
     */
    public function canAclGetRecommendedUser() {
        return MbqMain::hasLogin();
    }

    /**
     * judge can ignore_user
     *
     * @return Boolean
     */
    public function canAclIgnoreUser($oMbqEtUser, $mode) {
        return MbqMain::hasLogin();
    }

        /**
     * judge can ignore_user
     *
     * @return Boolean
     */
    public function canAclGetIgnoredUsers() {
        return MbqMain::hasLogin();
    }

    /**
     * judge can view porfile
     *
     * @return Boolean
     */
    public function canAclGetUserInfo() {
        return \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( 'core', 'members' ));
    }
}
