<?php
/*
 * Classe para confugurar o Apache dentro do xampp
 * Autor: Lucas Costa
 * Data: Abr 2020
 */

 require_once ( "../archive/Archive.php" );

class Apache
{

	# arquivo de configuarção do apache
	public $httpdConf = "";
	# arquivo de configuração das Vitual Hosts
	public $httdpVhostsConf = "";

    # Método que cria um template para uma virtual host
    private function vhostTemplate ( string $path = "", string $host = "", string $port = "80" ): string
	{
		return '
<VirtualHost '.$host.':'.$port.'>
    ServerAdmin admin@'.$host.'
    ServerName '.$host.':'.$port.'
    ServerAlias www.'.$host.'
    DocumentRoot "'.$path.'"
    UseCanonicalName Off
    <Directory "'.$path.'">
    	AddDefaultCharset utf-8
        AllowOverride All
        Allow from all
        DirectoryIndex index.php index.html index.htm
    	EnableSendfile On
        Require all granted
    </Directory>
</VirtualHost>';

    }
    
    #procura a porta ouvida pelo apache
	public function findPort ( string $port = "80" ) 
	{
		return Archive::find ( $this->httpdConf, "Listen {$port}" );
    }
	
	# adiciona um a porta no apache
    public function addPort ( string $port = "80" )
	{	
		$status = false;
		if ( !$this->findPort ( $port ) ) {
			$divider = "\nListen 80";
        	$buffer = explode ( $divider, Archive::read ( $this->httpdConf ) );
        	$status = Archive::write ( $this->httpdConf, implode ( "{$divider} \nListen {$port}", $buffer ) );
		};
		return $status;
	}
	
	# remove um aporta no apache
	public function removePort ( string $port = "80" )
	{	
		$status = false;
		if ( $this->findPort ( $port ) && $port != "80" ) {
        	$buffer = explode ( "\nListen {$port}", Archive::read ( $this->httpdConf ) );
        	$status = Archive::write ( $this->httpdConf, implode ( "\n", $buffer ) );
		};
		return $status;
    }
	
	# Método para procuara  a existência de uma virtual host
    public function find ( string $host = "localhost" ): bool 
	{
		return Archive::find ( $this->httdpVhostsConf,  "<VirtualHost {$host}" );
    }
	
	# Método para adicionar uma nova virtual host no apache
    public function add ( string $path = "", string $vhost = "localhost",  $port = "80" ): bool
	{
		$status = false;
		if ( !$this->find ( $vhost ) ) {

			$this->addPort ( $port );

			$status = Archive::write ( 
				$this->httdpVhostsConf, 
				$this->vhostTemplate ( $path, $vhost, $port ),
				"end"
			);
		};
		return $status;
	}

	#remove uma virtual hosts no apache
	public function remove ( string $host, $port = "80" ): bool
	{
		$status = false;

		if ( $this->find ( $host ) == true ) {

			$this->removePort ( $port );

			$init = "<VirtualHost {$host}";
			$end = "</VirtualHost>";

			$status = Archive::write ( 
				$this->httdpVhostsConf,
				Archive::FilterOutside ( $this->httdpVhostsConf, $init, $end )
			);
		}

		return $status;
	}

}

#$apache = new Apache ( );
#apache->find ( "localhost" );
#$out = $apache->addPort ( 81 );
#$out = $apache->removePort ( 81 );
#$out = $apache->add ( "C:/xampp/htdocs", 'localhost', 8081 );
#$out = $apache->remove ( "localhost" );
#var_dump ( $out );