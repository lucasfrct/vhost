<?php 

require_once ( "../archive/Archive.php" );
require_once ( "../path/Path.php" );

$path = new Path( );

$httpdConf = "apache/conf/httpd.conf";
$httdpVhostsConf = "apache/conf/extra/httpd-vhosts.conf";
$winHosts = "C:/Windows/System32/drivers/etc/hosts";
$host = "htdocs";
$settings = [ ];

$post = json_decode ( file_get_contents ( 'php://input' ), true );

$settings [ "xampp" ] = $path->digest ( $post [ "xampp" ] ).DIRECTORY_SEPARATOR;

$settings [ "hosts" ] = $path->digest ( ( empty ( $post [ "hosts" ] ) ) ?  $winHosts : $post [ "hosts" ] );

$settings [ "httpdConf" ] = $path->digest ( $settings [ "xampp" ].$httpdConf );

$settings [ "httdpVhostsConf" ] = $path->digest ( $settings [ "xampp" ].$httdpVhostsConf );

$settings [ "htdocs" ] = $path->digest ( $settings [ "xampp" ].$host );

Archive::write( "../log/settings.log", json_encode ( $settings ) );

echo json_encode( $settings );