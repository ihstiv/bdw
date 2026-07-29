
------------------------------------------------
Sun, 29 Apr 2018 03:14:26 +0000
Created UTF8 table admin_login_logs (PKEY: admin_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:26 +0000
admin_login_logs keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:26 +0000
Pre inserts for MyISAM table admin_login_logs
------------------------------------------------
Sun, 29 Apr 2018 03:14:26 +0000
INSERT IGNORE INTO `x_utf_admin_login_logs` SELECT `admin_id`,CONVERT( CAST(`admin_ip_address` AS BINARY) USING utf8 ),CONVERT( CAST(`admin_username` AS BINARY) USING utf8 ),`admin_time`,`admin_success`,CONVERT( CAST(`admin_post_details` AS BINARY) USING utf8 ) FROM `admin_login_logs`
------------------------------------------------
Sun, 29 Apr 2018 03:14:26 +0000
Post inserts for MyISAM table admin_login_logs
------------------------------------------------
Sun, 29 Apr 2018 03:14:26 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:26 +0000
Created UTF8 table admin_logs (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:26 +0000
admin_logs keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:26 +0000
Continuing with admin_logs (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:26 +0000
Pre inserts for MyISAM table admin_logs
------------------------------------------------
Sun, 29 Apr 2018 03:14:26 +0000
INSERT IGNORE INTO `x_utf_admin_logs` SELECT `id`,`member_id`,`ctime`,CONVERT( CAST(`note` AS BINARY) USING utf8 ),CONVERT( CAST(`ip_address` AS BINARY) USING utf8 ),CONVERT( CAST(`appcomponent` AS BINARY) USING utf8 ),CONVERT( CAST(`module` AS BINARY) USING utf8 ),CONVERT( CAST(`section` AS BINARY) USING utf8 ),CONVERT( CAST(`do` AS BINARY) USING utf8 ) FROM `admin_logs`
------------------------------------------------
Sun, 29 Apr 2018 03:14:26 +0000
Post inserts for MyISAM table admin_logs
------------------------------------------------
Sun, 29 Apr 2018 03:14:26 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:26 +0000
Created UTF8 table admin_permission_rows (PKEY: row_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:26 +0000
admin_permission_rows keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:26 +0000
Continuing with admin_permission_rows (PKEY: row_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:26 +0000
Pre inserts for MyISAM table admin_permission_rows
------------------------------------------------
Sun, 29 Apr 2018 03:14:26 +0000
INSERT IGNORE INTO `x_utf_admin_permission_rows` SELECT `row_id`,CONVERT( CAST(`row_id_type` AS BINARY) USING utf8 ),CONVERT( CAST(`row_perm_cache` AS BINARY) USING utf8 ),`row_updated` FROM `admin_permission_rows`
------------------------------------------------
Sun, 29 Apr 2018 03:14:26 +0000
Post inserts for MyISAM table admin_permission_rows
------------------------------------------------
Sun, 29 Apr 2018 03:14:26 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:26 +0000
Created UTF8 table announcements (PKEY: announce_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:26 +0000
announcements keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:26 +0000
Continuing with announcements (PKEY: announce_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:26 +0000
Pre inserts for MyISAM table announcements
------------------------------------------------
Sun, 29 Apr 2018 03:14:26 +0000
INSERT IGNORE INTO `x_utf_announcements` SELECT `announce_id`,CONVERT( CAST(`announce_title` AS BINARY) USING utf8 ),CONVERT( CAST(`announce_post` AS BINARY) USING utf8 ),CONVERT( CAST(`announce_forum` AS BINARY) USING utf8 ),`announce_member_id`,`announce_html_enabled`,`announce_nlbr_enabled`,`announce_views`,`announce_start`,`announce_end`,`announce_active`,CONVERT( CAST(`announce_seo_title` AS BINARY) USING utf8 ) FROM `announcements`
------------------------------------------------
Sun, 29 Apr 2018 03:14:26 +0000
Post inserts for MyISAM table announcements
------------------------------------------------
Sun, 29 Apr 2018 03:14:26 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:26 +0000
Created UTF8 table api_log (PKEY: api_log_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:26 +0000
api_log keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:26 +0000
Continuing with api_log (PKEY: api_log_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:26 +0000
Pre inserts for MyISAM table api_log
------------------------------------------------
Sun, 29 Apr 2018 03:14:26 +0000
INSERT IGNORE INTO `x_utf_api_log` SELECT `api_log_id`,CONVERT( CAST(`api_log_key` AS BINARY) USING utf8 ),CONVERT( CAST(`api_log_ip` AS BINARY) USING utf8 ),`api_log_date`,CONVERT( CAST(`api_log_query` AS BINARY) USING utf8 ),`api_log_allowed` FROM `api_log`
------------------------------------------------
Sun, 29 Apr 2018 03:14:26 +0000
Post inserts for MyISAM table api_log
------------------------------------------------
Sun, 29 Apr 2018 03:14:26 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:26 +0000
Created UTF8 table api_users (PKEY: api_user_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:26 +0000
api_users keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:26 +0000
Continuing with api_users (PKEY: api_user_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:26 +0000
Pre inserts for MyISAM table api_users
------------------------------------------------
Sun, 29 Apr 2018 03:14:26 +0000
INSERT IGNORE INTO `x_utf_api_users` SELECT `api_user_id`,CONVERT( CAST(`api_user_key` AS BINARY) USING utf8 ),CONVERT( CAST(`api_user_name` AS BINARY) USING utf8 ),CONVERT( CAST(`api_user_perms` AS BINARY) USING utf8 ),CONVERT( CAST(`api_user_ip` AS BINARY) USING utf8 ) FROM `api_users`
------------------------------------------------
Sun, 29 Apr 2018 03:14:26 +0000
Post inserts for MyISAM table api_users
------------------------------------------------
Sun, 29 Apr 2018 03:14:26 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:26 +0000
Created UTF8 table attachments (PKEY: attach_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:26 +0000
attachments keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:26 +0000
Continuing with attachments (PKEY: attach_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:26 +0000
Pre inserts for MyISAM table attachments
------------------------------------------------
Sun, 29 Apr 2018 03:14:26 +0000
INSERT IGNORE INTO `x_utf_attachments` SELECT `attach_id`,CONVERT( CAST(`attach_ext` AS BINARY) USING utf8 ),CONVERT( CAST(`attach_file` AS BINARY) USING utf8 ),CONVERT( CAST(`attach_location` AS BINARY) USING utf8 ),CONVERT( CAST(`attach_thumb_location` AS BINARY) USING utf8 ),`attach_thumb_width`,`attach_thumb_height`,`attach_is_image`,`attach_hits`,`attach_date`,CONVERT( CAST(`attach_post_key` AS BINARY) USING utf8 ),`attach_member_id`,`attach_filesize`,`attach_rel_id`,CONVERT( CAST(`attach_rel_module` AS BINARY) USING utf8 ),`attach_img_width`,`attach_img_height`,`attach_parent_id`,`attach_is_archived`,`smushed`,`smushedsize` FROM `attachments`
------------------------------------------------
Sun, 29 Apr 2018 03:14:26 +0000
Post inserts for MyISAM table attachments
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Created UTF8 table attachments_type (PKEY: atype_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
attachments_type keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Continuing with attachments_type (PKEY: atype_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Pre inserts for MyISAM table attachments_type
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
INSERT IGNORE INTO `x_utf_attachments_type` SELECT `atype_id`,CONVERT( CAST(`atype_extension` AS BINARY) USING utf8 ),CONVERT( CAST(`atype_mimetype` AS BINARY) USING utf8 ),`atype_post`,CONVERT( CAST(`atype_img` AS BINARY) USING utf8 ) FROM `attachments_type`
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Post inserts for MyISAM table attachments_type
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Created UTF8 table backup_log (PKEY: log_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
backup_log keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Continuing with backup_log (PKEY: log_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Pre inserts for MyISAM table backup_log
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
INSERT IGNORE INTO `x_utf_backup_log` SELECT `log_id`,`log_row_count`,CONVERT( CAST(`log_result` AS BINARY) USING utf8 ) FROM `backup_log`
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Post inserts for MyISAM table backup_log
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Created UTF8 table backup_queue (PKEY: queue_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
backup_queue keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Continuing with backup_queue (PKEY: queue_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Pre inserts for MyISAM table backup_queue
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
INSERT IGNORE INTO `x_utf_backup_queue` SELECT `queue_id`,`queue_entry_date`,`queue_entry_type`,CONVERT( CAST(`queue_entry_table` AS BINARY) USING utf8 ),CONVERT( CAST(`queue_entry_key` AS BINARY) USING utf8 ),CONVERT( CAST(`queue_entry_value` AS BINARY) USING utf8 ),CONVERT( CAST(`queue_entry_sql` AS BINARY) USING utf8 ) FROM `backup_queue`
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Post inserts for MyISAM table backup_queue
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Created UTF8 table backup_vars (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
backup_vars keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Continuing with backup_vars (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Pre inserts for MyISAM table backup_vars
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
INSERT IGNORE INTO `x_utf_backup_vars` SELECT CONVERT( CAST(`backup_var_key` AS BINARY) USING utf8 ),CONVERT( CAST(`backup_var_value` AS BINARY) USING utf8 ) FROM `backup_vars`
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Post inserts for MyISAM table backup_vars
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Created UTF8 table badwords (PKEY: wid)
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
badwords keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Continuing with badwords (PKEY: wid)
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Pre inserts for MyISAM table badwords
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
INSERT IGNORE INTO `x_utf_badwords` SELECT `wid`,CONVERT( CAST(`type` AS BINARY) USING utf8 ),CONVERT( CAST(`swop` AS BINARY) USING utf8 ),`m_exact` FROM `badwords`
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Post inserts for MyISAM table badwords
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Created UTF8 table banfilters (PKEY: ban_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
banfilters keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Continuing with banfilters (PKEY: ban_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Pre inserts for MyISAM table banfilters
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
INSERT IGNORE INTO `x_utf_banfilters` SELECT `ban_id`,CONVERT( CAST(`ban_type` AS BINARY) USING utf8 ),CONVERT( CAST(`ban_content` AS BINARY) USING utf8 ),`ban_date`,CONVERT( CAST(`ban_reason` AS BINARY) USING utf8 ),`sfs` FROM `banfilters`
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Post inserts for MyISAM table banfilters
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Created UTF8 table bbcode_mediatag (PKEY: mediatag_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
bbcode_mediatag keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Continuing with bbcode_mediatag (PKEY: mediatag_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Pre inserts for MyISAM table bbcode_mediatag
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
INSERT IGNORE INTO `x_utf_bbcode_mediatag` SELECT `mediatag_id`,CONVERT( CAST(`mediatag_name` AS BINARY) USING utf8 ),CONVERT( CAST(`mediatag_match` AS BINARY) USING utf8 ),CONVERT( CAST(`mediatag_replace` AS BINARY) USING utf8 ),`mediatag_position` FROM `bbcode_mediatag`
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Post inserts for MyISAM table bbcode_mediatag
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Created UTF8 table blog_akismet_logs (PKEY: log_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
blog_akismet_logs keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Continuing with blog_akismet_logs (PKEY: log_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Pre inserts for MyISAM table blog_akismet_logs
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
INSERT IGNORE INTO `x_utf_blog_akismet_logs` SELECT `log_id`,`log_date`,CONVERT( CAST(`log_msg` AS BINARY) USING utf8 ),CONVERT( CAST(`log_errors` AS BINARY) USING utf8 ),CONVERT( CAST(`log_data` AS BINARY) USING utf8 ),CONVERT( CAST(`log_type` AS BINARY) USING utf8 ),`log_etbid`,`log_isspam`,CONVERT( CAST(`log_action` AS BINARY) USING utf8 ),`log_submitted`,`log_connect_error` FROM `blog_akismet_logs`
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Post inserts for MyISAM table blog_akismet_logs
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Created UTF8 table blog_blogs (PKEY: blog_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
blog_blogs keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Continuing with blog_blogs (PKEY: blog_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Pre inserts for MyISAM table blog_blogs
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
INSERT IGNORE INTO `x_utf_blog_blogs` SELECT `blog_id`,`member_id`,CONVERT( CAST(`blog_name` AS BINARY) USING utf8 ),CONVERT( CAST(`blog_desc` AS BINARY) USING utf8 ),CONVERT( CAST(`blog_type` AS BINARY) USING utf8 ),CONVERT( CAST(`blog_exturl` AS BINARY) USING utf8 ),`blog_num_exthits`,`blog_num_views`,`blog_private`,`blog_pinned`,`blog_disabled`,`blog_allowguests`,`blog_rating_total`,`blog_rating_count`,`blog_last_delete`,`blog_skin_id`,CONVERT( CAST(`blog_friendly_url` AS BINARY) USING utf8 ),CONVERT( CAST(`blog_settings` AS BINARY) USING utf8 ),`blog_theme_id`,CONVERT( CAST(`blog_theme_custom` AS BINARY) USING utf8 ),CONVERT( CAST(`blog_theme_final` AS BINARY) USING utf8 ),`blog_theme_approved`,CONVERT( CAST(`blog_last_visitors` AS BINARY) USING utf8 ),CONVERT( CAST(`blog_view_level` AS BINARY) USING utf8 ),CONVERT( CAST(`blog_seo_name` AS BINARY) USING utf8 ),CONVERT( CAST(`blog_categories` AS BINARY) USING utf8 ),`blog_editors`,CONVERT( CAST(`blog_groupblog_ids` AS BINARY) USING utf8 ),CONVERT( CAST(`blog_groupblog_name` AS BINARY) USING utf8 ),`blog_groupblog`,`blog_last_edate`,`blog_lentry_banish`,`blog_last_udate`,`blog_owner_only`,CONVERT( CAST(`blog_authorized_users` AS BINARY) USING utf8 ) FROM `blog_blogs`
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Post inserts for MyISAM table blog_blogs
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Created UTF8 table blog_categories (PKEY: category_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
blog_categories keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Continuing with blog_categories (PKEY: category_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Pre inserts for MyISAM table blog_categories
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
INSERT IGNORE INTO `x_utf_blog_categories` SELECT `category_id`,`category_blog_id`,`category_parent`,CONVERT( CAST(`category_title` AS BINARY) USING utf8 ),CONVERT( CAST(`category_title_seo` AS BINARY) USING utf8 ),`category_position` FROM `blog_categories`
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Post inserts for MyISAM table blog_categories
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Created UTF8 table blog_category_mapping (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
blog_category_mapping keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Continuing with blog_category_mapping (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Pre inserts for MyISAM table blog_category_mapping
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Post inserts for MyISAM table blog_category_mapping
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
No columns to convert in blog_category_mapping INSERT INTO FROM SELECT used
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Created UTF8 table blog_cblock_cache (PKEY: blog_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
blog_cblock_cache keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Continuing with blog_cblock_cache (PKEY: blog_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Pre inserts for MyISAM table blog_cblock_cache
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
INSERT IGNORE INTO `x_utf_blog_cblock_cache` SELECT `blog_id`,CONVERT( CAST(`cbcache_key` AS BINARY) USING utf8 ),`cbcache_lastupdate`,`cbcache_refresh`,CONVERT( CAST(`cbcache_content` AS BINARY) USING utf8 ) FROM `blog_cblock_cache`
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Post inserts for MyISAM table blog_cblock_cache
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Created UTF8 table blog_cblocks (PKEY: cblock_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
blog_cblocks keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Continuing with blog_cblocks (PKEY: cblock_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Pre inserts for MyISAM table blog_cblocks
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
INSERT IGNORE INTO `x_utf_blog_cblocks` SELECT `cblock_id`,`blog_id`,`member_id`,`cblock_order`,`cblock_show`,CONVERT( CAST(`cblock_type` AS BINARY) USING utf8 ),`cblock_ref_id`,CONVERT( CAST(`cblock_position` AS BINARY) USING utf8 ),CONVERT( CAST(`cblock_config` AS BINARY) USING utf8 ) FROM `blog_cblocks`
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Post inserts for MyISAM table blog_cblocks
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Created UTF8 table blog_comments (PKEY: comment_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
blog_comments keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Continuing with blog_comments (PKEY: comment_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Pre inserts for MyISAM table blog_comments
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
INSERT IGNORE INTO `x_utf_blog_comments` SELECT `comment_id`,`entry_id`,`member_id`,CONVERT( CAST(`member_name` AS BINARY) USING utf8 ),CONVERT( CAST(`ip_address` AS BINARY) USING utf8 ),`comment_date`,`comment_edit_time`,CONVERT( CAST(`comment_text` AS BINARY) USING utf8 ),`comment_approved` FROM `blog_comments`
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Post inserts for MyISAM table blog_comments
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Created UTF8 table blog_custom_cblocks (PKEY: cbcus_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
blog_custom_cblocks keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Continuing with blog_custom_cblocks (PKEY: cbcus_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Pre inserts for MyISAM table blog_custom_cblocks
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
INSERT IGNORE INTO `x_utf_blog_custom_cblocks` SELECT `cbcus_id`,CONVERT( CAST(`cbcus_name` AS BINARY) USING utf8 ),CONVERT( CAST(`cbcus` AS BINARY) USING utf8 ),CONVERT( CAST(`cbcus_post_key` AS BINARY) USING utf8 ),`cbcus_has_attach`,`cbcus_html_state` FROM `blog_custom_cblocks`
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Post inserts for MyISAM table blog_custom_cblocks
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Created UTF8 table blog_default_cblocks (PKEY: cbdef_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
blog_default_cblocks keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Continuing with blog_default_cblocks (PKEY: cbdef_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Pre inserts for MyISAM table blog_default_cblocks
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
INSERT IGNORE INTO `x_utf_blog_default_cblocks` SELECT `cbdef_id`,CONVERT( CAST(`cbdef_name` AS BINARY) USING utf8 ),CONVERT( CAST(`cbdef_function` AS BINARY) USING utf8 ),`cbdef_default`,`cbdef_order`,`cbdef_locked`,`cbdef_enabled` FROM `blog_default_cblocks`
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Post inserts for MyISAM table blog_default_cblocks
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Created UTF8 table blog_editors_map (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
blog_editors_map keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Continuing with blog_editors_map (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Pre inserts for MyISAM table blog_editors_map
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Post inserts for MyISAM table blog_editors_map
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
No columns to convert in blog_editors_map INSERT INTO FROM SELECT used
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Created UTF8 table blog_entries (PKEY: entry_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
blog_entries keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Pre inserts for MyISAM table blog_entries
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
INSERT IGNORE INTO `x_utf_blog_entries` SELECT `entry_id`,`blog_id`,`entry_author_id`,CONVERT( CAST(`entry_author_name` AS BINARY) USING utf8 ),`entry_date`,CONVERT( CAST(`entry_name` AS BINARY) USING utf8 ),CONVERT( CAST(`entry` AS BINARY) USING utf8 ),CONVERT( CAST(`entry_status` AS BINARY) USING utf8 ),`entry_locked`,`entry_num_comments`,`entry_last_comment`,`entry_last_comment_date`,CONVERT( CAST(`entry_last_comment_name` AS BINARY) USING utf8 ),`entry_last_comment_mid`,`entry_queued_comments`,`entry_has_attach`,CONVERT( CAST(`entry_post_key` AS BINARY) USING utf8 ),`entry_edit_time`,CONVERT( CAST(`entry_edit_name` AS BINARY) USING utf8 ),`entry_html_state`,`entry_use_emo`,`entry_trackbacks`,CONVERT( CAST(`entry_sent_trackbacks` AS BINARY) USING utf8 ),`entry_last_update`,`entry_gallery_album`,`entry_poll_state`,`entry_last_vote`,`entry_featured`,`entry_hastags`,CONVERT( CAST(`entry_category` AS BINARY) USING utf8 ),CONVERT( CAST(`entry_name_seo` AS BINARY) USING utf8 ),CONVERT( CAST(`entry_tag_cache` AS BINARY) USING utf8 ),CONVERT( CAST(`entry_short` AS BINARY) USING utf8 ),`entry_rating_total`,`entry_rating_count`,`entry_rss_import`,`entry_future_date`,`entry_banish`,CONVERT( CAST(`entry_image` AS BINARY) USING utf8 ),`entry_views` FROM `blog_entries`
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Post inserts for MyISAM table blog_entries
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Created UTF8 table blog_lastinfo (PKEY: blog_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
blog_lastinfo keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Continuing with blog_lastinfo (PKEY: blog_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Pre inserts for MyISAM table blog_lastinfo
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
INSERT IGNORE INTO `x_utf_blog_lastinfo` SELECT `blog_id`,`blog_num_entries`,`blog_num_drafts`,`blog_num_comments`,`blog_last_entry`,CONVERT( CAST(`blog_last_entryname` AS BINARY) USING utf8 ),`blog_last_date`,`blog_last_comment`,`blog_last_comment_date`,`blog_last_comment_entry`,CONVERT( CAST(`blog_last_comment_entryname` AS BINARY) USING utf8 ),CONVERT( CAST(`blog_last_comment_name` AS BINARY) USING utf8 ),`blog_last_comment_mid`,`blog_last_update`,CONVERT( CAST(`blog_last_entry_excerpt` AS BINARY) USING utf8 ),CONVERT( CAST(`blog_tag_cloud` AS BINARY) USING utf8 ),CONVERT( CAST(`blog_cblocks` AS BINARY) USING utf8 ),CONVERT( CAST(`blog_last_comment_20` AS BINARY) USING utf8 ),CONVERT( CAST(`blog_cblocks_available` AS BINARY) USING utf8 ) FROM `blog_lastinfo`
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Post inserts for MyISAM table blog_lastinfo
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Created UTF8 table blog_mediatag (PKEY: mediatag_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
blog_mediatag keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Continuing with blog_mediatag (PKEY: mediatag_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Pre inserts for MyISAM table blog_mediatag
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
INSERT IGNORE INTO `x_utf_blog_mediatag` SELECT `mediatag_id`,CONVERT( CAST(`mediatag_name` AS BINARY) USING utf8 ),CONVERT( CAST(`mediatag_match` AS BINARY) USING utf8 ),CONVERT( CAST(`mediatag_replace` AS BINARY) USING utf8 ) FROM `blog_mediatag`
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Post inserts for MyISAM table blog_mediatag
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Created UTF8 table blog_moderators (PKEY: moderate_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
blog_moderators keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Continuing with blog_moderators (PKEY: moderate_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Pre inserts for MyISAM table blog_moderators
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
INSERT IGNORE INTO `x_utf_blog_moderators` SELECT `moderate_id`,CONVERT( CAST(`moderate_type` AS BINARY) USING utf8 ),`moderate_mg_id`,`moderate_can_edit_comments`,`moderate_can_edit_entries`,`moderate_can_del_comments`,`moderate_can_del_entries`,`moderate_can_lock`,`moderate_can_publish`,`moderate_can_approve`,`moderate_can_editcblocks`,`moderate_can_del_trackback`,`moderate_can_view_draft`,`moderate_can_view_private`,`moderate_can_warn`,`moderate_can_pin`,`moderate_can_disable`,`moderator_can_feature` FROM `blog_moderators`
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
Post inserts for MyISAM table blog_moderators
------------------------------------------------
Sun, 29 Apr 2018 03:14:27 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Created UTF8 table blog_pingservices (PKEY: blog_service_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
blog_pingservices keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Continuing with blog_pingservices (PKEY: blog_service_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Pre inserts for MyISAM table blog_pingservices
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
INSERT IGNORE INTO `x_utf_blog_pingservices` SELECT `blog_service_id`,CONVERT( CAST(`blog_service_key` AS BINARY) USING utf8 ),CONVERT( CAST(`blog_service_name` AS BINARY) USING utf8 ),CONVERT( CAST(`blog_service_host` AS BINARY) USING utf8 ),`blog_service_port`,CONVERT( CAST(`blog_service_path` AS BINARY) USING utf8 ),CONVERT( CAST(`blog_service_methodname` AS BINARY) USING utf8 ),`blog_service_extended`,`blog_service_enabled` FROM `blog_pingservices`
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Post inserts for MyISAM table blog_pingservices
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Created UTF8 table blog_polls (PKEY: poll_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
blog_polls keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Continuing with blog_polls (PKEY: poll_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Pre inserts for MyISAM table blog_polls
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
INSERT IGNORE INTO `x_utf_blog_polls` SELECT `poll_id`,`entry_id`,`start_date`,CONVERT( CAST(`choices` AS BINARY) USING utf8 ),`starter_id`,`votes`,CONVERT( CAST(`poll_question` AS BINARY) USING utf8 ) FROM `blog_polls`
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Post inserts for MyISAM table blog_polls
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Created UTF8 table blog_ratings (PKEY: rating_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
blog_ratings keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Continuing with blog_ratings (PKEY: rating_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Pre inserts for MyISAM table blog_ratings
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Post inserts for MyISAM table blog_ratings
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
No columns to convert in blog_ratings INSERT INTO FROM SELECT used
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Created UTF8 table blog_rsscache (PKEY: blog_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
blog_rsscache keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Pre inserts for MyISAM table blog_rsscache
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
INSERT IGNORE INTO `x_utf_blog_rsscache` SELECT `blog_id`,`rsscache_refresh`,CONVERT( CAST(`rsscache_feed` AS BINARY) USING utf8 ) FROM `blog_rsscache`
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Post inserts for MyISAM table blog_rsscache
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Created UTF8 table blog_rssimport (PKEY: rss_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
blog_rssimport keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Continuing with blog_rssimport (PKEY: rss_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Pre inserts for MyISAM table blog_rssimport
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
INSERT IGNORE INTO `x_utf_blog_rssimport` SELECT `rss_id`,`rss_blog_id`,CONVERT( CAST(`rss_url` AS BINARY) USING utf8 ),`rss_per_go`,CONVERT( CAST(`rss_auth_user` AS BINARY) USING utf8 ),CONVERT( CAST(`rss_auth_pass` AS BINARY) USING utf8 ),`rss_last_import`,`rss_in_progress`,`rss_count`,CONVERT( CAST(`rss_tags` AS BINARY) USING utf8 ),CONVERT( CAST(`rss_cats` AS BINARY) USING utf8 ) FROM `blog_rssimport`
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Post inserts for MyISAM table blog_rssimport
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Created UTF8 table blog_themes (PKEY: theme_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
blog_themes keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Continuing with blog_themes (PKEY: theme_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Pre inserts for MyISAM table blog_themes
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
INSERT IGNORE INTO `x_utf_blog_themes` SELECT `theme_id`,`theme_on`,CONVERT( CAST(`theme_css` AS BINARY) USING utf8 ),CONVERT( CAST(`theme_images` AS BINARY) USING utf8 ),CONVERT( CAST(`theme_opts` AS BINARY) USING utf8 ),CONVERT( CAST(`theme_name` AS BINARY) USING utf8 ),CONVERT( CAST(`theme_author` AS BINARY) USING utf8 ),CONVERT( CAST(`theme_homepage` AS BINARY) USING utf8 ),CONVERT( CAST(`theme_email` AS BINARY) USING utf8 ),CONVERT( CAST(`theme_desc` AS BINARY) USING utf8 ),`theme_css_overwrite` FROM `blog_themes`
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Post inserts for MyISAM table blog_themes
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Created UTF8 table blog_this (PKEY: bt_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
blog_this keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Continuing with blog_this (PKEY: bt_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Pre inserts for MyISAM table blog_this
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
INSERT IGNORE INTO `x_utf_blog_this` SELECT `bt_id`,`bt_entry_id`,CONVERT( CAST(`bt_app` AS BINARY) USING utf8 ),`bt_id1`,`bt_id2` FROM `blog_this`
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Post inserts for MyISAM table blog_this
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Created UTF8 table blog_trackback (PKEY: trackback_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
blog_trackback keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Continuing with blog_trackback (PKEY: trackback_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Pre inserts for MyISAM table blog_trackback
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
INSERT IGNORE INTO `x_utf_blog_trackback` SELECT `trackback_id`,`blog_id`,`entry_id`,CONVERT( CAST(`ip_address` AS BINARY) USING utf8 ),CONVERT( CAST(`trackback_url` AS BINARY) USING utf8 ),CONVERT( CAST(`trackback_title` AS BINARY) USING utf8 ),CONVERT( CAST(`trackback_excerpt` AS BINARY) USING utf8 ),CONVERT( CAST(`trackback_blog_name` AS BINARY) USING utf8 ),`trackback_date`,`trackback_queued` FROM `blog_trackback`
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Post inserts for MyISAM table blog_trackback
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Created UTF8 table blog_trackback_spamlogs (PKEY: trackback_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
blog_trackback_spamlogs keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Continuing with blog_trackback_spamlogs (PKEY: trackback_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Pre inserts for MyISAM table blog_trackback_spamlogs
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
INSERT IGNORE INTO `x_utf_blog_trackback_spamlogs` SELECT `trackback_id`,`blog_id`,`entry_id`,CONVERT( CAST(`ip_address` AS BINARY) USING utf8 ),CONVERT( CAST(`trackback_url` AS BINARY) USING utf8 ),CONVERT( CAST(`trackback_title` AS BINARY) USING utf8 ),CONVERT( CAST(`trackback_excerpt` AS BINARY) USING utf8 ),CONVERT( CAST(`trackback_blog_name` AS BINARY) USING utf8 ),`trackback_date`,`trackback_queued` FROM `blog_trackback_spamlogs`
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Post inserts for MyISAM table blog_trackback_spamlogs
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Created UTF8 table blog_updatepings (PKEY: ping_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
blog_updatepings keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Continuing with blog_updatepings (PKEY: ping_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Pre inserts for MyISAM table blog_updatepings
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
INSERT IGNORE INTO `x_utf_blog_updatepings` SELECT `ping_id`,`ping_active`,`ping_time`,`ping_tries`,`blog_id`,`entry_id`,CONVERT( CAST(`ping_service` AS BINARY) USING utf8 ) FROM `blog_updatepings`
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Post inserts for MyISAM table blog_updatepings
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Created UTF8 table blog_views (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
blog_views keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Continuing with blog_views (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Pre inserts for MyISAM table blog_views
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Post inserts for MyISAM table blog_views
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
No columns to convert in blog_views INSERT INTO FROM SELECT used
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Created UTF8 table blog_voters (PKEY: vote_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
blog_voters keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Pre inserts for MyISAM table blog_voters
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
INSERT IGNORE INTO `x_utf_blog_voters` SELECT `vote_id`,CONVERT( CAST(`ip_address` AS BINARY) USING utf8 ),`vote_date`,`entry_id`,CONVERT( CAST(`member_id` AS BINARY) USING utf8 ) FROM `blog_voters`
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Post inserts for MyISAM table blog_voters
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Created UTF8 table bulk_mail (PKEY: mail_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
bulk_mail keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Continuing with bulk_mail (PKEY: mail_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Pre inserts for MyISAM table bulk_mail
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
INSERT IGNORE INTO `x_utf_bulk_mail` SELECT `mail_id`,CONVERT( CAST(`mail_subject` AS BINARY) USING utf8 ),CONVERT( CAST(`mail_content` AS BINARY) USING utf8 ),CONVERT( CAST(`mail_groups` AS BINARY) USING utf8 ),CONVERT( CAST(`mail_opts` AS BINARY) USING utf8 ),`mail_start`,`mail_updated`,`mail_sentto`,`mail_active`,`mail_pergo` FROM `bulk_mail`
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Post inserts for MyISAM table bulk_mail
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Created UTF8 table cache_simple (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
cache_simple keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Continuing with cache_simple (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Pre inserts for MyISAM table cache_simple
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
INSERT IGNORE INTO `x_utf_cache_simple` SELECT CONVERT( CAST(`cache_id` AS BINARY) USING utf8 ),CONVERT( CAST(`cache_perm_key` AS BINARY) USING utf8 ),`cache_time`,CONVERT( CAST(`cache_data` AS BINARY) USING utf8 ) FROM `cache_simple`
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Post inserts for MyISAM table cache_simple
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Created UTF8 table cache_store (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
cache_store keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Continuing with cache_store (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Pre inserts for MyISAM table cache_store
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Post inserts for MyISAM table cache_store
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
50 rows batch inserted using conversion method: Mb, last insert ID 0
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Pre inserts for MyISAM table cache_store
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Post inserts for MyISAM table cache_store
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
39 rows batch inserted using conversion method: Mb, last insert ID 0
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
cache_store keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Created UTF8 table cal_calendars (PKEY: cal_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
cal_calendars keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Pre inserts for MyISAM table cal_calendars
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
INSERT IGNORE INTO `x_utf_cal_calendars` SELECT `cal_id`,CONVERT( CAST(`cal_title` AS BINARY) USING utf8 ),`cal_moderate`,`cal_position`,`cal_event_limit`,`cal_bday_limit`,`cal_rss_export`,`cal_rss_export_days`,`cal_rss_export_max`,`cal_rss_update`,`cal_rss_update_last`,CONVERT( CAST(`cal_rss_cache` AS BINARY) USING utf8 ),CONVERT( CAST(`cal_title_seo` AS BINARY) USING utf8 ),`cal_comment_moderate`,`cal_rsvp_owner` FROM `cal_calendars`
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Post inserts for MyISAM table cal_calendars
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Created UTF8 table cal_event_comments (PKEY: comment_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
cal_event_comments keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Continuing with cal_event_comments (PKEY: comment_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Pre inserts for MyISAM table cal_event_comments
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
INSERT IGNORE INTO `x_utf_cal_event_comments` SELECT `comment_id`,`comment_eid`,`comment_mid`,`comment_date`,`comment_approved`,CONVERT( CAST(`comment_text` AS BINARY) USING utf8 ),`comment_append_edit`,`comment_edit_time`,CONVERT( CAST(`comment_edit_name` AS BINARY) USING utf8 ),CONVERT( CAST(`ip_address` AS BINARY) USING utf8 ),CONVERT( CAST(`comment_author` AS BINARY) USING utf8 ) FROM `cal_event_comments`
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Post inserts for MyISAM table cal_event_comments
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Created UTF8 table cal_event_ratings (PKEY: rating_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
cal_event_ratings keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Continuing with cal_event_ratings (PKEY: rating_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Pre inserts for MyISAM table cal_event_ratings
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
INSERT IGNORE INTO `x_utf_cal_event_ratings` SELECT `rating_id`,`rating_eid`,`rating_member_id`,`rating_value`,CONVERT( CAST(`rating_ip_address` AS BINARY) USING utf8 ) FROM `cal_event_ratings`
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Post inserts for MyISAM table cal_event_ratings
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Created UTF8 table cal_event_rsvp (PKEY: rsvp_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
cal_event_rsvp keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Continuing with cal_event_rsvp (PKEY: rsvp_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Pre inserts for MyISAM table cal_event_rsvp
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Post inserts for MyISAM table cal_event_rsvp
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
No columns to convert in cal_event_rsvp INSERT INTO FROM SELECT used
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Created UTF8 table cal_events (PKEY: event_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
cal_events keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Pre inserts for MyISAM table cal_events
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
INSERT IGNORE INTO `x_utf_cal_events` SELECT `event_id`,`event_calendar_id`,`event_member_id`,CONVERT( CAST(`event_content` AS BINARY) USING utf8 ),CONVERT( CAST(`event_title` AS BINARY) USING utf8 ),`event_smilies`,`event_comments`,`event_comments_pending`,`event_rsvp`,CONVERT( CAST(`event_perms` AS BINARY) USING utf8 ),`event_private`,`event_approved`,`event_saved`,`event_lastupdated`,`event_recurring`,`event_start_date`,`event_end_date`,CONVERT( CAST(`event_title_seo` AS BINARY) USING utf8 ),`event_rating_total`,`event_rating_hits`,`event_rating_avg`,`event_attachments`,CONVERT( CAST(`event_post_key` AS BINARY) USING utf8 ),`event_sequence`,`event_all_day` FROM `cal_events`
------------------------------------------------
Sun, 29 Apr 2018 03:14:28 +0000
Post inserts for MyISAM table cal_events
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
Created UTF8 table cal_import_feeds (PKEY: feed_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
cal_import_feeds keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
Continuing with cal_import_feeds (PKEY: feed_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
Pre inserts for MyISAM table cal_import_feeds
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
INSERT IGNORE INTO `x_utf_cal_import_feeds` SELECT `feed_id`,CONVERT( CAST(`feed_title` AS BINARY) USING utf8 ),CONVERT( CAST(`feed_url` AS BINARY) USING utf8 ),`feed_added`,`feed_lastupdated`,`feed_recache_freq`,`feed_calendar_id`,`feed_member_id`,`feed_next_run` FROM `cal_import_feeds`
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
Post inserts for MyISAM table cal_import_feeds
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
Created UTF8 table cal_import_map (PKEY: import_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
cal_import_map keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
Continuing with cal_import_map (PKEY: import_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
Pre inserts for MyISAM table cal_import_map
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
INSERT IGNORE INTO `x_utf_cal_import_map` SELECT `import_id`,`import_feed_id`,`import_event_id`,CONVERT( CAST(`import_guid` AS BINARY) USING utf8 ) FROM `cal_import_map`
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
Post inserts for MyISAM table cal_import_map
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
Created UTF8 table captcha (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
captcha keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
Continuing with captcha (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
Pre inserts for MyISAM table captcha
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
INSERT IGNORE INTO `x_utf_captcha` SELECT CONVERT( CAST(`captcha_unique_id` AS BINARY) USING utf8 ),CONVERT( CAST(`captcha_string` AS BINARY) USING utf8 ),CONVERT( CAST(`captcha_ipaddress` AS BINARY) USING utf8 ),`captcha_date` FROM `captcha`
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
Post inserts for MyISAM table captcha
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
Created UTF8 table ccs_attachments_map (PKEY: map_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
ccs_attachments_map keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
Continuing with ccs_attachments_map (PKEY: map_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
Pre inserts for MyISAM table ccs_attachments_map
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
Post inserts for MyISAM table ccs_attachments_map
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
No columns to convert in ccs_attachments_map INSERT INTO FROM SELECT used
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
Created UTF8 table ccs_block_wizard (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
ccs_block_wizard keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
Pre inserts for MyISAM table ccs_block_wizard
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
INSERT IGNORE INTO `x_utf_ccs_block_wizard` SELECT CONVERT( CAST(`wizard_id` AS BINARY) USING utf8 ),`wizard_step`,CONVERT( CAST(`wizard_type` AS BINARY) USING utf8 ),CONVERT( CAST(`wizard_name` AS BINARY) USING utf8 ),CONVERT( CAST(`wizard_config` AS BINARY) USING utf8 ),`wizard_started` FROM `ccs_block_wizard`
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
Post inserts for MyISAM table ccs_block_wizard
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
Created UTF8 table ccs_blocks (PKEY: block_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
ccs_blocks keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
Continuing with ccs_blocks (PKEY: block_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
Pre inserts for MyISAM table ccs_blocks
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
INSERT IGNORE INTO `x_utf_ccs_blocks` SELECT `block_id`,`block_active`,CONVERT( CAST(`block_name` AS BINARY) USING utf8 ),CONVERT( CAST(`block_description` AS BINARY) USING utf8 ),CONVERT( CAST(`block_key` AS BINARY) USING utf8 ),`block_template`,CONVERT( CAST(`block_type` AS BINARY) USING utf8 ),CONVERT( CAST(`block_config` AS BINARY) USING utf8 ),CONVERT( CAST(`block_content` AS BINARY) USING utf8 ),CONVERT( CAST(`block_cache_ttl` AS BINARY) USING utf8 ),`block_cache_last`,CONVERT( CAST(`block_cache_output` AS BINARY) USING utf8 ),`block_position`,`block_category` FROM `ccs_blocks`
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
Post inserts for MyISAM table ccs_blocks
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
Created UTF8 table ccs_containers (PKEY: container_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
ccs_containers keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
Continuing with ccs_containers (PKEY: container_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
Pre inserts for MyISAM table ccs_containers
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
INSERT IGNORE INTO `x_utf_ccs_containers` SELECT `container_id`,CONVERT( CAST(`container_name` AS BINARY) USING utf8 ),CONVERT( CAST(`container_type` AS BINARY) USING utf8 ),`container_order` FROM `ccs_containers`
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
Post inserts for MyISAM table ccs_containers
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
Created UTF8 table ccs_custom_database_1 (PKEY: primary_id_field)
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
ccs_custom_database_1 keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
Continuing with ccs_custom_database_1 (PKEY: primary_id_field)
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
Pre inserts for MyISAM table ccs_custom_database_1
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
INSERT IGNORE INTO `x_utf_ccs_custom_database_1` SELECT `primary_id_field`,`member_id`,`record_saved`,`record_updated`,CONVERT( CAST(`post_key` AS BINARY) USING utf8 ),`rating_real`,`rating_hits`,`rating_value`,`category_id`,`record_locked`,`record_comments`,`record_comments_queued`,`record_views`,`record_approved`,`record_pinned`,CONVERT( CAST(`record_dynamic_furl` AS BINARY) USING utf8 ),CONVERT( CAST(`record_static_furl` AS BINARY) USING utf8 ),CONVERT( CAST(`record_meta_keywords` AS BINARY) USING utf8 ),CONVERT( CAST(`record_meta_description` AS BINARY) USING utf8 ),`record_template`,`record_topicid`,CONVERT( CAST(`field_1` AS BINARY) USING utf8 ),CONVERT( CAST(`field_2` AS BINARY) USING utf8 ),CONVERT( CAST(`field_3` AS BINARY) USING utf8 ),CONVERT( CAST(`field_4` AS BINARY) USING utf8 ),CONVERT( CAST(`field_5` AS BINARY) USING utf8 ),CONVERT( CAST(`field_6` AS BINARY) USING utf8 ),CONVERT( CAST(`field_7` AS BINARY) USING utf8 ),CONVERT( CAST(`field_8` AS BINARY) USING utf8 ),CONVERT( CAST(`field_9` AS BINARY) USING utf8 ),CONVERT( CAST(`field_20` AS BINARY) USING utf8 ) FROM `ccs_custom_database_1`
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
Post inserts for MyISAM table ccs_custom_database_1
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
Created UTF8 table ccs_custom_database_1_bak (PKEY: primary_id_field)
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
ccs_custom_database_1_bak keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
Continuing with ccs_custom_database_1_bak (PKEY: primary_id_field)
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
Pre inserts for MyISAM table ccs_custom_database_1_bak
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
INSERT IGNORE INTO `x_utf_ccs_custom_database_1_bak` SELECT `primary_id_field`,`member_id`,`record_saved`,`record_updated`,CONVERT( CAST(`post_key` AS BINARY) USING utf8 ),`rating_real`,`rating_hits`,`rating_value`,`category_id`,`record_locked`,`record_comments`,`record_comments_queued`,`record_views`,`record_approved`,`record_pinned`,CONVERT( CAST(`record_dynamic_furl` AS BINARY) USING utf8 ),CONVERT( CAST(`record_static_furl` AS BINARY) USING utf8 ),CONVERT( CAST(`record_meta_keywords` AS BINARY) USING utf8 ),CONVERT( CAST(`record_meta_description` AS BINARY) USING utf8 ),`record_template`,`record_topicid`,CONVERT( CAST(`field_1` AS BINARY) USING utf8 ),CONVERT( CAST(`field_2` AS BINARY) USING utf8 ),CONVERT( CAST(`field_3` AS BINARY) USING utf8 ),CONVERT( CAST(`field_4` AS BINARY) USING utf8 ),CONVERT( CAST(`field_5` AS BINARY) USING utf8 ),CONVERT( CAST(`field_6` AS BINARY) USING utf8 ),CONVERT( CAST(`field_7` AS BINARY) USING utf8 ),CONVERT( CAST(`field_8` AS BINARY) USING utf8 ),CONVERT( CAST(`field_9` AS BINARY) USING utf8 ) FROM `ccs_custom_database_1_bak`
------------------------------------------------
Sun, 29 Apr 2018 03:14:29 +0000
Post inserts for MyISAM table ccs_custom_database_1_bak
------------------------------------------------
Sun, 29 Apr 2018 03:14:30 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:30 +0000
Created UTF8 table ccs_custom_database_1_bak101314 (PKEY: primary_id_field)
------------------------------------------------
Sun, 29 Apr 2018 03:14:30 +0000
ccs_custom_database_1_bak101314 keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:30 +0000
Continuing with ccs_custom_database_1_bak101314 (PKEY: primary_id_field)
------------------------------------------------
Sun, 29 Apr 2018 03:14:30 +0000
Pre inserts for MyISAM table ccs_custom_database_1_bak101314
------------------------------------------------
Sun, 29 Apr 2018 03:14:30 +0000
INSERT IGNORE INTO `x_utf_ccs_custom_database_1_bak101314` SELECT `primary_id_field`,`member_id`,`record_saved`,`record_updated`,CONVERT( CAST(`post_key` AS BINARY) USING utf8 ),`rating_real`,`rating_hits`,`rating_value`,`category_id`,`record_locked`,`record_comments`,`record_comments_queued`,`record_views`,`record_approved`,`record_pinned`,CONVERT( CAST(`record_dynamic_furl` AS BINARY) USING utf8 ),CONVERT( CAST(`record_static_furl` AS BINARY) USING utf8 ),CONVERT( CAST(`record_meta_keywords` AS BINARY) USING utf8 ),CONVERT( CAST(`record_meta_description` AS BINARY) USING utf8 ),`record_template`,`record_topicid`,CONVERT( CAST(`field_1` AS BINARY) USING utf8 ),CONVERT( CAST(`field_2` AS BINARY) USING utf8 ),CONVERT( CAST(`field_3` AS BINARY) USING utf8 ),CONVERT( CAST(`field_4` AS BINARY) USING utf8 ),CONVERT( CAST(`field_5` AS BINARY) USING utf8 ),CONVERT( CAST(`field_6` AS BINARY) USING utf8 ),CONVERT( CAST(`field_7` AS BINARY) USING utf8 ),CONVERT( CAST(`field_8` AS BINARY) USING utf8 ),CONVERT( CAST(`field_9` AS BINARY) USING utf8 ),CONVERT( CAST(`field_20` AS BINARY) USING utf8 ) FROM `ccs_custom_database_1_bak101314`
------------------------------------------------
Sun, 29 Apr 2018 03:14:30 +0000
Post inserts for MyISAM table ccs_custom_database_1_bak101314
------------------------------------------------
Sun, 29 Apr 2018 03:14:30 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Created UTF8 table ccs_database_categories (PKEY: category_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
ccs_database_categories keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Continuing with ccs_database_categories (PKEY: category_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Pre inserts for MyISAM table ccs_database_categories
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
INSERT IGNORE INTO `x_utf_ccs_database_categories` SELECT `category_id`,`category_database_id`,CONVERT( CAST(`category_name` AS BINARY) USING utf8 ),`category_parent_id`,`category_last_record_id`,`category_last_record_date`,`category_last_record_member`,CONVERT( CAST(`category_last_record_name` AS BINARY) USING utf8 ),CONVERT( CAST(`category_last_record_seo_name` AS BINARY) USING utf8 ),CONVERT( CAST(`category_description` AS BINARY) USING utf8 ),`category_position`,`category_records`,`category_records_queued`,`category_record_comments`,`category_record_comments_queued`,`category_has_perms`,`category_show_records`,`category_rss`,CONVERT( CAST(`category_rss_cache` AS BINARY) USING utf8 ),`category_rss_cached`,`category_rss_exclude`,CONVERT( CAST(`category_furl_name` AS BINARY) USING utf8 ),CONVERT( CAST(`category_meta_keywords` AS BINARY) USING utf8 ),CONVERT( CAST(`category_meta_description` AS BINARY) USING utf8 ),`category_template`,`category_forum_override`,`category_forum_record`,`category_forum_comments`,`category_forum_delete`,`category_forum_forum`,CONVERT( CAST(`category_forum_prefix` AS BINARY) USING utf8 ),CONVERT( CAST(`category_forum_suffix` AS BINARY) USING utf8 ),CONVERT( CAST(`category_page_title` AS BINARY) USING utf8 ),`category_tags_override`,`category_tags_enabled`,`category_tags_noprefixes`,CONVERT( CAST(`category_tags_predefined` AS BINARY) USING utf8 ),CONVERT( CAST(`conv_parent` AS BINARY) USING utf8 ) FROM `ccs_database_categories`
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Post inserts for MyISAM table ccs_database_categories
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Created UTF8 table ccs_database_comments (PKEY: comment_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
ccs_database_comments keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Continuing with ccs_database_comments (PKEY: comment_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Pre inserts for MyISAM table ccs_database_comments
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
INSERT IGNORE INTO `x_utf_ccs_database_comments` SELECT `comment_id`,`comment_user`,`comment_database_id`,`comment_record_id`,`comment_date`,CONVERT( CAST(`comment_ip_address` AS BINARY) USING utf8 ),CONVERT( CAST(`comment_post` AS BINARY) USING utf8 ),`comment_approved`,CONVERT( CAST(`comment_author` AS BINARY) USING utf8 ),`comment_edit_date` FROM `ccs_database_comments`
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Post inserts for MyISAM table ccs_database_comments
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Created UTF8 table ccs_database_fields (PKEY: field_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
ccs_database_fields keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Continuing with ccs_database_fields (PKEY: field_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Pre inserts for MyISAM table ccs_database_fields
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
INSERT IGNORE INTO `x_utf_ccs_database_fields` SELECT `field_id`,`field_database_id`,CONVERT( CAST(`field_name` AS BINARY) USING utf8 ),CONVERT( CAST(`field_description` AS BINARY) USING utf8 ),CONVERT( CAST(`field_key` AS BINARY) USING utf8 ),CONVERT( CAST(`field_type` AS BINARY) USING utf8 ),`field_required`,`field_user_editable`,`field_position`,`field_max_length`,CONVERT( CAST(`field_extra` AS BINARY) USING utf8 ),`field_html`,`field_is_numeric`,`field_truncate`,CONVERT( CAST(`field_default_value` AS BINARY) USING utf8 ),`field_display_listing`,`field_display_display`,CONVERT( CAST(`field_format_opts` AS BINARY) USING utf8 ),CONVERT( CAST(`field_validator` AS BINARY) USING utf8 ),CONVERT( CAST(`field_topic_format` AS BINARY) USING utf8 ),`field_filter` FROM `ccs_database_fields`
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Post inserts for MyISAM table ccs_database_fields
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Created UTF8 table ccs_database_moderators (PKEY: moderator_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
ccs_database_moderators keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Continuing with ccs_database_moderators (PKEY: moderator_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Pre inserts for MyISAM table ccs_database_moderators
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
INSERT IGNORE INTO `x_utf_ccs_database_moderators` SELECT `moderator_id`,`moderator_database_id`,CONVERT( CAST(`moderator_type` AS BINARY) USING utf8 ),`moderator_type_id`,`moderator_delete_record`,`moderator_edit_record`,`moderator_lock_record`,`moderator_unlock_record`,`moderator_delete_comment`,`moderator_approve_record`,`moderator_approve_comment`,`moderator_pin_record`,`moderator_add_record`,`moderator_edit_comment`,`moderator_restore_revision`,`moderator_extras` FROM `ccs_database_moderators`
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Post inserts for MyISAM table ccs_database_moderators
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Created UTF8 table ccs_database_modqueue (PKEY: mod_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
ccs_database_modqueue keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Continuing with ccs_database_modqueue (PKEY: mod_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Pre inserts for MyISAM table ccs_database_modqueue
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Post inserts for MyISAM table ccs_database_modqueue
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
No columns to convert in ccs_database_modqueue INSERT INTO FROM SELECT used
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Created UTF8 table ccs_database_ratings (PKEY: rating_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
ccs_database_ratings keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Pre inserts for MyISAM table ccs_database_ratings
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
INSERT IGNORE INTO `x_utf_ccs_database_ratings` SELECT `rating_id`,`rating_user_id`,`rating_database_id`,`rating_record_id`,`rating_rating`,`rating_added`,CONVERT( CAST(`rating_ip_address` AS BINARY) USING utf8 ) FROM `ccs_database_ratings`
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Post inserts for MyISAM table ccs_database_ratings
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Created UTF8 table ccs_database_revisions (PKEY: revision_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
ccs_database_revisions keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Continuing with ccs_database_revisions (PKEY: revision_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Pre inserts for MyISAM table ccs_database_revisions
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
INSERT IGNORE INTO `x_utf_ccs_database_revisions` SELECT `revision_id`,`revision_database_id`,`revision_record_id`,CONVERT( CAST(`revision_data` AS BINARY) USING utf8 ),CONVERT( CAST(`revision_date` AS BINARY) USING utf8 ),`revision_member_id` FROM `ccs_database_revisions`
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Post inserts for MyISAM table ccs_database_revisions
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Created UTF8 table ccs_databases (PKEY: database_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
ccs_databases keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Continuing with ccs_databases (PKEY: database_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Pre inserts for MyISAM table ccs_databases
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
INSERT IGNORE INTO `x_utf_ccs_databases` SELECT `database_id`,CONVERT( CAST(`database_name` AS BINARY) USING utf8 ),CONVERT( CAST(`database_key` AS BINARY) USING utf8 ),CONVERT( CAST(`database_database` AS BINARY) USING utf8 ),CONVERT( CAST(`database_description` AS BINARY) USING utf8 ),`database_field_count`,`database_record_count`,`database_template_listing`,`database_template_display`,`database_template_categories`,`database_all_editable`,`database_revisions`,CONVERT( CAST(`database_field_title` AS BINARY) USING utf8 ),CONVERT( CAST(`database_field_sort` AS BINARY) USING utf8 ),CONVERT( CAST(`database_field_direction` AS BINARY) USING utf8 ),`database_field_perpage`,`database_comment_approve`,`database_record_approve`,`database_rss`,CONVERT( CAST(`database_rss_cache` AS BINARY) USING utf8 ),`database_rss_cached`,CONVERT( CAST(`database_field_content` AS BINARY) USING utf8 ),CONVERT( CAST(`database_lang_sl` AS BINARY) USING utf8 ),CONVERT( CAST(`database_lang_pl` AS BINARY) USING utf8 ),CONVERT( CAST(`database_lang_su` AS BINARY) USING utf8 ),CONVERT( CAST(`database_lang_pu` AS BINARY) USING utf8 ),`database_comment_bump`,`database_featured_article`,`database_is_articles`,`database_forum_record`,`database_forum_comments`,`database_forum_delete`,`database_forum_forum`,CONVERT( CAST(`database_forum_prefix` AS BINARY) USING utf8 ),CONVERT( CAST(`database_forum_suffix` AS BINARY) USING utf8 ),`database_search`,`database_tags_enabled`,`database_tags_noprefixes`,CONVERT( CAST(`database_tags_predefined` AS BINARY) USING utf8 ) FROM `ccs_databases`
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Post inserts for MyISAM table ccs_databases
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Created UTF8 table ccs_folders (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
ccs_folders keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Continuing with ccs_folders (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Pre inserts for MyISAM table ccs_folders
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
INSERT IGNORE INTO `x_utf_ccs_folders` SELECT CONVERT( CAST(`folder_path` AS BINARY) USING utf8 ),`last_modified` FROM `ccs_folders`
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Post inserts for MyISAM table ccs_folders
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Created UTF8 table ccs_menus (PKEY: menu_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
ccs_menus keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Continuing with ccs_menus (PKEY: menu_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Pre inserts for MyISAM table ccs_menus
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
INSERT IGNORE INTO `x_utf_ccs_menus` SELECT `menu_id`,`menu_parent_id`,CONVERT( CAST(`menu_title` AS BINARY) USING utf8 ),CONVERT( CAST(`menu_url` AS BINARY) USING utf8 ),`menu_submenu`,CONVERT( CAST(`menu_position` AS BINARY) USING utf8 ),CONVERT( CAST(`menu_description` AS BINARY) USING utf8 ),CONVERT( CAST(`menu_attributes` AS BINARY) USING utf8 ),CONVERT( CAST(`menu_permissions` AS BINARY) USING utf8 ) FROM `ccs_menus`
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Post inserts for MyISAM table ccs_menus
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Created UTF8 table ccs_page_templates (PKEY: template_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
ccs_page_templates keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Continuing with ccs_page_templates (PKEY: template_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Pre inserts for MyISAM table ccs_page_templates
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
INSERT IGNORE INTO `x_utf_ccs_page_templates` SELECT `template_id`,CONVERT( CAST(`template_name` AS BINARY) USING utf8 ),CONVERT( CAST(`template_desc` AS BINARY) USING utf8 ),CONVERT( CAST(`template_key` AS BINARY) USING utf8 ),CONVERT( CAST(`template_content` AS BINARY) USING utf8 ),`template_updated`,`template_position`,`template_category`,`template_database` FROM `ccs_page_templates`
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Post inserts for MyISAM table ccs_page_templates
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Created UTF8 table ccs_page_wizard (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
ccs_page_wizard keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Continuing with ccs_page_wizard (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Pre inserts for MyISAM table ccs_page_wizard
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
INSERT IGNORE INTO `x_utf_ccs_page_wizard` SELECT CONVERT( CAST(`wizard_id` AS BINARY) USING utf8 ),`wizard_step`,`wizard_edit_id`,CONVERT( CAST(`wizard_name` AS BINARY) USING utf8 ),CONVERT( CAST(`wizard_folder` AS BINARY) USING utf8 ),CONVERT( CAST(`wizard_type` AS BINARY) USING utf8 ),`wizard_template`,CONVERT( CAST(`wizard_content` AS BINARY) USING utf8 ),CONVERT( CAST(`wizard_cache_ttl` AS BINARY) USING utf8 ),CONVERT( CAST(`wizard_perms` AS BINARY) USING utf8 ),CONVERT( CAST(`wizard_seo_name` AS BINARY) USING utf8 ),`wizard_content_only`,CONVERT( CAST(`wizard_meta_keywords` AS BINARY) USING utf8 ),CONVERT( CAST(`wizard_meta_description` AS BINARY) USING utf8 ),`wizard_started`,CONVERT( CAST(`wizard_previous_type` AS BINARY) USING utf8 ),`wizard_ipb_wrapper`,`wizard_omit_filename`,CONVERT( CAST(`wizard_page_title` AS BINARY) USING utf8 ),`wizard_page_quicknav`,CONVERT( CAST(`wizard_database_title` AS BINARY) USING utf8 ) FROM `ccs_page_wizard`
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Post inserts for MyISAM table ccs_page_wizard
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Created UTF8 table ccs_pages (PKEY: page_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
ccs_pages keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Continuing with ccs_pages (PKEY: page_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Pre inserts for MyISAM table ccs_pages
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
INSERT IGNORE INTO `x_utf_ccs_pages` SELECT `page_id`,CONVERT( CAST(`page_name` AS BINARY) USING utf8 ),CONVERT( CAST(`page_seo_name` AS BINARY) USING utf8 ),CONVERT( CAST(`page_folder` AS BINARY) USING utf8 ),CONVERT( CAST(`page_type` AS BINARY) USING utf8 ),`page_last_edited`,`page_template_used`,CONVERT( CAST(`page_content` AS BINARY) USING utf8 ),CONVERT( CAST(`page_cache` AS BINARY) USING utf8 ),CONVERT( CAST(`page_view_perms` AS BINARY) USING utf8 ),CONVERT( CAST(`page_cache_ttl` AS BINARY) USING utf8 ),`page_cache_last`,`page_content_only`,CONVERT( CAST(`page_meta_keywords` AS BINARY) USING utf8 ),CONVERT( CAST(`page_meta_description` AS BINARY) USING utf8 ),CONVERT( CAST(`page_content_type` AS BINARY) USING utf8 ),CONVERT( CAST(`page_template` AS BINARY) USING utf8 ),`page_ipb_wrapper`,`page_omit_filename`,CONVERT( CAST(`page_title` AS BINARY) USING utf8 ),`page_quicknav`,CONVERT( CAST(`page_database_title` AS BINARY) USING utf8 ) FROM `ccs_pages`
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Post inserts for MyISAM table ccs_pages
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Created UTF8 table ccs_revisions (PKEY: revision_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
ccs_revisions keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Continuing with ccs_revisions (PKEY: revision_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Pre inserts for MyISAM table ccs_revisions
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
INSERT IGNORE INTO `x_utf_ccs_revisions` SELECT `revision_id`,CONVERT( CAST(`revision_type` AS BINARY) USING utf8 ),`revision_type_id`,CONVERT( CAST(`revision_content` AS BINARY) USING utf8 ),CONVERT( CAST(`revision_other` AS BINARY) USING utf8 ),`revision_date`,`revision_member` FROM `ccs_revisions`
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Post inserts for MyISAM table ccs_revisions
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Created UTF8 table ccs_slug_memory (PKEY: memory_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
ccs_slug_memory keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Continuing with ccs_slug_memory (PKEY: memory_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Pre inserts for MyISAM table ccs_slug_memory
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
INSERT IGNORE INTO `x_utf_ccs_slug_memory` SELECT `memory_id`,CONVERT( CAST(`memory_url` AS BINARY) USING utf8 ),CONVERT( CAST(`memory_type` AS BINARY) USING utf8 ),`memory_type_id`,`memory_type_id_2` FROM `ccs_slug_memory`
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Post inserts for MyISAM table ccs_slug_memory
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Created UTF8 table ccs_template_blocks (PKEY: tpb_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
ccs_template_blocks keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Continuing with ccs_template_blocks (PKEY: tpb_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Pre inserts for MyISAM table ccs_template_blocks
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
INSERT IGNORE INTO `x_utf_ccs_template_blocks` SELECT `tpb_id`,CONVERT( CAST(`tpb_name` AS BINARY) USING utf8 ),CONVERT( CAST(`tpb_params` AS BINARY) USING utf8 ),CONVERT( CAST(`tpb_content` AS BINARY) USING utf8 ),CONVERT( CAST(`tpb_human_name` AS BINARY) USING utf8 ),CONVERT( CAST(`tpb_app_type` AS BINARY) USING utf8 ),CONVERT( CAST(`tpb_content_type` AS BINARY) USING utf8 ),CONVERT( CAST(`tpb_image` AS BINARY) USING utf8 ),`tpb_position`,`tpb_protected`,CONVERT( CAST(`tpb_desc` AS BINARY) USING utf8 ) FROM `ccs_template_blocks`
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Post inserts for MyISAM table ccs_template_blocks
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Created UTF8 table ccs_template_cache (PKEY: cache_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
ccs_template_cache keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Continuing with ccs_template_cache (PKEY: cache_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Pre inserts for MyISAM table ccs_template_cache
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
INSERT IGNORE INTO `x_utf_ccs_template_cache` SELECT `cache_id`,CONVERT( CAST(`cache_type` AS BINARY) USING utf8 ),`cache_type_id`,CONVERT( CAST(`cache_content` AS BINARY) USING utf8 ) FROM `ccs_template_cache`
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Post inserts for MyISAM table ccs_template_cache
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Created UTF8 table cmtp_bugs (PKEY: bugs_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
cmtp_bugs keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Continuing with cmtp_bugs (PKEY: bugs_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Pre inserts for MyISAM table cmtp_bugs
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
INSERT IGNORE INTO `x_utf_cmtp_bugs` SELECT `bugs_id`,CONVERT( CAST(`bugs_submitter` AS BINARY) USING utf8 ),CONVERT( CAST(`bugs_contact` AS BINARY) USING utf8 ),CONVERT( CAST(`bugs_report` AS BINARY) USING utf8 ),CONVERT( CAST(`bugs_date` AS BINARY) USING utf8 ),`bugs_sent` FROM `cmtp_bugs`
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Post inserts for MyISAM table cmtp_bugs
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Created UTF8 table cmtp_groups (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
cmtp_groups keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Continuing with cmtp_groups (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Pre inserts for MyISAM table cmtp_groups
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
INSERT IGNORE INTO `x_utf_cmtp_groups` SELECT `group_id`,`display_order`,CONVERT( CAST(`replacement_name` AS BINARY) USING utf8 ) FROM `cmtp_groups`
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Post inserts for MyISAM table cmtp_groups
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Created UTF8 table cmtp_members (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
cmtp_members keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Continuing with cmtp_members (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Pre inserts for MyISAM table cmtp_members
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
INSERT IGNORE INTO `x_utf_cmtp_members` SELECT `group_id`,`member_id`,CONVERT( CAST(`etc` AS BINARY) USING utf8 ) FROM `cmtp_members`
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Post inserts for MyISAM table cmtp_members
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Created UTF8 table cmtp_members_added (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
cmtp_members_added keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Continuing with cmtp_members_added (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Pre inserts for MyISAM table cmtp_members_added
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
INSERT IGNORE INTO `x_utf_cmtp_members_added` SELECT `member_group_id`,`member_id`,CONVERT( CAST(`name` AS BINARY) USING utf8 ) FROM `cmtp_members_added`
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Post inserts for MyISAM table cmtp_members_added
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Created UTF8 table contato_antispam (PKEY: qid)
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
contato_antispam keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Continuing with contato_antispam (PKEY: qid)
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Pre inserts for MyISAM table contato_antispam
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
INSERT IGNORE INTO `x_utf_contato_antispam` SELECT `qid`,CONVERT( CAST(`question` AS BINARY) USING utf8 ),CONVERT( CAST(`answer` AS BINARY) USING utf8 ) FROM `contato_antispam`
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Post inserts for MyISAM table contato_antispam
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Created UTF8 table contato_customfields (PKEY: cid)
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
contato_customfields keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Continuing with contato_customfields (PKEY: cid)
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Pre inserts for MyISAM table contato_customfields
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
INSERT IGNORE INTO `x_utf_contato_customfields` SELECT `cid`,CONVERT( CAST(`title` AS BINARY) USING utf8 ),CONVERT( CAST(`description` AS BINARY) USING utf8 ),`charlimit`,`cposition`,`obrigatorio`,`visivel`,CONVERT( CAST(`department` AS BINARY) USING utf8 ) FROM `contato_customfields`
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Post inserts for MyISAM table contato_customfields
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Created UTF8 table contato_departamentos (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
contato_departamentos keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Continuing with contato_departamentos (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Pre inserts for MyISAM table contato_departamentos
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
INSERT IGNORE INTO `x_utf_contato_departamentos` SELECT `id`,CONVERT( CAST(`nome` AS BINARY) USING utf8 ),`forum_id`,`d_order` FROM `contato_departamentos`
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
Post inserts for MyISAM table contato_departamentos
------------------------------------------------
Sun, 29 Apr 2018 03:14:31 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:32 +0000
Created UTF8 table contato_emails (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:32 +0000
contato_emails keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:32 +0000
Continuing with contato_emails (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:32 +0000
Pre inserts for MyISAM table contato_emails
------------------------------------------------
Sun, 29 Apr 2018 03:14:32 +0000
INSERT IGNORE INTO `x_utf_contato_emails` SELECT `id`,CONVERT( CAST(`nome` AS BINARY) USING utf8 ),CONVERT( CAST(`email` AS BINARY) USING utf8 ),`dep_id` FROM `contato_emails`
------------------------------------------------
Sun, 29 Apr 2018 03:14:32 +0000
Post inserts for MyISAM table contato_emails
------------------------------------------------
Sun, 29 Apr 2018 03:14:32 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:32 +0000
Created UTF8 table content_cache_posts (PKEY: cache_content_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:32 +0000
content_cache_posts keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:32 +0000
Continuing with content_cache_posts (PKEY: cache_content_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:32 +0000
No content conversion of content_cache_posts required
------------------------------------------------
Sun, 29 Apr 2018 03:14:32 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:32 +0000
Created UTF8 table content_cache_posts_bak (PKEY: cache_content_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:32 +0000
content_cache_posts_bak keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:32 +0000
Continuing with content_cache_posts_bak (PKEY: cache_content_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:32 +0000
Pre inserts for MyISAM table content_cache_posts_bak
------------------------------------------------
Sun, 29 Apr 2018 03:14:32 +0000
INSERT IGNORE INTO `x_utf_content_cache_posts_bak` SELECT `cache_content_id`,CONVERT( CAST(`cache_content` AS BINARY) USING utf8 ),`cache_updated` FROM `content_cache_posts_bak`
------------------------------------------------
Sun, 29 Apr 2018 03:14:34 +0000
Post inserts for MyISAM table content_cache_posts_bak
------------------------------------------------
Sun, 29 Apr 2018 03:14:34 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:34 +0000
Created UTF8 table content_cache_sigs (PKEY: cache_content_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:34 +0000
content_cache_sigs keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:34 +0000
Continuing with content_cache_sigs (PKEY: cache_content_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:34 +0000
No content conversion of content_cache_sigs required
------------------------------------------------
Sun, 29 Apr 2018 03:14:34 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:34 +0000
Created UTF8 table content_cache_sigs_bak (PKEY: cache_content_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:34 +0000
content_cache_sigs_bak keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:34 +0000
Continuing with content_cache_sigs_bak (PKEY: cache_content_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:34 +0000
Pre inserts for MyISAM table content_cache_sigs_bak
------------------------------------------------
Sun, 29 Apr 2018 03:14:34 +0000
INSERT IGNORE INTO `x_utf_content_cache_sigs_bak` SELECT `cache_content_id`,CONVERT( CAST(`cache_content` AS BINARY) USING utf8 ),`cache_updated` FROM `content_cache_sigs_bak`
------------------------------------------------
Sun, 29 Apr 2018 03:14:34 +0000
Post inserts for MyISAM table content_cache_sigs_bak
------------------------------------------------
Sun, 29 Apr 2018 03:14:34 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:34 +0000
Created UTF8 table conv_apps (PKEY: app_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:34 +0000
conv_apps keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:34 +0000
Continuing with conv_apps (PKEY: app_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:34 +0000
Pre inserts for InnoDB table conv_apps
------------------------------------------------
Sun, 29 Apr 2018 03:14:34 +0000
INSERT IGNORE INTO `x_utf_conv_apps` SELECT `app_id`,CONVERT( CAST(`sw` AS BINARY) USING utf8 ),CONVERT( CAST(`app_key` AS BINARY) USING utf8 ),CONVERT( CAST(`name` AS BINARY) USING utf8 ),`login`,`parent`,CONVERT( CAST(`db_driver` AS BINARY) USING utf8 ),CONVERT( CAST(`db_host` AS BINARY) USING utf8 ),CONVERT( CAST(`db_user` AS BINARY) USING utf8 ),CONVERT( CAST(`db_pass` AS BINARY) USING utf8 ),CONVERT( CAST(`db_db` AS BINARY) USING utf8 ),CONVERT( CAST(`db_prefix` AS BINARY) USING utf8 ),CONVERT( CAST(`db_charset` AS BINARY) USING utf8 ),`app_merge` FROM `conv_apps`
------------------------------------------------
Sun, 29 Apr 2018 03:14:34 +0000
Post inserts for InnoDB table conv_apps
------------------------------------------------
Sun, 29 Apr 2018 03:14:34 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:35 +0000
Created UTF8 table conv_link (PKEY: link_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:35 +0000
conv_link keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:35 +0000
Continuing with conv_link (PKEY: link_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:35 +0000
Pre inserts for InnoDB table conv_link
------------------------------------------------
Sun, 29 Apr 2018 03:14:35 +0000
INSERT IGNORE INTO `x_utf_conv_link` SELECT `link_id`,`ipb_id`,CONVERT( CAST(`foreign_id` AS BINARY) USING utf8 ),CONVERT( CAST(`type` AS BINARY) USING utf8 ),`duplicate`,`app`,CONVERT( CAST(`conv_cats` AS BINARY) USING utf8 ) FROM `conv_link`
------------------------------------------------
Sun, 29 Apr 2018 03:14:57 +0000
Post inserts for InnoDB table conv_link
------------------------------------------------
Sun, 29 Apr 2018 03:14:57 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:57 +0000
Created UTF8 table conv_link_pms (PKEY: link_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:57 +0000
conv_link_pms keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:57 +0000
Continuing with conv_link_pms (PKEY: link_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:57 +0000
Pre inserts for InnoDB table conv_link_pms
------------------------------------------------
Sun, 29 Apr 2018 03:14:57 +0000
INSERT IGNORE INTO `x_utf_conv_link_pms` SELECT `link_id`,`ipb_id`,`foreign_id`,CONVERT( CAST(`type` AS BINARY) USING utf8 ),`duplicate`,`app` FROM `conv_link_pms`
------------------------------------------------
Sun, 29 Apr 2018 03:14:57 +0000
Post inserts for InnoDB table conv_link_pms
------------------------------------------------
Sun, 29 Apr 2018 03:14:57 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:57 +0000
Created UTF8 table conv_link_posts (PKEY: link_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:57 +0000
conv_link_posts keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:14:57 +0000
Continuing with conv_link_posts (PKEY: link_id)
------------------------------------------------
Sun, 29 Apr 2018 03:14:57 +0000
Pre inserts for InnoDB table conv_link_posts
------------------------------------------------
Sun, 29 Apr 2018 03:14:57 +0000
INSERT IGNORE INTO `x_utf_conv_link_posts` SELECT `link_id`,`ipb_id`,`foreign_id`,CONVERT( CAST(`type` AS BINARY) USING utf8 ),`duplicate`,`app` FROM `conv_link_posts`
------------------------------------------------
Sun, 29 Apr 2018 03:15:27 +0000
Post inserts for InnoDB table conv_link_posts
------------------------------------------------
Sun, 29 Apr 2018 03:15:27 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:27 +0000
Created UTF8 table conv_link_topics (PKEY: link_id)
------------------------------------------------
Sun, 29 Apr 2018 03:15:27 +0000
conv_link_topics keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:27 +0000
Continuing with conv_link_topics (PKEY: link_id)
------------------------------------------------
Sun, 29 Apr 2018 03:15:27 +0000
Pre inserts for InnoDB table conv_link_topics
------------------------------------------------
Sun, 29 Apr 2018 03:15:27 +0000
INSERT IGNORE INTO `x_utf_conv_link_topics` SELECT `link_id`,`ipb_id`,`foreign_id`,CONVERT( CAST(`type` AS BINARY) USING utf8 ),`duplicate`,`app` FROM `conv_link_topics`
------------------------------------------------
Sun, 29 Apr 2018 03:15:31 +0000
Post inserts for InnoDB table conv_link_topics
------------------------------------------------
Sun, 29 Apr 2018 03:15:31 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:31 +0000
Created UTF8 table core_applications (PKEY: app_id)
------------------------------------------------
Sun, 29 Apr 2018 03:15:31 +0000
core_applications keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:31 +0000
Continuing with core_applications (PKEY: app_id)
------------------------------------------------
Sun, 29 Apr 2018 03:15:31 +0000
Pre inserts for MyISAM table core_applications
------------------------------------------------
Sun, 29 Apr 2018 03:15:31 +0000
INSERT IGNORE INTO `x_utf_core_applications` SELECT `app_id`,CONVERT( CAST(`app_title` AS BINARY) USING utf8 ),CONVERT( CAST(`app_public_title` AS BINARY) USING utf8 ),CONVERT( CAST(`app_description` AS BINARY) USING utf8 ),CONVERT( CAST(`app_author` AS BINARY) USING utf8 ),CONVERT( CAST(`app_version` AS BINARY) USING utf8 ),`app_long_version`,CONVERT( CAST(`app_directory` AS BINARY) USING utf8 ),`app_added`,`app_position`,`app_protected`,`app_enabled`,CONVERT( CAST(`app_location` AS BINARY) USING utf8 ),`app_hide_tab`,CONVERT( CAST(`app_tab_groups` AS BINARY) USING utf8 ),CONVERT( CAST(`app_website` AS BINARY) USING utf8 ),CONVERT( CAST(`app_update_check` AS BINARY) USING utf8 ),CONVERT( CAST(`app_global_caches` AS BINARY) USING utf8 ),CONVERT( CAST(`app_tab_attributes` AS BINARY) USING utf8 ),CONVERT( CAST(`app_tab_description` AS BINARY) USING utf8 ) FROM `core_applications`
------------------------------------------------
Sun, 29 Apr 2018 03:15:31 +0000
Post inserts for MyISAM table core_applications
------------------------------------------------
Sun, 29 Apr 2018 03:15:31 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:31 +0000
Created UTF8 table core_archive_log (PKEY: archlog_id)
------------------------------------------------
Sun, 29 Apr 2018 03:15:31 +0000
core_archive_log keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:31 +0000
Continuing with core_archive_log (PKEY: archlog_id)
------------------------------------------------
Sun, 29 Apr 2018 03:15:31 +0000
Pre inserts for MyISAM table core_archive_log
------------------------------------------------
Sun, 29 Apr 2018 03:15:31 +0000
INSERT IGNORE INTO `x_utf_core_archive_log` SELECT `archlog_id`,CONVERT( CAST(`archlog_app` AS BINARY) USING utf8 ),`archlog_date`,CONVERT( CAST(`archlog_ids` AS BINARY) USING utf8 ),`archlog_count`,`archlog_is_restore`,`archlog_is_error`,CONVERT( CAST(`archlog_msg` AS BINARY) USING utf8 ) FROM `core_archive_log`
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
Post inserts for MyISAM table core_archive_log
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
Created UTF8 table core_archive_restore (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
core_archive_restore keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
Continuing with core_archive_restore (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
Pre inserts for MyISAM table core_archive_restore
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
INSERT IGNORE INTO `x_utf_core_archive_restore` SELECT `restore_min_tid`,`restore_max_tid`,CONVERT( CAST(`restore_manual_tids` AS BINARY) USING utf8 ) FROM `core_archive_restore`
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
Post inserts for MyISAM table core_archive_restore
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
Created UTF8 table core_archive_rules (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
core_archive_rules keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
Continuing with core_archive_rules (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
Pre inserts for MyISAM table core_archive_rules
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
INSERT IGNORE INTO `x_utf_core_archive_rules` SELECT CONVERT( CAST(`archive_key` AS BINARY) USING utf8 ),CONVERT( CAST(`archive_app` AS BINARY) USING utf8 ),CONVERT( CAST(`archive_field` AS BINARY) USING utf8 ),CONVERT( CAST(`archive_value` AS BINARY) USING utf8 ),CONVERT( CAST(`archive_text` AS BINARY) USING utf8 ),CONVERT( CAST(`archive_unit` AS BINARY) USING utf8 ),`archive_skip` FROM `core_archive_rules`
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
Post inserts for MyISAM table core_archive_rules
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
Created UTF8 table core_editor_autosave (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
core_editor_autosave keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
Continuing with core_editor_autosave (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
Pre inserts for MyISAM table core_editor_autosave
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
INSERT IGNORE INTO `x_utf_core_editor_autosave` SELECT CONVERT( CAST(`eas_key` AS BINARY) USING utf8 ),`eas_member_id`,CONVERT( CAST(`eas_app` AS BINARY) USING utf8 ),CONVERT( CAST(`eas_section` AS BINARY) USING utf8 ),`eas_updated`,CONVERT( CAST(`eas_content` AS BINARY) USING utf8 ) FROM `core_editor_autosave`
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
Post inserts for MyISAM table core_editor_autosave
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
Created UTF8 table core_geolocation_cache (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
core_geolocation_cache keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
Continuing with core_geolocation_cache (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
Pre inserts for MyISAM table core_geolocation_cache
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
INSERT IGNORE INTO `x_utf_core_geolocation_cache` SELECT CONVERT( CAST(`geocache_key` AS BINARY) USING utf8 ),CONVERT( CAST(`geocache_lat` AS BINARY) USING utf8 ),CONVERT( CAST(`geocache_lon` AS BINARY) USING utf8 ),CONVERT( CAST(`geocache_raw` AS BINARY) USING utf8 ),CONVERT( CAST(`geocache_country` AS BINARY) USING utf8 ),CONVERT( CAST(`geocache_district` AS BINARY) USING utf8 ),CONVERT( CAST(`geocache_district2` AS BINARY) USING utf8 ),CONVERT( CAST(`geocache_locality` AS BINARY) USING utf8 ),CONVERT( CAST(`geocache_type` AS BINARY) USING utf8 ),CONVERT( CAST(`geocache_engine` AS BINARY) USING utf8 ),`geocache_added`,CONVERT( CAST(`geocache_short` AS BINARY) USING utf8 ) FROM `core_geolocation_cache`
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
Post inserts for MyISAM table core_geolocation_cache
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
Created UTF8 table core_hooks (PKEY: hook_id)
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
core_hooks keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
Continuing with core_hooks (PKEY: hook_id)
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
Pre inserts for MyISAM table core_hooks
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
INSERT IGNORE INTO `x_utf_core_hooks` SELECT `hook_id`,`hook_enabled`,CONVERT( CAST(`hook_name` AS BINARY) USING utf8 ),CONVERT( CAST(`hook_desc` AS BINARY) USING utf8 ),CONVERT( CAST(`hook_author` AS BINARY) USING utf8 ),CONVERT( CAST(`hook_email` AS BINARY) USING utf8 ),CONVERT( CAST(`hook_website` AS BINARY) USING utf8 ),CONVERT( CAST(`hook_update_check` AS BINARY) USING utf8 ),CONVERT( CAST(`hook_requirements` AS BINARY) USING utf8 ),CONVERT( CAST(`hook_version_human` AS BINARY) USING utf8 ),CONVERT( CAST(`hook_version_long` AS BINARY) USING utf8 ),`hook_installed`,`hook_updated`,`hook_position`,CONVERT( CAST(`hook_extra_data` AS BINARY) USING utf8 ),CONVERT( CAST(`hook_key` AS BINARY) USING utf8 ),CONVERT( CAST(`hook_global_caches` AS BINARY) USING utf8 ) FROM `core_hooks`
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
Post inserts for MyISAM table core_hooks
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
Created UTF8 table core_hooks_files (PKEY: hook_file_id)
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
core_hooks_files keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
Continuing with core_hooks_files (PKEY: hook_file_id)
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
Pre inserts for MyISAM table core_hooks_files
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
INSERT IGNORE INTO `x_utf_core_hooks_files` SELECT `hook_file_id`,`hook_hook_id`,CONVERT( CAST(`hook_file_stored` AS BINARY) USING utf8 ),CONVERT( CAST(`hook_file_real` AS BINARY) USING utf8 ),CONVERT( CAST(`hook_type` AS BINARY) USING utf8 ),CONVERT( CAST(`hook_classname` AS BINARY) USING utf8 ),CONVERT( CAST(`hook_data` AS BINARY) USING utf8 ),CONVERT( CAST(`hooks_source` AS BINARY) USING utf8 ) FROM `core_hooks_files`
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
Post inserts for MyISAM table core_hooks_files
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
Created UTF8 table core_incoming_email_log (PKEY: log_id)
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
core_incoming_email_log keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
Continuing with core_incoming_email_log (PKEY: log_id)
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
Pre inserts for MyISAM table core_incoming_email_log
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
INSERT IGNORE INTO `x_utf_core_incoming_email_log` SELECT `log_id`,CONVERT( CAST(`log_email` AS BINARY) USING utf8 ),`log_time` FROM `core_incoming_email_log`
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
Post inserts for MyISAM table core_incoming_email_log
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
Created UTF8 table core_incoming_emails (PKEY: rule_id)
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
core_incoming_emails keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
Continuing with core_incoming_emails (PKEY: rule_id)
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
Pre inserts for MyISAM table core_incoming_emails
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
INSERT IGNORE INTO `x_utf_core_incoming_emails` SELECT `rule_id`,CONVERT( CAST(`rule_criteria_field` AS BINARY) USING utf8 ),CONVERT( CAST(`rule_criteria_type` AS BINARY) USING utf8 ),CONVERT( CAST(`rule_criteria_value` AS BINARY) USING utf8 ),CONVERT( CAST(`rule_app` AS BINARY) USING utf8 ),`rule_added_by`,`rule_added_date` FROM `core_incoming_emails`
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
Post inserts for MyISAM table core_incoming_emails
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
Created UTF8 table core_inline_messages (PKEY: inline_msg_id)
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
core_inline_messages keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
Continuing with core_inline_messages (PKEY: inline_msg_id)
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
Pre inserts for MyISAM table core_inline_messages
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
INSERT IGNORE INTO `x_utf_core_inline_messages` SELECT `inline_msg_id`,`inline_msg_date`,CONVERT( CAST(`inline_msg_content` AS BINARY) USING utf8 ) FROM `core_inline_messages`
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
Post inserts for MyISAM table core_inline_messages
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
Created UTF8 table core_item_markers (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
core_item_markers keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
Continuing with core_item_markers (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
Pre inserts for MyISAM table core_item_markers
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
INSERT IGNORE INTO `x_utf_core_item_markers` SELECT CONVERT( CAST(`item_key` AS BINARY) USING utf8 ),`item_member_id`,CONVERT( CAST(`item_app` AS BINARY) USING utf8 ),`item_last_update`,`item_last_saved`,`item_unread_count`,CONVERT( CAST(`item_read_array` AS BINARY) USING utf8 ),`item_global_reset`,`item_app_key_1`,`item_app_key_2`,`item_app_key_3`,`item_is_deleted` FROM `core_item_markers`
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
Post inserts for MyISAM table core_item_markers
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
Created UTF8 table core_item_markers_storage (PKEY: item_member_id)
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
core_item_markers_storage keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
Continuing with core_item_markers_storage (PKEY: item_member_id)
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
Pre inserts for MyISAM table core_item_markers_storage
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
INSERT IGNORE INTO `x_utf_core_item_markers_storage` SELECT `item_member_id`,CONVERT( CAST(`item_markers` AS BINARY) USING utf8 ),`item_last_updated`,`item_last_saved` FROM `core_item_markers_storage`
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
Post inserts for MyISAM table core_item_markers_storage
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
Created UTF8 table core_like (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
core_like keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
Continuing with core_like (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
Pre inserts for MyISAM table core_like
------------------------------------------------
Sun, 29 Apr 2018 03:15:32 +0000
INSERT IGNORE INTO `x_utf_core_like` SELECT CONVERT( CAST(`like_id` AS BINARY) USING utf8 ),CONVERT( CAST(`like_lookup_id` AS BINARY) USING utf8 ),CONVERT( CAST(`like_lookup_area` AS BINARY) USING utf8 ),CONVERT( CAST(`like_app` AS BINARY) USING utf8 ),CONVERT( CAST(`like_area` AS BINARY) USING utf8 ),`like_rel_id`,`like_member_id`,`like_is_anon`,`like_added`,`like_notify_do`,CONVERT( CAST(`like_notify_meta` AS BINARY) USING utf8 ),CONVERT( CAST(`like_notify_freq` AS BINARY) USING utf8 ),`like_notify_sent`,`like_visible` FROM `core_like`
------------------------------------------------
Sun, 29 Apr 2018 03:15:33 +0000
Post inserts for MyISAM table core_like
------------------------------------------------
Sun, 29 Apr 2018 03:15:33 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:33 +0000
Created UTF8 table core_like_cache (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:15:33 +0000
core_like_cache keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:33 +0000
Continuing with core_like_cache (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:15:33 +0000
Pre inserts for MyISAM table core_like_cache
------------------------------------------------
Sun, 29 Apr 2018 03:15:33 +0000
INSERT IGNORE INTO `x_utf_core_like_cache` SELECT CONVERT( CAST(`like_cache_id` AS BINARY) USING utf8 ),CONVERT( CAST(`like_cache_app` AS BINARY) USING utf8 ),CONVERT( CAST(`like_cache_area` AS BINARY) USING utf8 ),`like_cache_rel_id`,CONVERT( CAST(`like_cache_data` AS BINARY) USING utf8 ),`like_cache_expire` FROM `core_like_cache`
------------------------------------------------
Sun, 29 Apr 2018 03:15:36 +0000
Post inserts for MyISAM table core_like_cache
------------------------------------------------
Sun, 29 Apr 2018 03:15:36 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:36 +0000
Created UTF8 table core_rss_imported (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:15:36 +0000
core_rss_imported keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:36 +0000
Continuing with core_rss_imported (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:15:36 +0000
Pre inserts for MyISAM table core_rss_imported
------------------------------------------------
Sun, 29 Apr 2018 03:15:36 +0000
INSERT IGNORE INTO `x_utf_core_rss_imported` SELECT CONVERT( CAST(`rss_guid` AS BINARY) USING utf8 ),CONVERT( CAST(`rss_foreign_key` AS BINARY) USING utf8 ) FROM `core_rss_imported`
------------------------------------------------
Sun, 29 Apr 2018 03:15:36 +0000
Post inserts for MyISAM table core_rss_imported
------------------------------------------------
Sun, 29 Apr 2018 03:15:36 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:36 +0000
Created UTF8 table core_share_links (PKEY: share_id)
------------------------------------------------
Sun, 29 Apr 2018 03:15:36 +0000
core_share_links keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:36 +0000
Continuing with core_share_links (PKEY: share_id)
------------------------------------------------
Sun, 29 Apr 2018 03:15:36 +0000
Pre inserts for MyISAM table core_share_links
------------------------------------------------
Sun, 29 Apr 2018 03:15:36 +0000
INSERT IGNORE INTO `x_utf_core_share_links` SELECT `share_id`,CONVERT( CAST(`share_title` AS BINARY) USING utf8 ),CONVERT( CAST(`share_key` AS BINARY) USING utf8 ),`share_enabled`,`share_position`,`share_canonical`,CONVERT( CAST(`share_groups` AS BINARY) USING utf8 ) FROM `core_share_links`
------------------------------------------------
Sun, 29 Apr 2018 03:15:36 +0000
Post inserts for MyISAM table core_share_links
------------------------------------------------
Sun, 29 Apr 2018 03:15:36 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:36 +0000
Created UTF8 table core_share_links_log (PKEY: log_id)
------------------------------------------------
Sun, 29 Apr 2018 03:15:36 +0000
core_share_links_log keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:36 +0000
Continuing with core_share_links_log (PKEY: log_id)
------------------------------------------------
Sun, 29 Apr 2018 03:15:36 +0000
Pre inserts for MyISAM table core_share_links_log
------------------------------------------------
Sun, 29 Apr 2018 03:15:36 +0000
INSERT IGNORE INTO `x_utf_core_share_links_log` SELECT `log_id`,`log_date`,`log_member_id`,CONVERT( CAST(`log_url` AS BINARY) USING utf8 ),CONVERT( CAST(`log_title` AS BINARY) USING utf8 ),CONVERT( CAST(`log_share_key` AS BINARY) USING utf8 ),CONVERT( CAST(`log_data_app` AS BINARY) USING utf8 ),CONVERT( CAST(`log_data_type` AS BINARY) USING utf8 ),`log_data_primary_id`,`log_data_secondary_id`,CONVERT( CAST(`log_ip_address` AS BINARY) USING utf8 ) FROM `core_share_links_log`
------------------------------------------------
Sun, 29 Apr 2018 03:15:39 +0000
Post inserts for MyISAM table core_share_links_log
------------------------------------------------
Sun, 29 Apr 2018 03:15:50 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:50 +0000
Created UTF8 table core_soft_delete_log (PKEY: sdl_id)
------------------------------------------------
Sun, 29 Apr 2018 03:15:50 +0000
core_soft_delete_log keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:50 +0000
Continuing with core_soft_delete_log (PKEY: sdl_id)
------------------------------------------------
Sun, 29 Apr 2018 03:15:50 +0000
Pre inserts for MyISAM table core_soft_delete_log
------------------------------------------------
Sun, 29 Apr 2018 03:15:50 +0000
INSERT IGNORE INTO `x_utf_core_soft_delete_log` SELECT `sdl_id`,`sdl_obj_id`,CONVERT( CAST(`sdl_obj_key` AS BINARY) USING utf8 ),`sdl_obj_member_id`,`sdl_obj_date`,CONVERT( CAST(`sdl_obj_reason` AS BINARY) USING utf8 ),`sdl_locked` FROM `core_soft_delete_log`
------------------------------------------------
Sun, 29 Apr 2018 03:15:50 +0000
Post inserts for MyISAM table core_soft_delete_log
------------------------------------------------
Sun, 29 Apr 2018 03:15:50 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:50 +0000
Created UTF8 table core_sys_bookmarks (PKEY: bookmark_id)
------------------------------------------------
Sun, 29 Apr 2018 03:15:50 +0000
core_sys_bookmarks keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:50 +0000
Continuing with core_sys_bookmarks (PKEY: bookmark_id)
------------------------------------------------
Sun, 29 Apr 2018 03:15:50 +0000
Pre inserts for MyISAM table core_sys_bookmarks
------------------------------------------------
Sun, 29 Apr 2018 03:15:50 +0000
INSERT IGNORE INTO `x_utf_core_sys_bookmarks` SELECT `bookmark_id`,`bookmark_member_id`,CONVERT( CAST(`bookmark_title` AS BINARY) USING utf8 ),CONVERT( CAST(`bookmark_url` AS BINARY) USING utf8 ),`bookmark_home`,`bookmark_pos` FROM `core_sys_bookmarks`
------------------------------------------------
Sun, 29 Apr 2018 03:15:50 +0000
Post inserts for MyISAM table core_sys_bookmarks
------------------------------------------------
Sun, 29 Apr 2018 03:15:50 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:50 +0000
Created UTF8 table core_sys_conf_settings (PKEY: conf_id)
------------------------------------------------
Sun, 29 Apr 2018 03:15:50 +0000
core_sys_conf_settings keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:50 +0000
Continuing with core_sys_conf_settings (PKEY: conf_id)
------------------------------------------------
Sun, 29 Apr 2018 03:15:50 +0000
Pre inserts for MyISAM table core_sys_conf_settings
------------------------------------------------
Sun, 29 Apr 2018 03:15:50 +0000
INSERT IGNORE INTO `x_utf_core_sys_conf_settings` SELECT `conf_id`,CONVERT( CAST(`conf_title` AS BINARY) USING utf8 ),CONVERT( CAST(`conf_description` AS BINARY) USING utf8 ),`conf_group`,CONVERT( CAST(`conf_type` AS BINARY) USING utf8 ),CONVERT( CAST(`conf_key` AS BINARY) USING utf8 ),CONVERT( CAST(`conf_value` AS BINARY) USING utf8 ),CONVERT( CAST(`conf_default` AS BINARY) USING utf8 ),CONVERT( CAST(`conf_extra` AS BINARY) USING utf8 ),CONVERT( CAST(`conf_evalphp` AS BINARY) USING utf8 ),`conf_protected`,`conf_position`,CONVERT( CAST(`conf_start_group` AS BINARY) USING utf8 ),`conf_add_cache`,CONVERT( CAST(`conf_keywords` AS BINARY) USING utf8 ) FROM `core_sys_conf_settings`
------------------------------------------------
Sun, 29 Apr 2018 03:15:50 +0000
Post inserts for MyISAM table core_sys_conf_settings
------------------------------------------------
Sun, 29 Apr 2018 03:15:50 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:50 +0000
Created UTF8 table core_sys_cp_sessions (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:15:50 +0000
core_sys_cp_sessions keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:50 +0000
Continuing with core_sys_cp_sessions (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:15:50 +0000
Pre inserts for MyISAM table core_sys_cp_sessions
------------------------------------------------
Sun, 29 Apr 2018 03:15:50 +0000
INSERT IGNORE INTO `x_utf_core_sys_cp_sessions` SELECT CONVERT( CAST(`session_id` AS BINARY) USING utf8 ),CONVERT( CAST(`session_ip_address` AS BINARY) USING utf8 ),CONVERT( CAST(`session_member_name` AS BINARY) USING utf8 ),`session_member_id`,CONVERT( CAST(`session_member_login_key` AS BINARY) USING utf8 ),CONVERT( CAST(`session_location` AS BINARY) USING utf8 ),`session_log_in_time`,`session_running_time`,CONVERT( CAST(`session_url` AS BINARY) USING utf8 ),CONVERT( CAST(`session_app_data` AS BINARY) USING utf8 ) FROM `core_sys_cp_sessions`
------------------------------------------------
Sun, 29 Apr 2018 03:15:50 +0000
Post inserts for MyISAM table core_sys_cp_sessions
------------------------------------------------
Sun, 29 Apr 2018 03:15:50 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:50 +0000
Created UTF8 table core_sys_lang (PKEY: lang_id)
------------------------------------------------
Sun, 29 Apr 2018 03:15:50 +0000
core_sys_lang keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:50 +0000
Continuing with core_sys_lang (PKEY: lang_id)
------------------------------------------------
Sun, 29 Apr 2018 03:15:50 +0000
Pre inserts for MyISAM table core_sys_lang
------------------------------------------------
Sun, 29 Apr 2018 03:15:50 +0000
INSERT IGNORE INTO `x_utf_core_sys_lang` SELECT `lang_id`,CONVERT( CAST(`lang_short` AS BINARY) USING utf8 ),CONVERT( CAST(`lang_title` AS BINARY) USING utf8 ),`lang_default`,`lang_isrtl`,`lang_protected` FROM `core_sys_lang`
------------------------------------------------
Sun, 29 Apr 2018 03:15:50 +0000
Post inserts for MyISAM table core_sys_lang
------------------------------------------------
Sun, 29 Apr 2018 03:15:50 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:50 +0000
Created UTF8 table core_sys_lang_words (PKEY: word_id)
------------------------------------------------
Sun, 29 Apr 2018 03:15:50 +0000
core_sys_lang_words keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:50 +0000
Continuing with core_sys_lang_words (PKEY: word_id)
------------------------------------------------
Sun, 29 Apr 2018 03:15:50 +0000
Pre inserts for MyISAM table core_sys_lang_words
------------------------------------------------
Sun, 29 Apr 2018 03:15:50 +0000
INSERT IGNORE INTO `x_utf_core_sys_lang_words` SELECT `word_id`,`lang_id`,CONVERT( CAST(`word_app` AS BINARY) USING utf8 ),CONVERT( CAST(`word_pack` AS BINARY) USING utf8 ),CONVERT( CAST(`word_key` AS BINARY) USING utf8 ),CONVERT( CAST(`word_default` AS BINARY) USING utf8 ),CONVERT( CAST(`word_custom` AS BINARY) USING utf8 ),CONVERT( CAST(`word_default_version` AS BINARY) USING utf8 ),CONVERT( CAST(`word_custom_version` AS BINARY) USING utf8 ),`word_js` FROM `core_sys_lang_words`
------------------------------------------------
Sun, 29 Apr 2018 03:15:50 +0000
Post inserts for MyISAM table core_sys_lang_words
------------------------------------------------
Sun, 29 Apr 2018 03:15:51 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:51 +0000
Created UTF8 table core_sys_login (PKEY: sys_login_id)
------------------------------------------------
Sun, 29 Apr 2018 03:15:51 +0000
core_sys_login keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:51 +0000
Continuing with core_sys_login (PKEY: sys_login_id)
------------------------------------------------
Sun, 29 Apr 2018 03:15:51 +0000
Pre inserts for MyISAM table core_sys_login
------------------------------------------------
Sun, 29 Apr 2018 03:15:51 +0000
INSERT IGNORE INTO `x_utf_core_sys_login` SELECT `sys_login_id`,CONVERT( CAST(`sys_cookie` AS BINARY) USING utf8 ),CONVERT( CAST(`sys_bookmarks` AS BINARY) USING utf8 ) FROM `core_sys_login`
------------------------------------------------
Sun, 29 Apr 2018 03:15:51 +0000
Post inserts for MyISAM table core_sys_login
------------------------------------------------
Sun, 29 Apr 2018 03:15:51 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:51 +0000
Created UTF8 table core_sys_module (PKEY: sys_module_id)
------------------------------------------------
Sun, 29 Apr 2018 03:15:51 +0000
core_sys_module keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:51 +0000
Continuing with core_sys_module (PKEY: sys_module_id)
------------------------------------------------
Sun, 29 Apr 2018 03:15:51 +0000
Pre inserts for MyISAM table core_sys_module
------------------------------------------------
Sun, 29 Apr 2018 03:15:51 +0000
INSERT IGNORE INTO `x_utf_core_sys_module` SELECT `sys_module_id`,CONVERT( CAST(`sys_module_title` AS BINARY) USING utf8 ),CONVERT( CAST(`sys_module_application` AS BINARY) USING utf8 ),CONVERT( CAST(`sys_module_key` AS BINARY) USING utf8 ),CONVERT( CAST(`sys_module_description` AS BINARY) USING utf8 ),CONVERT( CAST(`sys_module_version` AS BINARY) USING utf8 ),`sys_module_protected`,`sys_module_visible`,`sys_module_position`,`sys_module_admin` FROM `core_sys_module`
------------------------------------------------
Sun, 29 Apr 2018 03:15:51 +0000
Post inserts for MyISAM table core_sys_module
------------------------------------------------
Sun, 29 Apr 2018 03:15:51 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:51 +0000
Created UTF8 table core_sys_settings_titles (PKEY: conf_title_id)
------------------------------------------------
Sun, 29 Apr 2018 03:15:51 +0000
core_sys_settings_titles keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:51 +0000
Continuing with core_sys_settings_titles (PKEY: conf_title_id)
------------------------------------------------
Sun, 29 Apr 2018 03:15:51 +0000
Pre inserts for MyISAM table core_sys_settings_titles
------------------------------------------------
Sun, 29 Apr 2018 03:15:51 +0000
INSERT IGNORE INTO `x_utf_core_sys_settings_titles` SELECT `conf_title_id`,CONVERT( CAST(`conf_title_title` AS BINARY) USING utf8 ),CONVERT( CAST(`conf_title_desc` AS BINARY) USING utf8 ),`conf_title_count`,`conf_title_noshow`,CONVERT( CAST(`conf_title_keyword` AS BINARY) USING utf8 ),CONVERT( CAST(`conf_title_app` AS BINARY) USING utf8 ),CONVERT( CAST(`conf_title_tab` AS BINARY) USING utf8 ) FROM `core_sys_settings_titles`
------------------------------------------------
Sun, 29 Apr 2018 03:15:51 +0000
Post inserts for MyISAM table core_sys_settings_titles
------------------------------------------------
Sun, 29 Apr 2018 03:15:51 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:51 +0000
Created UTF8 table core_tags (PKEY: tag_id)
------------------------------------------------
Sun, 29 Apr 2018 03:15:51 +0000
core_tags keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:51 +0000
Continuing with core_tags (PKEY: tag_id)
------------------------------------------------
Sun, 29 Apr 2018 03:15:51 +0000
Pre inserts for MyISAM table core_tags
------------------------------------------------
Sun, 29 Apr 2018 03:15:51 +0000
INSERT IGNORE INTO `x_utf_core_tags` SELECT `tag_id`,CONVERT( CAST(`tag_aai_lookup` AS BINARY) USING utf8 ),CONVERT( CAST(`tag_aap_lookup` AS BINARY) USING utf8 ),CONVERT( CAST(`tag_meta_app` AS BINARY) USING utf8 ),CONVERT( CAST(`tag_meta_area` AS BINARY) USING utf8 ),`tag_meta_id`,`tag_meta_parent_id`,`tag_member_id`,`tag_added`,`tag_prefix`,CONVERT( CAST(`tag_text` AS BINARY) USING utf8 ) FROM `core_tags`
------------------------------------------------
Sun, 29 Apr 2018 03:15:51 +0000
Post inserts for MyISAM table core_tags
------------------------------------------------
Sun, 29 Apr 2018 03:15:51 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:51 +0000
Created UTF8 table core_tags_cache (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:15:51 +0000
core_tags_cache keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:51 +0000
Continuing with core_tags_cache (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:15:51 +0000
Pre inserts for MyISAM table core_tags_cache
------------------------------------------------
Sun, 29 Apr 2018 03:15:51 +0000
INSERT IGNORE INTO `x_utf_core_tags_cache` SELECT CONVERT( CAST(`tag_cache_key` AS BINARY) USING utf8 ),CONVERT( CAST(`tag_cache_text` AS BINARY) USING utf8 ),`tag_cache_date` FROM `core_tags_cache`
------------------------------------------------
Sun, 29 Apr 2018 03:15:51 +0000
Post inserts for MyISAM table core_tags_cache
------------------------------------------------
Sun, 29 Apr 2018 03:15:51 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:51 +0000
Created UTF8 table core_tags_perms (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:15:51 +0000
core_tags_perms keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:51 +0000
Continuing with core_tags_perms (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:15:51 +0000
Pre inserts for MyISAM table core_tags_perms
------------------------------------------------
Sun, 29 Apr 2018 03:15:51 +0000
INSERT IGNORE INTO `x_utf_core_tags_perms` SELECT CONVERT( CAST(`tag_perm_aai_lookup` AS BINARY) USING utf8 ),CONVERT( CAST(`tag_perm_aap_lookup` AS BINARY) USING utf8 ),CONVERT( CAST(`tag_perm_text` AS BINARY) USING utf8 ),`tag_perm_visible` FROM `core_tags_perms`
------------------------------------------------
Sun, 29 Apr 2018 03:15:51 +0000
Post inserts for MyISAM table core_tags_perms
------------------------------------------------
Sun, 29 Apr 2018 03:15:51 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:51 +0000
Created UTF8 table core_uagent_groups (PKEY: ugroup_id)
------------------------------------------------
Sun, 29 Apr 2018 03:15:51 +0000
core_uagent_groups keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:51 +0000
Continuing with core_uagent_groups (PKEY: ugroup_id)
------------------------------------------------
Sun, 29 Apr 2018 03:15:51 +0000
Pre inserts for MyISAM table core_uagent_groups
------------------------------------------------
Sun, 29 Apr 2018 03:15:51 +0000
INSERT IGNORE INTO `x_utf_core_uagent_groups` SELECT `ugroup_id`,CONVERT( CAST(`ugroup_title` AS BINARY) USING utf8 ),CONVERT( CAST(`ugroup_array` AS BINARY) USING utf8 ) FROM `core_uagent_groups`
------------------------------------------------
Sun, 29 Apr 2018 03:15:51 +0000
Post inserts for MyISAM table core_uagent_groups
------------------------------------------------
Sun, 29 Apr 2018 03:15:51 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:51 +0000
Created UTF8 table core_uagents (PKEY: uagent_id)
------------------------------------------------
Sun, 29 Apr 2018 03:15:51 +0000
core_uagents keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:51 +0000
Continuing with core_uagents (PKEY: uagent_id)
------------------------------------------------
Sun, 29 Apr 2018 03:15:51 +0000
Pre inserts for MyISAM table core_uagents
------------------------------------------------
Sun, 29 Apr 2018 03:15:51 +0000
INSERT IGNORE INTO `x_utf_core_uagents` SELECT `uagent_id`,CONVERT( CAST(`uagent_key` AS BINARY) USING utf8 ),CONVERT( CAST(`uagent_name` AS BINARY) USING utf8 ),CONVERT( CAST(`uagent_regex` AS BINARY) USING utf8 ),`uagent_regex_capture`,CONVERT( CAST(`uagent_type` AS BINARY) USING utf8 ),`uagent_position`,CONVERT( CAST(`uagent_default_regex` AS BINARY) USING utf8 ) FROM `core_uagents`
------------------------------------------------
Sun, 29 Apr 2018 03:15:51 +0000
Post inserts for MyISAM table core_uagents
------------------------------------------------
Sun, 29 Apr 2018 03:15:51 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:52 +0000
Created UTF8 table custom_bbcode (PKEY: bbcode_id)
------------------------------------------------
Sun, 29 Apr 2018 03:15:52 +0000
custom_bbcode keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:52 +0000
Continuing with custom_bbcode (PKEY: bbcode_id)
------------------------------------------------
Sun, 29 Apr 2018 03:15:52 +0000
Pre inserts for MyISAM table custom_bbcode
------------------------------------------------
Sun, 29 Apr 2018 03:15:52 +0000
INSERT IGNORE INTO `x_utf_custom_bbcode` SELECT `bbcode_id`,CONVERT( CAST(`bbcode_title` AS BINARY) USING utf8 ),CONVERT( CAST(`bbcode_desc` AS BINARY) USING utf8 ),CONVERT( CAST(`bbcode_tag` AS BINARY) USING utf8 ),CONVERT( CAST(`bbcode_replace` AS BINARY) USING utf8 ),`bbcode_useoption`,CONVERT( CAST(`bbcode_example` AS BINARY) USING utf8 ),`bbcode_switch_option`,CONVERT( CAST(`bbcode_menu_option_text` AS BINARY) USING utf8 ),CONVERT( CAST(`bbcode_menu_content_text` AS BINARY) USING utf8 ),`bbcode_single_tag`,CONVERT( CAST(`bbcode_groups` AS BINARY) USING utf8 ),CONVERT( CAST(`bbcode_sections` AS BINARY) USING utf8 ),CONVERT( CAST(`bbcode_php_plugin` AS BINARY) USING utf8 ),`bbcode_no_parsing`,`bbcode_protected`,CONVERT( CAST(`bbcode_aliases` AS BINARY) USING utf8 ),`bbcode_optional_option`,CONVERT( CAST(`bbcode_image` AS BINARY) USING utf8 ),CONVERT( CAST(`bbcode_app` AS BINARY) USING utf8 ),CONVERT( CAST(`bbcode_custom_regex` AS BINARY) USING utf8 ) FROM `custom_bbcode`
------------------------------------------------
Sun, 29 Apr 2018 03:15:52 +0000
Post inserts for MyISAM table custom_bbcode
------------------------------------------------
Sun, 29 Apr 2018 03:15:52 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:52 +0000
Created UTF8 table dnames_change (PKEY: dname_id)
------------------------------------------------
Sun, 29 Apr 2018 03:15:52 +0000
dnames_change keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:52 +0000
Continuing with dnames_change (PKEY: dname_id)
------------------------------------------------
Sun, 29 Apr 2018 03:15:52 +0000
Pre inserts for MyISAM table dnames_change
------------------------------------------------
Sun, 29 Apr 2018 03:15:52 +0000
INSERT IGNORE INTO `x_utf_dnames_change` SELECT `dname_id`,`dname_member_id`,`dname_date`,CONVERT( CAST(`dname_ip_address` AS BINARY) USING utf8 ),CONVERT( CAST(`dname_previous` AS BINARY) USING utf8 ),CONVERT( CAST(`dname_current` AS BINARY) USING utf8 ),`dname_discount` FROM `dnames_change`
------------------------------------------------
Sun, 29 Apr 2018 03:15:52 +0000
Post inserts for MyISAM table dnames_change
------------------------------------------------
Sun, 29 Apr 2018 03:15:52 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:52 +0000
Created UTF8 table dp3_rs_referrals (PKEY: i_id)
------------------------------------------------
Sun, 29 Apr 2018 03:15:52 +0000
dp3_rs_referrals keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:52 +0000
Continuing with dp3_rs_referrals (PKEY: i_id)
------------------------------------------------
Sun, 29 Apr 2018 03:15:52 +0000
Pre inserts for InnoDB table dp3_rs_referrals
------------------------------------------------
Sun, 29 Apr 2018 03:15:52 +0000
INSERT IGNORE INTO `x_utf_dp3_rs_referrals` SELECT `i_id`,`i_inviter_id`,`i_invited_id`,CONVERT( CAST(`i_secure_key` AS BINARY) USING utf8 ),`i_time`,CONVERT( CAST(`i_invited_ip` AS BINARY) USING utf8 ),CONVERT( CAST(`i_friend_mail` AS BINARY) USING utf8 ),CONVERT( CAST(`i_body` AS BINARY) USING utf8 ),CONVERT( CAST(`i_status` AS BINARY) USING utf8 ),`i_times_sent`,`i_user_pending` FROM `dp3_rs_referrals`
------------------------------------------------
Sun, 29 Apr 2018 03:15:52 +0000
Post inserts for InnoDB table dp3_rs_referrals
------------------------------------------------
Sun, 29 Apr 2018 03:15:52 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:52 +0000
Created UTF8 table emoticons (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:15:52 +0000
emoticons keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:52 +0000
Continuing with emoticons (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:15:52 +0000
Pre inserts for MyISAM table emoticons
------------------------------------------------
Sun, 29 Apr 2018 03:15:52 +0000
INSERT IGNORE INTO `x_utf_emoticons` SELECT `id`,CONVERT( CAST(`typed` AS BINARY) USING utf8 ),CONVERT( CAST(`image` AS BINARY) USING utf8 ),`clickable`,CONVERT( CAST(`emo_set` AS BINARY) USING utf8 ),`emo_position` FROM `emoticons`
------------------------------------------------
Sun, 29 Apr 2018 03:15:52 +0000
Post inserts for MyISAM table emoticons
------------------------------------------------
Sun, 29 Apr 2018 03:15:52 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:52 +0000
Created UTF8 table error_logs (PKEY: log_id)
------------------------------------------------
Sun, 29 Apr 2018 03:15:52 +0000
error_logs keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:52 +0000
Continuing with error_logs (PKEY: log_id)
------------------------------------------------
Sun, 29 Apr 2018 03:15:52 +0000
Pre inserts for MyISAM table error_logs
------------------------------------------------
Sun, 29 Apr 2018 03:15:52 +0000
INSERT IGNORE INTO `x_utf_error_logs` SELECT `log_id`,`log_member`,`log_date`,CONVERT( CAST(`log_error` AS BINARY) USING utf8 ),CONVERT( CAST(`log_error_code` AS BINARY) USING utf8 ),CONVERT( CAST(`log_ip_address` AS BINARY) USING utf8 ),CONVERT( CAST(`log_request_uri` AS BINARY) USING utf8 ) FROM `error_logs`
------------------------------------------------
Sun, 29 Apr 2018 03:15:52 +0000
Post inserts for MyISAM table error_logs
------------------------------------------------
Sun, 29 Apr 2018 03:15:52 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:53 +0000
Created UTF8 table export_posts (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:15:53 +0000
export_posts keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:15:53 +0000
Continuing with export_posts (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:15:53 +0000
Pre inserts for InnoDB table export_posts
------------------------------------------------
Sun, 29 Apr 2018 03:15:53 +0000
INSERT IGNORE INTO `x_utf_export_posts` SELECT `id`,`posted_by_uid`,`thread_id`,CONVERT( CAST(`title` AS BINARY) USING utf8 ),CONVERT( CAST(`content` AS BINARY) USING utf8 ),CONVERT( CAST(`post_timestamp` AS BINARY) USING utf8 ),`rating`,CONVERT( CAST(`edit_timestamp` AS BINARY) USING utf8 ),`edited_by_uid`,`status` FROM `export_posts`
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
Post inserts for InnoDB table export_posts
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
Created UTF8 table faq (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
faq keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
Continuing with faq (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
Pre inserts for MyISAM table faq
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
INSERT IGNORE INTO `x_utf_faq` SELECT `id`,CONVERT( CAST(`title` AS BINARY) USING utf8 ),CONVERT( CAST(`text` AS BINARY) USING utf8 ),CONVERT( CAST(`description` AS BINARY) USING utf8 ),`position`,CONVERT( CAST(`app` AS BINARY) USING utf8 ) FROM `faq`
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
Post inserts for MyISAM table faq
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
Created UTF8 table fcontent (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
fcontent keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
Continuing with fcontent (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
Pre inserts for MyISAM table fcontent
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
INSERT IGNORE INTO `x_utf_fcontent` SELECT `id`,`f_slideshow`,`f_tid`,CONVERT( CAST(`f_name` AS BINARY) USING utf8 ),CONVERT( CAST(`f_URL` AS BINARY) USING utf8 ),CONVERT( CAST(`f_URLinNewWindow` AS BINARY) USING utf8 ),CONVERT( CAST(`f_image` AS BINARY) USING utf8 ),CONVERT( CAST(`f_imageURL` AS BINARY) USING utf8 ),`f_order1`,`f_order2`,`f_hideTitle` FROM `fcontent`
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
Post inserts for MyISAM table fcontent
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
Created UTF8 table fcontent_slideshow (PKEY: ssid)
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
fcontent_slideshow keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
Continuing with fcontent_slideshow (PKEY: ssid)
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
Pre inserts for MyISAM table fcontent_slideshow
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
INSERT IGNORE INTO `x_utf_fcontent_slideshow` SELECT `ssid`,CONVERT( CAST(`slideshow_name` AS BINARY) USING utf8 ),CONVERT( CAST(`slideshow_showname` AS BINARY) USING utf8 ),CONVERT( CAST(`slideshow_pagetype` AS BINARY) USING utf8 ),CONVERT( CAST(`slideshow_pagelist` AS BINARY) USING utf8 ),CONVERT( CAST(`slideshow_style` AS BINARY) USING utf8 ),CONVERT( CAST(`slideshow_total_items` AS BINARY) USING utf8 ),CONVERT( CAST(`slideshow_maxSlides` AS BINARY) USING utf8 ),CONVERT( CAST(`slideshow_img_w` AS BINARY) USING utf8 ),CONVERT( CAST(`slideshow_img_h` AS BINARY) USING utf8 ),CONVERT( CAST(`slideshow_autoplay` AS BINARY) USING utf8 ),CONVERT( CAST(`slideshow_speed` AS BINARY) USING utf8 ),CONVERT( CAST(`slideshow_duration` AS BINARY) USING utf8 ),CONVERT( CAST(`slideshow_shownav` AS BINARY) USING utf8 ),CONVERT( CAST(`slideshow_showtitle` AS BINARY) USING utf8 ),CONVERT( CAST(`slideshow_method` AS BINARY) USING utf8 ),CONVERT( CAST(`slideshow_randomcontent` AS BINARY) USING utf8 ),CONVERT( CAST(`slideshow_forums` AS BINARY) USING utf8 ),CONVERT( CAST(`slideshow_sortkey` AS BINARY) USING utf8 ),CONVERT( CAST(`slideshow_sortby` AS BINARY) USING utf8 ),CONVERT( CAST(`slideshow_rssURL` AS BINARY) USING utf8 ),CONVERT( CAST(`slideshow_minSlides` AS BINARY) USING utf8 ) FROM `fcontent_slideshow`
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
Post inserts for MyISAM table fcontent_slideshow
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
Created UTF8 table forum_perms (PKEY: perm_id)
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
forum_perms keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
Continuing with forum_perms (PKEY: perm_id)
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
Pre inserts for MyISAM table forum_perms
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
INSERT IGNORE INTO `x_utf_forum_perms` SELECT `perm_id`,CONVERT( CAST(`perm_name` AS BINARY) USING utf8 ) FROM `forum_perms`
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
Post inserts for MyISAM table forum_perms
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
Created UTF8 table forums (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
forums keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
Continuing with forums (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
Pre inserts for MyISAM table forums
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
INSERT IGNORE INTO `x_utf_forums` SELECT `id`,`topics`,`posts`,`last_post`,`last_poster_id`,CONVERT( CAST(`last_poster_name` AS BINARY) USING utf8 ),CONVERT( CAST(`name` AS BINARY) USING utf8 ),CONVERT( CAST(`description` AS BINARY) USING utf8 ),`position`,`use_ibc`,`use_html`,CONVERT( CAST(`password` AS BINARY) USING utf8 ),CONVERT( CAST(`password_override` AS BINARY) USING utf8 ),CONVERT( CAST(`last_title` AS BINARY) USING utf8 ),`last_id`,CONVERT( CAST(`sort_key` AS BINARY) USING utf8 ),CONVERT( CAST(`sort_order` AS BINARY) USING utf8 ),`prune`,CONVERT( CAST(`topicfilter` AS BINARY) USING utf8 ),`show_rules`,`preview_posts`,`allow_poll`,`allow_pollbump`,`inc_postcount`,`skin_id`,`parent_id`,CONVERT( CAST(`redirect_url` AS BINARY) USING utf8 ),`redirect_on`,`redirect_hits`,CONVERT( CAST(`rules_title` AS BINARY) USING utf8 ),CONVERT( CAST(`rules_text` AS BINARY) USING utf8 ),CONVERT( CAST(`notify_modq_emails` AS BINARY) USING utf8 ),`sub_can_post`,CONVERT( CAST(`permission_custom_error` AS BINARY) USING utf8 ),`permission_showtopic`,`queued_topics`,`queued_posts`,`forum_allow_rating`,`forum_last_deletion`,CONVERT( CAST(`newest_title` AS BINARY) USING utf8 ),`newest_id`,`min_posts_post`,`min_posts_view`,`can_view_others`,`hide_last_info`,CONVERT( CAST(`name_seo` AS BINARY) USING utf8 ),CONVERT( CAST(`seo_last_title` AS BINARY) USING utf8 ),CONVERT( CAST(`seo_last_name` AS BINARY) USING utf8 ),CONVERT( CAST(`last_x_topic_ids` AS BINARY) USING utf8 ),`forums_bitoptions`,`disable_sharelinks`,`deleted_posts`,`deleted_topics`,CONVERT( CAST(`tag_predefined` AS BINARY) USING utf8 ),`archived_topics`,`archived_posts`,CONVERT( CAST(`ipseo_priority` AS BINARY) USING utf8 ),`viglink`,CONVERT( CAST(`conv_parent` AS BINARY) USING utf8 ),CONVERT( CAST(`newest_prefix` AS BINARY) USING utf8 ),`require_prefix`,CONVERT( CAST(`default_prefix` AS BINARY) USING utf8 ),CONVERT( CAST(`default_tags` AS BINARY) USING utf8 ),CONVERT( CAST(`tag_mode` AS BINARY) USING utf8 ),`show_prefix_in_desc`,CONVERT( CAST(`mobile_name` AS BINARY) USING utf8 ) FROM `forums`
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
Post inserts for MyISAM table forums
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
Created UTF8 table forums_archive_posts (PKEY: archive_id)
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
forums_archive_posts keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
Continuing with forums_archive_posts (PKEY: archive_id)
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
Pre inserts for MyISAM table forums_archive_posts
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
INSERT IGNORE INTO `x_utf_forums_archive_posts` SELECT `archive_id`,`archive_author_id`,CONVERT( CAST(`archive_author_name` AS BINARY) USING utf8 ),CONVERT( CAST(`archive_ip_address` AS BINARY) USING utf8 ),`archive_content_date`,CONVERT( CAST(`archive_content` AS BINARY) USING utf8 ),`archive_queued`,`archive_topic_id`,`archive_is_first`,`archive_bwoptions`,CONVERT( CAST(`archive_attach_key` AS BINARY) USING utf8 ),`archive_html_mode`,`archive_show_signature`,`archive_show_emoticons`,`archive_show_edited_by`,`archive_edit_time`,CONVERT( CAST(`archive_edit_name` AS BINARY) USING utf8 ),CONVERT( CAST(`archive_edit_reason` AS BINARY) USING utf8 ),`archive_added`,`archive_restored`,`archive_forum_id` FROM `forums_archive_posts`
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
Post inserts for MyISAM table forums_archive_posts
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
Created UTF8 table forums_recent_posts (PKEY: post_id)
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
forums_recent_posts keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
Continuing with forums_recent_posts (PKEY: post_id)
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
Pre inserts for MyISAM table forums_recent_posts
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
Post inserts for MyISAM table forums_recent_posts
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
No columns to convert in forums_recent_posts INSERT INTO FROM SELECT used
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
Created UTF8 table gallery_albums (PKEY: album_id)
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
gallery_albums keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
Pre inserts for MyISAM table gallery_albums
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
INSERT IGNORE INTO `x_utf_gallery_albums` SELECT `album_id`,`album_category_id`,`album_owner_id`,CONVERT( CAST(`album_name` AS BINARY) USING utf8 ),CONVERT( CAST(`album_name_seo` AS BINARY) USING utf8 ),CONVERT( CAST(`album_description` AS BINARY) USING utf8 ),`album_type`,`album_count_imgs`,`album_count_comments`,`album_count_imgs_hidden`,`album_count_comments_hidden`,`album_cover_img_id`,`album_last_img_id`,`album_last_img_date`,CONVERT( CAST(`album_sort_options` AS BINARY) USING utf8 ),`album_allow_comments`,`album_allow_rating`,`album_rating_aggregate`,`album_rating_count`,`album_rating_total`,`album_after_forum_id`,`album_position`,`album_watermark`,CONVERT( CAST(`album_last_x_images` AS BINARY) USING utf8 ) FROM `gallery_albums`
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
Post inserts for MyISAM table gallery_albums
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
Created UTF8 table gallery_bandwidth (PKEY: bid)
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
gallery_bandwidth keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
Continuing with gallery_bandwidth (PKEY: bid)
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
Pre inserts for MyISAM table gallery_bandwidth
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
INSERT IGNORE INTO `x_utf_gallery_bandwidth` SELECT `bid`,`member_id`,CONVERT( CAST(`file_name` AS BINARY) USING utf8 ),`bdate`,`bsize` FROM `gallery_bandwidth`
------------------------------------------------
Sun, 29 Apr 2018 03:16:47 +0000
Post inserts for MyISAM table gallery_bandwidth
------------------------------------------------
Sun, 29 Apr 2018 03:16:48 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:16:48 +0000
Created UTF8 table gallery_categories (PKEY: category_id)
------------------------------------------------
Sun, 29 Apr 2018 03:16:48 +0000
gallery_categories keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:16:48 +0000
Continuing with gallery_categories (PKEY: category_id)
------------------------------------------------
Sun, 29 Apr 2018 03:16:48 +0000
Pre inserts for MyISAM table gallery_categories
------------------------------------------------
Sun, 29 Apr 2018 03:16:48 +0000
INSERT IGNORE INTO `x_utf_gallery_categories` SELECT `category_id`,`category_parent_id`,CONVERT( CAST(`category_name` AS BINARY) USING utf8 ),CONVERT( CAST(`category_name_seo` AS BINARY) USING utf8 ),CONVERT( CAST(`category_description` AS BINARY) USING utf8 ),`category_count_imgs`,`category_count_comments`,`category_count_imgs_hidden`,`category_count_comments_hidden`,`category_cover_img_id`,`category_last_img_id`,`category_last_img_date`,`category_type`,CONVERT( CAST(`category_sort_options` AS BINARY) USING utf8 ),`category_allow_comments`,`category_allow_rating`,`category_approve_img`,`category_approve_com`,CONVERT( CAST(`category_rules` AS BINARY) USING utf8 ),`category_rating_aggregate`,`category_rating_count`,`category_rating_total`,`category_after_forum_id`,`category_watermark`,`category_position`,`category_can_tag`,CONVERT( CAST(`category_preset_tags` AS BINARY) USING utf8 ),`category_public_albums`,`category_nonpublic_albums` FROM `gallery_categories`
------------------------------------------------
Sun, 29 Apr 2018 03:16:48 +0000
Post inserts for MyISAM table gallery_categories
------------------------------------------------
Sun, 29 Apr 2018 03:16:48 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:16:48 +0000
Created UTF8 table gallery_comments (PKEY: comment_id)
------------------------------------------------
Sun, 29 Apr 2018 03:16:48 +0000
gallery_comments keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:16:48 +0000
Continuing with gallery_comments (PKEY: comment_id)
------------------------------------------------
Sun, 29 Apr 2018 03:16:48 +0000
Pre inserts for MyISAM table gallery_comments
------------------------------------------------
Sun, 29 Apr 2018 03:16:48 +0000
INSERT IGNORE INTO `x_utf_gallery_comments` SELECT `comment_id`,`comment_edit_time`,`comment_author_id`,CONVERT( CAST(`comment_author_name` AS BINARY) USING utf8 ),CONVERT( CAST(`comment_ip_address` AS BINARY) USING utf8 ),`comment_post_date`,CONVERT( CAST(`comment_text` AS BINARY) USING utf8 ),`comment_approved`,`comment_img_id` FROM `gallery_comments`
------------------------------------------------
Sun, 29 Apr 2018 03:16:48 +0000
Post inserts for MyISAM table gallery_comments
------------------------------------------------
Sun, 29 Apr 2018 03:16:48 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:16:48 +0000
Created UTF8 table gallery_images (PKEY: image_id)
------------------------------------------------
Sun, 29 Apr 2018 03:16:48 +0000
gallery_images keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:16:48 +0000
Continuing with gallery_images (PKEY: image_id)
------------------------------------------------
Sun, 29 Apr 2018 03:16:48 +0000
Pre inserts for MyISAM table gallery_images
------------------------------------------------
Sun, 29 Apr 2018 03:16:48 +0000
INSERT IGNORE INTO `x_utf_gallery_images` SELECT `image_id`,`image_member_id`,`image_category_id`,`image_album_id`,CONVERT( CAST(`image_caption` AS BINARY) USING utf8 ),CONVERT( CAST(`image_description` AS BINARY) USING utf8 ),CONVERT( CAST(`image_directory` AS BINARY) USING utf8 ),CONVERT( CAST(`image_masked_file_name` AS BINARY) USING utf8 ),CONVERT( CAST(`image_medium_file_name` AS BINARY) USING utf8 ),CONVERT( CAST(`image_original_file_name` AS BINARY) USING utf8 ),CONVERT( CAST(`image_file_name` AS BINARY) USING utf8 ),`image_file_size`,CONVERT( CAST(`image_file_type` AS BINARY) USING utf8 ),`image_approved`,`image_thumbnail`,`image_views`,`image_comments`,`image_comments_queued`,`image_date`,`image_ratings_total`,`image_ratings_count`,`image_rating`,`image_pinned`,`image_last_comment`,`image_media`,CONVERT( CAST(`image_credit_info` AS BINARY) USING utf8 ),CONVERT( CAST(`image_copyright` AS BINARY) USING utf8 ),CONVERT( CAST(`image_metadata` AS BINARY) USING utf8 ),CONVERT( CAST(`image_media_thumb` AS BINARY) USING utf8 ),CONVERT( CAST(`image_caption_seo` AS BINARY) USING utf8 ),CONVERT( CAST(`image_notes` AS BINARY) USING utf8 ),`image_privacy`,CONVERT( CAST(`image_data` AS BINARY) USING utf8 ),CONVERT( CAST(`image_parent_permission` AS BINARY) USING utf8 ),`image_feature_flag`,CONVERT( CAST(`image_gps_raw` AS BINARY) USING utf8 ),CONVERT( CAST(`image_gps_latlon` AS BINARY) USING utf8 ),`image_gps_show`,CONVERT( CAST(`image_gps_lat` AS BINARY) USING utf8 ),CONVERT( CAST(`image_gps_lon` AS BINARY) USING utf8 ),CONVERT( CAST(`image_loc_short` AS BINARY) USING utf8 ),CONVERT( CAST(`image_media_data` AS BINARY) USING utf8 ) FROM `gallery_images`
------------------------------------------------
Sun, 29 Apr 2018 03:16:50 +0000
Post inserts for MyISAM table gallery_images
------------------------------------------------
Sun, 29 Apr 2018 03:16:54 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:16:54 +0000
Created UTF8 table gallery_images_uploads (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:16:54 +0000
gallery_images_uploads keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:16:54 +0000
Continuing with gallery_images_uploads (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:16:54 +0000
Pre inserts for MyISAM table gallery_images_uploads
------------------------------------------------
Sun, 29 Apr 2018 03:16:54 +0000
INSERT IGNORE INTO `x_utf_gallery_images_uploads` SELECT CONVERT( CAST(`upload_key` AS BINARY) USING utf8 ),CONVERT( CAST(`upload_session` AS BINARY) USING utf8 ),`upload_member_id`,`upload_album_id`,`upload_category_id`,`upload_date`,CONVERT( CAST(`upload_file_directory` AS BINARY) USING utf8 ),CONVERT( CAST(`upload_file_orig_name` AS BINARY) USING utf8 ),CONVERT( CAST(`upload_file_name` AS BINARY) USING utf8 ),CONVERT( CAST(`upload_file_name_original` AS BINARY) USING utf8 ),`upload_file_size`,CONVERT( CAST(`upload_file_type` AS BINARY) USING utf8 ),CONVERT( CAST(`upload_thumb_name` AS BINARY) USING utf8 ),CONVERT( CAST(`upload_medium_name` AS BINARY) USING utf8 ),CONVERT( CAST(`upload_title` AS BINARY) USING utf8 ),CONVERT( CAST(`upload_description` AS BINARY) USING utf8 ),CONVERT( CAST(`upload_copyright` AS BINARY) USING utf8 ),CONVERT( CAST(`upload_exif` AS BINARY) USING utf8 ),CONVERT( CAST(`upload_data` AS BINARY) USING utf8 ),`upload_feature_flag`,CONVERT( CAST(`upload_geodata` AS BINARY) USING utf8 ),CONVERT( CAST(`upload_media_data` AS BINARY) USING utf8 ) FROM `gallery_images_uploads`
------------------------------------------------
Sun, 29 Apr 2018 03:16:54 +0000
Post inserts for MyISAM table gallery_images_uploads
------------------------------------------------
Sun, 29 Apr 2018 03:16:54 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:16:54 +0000
Created UTF8 table gallery_moderators (PKEY: mod_id)
------------------------------------------------
Sun, 29 Apr 2018 03:16:54 +0000
gallery_moderators keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:16:54 +0000
Continuing with gallery_moderators (PKEY: mod_id)
------------------------------------------------
Sun, 29 Apr 2018 03:16:54 +0000
Pre inserts for MyISAM table gallery_moderators
------------------------------------------------
Sun, 29 Apr 2018 03:16:54 +0000
INSERT IGNORE INTO `x_utf_gallery_moderators` SELECT `mod_id`,CONVERT( CAST(`mod_type` AS BINARY) USING utf8 ),`mod_type_id`,CONVERT( CAST(`mod_type_name` AS BINARY) USING utf8 ),CONVERT( CAST(`mod_categories` AS BINARY) USING utf8 ),`mod_can_approve`,`mod_can_edit`,`mod_can_hide`,`mod_can_delete`,`mod_can_approve_comments`,`mod_can_edit_comments`,`mod_can_delete_comments`,`mod_can_move`,`mod_set_cover_image` FROM `gallery_moderators`
------------------------------------------------
Sun, 29 Apr 2018 03:16:54 +0000
Post inserts for MyISAM table gallery_moderators
------------------------------------------------
Sun, 29 Apr 2018 03:16:54 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:16:54 +0000
Created UTF8 table gallery_ratings (PKEY: rate_id)
------------------------------------------------
Sun, 29 Apr 2018 03:16:54 +0000
gallery_ratings keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:16:54 +0000
Continuing with gallery_ratings (PKEY: rate_id)
------------------------------------------------
Sun, 29 Apr 2018 03:16:54 +0000
Pre inserts for MyISAM table gallery_ratings
------------------------------------------------
Sun, 29 Apr 2018 03:16:54 +0000
INSERT IGNORE INTO `x_utf_gallery_ratings` SELECT `rate_id`,`rate_member_id`,CONVERT( CAST(`rate_type` AS BINARY) USING utf8 ),`rate_type_id`,`rate_date`,`rate_rate` FROM `gallery_ratings`
------------------------------------------------
Sun, 29 Apr 2018 03:16:54 +0000
Post inserts for MyISAM table gallery_ratings
------------------------------------------------
Sun, 29 Apr 2018 03:16:54 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:16:54 +0000
Created UTF8 table gaplus_events (PKEY: ga_event_id)
------------------------------------------------
Sun, 29 Apr 2018 03:16:54 +0000
gaplus_events keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:16:54 +0000
Continuing with gaplus_events (PKEY: ga_event_id)
------------------------------------------------
Sun, 29 Apr 2018 03:16:54 +0000
Pre inserts for MyISAM table gaplus_events
------------------------------------------------
Sun, 29 Apr 2018 03:16:54 +0000
INSERT IGNORE INTO `x_utf_gaplus_events` SELECT `ga_event_id`,CONVERT( CAST(`ga_event_title` AS BINARY) USING utf8 ),CONVERT( CAST(`ga_event_element` AS BINARY) USING utf8 ),CONVERT( CAST(`ga_event_category` AS BINARY) USING utf8 ),CONVERT( CAST(`ga_event_event` AS BINARY) USING utf8 ),`ga_event_active` FROM `gaplus_events`
------------------------------------------------
Sun, 29 Apr 2018 03:16:54 +0000
Post inserts for MyISAM table gaplus_events
------------------------------------------------
Sun, 29 Apr 2018 03:16:54 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:16:54 +0000
Created UTF8 table gaplus_vars (PKEY: ga_id)
------------------------------------------------
Sun, 29 Apr 2018 03:16:54 +0000
gaplus_vars keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:16:54 +0000
Continuing with gaplus_vars (PKEY: ga_id)
------------------------------------------------
Sun, 29 Apr 2018 03:16:54 +0000
Pre inserts for MyISAM table gaplus_vars
------------------------------------------------
Sun, 29 Apr 2018 03:16:54 +0000
INSERT IGNORE INTO `x_utf_gaplus_vars` SELECT `ga_id`,`ga_var_active`,CONVERT( CAST(`ga_app` AS BINARY) USING utf8 ),CONVERT( CAST(`ga_module` AS BINARY) USING utf8 ),CONVERT( CAST(`ga_section` AS BINARY) USING utf8 ),CONVERT( CAST(`ga_var_title` AS BINARY) USING utf8 ),CONVERT( CAST(`ga_var` AS BINARY) USING utf8 ),CONVERT( CAST(`ga_request` AS BINARY) USING utf8 ),`ga_level` FROM `gaplus_vars`
------------------------------------------------
Sun, 29 Apr 2018 03:16:54 +0000
Post inserts for MyISAM table gaplus_vars
------------------------------------------------
Sun, 29 Apr 2018 03:16:54 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:16:54 +0000
Created UTF8 table groups (PKEY: g_id)
------------------------------------------------
Sun, 29 Apr 2018 03:16:54 +0000
groups keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:16:54 +0000
Continuing with groups (PKEY: g_id)
------------------------------------------------
Sun, 29 Apr 2018 03:16:54 +0000
Pre inserts for MyISAM table groups
------------------------------------------------
Sun, 29 Apr 2018 03:16:54 +0000
INSERT IGNORE INTO `x_utf_groups` SELECT `g_id`,`g_view_board`,`g_mem_info`,`g_other_topics`,`g_use_search`,`g_edit_profile`,`g_post_new_topics`,`g_reply_own_topics`,`g_reply_other_topics`,`g_edit_posts`,`g_delete_own_posts`,`g_open_close_posts`,`g_delete_own_topics`,`g_post_polls`,`g_vote_polls`,`g_use_pm`,`g_is_supmod`,`g_access_cp`,CONVERT( CAST(`g_title` AS BINARY) USING utf8 ),`g_append_edit`,`g_access_offline`,`g_avoid_q`,`g_avoid_flood`,CONVERT( CAST(`g_icon` AS BINARY) USING utf8 ),`g_attach_max`,CONVERT( CAST(`prefix` AS BINARY) USING utf8 ),CONVERT( CAST(`suffix` AS BINARY) USING utf8 ),`g_max_messages`,`g_max_mass_pm`,`g_search_flood`,`g_edit_cutoff`,CONVERT( CAST(`g_promotion` AS BINARY) USING utf8 ),`g_hide_from_list`,`g_post_closed`,CONVERT( CAST(`g_perm_id` AS BINARY) USING utf8 ),CONVERT( CAST(`g_photo_max_vars` AS BINARY) USING utf8 ),`g_dohtml`,`g_edit_topic`,`g_bypass_badwords`,`g_can_msg_attach`,`g_attach_per_post`,`g_topic_rate_setting`,`g_dname_changes`,`g_dname_date`,`g_mod_preview`,`g_rep_max_positive`,`g_rep_max_negative`,CONVERT( CAST(`g_signature_limits` AS BINARY) USING utf8 ),`g_can_add_friends`,`g_hide_online_list`,`g_bitoptions`,`g_pm_perday`,`g_mod_post_unit`,`g_ppd_limit`,`g_ppd_unit`,`g_displayname_unit`,`g_sig_unit`,`g_pm_flood_mins`,`g_max_notifications`,`g_max_bgimg_upload`,`g_max_diskspace`,`g_max_upload`,`g_max_transfer`,`g_max_views`,`g_create_albums`,`g_create_albums_private`,`g_create_albums_fo`,`g_album_limit`,`g_img_album_limit`,`g_edit_own`,`g_del_own`,`g_img_local`,`g_movies`,`g_movie_size`,`g_gallery_use`,`g_delete_own_albums`,`g_blog_attach_max`,`g_blog_attach_per_entry`,`g_blog_do_html`,`g_blog_do_commenthtml`,`g_blog_allowpoll`,`g_blog_allowprivate`,`g_blog_allowprivclub`,`g_blog_alloweditors`,`g_blog_allowskinchoose`,`g_blog_preventpublish`,CONVERT( CAST(`g_blog_settings` AS BINARY) USING utf8 ),`g_fcontent_canView`,CONVERT( CAST(`g_fcontent_excludeFGroup` AS BINARY) USING utf8 ),`g_fcontent_canAdd_topic`,`g_fcontent_canEdit_topic`,`g_fcontent_canMove_topic`,`g_fcontent_canDel_topic`,`g_fcontent_canAdd_custom`,`g_fcontent_canEdit_custom`,`g_fcontent_canMove_custom`,`g_fcontent_canDel_custom`,CONVERT( CAST(`g_fcontent_manaG` AS BINARY) USING utf8 ) FROM `groups`
------------------------------------------------
Sun, 29 Apr 2018 03:16:54 +0000
Post inserts for MyISAM table groups
------------------------------------------------
Sun, 29 Apr 2018 03:16:54 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:16:54 +0000
Created UTF8 table ignored_users (PKEY: ignore_id)
------------------------------------------------
Sun, 29 Apr 2018 03:16:54 +0000
ignored_users keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:16:54 +0000
Continuing with ignored_users (PKEY: ignore_id)
------------------------------------------------
Sun, 29 Apr 2018 03:16:54 +0000
Pre inserts for MyISAM table ignored_users
------------------------------------------------
Sun, 29 Apr 2018 03:16:54 +0000
Post inserts for MyISAM table ignored_users
------------------------------------------------
Sun, 29 Apr 2018 03:16:54 +0000
No columns to convert in ignored_users INSERT INTO FROM SELECT used
------------------------------------------------
Sun, 29 Apr 2018 03:16:54 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:16:54 +0000
Created UTF8 table inline_notifications (PKEY: notify_id)
------------------------------------------------
Sun, 29 Apr 2018 03:16:54 +0000
inline_notifications keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:16:54 +0000
Pre inserts for MyISAM table inline_notifications
------------------------------------------------
Sun, 29 Apr 2018 03:16:54 +0000
INSERT IGNORE INTO `x_utf_inline_notifications` SELECT `notify_id`,`notify_to_id`,`notify_sent`,`notify_read`,CONVERT( CAST(`notify_title` AS BINARY) USING utf8 ),CONVERT( CAST(`notify_text` AS BINARY) USING utf8 ),`notify_from_id`,CONVERT( CAST(`notify_type_key` AS BINARY) USING utf8 ),CONVERT( CAST(`notify_url` AS BINARY) USING utf8 ),CONVERT( CAST(`notify_meta_app` AS BINARY) USING utf8 ),CONVERT( CAST(`notify_meta_area` AS BINARY) USING utf8 ),`notify_meta_id`,CONVERT( CAST(`notify_meta_key` AS BINARY) USING utf8 ) FROM `inline_notifications`
------------------------------------------------
Sun, 29 Apr 2018 03:16:55 +0000
Post inserts for MyISAM table inline_notifications
------------------------------------------------
Sun, 29 Apr 2018 03:16:55 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:16:55 +0000
Created UTF8 table login_methods (PKEY: login_id)
------------------------------------------------
Sun, 29 Apr 2018 03:16:55 +0000
login_methods keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:16:55 +0000
Continuing with login_methods (PKEY: login_id)
------------------------------------------------
Sun, 29 Apr 2018 03:16:55 +0000
Pre inserts for MyISAM table login_methods
------------------------------------------------
Sun, 29 Apr 2018 03:16:55 +0000
INSERT IGNORE INTO `x_utf_login_methods` SELECT `login_id`,CONVERT( CAST(`login_title` AS BINARY) USING utf8 ),CONVERT( CAST(`login_description` AS BINARY) USING utf8 ),CONVERT( CAST(`login_folder_name` AS BINARY) USING utf8 ),CONVERT( CAST(`login_maintain_url` AS BINARY) USING utf8 ),CONVERT( CAST(`login_register_url` AS BINARY) USING utf8 ),CONVERT( CAST(`login_alt_login_html` AS BINARY) USING utf8 ),CONVERT( CAST(`login_alt_acp_html` AS BINARY) USING utf8 ),`login_settings`,`login_enabled`,`login_safemode`,`login_replace_form`,CONVERT( CAST(`login_user_id` AS BINARY) USING utf8 ),CONVERT( CAST(`login_login_url` AS BINARY) USING utf8 ),CONVERT( CAST(`login_logout_url` AS BINARY) USING utf8 ),`login_order`,CONVERT( CAST(`login_custom_config` AS BINARY) USING utf8 ) FROM `login_methods`
------------------------------------------------
Sun, 29 Apr 2018 03:16:55 +0000
Post inserts for MyISAM table login_methods
------------------------------------------------
Sun, 29 Apr 2018 03:16:55 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:16:55 +0000
Created UTF8 table mail_error_logs (PKEY: mlog_id)
------------------------------------------------
Sun, 29 Apr 2018 03:16:55 +0000
mail_error_logs keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:16:55 +0000
Continuing with mail_error_logs (PKEY: mlog_id)
------------------------------------------------
Sun, 29 Apr 2018 03:16:55 +0000
Pre inserts for MyISAM table mail_error_logs
------------------------------------------------
Sun, 29 Apr 2018 03:16:55 +0000
INSERT IGNORE INTO `x_utf_mail_error_logs` SELECT `mlog_id`,`mlog_date`,CONVERT( CAST(`mlog_to` AS BINARY) USING utf8 ),CONVERT( CAST(`mlog_from` AS BINARY) USING utf8 ),CONVERT( CAST(`mlog_subject` AS BINARY) USING utf8 ),CONVERT( CAST(`mlog_content` AS BINARY) USING utf8 ),CONVERT( CAST(`mlog_msg` AS BINARY) USING utf8 ),CONVERT( CAST(`mlog_code` AS BINARY) USING utf8 ),CONVERT( CAST(`mlog_smtp_msg` AS BINARY) USING utf8 ) FROM `mail_error_logs`
------------------------------------------------
Sun, 29 Apr 2018 03:16:55 +0000
Post inserts for MyISAM table mail_error_logs
------------------------------------------------
Sun, 29 Apr 2018 03:16:55 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:16:55 +0000
Created UTF8 table mail_queue (PKEY: mail_id)
------------------------------------------------
Sun, 29 Apr 2018 03:16:55 +0000
mail_queue keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:16:55 +0000
Continuing with mail_queue (PKEY: mail_id)
------------------------------------------------
Sun, 29 Apr 2018 03:16:55 +0000
Pre inserts for MyISAM table mail_queue
------------------------------------------------
Sun, 29 Apr 2018 03:16:55 +0000
INSERT IGNORE INTO `x_utf_mail_queue` SELECT `mail_id`,`mail_date`,CONVERT( CAST(`mail_to` AS BINARY) USING utf8 ),CONVERT( CAST(`mail_from` AS BINARY) USING utf8 ),CONVERT( CAST(`mail_subject` AS BINARY) USING utf8 ),CONVERT( CAST(`mail_content` AS BINARY) USING utf8 ),`mail_html_on`,CONVERT( CAST(`mail_cc` AS BINARY) USING utf8 ),CONVERT( CAST(`mail_html_content` AS BINARY) USING utf8 ) FROM `mail_queue`
------------------------------------------------
Sun, 29 Apr 2018 03:16:55 +0000
Post inserts for MyISAM table mail_queue
------------------------------------------------
Sun, 29 Apr 2018 03:16:55 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:16:55 +0000
Created UTF8 table member_status_actions (PKEY: action_id)
------------------------------------------------
Sun, 29 Apr 2018 03:16:55 +0000
member_status_actions keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:16:55 +0000
Continuing with member_status_actions (PKEY: action_id)
------------------------------------------------
Sun, 29 Apr 2018 03:16:55 +0000
Pre inserts for MyISAM table member_status_actions
------------------------------------------------
Sun, 29 Apr 2018 03:16:55 +0000
INSERT IGNORE INTO `x_utf_member_status_actions` SELECT `action_id`,`action_status_id`,`action_reply_id`,`action_member_id`,`action_date`,CONVERT( CAST(`action_key` AS BINARY) USING utf8 ),`action_status_owner`,CONVERT( CAST(`action_app` AS BINARY) USING utf8 ),CONVERT( CAST(`action_custom_text` AS BINARY) USING utf8 ),`action_custom`,CONVERT( CAST(`action_custom_url` AS BINARY) USING utf8 ) FROM `member_status_actions`
------------------------------------------------
Sun, 29 Apr 2018 03:16:55 +0000
Post inserts for MyISAM table member_status_actions
------------------------------------------------
Sun, 29 Apr 2018 03:16:55 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:16:55 +0000
Created UTF8 table member_status_replies (PKEY: reply_id)
------------------------------------------------
Sun, 29 Apr 2018 03:16:55 +0000
member_status_replies keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:16:55 +0000
Continuing with member_status_replies (PKEY: reply_id)
------------------------------------------------
Sun, 29 Apr 2018 03:16:55 +0000
Pre inserts for MyISAM table member_status_replies
------------------------------------------------
Sun, 29 Apr 2018 03:16:55 +0000
INSERT IGNORE INTO `x_utf_member_status_replies` SELECT `reply_id`,`reply_status_id`,`reply_member_id`,`reply_date`,CONVERT( CAST(`reply_content` AS BINARY) USING utf8 ) FROM `member_status_replies`
------------------------------------------------
Sun, 29 Apr 2018 03:16:55 +0000
Post inserts for MyISAM table member_status_replies
------------------------------------------------
Sun, 29 Apr 2018 03:16:55 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:16:55 +0000
Created UTF8 table member_status_updates (PKEY: status_id)
------------------------------------------------
Sun, 29 Apr 2018 03:16:55 +0000
member_status_updates keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:16:55 +0000
Continuing with member_status_updates (PKEY: status_id)
------------------------------------------------
Sun, 29 Apr 2018 03:16:55 +0000
Pre inserts for MyISAM table member_status_updates
------------------------------------------------
Sun, 29 Apr 2018 03:16:55 +0000
INSERT IGNORE INTO `x_utf_member_status_updates` SELECT `status_id`,`status_member_id`,`status_date`,CONVERT( CAST(`status_content` AS BINARY) USING utf8 ),`status_replies`,CONVERT( CAST(`status_last_ids` AS BINARY) USING utf8 ),`status_is_latest`,`status_is_locked`,CONVERT( CAST(`status_hash` AS BINARY) USING utf8 ),`status_imported`,CONVERT( CAST(`status_creator` AS BINARY) USING utf8 ),`status_author_id`,CONVERT( CAST(`status_author_ip` AS BINARY) USING utf8 ),`status_approved` FROM `member_status_updates`
------------------------------------------------
Sun, 29 Apr 2018 03:16:55 +0000
Post inserts for MyISAM table member_status_updates
------------------------------------------------
Sun, 29 Apr 2018 03:16:55 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:16:55 +0000
Created UTF8 table members (PKEY: member_id)
------------------------------------------------
Sun, 29 Apr 2018 03:16:55 +0000
members keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:16:55 +0000
Continuing with members (PKEY: member_id)
------------------------------------------------
Sun, 29 Apr 2018 03:16:55 +0000
Pre inserts for MyISAM table members
------------------------------------------------
Sun, 29 Apr 2018 03:16:55 +0000
INSERT IGNORE INTO `x_utf_members` SELECT `member_id`,CONVERT( CAST(`name` AS BINARY) USING utf8 ),`member_group_id`,CONVERT( CAST(`email` AS BINARY) USING utf8 ),`joined`,CONVERT( CAST(`ip_address` AS BINARY) USING utf8 ),`posts`,CONVERT( CAST(`title` AS BINARY) USING utf8 ),`allow_admin_mails`,CONVERT( CAST(`time_offset` AS BINARY) USING utf8 ),`skin`,`warn_level`,`warn_lastwarn`,`language`,`last_post`,CONVERT( CAST(`restrict_post` AS BINARY) USING utf8 ),`view_sigs`,`view_img`,`bday_day`,`bday_month`,`bday_year`,`msg_count_new`,`msg_count_total`,`msg_count_reset`,`msg_show_notification`,CONVERT( CAST(`misc` AS BINARY) USING utf8 ),`last_visit`,`last_activity`,`dst_in_use`,`coppa_user`,CONVERT( CAST(`mod_posts` AS BINARY) USING utf8 ),CONVERT( CAST(`auto_track` AS BINARY) USING utf8 ),CONVERT( CAST(`temp_ban` AS BINARY) USING utf8 ),CONVERT( CAST(`login_anonymous` AS BINARY) USING utf8 ),CONVERT( CAST(`ignored_users` AS BINARY) USING utf8 ),CONVERT( CAST(`mgroup_others` AS BINARY) USING utf8 ),CONVERT( CAST(`org_perm_id` AS BINARY) USING utf8 ),CONVERT( CAST(`member_login_key` AS BINARY) USING utf8 ),`member_login_key_expire`,CONVERT( CAST(`has_blog` AS BINARY) USING utf8 ),`blogs_recache`,`has_gallery`,`members_auto_dst`,CONVERT( CAST(`members_display_name` AS BINARY) USING utf8 ),CONVERT( CAST(`members_seo_name` AS BINARY) USING utf8 ),`members_created_remote`,CONVERT( CAST(`members_cache` AS BINARY) USING utf8 ),`members_disable_pm`,CONVERT( CAST(`members_l_display_name` AS BINARY) USING utf8 ),CONVERT( CAST(`members_l_username` AS BINARY) USING utf8 ),CONVERT( CAST(`failed_logins` AS BINARY) USING utf8 ),`failed_login_count`,`members_profile_views`,CONVERT( CAST(`members_pass_hash` AS BINARY) USING utf8 ),CONVERT( CAST(`members_pass_salt` AS BINARY) USING utf8 ),`member_banned`,CONVERT( CAST(`member_uploader` AS BINARY) USING utf8 ),`members_bitoptions`,`fb_uid`,CONVERT( CAST(`fb_emailhash` AS BINARY) USING utf8 ),`fb_lastsync`,CONVERT( CAST(`members_day_posts` AS BINARY) USING utf8 ),CONVERT( CAST(`live_id` AS BINARY) USING utf8 ),CONVERT( CAST(`twitter_id` AS BINARY) USING utf8 ),CONVERT( CAST(`twitter_token` AS BINARY) USING utf8 ),CONVERT( CAST(`twitter_secret` AS BINARY) USING utf8 ),`notification_cnt`,`tc_lastsync`,CONVERT( CAST(`fb_session` AS BINARY) USING utf8 ),CONVERT( CAST(`fb_token` AS BINARY) USING utf8 ),CONVERT( CAST(`ips_mobile_token` AS BINARY) USING utf8 ),`unacknowledged_warnings`,`ipsconnect_id`,CONVERT( CAST(`ipsconnect_revalidate_url` AS BINARY) USING utf8 ),CONVERT( CAST(`gallery_perms` AS BINARY) USING utf8 ),CONVERT( CAST(`conv_password` AS BINARY) USING utf8 ),`cm_credits`,`cm_reg`,`referred_by`,`cm_no_sev`,CONVERT( CAST(`cim_profile_id` AS BINARY) USING utf8 ),`cim_payment_id`,`cim_method`,`cm_return_group`,`reviewpoints`,`monreviewpoints`,`reviews`,`revawards`,`revrates`,`revrated`,`revdeals`,`revanswers`,`revquestions`,`revrequests`,`rcomments`,`revfills`,`revtracked`,`goodrevreports`,`dp3_rs_menable`,`dp3_rs_referred_by`,`dp3_rs_banned`,`dp3_rs_padded`,`dp3_rs_incr`,`wedding_event_id`,`wedding_date`,CONVERT( CAST(`wedding_location` AS BINARY) USING utf8 ) FROM `members`
------------------------------------------------
Sun, 29 Apr 2018 03:16:57 +0000
Post inserts for MyISAM table members
------------------------------------------------
Sun, 29 Apr 2018 03:17:03 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:03 +0000
Created UTF8 table members_partial (PKEY: partial_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:03 +0000
members_partial keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:03 +0000
Continuing with members_partial (PKEY: partial_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:03 +0000
Pre inserts for MyISAM table members_partial
------------------------------------------------
Sun, 29 Apr 2018 03:17:03 +0000
Post inserts for MyISAM table members_partial
------------------------------------------------
Sun, 29 Apr 2018 03:17:03 +0000
No columns to convert in members_partial INSERT INTO FROM SELECT used
------------------------------------------------
Sun, 29 Apr 2018 03:17:03 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:03 +0000
Created UTF8 table members_warn_actions (PKEY: wa_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:03 +0000
members_warn_actions keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:03 +0000
Continuing with members_warn_actions (PKEY: wa_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:03 +0000
Pre inserts for MyISAM table members_warn_actions
------------------------------------------------
Sun, 29 Apr 2018 03:17:03 +0000
INSERT IGNORE INTO `x_utf_members_warn_actions` SELECT `wa_id`,`wa_points`,`wa_mq`,CONVERT( CAST(`wa_mq_unit` AS BINARY) USING utf8 ),`wa_rpa`,CONVERT( CAST(`wa_rpa_unit` AS BINARY) USING utf8 ),`wa_suspend`,CONVERT( CAST(`wa_suspend_unit` AS BINARY) USING utf8 ),`wa_ban_group`,`wa_override` FROM `members_warn_actions`
------------------------------------------------
Sun, 29 Apr 2018 03:17:03 +0000
Post inserts for MyISAM table members_warn_actions
------------------------------------------------
Sun, 29 Apr 2018 03:17:03 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:03 +0000
Created UTF8 table members_warn_logs (PKEY: wl_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:03 +0000
members_warn_logs keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:03 +0000
Continuing with members_warn_logs (PKEY: wl_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:03 +0000
Pre inserts for MyISAM table members_warn_logs
------------------------------------------------
Sun, 29 Apr 2018 03:17:03 +0000
INSERT IGNORE INTO `x_utf_members_warn_logs` SELECT `wl_id`,`wl_member`,`wl_moderator`,`wl_date`,`wl_reason`,`wl_points`,CONVERT( CAST(`wl_note_member` AS BINARY) USING utf8 ),CONVERT( CAST(`wl_note_mods` AS BINARY) USING utf8 ),`wl_mq`,CONVERT( CAST(`wl_mq_unit` AS BINARY) USING utf8 ),`wl_rpa`,CONVERT( CAST(`wl_rpa_unit` AS BINARY) USING utf8 ),`wl_suspend`,CONVERT( CAST(`wl_suspend_unit` AS BINARY) USING utf8 ),`wl_ban_group`,`wl_expire`,CONVERT( CAST(`wl_expire_unit` AS BINARY) USING utf8 ),`wl_acknowledged`,CONVERT( CAST(`wl_content_app` AS BINARY) USING utf8 ),CONVERT( CAST(`wl_content_id1` AS BINARY) USING utf8 ),CONVERT( CAST(`wl_content_id2` AS BINARY) USING utf8 ),`wl_expire_date` FROM `members_warn_logs`
------------------------------------------------
Sun, 29 Apr 2018 03:17:03 +0000
Post inserts for MyISAM table members_warn_logs
------------------------------------------------
Sun, 29 Apr 2018 03:17:03 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:03 +0000
Created UTF8 table members_warn_reasons (PKEY: wr_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:03 +0000
members_warn_reasons keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:03 +0000
Continuing with members_warn_reasons (PKEY: wr_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:03 +0000
Pre inserts for MyISAM table members_warn_reasons
------------------------------------------------
Sun, 29 Apr 2018 03:17:03 +0000
INSERT IGNORE INTO `x_utf_members_warn_reasons` SELECT `wr_id`,CONVERT( CAST(`wr_name` AS BINARY) USING utf8 ),`wr_points`,`wr_points_override`,`wr_remove`,CONVERT( CAST(`wr_remove_unit` AS BINARY) USING utf8 ),`wr_remove_override`,`wr_order` FROM `members_warn_reasons`
------------------------------------------------
Sun, 29 Apr 2018 03:17:03 +0000
Post inserts for MyISAM table members_warn_reasons
------------------------------------------------
Sun, 29 Apr 2018 03:17:03 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:03 +0000
Created UTF8 table message_posts (PKEY: msg_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:03 +0000
message_posts keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:03 +0000
Continuing with message_posts (PKEY: msg_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:03 +0000
Pre inserts for MyISAM table message_posts
------------------------------------------------
Sun, 29 Apr 2018 03:17:03 +0000
INSERT IGNORE INTO `x_utf_message_posts` SELECT `msg_id`,`msg_topic_id`,`msg_date`,CONVERT( CAST(`msg_post` AS BINARY) USING utf8 ),CONVERT( CAST(`msg_post_key` AS BINARY) USING utf8 ),`msg_author_id`,CONVERT( CAST(`msg_ip_address` AS BINARY) USING utf8 ),`msg_is_first_post` FROM `message_posts`
------------------------------------------------
Sun, 29 Apr 2018 03:17:04 +0000
Post inserts for MyISAM table message_posts
------------------------------------------------
Sun, 29 Apr 2018 03:17:22 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:22 +0000
Created UTF8 table message_topic_user_map (PKEY: map_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:22 +0000
message_topic_user_map keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:22 +0000
Continuing with message_topic_user_map (PKEY: map_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:22 +0000
Pre inserts for MyISAM table message_topic_user_map
------------------------------------------------
Sun, 29 Apr 2018 03:17:22 +0000
INSERT IGNORE INTO `x_utf_message_topic_user_map` SELECT `map_id`,`map_user_id`,`map_topic_id`,CONVERT( CAST(`map_folder_id` AS BINARY) USING utf8 ),`map_read_time`,`map_user_active`,`map_user_banned`,`map_has_unread`,`map_is_system`,`map_is_starter`,`map_left_time`,`map_ignore_notification`,`map_last_topic_reply` FROM `message_topic_user_map`
------------------------------------------------
Sun, 29 Apr 2018 03:17:22 +0000
Post inserts for MyISAM table message_topic_user_map
------------------------------------------------
Sun, 29 Apr 2018 03:17:22 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:22 +0000
Created UTF8 table message_topics (PKEY: mt_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:22 +0000
message_topics keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:22 +0000
Continuing with message_topics (PKEY: mt_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:22 +0000
Pre inserts for MyISAM table message_topics
------------------------------------------------
Sun, 29 Apr 2018 03:17:22 +0000
INSERT IGNORE INTO `x_utf_message_topics` SELECT `mt_id`,`mt_date`,CONVERT( CAST(`mt_title` AS BINARY) USING utf8 ),`mt_hasattach`,`mt_starter_id`,`mt_start_time`,`mt_last_post_time`,CONVERT( CAST(`mt_invited_members` AS BINARY) USING utf8 ),`mt_to_count`,`mt_to_member_id`,`mt_replies`,`mt_last_msg_id`,`mt_first_msg_id`,`mt_is_draft`,`mt_is_deleted`,`mt_is_system` FROM `message_topics`
------------------------------------------------
Sun, 29 Apr 2018 03:17:22 +0000
Post inserts for MyISAM table message_topics
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
Created UTF8 table mobile_app_style (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
mobile_app_style keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
Continuing with mobile_app_style (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
Pre inserts for MyISAM table mobile_app_style
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
INSERT IGNORE INTO `x_utf_mobile_app_style` SELECT `id`,CONVERT( CAST(`filename` AS BINARY) USING utf8 ),`hasRetina`,`isInUse`,`lastUpdated` FROM `mobile_app_style`
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
Post inserts for MyISAM table mobile_app_style
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
Created UTF8 table mobile_device_map (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
mobile_device_map keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
Continuing with mobile_device_map (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
Pre inserts for MyISAM table mobile_device_map
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
INSERT IGNORE INTO `x_utf_mobile_device_map` SELECT CONVERT( CAST(`token` AS BINARY) USING utf8 ),`member_id` FROM `mobile_device_map`
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
Post inserts for MyISAM table mobile_device_map
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
Created UTF8 table mobile_notifications (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
mobile_notifications keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
Continuing with mobile_notifications (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
Pre inserts for MyISAM table mobile_notifications
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
INSERT IGNORE INTO `x_utf_mobile_notifications` SELECT `id`,CONVERT( CAST(`notify_title` AS BINARY) USING utf8 ),`notify_date`,`member_id`,`notify_sent`,CONVERT( CAST(`notify_url` AS BINARY) USING utf8 ) FROM `mobile_notifications`
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
Post inserts for MyISAM table mobile_notifications
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
Created UTF8 table mod_queued_items (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
mod_queued_items keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
Continuing with mod_queued_items (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
Pre inserts for MyISAM table mod_queued_items
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
INSERT IGNORE INTO `x_utf_mod_queued_items` SELECT `id`,CONVERT( CAST(`type` AS BINARY) USING utf8 ),`type_id` FROM `mod_queued_items`
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
Post inserts for MyISAM table mod_queued_items
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
Created UTF8 table moderator_logs (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
moderator_logs keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
Continuing with moderator_logs (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
Pre inserts for MyISAM table moderator_logs
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
INSERT IGNORE INTO `x_utf_moderator_logs` SELECT `id`,`forum_id`,`topic_id`,`post_id`,`member_id`,CONVERT( CAST(`member_name` AS BINARY) USING utf8 ),CONVERT( CAST(`ip_address` AS BINARY) USING utf8 ),CONVERT( CAST(`http_referer` AS BINARY) USING utf8 ),`ctime`,CONVERT( CAST(`topic_title` AS BINARY) USING utf8 ),CONVERT( CAST(`action` AS BINARY) USING utf8 ),CONVERT( CAST(`query_string` AS BINARY) USING utf8 ) FROM `moderator_logs`
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
Post inserts for MyISAM table moderator_logs
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
Created UTF8 table moderators (PKEY: mid)
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
moderators keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
Continuing with moderators (PKEY: mid)
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
Pre inserts for MyISAM table moderators
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
INSERT IGNORE INTO `x_utf_moderators` SELECT `mid`,CONVERT( CAST(`forum_id` AS BINARY) USING utf8 ),CONVERT( CAST(`member_name` AS BINARY) USING utf8 ),`member_id`,`edit_post`,`edit_topic`,`delete_post`,`delete_topic`,`view_ip`,`open_topic`,`close_topic`,`mass_move`,`mass_prune`,`move_topic`,`pin_topic`,`unpin_topic`,`post_q`,`topic_q`,`allow_warn`,`is_group`,`group_id`,CONVERT( CAST(`group_name` AS BINARY) USING utf8 ),`split_merge`,`can_mm`,`mod_can_set_open_time`,`mod_can_set_close_time`,`mod_bitoptions` FROM `moderators`
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
Post inserts for MyISAM table moderators
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
Created UTF8 table nexus_ads (PKEY: ad_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
nexus_ads keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
Continuing with nexus_ads (PKEY: ad_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
Pre inserts for MyISAM table nexus_ads
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
INSERT IGNORE INTO `x_utf_nexus_ads` SELECT `ad_id`,CONVERT( CAST(`ad_locations` AS BINARY) USING utf8 ),CONVERT( CAST(`ad_image` AS BINARY) USING utf8 ),CONVERT( CAST(`ad_link` AS BINARY) USING utf8 ),CONVERT( CAST(`ad_html` AS BINARY) USING utf8 ),CONVERT( CAST(`ad_exempt` AS BINARY) USING utf8 ),`ad_clicks`,`ad_impressions`,`ad_active`,`ad_expire`,CONVERT( CAST(`ad_expire_unit` AS BINARY) USING utf8 ),`ad_start`,`ad_end`,`ad_member`,`ad_https` FROM `nexus_ads`
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
Post inserts for MyISAM table nexus_ads
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
Created UTF8 table nexus_alternate_contacts (PKEY: main_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
nexus_alternate_contacts keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
Continuing with nexus_alternate_contacts (PKEY: main_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
Pre inserts for MyISAM table nexus_alternate_contacts
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
INSERT IGNORE INTO `x_utf_nexus_alternate_contacts` SELECT `main_id`,`alt_id`,CONVERT( CAST(`purchases` AS BINARY) USING utf8 ),`billing`,`support` FROM `nexus_alternate_contacts`
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
Post inserts for MyISAM table nexus_alternate_contacts
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
Created UTF8 table nexus_coupons (PKEY: c_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
nexus_coupons keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
Continuing with nexus_coupons (PKEY: c_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
Pre inserts for MyISAM table nexus_coupons
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
INSERT IGNORE INTO `x_utf_nexus_coupons` SELECT `c_id`,CONVERT( CAST(`c_code` AS BINARY) USING utf8 ),`c_discount`,CONVERT( CAST(`c_unit` AS BINARY) USING utf8 ),CONVERT( CAST(`c_products` AS BINARY) USING utf8 ),`c_limit_discount`,CONVERT( CAST(`c_groups` AS BINARY) USING utf8 ),`c_uses`,`c_member_uses`,`c_start`,`c_end`,CONVERT( CAST(`c_used_by` AS BINARY) USING utf8 ),`c_combine`,`c_renewals` FROM `nexus_coupons`
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
Post inserts for MyISAM table nexus_coupons
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
Created UTF8 table nexus_customer_fields (PKEY: f_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
nexus_customer_fields keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
Continuing with nexus_customer_fields (PKEY: f_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
Pre inserts for MyISAM table nexus_customer_fields
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
INSERT IGNORE INTO `x_utf_nexus_customer_fields` SELECT `f_id`,CONVERT( CAST(`f_column` AS BINARY) USING utf8 ),`f_locked`,CONVERT( CAST(`f_name` AS BINARY) USING utf8 ),CONVERT( CAST(`f_type` AS BINARY) USING utf8 ),CONVERT( CAST(`f_extra` AS BINARY) USING utf8 ),`f_position`,`f_reg_show`,`f_reg_require`,`f_purchase_show`,`f_purchase_require` FROM `nexus_customer_fields`
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
Post inserts for MyISAM table nexus_customer_fields
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
Created UTF8 table nexus_customer_history (PKEY: log_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
nexus_customer_history keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
Continuing with nexus_customer_history (PKEY: log_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
Pre inserts for MyISAM table nexus_customer_history
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
INSERT IGNORE INTO `x_utf_nexus_customer_history` SELECT `log_id`,`log_member`,`log_by`,CONVERT( CAST(`log_type` AS BINARY) USING utf8 ),CONVERT( CAST(`log_data` AS BINARY) USING utf8 ),`log_date`,CONVERT( CAST(`log_ip_address` AS BINARY) USING utf8 ) FROM `nexus_customer_history`
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
Post inserts for MyISAM table nexus_customer_history
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
Created UTF8 table nexus_customers (PKEY: member_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
nexus_customers keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
Continuing with nexus_customers (PKEY: member_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
Pre inserts for MyISAM table nexus_customers
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
INSERT IGNORE INTO `x_utf_nexus_customers` SELECT `member_id`,CONVERT( CAST(`cm_first_name` AS BINARY) USING utf8 ),CONVERT( CAST(`cm_last_name` AS BINARY) USING utf8 ),CONVERT( CAST(`cm_address_1` AS BINARY) USING utf8 ),CONVERT( CAST(`cm_address_2` AS BINARY) USING utf8 ),CONVERT( CAST(`cm_city` AS BINARY) USING utf8 ),CONVERT( CAST(`cm_state` AS BINARY) USING utf8 ),CONVERT( CAST(`cm_zip` AS BINARY) USING utf8 ),CONVERT( CAST(`cm_country` AS BINARY) USING utf8 ),CONVERT( CAST(`cm_phone` AS BINARY) USING utf8 ) FROM `nexus_customers`
------------------------------------------------
Sun, 29 Apr 2018 03:17:23 +0000
Post inserts for MyISAM table nexus_customers
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Created UTF8 table nexus_donate_goals (PKEY: d_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
nexus_donate_goals keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Continuing with nexus_donate_goals (PKEY: d_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Pre inserts for MyISAM table nexus_donate_goals
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
INSERT IGNORE INTO `x_utf_nexus_donate_goals` SELECT `d_id`,CONVERT( CAST(`d_name` AS BINARY) USING utf8 ),CONVERT( CAST(`d_desc` AS BINARY) USING utf8 ),`d_goal`,`d_current`,`d_position` FROM `nexus_donate_goals`
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Post inserts for MyISAM table nexus_donate_goals
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Created UTF8 table nexus_donate_logs (PKEY: dl_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
nexus_donate_logs keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Continuing with nexus_donate_logs (PKEY: dl_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Pre inserts for MyISAM table nexus_donate_logs
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Post inserts for MyISAM table nexus_donate_logs
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
No columns to convert in nexus_donate_logs INSERT INTO FROM SELECT used
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Created UTF8 table nexus_eom (PKEY: eom_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
nexus_eom keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Pre inserts for MyISAM table nexus_eom
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
INSERT IGNORE INTO `x_utf_nexus_eom` SELECT `eom_id`,CONVERT( CAST(`eom_url` AS BINARY) USING utf8 ),CONVERT( CAST(`eom_type` AS BINARY) USING utf8 ),CONVERT( CAST(`eom_value` AS BINARY) USING utf8 ),CONVERT( CAST(`eom_notify` AS BINARY) USING utf8 ) FROM `nexus_eom`
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Post inserts for MyISAM table nexus_eom
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Created UTF8 table nexus_fraud_rules (PKEY: f_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
nexus_fraud_rules keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Continuing with nexus_fraud_rules (PKEY: f_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Pre inserts for MyISAM table nexus_fraud_rules
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
INSERT IGNORE INTO `x_utf_nexus_fraud_rules` SELECT `f_id`,CONVERT( CAST(`f_name` AS BINARY) USING utf8 ),CONVERT( CAST(`f_groups` AS BINARY) USING utf8 ),CONVERT( CAST(`f_amount` AS BINARY) USING utf8 ),`f_amount_unit`,CONVERT( CAST(`f_methods` AS BINARY) USING utf8 ),`f_voucher`,CONVERT( CAST(`f_email` AS BINARY) USING utf8 ),CONVERT( CAST(`f_email_unit` AS BINARY) USING utf8 ),CONVERT( CAST(`f_country` AS BINARY) USING utf8 ),CONVERT( CAST(`f_maxmind` AS BINARY) USING utf8 ),`f_maxmind_unit`,`f_maxmind_address_valid`,`f_maxmind_address_match`,CONVERT( CAST(`f_maxmind_proxy` AS BINARY) USING utf8 ),`f_maxmind_proxy_unit`,`f_maxmind_freeemail`,`f_maxmind_phone_match`,`f_maxmind_riskyemail`,`f_maxmind_riskyusername`,CONVERT( CAST(`f_trans_okay` AS BINARY) USING utf8 ),`f_trans_okay_unit`,CONVERT( CAST(`f_trans_fraud` AS BINARY) USING utf8 ),`f_trans_fraud_unit`,CONVERT( CAST(`f_action` AS BINARY) USING utf8 ),`f_action_ban`,`f_order` FROM `nexus_fraud_rules`
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Post inserts for MyISAM table nexus_fraud_rules
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Created UTF8 table nexus_gateways (PKEY: g_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
nexus_gateways keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Continuing with nexus_gateways (PKEY: g_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Pre inserts for MyISAM table nexus_gateways
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
INSERT IGNORE INTO `x_utf_nexus_gateways` SELECT `g_id`,CONVERT( CAST(`g_key` AS BINARY) USING utf8 ),CONVERT( CAST(`g_name` AS BINARY) USING utf8 ),CONVERT( CAST(`g_settings` AS BINARY) USING utf8 ),`g_testmode`,`g_position`,`g_payout` FROM `nexus_gateways`
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Post inserts for MyISAM table nexus_gateways
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Created UTF8 table nexus_hosting_accounts (PKEY: ps_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
nexus_hosting_accounts keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Continuing with nexus_hosting_accounts (PKEY: ps_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Pre inserts for MyISAM table nexus_hosting_accounts
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
INSERT IGNORE INTO `x_utf_nexus_hosting_accounts` SELECT `ps_id`,`account_server`,CONVERT( CAST(`account_domain` AS BINARY) USING utf8 ),CONVERT( CAST(`account_username` AS BINARY) USING utf8 ),CONVERT( CAST(`account_password` AS BINARY) USING utf8 ),`account_exists` FROM `nexus_hosting_accounts`
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Post inserts for MyISAM table nexus_hosting_accounts
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Created UTF8 table nexus_hosting_errors (PKEY: e_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
nexus_hosting_errors keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Continuing with nexus_hosting_errors (PKEY: e_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Pre inserts for MyISAM table nexus_hosting_errors
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
INSERT IGNORE INTO `x_utf_nexus_hosting_errors` SELECT `e_id`,`e_time`,`e_server`,CONVERT( CAST(`e_message` AS BINARY) USING utf8 ),CONVERT( CAST(`e_extra` AS BINARY) USING utf8 ) FROM `nexus_hosting_errors`
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Post inserts for MyISAM table nexus_hosting_errors
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Created UTF8 table nexus_hosting_queues (PKEY: queue_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
nexus_hosting_queues keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Continuing with nexus_hosting_queues (PKEY: queue_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Pre inserts for MyISAM table nexus_hosting_queues
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
INSERT IGNORE INTO `x_utf_nexus_hosting_queues` SELECT `queue_id`,CONVERT( CAST(`queue_name` AS BINARY) USING utf8 ) FROM `nexus_hosting_queues`
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Post inserts for MyISAM table nexus_hosting_queues
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Created UTF8 table nexus_hosting_servers (PKEY: server_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
nexus_hosting_servers keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Continuing with nexus_hosting_servers (PKEY: server_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Pre inserts for MyISAM table nexus_hosting_servers
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
INSERT IGNORE INTO `x_utf_nexus_hosting_servers` SELECT `server_id`,CONVERT( CAST(`server_hostname` AS BINARY) USING utf8 ),CONVERT( CAST(`server_ip` AS BINARY) USING utf8 ),CONVERT( CAST(`server_username` AS BINARY) USING utf8 ),CONVERT( CAST(`server_access` AS BINARY) USING utf8 ),CONVERT( CAST(`server_type` AS BINARY) USING utf8 ),CONVERT( CAST(`server_queues` AS BINARY) USING utf8 ),`server_max_accounts`,CONVERT( CAST(`server_nameservers` AS BINARY) USING utf8 ),`server_cost`,CONVERT( CAST(`server_monitor` AS BINARY) USING utf8 ),`server_monitor_fails`,`server_monitor_last_sucess`,`server_monitor_version`,`server_monitor_acknowledged`,`server_dedicated`,CONVERT( CAST(`server_extra` AS BINARY) USING utf8 ) FROM `nexus_hosting_servers`
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Post inserts for MyISAM table nexus_hosting_servers
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Created UTF8 table nexus_invoices (PKEY: i_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
nexus_invoices keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Continuing with nexus_invoices (PKEY: i_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Pre inserts for MyISAM table nexus_invoices
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
INSERT IGNORE INTO `x_utf_nexus_invoices` SELECT `i_id`,CONVERT( CAST(`i_status` AS BINARY) USING utf8 ),CONVERT( CAST(`i_title` AS BINARY) USING utf8 ),`i_member`,CONVERT( CAST(`i_items` AS BINARY) USING utf8 ),`i_total`,`i_date`,CONVERT( CAST(`i_return_uri` AS BINARY) USING utf8 ),`i_paid`,CONVERT( CAST(`i_status_extra` AS BINARY) USING utf8 ),`i_discount`,CONVERT( CAST(`i_temp` AS BINARY) USING utf8 ),`i_ordersteps`,`i_noreminder`,CONVERT( CAST(`i_renewal_ids` AS BINARY) USING utf8 ),CONVERT( CAST(`i_po` AS BINARY) USING utf8 ),CONVERT( CAST(`i_notes` AS BINARY) USING utf8 ),CONVERT( CAST(`i_shipaddress` AS BINARY) USING utf8 ) FROM `nexus_invoices`
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Post inserts for MyISAM table nexus_invoices
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Created UTF8 table nexus_licensekeys (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
nexus_licensekeys keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Continuing with nexus_licensekeys (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Pre inserts for MyISAM table nexus_licensekeys
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
INSERT IGNORE INTO `x_utf_nexus_licensekeys` SELECT CONVERT( CAST(`lkey_key` AS BINARY) USING utf8 ),CONVERT( CAST(`lkey_type` AS BINARY) USING utf8 ),CONVERT( CAST(`lkey_identifier` AS BINARY) USING utf8 ),`lkey_purchase`,`lkey_member`,`lkey_active`,`lkey_uses`,`lkey_max_uses`,CONVERT( CAST(`lkey_activate_data` AS BINARY) USING utf8 ),`lkey_generated` FROM `nexus_licensekeys`
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Post inserts for MyISAM table nexus_licensekeys
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Created UTF8 table nexus_notes (PKEY: note_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
nexus_notes keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Continuing with nexus_notes (PKEY: note_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Pre inserts for MyISAM table nexus_notes
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
INSERT IGNORE INTO `x_utf_nexus_notes` SELECT `note_id`,`note_member`,CONVERT( CAST(`note_text` AS BINARY) USING utf8 ),`note_author`,`note_date` FROM `nexus_notes`
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Post inserts for MyISAM table nexus_notes
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Created UTF8 table nexus_package_fields (PKEY: cf_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
nexus_package_fields keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Continuing with nexus_package_fields (PKEY: cf_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Pre inserts for MyISAM table nexus_package_fields
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
INSERT IGNORE INTO `x_utf_nexus_package_fields` SELECT `cf_id`,CONVERT( CAST(`cf_name` AS BINARY) USING utf8 ),CONVERT( CAST(`cf_desc` AS BINARY) USING utf8 ),CONVERT( CAST(`cf_type` AS BINARY) USING utf8 ),CONVERT( CAST(`cf_extra` AS BINARY) USING utf8 ),CONVERT( CAST(`cf_packages` AS BINARY) USING utf8 ),`cf_position`,`cf_sticky`,`cf_purchase`,`cf_required`,`cf_editable` FROM `nexus_package_fields`
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Post inserts for MyISAM table nexus_package_fields
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Created UTF8 table nexus_package_groups (PKEY: pg_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
nexus_package_groups keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Continuing with nexus_package_groups (PKEY: pg_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Pre inserts for MyISAM table nexus_package_groups
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
INSERT IGNORE INTO `x_utf_nexus_package_groups` SELECT `pg_id`,CONVERT( CAST(`pg_name` AS BINARY) USING utf8 ),CONVERT( CAST(`pg_seo_name` AS BINARY) USING utf8 ),`pg_position`,`pg_parent` FROM `nexus_package_groups`
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Post inserts for MyISAM table nexus_package_groups
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Created UTF8 table nexus_package_images (PKEY: image_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
nexus_package_images keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Continuing with nexus_package_images (PKEY: image_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Pre inserts for MyISAM table nexus_package_images
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
INSERT IGNORE INTO `x_utf_nexus_package_images` SELECT `image_id`,`image_product`,CONVERT( CAST(`image_location` AS BINARY) USING utf8 ),`image_primary`,CONVERT( CAST(`image_temp` AS BINARY) USING utf8 ) FROM `nexus_package_images`
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Post inserts for MyISAM table nexus_package_images
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Created UTF8 table nexus_packages (PKEY: p_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
nexus_packages keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Continuing with nexus_packages (PKEY: p_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Pre inserts for MyISAM table nexus_packages
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
INSERT IGNORE INTO `x_utf_nexus_packages` SELECT `p_id`,CONVERT( CAST(`p_name` AS BINARY) USING utf8 ),CONVERT( CAST(`p_seo_name` AS BINARY) USING utf8 ),CONVERT( CAST(`p_desc` AS BINARY) USING utf8 ),`p_group`,`p_stock`,`p_reg`,`p_store`,CONVERT( CAST(`p_member_groups` AS BINARY) USING utf8 ),`p_allow_upgrading`,`p_upgrade_charge`,`p_allow_downgrading`,`p_downgrade_refund`,CONVERT( CAST(`p_base_price` AS BINARY) USING utf8 ),`p_tax`,CONVERT( CAST(`p_renew_options` AS BINARY) USING utf8 ),`p_renewal_days`,`p_renewal_days_advance`,`p_primary_group`,CONVERT( CAST(`p_secondary_group` AS BINARY) USING utf8 ),CONVERT( CAST(`p_perm_set` AS BINARY) USING utf8 ),`p_return_primary`,`p_return_secondary`,`p_return_perm`,CONVERT( CAST(`p_module` AS BINARY) USING utf8 ),`p_position`,CONVERT( CAST(`p_associable` AS BINARY) USING utf8 ),`p_force_assoc`,CONVERT( CAST(`p_assoc_error` AS BINARY) USING utf8 ),CONVERT( CAST(`p_discounts` AS BINARY) USING utf8 ),CONVERT( CAST(`p_page` AS BINARY) USING utf8 ),`p_support`,`p_support_department`,`p_support_severity`,`p_featured`,`p_upsell`,CONVERT( CAST(`p_notify` AS BINARY) USING utf8 ),CONVERT( CAST(`p_type` AS BINARY) USING utf8 ),`p_custom`,`p_reviewable`,`p_review_moderate`,CONVERT( CAST(`p_image` AS BINARY) USING utf8 ),CONVERT( CAST(`p_methods` AS BINARY) USING utf8 ),`p_group_renewals`,`p_rebuild_thumb` FROM `nexus_packages`
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Post inserts for MyISAM table nexus_packages
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Created UTF8 table nexus_packages_ads (PKEY: p_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
nexus_packages_ads keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Continuing with nexus_packages_ads (PKEY: p_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Pre inserts for MyISAM table nexus_packages_ads
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
INSERT IGNORE INTO `x_utf_nexus_packages_ads` SELECT `p_id`,CONVERT( CAST(`p_locations` AS BINARY) USING utf8 ),CONVERT( CAST(`p_exempt` AS BINARY) USING utf8 ),`p_expire`,CONVERT( CAST(`p_expire_unit` AS BINARY) USING utf8 ),`p_max_height`,`p_max_width` FROM `nexus_packages_ads`
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Post inserts for MyISAM table nexus_packages_ads
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Created UTF8 table nexus_packages_hosting (PKEY: p_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
nexus_packages_hosting keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Continuing with nexus_packages_hosting (PKEY: p_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Pre inserts for MyISAM table nexus_packages_hosting
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Post inserts for MyISAM table nexus_packages_hosting
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
No columns to convert in nexus_packages_hosting INSERT INTO FROM SELECT used
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Created UTF8 table nexus_packages_products (PKEY: p_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
nexus_packages_products keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Pre inserts for MyISAM table nexus_packages_products
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
INSERT IGNORE INTO `x_utf_nexus_packages_products` SELECT `p_id`,`p_physical`,`p_subscription`,CONVERT( CAST(`p_shipping` AS BINARY) USING utf8 ),`p_weight`,CONVERT( CAST(`p_lkey` AS BINARY) USING utf8 ),CONVERT( CAST(`p_lkey_identifier` AS BINARY) USING utf8 ),`p_lkey_uses` FROM `nexus_packages_products`
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Post inserts for MyISAM table nexus_packages_products
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Created UTF8 table nexus_paymethods (PKEY: m_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
nexus_paymethods keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Continuing with nexus_paymethods (PKEY: m_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Pre inserts for MyISAM table nexus_paymethods
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
INSERT IGNORE INTO `x_utf_nexus_paymethods` SELECT `m_id`,`m_gateway`,CONVERT( CAST(`m_name` AS BINARY) USING utf8 ),CONVERT( CAST(`m_countries` AS BINARY) USING utf8 ),CONVERT( CAST(`m_settings` AS BINARY) USING utf8 ),`m_active`,`m_position` FROM `nexus_paymethods`
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Post inserts for MyISAM table nexus_paymethods
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Created UTF8 table nexus_payouts (PKEY: po_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
nexus_payouts keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Continuing with nexus_payouts (PKEY: po_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Pre inserts for MyISAM table nexus_payouts
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
INSERT IGNORE INTO `x_utf_nexus_payouts` SELECT `po_id`,`po_amount`,`po_member`,`po_gateway`,CONVERT( CAST(`po_data` AS BINARY) USING utf8 ),CONVERT( CAST(`po_status` AS BINARY) USING utf8 ),`po_date` FROM `nexus_payouts`
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Post inserts for MyISAM table nexus_payouts
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Created UTF8 table nexus_product_options (PKEY: opt_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
nexus_product_options keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Continuing with nexus_product_options (PKEY: opt_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Pre inserts for MyISAM table nexus_product_options
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
INSERT IGNORE INTO `x_utf_nexus_product_options` SELECT `opt_id`,`opt_package`,CONVERT( CAST(`opt_values` AS BINARY) USING utf8 ),`opt_stock`,`opt_base_price`,`opt_renew_price` FROM `nexus_product_options`
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Post inserts for MyISAM table nexus_product_options
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Created UTF8 table nexus_purchases (PKEY: ps_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
nexus_purchases keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Continuing with nexus_purchases (PKEY: ps_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Pre inserts for MyISAM table nexus_purchases
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
INSERT IGNORE INTO `x_utf_nexus_purchases` SELECT `ps_id`,`ps_member`,CONVERT( CAST(`ps_name` AS BINARY) USING utf8 ),`ps_active`,`ps_cancelled`,`ps_start`,`ps_expire`,`ps_renewals`,`ps_renewal_price`,CONVERT( CAST(`ps_renewal_unit` AS BINARY) USING utf8 ),CONVERT( CAST(`ps_app` AS BINARY) USING utf8 ),CONVERT( CAST(`ps_type` AS BINARY) USING utf8 ),`ps_item_id`,CONVERT( CAST(`ps_item_uri` AS BINARY) USING utf8 ),CONVERT( CAST(`ps_admin_uri` AS BINARY) USING utf8 ),CONVERT( CAST(`ps_custom_fields` AS BINARY) USING utf8 ),CONVERT( CAST(`ps_extra` AS BINARY) USING utf8 ),`ps_parent`,`ps_invoice_pending`,`ps_invoice_warning_sent`,`ps_pay_to`,`ps_commission`,`ps_original_invoice`,`ps_tax`,`ps_can_reactivate`,CONVERT( CAST(`ps_grouped_renewals` AS BINARY) USING utf8 ) FROM `nexus_purchases`
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Post inserts for MyISAM table nexus_purchases
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Created UTF8 table nexus_referral_banners (PKEY: rb_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
nexus_referral_banners keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Continuing with nexus_referral_banners (PKEY: rb_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Pre inserts for MyISAM table nexus_referral_banners
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
INSERT IGNORE INTO `x_utf_nexus_referral_banners` SELECT `rb_id`,CONVERT( CAST(`rb_url` AS BINARY) USING utf8 ),`rb_upload`,`rb_order` FROM `nexus_referral_banners`
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Post inserts for MyISAM table nexus_referral_banners
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Created UTF8 table nexus_referral_rules (PKEY: rrule_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
nexus_referral_rules keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Continuing with nexus_referral_rules (PKEY: rrule_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Pre inserts for MyISAM table nexus_referral_rules
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
INSERT IGNORE INTO `x_utf_nexus_referral_rules` SELECT `rrule_id`,CONVERT( CAST(`rrule_name` AS BINARY) USING utf8 ),CONVERT( CAST(`rrule_by_purchases_type` AS BINARY) USING utf8 ),CONVERT( CAST(`rrule_by_purchases_op` AS BINARY) USING utf8 ),`rrule_by_purchases_unit`,CONVERT( CAST(`rrule_by_group` AS BINARY) USING utf8 ),CONVERT( CAST(`rrule_for_purchases_type` AS BINARY) USING utf8 ),CONVERT( CAST(`rrule_for_purchases_op` AS BINARY) USING utf8 ),`rrule_for_purchases_unit`,CONVERT( CAST(`rrule_for_group` AS BINARY) USING utf8 ),CONVERT( CAST(`rrule_purchase_packages` AS BINARY) USING utf8 ),`rrule_purchase_any`,`rrule_purchase_package_limit`,`rrule_purchase_renewal`,CONVERT( CAST(`rrule_purchase_amount_op` AS BINARY) USING utf8 ),`rrule_purchase_amount_unit`,`rrule_commission`,`rrule_commission_limit` FROM `nexus_referral_rules`
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Post inserts for MyISAM table nexus_referral_rules
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Created UTF8 table nexus_referrals (PKEY: member_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
nexus_referrals keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Continuing with nexus_referrals (PKEY: member_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Pre inserts for MyISAM table nexus_referrals
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Post inserts for MyISAM table nexus_referrals
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
No columns to convert in nexus_referrals INSERT INTO FROM SELECT used
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Created UTF8 table nexus_review_rates (PKEY: rr_review)
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
nexus_review_rates keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Pre inserts for MyISAM table nexus_review_rates
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
INSERT IGNORE INTO `x_utf_nexus_review_rates` SELECT `rr_review`,`rr_member`,`rr_rate` FROM `nexus_review_rates`
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Post inserts for MyISAM table nexus_review_rates
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Created UTF8 table nexus_reviews (PKEY: review_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
nexus_reviews keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Continuing with nexus_reviews (PKEY: review_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Pre inserts for MyISAM table nexus_reviews
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
INSERT IGNORE INTO `x_utf_nexus_reviews` SELECT `review_id`,`review_product`,`review_author_id`,CONVERT( CAST(`review_author_name` AS BINARY) USING utf8 ),CONVERT( CAST(`review_ip_address` AS BINARY) USING utf8 ),`review_date`,`review_edit_date`,`review_approved`,CONVERT( CAST(`review_text` AS BINARY) USING utf8 ),`review_rating`,`review_useful`,`review_votes` FROM `nexus_reviews`
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Post inserts for MyISAM table nexus_reviews
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Created UTF8 table nexus_ship_orders (PKEY: o_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
nexus_ship_orders keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Continuing with nexus_ship_orders (PKEY: o_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Pre inserts for MyISAM table nexus_ship_orders
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
INSERT IGNORE INTO `x_utf_nexus_ship_orders` SELECT `o_id`,`o_invoice`,CONVERT( CAST(`o_data` AS BINARY) USING utf8 ),CONVERT( CAST(`o_status` AS BINARY) USING utf8 ),`o_method`,CONVERT( CAST(`o_items` AS BINARY) USING utf8 ),`o_date`,`o_shipped_date`,CONVERT( CAST(`o_service` AS BINARY) USING utf8 ),CONVERT( CAST(`o_tracknumber` AS BINARY) USING utf8 ),CONVERT( CAST(`o_api` AS BINARY) USING utf8 ),CONVERT( CAST(`o_api_service` AS BINARY) USING utf8 ),CONVERT( CAST(`o_label` AS BINARY) USING utf8 ),CONVERT( CAST(`o_extra` AS BINARY) USING utf8 ) FROM `nexus_ship_orders`
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Post inserts for MyISAM table nexus_ship_orders
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Created UTF8 table nexus_shipping (PKEY: s_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
nexus_shipping keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Continuing with nexus_shipping (PKEY: s_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Pre inserts for MyISAM table nexus_shipping
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
INSERT IGNORE INTO `x_utf_nexus_shipping` SELECT `s_id`,CONVERT( CAST(`s_name` AS BINARY) USING utf8 ),CONVERT( CAST(`s_locations` AS BINARY) USING utf8 ),CONVERT( CAST(`s_type` AS BINARY) USING utf8 ),CONVERT( CAST(`s_rates` AS BINARY) USING utf8 ),`s_tax`,`s_order` FROM `nexus_shipping`
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Post inserts for MyISAM table nexus_shipping
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Created UTF8 table nexus_subscriptions (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
nexus_subscriptions keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Continuing with nexus_subscriptions (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Pre inserts for MyISAM table nexus_subscriptions
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
INSERT IGNORE INTO `x_utf_nexus_subscriptions` SELECT CONVERT( CAST(`s_id` AS BINARY) USING utf8 ),CONVERT( CAST(`s_items` AS BINARY) USING utf8 ),`s_start_trans`,`s_method`,`s_member`,CONVERT( CAST(`s_gateway_key` AS BINARY) USING utf8 ) FROM `nexus_subscriptions`
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
Post inserts for MyISAM table nexus_subscriptions
------------------------------------------------
Sun, 29 Apr 2018 03:17:24 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Created UTF8 table nexus_support_departments (PKEY: dpt_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
nexus_support_departments keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Continuing with nexus_support_departments (PKEY: dpt_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Pre inserts for MyISAM table nexus_support_departments
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
INSERT IGNORE INTO `x_utf_nexus_support_departments` SELECT `dpt_id`,CONVERT( CAST(`dpt_name` AS BINARY) USING utf8 ),`dpt_open`,`dpt_require_package`,CONVERT( CAST(`dpt_packages` AS BINARY) USING utf8 ),`dpt_position`,CONVERT( CAST(`dpt_email` AS BINARY) USING utf8 ),CONVERT( CAST(`dpt_notify` AS BINARY) USING utf8 ),`dpt_notify_reply`,`dpt_ppi` FROM `nexus_support_departments`
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Post inserts for MyISAM table nexus_support_departments
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Created UTF8 table nexus_support_fields (PKEY: sf_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
nexus_support_fields keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Continuing with nexus_support_fields (PKEY: sf_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Pre inserts for MyISAM table nexus_support_fields
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
INSERT IGNORE INTO `x_utf_nexus_support_fields` SELECT `sf_id`,CONVERT( CAST(`sf_name` AS BINARY) USING utf8 ),CONVERT( CAST(`sf_desc` AS BINARY) USING utf8 ),CONVERT( CAST(`sf_type` AS BINARY) USING utf8 ),CONVERT( CAST(`sf_extra` AS BINARY) USING utf8 ),CONVERT( CAST(`sf_departments` AS BINARY) USING utf8 ),`sf_position`,`sf_required` FROM `nexus_support_fields`
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Post inserts for MyISAM table nexus_support_fields
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Created UTF8 table nexus_support_ratings (PKEY: rating_reply)
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
nexus_support_ratings keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Continuing with nexus_support_ratings (PKEY: rating_reply)
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Pre inserts for MyISAM table nexus_support_ratings
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
INSERT IGNORE INTO `x_utf_nexus_support_ratings` SELECT `rating_reply`,`rating_rating`,`rating_from`,`rating_staff`,CONVERT( CAST(`rating_note` AS BINARY) USING utf8 ),`rating_date` FROM `nexus_support_ratings`
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Post inserts for MyISAM table nexus_support_ratings
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Created UTF8 table nexus_support_replies (PKEY: reply_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
nexus_support_replies keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Continuing with nexus_support_replies (PKEY: reply_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Pre inserts for MyISAM table nexus_support_replies
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
INSERT IGNORE INTO `x_utf_nexus_support_replies` SELECT `reply_id`,`reply_request`,`reply_member`,CONVERT( CAST(`reply_type` AS BINARY) USING utf8 ),CONVERT( CAST(`reply_post` AS BINARY) USING utf8 ),`reply_hidden`,`reply_date`,CONVERT( CAST(`reply_email` AS BINARY) USING utf8 ),CONVERT( CAST(`reply_cc` AS BINARY) USING utf8 ),CONVERT( CAST(`reply_raw` AS BINARY) USING utf8 ),CONVERT( CAST(`reply_textformat` AS BINARY) USING utf8 ),CONVERT( CAST(`reply_ip_address` AS BINARY) USING utf8 ) FROM `nexus_support_replies`
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Post inserts for MyISAM table nexus_support_replies
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Created UTF8 table nexus_support_requests (PKEY: r_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
nexus_support_requests keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Continuing with nexus_support_requests (PKEY: r_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Pre inserts for MyISAM table nexus_support_requests
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
INSERT IGNORE INTO `x_utf_nexus_support_requests` SELECT `r_id`,CONVERT( CAST(`r_title` AS BINARY) USING utf8 ),`r_member`,`r_department`,`r_purchase`,`r_status`,`r_severity`,`r_severity_lock`,`r_started`,`r_last_reply`,`r_last_reply_by`,`r_last_new_reply`,`r_last_staff_reply`,`r_staff`,`r_staff_lock`,`r_replies`,CONVERT( CAST(`r_notify` AS BINARY) USING utf8 ),CONVERT( CAST(`r_email` AS BINARY) USING utf8 ),CONVERT( CAST(`r_email_key` AS BINARY) USING utf8 ),`r_ar_notify`,CONVERT( CAST(`r_cfields` AS BINARY) USING utf8 ) FROM `nexus_support_requests`
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Post inserts for MyISAM table nexus_support_requests
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Created UTF8 table nexus_support_severities (PKEY: sev_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
nexus_support_severities keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Continuing with nexus_support_severities (PKEY: sev_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Pre inserts for MyISAM table nexus_support_severities
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
INSERT IGNORE INTO `x_utf_nexus_support_severities` SELECT `sev_id`,CONVERT( CAST(`sev_name` AS BINARY) USING utf8 ),CONVERT( CAST(`sev_icon` AS BINARY) USING utf8 ),CONVERT( CAST(`sev_color` AS BINARY) USING utf8 ),`sev_default`,`sev_public`,`sev_position`,CONVERT( CAST(`sev_action` AS BINARY) USING utf8 ) FROM `nexus_support_severities`
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Post inserts for MyISAM table nexus_support_severities
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Created UTF8 table nexus_support_staff (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
nexus_support_staff keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Continuing with nexus_support_staff (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Pre inserts for MyISAM table nexus_support_staff
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
INSERT IGNORE INTO `x_utf_nexus_support_staff` SELECT CONVERT( CAST(`staff_type` AS BINARY) USING utf8 ),`staff_id`,CONVERT( CAST(`staff_departments` AS BINARY) USING utf8 ) FROM `nexus_support_staff`
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Post inserts for MyISAM table nexus_support_staff
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Created UTF8 table nexus_support_statuses (PKEY: status_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
nexus_support_statuses keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Continuing with nexus_support_statuses (PKEY: status_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Pre inserts for MyISAM table nexus_support_statuses
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
INSERT IGNORE INTO `x_utf_nexus_support_statuses` SELECT `status_id`,CONVERT( CAST(`status_name` AS BINARY) USING utf8 ),CONVERT( CAST(`status_public_name` AS BINARY) USING utf8 ),CONVERT( CAST(`status_public_set` AS BINARY) USING utf8 ),`status_default_member`,`status_default_staff`,`status_is_locked`,`status_assign`,`status_position`,`status_open`,CONVERT( CAST(`status_color` AS BINARY) USING utf8 ) FROM `nexus_support_statuses`
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Post inserts for MyISAM table nexus_support_statuses
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Created UTF8 table nexus_support_stock_actions (PKEY: action_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
nexus_support_stock_actions keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Continuing with nexus_support_stock_actions (PKEY: action_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Pre inserts for MyISAM table nexus_support_stock_actions
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
INSERT IGNORE INTO `x_utf_nexus_support_stock_actions` SELECT `action_id`,CONVERT( CAST(`action_name` AS BINARY) USING utf8 ),`action_department`,`action_status`,`action_staff`,CONVERT( CAST(`action_message` AS BINARY) USING utf8 ),`action_position` FROM `nexus_support_stock_actions`
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Post inserts for MyISAM table nexus_support_stock_actions
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Created UTF8 table nexus_support_tracker (PKEY: member_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
nexus_support_tracker keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Continuing with nexus_support_tracker (PKEY: member_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Pre inserts for MyISAM table nexus_support_tracker
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Post inserts for MyISAM table nexus_support_tracker
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
No columns to convert in nexus_support_tracker INSERT INTO FROM SELECT used
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Created UTF8 table nexus_support_views (PKEY: view_rid)
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
nexus_support_views keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Pre inserts for MyISAM table nexus_support_views
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
INSERT IGNORE INTO `x_utf_nexus_support_views` SELECT `view_rid`,`view_member`,`view_first`,`view_last`,`view_reply` FROM `nexus_support_views`
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Post inserts for MyISAM table nexus_support_views
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Created UTF8 table nexus_tax (PKEY: t_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
nexus_tax keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Continuing with nexus_tax (PKEY: t_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Pre inserts for MyISAM table nexus_tax
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
INSERT IGNORE INTO `x_utf_nexus_tax` SELECT `t_id`,CONVERT( CAST(`t_name` AS BINARY) USING utf8 ),CONVERT( CAST(`t_rate` AS BINARY) USING utf8 ),`t_order` FROM `nexus_tax`
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Post inserts for MyISAM table nexus_tax
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Created UTF8 table nexus_transactions (PKEY: t_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
nexus_transactions keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Continuing with nexus_transactions (PKEY: t_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Pre inserts for MyISAM table nexus_transactions
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
INSERT IGNORE INTO `x_utf_nexus_transactions` SELECT `t_id`,`t_member`,`t_invoice`,`t_method`,CONVERT( CAST(`t_status` AS BINARY) USING utf8 ),`t_amount`,`t_date`,CONVERT( CAST(`t_extra` AS BINARY) USING utf8 ),CONVERT( CAST(`t_fraud` AS BINARY) USING utf8 ),CONVERT( CAST(`t_gw_id` AS BINARY) USING utf8 ),CONVERT( CAST(`t_ip` AS BINARY) USING utf8 ),`t_fraud_blocked`,`t_fraud_checked` FROM `nexus_transactions`
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Post inserts for MyISAM table nexus_transactions
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Created UTF8 table permission_index (PKEY: perm_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
permission_index keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Continuing with permission_index (PKEY: perm_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Pre inserts for MyISAM table permission_index
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
INSERT IGNORE INTO `x_utf_permission_index` SELECT `perm_id`,CONVERT( CAST(`app` AS BINARY) USING utf8 ),CONVERT( CAST(`perm_type` AS BINARY) USING utf8 ),`perm_type_id`,CONVERT( CAST(`perm_view` AS BINARY) USING utf8 ),CONVERT( CAST(`perm_2` AS BINARY) USING utf8 ),CONVERT( CAST(`perm_3` AS BINARY) USING utf8 ),CONVERT( CAST(`perm_4` AS BINARY) USING utf8 ),CONVERT( CAST(`perm_5` AS BINARY) USING utf8 ),CONVERT( CAST(`perm_6` AS BINARY) USING utf8 ),CONVERT( CAST(`perm_7` AS BINARY) USING utf8 ),`owner_only`,`friend_only`,CONVERT( CAST(`authorized_users` AS BINARY) USING utf8 ) FROM `permission_index`
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Post inserts for MyISAM table permission_index
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Created UTF8 table pfields_content (PKEY: member_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
pfields_content keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Continuing with pfields_content (PKEY: member_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Pre inserts for MyISAM table pfields_content
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
INSERT IGNORE INTO `x_utf_pfields_content` SELECT `member_id`,CONVERT( CAST(`field_1` AS BINARY) USING utf8 ),CONVERT( CAST(`field_2` AS BINARY) USING utf8 ),CONVERT( CAST(`field_3` AS BINARY) USING utf8 ),CONVERT( CAST(`field_5` AS BINARY) USING utf8 ),CONVERT( CAST(`field_6` AS BINARY) USING utf8 ),CONVERT( CAST(`field_7` AS BINARY) USING utf8 ),CONVERT( CAST(`field_8` AS BINARY) USING utf8 ),CONVERT( CAST(`field_10` AS BINARY) USING utf8 ),CONVERT( CAST(`sfsMemInfo` AS BINARY) USING utf8 ),`sfsNextCheck` FROM `pfields_content`
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Post inserts for MyISAM table pfields_content
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Created UTF8 table pfields_data (PKEY: pf_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
pfields_data keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Continuing with pfields_data (PKEY: pf_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Pre inserts for MyISAM table pfields_data
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
INSERT IGNORE INTO `x_utf_pfields_data` SELECT `pf_id`,CONVERT( CAST(`pf_title` AS BINARY) USING utf8 ),CONVERT( CAST(`pf_desc` AS BINARY) USING utf8 ),CONVERT( CAST(`pf_content` AS BINARY) USING utf8 ),CONVERT( CAST(`pf_type` AS BINARY) USING utf8 ),`pf_not_null`,`pf_member_hide`,`pf_max_input`,`pf_member_edit`,`pf_position`,`pf_show_on_reg`,CONVERT( CAST(`pf_input_format` AS BINARY) USING utf8 ),`pf_admin_only`,CONVERT( CAST(`pf_topic_format` AS BINARY) USING utf8 ),`pf_group_id`,CONVERT( CAST(`pf_icon` AS BINARY) USING utf8 ),CONVERT( CAST(`pf_key` AS BINARY) USING utf8 ),CONVERT( CAST(`pf_search_type` AS BINARY) USING utf8 ),`pf_filtering` FROM `pfields_data`
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Post inserts for MyISAM table pfields_data
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Created UTF8 table pfields_groups (PKEY: pf_group_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
pfields_groups keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Continuing with pfields_groups (PKEY: pf_group_id)
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Pre inserts for MyISAM table pfields_groups
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
INSERT IGNORE INTO `x_utf_pfields_groups` SELECT `pf_group_id`,CONVERT( CAST(`pf_group_name` AS BINARY) USING utf8 ),CONVERT( CAST(`pf_group_key` AS BINARY) USING utf8 ) FROM `pfields_groups`
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
Post inserts for MyISAM table pfields_groups
------------------------------------------------
Sun, 29 Apr 2018 03:17:25 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:26 +0000
Created UTF8 table polls (PKEY: pid)
------------------------------------------------
Sun, 29 Apr 2018 03:17:26 +0000
polls keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:26 +0000
Continuing with polls (PKEY: pid)
------------------------------------------------
Sun, 29 Apr 2018 03:17:26 +0000
Pre inserts for MyISAM table polls
------------------------------------------------
Sun, 29 Apr 2018 03:17:26 +0000
INSERT IGNORE INTO `x_utf_polls` SELECT `pid`,`tid`,`start_date`,CONVERT( CAST(`choices` AS BINARY) USING utf8 ),`starter_id`,`votes`,`forum_id`,CONVERT( CAST(`poll_question` AS BINARY) USING utf8 ),`poll_only`,`poll_view_voters` FROM `polls`
------------------------------------------------
Sun, 29 Apr 2018 03:17:26 +0000
Post inserts for MyISAM table polls
------------------------------------------------
Sun, 29 Apr 2018 03:17:26 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:26 +0000
Created UTF8 table posts (PKEY: pid)
------------------------------------------------
Sun, 29 Apr 2018 03:17:26 +0000
posts keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:17:26 +0000
Continuing with posts (PKEY: pid)
------------------------------------------------
Sun, 29 Apr 2018 03:17:26 +0000
Pre inserts for MyISAM table posts
------------------------------------------------
Sun, 29 Apr 2018 03:17:26 +0000
INSERT IGNORE INTO `x_utf_posts` SELECT `pid`,`append_edit`,`edit_time`,`author_id`,CONVERT( CAST(`author_name` AS BINARY) USING utf8 ),`use_sig`,`use_emo`,CONVERT( CAST(`ip_address` AS BINARY) USING utf8 ),`post_date`,CONVERT( CAST(`post` AS BINARY) USING utf8 ),`queued`,`topic_id`,`new_topic`,CONVERT( CAST(`edit_name` AS BINARY) USING utf8 ),CONVERT( CAST(`post_key` AS BINARY) USING utf8 ),`post_htmlstate`,CONVERT( CAST(`post_edit_reason` AS BINARY) USING utf8 ),`post_bwoptions`,`pdelete_time`,`post_field_int`,CONVERT( CAST(`post_field_t1` AS BINARY) USING utf8 ),CONVERT( CAST(`post_field_t2` AS BINARY) USING utf8 ) FROM `posts`
------------------------------------------------
Sun, 29 Apr 2018 03:18:04 +0000
Post inserts for MyISAM table posts
------------------------------------------------
Sun, 29 Apr 2018 03:28:01 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:28:01 +0000
Created UTF8 table profile_friends (PKEY: friends_id)
------------------------------------------------
Sun, 29 Apr 2018 03:28:01 +0000
profile_friends keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:28:01 +0000
Continuing with profile_friends (PKEY: friends_id)
------------------------------------------------
Sun, 29 Apr 2018 03:28:01 +0000
Pre inserts for MyISAM table profile_friends
------------------------------------------------
Sun, 29 Apr 2018 03:28:01 +0000
Post inserts for MyISAM table profile_friends
------------------------------------------------
Sun, 29 Apr 2018 03:28:01 +0000
No columns to convert in profile_friends INSERT INTO FROM SELECT used
------------------------------------------------
Sun, 29 Apr 2018 03:28:01 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:28:01 +0000
Created UTF8 table profile_friends_flood (PKEY: friends_id)
------------------------------------------------
Sun, 29 Apr 2018 03:28:01 +0000
profile_friends_flood keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:28:01 +0000
Continuing with profile_friends_flood (PKEY: friends_id)
------------------------------------------------
Sun, 29 Apr 2018 03:28:01 +0000
Pre inserts for MyISAM table profile_friends_flood
------------------------------------------------
Sun, 29 Apr 2018 03:28:01 +0000
Post inserts for MyISAM table profile_friends_flood
------------------------------------------------
Sun, 29 Apr 2018 03:28:01 +0000
No columns to convert in profile_friends_flood INSERT INTO FROM SELECT used
------------------------------------------------
Sun, 29 Apr 2018 03:28:01 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:28:01 +0000
Created UTF8 table profile_portal (PKEY: pp_member_id)
------------------------------------------------
Sun, 29 Apr 2018 03:28:01 +0000
profile_portal keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:28:01 +0000
Pre inserts for MyISAM table profile_portal
------------------------------------------------
Sun, 29 Apr 2018 03:28:01 +0000
INSERT IGNORE INTO `x_utf_profile_portal` SELECT `pp_member_id`,CONVERT( CAST(`pp_last_visitors` AS BINARY) USING utf8 ),`pp_rating_hits`,`pp_rating_value`,`pp_rating_real`,CONVERT( CAST(`pp_main_photo` AS BINARY) USING utf8 ),`pp_main_width`,`pp_main_height`,CONVERT( CAST(`pp_thumb_photo` AS BINARY) USING utf8 ),`pp_thumb_width`,`pp_thumb_height`,`pp_setting_moderate_comments`,`pp_setting_moderate_friends`,`pp_setting_count_friends`,`pp_setting_count_comments`,`pp_setting_count_visitors`,CONVERT( CAST(`pp_about_me` AS BINARY) USING utf8 ),`pp_reputation_points`,CONVERT( CAST(`pp_gravatar` AS BINARY) USING utf8 ),CONVERT( CAST(`pp_photo_type` AS BINARY) USING utf8 ),CONVERT( CAST(`signature` AS BINARY) USING utf8 ),CONVERT( CAST(`avatar_location` AS BINARY) USING utf8 ),CONVERT( CAST(`avatar_size` AS BINARY) USING utf8 ),CONVERT( CAST(`avatar_type` AS BINARY) USING utf8 ),CONVERT( CAST(`pconversation_filters` AS BINARY) USING utf8 ),CONVERT( CAST(`fb_photo` AS BINARY) USING utf8 ),CONVERT( CAST(`fb_photo_thumb` AS BINARY) USING utf8 ),`fb_bwoptions`,CONVERT( CAST(`tc_last_sid_import` AS BINARY) USING utf8 ),CONVERT( CAST(`tc_photo` AS BINARY) USING utf8 ),`tc_bwoptions`,CONVERT( CAST(`pp_customization` AS BINARY) USING utf8 ),`pp_profile_update` FROM `profile_portal`
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
Post inserts for MyISAM table profile_portal
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
Created UTF8 table profile_portal_views (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
profile_portal_views keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
Continuing with profile_portal_views (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
Pre inserts for MyISAM table profile_portal_views
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
Post inserts for MyISAM table profile_portal_views
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
No columns to convert in profile_portal_views INSERT INTO FROM SELECT used
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
Created UTF8 table profile_ratings (PKEY: rating_id)
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
profile_ratings keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
Continuing with profile_ratings (PKEY: rating_id)
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
Pre inserts for MyISAM table profile_ratings
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
INSERT IGNORE INTO `x_utf_profile_ratings` SELECT `rating_id`,`rating_for_member_id`,`rating_by_member_id`,CONVERT( CAST(`rating_ip_address` AS BINARY) USING utf8 ),`rating_value` FROM `profile_ratings`
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
Post inserts for MyISAM table profile_ratings
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
Created UTF8 table question_and_answer (PKEY: qa_id)
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
question_and_answer keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
Continuing with question_and_answer (PKEY: qa_id)
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
Pre inserts for MyISAM table question_and_answer
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
INSERT IGNORE INTO `x_utf_question_and_answer` SELECT `qa_id`,CONVERT( CAST(`qa_question` AS BINARY) USING utf8 ),CONVERT( CAST(`qa_answers` AS BINARY) USING utf8 ) FROM `question_and_answer`
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
Post inserts for MyISAM table question_and_answer
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
Created UTF8 table rc_classes (PKEY: com_id)
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
rc_classes keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
Continuing with rc_classes (PKEY: com_id)
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
Pre inserts for MyISAM table rc_classes
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
INSERT IGNORE INTO `x_utf_rc_classes` SELECT `com_id`,`onoff`,CONVERT( CAST(`class_title` AS BINARY) USING utf8 ),CONVERT( CAST(`class_desc` AS BINARY) USING utf8 ),CONVERT( CAST(`author` AS BINARY) USING utf8 ),CONVERT( CAST(`author_url` AS BINARY) USING utf8 ),CONVERT( CAST(`pversion` AS BINARY) USING utf8 ),CONVERT( CAST(`my_class` AS BINARY) USING utf8 ),CONVERT( CAST(`group_can_report` AS BINARY) USING utf8 ),CONVERT( CAST(`mod_group_perm` AS BINARY) USING utf8 ),CONVERT( CAST(`extra_data` AS BINARY) USING utf8 ),`lockd`,CONVERT( CAST(`app` AS BINARY) USING utf8 ) FROM `rc_classes`
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
Post inserts for MyISAM table rc_classes
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
Created UTF8 table rc_comments (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
rc_comments keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
Continuing with rc_comments (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
Pre inserts for MyISAM table rc_comments
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
INSERT IGNORE INTO `x_utf_rc_comments` SELECT `id`,`rid`,CONVERT( CAST(`comment` AS BINARY) USING utf8 ),`comment_by`,`comment_date`,`approved`,`edit_date`,CONVERT( CAST(`author_name` AS BINARY) USING utf8 ),CONVERT( CAST(`ip_address` AS BINARY) USING utf8 ) FROM `rc_comments`
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
Post inserts for MyISAM table rc_comments
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
Created UTF8 table rc_modpref (PKEY: mem_id)
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
rc_modpref keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
Continuing with rc_modpref (PKEY: mem_id)
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
Pre inserts for MyISAM table rc_modpref
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
INSERT IGNORE INTO `x_utf_rc_modpref` SELECT `mem_id`,CONVERT( CAST(`rss_key` AS BINARY) USING utf8 ),CONVERT( CAST(`rss_cache` AS BINARY) USING utf8 ) FROM `rc_modpref`
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
Post inserts for MyISAM table rc_modpref
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
Created UTF8 table rc_reports (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
rc_reports keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
Continuing with rc_reports (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
Pre inserts for MyISAM table rc_reports
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
INSERT IGNORE INTO `x_utf_rc_reports` SELECT `id`,`rid`,CONVERT( CAST(`report` AS BINARY) USING utf8 ),`report_by`,`date_reported` FROM `rc_reports`
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
Post inserts for MyISAM table rc_reports
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
Created UTF8 table rc_reports_index (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
rc_reports_index keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
Continuing with rc_reports_index (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
Pre inserts for MyISAM table rc_reports_index
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
INSERT IGNORE INTO `x_utf_rc_reports_index` SELECT `id`,CONVERT( CAST(`uid` AS BINARY) USING utf8 ),CONVERT( CAST(`title` AS BINARY) USING utf8 ),`status`,CONVERT( CAST(`url` AS BINARY) USING utf8 ),CONVERT( CAST(`img_preview` AS BINARY) USING utf8 ),`rc_class`,`updated_by`,`date_updated`,`date_created`,`exdat1`,`exdat2`,`exdat3`,`num_reports`,`num_comments`,CONVERT( CAST(`seoname` AS BINARY) USING utf8 ),CONVERT( CAST(`seotemplate` AS BINARY) USING utf8 ) FROM `rc_reports_index`
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
Post inserts for MyISAM table rc_reports_index
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
Created UTF8 table rc_status (PKEY: status)
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
rc_status keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
Continuing with rc_status (PKEY: status)
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
Pre inserts for MyISAM table rc_status
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
INSERT IGNORE INTO `x_utf_rc_status` SELECT `status`,CONVERT( CAST(`title` AS BINARY) USING utf8 ),`points_per_report`,`minutes_to_apoint`,`is_new`,`is_complete`,`is_active`,`rorder` FROM `rc_status`
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
Post inserts for MyISAM table rc_status
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
Created UTF8 table rc_status_sev (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
rc_status_sev keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
Continuing with rc_status_sev (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
Pre inserts for MyISAM table rc_status_sev
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
INSERT IGNORE INTO `x_utf_rc_status_sev` SELECT `id`,`status`,`points`,CONVERT( CAST(`img` AS BINARY) USING utf8 ),`is_png`,`width`,`height` FROM `rc_status_sev`
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
Post inserts for MyISAM table rc_status_sev
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
Created UTF8 table reputation_cache (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
reputation_cache keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
Continuing with reputation_cache (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
Pre inserts for MyISAM table reputation_cache
------------------------------------------------
Sun, 29 Apr 2018 03:28:02 +0000
INSERT IGNORE INTO `x_utf_reputation_cache` SELECT `id`,CONVERT( CAST(`app` AS BINARY) USING utf8 ),CONVERT( CAST(`type` AS BINARY) USING utf8 ),`type_id`,`rep_points`,CONVERT( CAST(`rep_like_cache` AS BINARY) USING utf8 ),`cache_date` FROM `reputation_cache`
------------------------------------------------
Sun, 29 Apr 2018 03:28:38 +0000
Post inserts for MyISAM table reputation_cache
------------------------------------------------
Sun, 29 Apr 2018 03:28:41 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:28:41 +0000
Created UTF8 table reputation_index (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:28:41 +0000
reputation_index keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:28:41 +0000
Continuing with reputation_index (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:28:41 +0000
Pre inserts for MyISAM table reputation_index
------------------------------------------------
Sun, 29 Apr 2018 03:28:41 +0000
INSERT IGNORE INTO `x_utf_reputation_index` SELECT `id`,`member_id`,CONVERT( CAST(`app` AS BINARY) USING utf8 ),CONVERT( CAST(`type` AS BINARY) USING utf8 ),`type_id`,`rep_date`,CONVERT( CAST(`rep_msg` AS BINARY) USING utf8 ),`rep_rating` FROM `reputation_index`
------------------------------------------------
Sun, 29 Apr 2018 03:28:41 +0000
Post inserts for MyISAM table reputation_index
------------------------------------------------
Sun, 29 Apr 2018 03:28:41 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:28:41 +0000
Created UTF8 table reputation_levels (PKEY: level_id)
------------------------------------------------
Sun, 29 Apr 2018 03:28:41 +0000
reputation_levels keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:28:41 +0000
Continuing with reputation_levels (PKEY: level_id)
------------------------------------------------
Sun, 29 Apr 2018 03:28:41 +0000
Pre inserts for MyISAM table reputation_levels
------------------------------------------------
Sun, 29 Apr 2018 03:28:41 +0000
INSERT IGNORE INTO `x_utf_reputation_levels` SELECT `level_id`,`level_points`,CONVERT( CAST(`level_title` AS BINARY) USING utf8 ),CONVERT( CAST(`level_image` AS BINARY) USING utf8 ) FROM `reputation_levels`
------------------------------------------------
Sun, 29 Apr 2018 03:28:41 +0000
Post inserts for MyISAM table reputation_levels
------------------------------------------------
Sun, 29 Apr 2018 03:28:41 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:28:41 +0000
Created UTF8 table reputation_totals (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:28:41 +0000
reputation_totals keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:28:41 +0000
Continuing with reputation_totals (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:28:41 +0000
Pre inserts for MyISAM table reputation_totals
------------------------------------------------
Sun, 29 Apr 2018 03:28:41 +0000
INSERT IGNORE INTO `x_utf_reputation_totals` SELECT CONVERT( CAST(`rt_key` AS BINARY) USING utf8 ),CONVERT( CAST(`rt_app_type` AS BINARY) USING utf8 ),`rt_total`,`rt_type_id` FROM `reputation_totals`
------------------------------------------------
Sun, 29 Apr 2018 03:29:03 +0000
Post inserts for MyISAM table reputation_totals
------------------------------------------------
Sun, 29 Apr 2018 03:29:41 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:41 +0000
Created UTF8 table rest_menu_items (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:29:41 +0000
rest_menu_items keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:41 +0000
Continuing with rest_menu_items (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:29:41 +0000
Pre inserts for MyISAM table rest_menu_items
------------------------------------------------
Sun, 29 Apr 2018 03:29:41 +0000
INSERT IGNORE INTO `x_utf_rest_menu_items` SELECT CONVERT( CAST(`item_key` AS BINARY) USING utf8 ),CONVERT( CAST(`item_label` AS BINARY) USING utf8 ),`item_enabled`,`item_order` FROM `rest_menu_items`
------------------------------------------------
Sun, 29 Apr 2018 03:29:41 +0000
Post inserts for MyISAM table rest_menu_items
------------------------------------------------
Sun, 29 Apr 2018 03:29:41 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:41 +0000
Created UTF8 table rest_profile_tabs (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:29:41 +0000
rest_profile_tabs keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:41 +0000
Continuing with rest_profile_tabs (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:29:41 +0000
Pre inserts for MyISAM table rest_profile_tabs
------------------------------------------------
Sun, 29 Apr 2018 03:29:41 +0000
INSERT IGNORE INTO `x_utf_rest_profile_tabs` SELECT CONVERT( CAST(`plugin_lang_bit` AS BINARY) USING utf8 ),CONVERT( CAST(`plugin_name` AS BINARY) USING utf8 ),CONVERT( CAST(`plugin_key` AS BINARY) USING utf8 ),`plugin_enabled`,`plugin_order`,`plugin_default`,CONVERT( CAST(`plugin_app` AS BINARY) USING utf8 ) FROM `rest_profile_tabs`
------------------------------------------------
Sun, 29 Apr 2018 03:29:41 +0000
Post inserts for MyISAM table rest_profile_tabs
------------------------------------------------
Sun, 29 Apr 2018 03:29:41 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:41 +0000
Created UTF8 table rest_renewal_keys (PKEY: member_id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:41 +0000
rest_renewal_keys keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:41 +0000
Continuing with rest_renewal_keys (PKEY: member_id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:41 +0000
Pre inserts for MyISAM table rest_renewal_keys
------------------------------------------------
Sun, 29 Apr 2018 03:29:41 +0000
INSERT IGNORE INTO `x_utf_rest_renewal_keys` SELECT `member_id`,CONVERT( CAST(`renewal_key` AS BINARY) USING utf8 ),CONVERT( CAST(`ip_address` AS BINARY) USING utf8 ),CONVERT( CAST(`browser` AS BINARY) USING utf8 ),CONVERT( CAST(`uagent_key` AS BINARY) USING utf8 ),CONVERT( CAST(`uagent_version` AS BINARY) USING utf8 ),CONVERT( CAST(`uagent_type` AS BINARY) USING utf8 ),`expiration` FROM `rest_renewal_keys`
------------------------------------------------
Sun, 29 Apr 2018 03:29:42 +0000
Post inserts for MyISAM table rest_renewal_keys
------------------------------------------------
Sun, 29 Apr 2018 03:29:42 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:42 +0000
Created UTF8 table rest_tmp_attach (PKEY: attach_id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:42 +0000
rest_tmp_attach keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:42 +0000
Continuing with rest_tmp_attach (PKEY: attach_id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:42 +0000
Pre inserts for MyISAM table rest_tmp_attach
------------------------------------------------
Sun, 29 Apr 2018 03:29:42 +0000
INSERT IGNORE INTO `x_utf_rest_tmp_attach` SELECT `attach_id`,CONVERT( CAST(`attach_ext` AS BINARY) USING utf8 ),CONVERT( CAST(`attach_file` AS BINARY) USING utf8 ),CONVERT( CAST(`attach_post_key` AS BINARY) USING utf8 ),`attach_rel_id`,CONVERT( CAST(`attach_rel_module` AS BINARY) USING utf8 ) FROM `rest_tmp_attach`
------------------------------------------------
Sun, 29 Apr 2018 03:29:42 +0000
Post inserts for MyISAM table rest_tmp_attach
------------------------------------------------
Sun, 29 Apr 2018 03:29:42 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:42 +0000
Created UTF8 table reviews (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:42 +0000
reviews keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:42 +0000
Continuing with reviews (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:42 +0000
Pre inserts for MyISAM table reviews
------------------------------------------------
Sun, 29 Apr 2018 03:29:42 +0000
INSERT IGNORE INTO `x_utf_reviews` SELECT `id`,`mid`,CONVERT( CAST(`mem_name` AS BINARY) USING utf8 ),CONVERT( CAST(`cid` AS BINARY) USING utf8 ),`approved`,CONVERT( CAST(`title` AS BINARY) USING utf8 ),CONVERT( CAST(`frname` AS BINARY) USING utf8 ),CONVERT( CAST(`conclusion` AS BINARY) USING utf8 ),CONVERT( CAST(`pros` AS BINARY) USING utf8 ),CONVERT( CAST(`cons` AS BINARY) USING utf8 ),CONVERT( CAST(`content` AS BINARY) USING utf8 ),`overall`,`locked`,`time`,`edit_time`,`editor`,CONVERT( CAST(`edited_name` AS BINARY) USING utf8 ),`buy`,`status`,`awards`,`points`,`views`,`monviews`,`tracked`,`rootid`,CONVERT( CAST(`temp_ratings` AS BINARY) USING utf8 ),`redirect`,`approvals`,`rcomments`,`fills`,`worth`,`pinned` FROM `reviews`
------------------------------------------------
Sun, 29 Apr 2018 03:29:42 +0000
Post inserts for MyISAM table reviews
------------------------------------------------
Sun, 29 Apr 2018 03:29:42 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:42 +0000
Created UTF8 table reviews_bak (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:42 +0000
reviews_bak keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:42 +0000
Continuing with reviews_bak (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:42 +0000
Pre inserts for MyISAM table reviews_bak
------------------------------------------------
Sun, 29 Apr 2018 03:29:42 +0000
INSERT IGNORE INTO `x_utf_reviews_bak` SELECT `id`,`mid`,CONVERT( CAST(`mem_name` AS BINARY) USING utf8 ),CONVERT( CAST(`cid` AS BINARY) USING utf8 ),`approved`,CONVERT( CAST(`title` AS BINARY) USING utf8 ),CONVERT( CAST(`frname` AS BINARY) USING utf8 ),CONVERT( CAST(`conclusion` AS BINARY) USING utf8 ),CONVERT( CAST(`pros` AS BINARY) USING utf8 ),CONVERT( CAST(`cons` AS BINARY) USING utf8 ),CONVERT( CAST(`content` AS BINARY) USING utf8 ),`overall`,`locked`,`time`,`edit_time`,`editor`,CONVERT( CAST(`edited_name` AS BINARY) USING utf8 ),`buy`,`status`,`awards`,`points`,`views`,`monviews`,`tracked`,`rootid`,CONVERT( CAST(`temp_ratings` AS BINARY) USING utf8 ),`redirect`,`approvals`,`rcomments`,`fills`,`worth`,`pinned` FROM `reviews_bak`
------------------------------------------------
Sun, 29 Apr 2018 03:29:42 +0000
Post inserts for MyISAM table reviews_bak
------------------------------------------------
Sun, 29 Apr 2018 03:29:42 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:42 +0000
Created UTF8 table reviews_ban_logs (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:42 +0000
reviews_ban_logs keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:42 +0000
Continuing with reviews_ban_logs (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:42 +0000
Pre inserts for MyISAM table reviews_ban_logs
------------------------------------------------
Sun, 29 Apr 2018 03:29:42 +0000
INSERT IGNORE INTO `x_utf_reviews_ban_logs` SELECT `id`,`mid`,`banned`,CONVERT( CAST(`reason` AS BINARY) USING utf8 ),`time` FROM `reviews_ban_logs`
------------------------------------------------
Sun, 29 Apr 2018 03:29:42 +0000
Post inserts for MyISAM table reviews_ban_logs
------------------------------------------------
Sun, 29 Apr 2018 03:29:42 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:42 +0000
Created UTF8 table reviews_behavior (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:42 +0000
reviews_behavior keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:42 +0000
Continuing with reviews_behavior (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:42 +0000
Pre inserts for MyISAM table reviews_behavior
------------------------------------------------
Sun, 29 Apr 2018 03:29:42 +0000
Post inserts for MyISAM table reviews_behavior
------------------------------------------------
Sun, 29 Apr 2018 03:29:42 +0000
No columns to convert in reviews_behavior INSERT INTO FROM SELECT used
------------------------------------------------
Sun, 29 Apr 2018 03:29:42 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:42 +0000
Created UTF8 table reviews_categories (PKEY: cid)
------------------------------------------------
Sun, 29 Apr 2018 03:29:42 +0000
reviews_categories keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:42 +0000
Pre inserts for MyISAM table reviews_categories
------------------------------------------------
Sun, 29 Apr 2018 03:29:42 +0000
INSERT IGNORE INTO `x_utf_reviews_categories` SELECT `cid`,`cparent`,CONVERT( CAST(`cname` AS BINARY) USING utf8 ),CONVERT( CAST(`fname` AS BINARY) USING utf8 ),CONVERT( CAST(`cratings` AS BINARY) USING utf8 ),CONVERT( CAST(`eratings` AS BINARY) USING utf8 ),CONVERT( CAST(`fratings` AS BINARY) USING utf8 ),CONVERT( CAST(`extra_rate` AS BINARY) USING utf8 ),`allow`,`hidden`,CONVERT( CAST(`cimg` AS BINARY) USING utf8 ),`mustbuy`,CONVERT( CAST(`imgdesc` AS BINARY) USING utf8 ),CONVERT( CAST(`longdesc` AS BINARY) USING utf8 ),CONVERT( CAST(`extradesc` AS BINARY) USING utf8 ),`favs`,`wishes`,`owned`,`tracked`,`views`,`monviews`,`root`,`rcomments`,CONVERT( CAST(`extra_fav` AS BINARY) USING utf8 ),CONVERT( CAST(`extra_owned` AS BINARY) USING utf8 ),CONVERT( CAST(`trail` AS BINARY) USING utf8 ),CONVERT( CAST(`conv_cats` AS BINARY) USING utf8 ),`bayesian_rating`,`weighted_rating`,`owner_id`,CONVERT( CAST(`schemaname` AS BINARY) USING utf8 ) FROM `reviews_categories`
------------------------------------------------
Sun, 29 Apr 2018 03:29:42 +0000
Post inserts for MyISAM table reviews_categories
------------------------------------------------
Sun, 29 Apr 2018 03:29:42 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:42 +0000
Created UTF8 table reviews_comments (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:42 +0000
reviews_comments keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:42 +0000
Continuing with reviews_comments (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:42 +0000
Pre inserts for MyISAM table reviews_comments
------------------------------------------------
Sun, 29 Apr 2018 03:29:42 +0000
INSERT IGNORE INTO `x_utf_reviews_comments` SELECT `id`,`mid`,CONVERT( CAST(`mem_name` AS BINARY) USING utf8 ),`rid`,`cid`,`approved`,`locked`,`time`,CONVERT( CAST(`comment` AS BINARY) USING utf8 ) FROM `reviews_comments`
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Post inserts for MyISAM table reviews_comments
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Created UTF8 table reviews_deals (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
reviews_deals keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Continuing with reviews_deals (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Pre inserts for MyISAM table reviews_deals
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
INSERT IGNORE INTO `x_utf_reviews_deals` SELECT `id`,`mid`,CONVERT( CAST(`mem_name` AS BINARY) USING utf8 ),`cid`,`price`,`locked`,`time`,`points`,`rooty`,CONVERT( CAST(`url` AS BINARY) USING utf8 ) FROM `reviews_deals`
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Post inserts for MyISAM table reviews_deals
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Created UTF8 table reviews_detailed_ratings (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
reviews_detailed_ratings keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Continuing with reviews_detailed_ratings (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Pre inserts for MyISAM table reviews_detailed_ratings
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
INSERT IGNORE INTO `x_utf_reviews_detailed_ratings` SELECT `id`,`revid`,`catid`,`rootid`,CONVERT( CAST(`rating_name` AS BINARY) USING utf8 ),CONVERT( CAST(`rrname` AS BINARY) USING utf8 ),`rating_score` FROM `reviews_detailed_ratings`
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Post inserts for MyISAM table reviews_detailed_ratings
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Created UTF8 table reviews_edit_logs (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
reviews_edit_logs keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Continuing with reviews_edit_logs (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Pre inserts for MyISAM table reviews_edit_logs
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
INSERT IGNORE INTO `x_utf_reviews_edit_logs` SELECT `id`,`rid`,`mid`,CONVERT( CAST(`mem_name` AS BINARY) USING utf8 ),`time`,CONVERT( CAST(`reason` AS BINARY) USING utf8 ) FROM `reviews_edit_logs`
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Post inserts for MyISAM table reviews_edit_logs
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Created UTF8 table reviews_extra_ratings (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
reviews_extra_ratings keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Continuing with reviews_extra_ratings (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Pre inserts for MyISAM table reviews_extra_ratings
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
INSERT IGNORE INTO `x_utf_reviews_extra_ratings` SELECT `catid`,`revid`,`rootid`,CONVERT( CAST(`name` AS BINARY) USING utf8 ),`rating`,`pid` FROM `reviews_extra_ratings`
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Post inserts for MyISAM table reviews_extra_ratings
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Created UTF8 table reviews_faq_answers (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
reviews_faq_answers keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Continuing with reviews_faq_answers (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Pre inserts for MyISAM table reviews_faq_answers
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
INSERT IGNORE INTO `x_utf_reviews_faq_answers` SELECT `id`,`qid`,`mid`,CONVERT( CAST(`mem_name` AS BINARY) USING utf8 ),`locked`,`time`,`points`,CONVERT( CAST(`answer` AS BINARY) USING utf8 ) FROM `reviews_faq_answers`
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Post inserts for MyISAM table reviews_faq_answers
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Created UTF8 table reviews_faq_questions (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
reviews_faq_questions keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Continuing with reviews_faq_questions (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Pre inserts for MyISAM table reviews_faq_questions
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
INSERT IGNORE INTO `x_utf_reviews_faq_questions` SELECT `id`,`cid`,`mid`,CONVERT( CAST(`mem_name` AS BINARY) USING utf8 ),CONVERT( CAST(`question` AS BINARY) USING utf8 ),CONVERT( CAST(`qname` AS BINARY) USING utf8 ),`locked`,`time`,`answers`,`points`,`closed`,`is_tip` FROM `reviews_faq_questions`
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Post inserts for MyISAM table reviews_faq_questions
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Created UTF8 table reviews_favorites (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
reviews_favorites keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Continuing with reviews_favorites (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Pre inserts for MyISAM table reviews_favorites
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
INSERT IGNORE INTO `x_utf_reviews_favorites` SELECT `id`,`mid`,CONVERT( CAST(`mem_name` AS BINARY) USING utf8 ),`cid`,`time`,`rooty`,CONVERT( CAST(`extra` AS BINARY) USING utf8 ) FROM `reviews_favorites`
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Post inserts for MyISAM table reviews_favorites
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Created UTF8 table reviews_owned (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
reviews_owned keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Continuing with reviews_owned (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Pre inserts for MyISAM table reviews_owned
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
INSERT IGNORE INTO `x_utf_reviews_owned` SELECT `id`,`mid`,CONVERT( CAST(`mem_name` AS BINARY) USING utf8 ),`cid`,`time`,`rooty`,CONVERT( CAST(`extra` AS BINARY) USING utf8 ) FROM `reviews_owned`
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Post inserts for MyISAM table reviews_owned
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Created UTF8 table reviews_ratings (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
reviews_ratings keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Continuing with reviews_ratings (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Pre inserts for MyISAM table reviews_ratings
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
INSERT IGNORE INTO `x_utf_reviews_ratings` SELECT `id`,`review_id`,`member_id`,`rev_mem_id`,CONVERT( CAST(`mem_name` AS BINARY) USING utf8 ),`rating`,`time` FROM `reviews_ratings`
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Post inserts for MyISAM table reviews_ratings
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Created UTF8 table reviews_requests (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
reviews_requests keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Continuing with reviews_requests (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Pre inserts for MyISAM table reviews_requests
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
INSERT IGNORE INTO `x_utf_reviews_requests` SELECT `id`,`mid`,CONVERT( CAST(`mem_name` AS BINARY) USING utf8 ),CONVERT( CAST(`cid` AS BINARY) USING utf8 ),`time`,`parent`,`offer`,`locked`,`filled`,`filled_time`,CONVERT( CAST(`filled_name` AS BINARY) USING utf8 ),`minimum`,`rid`,`revmin` FROM `reviews_requests`
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Post inserts for MyISAM table reviews_requests
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Created UTF8 table reviews_searches (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
reviews_searches keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Continuing with reviews_searches (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Pre inserts for MyISAM table reviews_searches
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
INSERT IGNORE INTO `x_utf_reviews_searches` SELECT CONVERT( CAST(`id` AS BINARY) USING utf8 ),`member_id`,CONVERT( CAST(`ip_address` AS BINARY) USING utf8 ),`time`,CONVERT( CAST(`words` AS BINARY) USING utf8 ),CONVERT( CAST(`results` AS BINARY) USING utf8 ) FROM `reviews_searches`
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Post inserts for MyISAM table reviews_searches
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Created UTF8 table reviews_tags (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
reviews_tags keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Continuing with reviews_tags (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Pre inserts for MyISAM table reviews_tags
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
INSERT IGNORE INTO `x_utf_reviews_tags` SELECT `id`,`rev_id`,`cat_id`,`root_id`,CONVERT( CAST(`word` AS BINARY) USING utf8 ),CONVERT( CAST(`fword` AS BINARY) USING utf8 ) FROM `reviews_tags`
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Post inserts for MyISAM table reviews_tags
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Created UTF8 table reviews_tracker_author (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
reviews_tracker_author keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Continuing with reviews_tracker_author (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Pre inserts for MyISAM table reviews_tracker_author
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
INSERT IGNORE INTO `x_utf_reviews_tracker_author` SELECT `id`,`mid`,CONVERT( CAST(`mem_name` AS BINARY) USING utf8 ),`author`,`time` FROM `reviews_tracker_author`
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Post inserts for MyISAM table reviews_tracker_author
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Created UTF8 table reviews_tracker_product (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
reviews_tracker_product keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Continuing with reviews_tracker_product (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Pre inserts for MyISAM table reviews_tracker_product
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Post inserts for MyISAM table reviews_tracker_product
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
No columns to convert in reviews_tracker_product INSERT INTO FROM SELECT used
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Created UTF8 table reviews_tracker_review (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
reviews_tracker_review keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Pre inserts for MyISAM table reviews_tracker_review
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
INSERT IGNORE INTO `x_utf_reviews_tracker_review` SELECT `id`,`midy`,`rid`,`cidy`,`root`,`timey`,`view_time` FROM `reviews_tracker_review`
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Post inserts for MyISAM table reviews_tracker_review
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Created UTF8 table reviews_views (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
reviews_views keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Continuing with reviews_views (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Pre inserts for MyISAM table reviews_views
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Post inserts for MyISAM table reviews_views
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
No columns to convert in reviews_views INSERT INTO FROM SELECT used
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Created UTF8 table reviews_waiting (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
reviews_waiting keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Continuing with reviews_waiting (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Pre inserts for MyISAM table reviews_waiting
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
INSERT IGNORE INTO `x_utf_reviews_waiting` SELECT `id`,`type`,CONVERT( CAST(`reason` AS BINARY) USING utf8 ) FROM `reviews_waiting`
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Post inserts for MyISAM table reviews_waiting
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Created UTF8 table reviews_wish_list (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
reviews_wish_list keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Continuing with reviews_wish_list (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Pre inserts for MyISAM table reviews_wish_list
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
INSERT IGNORE INTO `x_utf_reviews_wish_list` SELECT `id`,`mid`,CONVERT( CAST(`mem_name` AS BINARY) USING utf8 ),`cid`,`root`,`time` FROM `reviews_wish_list`
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Post inserts for MyISAM table reviews_wish_list
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Created UTF8 table rss_export (PKEY: rss_export_id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
rss_export keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Continuing with rss_export (PKEY: rss_export_id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Pre inserts for MyISAM table rss_export
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
INSERT IGNORE INTO `x_utf_rss_export` SELECT `rss_export_id`,`rss_export_enabled`,CONVERT( CAST(`rss_export_title` AS BINARY) USING utf8 ),CONVERT( CAST(`rss_export_desc` AS BINARY) USING utf8 ),CONVERT( CAST(`rss_export_image` AS BINARY) USING utf8 ),CONVERT( CAST(`rss_export_forums` AS BINARY) USING utf8 ),`rss_export_include_post`,`rss_export_count`,`rss_export_cache_time`,`rss_export_cache_last`,CONVERT( CAST(`rss_export_cache_content` AS BINARY) USING utf8 ),CONVERT( CAST(`rss_export_sort` AS BINARY) USING utf8 ),CONVERT( CAST(`rss_export_order` AS BINARY) USING utf8 ) FROM `rss_export`
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Post inserts for MyISAM table rss_export
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Created UTF8 table rss_import (PKEY: rss_import_id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
rss_import keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Continuing with rss_import (PKEY: rss_import_id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Pre inserts for MyISAM table rss_import
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
INSERT IGNORE INTO `x_utf_rss_import` SELECT `rss_import_id`,`rss_import_enabled`,CONVERT( CAST(`rss_import_title` AS BINARY) USING utf8 ),CONVERT( CAST(`rss_import_url` AS BINARY) USING utf8 ),`rss_import_forum_id`,`rss_import_mid`,`rss_import_pergo`,`rss_import_time`,`rss_import_last_import`,CONVERT( CAST(`rss_import_showlink` AS BINARY) USING utf8 ),`rss_import_topic_open`,`rss_import_topic_hide`,CONVERT( CAST(`rss_import_topic_pre` AS BINARY) USING utf8 ),`rss_import_allow_html`,`rss_import_auth`,CONVERT( CAST(`rss_import_auth_user` AS BINARY) USING utf8 ),CONVERT( CAST(`rss_import_auth_pass` AS BINARY) USING utf8 ) FROM `rss_import`
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Post inserts for MyISAM table rss_import
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Created UTF8 table rss_imported (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
rss_imported keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Continuing with rss_imported (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Pre inserts for MyISAM table rss_imported
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
INSERT IGNORE INTO `x_utf_rss_imported` SELECT CONVERT( CAST(`rss_imported_guid` AS BINARY) USING utf8 ),`rss_imported_tid`,`rss_imported_impid` FROM `rss_imported`
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Post inserts for MyISAM table rss_imported
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Created UTF8 table search_keywords (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
search_keywords keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Continuing with search_keywords (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
No content conversion of search_keywords required
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Created UTF8 table search_sessions (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
search_sessions keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Continuing with search_sessions (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Pre inserts for MyISAM table search_sessions
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
INSERT IGNORE INTO `x_utf_search_sessions` SELECT CONVERT( CAST(`session_id` AS BINARY) USING utf8 ),`session_created`,`session_updated`,`session_member_id`,CONVERT( CAST(`session_data` AS BINARY) USING utf8 ) FROM `search_sessions`
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Post inserts for MyISAM table search_sessions
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Created UTF8 table search_visitors (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
search_visitors keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Continuing with search_visitors (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Pre inserts for InnoDB table search_visitors
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
INSERT IGNORE INTO `x_utf_search_visitors` SELECT `id`,`member`,`date`,CONVERT( CAST(`engine` AS BINARY) USING utf8 ),CONVERT( CAST(`keywords` AS BINARY) USING utf8 ),CONVERT( CAST(`url` AS BINARY) USING utf8 ) FROM `search_visitors`
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Post inserts for InnoDB table search_visitors
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Created UTF8 table seo_acronyms (PKEY: a_id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
seo_acronyms keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Continuing with seo_acronyms (PKEY: a_id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Pre inserts for InnoDB table seo_acronyms
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
INSERT IGNORE INTO `x_utf_seo_acronyms` SELECT `a_id`,CONVERT( CAST(`a_short` AS BINARY) USING utf8 ),CONVERT( CAST(`a_long` AS BINARY) USING utf8 ),`a_semantic`,`a_casesensitive` FROM `seo_acronyms`
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Post inserts for InnoDB table seo_acronyms
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Created UTF8 table seo_meta (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
seo_meta keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Continuing with seo_meta (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Pre inserts for InnoDB table seo_meta
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
INSERT IGNORE INTO `x_utf_seo_meta` SELECT CONVERT( CAST(`url` AS BINARY) USING utf8 ),CONVERT( CAST(`name` AS BINARY) USING utf8 ),CONVERT( CAST(`content` AS BINARY) USING utf8 ) FROM `seo_meta`
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Post inserts for InnoDB table seo_meta
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Created UTF8 table sessions (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
sessions keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Continuing with sessions (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
No content conversion of sessions required
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Created UTF8 table sfs_blocked (PKEY: blockID)
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
sfs_blocked keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Continuing with sfs_blocked (PKEY: blockID)
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Pre inserts for MyISAM table sfs_blocked
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
INSERT IGNORE INTO `x_utf_sfs_blocked` SELECT `blockID`,CONVERT( CAST(`blockedBy` AS BINARY) USING utf8 ),`blockDate`,CONVERT( CAST(`blockUN` AS BINARY) USING utf8 ),CONVERT( CAST(`blockEM` AS BINARY) USING utf8 ),CONVERT( CAST(`blockIP` AS BINARY) USING utf8 ),`timesBlocked`,`sfsFreq`,`sfsLast`,`sfsConf` FROM `sfs_blocked`
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Post inserts for MyISAM table sfs_blocked
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Created UTF8 table sfs_settings (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
sfs_settings keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Continuing with sfs_settings (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Pre inserts for MyISAM table sfs_settings
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
INSERT IGNORE INTO `x_utf_sfs_settings` SELECT `checkType`,`ipAtAll`,`ipNumTimes`,`ipDaysAgo`,`ipConfidence`,`emAtAll`,`emNumTimes`,`emDaysAgo`,`emConfidence`,`addBan`,`keepBanDays`,CONVERT( CAST(`errorMessage` AS BINARY) USING utf8 ),CONVERT( CAST(`apiKey` AS BINARY) USING utf8 ),`blockCount`,CONVERT( CAST(`emailTo` AS BINARY) USING utf8 ),CONVERT( CAST(`emailSub` AS BINARY) USING utf8 ),CONVERT( CAST(`statText` AS BINARY) USING utf8 ),`acpGraph` FROM `sfs_settings`
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Post inserts for MyISAM table sfs_settings
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Created UTF8 table sfs_tracking (PKEY: year)
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
sfs_tracking keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Continuing with sfs_tracking (PKEY: year)
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Pre inserts for MyISAM table sfs_tracking
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Post inserts for MyISAM table sfs_tracking
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
No columns to convert in sfs_tracking INSERT INTO FROM SELECT used
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Created UTF8 table sfs_whitelist (PKEY: wlID)
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
sfs_whitelist keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Pre inserts for MyISAM table sfs_whitelist
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
INSERT IGNORE INTO `x_utf_sfs_whitelist` SELECT `wlID`,CONVERT( CAST(`wlInfo` AS BINARY) USING utf8 ),`wlEntry` FROM `sfs_whitelist`
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Post inserts for MyISAM table sfs_whitelist
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Created UTF8 table sidebars (PKEY: sidebar_id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
sidebars keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Continuing with sidebars (PKEY: sidebar_id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Pre inserts for MyISAM table sidebars
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
INSERT IGNORE INTO `x_utf_sidebars` SELECT `sidebar_id`,CONVERT( CAST(`app` AS BINARY) USING utf8 ),CONVERT( CAST(`module` AS BINARY) USING utf8 ),CONVERT( CAST(`section` AS BINARY) USING utf8 ),CONVERT( CAST(`do` AS BINARY) USING utf8 ),`use_default`,CONVERT( CAST(`params` AS BINARY) USING utf8 ) FROM `sidebars`
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Post inserts for MyISAM table sidebars
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Created UTF8 table sidebars_blocks (PKEY: block_id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
sidebars_blocks keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Continuing with sidebars_blocks (PKEY: block_id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Pre inserts for MyISAM table sidebars_blocks
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
INSERT IGNORE INTO `x_utf_sidebars_blocks` SELECT `block_id`,CONVERT( CAST(`name` AS BINARY) USING utf8 ),CONVERT( CAST(`type` AS BINARY) USING utf8 ),CONVERT( CAST(`block_key` AS BINARY) USING utf8 ),CONVERT( CAST(`html_content` AS BINARY) USING utf8 ),CONVERT( CAST(`groups` AS BINARY) USING utf8 ) FROM `sidebars_blocks`
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Post inserts for MyISAM table sidebars_blocks
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Created UTF8 table sidebars_blocks_sequence (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
sidebars_blocks_sequence keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Continuing with sidebars_blocks_sequence (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Pre inserts for MyISAM table sidebars_blocks_sequence
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Post inserts for MyISAM table sidebars_blocks_sequence
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
No columns to convert in sidebars_blocks_sequence INSERT INTO FROM SELECT used
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Created UTF8 table skin_cache (PKEY: cache_id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
skin_cache keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
Pre inserts for MyISAM table skin_cache
------------------------------------------------
Sun, 29 Apr 2018 03:29:43 +0000
INSERT IGNORE INTO `x_utf_skin_cache` SELECT `cache_id`,`cache_updated`,CONVERT( CAST(`cache_type` AS BINARY) USING utf8 ),`cache_set_id`,CONVERT( CAST(`cache_key_1` AS BINARY) USING utf8 ),CONVERT( CAST(`cache_value_1` AS BINARY) USING utf8 ),CONVERT( CAST(`cache_key_2` AS BINARY) USING utf8 ),CONVERT( CAST(`cache_value_2` AS BINARY) USING utf8 ),CONVERT( CAST(`cache_value_3` AS BINARY) USING utf8 ),CONVERT( CAST(`cache_content` AS BINARY) USING utf8 ),CONVERT( CAST(`cache_key_3` AS BINARY) USING utf8 ),CONVERT( CAST(`cache_key_4` AS BINARY) USING utf8 ),CONVERT( CAST(`cache_value_4` AS BINARY) USING utf8 ),CONVERT( CAST(`cache_key_5` AS BINARY) USING utf8 ),CONVERT( CAST(`cache_value_5` AS BINARY) USING utf8 ),CONVERT( CAST(`cache_key_6` AS BINARY) USING utf8 ),CONVERT( CAST(`cache_value_6` AS BINARY) USING utf8 ) FROM `skin_cache`
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
Post inserts for MyISAM table skin_cache
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
Created UTF8 table skin_collections (PKEY: set_id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
skin_collections keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
Continuing with skin_collections (PKEY: set_id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
Pre inserts for MyISAM table skin_collections
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
INSERT IGNORE INTO `x_utf_skin_collections` SELECT `set_id`,CONVERT( CAST(`set_name` AS BINARY) USING utf8 ),CONVERT( CAST(`set_key` AS BINARY) USING utf8 ),`set_parent_id`,CONVERT( CAST(`set_parent_array` AS BINARY) USING utf8 ),CONVERT( CAST(`set_child_array` AS BINARY) USING utf8 ),CONVERT( CAST(`set_permissions` AS BINARY) USING utf8 ),`set_is_default`,CONVERT( CAST(`set_author_name` AS BINARY) USING utf8 ),CONVERT( CAST(`set_author_url` AS BINARY) USING utf8 ),CONVERT( CAST(`set_image_dir` AS BINARY) USING utf8 ),CONVERT( CAST(`set_emo_dir` AS BINARY) USING utf8 ),`set_css_inline`,CONVERT( CAST(`set_css_groups` AS BINARY) USING utf8 ),`set_added`,`set_updated`,CONVERT( CAST(`set_output_format` AS BINARY) USING utf8 ),CONVERT( CAST(`set_locked_uagent` AS BINARY) USING utf8 ),`set_hide_from_list`,`set_minify`,CONVERT( CAST(`set_master_key` AS BINARY) USING utf8 ),`set_order`,`set_by_skin_gen`,CONVERT( CAST(`set_skin_gen_data` AS BINARY) USING utf8 ) FROM `skin_collections`
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
Post inserts for MyISAM table skin_collections
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
Created UTF8 table skin_css (PKEY: css_id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
skin_css keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
Continuing with skin_css (PKEY: css_id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
Pre inserts for MyISAM table skin_css
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
INSERT IGNORE INTO `x_utf_skin_css` SELECT `css_id`,`css_set_id`,`css_updated`,CONVERT( CAST(`css_group` AS BINARY) USING utf8 ),CONVERT( CAST(`css_content` AS BINARY) USING utf8 ),`css_position`,`css_added_to`,CONVERT( CAST(`css_app` AS BINARY) USING utf8 ),`css_app_hide`,CONVERT( CAST(`css_attributes` AS BINARY) USING utf8 ),CONVERT( CAST(`css_modules` AS BINARY) USING utf8 ),`css_removed`,CONVERT( CAST(`css_master_key` AS BINARY) USING utf8 ) FROM `skin_css`
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
Post inserts for MyISAM table skin_css
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
Created UTF8 table skin_css_previous (PKEY: p_css_id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
skin_css_previous keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
Continuing with skin_css_previous (PKEY: p_css_id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
Pre inserts for MyISAM table skin_css_previous
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
INSERT IGNORE INTO `x_utf_skin_css_previous` SELECT `p_css_id`,CONVERT( CAST(`p_css_group` AS BINARY) USING utf8 ),CONVERT( CAST(`p_css_content` AS BINARY) USING utf8 ),CONVERT( CAST(`p_css_app` AS BINARY) USING utf8 ),CONVERT( CAST(`p_css_attributes` AS BINARY) USING utf8 ),CONVERT( CAST(`p_css_modules` AS BINARY) USING utf8 ),CONVERT( CAST(`p_css_master_key` AS BINARY) USING utf8 ),CONVERT( CAST(`p_css_long_version` AS BINARY) USING utf8 ),CONVERT( CAST(`p_css_human_version` AS BINARY) USING utf8 ) FROM `skin_css_previous`
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
Post inserts for MyISAM table skin_css_previous
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
Created UTF8 table skin_generator_sessions (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
skin_generator_sessions keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
Continuing with skin_generator_sessions (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
Pre inserts for MyISAM table skin_generator_sessions
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
INSERT IGNORE INTO `x_utf_skin_generator_sessions` SELECT CONVERT( CAST(`sg_session_id` AS BINARY) USING utf8 ),`sg_member_id`,`sg_skin_set_id`,`sg_date_start`,CONVERT( CAST(`sg_data` AS BINARY) USING utf8 ) FROM `skin_generator_sessions`
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
Post inserts for MyISAM table skin_generator_sessions
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
Created UTF8 table skin_merge_changes (PKEY: change_id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
skin_merge_changes keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
Continuing with skin_merge_changes (PKEY: change_id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
Pre inserts for MyISAM table skin_merge_changes
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
INSERT IGNORE INTO `x_utf_skin_merge_changes` SELECT `change_id`,CONVERT( CAST(`change_key` AS BINARY) USING utf8 ),`change_session_id`,`change_updated`,CONVERT( CAST(`change_data_group` AS BINARY) USING utf8 ),CONVERT( CAST(`change_data_title` AS BINARY) USING utf8 ),CONVERT( CAST(`change_data_content` AS BINARY) USING utf8 ),CONVERT( CAST(`change_data_type` AS BINARY) USING utf8 ),`change_is_new`,`change_is_diff`,`change_can_merge`,CONVERT( CAST(`change_merge_content` AS BINARY) USING utf8 ),`change_is_conflict`,CONVERT( CAST(`change_final_content` AS BINARY) USING utf8 ),`change_changes_applied`,CONVERT( CAST(`change_original_content` AS BINARY) USING utf8 ) FROM `skin_merge_changes`
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
Post inserts for MyISAM table skin_merge_changes
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
Created UTF8 table skin_merge_session (PKEY: merge_id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
skin_merge_session keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
Continuing with skin_merge_session (PKEY: merge_id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
Pre inserts for MyISAM table skin_merge_session
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
INSERT IGNORE INTO `x_utf_skin_merge_session` SELECT `merge_id`,`merge_date`,`merge_set_id`,CONVERT( CAST(`merge_master_key` AS BINARY) USING utf8 ),CONVERT( CAST(`merge_old_version` AS BINARY) USING utf8 ),CONVERT( CAST(`merge_new_version` AS BINARY) USING utf8 ),`merge_templates_togo`,`merge_css_togo`,`merge_templates_done`,`merge_css_done`,`merge_m_templates_togo`,`merge_m_css_togo`,`merge_m_templates_done`,`merge_m_css_done`,`merge_diff_done` FROM `skin_merge_session`
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
Post inserts for MyISAM table skin_merge_session
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
Created UTF8 table skin_replacements (PKEY: replacement_id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
skin_replacements keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
Continuing with skin_replacements (PKEY: replacement_id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
Pre inserts for MyISAM table skin_replacements
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
INSERT IGNORE INTO `x_utf_skin_replacements` SELECT `replacement_id`,CONVERT( CAST(`replacement_key` AS BINARY) USING utf8 ),CONVERT( CAST(`replacement_content` AS BINARY) USING utf8 ),`replacement_set_id`,`replacement_added_to`,CONVERT( CAST(`replacement_master_key` AS BINARY) USING utf8 ) FROM `skin_replacements`
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
Post inserts for MyISAM table skin_replacements
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
Created UTF8 table skin_templates (PKEY: template_id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
skin_templates keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
Continuing with skin_templates (PKEY: template_id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
Pre inserts for MyISAM table skin_templates
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
INSERT IGNORE INTO `x_utf_skin_templates` SELECT `template_id`,`template_set_id`,CONVERT( CAST(`template_group` AS BINARY) USING utf8 ),CONVERT( CAST(`template_content` AS BINARY) USING utf8 ),CONVERT( CAST(`template_name` AS BINARY) USING utf8 ),CONVERT( CAST(`template_data` AS BINARY) USING utf8 ),`template_updated`,`template_removable`,`template_added_to`,`template_user_added`,`template_user_edited`,CONVERT( CAST(`template_master_key` AS BINARY) USING utf8 ) FROM `skin_templates`
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
Post inserts for MyISAM table skin_templates
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
Created UTF8 table skin_templates_cache (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
skin_templates_cache keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
Continuing with skin_templates_cache (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
Pre inserts for MyISAM table skin_templates_cache
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
INSERT IGNORE INTO `x_utf_skin_templates_cache` SELECT CONVERT( CAST(`template_id` AS BINARY) USING utf8 ),CONVERT( CAST(`template_group_name` AS BINARY) USING utf8 ),CONVERT( CAST(`template_group_content` AS BINARY) USING utf8 ),`template_set_id` FROM `skin_templates_cache`
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
Post inserts for MyISAM table skin_templates_cache
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
Created UTF8 table skin_templates_previous (PKEY: p_template_id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
skin_templates_previous keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
Continuing with skin_templates_previous (PKEY: p_template_id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
Pre inserts for MyISAM table skin_templates_previous
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
INSERT IGNORE INTO `x_utf_skin_templates_previous` SELECT `p_template_id`,CONVERT( CAST(`p_template_group` AS BINARY) USING utf8 ),CONVERT( CAST(`p_template_content` AS BINARY) USING utf8 ),CONVERT( CAST(`p_template_name` AS BINARY) USING utf8 ),CONVERT( CAST(`p_template_data` AS BINARY) USING utf8 ),CONVERT( CAST(`p_template_master_key` AS BINARY) USING utf8 ),CONVERT( CAST(`p_template_long_version` AS BINARY) USING utf8 ),CONVERT( CAST(`p_template_human_version` AS BINARY) USING utf8 ) FROM `skin_templates_previous`
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
Post inserts for MyISAM table skin_templates_previous
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
Created UTF8 table skin_url_mapping (PKEY: map_id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
skin_url_mapping keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
Continuing with skin_url_mapping (PKEY: map_id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
Pre inserts for MyISAM table skin_url_mapping
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
INSERT IGNORE INTO `x_utf_skin_url_mapping` SELECT `map_id`,CONVERT( CAST(`map_title` AS BINARY) USING utf8 ),CONVERT( CAST(`map_match_type` AS BINARY) USING utf8 ),CONVERT( CAST(`map_url` AS BINARY) USING utf8 ),`map_skin_set_id`,`map_date_added` FROM `skin_url_mapping`
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
Post inserts for MyISAM table skin_url_mapping
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
Created UTF8 table spam_service_log (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
spam_service_log keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
Continuing with spam_service_log (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
Pre inserts for MyISAM table spam_service_log
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
INSERT IGNORE INTO `x_utf_spam_service_log` SELECT `id`,`log_date`,`log_code`,CONVERT( CAST(`log_msg` AS BINARY) USING utf8 ),CONVERT( CAST(`email_address` AS BINARY) USING utf8 ),CONVERT( CAST(`ip_address` AS BINARY) USING utf8 ) FROM `spam_service_log`
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
Post inserts for MyISAM table spam_service_log
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
Created UTF8 table spider_logs (PKEY: sid)
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
spider_logs keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
Continuing with spider_logs (PKEY: sid)
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
Pre inserts for MyISAM table spider_logs
------------------------------------------------
Sun, 29 Apr 2018 03:29:44 +0000
INSERT IGNORE INTO `x_utf_spider_logs` SELECT `sid`,CONVERT( CAST(`bot` AS BINARY) USING utf8 ),CONVERT( CAST(`query_string` AS BINARY) USING utf8 ),`entry_date`,CONVERT( CAST(`ip_address` AS BINARY) USING utf8 ),CONVERT( CAST(`request_addr` AS BINARY) USING utf8 ) FROM `spider_logs`
------------------------------------------------
Sun, 29 Apr 2018 03:29:49 +0000
Post inserts for MyISAM table spider_logs
------------------------------------------------
Sun, 29 Apr 2018 03:29:49 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:49 +0000
Created UTF8 table tags_index (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:49 +0000
tags_index keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:49 +0000
Continuing with tags_index (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:49 +0000
Pre inserts for MyISAM table tags_index
------------------------------------------------
Sun, 29 Apr 2018 03:29:49 +0000
INSERT IGNORE INTO `x_utf_tags_index` SELECT `id`,CONVERT( CAST(`app` AS BINARY) USING utf8 ),CONVERT( CAST(`tag` AS BINARY) USING utf8 ),CONVERT( CAST(`type` AS BINARY) USING utf8 ),`type_id`,CONVERT( CAST(`type_2` AS BINARY) USING utf8 ),`type_id_2`,`updated`,`member_id`,`tag_hidden` FROM `tags_index`
------------------------------------------------
Sun, 29 Apr 2018 03:29:49 +0000
Post inserts for MyISAM table tags_index
------------------------------------------------
Sun, 29 Apr 2018 03:29:49 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:49 +0000
Created UTF8 table tapatalk_push_data (PKEY: push_id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:49 +0000
tapatalk_push_data keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:49 +0000
Continuing with tapatalk_push_data (PKEY: push_id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:49 +0000
Pre inserts for MyISAM table tapatalk_push_data
------------------------------------------------
Sun, 29 Apr 2018 03:29:49 +0000
INSERT IGNORE INTO `x_utf_tapatalk_push_data` SELECT `push_id`,CONVERT( CAST(`author` AS BINARY) USING utf8 ),`user_id`,CONVERT( CAST(`data_type` AS BINARY) USING utf8 ),CONVERT( CAST(`title` AS BINARY) USING utf8 ),`data_id`,`create_time`,`sub_id`,`author_id` FROM `tapatalk_push_data`
------------------------------------------------
Sun, 29 Apr 2018 03:29:49 +0000
Post inserts for MyISAM table tapatalk_push_data
------------------------------------------------
Sun, 29 Apr 2018 03:29:49 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:49 +0000
Created UTF8 table tapatalk_users (PKEY: userid)
------------------------------------------------
Sun, 29 Apr 2018 03:29:49 +0000
tapatalk_users keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:49 +0000
Continuing with tapatalk_users (PKEY: userid)
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
Pre inserts for MyISAM table tapatalk_users
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
Post inserts for MyISAM table tapatalk_users
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
No columns to convert in tapatalk_users INSERT INTO FROM SELECT used
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
Created UTF8 table task_logs (PKEY: log_id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
task_logs keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
Continuing with task_logs (PKEY: log_id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
Pre inserts for MyISAM table task_logs
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
INSERT IGNORE INTO `x_utf_task_logs` SELECT `log_id`,CONVERT( CAST(`log_title` AS BINARY) USING utf8 ),`log_date`,CONVERT( CAST(`log_ip` AS BINARY) USING utf8 ),CONVERT( CAST(`log_desc` AS BINARY) USING utf8 ) FROM `task_logs`
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
Post inserts for MyISAM table task_logs
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
Created UTF8 table task_manager (PKEY: task_id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
task_manager keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
Continuing with task_manager (PKEY: task_id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
Pre inserts for MyISAM table task_manager
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
INSERT IGNORE INTO `x_utf_task_manager` SELECT `task_id`,CONVERT( CAST(`task_title` AS BINARY) USING utf8 ),CONVERT( CAST(`task_file` AS BINARY) USING utf8 ),`task_next_run`,`task_week_day`,`task_month_day`,`task_hour`,`task_minute`,CONVERT( CAST(`task_cronkey` AS BINARY) USING utf8 ),`task_log`,CONVERT( CAST(`task_description` AS BINARY) USING utf8 ),`task_enabled`,CONVERT( CAST(`task_key` AS BINARY) USING utf8 ),`task_safemode`,`task_locked`,CONVERT( CAST(`task_application` AS BINARY) USING utf8 ) FROM `task_manager`
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
Post inserts for MyISAM table task_manager
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
Created UTF8 table template_sandr (PKEY: sandr_session_id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
template_sandr keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
Continuing with template_sandr (PKEY: sandr_session_id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
Pre inserts for MyISAM table template_sandr
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
INSERT IGNORE INTO `x_utf_template_sandr` SELECT `sandr_session_id`,`sandr_set_id`,`sandr_search_only`,`sandr_search_all`,CONVERT( CAST(`sandr_search_for` AS BINARY) USING utf8 ),CONVERT( CAST(`sandr_replace_with` AS BINARY) USING utf8 ),`sandr_is_regex`,`sandr_template_count`,`sandr_template_processed`,CONVERT( CAST(`sandr_results` AS BINARY) USING utf8 ),`sandr_updated` FROM `template_sandr`
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
Post inserts for MyISAM table template_sandr
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
Created UTF8 table titles (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
titles keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
Continuing with titles (PKEY: id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
Pre inserts for MyISAM table titles
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
INSERT IGNORE INTO `x_utf_titles` SELECT `id`,`posts`,CONVERT( CAST(`title` AS BINARY) USING utf8 ),CONVERT( CAST(`pips` AS BINARY) USING utf8 ) FROM `titles`
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
Post inserts for MyISAM table titles
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
Created UTF8 table topic_mmod (PKEY: mm_id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
topic_mmod keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
Continuing with topic_mmod (PKEY: mm_id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
Pre inserts for MyISAM table topic_mmod
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
INSERT IGNORE INTO `x_utf_topic_mmod` SELECT `mm_id`,CONVERT( CAST(`mm_title` AS BINARY) USING utf8 ),`mm_enabled`,CONVERT( CAST(`topic_state` AS BINARY) USING utf8 ),CONVERT( CAST(`topic_pin` AS BINARY) USING utf8 ),`topic_move`,`topic_move_link`,CONVERT( CAST(`topic_title_st` AS BINARY) USING utf8 ),CONVERT( CAST(`topic_title_end` AS BINARY) USING utf8 ),`topic_reply`,CONVERT( CAST(`topic_reply_content` AS BINARY) USING utf8 ),`topic_reply_postcount`,CONVERT( CAST(`mm_forums` AS BINARY) USING utf8 ),`topic_approve`,`topic_prefix`,CONVERT( CAST(`topic_add_tags` AS BINARY) USING utf8 ) FROM `topic_mmod`
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
Post inserts for MyISAM table topic_mmod
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
Created UTF8 table topic_prefixes (PKEY: prefix_id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
topic_prefixes keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
Continuing with topic_prefixes (PKEY: prefix_id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
Pre inserts for MyISAM table topic_prefixes
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
INSERT IGNORE INTO `x_utf_topic_prefixes` SELECT `prefix_id`,CONVERT( CAST(`prefix_title` AS BINARY) USING utf8 ),CONVERT( CAST(`prefix_pre` AS BINARY) USING utf8 ),CONVERT( CAST(`prefix_post` AS BINARY) USING utf8 ),CONVERT( CAST(`prefix_groups` AS BINARY) USING utf8 ),`prefix_showtitle` FROM `topic_prefixes`
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
Post inserts for MyISAM table topic_prefixes
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
Created UTF8 table topic_ratings (PKEY: rating_id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
topic_ratings keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
Continuing with topic_ratings (PKEY: rating_id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
Pre inserts for MyISAM table topic_ratings
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
INSERT IGNORE INTO `x_utf_topic_ratings` SELECT `rating_id`,`rating_tid`,`rating_member_id`,`rating_value`,CONVERT( CAST(`rating_ip_address` AS BINARY) USING utf8 ) FROM `topic_ratings`
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
Post inserts for MyISAM table topic_ratings
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
Created UTF8 table topic_views (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
topic_views keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
Continuing with topic_views (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
No content conversion of topic_views required
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
Created UTF8 table topics (PKEY: tid)
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
topics keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
Continuing with topics (PKEY: tid)
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
Pre inserts for MyISAM table topics
------------------------------------------------
Sun, 29 Apr 2018 03:29:50 +0000
INSERT IGNORE INTO `x_utf_topics` SELECT `tid`,CONVERT( CAST(`title` AS BINARY) USING utf8 ),CONVERT( CAST(`state` AS BINARY) USING utf8 ),`posts`,`starter_id`,`start_date`,`last_poster_id`,`last_post`,CONVERT( CAST(`starter_name` AS BINARY) USING utf8 ),CONVERT( CAST(`last_poster_name` AS BINARY) USING utf8 ),CONVERT( CAST(`poll_state` AS BINARY) USING utf8 ),`last_vote`,`views`,`forum_id`,`approved`,`author_mode`,`pinned`,CONVERT( CAST(`moved_to` AS BINARY) USING utf8 ),`topic_hasattach`,`topic_firstpost`,`topic_queuedposts`,`topic_open_time`,`topic_close_time`,`topic_rating_total`,`topic_rating_hits`,CONVERT( CAST(`title_seo` AS BINARY) USING utf8 ),CONVERT( CAST(`seo_last_name` AS BINARY) USING utf8 ),CONVERT( CAST(`seo_first_name` AS BINARY) USING utf8 ),`topic_deleted_posts`,`tdelete_time`,`moved_on`,`topic_archive_status`,`last_real_post`,`topic_answered_pid` FROM `topics`
------------------------------------------------
Sun, 29 Apr 2018 03:29:51 +0000
Post inserts for MyISAM table topics
------------------------------------------------
Sun, 29 Apr 2018 03:29:54 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:54 +0000
Created UTF8 table twitter_connect (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:29:54 +0000
twitter_connect keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:54 +0000
Continuing with twitter_connect (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:29:54 +0000
Pre inserts for MyISAM table twitter_connect
------------------------------------------------
Sun, 29 Apr 2018 03:29:54 +0000
INSERT IGNORE INTO `x_utf_twitter_connect` SELECT CONVERT( CAST(`t_key` AS BINARY) USING utf8 ),CONVERT( CAST(`t_token` AS BINARY) USING utf8 ),CONVERT( CAST(`t_secret` AS BINARY) USING utf8 ),`t_time` FROM `twitter_connect`
------------------------------------------------
Sun, 29 Apr 2018 03:29:54 +0000
Post inserts for MyISAM table twitter_connect
------------------------------------------------
Sun, 29 Apr 2018 03:29:54 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:54 +0000
Created UTF8 table upgrade_history (PKEY: upgrade_id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:54 +0000
upgrade_history keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:54 +0000
Continuing with upgrade_history (PKEY: upgrade_id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:54 +0000
Pre inserts for MyISAM table upgrade_history
------------------------------------------------
Sun, 29 Apr 2018 03:29:54 +0000
INSERT IGNORE INTO `x_utf_upgrade_history` SELECT `upgrade_id`,`upgrade_version_id`,CONVERT( CAST(`upgrade_version_human` AS BINARY) USING utf8 ),`upgrade_date`,`upgrade_mid`,CONVERT( CAST(`upgrade_notes` AS BINARY) USING utf8 ),CONVERT( CAST(`upgrade_app` AS BINARY) USING utf8 ) FROM `upgrade_history`
------------------------------------------------
Sun, 29 Apr 2018 03:29:54 +0000
Post inserts for MyISAM table upgrade_history
------------------------------------------------
Sun, 29 Apr 2018 03:29:54 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:54 +0000
Created UTF8 table upgrade_sessions (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:29:54 +0000
upgrade_sessions keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:54 +0000
Continuing with upgrade_sessions (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:29:54 +0000
Pre inserts for MyISAM table upgrade_sessions
------------------------------------------------
Sun, 29 Apr 2018 03:29:54 +0000
INSERT IGNORE INTO `x_utf_upgrade_sessions` SELECT CONVERT( CAST(`session_id` AS BINARY) USING utf8 ),`session_member_id`,CONVERT( CAST(`session_member_key` AS BINARY) USING utf8 ),`session_start_time`,`session_current_time`,CONVERT( CAST(`session_ip_address` AS BINARY) USING utf8 ),CONVERT( CAST(`session_section` AS BINARY) USING utf8 ),CONVERT( CAST(`session_post` AS BINARY) USING utf8 ),CONVERT( CAST(`session_get` AS BINARY) USING utf8 ),CONVERT( CAST(`session_data` AS BINARY) USING utf8 ),CONVERT( CAST(`session_extra` AS BINARY) USING utf8 ) FROM `upgrade_sessions`
------------------------------------------------
Sun, 29 Apr 2018 03:29:54 +0000
Post inserts for MyISAM table upgrade_sessions
------------------------------------------------
Sun, 29 Apr 2018 03:29:54 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:54 +0000
Created UTF8 table validating (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:29:54 +0000
validating keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:54 +0000
Continuing with validating (PKEY: )
------------------------------------------------
Sun, 29 Apr 2018 03:29:54 +0000
Pre inserts for MyISAM table validating
------------------------------------------------
Sun, 29 Apr 2018 03:29:54 +0000
INSERT IGNORE INTO `x_utf_validating` SELECT CONVERT( CAST(`vid` AS BINARY) USING utf8 ),`member_id`,`real_group`,`temp_group`,`entry_date`,`coppa_user`,`lost_pass`,`new_reg`,`email_chg`,CONVERT( CAST(`ip_address` AS BINARY) USING utf8 ),`user_verified`,CONVERT( CAST(`prev_email` AS BINARY) USING utf8 ),`spam_flag` FROM `validating`
------------------------------------------------
Sun, 29 Apr 2018 03:29:54 +0000
Post inserts for MyISAM table validating
------------------------------------------------
Sun, 29 Apr 2018 03:29:54 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:54 +0000
Created UTF8 table voters (PKEY: vid)
------------------------------------------------
Sun, 29 Apr 2018 03:29:54 +0000
voters keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:54 +0000
Continuing with voters (PKEY: vid)
------------------------------------------------
Sun, 29 Apr 2018 03:29:54 +0000
Pre inserts for MyISAM table voters
------------------------------------------------
Sun, 29 Apr 2018 03:29:54 +0000
INSERT IGNORE INTO `x_utf_voters` SELECT `vid`,CONVERT( CAST(`ip_address` AS BINARY) USING utf8 ),`vote_date`,`tid`,`member_id`,`forum_id`,CONVERT( CAST(`member_choices` AS BINARY) USING utf8 ) FROM `voters`
------------------------------------------------
Sun, 29 Apr 2018 03:29:54 +0000
Post inserts for MyISAM table voters
------------------------------------------------
Sun, 29 Apr 2018 03:29:54 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:54 +0000
Created UTF8 table warn_logs (PKEY: wlog_id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:54 +0000
warn_logs keys disabled.
------------------------------------------------
Sun, 29 Apr 2018 03:29:54 +0000
Continuing with warn_logs (PKEY: wlog_id)
------------------------------------------------
Sun, 29 Apr 2018 03:29:54 +0000
Pre inserts for MyISAM table warn_logs
------------------------------------------------
Sun, 29 Apr 2018 03:29:54 +0000
INSERT IGNORE INTO `x_utf_warn_logs` SELECT `wlog_id`,`wlog_mid`,CONVERT( CAST(`wlog_notes` AS BINARY) USING utf8 ),CONVERT( CAST(`wlog_contact` AS BINARY) USING utf8 ),CONVERT( CAST(`wlog_contact_content` AS BINARY) USING utf8 ),`wlog_date`,CONVERT( CAST(`wlog_type` AS BINARY) USING utf8 ),`wlog_addedby` FROM `warn_logs`
------------------------------------------------
Sun, 29 Apr 2018 03:29:54 +0000
Post inserts for MyISAM table warn_logs
------------------------------------------------
Sun, 29 Apr 2018 03:29:54 +0000
 keys enabled.
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `admin_login_logs` TO `orig_admin_login_logs`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `admin_logs` TO `orig_admin_logs`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `admin_permission_rows` TO `orig_admin_permission_rows`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `announcements` TO `orig_announcements`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `api_log` TO `orig_api_log`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `api_users` TO `orig_api_users`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `attachments` TO `orig_attachments`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `attachments_type` TO `orig_attachments_type`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `backup_log` TO `orig_backup_log`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `backup_queue` TO `orig_backup_queue`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `backup_vars` TO `orig_backup_vars`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `badwords` TO `orig_badwords`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `banfilters` TO `orig_banfilters`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `bbcode_mediatag` TO `orig_bbcode_mediatag`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `blog_akismet_logs` TO `orig_blog_akismet_logs`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `blog_blogs` TO `orig_blog_blogs`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `blog_categories` TO `orig_blog_categories`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `blog_category_mapping` TO `orig_blog_category_mapping`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `blog_cblock_cache` TO `orig_blog_cblock_cache`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `blog_cblocks` TO `orig_blog_cblocks`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `blog_comments` TO `orig_blog_comments`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `blog_custom_cblocks` TO `orig_blog_custom_cblocks`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `blog_default_cblocks` TO `orig_blog_default_cblocks`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `blog_editors_map` TO `orig_blog_editors_map`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `blog_entries` TO `orig_blog_entries`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `blog_lastinfo` TO `orig_blog_lastinfo`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `blog_mediatag` TO `orig_blog_mediatag`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `blog_moderators` TO `orig_blog_moderators`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `blog_pingservices` TO `orig_blog_pingservices`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `blog_polls` TO `orig_blog_polls`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `blog_ratings` TO `orig_blog_ratings`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `blog_rsscache` TO `orig_blog_rsscache`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `blog_rssimport` TO `orig_blog_rssimport`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `blog_themes` TO `orig_blog_themes`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `blog_this` TO `orig_blog_this`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `blog_trackback` TO `orig_blog_trackback`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `blog_trackback_spamlogs` TO `orig_blog_trackback_spamlogs`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `blog_updatepings` TO `orig_blog_updatepings`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `blog_views` TO `orig_blog_views`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `blog_voters` TO `orig_blog_voters`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `bulk_mail` TO `orig_bulk_mail`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `cache_simple` TO `orig_cache_simple`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `cache_store` TO `orig_cache_store`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `cal_calendars` TO `orig_cal_calendars`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `cal_event_comments` TO `orig_cal_event_comments`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `cal_event_ratings` TO `orig_cal_event_ratings`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `cal_event_rsvp` TO `orig_cal_event_rsvp`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `cal_events` TO `orig_cal_events`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `cal_import_feeds` TO `orig_cal_import_feeds`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `cal_import_map` TO `orig_cal_import_map`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `captcha` TO `orig_captcha`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `ccs_attachments_map` TO `orig_ccs_attachments_map`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `ccs_block_wizard` TO `orig_ccs_block_wizard`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `ccs_blocks` TO `orig_ccs_blocks`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `ccs_containers` TO `orig_ccs_containers`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `ccs_custom_database_1` TO `orig_ccs_custom_database_1`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `ccs_custom_database_1_bak` TO `orig_ccs_custom_database_1_bak`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `ccs_custom_database_1_bak101314` TO `orig_ccs_custom_database_1_bak101314`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `ccs_database_categories` TO `orig_ccs_database_categories`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `ccs_database_comments` TO `orig_ccs_database_comments`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `ccs_database_fields` TO `orig_ccs_database_fields`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `ccs_database_moderators` TO `orig_ccs_database_moderators`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `ccs_database_modqueue` TO `orig_ccs_database_modqueue`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `ccs_database_ratings` TO `orig_ccs_database_ratings`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `ccs_database_revisions` TO `orig_ccs_database_revisions`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `ccs_databases` TO `orig_ccs_databases`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `ccs_folders` TO `orig_ccs_folders`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `ccs_menus` TO `orig_ccs_menus`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `ccs_page_templates` TO `orig_ccs_page_templates`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `ccs_page_wizard` TO `orig_ccs_page_wizard`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `ccs_pages` TO `orig_ccs_pages`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `ccs_revisions` TO `orig_ccs_revisions`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `ccs_slug_memory` TO `orig_ccs_slug_memory`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `ccs_template_blocks` TO `orig_ccs_template_blocks`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `ccs_template_cache` TO `orig_ccs_template_cache`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `cmtp_bugs` TO `orig_cmtp_bugs`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `cmtp_groups` TO `orig_cmtp_groups`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `cmtp_members` TO `orig_cmtp_members`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `cmtp_members_added` TO `orig_cmtp_members_added`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `contato_antispam` TO `orig_contato_antispam`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `contato_customfields` TO `orig_contato_customfields`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `contato_departamentos` TO `orig_contato_departamentos`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `contato_emails` TO `orig_contato_emails`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `content_cache_posts` TO `orig_content_cache_posts`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `content_cache_posts_bak` TO `orig_content_cache_posts_bak`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `content_cache_sigs` TO `orig_content_cache_sigs`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `content_cache_sigs_bak` TO `orig_content_cache_sigs_bak`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `conv_apps` TO `orig_conv_apps`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `conv_link` TO `orig_conv_link`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `conv_link_pms` TO `orig_conv_link_pms`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `conv_link_posts` TO `orig_conv_link_posts`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `conv_link_topics` TO `orig_conv_link_topics`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `core_applications` TO `orig_core_applications`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `core_archive_log` TO `orig_core_archive_log`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `core_archive_restore` TO `orig_core_archive_restore`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `core_archive_rules` TO `orig_core_archive_rules`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `core_editor_autosave` TO `orig_core_editor_autosave`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `core_geolocation_cache` TO `orig_core_geolocation_cache`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `core_hooks` TO `orig_core_hooks`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `core_hooks_files` TO `orig_core_hooks_files`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `core_incoming_email_log` TO `orig_core_incoming_email_log`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `core_incoming_emails` TO `orig_core_incoming_emails`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `core_inline_messages` TO `orig_core_inline_messages`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `core_item_markers` TO `orig_core_item_markers`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `core_item_markers_storage` TO `orig_core_item_markers_storage`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `core_like` TO `orig_core_like`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `core_like_cache` TO `orig_core_like_cache`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `core_rss_imported` TO `orig_core_rss_imported`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `core_share_links` TO `orig_core_share_links`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `core_share_links_log` TO `orig_core_share_links_log`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `core_soft_delete_log` TO `orig_core_soft_delete_log`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `core_sys_bookmarks` TO `orig_core_sys_bookmarks`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `core_sys_conf_settings` TO `orig_core_sys_conf_settings`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `core_sys_cp_sessions` TO `orig_core_sys_cp_sessions`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `core_sys_lang` TO `orig_core_sys_lang`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `core_sys_lang_words` TO `orig_core_sys_lang_words`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `core_sys_login` TO `orig_core_sys_login`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `core_sys_module` TO `orig_core_sys_module`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `core_sys_settings_titles` TO `orig_core_sys_settings_titles`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `core_tags` TO `orig_core_tags`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `core_tags_cache` TO `orig_core_tags_cache`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `core_tags_perms` TO `orig_core_tags_perms`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `core_uagent_groups` TO `orig_core_uagent_groups`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `core_uagents` TO `orig_core_uagents`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `custom_bbcode` TO `orig_custom_bbcode`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `dnames_change` TO `orig_dnames_change`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `dp3_rs_referrals` TO `orig_dp3_rs_referrals`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `emoticons` TO `orig_emoticons`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `error_logs` TO `orig_error_logs`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `export_posts` TO `orig_export_posts`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `faq` TO `orig_faq`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `fcontent` TO `orig_fcontent`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `fcontent_slideshow` TO `orig_fcontent_slideshow`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `forum_perms` TO `orig_forum_perms`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `forums` TO `orig_forums`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `forums_archive_posts` TO `orig_forums_archive_posts`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `forums_recent_posts` TO `orig_forums_recent_posts`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `gallery_albums` TO `orig_gallery_albums`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `gallery_bandwidth` TO `orig_gallery_bandwidth`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `gallery_categories` TO `orig_gallery_categories`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `gallery_comments` TO `orig_gallery_comments`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `gallery_images` TO `orig_gallery_images`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `gallery_images_uploads` TO `orig_gallery_images_uploads`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `gallery_moderators` TO `orig_gallery_moderators`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `gallery_ratings` TO `orig_gallery_ratings`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `gaplus_events` TO `orig_gaplus_events`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `gaplus_vars` TO `orig_gaplus_vars`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `groups` TO `orig_groups`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `ignored_users` TO `orig_ignored_users`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `inline_notifications` TO `orig_inline_notifications`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `login_methods` TO `orig_login_methods`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `mail_error_logs` TO `orig_mail_error_logs`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `mail_queue` TO `orig_mail_queue`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `member_status_actions` TO `orig_member_status_actions`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `member_status_replies` TO `orig_member_status_replies`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `member_status_updates` TO `orig_member_status_updates`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `members` TO `orig_members`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `members_partial` TO `orig_members_partial`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `members_warn_actions` TO `orig_members_warn_actions`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `members_warn_logs` TO `orig_members_warn_logs`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `members_warn_reasons` TO `orig_members_warn_reasons`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `message_posts` TO `orig_message_posts`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `message_topic_user_map` TO `orig_message_topic_user_map`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `message_topics` TO `orig_message_topics`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `mobile_app_style` TO `orig_mobile_app_style`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `mobile_device_map` TO `orig_mobile_device_map`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `mobile_notifications` TO `orig_mobile_notifications`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `mod_queued_items` TO `orig_mod_queued_items`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `moderator_logs` TO `orig_moderator_logs`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `moderators` TO `orig_moderators`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `nexus_ads` TO `orig_nexus_ads`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `nexus_alternate_contacts` TO `orig_nexus_alternate_contacts`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `nexus_coupons` TO `orig_nexus_coupons`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `nexus_customer_fields` TO `orig_nexus_customer_fields`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `nexus_customer_history` TO `orig_nexus_customer_history`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `nexus_customers` TO `orig_nexus_customers`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `nexus_donate_goals` TO `orig_nexus_donate_goals`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `nexus_donate_logs` TO `orig_nexus_donate_logs`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `nexus_eom` TO `orig_nexus_eom`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `nexus_fraud_rules` TO `orig_nexus_fraud_rules`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `nexus_gateways` TO `orig_nexus_gateways`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `nexus_hosting_accounts` TO `orig_nexus_hosting_accounts`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `nexus_hosting_errors` TO `orig_nexus_hosting_errors`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `nexus_hosting_queues` TO `orig_nexus_hosting_queues`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `nexus_hosting_servers` TO `orig_nexus_hosting_servers`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `nexus_invoices` TO `orig_nexus_invoices`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `nexus_licensekeys` TO `orig_nexus_licensekeys`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `nexus_notes` TO `orig_nexus_notes`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `nexus_package_fields` TO `orig_nexus_package_fields`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `nexus_package_groups` TO `orig_nexus_package_groups`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `nexus_package_images` TO `orig_nexus_package_images`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `nexus_packages` TO `orig_nexus_packages`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `nexus_packages_ads` TO `orig_nexus_packages_ads`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `nexus_packages_hosting` TO `orig_nexus_packages_hosting`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `nexus_packages_products` TO `orig_nexus_packages_products`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `nexus_paymethods` TO `orig_nexus_paymethods`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `nexus_payouts` TO `orig_nexus_payouts`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `nexus_product_options` TO `orig_nexus_product_options`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `nexus_purchases` TO `orig_nexus_purchases`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `nexus_referral_banners` TO `orig_nexus_referral_banners`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `nexus_referral_rules` TO `orig_nexus_referral_rules`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `nexus_referrals` TO `orig_nexus_referrals`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `nexus_review_rates` TO `orig_nexus_review_rates`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `nexus_reviews` TO `orig_nexus_reviews`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `nexus_ship_orders` TO `orig_nexus_ship_orders`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `nexus_shipping` TO `orig_nexus_shipping`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `nexus_subscriptions` TO `orig_nexus_subscriptions`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `nexus_support_departments` TO `orig_nexus_support_departments`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `nexus_support_fields` TO `orig_nexus_support_fields`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `nexus_support_ratings` TO `orig_nexus_support_ratings`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `nexus_support_replies` TO `orig_nexus_support_replies`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `nexus_support_requests` TO `orig_nexus_support_requests`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `nexus_support_severities` TO `orig_nexus_support_severities`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `nexus_support_staff` TO `orig_nexus_support_staff`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `nexus_support_statuses` TO `orig_nexus_support_statuses`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `nexus_support_stock_actions` TO `orig_nexus_support_stock_actions`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `nexus_support_tracker` TO `orig_nexus_support_tracker`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `nexus_support_views` TO `orig_nexus_support_views`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `nexus_tax` TO `orig_nexus_tax`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `nexus_transactions` TO `orig_nexus_transactions`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `permission_index` TO `orig_permission_index`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `pfields_content` TO `orig_pfields_content`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `pfields_data` TO `orig_pfields_data`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `pfields_groups` TO `orig_pfields_groups`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `polls` TO `orig_polls`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `posts` TO `orig_posts`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `profile_friends` TO `orig_profile_friends`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `profile_friends_flood` TO `orig_profile_friends_flood`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `profile_portal` TO `orig_profile_portal`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `profile_portal_views` TO `orig_profile_portal_views`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `profile_ratings` TO `orig_profile_ratings`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `question_and_answer` TO `orig_question_and_answer`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `rc_classes` TO `orig_rc_classes`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `rc_comments` TO `orig_rc_comments`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `rc_modpref` TO `orig_rc_modpref`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `rc_reports` TO `orig_rc_reports`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `rc_reports_index` TO `orig_rc_reports_index`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `rc_status` TO `orig_rc_status`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `rc_status_sev` TO `orig_rc_status_sev`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `reputation_cache` TO `orig_reputation_cache`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `reputation_index` TO `orig_reputation_index`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `reputation_levels` TO `orig_reputation_levels`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `reputation_totals` TO `orig_reputation_totals`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `rest_menu_items` TO `orig_rest_menu_items`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `rest_profile_tabs` TO `orig_rest_profile_tabs`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `rest_renewal_keys` TO `orig_rest_renewal_keys`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `rest_tmp_attach` TO `orig_rest_tmp_attach`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `reviews` TO `orig_reviews`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `reviews_bak` TO `orig_reviews_bak`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `reviews_ban_logs` TO `orig_reviews_ban_logs`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `reviews_behavior` TO `orig_reviews_behavior`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `reviews_categories` TO `orig_reviews_categories`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `reviews_comments` TO `orig_reviews_comments`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `reviews_deals` TO `orig_reviews_deals`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `reviews_detailed_ratings` TO `orig_reviews_detailed_ratings`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `reviews_edit_logs` TO `orig_reviews_edit_logs`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `reviews_extra_ratings` TO `orig_reviews_extra_ratings`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `reviews_faq_answers` TO `orig_reviews_faq_answers`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `reviews_faq_questions` TO `orig_reviews_faq_questions`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `reviews_favorites` TO `orig_reviews_favorites`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `reviews_owned` TO `orig_reviews_owned`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `reviews_ratings` TO `orig_reviews_ratings`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `reviews_requests` TO `orig_reviews_requests`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `reviews_searches` TO `orig_reviews_searches`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `reviews_tags` TO `orig_reviews_tags`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `reviews_tracker_author` TO `orig_reviews_tracker_author`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `reviews_tracker_product` TO `orig_reviews_tracker_product`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `reviews_tracker_review` TO `orig_reviews_tracker_review`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `reviews_views` TO `orig_reviews_views`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `reviews_waiting` TO `orig_reviews_waiting`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `reviews_wish_list` TO `orig_reviews_wish_list`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `rss_export` TO `orig_rss_export`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `rss_import` TO `orig_rss_import`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `rss_imported` TO `orig_rss_imported`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `search_keywords` TO `orig_search_keywords`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `search_sessions` TO `orig_search_sessions`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `search_visitors` TO `orig_search_visitors`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `seo_acronyms` TO `orig_seo_acronyms`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `seo_meta` TO `orig_seo_meta`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `sessions` TO `orig_sessions`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `sfs_blocked` TO `orig_sfs_blocked`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `sfs_settings` TO `orig_sfs_settings`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `sfs_tracking` TO `orig_sfs_tracking`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `sfs_whitelist` TO `orig_sfs_whitelist`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `sidebars` TO `orig_sidebars`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `sidebars_blocks` TO `orig_sidebars_blocks`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `sidebars_blocks_sequence` TO `orig_sidebars_blocks_sequence`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `skin_cache` TO `orig_skin_cache`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `skin_collections` TO `orig_skin_collections`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `skin_css` TO `orig_skin_css`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `skin_css_previous` TO `orig_skin_css_previous`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `skin_generator_sessions` TO `orig_skin_generator_sessions`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `skin_merge_changes` TO `orig_skin_merge_changes`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `skin_merge_session` TO `orig_skin_merge_session`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `skin_replacements` TO `orig_skin_replacements`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `skin_templates` TO `orig_skin_templates`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `skin_templates_cache` TO `orig_skin_templates_cache`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `skin_templates_previous` TO `orig_skin_templates_previous`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `skin_url_mapping` TO `orig_skin_url_mapping`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `spam_service_log` TO `orig_spam_service_log`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `spider_logs` TO `orig_spider_logs`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `tags_index` TO `orig_tags_index`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `tapatalk_push_data` TO `orig_tapatalk_push_data`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `tapatalk_users` TO `orig_tapatalk_users`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `task_logs` TO `orig_task_logs`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `task_manager` TO `orig_task_manager`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `template_sandr` TO `orig_template_sandr`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `titles` TO `orig_titles`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `topic_mmod` TO `orig_topic_mmod`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `topic_prefixes` TO `orig_topic_prefixes`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `topic_ratings` TO `orig_topic_ratings`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `topic_views` TO `orig_topic_views`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `topics` TO `orig_topics`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `twitter_connect` TO `orig_twitter_connect`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `upgrade_history` TO `orig_upgrade_history`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `upgrade_sessions` TO `orig_upgrade_sessions`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `validating` TO `orig_validating`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `voters` TO `orig_voters`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `warn_logs` TO `orig_warn_logs`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_admin_login_logs` TO `admin_login_logs`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_admin_logs` TO `admin_logs`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_admin_permission_rows` TO `admin_permission_rows`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_announcements` TO `announcements`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_api_log` TO `api_log`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_api_users` TO `api_users`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_attachments` TO `attachments`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_attachments_type` TO `attachments_type`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_backup_log` TO `backup_log`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_backup_queue` TO `backup_queue`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_backup_vars` TO `backup_vars`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_badwords` TO `badwords`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_banfilters` TO `banfilters`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_bbcode_mediatag` TO `bbcode_mediatag`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_blog_akismet_logs` TO `blog_akismet_logs`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_blog_blogs` TO `blog_blogs`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_blog_categories` TO `blog_categories`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_blog_category_mapping` TO `blog_category_mapping`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_blog_cblock_cache` TO `blog_cblock_cache`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_blog_cblocks` TO `blog_cblocks`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_blog_comments` TO `blog_comments`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_blog_custom_cblocks` TO `blog_custom_cblocks`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_blog_default_cblocks` TO `blog_default_cblocks`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_blog_editors_map` TO `blog_editors_map`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_blog_entries` TO `blog_entries`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_blog_lastinfo` TO `blog_lastinfo`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_blog_mediatag` TO `blog_mediatag`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_blog_moderators` TO `blog_moderators`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_blog_pingservices` TO `blog_pingservices`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_blog_polls` TO `blog_polls`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_blog_ratings` TO `blog_ratings`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_blog_rsscache` TO `blog_rsscache`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_blog_rssimport` TO `blog_rssimport`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_blog_themes` TO `blog_themes`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_blog_this` TO `blog_this`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_blog_trackback` TO `blog_trackback`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_blog_trackback_spamlogs` TO `blog_trackback_spamlogs`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_blog_updatepings` TO `blog_updatepings`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_blog_views` TO `blog_views`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_blog_voters` TO `blog_voters`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_bulk_mail` TO `bulk_mail`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_cache_simple` TO `cache_simple`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_cache_store` TO `cache_store`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_cal_calendars` TO `cal_calendars`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_cal_event_comments` TO `cal_event_comments`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_cal_event_ratings` TO `cal_event_ratings`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_cal_event_rsvp` TO `cal_event_rsvp`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_cal_events` TO `cal_events`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_cal_import_feeds` TO `cal_import_feeds`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_cal_import_map` TO `cal_import_map`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_captcha` TO `captcha`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_ccs_attachments_map` TO `ccs_attachments_map`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_ccs_block_wizard` TO `ccs_block_wizard`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_ccs_blocks` TO `ccs_blocks`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_ccs_containers` TO `ccs_containers`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_ccs_custom_database_1` TO `ccs_custom_database_1`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_ccs_custom_database_1_bak` TO `ccs_custom_database_1_bak`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_ccs_custom_database_1_bak101314` TO `ccs_custom_database_1_bak101314`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_ccs_database_categories` TO `ccs_database_categories`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_ccs_database_comments` TO `ccs_database_comments`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_ccs_database_fields` TO `ccs_database_fields`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_ccs_database_moderators` TO `ccs_database_moderators`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_ccs_database_modqueue` TO `ccs_database_modqueue`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_ccs_database_ratings` TO `ccs_database_ratings`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_ccs_database_revisions` TO `ccs_database_revisions`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_ccs_databases` TO `ccs_databases`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_ccs_folders` TO `ccs_folders`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_ccs_menus` TO `ccs_menus`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_ccs_page_templates` TO `ccs_page_templates`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_ccs_page_wizard` TO `ccs_page_wizard`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_ccs_pages` TO `ccs_pages`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_ccs_revisions` TO `ccs_revisions`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_ccs_slug_memory` TO `ccs_slug_memory`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_ccs_template_blocks` TO `ccs_template_blocks`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_ccs_template_cache` TO `ccs_template_cache`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_cmtp_bugs` TO `cmtp_bugs`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_cmtp_groups` TO `cmtp_groups`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_cmtp_members` TO `cmtp_members`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_cmtp_members_added` TO `cmtp_members_added`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_contato_antispam` TO `contato_antispam`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_contato_customfields` TO `contato_customfields`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_contato_departamentos` TO `contato_departamentos`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_contato_emails` TO `contato_emails`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_content_cache_posts` TO `content_cache_posts`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_content_cache_posts_bak` TO `content_cache_posts_bak`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_content_cache_sigs` TO `content_cache_sigs`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_content_cache_sigs_bak` TO `content_cache_sigs_bak`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_conv_apps` TO `conv_apps`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_conv_link` TO `conv_link`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_conv_link_pms` TO `conv_link_pms`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_conv_link_posts` TO `conv_link_posts`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_conv_link_topics` TO `conv_link_topics`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_core_applications` TO `core_applications`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_core_archive_log` TO `core_archive_log`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_core_archive_restore` TO `core_archive_restore`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_core_archive_rules` TO `core_archive_rules`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_core_editor_autosave` TO `core_editor_autosave`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_core_geolocation_cache` TO `core_geolocation_cache`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_core_hooks` TO `core_hooks`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_core_hooks_files` TO `core_hooks_files`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_core_incoming_email_log` TO `core_incoming_email_log`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_core_incoming_emails` TO `core_incoming_emails`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_core_inline_messages` TO `core_inline_messages`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_core_item_markers` TO `core_item_markers`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_core_item_markers_storage` TO `core_item_markers_storage`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_core_like` TO `core_like`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_core_like_cache` TO `core_like_cache`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_core_rss_imported` TO `core_rss_imported`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_core_share_links` TO `core_share_links`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_core_share_links_log` TO `core_share_links_log`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_core_soft_delete_log` TO `core_soft_delete_log`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_core_sys_bookmarks` TO `core_sys_bookmarks`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_core_sys_conf_settings` TO `core_sys_conf_settings`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_core_sys_cp_sessions` TO `core_sys_cp_sessions`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_core_sys_lang` TO `core_sys_lang`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_core_sys_lang_words` TO `core_sys_lang_words`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_core_sys_login` TO `core_sys_login`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_core_sys_module` TO `core_sys_module`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_core_sys_settings_titles` TO `core_sys_settings_titles`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_core_tags` TO `core_tags`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_core_tags_cache` TO `core_tags_cache`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_core_tags_perms` TO `core_tags_perms`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_core_uagent_groups` TO `core_uagent_groups`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_core_uagents` TO `core_uagents`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_custom_bbcode` TO `custom_bbcode`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_dnames_change` TO `dnames_change`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_dp3_rs_referrals` TO `dp3_rs_referrals`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_emoticons` TO `emoticons`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_error_logs` TO `error_logs`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_export_posts` TO `export_posts`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_faq` TO `faq`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_fcontent` TO `fcontent`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_fcontent_slideshow` TO `fcontent_slideshow`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_forum_perms` TO `forum_perms`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_forums` TO `forums`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_forums_archive_posts` TO `forums_archive_posts`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_forums_recent_posts` TO `forums_recent_posts`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_gallery_albums` TO `gallery_albums`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_gallery_bandwidth` TO `gallery_bandwidth`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_gallery_categories` TO `gallery_categories`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_gallery_comments` TO `gallery_comments`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_gallery_images` TO `gallery_images`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_gallery_images_uploads` TO `gallery_images_uploads`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_gallery_moderators` TO `gallery_moderators`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_gallery_ratings` TO `gallery_ratings`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_gaplus_events` TO `gaplus_events`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_gaplus_vars` TO `gaplus_vars`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_groups` TO `groups`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_ignored_users` TO `ignored_users`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_inline_notifications` TO `inline_notifications`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_login_methods` TO `login_methods`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_mail_error_logs` TO `mail_error_logs`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_mail_queue` TO `mail_queue`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_member_status_actions` TO `member_status_actions`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_member_status_replies` TO `member_status_replies`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_member_status_updates` TO `member_status_updates`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_members` TO `members`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_members_partial` TO `members_partial`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_members_warn_actions` TO `members_warn_actions`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_members_warn_logs` TO `members_warn_logs`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_members_warn_reasons` TO `members_warn_reasons`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_message_posts` TO `message_posts`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_message_topic_user_map` TO `message_topic_user_map`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_message_topics` TO `message_topics`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_mobile_app_style` TO `mobile_app_style`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_mobile_device_map` TO `mobile_device_map`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_mobile_notifications` TO `mobile_notifications`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_mod_queued_items` TO `mod_queued_items`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_moderator_logs` TO `moderator_logs`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_moderators` TO `moderators`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_nexus_ads` TO `nexus_ads`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_nexus_alternate_contacts` TO `nexus_alternate_contacts`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_nexus_coupons` TO `nexus_coupons`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_nexus_customer_fields` TO `nexus_customer_fields`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_nexus_customer_history` TO `nexus_customer_history`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_nexus_customers` TO `nexus_customers`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_nexus_donate_goals` TO `nexus_donate_goals`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_nexus_donate_logs` TO `nexus_donate_logs`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_nexus_eom` TO `nexus_eom`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_nexus_fraud_rules` TO `nexus_fraud_rules`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_nexus_gateways` TO `nexus_gateways`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_nexus_hosting_accounts` TO `nexus_hosting_accounts`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_nexus_hosting_errors` TO `nexus_hosting_errors`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_nexus_hosting_queues` TO `nexus_hosting_queues`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_nexus_hosting_servers` TO `nexus_hosting_servers`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_nexus_invoices` TO `nexus_invoices`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_nexus_licensekeys` TO `nexus_licensekeys`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_nexus_notes` TO `nexus_notes`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_nexus_package_fields` TO `nexus_package_fields`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_nexus_package_groups` TO `nexus_package_groups`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_nexus_package_images` TO `nexus_package_images`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_nexus_packages` TO `nexus_packages`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_nexus_packages_ads` TO `nexus_packages_ads`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_nexus_packages_hosting` TO `nexus_packages_hosting`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_nexus_packages_products` TO `nexus_packages_products`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_nexus_paymethods` TO `nexus_paymethods`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_nexus_payouts` TO `nexus_payouts`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_nexus_product_options` TO `nexus_product_options`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_nexus_purchases` TO `nexus_purchases`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_nexus_referral_banners` TO `nexus_referral_banners`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_nexus_referral_rules` TO `nexus_referral_rules`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_nexus_referrals` TO `nexus_referrals`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_nexus_review_rates` TO `nexus_review_rates`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_nexus_reviews` TO `nexus_reviews`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_nexus_ship_orders` TO `nexus_ship_orders`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_nexus_shipping` TO `nexus_shipping`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_nexus_subscriptions` TO `nexus_subscriptions`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_nexus_support_departments` TO `nexus_support_departments`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_nexus_support_fields` TO `nexus_support_fields`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_nexus_support_ratings` TO `nexus_support_ratings`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_nexus_support_replies` TO `nexus_support_replies`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_nexus_support_requests` TO `nexus_support_requests`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_nexus_support_severities` TO `nexus_support_severities`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_nexus_support_staff` TO `nexus_support_staff`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_nexus_support_statuses` TO `nexus_support_statuses`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_nexus_support_stock_actions` TO `nexus_support_stock_actions`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_nexus_support_tracker` TO `nexus_support_tracker`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_nexus_support_views` TO `nexus_support_views`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_nexus_tax` TO `nexus_tax`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_nexus_transactions` TO `nexus_transactions`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_permission_index` TO `permission_index`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_pfields_content` TO `pfields_content`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_pfields_data` TO `pfields_data`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_pfields_groups` TO `pfields_groups`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_polls` TO `polls`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_posts` TO `posts`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_profile_friends` TO `profile_friends`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_profile_friends_flood` TO `profile_friends_flood`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_profile_portal` TO `profile_portal`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_profile_portal_views` TO `profile_portal_views`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_profile_ratings` TO `profile_ratings`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_question_and_answer` TO `question_and_answer`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_rc_classes` TO `rc_classes`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_rc_comments` TO `rc_comments`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_rc_modpref` TO `rc_modpref`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_rc_reports` TO `rc_reports`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_rc_reports_index` TO `rc_reports_index`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_rc_status` TO `rc_status`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_rc_status_sev` TO `rc_status_sev`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_reputation_cache` TO `reputation_cache`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_reputation_index` TO `reputation_index`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_reputation_levels` TO `reputation_levels`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_reputation_totals` TO `reputation_totals`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_rest_menu_items` TO `rest_menu_items`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_rest_profile_tabs` TO `rest_profile_tabs`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_rest_renewal_keys` TO `rest_renewal_keys`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_rest_tmp_attach` TO `rest_tmp_attach`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_reviews` TO `reviews`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_reviews_bak` TO `reviews_bak`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_reviews_ban_logs` TO `reviews_ban_logs`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_reviews_behavior` TO `reviews_behavior`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_reviews_categories` TO `reviews_categories`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_reviews_comments` TO `reviews_comments`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_reviews_deals` TO `reviews_deals`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_reviews_detailed_ratings` TO `reviews_detailed_ratings`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_reviews_edit_logs` TO `reviews_edit_logs`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_reviews_extra_ratings` TO `reviews_extra_ratings`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_reviews_faq_answers` TO `reviews_faq_answers`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_reviews_faq_questions` TO `reviews_faq_questions`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_reviews_favorites` TO `reviews_favorites`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_reviews_owned` TO `reviews_owned`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_reviews_ratings` TO `reviews_ratings`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_reviews_requests` TO `reviews_requests`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_reviews_searches` TO `reviews_searches`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_reviews_tags` TO `reviews_tags`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_reviews_tracker_author` TO `reviews_tracker_author`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_reviews_tracker_product` TO `reviews_tracker_product`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_reviews_tracker_review` TO `reviews_tracker_review`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_reviews_views` TO `reviews_views`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_reviews_waiting` TO `reviews_waiting`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_reviews_wish_list` TO `reviews_wish_list`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_rss_export` TO `rss_export`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_rss_import` TO `rss_import`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_rss_imported` TO `rss_imported`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_search_keywords` TO `search_keywords`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_search_sessions` TO `search_sessions`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_search_visitors` TO `search_visitors`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_seo_acronyms` TO `seo_acronyms`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_seo_meta` TO `seo_meta`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_sessions` TO `sessions`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_sfs_blocked` TO `sfs_blocked`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_sfs_settings` TO `sfs_settings`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_sfs_tracking` TO `sfs_tracking`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_sfs_whitelist` TO `sfs_whitelist`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_sidebars` TO `sidebars`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_sidebars_blocks` TO `sidebars_blocks`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_sidebars_blocks_sequence` TO `sidebars_blocks_sequence`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_skin_cache` TO `skin_cache`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_skin_collections` TO `skin_collections`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_skin_css` TO `skin_css`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_skin_css_previous` TO `skin_css_previous`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_skin_generator_sessions` TO `skin_generator_sessions`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_skin_merge_changes` TO `skin_merge_changes`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_skin_merge_session` TO `skin_merge_session`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_skin_replacements` TO `skin_replacements`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_skin_templates` TO `skin_templates`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_skin_templates_cache` TO `skin_templates_cache`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_skin_templates_previous` TO `skin_templates_previous`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_skin_url_mapping` TO `skin_url_mapping`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_spam_service_log` TO `spam_service_log`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_spider_logs` TO `spider_logs`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_tags_index` TO `tags_index`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_tapatalk_push_data` TO `tapatalk_push_data`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_tapatalk_users` TO `tapatalk_users`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_task_logs` TO `task_logs`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_task_manager` TO `task_manager`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_template_sandr` TO `template_sandr`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_titles` TO `titles`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_topic_mmod` TO `topic_mmod`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_topic_prefixes` TO `topic_prefixes`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_topic_ratings` TO `topic_ratings`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_topic_views` TO `topic_views`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_topics` TO `topics`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_twitter_connect` TO `twitter_connect`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_upgrade_history` TO `upgrade_history`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_upgrade_sessions` TO `upgrade_sessions`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_validating` TO `validating`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_voters` TO `voters`
------------------------------------------------
Sun, 29 Apr 2018 03:37:12 +0000
RENAME TABLE `x_utf_warn_logs` TO `warn_logs`