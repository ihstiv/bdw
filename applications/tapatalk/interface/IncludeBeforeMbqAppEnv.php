<?php

defined('MBQ_IN_IT') or exit;
/**
 * This file is not needed by default!
 * Run this first before call MbqMain::initAppEnv() when you need!

 */
/* Please write any codes you need in the following area before call MbqMain::initAppEnv()! */

$_SERVER['SCRIPT_FILENAME']	= __FILE__;
if(!defined( 'IN_IPB' ))
{
    $fileDir = __DIR__;
    $fileDir = str_replace('applications/tapatalk/interface', '', $fileDir);
    if (file_exists($fileDir . 'init.php') && file_exists(__DIR__ . '/helper.php')) {
        require_once $fileDir . 'init.php';
        require_once 'helper.php';
    }else {
        while (!file_exists('init.php')) {
            chdir('..');
        }
        require_once 'init.php';
        require_once 'helper.php';
    }
    \IPS\IPS::$PSR0Namespaces['Tapatalk'] = MBQ_APPEXTENTION_PATH;
    \Tapatalk\IPS\Dispatcher::i();
}

 function isIPB43()
 {
      return class_exists('\IPS\Login\Success');
 }

