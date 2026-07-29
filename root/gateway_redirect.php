<?php

define( 'IN_IPB', 1 );
define( 'IPS_ENFORCE_ACCESS', 1 );

require_once( './initdata.php' );
require_once( IPS_ROOT_PATH . '/sources/base/ipsRegistry.php' );
require_once( IPS_ROOT_PATH . '/sources/base/ipsController.php' );

$registry = ipsRegistry::instance();

$registry->init();

$class = new redirector( $registry );

$class->run();

class redirector
{
	protected $registry;
	protected $DB;
	protected $settings;
	protected $request;
	private $HDLR = array();
	private $imagePath = 'http://cdn.bestdestinationwedding.com/';
	
	public function __construct( ipsRegistry $registry )
	{
		$this->registry	= $registry;
		$this->DB		= $this->registry->DB();
		$this->settings	= $this->registry->fetchSettings();
		$this->request	= $this->registry->fetchRequest();
		
		$this->HDLR		=	array(
			'name'		=>	'bdwforum_final2', # Database name
			'user'		=>	'bdwforum_final3', # Database user
			'pass'		=>	'9c1W7eNxfvFz',	   # Database password
			'host'		=>	'localhost',	# Database host
			'prefix'	=>	'',		# Database prefix
			//'prefix'	=> '',			# For some strange reason, the subscriptions table doesn't appear to have a prefix.. at least on staging anyway.
			'charset'	=>	'UTF8',		# Database charset
		);
	}

	public function run()
	{
		switch( $this->request['act'] )
		{
			case 'forums':
				$table	= 'conv_link';
				$type	= 'forums';
				$url	= $this->settings['board_url'] . '/index.php?showforum=';
			break;
			
			case 'members':
				$table	= 'conv_link';
				$type	= 'members';
				$url	= $this->settings['board_url'] . '/index.php?showuser=';
			break;
			
			case 'topics':
				$table	= 'conv_link_topics';
				$type	= 'topics';
				$url	= $this->settings['board_url'] . '/index.php?showtopic=';
			break;
			
			case 'posts':
				$table	= 'conv_link_posts';
				$type	= 'posts';
				$url	= $this->settings['board_url'] . '/index.php?app=forums&module=forums&section=findpost&pid=';
			break;
			
			case 'content':
				$this->_contentRedirect();
			break;
			
			case 'image':
				$this->_getImage();
			break;

			case 'gallery_albums':
				// Fix strange double querystring issue
				$this->request['id'] = explode('?', $this->request['id'][0]);

				$table	= 'conv_link';
				$type	= 'gallery_albums';
				$url	= $this->settings['board_url'] . '/index.php?app=gallery&module=user&do=view_album&album=';
			break;
			
			//added by swright 082013
			case 'img':
				$this->_getImg();
			break;
		}
		
		// Let's look it up.
	   // $link = $this->DB->buildAndFetch( array( 'select' => 'ipb_id', 'from' => $table, 'where' => "foreign_id = {$this->request['id']} AND type = '{$type}'" ) );
        $this->request['id'] = intval($this->request['id']);
		$link = $this->DB->buildAndFetch( array( 'select' => 'ipb_id', 'from' => $table, 'where' => "foreign_id = {$this->request['id']} AND type = '{$type}' AND app IN(9,4)" ) ); 

		// Get something?
		if ( ! $link['ipb_id'] )
		{
			//first try this one - this is for the quote reference links w/in posts swright 12/6/13
			 $link = $this->DB->buildAndFetch( array( 'select' => 'ipb_id', 'from' => $table, 'where' => "foreign_id = {$this->request['id']} AND type = '{$type}'" ) );
		} 
		
		if ( ! $link['ipb_id'] ) 
		{
			 // Nope, just send to index.
			$this->registry->output->silentRedirect( $this->settings['board_url'] );
		}
		else
		{
			// Yep - send us on our way.
			$this->registry->output->silentRedirect( $url . $link['ipb_id'] );
		}
	}
	
