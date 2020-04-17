<?php 

header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

$header = [];
$header = array_merge( $header, array( "server" => $_SERVER['SERVER_ADDR'] ) );
$header = array_merge($header, array( "host" => $_SERVER['REMOTE_ADDR'] ) ); 

echo "event: header\n";
echo "retry: 60000\n";
echo 'data: '.json_encode($header);
echo "\n\n";
