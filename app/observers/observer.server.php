<?php 

require_once ( "Observer.php" );

$eventName = "server";

$header = [];
$header [ "name" ] = $_SERVER [ 'SERVER_NAME' ];
$header [ "address" ] = $_SERVER [ 'SERVER_ADDR' ];
$header [ "remote" ] = $_SERVER [ 'REMOTE_ADDR' ];

#$cached = Observer::LogRead ( "{$IPRemote}.settings" );

Observer::LogCreate ( $header [ "remote" ].".settings", json_encode ( $header ) );

Observer::EventCreate ( $eventName , json_encode ( $header ), 6000 );



