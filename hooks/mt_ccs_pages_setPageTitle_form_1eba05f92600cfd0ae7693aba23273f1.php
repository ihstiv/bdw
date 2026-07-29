<?php
class mt_ccs_pages_setPageTitle_form extends cp_skin_pages
{
public function wizard_step_1( $session, $additional )
{
$html = parent::wizard_step_1( $session, $additional );
$html = $this->addPageTitleOvverride( $session, $additional, $html );
return $html;
}
private function addPageTitleOvverride($session, $additional, $output)
{
$pageTitle	= "<div id='page_title'>";
$opts = @unserialize($session['wizard_database_title']);
if($opts)
{
$valid = array('board_name', 'website_name', 'page_name', 'database_name', 'category_name', 'record_name');
$replacements = array();
foreach($valid as $vuber)
{
$replacements['{'.$vuber.'}'] = '~~##~'.$vuber.'~##~~';
}
foreach($opts as $key => $me)
{
foreach($replacements as $change => $to)
{
$me = str_replace($to, $change, $me);
}
$opts[$key] = $me;
}
}
$index	= $this->registry->output->formInput( 'database_title_format_index', $opts['database_title_format_index']);
$cat	= $this->registry->output->formInput( 'database_title_format_cat', $opts['database_title_format_cat']);
$record	= $this->registry->output->formInput( 'database_title_format_record', $opts['database_title_format_record']);
$databaseTitleForm = <<<EOF
<div id='page_title_database_index'>
{$this->lang->words['page_database_title_format_index']}: {$index}
<div class='desctext'>{$this->lang->words['page_database_title_format_indexhelptext']}
<br />
{$this->lang->words['page_database_title_format_indexhelptext_extra']}</div>
</div>
<div id='page_title_database_cat'>
{$this->lang->words['page_database_title_format_cat']}: {$cat}
<div class='desctext'>{$this->lang->words['page_database_title_format_cathelptext']}
<br />
{$this->lang->words['page_database_title_format_cathelptext_extra']}</div>
</div>
<div id='page_title_database_record'>
{$this->lang->words['page_database_title_format_record']}: {$record}
<div class='desctext'>{$this->lang->words['page_database_title_format_recordhelptext']}
<br />
{$this->lang->words['page_database_title_format_recordhelptext_extra']}</div>
</div>
EOF;
$databaseTitleForm .= '<script>document.observe("dom:loaded", function(){if( $(\'page_name_as_title\').checked ){$(\'page_title_database_index\').hide();$(\'page_title_database_cat\').hide();$(\'page_title_database_record\').hide();}else{$(\'page_title_database_index\').show();$(\'page_title_database_cat\').show();$(\'page_title_database_record\').show();}
$(\'page_name_as_title\').observe(\'click\', function(){if( $(\'page_name_as_title\').checked ){$(\'page_title_database_index\').hide();$(\'page_title_database_cat\').hide();$(\'page_title_database_record\').hide();}else{$(\'page_title_database_index\').show();$(\'page_title_database_cat\').show();$(\'page_title_database_record\').show();}})});</script>';
$output = str_replace($pageTitle, $databaseTitleForm.$pageTitle, $output);
return $output;
}
}
?>
