<?php

class tapatalk_report extends public_core_reports_reports
{
    public function doExecute( ipsRegistry $registry )
    {
        if (defined('IN_MOBIQUO'))
        {
            $this->registry->class_localization->loadLanguageFile( array( 'public_reports' ) );
            $this->DB->loadCacheFile( IPSLib::getAppDir('core') . '/sql/' . ips_DBRegistry::getDriverType() . '_report_queries.php', 'report_sql_queries' );
            $classToLoad = IPSLib::loadLibrary( IPSLib::getAppDir('core') .'/sources/classes/reportLibrary.php', 'reportLibrary' );
            $this->registry->setClass( 'reportLibrary', new $classToLoad( $this->registry ) );
    
            // Check permissions...
            if( $this->request['do'] AND $this->request['do'] != 'report' AND !IPSMember::isInGroup( $this->memberData, explode( ',', IPSText::cleanPermString( $this->settings['report_mod_group_access'] ) ) ) )
            {
                $this->registry->output->showError( 'no_reports_permission', 2018, true, null, 403 );
            }

            switch( $this->request['do'] )
            {
                default:
                case 'report':
                    $this->_initReportForm();
                    break;
                
                case 'showMessage':
                    $this->_viewReportedMessage();
                    break;
                
                case 'index':
                    $this->_displayReportCenter();
                    break;
                
                case 'process':
                    $this->request['k'] = $this->member->form_hash;
                    $this->memberData['g_access_cp'] = 1;
                    $this->_processReports();
                    break;
                
                case 'findfirst':
                    $this->findFirstReport();
                    break;
    
                case 'show_report':
                    $this->_displayReport();
                    break;
            }
        }
        else
            parent::doExecute($registry);
    }
    
