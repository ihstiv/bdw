<?php

/**
 * @brief			This file fixes member id and name.
 * @author			<a href='http://www.invisionpower.com'>Invision Power Services, Inc.</a>
 * @copyright		(c) 2001 - SVN_YYYY Invision Power Services, Inc.
 * @license			http://www.invisionpower.com/legal/standards/
 * @package			IPS Community Suite
 * @subpackage		Converters
 * @since			Thursday March 21st 2013
 * @version			SVN_VERSION_NUMBER
 */

define( 'HDLR_PHOTO_PATH', '/home/bdwforum/public_html/img/' );

class fixHuddlerGroups
{
	
	private $go = 250;
	private $HDLR;
	public $loop;
	private $_like;
	
	public function __construct()
	{
		/*
		 * CONFIGURE ME
		*/
		$this->HDLR		=	array(
			'name'		=>	'bdwforum_old',		# Database name
			'user'		=>	'bdwforum_huddler',			# Database user
			'pass'		=>	'44kDzR',				# Database password
			'host'		=>	'localhost',	# Database host
			'prefix'	=>	'export_',		# Database prefix
			//'prefix'	=> '',				# For some strange reason, the subscriptions table doesn't appear to have a prefix.. at least on staging anyway.
			'charset'	=>	'UTF8',		# Database charset
		);
		
		/*
		 * END CONFIG
		*/
		
		// Load IPB
		require_once( 'initdata.php' );
		require_once( CP_DIRECTORY.'/sources/base/ipsRegistry.php' );
		require_once( CP_DIRECTORY.'/sources/base/ipsController.php' );
		$this->registry	=	ipsRegistry::instance();
		$this->registry->init();
		$this->settings =&	$this->registry->fetchSettings();
		
		// Load DB
		$this->DB       =	$this->registry->DB();
		
		// Load External DB
		$this->HB		=	$this->connect();
		
		$this->next 	=	$_REQUEST['st'] + $this->go;
	}
	
	/**
	 * Load up the information from the Huddler database
	 */
	public function load()
	{
		// Set up the limit.
		$limit  = array( $_REQUEST['st'], $this->go );
		
		$this->DB->build( array(
			'select'	=> '*',
			'from'		=> 'members',
			'where'		=> 'member_group_id NOT IN(4)',
			'limit'		=> $limit,
			'order'		=> 'member_id ASC',
		) );
		$o = $this->DB->execute();
		
		// Got anything?
		if ( ! $this->DB->getTotalRows( $o ) )
		{			
			// And kill it.
			echo 'Complete'; exit;
		}
		
		// Array cache it
		while( $row = $this->DB->fetch( $o ) )
		{
			$this->loop[$row['member_id']] = $row;
		}
	}
	
	/**
	 * Convert the data to an IPB friendly format.
	 */
	public function process( $row )
	{
		$memberLink = $this->DB->buildAndFetch( array(
			'select'	=> 'foreign_id',
			'from'		=> 'conv_link',
			'where'		=> "ipb_id = {$row['member_id']} AND type = 'members'",
		) );
		
		// orphaned albums
		if ( $memberLink['foreign_id'] )
		{
			$old = array();
			foreach( $this->HB->buildAndFetchAll( array( 'select' => 'group_id', 'from' => 'perms_group_membership', 'where' => "user_id = {$memberLink['foreign_id']}", 'order' => 'start_date DESC' ) ) AS $k => $group )
			{
				$old[] = $group['group_id'];
			}
			
			$oldPrimary = array_shift( $old );
			
			$secondaries = array();
			if( count( $old ) > 0 )
			{
				foreach( $old AS $k => $oldGroup )
				{
					$newId = $this->DB->buildAndFetch( array( 'select' => 'ipb_id', 'from' => 'conv_link', 'where' => "foreign_id = {$oldGroup} AND type = 'groups'" ) );
					$secondaries[] = $newId['ipb_id'];
				}
			}
			
			if ( count( $secondaries ) > 0 )
			{
				$newSecondaries = ',' . implode( ',', $secondaries ) . ',';
			}
			else
			{
				$newSecondaries = '';
			}
			
			// New Group Link
			$primary = $this->DB->buildAndFetch( array( 'select' => 'ipb_id', 'from' => 'conv_link', 'where' => "foreign_id = {$oldPrimary} AND type = 'groups'") );
			
			$this->DB->update( 'members', array(
				'member_group_id'		=> $primary['ipb_id'],
				'mgroup_others'			=> "{$newSecondaries}",
			), "member_id = {$row['member_id']}" );
		}
	}
	
	/**
	 * External DB Connect for the database layer
	 */

	public function connect()
	{
		$this->registry->dbFunctions()->setDB( 'mysql', 'hb', array(
			'sql_database'		=> $this->HDLR['name'],
			'sql_user'			=> $this->HDLR['user'],
			'sql_pass'			=> $this->HDLR['pass'],
			'sql_host'			=> $this->HDLR['host'],
			'sql_tbl_prefix'	=> $this->HDLR['prefix'],
			'sql_charset'		=> $this->HDLR['charset'],
		) );
		return ipsRegistry::DB('hb');
	}
}

// Init
$class = new fixHuddlerGroups();

// Get subs from huddler
$class->load();

// Convert 'em
foreach( $class->loop as $k => $v )
{
	$class->process( $v );
}

// Next
echo "Up to {$class->next} done... continuing.
<script type='text/javascript'>window.location = '{$_SERVER['PHP_SELF']}?st={$class->next}';</script>";