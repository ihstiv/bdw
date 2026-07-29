<?php
        
//-----------------------------------------------
// (DP34) Referrals System
//-----------------------------------------------
//-----------------------------------------------
// Class Overload
//-----------------------------------------------
// Author: DawPi
// Site: http://www.ipslink.pl
// Written on: 16 / 08 / 2010
// Updated on: 16 / 03 / 2013
//-----------------------------------------------
// Copyright (C) 2010-2013 DawPi
// All Rights Reserved
//-----------------------------------------------  

class dp3rs_CheckRegister extends public_core_global_register
{
	/**
	 * Class entry point
	 *
	 * @access	public
	 * @param	object		Registry reference
	 * @return	void		[Outputs to screen/redirects]
	 */
	public function doExecute( ipsRegistry $registry )
	{
		/* System is enabled */
		
		if( $this->settings['dp3_rs_enable'] )
		{		
			/* Load library */
					
			$classToLoad = IPSLib::loadLibrary( IPSLib::getAppDir( 'referrals' ) . '/sources/classes/library.php', 'referralsSystemLibrary', 'referrals' );
			$this->referralsSystemLibrary = new $classToLoad( $this->registry );	
		
			/* Invite only? */
			
			if( ($this->settings['dp3_rs_type'] == 'invite' ) && ( in_array( $this->request['do'], array( 'form', 'process_form' ) ) || ! $this->request['do'] ) )
			{
				/* Load lang */
				
				$this->registry->getClass('class_localization')->loadLanguageFile( array( 'public_referrals' ), 'referrals' );
				
				/* Get cookie */
						
				$reff_cookie = IPSCookie::get( $this->referralsSystemLibrary->invite_reff_hash );
				
				/* Do we have refferal invite key? */
				
				if( ( $reff_cookie == '-' ) || ! $reff_cookie )	
				{
					#Remove all cookies
					$this->referralsSystemLibrary->delCookies( 'debug_dp3rsCheckRegister_1' );

					$this->registry->output->showError( $this->lang->words['error_no_invite_ref_hash'], 'RS_P021' );	
				}
				
				/* Get invite info from SQL */
				
				$data	= $this->referralsSystemLibrary->getTransactionBasedOnHash( $reff_cookie );
				
				/* No invite? */
				
				if( ! $data['i_id'] )
				{
					#Remove all cookies
					$this->referralsSystemLibrary->delCookies( 'debug_dp3rsCheckRegister_2' );
									
					$this->registry->output->showError( $this->lang->words['error_invite_no_such_key'], 'RS_P022' );				
				}
				
				/* Invite was expired? */
				
				if( $this->settings['dp3_rs_invite_time_act'] )
				{
					if( ( $data['i_time'] + ( $this->settings['dp3_rs_invite_time_act'] * $this->referralsSystemLibrary->day ) ) < time() )
					{
						#Remove all cookies
						$this->referralsSystemLibrary->delCookies( 'debug_dp3rsCheckRegister_3' );	
										
						$this->registry->output->showError( $this->lang->words['error_invite_expired'], 'RS_P023' );				
					}
				}
				
				/* Used */
				
				if( $data['i_status'] != 'sent' )
				{
					#Remove all cookies
					$this->referralsSystemLibrary->delCookies( 'debug_dp3rsCheckRegister_4' );	
									
					$this->registry->output->showError( $this->lang->words['error_invite_used_already'], 'RS_P024' );				
				}
				
				/* Check key if it's correct */
				
				if( $reff_cookie != $this->referralsSystemLibrary->generateKey( $data['i_friend_mail'] ) )
				{
					#Remove all cookies
					$this->referralsSystemLibrary->delCookies( 'debug_dp3rsCheckRegister_5' );	
									
					$this->registry->output->showError( $this->lang->words['error_invite_wrong_key'], 'RS_P025' );				
				}									
			}		
		}	 	
			 	
		/* Run parent */

	 	parent::doExecute( $registry );
	}
	
	
	public function registerProcessForm()
 	{
		$this->_resetMember();
			
		$form_errors	= array();
		$coppa			= ( $this->request['coppa_user'] == 1 ) ? 1 : 0;
		$in_password	= trim( $this->request['PassWord'] );
		$in_email		= strtolower( trim( $this->request['EmailAddress'] ) );
		
		/* Did we agree to the t&c? */
		if( ! $this->request['agree_tos'] )
		{
			$form_errors['tos']	= array( $this->lang->words['must_agree_to_terms'] );
		}
		    	
		/* Custom profile field stuff */
		$classToLoad = IPSLib::loadLibrary( IPS_ROOT_PATH . 'sources/classes/customfields/profileFields.php', 'customProfileFields' );
		$custom_fields = new $classToLoad();
		
		$custom_fields->initData( 'edit' );
		$custom_fields->parseToSave( $_POST, 'register' );		

		/* Check */
		if( $custom_fields->error_messages )
		{
			$form_errors['general']	= $custom_fields->error_messages;
		}
		
		/* Check the email address */		
		if ( ! $in_email OR strlen( $in_email ) < 6 OR !IPSText::checkEmailAddress( $in_email ) )
		{
			$form_errors['email'][$this->lang->words['err_invalid_email']] = $this->lang->words['err_invalid_email'];
		}
		
		if( trim($this->request['PassWord_Check']) != $in_password OR !$in_password )
		{
			$form_errors['password'][$this->lang->words['passwords_not_match']] = $this->lang->words['passwords_not_match'];
		}
        
		/*
		There's no reason for this - http://community.invisionpower.com/resources/bugs.html/_/ip-board/registrations-limit-passwords-to-32-characters-for-no-apparent-reason-r37770
		elseif ( strlen( $in_password ) < 3 )
		{
			$form_errors['password'][$this->lang->words['pass_too_short']] = $this->lang->words['pass_too_short'];
		}
		elseif ( strlen( $in_password ) > 32 )
		{
			$form_errors['password'][$this->lang->words['pass_too_long']] = $this->lang->words['pass_too_long'];
		}
		*/

		/* Check the username */
		$user_check = IPSMember::getFunction()->cleanAndCheckName( $this->request['members_display_name'], array(), 'name' );
		$disp_check = IPSMember::getFunction()->cleanAndCheckName( $this->request['members_display_name'], array(), 'members_display_name' );

		if( is_array( $user_check['errors'] ) && count( $user_check['errors'] ) )
		{
			foreach( $user_check['errors'] as $key => $error )
			{
				$form_errors['dname'][ $error ]	= isset($this->lang->words[ $error ]) ? $this->lang->words[ $error ] : $error;
			}
		}

		/* this duplicates username error above */
		/*if( is_array( $disp_check['errors'] ) && count( $disp_check['errors'] ) )
		{
			foreach( $disp_check['errors'] as $key => $error )
			{
				$form_errors['dname'][ $error ]	= isset($this->lang->words[ $error ]) ? $this->lang->words[ $error ] : $error;
			}
		}*/
		
		/*** (DP34) Referrals System ***/
		
		/* System is enabled? */
		
		if( $this->settings['dp3_rs_enable'] && $this->referralsSystemLibrary->checkActIp() )
		{			        
			/* Load lang */	
				
			$this->registry->getClass('class_localization')->loadLanguageFile( array( 'public_referrals' ), 'referrals' );
			
			/* Do we have cookie with the hash? */
			
			$reffKey = IPSCookie::get( $this->referralsSystemLibrary->invite_reff_hash );
			
			if( $reffKey && ( $reffKey != '-' ) )
			{
				$_data = $this->referralsSystemLibrary->getTransactionBasedOnHash( $reffKey );
				
				if( $_data['i_inviter_id'] )
				{
					$inviter = IPSmember::load( $_data['i_inviter_id'], 'core', 'id' );
					
					$_referralName = $inviter['members_display_name'];					
				}	
			}
			else
			{
				$_referralName = $this->request['referral_name'];	
			}
			
			/* Check referral name */
			
			$referralName = $this->referralsSystemLibrary->cleanEnteredName( $_referralName );
				
			/* Check entered name */
			
			$checkKey = $this->referralsSystemLibrary->checkEnteredName( $referralName );
			
			/* Force? */
			
			if( $this->settings['dp3_rs_type'] == 'force' )
			{
				if( ! IPSText::mbstrlen( $referralName ) )
				{
					$form_errors['general'][ $this->lang->words['err_dp3_rs_regis_error'] ] = $this->lang->words['err_dp3_rs_regis_error'];	
				}
			}
			
			/* Do we have error? */
				
			if( ! is_numeric( $checkKey ) )
			{
				$form_errors['general'][ $checkKey ] = $this->lang->words[ $checkKey ];					
			}
			
			/* Get key ID */
			
			$referredBy = $checkKey;
		}
		
		/*** (DP34) Referrals System ***/

		/* CHECK 1: Any errors (missing fields, etc)? */
		if( count( $form_errors ) )
		{
			$this->registerForm( $form_errors );
			return;
		}
		
		/* Is this email addy taken? */
		if( IPSMember::checkByEmail( $in_email ) == TRUE )
		{
			$form_errors['email'][$this->lang->words['reg_error_email_taken']] = $this->lang->words['reg_error_email_taken'];
		}
		
		/* Load handler... */
    	$classToLoad = IPSLib::loadLibrary( IPS_ROOT_PATH . 'sources/handlers/han_login.php', 'han_login' );
    	$this->han_login =  new $classToLoad( $this->registry );
    	$this->han_login->init();
		$this->han_login->emailExistsCheck( $in_email );

		if( $this->han_login->return_code AND $this->han_login->return_code != 'METHOD_NOT_DEFINED' AND $this->han_login->return_code != 'EMAIL_NOT_IN_USE' )
		{
			$form_errors['email'][$this->lang->words['reg_error_email_taken']] = $this->lang->words['reg_error_email_taken'];
		}
		
		/* Are they banned [EMAIL]? */
		if ( IPSMember::isBanned( 'email', $in_email ) === TRUE )
		{
			$form_errors['email'][$this->lang->words['reg_error_email_ban']] = $this->lang->words['reg_error_email_ban'];
		}
		
		/* Check the CAPTCHA */
		if ( $this->settings['bot_antispam_type'] != 'none' )
		{
			if ( $this->registry->getClass('class_captcha')->validate() !== TRUE )
			{
				$form_errors['general'][$this->lang->words['err_reg_code']] = $this->lang->words['err_reg_code'];
			}
		}
		
		/* Check the Q and A */
		$qanda	= intval($this->request['qanda_id']);
		$pass	= true;
		
		if( $qanda )
		{
			$pass	= false;
			$data	= $this->DB->buildAndFetch( array( 'select' => '*', 'from' => 'question_and_answer', 'where' => 'qa_id=' . $qanda ) );
			
			if( $data['qa_id'] )
			{
				$answers	 = explode( "\n", str_replace( "\r", "", $data['qa_answers'] ) );
				
				if( count($answers) )
				{
					foreach( $answers as $answer )
					{
						$answer	= trim($answer);

						if( strlen($answer) AND strtolower($answer) == strtolower($this->request['qa_answer']) )
						{
							$pass	= true;
							break;
						}
					}
				}
			}
		}
		else
		{
			//-----------------------------------------
			// Do we have any questions?
			//-----------------------------------------
			
			$data	= $this->DB->buildAndFetch( array( 'select' => 'COUNT(*) as questions', 'from' => 'question_and_answer' ) );
			
			if( $data['questions'] )
			{
				$pass	= false;
			}
		}
		
		if( !$pass )
		{
			$form_errors['general'][$this->lang->words['err_q_and_a']] = $this->lang->words['err_q_and_a'];
		}

		/* CHECK 2: Any errors ? */		
		if ( count( $form_errors ) )
		{
			$this->registerForm( $form_errors );
			return;
		}
		
		/* Build up the hashes */
		$mem_group = $this->settings['member_group'];
		
		/* Are we asking the member or admin to preview? */
		if( $this->settings['reg_auth_type'] )
		{
			$mem_group = $this->settings['auth_group'];
		}
		else if ($coppa == 1)
		{
			$mem_group = $this->settings['auth_group'];
		}
				
		/* Create member */
		$member = array(
						 'name'						=> $this->request['members_display_name'],
						 'password'					=> $in_password,
						 'members_display_name'		=> $this->request['members_display_name'],
						 'email'					=> $in_email,
						 'member_group_id'			=> $mem_group,
						 'joined'					=> time(),
						 'ip_address'				=> $this->member->ip_address,
						 'time_offset'				=> $this->request['time_offset'],
						 'coppa_user'				=> $coppa,
						 'members_auto_dst'			=> intval($this->settings['time_dst_auto_correction']),
						 'allow_admin_mails'		=> intval( $this->request['allow_admin_mail'] ),
						 'language'					=> $this->member->language_id,						 
						 'dp3_rs_referred_by'		=> is_numeric( $referredBy ) ? $referredBy : 0,
						 'dp3_rs_padded'			=> $this->settings['dp3_rs_post_ref_required'] ? 0 : 1,
					   );
	
		/* Spam Service */
		$spamCode 	= 0;
		$_spamFlag	= 0;
		
		if( $this->settings['spam_service_enabled'] )
		{
			/* Query the service */
			$spamCode = IPSMember::querySpamService( $in_email );
        
			/* Action to perform */
			$action = $this->settings[ 'spam_service_action_' . $spamCode ];
        
			/* Perform Action */
			switch( $action )
			{
				/* Proceed with registration */
				case 1:
				break;
        
				/* Flag for admin approval */
				case 2:
        			$member['member_group_id'] = $this->settings['auth_group'];
					$this->settings['reg_auth_type'] = 'admin';
					$_spamFlag	= 1;
				break;
        
				/* Approve the account, but ban it */
				case 3:
        			$member['member_banned']			= 1;
					$member['bw_is_spammer']			= 1;
					$this->settings['reg_auth_type']	= '';
				break;
                
				/* Deny registration */
				case 4:
					$this->registry->output->showError( 'spam_denied_account', '100x001', FALSE, '', 200 );
				break;
			}
		}
				
		//-----------------------------------------
		// Create the account
		//-----------------------------------------

		$member	= IPSMember::create( array( 'members' => $member, 'pfields_content' => $custom_fields->out_fields ), FALSE, FALSE, FALSE );
				
		//-----------------------------------------
		// Login handler create account callback
		//-----------------------------------------
		
   		$this->han_login->createAccount( array(	'member_id'				=> $member['member_id'],
   												'email'					=> $member['email'],
												'joined'				=> $member['joined'],
												'password'				=> $in_password,
												'ip_address'			=> $this->member->ip_address,
												'username'				=> $member['members_display_name'],
												'name'					=> $member['name'],
												'members_display_name'	=> $member['members_display_name'],
   										)		);

		/* Add referer points if enabled and check promotion system */
		
		if( $this->settings['dp3_rs_enable'] )
		{
			##$this->referralsSystemLibrary->handlePointsSystem( $referredBy );
		}
		
		/* Add referred by log */
		
		if( $referredBy )
		{
		    /* Check the key first */
		    
		    $key = IPSCookie::get( $this->referralsSystemLibrary->invite_reff_hash );
		    
		    if( ( ( $key == '-' ) || ! $key ) && $this->referralsSystemLibrary->checkActIp() )	
		    {
				$newKey = md5( my_getenv( 'REMOTE_ADDR' ) . $this->referralsSystemLibrary->hash . uniqid( microtime(), true ) );
				
				#if( $this->settings['dp3_rs_type'] != 'force' )
				#{					
					IPSCookie::set( $this->referralsSystemLibrary->invite_reff_hash, $newKey, 1 );
				#}  
								
				$this->DB->insert( 'dp3_rs_referrals', array( 'i_time' => time(), 'i_inviter_id' => $referredBy, 'i_friend_mail' => $in_email, 'i_invited_ip' => $this->member->ip_address, 'i_user_pending' => $member['member_id'], 'i_secure_key' => $newKey, 'i_status' => 'sent' ) );				          
			}
			else
			{
				$this->DB->update( 'dp3_rs_referrals', array( 'i_user_pending' => $member['member_id'] ), 'i_secure_key = "' . $key . '"' );
			}
		}
		
		//-----------------------------------------
		// We'll just ignore if this fails - it shouldn't hold up IPB anyways
		//-----------------------------------------
		
		/*if ( $han_login->return_code AND ( $han_login->return_code != 'METHOD_NOT_DEFINED' AND $han_login->return_code != 'SUCCESS' ) )
		{
			$this->registry->output->showError( 'han_login_create_failed', 2017, true );
		}*/
   		
		//-----------------------------------------
		// Validation
		//-----------------------------------------
		
		$validate_key = md5( IPSMember::makePassword() . time() );
		$time         = time();
		
		if( $coppa != 1 )
		{
			if( ( $this->settings['reg_auth_type'] == 'user' ) or ( $this->settings['reg_auth_type'] == 'admin' ) or ( $this->settings['reg_auth_type'] == 'admin_user' ) )
			{
				//-----------------------------------------
				// We want to validate all reg's via email,
				// after email verificiation has taken place,
				// we restore their previous group and remove the validate_key
				//-----------------------------------------
				
				$this->DB->insert( 'validating', array(
													  'vid'         => $validate_key,
													  'member_id'   => $member['member_id'],
													  'real_group'  => $this->settings['member_group'],
													  'temp_group'  => $this->settings['auth_group'],
													  'entry_date'  => $time,
													  'coppa_user'  => $coppa,
													  'new_reg'     => 1,
													  'ip_address'  => $member['ip_address'],
													  'spam_flag'	=> $_spamFlag,
											)       );
				
				if ( $this->settings['reg_auth_type'] == 'user' OR $this->settings['reg_auth_type'] == 'admin_user' )
				{
					/* Send out the email. */
					$message = array(   'THE_LINK'     => $this->settings['base_url'] . "app=core&module=global&section=register&do=auto_validate&uid=" . urlencode( $member['member_id'] ) . "&aid=" . urlencode( $validate_key ),
										'NAME'         => $member['members_display_name'],
										'MAN_LINK'     => $this->settings['base_url'] . "app=core&module=global&section=register&do=05",
										'EMAIL'        => $member['email'],
										'ID'           => $member['member_id'],
										'CODE'         => $validate_key );
				
					IPSText::getTextClass('email')->setPlainTextTemplate( IPSText::getTextClass('email')->getTemplate( "reg_validate", $this->member->language_id ) );
					IPSText::getTextClass('email')->buildPlainTextContent( $message );											
					IPSText::getTextClass('email')->buildHtmlContent( $message );
			
					IPSText::getTextClass('email')->subject = sprintf( $this->lang->words['new_registration_email'], $this->settings['board_name'] );
					IPSText::getTextClass('email')->to      = $member['email'];
					
					IPSText::getTextClass('email')->sendMail();
					
					$this->output     = $this->registry->output->getTemplate('register')->showAuthorize( $member );
					
				}
				else if( $this->settings['reg_auth_type'] == 'admin' )
				{
					$this->output     = $this->registry->output->getTemplate('register')->showPreview( $member );
				}
				
				/* Only send new registration email if the member wasn't banned */
				if( $this->settings['new_reg_notify'] AND ! $member['member_banned'] )
				{
					$date = $this->registry->class_localization->getDate( time(), 'LONG', 1 );
					
					IPSText::getTextClass('email')->getTemplate( 'admin_newuser' );
					
					IPSText::getTextClass('email')->buildMessage( array( 'DATE'			=> $date,
																		 'LOG_IN_NAME'  => $member['name'],
																		 'EMAIL'		=> $member['email'],
																		 'IP'			=> $member['ip_address'],
																		 'DISPLAY_NAME'	=> $member['members_display_name'] ) );
																 
					IPSText::getTextClass('email')->subject = sprintf( $this->lang->words['new_registration_email1'], $this->settings['board_name'] );
					IPSText::getTextClass('email')->to      = $this->settings['email_in'];
					IPSText::getTextClass('email')->sendMail();
				}
				
				$this->registry->output->setTitle( $this->lang->words['reg_success'] . ' - ' . ipsRegistry::$settings['board_name'] );
				$this->registry->output->addNavigation( $this->lang->words['nav_reg'], '' );
			}
			else
			{
				/* We don't want to preview, or get them to validate via email. */
				$stat_cache = $this->cache->getCache('stats');
				
				if( $member['members_display_name'] AND $member['member_id'] AND !$this->caches['group_cache'][ $member['member_group_id'] ]['g_hide_online_list'] )
				{
					$stat_cache['last_mem_name']		= $member['members_display_name'];
					$stat_cache['last_mem_name_seo']	= IPSText::makeSeoTitle( $member['members_display_name'] );
					$stat_cache['last_mem_id']			= $member['member_id'];
				}

				$stat_cache['mem_count']		+= 1;
				
				$this->cache->setCache( 'stats', $stat_cache, array( 'array' => 1 ) );
				
				/* Only send new registration email if the member wasn't banned */
				if( $this->settings['new_reg_notify'] AND ! $member['member_banned'] )
				{
					$date = $this->registry->class_localization->getDate( time(), 'LONG', 1 );
					
					IPSText::getTextClass('email')->getTemplate( 'admin_newuser' );
					
					IPSText::getTextClass('email')->buildMessage( array( 'DATE'			=> $date,
																		 'LOG_IN_NAME'  => $member['name'],
																		 'EMAIL'		=> $member['email'],
																		 'IP'			=> $member['ip_address'],
																		 'DISPLAY_NAME'	=> $member['members_display_name'] ) );
												
					IPSText::getTextClass('email')->subject = sprintf( $this->lang->words['new_registration_email1'], $this->settings['board_name'] );
					IPSText::getTextClass('email')->to      = $this->settings['email_in'];
					IPSText::getTextClass('email')->sendMail();
				}

				IPSCookie::set( 'pass_hash'   , $member['member_login_key'], 1);
				IPSCookie::set( 'member_id'   , $member['member_id']       , 1);
				
				//-----------------------------------------
				// Fix up session
				//-----------------------------------------

				$privacy = ( $member['g_hide_online_list'] || ( empty($this->settings['disable_anonymous']) && ! empty($this->request['Privacy']) ) ) ? 1 : 0;
				
				# Update value for onCompleteAccount call
				$member['login_anonymous'] = $privacy . '&1';
		
				$this->member->sessionClass()->convertGuestToMember( array( 'member_name'	  => $member['members_display_name'],
																  			'member_id'	  	  => $member['member_id'],
																			'member_group'  => $member['member_group_id'],
																			'login_type'	  => $privacy ) );
				
				IPSLib::runMemberSync( 'onCompleteAccount', $member );

				$this->registry->output->silentRedirect( $this->settings['base_url'] . '&app=core&module=global&section=login&do=autologin&fromreg=1');
			}
		}
		else
		{
			/* This is a COPPA user, so lets tell them they registered OK and redirect to the form. */
			$this->DB->insert( 'validating', array (
												  'vid'         => $validate_key,
												  'member_id'   => $member['member_id'],
												  'real_group'  => $this->settings['member_group'],
												  'temp_group'  => $this->settings['auth_group'],
												  'entry_date'  => $time,
												  'coppa_user'  => $coppa,
												  'new_reg'     => 1,
												  'ip_address'  => $member['ip_address']
										)       );
			
			$this->registry->output->redirectScreen( $this->lang->words['cp_success'], $this->settings['base_url'] . 'app=core&amp;module=global&amp;section=register&amp;do=12' );
		}
	}	
} // End of class