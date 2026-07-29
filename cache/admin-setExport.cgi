
--------------------------------------------------------------------------------
> Time: 1423791453 / Fri, 13 Feb 2015 01:37:33 +0000
> URL: /admin/index.php?adsess=65123953941da2af08bd12daeafb73df&app=core&&module=templates&section=importexport&do=exportSet
> Template Export: calendar
<?xml version="1.0" encoding="utf-8"?>
<templates application="calendar" templategroups="a:1:{s:13:&quot;skin_calendar&quot;;s:5:&quot;exact&quot;;}">
  <templategroup group="skin_calendar">
    <template>
      <template_group>skin_calendar</template_group>
      <template_content><![CDATA[{parse js_module="calendar"}
<script type='text/javascript'>
	ipb.vars['month_url'] = "{parse url="app=calendar&module=calendar&section=view&cal_id={$data['calendar']['cal_id']}" base="public"}";
	ipb.vars['week_url'] = "{parse url="app=calendar&module=calendar&section=view&cal_id={$data['calendar']['cal_id']}&do=showweek" base="public"}";
	ipb.vars['day_url'] = "{parse url="app=calendar&module=calendar&section=view&cal_id={$data['calendar']['cal_id']}&do=showday" base="public"}";
	ipb.vars['add_event_url'] = "{parse url="app=calendar&module=calendar&section=post&cal_id={$data['calendar']['cal_id']}&do=newevent" base="public" seotitle="{$data['calendar']['cal_title_seo']}" template="cal_post"}";
	
	ipb.calendar.currentView = "month";
</script>
<div class='right'>
	{$data['_like_strip']}
</div>
<h1 class='ipsType_pagetitle calendar_title left'>{$data['month_title']} {$data['chosen_date']['year']}</h1>
{parse template="calendarJump" group="calendar" params="$data['calendars'], $data['calendar'], $data['chosen_date']"}
<br /><br />
<div class='topic_controls clearfix'>
	<ul class='pagination ipsList_inline left'>
		<li class='back'><a href="{parse url="app=calendar&amp;module=calendar&amp;section=view&amp;cal_id={$data['calendar']['cal_id']}&amp;m={$data['prev_month']['month_id']}&amp;y={$data['prev_month']['year_id']}" base="public" seotitle="{$data['calendar']['cal_title_seo']}" template="cal_month"}" title="{$data['prev_month']['month_name']} {$data['prev_month']['year_id']}">{$this->lang->words['_larr']} {$this->lang->words['month_previous']}</a></li>
		<li class='forward'><a href="{parse url="app=calendar&amp;module=calendar&amp;section=view&amp;cal_id={$data['calendar']['cal_id']}&amp;m={$data['next_month']['month_id']}&amp;y={$data['next_month']['year_id']}" base="public" seotitle="{$data['calendar']['cal_title_seo']}" template="cal_month"}" title="{$data['next_month']['month_name']} {$data['next_month']['year_id']}">{$this->lang->words['month_next']} {$this->lang->words['_rarr']}</a></li>
		<li>
			<a href='#mini_calendar_jump' id='month_jump' class='ipsType_smaller'>{$this->lang->words['jump_to']}</a>
		</li>
	</ul>
	<form action="{parse url="app=calendar&amp;module=calendar" base="public"}" method="post" style='display: none' id='mini_calendar_jump'>
		<fieldset class='ipsPad'>
			<input type='hidden' name='cal_id' value='{$this->request['cal_id']}' />
			<label for='m' class='hide'>{$this->lang->words['fv_months']}:</label>
			<select name="m" class='input_select'>{$data['month_box']}</select>&nbsp;
			<label for='year' class='hide'>{$this->lang->words['fv_years']}:</label>
			<select name="y" class='input_select'>{$data['year_box']}</select>&nbsp;
			<input type='submit' class='input_submit' value='{$this->lang->words['jmp_go']}' />
		</fieldset>
	</form>
	<ul class='topic_buttons'>
		<if test="canstart:|:$this->memberData['member_id'] && $this->registry->permissions->check( 'start', $data['calendar'] )">
			<li><a id='ips_addEventButton' href='{parse url="app=calendar&amp;module=calendar&amp;section=post&amp;cal_id={$data['calendar']['cal_id']}&amp;do=newevent" base="public" seotitle="{$data['calendar']['cal_title_seo']}" template="cal_post"}' title='{$this->lang->words['event_add_single']}'>{$this->lang->words['event_add_single']}</a></li>
		<else />
			<li class='disabled'><span>{$this->lang->words['calendar_no_post']}</span></li>
		</if>
	</ul>
</div>
<div class='maintitle ipsFilterbar ipsForm_center'>
	<ul class='ipsList_inline'>
		<li class='active'><a href='{parse url="app=calendar&amp;module=calendar&amp;section=view&amp;cal_id={$data['calendar']['cal_id']}&amp;m={$data['navigation']['this_month']['m']}&amp;y={$data['navigation']['this_month']['y']}" base="public" seotitle="{$data['calendar']['cal_title_seo']}" template="cal_month"}' title="{$this->lang->words['view_this_month']}" id='view_month'><img src='{$this->settings['img_url']}/icon_month.png' />&nbsp; {$this->lang->words['view_month_view']}</a></li>
		<li>
			<a href="{parse url="app=calendar&amp;module=calendar&amp;section=view&amp;cal_id={$data['calendar']['cal_id']}&amp;do=showweek&amp;week={$data['navigation']['this_week']}" seotitle="{$data['calendar']['cal_title_seo']}" template="cal_week" base="public"}" title="{$this->lang->words['view_this_week']}" id='view_week'><img src='{$this->settings['img_url']}/icon_week.png' />&nbsp; {$this->lang->words['view_week_view']}</a>
		</li>
		<li><a href='{parse url="app=calendar&amp;module=calendar&amp;section=view&amp;cal_id={$data['calendar']['cal_id']}&amp;do=showday&amp;y={$data['navigation']['this_month']['y']}&amp;m={$data['navigation']['this_month']['m']}&amp;d=01" base="public" seotitle="{$data['calendar']['cal_title_seo']}" template="cal_day"}' title="{$this->lang->words['view_this_day']}" id='view_day'><img src='{$this->settings['img_url']}/icon_day.png' />&nbsp; {$this->lang->words['view_day_view']}</a></li>
	</ul>
</div>
<div class='ipsBox'>
	<div class='ipsBox_container'>
		<table id='calendar_table' class='ipsCalendar ipb_table vcalendar' summary="{$this->lang->words['calendar_for']} {$data['month_title']} {$data['chosen_date']['year']}">
			<tr class='header'>
				<foreach loop="days:$data['day_words'] as $day">
					<th scope='col'>{$day}</th>
				</foreach>
				{$data['events']}
			</tr>
		</table>
	</div>
</div>
<br />
<ul class='ipsList_inline ipsType_small'>
	<li>
		<a class='calendar_icon' href='{parse url="app=calendar&amp;module=feed&amp;section=output&amp;cal_id={$data['calendar']['cal_id']}" base="public"}' title="{$this->lang->words['download_this_calendar']}"><img src='{$this->settings['img_url']}/download.png' alt="{$this->lang->words['download_this_calendar']}" title="{$this->lang->words['download_this_calendar']}" /> {$this->lang->words['download_this_calendar']}</a>
	</li>
	<li>
		<a class='calendar_icon' href='{parse expression="str_replace( array( 'https://', 'http://' ), 'webcal://', $this->settings['base_url'] )"}app=calendar&amp;module=feed&amp;section=output&amp;cal_id={$data['calendar']['cal_id']}' title="{$this->lang->words['subscribe_this_calendar']}"><img src='{$this->settings['img_url']}/transmit.png' alt="{$this->lang->words['subscribe_this_calendar']}" title="{$this->lang->words['subscribe_this_calendar']}" /> {$this->lang->words['subscribe_this_calendar']}</a>
	</li>
</ul>
<div id='mini_calendars' class='two_wide clearfix'>
	<div class='left' style='width:45%;'>
		{$data['minical_prev']}
	</div>
	<div class='right' style='width:45%;margin-right:5px;'>
		{$data['minical_next']}
	</div>
</div>
<br />]]></template_content>
      <template_name>calendarMainContent</template_name>
      <template_data>$data</template_data>
      <template_removable>1</template_removable>
      <template_user_added>0</template_user_added>
      <template_user_edited>1</template_user_edited>
      <template_master_key/>
    </template>
  </templategroup>
</templates>

--------------------------------------------------------------------------------
> Time: 1423791453 / Fri, 13 Feb 2015 01:37:33 +0000
> URL: /admin/index.php?adsess=65123953941da2af08bd12daeafb73df&app=core&&module=templates&section=importexport&do=exportSet
> CSS Export: core
<?xml version="1.0" encoding="utf-8"?>
<css>
  <cssfile>
    <css_set_id>6</css_set_id>
    <css_updated>1415896606</css_updated>
    <css_group>calendar_select</css_group>
    <css_content>.calendar_date_select {
  color:white;
  border:#777 1px solid;
  display:block;
  width:195px;
  z-index: 1000;
}
/* this is a fun ie6 hack to get drop downs to stay behind the popup window.  This should always be just underneath .calendar_date_select */
iframe.ie6_blocker {
  position: absolute;
  z-index: 999;
}

.calendar_date_select thead th {
  font-weight:bold;
  background-color: #aaa;
  border-top:1px solid #777;
  border-bottom:1px solid #777;
  color: white !important;
}

.calendar_date_select .cds_buttons {
  text-align:center;
  padding:5px 0px;
  background-color: #555;
}

.calendar_date_select .cds_footer {
  background-color: black;
  padding:3px;
  font-size:12px;
  text-align:center;
}

.calendar_date_select table {
  margin: 0px;
  padding: 0px;
}


.calendar_date_select .cds_header {
  background-color: #ccc;
  border-bottom: 2px solid #aaa;
  text-align:center;
}

.calendar_date_select .cds_header span {
  font-size:15px;
  color: black;
  font-weight: bold;
}

.calendar_date_select select { font-size:11px;}

.calendar_date_select .cds_header a:hover {
  color: white;
}
.calendar_date_select .cds_header a {
  width:22px;
  height:20px;
  text-decoration: none;
  font-size:14px;
  color:black !important;
}

.calendar_date_select .cds_header a.prev {
  float:left;
}
.calendar_date_select .cds_header a.next {
  float:right;
}

.calendar_date_select .cds_header a.close {
  float:right;
  display:none;
}

.calendar_date_select .cds_header select.month {
  width:90px;
}

.calendar_date_select .cds_header select.year {
  width:61px;
}
.calendar_date_select .cds_buttons a {
  color: white;
  font-size: 9px;
}

.calendar_date_select td {
  font-size:12px;
  width: 24px;
  height: 21px;
  text-align:center;
  vertical-align: middle;
  background-color: #fff;
}
.calendar_date_select td.weekend {
  background-color: #eee;
  border-left:1px solid #ddd;
  border-right:1px solid #ddd;
}

.calendar_date_select td div {
  color: #000;
}
.calendar_date_select td div.other {
  color: #ccc;
}
.calendar_date_select td.selected div {
  color:white;
}

.calendar_date_select tbody td {
  border-bottom: 1px solid #ddd;
}
.calendar_date_select td.selected {
  background-color:#777;
}

.calendar_date_select td:hover {
  background-color:#ccc;
}

.calendar_date_select td.today {
  border: 1px dashed #999;
}

.calendar_date_select td.disabled div {
  color: #e6e6e6;
}

.fieldWithErrors .calendar_date_select {
  border: 2px solid red;
}




