<?php

require_once( 'init.php' );
\IPS\Dispatcher\External::i();

class redirector
{
	private $HDLR = array(
        'sql_database' => 'bdwforum_final2', # Database name
        'sql_user' => 'bdwforum_final3', # Database user
        'sql_pass' => '9c1W7eNxfvFz',	   # Database password
        'sql_host' => 'localhost',	# Database host
        'sql_tbl_prefix' => '',		# Database prefix
        'sql_charset' => 'UTF8',		# Database charset
    );

	private $imagePath = 'https://cdn.bestdestinationwedding.com/';

	public function run()
	{
	    switch( \IPS\Request::i()->act )
        {
			case 'forums':
			    $table = 'convert_link';
			    $class = 'IPS\forums\Forum';
			    break;

            case 'members':
                $table = 'convert_link';
                $class = 'IPS\Member';
                break;

            case 'gallery_albums':
                $table = 'convert_link';
			    $class = 'IPS\gallery\Album';

                // fix stange double querystring issue
                if( mb_substr( \IPS\Request::i()->id, '?' ) !== false )
                {
                    \IPS\Request::i()->id = explode ("?", \IPS\Request::i()->id[0] );
                }
			    break;

            case 'topics':
                $table = 'convert_link_topics';
                $class = 'IPS\forums\Topic';
                break;

            case 'posts':
                $table = 'convert_link_posts';
                $class = 'IPS\forums\Topic\Post';
                break;
			
			case 'content':
				$this->_contentRedirect();
			    break;
			
			case 'image':
				$this->_getImage();
			    break;
			
			//added by swright 082013
			case 'img':
			    $this->_getImg();
			    break;
		}

        try
        {
            $where = array();
            $where[] = array( 'foreign_id=?', \IPS\Request::i()->id );
            $where[] = array( 'type=?', \IPS\Request::i()->act );
            $where[] = array( \IPS\Db::i()->in( 'app', array( 9, 4 ) ) );
            $ipbId = \IPS\Db::i()->select( 'ipb_id', $table, $where )->first();
        }
        catch( \UnderflowException $e )
        {
            //first try this one - this is for the quote reference links w/in posts swright 12/6/13
            try
            {
                $ipbId = \IPS\Db::i()->select( 'ipb_id', $table, array( 'foreign_id=? and type=?', \IPS\Request::i()->id, \IPS\Request::i()->act ) )->first();
            }
            catch( \UnderflowException $e )
            {
                // just redirect to the index
                \IPS\Output::i()->redirect( \IPS\Http\Url::internal( "" ) );
            }
        }

        // if we are still here we have an ID
        try
        {
            $obj = $class::load( $ipbId );
            \IPS\Output::i()->redirect( $obj->url() );
        }
        catch( \OutOfRangeException $e )
        {
            \IPS\Output::i()->redirect( \IPS\Http\Url::internal( "" ) );
        }
	}

    /**
     * Redirect to articles
     */
	private function _contentRedirect()
	{
	    try
        {
            $row = \IPS\Db::i()->select( '*', 'cms_custom_database_1', array( 'record_static_furl=? or record_dynamic_furl=?', \IPS\Request::i()->id, \IPS\Request::i()->id ) )->first();
            $record = \IPS\cms\Records1::constructFromData( $row );
            \IPS\Output::i()->redirect( $record->url() );
        }
        catch( \UnderflowException $e )
        {
            \IPS\Output::i()->redirect( \IPS\Http\Url::internal( "" ) );
        }
	}
	
	
	//use this function for articles - swright //http://www.bestdestinationwedding.com/content/type/61/id/221934/width/350/height/700/flags/LL
	private function _getImage()
	{
        $hb = \IPS\Db::i( 'hb', $this->HDLR );

        //this one pulls the correct ID for FORUM image redirects. swright 12/7/13
        try
        {
            $obj = $hb->select( 'e.*', array( 'gallery_images', 'i' ), array( 'i.id=?', \IPS\Request::i()->id ) )
                ->join( array( 'external_store_objects', 'e' ), 'e.id=i.external_store_object_id' )->first();

            @header( "Content-Type: {$obj['mime_type']}/{$obj['mime_subtype']}" );
            $file = \file_get_contents( $this->imagePath . $obj['store_key'] );
            echo( $file );
            exit;
        }
        catch( \UnderflowException $e )
        {
            \IPS\Output::i()->redirect( \IPS\Http\Url::internal( "" ) );
        }
	}
	
	//use this function for forums - swright //http://www.bestdestinationwedding.com/image/id/216871/width/1000/height/500
	private function _getImg()
	{
	    $hb = \IPS\Db::i( 'hb', $this->HDLR );
		
		//this one pulls the correct ID for FORUM image redirects. swright 12/7/13
        try
        {
            $obj = $hb->select( '*', 'external_store_objects', array( 'id=?', \IPS\Request::i()->id ) )->first();

            @header( "Content-Type: {$obj['mime_type']}/{$obj['mime_subtype']}" );
            $file = \file_get_contents( $this->imagePath . $obj['store_key'] );
            echo( $file );
            exit;
        }
        catch( \UnderflowException $e )
        {
            \IPS\Output::i()->redirect( \IPS\Http\Url::internal( "" ) );
        }
	}
}

$class = new redirector();
$class->run();