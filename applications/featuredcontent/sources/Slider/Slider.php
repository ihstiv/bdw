<?php

namespace IPS\featuredcontent;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * Featured Content Node
 */
class _Slider extends \IPS\Node\Model implements \IPS\Node\Permissions
{
	/**
	 * @brief	[ActiveRecord] Multiton Store
	 */
	protected static $multitons;
		
	/**
	 * @brief	[ActiveRecord] Default Values
	 */
	protected static $defaultValues = NULL;
	
	/**
	 * @brief	[ActiveRecord] Database Table
	 */
	public static $databaseTable = 'featuredcontent_sliders';
	
	/**
	 * @brief	[ActiveRecord] Database Prefix
	 */
	public static $databasePrefix = 'fcs_';
		
	/**
	 * @brief	[Node] Order Database Column
	 */
	public static $databaseColumnOrder = 'position';
	
	/**
	 * @brief	[Node] Node Title
	 */
	public static $nodeTitle = 'fc_slider_sliders';
			
	/**
	 * @brief	[Node] Show forms modally?
	 */
	public static $modalForms = FALSE;
	
	/**
	 * @brief	[Node] ACP Restrictions
	 * @code
	 	array(
	 		'app'		=> 'core',				// The application key which holds the restrictrions
	 		'module'	=> 'foo',				// The module key which holds the restrictions
	 		'map'		=> array(				// [Optional] The key for each restriction - can alternatively use "prefix"
	 			'add'			=> 'foo_add',
	 			'edit'			=> 'foo_edit',
	 			'permissions'	=> 'foo_perms',
	 			'delete'		=> 'foo_delete'
	 		),
	 		'all'		=> 'foo_manage',		// [Optional] The key to use for any restriction not provided in the map (only needed if not providing all 4)
	 		'prefix'	=> 'foo_',				// [Optional] Rather than specifying each  key in the map, you can specify a prefix, and it will automatically look for restrictions with the key "[prefix]_add/edit/permissions/delete"
	 * @encode
	 */
	protected static $restrictions = array(
		'app'		=> 'featuredcontent',
		'module'	=> 'sliders',
		'prefix' 	=> 'sliders_',
		'all'		=> 'sliders_manage',
	);
	
	/** 
	 * @brief	[Node] App for permission index
	 */
	public static $permApp = 'featuredcontent';
	
	/** 
	 * @brief	[Node] Type for permission index
	 */
	public static $permType = 'slider';
	
	/**
	 * @brief	The map of permission columns
	 */
	public static $permissionMap = array(
		'view' 		=> 'view',
		'manage'	=> 3,
	);

	/** 
	 * @brief	[Node] Moderator Permission
	 */
	public static $modPerm = 'slider_sliders';
	
	
	/**
	 * @brief	[Node] Prefix string that is automatically prepended to permission matrix language strings
	 */
	public static $permissionLangPrefix = 'fcperm_';
	
	/**
	 * [Node] Get whether or not this node is enabled
	 *
	 * @note	Return value NULL indicates the node cannot be enabled/disabled
	 * @return	bool|null
	 */
	protected function get__enabled()
	{
		return $this->enabled;
	}

	/**
	 * [Node] Set whether or not this node is enabled
	 *
	 * @param	bool|int	$enabled	Whether to set it enabled or disabled
	 * @return	void
	 */
	protected function set__enabled( $enabled )
	{
		$this->enabled	= $enabled;
	}	
	
	/**
	 * [Node] Get Node Title
	 *
	 * @return	string
	 */
	protected function get__title()
	{
		return $this->title;
	}
	
	protected function get__description()
	{
		$code = "{fcontent=&quot;" . $this->id . "&quot;}";
		return $code;
	}
	
	protected function get_titleHeight()
	{
		$default = 35 + 20;
		$line = $this->truncate > 0 ? $this->truncate : 1;
		if ( $line == 1 )
		{
			$height = $default;
		}
		else
		{
			$height = $default + ($line-1) * 18;
		}
		return $height . 'px';
	}	
	
	protected function get_itemWidth()
	{
		return $this->img_w > 0 ? $this->img_w . "px" : 'auto';
	}	
	
	protected function get_itemHeight()
	{
		return $this->img_h > 0 ? $this->img_h . "px" : 'auto';
	}
	
	protected function get_tickerHeight()
	{
		if ( $this->showtitle == 1 && $this->title_pos == 'below' )
		{
			$height = $this->img_h + $this->titleHeight + 2;
		}
		else
		{
			$height = $this->img_h;
		}
		return $height;
	}		
	