</css_content>
    <css_position>1</css_position>
    <css_app>core</css_app>
    <css_app_hide>0</css_app_hide>
    <css_attributes><![CDATA[title="Main" media="screen"]]></css_attributes>
    <css_modules/>
    <css_removed>0</css_removed>
    <css_master_key/>
  </cssfile>
  <cssfile>
    <css_set_id>6</css_set_id>
    <css_updated>1386177712</css_updated>
    <css_group>ipb_ckeditor</css_group>
    <css_content><![CDATA[/***************************************************************/
/* IP.Board 3.2 Editor CSS                                       */
/* ___________________________________________________________ */
/* By Matt Mecham					                            */
/***************************************************************/
/* Styles for the editor (colors in main css) */
/***************************************************************/

.bbcode_hilight {
	background-color: yellow;
}

.as_content {
	background: #fff;
	font-size: 1.0em;
	border: 1px solid black;
	padding: 6px;
	margin: 8px;
	overflow: auto;
	max-height: 400px;
}
.as_buttons {
	text-align: right;
	padding: 4px 0px;
}
.as_message {
	display: inline-block;
}

.ipsEditor_textarea {
	width: 99%;
	height: 200px;
	font-size: 14px;
}
.cke_browser_webkit {outline:none !important;}
	
/* Main tool bar BG */
.cke_top {
	background: #e4f2f0;
}

/* Normal STD */
.cke_skin_ips textarea.cke_source {
	/* removed as causes pasted text to appear on one line: white-space: pre-line !important;*/
}

/* Minimized RTE */
.cke_skin_ips .cke_wrapper.minimized { 
	opacity: 0.6 !important;
	background: none !important;
	border: none !important;
}

/* Minimized STD */
.cke_skin_ips .cke_wrapper.minimized.std { 
	border: 2px solid #d5e5e3 !important;
}

/* Main Editor wrapper */
.cke_skin_ips { margin-bottom: 0px !important; }

.cke_skin_ips .cke_wrapper
{
	padding: 0px 5px 0px 3px !important;
	border: 2px solid #d5e5e3 !important;
	background-color: #e4f2f0 !important;
	background-image: none !important;
}

/* OFF state for editor buttons */
.cke_skin_ips .cke_toolgroup
{
	background-color: transparent !important;
}

/* HOVER 'off' button */
.cke_skin_ips .cke_button a:hover,
.cke_skin_ips .cke_button a:focus,
.cke_skin_ips .cke_button a:active	/* IE */
{
	background-color: #d5e5e3 !important;
}

/* HOVER 'on' button */
.cke_skin_ips .cke_button a:hover.cke_on,
.cke_skin_ips .cke_button a:focus.cke_on,
.cke_skin_ips .cke_button a:active.cke_on	/* IE */
{
	background-color: #86caff !important;
}

/* Button group */
.cke_skin_ips .cke_toolgroup
{
	margin-right: 0px !important;
}

/* Button separator */
.cke_skin_ips .cke_separator
{
	border-left:solid 1px #d5e5e3;
	display:inline-block !important;
	float:left;
	height:30px;
	margin:0px 2px;
}

/* DIALOG: Modal blind */
.cke_dialog_background_cover
{
	background-color: #3e3e3e !important;
}

/* DIALOG: Title - based on .maintitle */
.cke_skin_ips .cke_dialog_title
{
	background: #79bfb4;
	color: #fff !important;
	padding: 10px 10px 11px !important;
	font-size: 16px !important;
	font-weight: 300 !important;
	text-shadow: 0 1px 2px rgba(0,0,0,0.3);
	font-weight: normal;
}

/* Dialog: Body */
.cke_skin_ips .cke_dialog_body {
	z-index: 20000 !important;
}

/* Dialog tab bg (will usually match dialog title) */
.cke_skin_ips .cke_dialog_tabs {
	background: #2C5687 !important;
}

/* Dialog Title close button */
.cke_skin_ips .cke_dialog_close_button
{
	background: transparent url({style_images_url}/close_popup.png) no-repeat top left !important;
	width: 13px !important;
	height: 13px !important;
	top: 11px !important;
	right: 10px !important;
}

/* Dialog OK / Cancel buttons - based on ipsButton_secondary*/
.cke_skin_ips span.cke_dialog_ui_button
{
	height: 22px !important;
	line-height: 22px !important;
	font-size: 12px !important;
	color: #7c7c7c !important;
	padding: 0 10px !important;
	background: #f6f6f6 !important;
	background: -moz-linear-gradient(top, #f6f6f6 0%, #e5e5e5 100%) !important; /* firefox */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#f6f6f6), color-stop(100%,#e5e5e5)) !important; /* webkit */
	border: 1px solid #dbdbdb !important;
	-moz-box-shadow: 0px 1px 0px rgba(255,255,255,1) inset, 0px 1px 0px rgba(0,0,0,0.3) !important;
	-webkit-box-shadow: 0px 1px 0px rgba(255,255,255,1) inset, 0px 1px 0px rgba(0,0,0,0.3) !important;
	box-shadow: 0px 1px 0px rgba(255,255,255,1) inset, 0px 1px 0px rgba(0,0,0,0.3) !important;
	-moz-border-radius: 3px !important;
	-webkit-border-radius: 3px !important;
	border-radius: 3px !important;
	color: #616161 !important;
	display: inline-block !important;
	white-space: nowrap !important;
}

/* Turn off resizer */
.cke_skin_ips .cke_dialog_footer .cke_resizer { display: none; }

/* Emo slide out tray */
.ipsSmileyTray
{
	position: relative;
	
	text-align: center;
	overflow: auto;
	margin: 0px auto 0px auto;
	padding: 4px 24px 4px 24px;
	min-width: 600px;
	width: 75%;
	height: 32px;
	border: 1px solid #d5e5e3;
	-moz-border-radius: 3px;
	-webkit-border-radius: 3px;
	border-radius: 3px;
	
	-moz-border-radius-topleft: 0px;
	-webkit-border-radius-topleft: 0px;
	border-top-left-radius: 0px;
	
	-moz-border-radius-topright: 0px;
	-webkit-border-radius-topright: 0px;
	border-top-right-radius: 0px;
	
	border-top: 0px;
	-moz-box-shadow: inset 0 1px 0 0 #edf7f6, 0px 2px 3px rgba(0,0,0,0.2);
	-webkit-box-shadow: inset 0 1px 0 0 #edf7f6, 0px 2px 3px rgba(0,0,0,0.2);
	box-shadow: inset 0 1px 0 0 #edf7f6, 0px 2px 3px rgba(0,0,0,0.2);
	
	background: #e4f2f0;
	overflow-y: hidden;
}
	.ipsSmileyTray img.bbc_emoticon {
		opacity: 0.8;
		cursor: pointer;
		margin: 6px 3px 0px 3px;
		max-width: 30px;
		max-height: 30px;
	 }
	 	.ipsSmileyTray img.bbc_emoticon:hover {
			opacity: 1.0;
	 	}
	
	.ipsSmileyTray .ipsSmileyTray_next {
		background: transparent url({style_images_url}/editor/next.png) no-repeat;
		background-position: 0px 10px;
		display: inline-block;
		/*float: right;
		position: relative;
		right: -20px;*/
		position: absolute;
		right: 5px;
		top: 4px;
		width: 13px;
		height: 30px;
		cursor: pointer;
	}
	
	.ipsSmileyTray .ipsSmileyTray_prev {
		background: transparent url({style_images_url}/editor/prev.png) no-repeat;
		background-position: 0px 10px;
		display: inline-block;
		/*position: relative;
		left: -20px;
		float: left;*/
		position: absolute;
		left: 5px;
		top: 4px;
		width: 13px;
		height: 30px;
		cursor: pointer;
	}
	
	.ipsSmileyTray_all {
		display: block;
		width: auto;
		margin: 3px auto 0px auto;
		text-align: center;
		cursor: pointer;
		font-size: 10px !important;
	}

/* Dialogs */
.cke_dialog.cke_single_page td.cke_dialog_contents {
	height: auto !important;
}

.cke_dialog .cke_dialog_ui_textarea { height: 130% !important }
	
/* ACP Specific */
table.cke_editor td { padding: 0px !important; }]]></css_content>
    <css_position>1</css_position>
    <css_app>core</css_app>
    <css_app_hide>1</css_app_hide>
    <css_attributes><![CDATA[title="Main" media="screen,print"]]></css_attributes>
    <css_modules/>
    <css_removed>0</css_removed>
    <css_master_key/>
  </cssfile>
  <cssfile>
    <css_set_id>6</css_set_id>
    <css_updated>1407947322</css_updated>
    <css_group>ipb_reviews</css_group>
    <css_content><![CDATA[
.ipsBox_container {}

table.revprod { }

.ipsBox_container .product__left_column {  width:240px; border:solid 1px #d2d2d2; height:210px;  /*position: relative;*/ overflow:hidden;}
.ipsBox_container .product__left_column #revprodimg { /*position: absolute; top:50%; height:10em; margin-top:-5em*/} 
div.review_content p {font:normal 14px arial; color:#333;}
#rev-top img.ipsUserPhoto {margin:0 10px 0 0;}

div.review_content {min-height:400px;} 

.rev-pro, .rev-con {font:normal 18px arial; padding-top:10px;}

div.product_reviews ul li img.ipsUserPhoto {margin-right:10px;}
div.product_reviews h3 a {font:normal 16px arial;}
div.product_reviews p {font:normal 14px arial; color:#333;}

div.product.clearfix h1.ipsType_pagetitle, #revprodcontent h1.ipsType_pagetitle {margin:0 0 15px 0;}

ul.topic_buttons li a.revbut {font:normal 16px arial; padding:5px 0 0 0; float:left;}

ul#revbut { float:left; margin:25px 0 10px -10px; } 

#revopts {margin:0 0 10px 0; /*position:relative; top:-20px;*/}

.alreadyrev { margin:20px 0 0 0; } 

#revprodcontent {padding-right:310px;  min-height:1000px;}
 
#revprodside {position:absolute; width:300px; margin:0 0 20px 0; right:0;} 

#revsearchform { position:relative; top:-5px; width:300px; margin:0 0 15px 0;}   

#revsearchbox {width:200px; height:25px; font:normal 16px arial; color:#666; padding:0 0 0 5px;  border:solid 1px #d2d2d2; background:#f9f8c7;}  


#rev-vendor-info {/*padding-left:255px;*/} 
 

/*
#revgenrerating {border:solid 1px #999; float:right;} 
#revextrarating {border:solid 1px #999; float:right;} 
*/

#revavgrating { margin:10px 0 0 0;  }     
  
#revavgrating ul li.revdetrate span, #revavgrating ul li.revdetrate {font:normal 12px arial!important; color:#666!important; } 
#revavgrating h3 {font:normal 12px arial!important; color:#B76B46!important;} 

#revavgratingprod {border:solid 1px #d2d2d2;  padding:10px; width:233px; float:right;  margin:5px; }   
#revavgratingprod span {font:normal 12px arial!important; color:#666!important; } 
#revavgratingprod h3 {font: bold 14px arial; color:#B76B46; margin:0 0 5px 0;}  
#revavgratingprod h4 {font: normal 12px arial; color:#999;margin:5px 0 0 0; }  

#distributedratings {border:solid 1px #d2d2d2;  padding:10px; width:233px; margin:5px; font: normal 12px arial; color: #999; }  
#distributedratings span {font:normal 12px arial!important; color:#666!important; } 
#distributedratings h3 {font: bold 14px arial; color:#B76B46; margin:0 0 5px 0;} 
#distributedratings .graph_container {width: 100px; height: 10px; margin-top: 2px; background-color: #eee;}
#distributedratings .graph {background-color: #999; height: 10px;}
#distributedratings .zero {opacity: 0.3;}
 
#rev-procon {padding:0 0 10px 0; /*width: 400px;*/ word-break: break-word;} 

#revprodad {float:right;  width:300px; height:250px;}

#mod-options {position:relative; top:0px;} 

div.review_body {padding-left:235px;}


.review_category {font:normal 20px arial;}

.revprodicons {padding:10px 0;} 


/*display none*/
div.ipsSteps.clearfix, img.galattach.emptyBox {display: none;} 

/*forms*/
 
#postingform .ipsFieldrev .ipsFieldrev_title { 	font-weight: bold;	font-size: 15px;}
#postingform .ipsForm_required {	color: #ab1f39;	font-weight: bold;}

/*
.ipsForm_horizontal .ipsFieldrev_title { 
	float: left;
	width: 185px;
	padding-right: 15px;
	text-align: right;
	line-height: 1.8;
}
*/ 

/* EME: Updated styling */
#postingform .ipsForm_required {font: normal 12px arial; color: red; font-weight: normal;}
#postingform div.ipsField_content input {width: 80%; height:30px; font:normal 16px arial; color:#333; border:solid 1px #999;} 

/* EME: No longer in use. IPS default styles handle almost all of this
#postingform .ipsForm_horizontal li.ipsFieldrev label.ipsFieldrev_title {padding:10px 0; margin:10px 0;  clear:both; text-align:left; }  


#postingform .ipsForm_required {font: 12px; color: red;}
#postingform .ipsForm_horizontal .ipsFieldrev { margin:0 0 15px 0; padding:0; }
#postingform .ipsForm_horizontal .ipsFieldrev_content, .ipsForm_horizontal .ipsFieldrev_submit { margin-left: 20px; }
#postingform .ipsForm_horizontal .ipsFieldrev_checkbox { margin: 0 0 5px 20px; }
#postingform .ipsForm_horizontal .ipsFieldrev_select .ipsFieldrev_title { line-height: 1.6; }


#postingform div.ipsFieldrev_content input {width:600px; height:30px; font:normal 16px arial; color:#333; margin:5px 0 0 -20px; border:solid 1px #999;} 

div.ipsFieldrev_content textarea, div.ipsFieldrev_content select {width:400px;  font:normal 16px arial; color:#333; margin:10px 0 0 -20px; } 

#postingform .ipsForm_vertical .ipsFieldrev { margin-bottom: 10px; }
#postingform .ipsForm_vertical .ipsFieldrev_content { margin-top: 3px; }

#postingform .ipsForm .ipsFieldrev_checkbox .ipsFieldrev_content { margin-left: 20px;  float:left;}

#postingform .ipsForm .ipsFieldrev_checkbox input { float: left; margin-top: 3px;   float:left;}  

#postingform .ipsFieldrev_primary input { font-size: 18px; }

#postingform .ipsForm_horizontal .ipsFieldrev_content textarea {width: 400px; height:200px;}*/ 
 
#postingform .ipsForm_submit {
	background: #e4e4e4;
	background: -moz-linear-gradient(top, #e4e4e4 0%, #cccccc 100%);
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#e4e4e4), color-stop(100%,#cccccc));
	padding: 5px 10px;
	text-align: right;
	border-top: 1px solid #cccccc;
	margin-top: 25px;
}

/*
  .input_submit {
	text-decoration: none;
	border-width: 1px;
	border-style: solid;
	padding: 8px 10px;
	cursor: pointer;

}*/

#postingform input .input_submit { padding:8px 15px;	float:left;} 

#postingform .ipsForm_right { text-align: right; }
#postingform .ipsForm_left { text-align: left; }
#postingform .ipsForm_center { text-align: center; } 

#postingform .review-error {color:red; } 

/*big stars on review form start*/
.form { margin:0; }
.form li {  list-style:none; }
.form li input {margin:0; height:27px; width:27px;}
.hide {  display:none;}
.rating input[type="radio"] {
    position:absolute;
    filter:alpha(opacity=0);
    -moz-opacity:0;
    -khtml-opacity:0;
    opacity:0;
    cursor:pointer;
    width:28px;
 height:27px;
}
.rating span {
    width:35px;
    height:27px;
    line-height:27px;
    padding:1px 30px 10px 0; /* 1px FireFox fix */
    background:url(/img/stars-big.png) no-repeat -33px 0;
}  
.rating input[type="radio"]:checked + span { background-position:-33px 0;}
.rating input[type="radio"]:checked + span ~ span { background-position:0 0; }
/*big stars on review form end*/



.review_cat_level_1 {
    font-size: 18px;
    margin-left: 15px;
}

.review_cat_level_2 {
    font-size: 15px;
    margin-left: 30px;
}

.product_reviews .pagination li {
    border-bottom: none;
}



/*-- Review Form Ratings --*/
/* Implementation from http://jsfiddle.net/LTQrZ/20/ */
.star-rating {
    margin: 0 auto;
    display:inline-block;
}
/* radio button stars */

/* you can easily stuff the generation of these repetitive chunks of CSS into a server-side language like ASP */
.star-rating-00:checked ~ .rating,
label.star-rating-00l:hover ~ .rating
{
    width: 0px; /* no stars */
} 

.star-rating-05:checked ~ .rating,
label.star-rating-05l:hover ~ .rating
{
    width: 16px; /* half a star */
} 

.star-rating-10:checked ~ .rating,
label.star-rating-10l:hover ~ .rating
{
    width: 32px; /* a star */
} 

.star-rating-15:checked ~ .rating,
label.star-rating-15l:hover ~ .rating
{
    width: 48px; /* 1.5 stars */
}

.star-rating-20:checked ~ .rating,
label.star-rating-20l:hover ~ .rating
{
    width: 64px; /* 2 stars */
}
.star-rating-25:checked ~ .rating,
label.star-rating-25l:hover ~ .rating
{
    width: 80px;
}
.star-rating-30:checked ~ .rating,
label.star-rating-30l:hover ~ .rating
{
    width: 96px;
}
.star-rating-35:checked ~ .rating,
label.star-rating-35l:hover ~ .rating
{
    width: 112px;
}
.star-rating-40:checked ~ .rating,
label.star-rating-40l:hover ~ .rating
{
    width: 128px;
}
.star-rating-45:checked ~ .rating,
label.star-rating-45l:hover ~ .rating
{
    width: 144px;
}
.star-rating-50:checked ~ .rating,
label.star-rating-50l:hover ~ .rating
{
    width: 160px; /* 5 stars */
}

.star-rating label.star {
    width: 16px; /* half star */
    left: -16px; /* half star */
    padding: 0;
    height: 40px; /* whole star + 2x padding (4px each for top and bottom) */ 
    position: relative;
    z-index: 3;
    float: left;
}

.star-rating label.star.last {
    width: 32px;
}

/* hide inputs (RBs and their labels) */
.star-rating input[type=radio],
.star-rating label.rb
{
    display: none;
}

/* using icons found at http://www.easyicon.cn/language.en/icondetail/523835/ */
.star-rating .rating {
    background: url({style_images_url}/star-full.gif) repeat-x top left;
    position: relative;
    z-index: 2;
    top: 4px; /* 1x padding */
    height: 32px; /* whole star */
    width:0px;
    margin: 0;
}

.rating-bg {
    background: url({style_images_url}/star-empty.gif) repeat-x top left;
    position: relative;
    z-index: 1;
    top: -28px; /* 1 whole star - 1x padding */
    height: 32px; /* whole star */
    width: 160px;
}

/* IE8 fallback to radio buttons */
.ie8 .star-rating input,
.ie8 .star-rating label.rb
 {
    display: inline-block;
}

.ie8 .rating,
.ie8 .rating-bg,
.ie8 .star-rating label.star {
    display: none;
}
/*--/ Review Form Ratings -- live css*/



.reviews {
overflow: auto;
clear: both;
}
.reviews li {
float: left;
width: 445px;
margin: 0 10px 10px 10px;
}
.reviews li.alpha {
margin-left: 0;
clear: left;
}
.reviews li.omega {
margin-right: 0;
}
.reviews li img {
float: left;
margin-right: 1em;
}
.reviews h3 {
margin-bottom: .25em;
font-weight: normal;
font-size: 1.4em;
line-height: 1.2em;
}
.reviews h4 {
font-weight: bold;
font-style: italic;
font-size: 1.2em;
line-height: 1.2;
}
.reviews p {
font-size: 1.1em;
line-height: 1.3;
margin-bottom: .25em;
}
.reviews__meta {
margin-bottom: .5em;
}

.categories {
overflow: auto;
clear: both;
}
.categories .category {
float: left;
width: 445px;
margin: 0 10px 10px 10px;
}
.categories .category.alpha {
margin-left: 0;
clear: left;
}
.categories .category.omega {
margin-right: 0;
}

.categories h1, .review_products h1, .review_category h1 {  
margin-bottom: .5em;
font: normal 26px/1.3 Helvetica, Arial, sans-serif;
color: #B76B46;
} 

.categories h2, .review_products h2 {  
margin-bottom: .5em;
font-weight: normal;
font-size: 1.4em;
line-height: 1.2em;
}
.categories .category__li {
font-size: 1.1em;
line-height: 1.2;
}
.categories .category__li span {
margin-right:10px;
}

/*
.review_category {
float: left;
width: 190px;
margin-right: 20px;
}
.review_category__children {
background: #e3eeff;
padding: 15px;
margin-bottom: 15px;
}
.review_products {
margin-left: 210px;
}
*/

.review_products__product {
overflow: auto;
margin-bottom: 1em;
border-bottom: 1px solid #e6e5e3;
padding: 10px 0;
}

.review_products__product h4 {font:normal 16px arial;}
.review_products__product p {margin:8px 0; font:normal 14px arial;}

.review_products img {
float: left;
margin-right: 1em;
}



.product {
margin-bottom: 1.5em;
}
.product__left_column {
float: left;
margin-right: 1em;
}
.product__right_column {
margin-left: 254px;
position: relative;
}
/*-- Product Page --*/
.product_reviews h2 {
font-size: 1.5em;
border-bottom: 1px solid black;
line-height: 1.2;
padding-bottom: 4px;
margin-bottom: 1em;
}
.product_reviews li {
padding-bottom: 1.5em;
margin-bottom: 1.5em;
border-bottom: 1px solid lightgray;
}
.product_reviews h3 {
margin-bottom: .5em;
}
.product_reviews li .image {
float: left;
margin-right: 1em;
}
.product_reviews p {
margin: .5em 0;
}
.product_reviews__pros-cons {

}
/*--/ Product Page --*/

/*-- Review Page --*/
.review_summary {float: left; margin-right: 1em; border: 1px solid #d2d2d2; padding: 1em; width:190px; }

.review_content {
margin-bottom: 2em;
}
/*--/ Review Page --*/


li.review_cat_level_0 a {font:normal 18px arial;}
li.review_cat_level_1 a {font:normal 14px arial; margin:0 0 0 10px; padding:-5px 0 -5px 0;}

li.review_cat_level_1 {margin:-5px 0 0 0; padding:0;}

.rev-count {font:italic 13px arial; position:relative; top:10px;}

#cat-rating {margin:20px 0 0 0; }
#cat-rating .score {font-weight:bold;}

.review_summary h2 { margin-bottom:5px;} 
.review_summary h2 a {font:bold 14px arial; color:#B76B46; }  
.review_summary p {color:#888;} 


/*reviews start*/

.ipsBox_container {}

table.revprod { background:pink;}

.ipsBox_container .product__left_column {  width:240px; border:solid 1px #d2d2d2; height:210px;  /*position: relative;*/ overflow:hidden;}
.ipsBox_container .product__left_column #revprodimg { /*position: absolute; top:50%; height:10em; margin-top:-5em*/} 
div.review_content p {font:normal 14px arial; color:#333;}
#rev-top img.ipsUserPhoto {margin:0 10px 0 0;}

div.review_content {min-height:400px;} 

.rev-pro, .rev-con {font:normal 18px arial; padding-top:10px;}

div.product_reviews ul li img.ipsUserPhoto {margin-right:10px;}
div.product_reviews h3 a {font:normal 16px arial;}
div.product_reviews p {font:normal 14px arial; color:#333;}

div.product.clearfix h1.ipsType_pagetitle, #revprodcontent h1.ipsType_pagetitle {margin:0 0 15px 0;}

ul.topic_buttons li a.revbut {font:normal 16px arial; padding:5px 0 0 0; float:left;}

ul#revbut { float:left; margin:25px 0 10px -10px; } 

#revopts {margin:0 0 10px 0; /*position:relative; top:-20px;*/}

.alreadyrev { margin:20px 0 0 0; } 

#revprodcontent {padding-right:310px;  min-height:1000px;}
 
#revprodside {position:absolute; width:300px; margin:0 0 20px 0; right:0;} 

#revsearchform { position:relative; top:-5px; width:300px; margin:0 0 15px 0;}   

#revsearchbox {width:200px; height:25px; font:normal 16px arial; color:#666; padding:0 0 0 5px;  border:solid 1px #d2d2d2; background:#f9f8c7;}  


#rev-vendor-info {/*padding-left:255px;*/} 
 

/*
#revgenrerating {border:solid 1px #999; float:right;} 
#revextrarating {border:solid 1px #999; float:right;} 
*/

 
 
#rev-procon {padding:15px 0 10px 0; width: 400px; word-break: break-word; } 

#revprodad {float:right;  width:300px; height:250px;}



div.review_body {padding-left:235px;}


.review_category {font:normal 20px arial;}

.revprodicons {padding:10px 0;} 


/*display none*/
div.ipsSteps.clearfix, img.galattach.emptyBox {display: none;} 

/*forms*/
 
#postingform .ipsFieldrev .ipsFieldrev_title { 	font-weight: bold;	font-size: 15px;}
#postingform .ipsForm_required {	color: #ab1f39;	font-weight: bold;}

/*
.ipsForm_horizontal .ipsFieldrev_title { 
	float: left;
	width: 185px;
	padding-right: 15px;
	text-align: right;
	line-height: 1.8;
}
*/ 

#postingform .ipsForm_horizontal li.ipsFieldrev label.ipsFieldrev_title {padding:10px 0; margin:10px 0;  clear:both; text-align:left; }  


#postingform .ipsForm_horizontal .ipsFieldrev { margin:0 0 15px 0; padding:0; }
#postingform .ipsForm_horizontal .ipsFieldrev_content, .ipsForm_horizontal .ipsFieldrev_submit { margin-left: 20px; }
#postingform .ipsForm_horizontal .ipsFieldrev_checkbox { margin: 0 0 5px 20px; }
#postingform .ipsForm_horizontal .ipsFieldrev_select .ipsFieldrev_title { line-height: 1.6; }


#postingform div.ipsFieldrev_content input {width:600px; height:30px; font:normal 16px arial; color:#333; margin:5px 0 0 -20px; border:solid 1px #999;} 

div.ipsFieldrev_content textarea, div.ipsFieldrev_content select {width:400px;  font:normal 16px arial; color:#333; margin:10px 0 0 -20px; } 

#postingform .ipsForm_vertical .ipsFieldrev { margin-bottom: 10px; }
#postingform .ipsForm_vertical .ipsFieldrev_content { margin-top: 3px; }

#postingform .ipsForm .ipsFieldrev_checkbox .ipsFieldrev_content { margin-left: 20px;  float:left;}

#postingform .ipsForm .ipsFieldrev_checkbox input { float: left; margin-top: 3px;   float:left;}  

#postingform .ipsFieldrev_primary input { font-size: 18px; }

#postingform .ipsForm_horizontal .ipsFieldrev_content textarea {width: 400px; height:200px;} 
 
#postingform .ipsForm_submit {
	background: #e4e4e4;
	background: -moz-linear-gradient(top, #e4e4e4 0%, #cccccc 100%);
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#e4e4e4), color-stop(100%,#cccccc));
	padding: 5px 10px;
	text-align: right;
	border-top: 1px solid #cccccc;
	margin-top: 25px;
}

/*
  .input_submit {
	text-decoration: none;
	border-width: 1px;
	border-style: solid;
	padding: 8px 10px;
	cursor: pointer;

}*/

#postingform input .input_submit { padding:8px 15px;	float:left;} 

#postingform .ipsForm_right { text-align: right; }
#postingform .ipsForm_left { text-align: left; }
#postingform .ipsForm_center { text-align: center; } 

#postingform .review-error {color:red; } 

/*big stars on review form start*/
.form { margin:0; }
.form li {  list-style:none; }
.form li input {margin:0; height:27px; width:27px;}
.hide {  display:none;}
.rating input[type="radio"] {
    position:absolute;
    filter:alpha(opacity=0);
    -moz-opacity:0;
    -khtml-opacity:0;
    opacity:0;
    cursor:pointer;
    width:28px;
 height:27px;
}
.rating span {
    width:35px;
    height:27px;
    line-height:27px;
    padding:1px 30px 10px 0; /* 1px FireFox fix */
    background:url(/img/stars-big.png) no-repeat -33px 0;
}  
.rating input[type="radio"]:checked + span { background-position:-33px 0;}
.rating input[type="radio"]:checked + span ~ span { background-position:0 0; }
/*big stars on review form end*/


div#reviews .ipsPad_half.left {width: 45%;}
div#reviews .ipsPad_half.right {width: 52%;}

.prodowner {font:normal 11px arial; color:#999; margin-top:5px;}
]]></css_content>
    <css_position>0</css_position>
    <css_app>core</css_app>
    <css_app_hide>0</css_app_hide>
    <css_attributes/>
    <css_modules/>
    <css_removed>0</css_removed>
    <css_master_key/>
  </cssfile>
  <cssfile>
    <css_set_id>6</css_set_id>
    <css_updated>1386177712</css_updated>
    <css_group>ipb_search</css_group>
    <css_content><![CDATA[/************************************************************************/
/* IP.Board 3 CSS - By Rikki Tissier - (c)2008 Invision Power Services	*/
/************************************************************************/
/* ipb_search.css - Search results styles								*/
/************************************************************************/

.ipsFilterbar #search_sort .submenu_indicator
{
	width: 9px; height: 5px;
	background: #244156 url({style_images_url}/header_dropdown.png ) no-repeat;
	display: inline-block;
	/* Prevent padding in sort buttons */
}

#main_search_form .ipsBox_container { margin-bottom: 10px; }
#main_search_form .ipsField { margin-bottom: 20px; }

.toggle_notify_on { display: none; }
.show_notify .toggle_notify_on { display: block; }
	.show_notify input.toggle_notify_on { display: inline; }
	.show_notify a.ipbmenu { display: none; }
.show_notify .toggle_notify_off { display: none; }	

.notify_info span {
	padding: 1px 8px;
	background: #ededed;
	-moz-border-radius: 2px;
	-webkit-border-radius: 2px;
	border-radius: 2px;
	font-size: 10px;
	font-weight: bold;
	display: inline-block;
}
	
	.notify_info img { vertical-align: bottom; }

#main_search_form .search_app {
	font-size: 12px;
	display: inline-block;
	padding: 8px 10px 8px 0;
	margin-right: 12px;
	font-weight: bold;
	border: 1px solid transparent;
	cursor: pointer;
}

	#main_search_form .search_app.active {
		background: #5d5338;
		padding-left: 10px;
		color: #fff;
		border-radius: 3px;
		-moz-border-radius: 3px;
		-webkit-border-radius: 3px;
	}

#main_search_form .search_msg {
	border-bottom: 1px solid #f0f0f0;
	display: block;
	font-size: 12px;
	padding: 0 0 5px 200px;
	margin-bottom: 15px;
	color: #5c5c5c;
}


div#search_results {
	border-bottom: 4px solid #d5dde5;
}	
	
	div#search_results span.icon {
		float: left;
		margin-right: 15px;
	}
	
	div#search_results div.result_info {
		float: left;
		width: 68%;
	}
	
		div#search_results div.result_info span.desc.breadcrumb a {
			color: #a9a9a9;
		}
	
	div#search_results h3 {
		background: none;
		font-weight: normal;
		font-size: 1.3em;
		border: 0;
		padding: 0;
	}

	div#search_results li.liwrap {
		padding: 10px 15px 15px 15px;
		border-top: 1px solid #fff;
	}

	div#search_results p {
		color: #606060;
		margin: 4px 0 2px 0;
	}
	
	/* Further details */
	div#search_results .result_details {
		width: 30%;
		float: right;
		border-left: 1px solid #B5C0CF;
		padding-left: 15px;
		line-height: 130%;
		font-size: 11px;
	}
	
		div#search_results .result_details li {
			border: 0;
			padding: 0;
		}

	div#search_results .gutter {
		background-color: #528f6c;
		color: #fff;
		font-size: 9px;
		font-weight: bold;
		text-transform: uppercase;
		padding: 3px 8px 2px 8px;
		margin-top: 0px;
		margin-right: 15px;
		display: none;
		float: left;
	}

		div#search_results .gutter img {
			padding-right: 4px;
		}

	div#search_results .sub div.result_info {
		padding-left: 3%;/*padding-left: 45px;*/
	}

		div#search_results .sub .gutter {
			background-color: #dedede;
			color: #1d3652;
			padding: 6px 8px 5px 8px;
			margin-left: 45px;
		}

	div#search_results ol ol {
		padding: 20px 0 0 15px;
		margin: 0 0 -15px 20px;
	}
	
	.tab_filters ul {
		padding-top: 5px;
	}
	
	.tab_filters ul.padded
	{
		padding-top: 10px;
	}
	
/* as forum stuffs */
.maintitle.links,
.maintitle a {
	text-decoration: none;
	font-size: 12px;
}
.entry-content.search {}

/* These styles are duplicated Rikki, putting a note as requested */

.search_filter_container {
	height: 440px;
	max-height: 440px;
}
.search_filter_container ul.block_list {
	height: 396px; overflow: auto;
}
.search_filter_container ul.block_list > li {
	padding: 0px;
}

.search_filter_container ul.block_list > li span {
	padding: 3px 10px 3px 25px;
	display: block;
}

	.search_filter_container ul.block_list li span.heading {
		font-weight: bold;
	}

.search_filter_container ul.block_list li.active span {
	background: #af286d url({style_images_url}/icon_check_white.png ) no-repeat 6px 8px;
	color: #fff;
	font-weight: bold;
}

