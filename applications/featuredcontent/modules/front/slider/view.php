<?php


namespace IPS\featuredcontent\modules\front\slider;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * view
 */
class _view extends \IPS\Dispatcher\Controller
{
	/**
	 * Execute
	 *
	 * @return	void
	 */
	public function execute()
	{
		try
		{
			$this->slider = \IPS\featuredcontent\Slider::load( \IPS\Request::i()->id );
		}
		catch( \OutOfRangeException $e )
		{
			\IPS\Output::i()->error( 'node_error', '2BIMFC100/2', 404 );
		}		
		parent::execute();
	}
	
	/**
	 * ...
	 *
	 * @return	void
	 */
	protected function manage()
	{
		if ( ! $this->slider->can('manage') || $this->slider->method != 'noauto' )
		{
			\IPS\Output::i()->error( 'fcs_error_nomanaperm', '2BIMFC100/3', 403, '' );
		}

		/* Display */
		\IPS\Output::i()->jsFiles	= array_merge( \IPS\Output::i()->jsFiles, \IPS\Output::i()->js( 'jquery/jquery-ui.js', 'core', 'interface' ) );
		\IPS\Output::i()->breadcrumb = array();
		\IPS\Output::i()->breadcrumb[] = array( NULL, $this->slider->title );		
		\IPS\Output::i()->title		= $this->slider->title;		
		\IPS\Output::i()->output	= \IPS\Theme::i()->getTemplate( 'manage' )->list_items( $this->slider );
	}
	
	/**
	 * Move
	 *
	 * @return	void
	 */
	protected function move()
	{
		if ( ! $this->slider->can('manage') )
		{
			\IPS\Output::i()->json( array( 'type' => 'error', 'message' => \IPS\Member::loggedIn()->language()->get( 'fcs_error_nomanaperm' ) ) );
			exit;
		}
		
		$position = 0;

		if ( \IPS\Request::i()->isAjax() and \IPS\Request::i()->ajax_order )
		{
			$i = 1;
			foreach ( \IPS\Request::i()->ajax_order as $id )
			{
				\IPS\Db::i()->update( 'featuredcontent_contents', array( 'fcc_position' => $i ), array( 'fcc_id=?', $id ) );
				$i++;
			}
			\IPS\Output::i()->json( 'OK' );
			return;
		}
		
		\IPS\Output::i()->redirect( isset( $_SERVER['HTTP_REFERER'] ) ? $_SERVER['HTTP_REFERER'] : \IPS\Http\Url::internal( '' ) );
	}
		