	/**
	 * [Node] Add/Edit Form
	 *
	 * @param	\IPS\Helpers\Form	$form	The form
	 * @return	void
	 */
	public function form( &$form )
	{
		# Basic
		$form->addTab( 'fcs_tab_basic' );	
		$form->addHeader( 'fcs_tab_basic' );	
		$form->add( new \IPS\Helpers\Form\Text( 'fcs_title', $this->id ? $this->title : "", TRUE, array( 'maxLength' => 255 ) ) );
		$form->add( new \IPS\Helpers\Form\YesNo( 'fcs_showname', $this->id ? $this->showname : 0, FALSE ) );
		$form->add( new \IPS\Helpers\Form\YesNo( 'fcs_showtitle', $this->id ? $this->showtitle : 1, FALSE ) );
		$form->add( new \IPS\Helpers\Form\Select( 'fcs_title_pos', $this->id ? $this->title_pos : "inside", FALSE, array(
			'options' => array(
				'inside' 	=> 'fcs_title_pos_inside',
				'below' 	=> 'fcs_title_pos_below'
			) ) ) );		
			
		$form->add( new \IPS\Helpers\Form\YesNo( 'fcs_hideinmobile', $this->id ? $this->hideinmobile : 0, FALSE, array(), NULL, NULL, NULL, 'fcs_hideinmobile' ) );		

		$form->addHeader( 'fcs_tab_images' );
		$form->add( new \IPS\Helpers\Form\Number( 'fcs_img_w', $this->id ? $this->img_w : 310, FALSE ) );
		$form->add( new \IPS\Helpers\Form\Number( 'fcs_img_h', $this->id ? $this->img_h : 220, FALSE ) );
		$form->add( new \IPS\Helpers\Form\Number( 'fcs_margin', $this->id ? $this->margin : 3, FALSE ) );
		$form->add( new \IPS\Helpers\Form\Upload( 'fcs_noimg', $this->noimg ? \IPS\File::get( 'core_Theme', $this->noimg ) : NULL, FALSE, array( 'image' => true, 'storageExtension' => 'core_Theme' ) ) );
		
		# Slider
		$form->addTab( 'fcs_tab_slider' );
		$sliderOpts = array( 'fcs_truncate', 'fcs_shownav', 'fcs_showpage', 'fcs_keyboard', 'fcs_ticker', 'fcs_maxSlides', 'fcs_minSlides', 'fcs_speed', 'fcs_duration', 'fcs_easing', 'fcs_autoplay', 'fcs_autocontrol' );
		
		$form->add( new \IPS\Helpers\Form\Select( 'fcs_style', $this->id ? $this->style : "horizontal", FALSE, array(
			'options' => array(
				'horizontal' 	=> 'fcs_style_h',
				'vertical' 		=> 'fcs_style_v',
				'fade' 			=> 'fcs_style_fade',
				'grid' 			=> 'fcs_style_grid',
			),
			'toggles'	=> array(
				'horizontal' 	=> $sliderOpts,
				'vertical' 		=> $sliderOpts,
				'fade' 			=> $sliderOpts,			
			),
		) ) );
			
		$form->add( new \IPS\Helpers\Form\Number( 'fcs_truncate', $this->id ? $this->truncate : 1, FALSE, array( 'min' => 1 ), NULL, NULL, NULL, 'fcs_truncate' ) );
		$form->add( new \IPS\Helpers\Form\YesNo( 'fcs_shownav', $this->id ? $this->shownav : 1, FALSE, array(), NULL, NULL, NULL, 'fcs_shownav' ) );
		$form->add( new \IPS\Helpers\Form\YesNo( 'fcs_showpage', $this->id ? $this->showpage : 1, FALSE, array(), NULL, NULL, NULL, 'fcs_showpage' ) );			
		$form->add( new \IPS\Helpers\Form\YesNo( 'fcs_keyboard', $this->id ? $this->keyboard : 1, FALSE, array(), NULL, NULL, NULL, 'fcs_keyboard' ) );
		
		$form->add( new \IPS\Helpers\Form\YesNo( 'fcs_ticker', $this->id ? $this->ticker : 0, FALSE, array( 'togglesOff' => array( 'fcs_easing', 'fcs_autoplay', 'fcs_autocontrol', 'fcs_maxSlides', 'fcs_minSlides', 'fcs_duration' ) ), NULL, NULL, NULL, 'fcs_ticker' ) );		
		$form->add( new \IPS\Helpers\Form\Number( 'fcs_maxSlides', ($this->id and $this->maxSlides > 0) ? $this->maxSlides : 5, FALSE, array(), NULL, NULL, NULL, 'fcs_maxSlides' ) );
		$form->add( new \IPS\Helpers\Form\Number( 'fcs_minSlides', ($this->id and $this->minSlides > 0) ? $this->minSlides : 1, FALSE, array(), NULL, NULL, NULL, 'fcs_minSlides' ) );		
		
		$form->add( new \IPS\Helpers\Form\Number( 'fcs_speed', ($this->id and $this->speed > 0) ? $this->speed : 500, FALSE, array(), NULL, NULL, NULL, 'fcs_speed' ) );
		$form->add( new \IPS\Helpers\Form\Number( 'fcs_duration', ($this->id and $this->duration > 0) ? $this->duration : 3000, FALSE, array(), NULL, NULL, NULL, 'fcs_duration' ) );		
		$form->add( new \IPS\Helpers\Form\Select( 'fcs_easing', $this->id ? $this->easing : "none", FALSE, array( 'options' => \IPS\Application::load('featuredcontent')->easingList() ), NULL, NULL, NULL, 'fcs_easing' ) );				
		
		$form->add( new \IPS\Helpers\Form\YesNo( 'fcs_autoplay', $this->id ? $this->autoplay : 1, FALSE, array( 'togglesOn' => array( 'fcs_autocontrol' ) ), NULL, NULL, NULL, 'fcs_autoplay' ) );			
		$form->add( new \IPS\Helpers\Form\YesNo( 'fcs_autocontrol', $this->id ? $this->autocontrol : 1, FALSE, array(), NULL, NULL, NULL, 'fcs_autocontrol' ) );
		
		# Contents
		$form->addTab( 'fcs_tab_content' );
		$form->addHeader( 'fcs_header_content' );	
		$form->add( new \IPS\Helpers\Form\Number( 'fcs_total_items', ($this->id and $this->total_items > 0) ? $this->total_items : 20, FALSE, array(), NULL, NULL, NULL, 'fcs_total_items' ) );	
		$form->add( new \IPS\Helpers\Form\Select( 'fcs_method', $this->id ? $this->method : "noauto", FALSE, array(
			'options' => array(
				'noauto' 	=> 'fcs_method_noauto',
				'cms' 		=> 'fcs_method_cms',				
				'forums' 	=> 'fcs_method_forum',
				'gallery' 	=> 'fcs_method_gallery',
				'downloads' => 'fcs_method_downloads',				
				'videobox' 	=> 'fcs_method_videobox',				
				'rss'		=> 'fcs_method_rss',
			),
			'toggles'	=> array(
				'cms'	=> array(
					'fcs_cms_db',
					'fcs_featured'
				),			
				'forums'	=> array(
					'fcs_forums',
					'fcs_getlastimage',
					'fcs_skiptopicnoimg',
					'fcs_fromtthumb',
					'fcs_featured'
				),
				'gallery'	=> array(
					'fcs_gallery_cat',
					'fcs_featured'
				),
				'downloads'	=> array(
					'fcs_downloads_cat',
					'fcs_featured'
				),
				'videobox'	=> array(
					'fcs_videobox_cat',
					'fcs_featured'
				),					
				'rss'	=> array(
					'fcs_rssURL',
					'fcs_skiptopicnoimg',
				),
			)
		) ) );
				
		/* Pages */
		if ( \IPS\Application::appIsEnabled( 'cms' ) )
		{			
			$fcs_cms_db = array();

			foreach( \IPS\cms\Databases::roots( NULL, NULL ) as $db )
			{
				$fcs_cms_db[ $db->id ] = $db->_title;
				$showCat[ $db->id ] = array( 'fcs_cms_cat_' . $db->id, 'fcs_cms_field_' . $db->id );
				$dbIDs[] = $db->id;
				\IPS\Member::loggedIn()->language()->words['fcs_cms_cat_' . $db->id] = "Categories from " . $db->_title; 
				\IPS\Member::loggedIn()->language()->words['fcs_cms_field_' . $db->id] = "Assign Image from Field"; 
				\IPS\Member::loggedIn()->language()->words['fcs_cms_field_' . $db->id . '_desc'] = "If not selected any field, the record  image will be priority"; 				
			}
		
			if ( !empty( $fcs_cms_db ) )
			{
				$form->add( new \IPS\Helpers\Form\Select( 'fcs_cms_db', explode( ',', $this->cms_db ), FALSE, array( 'options' => $fcs_cms_db, 'toggles' => $showCat, 'multiple' => FALSE ), NULL, NULL, NULL, 'fcs_cms_db' ) );				
				foreach( $dbIDs as $dbID )
				{
					$form->add( new \IPS\Helpers\Form\Node( 'fcs_cms_cat_' . $dbID, ( $this->id and $this->cms_cat != '*' ) ? $this->cms_cat : 0, FALSE, array( 'class' => '\IPS\cms\Categories' . $dbID, 'multiple' => TRUE, 'zeroVal' => 'all'  ), NULL, NULL, NULL, 'fcs_cms_cat_' . $dbID ) );	
					$form->add( new \IPS\Helpers\Form\Select( 'fcs_cms_field_' . $dbID, $this->id ? $this->cms_fieldIMG : 0, FALSE, array( 'options' => $this->getFieldsFromDB($dbID), 'multiple' => FALSE  ), NULL, NULL, NULL, 'fcs_cms_field_' . $dbID ) );	
				}
			}
		}
		else
		{
			$form->add( new \IPS\Helpers\Form\Custom( 'fcs_cms_db', null, FALSE, array( 'getHtml' => function(){
				return "<span style='color:red;'>" . \IPS\Member::loggedIn()->language()->addToStack('fcontent_noCMS') . "</span>";
			} ), function() {}, NULL, NULL, 'fcs_cms_db' ) );
		}
		
		/* Forums */
		if ( \IPS\Application::appIsEnabled( 'forums' ) )
		{		
			$form->add( new \IPS\Helpers\Form\Node( 'fcs_forums', ( $this->id and $this->forums != '*' ) ? $this->forums : 0, FALSE, array( 'clubs' => true, 'class' => 'IPS\forums\Forum', 'multiple' => TRUE, 'zeroVal' => 'all'  ), NULL, NULL, NULL, 'fcs_forums' ) );	
			$form->add( new \IPS\Helpers\Form\YesNo( 'fcs_getlastimage', $this->id ? $this->getlastimage : 0, FALSE, array(), NULL, NULL, NULL, 'fcs_getlastimage' ) );
			$form->add( new \IPS\Helpers\Form\YesNo( 'fcs_skiptopicnoimg', $this->id ? $this->skiptopicnoimg : 0, FALSE, array(), NULL, NULL, NULL, 'fcs_skiptopicnoimg' ) );
			$form->add( new \IPS\Helpers\Form\YesNo( 'fcs_fromtthumb', $this->id ? $this->fromtthumb : 0, FALSE, array(), NULL, NULL, NULL, 'fcs_fromtthumb' ) );
		}
		else
		{
			$form->add( new \IPS\Helpers\Form\Custom( 'fcs_forums', null, FALSE, array( 'getHtml' => function(){
				return "<span style='color:red;'>" . \IPS\Member::loggedIn()->language()->addToStack('fcontent_noForums') . "</span>";
			} ), function() {}, NULL, NULL, 'fcs_forums' ) );
		}
		
		/* Gallery */
		if ( \IPS\Application::appIsEnabled( 'gallery' ) )
		{		
			$form->add( new \IPS\Helpers\Form\Node( 'fcs_gallery_cat', ( $this->id and $this->gallery_cat != '*' ) ? $this->gallery_cat : 0, FALSE, array( 'clubs' => true, 'class' => 'IPS\gallery\Category', 'multiple' => TRUE, 'zeroVal' => 'all'  ), NULL, NULL, NULL, 'fcs_gallery_cat' ) );	
		}
		else
		{
			$form->add( new \IPS\Helpers\Form\Custom( 'fcs_gallery_cat', null, FALSE, array( 'getHtml' => function(){
				return "<span style='color:red;'>" . \IPS\Member::loggedIn()->language()->addToStack('fcontent_noGallery') . "</span>";
			} ), function() {}, NULL, NULL, 'fcs_gallery_cat' ) );
		}
		
		/* Downloads */
		if ( \IPS\Application::appIsEnabled( 'downloads' ) )
		{		
			$form->add( new \IPS\Helpers\Form\Node( 'fcs_downloads_cat', ( $this->id and $this->downloads_cat != '*' ) ? $this->downloads_cat : 0, FALSE, array( 'clubs' => true, 'class' => 'IPS\downloads\Category', 'multiple' => TRUE, 'zeroVal' => 'all'  ), NULL, NULL, NULL, 'fcs_downloads_cat' ) );	
		}
		else
		{
			$form->add( new \IPS\Helpers\Form\Custom( 'fcs_downloads_cat', null, FALSE, array( 'getHtml' => function(){
				return "<span style='color:red;'>" . \IPS\Member::loggedIn()->language()->addToStack('fcontent_noDownloads') . "</span>";
			} ), function() {}, NULL, NULL, 'fcs_downloads_cat' ) );
		}
		
		/* Videobox */
		if ( \IPS\Application::appIsEnabled( 'videobox' ) )
		{		
			$form->add( new \IPS\Helpers\Form\Node( 'fcs_videobox_cat', ( $this->id and $this->videobox_cat != '*' ) ? $this->videobox_cat : 0, FALSE, array( 'clubs' => true, 'class' => 'IPS\videobox\Category', 'multiple' => TRUE, 'zeroVal' => 'all'  ), NULL, NULL, NULL, 'fcs_videobox_cat' ) );	
		}
		else
		{
			$form->add( new \IPS\Helpers\Form\Custom( 'fcs_videobox_cat', null, FALSE, array( 'getHtml' => function(){
				return "<span style='color:red;'>" . \IPS\Member::loggedIn()->language()->addToStack('fcontent_noVideobox') . "</span>";
			} ), function() {}, NULL, NULL, 'fcs_videobox_cat' ) );
		}		
		
		/* RSS */
		$form->add( new \IPS\Helpers\Form\Text( 'fcs_rssURL', $this->id ? $this->rssURL : FALSE, FALSE, array( 'placeholder' => 'http://www.example.com/rss' ), NULL, NULL, NULL, 'fcs_rssURL' ) );
		
		/* Specified contents */	
		$form->add( new \IPS\Helpers\Form\CheckboxSet( 'fcs_featured', $this->featured ? explode( ',', $this->featured ) : array(), FALSE, array(
			'options' => array(
			    'pinned'      	=> 'pinned',
			    'unpinned'      => 'unpinned',
			    'featured'    	=> 'featured',			
			    'unfeatured'    => 'unfeatured',			
			)
		), NULL, NULL, NULL, 'fcs_featured' ) );
	
		/* Sort contents */
		$form->addHeader( 'fcs_header_sorting' );		
		$form->add( new \IPS\Helpers\Form\Select( 'fcs_sortkey', $this->id ? $this->sortkey : "id", FALSE, array(
			'options' => array(
					'id'					=> 'fcs_key_id',
					'start_date' 			=> 'fcs_key_start_date',
					'last_updated' 			=> 'fcs_key_last_updated',
					'title'					=> 'fcs_key_title',
					'views'					=> 'fcs_key_views',
					'rating'				=> 'fcs_key_topic_rating_total',
				) ), NULL, NULL, NULL, 'fcs_sortkey' ) );
	
		$form->add( new \IPS\Helpers\Form\Select( 'fcs_sortby', $this->id ? $this->sortby : "DESC", FALSE, array(
			'options' => array(
				'DESC' 	=> 'fcs_bydesc',
				'ASC' 	=> 'fcs_byasc',
			) ), NULL, NULL, NULL, 'fcs_sortby' ) );	
				
		$form->add( new \IPS\Helpers\Form\YesNo( 'fcs_randomcontent', $this->id ? $this->randomcontent : 0, FALSE ) );


		$form->addHeader( 'fcs_tab_links' );
		$form->add( new \IPS\Helpers\Form\YesNo( 'fcs_nolink', $this->id ? $this->nolink : 0, FALSE, array( 'togglesOff' => array( 'fcs_viewlinkin' ) ) ) );
		$form->add( new \IPS\Helpers\Form\Radio( 'fcs_viewlinkin', $this->id ? $this->viewlinkin : '1', FALSE, array( 'options' => array( '1' => 'fcs_viewin_current', '2' => 'fcs_viewin_page', '3' => 'fcs_viewin_popup' ) ), NULL, NULL, NULL, 'fcs_viewlinkin' ) );		
		
	}
	