    public function _displayReportCenter()
    {
        if (defined('IN_MOBIQUO'))
        {
            global $totalReports, $reports;
            
            $totalReports = 0;
            $reports = array();
            
            $this->registry->getClass('reportLibrary')->checkMemberRSSKey();
            $this->registry->output->addNavigation( $this->lang->words['main_title'], 'app=core&amp;module=reports&amp;do=index' );
            $COM_PERM = $this->registry->getClass('reportLibrary')->buildQueryPermissions();
            $_where = $COM_PERM . ' AND stat.is_active=1';
            
            $total = $this->DB->buildAndFetch( array(
                                                    'select'    => 'COUNT(*) as reports',
                                                    'from'      => array( 'rc_reports_index' => 'rep' ),
                                                    'where'     => $_where,
                                                    'add_join'  => array(
                                                                        array(
                                                                            'from'  => array( 'rc_classes' => 'rcl' ),
                                                                            'where' => 'rcl.com_id=rep.rc_class'
                                                                            ),
                                                                        array(
                                                                            'from'  => array( 'rc_status' => 'stat' ),
                                                                            'where' => 'stat.status=rep.status'
                                                                            )
                                                                        )
                                            )       );
            
            $totalReports = $total['reports'];
            
            if ($total['reports'])
            {
                $this->DB->buildFromCache( 'reports_index', array( 'WHERE' => $_where, 'START' => intval($this->request['st']), 'LIMIT' => $this->request['perpage'] ), 'report_sql_queries' );
                $res = $this->DB->execute();
                
                if ( ! $this->registry->isClassLoaded('topics') )
                {
                    $classToLoad = IPSLib::loadLibrary( IPSLib::getAppDir( 'forums' ) . "/sources/classes/topics.php", 'app_forums_classes_topics', 'forums' );
                    $this->registry->setClass( 'topics', new $classToLoad( $this->registry ) );
                }
                
                while( $row = $this->DB->fetch($res) )
                {
                    $sec_data           = $this->registry->getClass('reportLibrary')->plugins[$row['my_class']]->giveSectionLinkTitle( $row );
                    $row['section']     = $sec_data;
                    $row['post']        = $this->registry->getClass('topics')->getPostById( $row['exdat3'] );
                    
                    if (!isset($row['post']['pid']))
                    {
                        $totalReports--;
                        continue;
                    }
                    
                    $reports[ $row['id'] ]  = $row;
                }
            }
            
            //Get report reason and current report number
            $currentNum = 0;
            foreach ($reports as $rid => $info)
            {
                $currentNum++;
                
                /* Load parser */
                $classToLoad = IPSLib::loadLibrary( IPS_ROOT_PATH . 'sources/classes/text/parser.php', 'classes_text_parser' );
                $parser = new $classToLoad();

                //-----------------------------------------
                // Get reports
                //-----------------------------------------

                $this->DB->buildFromCache( 'grab_report', array( 'COM' => $COM_PERM, 'rid' => $rid ), 'report_sql_queries' );
                $outer = $this->DB->execute();

                while( $row = $this->DB->fetch($outer) )
                {
                    $row['points']      = isset( $row['points'] ) ? $row['points'] :  $this->settings['_tmpPoints'][ $row['id'] ];

                    if( !$options['url'] && $row['url'] )
                    {
                        $options['url'] = $this->registry->getClass('reportLibrary')->processUrl( $row['url'], $row['seoname'], $row['seotemplate'] );
                    }

                    if( !$options['class'] && $row['my_class'] )
                    {
                        $options['class'] = $row['my_class'];
                    }

                    if( $row['my_class'] == 'messages' && !$options['topicID'] && $row['exdat1'] )
                    {
                        $options['topicID'] = intval($row['exdat1']);
                    }

                    $options['title'] = $row['title'];
                    $options['status_id'] = $row['status'];

                    if( !$options['status_icon'] )
                    {
                        $options['status_icon'] = $this->registry->getClass('reportLibrary')->buildStatusIcon( $row );
                        $options['status_text'] = $this->registry->getClass('reportLibrary')->flag_cache[ $row['status'] ][ $row['points'] ]['title'];
                    }

                    /* Stupid stupid stupidness */
                    $row['_title']  = $row['title'];
                    $row['title']   = $row['member_title'];

                    if( $row['member_id'] )
                    {
                        $row['author'] = IPSMember::buildDisplayData( $row );
                    }
                    else
                    {
                        $row['author'] = IPSMember::buildDisplayData( IPSMember::setUpGuest( '' ) );
                    }

                    $row['title']   = $row['_title'];

                    /* Set up some settings */
                    $parser->set( array( 'parseArea'      => 'reports',
                            'memberData'     => $row['author'],
                            'parseBBCode'    => true,
                            'parseHtml'      => false,
                            'parseEmoticons' => true ) );
                    
                    $row['report']  = $parser->display( $row['report'] );

                    $reports[$rid]['reason'][]  = $row;
                    
                    //See if the post reported is the sponsor one of a topic
                    $Topic_sponsor = false;
                    
                    if ( ! $this->registry->isClassLoaded('topics') )
                    {
                        $classToLoad = IPSLib::loadLibrary( IPSLib::getAppDir( 'forums' ) . "/sources/classes/topics.php", 'app_forums_classes_topics', 'forums' );
                        $this->registry->setClass( 'topics', new $classToLoad( $this->registry ) );
                    }
                    
                    $topicData      = $this->registry->getClass('topics')->getTopicById($info['exdat2']);
                    
                    if($topicData['topic_firstpost']==$info['exdat3'])
                        $Topic_sponsor = true;
                        
                    $reports[$rid]['Topic_sponsor']  = $Topic_sponsor;
                }
                
            }
            $totalReports = $currentNum;
            
            //Get ban info
            foreach ($reports as $rid => $info)
            {
                $uid = $info['post']['author_id'];
                $author = IPSMember::buildDisplayData($uid, array('spamStatus' => 1));
                
                $is_spam = $author['spamStatus'] === TRUE;
                $can_mark_spam = $author['spamStatus'] === FALSE && $author['member_id'] != $this->memberData['member_id'];
                
                $reports[$rid]['can_ban'] = $can_mark_spam;
            }
        }
        else
            parent::_displayReportCenter();
    }
}