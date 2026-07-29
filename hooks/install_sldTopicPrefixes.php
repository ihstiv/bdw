<?php
/**
 * @package		Advanced Tags & Prefixes
 * @author		Ryan Hoerr
 * @copyright	(c) 2012 Ryan Hoerr / Sublime Development
 * @license		http://www.sublimism.com/products/terms-of-use
 * @version		$Id: topic_prefixes.xml 40 2013-07-30 04:12:33Z No1_1000 $
 * @updated		$Date: 2013-07-30 00:12:33 -0400 (Tue, 30 Jul 2013) $
 */

/**
 * Topic Prefixes: Run the upgrade process when first
 * installing the new application.
 */

class sldTopicPrefixes
{
	protected $registry;
	protected $DB;
	protected $settings;
	protected $_output	= array();
	
	public function install()
	{
		$this->registry = ipsRegistry::instance();
		$this->DB       =  $this->registry->DB();
		$this->settings =& $this->registry->fetchSettings();

		$prefixesFound	= $this->DB->checkForField( 'topic_prefix', 'topics' );
		$appInstalled	= $this->DB->checkForField( 'default_tags', 'forums' );

		/**
		 * Was Topic Prefixes installed before? Do we need to update to the app?
		 * This is quite query-intensive!
		 */
		if( $prefixesFound && !$appInstalled ) {
			/**
			 * Yes -- update various settings and records per tags.
			 */
			$this->_output[] = "Existing Topic Prefixes installation found!";
			

			/**
			 * Fetch prefix data
			 */
			$this->DB->build( array(	'select'	=> '*',
										'from'		=> 'topic_prefixes' ) );
			$this->DB->execute();
			while( $r = $this->DB->fetch() ) {
				$prefixes[ $r['prefix_id'] ] = $r;
				$prefixesByName[ IPSText::mbstrtolower( $r['prefix_title'] ) ] = $r;
			}
			

			/**
			 * Convert topic prefixes to tags.
			 */
			
			/* Load tagging stuff */
			if ( ! $this->registry->isClassLoaded('tags') )
			{
				require_once( IPS_ROOT_PATH . 'sources/classes/tags/bootstrap.php' );/*noLibHook*/
				$this->registry->setClass( 'tags', classes_tags_bootstrap::run( 'forums', 'topics' ) );
			}
			$_REQUEST['ipsTags_prefix'] = 1;

			$insert	= array();
			$count	= 0;
			$this->DB->build( array(	'select'	=> '*',
										'from'		=> 'topics',
										'where'		=> 'topic_prefix != 0' ) );
			$q = $this->DB->execute();
			while( $r = $this->DB->fetch($q) ) {
				/**
				 * Get topic tags
				 */
				$tags = $this->registry->getClass('tags')->getTagsByMetaId( array( 'meta_id' => $r['tid'] ) );

				if( !count($tags) ) {
					$tags = array( 'tags' => array() );
				}

				/**
				 * Prepend and send back.
				 */
				array_unshift( $tags['tags'], $prefixes[ $r['topic_prefix'] ]['prefix_title'] );
				$this->registry->getClass('tags')->replace( $tags['tags'], array(	'meta_id'			=> $r['tid'],
																					'meta_parent_id'	=> $r['forum_id'] ) );
				
				$count++;
			}
			$this->DB->dropField( 'topics', 'topic_prefix' );
			
			$this->_output[] = "Successfully converted prefixes for $count topics.";
			
			$this->DB->addIndex( 'topic_prefixes', 'title', 'prefix_title' );
			
			$this->_output[] = "Successfully added one new table index.";

			
			/**
			 * Update forums with old prefixes:
			 *  Convert allowed and default prefixes to tags.
			 *  Build newest_prefix data.
			 */
			$this->DB->addField( 'forums', 'default_prefix_v', 'varchar(255)' );
			$this->DB->addField( 'forums', 'newest_prefix', 'varchar(2550)' );
			
			$count = 0;
			
			$this->DB->build( array(	'select'	=> 'f.*',
										'from'		=> array( 'forums' => 'f' ),
										'add_join'	=> array( array(
												'select'	=> 'tag_text',
												'from'		=> array('core_tags' => 't'),
												'type'		=> 'left',
												'where'		=> 't.tag_meta_parent_id=f.id and t.tag_meta_id=f.last_id and t.tag_prefix=1',
											) ) ) );
			$q = $this->DB->execute();
			while( $r = $this->DB->fetch($q) ) {
				$r['allowed_prefixes'] = array_filter( explode( "','", trim( $r['allowed_prefixes'], ",'" ) ) );
				$update = array();

				/**
				 * Convert allowed/default prefixes
				 */
				if( count($r['allowed_prefixes']) ) {
					$tags = array();
					foreach( $r['allowed_prefixes'] as $prefix ) {
						$tags[] = $prefixes[ $prefix ]['prefix_title'];
					}
					
					$tags = trim( IPSText::safeslashes( implode( ', ', $tags ) ) );
					
					if( !empty( $r['tag_predefined'] ) ) {
						$tags = $r['tag_predefined'] . ', ' . $tags;
					}
					
					if( intval( $r['default_prefix'] ) ) {
						$default = IPSText::safeslashes( $prefixes[ $r['default_prefix'] ] );
					}
					else {
						$default = '';
					}

					$update['tag_predefined']	= $tags;
					$update['default_prefix_v']	= $default;
				}

				/**
				 * Build and cache latest topic prefix
				 */
				if( !empty($r['tag_text']) ) {
					if( $p = $prefixesByName[ IPSText::mbstrtolower( $r['tag_text'] ) ] ) {
						$tag	= $p['prefix_pre'] . ($p['prefix_showtitle'] ? $p['prefix_title'] : '') . $p['prefix_post'];
						$style	= '';
					}
					else {
						$style	= " class='ipsBadge ipsBadge_lightgrey'";
					}
					
					$update['newest_prefix'] = "<a href=\"" . $this->registry->getClass('output')->formatUrl( $this->registry->getClass('output')->buildUrl( "app=core&amp;module=search&amp;do=search&amp;search_tags=" . urlencode($r['tag_text']) . "&amp;search_app=forums", "public",'' ), "", "" ) . "\"{$style}>{$tag}</a>";
				}
				
				if( count($update) ) {
					$this->DB->update( 'forums', $update, 'id=' . $r['id'] );
					$count++;
				}
			}
			
			$this->DB->dropField( 'forums', 'default_prefix' );
			$this->DB->dropField( 'forums', 'allowed_prefixes' );
			$this->DB->changeField( 'forums', 'default_prefix_v', 'default_prefix', 'varchar(255)' );
			$this->DB->addField( 'forums', 'default_tags', 'mediumtext' );
			$this->DB->addField( 'forums', 'tag_mode', 'varchar(255)', "'inherit'" );
			
			$this->_output[] = "Successfully converted prefixes for $count forums.";


			/**
			 * Make sure we have all the needed columns.
			 */
			if( !$this->DB->checkForField( 'show_prefix_in_desc', 'forums' ) ) {
				$this->DB->addField( 'forums', 'show_prefix_in_desc', 'tinyint(1)', '0' );
			}


			/**
			 * Attempt to remove legacy bits
			 */
			$modules = $this->DB->buildAndFetch( array(	'select'	=> '*',
														'from'		=> 'cache_store',
														'where'		=> "cs_key='module_store'" ) );
			$modules['cs_value'] = unserialize($modules['cs_value']);
			if( count($modules['cs_value']['forums']) ) {
				foreach( $modules['cs_value']['forums'] as $k => $v ) {
					if( $v['sys_module_key'] == 'prefixes' ) {
						unset( $modules['cs_value']['forums'][ $k ] );
						$modules['cs_value']['forums'] = array_values($modules['cs_value']['forums']);
						break;
					}
				}

				$this->DB->update( 'cache_store', array( 'cs_value' => serialize($modules['cs_value']) ), "cs_key='module_store'" );
				$this->_output[] = "Removed legacy Prefixes module";
			}

			$files = array( IPSLib::getAppDir( 'forums' ) . '/extensions/admin/forum_form.php' => 'file',
							IPSLib::getAppDir( 'forums' ) . '/modules_admin/prefixes' => 'dir',
							IPSLib::getAppDir( 'forums' ) . '/skin_cp/cp_skin_prefixes.php' => 'file' );
			$count = 0;
			foreach( $files as $file => $type ) {
				if( $type == 'file' && @unlink( $file ) ) {
					$count++;
				}
				else if( $type == 'dir' ) {
					$count += $this->rrmdir( $file );
				}
			}
			$this->_output[] = "Removed $count legacy files";
			

			/**
			 * Update styles...
			 */
			$this->DB->build( array(	'update'	=> 'topic_prefixes',
										'set'		=> "prefix_pre=replace(prefix_pre, 'prefix', 'ipsBadge')" ) );
			$this->DB->execute();
			
			/**
			 * Add misc. new fields
			 */
			$this->DB->addField( 'topic_mmod', 'topic_add_tags', 'mediumtext' );
		}
		else if( !$appInstalled ) {
			/**
			 * No -- add columns.
			 */
			$this->_output[] = "No prior installation of Topic Prefixes found. Adding columns...";
			
			$this->DB->addField( 'forums', 'newest_prefix', 'varchar(2550)' );
			$this->DB->addField( 'forums', 'require_prefix', 'tinyint(1)', '0' );
			$this->DB->addField( 'forums', 'default_prefix', 'varchar(255)' );
			$this->DB->addField( 'forums', 'default_tags', 'mediumtext' );
			$this->DB->addField( 'forums', 'tag_mode', 'varchar(255)', "'inherit'" );
			$this->DB->addField( 'forums', 'show_prefix_in_desc', 'tinyint(1)', '0' );
			$this->DB->addField( 'topic_mmod', 'topic_prefix', 'int(10)', '-1' );
			$this->DB->addField( 'topic_mmod', 'topic_add_tags', 'mediumtext' );
			
			$this->_output[] = "Added eight new table columns successfully.";


			/**
			 * Update forums: Build newest_prefix data.
			 */
			$count = 0;
			
			$this->DB->build( array(	'select'	=> 'f.*',
										'from'		=> array( 'forums' => 'f' ),
										'add_join'	=> array( array(
												'select'	=> 'tag_text',
												'from'		=> array('core_tags' => 't'),
												'type'		=> 'left',
												'where'		=> 't.tag_meta_parent_id=f.id and t.tag_meta_id=f.last_id and t.tag_prefix=1',
											) ) ) );
			$q = $this->DB->execute();
			while( $r = $this->DB->fetch($q) ) {
				$update = array();

				/**
				 * Build and cache latest topic prefix
				 */
				if( !empty($r['tag_text']) ) {
					$style	= " class='ipsBadge ipsBadge_lightgrey'";
					$update['newest_prefix'] = "<a href=\"" . $this->registry->getClass('output')->formatUrl( $this->registry->getClass('output')->buildUrl( "app=core&amp;module=search&amp;do=search&amp;search_tags=" . urlencode($r['tag_text']) . "&amp;search_app=forums", "public",'' ), "", "" ) . "\"{$style}>{$tag}</a>";
					$this->DB->update( 'forums', $update, 'id=' . $r['id'] );
					$count++;
				}
			}

			$this->_output[] = "Build 'Last Post' prefix cache for $count forums.";
		}
	}
	
	public function uninstall()
	{
	}

	protected function rrmdir( $dir )
	{
		$count = 0;
		$objects = scandir($dir);
		foreach( $objects as $object ) {
			if( $object != "." && $object != ".." ) {
				if( filetype( $dir . "/" . $object ) == "dir" )
					$count += $this->rrmdir( $dir . "/" . $object );
				else
					$count += @unlink( $dir . "/" . $object );
			}
		}
		$count += @rmdir($dir);

		return $count;
	}
}