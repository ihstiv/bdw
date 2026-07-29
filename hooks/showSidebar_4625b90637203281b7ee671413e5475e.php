//<?php

class showSidebar extends skin_global(~id~)
{
    public function globalTemplate($html, $documentHeadItems, $css, $jsModules, $metaTags, array $header_items, $items=array(), $footer_items=array(), $stats=array())
    {
        // include IP.Content styles if they are not already there
        $ipcCss = "{$this->settings['css_base_url']}ipc_blocks/compiled.css";
        if(is_array($css['import']) && !in_array($ipcCss, array_keys($css['import'])))
        {
            $css['import'][$ipcCss] = array('attributes' => '', 'content' => $ipcCss);
        }
        
        return parent::globalTemplate($html, $documentHeadItems, $css, $jsModules, $metaTags, $header_items, $items, $footer_items, $stats);
    }
}