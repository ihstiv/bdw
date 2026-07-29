<?php

class popularTopics
{
	public function __construct()
	{
		$this->registry = IPSRegistry::instance();
		$this->member     =  $this->registry->member();
		$this->memberData =& $this->registry->member()->fetchMemberData();
		$this->settings   =& $this->registry->fetchSettings();		
		$this->DB         = $this->registry->DB();
	}
	
	public function getOutput()
	{
		$blocked = explode( ',' , IPSText::cleanPermString($this->settings['poptop_block']) );
		$forums = $this->registry->class_forums->fetchSearchableForumIds( $this->memberData['member_id'], $blocked );
		$pussy = intval($this->settings['poptop_days']);
		$howmuch = $pussy * 24 * 60 * 60;
		$takeoff = time() - $howmuch;
		$nipples = intval($this->settings['poptop_amount']);
		$this->DB->build( array(
					'select' => 'p.*,count(p.topic_id) as stuff',
					'from' => array( 'posts' => 'p' ),
					'where' => "post_date > " . $takeoff . ' AND ' . ( empty( $forums ) ? '1=0' : ipsRegistry::DB()->buildWherePermission( $forums, 't.forum_id', FALSE ) ), 
					'group' => 'topic_id',
					'limit' => array( 0, $nipples ),
					'order' => 'stuff DESC',
					'add_join'  => array ( 1 => array (
									'select' => 't.*,t.title as topic_title',
									'from'   => array ( 'topics' => 't' ),
									'where'  => 't.tid = p.topic_id',
									'type'   => 'left' ),
							   2 => array (
										'select' => 'm.*',
										'from'   => array ( 'members' => 'm' ),
										'where'  => 'm.member_id = t.starter_id',
										'type'   => 'left' ),
							   3 => array (
										'select' => 'pp.*',
										'from'   => array ( 'profile_portal' => 'pp' ),
										'where'  => 'pp.pp_member_id = m.member_id',
										'type'   => 'left' )
								)
				) );										
	
		$this->DB->execute();
		$popular = array();
		while( $r = $this->DB->fetch() )
		{
		        $popular[] = IPSMember::buildDisplayData( $r );
		}	
		
		return $this->registry->getClass('output')->getTemplate('boards')->popularTopics($popular);
	}
}