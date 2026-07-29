<?php

$url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$url = str_replace('/applications/tapatalk','', $url);
if( isset($_SERVER['HTTPS'] ) ) {
    header('Location: https://'.$url);
}
else{
    header('Location: http://'.$url);
} 