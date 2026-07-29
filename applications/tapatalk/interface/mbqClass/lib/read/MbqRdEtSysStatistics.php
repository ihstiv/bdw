<?php

defined('MBQ_IN_IT') or exit;

MbqMain::$oClk->includeClass('MbqBaseRdEtSysStatistics');

/**
 * system statistics read class
 */
Class MbqRdEtSysStatistics extends MbqBaseRdEtSysStatistics {
    
    public function __construct() {
    }
    
    public function makeProperty(&$oMbqEtSysStatistics, $pName, $mbqOpt = array()) {
        switch ($pName) {
            default:
            MbqError::alert('', __METHOD__ . ',line:' . __LINE__ . '.' . MBQ_ERR_INFO_UNKNOWN_PNAME . ':' . $pName . '.');
            break;
        }
    }
    public function initOMbqEtSysStatistics() {
        $oMbqEtSysStatistics = MbqMain::$oClk->newObj('MbqEtSysStatistics');
        $stats = array();
		
		$stats['total_posts']	= \IPS\Db::i()->select( "COUNT(*)", 'forums_posts', array( 'queued = ?', 0 ) )->first();
		
		if ( \IPS\Settings::i()->archive_on )
		{
			$stats['total_posts'] += \IPS\forums\Topic\ArchivedPost::db()->select( 'COUNT(*)', 'forums_archive_posts', array( 'archive_queued = ?', 0 ) )->first();
		}
		
		$stats['total_topics']	= \IPS\Db::i()->select( "COUNT(*)", 'forums_topics', array( 'approved = ?', 1 ) )->first();
        $stats['num_users'] = \IPS\Db::i()->select( "COUNT(*)", 'core_members')->first();
        
        
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
        $stats['num_online'] = $counter->first();
        
             
        $oMbqEtSysStatistics->forumTotalThreads->setOriValue($stats['total_topics']);
        $oMbqEtSysStatistics->forumTotalPosts->setOriValue($stats['total_posts']);
        $oMbqEtSysStatistics->forumTotalMembers->setOriValue($stats['num_users']);
        $oMbqEtSysStatistics->forumActiveMembers->setOriValue($stats['num_users']);
        $oMbqEtSysStatistics->forumTotalOnline->setOriValue($stats['num_online']);
        $oMbqEtSysStatistics->forumGuestOnline->setOriValue(0);
        return $oMbqEtSysStatistics;
    }
}
