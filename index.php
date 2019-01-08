<?php 
include_once ( "addVHost.php" );
include_once ( "layout.php" );

#newHost ( "\path", "domain", "port" );

#newVHost ( "\bible-xml", "biblexml", "80" );
#newVHost ( "\callcommunity", "callcommunity", "80" );
#newVHost ( "\components", "components", "80" );
#newVHost ( "\core-banking", "corebanking", "80" );
#newVHost ( "\crud", "crud", "80" );
#newVHost ( "\lotodroid", "lotodroid", "80" );
#newHost ( "\lotoweb", "lotoweb", "80" );
#newHost ( "\musical-systematizer", "musicalsystematizer", "80" );
#newHost ( "\soundapp", "soundapp", "80" );
#newHost ( "\lightcontroller", "lightcontroller" );
newVHost ( "\appliber", "appliber", "81" );

#addLink ( "Name", "url" );
#addLink ( "Bible XML", "http://biblexml/" );
#addLink ( "Call Community", "http://callcommunity/" );
#addLink ( "Components", "http://components/" );
#addLink ( "Core Bank Client", "http://corebanking/" );
#addLink ( "CRUD", "http://crud/" );
#addLink ( "Loto Droid", "http://lotodroid/" );
#addLink ( "Loto Web", "http://lotoweb/" );
#addLink ( "Musical Systematizer", "http://musicalsystematizer/" );
#addLink ( "Sound App", "http://soundapp/" );
#addLink ( "Web Light Controller", "http://lightcontroller/" );
addLink ( "Liber", "http://appliber:81/" );

#report ( );