#vnc_filter_popup_close { 
	text-align: center;
	position: absolute;
	bottom: 0; left: 0;	right: 0;
	height: 42px;
	line-height: 42px;
	padding: 0 5px;
	background: #DBE4EF;
	background: -moz-linear-gradient(top, #DBE4EF 0%, #c7d4e4 100%); /* firefox */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#DBE4EF), color-stop(100%,#c7d4e4)); /* webkit */
	-webkit-box-shadow: 0px 1px 1px 0px rgba(255,255,255,0.5) inset;
	-moz-box-shadow: 0px 1px 1px 0px rgba(255,255,255,0.5) inset;
	box-shadow: 0px 1px 1px 0px rgba(255,255,255,0.5) inset;
	border-top: 1px solid #DBE4EF;
}]]></css_content>
    <css_position>2</css_position>
    <css_app>core</css_app>
    <css_app_hide>1</css_app_hide>
    <css_attributes><![CDATA[title="Main" media="screen,print"]]></css_attributes>
    <css_modules>search</css_modules>
    <css_removed>0</css_removed>
    <css_master_key/>
  </cssfile>
  <cssfile>
    <css_set_id>6</css_set_id>
    <css_updated>1415729627</css_updated>
    <css_group>ipb_styles</css_group>
    <css_content><![CDATA[/************************************************************************/
/* IP.Board 3 CSS - By Rikki Tissier - (c)2008 Invision Power Services 	*/
/************************************************************************/
/* ipb_styles.css														*/
/************************************************************************/

/************************************************************************/
/* RESET (Thanks to YUI) */

body,div,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6,pre,form,fieldset,input,textarea,p,blockquote,th,td { margin:0; padding:0; font-family:arial,helvetica,sans-serif; } 
table {	border-collapse:collapse; border-spacing:0; }
fieldset,img { border:0; }
address,caption,cite,code,dfn,th,var { font-style:normal; font-weight:normal; }
ol,ul { list-style:none; }
caption,th { text-align:left; }
h1,h2,h3,h4,h5,h6 { font-size:100%;	font-weight:normal; }
q:before,q:after { content:''; }
abbr,acronym { border:0; }
/*hr { display: none; }*/
address{ display: inline; }

/************************************************************************/
/* CORE ELEMENT STYLES */

html, body { /* Safari has trouble with bgcolor on body. Apply to html tag too. */
	background-color: #dceeea;  /* hr blue: #2f5391*/
	color: #5a5a5a;
}

body {
	font: normal 16px Verdana, Helvetica, Arial, sans-serif;
	position: relative;
}

input, select {
	font: normal 13px helvetica, arial, sans-serif;
}

h3, strong { font-weight: bold; }
em { font-style: italic; }
img, .input_check, .input_radio { vertical-align: middle; }
legend { display: none; }
table { width: 100%; }
td { padding: 3px; }


a {
	color: #44708c;
	text-decoration: none;
}

	a:hover { color: #328586; }

	
/************************************************************************/
/* LISTS */


.ipsList_inline > li {
	display: inline-block;
	margin: 0 3px;
}

/*
div.pagination .ipsList_inline ul li {
	display: inline-block;
	margin: 0 3px;
}

ol.ipsList_inline.ipsType_small.subforums li {margin: 0 3px;}
*/
 
	.ipsList_inline > li:first-child { margin-left: 0; }
	.ipsList_inline > li:last-child { margin-right: 0; }
	.ipsList_inline.ipsList_reset > li:first-child { margin-left: 3px; }
	.ipsList_inline.ipsList_reset > li:last-child { margin-right: 3px; }
	.ipsList_inline.ipsList_nowrap { white-space: nowrap; }
	
.ipsList_withminiphoto > li { margin-bottom: 8px; }
.ipsList_withmediumphoto > li .list_content { margin-left: 60px; }
.ipsList_withminiphoto > li .list_content { margin-left: 40px; }
.ipsList_withtinyphoto > li .list_content { margin-left: 30px; }
.list_content { word-wrap: break-word; }

.ipsList_data li { margin-bottom: 6px; line-height: 1.3; }
.ipsList_data .row_data { display: inline-block; word-wrap: break-word; max-width: 100%; }
.ipsList_data .row_title, .ipsList_data .ft {
	display: inline-block;
	float: left;
	width: 120px;
	font-weight: bold;
	text-align: right;
	padding-right: 10px;
}

.ipsList_data.ipsList_data_thin .row_title, .ipsList_data.ipsList_data_thin .ft {
	width: 80px;
}

/************************************************************************/
/* TYPOGRAPHY */

.ipsType_pagetitle, .ipsType_subtitle {
	font: normal 26px/1.3 Helvetica, Arial, sans-serif;
	color: #B76B46;
}
.ipsType_subtitle { font-size: 18px; }
.ipsType_sectiontitle { 
	font-size: 16px;
	font-weight: normal;
	color: #595959;
	padding: 5px 0;
	border-bottom: 1px solid #ececec;
}

.ipsType_pagedesc {
	color: #7f7f7f;
	line-height: 1.5;
}

.ipsType_pagedesc a { text-decoration: underline; }

.ipsType_textblock { line-height: 1.5; color: #282828; }

.ipsType_small { font-size: 12px; }
.ipsType_smaller, .ipsType_smaller a { font-size: 11px !important; }
.ipsType_smallest, .ipsType_smallest a { font-size: 10px !important; }

.ipsReset { margin: 0px !important; padding: 0px !important; }

/************************************************************************/
/* LAYOUT */
#content, .main_width {
	margin: 0 auto;
	/* Uncomment for fixed */
	max-width: 1240px;
	/* Fluid */
	width: 97% !important;
 	min-width: 960px;  /**/
}

#branding, #header_bar, #primary_nav {/* min-width: 980px; */ }
/*#header_bar .main_width, #branding .main_width, #primary_nav .main_width { padding: 0 10px; }*/


#content {
	background: #fff;
	padding: 10px 10px;
	line-height: 120%;
	border: 2px solid #bcb9b0;
        clear: both;
}

/************************************************************************/
/* COLORS */


.row1, .post_block.row1 {	background-color: #fff;  }


.row2, .post_block.row2 { 	background-color: #f8f8f8; }



.unread 				{	background-color: #f9f9f9; }


.unread .altrow, .unread.altrow { background-color: #efefef; }

/* primarily used for topic preview header */
.highlighted, .highlighted .altrow { background-color: #eee; }


.ipsBox { background: #f1f1f1; }
	
	.ipsBox_notice, .ipsBox_highlight {
		background: #f4fcff;
		border-bottom: 1px solid #cae9f5;
	}

/* mini badges */
a.ipsBadge:hover { color: #fff; }

.ipsBadge_green { background: #7ba60d; }
.ipsBadge_purple { background: #87ba44; }
.ipsBadge_grey { background: #5b5b5b; }
.ipsBadge_lightgrey { background: #b3b3b3; }
.ipsBadge_orange { background: #ED7710; }
.ipsBadge_red {	background: #bf1d00; }


.bar {
	background: #f6f6f6;
	padding: 8px 10px;
}
	
	.bar.altbar {
		background: #d9d9d9;
		color: #222;
	}


.header {
	background: #d9d9d9;
	color: #222;
}

	
	body .ipb_table .header a,
	body .topic_options a {
		color: #222;
	}
	

.post_block {
	background: #fff;
	border-bottom: 1px solid #eaeaea;
}

.post_body .post { color: #282828; }

.bbc_url, .bbc_email {
	color: #0f72da;
	text-decoration: underline;
}



/* Dates */
.date, .poll_question .votes {
	color: #747474;
	font-size: 11px;
}


.no_messages {
	background-color: #f8f8f8;
	color: #373737;
	padding: 15px 10px;
}

/* Tab bars */
.tab_bar {
	background-color: #f0f0f0;
	color: #4a6784;
}

	.tab_bar li.active {
		background-color: #474747;
		color: #fff;
	}
	
	.tab_bar.no_title.mini {
		border-bottom: 8px solid #474747;
	}

/* Menu popups */
.ipbmenu_content, .ipb_autocomplete {
	background-color: #f9f9f9;
	border: 1px solid #e5e5e5;
	-webkit-box-shadow: rgba(0, 0, 0, 0.3) 0px 6px 6px;
	box-shadow: rgba(0, 0, 0, 0.3) 0px 6px 6px;
}

	.ipbmenu_content li, .ipb_autocomplete li {
		border-bottom: 1px solid #e5e5e5;
	}
	
		.ipb_autocomplete li.active {
			background: #e5e5e5;
		}
		
	.ipbmenu_content a:hover { background: #e5e5e5; }
		
/* Forms */

.input_submit {
	background: #212121 url({style_images_url}/topic_button.png ) repeat-x top;
	color: #fff;
	-moz-border-radius: 3px;
	-webkit-border-radius: 3px;
	border-radius: 3px;
	-moz-box-shadow: inset 0 1px 0 0 #5c5c5c, 0px 2px 3px rgba(0,0,0,0.2);
	-webkit-box-shadow: inset 0 1px 0 0 #5c5c5c, 0px 2px 3px rgba(0,0,0,0.2);
	box-shadow: inset 0 1px 0 0 #5c5c5c, 0px 2px 3px rgba(0,0,0,0.2);
	border-color: #212121;
}

	.input_submit:hover { color: #fff; }
	
	
	.input_submit.alt {
		background: #efefef;
		border-color: #dae2ea;
		color: #464646;
		-moz-box-shadow: inset 0 1px 0 0 #eff3f8, 0px 2px 3px rgba(0,0,0,0.2);
		-webkit-box-shadow: inset 0 1px 0 0 #eff3f8, 0px 2px 3px rgba(0,0,0,0.2);
		box-shadow: inset 0 1px 0 0 #eff3f8, 0px 2px 3px rgba(0,0,0,0.2);
	}
	
		.input_submit.alt:hover { color: #464646; }

	.input_submit.delete {
		background: #ad2930;
		border-color: #C8A5A4 #962D29 #962D29 #C8A5A4;
		color: #fff;
		-moz-box-shadow: inset 0 1px 0 0 #C8A5A4, 0px 2px 3px rgba(0,0,0,0.2);
		-webkit-box-shadow: inset 0 1px 0 0 #C8A5A4, 0px 2px 3px rgba(0,0,0,0.2);
		box-shadow: inset 0 1px 0 0 #C8A5A4, 0px 2px 3px rgba(0,0,0,0.2);
	}
	
		.input_submit.delete:hover { color: #fff; }

	
body#ipboard_body fieldset.submit,
body#ipboard_body p.submit {
	background-color: #e7e7e7;
}

/* Moderated styles */
.moderated, body .moderated td, .moderated td.altrow, .post_block.moderated,
body td.moderated, body td.moderated {
	background-color: #f8f1f3;
}
	
	.post_block.moderated { border-color: #e9d2d7; }	
	.moderated .row2 { background-color: #f0e0e3; }
	.moderated, .moderated a { color: #6f3642; }
	
body#ipboard_body.redirector {
	background: #fff !important;
}

/************************************************************************/
/* HEADER */

#header_bar {
	background: #323232 url({style_images_url}/user_navigation.png ) repeat-x bottom;
	padding: 0;
	text-align: right;
}
	
#admin_bar { font-size: 11px; line-height: 36px; }
#admin_bar li.active a { color: #fc6d35; }
#admin_bar a { color: #8a8a8a; }
	#admin_bar a:hover { color: #fff; }

#user_navigation { color: #389948; font-size: 14px; text-shadow: 0px 1px 0px #deede9 }
#user_navigation a { color: #419285; }
#user_navigation .ipsList_inline li { margin: 0;} /* remove spacing from default ipsList_inline */

#user_navigation.not_logged_in {
	height: 26px; padding: 6px 0 4px;
}

#user_link {
        background-color: #aad3ca;
	color: #419285;
	padding: 0 12px;
	height: 36px;
	line-height: 36px;
	display: inline-block;
	margin-right: 15px;
	outline: 0;
}
	
	#user_link_dd, .dropdownIndicator {
		display: inline-block;
		width: 9px; height: 5px;
		background: url({style_images_url}/header_dropdown.png ) no-repeat left;
	}
	
	#user_link:hover, #notify_link:hover, #inbox_link:hover { background-color: #aad3ca; }

#user_link_menucontent #links li { 
	width: 50%;
	float: left;
	margin: 3px 0;
	text-shadow: 0px 1px 0 rgba(255,255,255,1);
	white-space: nowrap;
}


#user_link.menu_active {
	background: #fff;
	color: #323232;
}
	
	#user_link.menu_active #user_link_dd, .menu_active .dropdownIndicator, li.active .dropdownIndicator { background-position: right; }
		#community_app_menu .menu_active .dropdownIndicator { background-position: left; }
			#community_app_menu li.active .menu_active .dropdownIndicator { background-position: right; }
	#user_link_menucontent #statusForm { margin-bottom: 15px; }
	#user_link_menucontent #statusUpdate {	margin-bottom: 5px; }

#user_link_menucontent > div {
	margin-left: 15px;
	width: 265px;
	text-align: left;
}


#statusSubmitGlobal { margin-top: 3px; }

#user_link.menu_active, #notify_link.menu_active, #inbox_link.menu_active {
	background-position: bottom;
	background-color: #fff;
	-moz-border-radius: 3px 3px 0 0;
	-webkit-border-top-left-radius: 3px;
	-webkit-border-top-right-radius: 3px;
	border-radius: 3px 3px 0 0;
}

#notify_link, #inbox_link {
	vertical-align: middle;
	width: 18px;
	height: 15px;
	padding: 13px 24px 8px 12px;
	position: relative;
}
	
#notify_link { background: url({style_images_url}/icon_notify.png ) no-repeat center; }
#inbox_link { background: url({style_images_url}/icon_inbox.png ) no-repeat center; }


#user_navigation #register_link { 
	background: #7ba60d; 
	color: #fff;
	display: inline-block;
	padding: 3px 8px;
	border: 1px solid #7ba60d;
	-webkit-box-shadow: inset 0px 1px 0 rgba(255,255,255,0.2), 0px 1px 4px rgba(0,0,0,0.4);
	-moz-box-shadow: inset 0px 1px 0 rgba(255,255,255,0.2), 0px 1px 4px rgba(0,0,0,0.4);
	box-shadow: inset 0px 1px 0 rgba(255,255,255,0.2), 0px 1px 4px rgba(0,0,0,0.4);
	text-shadow: 0px 1px 2px rgba(0,0,0,0.3);
}


#branding {
	background: url({style_images_url}/branding_bg.png) repeat-x center;
        height: 155px;
}
	
        #branding .main_width > a {
             display: inline-block;
             padding-top: 15px;
        }

	#logo { 
             background: url({style_images_url}/logo.png) no-repeat;
             width: 135px; 
             height: 87px; 
        }
/*
	#logo:hover { 
             background: url({style_images_url}/logo_hover.png) no-repeat;
        }
*/

#primary_nav {
	background: transparent;
	font-size: 14px;
        text-transform: uppercase;
	padding: 21px 0 0 0;

}

	#community_app_menu > li { margin: 0px 3px 0 0; position: relative; }

	
	#community_app_menu > li > a {
		color: #FFF;
		display: block;
		padding: 6px 15px 8px;
		text-shadow: 0px 1px 1px rgba(0,0,0,0.5);
	}

		
		#community_app_menu > li > a:hover, #community_app_menu > li > a.menu_active {
			color: #28bbaa;
		}
	
	
	#community_app_menu > li.active > a {
		background: #dceeea;
		/*color: #28bbaa;*/
color: #287268;
                text-shadow: 0 1px 0 #FFF !important;
		margin-top: 0;
		text-shadow: none;
                border: 2px solid #FFF;
                border-bottom: 0;
                -webkit-border-radius: 3px 3px 0px 0px;
                border-radius: 3px 3px 0px 0px;
	}

#quickNavLaunch span { 
	background: url({style_images_url}/icon_quicknav.png ) no-repeat top;
	width: 13px;
	height: 13px;
	display: inline-block;
}
#quickNavLaunch:hover span { background: url({style_images_url}/icon_quicknav.png ) no-repeat bottom; }
#primary_nav #quickNavLaunch { padding: 6px 8px 8px; }

#more_apps_menucontent, .submenu_container {
	background: #173455;
	font-size: 12px;
	border: 0;
	min-width: 140px;
}
	#more_apps_menucontent li, .submenu_container li { padding: 0; border: 0; float: none !important; min-width: 150px; }
	#more_apps_menucontent a, .submenu_container a { 
		display: block;
		padding: 8px 10px;
		color: #fff;
		text-shadow: 0px 1px 1px rgba(0,0,0,0.5);
	}

	#more_apps_menucontent li:hover, .submenu_container li:hover { background-color: #fff !important; }
	
	#more_apps_menucontent li:hover a, .submenu_container li:hover a { color: #000; text-shadow: none; }

#community_app_menu .submenu_container,
#more_apps_menucontent.submenu_container {
	width: 260px;
}

	#community_app_menu .submenu_container li,
	#more_apps_menucontent.submenu_container li {
		width: 260px;
	}

.breadcrumb {
	color: #777;
	font-size: 11px;
}
	.breadcrumb a { color: #777; }
	.breadcrumb li .nav_sep { margin: 0 5px 0 0; }
	.breadcrumb li:first-child{ margin-left: 0; }
	.breadcrumb.top { margin-bottom: 10px; }
	.breadcrumb.bottom { margin-top: 10px; width: 100% }

.ipsHeaderMenu {
	background: #ffffff; /* Old browsers */
	background: -moz-linear-gradient(top, #ffffff 0%, #f6f6f6 70%, #ededed 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ffffff), color-stop(70%,#f6f6f6), color-stop(100%,#ededed)); /* Chrome,Safari4+ */
	padding: 10px;
	-moz-border-radius: 0 0 6px 6px;
	-webkit-border-bottom-right-radius: 6px;
	-webkit-border-bottom-left-radius: 6px;
	border-radius: 0 0 6px 6px;
	overflow: hidden;
	width: 340px;
        font-size: 12px;
}

	.ipsHeaderMenu .ipsType_sectiontitle { margin-bottom: 8px; }
	
	#user_notifications_link_menucontent.ipsHeaderMenu,
	#user_inbox_link_menucontent.ipsHeaderMenu {
		width: 300px;
	}
	
/************************************************************************/
/* SEARCH */	

#search {
        margin-left: -12px; 
        float: left !important;
}	

#main_search {
	font-size: 12px;
	border: 0;
	padding: 0;
	background: transparent;
	width: 130px;
	outline: 0;
}

	#main_search.inactive {	color: #bcbcbc;	}
	
#search_wrap {
	position: relative;
	background: #fff;
	display: block;
	padding: 0 26px 0 4px;
	height: 26px;
	line-height: 22px;
        border: 2px solid #bcb9b0;
	width: 600px;
}

#adv_search {
	width: 16px;
	height: 16px;
	background: url({style_images_url}/advanced_search.png) no-repeat right 50%;
	text-indent: -3000em;
	display: inline-block;
	margin: 7px 0 4px 4px;
}


#search .submit_input {
	background: url({style_images_url}/search_icon.png) no-repeat 50%;
	text-indent: -3000em;
	padding: 0; border: 0;
	display: block;
	width: 26px;
	height: 26px;
	position: absolute;
	right: 0; top: 0; bottom: 0;
}

#search_options {
	font-size: 10px;
	height: 20px;
	line-height: 20px;
	margin: 3px 3px 3px 0;
	padding: 0 6px;
	-moz-border-radius: 3px;
	-webkit-border-radius: 3px;
	border-radius: 3px;
	background: #eaeaea;
	display: inline-block;
	float: right;
	max-width: 80px;
	text-overflow:ellipsis;
	overflow: hidden;
}

#search_options_menucontent { min-width: 100px; white-space: nowrap; }
	#search_options_menucontent input { margin-right: 10px; }
	#search_options_menucontent li { border-bottom: 0; }
	#search_options_menucontent label { cursor: pointer; }
	
/************************************************************************/
/* FOOTER */	

#backtotop {
	width: 24px;
	height: 24px;
	line-height: 20px;
	left: 50%;
	margin-left: -12px;
	position: absolute;
	display: inline-block;
	background: #bdbdbd;
	text-align: center;
	-moz-border-radius: 16px;
	-webkit-border-radius: 16px;
	border-radius: 16px;
	opacity: 0.4;
	outline: 0;
}

	#backtotop:hover { 
		background: #87ba44;
		color: #fff;
		opacity: 1;
	}

#footer_utilities { 
	padding: 10px; 
	font-size: 11px;
	position: relative;
}
	
	#footer_utilities .ipsList_inline > li > a { margin-right: 0px; padding: 4px 10px; }
	#footer_utilities a.menu_active { 
		background: #fff;
		margin-top: -5px;
		padding: 3px 9px 4px !important;
		z-index: 20000;
		position: relative;
		display: inline-block;
		border: 1px solid #e5e5e5;
		border-bottom: 0;
	}
	
	#copyright {
		color: #848484;
		text-align: right;
		text-shadow: 0px 1px 0px #fff;
	}
	
		#copyright a { color: #848484; }

#ipsDebug_footer {
	width: 900px;
	margin: 8px auto 0px auto;
	text-align: center;
	color: #404040;
	text-shadow: 0px 1px 0px #fff;
	font-size: 11px;
}
	#ipsDebug_footer strong { margin-left: 20px; }
	#ipsDebug_footer a { color: #404040; }
	
#rss_menu {
	background-color: #fef3d7;
	border: 1px solid #ed7710;
}
	
	#rss_menu li { border-bottom: 1px solid #fce19b; }
	#rss_menu a {
		color: #ed7710;
		padding: 5px 8px;
	}

		#rss_menu a:hover {
			background-color: #ed7710;
			color: #fff;
		}

/************************************************************************/
/* GENERAL CONTENT */

.ipsUserPhoto {
	padding: 1px;
	border: 1px solid #d5d5d5;
	background: #fff;
	-webkit-box-shadow: 0px 2px 2px rgba(0,0,0,0.1);
	-moz-box-shadow: 0px 2px 2px rgba(0,0,0,0.1);
	box-shadow: 0px 2px 2px rgba(0,0,0,0.1);
}
	
	.ipsUserPhotoLink:hover .ipsUserPhoto {
		border-color: #7d7d7d;
	}
	
	.ipsUserPhoto_variable { max-width: 155px; }
	.ipsUserPhoto_large { max-width: 90px; max-height: 90px; }
	.ipsUserPhoto_medium { width: 50px; height: 50px; }
	.ipsUserPhoto_mini { width: 30px; height: 30px; }
	.ipsUserPhoto_tiny { width: 20px; height: 20px;	}
	.ipsUserPhoto_icon { width: 16px; height: 16px;	}


.general_box {
	background: #fcfcfc;
	margin-bottom: 10px;
}

	
	.general_box h3 {
		font: normal 14px helvetica, arial, sans-serif;
		padding: 8px 10px;
		background: #e9e9e9;
		color: #565656;
	}

.general_box .none {
	color: #bcbcbc;
}

.ipsPad { padding: 9px; }
	.ipsPad_double { padding: 9px 19px; } /* 19px because it's still only 1px border to account for */
	.ipsBox_withphoto { margin-left: 65px; }
	
	
	.ipsBox_container {
		background: #fff;
	}
	.ipsBox_container.moderated { 
		background: #f8f1f3;
		border: 1px solid #d6b0bb;
	}
	.ipsBox_notice {
		padding: 10px;
		line-height: 1.6;
		margin-bottom: 10px;
	}
	.ipsBox_container .ipsBox_notice {	margin: -10px -10px 10px -10px;	}
.ipsPad_half { padding: 4px !important; }
.ipsPad_left { padding-left: 9px; }
.ipsPad_top { padding-top: 9px; }
.ipsPad_top_slimmer { padding-top: 7px; }
.ipsPad_top_half { padding-top: 4px; }
.ipsPad_top_bottom { padding-top: 9px; padding-bottom: 9px; }
.ipsPad_top_bottom_half { padding-top: 4px; padding-bottom: 4px; }
.ipsMargin_top { margin-top: 9px; }

.ipsBlendLinks_target .ipsBlendLinks_here {
		opacity: 0.5;
		-webkit-transition: all 0.1s ease-in-out;
		-moz-transition: all 0.2s ease-in-out;
	}
	.ipsBlendLinks_target:hover .ipsBlendLinks_here { opacity: 1; }
	
.block_list > li {
	padding: 5px 10px;
	border-bottom: 1px solid #f2f2f2;
}

.ipsModMenu {
	width: 15px;
	height: 15px;
	display: inline-block;
	text-indent: -2000em;
	background: url({style_images_url}/moderation_cog.png ) no-repeat;
	margin-right: 5px;
	vertical-align: middle;
}

.ipsBadge {
	display: inline-block;
	height: 15px;
	line-height: 15px;
	padding: 0 5px;
	font-size: 9px;
	font-weight: bold;
	text-transform: uppercase;
	color: #fff;
	-moz-border-radius: 4px;
	-webkit-border-radius: 4px;
	border-radius: 4px;
	vertical-align: middle;
}

	.ipsBadge.has_icon img {
		max-height: 7px;
		vertical-align: baseline;
	}
	
	#nav_app_ipchat .ipsBadge {	position: absolute;	}
	
#ajax_loading {
	background: #95C715;
	background: -moz-linear-gradient(top, #95C715 0%, #7BA60D 100%);
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#95C715), color-stop(100%,#7BA60D));
	background: linear-gradient(top, #95C715 0%,#7BA60D 100%);
	border: 1px solid #7BA60D;
	color: #fff;
	text-align: center;
	padding: 5px 0 8px;
	width: 8%;
	top: 0px;
	left: 46%;
	-moz-border-radius: 0 0 5px 5px;
	-webkit-border-bottom-right-radius: 5px;
	-webkit-border-bottom-left-radius: 5px;
	border-radius: 0 0 5px 5px;
	z-index: 10000;
	position: fixed;
	-moz-box-shadow: 0px 3px 5px rgba(0,0,0,0.2), inset 0px -1px 0px rgba(255,255,255,0.2);
	-webkit-box-shadow: 0px 3px 5px rgba(0,0,0,0.2), inset 0px -1px 0px rgba(255,255,255,0.2);
	box-shadow: 0px 3px 5px rgba(0,0,0,0.2), inset 0px -1px 0px rgba(255,255,255,0.2);
}

#ipboard_body.redirector {
	width: 500px;
	margin: 150px auto 0 auto;
}

#ipboard_body.minimal { margin-top: 40px; }
	#ipboard_body.minimal #content {
		-moz-border-radius: 10px;
		-webkit-border-radius: 10px;
		border-radius: 10px;
		padding: 20px 30px;
	}
	#ipboard_body.minimal h1 { font-size: 32px; }
	#ipboard_body.minimal .ipsType_pagedesc { font-size: 16px; }

