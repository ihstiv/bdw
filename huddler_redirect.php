<?php
/**
 * Configuration
 */

// Full URL to IPB (no trailing slash or index.php)
define ('IPB_URL', 'http://www.bestdestinationwedding.com');

// Full Path to IPB (no trailing slash or index.php)
define ('IPB_PATH', '.');

// Convert ID (what you used when deciding which software to convert from)
define ('CONV_ID', 'convert_huddler_reviews');

// Host db connection parameters
$connection_parameters = array('sql_database'   => 'bdwforum_final2',
                               'sql_user'       => 'bdwforum_final3',
                               'sql_pass'       => '9c1W7eNxfvFz',
                               'sql_host'       => 'localhost',
                               'sql_tbl_prefix' => '',
                               'sql_charset'    => 'UTF8');

/** DONE EDITING */

define('CCS_GATEWAY_CALLED', true);

if(!file_exists(IPB_PATH.'/initdata.php')) {
  echo('Wrong IPB Path');
  exit;
}

define ('IPB_THIS_SCRIPT', 'public');

// Setup redirector
$redirector = new redirector($connection_parameters);
$redirector->run();

class redirector {
  var $db;
  var $hb;
  var $connection_parameters;

  function __construct($connection_parameters) {
    require_once(IPB_PATH.'/initdata.php');

    // Setup registry
    require_once(IPB_PATH.'/'.CP_DIRECTORY.'/sources/base/ipsRegistry.php');
    $this->registry = ipsRegistry::instance();
    $this->registry->init();

    // Parse browser request
    $this->request =& $this->registry->fetchRequest();

    $this->connection_parameters = $connection_parameters;
  }

  function run() {
    // Load app if not valid request
    if(!in_array($this->request['act'], array('reviews_category', 'reviews_review', 'reviews_product'))) {
      require_once(IPS_ROOT_PATH.'sources/base/ipsController.php');
      ipsController::run();
      exit;
    }

    // Set local db connection
    $this->db = $this->registry->DB();

    // Set host db connection
    $this->registry->dbFunctions()->setDB('mysql', 'hb', $this->connection_parameters);
    $this->hb = $this->registry->dbFunctions()->getDB('hb');

    $type = $url = $table = $foreign_id = $ipb_id = '';

    switch($this->request['act']) {
      case 'reviews_category':
        // Determine old id
        $foreign_tag = $this->hb->buildAndFetch(array('select' => 'item_id', 'from' => 'tags', 'where' => "tag='{$this->request['id']}'"));
        $id = $this->get_conv_link_id((int)$foreign_tag['item_id'], 'reviews_categories');

        if($id) {
          $category = $this->db->buildAndFetch(array('select' => 'cname', 'from' => 'reviews_categories', 'where' => "cid='{$id}'"));
          $this->registry->getClass('output')->silentRedirect($this->registry->getClass('output')->buildSEOUrl("app=reviews&amp;module=products&amp;section=categories&amp;do=viewcat&amp;cid={$id}", 'public', IPSText::makeSeoTitle($category['cname']), 'showrevcategorytwo'), '', true);
          exit;
        }
        break;
      case 'reviews_review':
        $id = $this->get_conv_link_id((int)$this->request['id'], 'reviews');

        if($id) {
          $review = $this->db->buildAndFetch(array('select' => 'title', 'from' => 'reviews', 'where' => "id='{$id}'"));
          $this->registry->getClass('output')->silentRedirect($this->registry->getClass('output')->buildSEOUrl("app=reviews&amp;module=reviews&amp;section=reviews&amp;do=view&amp;id={$id}", 'public', IPSText::makeSeoTitle($review['title']), 'showrevreview'), '', true);
          exit;
        }

        break;
      case 'reviews_product':
        // Determine old id
        $foreign_tag = $this->hb->buildAndFetch(array('select' => 'item_id', 'from' => 'tags', 'where' => "tag='{$this->request['id']}'"));
        $id = $this->get_conv_link_id((int)$foreign_tag['item_id'], 'reviews_products');

        if($id) {
          $category = $this->db->buildAndFetch(array('select' => 'cname', 'from' => 'reviews_categories', 'where' => "cid='{$id}'"));
          $this->registry->getClass('output')->silentRedirect($this->registry->getClass('output')->buildSEOUrl("app=reviews&amp;module=products&amp;section=products&amp;do=products&amp;id={$id}", 'public', IPSText::makeSeoTitle($category['cname']), 'showrevproduct'), '', true);
          exit;
        }

        break;
    }

    $this->registry->getClass('output')->silentRedirect($this->registry->getClass('output')->buildSEOUrl("app=reviews", 'public', 'home', 'app=reviews'), '', true);
    exit;
  }

  function get_conv_link_id($foreign_id, $type, $table = '') {
    $app = $this->db->buildAndFetch(array('select' => 'app_id',
                                          'from'   => 'conv_apps',
                                          'where'  => "name = '".CONV_ID."'"));

    if(!$app['app_id']) {
      echo('Invalid Conversion ID');
      exit;
    }

    $row = $this->db->buildAndFetch(array('select' => 'ipb_id',
                                          'from'   => 'conv_link'.$table,
                                          'where'  => "foreign_id = '{$foreign_id}' AND type = '{$type}' AND app = '{$app['app_id']}'"));

    return $row ? $row['ipb_id'] : false;
  }

  function redirect($url) {

    exit;
  }
}