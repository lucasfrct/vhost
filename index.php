<?php 
require_once ( "Vhost.php" );
require_once ( "vhost.layout.php" );

# EXEMPLO
#$vhost->new (  /folder, domain, port );
#addLink ( /folder, domain, port );

$vhost = new VHost ( );

# LOCALHOST
$vhost->new (  "/", "localhost", "80" );

$vhost->new ( "liber/app/web", "liber.dev.com", "80" );
addLink ( "liber/app/web", "liber.dev.com", "80" );

$vhost->new ( "components", "components.dev.com", "80" );
addLink ( "components", "components.dev.com", "80" );


$vhost->new ( "callcommunity", "callcommunity.dev.com", "80" );
addLink ( "callcommunity", "callcommunity.dev.com", "80" );