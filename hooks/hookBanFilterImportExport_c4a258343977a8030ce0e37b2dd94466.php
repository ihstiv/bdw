<?php
/*
+--------------------------------------------------------------------------
|   Ban Filter Importer/Exporter 1.1.0
|   =============================================
|   by Michael
|   Copyright 2007-2013 DevFuse
|   http://www.devfuse.com
|   =============================================
|	Idea and some code based on bad word importer 
|	which is copyright (c) 2001 - 2013 Invision Power Services, Inc.
+--------------------------------------------------------------------------
*/

class hookBanFilterImportExport extends admin_members_members_banfilters
{
	public function doExecute( ipsRegistry $registry )
	{		
		$this->registry->class_localization->loadLanguageFile( array( 'admin_member' ) );		
     
		$this->htmlimport = $this->registry->output->loadTemplate( 'cp_skin_banfilters_import' );
		$this->htmlimport->form_code    = '&amp;module=members&amp;section=banfilters';
		$this->htmlimport->form_code_js = '&module=members&section=banfilters';
				
		switch( $this->request['do'] )
		{
			case 'banfilter_import':
				$this->registry->getClass('class_permissions')->checkPermissionAutoMsg( 'ban_manage' );
				$this->banfilterImport();
				break;
			case 'banfilter_export':
				$this->registry->getClass('class_permissions')->checkPermissionAutoMsg( 'ban_manage' );
				$this->banfilterExport();
				break;				
			default:
			break;
		}
		parent::doExecute( $registry );
	}	
	
	/*-------------------------------------------------------------------------*/
	// Hook: Ban Filter Overview
	/*-------------------------------------------------------------------------*/	
	public function banOverview()
	{
		$this->registry->output->html .= $this->htmlimport->banImportDisplay();
		parent::banOverview();				
	}

	/*-------------------------------------------------------------------------*/
	// Ban Filter Import
	/*-------------------------------------------------------------------------*/	
	public function banfilterImport()
	{
		# Do we have a file to import?
		$content = $this->registry->adminFunctions->importXml( 'ipb_banfilter.xml' );
		
		if ( ! $content )
		{
			$this->registry->output->global_message = $this->lang->words['banie_import_failed'];
			return;
		}
		
		# Load XML class		
		require_once( IPS_KERNEL_PATH.'classXML.php' );
		$xml = new classXML( IPS_DOC_CHAR_SET );
		$xml->loadXML( $content );
		
		if( !count( $xml->fetchElements('banblock') ) )
		{
			$this->registry->output->global_message = $this->lang->words['banie_import_wrong'];
			return;
		}
		
		$filter = array();
		
		# Get our current content
		$this->DB->build( array( 'select' => '*', 'from' => 'banfilters', 'order' => 'ban_type' ) );
		$this->DB->execute();
		
		while( $r = $this->DB->fetch() )
		{
			$filter[ $r['ban_content'] ] = 1;
		}
		
		# Check if ban content is already in database
		foreach( $xml->fetchElements('ban') as $ban )
		{
			$entry  = $xml->fetchElementsFromRecord( $ban );

			$type    = $entry['ban_type'];
			$content = $entry['ban_content'];
			$reason  = $entry['ban_reason'];            
			
			if ( $filter[ $content ] )
			{
				continue;
			}

			# All good?
			if ( $content )
			{
				$this->DB->insert( 'banfilters', array( 'ban_type' => $type, 'ban_content' => $content, 'ban_reason' => $reason, 'ban_date' => time() ) );
			}
		}
		
		# Rebuild ban cache
		$this->rebuildBanCache();                    
		$this->registry->output->global_message = $this->lang->words['banie_import_success'];			
	}

	/*-------------------------------------------------------------------------*/
	// Ban Filter Export
	/*-------------------------------------------------------------------------*/	
	public function banfilterExport()
	{
		# Load XML class
		require_once( IPS_KERNEL_PATH.'classXML.php' );
		$xml = new classXML( IPS_DOC_CHAR_SET );
		
		$xml->newXMLDocument();
		$xml->addElement( 'banfilter' );
		$xml->addElement( 'banblock', 'banfilter' );

		# Get content to export
		$this->DB->build( array( 'select' => 'ban_type, ban_content, ban_reason', 'from' => 'banfilters', 'order' => 'ban_type' ) );
		$this->DB->execute();
		
		while( $r = $this->DB->fetch() )
		{
			$xml->addElementAsRecord( 'banblock', 'ban', $r );
		}

		# Create and show banfilter download.
		$xmlData = $xml->fetchDocument();
		$this->registry->output->showDownload( $xmlData, 'ipb_banfilter.xml' );
	}		
}
?>