	/*-------------------------------------------------------------------------*/
	// Edit/Add content
	/*-------------------------------------------------------------------------*/	
	protected function manageSlider()
    {	
		/* Check Item */
		try
		{
			$item = \IPS\Db::i()->select( '*', 'featuredcontent_contents', array( 'fcc_id=?', \intval( \IPS\Request::i()->item ) ) )->first();
		}
		catch( \UnderflowException $e ){}

		$item['moderators'] = $item['moderators'] ? $item['moderators'] : 0;
		if ( !$this->slider->can('manage') && !\in_array( \IPS\Member::loggedIn()->member_id, explode( ",", $item['moderators'] ) ) )
		{
			\IPS\Output::i()->error( 'fcs_error_nomanaperm', '2BIMFC100/4', 403, '' );
		}
		
		/* Build Form */
		$form = new \IPS\Helpers\Form;
		$form->class = 'ipsPad ipsForm_vertical';

		$options = array( 'url' => 'fcc_image', 'upload' => 'fcc_uploadimg' );
		$toggles = array( 'url' => array( 'fcc_image' ), 'upload' => array( 'fcc_uploadimg' ) );
		$form->add( new \IPS\Helpers\Form\Select( 'fcc_imageFrom', $item ? $item['fcc_imageFrom'] : 'fromURL', FALSE, array( 'options' => $options, 'toggles' => $toggles ) ) );	

		$form->add( new \IPS\Helpers\Form\Url( 'fcc_image', $item ? $item['fcc_image'] : NULL, FALSE, array(), NULL, NULL, NULL, 'fcc_image' ) );
		$form->add( new \IPS\Helpers\Form\Upload( 'fcc_uploadimg', ( $item AND $item['fcc_uploadimg'] ) ? \IPS\File::get( 'featuredcontent_Image', $item['fcc_uploadimg'] ) : NULL, FALSE, array( 'image' => TRUE, 'storageExtension' => 'featuredcontent_Image' ), NULL, NULL, NULL, 'fcc_uploadimg' ) );		
		$form->add( new \IPS\Helpers\Form\Url( 'fcc_url', $item ? $item['fcc_url'] : NULL, FALSE, array(), NULL, NULL, NULL, 'fcc_url' ) );
		$form->add( new \IPS\Helpers\Form\Text( 'fcc_title', $item ? $item['fcc_title'] : NULL, FALSE, array(), NULL, NULL, NULL, 'fcc_title' ) );	
		$form->add( new \IPS\Helpers\Form\YesNo( 'fcc_newtab', $item ? $item['fcc_newtab'] : NULL, FALSE, array(), NULL, NULL, NULL, 'fcc_newtab' ) );
		
		if ( $this->slider->can('manage') )
		{
			if( $item['fcc_moderators'] )
			{
				foreach( explode(",", $item['fcc_moderators']) as $mid )
				{
					$mem = \IPS\Member::load( $mid );

					if( $mem->member_id )
					{
						$mod[] = $mem;
					}
				}
			}		
			$form->add( new \IPS\Helpers\Form\Member( 'fcc_moderators', $item && $item['fcc_moderators'] ? $mod : NULL, FALSE, array( 'multiple' => null ) ) );	
		}
		
		/* Save */
		if ( $values = $form->values() )
		{			
			$data = array( 	'fcc_slider' 		=> $this->slider->id,
							'fcc_imageFrom'	 	=> $values['fcc_imageFrom'],			
							'fcc_image'	 		=> $values['fcc_image'],
							'fcc_uploadimg'	 	=> (string) $values['fcc_uploadimg'],
							'fcc_url'	 		=> $values['fcc_url'],
							'fcc_title'	 		=> htmlspecialchars( $values['fcc_title'], ENT_QUOTES | ENT_DISALLOWED, 'UTF-8', FALSE ),
							'fcc_newtab'	 	=> $values['fcc_newtab'],
			);
			
			if ( $this->slider->can('manage') )
			{			
				if ( $values['fcc_moderators'] )
				{
					$moderators = array_map( function( $member )
					{
						return $member->member_id;
					}, $values['fcc_moderators'] );
				}
				$addMods = array( 'fcc_moderators'	=> $moderators ? implode( ",", $moderators ) : null );
				$data = array_merge( $data, $addMods );
			}		
			
			if ( $item['fcc_id'] > 0 )
			{
				\IPS\Db::i()->update( 'featuredcontent_contents', $data, array( 'fcc_id=?', $item['fcc_id'] ) );
			}
			else
			{
				\IPS\Db::i()->insert( 'featuredcontent_contents', $data );
			}		

			\IPS\Output::i()->redirect( isset( $_SERVER['HTTP_REFERER'] ) ? $_SERVER['HTTP_REFERER'] : \IPS\Http\Url::internal( '' ) );
		}
		
		/* Display */
		\IPS\Output::i()->breadcrumb[] = array( NULL, \IPS\Member::loggedIn()->language()->addToStack( \IPS\Request::i()->item > 0 ? 'fcs_edit' : 'fcs_add' ) . ": " . $this->slider->title );		
		\IPS\Output::i()->title = \IPS\Member::loggedIn()->language()->addToStack( \IPS\Request::i()->item > 0 ? 'fcs_edit' : 'fcs_add' );	
		\IPS\Output::i()->output = $form;
	}	

