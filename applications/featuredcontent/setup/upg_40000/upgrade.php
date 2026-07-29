<?php


namespace IPS\featuredcontent\setup\upg_40000;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * 4.0.0 Upgrade Code
 */
class _Upgrade
{
	/**
	 * ...
	 *
	 * @return	array	If returns TRUE, upgrader will proceed to next step. If it returns any other value, it will set this as the value of the 'extra' GET parameter and rerun this step (useful for loops)
	 */
	public function step1()
	{
		if( \IPS\Db::i()->checkForTable( 'fcontent_slideshow' ) === true )
		{
			foreach ( \IPS\Db::i()->select( '*', 'fcontent_slideshow' ) as $slider )
			{
				# Import old sliders
				$insertId = \IPS\Db::i()->insert( 	'featuredcontent_sliders', array(
													'fcs_enabled'		=> $slider['slideshow_enable'],
													'fcs_title'			=> $slider['slideshow_name'],
													'fcs_style'			=> $slider['slideshow_style'],
													'fcs_total_items'	=> $slider['slideshow_total_items'],
													'fcs_maxSlides'		=> $slider['slideshow_maxSlides'],
													'fcs_minSlides'		=> $slider['slideshow_minSlides'],
													'fcs_img_w'			=> $slider['slideshow_img_w'] ? $slider['slideshow_img_w'] : 250,
													'fcs_img_h'			=> $slider['slideshow_img_h'] ? $slider['slideshow_img_h'] : 160,
													'fcs_speed'			=> $slider['slideshow_speed'],
													'fcs_duration'		=> $slider['slideshow_duration'],
													'fcs_method'		=> $slider['slideshow_method'],
													'fcs_forums'		=> $slider['slideshow_forums'],
													'fcs_sortkey'		=> $slider['slideshow_sortkey'],
													'fcs_sortby'		=> $slider['slideshow_sortby'],
													'fcs_rssURL'		=> $slider['slideshow_rssURL'],
													'fcs_position'		=> 1,
													'fcs_bitoptions'	=> 31,
												) );
				
				# Add permissions
				$permissions	= array( 'app'			=> 'featuredcontent',
										 'perm_type'	=> 'slider',
										 'perm_type_id'	=> $insertId,
										 'perm_view'	=> '*',
										 'perm_3'		=> 4,
										);
				\IPS\Db::i()->insert( 'core_permission_index', $permissions );	
				
				# Add contents
				if ( !\in_array( $slider['fcs_method'], array('rss', 'forums') ) )
				{
					$cnt = 0;
					
					foreach ( \IPS\Db::i()->select( '*', 'fcontent', array( 'f_slideshow=?', $slider['ssid'] ), 'f_order1 DESC' ) as $content )
					{
						$cnt++;
						if ( mb_strpos($content['f_URL'], "http") === false && $content['f_tid'] > 0 )
						{
							$url = \IPS\Http\Url::internal( "app=forums&module=forums&controller=topic&id={$content['f_tid']}", 'front', 'forums_topic', array( $content['f_URL'] ) );
						}
						else
						{
							$url = $content['f_URL'];
						}
						\IPS\Db::i()->insert( 'featuredcontent_contents', array(
							'fcc_slider'		=> $insertId,
							'fcc_image'			=> $content['f_imageURL'],
							'fcc_url'			=> $url,
							'fcc_title'			=> $content['f_name'],
							'fcc_position'		=> $cnt,
						) );							
					}
				}
			}
			\IPS\Db::i()->dropTable( 'fcontent_slideshow' );
			\IPS\Db::i()->dropTable( 'fcontent' );
		}

		return TRUE;
	}
	
	// You can create as many additional methods (step2, step3, etc.) as is necessary.
	// Each step will be executed in a new HTTP request
}