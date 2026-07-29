<?php

require_once( 'init.php' );
\IPS\Dispatcher\External::i();

\IPS\Task::queue( 'core', 'RebuildPosts', array( 'class' => 'IPS\reviews\Review\Comment' ), 5 );