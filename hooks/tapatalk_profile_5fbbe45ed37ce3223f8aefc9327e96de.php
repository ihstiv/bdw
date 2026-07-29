<?php

class tapatalk_profile extends public_members_profile_view
{
    public function doExecute( ipsRegistry $registry )
    {
        if (defined('IN_MOBIQUO'))
        {
            global $profile, $required_custom_fields;
            
            // process prefetch_account
            if (isset($this->request['email']))
            {
                if (empty($this->request['email']))
                    $this->registry->output->showError("Invalid parameter");
                
                $profile = IPSMember::load($this->request['email'], 'all', 'email');
                
                //-----------------------------------------
                // Custom fields
                //-----------------------------------------
                
                $classToLoad        = IPSLib::loadLibrary( IPS_ROOT_PATH . 'sources/classes/customfields/profileFields.php', 'customProfileFields' );
                $custom_fields      = new $classToLoad();
                
                $custom_fields->member_data = $this->memberData;
                $custom_fields->initData( 'edit', 0, array( 'tabindex' => 6 ) );
                $custom_fields->parseToEdit( 'register' );
                
                if ( count( $custom_fields->out_fields ) )
                {
                    foreach( $custom_fields->out_fields as $id => $form_element )
                    {
                        if ( $custom_fields->cache_data[ $id ]['pf_not_null'] == 1 )
                        {
                            $custom_field_data = array(
                                'name'          => new xmlrpcval(subject_clean($custom_fields->field_names[ $id ]), 'base64'),
                                'description'   => new xmlrpcval(subject_clean($custom_fields->field_desc[ $id ]), 'base64'),
                                'key'           => new xmlrpcval('field_'.$id),
                                'real_key'      => new xmlrpcval($custom_fields->cache_data[ $id ]['pf_key']),
                                'type'          => new xmlrpcval($custom_fields->cache_data[ $id ]['pf_type']),
                            );
                            
                            if (in_array($custom_fields->cache_data[ $id ]['pf_type'], array('drop', 'cbox', 'radio')))
                            {
                                $custom_field_data['options'] = new xmlrpcval(subject_clean($custom_fields->cache_data[ $id ]['pf_content']), 'base64');
                            }
                            else if ($custom_fields->cache_data[ $id ]['pf_input_format'])
                            {
                                $custom_field_data['format'] = new xmlrpcval($custom_fields->cache_data[ $id ]['pf_input_format']);
                            }
                            
                            $required_custom_fields[] = new xmlrpcval($custom_field_data, 'struct');
                        }
                    }
                }
                
                return;
            }
            
            // fetch user id from displayname
            if (empty($this->request['id']) && isset($this->request['user_name']))
            {
                $displayname = to_local($this->request['user_name']);
                $member = IPSMember::load( $displayname, 'core', 'displayname' );
                $this->request['id'] = $member['member_id'];
            }
            
            $this->registry->class_localization->loadLanguageFile( array( 'public_profile' ), 'members' );
            $this->registry->class_localization->loadLanguageFile( array( 'public_online' ), 'members' );
            
            $this->_viewModern();
            
            // prepare user profile for tapatalk display
            $profile = ipsRegistry::instance()->output->getTemplate('profile')->functionData['profileModern'][0]['member'];
            
            $profile['custom_fields_list'] = array(
                array (
                    'name' => $this->lang->words['m_group'],
                    'value' => $profile['g_title'],
                ),
                array (
                    'name'  => $this->lang->words['m_profile_views'],
                    'value' =>  $profile['members_profile_views'],
                ),
                array (
                    'name'  => $this->lang->words['m_currently'],
                    'value' => subject_clean($profile['_online'] ? $profile['online_extra'] : $this->lang->words['online_offline']),
                ),
                array(
                    'name'  => $this->lang->words['m_member_title'],
                    'value' => $profile['title'],
                ),
                array(
                    'name'  => $this->lang->words['m_age_prefix'],
                    'value' => $profile['_age'] > 0 ? $profile['_age'].' '.$this->lang->words['m_years_old'] : $this->lang->words['m_age_unknown'],
                ),
                array(
                    'name'  => $this->lang->words['m_birthday_prefix'],
                    'value' => $profile['bday_day'] ? $profile['_bday_month'].' '.$profile['bday_day'].($profile['bday_year'] ? ', '.$profile['bday_year'] : '') : $this->lang->words['m_bday_unknown'],
                ),
            );
            
            if (isset($profile['custom_fields']['profile_info']) && count($profile['custom_fields']['profile_info']))
            {
                foreach($profile['custom_fields']['profile_info'] as $profile_info)
                {
                    if (preg_match("/<span class='row_title'>(.*?)<\/span>/si", $profile_info, $match))
                    {
                        $profile['custom_fields_list'][] = array(
                            'name'  => $match[1],
                            'value' => str_replace($match[0], '', $profile_info),
                        );
                    }
                }
            }
            
            if (isset($profile['custom_fields']['contact']) && count($profile['custom_fields']['contact']))
            {
                foreach($profile['custom_fields']['contact'] as $contact)
                {
                    if (preg_match("/<span class='row_title'>(.*?)<\/span>/si", $contact, $match))
                    {
                        $profile['custom_fields_list'][] = array(
                            'name'  => $match[1],
                            'value' => str_replace($match[0], '', $contact),
                        );
                    }
                }
            }
        }
        else
            parent::doExecute($registry);
    }
}
