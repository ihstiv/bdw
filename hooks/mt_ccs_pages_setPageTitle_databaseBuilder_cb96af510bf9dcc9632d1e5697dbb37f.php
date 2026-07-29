<?php
class mt_ccs_pages_setPageTitle_databaseBuilder extends databaseBuilder
{

protected function _setPageTitle( $slugs=array(), $area=1 )
 	{
$skipParent = false;
$opts = @unserialize($this->page['page_database_title']);
if($opts && $area && $this->page['page_title'])
{
$title = '';
switch( $area )
 			{
 				case 1:
 					if( $opts['database_title_format_index'] )
 					{
 						$title	= $opts['database_title_format_index'];
 					}
				break;
				
 				case 2:
 					if( $opts['database_title_format_cat'] )
 					{
 						$title	= $opts['database_title_format_cat'];
 					}
				break;
				
 				case 3:
 					if( $opts['database_title_format_record'] )
 					{
 						$title	= $opts['database_title_format_record'];
 					}
				break;
 				case 4://only one place uses it, constant is fine.
				break;
 			}
if($title)
{
$skipParent = true;
$title	= str_replace( '~~##~board_name~##~~', 		$this->settings['board_name'], $title );
$title	= str_replace( '~~##~website_name~##~~', 	$this->settings['home_name'], $title );
$title	= str_replace( '~~##~page_name~##~~', 		$this->page['page_title'], $title );
$title	= str_replace( '~~##~database_name~##~~', 	$this->database['database_name'], $title );
$title	= str_replace( '~~##~category_name~##~~', 	$slugs['category_name'], $title );
$title	= str_replace( '~~##~record_name~##~~', 	$slugs['record_name'], 	$title );
$this->registry->output->setTitle($title);
}
}
if(!$skipParent)
{
parent::_setPageTitle($slugs, $area);
}
}
}
?>