.progress_bar {
	background-color: #fff;
	border: 1px solid #e5e5e5;
}

	.progress_bar span {
		background: #404040 url({style_images_url}/gradient_bg.png) repeat-x left 50%;
		color: #fff;
		font-size: 0em;
		font-weight: bold;
		text-align: center;
		text-indent: -2000em; /* Safari fix */
		height: 10px;
		display: block;
		overflow: hidden;
	}

	.progress_bar.limit span {
		background: #b82929 url({style_images_url}/progressbar_warning.png) repeat-x center;
	}

	.progress_bar span span {
		display: none;
	}

.progress_bar.user_warn {	
	margin: 0 auto;
	width: 80%;
}

	.progress_bar.user_warn span {
		height: 6px;
	}

.progress_bar.topic_poll {
	border: 1px solid #e5e5e5;
	margin-top: 2px;
	width: 40%;
}

li.rating a {
	outline: 0;
}

.antispam_img { margin: 0 3px 5px 0; }
	
span.error {
	color: #ad2930;
	font-weight: bold;
	clear: both;
}

#recaptcha_widget_div { max-width: 350px; }
#recaptcha_table { border: 0 !important; }

.mediatag_wrapper {
	position: relative;
	padding-bottom: 56.25%;
	padding-top: 30px;
	height: 0;
	overflow: hidden;
}

.mediatag_wrapper iframe,  
.mediatag_wrapper object,  
.mediatag_wrapper embed {
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
}

/************************************************************************/
/* GENERIC REPEATED STYLES */
/* Inline lists */
.tab_filters ul, .tab_filters li, fieldset.with_subhead span.desc, fieldset.with_subhead label,.user_controls li {
	display: inline;
}

/* Utility styles */
.right { float: right; }
.left { float: left; }
.hide { display: none; }
.short { text-align: center; }
.clear { clear: both; }
.clearfix:after { content: ".";display: block;height: 0;clear: both;visibility: hidden;}
.faded { opacity: 0.5 }
.clickable { cursor: pointer; }
.reset_cursor { cursor: default; }

/* Bullets */
.bullets ul, .bullets ol,
ul.bullets, ol.bullets {
	list-style: disc;
	margin-left: 30px;
	line-height: 150%;
	list-style-image: none;
}


