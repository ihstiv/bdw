<?php
/**
 * FURL Templates cache. Do not attempt to modify this file.
 * Please modify the relevant 'furlTemplates.php' file in /{app}/extensions/furlTemplates.php
 * and rebuild from the Admin CP
 *
 * Written: Wed, 28 Sep 2016 02:26:22 +0000
 *
 * Why? Because Matt says so.
 */
 $templates = array (
  '__data__' => 
  array (
    'start' => '-',
    'end' => '/',
    'varBlock' => '?',
    'varPage' => 'page-',
    'varSep' => '&',
    'varJoin' => '=',
  ),
  'showuser' => 
  array (
    'app' => 'members',
    'allowRedirect' => 1,
    'out' => 
    array (
      0 => '#showuser=(.+?)((?:&|&amp;)f=(.+?))?(&|$)#i',
      1 => 'user/$1-#{__title__}/$2$4',
    ),
    'in' => 
    array (
      'regex' => '#^/user/(\\d+?)-#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'showuser',
          1 => '$1',
        ),
      ),
    ),
  ),
  'members_status_legacy' => 
  array (
    'app' => 'members',
    'allowRedirect' => 0,
    'out' => 
    array (
      0 => '#app=xxxxx(?:&|&amp;)module=profile(?:&|&amp;)section=status(?:&|&amp;)type=single(&|$)#i',
      1 => 'statuses/user/#{__title-0__}-#{__title-1__}/$1',
    ),
    'newTemplate' => 'members_status_single',
    'in' => 
    array (
      'regex' => '#^/statuses/id/(\\d+?)(/|$|\\?)#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'members',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'profile',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'status',
        ),
        3 => 
        array (
          0 => 'type',
          1 => 'single',
        ),
        4 => 
        array (
          0 => 'status_id',
          1 => '$1',
        ),
      ),
    ),
  ),
  'members_status_single' => 
  array (
    'app' => 'members',
    'allowRedirect' => 0,
    'out' => 
    array (
      0 => '#app=members(?:&|&amp;)module=profile(?:&|&amp;)section=status(?:&|&amp;)type=single(&|$)#i',
      1 => 'statuses/user/#{__title-0__}-#{__title-1__}/$1',
    ),
    'in' => 
    array (
      'regex' => '#^/statuses/user/([^/]+?)/\\{__varBlock__\\}status_id#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'members',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'profile',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'status',
        ),
        3 => 
        array (
          0 => 'type',
          1 => 'single',
        ),
      ),
    ),
  ),
  'members_status_member_all' => 
  array (
    'app' => 'members',
    'allowRedirect' => 0,
    'out' => 
    array (
      0 => '#app=members(?:&|&amp;)module=profile(?:&|&amp;)section=status(?:&|&amp;)type=memberall(?:&|&amp;)member_id=\\d+?(&|$)#i',
      1 => 'statuses/user/#{__title-0__}-#{__title-1__}/$1',
    ),
    'in' => 
    array (
      'regex' => '#^/statuses/user/(\\d+?)-([^/]+?)/(?!\\#\\{__varBlock__\\}status_id)#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'members',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'profile',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'status',
        ),
        3 => 
        array (
          0 => 'member_id',
          1 => '$1',
        ),
      ),
    ),
  ),
  'members_status_friends' => 
  array (
    'app' => 'members',
    'allowRedirect' => 0,
    'out' => 
    array (
      0 => '#app=members(?:&|&amp;)module=profile(?:&|&amp;)section=status(?:&|&amp;)type=friends(&|$)#i',
      1 => 'statuses/friends/$2',
    ),
    'in' => 
    array (
      'regex' => '#^/statuses/friends#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'members',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'profile',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'status',
        ),
        3 => 
        array (
          0 => 'type',
          1 => 'friends',
        ),
      ),
    ),
  ),
  'members_status_all' => 
  array (
    'app' => 'members',
    'allowRedirect' => 0,
    'out' => 
    array (
      0 => '#app=members(?:&|&amp;)module=profile(?:&|&amp;)section=status((?:&|&amp;)type=all)?(&|$)#i',
      1 => 'statuses/all/$2',
    ),
    'in' => 
    array (
      'regex' => '#^/statuses/all#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'members',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'profile',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'status',
        ),
      ),
    ),
  ),
  'members_list' => 
  array (
    'app' => 'members',
    'allowRedirect' => 0,
    'out' => 
    array (
      0 => '#app=members((&|&amp;)module=list)?#i',
      1 => 'members/',
    ),
    'in' => 
    array (
      'regex' => '#^/members(/|$|\\?)#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'members',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'list',
        ),
      ),
    ),
  ),
  'most_liked' => 
  array (
    'app' => 'members',
    'allowRedirect' => 0,
    'out' => 
    array (
      0 => '#app=members(?:&|&amp;)module=reputation(?:&|&amp;)section=most#i',
      1 => 'best-content/',
    ),
    'in' => 
    array (
      'regex' => '#^/best-content(/|$|\\?)#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'members',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'reputation',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'most',
        ),
      ),
    ),
  ),
  'section=register' => 
  array (
    'app' => 'core',
    'allowRedirect' => 0,
    'out' => 
    array (
      0 => '#app=core(&amp;|&)module=global(&amp;|&)section=register(&amp;|&|$)#i',
      1 => 'register/$3',
    ),
    'in' => 
    array (
      'regex' => '#/register(/|$|\\?)#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'core',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'global',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'register',
        ),
      ),
    ),
  ),
  'tags' => 
  array (
    'app' => 'core',
    'isPagesMode' => true,
    'allowRedirect' => 0,
    'out' => 
    array (
      0 => '#app=core(&amp;|&)module=search(&amp;|&)do=search(&amp;|&)search_tags=(\\S+?)(&amp;|&)search_app=(\\S+?)(&amp;|&|$)#i',
      1 => 'tags/$6/$4/$7',
    ),
    'in' => 
    array (
      'regex' => '#/tags/(\\S+?)/(\\S+?)/#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'core',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'search',
        ),
        2 => 
        array (
          0 => 'do',
          1 => 'search',
        ),
        3 => 
        array (
          0 => 'search_tags',
          1 => '$2',
        ),
        4 => 
        array (
          0 => 'search_app',
          1 => '$1',
        ),
      ),
    ),
  ),
  'privacy' => 
  array (
    'app' => 'core',
    'allowRedirect' => 0,
    'out' => 
    array (
      0 => '#app=core(&amp;|&)module=global(&amp;|&)section=privacy(&amp;|&|$)#i',
      1 => 'privacypolicy/$4/',
    ),
    'in' => 
    array (
      'regex' => '#/privacypolicy/#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'core',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'global',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'privacy',
        ),
      ),
    ),
  ),
  'likeunsubscribe' => 
  array (
    'app' => 'core',
    'allowRedirect' => 0,
    'out' => 
    array (
      0 => '#app=core(&amp;|&)module=global(&amp;|&)section=like(&amp;|&)do=unsubscribe(&amp;|&)key=(\\S+?)(&amp;|&|$)#i',
      1 => 'unsubscribe/$5/',
    ),
    'in' => 
    array (
      'regex' => '#/unsubscribe/(\\S+?)/$#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'core',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'global',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'like',
        ),
        3 => 
        array (
          0 => 'do',
          1 => 'unsubscribe',
        ),
        4 => 
        array (
          0 => 'key',
          1 => '$1',
        ),
      ),
    ),
  ),
  'findcomment' => 
  array (
    'app' => 'core',
    'allowRedirect' => 0,
    'out' => 
    array (
      0 => '#app=core(&amp;|&)module=global(&amp;|&)section=comments(&amp;|&)do=findComment(&amp;|&)fromApp=(\\S+?)(&amp;|&)parentId=(\\d+?)(&amp;|&)commentId=(\\d+?)(&amp;|&|$)#i',
      1 => 'findComment/$5/$7-$9',
    ),
    'in' => 
    array (
      'regex' => '#/findComment/(\\S+?-\\S+?)/(\\d+?)-(\\d+?)$#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'core',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'global',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'comments',
        ),
        3 => 
        array (
          0 => 'do',
          1 => 'findComment',
        ),
        4 => 
        array (
          0 => 'fromApp',
          1 => '$1',
        ),
        5 => 
        array (
          0 => 'parentId',
          1 => '$2',
        ),
        6 => 
        array (
          0 => 'commentId',
          1 => '$3',
        ),
      ),
    ),
  ),
  'section=rss' => 
  array (
    'app' => 'core',
    'allowRedirect' => 0,
    'out' => 
    array (
      0 => '#app=core(&amp;|&)module=global(&amp;|&)section=rss(&amp;|&)type=(\\w+?)$#i',
      1 => 'rss/$4/',
    ),
    'in' => 
    array (
      'regex' => '#/rss/(\\w+?)/$#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'core',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'global',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'rss',
        ),
        3 => 
        array (
          0 => 'type',
          1 => '$1',
        ),
      ),
    ),
  ),
  'section=rss2' => 
  array (
    'app' => 'core',
    'allowRedirect' => 0,
    'out' => 
    array (
      0 => '#app=core(&amp;|&)module=global(&amp;|&)section=rss(&amp;|&)type=(\\w+?)(&amp;|&)id=(\\w+?)$#i',
      1 => 'rss/$4/$6-#{__title__}/',
    ),
    'in' => 
    array (
      'regex' => '#/rss/(\\w+?)/(\\w+?)-#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'core',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'global',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'rss',
        ),
        3 => 
        array (
          0 => 'type',
          1 => '$1',
        ),
        4 => 
        array (
          0 => 'id',
          1 => '$2',
        ),
      ),
    ),
  ),
  'showannouncement' => 
  array (
    'app' => 'forums',
    'allowRedirect' => 1,
    'out' => 
    array (
      0 => '#showannouncement=(.+?)((?:&|&amp;)f=(.+?))?(&|$)#i',
      1 => 'forum-$3/announcement-$1-#{__title__}/$4',
    ),
    'in' => 
    array (
      'regex' => '#/forum-(\\d+?)?/announcement-(\\d+?)-#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'showannouncement',
          1 => '$2',
        ),
        1 => 
        array (
          0 => 'f',
          1 => '$1',
        ),
      ),
    ),
  ),
  'showforum' => 
  array (
    'app' => 'forums',
    'allowRedirect' => 1,
    'isPagesMode' => 1,
    'out' => 
    array (
      0 => '#showforum=(.+?)(&|$)#i',
      1 => 'forum/$1-#{__title__}/$2',
    ),
    'in' => 
    array (
      'regex' => '#^/forum/(\\d+?)-#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'showforum',
          1 => '$1',
        ),
      ),
    ),
  ),
  'showtopic' => 
  array (
    'app' => 'forums',
    'allowRedirect' => 1,
    'isPagesMode' => 1,
    'out' => 
    array (
      0 => '#showtopic=(.+?)(\\#|&|$)#i',
      1 => 'topic/$1-#{__title__}/$2',
    ),
    'in' => 
    array (
      'regex' => '#^/topic/(\\d+?)-#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'showtopic',
          1 => '$1',
        ),
      ),
    ),
  ),
  'acteqst' => 
  array (
    'app' => 'forums',
    'allowRedirect' => 1,
    'out' => 
    array (
      0 => '#act=ST(.*?)&t=(.+?)(&|$)#i',
      1 => 'topic/$2-#{__title__}/$3',
    ),
    'in' => 
    array (
      'regex' => '#^notavalidrequest$#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'showtopic',
          1 => '0',
        ),
      ),
    ),
  ),
  'act=idx' => 
  array (
    'app' => 'forums',
    'allowRedirect' => 0,
    'out' => 
    array (
      0 => '#act=idx(&|$)#i',
      1 => 'forum/$1',
    ),
    'in' => 
    array (
      'regex' => '#^/forum(/|$|\\?)#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'act',
          1 => 'idx',
        ),
      ),
    ),
  ),
  'cal_event' => 
  array (
    'app' => 'calendar',
    'allowRedirect' => 1,
    'out' => 
    array (
      0 => '#app=calendar(?:&|&amp;)module=calendar(?:&|&amp;)section=view(?:&|&amp;)do=showevent(?:&|&amp;)event_id=(\\d+?)(&|$)#i',
      1 => 'calendar/event/$1-#{__title__}/$2',
    ),
    'in' => 
    array (
      'regex' => '#/calendar/event/(\\d+?)-([^/]+?)(/|$)#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'calendar',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'calendar',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'view',
        ),
        3 => 
        array (
          0 => 'do',
          1 => 'showevent',
        ),
        4 => 
        array (
          0 => 'event_id',
          1 => '$1',
        ),
      ),
    ),
  ),
  'cal_post' => 
  array (
    'app' => 'calendar',
    'allowRedirect' => 1,
    'out' => 
    array (
      0 => '#app=calendar(?:&|&amp;)module=calendar(?:&|&amp;)section=post(?:&|&amp;)cal_id=(.+?)(?:&|&amp;)do=newevent#i',
      1 => 'calendar/$1-#{__title__}/add',
    ),
    'in' => 
    array (
      'regex' => '#/calendar/(\\d+?)-([^/]+?)/add(/|$|\\?)#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'calendar',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'calendar',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'post',
        ),
        3 => 
        array (
          0 => 'do',
          1 => 'newevent',
        ),
        4 => 
        array (
          0 => 'cal_id',
          1 => '$1',
        ),
      ),
    ),
  ),
  'cal_day' => 
  array (
    'app' => 'calendar',
    'allowRedirect' => 1,
    'out' => 
    array (
      0 => '#app=calendar(?:&|&amp;)module=calendar(?:&|&amp;)section=view(?:&|&amp;)cal_id=(.+?)(?:&|&amp;)do=showday(?:&|&amp;)y=(.+?)(?:&|&amp;)m=(.+?)(?:&|&amp;)d=(.+?)(&|$)#i',
      1 => 'calendar/$1-#{__title__}/day-$2-$3-$4$5',
    ),
    'in' => 
    array (
      'regex' => '#/calendar/(\\d+?)-([^/]+?)/day-(\\d+?)-(\\d+?)-(\\d+?)(/|$)#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'calendar',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'calendar',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'view',
        ),
        3 => 
        array (
          0 => 'do',
          1 => 'showday',
        ),
        4 => 
        array (
          0 => 'cal_id',
          1 => '$1',
        ),
        5 => 
        array (
          0 => 'y',
          1 => '$3',
        ),
        6 => 
        array (
          0 => 'm',
          1 => '$4',
        ),
        7 => 
        array (
          0 => 'd',
          1 => '$5',
        ),
      ),
    ),
  ),
  'cal_week' => 
  array (
    'app' => 'calendar',
    'allowRedirect' => 1,
    'out' => 
    array (
      0 => '#app=calendar(?:&|&amp;)module=calendar(?:&|&amp;)section=view(?:&|&amp;)cal_id=(\\d+?)(?:&|&amp;)do=showweek(?:&|&amp;)week=(.+?)(?:&|$)#i',
      1 => 'calendar/$1-#{__title__}/week-$2',
    ),
    'in' => 
    array (
      'regex' => '#/calendar/(\\d+?)-([^/]+?)/week-(.+?)(/|$)#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'calendar',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'calendar',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'view',
        ),
        3 => 
        array (
          0 => 'do',
          1 => 'showweek',
        ),
        4 => 
        array (
          0 => 'cal_id',
          1 => '$1',
        ),
        5 => 
        array (
          0 => 'week',
          1 => '$3',
        ),
      ),
    ),
  ),
  'cal_month' => 
  array (
    'app' => 'calendar',
    'allowRedirect' => 1,
    'out' => 
    array (
      0 => '#app=calendar(?:&|&amp;)module=calendar(?:&|&amp;)section=view(?:&|&amp;)cal_id=(.+?)(?:&|&amp;)m=(.+?)(?:&|&amp;)y=(.+?)(?:&|$)#i',
      1 => 'calendar/$1-#{__title__}/$2-$3',
    ),
    'in' => 
    array (
      'regex' => '#/calendar/(\\d+?)-([^/]+?)/(\\d+?)-(\\d+?)(/|$)#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'calendar',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'calendar',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'view',
        ),
        3 => 
        array (
          0 => 'cal_id',
          1 => '$1',
        ),
        4 => 
        array (
          0 => 'm',
          1 => '$3',
        ),
        5 => 
        array (
          0 => 'y',
          1 => '$4',
        ),
      ),
    ),
  ),
  'cal_calendar' => 
  array (
    'app' => 'calendar',
    'allowRedirect' => 1,
    'out' => 
    array (
      0 => '#app=calendar(?:&|&amp;)module=calendar(?:&|&amp;)section=view(?:&|&amp;)cal_id=(.+?)(&|$)#i',
      1 => 'calendar/$1-#{__title__}',
    ),
    'in' => 
    array (
      'regex' => '#/calendar/(\\d+?)-([^/]+?)(/|$)#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'calendar',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'calendar',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'view',
        ),
        3 => 
        array (
          0 => 'cal_id',
          1 => '$1',
        ),
      ),
    ),
  ),
  'app=calendar' => 
  array (
    'app' => 'calendar',
    'allowRedirect' => 1,
    'out' => 
    array (
      0 => '#app=calendar$#i',
      1 => 'calendar/',
    ),
    'in' => 
    array (
      'regex' => '#/calendar(/|$|\\?)#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'calendar',
        ),
      ),
    ),
  ),
  'blogcatview' => 
  array (
    'app' => 'blog',
    'allowRedirect' => 1,
    'out' => 
    array (
      0 => '/app=blog(?:(?:&|&amp;))blogid=(.+?)(?:(?:&|&amp;))cat=(.+?)(&|$)/i',
      1 => 'blog/blog-$1/cat-$2-#{__title__}',
    ),
    'in' => 
    array (
      'regex' => '#/blog/blog-(\\d+?)/cat-(\\d+?)-#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'blog',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'display',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'blog',
        ),
        3 => 
        array (
          0 => 'blogid',
          1 => '$1',
        ),
        4 => 
        array (
          0 => 'cat',
          1 => '$2',
        ),
      ),
    ),
  ),
  'showentry' => 
  array (
    'app' => 'blog',
    'allowRedirect' => 1,
    'out' => 
    array (
      0 => '/app=blog(?:(?:&|&amp;)module=display(?:&|&amp;)section=blog)?(?:&|&amp;)blogid=(.+?)(?:&|&amp;)showentry=(.+?)(&|$)/i',
      1 => 'blog/$1/entry-$2-#{__title__}/$3',
    ),
    'in' => 
    array (
      'regex' => '#/blog/(\\d+?)/entry-(\\d+?)-#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'blog',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'display',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'blog',
        ),
        3 => 
        array (
          0 => 'blogid',
          1 => '$1',
        ),
        4 => 
        array (
          0 => 'showentry',
          1 => '$2',
        ),
      ),
    ),
  ),
  'showblog' => 
  array (
    'app' => 'blog',
    'allowRedirect' => 1,
    'out' => 
    array (
      0 => '/app=blog(?:(?:(?:&|&amp;))module=display(?:(?:&|&amp;))section=blog)?(?:(?:&|&amp;))blogid=(.+?)(&|&amp;|$)/i',
      1 => 'blog/$1-#{__title__}/$2',
    ),
    'in' => 
    array (
      'regex' => '#/blog/(\\d+?)-#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'blog',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'display',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'blog',
        ),
        3 => 
        array (
          0 => 'blogid',
          1 => '$1',
        ),
      ),
    ),
  ),
  'manageblog' => 
  array (
    'app' => 'blog',
    'allowRedirect' => 1,
    'out' => 
    array (
      0 => '/app=blog(?:&|&amp;)module=manage(&|&amp;|$|#)/i',
      1 => 'blog/manage/$1',
    ),
    'in' => 
    array (
      'regex' => '#/blog/manage#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'blog',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'manage',
        ),
      ),
    ),
  ),
  'createblog' => 
  array (
    'app' => 'blog',
    'allowRedirect' => 1,
    'out' => 
    array (
      0 => '/app=blog(?:&|&amp;)module=manage(?:(?:&|&amp;))section=dashboard(?:(?:&|&amp;))act=create(&|&amp;|$|#)/i',
      1 => 'blog/create/$1',
    ),
    'in' => 
    array (
      'regex' => '#/blog/create#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'blog',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'manage',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'dashboard',
        ),
        3 => 
        array (
          0 => 'act',
          1 => 'create',
        ),
      ),
    ),
  ),
  'blogarchive' => 
  array (
    'app' => 'blog',
    'allowRedirect' => 1,
    'out' => 
    array (
      0 => '/app=blog(?:&|&amp;)module=display(?:&|&amp;)section=archive(?:&|&amp;)blogid=(.+?)(&|$)/i',
      1 => 'blog/archive/$1-#{__title__}/$2',
    ),
    'in' => 
    array (
      'regex' => '#/blog/archive/(\\d+?)-#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'blog',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'display',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'archive',
        ),
        3 => 
        array (
          0 => 'blogid',
          1 => '$1',
        ),
      ),
    ),
  ),
  'blogrss' => 
  array (
    'app' => 'blog',
    'allowRedirect' => 1,
    'out' => 
    array (
      0 => '/app=core&amp;module=global&amp;section=rss&amp;type=blog&amp;blogid=(.+?)(&|$)/i',
      1 => 'blog/rss/$1-#{__title__}/$2',
    ),
    'in' => 
    array (
      'regex' => '#/blog/rss/(\\d+?)-#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'core',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'global',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'rss',
        ),
        3 => 
        array (
          0 => 'type',
          1 => 'blog',
        ),
        4 => 
        array (
          0 => 'blogid',
          1 => '$1',
        ),
      ),
    ),
  ),
  'app=blog' => 
  array (
    'app' => 'blog',
    'allowRedirect' => 1,
    'out' => 
    array (
      0 => '/app=blog/i',
      1 => 'blogs/',
    ),
    'in' => 
    array (
      'regex' => '#^/blogs(/|$|\\?)#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'blog',
        ),
      ),
    ),
  ),
  'viewsizes' => 
  array (
    'app' => 'gallery',
    'allowRedirect' => 1,
    'out' => 
    array (
      0 => '/app=gallery(?:(?:&|&amp;))image=(.+?)(?:(?:&|&amp;))size=(.+?)(&|$)/i',
      1 => 'gallery/sizes/$1-#{__title__}/$2/$3',
    ),
    'in' => 
    array (
      'regex' => '#^/gallery/sizes/(\\d+?)-(.+?)/(?:(.+?)(/|$))?#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'gallery',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'images',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'sizes',
        ),
        3 => 
        array (
          0 => 'image',
          1 => '$1',
        ),
        4 => 
        array (
          0 => 'size',
          1 => '$3',
        ),
      ),
    ),
  ),
  'viewimage' => 
  array (
    'app' => 'gallery',
    'allowRedirect' => 1,
    'out' => 
    array (
      0 => '/app=gallery(?:(?:&|&amp;))image=(.+?)(&|$)/i',
      1 => 'gallery/image/$1-#{__title__}/$2',
    ),
    'in' => 
    array (
      'regex' => '#^/gallery/image/(\\d+?)-#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'gallery',
        ),
        1 => 
        array (
          0 => 'image',
          1 => '$1',
        ),
      ),
    ),
  ),
  'slideshow' => 
  array (
    'app' => 'gallery',
    'allowRedirect' => 1,
    'out' => 
    array (
      0 => '/app=gallery(?:(?:&|&amp;))module=images(?:(?:&|&amp;))section=slideshow(?:(?:&|&amp;))type=(album|category)(?:(?:&|&amp;))typeid=(.+?)(&|$)/i',
      1 => 'gallery/slideshow/$1-$2/$3',
    ),
    'in' => 
    array (
      'regex' => '#^/gallery/slideshow/(album|category)-(\\d+?)(/|$)#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'gallery',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'images',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'slideshow',
        ),
        3 => 
        array (
          0 => 'type',
          1 => '$1',
        ),
        4 => 
        array (
          0 => 'typeid',
          1 => '$2',
        ),
      ),
    ),
  ),
  'editalbum' => 
  array (
    'app' => 'gallery',
    'allowRedirect' => 1,
    'out' => 
    array (
      0 => '/app=gallery(?:(?:&|&amp;))albumedit=(.+?)(&|$)/i',
      1 => 'gallery/album/$1-#{__title__}/edit/$2',
    ),
    'in' => 
    array (
      'regex' => '#^/gallery/album/(\\d+?)-(.+?)/edit(/|$)#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'gallery',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'images',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'review',
        ),
        3 => 
        array (
          0 => 'album_id',
          1 => '$1',
        ),
      ),
    ),
  ),
  'viewalbum' => 
  array (
    'app' => 'gallery',
    'allowRedirect' => 1,
    'out' => 
    array (
      0 => '/app=gallery(?:(?:&|&amp;))(?:module=user(?:&|&amp;)user=\\d+?(?:&|&amp;)do=view_album(?:&|&amp;))?album=(.+?)(&|$)/i',
      1 => 'gallery/album/$1-#{__title__}/$2',
    ),
    'in' => 
    array (
      'regex' => '#^/gallery/album/(\\d+?)-#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'gallery',
        ),
        1 => 
        array (
          0 => 'album',
          1 => '$1',
        ),
      ),
    ),
  ),
  'viewcategory' => 
  array (
    'app' => 'gallery',
    'allowRedirect' => 0,
    'out' => 
    array (
      0 => '/app=gallery(?:&|&amp;)category=(\\d+?)(&|$)/i',
      1 => 'gallery/category/$1-#{__title__}/$2',
    ),
    'in' => 
    array (
      'regex' => '#^/gallery/category/(\\d+?)-#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'gallery',
        ),
        1 => 
        array (
          0 => 'category',
          1 => '$1',
        ),
      ),
    ),
  ),
  'galleryrss' => 
  array (
    'app' => 'gallery',
    'allowRedirect' => 1,
    'out' => 
    array (
      0 => '/app=gallery(?:(?:&|&amp;))module=albums(?:(?:&|&amp;))section=rss(?:(?:&|&amp;))type=(album|category)(?:(?:&|&amp;))typeid=(\\d+?)(&|$)/i',
      1 => 'gallery/rssfeed/#{__title__}/$1-$2/$3',
    ),
    'in' => 
    array (
      'regex' => '#^/gallery/rssfeed/(.+?)/(album|category)-(\\d+?)(/|$)#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'gallery',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'albums',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'rss',
        ),
        3 => 
        array (
          0 => 'type',
          1 => '$2',
        ),
        4 => 
        array (
          0 => 'typeid',
          1 => '$3',
        ),
      ),
    ),
  ),
  'useralbum' => 
  array (
    'app' => 'gallery',
    'allowRedirect' => 1,
    'out' => 
    array (
      0 => '/app=gallery(?:(?:&|&amp;))user=(.+?)(&|$)/i',
      1 => 'gallery/member/$1-#{__title__}/$2',
    ),
    'in' => 
    array (
      'regex' => '#^/gallery/member/(\\d+?)-#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'gallery',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'albums',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'user',
        ),
        3 => 
        array (
          0 => 'member_id',
          1 => '$1',
        ),
      ),
    ),
  ),
  'app=gallery' => 
  array (
    'app' => 'gallery',
    'allowRedirect' => 1,
    'out' => 
    array (
      0 => '/app=gallery/i',
      1 => 'gallery/',
    ),
    'in' => 
    array (
      'regex' => '#^/gallery(/|$|\\?)#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'gallery',
        ),
      ),
    ),
  ),
  'page' => 
  array (
    'app' => 'ccs',
    'allowRedirect' => 1,
    'out' => 
    array (
      0 => '#app=ccs(?:&amp;|&)module=pages(?:&amp;|&)section=pages(?:&amp;|&)(?:folder=(.*?)(?:&amp;|&))(?:id|page)=(.+?)(&|$)#i',
      1 => 'page/$1/#{__title__}',
    ),
    'in' => 
    array (
      'regex' => '#/page(/.*?)?/([^/]+?)(\\/|\\?|$)#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'ccs',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'pages',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'pages',
        ),
        3 => 
        array (
          0 => 'folder',
          1 => '$1',
        ),
        4 => 
        array (
          0 => 'page',
          1 => '$2',
        ),
      ),
    ),
  ),
  'store-featured' => 
  array (
    'app' => 'nexus',
    'allowRedirect' => 0,
    'out' => 
    array (
      0 => '/app=nexus(?:(?:&|&amp;))module=payments(?:(?:&|&amp;))section=store(?:(?:&|&amp;))featured=1(?:(?:&|&amp;))view=(\\w+)/i',
      1 => 'store/featured-$1/',
    ),
    'in' => 
    array (
      'regex' => '#/store/featured-(\\w+)/?$#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'nexus',
        ),
        1 => 
        array (
          0 => 'featured',
          1 => '1',
        ),
        2 => 
        array (
          0 => 'view',
          1 => '$1',
        ),
      ),
    ),
  ),
  'store-popular' => 
  array (
    'app' => 'nexus',
    'allowRedirect' => 0,
    'out' => 
    array (
      0 => '/app=nexus(?:(?:&|&amp;))module=payments(?:(?:&|&amp;))section=store(?:(?:&|&amp;))popular=1(?:(?:&|&amp;))view=(\\w+)/i',
      1 => 'store/popular-$1/',
    ),
    'in' => 
    array (
      'regex' => '#/store/popular-(\\w+)/?$#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'nexus',
        ),
        1 => 
        array (
          0 => 'popular',
          1 => '1',
        ),
        2 => 
        array (
          0 => 'view',
          1 => '$1',
        ),
      ),
    ),
  ),
  'store-latest' => 
  array (
    'app' => 'nexus',
    'allowRedirect' => 0,
    'out' => 
    array (
      0 => '/app=nexus(?:(?:&|&amp;))module=payments(?:(?:&|&amp;))section=store(?:(?:&|&amp;))latest=1(?:(?:&|&amp;))view=(\\w+)/i',
      1 => 'store/latest-$1/',
    ),
    'in' => 
    array (
      'regex' => '#/store/latest-(\\w+)/?$#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'nexus',
        ),
        1 => 
        array (
          0 => 'latest',
          1 => '1',
        ),
        2 => 
        array (
          0 => 'view',
          1 => '$1',
        ),
      ),
    ),
  ),
  'storecat' => 
  array (
    'app' => 'nexus',
    'allowRedirect' => 0,
    'out' => 
    array (
      0 => '/app=nexus(?:(?:&|&amp;))module=payments(?:(?:&|&amp;))cat=(\\d+)/i',
      1 => 'store/category/$1-#{__title__}/',
    ),
    'in' => 
    array (
      'regex' => '#/store/category/(\\d+?)-#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'nexus',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'payments',
        ),
        2 => 
        array (
          0 => 'cat',
          1 => '$1',
        ),
      ),
    ),
  ),
  'storeitem' => 
  array (
    'app' => 'nexus',
    'allowRedirect' => 0,
    'out' => 
    array (
      0 => '/app=nexus(?:(?:&|&amp;))module=payments(?:(?:&|&amp;))section=store(?:(?:&|&amp;))do=item(?:(?:&|&amp;))id=(\\d+)/i',
      1 => 'store/product/$1-#{__title__}/',
    ),
    'in' => 
    array (
      'regex' => '#/store/product/(\\d+?)-#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'nexus',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'payments',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'store',
        ),
        3 => 
        array (
          0 => 'do',
          1 => 'item',
        ),
        4 => 
        array (
          0 => 'id',
          1 => '$1',
        ),
      ),
    ),
  ),
  'storecart' => 
  array (
    'app' => 'nexus',
    'allowRedirect' => 0,
    'out' => 
    array (
      0 => '/app=nexus(?:(?:&|&amp;))module=payments(?:(?:&|&amp;))do=view/i',
      1 => 'store/cart/',
    ),
    'in' => 
    array (
      'regex' => '#/store/cart/?#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'nexus',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'payments',
        ),
        2 => 
        array (
          0 => 'do',
          1 => 'view',
        ),
      ),
    ),
  ),
  'gift_vouchers' => 
  array (
    'app' => 'nexus',
    'allowRedirect' => 0,
    'out' => 
    array (
      0 => '/app=nexus(?:(?:&|&amp;))module=payments(?:(?:&|&amp;))do=vouchers/i',
      1 => 'store/gift-vouchers/',
    ),
    'in' => 
    array (
      'regex' => '#/store/gift-vouchers/?#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'nexus',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'payments',
        ),
        2 => 
        array (
          0 => 'do',
          1 => 'vouchers',
        ),
      ),
    ),
  ),
  'redeem' => 
  array (
    'app' => 'nexus',
    'allowRedirect' => 0,
    'out' => 
    array (
      0 => '/app=nexus(?:(?:&|&amp;))module=payments(?:(?:&|&amp;))do=redeem/i',
      1 => 'store/redeem/',
    ),
    'in' => 
    array (
      'regex' => '#/store/redeem/?#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'nexus',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'payments',
        ),
        2 => 
        array (
          0 => 'do',
          1 => 'redeem',
        ),
      ),
    ),
  ),
  'network-status' => 
  array (
    'app' => 'nexus',
    'allowRedirect' => 0,
    'out' => 
    array (
      0 => '/app=nexus(?:(?:&|&amp;))module=clients(?:(?:&|&amp;))section=status/i',
      1 => 'network-status/',
    ),
    'in' => 
    array (
      'regex' => '#/network-status/?#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'nexus',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'clients',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'status',
        ),
      ),
    ),
  ),
  'app=nexus' => 
  array (
    'app' => 'nexus',
    'allowRedirect' => 1,
    'out' => 
    array (
      0 => '/app=nexus((?:(?:&amp;|&))module=payments(?:(?:&amp;|&))section=store)?/i',
      1 => 'store/',
    ),
    'in' => 
    array (
      'regex' => '#/store(/|$|\\?)#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'nexus',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'payments',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'store',
        ),
      ),
    ),
  ),
  'app=contactus' => 
  array (
    'app' => 'contactus',
    'allowRedirect' => 1,
    'out' => 
    array (
      0 => '#app=contactus#i',
      1 => 'contactus/',
    ),
    'in' => 
    array (
      'regex' => '#/contactus($|\\/)#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'contactus',
        ),
      ),
    ),
  ),
  'advertise' => 
  array (
    'app' => 'contactus',
    'allowRedirect' => 1,
    'out' => 
    array (
      0 => '#app=contactus#i',
      1 => 'advertise/',
    ),
    'in' => 
    array (
      'regex' => '#/advertise($|\\/)#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'contactus',
        ),
        1 => 
        array (
          0 => 'dept',
          1 => 'ads',
        ),
      ),
    ),
  ),
  'reff_mask' => 
  array (
    'app' => 'referrals',
    'allowRedirect' => 1,
    'out' => 
    array (
      0 => '#app=referrals(?:&|&amp;)reff=(.+?)#i',
      1 => 'r/$1',
    ),
    'in' => 
    array (
      'regex' => '#^/r/(.+?)($|\\/)#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'referrals',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'core',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'main',
        ),
        3 => 
        array (
          0 => 'do',
          1 => 'checkRefferal',
        ),
        4 => 
        array (
          0 => 'reff',
          1 => '$1',
        ),
        5 => 
        array (
          0 => 'fromFurl',
          1 => '1',
        ),
      ),
    ),
  ),
  'reff_key' => 
  array (
    'app' => 'referrals',
    'allowRedirect' => 1,
    'out' => 
    array (
      0 => '#app=referrals(?:&|&amp;)key=(.+?)#i',
      1 => 'key/$1',
    ),
    'in' => 
    array (
      'regex' => '#/key/(.+?)($|\\/)#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'referrals',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'core',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'invite',
        ),
        3 => 
        array (
          0 => 'do',
          1 => 'receiveValidate',
        ),
        4 => 
        array (
          0 => 'key',
          1 => '$1',
        ),
      ),
    ),
  ),
  'REST_tos' => 
  array (
    'app' => 'REST_Service',
    'allow_redirect' => 1,
    'out' => 
    array (
      0 => '#app=REST_Service&amp;module=links&amp;section=links&amp;do=tos#i',
      1 => 'REST/tos',
    ),
    'in' => 
    array (
      'regex' => '#^/REST/tos(/$|$)#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'REST_Service',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'links',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'links',
        ),
        3 => 
        array (
          0 => 'do',
          1 => 'tos',
        ),
      ),
    ),
  ),
  'REST_Search' => 
  array (
    'app' => 'REST_Service',
    'allow_redirect' => 1,
    'out' => 
    array (
      0 => '#REST=search&amp;application=(.+?)&amp;type=(.+?)(&|$)#i',
      1 => 'REST/search/$1/$2/$3',
    ),
    'in' => 
    array (
      'regex' => '#^/REST/search/(.+?)(/(.+?))?(&|$)#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'REST_Service',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'REST',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'search',
        ),
        3 => 
        array (
          0 => 'application',
          1 => '$1',
        ),
        4 => 
        array (
          0 => 'type',
          1 => '$3',
        ),
      ),
    ),
  ),
  'REST' => 
  array (
    'app' => 'REST_Service',
    'allow_redirect' => 1,
    'out' => 
    array (
      0 => '#REST=run&amp;application=(.+?)&amp;class=(.+?)(&amp;operation=(.+?))(&|$)#i',
      1 => 'REST/$1/$2/$4/$5',
    ),
    'in' => 
    array (
      'regex' => '#^/REST/(.+?)/(.+?)(/(.+?))?(&|$)#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'REST_Service',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'REST',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'run',
        ),
        3 => 
        array (
          0 => 'application',
          1 => '$1',
        ),
        4 => 
        array (
          0 => 'class',
          1 => '$2',
        ),
        5 => 
        array (
          0 => 'operation',
          1 => '$4',
        ),
      ),
    ),
  ),
  'showrevcategory' => 
  array (
    'app' => 'reviews',
    'allowRedirect' => 0,
    'out' => 
    array (
      0 => '/app=reviews(?:(?:&|&amp;))module=products(?:(?:&|&amp;))section=categories(?:(?:&|&amp;))do=viewcat(?:(?:&|&amp;))cid=(.+?)(?:(?:&|&amp;))sort=(.+?)(&|$)/i',
      1 => 'reviews/c/$1-#{__title__}/$2/$3',
    ),
    'in' => 
    array (
      'regex' => '#^/reviews/c/(\\d+)-[^/]+/([^/]+)/#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'reviews',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'products',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'categories',
        ),
        3 => 
        array (
          0 => 'do',
          1 => 'viewcat',
        ),
        4 => 
        array (
          0 => 'cid',
          1 => '$1',
        ),
        5 => 
        array (
          0 => 'sort',
          1 => '$2',
        ),
      ),
    ),
  ),
  'showrevcategorytwo' => 
  array (
    'app' => 'reviews',
    'allowRedirect' => 1,
    'out' => 
    array (
      0 => '/app=reviews(?:(?:&|&amp;))module=products(?:(?:&|&amp;))section=categories(?:(?:&|&amp;))do=viewcat(?:(?:&|&amp;))cid=(.+?)(&|$)/i',
      1 => 'reviews/c/$1-#{__title__}/$2',
    ),
    'in' => 
    array (
      'regex' => '#^/reviews/c/(\\d+?)-#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'reviews',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'products',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'categories',
        ),
        3 => 
        array (
          0 => 'do',
          1 => 'viewcat',
        ),
        4 => 
        array (
          0 => 'cid',
          1 => '$1',
        ),
      ),
    ),
  ),
  'showrevcomments' => 
  array (
    'app' => 'reviews',
    'allowRedirect' => 0,
    'out' => 
    array (
      0 => '/app=reviews(?:(?:&|&amp;))module=extra(?:(?:&|&amp;))section=comment(?:(?:&|&amp;))do=comments(?:(?:&|&amp;))id=(.+?)(&|$)/i',
      1 => 'reviews/products/comments/$1-#{__title__}/$2',
    ),
    'in' => 
    array (
      'regex' => '#^/reviews/products/comments/(\\d+?)-#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'reviews',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'extra',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'comment',
        ),
        3 => 
        array (
          0 => 'do',
          1 => 'comments',
        ),
        4 => 
        array (
          0 => 'id',
          1 => '$1',
        ),
      ),
    ),
  ),
  'showrevfaq' => 
  array (
    'app' => 'reviews',
    'allowRedirect' => 0,
    'out' => 
    array (
      0 => '/app=reviews(?:(?:&|&amp;))module=products(?:(?:&|&amp;))section=faq(?:(?:&|&amp;))do=faq(?:(?:&|&amp;))id=(.+?)(&|$)/i',
      1 => 'reviews/products/faq/$1-#{__title__}/$2',
    ),
    'in' => 
    array (
      'regex' => '#^/reviews/products/faq/(\\d+?)-#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'reviews',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'products',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'faq',
        ),
        3 => 
        array (
          0 => 'do',
          1 => 'faq',
        ),
        4 => 
        array (
          0 => 'id',
          1 => '$1',
        ),
      ),
    ),
  ),
  'showrevalldeals' => 
  array (
    'app' => 'reviews',
    'allowRedirect' => 0,
    'out' => 
    array (
      0 => '/app=reviews(?:(?:&|&amp;))module=products(?:(?:&|&amp;))section=deals(?:(?:&|&amp;))do=deals_page/i',
      1 => 'reviews/products/deals/all/$1',
    ),
    'in' => 
    array (
      'regex' => '#^/reviews/products/deals/all/#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'reviews',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'products',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'deals',
        ),
        3 => 
        array (
          0 => 'do',
          1 => 'deals_page',
        ),
      ),
    ),
  ),
  'showrevproddeals' => 
  array (
    'app' => 'reviews',
    'allowRedirect' => 0,
    'out' => 
    array (
      0 => '/app=reviews(?:(?:&|&amp;))module=products(?:(?:&|&amp;))section=deals(?:(?:&|&amp;))do=cat_deals(?:(?:&|&amp;))id=(.+?)(&|$)/i',
      1 => 'reviews/products/deals/$1-#{__title__}/$2',
    ),
    'in' => 
    array (
      'regex' => '#^/reviews/products/deals/(\\d+?)-#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'reviews',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'products',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'deals',
        ),
        3 => 
        array (
          0 => 'do',
          1 => 'cat_deals',
        ),
        4 => 
        array (
          0 => 'id',
          1 => '$1',
        ),
      ),
    ),
  ),
  'showrevauthors' => 
  array (
    'app' => 'reviews',
    'allowRedirect' => 0,
    'out' => 
    array (
      0 => '/app=reviews(?:(?:&|&amp;))module=authors(?:(?:&|&amp;))section=content(?:(?:&|&amp;))do=authors/i',
      1 => 'reviews/authors/stats/$1',
    ),
    'in' => 
    array (
      'regex' => '#^/reviews/authors/stats/#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'reviews',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'authors',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'content',
        ),
        3 => 
        array (
          0 => 'do',
          1 => 'authors',
        ),
      ),
    ),
  ),
  'showrevproduct' => 
  array (
    'app' => 'reviews',
    'allowRedirect' => 1,
    'out' => 
    array (
      0 => '/app=reviews(?:(?:&|&amp;))module=products(?:(?:&|&amp;))section=products(?:(?:&|&amp;))do=products(?:(?:&|&amp;))id=(.+?)(&|$)/i',
      1 => 'reviews/p/$1-#{__title__}/$2',
    ),
    'in' => 
    array (
      'regex' => '#^/reviews/p/(\\d+?)-#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'reviews',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'products',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'products',
        ),
        3 => 
        array (
          0 => 'do',
          1 => 'products',
        ),
        4 => 
        array (
          0 => 'id',
          1 => '$1',
        ),
      ),
    ),
  ),
  'showrevbest' => 
  array (
    'app' => 'reviews',
    'allowRedirect' => 0,
    'out' => 
    array (
      0 => '/app=reviews(?:(?:&|&amp;))module=products(?:(?:&|&amp;))section=best(?:(?:&|&amp;))do=viewbest(?:(?:&|&amp;))letter=(.+?)(&|$)/i',
      1 => 'reviews/products/best/letter/$1/$2',
    ),
    'in' => 
    array (
      'regex' => '#^/reviews/products/best/letter/(.+?)/#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'reviews',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'products',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'best',
        ),
        3 => 
        array (
          0 => 'do',
          1 => 'viewbest',
        ),
        4 => 
        array (
          0 => 'letter',
          1 => '$1',
        ),
      ),
    ),
  ),
  'showrevuser' => 
  array (
    'app' => 'reviews',
    'allowRedirect' => 0,
    'out' => 
    array (
      0 => '/app=reviews(?:(?:&|&amp;))module=authors(?:(?:&|&amp;))section=profile(?:(?:&|&amp;))do=profile(?:(?:&|&amp;))id=(.+?)(&|$)/i',
      1 => 'reviews/authors/profiles/$1-#{__title__}/$2',
    ),
    'in' => 
    array (
      'regex' => '#^/reviews/authors/profiles/(\\d+?)-#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'reviews',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'authors',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'profile',
        ),
        3 => 
        array (
          0 => 'do',
          1 => 'profile',
        ),
        4 => 
        array (
          0 => 'id',
          1 => '$1',
        ),
      ),
    ),
  ),
  'showrevmember' => 
  array (
    'app' => 'reviews',
    'allowRedirect' => 0,
    'out' => 
    array (
      0 => '/app=reviews(?:(?:&|&amp;))module=authors(?:(?:&|&amp;))section=content(?:(?:&|&amp;))do=viewallbymember(?:(?:&|&amp;))id=(.+?)(&|$)/i',
      1 => 'reviews/authors/content/$1-#{__title__}/$2',
    ),
    'in' => 
    array (
      'regex' => '#^/reviews/authors/content/(\\d+?)-#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'reviews',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'authors',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'content',
        ),
        3 => 
        array (
          0 => 'do',
          1 => 'viewallbymember',
        ),
        4 => 
        array (
          0 => 'id',
          1 => '$1',
        ),
      ),
    ),
  ),
  'showrevmemdeals' => 
  array (
    'app' => 'reviews',
    'allowRedirect' => 0,
    'out' => 
    array (
      0 => '/app=reviews(?:(?:&|&amp;))module=authors(?:(?:&|&amp;))section=content(?:(?:&|&amp;))do=mem_deals(?:(?:&|&amp;))id=(.+?)(&|$)/i',
      1 => 'reviews/authors/deals/$1-#{__title__}/$2',
    ),
    'in' => 
    array (
      'regex' => '#^/reviews/authors/deals/(\\d+?)-#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'reviews',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'authors',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'content',
        ),
        3 => 
        array (
          0 => 'do',
          1 => 'mem_deals',
        ),
        4 => 
        array (
          0 => 'id',
          1 => '$1',
        ),
      ),
    ),
  ),
  'showrevfav' => 
  array (
    'app' => 'reviews',
    'allowRedirect' => 0,
    'out' => 
    array (
      0 => '/app=reviews(?:(?:&|&amp;))module=authors(?:(?:&|&amp;))section=lists(?:(?:&|&amp;))do=fav(?:(?:&|&amp;))id=(.+?)(&|$)/i',
      1 => 'reviews/authors/lists/favorites/$1-#{__title__}/$2',
    ),
    'in' => 
    array (
      'regex' => '#^/reviews/authors/lists/favorites/(\\d+?)-#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'reviews',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'authors',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'lists',
        ),
        3 => 
        array (
          0 => 'do',
          1 => 'fav',
        ),
        4 => 
        array (
          0 => 'id',
          1 => '$1',
        ),
      ),
    ),
  ),
  'showrevwish' => 
  array (
    'app' => 'reviews',
    'allowRedirect' => 0,
    'out' => 
    array (
      0 => '/app=reviews(?:(?:&|&amp;))module=authors(?:(?:&|&amp;))section=lists(?:(?:&|&amp;))do=wish(?:(?:&|&amp;))id=(.+?)(&|$)/i',
      1 => 'reviews/authors/lists/wanted/$1-#{__title__}/$2',
    ),
    'in' => 
    array (
      'regex' => '#^/reviews/authors/lists/wanted/(\\d+?)-#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'reviews',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'authors',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'lists',
        ),
        3 => 
        array (
          0 => 'do',
          1 => 'wish',
        ),
        4 => 
        array (
          0 => 'id',
          1 => '$1',
        ),
      ),
    ),
  ),
  'showrevowned' => 
  array (
    'app' => 'reviews',
    'allowRedirect' => 0,
    'out' => 
    array (
      0 => '/app=reviews(?:(?:&|&amp;))module=authors(?:(?:&|&amp;))section=lists(?:(?:&|&amp;))do=owned(?:(?:&|&amp;))id=(.+?)(&|$)/i',
      1 => 'reviews/authors/lists/collection/$1-#{__title__}/$2',
    ),
    'in' => 
    array (
      'regex' => '#^/reviews/authors/lists/collection/(\\d+?)-#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'reviews',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'authors',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'lists',
        ),
        3 => 
        array (
          0 => 'do',
          1 => 'owned',
        ),
        4 => 
        array (
          0 => 'id',
          1 => '$1',
        ),
      ),
    ),
  ),
  'showrevall' => 
  array (
    'app' => 'reviews',
    'allowRedirect' => 0,
    'out' => 
    array (
      0 => '/app=reviews(?:(?:&|&amp;))module=reviews(?:(?:&|&amp;))section=all(?:(?:&|&amp;))do=viewall/i',
      1 => 'reviews/all/$1',
    ),
    'in' => 
    array (
      'regex' => '#^/reviews/all/#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'reviews',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'reviews',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'all',
        ),
        3 => 
        array (
          0 => 'do',
          1 => 'viewall',
        ),
      ),
    ),
  ),
  'showrevreview' => 
  array (
    'app' => 'reviews',
    'allowRedirect' => 1,
    'out' => 
    array (
      0 => '/app=reviews(?:(?:&|&amp;))module=reviews(?:(?:&|&amp;))section=reviews(?:(?:&|&amp;))do=view(?:(?:&|&amp;))id=(.+?)(&|$)/i',
      1 => 'reviews/r/$1-#{__title__}/$2',
    ),
    'in' => 
    array (
      'regex' => '#^/reviews/r/(\\d+?)-#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'reviews',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'reviews',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'reviews',
        ),
        3 => 
        array (
          0 => 'do',
          1 => 'view',
        ),
        4 => 
        array (
          0 => 'id',
          1 => '$1',
        ),
      ),
    ),
  ),
  'showrevlatest' => 
  array (
    'app' => 'reviews',
    'allowRedirect' => 0,
    'out' => 
    array (
      0 => '/app=reviews(?:(?:&|&amp;))module=reviews(?:(?:&|&amp;))section=latest(?:(?:&|&amp;))do=lastvisit/i',
      1 => 'reviews/r/latest/$1',
    ),
    'in' => 
    array (
      'regex' => '#^/reviews/r/latest/#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'reviews',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'reviews',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'latest',
        ),
        3 => 
        array (
          0 => 'do',
          1 => 'lastvisit',
        ),
      ),
    ),
  ),
  'showrevstats' => 
  array (
    'app' => 'reviews',
    'allowRedirect' => 0,
    'out' => 
    array (
      0 => '/app=reviews(?:(?:&|&amp;))module=extra(?:(?:&|&amp;))section=stats(?:(?:&|&amp;))do=stats/i',
      1 => 'reviews/stats/$1',
    ),
    'in' => 
    array (
      'regex' => '#^/reviews/stats/#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'reviews',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'extra',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'stats',
        ),
        3 => 
        array (
          0 => 'do',
          1 => 'stats',
        ),
      ),
    ),
  ),
  'showrevrequests' => 
  array (
    'app' => 'reviews',
    'allowRedirect' => 0,
    'out' => 
    array (
      0 => '/app=reviews(?:(?:&|&amp;))module=products(?:(?:&|&amp;))section=requests(?:(?:&|&amp;))do=requests/i',
      1 => 'reviews/products/requests/$1',
    ),
    'in' => 
    array (
      'regex' => '#^/reviews/products/requests/#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'reviews',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'products',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'requests',
        ),
        3 => 
        array (
          0 => 'do',
          1 => 'requests',
        ),
      ),
    ),
  ),
  'showrevquestions' => 
  array (
    'app' => 'reviews',
    'allowRedirect' => 0,
    'out' => 
    array (
      0 => '/app=reviews(?:(?:&|&amp;))module=products(?:(?:&|&amp;))section=faq(?:(?:&|&amp;))do=allquestions/i',
      1 => 'reviews/products/questions/$1',
    ),
    'in' => 
    array (
      'regex' => '#^/reviews/products/questions/#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'reviews',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'products',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'faq',
        ),
        3 => 
        array (
          0 => 'do',
          1 => 'allquestions',
        ),
      ),
    ),
  ),
  'showrevanswers' => 
  array (
    'app' => 'reviews',
    'allowRedirect' => 0,
    'out' => 
    array (
      0 => '/app=reviews(?:(?:&|&amp;))module=products(?:(?:&|&amp;))section=faq(?:(?:&|&amp;))do=questions(?:(?:&|&amp;))id=(.+?)(&|$)/i',
      1 => 'reviews/products/answers/$1-#{__title__}/$2',
    ),
    'in' => 
    array (
      'regex' => '#^/reviews/products/answers/(\\d+?)-#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'reviews',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'products',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'faq',
        ),
        3 => 
        array (
          0 => 'do',
          1 => 'questions',
        ),
        4 => 
        array (
          0 => 'id',
          1 => '$1',
        ),
      ),
    ),
  ),
  'showrevtagtwo' => 
  array (
    'app' => 'reviews',
    'allowRedirect' => 0,
    'out' => 
    array (
      0 => '/app=reviews(?:(?:&|&amp;))module=extra(?:(?:&|&amp;))section=tags(?:(?:&|&amp;))do=tags(?:(?:&|&amp;))tag=(.+?)(?:(?:&|&amp;))type=(.+?)(&|$)/i',
      1 => 'reviews/keywords/products/$1-#{__title__}/$3',
    ),
    'in' => 
    array (
      'regex' => '#^/reviews/keywords/products/(\\d+?)-#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'reviews',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'extra',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'tags',
        ),
        3 => 
        array (
          0 => 'do',
          1 => 'tags',
        ),
        4 => 
        array (
          0 => 'tag',
          1 => '$1',
        ),
        5 => 
        array (
          0 => 'type',
          1 => '2',
        ),
      ),
    ),
  ),
  'showrevtagone' => 
  array (
    'app' => 'reviews',
    'allowRedirect' => 0,
    'out' => 
    array (
      0 => '/app=reviews(?:(?:&|&amp;))module=extra(?:(?:&|&amp;))section=tags(?:(?:&|&amp;))do=tags(?:(?:&|&amp;))tag=(.+?)(&|$)/i',
      1 => 'reviews/keywords/reviews/$1-#{__title__}/$2',
    ),
    'in' => 
    array (
      'regex' => '#^/reviews/keywords/reviews/(\\d+?)-#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'reviews',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'extra',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'tags',
        ),
        3 => 
        array (
          0 => 'do',
          1 => 'tags',
        ),
        4 => 
        array (
          0 => 'tag',
          1 => '$1',
        ),
      ),
    ),
  ),
  'showrevallfav' => 
  array (
    'app' => 'reviews',
    'allowRedirect' => 0,
    'out' => 
    array (
      0 => '/app=reviews(?:(?:&|&amp;))module=extra(?:(?:&|&amp;))section=all(?:(?:&|&amp;))do=allwithfav(?:(?:&|&amp;))cid=(.+?)(&|$)/i',
      1 => 'reviews/products/lists/favorites/$1-#{__title__}/$2',
    ),
    'in' => 
    array (
      'regex' => '#^/reviews/products/lists/favorites/(\\d+?)-#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'reviews',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'extra',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'all',
        ),
        3 => 
        array (
          0 => 'do',
          1 => 'allwithfav',
        ),
        4 => 
        array (
          0 => 'cid',
          1 => '$1',
        ),
      ),
    ),
  ),
  'showrevallowned' => 
  array (
    'app' => 'reviews',
    'allowRedirect' => 0,
    'out' => 
    array (
      0 => '/app=reviews(?:(?:&|&amp;))module=extra(?:(?:&|&amp;))section=all(?:(?:&|&amp;))do=allwithowned(?:(?:&|&amp;))cid=(.+?)(&|$)/i',
      1 => 'reviews/products/lists/owned/$1-#{__title__}/$2',
    ),
    'in' => 
    array (
      'regex' => '#^/reviews/products/lists/owned/(\\d+?)-#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'reviews',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'extra',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'all',
        ),
        3 => 
        array (
          0 => 'do',
          1 => 'allwithowned',
        ),
        4 => 
        array (
          0 => 'cid',
          1 => '$1',
        ),
      ),
    ),
  ),
  'showrevallwish' => 
  array (
    'app' => 'reviews',
    'allowRedirect' => 0,
    'out' => 
    array (
      0 => '/app=reviews(?:(?:&|&amp;))module=extra(?:(?:&|&amp;))section=all(?:(?:&|&amp;))do=allwithwish(?:(?:&|&amp;))cid=(.+?)(&|$)/i',
      1 => 'reviews/products/lists/wanted/$1-#{__title__}/$2',
    ),
    'in' => 
    array (
      'regex' => '#^/reviews/products/lists/wanted/(\\d+?)-#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'reviews',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'extra',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'all',
        ),
        3 => 
        array (
          0 => 'do',
          1 => 'allwithwish',
        ),
        4 => 
        array (
          0 => 'cid',
          1 => '$1',
        ),
      ),
    ),
  ),
  'showrevmustbuy' => 
  array (
    'app' => 'reviews',
    'allowRedirect' => 0,
    'out' => 
    array (
      0 => '/app=reviews(?:(?:&|&amp;))module=products(?:(?:&|&amp;))section=awards(?:(?:&|&amp;))do=mustbuy/i',
      1 => 'reviews/products/recommended/$1',
    ),
    'in' => 
    array (
      'regex' => '#^/reviews/products/recommended/#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'reviews',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'products',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'awards',
        ),
        3 => 
        array (
          0 => 'do',
          1 => 'mustbuy',
        ),
      ),
    ),
  ),
  'showreveratings' => 
  array (
    'app' => 'reviews',
    'allowRedirect' => 0,
    'out' => 
    array (
      0 => '/app=reviews(?:(?:&|&amp;))module=extra(?:(?:&|&amp;))section=ratings(?:(?:&|&amp;))do=eratings(?:(?:&|&amp;))id=(.+?)(&|$)/i',
      1 => 'reviews/products/comparisons/extra/$1-#{__title__}/$2',
    ),
    'in' => 
    array (
      'regex' => '#^/reviews/products/comparisons/extra/(\\d+?)-#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'reviews',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'extra',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'ratings',
        ),
        3 => 
        array (
          0 => 'do',
          1 => 'eratings',
        ),
        4 => 
        array (
          0 => 'id',
          1 => '$1',
        ),
      ),
    ),
  ),
  'showrevratings' => 
  array (
    'app' => 'reviews',
    'allowRedirect' => 0,
    'out' => 
    array (
      0 => '/app=reviews(?:(?:&|&amp;))module=extra(?:(?:&|&amp;))section=ratings(?:(?:&|&amp;))do=ratings(?:(?:&|&amp;))id=(.+?)(?:(?:&|&amp;))sort=(.+?)(&|$)/i',
      1 => 'reviews/products/comparisons/$1-#{__title__}/$2/$3',
    ),
    'in' => 
    array (
      'regex' => '#^/reviews/products/comparisons/(\\d+)-[^/]+/([^/]+)/#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'reviews',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'extra',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'ratings',
        ),
        3 => 
        array (
          0 => 'do',
          1 => 'ratings',
        ),
        4 => 
        array (
          0 => 'id',
          1 => '$1',
        ),
        5 => 
        array (
          0 => 'sort',
          1 => '$2',
        ),
      ),
    ),
  ),
  'showrevratingstwo' => 
  array (
    'app' => 'reviews',
    'allowRedirect' => 0,
    'out' => 
    array (
      0 => '/app=reviews(?:(?:&|&amp;))module=extra(?:(?:&|&amp;))section=ratings(?:(?:&|&amp;))do=ratings(?:(?:&|&amp;))id=(.+?)(&|$)/i',
      1 => 'reviews/products/comparisons/$1-#{__title__}/$2',
    ),
    'in' => 
    array (
      'regex' => '#^/reviews/products/comparisons/(\\d+)-#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'reviews',
        ),
        1 => 
        array (
          0 => 'module',
          1 => 'extra',
        ),
        2 => 
        array (
          0 => 'section',
          1 => 'ratings',
        ),
        3 => 
        array (
          0 => 'do',
          1 => 'ratings',
        ),
        4 => 
        array (
          0 => 'id',
          1 => '$1',
        ),
      ),
    ),
  ),
  'app=reviews' => 
  array (
    'app' => 'reviews',
    'allowRedirect' => 0,
    'out' => 
    array (
      0 => '#app=reviews$#i',
      1 => 'reviews/',
    ),
    'in' => 
    array (
      'regex' => '#^/reviews(/|$|\\?)#i',
      'matches' => 
      array (
        0 => 
        array (
          0 => 'app',
          1 => 'reviews',
        ),
      ),
    ),
  ),
);

?>