<?php 
require_once ( "app/Vhost.php" );
require_once ( "app/vhost.layout.php" );

$vhost = new VHost ( );
$vhost->path->httpdConf ( "C:/xampp/apache/conf/httpd.conf" ) ;
$vhost->path->httdpVhostsConf ( "C:/xampp/apache/conf/extra/httpd-vhosts.conf" ) ;
$vhost->path->winHosts ( "C:/Windows/System32/drivers/etc/hosts" );
$vhost->path->host ( "C:/xampp/htdocs" );

#echo $vhost->path->httpdConf ( );
#echo $vhost->path->httdpVhostsConf ( );
#echo $vhost->path->winHosts ( );
#echo $vhost->path->host ( );

#echo json_encode ( $vhost->isWin ( ) );

#echo json_encode ( $vhost->file->read ( $vhost->path->httpdConf ( ) ) );
#echo json_encode ( $vhost->file->write ( $vhost->path->winHosts ( ), "asdf" ) );
#echo json_encode ( $vhost->file->find ( $vhost->path->winHosts ( ), "localhost" ) );

#echo json_encode ( $vhost->template->winHosts ( "local", "1.1.1.1." ) );
#echo json_encode ( $vhost->template->vhost ( $vhost->path->httdpVhostsConf ( ), "testhost", "81" ) );

#echo json_encode ( $vhost->hasWinHosts ( "localhost" ) );
#echo json_encode ( $vhost->AddWinHosts ( "tt", "1.1.1.1" ) );

#echo json_encode ( $vhost->findport ( "80" ) );
#echo json_encode ( $vhost->addPort ( "81" ) );

#echo json_encode ( $vhost->find ( "localhost" ) );
#echo json_encode ( $vhost->add ( $vhost->path->host ( ), "localhost", "81" ) );


# LOCALHOST
#$vhost->new (  "C:/xampp/htdocs", "localhost", "127.0.0.1", "80" );

#$vhost->new (  "D:/Documents/GitHub/liber/app/db", "liber.db", "127.0.0.1", "81" );
addLink ( "D:/Documents/GitHub/liber/app/db", "liber.db", "81" );


/*# PASTA DA LIBER WEB
$vhost->new ( "C:/xampp/htdocs/liber/app/web", "liber.dev.com", "127.0.0.1", "80" );
addLink ( "C:/xampp/htdocs/liber/app/web", "liber.dev.com", "80" );

# PASTA LUCASFRCT
$vhost->new ( "C:/xampp/htdocs/lucasfrct", "lucasfrct.dev.com", "127.0.0.1", "80" );
addLink ( "C:/xampp/htdocs/lucasfrct", "lucasfrct.dev.com", "80" );

# PASTA LUCASFRCT
$vhost->new ( "C:/xampp/htdocs/andre", "andre.dev.com", "127.0.0.1", "3000" );
addLink ( "C:/xampp/htdocs/andre", "andre.dev.com", "3000" );
*/