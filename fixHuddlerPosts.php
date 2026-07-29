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


class fixHuddlerPosts
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
			'name'		=>	'bdwforum_ipboard',		# Database name
			'user'		=>	'bdwforum_ipb',			# Database user
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
		
		$this->HB->build( array(
			'select'	=> '*',
			'from'		=> 'posts',
			'limit'		=> $limit,
		) );
		$o = $this->HB->execute();
		
		// Got anything?
		if ( ! $this->HB->getTotalRows( $o ) )
		{			
			// And kill it.
			echo 'Complete'; exit;
		}
		
		// Array cache it
		while( $row = $this->HB->fetch( $o ) )
		{
			$this->loop[$row['id']] = $row;
		}
	}
	
	/**
	 * Convert the data to an IPB friendly format.
	 */
	public function process( $row )
	{
		// First things first - let's grab our conv_link_posts entry.
		$postLink = $this->DB->buildAndFetch( array(
			'select'	=> 'ipb_id',
			'from'		=> 'conv_link_posts',
			'where'		=> "foreign_id = {$row['id']}",
		) );
		
		// And the members link entry.
		$memberLink = $this->DB->buildAndFetch( array(
			'select'	=> 'ipb_id',
			'from'		=> 'conv_link',
			'where'		=> "foreign_id = {$row['posted_by_uid']} AND type = 'members'",
		) );
		
		// Get member info
		$member = $this->DB->buildAndFetch( array( 'select' => '*', 'from' => 'members', 'where' => "member_id = {$memberLink['ipb_id']}" ) );
		
		// orphaned topics and / or members
		if ( $postLink['ipb_id'] AND $memberLink['ipb_id'] )
		{
			$this->DB->update( 'posts', array( 'author_id' => $member['member_id'], 'author_name' => $member['members_display_name'] ), "pid = {$postLink['ipb_id']}" );
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
$class = new fixHuddlerPosts();

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