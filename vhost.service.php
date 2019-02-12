<?php 
require_once ( "Vhost.php" );
require_once ( "vhost.layout.php" );

$vhost = new VHost ( );
$vhost->new (  "/", "localhost", "80" );

$vhost->new (  "callcommunity", "callcommunity.dev.com", "80" );
addLink ( "callcommunity", 'callcommunity.dev.com', "80" );

$vhost->new (  "components", "components.dev.com", "80" );
addLink ( "components", 'components.dev.com', "80" );

