<?php

require_once ( "Observer.php" );
require_once ( "../path/Path.php" );
require_once ( "../archive/Archive.php" );


$uri = "../cache/";
$eventName = "reload";
$numNotify = 8;

$path = new Path ( );

$files = $path->find ( $uri );
$cache = json_encode ( $files );

$cached = Observer::LogRead ( $eventName  );

if ( !Observer::LogEqual ( $cache, $cached ) && Observer::EventCount ( $eventName  ) <= $numNotify ) {

    $servers = [ ];

    if ( Observer::EventCount ( $eventName  ) >= $numNotify ) {
        Observer::LogCreate ( $eventName , $cache );
    }

    foreach ( $files as $file ) {
        array_push ( $servers, json_decode ( Archive::read ( $uri.$file ), true ) );
    }

    Observer::EventCreate ( $eventName , json_encode ( $servers ), 500 );

    Observer::EventCount ( $eventName , 1 );

} else { 
    Observer::EventCount ( $eventName , 0) ;
}