	protected function getFieldsFromDB($id)
	{
		$data = array();
		
		$fclass = '\IPS\cms\Fields' . $id;
		$data[0] = '-----------';
		foreach( $fclass::roots() as $f )
		{
			$data[$f->id] = $f->_title;
		}
		
		return $data;
	}
	
	/**
	 * [Node] Save Add/Edit Form
	 *
	 * @param	array	$values	Values from the form
	 * @return	void
	 */
	public function saveForm( $values )
	{
		if ( !$this->id )
		{
			$this->save();
		}
				
		/* Save CMS categories */
		if ( \IPS\Application::appIsEnabled( 'cms' ) && $values['fcs_cms_db'] )
		{		
			foreach( \IPS\cms\Databases::roots( NULL, NULL ) as $db )
			{
				if ( isset( $values[ 'fcs_cms_cat_' . $db->id ] ) && ( $db->id == $values['fcs_cms_db'] ) )
				{
					if ( $values[ 'fcs_cms_cat_' . $db->id ] == 0 )
					{
						$values['fcs_cms_cat'] = '*';
					}
					else 
					{
						$cmscats = array();
						foreach ( $values[ 'fcs_cms_cat_' . $db->id ] as $cat )
						{
							$cmscats[] = $cat->_id;
						}
						
						$values['fcs_cms_cat'] = ( implode( ',', $cmscats ) );
					}

					$values['fcs_cms_fieldIMG'] = $values[ 'fcs_cms_field_' . $db->id ];
				}
				
				unset( $values[ 'fcs_cms_cat_' . $db->id ] );
				unset( $values[ 'fcs_cms_field_' . $db->id ] );
			}
		}
		
		/* Save forums */
		if ( \IPS\Application::appIsEnabled( 'forums' ) && isset( $values['fcs_forums'] ) )
		{
			if ( $values['fcs_forums'] == 0 )
			{
				$values['fcs_forums'] = '*';
			}
			else 
			{
				$forums = array();
				foreach ( (array) $values['fcs_forums'] as $forum )
				{
					$forums[] = $forum->_id;
				}
				
				$values['fcs_forums'] = ( implode( ',', $forums ) );
			}		
		}		
		
		/* Save gallery */
		if ( \IPS\Application::appIsEnabled( 'gallery' ) && isset( $values['fcs_gallery_cat'] ) )
		{
			if ( $values['fcs_gallery_cat'] == 0 )
			{
				$values['fcs_gallery_cat'] = '*';
			}
			else 
			{
				$gcats = array();
				foreach ( (array) $values['fcs_gallery_cat'] as $gcat )
				{
					$gcats[] = $gcat->_id;
				}
				
				if ( \count($gcats) > 0 )
				{
					$values['fcs_gallery_cat'] = implode( ',', $gcats );
				}
			}
		}	
		
		/* Save downloads */
		if ( \IPS\Application::appIsEnabled( 'downloads' ) && isset( $values['fcs_downloads_cat'] ) )
		{
			if ( $values['fcs_downloads_cat'] == 0 )
			{
				$values['fcs_downloads_cat'] = '*';
			}
			else 
			{
				$dcats = array();
				foreach ( (array) $values['fcs_downloads_cat'] as $dcat )
				{
					$dcats[] = $dcat->_id;
				}
				if ( \count($dcats) > 0 )
				{				
					$values['fcs_downloads_cat'] = implode( ',', $dcats );
				}
			}				
		}	
		
		/* Save videobox */
		if ( \IPS\Application::appIsEnabled( 'videobox' ) && isset( $values['fcs_videobox_cat'] ) )
		{
			if ( $values['fcs_videobox_cat'] == 0 )
			{
				$values['fcs_videobox_cat'] = '*';
			}
			else 
			{
				$vcats = array();
				foreach ( (array) $values['fcs_videobox_cat'] as $vcat )
				{
					$vcats[] = $vcat->_id;
				}
				if ( \count($vcats) > 0 )
				{				
					$values['fcs_videobox_cat'] = implode( ',', $vcats );
				}
			}				
		}			
		/* return */
		parent::saveForm( $values );
	}

