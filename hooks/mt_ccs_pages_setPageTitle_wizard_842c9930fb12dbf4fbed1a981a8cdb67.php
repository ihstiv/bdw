<?php
class mt_ccs_pages_setPageTitle_wizard extends admin_ccs_pages_wizard
{
protected function _saveToDb( $sessionId, $currentStep, $dataToSave )
	{
if($currentStep==1)
{
$valid = array('board_name', 'website_name', 'page_name', 'database_name', 'category_name', 'record_name');
$replacements = array();
foreach($valid as $vuber)
{
$replacements['{'.$vuber.'}'] = '~~##~'.$vuber.'~##~~';
}
$newArray = array(
'database_title_format_index' =>  $this->request['database_title_format_index'],
'database_title_format_cat' =>  $this->request['database_title_format_cat'],
'database_title_format_record' => $this->request['database_title_format_record'],
);
foreach($newArray as $key => $val)
{
foreach($replacements as $change => $to)
{
$val = str_replace($change, $to, $val);
}
$newArray[$key] = $val;
}
$dataToSave['wizard_database_title'] = @serialize($newArray);
}
		parent::_saveToDb( $sessionId, $currentStep, $dataToSave );
	}
protected function _savePage( $session )
	{
$page = parent::_savePage( $session );
$page['page_database_title'] = $session['wizard_database_title'];
$this->DB->update('ccs_pages', array('page_database_title' => $page['page_database_title']), "page_id='{$page['page_id']}'");
return $page;
}
protected function _wizardProxy()
	{	
parent::_wizardProxy();
//-----------------------------------------
		// INIT
		//-----------------------------------------
		
		$sessionId	= $this->request['wizard_session'] ? IPSText::md5Clean( $this->request['wizard_session'] ) : md5( uniqid( microtime(), true ) );
$_sessions	= $this->DB->buildAndFetch( array( 'select' => '*', 'from' => 'ccs_page_wizard', 'where' => "wizard_id='{$sessionId}'" ) );
if( $_sessions['wizard_edit_id'] )
{
$_page	= $this->DB->buildAndFetch( array( 'select' => 'page_database_title', 'from' => 'ccs_pages', 'where' => "page_id='{$_sessions['wizard_edit_id']}'" ) );
if($_page['page_database_title'])
{
$this->DB->update('ccs_page_wizard', array('wizard_database_title' => $_page['page_database_title']), "wizard_id='{$_sessions['wizard_id']}'");
}
}
}
protected function _saveAndGo( $session, $step )
	{
		
		if( $session['wizard_edit_id'] AND $this->request['save_button'] )
		{
if($session['wizard_page_title'])
{
$valid = array('board_name', 'website_name', 'page_name', 'database_name', 'category_name', 'record_name');
$replacements = array();
foreach($valid as $vuber)
{
$replacements['{'.$vuber.'}'] = '~~##~'.$vuber.'~##~~';
}
$newArray = array(
'database_title_format_index' =>  $this->request['database_title_format_index'],
'database_title_format_cat' =>  $this->request['database_title_format_cat'],
'database_title_format_record' => $this->request['database_title_format_record'],
);
foreach($newArray as $key => $val)
{
foreach($replacements as $change => $to)
{
$val = str_replace($change, $to, $val);
}
$newArray[$key] = $val;
}
$session['wizard_database_title'] = @serialize($newArray);
}
}
parent::_saveAndGo( $session, $step );
}
}
?>
