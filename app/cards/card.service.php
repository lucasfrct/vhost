<?php

require_once ( "../archive/Archive.php" );
require_once ( "../path/Path.php" );
require_once ( "../apache/Apache.php" );
require_once ( "../windows/Windows.php" );

$path = new Path ( );

$uri = "../cache/";

$post = json_decode ( file_get_contents ( "php://input" ), true );

if ( !empty ( $post ) ) {

    $apache = new Apache ( ); 
    $windows = new Windows ( );
    
    $settings = json_decode ( Archive::read ( "../log/settings.log" ), true );
    
    $apache->httpdConf          = $settings [ 'httpdConf' ];
    $apache->httdpVhostsConf    = $settings [ 'httdpVhostsConf' ];
    $windows->src               = $settings [ 'hosts' ];
    
    $domain = (explode ( ":", trim ( $post [ "domain" ] ) )[ 0 ] ) ?? "";
    $port   = (explode ( ":", trim ( $post [ "domain" ] ) )[ 1 ] ) ?? "80";
    $folder = $path->digest ( trim ( $post [ "folder" ] ) ) ?? "";    
    
    if ( "save" == $post [ "action" ] ) {
        
        $apache->add ( $folder , $domain, $port );
        $windows->addHosts ( $domain );
        
        $data = array ( 
            "domain"=> $domain.":".$port, 
            "folder"=> $folder, 
            "status"=> $windows->ping ( "localhost" ), 
            "location"=> $path->check ( $folder ) 
        );
        Archive::write ( $uri.$domain.".json", json_encode ( $data ) );
    }

    if ( "delete" == $post [ "action" ] ) {
        
        $apache->remove ( $domain, $port );
        $windows->removeHosts ( $domain );
        
        Archive::erase ( $uri.$domain.".json" );
    }

}

$servers = [];

$files = $path->list ( $uri );

foreach ( $files as $file ) {
    array_push ( $servers, json_decode ( Archive::read ( $uri.$file ), true ) );
}

echo json_encode ( $servers );