	/**
	 * [ActiveRecord] Delete Record
	 *
	 * @return	void
	 */
	public function delete()
	{
		\IPS\Db::i()->delete( 'featuredcontent_sliders', array( 'fcs_id=?', $this->id ) );
			
		foreach( \IPS\Db::i()->select( '*', 'featuredcontent_contents', array( 'fcc_slider=?', $this->id ) ) as $slider )
		{
			if ( $slider['fcc_uploadimg'] )
			{
				try
				{
					\IPS\File::get( 'featuredcontent_Image', $slider['fcc_uploadimg'] )->delete();
				}
				catch( \Exception $e ){}
			}
		}		
		
		\IPS\Db::i()->delete( 'featuredcontent_contents', array( 'fcc_slider=?', $this->id ) );	
		
		return parent::delete();
	}
	
	/**
	 * Search
	 *
	 * @param	string		$column	Column to search
	 * @param	string		$query	Search query
	 * @param	string|null	$order	Column to order by
	 * @param	mixed		$where	Where clause
	 * @return	array
	 */
	public static function search( $column, $query, $order=NULL, $where=array() )
	{
		if ( $column === '_title' )
		{
			$column	= 'fcs_title';
		}

		if( $order == '_title' )
		{
			$order	= 'fcs_title';
		}

		return parent::search( $column, $query, $order, $where );
	}
	
	/**
	 * [ActiveRecord] Duplicate
	 *
	 * @return	void
	 */
	public function __clone()
	{
		if( $this->skipCloneDuplication === TRUE )
		{
			return;
		}

		$primaryKey = static::$databaseColumnId;
		$this->$primaryKey = NULL;
		
		$this->_new = TRUE;
		$this->save();
	}	
	
	/*-------------------------------------------------------------------------*/
	// get Contents in slider
	/*-------------------------------------------------------------------------*/		 
	public function getContents()
	{
		$contents = array();
		
		switch ( $this->method )
		{
			case 'cms':
				$contents = $this->fromCMS(); break;
				
			case 'forums':
				$contents = $this->fromForums(); break;
		
			case 'gallery':
				$contents = $this->fromGallery(); break;

			case 'downloads':
				$contents = $this->fromDownloads(); break;

			case 'videobox':
				$contents = $this->fromVideobox(); break;
				
			case 'rss':
				$contents = $this->fromRSS(); break;
				
			case 'noauto':	
			default:
				$contents = $this->fromCustom(); break;
		}
		
		return $contents;
	}

	/*-------------------------------------------------------------------------*/
	// get Contents from Pages (CMS)
	/*-------------------------------------------------------------------------*/		
	protected function fromCMS()
	{
		switch ( $this->sortkey )
		{
			case 'id':
				$sort = "primary_id_field"; break;
				
			case 'start_date':
				$sort = "record_publish_date"; break;
				
			case 'last_updated':
				$sort = "record_last_comment"; break;
											
			case 'title':
				$sort = "record_dynamic_furl"; break;
				
			case 'views':
				$sort = "record_views"; break;
			
			case 'rating':
				$sort = "rating_real"; break;
				
			default:
				$sort = "primary_id_field"; break;
		}		
		
		if ( $this->cms_fieldIMG > 0 )
		{
			$fieldsClass = '\IPS\cms\Fields' . $this->cms_db;
			$fields = $fieldsClass::load( $this->cms_fieldIMG );
		}
		
		$recordClass = 'IPS\cms\Records' . $this->cms_db;
		
		$where[] = array("record_approved=1");
		
		if ( $this->cms_cat !== '*' )
		{
			$where[] = array( "record_approved=1 && category_id IN (". $this->cms_cat .")" );
		}		
		
		if ( !empty( $this->featured ) )
		{
			$status = explode(",", $this->featured );
			if ( \in_array( 'pinned', $status ) )
			{
				$state[] = 'record_pinned=1';
			}
			if ( \in_array( 'unpinned', $status ) )
			{
				$state[] = 'record_pinned=0';
			}			
			if ( \in_array( 'featured', $status ) )
			{
				$state[] = 'record_featured=1';
			}
			if ( \in_array( 'unfeatured', $status ) )
			{
				$state[] = 'record_featured=0';
			}			
			$where[] = array( "(" . implode(" OR ", $state) . ")" );
		}			
		
		$sort = $this->randomcontent == 1 ? "RAND()" : $sort . " " . $this->sortby;
		//$records = $recordClass::getItemsWithPermission( $where, $sort . " " . $this->sortby, $this->total_items );
		foreach( \IPS\Db::i()->select( '*', 'cms_custom_database_' . $this->cms_db, $where, $sort, array( 0, $this->total_items ) ) as $k => $r )
		{		
			try
			{		
				$row = $recordClass::constructFromData( $r );			

				if ( $fields )
				{
					$fieldIMG = "field_" . $this->cms_fieldIMG;
					
					if ($fields->type == 'Upload')
					{
						if ( $fields->is_multiple == 1 )
						{
							$imgs_ = explode(",", $row->$fieldIMG);
							$imgFromField = $imgs_[0];
						}
						else
						{
							$imgFromField = $row->$fieldIMG;
						}
						
						$image = $imgFromField ? (string) \IPS\File::get( 'cms_Records', $imgFromField )->url : null;
					}
					else
					{
						$image = $this->getImageURL( $row->$fieldIMG );
					}
				}
				else
				{
					$image = $row->record_image ? (string) \IPS\File::get( 'cms_Records', $row->record_image )->url : $this->getImageURL($row->content());
				}

				$data[$k] = array( 	'image'  	=> $this->getThumbnail($image),
									'title'  	=> $row->_title,
									'url'	 	=> (string) $row->url( 'getNewComment' ),
									'author' 	=> $row->author(),
									'tag'		=> \count($row->tags()) ? $row->tags()[0] : null,
									'rating'	=> $row->rating,
									'views'		=> $row->views,
									'comments'	=> $row->comments,
									'content'	=> $this->cutText($row->content(),200),
									'date'		=> $row->record_saved,
									'id'		=> $row->primary_id_field,
								);
			}
			catch( \LogicException $ex )
			{
			}
		}
		return $data;
	}
	
