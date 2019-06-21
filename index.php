<?php 
require_once ( "Vhost.php" );
require_once ( "vhost.layout.php" );

#$vhost->new (  /folder, domain, port );
#addLink ( /folder, domain, port );

$vhost = new VHost ( );
$vhost->new (  "/", "localhost", "80" );

#$vhost->new (  "callcommunity", "callcommunity.dev.com", "80" );
#addLink ( "callcommunity", "callcommunity.dev.com", "80" );

$vhost->new (  "components", "components.dev.com", "80" );
addLink ( "components", "components.dev.com", "80" );

#$vhost->new (  "crud", "crud.dev.com", "80" );
#addLink ( "crud", "crud.dev.com", "80" );

$vhost->new (  "mvp-imoveis/", "mvpimoveis.dev.com", "80" );
addLink ( "mvp-imoveis/", "mvpimoveis.dev.com", "80" );

$vhost->new (  "mvp-marketing/", "mvpmarketing.dev.com", "80" );
addLink ( "mvp-marketing/", "mvpmarketing.dev.com", "80" );