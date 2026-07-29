<?php
function get_tapatalk_location($request, $page_type)
{
    try
    {
        $forums_posts_per_page = \IPS\Settings::i()->forums_posts_per_page;
        switch ($page_type)
        {
            case "forum":

                $param_arr['fid'] = $request->__get('id');;
                $page = $request->__get('page');
                if(isset($page))
                {
                    $param_arr['page'] = $page;
                    $param_arr['perpage'] = $forums_posts_per_page;
                }
                else
                {
                    $param_arr['page'] =  1;
                    $param_arr['perpage'] = $forums_posts_per_page;
                }
                $param_arr['location'] = 'forum';
                break;
            case "index.php":
            case '':
                $param_arr['location'] = 'index';
                break;
            case "ucp.php":
                if(!empty($_GET['i']) && ($_GET['i'] == "pm"))
                {
                    $param_arr['location'] = 'message';
                    if(!empty($_GET['p']))
                        $param_arr['mid'] = $_GET['p'];
                }
                if(!empty($_GET['mode']) && ($_GET['mode'] == 'login'))
                {
                    $param_arr['location'] = 'login';
                }
                break;
            case "search.php":
                $param_arr['location'] = "search";
                break;
            case "topic":
                {
                    $param_arr['location'] = 'topic';
                    if(isset($_GET['f']))
                    {
                        $param_arr['fid'] = $_GET['f'];
                    }
                    $param_arr['tid'] = $request->__get('id');
                    $page = $request->__get('page');
                    if(isset($page))
                    {
                        $param_arr['page'] = $page;
                        $param_arr['perpage'] = $forums_posts_per_page;
                    }
                    else
                    {
                        $param_arr['page'] =  1;
                        $param_arr['perpage'] = $forums_posts_per_page;
                    }
                    if(isset($_GET['p']))
                    {
                        $param_arr['pid'] = $_GET['p'];
                        $param_arr['location'] = 'post';
                    }

                    break;
                }
            case "memberlist.php":
                if(!empty($_GET['mode']) && $_GET['mode'] == "viewprofile" && !empty($_GET['u']))
                {
                    $param_arr['location'] = 'profile';
                    $param_arr['uid'] = $_GET['u'];
                }

                break;
            case "viewonline.php":
                $param_arr['location'] = 'online';
                break;
            default:
                $param_arr['location'] = 'index';
                break;
        }
        $queryString = http_build_query($param_arr);
        $url = \IPS\Settings::i()->base_url . '?' .$queryString;
        $url = preg_replace('/^(https|http):\/\//isU', '', $url);
        return $url;
    }
    catch(Exception $ex)
    {
        return "";
    }
}
function mobiquo_hide_forum_array()
{
    $hiddenForums = array();
    if(isset(\IPS\Settings::i()->tapatalk_hideforums))
    {
        $hideForum =  explode(',', \IPS\Settings::i()->tapatalk_hideforums);
        foreach ($hideForum as $hideForumId)
        {
            if(is_numeric($hideForumId) && $hideForumId != 0)
            {
                $hiddenForums[] = $hideForumId;
            }
        }
    }
    return $hiddenForums;
}
function mobiquo_hide_forum($forumId)
{
    $hiddenForums = mobiquo_hide_forum_array();
    return in_array($forumId, $hiddenForums);
}

function mobiquo_hide_forum_topicWhere()
{
    $hiddenForums = mobiquo_hide_forum_array();
    if(!empty($hiddenForums))
    {
        return array('forums_topics.forum_id NOT IN (' . implode(',',$hiddenForums) . ')');
    }
    return null;
}
function mobiquo_format_date($date)
{
    return $date;
}

function check_return_user_type($member)
{

    try
    {
        $row = \IPS\Db::i()->select( 'user_verified', 'core_validating', array( "member_id = ?", $member->__get('member_id')))->first();
        $memberbitOptions = $member->__get('members_bitoptions');
        if(isset($memberbitOptions) && isset($memberbitOptions->values['members_bitoptions']) && $member->members_bitoptions['validating'])
        {
            if ( \IPS\Settings::i()->reg_auth_type == 'admin_user' )
            {
                return 'unapproved';
            }
            else
            {
                return 'inactive';
            }
        }
    }
    catch(Exception $e){

    }
    $user_type = 'normal';
    if($member->isBanned())
    {
        $user_type = 'banned';
    }
    else if($member->isAdmin())
    {
        $user_type = 'admin';
    }
    else if($member->modPermission() != null)
    {
        $user_type = 'mod';
    }
    return $user_type;
}