	/*-------------------------------------------------------------------------*/
	// get Contents from Forums
	/*-------------------------------------------------------------------------*/		
	protected function fromForums()
	{
		switch ( $this->sortkey )
		{
			case 'id':
				$sort = "tid"; break;
				
			case 'start_date':
				$sort = "start_date"; break;
				
			case 'last_updated':
				$sort = "last_real_post"; break;
											
			case 'title':
				$sort = "title"; break;
				
			case 'views':
				$sort = "views"; break;
			
			case 'rating':
				$sort = "topic_rating_total"; break;
				
			default:
				$sort = "tid"; break;
		}
		
		$where[] = array( "approved=1 AND topic_archive_status!=1" );
		
		if ( $this->forums !== '*' )
		{
			$where[] = array( "forum_id IN (" . $this->forums . ")" );
		}

		if ( !empty( $this->featured ) )
		{
			$status = explode(",", $this->featured );
			if ( \in_array( 'pinned', $status ) )
			{
				$state[] = 'pinned=1';
			}
			if ( \in_array( 'unpinned', $status ) )
			{
				$state[] = 'pinned=0';
			}			
			if ( \in_array( 'featured', $status ) )
			{
				$state[] = 'featured=1';
			}
			if ( \in_array( 'unfeatured', $status ) )
			{
				$state[] = 'featured=0';
			}			
			$where[] = array( "(" . implode(" OR ", $state) . ")" );
		}	

		$sort = $this->randomcontent == 1 ? "RAND()" : $sort . " " . $this->sortby;
		
		$tlimit = $this->skiptopicnoimg == 1 ? $this->total_items * 10 : $this->total_items;
		
		$num = 0;
		
		foreach ( \IPS\forums\Topic::getItemsWithPermission( $where, $sort, $tlimit ) as $k => $topic )
		{
			if ( $this->fromtthumb == 1 && method_exists($topic,'tthumb_show') )
			{
				if ( !$topic->topic_thumbnail || $topic->topic_thumbnail == 'no' || mb_stripos($topic->topic_thumbnail, "://") !== false )
				{
					$thumb = $topic->tthumb_show();  // Cho topic thumbnail plugin phien ban cu
				}
				else $thumb = $topic->tthumb_show(1);
				$topicThumbnail_noimg = \IPS\Settings::i()->bim_tthumb_defaultimg ? (string) \IPS\File::get( 'core_Theme', \IPS\Settings::i()->bim_tthumb_defaultimg )->url : (string) \IPS\Theme::i()->resource( 'plugins/noThumb.png', 'core', 'global' );
				if ( $thumb == $topicThumbnail_noimg )
				{
					$thumb = null;
				}
			}
			else
			{
				$postcontent = $this->getlastimage != 1 ? $topic->content() : $topic->comments( 1, 0, 'date', 'DESC' )->post;
				$thumb = $this->getImageURL( $postcontent );
			}

			if ( $this->skiptopicnoimg == 1 )
			{
				if ( $thumb == null )
				{
					continue;
				}

				$num++;
				
				if ( $num >= $this->total_items )
				{
					break;
				}
			}
			
			$data[$k] = array( 	'image'  	=> $this->getThumbnail($thumb),
								'title'  	=> $topic->title,
								'url'	 	=> $re[0]['id2'] ? (string) $topic->url()->setQueryString( array( 'do' => 'findComment', 'comment' => $re[0]['id2'] ) ) : (string) $topic->url(),
								'author' 	=> $topic->author(),
								'tag'		=> \count($topic->tags()) ? $topic->tags()[0] : null,	
								'rating'	=> $topic->rating,										
								'views'		=> $topic->views,
								'comments'	=> $topic->posts - 1,
								'content'	=> $this->cutText($topic->content(),200),
								'date'		=> $topic->start_date,
								'id'		=> $topic->tid,
							);
		}			

		return $data;
	}

