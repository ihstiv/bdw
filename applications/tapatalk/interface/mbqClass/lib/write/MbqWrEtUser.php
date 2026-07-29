<?php

defined('MBQ_IN_IT') or exit;

MbqMain::$oClk->includeClass('MbqBaseWrEtUser');

/**
 * user write class
 *
 * @since  2012-9-28
 * @author Wu ZeTao <578014287@qq.com>
 */
Class MbqWrEtUser extends MbqBaseWrEtUser {

    public function __construct() {
    }
    /**
     * register user
     */
	public function registerUser($username, $password, $email, $verified, $custom_register_fields, $profile, &$errors) {

        $values = array();
        $values['username'] = $username;
        $values['email_address'] = $email;
        $values['password'] = $password;
        $values['reg_admin_mails'] = true;

        /* Query spam service */
        if( \IPS\Settings::i()->spam_service_enabled )
        {
            $tt_member = new \IPS\Member;
            $tt_member->ip_address  = \IPS\Request::i()->ipAddress();
            $tt_member->email  = $email;
            if( $tt_member->spamService() == 4 )
            {
                MbqError::alert('', "Sorry, your email was detected as spammer!", '', MBQ_ERR_NOT_SUPPORT);
            }
        }

		/* Create Member */
        $member = \IPS\core\modules\front\system\register::_createMember( $values , array());
        if(!$member)
        {
            return false;
        }
        //try
        //{
        //    $ipAddress = \IPS\Request::i()->ipAddress();
        //    $response = \IPS\Http\Url::ips( 'spam/register' )->request()->login( \IPS\Settings::i()->ipb_reg_number, '' )->post( array(
        //        'email' => $email,
        //        'ip'    => $ipAddress,
        //    ) );

        //    if ( $response->httpResponseCode !== 200 )
        //    {
        //        $spamCode = intval( (string) $response );
        //    }
        //    else
        //    {
        //        $spamCode = 0;
        //    }

        //}
        //catch ( \IPS\Http\Request\Exception $e )
        //{
        //    $spamCode = 0;
        //}
        //$key = "spam_service_action_{$spamCode}";
        //$action = \IPS\Settings::i()->$key;
        //if($spamCode &&  $action == 4)
        //{
        //    \IPS\Db::i()->insert( 'core_spam_service_log', array(
        //                                                    'log_date'      => time(),
        //                                                    'log_code'      => $spamCode,
        //                                                    'log_msg'       => '',  // No value is returned unless it's a developer account making the call
        //                                                    'email_address' => $email,
        //                                                    'ip_address'    => $ipAddress
        //    ) );
        //    MbqError::alert('', 'spam_denied_account', '', MBQ_ERR_APP);
        //}
        //$member = \IPS\core\modules\front\system\register::_createMember( $values );

		/* Custom Fields */
		$profileFields = array();

		foreach ( \IPS\core\ProfileFields\Field::fields( array(), \IPS\core\ProfileFields\REG ) as $group => $fields )
		{
			foreach ( $fields as $id => $field )
			{
                if(isset($custom_register_fields[ $field->name ]))
                {
				    $profileFields[ "field_{$id}" ] = $field::stringValue( $custom_register_fields[ $field->name ] );

				    if ( $fields instanceof \IPS\Helpers\Form\Editor )
				    {
					    $field->claimAttachments( $this->id );
				    }
                }
			}
		}
		\IPS\Db::i()->replace( 'core_pfields_content', array_merge( array( 'member_id' => $member->member_id ), $profileFields ) );

        /* Email - We don't want to send if the new member is banned or we're not using email validation */
		if( \IPS\Settings::i()->reg_auth_type != 'none' AND \IPS\Settings::i()->reg_auth_type != 'admin' AND !$member->members_bitoptions['bw_is_spammer'] )
		{
			\IPS\Email::buildFromTemplate( 'core', 'registration_validate', array( $member, \IPS\Db::i()->select( 'vid', 'core_validating', array( 'member_id=?', $member->member_id ) )->first() ) )->send( $member );
		}

		/* Notify the incoming mail address except if they're a spammer */
		if( \IPS\Settings::i()->new_reg_notify && !$member->members_bitoptions['bw_is_spammer'] )
		{
			\IPS\Email::buildFromTemplate( 'core', 'registration_notify', array( $member, $profileFields ) )->send( \IPS\Settings::i()->email_in );
		}
        if(isset($profile['avatar']))
        {
            $this->tt_copy_avatar($member, $profile['avatar']);
        }
		if($verified && \IPS\Settings::i()->tapatalk_inappregapprove == 1)
        {
            if(method_exists($member, 'validationComplete'))
                $member->validationComplete();
            else
                $member->validate();

            $member = \IPS\Member::load($member->member_id);
        }
        $addToGroups = \IPS\Settings::i()->tapatalk_usergroup;

        if(isset($addToGroups))
        {
            $member->mgroup_others = $addToGroups;
            $member->save();
        }


		/* Log them in */
		\IPS\Session::i()->setMember( $member );

		$oMbqRdEtUser = MbqMain::$oClk->newObj('MbqRdEtUser');
		return $oMbqRdEtUser->initOMbqEtUser($member, array('case'=>'user_row'));

	}

    public function updatePasswordDirectly($oMbqEtUser, $newPassword)
    {
        $member = $oMbqEtUser->mbqBind;
        if(isIPB43())
        {
            $member->changePassword($newPassword);
        }
        else
        {

            foreach ( \IPS\Login::handlers( TRUE ) as $handler )
            {
                /* We cannot update our password in some login handlers, that's ok */
                try
                {
                    $handler->changePassword( $member, $newPassword );
                }
                catch( \BadMethodCallException $e ){}
            }
            $member->members_pass_salt = $member->generateSalt();
            $member->members_pass_hash = $member->encryptedPassword( $newPassword );
            $member->save();
        }


		return true;
    }
	/**
     * update password
     */
	public function updatePassword($oldPassword, $newPassword) {

        $validateOldPassword = new \IPS\Helpers\Form\Password( 'current_password', $oldPassword, TRUE, array( 'validateFor' => \IPS\Member::loggedIn() ));
        try
        {
            $validateOldPassword->validate();
        }
        catch(Exception $ex)
        {
            return \IPS\Member::loggedIn()->language()->get($ex->getMessage());
        }
        if(isIPB43())
        {
            \IPS\Member::loggedIn()->changePassword($newPassword);
        }
        else
        {
            foreach ( \IPS\Login::handlers() as $handler )
            {
                /* We cannot update our password in some login handlers, that's ok */
                try
                {
                    $handler->changePassword( \IPS\Member::loggedIn(), $newPassword );
                }
                catch( \BadMethodCallException $e ){}
            }
            \IPS\Member::loggedIn()->members_pass_salt = \IPS\Member::loggedIn()->generateSalt();
            \IPS\Member::loggedIn()->members_pass_hash = \IPS\Member::loggedIn()->encryptedPassword( $newPassword );
            \IPS\Member::loggedIn()->save();
        }


        return true;

	}

	/**
     * update email
     */
	public function updateEmail($password, $email, &$resultMessage) {
        $validateOldPassword = new \IPS\Helpers\Form\Password( 'current_password', $password, TRUE, array( 'validateFor' => \IPS\Member::loggedIn() ));
        try
        {
            $validateOldPassword->validate();
        }
        catch(Exception $ex)
        {
            return \IPS\Member::loggedIn()->language()->get($ex->getMessage());
        }
        if(isIPB43())
        {
            //FROM applications\core\modules\front\system\settings.php _email method
            /* Disable syncing */
            $profileSync = \IPS\Member::loggedIn()->profilesync;
            if ( isset( $profileSync['email'] ) )
            {
                unset( $profileSync['email'] );
                \IPS\Member::loggedIn()->profilesync = $profileSync;
                \IPS\Member::loggedIn()->save();
            }

            /* Change the email */
            $oldEmail = \IPS\Member::loggedIn()->email;
            \IPS\Member::loggedIn()->email = $email;
            \IPS\Member::loggedIn()->save();
            foreach ( \IPS\Login::methods() as $method )
            {
                try
                {
                    $method->changeEmail( \IPS\Member::loggedIn(), $oldEmail,$email );
                }
                catch( \BadMethodCallException $e ){}
            }
            \IPS\Member::loggedIn()->logHistory( 'core', 'email_change', array( 'old' => $oldEmail, 'new' => \IPS\Member::loggedIn()->email, 'by' => 'manual' ) );
            \IPS\Member::loggedIn()->memberSync( 'onEmailChange', array( $email, $oldEmail ) );
            unset( $email );

            /* Invalidate sessions except this one */
            \IPS\Member::loggedIn()->invalidateSessionsAndLogins( \IPS\Session::i()->id );
            if( isset( \IPS\Request::i()->cookie['login_key'] ) )
            {
                \IPS\Member\Device::loadOrCreate( \IPS\Member::loggedIn() )->updateAfterAuthentication( TRUE );
            }

            /* Delete any pending validation emails */
            \IPS\Db::i()->delete( 'core_validating', array( 'member_id=? AND email_chg=1', \IPS\Member::loggedIn()->member_id ) );

            /* Send a validation email if we need to */
            if ( \IPS\Settings::i()->reg_auth_type == 'user' or \IPS\Settings::i()->reg_auth_type == 'admin_user' )
            {
                $vid = \IPS\Login::generateRandomString();

                \IPS\Db::i()->insert( 'core_validating', array(
                    'vid'			=> $vid,
                    'member_id'		=> \IPS\Member::loggedIn()->member_id,
                    'entry_date'	=> time(),
                    'email_chg'		=> TRUE,
                    'ip_address'	=> \IPS\Request::i()->ipAddress(),
                    'prev_email'	=> $oldEmail,
                    'email_sent'	=> time(),
                ) );

                \IPS\Member::loggedIn()->members_bitoptions['validating'] = TRUE;
                \IPS\Member::loggedIn()->save();

                \IPS\Email::buildFromTemplate( 'core', 'email_change', array( \IPS\Member::loggedIn(), $vid ), \IPS\Email::TYPE_TRANSACTIONAL )->send( \IPS\Member::loggedIn() );

            }

            /* Or just redirect */
            else
            {
                /* Send a confirmation email */
                \IPS\Email::buildFromTemplate( 'core', 'email_address_changed', array( \IPS\Member::loggedIn(), $oldEmail ), \IPS\Email::TYPE_TRANSACTIONAL )->send( $oldEmail, array(), array(), NULL, NULL, array( 'Reply-To' => \IPS\Settings::i()->email_in ) );

    		}
        }
        else
        {
            $check		= \IPS\Member::load( $email, 'email' );
            if( $check->member_id )
            {
                return \IPS\Member::loggedIn()->language()->get("EMAIL_IN_USE");
            }

            $member = \IPS\Member::loggedIn();
            foreach ( \IPS\Login::handlers( TRUE ) as $handler )
            {
                try
                {
                    $handler->changeEmail( $member, $member->email, $email );
                }
                catch( \BadMethodCallException $e ) {}
            }
        }
        return true;
	}

	/**
     * upload avatar
     */
	public function uploadAvatar() {
        $uploadedFiles =  \IPS\File::createFromUploads('core_Profile');
        if(is_array($uploadedFiles) && sizeof($uploadedFiles) == 1)
        {
            $uploadedFile = $uploadedFiles[0];
            $member = \IPS\Member::loggedIn();
            $member->pp_photo_type  = 'custom';
            $member->pp_main_photo  = NULL;
            $member->pp_main_photo  = (string) $uploadedFile;
            $member->pp_thumb_photo = (string) $uploadedFile->thumbnail( 'core_Profile', \IPS\PHOTO_THUMBNAIL_SIZE, \IPS\PHOTO_THUMBNAIL_SIZE, TRUE );
            $member->photo_last_update = time();

            $member->save();
            return true;
        }
        return false;
	}

	function tt_copy_avatar($member,$avatar_url)
	{
		if(!empty($avatar_url))
		{
            $url = new \IPS\Helpers\Form\Url( 'member_photo_url', $avatar_url, FALSE, array( 'file' => 'core_Profile',  'file'=>'core_Profile'), NULL, NULL, NULL, 'member_photo_url' );
            $url->validate();
			$member->pp_photo_type = 'custom';
            $member->pp_main_photo = NULL;
            $member->pp_main_photo = (string) $url->value;
            $member->pp_thumb_photo = (string) $url->value->thumbnail( 'core_Profile', \IPS\PHOTO_THUMBNAIL_SIZE, \IPS\PHOTO_THUMBNAIL_SIZE, TRUE );
            $member->photo_last_update = time();
            $member->save();
		}
	}

    /**
     * m_mark_as_spam
     */
    public function mMarkAsSpam($oMbqEtUser) {
        $OriginalMember = $oMbqEtUser->mbqBind;
        $OriginalMember->flagAsSpammer();
        \IPS\Session::i()->modLog( 'modlog__spammer_flagged', array( $member->name => FALSE ) );

        return true;
    }

    /**
     * m_ban_user
     * here,this function is just the same to m_mark_as_spam,so params mode and reason willn't be used.
     */
    public function mBanUser($oMbqEtUser, $mode, $reason, $expires) {
        $OriginalMember = $oMbqEtUser->mbqBind;
        $OriginalMember->temp_ban = -1;
        $OriginalMember->save();
        return true;
    }

    /**
     * m_unban_user
     * here,this function just unflag as spammer.
     */
    public function mUnBanUser($oMbqEtUser) {
        $OriginalMember = $oMbqEtUser->mbqBind;
        $OriginalMember->unflagAsSpammer();
        $OriginalMember->temp_ban = 0;
        $OriginalMember->member_group_id = \IPS\Settings::i()->member_group;
        $OriginalMember->restrict_post = 0;
        $OriginalMember->members_disable_pm = 0;
        $OriginalMember->save();
        \IPS\Session::i()->modLog( 'modlog__spammer_unflagged', array( $OriginalMember->name => FALSE ) );

        return true;
    }

    /**
     * ignoreUser
     */
    public function ignoreUser($oMbqEtUser, $mode) {
        $member = $oMbqEtUser->mbqBind;
        if($mode == 0) //ignore user
        {
            try
            {
                $ignore = \IPS\core\Ignore::load( $member->member_id, 'ignore_ignore_id', array( 'ignore_owner_id=?', \IPS\Member::loggedIn()->member_id ) );
                $ignore->delete();
            }  catch( \OutOfRangeException $e )
            {}
        }
        else
        {
			if ( $member->member_id == \IPS\Member::loggedIn()->member_id )
			{
				throw new \InvalidArgumentException( 'cannot_ignore_self' );
			}

			if ( $member->group['gbw_cannot_be_ignored'] )
			{
				throw new \InvalidArgumentException( 'cannot_ignore_that_member' );
			}

			$ignore = NULL;
			try
            {
                $ignore = \IPS\core\Ignore::load( $member->member_id, 'ignore_ignore_id', array( 'ignore_owner_id=?', \IPS\Member::loggedIn()->member_id ) );
                foreach ( \IPS\core\Ignore::types() as $type )
                {
                        $ignore->$type = true;
                }
                $ignore->save();
            }
            catch( \OutOfRangeException $e )
            {
                $ignore = new \IPS\core\Ignore;
                foreach ( \IPS\core\Ignore::types() as $type )
                {
                        $ignore->$type = true;
                }
                $ignore->owner_id	= \IPS\Member::loggedIn()->member_id;
                $ignore->ignore_id	= $member->member_id;
                $ignore->save();
            }

            \IPS\Member::loggedIn()->members_bitoptions['has_no_ignored_users'] = FALSE;
            \IPS\Member::loggedIn()->save();

         }
        return true;
    }
}
