<?php 
include_once ( "addVHost.php" );
include_once ( "layout.php" );

#newHost ( "domain", "c:\Server\htdocs\path" );
newHost ( "localhost", "c:\Server\htdocs" );
newHost ( "components", "c:\Server\htdocs\components" );
//newHost ( "callcommunity", "c:\Server\htdocs\callcommunity" );
//newHost ( "corebank", "c:\Server\htdocs\core-banking-client" );
//newHost ( "crud", "c:\Server\htdocs\crud" );
newHost ( "soundapp", "c:\Server\htdocs\soundapp" );
newHost ( "ligthcontroler", "c:\Server\htdocs\web-light-controller" );

#addLink ( "Name", "url" );
addLink ( "Components", "http://components/" );
//addLink ( "Call Community", "http://callcommunity/" );
//addLink ( "Core Bank Client", "http://corebank/" );
//addLink ( "CRUD", "http://crud/" );
addLink ( "Sound App", "http://soundapp/" );
addLink ( "Web Light Controller", "http://ligthcontroler/" );

#report ( );