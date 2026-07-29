<?php
$INFO['sql_driver']			=	'mysql';
$INFO['sql_host']			=	'localhost';
$INFO['sql_database']			=	'bdwforum_ipboard';
$INFO['sql_user']			=	'bdwforum_ipb';
$INFO['sql_pass']			=	'44kDzR98x';
$INFO['sql_tbl_prefix']			=	'';
$INFO['sql_debug']			=	'0';
$INFO['sql_charset']			=	'';
$INFO['board_start']			=	'1373995016';
$INFO['installed']			=	'1';
$INFO['php_ext']			=	'php';
$INFO['safe_mode']			=	'0';
$INFO['board_url']			=	'https://www.bestdestinationwedding.com';
$INFO['banned_group']			=	'5';
$INFO['admin_group']			=	'4';
$INFO['guest_group']			=	'2';
$INFO['member_group']			=	'39'; /*default to newbie*/
$INFO['auth_group']			=	'1';
$INFO['use_friendly_urls']		=	'1';
$INFO['_jsDebug']			=	'0';
$INFO['mysql_tbl_type']			=	'MyISAM';

define('IN_DEV', 0);
/* Remote archive DB - complete these details if you\'re using a remote DB for the post archive.
   If content has already been archived in the local DB, this will need transferring and will not be done automatically. */
$INFO['archive_remote_sql_host']			=	'';
$INFO['archive_remote_sql_database']			=	'';
$INFO['archive_remote_sql_user']			=	'';
$INFO['archive_remote_sql_pass']			=	'';
$INFO['archive_remote_sql_charset']			=	'';

/*page titles for wedding tips area swright*/
define( 'CCS_PAGE_TITLE_HOME', '{page_name} | {board_name}' );
define( 'CCS_PAGE_TITLE_CAT', '{category_name} | {board_name}' );
define( 'CCS_PAGE_TITLE_RECORD', '{record_name} | {page_name} | {board_name}' );
//define( 'CCS_PAGE_TITLE_LIST', '{page_name} | {category_name} | {board_name}' );

?>