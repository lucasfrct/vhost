<?php

require_once ( "../archive/Archive.php" );
require_once ( "../path/Path.php" );

$uri = "../cache/";

if ( !empty ( $_GET ) ) {

    $domain = trim ( $_GET [ "domain" ] ) ?? "";
    $foldfer = trim ( $_GET [ "folder" ] ) ?? "";

    if ( "save" == $_GET [ "action" ] ) {
        
        $data = array ( "domain"=> $domain, "folder"=> $foldfer, "status"=> true, "location"=> true );
    
        Archive::write ( $uri.$domain.".json", json_encode ( $data ) );
    }

    if ( "delete" == $_GET [ "action" ] ) {
        Archive::erase ( $uri.$domain.".json" );
    }

}

$servers = [];

$path = new Path ( );
$files = $path->find ( $uri );

foreach ( $files as $file ) {
    array_push ( $servers, json_decode ( Archive::read ( $uri.$file ), true ) );
}

echo json_encode ( $servers );