.maintitle {
        background: #97d6cb;
        background: -moz-linear-gradient(top,  #97d6cb 0%, #7abdb2 100%);
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#97d6cb), color-stop(100%,#7abdb2));
        background: -webkit-linear-gradient(top,  #97d6cb 0%,#7abdb2 100%);
        background: -o-linear-gradient(top,  #97d6cb 0%,#7abdb2 100%);
        background: -ms-linear-gradient(top,  #97d6cb 0%,#7abdb2 100%);
        background: linear-gradient(to bottom,  #97d6cb 0%,#7abdb2 100%);
	color: #fff;
	padding: 8px 10px 11px;
	font-size: 16px;
	font-weight: 300;
	-moz-border-radius: 4px 4px 0 0;
	-webkit-border-top-left-radius: 4px;
	-webkit-border-top-right-radius: 4px;
	border-radius: 4px 4px 0 0;
	-webkit-box-shadow: inset 0px 1px 0 #b8e2d9;
	-moz-box-shadow: inset 0px 1px 0 #b8e2d9;
	box-shadow: inset 0px 1px 0 #b8e2d9;
	border-width: 1px;
	border-color: #5c9d92;
	border-style: solid;
}

	.maintitle a {	
                color: #fff; 
                text-shadow: 0px 1px 0px #80bbb1;
        }
	
	.collapsed .maintitle {
		opacity: 0.2;
		-moz-border-radius: 4px;
		-webkit-border-radius: 4px;
		border-radius: 4px;
	}
	
		.collapsed .maintitle:hover { opacity: 0.4; }
	
	.maintitle .toggle { 
		visibility: hidden;
		background: url({style_images_url}/cat_minimize.png) no-repeat;
		text-indent: -3000em;
		width: 25px; height: 25px;
		display: block;
		outline: 0;
	}
		.maintitle:hover .toggle { visibility: visible; }
	
	.collapsed .toggle {
		background-image: url({style_images_url}/cat_maximize.png);
	}	
	
/* Rounded corners */
#user_navigation #new_msg_count, .poll_question h4,
.rounded {
	border-radius: 6px;
	-moz-border-radius: 6px;
	-webkit-border-radius: 6px;
}


.desc, .desc.blend_links a, p.posted_info {
	font-size: 12px;
	color: #777777;
}


.desc.lighter, .desc.lighter.blend_links a {
	color: #a4a4a4;
}

/* Cancel */
.cancel {
	color: #ad2930;
	font-size: 0.9em;
	font-weight: bold;
}

/* Moderation */
em.moderated {
	font-size: 11px;
	font-style: normal;
	font-weight: bold;
}

/* Positive/Negative */
.positive {	color: #6f8f52; }
.negative {	color: #c7172b; }

/* Search highlighting */
.searchlite
{
	background-color: yellow;
	color: red;
	font-size:14px;
}

/* Users posting */
.activeuserposting {
	font-style: italic;
}
	
/************************************************************************/
/* COLUMN WIDTHS FOR TABLES */
/* col_f = forums; col_c = categories; col_m = messenger; col_n = notifications */

.col_f_post { width: 250px !important; }
	.is_mod .col_f_post { width: 180px !important; }

	td.col_c_post { 
		padding-top: 10px !important;
		width: 250px;
	}

.col_f_icon {
	padding: 10px 0 0 0 !important;
	width: 24px !important;
	text-align: center;
	vertical-align: top;
}

.col_n_icon { 
	vertical-align: middle;
	width: 24px;
	padding: 0 !important;
}
	
.col_f_views, .col_m_replies {
	width: 100px !important;
	text-align: right;
	white-space: nowrap;
}

.col_f_mod, .col_m_mod, .col_n_mod { width: 40px; text-align: right; }
.col_f_preview { 
	width: 20px !important; 
	text-align: right;
}

.col_c_icon { padding: 10px 5px 10px 5px !important; width: 33px; vertical-align: middle; text-align: middle; }
.col_c_post .ipsUserPhoto { margin-top: 3px; }

.col_n_date { width: 250px; }
.col_m_photo, .col_n_photo { width: 30px; }
.col_m_mod { text-align: right; }
.col_r_icon { width: 3%; }
.col_f_topic, .col_m_subject { width: 49%; }
.col_f_starter, .col_r_total, .col_r_comments {	width: 10%; }
.col_m_date, .col_r_updated, .col_r_section { width: 18%; }
.col_c_stats { width: 15%; text-align: right; }
.col_c_forum { width: auto; }
.col_mod, .col_r_mod { width: 3%; }
.col_r_title { width: 26%; }

/*.col_c_forum, .col_c_stats, .col_c_icon, .col_c_post { vertical-align: top; }*/

/************************************************************************/
/* TABLE STYLES */

table.ipb_table {
	width: 100%;
	line-height: 1.3;
	border-collapse: collapse;
}
	
	
	table.ipb_table td {
		padding: 10px;
		border-bottom: 1px solid #e6e6e6;
	}
		
		table.ipb_table tr.unread h4 { font-weight: bold; }
		table.ipb_table tr.highlighted td { border-bottom: 0; }
	
	table.ipb_table th {
		font-size: 11px;
		font-weight: bold;
		padding: 8px 6px;
	}
	
.last_post { margin-left: 45px; }

table.ipb_table h4,
table.ipb_table .topic_title {
	font-size: 14px;
	display: inline-block;
}

table.ipb_table  .unread .topic_title { font-weight: bold; }
table.ipb_table .ipsModMenu { visibility: hidden; }
table.ipb_table tr:hover .ipsModMenu, table.ipb_table tr .ipsModMenu.menu_active { visibility: visible; }

#announcements h4 { display: inline; }
#announcements td { border-bottom: 1px solid #fff; }

.forum_data {
	font-size: 11px;
	color: #5c5c5c;
	display: inline-block;
	white-space: nowrap;
	margin: 0px 0 0 8px;
}

.desc_more {
	background: url({style_images_url}/desc_more.png ) no-repeat top;
	display: inline-block;
	width: 13px; height: 13px;
	text-indent: -2000em;
}
	.desc_more:hover { background-position: bottom; }

.category_block .ipb_table h4 { font-size: 15px; word-wrap: break-word; }

table.ipb_table .subforums {
	margin: 2px 0 3px 5px;
	padding-left: 20px;
	background: url({style_images_url}/subforum_stem.png ) no-repeat left 4px;
}
	table.ipb_table .subforums li.unread { font-weight: bold; }

table.ipb_table .expander { 
	visibility: hidden;
	width: 16px;
	height: 16px;
	display: inline-block;
}
table.ipb_table tr:hover .expander { visibility: visible; opacity: 0.2; }
table.ipb_table td.col_f_preview { cursor: pointer; }
table.ipb_table tr td:hover .expander, .expander.open, .expander.loading { visibility: visible !important; opacity: 1; }
table.ipb_table .expander.closed { background: url({style_images_url}/icon_expand_close.png ) no-repeat top; }
table.ipb_table .expander.open { background: url({style_images_url}/icon_expand_close.png ) no-repeat bottom; }
table.ipb_table .expander.loading { background: url({style_images_url}/loading.gif ) no-repeat; }
table.ipb_table .preview td {
	padding: 20px 10px 20px 29px;
	z-index: 20000;
	border-top: 0;
}

	table.ipb_table .preview td > div {
		line-height: 1.4;
		position: relative;		
	}
	
	table.ipb_table .preview td {
		-webkit-box-shadow: 0px 4px 5px rgba(0,0,0,0.15);
		-moz-box-shadow: 0px 4px 5px rgba(0,0,0,0.15);
		box-shadow: 0px 4px 5px rgba(0,0,0,0.15);
		border: 1px solid #ebebeb;
	}

.preview_col {
	margin-left: 80px;
}

.preview_info {
	border-bottom: 1px solid #eaeaea;
	padding-bottom: 3px;
	margin: -3px 0 3px;
}

table.ipb_table .mini_pagination { opacity: 0.5; }
table.ipb_table tr:hover .mini_pagination { opacity: 1; }

/************************************************************************/
/* LAYOUT SYSTEM */

.ipsLayout.ipsLayout_withleft { padding-left: 210px; }
	.ipsBox.ipsLayout.ipsLayout_withleft { padding-left: 220px; }
.ipsLayout.ipsLayout_withright { padding-right: 210px; clear: left; }
	.ipsBox.ipsLayout.ipsLayout_withright { padding-right: 220px; }
	
/* Panes */
.ipsLayout_content, .ipsLayout .ipsLayout_left, .ipsLayout_right { position: relative; }
.ipsLayout_content { width: 100%; float: left; }
.ipsLayout .ipsLayout_left { width: 200px; margin-left: -210px; float: left; }
.ipsLayout .ipsLayout_right { width: 200px; margin-right: -210px; float: right; }

/* Wider sidebars */
.ipsLayout_largeleft.ipsLayout_withleft { padding-left: 280px; }
	.ipsBox.ipsLayout_largeleft.ipsLayout_withleft { padding-left: 290px; }
.ipsLayout_largeleft.ipsLayout .ipsLayout_left { width: 270px; margin-left: -280px; }
.ipsLayout_largeright.ipsLayout_withright { padding-right: 280px; }
	.ipsBox.ipsLayout_largeright.ipsLayout_withright { padding-right: 290px; }
.ipsLayout_largeright.ipsLayout .ipsLayout_right { width: 270px; margin-right: -280px; }

/* Narrow sidebars */
.ipsLayout_smallleft.ipsLayout_withleft { padding-left: 150px; }
	.ipsBox.ipsLayout_smallleft.ipsLayout_withleft { padding-left: 160px; }
.ipsLayout_smallleft.ipsLayout .ipsLayout_left { width: 140px; margin-left: -150px; }
.ipsLayout_smallright.ipsLayout_withright { padding-right: 150px; }
	.ipsBox.ipsLayout_smallright.ipsLayout_withright { padding-right: 160px; }
.ipsLayout_smallright.ipsLayout .ipsLayout_right { width: 140px; margin-right: -150px; }

/* Tiny sidebar */
.ipsLayout_tinyleft.ipsLayout_withleft { padding-left: 50px; }
	.ipsBox.ipsLayout_tinyleft.ipsLayout_withleft { padding-left: 60px; }
.ipsLayout_tinyleft.ipsLayout .ipsLayout_left { width: 40px; margin-left: -50px; }
.ipsLayout_tinyright.ipsLayout_withright { padding-right: 50px; }
	.ipsBox.ipsLayout_tinyright.ipsLayout_withright { padding-right: 60px; }
.ipsLayout_tinyright.ipsLayout .ipsLayout_right { width: 40px; margin-right: -50px; }

/* Big sidebar */
.ipsLayout_bigleft.ipsLayout_withleft { padding-left: 330px; }
	.ipsBox.ipsLayout_bigleft.ipsLayout_withleft { padding-left: 340px; }
.ipsLayout_bigleft.ipsLayout .ipsLayout_left { width: 320px; margin-left: -330px; }
.ipsLayout_bigright.ipsLayout_withright { padding-right: 330px; }
	.ipsBox.ipsLayout_bigright.ipsLayout_withright { padding-right: 340px; }
.ipsLayout_bigright.ipsLayout .ipsLayout_right { width: 320px; margin-right: -330px; }

/* Even Wider sidebars */
.ipsLayout_hugeleft.ipsLayout_withleft { padding-left: 380px; }
	.ipsBox.ipsLayout_hugeleft.ipsLayout_withleft { padding-left: 390px; }
.ipsLayout_hugeleft.ipsLayout .ipsLayout_left { width: 370px; margin-left: -380px; }
.ipsLayout_hugeright.ipsLayout_withright { padding-right: 380px; }
	.ipsBox.ipsLayout_hugeright.ipsLayout_withright { padding-right: 390px; }
.ipsLayout_hugeright.ipsLayout .ipsLayout_right { width: 370px; margin-right: -380px; }

/************************************************************************/


/************************************************************************/
/* SETTINGS SCREENS */
.ipsSettings_pagetitle { font-size: 20px; margin-bottom: 5px; }
.ipsSettings { padding: 0 0px; }
.ipsSettings_section {
	margin: 0 0 15px 0;
	border-top: 1px solid #eaeaea;
	padding: 15px 0 0 0;
}
	
	.ipsSettings_section > div { margin-left: 175px; }
	.ipsSettings_section > div ul li { margin-bottom: 10px; }
	.ipsSettings_section .desc { margin-top: 3px; }
	
.ipsSettings_sectiontitle {
	font: bold 14px Helvetica, Arial, sans-serif;
	color: #151515;
	width: 165px;
	padding-left: 10px;
	float: left;
}

.ipsSettings_fieldtitle { 
	min-width: 100px;
	margin-right: 10px;
	font-size: 14px;
	display: inline-block;
	vertical-align: top;
	padding-top: 3px;
}

/************************************************************************/
/* TOOLTIPS */

.ipsTooltip { padding: 5px; z-index: 25000;}
.ipsTooltip_inner {
	padding: 8px;
	background: #333333;
	border: 1px solid #333333;
	color: #fff;
	-webkit-box-shadow: 0px 2px 4px rgba(0,0,0,0.3), 0px 1px 0px rgba(255,255,255,0.1) inset;
	-moz-box-shadow: 0px 2px 4px rgba(0,0,0,0.3), 0px 1px 0px rgba(255,255,255,0.1) inset;
	box-shadow: 0px 2px 4px rgba(0,0,0,0.3), 0px 1px 0px rgba(255,255,255,0.1) inset;
	-moz-border-radius: 4px;
	-webkit-border-radius: 4px;
	border-radius: 4px;
	font-size: 12px;
	text-align: center;
	max-width: 250px;
}
	.ipsTooltip_inner a { color: #fff; }
	.ipsTooltip_inner span { font-size: 11px; color: #d2d2d2 }
	.ipsTooltip.top 	{ background: url({style_images_url}/stems/tooltip_top.png) no-repeat bottom center; }
		.ipsTooltip.top_left 	{ background-position: bottom left; }
	.ipsTooltip.bottom	{ background: url({style_images_url}/stems/tooltip_bottom.png) no-repeat top center; }
	.ipsTooltip.left 	{ background: url({style_images_url}/stems/tooltip_left.png) no-repeat center right; }
	.ipsTooltip.right	{ background: url({style_images_url}/stems/tooltip_right.png) no-repeat center left; }
	
/************************************************************************/
/* AlertFlag */

.ipsHasNotifications {
	padding: 0px 4px;
	height: 12px;
	line-height: 12px;
	background: #cf2020;
	color: #fff !important;
	font-size: 9px;
	text-align: center;
	-webkit-box-shadow: 0px 2px 4px rgba(0,0,0,0.3), 0px 1px 0px rgba(255,255,255,0.1) inset;
	-moz-box-shadow: 0px 2px 4px rgba(0,0,0,0.3), 0px 1px 0px rgba(255,255,255,0.1) inset;
	box-shadow: 0px 2px 4px rgba(0,0,0,0.3), 0px 1px 0px rgba(255,255,255,0.1) inset;
	-moz-border-radius: 2px;
	-webkit-border-radius: 2px;
	border-radius: 2px;
	position: absolute;
	top: 4px;
	left: 3px;
}

.ipsHasNotifications_blank { display: none; }
#chat-tab-count.ipsHasNotifications { left: auto; top: 0px; right: -1px; text-shadow: none !important; position: absolute; }

/************************************************************************/
/* SIDEBAR STYLE */

.ipsSideMenu { padding: 10px 0; }
.ipsSideMenu h4 { 
	margin: 0 10px 5px 25px;
	font-weight: bold;
	color: #383838;
}

.ipsSideMenu ul {
	border-top: 1px solid #f2f2f2;
	margin-bottom: 20px;
}

.ipsSideMenu ul li {
	font-size: 11px;
	border-bottom: 1px solid #f2f2f2;
}

.ipsSideMenu ul li a {
	padding: 5px 10px 5px 25px;
	display: block;
}


.ipsSideMenu ul li.active a {
	background: #87ba44 url({style_images_url}/icon_check_white.png ) no-repeat 6px 8px;
	color: #fff;
	font-weight: bold;
}

/***************************************************************************/
/* WIZARDS */
.ipsSteps {
	border-bottom: 1px solid #fff;
	background: #eaeaea;
	overflow: hidden;
}	
	.ipsSteps ul li {
		float: left;
		padding: 11px 33px 11px 18px;
		color: #323232;
		background-image: url({style_images_url}/wizard_step_large.png );
		background-repeat: no-repeat;
		background-position: bottom right;
		position: relative;
		max-height: 53px;
	}
	
	.ipsSteps .ipsSteps_active {
		background-position: top right;
		color: #fff;
		text-shadow: 0px -1px 0 rgba(0,0,0,0.7);
	}
	
	.ipsSteps .ipsSteps_done { color: #aeaeae; }
	.ipsSteps_desc { font-size: 11px; }	
	.ipsSteps_arrow { display: none; }
	
	.ipsSteps_title {
		display: block;
		font-size: 14px;
	}
	
	.ipsSteps_active .ipsSteps_arrow {
		display: block;
		position: absolute;
		left: -23px;
		top: 0;
		width: 23px;
		height: 54px;
		background: url({style_images_url}/wizard_step_extra.png ) no-repeat;
	}
	
	.ipsSteps ul li:first-child .ipsSteps_arrow { display: none !important;	}

/************************************************************************/
/* VERTICAL TABS (profile etc.) */

.ipsVerticalTabbed { }

	.ipsVerticalTabbed_content {
		min-height: 400px;
	}
	
	.ipsVerticalTabbed_tabs > ul {
		width: 149px !important;
		margin-top: 10px;
		border-top: 1px solid #eee;
		border-left: 1px solid #eee;
	}
		
		.ipsVerticalTabbed_minitabs.ipsVerticalTabbed_tabs > ul { width: 49px !important; }
		
		
		.ipsVerticalTabbed_tabs li {
			background: #f9f9f9;
			color: #808080;
			border-bottom: 1px solid #eee;
			font-size: 13px;
		}
		
			
			.ipsVerticalTabbed_tabs li a {
				display: block;
				padding: 10px 8px;
				outline: 0;
				color: #8d8d8d;
				-webkit-transition: background-color 0.1s ease-in-out;
				-moz-transition: background-color 0.3s ease-in-out;
			}
			
				
				.ipsVerticalTabbed_tabs li a:hover {
					background: #f5f5f5;
					color: #808080;
				}
			
				
				.ipsVerticalTabbed_tabs li.active a {
					width: 135px;
					position: relative;
					z-index: 8000;
					border-right: 1px solid #fff;
					background: #fff;
					color: #353535;
					font-weight: bold;
				}
				
					.ipsVerticalTabbed_minitabs.ipsVerticalTabbed_tabs li.active a {
						width: 24px;
					}

/************************************************************************/
/* 'LIKE' FUNCTIONS */

.ipsLikeBar { margin: 10px 0; font-size: 11px; }
	
	.ipsLikeBar_info {
		line-height: 19px;
		background: #f4f4f4;
		padding: 0 10px;
		display: inline-block;
		-moz-border-radius: 2px;
		-webkit-border-radius: 2px;
		border-radius: 2px;
	}
	
.ipsLikeButton {
	line-height: 17px;
	padding: 0 6px 0 24px;
	font-size: 11px;
	display: inline-block;
	-moz-border-radius: 2px;
	-webkit-border-radius: 2px;
	border-radius: 2px;
	color: #fff !important;
}
	.ipsLikeButton:hover { color: #fff !important; }
	
	.ipsLikeButton.ipsLikeButton_enabled {
		background: #7b96bb url({style_images_url}/like_button.png ) no-repeat top left;
		border: 1px solid #7b96bb;
	}
	
	.ipsLikeButton.ipsLikeButton_disabled {
		background: #acacac url({style_images_url}/like_button.png ) no-repeat bottom left;
		border: 1px solid #acacac;
	}

/************************************************************************/
/* TAG LIST */

.ipsTag {
	display: inline-block;
	background: url({style_images_url}/tag_bg.png );
	height: 20px;
	line-height: 20px;
	padding: 0 7px 0 15px;
	margin: 5px 5px 0 0;
	font-size: 11px;
	color: #656565;
	text-shadow: 0 1px 0 rgba(255,255,255,1);
	-moz-border-radius: 0 3px 3px 0;
	-webkit-border-top-right-radius: 3px;
	-webkit-border-bottom-right-radius: 3px;
	border-radius: 0 3px 3px 0;
}

/************************************************************************/
/* TAG EDITOR STYLES */

.ipsTagBox_wrapper {
	min-height: 18px;
	width: 350px;
	line-height: 1.3;
	display: inline-block;
}
	
	.ipsTagBox_hiddeninput { background: #fff; }
	.ipsTagBox_hiddeninput.inactive {
		font-size: 11px;
		min-width: 200px;
	}
	
	.ipsTagBox_wrapper input { border: 0px;	outline: 0; }
	.ipsTagBox_wrapper li {	display: inline-block; }
	
	.ipsTagBox_wrapper.with_prefixes li.ipsTagBox_tag:first-child {
		background: #dbf3ff;
		border-color: #a8e3ff;
		color: #136db5;
	}
	
	.ipsTagBox_tag {
		padding: 2px 1px 2px 4px;
		background: #f4f4f4;
		border: 1px solid #dddddd;
		margin: 0 3px 2px 0;
		font-size: 11px;
		-moz-border-radius: 2px;
		-webkit-border-radius: 2px;
		border-radius: 2px;
		cursor: pointer;
	}
	
		.ipsTagBox_tag:hover {
			border-color: #bdbdbd;
		}
		
		.ipsTagBox_tag.selected {
			background: #e2e2e2 !important;
			border-color: #c0c0c0 !important;
			color: #424242 !important;
		}
		
	.ipsTagBox_closetag {
		margin-left: 2px;
		display: inline-block;
		padding: 0 3px;
		color: #c7c7c7;
		font-weight: bold;
	}
		.ipsTagBox_closetag:hover { color: #454545;	}
		.ipsTagBox_tag.selected .ipsTagBox_closetag { color: #424242; }
		.ipsTagBox_tag.selected .ipsTagBox_closetag:hover { color: #2f2f2f;	}
		.ipsTagBox_wrapper.with_prefixes li.ipsTagBox_tag:first-child .ipsTagBox_closetag { color: #4f87bb; }
		.ipsTagBox_wrapper.with_prefixes li.ipsTagBox_tag:first-child .ipsTagBox_closetag:hover { color: #003b71; }
		
	.ipsTagBox_addlink {
		font-size: 10px;
		margin-left: 3px;
		outline: 0;
	}
	
	.ipsTagBox_dropdown {
		height: 100px;
		overflow: scroll;
		background: #fff;
		border: 1px solid #dddddd;
		-webkit-box-shadow: 0px 5px 10px rgba(0,0,0,0.2);
		-moz-box-shadow: 0px 5px 10px rgba(0,0,0,0.2);
		box-shadow: 0px 5px 10px rgba(0,0,0,0.2);
		z-index: 16000;
	}
	
		.ipsTagBox_dropdown li {
			padding: 4px;
			font-size: 12px;
			cursor: pointer;
		}
		.ipsTagBox_dropdown li:hover {
			background: #dbf3ff;
			color: #003b71;
		}

/************************************************************************/
/* TAG CLOUD */
.ipsTagWeight_1 { opacity: 1.0; }
.ipsTagWeight_2 { opacity: 1.0; }
.ipsTagWeight_3 { opacity: 1.0; }
.ipsTagWeight_4 { opacity: 1.0; }
.ipsTagWeight_5 { opacity: 0.9; }
.ipsTagWeight_6 { opacity: 0.7; }
.ipsTagWeight_7 { opacity: 0.8; }
.ipsTagWeight_8 { opacity: 0.6; }
		
/************************************************************************/
/* NEW FILTER BAR */

.ipsFilterbar li {
	margin: 0px 15px 0px 0;
	font-size: 11px;
}
	
	.ipsFilterbar li a {
		color: #fff;
		opacity: 0.5;
		text-shadow: 0px 1px 0px #0d273e;
		-webkit-transition: all 0.3s ease-in-out;
		-moz-transition: all 0.3s ease-in-out;
	}
		.ipsFilterbar.bar.altbar li a { color: #244156; text-shadow: none; opacity: .8; }
	
		.ipsFilterbar:hover li a { opacity: 0.8; }

		.ipsFilterbar li a:hover {
			color: #fff;
			opacity: 1;
		}

		.ipsFilterbar li img { margin-top: -3px; }

.ipsFilterbar li.active { opacity: 1; }

	
	.ipsFilterbar li.active a, .ipsFilterbar.bar.altbar li.active a {
		background: #494949;
		opacity: 1;
		color: #fff;
		padding: 4px 10px;
		font-weight: bold;
		-moz-border-radius: 10px;
		-webkit-border-radius: 10px !important;
		border-radius: 10px;
		-webkit-box-shadow: inset 0px 2px 2px rgba(0,0,0,0.2);
		-moz-box-shadow: inset 0px 2px 2px rgba(0,0,0,0.2);
		box-shadow: inset 0px 2px 2px rgba(0,0,0,0.2);
	}
		
/************************************************************************/
/* POSTING FORM STYLES */
/* Additional form styles for posting forms */

.ipsPostForm { }
	
	.ipsPostForm.ipsLayout_withright {
		padding-right: 260px !important;
	}
		
	.ipsPostForm .ipsLayout_content {
		z-index: 900;
		-webkit-box-shadow: 2px 0px 4px rgba(0,0,0,0.1);
		-moz-box-shadow: 2px 0px 4px rgba(0,0,0,0.1);
		box-shadow: 2px 0px 4px rgba(0,0,0,0.1);
		float: none;
	}
	
	.ipsPostForm .ipsLayout_right {
		width: 250px;
		margin-right: -251px;
		border-left: 0;
		z-index: 800;
	}
	
	.ipsPostForm_sidebar .ipsPostForm_sidebar_block.closed h3 {
		background-image: url({style_images_url}/folder_closed.png );
		background-repeat: no-repeat;
		background-position: 10px 9px;
		padding-left: 26px;
		margin-bottom: 2px;
	}

/************************************************************************/
/* MEMBER LIST STYLES */
.ipsMemberList .ipsButton_secondary { opacity: 0.3; }
.ipsMemberList li:hover .ipsButton_secondary, .ipsMemberList tr:hover .ipsButton_secondary { opacity: 1; }
.ipsMemberList li .reputation { margin: 5px 10px 0 0; }
.ipsMemberList > li .ipsButton_secondary { margin-top: 15px; }
.ipsMemberList li .rating {	display: inline; }

/************************************************************************/
/* COMMENT STYLES */
.ipsComment_wrap { margin-top: 10px; }
	.ipsComment_wrap .ipsLikeBar { margin: 0; }
	.ipsComment_wrap input[type='checkbox'] { vertical-align: middle; }
	
.ipsComment {
	border-bottom: 1px solid #e9e9e9;
	margin-bottom: 5px;
	padding: 10px 0;
}
	
.ipsComment_author, .ipsComment_reply_user {
	width: 160px;
	text-align: right;
	padding: 0 10px;
	float: left;
	line-height: 1.3;
}

	.ipsComment_author .ipsUserPhoto { margin-bottom: 5px; }
	
.ipsComment_comment {
	margin-left: 190px;
	line-height: 1.5;
}

	.ipsComment_comment > div { min-height: 33px; }

	
.ipsComment_controls { margin-top: 10px; }
.ipsComment_controls > li { opacity: 0.2; }
	.ipsComment:hover .ipsComment_controls > li, .ipsComment .ipsComment_controls > li.right { opacity: 1; }

.ipsComment_reply_user_photo {
	margin-left: 115px;
}

/************************************************************************/
/* FLOATING ACTION STYLES (comment moderation, multiquote etc.) */
.ipsFloatingAction {
	position: fixed;
	right: 10px;
	bottom: 10px;
	background: #fff;
	padding: 10px;
	z-index: 15000;
	border: 4px solid #464646;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	border-radius: 5px;
	-moz-box-shadow: 0px 3px 6px rgba(0,0,0,0.4);
	-webkit-box-shadow: 0px 3px 6px rgba(0,0,0,0.4);
	box-shadow: 0px 3px 6px rgba(0,0,0,0.4);
}

	.ipsFloatingAction.left {
		right: auto;
		left: 10px;
	}
	
	.ipsFloatingAction .fixed_inner {
		overflow-y: auto;
		overflow-x: hidden;
	}
	
/* specifics for seo meta tags editor */
#seoMetaTagEditor { width: 480px; }

	#seoMetaTagEditor table { width: 450px; }
	#seoMetaTagEditor table td { width: 50%; padding-right: 0px }

/************************************************************************/
/* FORM STYLES */

body#ipboard_body fieldset.submit,
body#ipboard_body p.submit {
	padding: 15px 6px 15px 6px;
	text-align: center;
}

.input_text, .ipsTagBox_wrapper {
	padding: 4px;
	border-width: 1px;
	border-style: solid;
	border-color: #848484 #c1c1c1 #e1e1e1 #c1c1c1;
	background: #fff;
	-moz-border-radius: 2px;
	-webkit-border-radius: 2px;
	border-radius: 2px;
}

	.input_text:focus {
		border-color: #4e4e4e #7c7c7c #a3a3a3 #7c7c7c;
		-webkit-box-shadow: 0px 0px 5px rgba(0,0,0,0.3);
		-moz-box-shadow: 0px 0px 5px rgba(0,0,0,0.3);
		box-shadow: 0px 0px 5px rgba(0,0,0,0.3);
	}
	
	input.inactive, select.inactive, textarea.inactive { color: #c4c4c4; }

	.input_text.error {
		background-color: #f3dddd;
	}
	.input_text.accept {
		background-color: #f1f6ec;
	}

.input_submit {
	text-decoration: none;
	border-width: 1px;
	border-style: solid;
	padding: 4px 10px;
	cursor: pointer;
}
	
	.input_submit.alt {
		text-decoration: none;
	}		

p.field {
	padding: 15px;
}

li.field {
	padding: 5px;
	margin-left: 5px;
}

	li.field label,
	li.field span.desc {
		display: block;
	}
	
li.field.error {
	color: #ad2930;
}

	li.field.error label {
		font-weight: bold;
	}

li.field.checkbox, li.field.cbox {
	margin-left: 0;
}

li.field.checkbox .input_check,
li.field.checkbox .input_radio,
li.field.cbox .input_check,
li.field.cbox .input_radio {
	margin-right: 10px;
	vertical-align: middle;
}

	li.field.checkbox label,
	li.field.cbox label {
		width: auto;
		float: none;
		display: inline;
	}
	
	li.field.checkbox p,
	li.field.cbox p {
		position: relative;
		left: 245px;
		display: block;
	}

	li.field.checkbox span.desc,
	li.field.cbox span.desc {
		padding-left: 27px;
		margin-left: auto;
		display: block;
	}
	
/************************************************************************/
/* MESSAGE STYLES */

.message {
	background: #ebfcdf;
	padding: 10px;
	border: 1px solid #a4cfa4;
	color: #0e440e;
	line-height: 1.6;
	font-size: 12px;
}

	.message h3 {
		padding: 0;
		color: #323232;
	}
	
	.message.error {
		background-color: #f3e3e6;
		border-color: #e599aa;
		color: #80001c;
	}
	
	.message.error.usercp {
		background-image: none;
		padding: 4px;
		float: right;
	}
	
	.message.unspecific {
		background-color: #f3f3f3;
		border-color: #d4d4d4;
		color: #515151;
		margin: 0 0 10px 0;
		clear: both;
	}
	
/************************************************************************/
/* MENU & POPUP STYLES */

.ipbmenu_content, .ipb_autocomplete {
	font-size: 12px;
	min-width: 85px;
	z-index: 2000;
}
	
	.ipbmenu_content li:last-child {
		border-bottom: 0;
		padding-bottom: 0px;
	}
	
	.ipbmenu_content li:first-child { padding-top: 0px;	}
	.ipbmenu_content.with_checks a { padding-left: 26px; } /* save room for a checkmark */
	.ipbmenu_content a .icon { margin-right: 10px; }
	.ipbmenu_content a { 
		text-decoration: none;
		text-align: left;
		display: block;
		padding: 6px 10px;
	}
	.ipbmenu_content.with_checks li.selected a {
		background-image: url({style_images_url}/icon_check.png );
		background-repeat: no-repeat;
		background-position: 7px 10px;
	}

.popupWrapper {
	background-color: #464646;
	background-color: rgba(70,70,70,0.6);
	padding: 4px;
	-webkit-box-shadow: 0px 12px 25px rgba(0, 0, 0, 0.7);
	-moz-box-shadow: 0px 12px 25px rgba(0, 0, 0, 0.7);
	box-shadow: 0px 12px 25px rgba(0, 0, 0, 0.7 );
	-moz-border-radius: 4px;
	-webkit-border-radius: 4px;
	border-radius: 4px;
}

	.popupInner {
		background: #fff;
		width: 500px;
		overflow: auto;
		-webkit-box-shadow: 0px 0px 3px rgba(0,0,0,0.4);
		-moz-box-shadow: 0px 0px 3px rgba(0,0,0,0.4);
		box-shadow: 0px 0px 3px rgba(0,0,0,0.4);
		overflow-x: hidden;
	}
	
		.popupInner.black_mode {
			background: #000;
			border: 3px solid #b3bbc3; 
			color: #eee;
			border: 3px solid #555;
		}
		
		.popupInner.warning_mode {
			border: 3px solid #7D1B1B; 
		}
	
		.popupInner h3 {
			background: #97d6cb;
			color: #fff;
			border-width: 1px 1px 0 1px;
			border-style: solid;
			border-color: #222;
			padding: 8px 10px 9px;
			font-size: 16px;
			font-weight: 300;
			text-shadow: 0 1px 2px rgba(0,0,0,0.3);
		}
		
			.popupInner h3 a { color: #fff; }
		
			.popupInner.black_mode h3 {
				background-color: #545C66;
				color: #ddd;
			}
			
			.popupInner.warning_mode h3 {
				background-color: #7D1B1B;
				padding-top: 6px;
				padding-bottom: 6px;
				color: #fff;
			}
			
			.popupInner.warning_mode input.input_submit {
				background-color: #7D1B1B;
			}

.popupClose {
	position: absolute;
	right: 16px;
	top: 12px;
}

.popupClose.light_close_button {
	background: transparent url({style_images_url}/close_popup_light.png) no-repeat top left;
	opacity: 0.8;
	width: 13px;
	height: 13px;
	top: 17px;
}

.popupClose.light_close_button img {
	display: none;
}

.popup_footer {
	padding: 15px;
	position: absolute;
	bottom: 0px;
	right: 0px;
}

.popup_body {
	padding: 10px;
}

.stem {
	width: 31px;
	height: 16px;
	position: absolute;
}

	.stem.topleft { background-image: url({style_images_url}/stems/topleft.png);	}
	.stem.topright { background-image: url({style_images_url}/stems/topright.png); }
	.stem.bottomleft { background-image: url({style_images_url}/stems/bottomleft.png); }
	.stem.bottomright { background-image: url({style_images_url}/stems/bottomright.png);	}
	
.modal {
	background-color: #3e3e3e;
}

.userpopup h3 { font-size: 17px; }
.userpopup h3, .userpopup .side + div { padding-left: 110px; }
.userpopup .side { position: absolute; margin-top: -40px; }
	.userpopup .side .ipsButton_secondary { 
		display: block;
		text-align: center;
		margin-top: 5px;
		/* 	#32468: hacky workaround to ensure these buttons work when translated */
		max-width: 85px;
		height: auto;
		line-height: 1;
		padding: 5px 10px;
		white-space: normal;
	}
.userpopup .user_controls { text-align: left; }
.userpopup .user_status { padding: 5px; margin-bottom: 5px; }
.userpopup .reputation {
	display: block; 
	text-align: center;
	margin-top: 5px;
}

.userpopup {
	overflow: hidden;
	position: relative;
	font-size: 0.9em;
}

	.userpopup dl {
		border-bottom: 1px solid #d4d4d4;
		padding-bottom: 10px;
		margin-bottom: 4px;
	}

.info dt {
	float: left;
	font-weight: bold;
	padding: 3px 6px;
	clear: both;
	width: 30%;
}

.info dd {
	padding: 3px 6px;
	width: 60%;
	margin-left: 35%;
}

/************************************************************************/
/* BUTTONS STYLES */

.topic_buttons li {
	float: right;
	margin: 0 0 10px 10px;
}


.topic_buttons li.important a, .topic_buttons li.important span, .ipsButton .important,
.topic_buttons li a, .topic_buttons li span, .ipsButton {
	background: #212121 url({style_images_url}/topic_button.png ) repeat-x top;
	border: 1px solid #212121;
	border-width: 1px 1px 0 1px;
	-moz-border-radius: 3px;
	-webkit-border-radius: 3px;
	border-radius: 3px;
	-moz-box-shadow: inset 0 1px 0 0 #5c5c5c, 0px 2px 3px rgba(0,0,0,0.2);
	-webkit-box-shadow: inset 0 1px 0 0 #5c5c5c, 0px 2px 3px rgba(0,0,0,0.2);
	box-shadow: inset 0 1px 0 0 #5c5c5c, 0px 2px 3px rgba(0,0,0,0.2);
	color: #fff;
	text-shadow: 0 -1px 0 #191919;
	font: 300 12px/1.3 Helvetica, Arial, sans-serif;
	line-height: 30px;
	height: 30px;
	padding: 0 10px;
	text-align: center;
	min-width: 125px;
	display: inline-block;
	cursor: pointer;
}

.topic_buttons li.important a, .topic_buttons li.important span, .ipsButton .important, .ipsButton.important {
	background: #812200 url({style_images_url}/topic_button_closed.png ) repeat-x top;
	border-color: #812200;
	-moz-box-shadow: inset 0 1px 0 0 #db6e46, 0px 2px 3px rgba(0,0,0,0.2);
	-webkit-box-shadow: inset 0 1px 0 0 #db6e46, 0px 2px 3px rgba(0,0,0,0.2);
	box-shadow: inset 0 1px 0 0 #db6e46, 0px 2px 3px rgba(0,0,0,0.2);
}
	
	.topic_buttons li a:hover, .ipsButton:hover { color: #fff; }
	.topic_buttons li.non_button a {
		background: transparent !important;
		background-color: transparent !important;
		border: 0;
		box-shadow: none;
		-moz-box-shadow: none;
		-webkit-box-shadow: none;
		text-shadow: none;
		min-width: 0px;
		color: #777777;
		font-weight: normal;
	}
	
	.topic_buttons li.disabled a, .topic_buttons li.disabled span {
		background: #ebebeb;
		box-shadow: none;
		-moz-box-shadow: none;
		-webkit-box-shadow: none;
		text-shadow: none;
		border: 0;
		color: #7f7f7f;
	}
	
	.topic_buttons li span { cursor: default !important; }


.ipsButton_secondary {
	height: 22px;
	line-height: 22px;
	font-size: 12px;
	padding: 0 10px;
	background: #f6f6f6;
	background: -moz-linear-gradient(top, #f6f6f6 0%, #e5e5e5 100%); /* firefox */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#f6f6f6), color-stop(100%,#e5e5e5)); /* webkit */
	border: 1px solid #dbdbdb;
	-moz-box-shadow: 0px 1px 0px rgba(255,255,255,1) inset, 0px 1px 0px rgba(0,0,0,0.3);
	-webkit-box-shadow: 0px 1px 0px rgba(255,255,255,1) inset, 0px 1px 0px rgba(0,0,0,0.3);
	box-shadow: 0px 1px 0px rgba(255,255,255,1) inset, 0px 1px 0px rgba(0,0,0,0.3);
	-moz-border-radius: 3px;
	-webkit-border-radius: 3px;
	border-radius: 3px;
	color: #616161;
	display: inline-block;
	white-space: nowrap;
	-webkit-transition: all 0.2s ease-in-out;
	-moz-transition: all 0.2s ease-in-out;
}
	.ipsButton_secondary a { color: #616161; }
	.ipsButton_secondary:hover {
		color: #4c4c4c;
		border-color: #9a9a9a;
	}
	
	
	.ipsButton_secondary.important {
		background: #9f2a00;
		background: -moz-linear-gradient(top, #9f2a00 0%, #812200 100%); /* firefox */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#9f2a00), color-stop(100%,#812200)); /* webkit */
		border: 1px solid #812200;
		color: #fbf4f4;
		-moz-box-shadow: 0px 1px 0px rgba(255,255,255,0.4) inset, 0px 1px 0px rgba(0,0,0,0.3);
		-webkit-box-shadow: 0px 1px 0px rgba(255,255,255,0.4) inset, 0px 1px 0px rgba(0,0,0,0.3);
		box-shadow: 0px 1px 0px rgba(255,255,255,0.4) inset, 0px 1px 0px rgba(0,0,0,0.3);
	}
		.ipsButton_secondary .icon {
			margin-right: 4px;
			margin-top: -3px;
		}
		
		.ipsButton_secondary img.small {
			max-height: 12px;
			margin-left: 3px;
			margin-top: -2px;
			opacity: 0.5;
		}
		
		.ipsButton_secondary.important a { color: #fbf4f4; }
		.ipsButton_secondary.important a:hover { 
			color: #fff !important;
			border-color: #571700;
		}
		
		/* Used in post forms */
		.ipsField.ipsField_checkbox.ipsButton_secondary
		{
			line-height: 18px;
		}
		
		.ipsField.ipsField_checkbox.ipsButton_secondary input
		{
			margin-top: 6px
		}
		
		.ipsField.ipsField_checkbox.ipsButton_secondary .ipsField_content
		{
			margin-left: 18px;
		}
		
.ipsButton_extra {
	line-height: 22px;
	height: 22px;
	font-size: 11px;
	margin-left: 5px;
	color: #5c5c5c;
}

.ipsButton_secondary.fixed_width{ min-width: 170px; }

.ipsButton.no_width { min-width: 0; }
.topic_controls { min-height: 30px; }


ul.post_controls {
	padding: 6px;
	margin: 0 0 10px 0;
	clear: both;
	-moz-border-radius: 4px;
	-webkit-border-radius: 4px;
	border-radius: 4px;
}

		ul.post_controls li {
			font-size: 12px;
			float: right;
		}

		ul.post_controls a {	
			height: 22px;
			line-height: 22px;
			padding: 0 12px;
			color: #222;
			text-decoration: none;
			margin-left: 4px;
			display: block;
		}

		ul.post_controls a:hover { color: #3d70a3; }
		
		ul.post_controls a.ipsButton_secondary {
			height: 20px;
			line-height: 20px;
		}
		
		ul.post_controls a.ipsButton_secondary.important:hover {
			color: #fff !important;
		}
		
		ul.post_controls li.multiquote.selected a { 
			background: #a1dc00; /* Old browsers */
			background: -moz-linear-gradient(top, #a1dc00 0%, #7ba60d 100%); /* FF3.6+ */
			background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#a1dc00), color-stop(100%,#7ba60d)); /* Chrome,Safari4+ */
			border-color: #7ba60d;
			-moz-box-shadow: 0px 1px 0px rgba(255,255,255,0.4) inset, 0px 1px 0px rgba(0,0,0,0.3);
			-webkit-box-shadow: 0px 1px 0px rgba(255,255,255,0.4) inset, 0px 1px 0px rgba(0,0,0,0.3);
			box-shadow: 0px 1px 0px rgba(255,255,255,0.4) inset, 0px 1px 0px rgba(0,0,0,0.3);
			color: #fff;
		}

.post_block .post_controls li a { 
	opacity: 0.2;
	-webkit-transition: all 0.2s ease-in-out;
	-moz-transition: all 0.5s ease-in-out;
}

.post_block .post_controls li a.ipsButton_secondary {
	opacity: 1;
}
.post_block:hover .post_controls li a { opacity: 1; }

.hide_signature, .sigIconStay { float: right; }
.post_block:hover .signature a.hide_signature, .sigIconStay {
	background: transparent url({style_images_url}/cross_sml.png) no-repeat top right;
	width: 13px;
	height: 13px;
	opacity: 0.6;
	position: absolute;
	right: 0px;
}

/************************************************************************/
/* PAGINATION STYLES */

.pagination { padding: 5px 0; line-height: 20px; }
.pagination.no_numbers .page { display: none; }
.pagination .pages { text-align: center; }
.pagination .back { margin-right: 6px; }
	.pagination .back li { margin: 0 2px 0 0; }
.pagination .forward { margin-left: 6px; }
	.pagination .forward li { margin: 0 0 0 2px; }


.pagination .back a,
.pagination .forward a {
	display: inline-block;
	padding: 0px 6px;
	height: 20px;
	background: #eaeaea;
	-moz-border-radius: 2px;
	-webkit-border-radius: 2px;
	border-radius: 2px;
	text-transform: uppercase;
	color: #5a5a5a;
	font-size: 11px;
	font-weight: bold;
}
	
	
	.pagination .back a:hover,
	.pagination .forward a:hover {
		background: #87ba44;
		color: #fff;
	}

	.pagination .disabled a {
		opacity: 0.4;
		display: none;
	}
	
.pagination .pages {
	font-size: 11px;
	font-weight: bold;
}

	.pagination .pages a, .pagejump {
		display: inline-block;
		padding: 1px 4px;
		color: #999;
	}
	
	.pagination .pages .pagejump { padding: 0px; }
	
	.pagination .pages a:hover {
		background: #ececec;
		-moz-border-radius: 2px;
		-webkit-border-radius: 2px;
		border-radius: 2px;
	}
	
	.pagination .pages li { margin: 0 1px; }
	
		
		.pagination .pages li.active {
			background: #7BA60D;
			color: #fff;
			font-weight: bold;
			-moz-border-radius: 2px;
			-webkit-border-radius: 2px;
			border-radius: 2px;
			padding: 1px 5px;
		}
		
.pagination.no_pages span {
	color: #acacac;
	display: inline-block;
	line-height: 20px;
	height: 20px;
}

ul.mini_pagination {
	font-size: 10px;
	display: inline;
	margin-left: 7px;
}

	ul.mini_pagination li a {
		background: #fff;
		border: 1px solid #d3d3d3;
		padding: 1px 3px;
	}

	ul.mini_pagination li {
		display: inline;
		margin: 0px 2px;
	}

/************************************************************************/
/* MODERATION & FILTER STYLES */

.moderation_bar {
	text-align: right;
	padding: 8px 10px;
	/*background: #f7f7f7;*/
}

	.moderation_bar.with_action {
		background-image: url({style_images_url}/topic_mod_arrow.png);
		background-repeat: no-repeat;
		background-position: right center;
		padding-right: 35px;
	}

/************************************************************************/
/* AUTHOR INFO (& RELATED) STYLES */

.author_info {
	width: 155px;
	float: left;
	font-size: 12px;
	text-align: center;
	padding: 15px 10px;
}
	
	.author_info .group_title {
		color: #5a5a5a;
		margin-top: 5px;
	}
	
	.author_info .member_title { margin-bottom: 5px; word-wrap: break-word; }
	.author_info .group_icon { margin-bottom: 3px; }
	
.custom_fields {
	color: #818181;
	margin-top: 8px;
}

.custom_fields .ft { 
	color: #505050;
	margin-right: 3px;
}

.custom_fields .fc {
	word-wrap: break-word;
}


.user_controls {
	text-align: center;
	margin: 6px 0;
}

	.user_controls li a {
		display: inline-block;
		background: #f6f6f6;
		background: -moz-linear-gradient(top, #f6f6f6 0%, #e5e5e5 100%); /* firefox */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#f6f6f6), color-stop(100%,#e5e5e5)); /* webkit */
		border: 1px solid #dbdbdb;
		-moz-box-shadow: 0px 1px 0px rgba(255,255,255,1) inset, 0px 1px 0px rgba(0,0,0,0.3);
		-webkit-box-shadow: 0px 1px 0px rgba(255,255,255,1) inset, 0px 1px 0px rgba(0,0,0,0.3);
		box-shadow: 0px 1px 0px rgba(255,255,255,1) inset, 0px 1px 0px rgba(0,0,0,0.3);
		-moz-border-radius: 3px;
		-webkit-border-radius: 3px;
		border-radius: 3px;
		padding: 5px;
		color: #616161;
	}

/************************************************************************/
/* BOARD INDEX STYLES */

#board_index { position: relative; }
	#board_index.no_sidebar { padding-right: 0px; }
		#board_index.force_sidebar { padding-right: 280px; }
	
#toggle_sidebar {
	position: absolute;
	right: -5px;
	top: -13px;
	z-index: 8000;
	background: #333333;
	padding: 3px 7px;
	-webkit-border-radius: 4px;
	-moz-border-radius: 4px;
	border-radius: 4px;
	color: #fff;
	opacity: 0;
	-webkit-transition: all 0.4s ease-in-out;
	-moz-transition: all 0.4s ease-in-out;
}
	#index_stats:hover + #toggle_sidebar, #board_index.no_sidebar #toggle_sidebar { opacity: 0.1; }
	#toggle_sidebar:hover { opacity: 1 !important; }

	
.ipsSideBlock {
	background: #f6f4f4;
	padding: 10px;
	margin-bottom: 10px;
}
		
	.ipsSideBlock h3 {
		font-size: 15px; font-weight: 300;
		color: #FFF;
		padding: 6px;
                background: #716545;
                background: -moz-linear-gradient(top,  #716545 0%, #59481a 100%);
                background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#716545), color-stop(100%,#59481a));
                background: -webkit-linear-gradient(top,  #716545 0%,#59481a 100%);
                background: -o-linear-gradient(top,  #716545 0%,#59481a 100%);
                background: -ms-linear-gradient(top,  #716545 0%,#59481a 100%);
                background: linear-gradient(to bottom,  #716545 0%,#59481a 100%);
	        -webkit-box-shadow: inset 0px 1px 0 #897c58;
	        -moz-box-shadow: inset 0px 1px 0 #897c58;
	        box-shadow: inset 0px 1px 0 #897c58;
		margin: -10px -10px 10px;
                border: 1px solid #48402b;
                text-shadow: 0px 1px 0px #534622;
	        -moz-border-radius: 4px 4px 0 0;
	        -webkit-border-top-left-radius: 4px;
	        -webkit-border-top-right-radius: 4px;
	        border-radius: 4px 4px 0 0;
	}
	
	.ipsSideBlock h3 .mod_links { opacity: 0.0; }
	.ipsSideBlock h3:hover .mod_links { opacity: 1; }

.status_list .status_list { margin: 10px 0 0 50px; }
.status_list p.index_status_update { line-height: 120%; margin:4px 0px; }
.status_list li { position: relative; }
.status_reply {
	margin-top: 8px;
}

.status_list li .mod_links { 
	opacity: 0.1;
	-webkit-transition: all 0.4s ease-in-out;
	-moz-transition: all 0.4s ease-in-out;
}
.status_list li:hover .mod_links { opacity: 1; }

/* board stats */
#board_stats ul { text-align: center; }
	#board_stats li { margin-right: 20px; }
	#board_stats .value {
		display: inline-block;
		background: #e2e2e2;
		color: #4a4a4a;
		padding: 2px 6px;
		font-weight: bold;
		-moz-border-radius: 2px;
		-webkit-border-radius: 2px;
		border-radius: 2px;
		margin-right: 3px;
	}

.statistics {
	margin: 20px 0 0 0;
	padding: 10px 0;
	border-top: 3px solid #d8d8d8;
	line-height: 1.3;
	overflow: hidden;
}

        .statistics p { font-size: 12px }
	.statistics_head {
		font-size: 14px;
		font-weight: bold;
	}

.friend_list ul li,
#top_posters li {
	text-align: center;
	padding: 8px 0 0 0;
	margin: 5px 0 0 0;
	min-width: 80px;
	height: 70px;
	float: left;
}

	.friend_list ul li span.name,
	#top_posters li span.name {
		font-size: 0.8em;
	}
	
#hook_watched_items ul li {
	padding: 8px;
}

	body#ipboard_body #hook_watched_items fieldset.submit {
		padding: 8px;
	}
	
#hook_birthdays .list_content {
	padding-top: 8px;
}

#hook_calendar .ipsBox_container { padding: 10px; }
#hook_calendar td, #hook_calendar th { text-align: center; }
#hook_calendar th { font-weight: bold; padding: 5px 0;}

/************************************************************************/
/* FORUM VIEW (& RELATED) STYLES */

#more_topics {
	text-align: center;
	font-weight: bold;
}
	#more_topics a { display: block; padding: 10px 0;}

	/* Result of the 'load more topics' link */
	.dynamic_update { border-top: 2px solid #b3b3b3; }

.topic_preview,
ul.topic_moderation {
	margin-top: -2px;
	z-index: 300;
}
	ul.topic_moderation li {
		float: left;
	}
	
	.topic_preview a,
	ul.topic_moderation li a {
		padding: 0 3px;
		display: block;
		float: left;
	}

span.mini_rate {
	margin-right: 12px;
	display: inline-block;
}

img.mini_rate {
	margin-right: -5px;
}

/************************************************************************/
/* TOPIC VIEW (& RELATED) STYLES */

/* Post share pop-up */
#postShareUrl { width: 95%; font-size: 18px; color: #999; }
 #postShareStrip { height: 35px; margin: 10px 0px 0px 30px; }

body .ip { color: #333; }
span.post_id { margin-left: 4px; }
input.post_mod { margin:12px 5px 0px 10px; }

.post_id a img.small {
	max-height: 12px;
	margin-left: 3px;
	margin-top: -2px;
	opacity: 0.5;
}

.signature {
	clear: right;
	color: #a4a4a4;
	font-size: 0.9em;
	border-top: 1px solid #d5d5d5;
	padding: 10px 0;
	margin: 6px 0 4px;
	position: relative;
}

	.signature a { text-decoration: underline; }

.post_block {
	position: relative;
}

	.post_block.no_sidebar {
		background-image: none;
	}
	
	.post_block.solved {
		background-color: #eaf8e2;
	}
	
	.post_block.feature_box {
		background-color: #eaf8e2;
		border:1px dotted #333;
		padding: 6px;
		min-height: 60px;
		word-wrap: break-word;
	}
	
	.post_block.feature_box .ipsType_sectiontitle {
		border-color: #ddd;
		font-size: 12px;
	}
	
	.post_block h3 {
		background: #e6e6e6;
		padding: 0 10px;
		height: 36px;
		line-height: 36px;
		font-weight: normal;
		font-size: 16px;
	}
	
	.post_wrap { top: 0px; }	

.post_body {
	margin: 0 10px 0 185px;
	padding-top: 15px;
}
	
	.post_body .post {
		line-height: 1.6;
		font-size: 14px;
		word-wrap: break-word;
	}
	
	.post_block.no_sidebar .post_body { margin-left: 10px !important; }
	
.posted_info {
	padding: 0 0 10px 0;
}

	.posted_info strong.event {
		color: #373737;
		font-size: 1.2em;
	}

.post_ignore {	
	background: #fbfbfb;
	color: #777;
	font-size: 0.9em;
	padding: 15px;	
}

	.post_ignore .reputation {
		text-align: center;
		padding: 2px 6px;
		float: none;
		display: inline;
	}

.rep_bar {
	white-space: nowrap;
	margin: 6px 4px;
}

	.rep_bar .reputation {
		font-size: 10px;
		padding: 2px 10px !important;
	}
		
p.rep_highlight {
	float: right;
	display: inline-block;
	margin: 5px 10px 10px 10px;
	background: #e4e4e4;
	color: #2f2f2f;
	padding: 5px;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	border-radius: 5px;
	font-size: 0.8em;
	font-weight: bold;
	text-align: center;
}

	p.rep_highlight img {
		margin-bottom: 4px;
	}

.edit {
	padding: 2px 0 0 24px;
	background: url({style_images_url}/icon_warning.png ) no-repeat left 4px;
	font-size: 12px;
	margin-top: 15px;
	line-height: 14px;
	color: #7c7c7c;
}

.poll fieldset {
	padding: 9px;
}

.poll_question {
	padding: 10px;
	margin: 10px 10px 10px 20px;
}

	.poll_question h4 {
		background-color: #f0f0f0;
		margin: 0 -7px;
		padding: 5px;
	}

	.poll_question ol {
		padding: 8px;
		background-color: #fbfbfb;
	}
	
	.poll_question li {
		font-size: 0.9em;
		margin: 6px 0;
	}
	
	.poll_question .votes {
		margin-left: 5px;
	}
	
.snapback { 
	margin-right: 5px;
	padding: 1px 0 1px 1px;
}

.rating { display: block; margin-bottom: 4px; line-height: 16px; } 
	.rating img { vertical-align: top; }
#rating_text { margin-left: 4px; }
	
/************************************************************************/
/* POSTING FORM (& RELATED) STYLES */

div.post_form label {
	text-align: right;
	padding-right: 15px;
	width: 275px;
	float: left;
	clear: both;
}

	div.post_form span.desc,
	fieldset#poll_wrap span.desc {
		margin-left: 290px;
		display: block;
		clear: both;
	}

	div.post_form .checkbox input.input_check,
	#mod_form .checkbox input.input_check {
		margin-left: 295px;
	}
	
	div.post_form .antispam_img {
		margin-left: 290px;
	}
	
	div.post_form .captcha .input_text {
		float: left;
	}
	
	div.post_form fieldset {
		padding-bottom: 15px;
	}

	div.post_form h3 {
		margin-bottom: 10px;
	}
	
fieldset.with_subhead {
	margin-bottom: 0;
	padding-bottom: 0;
}

	fieldset.with_subhead h4 {
		text-align: right;	
		margin-top: 6px;
		width: 300px;
		float: left;
	}

	fieldset.with_subhead ul {
		border-bottom: 1px solid #e5e5e5;
		padding-bottom: 6px;
		margin: 0 15px 6px 320px;
	}

	fieldset.with_subhead span.desc,
	fieldset.with_subhead label {
		margin: 0;
		width: auto;
	}

	fieldset.with_subhead .checkbox input.input_check {
		margin-left: 0px;
	}

#toggle_post_options {
	background: transparent url({style_images_url}/add.png) no-repeat;
	font-size: 0.9em;
	padding: 2px 0 2px 22px;
	margin: 15px;
	display: block;
}

#poll_wrap .question {
	margin-bottom: 10px;
}

		#poll_wrap .question .wrap ol {
			margin-left: 25px; 
			list-style: decimal;
		}
			#poll_wrap .question .wrap ol li {
				margin: 5px;
			}
	
.question_title { margin-left: 30px; padding-bottom: 0; }
	.question_title .input_text { font-weight: bold }

#poll_wrap { position: relative; }
#poll_footer { }
#poll_container_wrap { overflow: auto; }
#poll_popup_inner { overflow: hidden; }

.poll_control { margin-left: 20px; }
.post_form .tag_field ul { margin-left: 290px; }

/************************************************************************/
/* ATTACHMENT MANAGER (& RELATED) STYLES */

.swfupload {
	position: absolute;
	z-index: 1;
}
	
#attachments { }

	#attachments li {
		background-color: #f0f0f0;
		border: 1px solid #e5e5e5;
		padding: 6px 20px 6px 42px;
		margin-bottom: 10px;
		position: relative;
	}
	
		#attachments li p.info {
			color: #757575;
			font-size: 0.8em;
			width: 300px;
		}
	
		#attachments li .links, #attachments li.error .links, #attachments.traditional .progress_bar {
			display: none;
		}
			
			#attachments li.complete .links {
				font-size: 0.9em;
				margin-right: 15px;
				right: 0px;
				top: 12px;
				display: block;
				position: absolute;
			}
			
		#attachments li .progress_bar {
			margin-right: 15px;
			width: 200px;
			right: 0px;
			top: 15px;
			position: absolute;
		}
	
		#attachments li.complete, #attachments li.in_progress, #attachments li.error {
			background-repeat: no-repeat;
			background-position: 12px 12px;
		}
	
		#attachments li.in_progress {
			background-image: url({style_images_url}/loading.gif);
		}
	
		#attachments li.error {
			background-image: url({style_images_url}/exclamation.png);
			background-color: #e8caca;
			border: 1px solid #ddafaf;
		}
		
			#attachments li.error .info {
				color: #8f2d2d;
			}
	
		#attachments li.complete {
			background-image: url({style_images_url}/accept.png);
		}
		
		#attachments li .thumb_img {
			left: 6px;
			top: 6px;
			width: 30px;
			height: 30px;
			overflow: hidden;
			position: absolute;
		}
		
.attach_controls {
	background: url({style_images_url}/icon_attach.png ) no-repeat 3px top;
	padding-left: 30px;
	min-height: 82px;
}

	.attach_controls .ipsType_subtitle { margin-bottom: 5px; }
	.attach_controls iframe { display: block; margin-bottom: 5px; }
	
.attach_button { font-weight: bold;  }
#help_msg {	margin-top: 8px; }

#attach_wrap {
	/*background: #eef3f8;
	padding: 6px;*/
	margin-top: 10px;
	overflow: hidden;
}

	#attach_wrap h4 {
		font-size: 16px;
		padding-left: 0px;
	}
	
	#attach_wrap ul { list-style-type: none; margin-left: 0px; }
	
	#attach_wrap li {
		margin: 5px 0;
		vertical-align: bottom;
		display: inline-block;
	}
		#attach_wrap .attachment {
			float: none;
		}
		
		#attach_wrap .desc.info {
			margin-left: 24px;
		}

#attach_error_box {	margin-bottom: 10px; }

.resized_img {
	margin: 0 5px 5px 0;
	display: inline-block;
}

/************************************************************************/
/* REPUTATION STYLES */

.reputation {
	font-weight: bold;
	padding: 3px 8px;
	display: inline-block;
	-moz-border-radius: 3px;
	-webkit-border-radius: 3px;
	border-radius: 3px;
}
	
	.reputation.positive, .members li.positive {
		background: #6f8f52;
	}
	
	.reputation.negative, .members li.negative {
		background: #b82929;
	}
	
	.reputation.positive, .reputation.negative {
		color: #fff;
	}
	
	.reputation.zero {
		background: #dedede;
		color: #6e6e6e;
	}


.status_main_content { white-space: break-word; }

.status_main_content h4 {
	font-weight:normal;
	font-size:1.2em;
}

.status_main_content h4 .su_links a { font-weight: normal; }

.status_main_content p {
	padding: 6px 0px 6px 0px;
}

.status_main_content h4 a {
	font-weight:bold;
	text-decoration: none;
}

.status_mini_wrap {
	padding: 7px;
	font-size: 0.95em;
	margin-top: 2px;
}
.status_mini_photo {
	float: left;
}


.status_textarea {
	width: 99%;
}

.status_replies_many {
	height: 300px;
	overflow: auto;
}

	
.status_update {
	background: #c6c6c6;
	color: #fff;
	padding: 15px 12px;
}

	.status_update .input_text { width: 70%; padding: 6px 4px; }
	.status_update .status_inactive { color: #bbbbbb; }	
	#status_wrapper h4 { font-weight: bold; font-size: 14px; }
	.status_content { line-height: 1.4; }
	.status_content .mod_links { opacity: 0.2; }
	.status_content:hover .mod_links { opacity: 1; }
	.status_content .h4, .status_content .status_status { font-size: 14px; word-wrap: break-word; }
	.status_feedback { margin: 10px 0 0 -10px; }
		.status_feedback .row2 { margin-bottom: 1px; }

#about_me img {
	max-width: 100%;
}

/* Favorites */
.ips_like {
	background-color: #f8f8f8;
	padding: 8px 4px 4px 4px;
	color: #878787;
	font-size: 1em;
	min-height: 18px;
	font-size: 0.9em;
	line-height: 130%;
	clear: both;
}
.ips_like a {
	color: #878787;
}

.ips_like a.ftoggle {
	float: right;
	/*background: #f0f0f0 url({style_images_url}/icons/thumb_up.png) no-repeat left 2px;*/
	border:1px solid #CBCBCB;
	padding: 3px 4px 2px 4px;
	color: #656565;
	font-size:0.8em;
	text-decoration: none;
	-webkit-border-top-left-radius: 4px;
	-webkit-border-top-right-radius: 4px;
	-webkit-border-bottom-left-radius: 4px;
	-webkit-border-bottom-right-radius: 4px;
	margin-top: -4px;
}

.ips_like a.ftoggle.on {
	/*background: #f0f0f0 url({style_images_url}/icons/fave_on_small.png) no-repeat left 2px;*/
	margin-left: 3px;
}

.ips_like a.ftoggle._newline,
.ips_like a.ftoggle.on._newline {
	float:none;
	margin-top: 5px;
	margin-left: auto;
	margin-right: 0;
	display: block;
	width: 70px;
	text-align: center;
}

.ips_like a:hover.ftoggle.on,
.ips_like a:hover.ftoggle {
	background-color: #e5e5e5;
}

.facebook-like { margin-top: 5px; }

.boxShadow {
	-webkit-box-shadow: rgba(0, 0, 0, 0.58) 0px 12px 25px;
	-moz-box-shadow: rgba(0, 0, 0, 0.58) 0px 12px 25px;
	box-shadow: rgba(0, 0, 0, 0.58) 0px 12px 25px;
}

/* New notification panel */
#ipsGlobalNotification {
	position: fixed;
	left: 50%;
	margin-left: -250px;
	top: 20px;
	text-align: center;
	font-weight: bold;
	z-index: 10000;
}

#ips_NotificationCloseButton {
	background: transparent url({style_images_url}/close_popup.png) no-repeat top left;
	opacity: 0.8;
	width: 13px;
	height: 13px;
	top: 5px;
	left: 5px;
	position: absolute;
	cursor: pointer;
}

.googlePlusOne {
	display: inline-block;
	vertical-align:middle;
	margin-top: 1px;
}

.fbLike {
	float: right !important;
	padding-left: 2px;
	max-height: 50px;
	overflow: hidden;
}
/************************************************************************/
/* SHARED MEDIA STYLES */

#mymedia_inserted {
	position: absolute;
	top: 100px; left: 50%;
	margin-left: -200px;
	width: 400px;
	padding: 20px 0;
	background: black;
	font-size: 15px;
	font-weight: bold;
	color: #fff;
	z-index: 20000;
	text-align: center;
	-moz-border-radius: 4px;
	-webkit-border-radius: 4px;
	border-radius: 4px;
}

#mymedia_toolbar { 
	position: absolute;
	bottom: 0; left: 0;	right: 0;
	height: 42px;
	line-height: 42px;
	padding: 0 5px;
	background: #eee;
	background: -moz-linear-gradient(top, #eee 0%, #e2e2e2 100%); /* firefox */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#eee), color-stop(100%,#e2e2e2)); /* webkit */
	-webkit-box-shadow: 0px 1px 1px 0px rgba(255,255,255,0.5) inset;
	-moz-box-shadow: 0px 1px 1px 0px rgba(255,255,255,0.5) inset;
	box-shadow: 0px 1px 1px 0px rgba(255,255,255,0.5) inset;
	border-top: 1px solid #eee;
}

#mymedia_finish { position: absolute; right: 5px; top: 5px; }
#mymedia_content { height: 339px; overflow: auto; }

.media_results li.result {
	width: 20%;
	height: 100px;
	padding: 15px 0;
	float: left;
	text-align: center;
	cursor: pointer;
	-moz-border-radius: 4px;
	-webkit-border-radius: 4px;
	border-radius: 4px;
}

	.media_results li:hover { 
		background: #F9F9F9;
		background: -moz-linear-gradient(top, #F9F9F9 0%, #EDEDED 100%);
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#F9F9F9), color-stop(100%,#EDEDED));
	}
	.media_results li:active { 
		background: #EDEDED;
		background: -moz-linear-gradient(top, #EDEDED 0%, #F9F9F9 100%);
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#EDEDED), color-stop(100%,#F9F9F9));
	}
	
	.media_image {
		padding: 1px;
		border: 1px solid #d5d5d5;
		margin-bottom: 5px;
	}

/********************************************************/
/* Template Error										*/	

.templateError {
	background: #ffffff !important;
	color: #000000 !important;
	padding: 10px !important;
	border: 1px dotted black !important;
	margin: 0px !important;
}
	
/********************************************************/
/* ModCP styles											*/

.modcp_post_controls { padding-bottom: 15px; }
.modcp_post_controls .ipsButton_secondary { opacity: 0.5; }
.post_body:hover .modcp_post_controls .ipsButton_secondary { opacity: 1; }

#modcp_content .ipsFilterbar li.active a {
	margin-bottom: 1px;
	display: inline-block;
}

/********************************************************/
/* Advertisements from Nexus							*/

.nexusad { padding: 10px; clear: both; }

#bbcode-description {
	color: #666 !important;
	white-space: normal !important;
	word-wrap: break-word;
}

/********************************************************/
/* iPad Specific									*/
@media only screen and (device-width: 768px) {
	table.ipb_table .expander,
	table.ipb_table .ipsModMenu { visibility: visible; opacity: 0.2; }
	.post_block .post_controls { opacity: 1 !important;	}
}

#postShareStrip .fb-like
{
	height: 20px;
    overflow: hidden;
}


/* NEW FORMS */

.ipsField .ipsField_title { 
	font-weight: bold;
	font-size: 15px;
}

.ipsForm_required {
	color: #ab1f39;
	font-weight: bold;
}

.ipsForm_horizontal .ipsField_title {
	float: left;
	width: 185px;
	padding-right: 15px;
	text-align: right;
	line-height: 1.8;
}

.ipsForm_horizontal .ipsField { margin-bottom: 15px; }
.ipsForm_horizontal .ipsField_content, .ipsForm_horizontal .ipsField_submit { margin-left: 200px; }
.ipsForm_horizontal .ipsField_checkbox { margin: 0 0 5px 200px; }
.ipsForm_horizontal .ipsField_select .ipsField_title { line-height: 1.6; }

.ipsForm_vertical .ipsField { margin-bottom: 10px; }
.ipsForm_vertical .ipsField_content { margin-top: 3px; }

.ipsForm .ipsField_checkbox .ipsField_content { margin-left: 25px; }
.ipsForm .ipsField_checkbox input { float: left; margin-top: 3px; }

.ipsField_primary input { font-size: 18px; }

.ipsForm_submit {
	background: #e4e4e4;
	background: -moz-linear-gradient(top, #e4e4e4 0%, #cccccc 100%);
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#e4e4e4), color-stop(100%,#cccccc));
	padding: 5px 10px;
	text-align: right;
	border-top: 1px solid #cccccc;
	margin-top: 25px;
}

.ipsForm_right { text-align: right; }
.ipsForm_left { text-align: left; }
.ipsForm_center { text-align: center; }


/*######################swright */

/*header banner*/
div.main_width {max-width:1240px; min-width:980px;} 

/*div#logo {max-width:1240px; min-width:980px;  width:100%; }*/
div#logo {max-width:1240px; min-width:980px;  width:100%; }

div#branding div.nexusad {position:relative; padding:0; text-align:right; top:-8px; left:10px; }
/*div#header_banner {position: relative; display:block; width:100%!important; background:yellow; text-align:right!important;}*/

 div.header_banner {position:absolute; right:0px; top:15px;} 


 /*header banner*/

/*home sidebar*/
div#content div.ipsLayout_right div.nexusad {position: relative; padding:0; text-align:center; }

div#homepage-content {width:100%;  }

/*top navigation menu tabs*/
div#primary_nav {position:relative; top:-3px;  }
div#primary_nav ul.ipsList_inline li a { font-family:"Raleway", arial, sans-serif; padding:7px 8px;} 
div#primary_nav ul.ipsList_inline li.isIt a:hover, ul.ipsList_inline li#nav_explore a:hover {color:#6d8682; }  
div#primary_nav ul.ipsList_inline li.isIt.active a {color:#6d8682; background:#dceeea;}   
ul#community_app_menu li a { padding:7px 8px;}
 
/*flowers background
ul#community_app_menu li.active { background: url({style_images_url}/nav_active.png) no-repeat right; z-index:100;} 
ul#community_app_menu li a:hover {background: #dceeea;} 

div#board_index.ipsLayout.ipsLayout_largeright.clearfix div#categories.ipsLayout_content.clearfix div.category_block.block_wrap {padding:0; margin:0; background:pink;} 
  */  
  
div#board_index.ipsLayout.ipsLayout_largeright.clearfix div#categories {padding:0; margin:0; width:100%;}  

 
input#main_search {width:480px; height:26px; font:normal 16px arial; color:#333;}

ul.ipsList_inline.ipsType_small li a, ul.ipsList_inline.ipsType_smaller li a {color:#fff; text-shadow:none; }

ul.ipsList_inline.ipsType_small li.active a, ul.ipsList_inline.ipsType_smaller li.active a {color:#fff; text-shadow:none; }

#message_list .maintitle, h3.maintitle, div.maintitle.ipsFilterbar, div.category_block.block_wrap h3.maintitle, div.ipsLayout_content h2.maintitle, div.maintitle.clear.clearfix , div.ipsLayout_content h3.maintitle, div.vcard.userpopup h3, div.ipsSideBlock.clearfix h3, h2.maintitle, #messenger_utilities h3, #pm_popup_popup h3, #navigation_popup_inner h3, caption.maintitle, .popupWrapper h3, #inline_login_form h3, form#register h1.maintitle, div#register_form h1.maintitle
{color:#fff; background:#84a5b8; border:none!important; height:25px;  padding:8px 0 0 10px; text-shadow:none; box-shadow:none; } /*   5d533a 84a5b8*/  
 
div.vcard.userpopup {min-height:230px; } 
div.vcard.userpopup div.side {position:absolute; top:72px;}
 
div.maintitle.ipsFilterbar li a {text-shadow:none; -webkit-transition:none; opacity:10;}
div.maintitle.ipsFilterbar li a:hover {text-decoration:underline;}

ul.ipsList_inline.right {margin-right:10px;}

h3.maintitle {color:#fff; height:20px;  padding:3px 10px; border:none!important;}

div.category_block.block_wrap div.ipsBox.table_wrap div.ipsBox_container {border:none!important;}

.gallery_album_info ul.ipsList_inline.right.ipsType_smaller li a {color:#333;} 

#sidebar-buttons {margin:0px auto; width:100%}
#sidebar-buttons .column  {float:left; margin:0; width:50%;}
/* a.bbc_url {display:none;} */

#fcgroup_1 div.desc em {font:normal 14px arial;}
/*#fcgroup_1 .viewport {background:#999;}*/

/*a.ipsUserPhotoLink {display:none; position:absolute;}*/
div.ipsBox_withphoto, div.ipsBox_withphoto.ipsGallery_h1image {margin:0; padding:0;}

/*h1.ipsType_pagetitle, h2.ccsBlockTitle {color:#B76B46!important; font-size:20px;}*/
h2.ccsBlockTitle {padding-left:0px!important;}

ul li h3 {font-size:18px;}

/*div.main_width, div#content {width:1220px;}*/

div.ccsText_block, p {font-size:12px;} 

div#secondary_navigation {margin:0; }  
div#secondary_navigation a {font-size:11px; }

td#homepage-content {position:relative; top:-15px; }

/*d#homepage-content h1:nth-child(2), td#homepage-content div.ccsBase.ccsTopicList {position:relative; top:-35px; }*/

div#statusHook h3 {text-align:left;}

div.error.message {clear:both; margin-bottom:15px!important; font-size:14px; color:#000; background:#e1e9d7; border:solid 1px #84a5b8;}

div.sideblock2 {position:relative;   right:0; width:300px;}

div.fsideblock {position:relative; top:-10px; left:-10px; width:300px;}

div#bdwhomefeat {width:435px; display:block; margin:2px; float:left; border:solid 1px #e0e0e0; padding:4px;}

div#categories.ipsLayout_content.clearfix {width:97%;}

div#index_stats.ipsLayout_right.clearfix {width:300px;} 

p.desc.member_title, li.group_title {display:none;}
li.group_icon {margin-top:3px;}

/*td.cke_contents textarea.cke_source.cke_enable_context_menu, td.cke_contents, table.cke_editor {width:1145px!important; }*/

/*span.desc.lighter.blend_links {color:#666;}*/

/*forum sidebar*/
#forumwrap {position:relative; min-height:650px;}
#forumcontent {padding-right:310px;}
#forumside {position:absolute; width:300px; margin:0 0 20px 0; right:0px; }  

#profile_content_main .rating {display:none;}

div#logo a#blog_title {display:none;}


/*wedding tips*/
#homepage-content #category_list {} 


body#ipboard_body.minimal div#content.clearfix {width:800px!important; background:#f8f8f8;}   

div.quote-container, div.post.entry-content table .alt2, .post_body table .alt2, .post_block table .alt2 {background:#f4f4f4; padding:5px 5px 5px 10px; margin-bottom:5px; border:solid 1px #d8d6d6;}   

ul.ipsComment_controls.ipsList_inline.ipsType_smaller li a.ipsButton_secondary.reply_comment, ul.ipsComment_controls a.edit_comment, ul.ipsComment_controls a.hide_comment, ul.ipsComment_controls li a.delete_comment {color:#333!important;}  

/*@media (max-width: 320px) { .responseh{display:none;}} 
div#secondary_navigation {display:none;} 
@media only screen and (max-width: 479px){ .responseh { width:350px!important; } .hide {display:none;}}
*/

div.ipsBox_withphoto {margin-left: 65px;}  

#sponsor-buttons {background:#fff; padding:5px; margin:5px 0; }
.buttonad {margin:5px 0; border:solid 1px #999; width:120px; height:60px;}  

ul#stat_links li a {color:#555;}  

/*IE8 */
html>/**/body #user_navigation #register_link { position:relative; left:75px\9; } 
/*IE9 */
:root #user_navigation #register_link { position:relative; left:0px; } 

abbr.published.date.updated {font-size:12px;}

div.ccsText_block, p, .post_body .post  {font-size:14px;} 

div.bx-viewport {border:none!important; margin:0;}

li.ccsClearfix.ccsPad_small, ul.hfeed li.hentry {padding:3px 0;} 

.review_summary h2 { margin-bottom:5px;} 
.review_summary h2 a {font:bold 14px arial; color:#B76B46; }  
.review_summary p {color:#888;} 

h1.pcat {font:normal 18px arial; color:#adadad;}   


#secondary_navigation .breadcrumb.top li span {
    background: url(../img/sprite_icons.png) no-repeat 2px -18px;
    width: 7px;
    height: 6px;
    padding: 1px 2px 0 2px; 
}


/*#####################################end swright*/


/*-- Content Styles --*/
.ccsBlock {
    margin-bottom: 25px;
}

#content .ccsBase.ccsBlock .ccsBlockTitle {
background: none;
color: #b76b46;
font-size: 22px;
line-height: 1.1em;
border-bottom: 2px solid #DDD;
margin-bottom: 10px;
padding-bottom: 4px;
}

#featured_articles li {
    margin-bottom: 20px;
}

#featured_articles li.last {
    margin-bottom: 0;
}

#featured_articles .thumbnail {
    float: left;
    margin-right: 15px;
    height: 150px;
    overflow: hidden;
}

#featured_articles .thumbnail img {
    width: 200px;
}

#featured_articles h3 {
    font-size: 20px;
    line-height: 1.2em;
    margin-bottom: 10px;
}

#featured_articles p {
    font-size: 16px;
    line-height: 1.2em;
}
/*--/ Content Styles --*/


div.ccsBase.ccsBlock {margin:0; padding:0; }

#cat-rating {margin:20px 0 0 0; }
#cat-rating .score {font-weight:bold;}

#globalfooter {margin:0; padding:10px 0; background: #635a42; height:350px; max-width:1260px; } 
#footer-table {color:#fff; margin:0 20px 20px 20px;}
#footer-table a {color:#dbede9; text-decoration: none;}
#footer-table a:hover { text-decoration:underline;}

#globalfooter h3 {color:#d6ccb8;}

#globalfooter .copy-foot {color:#d7d7d7;}

/*siteskin start*/
/*
body {background: url(/public/style_images/siteskin/background-hr-pc.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
background-color:#2f5391;
}
div#branding {background-image:url(/public/style_images/siteskin/branding_bg-siteskin.png);}


li#nav_app_forums.active a, li#nav_app_ccs.active a, li#nav_menu_1.active a, li#nav_menu_7.active a, li#nav_menu_5.active a {background:#f2e2d3; color:#333; text-shadow:none!important; border-bottom:solid 2px #f2e2d3; border-top:solid 1px #fff; border-left:solid 1px #fff; border-right:solid 1px #fff;}
li#nav_menu_6.active a, li#nav_app_gallery.active a, li#nav_app_blog.active a, li#nav_explore.active a {background:#babec9; color:#333; text-shadow:none!important; border-bottom:solid 2px #babec9; border-top:solid 1px #fff; border-left:solid 1px #fff; border-right:solid 1px #fff;}
#user_navigation a#user_link {background:#babec9; color:#333; text-shadow:none;}


li#nav_app_forums.active a, li#nav_app_ccs.active a, li#nav_menu_1.active a, li#nav_menu_7.active a, li#nav_menu_5.active a {background:#728fde; color:#fff; text-shadow:none!important; border-bottom:solid 2px #728fde; border-top:solid 1px #fff; border-left:solid 1px #fff; border-right:solid 1px #fff;}
li#nav_menu_6.active a, li#nav_app_gallery.active a, li#nav_app_blog.active a, li#nav_explore.active a {background:#4183e4; color:#fff; text-shadow:none!important; border-bottom:solid 2px #4183e4; border-top:solid 1px #fff; border-left:solid 1px #fff; border-right:solid 1px #fff;}
#user_navigation a#user_link {background:#babec9; color:#333; text-shadow:none;}
#user_navigation a {color:#fff; text-shadow:none;}

#spotlight { padding:0 15px;}
#spotlight h1 {color: #B76B46; font-size: 22px; margin-bottom:5px;}
h2.fresort{font:bold 14px arial; color:#B76B46; margin:0 0 5px 7px;}
*/
/*siteskin end*/
body {overflow-y: scroll; overflow-x: hidden;}

@media only screen and (max-width : 1220px){ 
div.ccsArticles_block.ccsClearfix.ccsRow_2.responseh:last-child {display:none;}
}

@media only screen and (max-width : 768px){ 
.tablethider {display:none;}
div#reviews .ipsPad_half.left.mobile, div#reviews .ipsPad_half.right.mobile {width: 100%;}
div#logo {min-width:135px!important;}
#footer-table {max-width:500px;}
}

@media only screen and (max-width : 640px){ 
.mobilehider {display:none;}
div#reviews .ipsPad_half.left, div#reviews .ipsPad_half.left.mobile, div#reviews .ipsPad_half.right.mobile {width: 100%;}
#rev-procon {max-width:350px!important;}
div#logo {min-width:135px!important;}
#footer-table {max-width:340px;}
}

#ipsTags_tagdropdown.ipsTagBox_dropdown {height:400px!important; }

ul.ipsList_withminiphoto li.clearfix div.list_content a img, #cblock_recent ul.ipsList_withminiphoto li.clear div.list_content.clearfix a img {display:none;}
div.list_content, div.list_content a {font-size:12px;}

.ipsType_pagetitle, .ipsType_subtitle {font-size:20px;}


]]></css_content>
    <css_position>1</css_position>
    <css_app>core</css_app>
    <css_app_hide>0</css_app_hide>
    <css_attributes><![CDATA[title="Main" media="screen,print"]]></css_attributes>
    <css_modules/>
    <css_removed>0</css_removed>
    <css_master_key/>
  </cssfile>
</css>

--------------------------------------------------------------------------------
> Time: 1423791453 / Fri, 13 Feb 2015 01:37:33 +0000
> URL: /admin/index.php?adsess=65123953941da2af08bd12daeafb73df&app=core&&module=templates&section=importexport&do=exportSet
> CSS Export: forums

--------------------------------------------------------------------------------
> Time: 1423791453 / Fri, 13 Feb 2015 01:37:33 +0000
> URL: /admin/index.php?adsess=65123953941da2af08bd12daeafb73df&app=core&&module=templates&section=importexport&do=exportSet
> CSS Export: gallery

--------------------------------------------------------------------------------
> Time: 1423791453 / Fri, 13 Feb 2015 01:37:33 +0000
> URL: /admin/index.php?adsess=65123953941da2af08bd12daeafb73df&app=core&&module=templates&section=importexport&do=exportSet
> CSS Export: blog
<?xml version="1.0" encoding="utf-8"?>
<css>
  <cssfile>
    <css_set_id>6</css_set_id>
    <css_updated>1393959458</css_updated>
    <css_group>ipblog</css_group>
    <css_content>/* TRACKBACKS */
#trackbacks {
	margin-left: 15px;
	margin-right: 10px;
}

#trackbacks .trackback {
	padding: 5px;
	margin: 8px;
	overflow: hidden;
	line-height: 150%;
	border-top: 1px solid #d5dde5;
	border-bottom: 1px solid #d5dde5;
}

#trackbacks .posted_date {
	display: block;
}

#trackbacks h4 {
	font-size: 1.1em;
	margin-bottom: -3px;
	clear: none !important;
}

