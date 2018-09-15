<?php 
include_once ( "addVHost.php" );
include_once ( "layout.php" );

#newHost ( "domain", "c:\Server\htdocs\path" );
newHost ( "localhost", "c:\Server\htdocs" );
newHost ( "biblexml", "c:\Server\htdocs\bible-xml" );
newHost ( "callcommunity", "c:\Server\htdocs\callcommunity" );
newHost ( "components", "c:\Server\htdocs\components" );
newHost ( "corebank", "c:\Server\htdocs\core-banking-client" );
newHost ( "crud", "c:\Server\htdocs\crud" );
newHost ( "lotodroid", "c:\Server\htdocs\lotodroid" );
newHost ( "lotoweb", "c:\Server\htdocs\lotoweb" );
newHost ( "musicalsystematizer", "c:\Server\htdocs\musical-systematizer" );
newHost ( "soundapp", "c:\Server\htdocs\soundapp" );
newHost ( "ligthcontroler", "c:\Server\htdocs\web-light-controller" );

#addLink ( "Name", "url" );
addLink ( "Bible XML", "http://biblexml/" );
addLink ( "Call Community", "http://callcommunity/" );
addLink ( "Components", "http://components/" );
addLink ( "Core Bank Client", "http://corebank/" );
addLink ( "Loto Droid", "http://lotodroid/" );
addLink ( "Loto Web", "http://lotoweb/" );
addLink ( "CRUD", "http://crud/" );
addLink ( "Musical Systematizer", "http://musicalsystematizer/" );
addLink ( "Sound App", "http://soundapp/" );
addLink ( "Web Light Controller", "http://ligthcontroler/" );

#report ( );