
class contentMenuBar extends skin_global(~id~)
{
//===========================================================================
// <ips:global_board_header:desc::trigger:>
//===========================================================================
function globalTemplate( $html, $documentHeadItems, $css, $jsModules, $metaTags, array $header_items, $items=array(), $footer_items=array(), $stats=array()) {

	$classToLoad	= IPSLib::loadLibrary( IPSLib::getAppDir('ccs') . '/sources/hooks.php', 'ccsHooks', 'ccs' );
	$ccsHooks		= new $classToLoad( $this->registry );
	
	$header_items['primary_navigation_menu']	= $ccsHooks->menuBar( $header_items['applications'] );
	
	return parent::globalTemplate( $html, $documentHeadItems, $css, $jsModules, $metaTags, $header_items, $items, $footer_items, $stats );
}
}