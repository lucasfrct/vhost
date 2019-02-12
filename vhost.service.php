<?php 
require_once ( "Vhost.php" );
require_once ( "vhost.layout.php" );

$vhost = new VHost ( );
$vhost->new (  "/", "localhost" );

$vhost->new (  "callcommunity", "callcommunity" );
addLink ( "callcommunity", 'callcommunity' );