/* CUSTOMIZATION */

#header_list {
	max-height: 200px;
	overflow: auto;
}

	#header_list ul li {
		padding: 10px;
	}

#theme_editor {
	padding-top: 5px;
}
	
#theme_editor strong {
	margin: 4px 2%;
	display: block;
	float: left;
}

	#theme_editor img.input_submit {
		float: right;
		margin-right: 3%;
	}

#theme_editor textarea {
	width: 94%;
	height: 200px;
	margin: 5px 2%;
}


/* BLOGS */

.mini_cal {
	border-top: 0;
}

.mini_cal th, .mini_cal td {
	font-size: 0.85em;
	text-align: center;
	padding: 6px;
}

	.mini_cal td {
		border: 1px solid #f1f4f7;
	}

table.mini_cal .cellHasEntry
{
	background-color: #FFFFE2;
	text-decoration: underline;
}

table.mini_cal .today
{
	text-decoration: underline;
}

/* Mini cal week day */

.cwd {
	font-weight: bold;
	font-style: italic;
	text-transform: lowercase;
}


/* New CSS IP.Blog 2.4 CSS */

#addentrylink_menucontent { min-width: 145px; }

.current_blog, .terms_confirm { font-weight: bold; }


.entry.featured .entry_header, .entry.featured .entry_footer { background-color: #f5faf7; }

.entry.private .entry_header, .entry.private .entry_footer { background-color: #f2e4e7 !important; }

.entry_header .ipsBadge {
	float: right;
	margin: 10px;
}

	.entry.featured .entry_header .ipsBadge,
	.entry.moderated .entry_header .ipsBadge,
	#main_column .entry_header .ipsBadge {
		margin-left: 0px;
	}

#entry_header_right .ipbmenu_content
{
	min-width: 170px;
}

.entry .entry_content {
	font-size: 14px;
	line-height: 1.6;
}

#main_column .entry_footer, #entry_data .entry_footer { margin-bottom: 0px !important; }

.entry_footer .ipsBadge { cursor: default; }

.cblock { 
	margin-bottom: 15px;
}
	
	.cblock .general_box { z-index: 2001; }
	
	.cblock.drop_zone {
		background: url({style_images_url}/trans_bg.png);
		border-radius: 10px;
		-moz-border-radius: 10px;
		-webkit-border-radius: 10px;
		padding-top: 10px;
		z-index: 2000;
	}
		
		.cblock.drop_zone.over { opacity: 0.5; }
	
	.cblock h3.draggable {
		cursor: move;
		display: block;
		font: normal 14px helvetica, arial, sans-serif;
		color: #204066;
		padding: 5px 10px;
		background: #DBE2EC;
	}
	
	.cblock .configure_link {
		margin: 0px 3px;
	}


/* POST FORM */

#formCatAddInput { width: 84%; }

#formCats { padding-bottom: 0px; }

	#formCats li { padding: 4px; }

#bf_timeToggle { padding-top: 0px; }
#bf_timeOpts, #bf_timeToggle { border-bottom: 1px solid #d5dde5; }


/* Drag and drop blocks */
#main_blog_wrapper #main_column,
#main_blog_wrapper #cblock_left,
#main_blog_wrapper #cblock_right {
	position: relative;
	float: left;
}