	/*-------------------------------------------------------------------------*/
	// get Contents from Gallery
	/*-------------------------------------------------------------------------*/		
	protected function fromGallery()
	{
		switch ( $this->sortkey )
		{
			case 'id':
				$sort = "image_id"; break;
				
			case 'start_date':
				$sort = "image_date"; break;
				
			case 'last_updated':
				$sort = "image_updated"; break;
											
			case 'title':
				$sort = "image_caption"; break;
				
			case 'views':
				$sort = "image_views"; break;
			
			case 'rating':
				$sort = "image_ratings_total"; break;
				
			default:
				$sort = "image_id"; break;
		}		
		
		$where[] = array("image_approved=1");
		
		if ( $this->gallery_cat !== '*' )
		{
			$where[] = array("image_category_id IN (". $this->gallery_cat .")");
		}
		
		if ( !empty( $this->featured ) )
		{
			$status = explode(",", $this->featured );
			if ( \in_array( 'pinned', $status ) )
			{
				$state[] = 'image_pinned=1';
			}
			if ( \in_array( 'unpinned', $status ) )
			{
				$state[] = 'image_pinned=0';
			}			
			if ( \in_array( 'featured', $status ) )
			{
				$state[] = 'image_feature_flag=1';
			}
			if ( \in_array( 'unfeatured', $status ) )
			{
				$state[] = 'image_feature_flag=0';
			}			
			$where[] = array( "(" . implode(" OR ", $state) . ")" );
		}
		
		$sort = $this->randomcontent == 1 ? "RAND()" : $sort . " " . $this->sortby;
		
		foreach ( \IPS\gallery\Image::getItemsWithPermission( $where, $sort, $this->total_items ) as $k => $image )
		{
			try
			{			
				$file = $image->medium_file_name? $image->medium_file_name : $image->original_file_name;
				$thumb = (string) \IPS\File::get( 'gallery_Images', $file )->url;
			}
			catch( \Exception $e ) {}				
			$data[$k] = array( 	'image'  	=> $this->getThumbnail($thumb),
								'title'  	=> $image->caption,
								'url'	 	=> (string) $image->url(),
								'author' 	=> $image->author(),
								'tag'		=> \count($image->tags()) ? $image->tags()[0] : null,	
								'rating'	=> $image->rating,										
								'views'		=> $image->views,
								'comments'	=> $image->comments,
								'content'	=> $this->cutText($image->content(),200),
								'date'		=> $image->date,
								'id'		=> $image->id,
							);
		}
		return $data;
	}
	
	
	/*-------------------------------------------------------------------------*/
	// get Contents from Downloads
	/*-------------------------------------------------------------------------*/	
	protected function fromDownloads()
	{
		switch ( $this->sortkey )
		{
			case 'id':
				$sort = "file_id"; break;
				
			case 'start_date':
				$sort = "file_submitted"; break;
				
			case 'last_updated':
				$sort = "file_updated"; break;
											
			case 'title':
				$sort = "file_name"; break;
				
			case 'views':
				$sort = "file_views"; break;
			
			case 'rating':
				$sort = "file_rating"; break;
				
			default:
				$sort = "file_id"; break;
		}		
		
		$where[] = array( "file_open=1" );
		
		if ( $this->downloads_cat !== '*' )
		{
			$where[] = array( "file_cat IN (". $this->downloads_cat .")" );
		}
	
		if ( !empty( $this->featured ) )
		{
			$status = explode(",", $this->featured );
			if ( \in_array( 'pinned', $status ) )
			{
				$state[] = 'file_pinned=1';
			}
			if ( \in_array( 'unpinned', $status ) )
			{
				$state[] = 'file_pinned=0';
			}			
			if ( \in_array( 'featured', $status ) )
			{
				$state[] = 'file_featured=1';
			}
			if ( \in_array( 'unfeatured', $status ) )
			{
				$state[] = 'file_featured=0';
			}			
			$where[] = array( "(" . implode(" OR ", $state) . ")" );
		}	
				
		$sort = $this->randomcontent == 1 ? "RAND()" : $sort . " " . $this->sortby;
		
		foreach( \IPS\downloads\File::getItemsWithPermission( $where, $sort, $this->total_items ) as $k => $file )
		{
			try
			{
				$image = (string) \IPS\File::get( 'downloads_Screenshots', $file->primary_screenshot )->url;
			}
			catch( \Exception $e ) {}
			$data[$k] = array( 	'image'  	=> $this->getThumbnail($image),
								'title'  	=> $file->name,
								'url'	 	=> (string) $file->url(),
								'author' 	=> $file->author(),
								'tag'		=> \count($file->tags()) ? $file->tags()[0] : null,	
								'rating'	=> $file->rating,										
								'views'		=> $file->views,
								'comments'	=> $file->comments,
								'content'	=> $this->cutText($file->content(),200),
								'date'		=> $file->submitted,
								'id'		=> $file->id,
							);
		}
		return $data;		
	}
	
	/*-------------------------------------------------------------------------*/
	// get Contents from Videobox
	/*-------------------------------------------------------------------------*/	
	protected function fromVideobox()
	{
		switch ( $this->sortkey )
		{
			case 'id':
				$sort = "v_id"; break;
				
			case 'start_date':
				$sort = "v_started"; break;
				
			case 'last_updated':
				$sort = "v_updated"; break;
											
			case 'title':
				$sort = "v_title"; break;
				
			case 'views':
				$sort = "v_views"; break;
			
			case 'rating':
				$sort = "v_rating_average"; break;
				
			default:
				$sort = "v_id"; break;
		}		
		
		$where[] = array( "v_open=1" );
		
		if ( $this->videobox_cat !== '*' )
		{
			$where[] = array( "v_cat IN (". $this->videobox_cat .")" );
		}
	
		if ( !empty( $this->featured ) )
		{
			$status = explode(",", $this->featured );
			if ( \in_array( 'pinned', $status ) )
			{
				$state[] = 'v_pinned=1';
			}
			if ( \in_array( 'unpinned', $status ) )
			{
				$state[] = 'v_pinned=0';
			}			
			if ( \in_array( 'featured', $status ) )
			{
				$state[] = 'v_featured=1';
			}
			if ( \in_array( 'unfeatured', $status ) )
			{
				$state[] = 'v_featured=0';
			}			
			$where[] = array( "(" . implode(" OR ", $state) . ")" );
		}	
				
		$sort = $this->randomcontent == 1 ? "RAND()" : $sort . " " . $this->sortby;
		
		foreach( \IPS\videobox\Video::getItemsWithPermission( $where, $sort, $this->total_items ) as $k => $video )
		{
			$data[$k] = array( 	'image'  	=> $this->getThumbnail($video->thumbnail('medium')),
								'title'  	=> $video->title,
								'url'	 	=> (string) $video->url(),
								'author' 	=> $video->author(),
								'tag'		=> \count($video->tags()) ? $video->tags()[0] : null,	
								'rating'	=> $video->rating_average,										
								'views'		=> $video->views,
								'comments'	=> $video->comments,
								'content'	=> $this->cutText($video->content(),200),
								'date'		=> $video->started,
								'id'		=> $video->id,
							);
		}
		return $data;		
	}	
	
	/*-------------------------------------------------------------------------*/
	// get Contents from RSS
	/*-------------------------------------------------------------------------*/		
	protected function fromRSS()
	{
		$data = array();
		
		if ( !$this->rssURL )
		{
			return '';
		}
		try
		{
			$request = \IPS\Http\Url::external( $this->rssURL )->request()->get();
			$content = $request->content;
			$request = $request->decodeXml();
		}
		catch ( \IPS\Http\Url\Exception $e ){}
		catch ( \IPS\Http\Exception $e ) {}
		catch( \IPS\Http\Request\Exception $e ) {}
		catch( \RuntimeException $e ) {}

		if ( mb_stripos( $content, "<content:encoded>" ) !== false )
		{
			$rss = new \DOMDocument();
			$rss->loadXML($content);
			$i = 0;
			foreach ($rss->getElementsByTagName('item') as $node) 
			{
				if ( $this->skiptopicnoimg == 1 || !$node->getElementsByTagName('title')->item(0)->nodeValue)
				{
					if ( $this->getImageURL($node->getElementsByTagName('encoded')->item(0)->nodeValue) == $this->noImageURL() )
					{
						continue;
					}
				}
				$image = $this->getImageURL($node->getElementsByTagName('encoded')->item(0)->nodeValue);
				$data[] = array (
						'image'		=> $this->getThumbnail($image),
						'title' 	=> $node->getElementsByTagName('title')->item(0)->nodeValue,
						'url' 		=> $node->getElementsByTagName('link')->item(0)->nodeValue
				);
			}
		}
		else
		{
			if ( \count( $request ) > 0 )
			{
				if ( $request instanceof \IPS\Xml\Atom )
				{
					$i = 0;

					foreach ( $request as $entry )
					{
						if ( $this->skiptopicnoimg == 1 || !$entry->title)
						{
							if ( $this->getImageURL( (string) $entry->content ) == $this->noImageURL() )
							{
								continue;
							}
						}
						
						$data[] = $entry;
						
						if ( $i++ == $this->total_items )
						{
							break;
						}				
					}
					
					if ( \count($data) > 0 )
					{
						foreach ( $data as $k => $entry )
						{
							$image = $this->getImageURL( (string) $entry->content );
							$data[$k] = array( 	'image'  => $this->getThumbnail($image),
												'title'  => (string) $entry->title,
												'url'	 => $entry->link['href'] ? $entry->link['href'] : (string) $entry->link,
											);		
						}
					}
				}
				else
				{
					$i = 0;
					foreach ( $request->channel->item as $entry )
					{
						if ( $this->skiptopicnoimg == 1 || !$entry->title)
						{
							if ( $this->rssIMG($entry) == $this->noImageURL() )
							{
								continue;
							}
						}
						
						$data[] = $entry;
						
						if ( $i++ == $this->total_items )
						{
							break;
						}				
					}
					
					if ( \count($data) > 0 )
					{
						foreach ( $data as $k => $entry )
						{
							$image = $this->rssIMG($entry);
							$data[$k] = array( 	'image'  => $this->getThumbnail($image), 
												'title'  => (string) $entry->title,
												'url'	 => (string) $entry->link,
											);		
						}
					}
				}

			}
		}
		
		if ( $this->randomcontent == 1 && \count($data) > 0)
		{
			shuffle($data);
		}		
		
		return $data;
	}
	