	private function _contentRedirect()
	{
		$this->request['id'] = $this->DB->addSlashes( $this->request['id'] );
		// Let's try static URL first.
		$article = $this->DB->buildAndFetch( array( 'select' => '*', 'from' => 'ccs_custom_database_1', 'where' => "record_static_furl = '{$this->request['id']}'" ) );
		
		if ( ! $article['primary_id_field'] )
		{
			// Nope - try dynamic.
			$article = $this->DB->buildAndFetch( array( 'select' => '*', 'from' => 'ccs_custom_database_1', 'where' => "record_dynamic_furl = '{$this->request['id']}'" ) );
		}
		
		if ( ! $article['primary_id_field'] )
		{
			// Couldn't find it - send to index.
			$this->registry->output->silentRedirect( $this->settings['board_url'] );
		}
		else
		{
			$this->registry->output->silentRedirect( $this->settings['board_url'] . '/index.php?app=ccs&module=pages&section=pages&do=redirect&to=articles&record=' . $article['primary_id_field'], '', true );
			exit;
		}
	}
	
	
	//use this function for articles - swright //http://www.bestdestinationwedding.com/content/type/61/id/221934/width/350/height/700/flags/LL
	private function _getImage()
	{
		// We need to connect to old Huddler DB.
		$this->registry->dbFunctions()->setDB( 'mysql', 'hb', array(
			'sql_database'		=> $this->HDLR['name'],
			'sql_user'		=> $this->HDLR['user'],
			'sql_pass'		=> $this->HDLR['pass'],
			'sql_host'		=> $this->HDLR['host'],
			'sql_tbl_prefix'	=> $this->HDLR['prefix'],
			'sql_charset'		=> $this->HDLR['charset'],
		) );
		$HB = ipsRegistry::DB('hb');
		
		//this one pulls the correct ID for ARTICLE image redirects. swright 12/7/13
		$img = $HB->buildAndFetch( array( 'select' => '*', 'from' => 'gallery_images', 'where' => "id = {$this->request['id']}" ) );
		$obj = $HB->buildAndFetch( array( 'select' => '*', 'from' => 'external_store_objects', 'where' => "id = {$img['external_store_object_id']}" ) );
				
	if (! $obj['store_key'] ){
	// Couldn't find it - send to index. //Jason: this isn't working and is throwing a 503/driver error instead when no image exists
	//example working: http://www.bestdestinationwedding.com/gateway_redirect.php?act=image&id=64670
	//example 503 error: http://www.bestdestinationwedding.com/gateway_redirect.php?act=image&id=64666
		$this->registry->output->silentRedirect( $this->settings['board_url'] );
	     }
	else {
	// Get the file.
		header('Content-type: ' . $obj['mime_type'] . '/' . $obj['mime_subtype'] );
		$file = @file_get_contents( $this->imagePath . $obj['store_key'] );
		echo( $file );
		exit;
	     }
	}
	
	//use this function for forums - swright //http://www.bestdestinationwedding.com/image/id/216871/width/1000/height/500
	private function _getImg()
	{
		// We need to connect to old Huddler DB.
		$this->registry->dbFunctions()->setDB( 'mysql', 'hb', array(
			'sql_database'		=> $this->HDLR['name'],
			'sql_user'		=> $this->HDLR['user'],
			'sql_pass'		=> $this->HDLR['pass'],
			'sql_host'		=> $this->HDLR['host'],
			'sql_tbl_prefix'	=> $this->HDLR['prefix'],
			'sql_charset'		=> $this->HDLR['charset'],
		) );
		$HB = ipsRegistry::DB('hb');
		
		//this one pulls the correct ID for FORUM image redirects. swright 12/7/13
		$img = $HB->buildAndFetch( array( 'select' => '*', 'from' => 'gallery_images', 'where' => "external_store_object_id = {$this->request['id']}" ) ); 		
		$obj = $HB->buildAndFetch( array( 'select' => '*', 'from' => 'external_store_objects', 'where' => "id = {$img['external_store_object_id']}" ) );
		
		// Get the file.
		header('Content-type: ' . $obj['mime_type'] . '/' . $obj['mime_subtype'] );
		$file = @file_get_contents( $this->imagePath . $obj['store_key'] );
		echo( $file );
		exit;
	}
	
}