#main_blog_wrapper #cblock_left.cblock.temp { left: 0px !important; }
#main_blog_wrapper #cblock_right.cblock.temp { height: 700px; left: -300px !important; /* Left width */ }

#main_blog_wrapper.with_left { padding-left: 250px; /* Left width */ }
#main_blog_wrapper.with_right {	clear: left; padding-right: 300px; /* Right width */ }

#main_blog_wrapper #main_column { width: 100%; }

#main_blog_wrapper #cblock_left { width: 250px; /* Left width */ right: 250px; /* Left width */	margin-left: -100%; }
#main_blog_wrapper #cblock_right { width: 300px; /* Right width */ margin-right: -300px; /* Right width */ }

#main_blog_wrapper #cblock_right .general_box {	margin: 0 0 10px 10px; z-index: 2001; }
#main_blog_wrapper #cblock_left .general_box { margin: 0 10px 10px 0; z-index: 2001; }

#main_blog_wrapper .cblock.drop_zone {
	background: rgba(0,0,0,0.3);
	border-radius: 10px;
	-moz-border-radius: 10px;
	-webkit-border-radius: 10px;
	padding-top: 10px;
	z-index: 2000;
}

	#main_blog_wrapper .cblock.drop_zone.over {
		background: rgba(0,0,0,0.6);
	}
	
#main_blog_wrapper #cblock_left.drop_zone .general_box { margin: 5px !important; }
#main_blog_wrapper #cblock_right.drop_zone .general_box { margin: 5px !important; }

#main_blog_wrapper.webkit_fix {
	margin-left: 1px !important;
}

.blog_title { min-width: 120px; }

.col_b_icon {
	padding: 0 0 0 0 !important;
	width: 24px !important;
	text-align: center;
	
}</css_content>
    <css_position>1</css_position>
    <css_app>blog</css_app>
    <css_app_hide>1</css_app_hide>
    <css_attributes><![CDATA[title="Main" media="screen,print"]]></css_attributes>
    <css_modules/>
    <css_removed>0</css_removed>
    <css_master_key/>
  </cssfile>
</css>

--------------------------------------------------------------------------------
> Time: 1423791453 / Fri, 13 Feb 2015 01:37:33 +0000
> URL: /admin/index.php?adsess=65123953941da2af08bd12daeafb73df&app=core&&module=templates&section=importexport&do=exportSet
> CSS Export: reviews

--------------------------------------------------------------------------------
> Time: 1423791453 / Fri, 13 Feb 2015 01:37:33 +0000
> URL: /admin/index.php?adsess=65123953941da2af08bd12daeafb73df&app=core&&module=templates&section=importexport&do=exportSet
> CSS Export: convert

--------------------------------------------------------------------------------
> Time: 1423791453 / Fri, 13 Feb 2015 01:37:33 +0000
> URL: /admin/index.php?adsess=65123953941da2af08bd12daeafb73df&app=core&&module=templates&section=importexport&do=exportSet
> CSS Export: members
<?xml version="1.0" encoding="utf-8"?>
<css>
  <cssfile>
    <css_set_id>6</css_set_id>
    <css_updated>1386177712</css_updated>
    <css_group>ipb_messenger</css_group>
    <css_content>/************************************************************************/
/* IP.Board 3 CSS - By Rikki Tissier - (c)2008 Invision Power Services	*/
/************************************************************************/
/* ipb_messenger.css - Messenger styles									*/
/************************************************************************/

#messenger_utilities { width: 19%; }	

#messenger_content { width: 80%; }

	#messenger_content h2 {
		clear: none;
		font-size: 1.4em;
	}

#folder_list, #space_allowance,
#message_search, #participants,
#invite_more {
	position: relative;
}

#space_allowance p { line-height: 150%;}
#message_list {	clear: right; }
#message_compose .input_check {	margin-left: 245px;}
#invite_more_dialogue { display: none;}
#invite_more_dialogue ul { padding: 4px;}
#invite_more_autocomplete {	width: 99%; }

#folder_list li {
	margin-bottom: 8px;
	margin-left: 4px;
	padding: 0px;
}

	#folder_list #folders {
		margin-bottom: 12px;
	}

	#folder_list .total {
		background-color: #ebebeb;
		font-size: 0.75em;
		font-weight: bold;
		padding: 3px 6px;
		margin-right: 10px;
		right: 0;
		position: absolute;
	}

	#participants #participants_list span.name.left_convo a {
		color: #8a8a8a;
		font-style: italic;
	}

	#participants #participants_list span.name.blocked a {
		color: #ad2930;
	}

#space_allowance {
	clear: both;
}

li.new_folder {
	padding-left: 20px;
}

.add_folder.input_submit {
	padding: 1px 3px;
}

.edit_folders {
	background: #f7f7f7;
	font-size: 0.8em;
	font-weight: bold;
	margin-right: 2px;
	padding: 2px;
	right: 3px;
	position: absolute;
}

	.f_delete {
		color: #f00;
	}
	
.col_m_subject {
	width:40%;
}</css_content>
    <css_position>1</css_position>
    <css_app>members</css_app>
    <css_app_hide>1</css_app_hide>
    <css_attributes><![CDATA[title="Main" media="screen,print"]]></css_attributes>
    <css_modules>messaging</css_modules>
    <css_removed>0</css_removed>
    <css_master_key/>
  </cssfile>
