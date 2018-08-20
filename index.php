<?php 
include_once ( "addVHost.php" );
include_once ( "layout.php" );

#newHost ( "domain", "c:\Server\htdocs\path" );
newHost ( "localhost", "c:\Server\htdocs" );
newHost ( "callcommunity", "c:\Server\htdocs\callcommunity" );
newHost ( "components", "c:\Server\htdocs\components" );
newHost ( "corebank", "c:\Server\htdocs\core-banking-client" );
newHost ( "crud", "c:\Server\htdocs\crud" );
newHost ( "musicalsystematizer", "c:\Server\htdocs\musicalsystematizer" );
newHost ( "soudapp", "c:\Server\htdocs\soundapp" );
newHost ( "ligthcontroler", "c:\Server\htdocs\web-light-controller" );

#addLink ( "Name", "url" );
addLink ( "Call Community", "http://callcommunity/" );
addLink ( "Components", "http://components/" );
addLink ( "Core Bank Client", "http://corebank/" );
addLink ( "CRUD", "http://crud/" );
addLink ( "Musical Systematizer", "http://musicalsystematizer/" );
addLink ( "Soud App", "http://soudapp/" );
addLink ( "Web Light Controller", "http://ligthcontroler/" );

#report ( );