function get_user_avatar_url($avatar, $avatar_type = 'custom', $ignore_config = false)
{
    switch($avatar_type)
    {
        case 'custom':
            {
                if(is_string($avatar))
                {
                    return $avatar;
                }
                return $avatar->rfc3986();
            }
    }
    return null;
    //global $config, $phpbb_home, $phpEx;

    //if (empty($avatar) || (isset($config['allow_avatar']) && !$config['allow_avatar'] && !$ignore_config))
    //{
    //    return '';
    //}

    //$avatar_img = '';

    //switch ($avatar_type)
    //{
    //    case AVATAR_UPLOAD:
    //        if (isset($config['allow_avatar_upload']) && !$config['allow_avatar_upload'] && !$ignore_config)
    //        {
    //            return '';
    //        }
    //        $avatar_img = $phpbb_home . "download/file.$phpEx?avatar=";
    //        break;

    //    case AVATAR_GALLERY:
    //        if (isset($config['allow_avatar_local']) && !$config['allow_avatar_local'] && !$ignore_config)
    //        {
    //            return '';
    //        }
    //        $avatar_img = $phpbb_home . $config['avatar_gallery_path'] . '/';
    //        break;

    //    case AVATAR_REMOTE:
    //        if (isset($config['allow_avatar_remote']) && !$config['allow_avatar_remote'] && !$ignore_config)
    //        {
    //            return '';
    //        }
    //        break;
    //    default:
    //        $avatar_img = $phpbb_home . "download/file.$phpEx?avatar=";
    //        break;
    //}

    //$avatar_img .= $avatar;
    //$avatar_img = str_replace(' ', '%20', $avatar_img);

    //return $avatar_img;
}


function TT_process_short_content($post_text, $length = 200)
{
    $addDots = false;
    $ori_post_text = $post_text;
    $post_text = TT_convertToTapatalkBBCode($post_text);
    $post_text = str_replace('<br />', ' ', $post_text);
    //if(mb_strlen($post_text) > 200)
    //{
    //    $addDots = true;
    //}
    $array_reg = array(
        array('reg' => '/\[quote(.*?)\](.*?)\[\/quote(.*?)\]/si','replace' => '[quote]'),
        // array('reg' => '/\[code(.*?)\](.*?)\[\/code(.*?)\]/si','replace' => '[code]'),
        array('reg' => '/\[code(.*?)\](.*?)\[\/code(.*?)\]/si','replace' => '$2'),
        array('reg' => '/\[mention=(.*?)\](.*?)\[\/mention(.*?)\]/si','replace' => '@$2'),
        array('reg' => '/\[video(.*?)\](.*?)\[\/video(.*?)\]/si','replace' => '[emoji327]'),
        array('reg' => '/\[attachment(.*?)\](.*?)\[\/attachment(.*?)\]/si','replace' => '[emoji420]'),
        array('reg' => '/\[url.*?\].*?\[\/url.*?\]/','replace' => '[emoji288]'),
        array('reg' => '/(https?|ftp|mms):\/\/([A-z0-9]+[_\-]?[A-z0-9]+\.)*[A-z0-9]+\-?[A-z0-9]+\.[A-z]{2,}(\/.*)*\/?/is','replace' => ''),
        array('reg' => '/\[img.*?\].*?\[\/img.*?\]/','replace' => '[emoji328]'),
         array('reg' => '/\[img\]/','replace' => '[emoji328]'),
       array('reg' => '/[\n\r\t]+/','replace' => ' '),
        array('reg' => '/\[flash(.*?)\](.*?)\[\/flash(.*?)\]/si','replace' => '[flash]'),
        array('reg' => '/\[spoiler(.*?)\](.*?)\[\/spoiler(.*?)\]/si','replace' => '[emoji85]'),
        array('reg' => '/\[spoil(.*?)\](.*?)\[\/spoil(.*?)\]/si','replace' => '[emoji85]'),
    );
    //echo $post_text;die();
    foreach ($array_reg as $arr)
    {
        $post_text = preg_replace($arr['reg'], $arr['replace'], $post_text);
    }
    $post_text = html_entity_decode($post_text, ENT_QUOTES, 'UTF-8');
    $post_text = function_exists('mb_substr') ? mb_substr($post_text, 0, $length) : substr($post_text, 0, $length);
    $post_text = trim(strip_tags($post_text));
    $post_text = preg_replace('/\\s+|\\r|\\n/', ' ', $post_text);
    if(empty($post_text))
    {
        $post_text = $ori_post_text;
        $post_text = function_exists('mb_substr') ? mb_substr($post_text, 0, $length) : substr($post_text, 0, $length);
    }
    if($addDots)
    {
        $post_text .= "...";
    }
    return $post_text;
}


/**
 * Get the 'unread' where SQL
 *
 * @param	string	$class 		Content class (\IPS\forums\Forum)
 * @return	array
 */