	/*-------------------------------------------------------------------------*/
	// Remove
	/*-------------------------------------------------------------------------*/
	public function remove()
	{
		\IPS\Session::i()->csrfCheck();
		
		try
		{
			$item = \IPS\Db::i()->select( '*', 'featuredcontent_contents', array('fcc_id=?', \intval( \IPS\Request::i()->item ) ) )->first();
		}
		catch( \UnderflowException $e ) 
		{
			\IPS\Output::i()->json( array( 'type' => 'error', 'message' => \IPS\Member::loggedIn()->language()->get( 'fc_noitem' ) ) );
			exit;					
		}
		
		$item['moderators'] = $item['moderators'] ? $item['moderators'] : 0;
		if ( !$this->slider->can('manage') && !\in_array( \IPS\Member::loggedIn()->member_id, explode( ",", $item['moderators'] ) ) )
		{
			\IPS\Output::i()->error( 'fcs_error_nomanaperm', '2BIMFC100/5', 403, '' );
		}
		
		\IPS\Db::i()->delete( 'featuredcontent_contents', array( 'fcc_id=?', $item['fcc_id'] ) );
		
		if ( $item['fcc_uploadimg'] )
		{
			\IPS\File::get( 'featuredcontent_Image', $item['fcc_uploadimg'] )->delete();
		}
		
		if ( \IPS\Request::i()->isAjax() )
		{
			\IPS\Output::i()->json( array( 'html' => \IPS\Theme::i()->getTemplate( 'manage' )->itemRows( $this->slider ), 'message' => \IPS\Member::loggedIn()->language()->get( 'deleted' ) ) );
		}
		else
		{
			\IPS\Output::i()->redirect( isset( $_SERVER['HTTP_REFERER'] ) ? $_SERVER['HTTP_REFERER'] : \IPS\Http\Url::internal( '' ) );
		}			
	}
	
	
	/*-------------------------------------------------------------------------*/
	// View Popup
	/*-------------------------------------------------------------------------*/		
	public function popup()
	{
		if ( ! $this->slider->can('view') )
		{
			\IPS\Output::i()->json( array( 'type' => 'error', 'message' => \IPS\Member::loggedIn()->language()->get( 'fcs_error_noviewperm' ) ) );
			exit;
		}
			
		try
		{
			if ( $this->slider->method == 'cms' )
			{
				$recordClass = 'IPS\cms\Records' . $this->slider->cms_db;
				$item = $recordClass::load( \IPS\Request::i()->item );
				$content = \IPS\Theme::i()->getTemplate( 'embed' )->popup_cms( $item );
			}
			elseif ( $this->slider->method == 'forums' )
			{
				$item = \IPS\forums\Topic::load( \IPS\Request::i()->item );
				$content = \IPS\Theme::i()->getTemplate( 'embed' )->popup_forums( $item );
			}
			elseif ( $this->slider->method == 'downloads' )
			{
				$item = \IPS\downloads\File::load( \IPS\Request::i()->item );
				$cfields	= array();
				$fields		= $item->customFields();

				foreach ( new \IPS\Patterns\ActiveRecordIterator( \IPS\Db::i()->select( 'pfd.*', array( 'downloads_cfields', 'pfd' ), NULL, 'pfd.cf_position' ), 'IPS\downloads\Field' ) as $field )
				{
					if( array_key_exists( 'field_' . $field->id, $item->customFields() ) )
					{
						if ( $fields[ 'field_' . $field->id ] !== null AND $fields[ 'field_' . $field->id ] !== '' )
						{
							$cfields[ 'field_' . $field->id ] = $field->displayValue( $fields[ 'field_' . $field->id ] );
						}
					}
				}
				
				$content = \IPS\Theme::i()->getTemplate( 'embed' )->popup_downloads( $item, $cfields );
			}
			elseif ( $this->slider->method == 'videobox' )
			{
				$item = \IPS\videobox\Video::load( \IPS\Request::i()->item );
				$content = \IPS\Theme::i()->getTemplate( 'embed' )->popup_videobox( 'info', $this->_videoinfo($item), $item );
			}			
			else
			{
				\IPS\Output::i()->json( array( 'type' => 'error', 'message' => \IPS\Member::loggedIn()->language()->get( 'fcs_error_noviewperm' ) ) );
				exit;			
			}			
		}
		catch( \OutOfRangeException $e )
		{
			\IPS\Output::i()->json( array( 'type' => 'error', 'message' => \IPS\Member::loggedIn()->language()->get( 'node_error' ) ) );
			exit;				
		}			
		
		\IPS\Output::i()->sendOutput( $content );
	}	
	
	protected function _videoinfo($video)
	{		
		if ( \IPS\Settings::i()->vb_conf_online_on == 1 && $video->container()->videoTab != 1 && ( \IPS\Settings::i()->vb_conf_online_cats=='0' || \in_array( $video->container()->id, explode(",",\IPS\Settings::i()->vb_conf_online_cats) ) ) )
		{
			$this->videoJS();
		}
		return \IPS\Theme::i()->getTemplate( 'view', 'videobox', 'front' )->videoInfo($video);
	}	
	
	protected function videoJS()
	{
		# CSS
		\IPS\Output::i()->cssFiles = array_merge( \IPS\Output::i()->cssFiles, \IPS\Theme::i()->css( 'video-js.css', 'videobox', 'front' ) );	
		
		# Javascript
		\IPS\Output::i()->jsFiles = array_merge( \IPS\Output::i()->jsFiles, \IPS\Output::i()->js( 'video-js/video.min.js', 'videobox', 'interface' ) );
		\IPS\Output::i()->jsFiles = array_merge( \IPS\Output::i()->jsFiles, \IPS\Output::i()->js( 'video-js/plugins/videojs-resolution-switcher.js', 'videobox', 'interface' ) );				
		\IPS\Output::i()->jsFiles = array_merge( \IPS\Output::i()->jsFiles, \IPS\Output::i()->js( 'video-js/plugins/hls.js', 'videobox', 'interface' ) );				
		\IPS\Output::i()->jsFiles = array_merge( \IPS\Output::i()->jsFiles, \IPS\Output::i()->js( 'video-js/plugins/ga.js', 'videobox', 'interface' ) );	
		if (\IPS\Settings::i()->vb_conf_online_preroll == 1 )
		{
			\IPS\Output::i()->jsFiles = array_merge( \IPS\Output::i()->jsFiles, \IPS\Output::i()->js( 'video-js/plugins/ads.js', 'videobox', 'interface' ) );	
		}
	}	
}