	protected function rssIMG($entry)
	{
		if ( $thumbAttr = $entry->children('media', true) )
		{
			$thumbAttr = $thumbAttr->content->attributes();
			return $thumbAttr['url'];
		}
		if ( isset($entry->enclosure) )
		{
			return $entry->enclosure->attributes()->url;
		}
		else return $this->getImageURL( (string) $entry->description );
	}
	
	/*-------------------------------------------------------------------------*/
	// get Contents Manually
	/*-------------------------------------------------------------------------*/		
	protected function fromCustom()
	{
		switch ( $this->sortkey )
		{
			case 'id':
				$sort = "fcc_position"; break;
				
			case 'start_date':
				$sort = "fcc_id"; break;
				
			case 'last_updated':
				$sort = "fcc_id"; break;
											
			case 'title':
				$sort = "fcc_title"; break;
				
			case 'views':
				$sort = "fcc_position"; break;
			
			case 'rating':
				$sort = "fcc_position"; break;
				
			default:
				$sort = "fcc_position"; break;
		}	
		
		$sort = $this->randomcontent == 1 ? "RAND()" : $sort . " " . $this->sortby;
		
		foreach ( \IPS\Db::i()->select( '*', 'featuredcontent_contents', "fcc_slider=" . $this->id, $sort, array( 0, $this->total_items ) ) as $k => $row )
		{
			$img = $row['fcc_imageFrom'] == 'upload' ? (string) \IPS\File::get( 'featuredcontent_Image', $row['fcc_uploadimg'] )->url : $row['fcc_image'];
			
			$data[$k] = array( 	'image'  		=> $this->getThumbnail($img),
								'title'  		=> strip_tags( $row['fcc_title'] ),
								'url'	 		=> $row['fcc_url'],
								'id'	 		=> $row['fcc_id'],
								'moderators'	=> $row['fcc_moderators'],
								'newtab'		=> $row['fcc_newtab'],
							);
		}
		return $data;	
	}
	
	/*-------------------------------------------------------------------------*/
	// Get first image in first post
	/*-------------------------------------------------------------------------*/		
	public function getImageURL($txt)
	{
		if ( \IPS\Settings::i()->lazy_load_enabled )
		{
			preg_match_all( '~<img[^>]*(?<!_mce_)data-src\s?=\s?([\'"])((?:(?!\1).)*)[^>]*>~i', $txt, $match );
		}
		else
		{
			preg_match_all( '~<img[^>]*(?<!_mce_)src\s?=\s?([\'"])((?:(?!\1).)*)[^>]*>~i', $txt, $match );
		}		
		
		for ( $e = 0 ; $e < \count($match[0]) ; $e++ )
		{
			if ( mb_strpos( $match[2][$e], 'fileStore.core_Emoticons' ) === false )
			{
				$_img = $this->tthumbGetRealIMG($match[2][$e]);
				if ( \IPS\Settings::i()->fcontent_ignoreurls )
				{
					if ( ! $this->isIgnoreUrl($_img) )
					{
						$images[] = $_img;
					}
				}
				else
				{
					$images[] = $_img;
				}
			}
		}

		if ( \count($images) > 0 )
		{
			if ($this->getlastimage == 1)
			{
				$images = array_reverse($images);
			}
			return $images[0];
		}
		
		if ( preg_match( '/\[photo=(.+?)\](.+?)\[\/photo\]/i', $txt, $match ) )
		{
			return strip_tags($match[1]);	
		}
		
		if ( preg_match( '/<iframe.*src=\"(.*)\".*><\/iframe>/isU', $txt, $match ) )
		{
			return $this->videoIMG($match[1]);	
		}
		
		return null;
	}
	
	protected function isIgnoreUrl($url)
	{
		$iglist = array();
		
		$iglist = explode( "\n", str_replace( "\r", "", \IPS\Settings::i()->fcontent_ignoreurls ) );
		$iglist = array_filter($iglist);
		
		$return = false;
		
		if ( \count($iglist) > 0 )
		{
			foreach( $iglist as $u )
			{
				if (mb_strpos($url, $u) !== FALSE)
				{
					$return = true;
					break;
				}
			}
		}
		return $return;
	}
	
	protected function tthumbGetRealIMG($txt)
	{
		$txt = str_replace("fileStore.core_Emoticons", "", $txt);
		$txt = str_replace("fileStore.core_Attachment", "", $txt);
		$txt = str_replace("<>", "", $txt);			
		$txt = str_replace("%3C%3E", "", $txt);
		$txt = str_replace( '<___base_url___>', rtrim( \IPS\Settings::i()->base_url, '/' ), $txt );
		$txt = str_replace( '&lt;___base_url___&gt;', rtrim( \IPS\Settings::i()->base_url, '/' ), $txt );
		
		if ( \IPS\File::get( 'core_Attachment', $txt )->originalFilename ) 
		{
			$txt = (string) \IPS\File::get( 'core_Attachment', $txt )->url;
		}

		# Fix double slashes
		if ( mb_strpos($txt, 'imageproxy.php') === false )
		{		
			$parts = explode('//', $txt, 2);
			$parts[1] = rtrim(preg_replace('@/+@', '/', $parts[1]), '/');
			$txt = implode('//', $parts);
			unset($parts);
		}
		
		# Remove double slashes at the end
		if (mb_strpos($txt, "fileStore.") !== false || mb_strpos($txt, "___base_url___") !== false)
		{
			$txt = rtrim($txt,"/");
		}		
		
		# Done
		return $txt;
	}
	
	/*-------------------------------------------------------------------------*/
	// Show video thumbnail ( support youtube & vimeo )
	/*-------------------------------------------------------------------------*/	
	protected function videoIMG( $txt )
	{
		if ( preg_match( '#^(?:https?://)?(?:www\.)?(?:m\.)?(?:youtu\.be/|youtube\.com(?:/embed/|/v/|/watch\?v=|/watch\?.+&v=))([\w-]{11})(?:.+)?$#x', $txt, $match ) )
		{
			$thumb = "https://i2.ytimg.com/vi/{$match[1]}/0.jpg";
		}
		elseif ( preg_match('/https?:\/\/(.+)?(wistia.com|wi.st|net)\/(medias|embed)\/(.*)\/(.*)/', $txt, $match ) )
		{
			$wID = $match[5];
			$url = "http://fast.wistia.com/oembed?url=http://home.wistia.com/medias/" . $wID;
			$wData = \IPS\Http\Url::external( $url )->request()->get()->decodeJson();
			$img = explode("?", $wData['thumbnail_url']);
			$width = $this->img_w ? $this->img_w : 310;
			$height = $this->img_h ? $this->img_h : 210;
			$thumb = $img[0] . "?image_crop_resized=" . $width . "x" . $height;
		}
		elseif ( preg_match( "/vimeo.com\/([1-9.-_]+)/", $txt, $match ) || preg_match( "/vimeo.com\/video\/([1-9.-_]+)/", $txt, $match ) )
		{
			$vurls = explode( "/", $txt );
			$vmid = $vurls[ \count( $vurls ) - 1 ];
			$url = "http://vimeo.com/api/v2/video/{$vmid}.json";
			$request = \IPS\Http\Url::external( $url )->request()->get();
			$output = json_decode($request);
			$output = $output[0];
			$thumb = $output->thumbnail_large;	
		}	
		return $thumb;
	}	

