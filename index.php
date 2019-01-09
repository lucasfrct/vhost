<?php 
include_once ( "addVHost.php" );
include_once ( "layout.php" );

#newHost ( "\path", "domain", "port" );
#addLink ( "Name", "url" );


newVHost ( "", "localhost", "80" );

newVHost ( "\appliber", "appliber", "81" );
addLink ( "Liber", "http://appliber:81/" );

newVHost ( "\callcommunity", "callcommunity", "80" );
addLink ( "Call Community", "http://callcommunity/" );

#newVHost ( "\bible-xml", "biblexml", "80" );
#newVHost ( "\components", "components", "80" );
#newVHost ( "\core-banking", "corebanking", "80" );
#newVHost ( "\crud", "crud", "80" );
#newVHost ( "\lotodroid", "lotodroid", "80" );
#newHost ( "\lotoweb", "lotoweb", "80" );
#newHost ( "\musical-systematizer", "musicalsystematizer", "80" );
#newHost ( "\soundapp", "soundapp", "80" );
#newHost ( "\lightcontroller", "lightcontroller" );

#addLink ( "Bible XML", "http://biblexml/" );
#addLink ( "Components", "http://components/" );
#addLink ( "Core Bank Client", "http://corebanking/" );
#addLink ( "CRUD", "http://crud/" );
#addLink ( "Loto Droid", "http://lotodroid/" );
#addLink ( "Loto Web", "http://lotoweb/" );
#addLink ( "Musical Systematizer", "http://musicalsystematizer/" );
#addLink ( "Sound App", "http://soundapp/" );
#addLink ( "Web Light Controller", "http://lightcontroller/" );

#report ( );