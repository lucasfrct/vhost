<?php 
include_once ( "addVHost.php" );
include_once ( "layout.php" );

#newHost ( "domain", "c:\Server\htdocs\path" );
newHost ( "localhost", "c:\Server\htdocs" );
newHost ( "localcomponents", "c:\Server\htdocs\components" );
newHost ( "corebank", "c:\Server\htdocs\core-banking-client" );
newHost ( "webjus", "c:\Server\htdocs\webjus" );
newHost ( "callcommunity", "c:\Server\htdocs\callcommunity" );
newHost ( "localcrud", "c:\Server\htdocs\crud" );
newHost ( "dmx", "c:\Server\htdocs\dmx" );

addLink ( "components", "http://localcomponents/" );
addLink ( "corebank", "http://corebank/" );
addLink ( "WebJus", "http://webjus/" );
addLink ( "Call Community", "http://callcommunity/" );
addLink ( "Crud", "http://localcrud/" );
addLink ( "DMX", "http://dmx/" );