	/*-------------------------------------------------------------------------*/
	// truncateText
	/*-------------------------------------------------------------------------*/
	protected function truncateText( $text )
	{	
		if ( mb_strlen($text) > $this->truncate )
		{
			$text = $text." ";
			$text = mb_substr($text, 0, $this->truncate);
			$text = mb_substr($text, 0, mb_strrpos($text,' '));
			$text = $text."...";			
		}
		return $text;
	}	

	protected function cutText( $text, $chars )
	{	
		$text = strip_tags($text);
		if ( mb_strlen($text) > $chars )
		{
			$text = $text." ";
			$text = mb_substr($text, 0, $chars);
			$text = mb_substr($text, 0, mb_strrpos($text,' '));
			$text = $text."...";			
		}
		return $text;
	}	
	
	
	/*-------------------------------------------------------------------------*/
	// NoImageURL
	/*-------------------------------------------------------------------------*/
	protected function noImageURL()
	{
		return $this->noimg ? (string) \IPS\File::get( 'core_Theme', $this->noimg )->url : (string) \IPS\Theme::i()->resource( 'noThumb.png', 'featuredcontent' );
	}
		
	/*-------------------------------------------------------------------------*/
	// Cache Image
	/*-------------------------------------------------------------------------*/	
	protected function getThumbnail($img)
	{
		if ( !$img || $img == $this->noImageURL() )
		{
			return $this->noImageURL();
		}

		if ( \IPS\Settings::i()->fcontent_resizerMode == "none" )
		{
			return $img;
		}
		
		if ( mb_strpos($img, 'imageproxy.php') !== false )
		{
			$parts = parse_url($img);
			parse_str($parts['query'], $query);	
			$img = $query['img'];
		}

		if ( \IPS\Settings::i()->fcontent_resizerMode == "script" )
		{
			if ( \IPS\Settings::i()->fcontent_imageOnTheFly && $this->img_w > 0 && $this->img_h > 0 )
			{
				$script_url = str_replace("{width}", $this->img_w, \IPS\Settings::i()->fcontent_imageOnTheFly );
				$script_url = str_replace("{height}", $this->img_h, $script_url );	
				$script_url = str_replace("{url}", $img, $script_url );
				return $script_url;
			}
			return preg_replace('#^https?:#', '', $img);
		}
		else
		{
			$img = $this->addScheme($img);
			$urlAsName = preg_replace("(^https?://)", "", urldecode($img) );
			$urlAsName = str_replace("/", "-", $urlAsName);
			$urlAsName = str_replace(".", "_", $urlAsName);
			$urlAsName = $urlAsName . "-" . $this->img_w . "x" . $this->img_h . ".jpg";

			try
			{		
				$cache = \IPS\File::get( 'featuredcontent_Image', "fcontentCache/" . $urlAsName );
				$cacheFileSize = $cache->filesize();
			}
			catch( \OutOfRangeException $ex )
			{
				$cacheFileSize = 0;
			}			
			
			if ($cacheFileSize > 0)
			{
				$image = (string) $cache->url;
			}
			else
			{
				$content = $this->resizeImage($img);
				if ( $content )
				{
					$newCache = \IPS\File::create( 'featuredcontent_Image', $urlAsName, $content, 'fcontentCache', false, null, false );
					$image = (string) $newCache->url;
				}
				else
				{
					$image = $this->noImageURL();
				}
			}
			return $image;			
		}
	}
	
	protected function addScheme($url)
	{
		if ( mb_substr($url, 0, 2) == "//" )
		{
			return "http:" . $url;
		}
		return $url;
	}
	
	protected function resizeImage($file)
	{
		$imageQuality = 85;
		$newWidth = $this->img_w;
		$newHeight = $this->img_h;
		$extension = mb_strtolower(mb_strrchr($file, '.'));

		switch($extension)
		{
			case '.jpg':		
			case '.jpeg':
				if ( mb_stripos($file, "https") !== false )		// Sua loi ko hoat dong voi https img
				{
					$img = @imagecreatefromstring($this->getImageRawData($file));
				}
				else
				{
					$img = @imagecreatefromjpeg($file);
				}
				break;	
			case '.gif':
				$img = @imagecreatefromgif($file);
				break;
			case '.png':
				$img = @imagecreatefrompng($file);
				break;
			default:
				$img = @imagecreatefromstring($this->getImageRawData($file));
				break;
		}

		if ($img) 
		{		
			$width  = imagesx($img);
			$height = imagesy($img);

			$heightRatio = $height / $newHeight;
			$widthRatio  = $width /  $newWidth;

			if ($heightRatio < $widthRatio) 
			{
				$optimalRatio = $heightRatio;
			} 
			else 
			{
				$optimalRatio = $widthRatio;
			}
			
			$optimalHeight = $height / $optimalRatio;
			$optimalWidth  = $width  / $optimalRatio;
			
			$imageResized = imagecreatetruecolor($optimalWidth, $optimalHeight);
			imagecopyresampled($imageResized, $img, 0, 0, 0, 0, $optimalWidth, $optimalHeight, $width, $height);

			# Crop image
			$cropStartX = ( $optimalWidth / 2) - ( $newWidth /2 );
			$cropStartY = ( $optimalHeight/ 2) - ( $newHeight/2 );
			$crop = $imageResized;
			$imageResized = imagecreatetruecolor($newWidth , $newHeight);
			imagecopyresampled($imageResized, $crop , 0, 0, $cropStartX, $cropStartY, $newWidth, $newHeight , $newWidth, $newHeight);
			
			# Save image
			ob_start();

			switch($extension)
			{
				default:
				case '.jpg':
				case '.jpeg':
					if (imagetypes() & IMG_JPG) {
						imagejpeg($imageResized, NULL, $imageQuality);
					}
					break;
				case '.gif':
					if (imagetypes() & IMG_GIF) {
						imagegif($imageResized, NULL);
					}
					break;
				case '.png':
					$scaleQuality = round(($imageQuality/100) * 9);
					$invertScaleQuality = 9 - $scaleQuality;
					if (imagetypes() & IMG_PNG) {
						 imagepng($imageResized, NULL, $invertScaleQuality);
					}
					break;
			}
			
			# Return the file content
			$content = ob_get_clean();
			imagedestroy($imageResized);
		}
		
		return $content;
	}
	
	protected function getImageRawData($image_url) 
	{
		if ( \function_exists('curl_init') ) 
		{
			$ch = \curl_init();
			$timeout = 5;
			curl_setopt($ch, CURLOPT_URL, $image_url);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);	
			$content = curl_exec($ch);
			curl_close($ch);
		}
		elseif ( ini_get('allow_url_fopen') ) 
		{
			$content = @file_get_contents($image_url);
		}
		return $content;
	}

	/**
	 * Get the associated club
	 *
	 * @return	\IPS\Member\Club|NULL
	 */
	public function club()
	{
		return NULL;
	}	
}