</css>

--------------------------------------------------------------------------------
> Time: 1423791453 / Fri, 13 Feb 2015 01:37:33 +0000
> URL: /admin/index.php?adsess=65123953941da2af08bd12daeafb73df&app=core&&module=templates&section=importexport&do=exportSet
> CSS Export: nexus

--------------------------------------------------------------------------------
> Time: 1423791453 / Fri, 13 Feb 2015 01:37:33 +0000
> URL: /admin/index.php?adsess=65123953941da2af08bd12daeafb73df&app=core&&module=templates&section=importexport&do=exportSet
> CSS Export: autowelcome

--------------------------------------------------------------------------------
> Time: 1423791453 / Fri, 13 Feb 2015 01:37:33 +0000
> URL: /admin/index.php?adsess=65123953941da2af08bd12daeafb73df&app=core&&module=templates&section=importexport&do=exportSet
> CSS Export: cmtp

--------------------------------------------------------------------------------
> Time: 1423791453 / Fri, 13 Feb 2015 01:37:33 +0000
> URL: /admin/index.php?adsess=65123953941da2af08bd12daeafb73df&app=core&&module=templates&section=importexport&do=exportSet
> CSS Export: contactus

--------------------------------------------------------------------------------
> Time: 1423791453 / Fri, 13 Feb 2015 01:37:33 +0000
> URL: /admin/index.php?adsess=65123953941da2af08bd12daeafb73df&app=core&&module=templates&section=importexport&do=exportSet
> CSS Export: ccs
<?xml version="1.0" encoding="utf-8"?>
<css>
  <cssfile>
    <css_set_id>6</css_set_id>
    <css_updated>1415308397</css_updated>
    <css_group>ipcontent</css_group>
    <css_content><![CDATA[
.ipsLayout_content .subcat {
	margin-bottom: 10px;
	padding: 15px 0 10px;
	border-top: 1px solid #d8d8d8;
	overflow: hidden;
}

	.ipsLayout_content .subcat h2 {
		float: left;
		width: 180px;
		font-weight: normal;
	}
	
		.ipsLayout_content .subcat h2 .desc {
			display: block;
			margin-top: 10px;
		}
		
		.ipsLayout_content .subcat h2 img {
			vertical-align: middle;
			margin-right: 5px;
		}

		.ipsLayout_content .subcat h2 a {
			text-decoration: none;
		}

	.ipsLayout_content .subcat em.moderated {
		padding: 5px;
		-moz-border-radius: 4px;
		-webkit-border-radius: 4px;
		border-radius: 4px;
	}

.ipsLayout_content .children {
	overflow: hidden;
	font-size: 11px;
	margin-top: 8px;
	float: left;
	clear: left;
	max-width: 180px;
	margin-left: 20px;
	line-height: 130%;
}


.ipsLayout_content .pagelinks a {
	display: inline-block;
	text-decoration: none;
	margin-left: 5px;
	padding: 4px 7px 4px;
	-moz-border-radius: 4px;
	-webkit-border-radius: 4px;
	border-radius: 4px;
	font-size: 14px;
	font-weight: bold;
}

	.ipsLayout_content .pagelinks a:hover {
		text-decoration: none !important;
	}

.ipsLayout_content .links {
	display: inline-block;
}

.article-pages {
	overflow: hidden;
}

span.pagination.no_pages {
	display: none;
	height: 0px;
}



#recent_articles, #recent_comments {
	padding: 0px;
	overflow: hidden;
}

	#recent_articles h3, #recent_comments h3 {
		margin: 0px 0px 3px 0px;
	}

	#article_sidebar .block_list {
		padding-top: 0px;
	}

		#recent_articles .block_list li {
			padding-right: 10px;
		}

	#recent_comments .photo {
		float: left;
		margin-right: 8px;
	}

	#recent_comments .desc {
		font-size: 0.9em;
	}

#category_list .nav {
	padding: 0px;
	background: #f6f4f4;
	border-bottom: 1px solid #dadada;
	margin-bottom: 15px;
}

	#category_list .nav ul a {
		text-decoration: none;
		display: block;
		padding: 8px 12px;
	}

		#category_list .nav ul a:hover {
			background: #d5dde5;
		}

	#category_list .nav li {
		font-size: 12px;
		float: left;
	}
	
	#category_list .nav li.active {
		background: #fff;
		border: solid #dadada;
		border-width: 1px 1px 0 1px;
	}

/*		#category_list .nav ul ul {
			margin-top: 3px;
		}

			#category_list .nav ul ul li a {
				font-size: 11px;
				padding: 6px 12px 6px 25px;
			}*/
#category_list > ul {
	margin-bottom: 20px;
}

#category_list > ul li {
	float: left;
	margin: 0 7px;
}
#category_list > ul li .title {
	display: block;
}
#category_list > ul li.first {
	margin-left: 11px;
}
#category_list > ul li.last {
	margin-right: 11px;
}


/* Some misc/global styles */
 
.section_title, .post_form h2 {
	font-size: 22px !important;
	font-weight: bold;
	border-bottom: 2px solid #cbcbcb;
	padding-bottom: 3px;
	margin-bottom: 5px;
}

.add_link, .post_block .share_links a {
	display: inline-block;
	text-decoration: none;
	margin-left: 5px;
	padding: 4px 7px 4px;
	color: #fff;
	-moz-border-radius: 4px;
	-webkit-border-radius: 4px;
	border-radius: 4px;
	font-size: 11px;
	cursor: pointer;
}

	.add_link:hover, .post_block .share_links a:hover {
		text-decoration: none !important;
		color: #fff;
	}

.add_link {
	position: relative;
	top: -4px;
}

.desc {
	font-size: 11px;
	color: #858585;
} 

/* Videos system */

.videos {
	width: 78%;
}

#videos_latest {
	text-align: center;
}

	#videos_latest h2, #videos_recent h2 {
		text-align: left;
		font-size: 22px !important;
		font-weight: bold;
		border-bottom: 2px solid #cbcbcb;
		padding-bottom: 3px;
		margin-bottom: 5px;
	}

#videos_recent {
	clear: both;
	width: 100%;
	margin-top: 20px;
}

	.video_thumb {
		padding: 10px;
		width: 140px;
		height: 140px;
		overflow: hidden;
		margin: 10px 3px 3px 3px;
		float: left;
	}
		
		.video_thumb img {
			margin-bottom: 5px;
		}
		
		.video_thumb a {
			color: #30587f;
			font-size: 11px;
			font-weight: bold;
			text-decoration: none;
		}
		
		.video_thumb .time {
			color: #979797;
			font-size: 11px;
		}
		
		.video_thumb .rating {
			margin-top: 8px;
			display: inline-block;
		}

/* Mini calendar */
.mini_cal td, .mini_cal th {
	text-align: center;
	padding: 4px;
}

	.mini_cal th {
		font-weight: bold;
	}

/* Unpublished articles - give a diff color */
.unpublished, body .unpublished td,
.unpublished td.altrow, .post_block.unpublished,
body td.unpublished {
	background-color: #d5eaff;
}

	.unpublished, .unpublished a {
		color: #0056ff;
	}


.teaser {
	margin-bottom: 30px;
}

/* Block styles (overridden to match skin) */
.ccsBase {
	background: #fcfcfc;
}

.ccsBase .ccsBlockTitle {
	background: #DBE2EC;
	font: normal 14px helvetica, arial, sans-serif;
	color: #204066;
	padding: 8px 10px;
}

/* Backgrounds */
.ccsRow_1 { background: #fff !important; }
.ccsRow_2 { background: #f1f6f9 !important; }
.ccsRow_3 { background: #f7fbfc !important; }
.ccsRow_4 { }

/* Text */
.ccsText_light { color: #777777 !important; }


/* User photos */
.ccsUserPhoto { 
	border: 1px solid #d5d5d5 !important;
	-webkit-box-shadow: 0px 2px 2px rgba(0,0,0,0.1) !important; 
	-moz-box-shadow: 0px 2px 2px rgba(0,0,0,0.1) !important;
    box-shadow: 0px 2px 2px rgba(0,0,0,0.1) !important;
}

/* Social sharing */
.ipsForm .ipsField.ipsField_checkbox p.ipsField_content {
    margin-top: 3px;
}

	#article_list div.ipsBox {
		background: none;
		border-bottom: solid 1px #dedcd7;
		padding-bottom: 10px;
		margin-bottom: 10px;
	}

/* swright */
#article_tags, #article_tags a {font:normal 13px arial!important;}
#article_tags a:hover {color:#85b685; }
div#article_tags ul li.ipsPad_half.ipsType_smaller {padding:0!important;}


div#category_info.message.unspecific.clearfix {margin:0 0 5px 0;}
/* EME */
#category_info .pagination {
  padding: inherit !important;
  line-height: normal !important;
}


]]></css_content>
    <css_position>1</css_position>
    <css_app>ccs</css_app>
    <css_app_hide>1</css_app_hide>
    <css_attributes><![CDATA[title="Main" media="screen,print"]]></css_attributes>
    <css_modules/>
    <css_removed>0</css_removed>
    <css_master_key/>
  </cssfile>
</css>

--------------------------------------------------------------------------------
> Time: 1423791453 / Fri, 13 Feb 2015 01:37:33 +0000
> URL: /admin/index.php?adsess=65123953941da2af08bd12daeafb73df&app=core&&module=templates&section=importexport&do=exportSet
> CSS Export: featuredcontent

--------------------------------------------------------------------------------
> Time: 1423791453 / Fri, 13 Feb 2015 01:37:33 +0000
> URL: /admin/index.php?adsess=65123953941da2af08bd12daeafb73df&app=core&&module=templates&section=importexport&do=exportSet
> CSS Export: REST_Service

--------------------------------------------------------------------------------
> Time: 1423791453 / Fri, 13 Feb 2015 01:37:33 +0000
> URL: /admin/index.php?adsess=65123953941da2af08bd12daeafb73df&app=core&&module=templates&section=importexport&do=exportSet
> CSS Export: referrals

--------------------------------------------------------------------------------
> Time: 1423791453 / Fri, 13 Feb 2015 01:37:33 +0000
> URL: /admin/index.php?adsess=65123953941da2af08bd12daeafb73df&app=core&&module=templates&section=importexport&do=exportSet
> CSS Export: googlecse

--------------------------------------------------------------------------------
> Time: 1423791453 / Fri, 13 Feb 2015 01:37:33 +0000
> URL: /admin/index.php?adsess=65123953941da2af08bd12daeafb73df&app=core&&module=templates&section=importexport&do=exportSet
> CSS Export: sidebar

--------------------------------------------------------------------------------
> Time: 1423791453 / Fri, 13 Feb 2015 01:37:33 +0000
> URL: /admin/index.php?adsess=65123953941da2af08bd12daeafb73df&app=core&&module=templates&section=importexport&do=exportSet
> CSS Export: advancedtagsprefixes

--------------------------------------------------------------------------------
> Time: 1423791453 / Fri, 13 Feb 2015 01:37:33 +0000
> URL: /admin/index.php?adsess=65123953941da2af08bd12daeafb73df&app=core&&module=templates&section=importexport&do=exportSet
> CSS Export: sfs

--------------------------------------------------------------------------------
> Time: 1423791453 / Fri, 13 Feb 2015 01:37:33 +0000
> URL: /admin/index.php?adsess=65123953941da2af08bd12daeafb73df&app=core&&module=templates&section=importexport&do=exportSet
> CSS Export: calendar
<?xml version="1.0" encoding="utf-8"?>
<css>
  <cssfile>
    <css_set_id>6</css_set_id>
    <css_updated>1415896593</css_updated>
    <css_group>ipb_calendar</css_group>
    <css_content><![CDATA[/************************************************************************/
/* IP.Board 3 CSS - By Rikki Tissier - (c)2008 Invision Power Services	*/
/************************************************************************/
/* ipb_calendar.css - Calendar specific styles							*/
/************************************************************************/

.calendar_title { display: inline; float: left; }

#calendar_table { border-top: 0; }

	#calendar_table td {
		font-size: 0.9em;
		vertical-align: top;
		border: 1px solid #F1F4F7;
		padding: 5px;
		height: 95px;
		width: 14%;
                max-width: 14%;
                -ms-word-break: break-all;
                word-break: normal;
                word-break: break-word;
	}
		
		
		#calendar_table td.selected {
			background-color: #E2E9F0;
			-moz-box-shadow: 1px 1px 3px rgba(0,0,0,0.3) inset;
		}
		
		
		#calendar_table td.normal:hover { background: #EDF1F5; }
		
		
		#calendar_table td.blank {
			background: #dbe2e8;
			border-color: #dbe2e8;
		}
	
		#calendar_table td ul {	margin: 5px; }
	
	
	#calendar_table td.today {
		border: 2px solid #6f8f52;
		color: #6f8f52;
		background-color: #f1f6ec;
	}
	
#calendar_table td.col_cal_date {
	width: 7%;
	text-align: center;
	font-size: 30px;
}
#calendar_table td.col_cal_data { width: 100%; }

/* Mini calendars */
#mini_calendars { margin-top: 10px; }
#mini_calendars.two_wide .mini_cal_wrap { width: 460px; }
#mini_calendars.three_wide > div { width: 32%; }
#mini_calendars.three_wide > div.left:first-child { margin-right: 2%; }
#mini_calendars.three_wide > div.right { margin-left: 2%; }

.mini_cal_wrap { background: #fff; }
	.mini_cal_wrap h3 { margin: 10px 0 0 15px; }
	.mini_cal_wrap .ipsBox_container { 	min-height: 212px; }
	
.mini_cal {	margin-top: 10px; }
	.mini_cal td, .mini_cal th {
		text-align: center;
		width: 14%;
		font-size: 11px;
		height: 24px;
	}
	.mini_cal th { font-weight: bold; }

.post_wrap.vevent h3 {
	height: auto !important;
	line-height: 1 !important;
	padding: 10px !important;
}
	.post_wrap.vevent h3 .ipsUserPhoto { margin-right: 10px; }
	
#cal_date_wrap { line-height: 1.5; }
.cal_date_day { font: 300 84px/58px 'Helvetica Neue', helvetica, arial, sans-serif; }
.cal_date_monthyear { 
	text-transform: uppercase;
	font-size: 16px;
}

/* RSVPing */
.rsvp {
	margin-top: 15px;
	padding: 10px 0 0 0;
	border-top: 1px solid #c0c0c0;
}
.rsvp > div { margin-top: 5px; }
#attendee_list { margin-top: 10px; }

.calendar_jump { 
	font-size: 14px !important;
	margin: 6px 0 0 10px;
	display: inline-block;
}

.calendar_dropdown { display: inline-block; }
	
	#calendar_chooser_menucontent {	width: 200px; }	
	#calendar_chooser_menucontent .calendar_icon { padding: 4px; }
	
.calendar_wrap table td.blank {
	background-color: #e7e7e7;
}

#ipboard_body .calendar_wrap table td.today {
	border: 2px solid #6f8f52;
	color: #6f8f52;
	background-color: #f1f6ec;
}

.calendar_wrap table td strong {
	font-size: 0.9em;
	font-weight: bold;
}
	
#ipboard_body table th.head_week {
	width: 2% !important;
}

#ipboard_body table th.view_week {
	background-color: #b6c7db;
	text-align: center;
	border: 1px solid #b6c7db;
}

/* Week view */
	div#current_calendar ol#week_view li.day {
		margin-bottom: 2px;
	}
	
	div#current_calendar ol#week_view li.day div {
		padding: 4px 10px 4px 75px;
		min-height: 60px;
		position: relative;
	}
	
	div#current_calendar ol#week_view li.day .date {
		color: #1d3652;
		font-size: 1.2em;
		text-align: center;
		padding-top: 10px;
		top: 0px;
		bottom: 0px;
		left: 0px;
		width: 65px;
		display: block;
		position: absolute;
	}

.cal_color {
	margin-right: 8px;
	padding: 0 7px;
	border-radius: 2px;
	-moz-border-radius: 2px;
	-webkit-border-radius: 2px;
}
	
.cal_1 {
	background-color: #971a48;
}
.cal_2 {
	background-color: #3fa711;
}
.cal_3 {
	background-color: #cd8b24;
}


.input_check.event_options {
	margin-left: 12px !important;
}

/*swright*/
li.cal.vevent a.summary.url {font-size:12px;}]]></css_content>
    <css_position>1</css_position>
    <css_app>calendar</css_app>
    <css_app_hide>1</css_app_hide>
    <css_attributes><![CDATA[title="Main" media="screen,print"]]></css_attributes>
    <css_modules/>
    <css_removed>0</css_removed>
    <css_master_key/>
  </cssfile>
</css>

--------------------------------------------------------------------------------
> Time: 1423791453 / Fri, 13 Feb 2015 01:37:33 +0000
> URL: /admin/index.php?adsess=65123953941da2af08bd12daeafb73df&app=core&&module=templates&section=importexport&do=exportSet
> Replacements Export:
<?xml version="1.0" encoding="utf-8"?>
<replacements>
  <replacement>
    <replacement_key>add_folder</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/folder_add.png' alt='{lang:add_folder}' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>add_friend</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/user_add.png' alt='{lang:add_friend}' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>add_poll_choice</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/add.png' alt='+' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>add_poll_question</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/add.png' alt='+' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>blog_banish</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/blog/layout_delete.png' alt='' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>blog_blog</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/blog/blog.png' alt='' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>blog_category</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/folder.png' alt='-' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>blog_comments</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/blog/comments.png' alt='' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>blog_comments_new</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/blog/comments_new.png' alt='' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>blog_link</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/book_open.png' alt='{lang:view_blog}' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>blog_locked</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/blog/lock.png' alt='' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>blog_rss_import</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/blog/rss-import.png' alt='' title='{lang:entry_imported_from_rss}' data-tooltip='{lang:entry_imported_from_rss}' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>close_poll_form</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/accept.png' alt='x' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>display_name</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/display_name.png' alt='' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>dropdown</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/dropdown.png' alt='+' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>edit_folder</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/folder_edit.png' alt='{lang:edit_folders}' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>find_topics_link</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/page_topic_magnify.png' alt='{lang:find_topics}' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>folder_delete</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/delete.png' alt='{lang:delete_folder_title}' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>folder_drafts</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/folder.png' alt='{lang:macro__folder}' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>folder_empty</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/bin.png' alt='{lang:empty_folder_title}' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>folder_finished</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/folder.png' alt='{lang:macro__folder}' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>folder_generic</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/folder.png' alt='{lang:macro__folder}' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>folder_myconvo</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/email_go.png' alt='{lang:macro__myconvo}' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>folder_new</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/folder_page.png' alt='{lang:macro__new}' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>f_cat_read</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/f_icon_read.png' alt='{lang:macro__readcat}' title='{lang:macro__readcat}' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>f_cat_unread</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/f_icon.png' alt='{lang:macro__unreadcat}' title='{lang:macro__markread}' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>f_nav_sep</replacement_key>
    <replacement_content>{lang:_rarr}</replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>f_newpost</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/new_post.png' alt='' title='{lang:first_unread_post}' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>f_pass_read</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/f_icon_read.png' alt='{lang:macro__readpw}' title='{lang:macro__readpw}' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>f_pass_unread</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/f_icon.png' alt='{lang:macro__unreadpw}' title='{lang:macro__markread}' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>f_read</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/f_icon_read.png' alt='{lang:macro__readf}' title='{lang:macro__readf}' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>f_redirect</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/f_redirect.png' alt='{lang:macro__redirect}' title='{lang:macro__redirect}' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>f_unread</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/f_icon.png' alt='{lang:macro__unreadf}' title='{lang:macro__markread}' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>galery_album_edit</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/folder_edit.png' alt='' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>gallery_album_delete</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/delete.png' alt='-' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>gallery_image</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/gallery/image_add.png' alt='' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>gallery_link</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/picture.png' alt='{lang:view_gallery}' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>gallery_slideshow</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/gallery/pictures.png' alt='' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>generic_cog</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/cog.png' alt='+' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>lim_facebook</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/loginmethods/facebook.png' alt='{lang:lim_facebook}' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>lim_twitter</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/loginmethods/twitter.png' alt='{lang:lim_twitter}' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>lim_windows</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/loginmethods/windows.png' alt='{lang:lim_windows}' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>live_large</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/live.gif' alt='{lang:macro__liveicon}' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>live_small</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/live.gif' alt='{lang:macro__liveicon}' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>lock_icon</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/lock.png' alt='{lang:pm_locked}' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>logo_img</replacement_key>
    <replacement_content>//www.bestdestinationwedding.com/public/style_images/6_logo.png</replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>mini_rate_off</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/bullet_star_off.png' alt='-' class='mini_rate' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>mini_rate_on</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/bullet_star.png' alt='*' class='mini_rate' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>pip_pip</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/bullet_black.png' alt='{lang:macro__pip}' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>popular_post</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/star_big.png' alt='*' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>post_attach_link</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/attachicon.gif'	alt='{lang:macro__attachment}' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>rate_off</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/star_off.png' alt='-' class='rate_img' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>rate_on</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/star.png' alt='*' class='rate_img' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>remove_friend</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/user_delete.png' alt='{lang:remove_friend}' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>remove_poll_choice</replacement_key>
    <replacement_content><![CDATA[<span class='cancel' title='{lang:remove_choice}'>&times;</span>]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>remove_poll_question</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/cross.png' alt='-' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>report_green_alert</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/reports/post_alert_3.png' alt='' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>report_red_alert</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/reports/post_alert_1.png' alt='' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>rep_down</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/rep_down.png' alt='-' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>rep_up</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/rep_up.png' alt='+' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>send_msg</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/email_open.png' alt='{lang:pm_this_member}' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>signin_icon</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/key.png' alt='{lang:macro__signin}' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>snapback</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/snapback.png' alt='{lang:macro__view_post}' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>sort_down</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/bullet_arrow_down.png' alt='V' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>sort_up</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/bullet_arrow_up.png' alt='^' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>spammer_off</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/spammer_off.png' alt='{lang:spm_off}' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>spammer_on</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/spammer_on.png' alt='{lang:spm_on}' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>topic_popup</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/topicpreview.png' alt='' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>t_announcement</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/t_announcement.png' alt='{lang:announce_row}' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>t_closed</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/t_locked.png' alt='{lang:pm_locked}' /><br />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>t_moved</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/t_moved.png' alt='{lang:pm_moved}' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>t_read_dot</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/t_read_dot.png' alt='{lang:you_posted_here}' title='{lang:you_posted_here}' /><br />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>t_unread</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/t_unread.png' alt='{lang:pm_open_new}' /><br />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>t_unread_dot</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/t_unread_dot.png' alt='{lang:you_posted_here}' /><br />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
  <replacement>
    <replacement_key>your_vote</replacement_key>
    <replacement_content><![CDATA[<img src='{style_image_url}/bullet_star_rated.png' alt='{lang:macro__voted}' />]]></replacement_content>
    <replacement_set_id>6</replacement_set_id>
    <replacement_master_key/>
  </replacement>
</replacements>

--------------------------------------------------------------------------------
> Time: 1423791453 / Fri, 13 Feb 2015 01:37:33 +0000
> URL: /admin/index.php?adsess=65123953941da2af08bd12daeafb73df&app=core&&module=templates&section=importexport&do=exportSet
> Info Export:
<?xml version="1.0" encoding="utf-8"?>
<info>
  <data>
    <set_name>BDW Desktop</set_name>
    <set_key>_1379508780_1386177712</set_key>
    <set_author_name>Brian Garcia, IPS Inc.</set_author_name>
    <set_author_url>http://invisionpower.com</set_author_url>
    <set_output_format>html</set_output_format>
    <set_master_key>root</set_master_key>
    <ipb_human_version>3.4.7</ipb_human_version>
    <ipb_long_version>34013</ipb_long_version>
    <ipb_major_version>3</ipb_major_version>
  </data>
</info>