function TT_getUnreadWhere( $class )
{
    $member = \IPS\Member::loggedIn();
    $classBits	    = explode( "\\", $class );
    $application    = $classBits[1];
    $resetTimes	    = $member->markersResetTimes( $application );
    $oldestTime	    = time();
    $markers	    = array();
    $excludeIds     = array();
    $where          = array();
    $unreadWheres	= array();
    $containerIds	= array();
    $containerClass = ( $class::$containerNodeClass ) ? $class::$containerNodeClass : NULL;


    /* What is the best date column? */
    $fields = array();
    foreach ( array( 'updated', 'last_comment', 'last_review' ) as $k )
    {
        if ( isset( $class::$databaseColumnMap[ $k ] ) )
        {
            if ( is_array( $class::$databaseColumnMap[ $k ] ) )
            {
                foreach ( $class::$databaseColumnMap[ $k ] as $_k )
                {
                    $fields[] = '`' . $class::$databaseTable . '`.`' . $class::$databasePrefix . $_k . '`';
                }
            }
            else
            {
                $fields[] = '`' . $class::$databaseTable . '`.`' . $class::$databasePrefix . $class::$databaseColumnMap[ $k ] . '`';
            }
        }
    }
    $fields = array_unique( $fields );
    $fields = ( count( $fields ) > 1 ) ? ( 'GREATEST( ' . implode( ', ', $fields ) . ' )' ) : $fields;


    foreach( $resetTimes as $containerId => $timestamp )
    {
        $container = NULL;

        if( $containerId AND $containerClass )
        {
            try
            {
                $container = $containerClass::load( $containerId );
            }
            catch ( \OutOfRangeException $e)
            {
                continue;
            }
        }

        $timestamp	= $timestamp ?: $member->marked_site_read;

        $containerIds[]	= $containerId;
        $unreadWheres[]	= '( ' . $class::$databaseTable . '.' . $class::$databasePrefix . $class::$databaseColumnMap['container'] . '=' . $containerId . ' AND ' . $fields . ' > ' . (int) $timestamp . ')';

        $items = $member->markersItems( $application, \IPS\Content\Item::makeMarkerKey( $container ) );

        if ( count( $items ) )
        {
            foreach( $items as $mid => $mtime )
            {
                if ( $mtime > $timestamp )
                {
                    $markers[ $mtime . '.' . $mid ] = $mid;
                }
            }
        }
    }

    if( count( $containerIds ) )
    {
        $unreadWheres[]	= "( " . $fields . " > " . $member->marked_site_read . " AND ( " . $class::$databaseTable . '.' . $class::$databasePrefix . $class::$databaseColumnMap['container'] . " NOT IN(" . implode( ',', $containerIds ) . ") ) )";
    }
    else
    {
        $unreadWheres[]	= "( " . $fields . " > " . $member->marked_site_read . ")";
    }

    if( count( $unreadWheres ) )
    {
        $where[] = array( "(" . implode( " OR ", $unreadWheres ) . ")" );
    }

    if ( count( $markers ) )
    {
        /* Avoid packet issues */
        krsort( $markers );
        $useIds = array_flip( array_slice( $markers, 0, 500, TRUE ) );
        $select = '';
        $from   = '';
        $notIn  = array();

        foreach( \IPS\Db::i()->select( $class::$databaseTable . '.' . $class::$databasePrefix . $class::$databaseColumnId. ' as _id, ' . $fields . ' as _date', $class::$databaseTable, \IPS\Db::i()->in( $class::$databasePrefix . $class::$databaseColumnId, array_keys( $useIds ) ) ) as $row )
        {
            if ( isset( $useIds[ $row['_id'] ] ) )
            {
                if ( $useIds[ $row['_id'] ] >= $row['_date'] )
                {
                    /* Still read */
                    $notIn[] = intval( $row['_id'] );
                }
            }
        }

        if ( count( $notIn ) )
        {
            $where[] = array( "( " . $class::$databaseTable . '.' . $class::$databasePrefix . $class::$databaseColumnId . " NOT IN (" . implode( ',', $notIn ) . ") )" );
        }
    }

    return $where;
}
function TT_convertBBCodeForSave($text, $attachmentIds)
{
    if(!empty($attachmentIds))
    {
        foreach($attachmentIds as $attachmentId)
        {
            if(!preg_match('/\[attachment='  . $attachmentId . ':/', $text))
            {
                try
                {
                    $attachmentFile = \IPS\Db::i()->select( '*', 'core_attachments', array( 'attach_id=?', (int) $attachmentId ) )->first();
                    $text .= '[attachment=' . $attachmentId . ':' . $attachmentFile['attach_file'] .']';
                }
                catch( \UnderflowException $e )
                {

                }
            }
        }
    }
    preg_match_all('/(^@|\s@)[_a-zA-Z][_a-zA-Z\d]+/', $text, $matches);
    if(!empty($matches[0]))
    {
        foreach ($matches[0] as $value) {
            $name = str_replace('@', "", $value);
            $name = trim($name);
            try{
                $row = \IPS\Db::i()->select( '*', 'core_members', array( "name = ?", mb_strtolower( $name) ))->first();
                $result = \IPS\Theme::i()->getTemplate( 'editor', 'core', 'global' )->mentionRow( \IPS\Member::constructFromData( $row ) );

                preg_match("/data-mentionhref='([^']+)/", $result, $matches);
                $mentionhref = $matches[1];
                preg_match("/data-mentionid='([^']+)/", $result, $matches);
                $mentionid = $matches[1];
                preg_match("/data-mentionhover='([^']+)/", $result, $matches);
                $mentionhover = $matches[1];
                $mentionstr = '<a href='.$mentionhref.' data-ipshover="" data-ipshover-target='.$mentionhover.' data-mentionid='.$mentionid.'>@'.$name.'</a>';
                $text = str_replace($value, $mentionstr, $text);
            }catch(Exception $e) {
                continue;
            }

        }
    }
    $text = preg_replace('/\r\n/si', '<br />', $text);
    $text = preg_replace('/\n/si', '<br />', $text);
    $text = preg_replace('/\r/si', '<br />', $text);
    $legacyParser = new \IPS\Text\LegacyParser(\IPS\Member::loggedIn(), TRUE, 'forums_Forums', 0, 0, NULL, 'forums_Forums');
    /* workaround for quote processing*/
    $text = preg_replace_callback( "#\[quote([^>]*?)\]#si" , 'TT_parseOldQuoteBbcode', $text );
    $text = str_replace( "[/quote]", "</div></blockquote>", $text );
    if( (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
    || $_SERVER['SERVER_PORT'] == 443)
    {
        $text = str_replace('http://uploads.tapatalk-cdn.com/','https://uploads.tapatalk-cdn.com/', $text);
    }
    $text = $legacyParser->parse($text, true);
    $text = preg_replace('/\n/si', '', $text);
    //$text = \IPS\Text\Parser::parseStatic($text, TRUE, NULL, NULL, 'forums_Forums');
    //fix attachment error in leacyparser
    $regex = "/\<___base_url___\>\/applications\/core\/interface\/imageproxy\/imageproxy\.php\?img\=%7BfileStore\.core_Attachment%7D([^\"]*?)\"/";
    $text =preg_replace_callback($regex,
        function($matches){
            $url = $matches[1];
            $keyPosition = strpos($url,'&amp;key=');
            if($keyPosition != 0)
            {
                $url = substr($url, 0, $keyPosition);
            }
            return '<fileStore.core_Attachment>' . $url . '"';
    }, $text);
    $text= preg_replace("/(\<fileStore\.core_Attachment\>[^\"]*\")\srel=\"external nofollow\"/", "$1", $text);
    return $text;
}
function TT_parseOldQuoteBbcode( $matches=array() )
{
    $parameters	= array( 'data-ipsQuote' => '', 'class' => 'ipsQuote' );

    if(is_array($matches) && isset( $matches[1] ) )
    {
        preg_match( "/name=['\"](.+?)[\"']/i", $matches[1], $author );
        preg_match( "/post=['\"](.+?)[\"']/i", $matches[1], $cid );
        preg_match( "/timestamp=['\"](.+?)[\"']/i", $matches[1], $time );
        preg_match( "/userid=['\"](.+?)[\"']/i", $matches[1], $userId );

        if( isset( $cid[1] ) )
        {
            $parameters['data-ipsquote-contentcommentid']	= $cid[1];
        }

        if( isset( $author[1] ) )
        {
            $parameters['data-ipsquote-username']	= $author[1];
            $parameters['data-cite']				= $author[1];
        }
        if( isset( $userId[1] ) )
        {
            $parameters['data-ipsquote-userid']	= $userId[1];
        }
        if( isset( $time[1] ) )
        {
            $parameters['data-ipsquote-timestamp']	= $time[1];
        }
    }

    $_parameterString	= '';

    foreach( $parameters as $key => $value )
    {
        $_parameterString	.= ' ' . $key . '="' . str_replace( '"', '\\"', $value ) . '"';
    }

    return "<blockquote{$_parameterString}><div>";
}
function TT_fixBaseUrl($url)
{
    if(substr($url, 0, 4) != "http") {
        if(substr($url, 0, 1) == ":")
        {
            $url = "http" . $url;
        }
        if(substr($url, 0, 2) == "//")
        {
            $url = "http:" . $url;
        }
    }
    if (substr($url, -1) != '/') {
        $url .= "/";
    }
    return $url;
}
function TT_convertToTapatalkBBCode($text)
{
    if(is_callable(array("\IPS\Text\Parser","removeLazyLoad")))
    {
        $text = \IPS\Text\Parser::removeLazyLoad( $text );
    }
    $baseUrl = \IPS\Settings::i()->base_url;
    $baseUrl = TT_fixBaseUrl($baseUrl);
    $attachmentBaseUrl = \IPS\File::getClass('core_Attachment' )->baseUrl();
    $attachmentBaseUrl = TT_fixBaseUrl($attachmentBaseUrl);
    $galleryBaseUrl = \IPS\File::getClass('gallery_Images')->baseUrl();
    $galleryBaseUrl = TT_fixBaseUrl($galleryBaseUrl);
    $text = preg_replace_callback('/<pre.*?>(.*?)<\/pre>/si', 'TT_bbcode_protect_code_callback', $text);
    $text = preg_replace_callback('/\[code\]<span>(.*?)<\/span>\[\/code\]/si', 'TT_bbcode_protect_code_callback', $text);
    //$text = preg_replace('/<___base_url___>\/applications\/core\/interface\/imageproxy\/imageproxy.php\?img=(.*?)&amp;key=[^\s"]*/si', '$1', $text);
    $text = str_replace('<___base_url___>/', $baseUrl, $text);
    $text = str_replace('<___base_url___>', $baseUrl, $text);
    $text = preg_replace('/\n/si',"", $text);
    $text = preg_replace('/<li>\s*?<p>\s*?((?:(?!<\/p>).)*?)\s*?<\/p>\s*?<\/li>/si','<li>$1</li>', $text);
    $text = preg_replace('/<p([^ra]*?)>(.*?)<\/p>/si','$2<br />', $text);
    $text = preg_replace('/<br>/si','<br />', $text);
    $text = preg_replace('/<a [^>]*?data-mentionid="(.*?)".*?>@(.*?)<\/a>/si', "[mention=$1]$2[/mention]", $text);
    $text = preg_replace('/<a [^>]*?href="(.*?)"(.*?)?>(.*?)<\/a>/si', "[url=$1]$3[/url]", $text);
    $text = preg_replace('/<blockquote class="ipsStyle_spoiler".*?>(.*?)<\/blockquote>/si', "[spoiler]$1[/spoiler]", $text);
    $text = preg_replace_callback('/<blockquote[^>]*>/si','TT_quoteCallback', $text);
    $text = preg_replace('/<\/blockquote>/si','[/quote]', $text);
    $text = preg_replace('/<div class="ipsSpoiler_contents".*?>(.*?)<\/div>/si', "[spoiler]$1[/spoiler]", $text);
    $text = preg_replace('/<em>(.*?)<\/em>/si','<i>$1</i>', $text);
    $text = preg_replace('/<strong>(.*?)<\/strong>/si','<b>$1</b>', $text);
    $text = preg_replace('/<span style="color:(.*?);">(.*?)<\/span>/si','<font color="$1">$2</font>', $text);
    $text = preg_replace('/<span style="text-decoration:underline;">(.*?)<\/span>/si','<u>$1</u>', $text);
    $text = preg_replace_callback('/<font color="rgb\((\d+?),(\d+?),(\d+?)\)">(.*?)<\/font>/si',function($match){
        return '<font color="' . TT_rgb2html($match[1],$match[2],$match[3]) . '">' . $match[4] . '</font>';
    }, $text);
    $text = preg_replace('/&lt;fileStore.core_Attachment&gt;\/?/si', $attachmentBaseUrl, $text);
    $text = preg_replace('/<fileStore.core_Attachment>\/?/si', $attachmentBaseUrl, $text);
    $text = preg_replace('/&lt;fileStore.gallery_Images&gt;\/?/si', $galleryBaseUrl, $text);
    $text = preg_replace('/<fileStore.gallery_Images>\/?/si', $galleryBaseUrl, $text);
    $text = preg_replace('/&lt;fileStore.core_Emoticons&gt;\/?/si', '----emoticon----', $text);
    $text = preg_replace('/<fileStore.core_Emoticons>\/?/si', '----emoticon----', $text);
    $text = preg_replace_callback('/<img.*?>/si',function($match){
        $theImg = TT_GetHtmlEntity($match[0], 'img');
        $src =  $theImg->getAttribute('src');
        if(strpos($src,'----emoticon----') !== false)
        {
            return TT_mapEmoticonToEmoji($theImg->getAttribute('alt'));
        }
        else if(strpos($src, 'emoji.tapatalk-cdn.com') !== false)
        {
            return '[' .str_replace('.png','', $theImg->getAttribute('alt')). ']';
        }
        return '[img]' . $src . '[/img]';

    }, $text);
    $text = TT_removeTagKeepContent('span', $text);
    $text = preg_replace('/<div class="ipsQuote_citation">(.*?)<\/div>/si','', $text);
    $text = TT_removeTagKeepContent('div', $text);

    $text = preg_replace('/<iframe .*?src="(.*?)"(.*?)?>(.*?)<\/iframe>/si', "[url=$1][/url]", $text);

    //deal with video url such as facebook
    preg_match('/\[url=http.*?\?app=core&amp;module=system&amp;controller=embed&amp;url=(.*?)\]/si', $text, $matches);
    if (!empty($matches[1]))
    {
        $original_url = urldecode($matches[1]);
        preg_match('/\[url=(http[^]]*?\?app=core&amp;module=system&amp;controller=embed&amp;url=.*?)\]/si', $text, $matches);
        $need_replace = $matches[1];
        $text = str_replace($need_replace, $original_url, $text);
    }

    $text = preg_replace('/\t{2,}/',"\t",$text);
    $text = preg_replace('/\t/si'," ", $text);
    $text = html_entity_decode($text, ENT_QUOTES, 'UTF-8');
    $text = preg_replace_callback('/\[code\](.*?)\[\/code\]/si', 'TT_bbcode_unprotect_code_callback', $text);

    if(isset(\IPS\Settings::i()->tapatalk_threadcontentreplacement))
    {
        $custom_replacement = \IPS\Settings::i()->tapatalk_threadcontentreplacement;
        if(!empty($custom_replacement))
        {
            $replace_arr = explode("\n", $custom_replacement);
            foreach ($replace_arr as $replace)
            {
                preg_match('/^\s*(\'|")((\#|\/|\!).+\3[ismexuADUX]*?)\1\s*,\s*(\'|")(.*?)\4\s*$/', $replace,$matches);
                if(count($matches) == 6)
                {
                    $temp_post = $text;
                    $text = @preg_replace($matches[2], $matches[5], $text);
                    if(empty($text))
                    {
                        $text = $temp_post;
                    }
                }
            }
        }
    }
    return $text;
}

function TT_deleteDeeplevelsQuotedContents($content)
{
    $content = preg_replace('/\[quote name=([^\]]*)\].*\[\/quote\]/si', "", $content);
    return $content;
}
function TT_mapEmoticonToEmoji($emoticon)
{
    $emoticons = array(">:(" => "35",
        ":D" => "3",
        "O.o" => "33",
        ":$" => "5",
        "B|" => "41",
        "¬¬" => "19",
        "^_^" => "5",
        "o.O" => "57",
        "xD" => "23",
        ":|" => "52",
        ":o" => "33",
        ":ph34r:" => "185",
        "9_9" => "16",
        ":(" => "20",
        "-_-" => "42",
        ":)" => "4",
        ":P" => "14",
        ":/" => "32",
        ":S" => "37",
        ";)" => "6",
        ":x" => "8");
    if(isset($emoticons[$emoticon]))
    {
        return '[emoji' .$emoticons[$emoticon] . ']';
    }
    return $emoticon;
}
function TT_bbcode_protect_code_callback($matches)
{
    $code = $matches[1];
    $code = base64_encode($code);
    return '[code]' . $code . '[/code]';
}
function TT_bbcode_unprotect_code_callback($matches)
{
    $code = $matches[1];
    $code = base64_decode($code);
    $code = preg_replace('/\n/si',"<br />", $code);
    return '[code]' . $code . '[/code]';
}
function TT_quoteCallback($match)
{
    $theBlock = TT_GetHtmlEntity($match[0], 'blockquote');
    if($theBlock != null)
    {
        switch($theBlock->getAttribute('class'))
        {
            case 'ipsQuote':
                {
                    $extraData = '';
                    if($theBlock->getAttribute('data-ipsquote-username'))
                    {
                            $extraData .= ' name="' . $theBlock->getAttribute('data-ipsquote-username') . '"';
                    }
                    if($theBlock->getAttribute('data-ipsquote-timestamp'))
                    {
                        $extraData .= ' timestamp="' . $theBlock->getAttribute('data-ipsquote-timestamp'). '"';
                    }
                    if($theBlock->getAttribute('data-ipsquote-userid'))
                    {
                        $extraData .= ' uid="' . $theBlock->getAttribute('data-ipsquote-userid'). '"';
                    }
                    if($theBlock->getAttribute('data-ipsquote-contentcommendid'))
                    {
                        $extraData .= ' post="' . $theBlock->getAttribute('data-ipsquote-contentcommendid'). '"';
                    }
                    $result = '[quote' . $extraData . ']';
                    return $result;
                }
            case 'ipsStyle_spoiler':
                {
                    return '[spoiler]';
                }
        }
    }
    return $match[0];
}
function TT_removeTagKeepContent($tag, $text)
{
    $text = preg_replace("/<\/?" .$tag . "[^>]*\>/i", "", $text);
    return $text;
}
function TT_getHtmlEntity($html, $tagName)
{
    $dom = new DOMDocument();
    $dom->loadHTML('<?xml encoding="UTF-8">' . $html);

    foreach ($dom->childNodes as $item)
        if ($item->nodeType == XML_PI_NODE)
            $dom->removeChild($item);
    $dom->encoding = 'UTF-8';
    return $dom->getElementsByTagName($tagName)->item(0);
}
function TT_rgb2html($r, $g=-1, $b=-1)
{
    if (is_array($r) && sizeof($r) == 3)
        list($r, $g, $b) = $r;

    $r = intval($r); $g = intval($g);
    $b = intval($b);

    $r = dechex($r<0?0:($r>255?255:$r));
    $g = dechex($g<0?0:($g>255?255:$g));
    $b = dechex($b<0?0:($b>255?255:$b));

    $color = (strlen($r) < 2?'0':'').$r;
    $color .= (strlen($g) < 2?'0':'').$g;
    $color .= (strlen($b) < 2?'0':'').$b;
    return TT_color_convert('#'.$color);
}
function TT_get_inner_html( $node ) {
    $innerHTML= '';
    $children = $node->childNodes;
    foreach ($children as $child) {
        $innerHTML .= $child->ownerDocument->saveXML( $child );
    }

    return $innerHTML;
}
function TT_color_convert($color)
{
    static $colorlist;

    if (preg_match('/#[\da-fA-F]{6}/is', $color))
    {
        if (!$colorlist)
        {
            $colorlist = array(
                '#000000' => 'Black',             '#708090' => 'SlateGray',       '#C71585' => 'MediumVioletRed', '#FF4500' => 'OrangeRed',
                '#000080' => 'Navy',              '#778899' => 'LightSlateGrey',  '#CD5C5C' => 'IndianRed',       '#FF6347' => 'Tomato',
                '#00008B' => 'DarkBlue',          '#778899' => 'LightSlateGray',  '#CD853F' => 'Peru',            '#FF69B4' => 'HotPink',
                '#0000CD' => 'MediumBlue',        '#7B68EE' => 'MediumSlateBlue', '#D2691E' => 'Chocolate',       '#FF7F50' => 'Coral',
                '#0000FF' => 'Blue',              '#7CFC00' => 'LawnGreen',       '#D2B48C' => 'Tan',             '#FF8C00' => 'Darkorange',
                '#006400' => 'DarkGreen',         '#7FFF00' => 'Chartreuse',      '#D3D3D3' => 'LightGrey',       '#FFA07A' => 'LightSalmon',
                '#008000' => 'Green',             '#7FFFD4' => 'Aquamarine',      '#D3D3D3' => 'LightGray',       '#FFA500' => 'Orange',
                '#008080' => 'Teal',              '#800000' => 'Maroon',          '#D87093' => 'PaleVioletRed',   '#FFB6C1' => 'LightPink',
                '#008B8B' => 'DarkCyan',          '#800080' => 'Purple',          '#D8BFD8' => 'Thistle',         '#FFC0CB' => 'Pink',
                '#00BFFF' => 'DeepSkyBlue',       '#808000' => 'Olive',           '#DA70D6' => 'Orchid',          '#FFD700' => 'Gold',
                '#00CED1' => 'DarkTurquoise',     '#808080' => 'Grey',            '#DAA520' => 'GoldenRod',       '#FFDAB9' => 'PeachPuff',
                '#00FA9A' => 'MediumSpringGreen', '#808080' => 'Gray',            '#DC143C' => 'Crimson',         '#FFDEAD' => 'NavajoWhite',
                '#00FF00' => 'Lime',              '#87CEEB' => 'SkyBlue',         '#DCDCDC' => 'Gainsboro',       '#FFE4B5' => 'Moccasin',
                '#00FF7F' => 'SpringGreen',       '#87CEFA' => 'LightSkyBlue',    '#DDA0DD' => 'Plum',            '#FFE4C4' => 'Bisque',
                '#00FFFF' => 'Aqua',              '#8A2BE2' => 'BlueViolet',      '#DEB887' => 'BurlyWood',       '#FFE4E1' => 'MistyRose',
                '#00FFFF' => 'Cyan',              '#8B0000' => 'DarkRed',         '#E0FFFF' => 'LightCyan',       '#FFEBCD' => 'BlanchedAlmond',
                '#191970' => 'MidnightBlue',      '#8B008B' => 'DarkMagenta',     '#E6E6FA' => 'Lavender',        '#FFEFD5' => 'PapayaWhip',
                '#1E90FF' => 'DodgerBlue',        '#8B4513' => 'SaddleBrown',     '#E9967A' => 'DarkSalmon',      '#FFF0F5' => 'LavenderBlush',
                '#20B2AA' => 'LightSeaGreen',     '#8FBC8F' => 'DarkSeaGreen',    '#EE82EE' => 'Violet',          '#FFF5EE' => 'SeaShell',
                '#228B22' => 'ForestGreen',       '#90EE90' => 'LightGreen',      '#EEE8AA' => 'PaleGoldenRod',   '#FFF8DC' => 'Cornsilk',
                '#2E8B57' => 'SeaGreen',          '#9370D8' => 'MediumPurple',    '#F08080' => 'LightCoral',      '#FFFACD' => 'LemonChiffon',
                '#2F4F4F' => 'DarkSlateGrey',     '#9400D3' => 'DarkViolet',      '#F0E68C' => 'Khaki',           '#FFFAF0' => 'FloralWhite',
                '#2F4F4F' => 'DarkSlateGray',     '#98FB98' => 'PaleGreen',       '#F0F8FF' => 'AliceBlue',       '#FFFAFA' => 'Snow',
                '#32CD32' => 'LimeGreen',         '#9932CC' => 'DarkOrchid',      '#F0FFF0' => 'HoneyDew',        '#FFFF00' => 'Yellow',
                '#3CB371' => 'MediumSeaGreen',    '#9ACD32' => 'YellowGreen',     '#F0FFFF' => 'Azure',           '#FFFFE0' => 'LightYellow',
                '#40E0D0' => 'Turquoise',         '#A0522D' => 'Sienna',          '#F4A460' => 'SandyBrown',      '#FFFFF0' => 'Ivory',
                '#4169E1' => 'RoyalBlue',         '#A52A2A' => 'Brown',           '#F5DEB3' => 'Wheat',           '#FFFFFF' => 'White',
                '#4682B4' => 'SteelBlue',         '#A9A9A9' => 'DarkGrey',        '#F5F5DC' => 'Beige',
                '#483D8B' => 'DarkSlateBlue',     '#A9A9A9' => 'DarkGray',        '#F5F5F5' => 'WhiteSmoke',
                '#48D1CC' => 'MediumTurquoise',   '#ADD8E6' => 'LightBlue',       '#F5FFFA' => 'MintCream',
                '#4B0082' => 'Indigo',            '#ADFF2F' => 'GreenYellow',     '#F8F8FF' => 'GhostWhite',
                '#556B2F' => 'DarkOliveGreen',    '#AFEEEE' => 'PaleTurquoise',   '#FA8072' => 'Salmon',
                '#5F9EA0' => 'CadetBlue',         '#B0C4DE' => 'LightSteelBlue',  '#FAEBD7' => 'AntiqueWhite',
                '#6495ED' => 'CornflowerBlue',    '#B0E0E6' => 'PowderBlue',      '#FAF0E6' => 'Linen',
                '#66CDAA' => 'MediumAquaMarine',  '#B22222' => 'FireBrick',       '#FAFAD2' => 'LightGoldenRodYellow',
                '#696969' => 'DimGrey',           '#B8860B' => 'DarkGoldenRod',   '#FDF5E6' => 'OldLace',
                '#696969' => 'DimGray',           '#BA55D3' => 'MediumOrchid',    '#FF0000' => 'Red',
                '#6A5ACD' => 'SlateBlue',         '#BC8F8F' => 'RosyBrown',       '#FF00FF' => 'Fuchsia',
                '#6B8E23' => 'OliveDrab',         '#BDB76B' => 'DarkKhaki',       '#FF00FF' => 'Magenta',
                '#708090' => 'SlateGrey',         '#C0C0C0' => 'Silver',          '#FF1493' => 'DeepPink',
            );
        }

        if (isset($colorlist[strtoupper($color)])) $color = $colorlist[strtoupper($color)];
    }

    return $color;
}
function TT_is_tapatalk_member($userId)
{
    $ttmember = null;
    try
    {
        if(\IPS\Db::i()->checkForTable('tapatalk_members'))
        {
            $ttmember = \IPS\Db::i()->select( '*', 'tapatalk_members', array( 'member_id=?', $userId ) )->first();
        }
        else{
            $ttmember = \IPS\Member::load($userId);
            if($ttmember->__get('is_tapatalk_member') != 1)
            {
                $ttmember = null;
            }
        }
    }
    catch ( \UnderflowException $e ) {}
    return $ttmember != null;
}
function TT_set_tapatalk_member($userId)
{
    try
    {
        if(!TT_is_tapatalk_member($userId))
        {
            if(\IPS\Db::i()->checkForTable('tapatalk_members'))
            {
                $ttmember = \IPS\Db::i()->insert( 'tapatalk_members', array( 'member_id'=> $userId ) );
            }
            else
            {
                $member = \IPS\Member::load($userId);
                $member->__set('is_tapatalk_member',1);
                $member->save();
            }
        }
    }
    catch ( \UnderflowException $e ) {}
}