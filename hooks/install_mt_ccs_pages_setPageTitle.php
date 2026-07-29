<?php
class mt_ccs_pages_setPageTitle {
/**
* Registry Object Shortcuts
*
* @access protected
* @var object
*/
protected $registry;
protected $DB;
public function __construct( ipsRegistry $registry )
{
/* Make objects */
$this->registry = $registry;
$this->DB = $this->registry->DB();
}
public function install()
{
if ( !$this->DB->checkForField('page_database_title', 'ccs_pages'))
{
    $this->DB->addField('ccs_pages', 'page_database_title', 'text');
}
if ( !$this->DB->checkForField('wizard_database_title', 'ccs_page_wizard'))
{
    $this->DB->addField('ccs_page_wizard', 'wizard_database_title', 'text');
}
}
public function uninstall()
{
if ($this->DB->checkForField('page_database_title', 'ccs_pages'))
{
    $this->DB->dropField('ccs_pages', 'page_database_title');
}
if ($this->DB->checkForField('wizard_database_title', 'ccs_page_wizard'))
{
    $this->DB->dropField('ccs_page_wizard', 'wizard_database_title');
}
}
}
?>
