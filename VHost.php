<?php 
#VHost.php

Class Path
{	
	public $httpdConf 		= "C:/xampp/apache/conf/httpd.conf";
	public $httpdVhostsConf = "C:/xampp/apache/conf/extra/httpd-vhosts.conf";
	public $WinHosts 		= "C:/Windows/System32/drivers/etc/hosts";
	public $host 			= "C:/xampp/htdocs";
	
	public function httpdConf ( string $path = "" ) : string
	{
		if ( $this->set ( $path, 12 ) ) { $this->httpdConf = $path; };
		return $this->digest ( $this->httpdConf );
	}

	public function httdpVhostsConf ( string $path = "" ): string 
	{
		if ( $this->set ( $path, 10 ) ) { $this->httpdVhostsConf = $path; };
		return $this->digest ( $this->httpdVhostsConf );
	}

	public function winHosts ( string $path = "" ): string
	{
		if ( $this->set ( $path, 10 ) ) { $this->winHosts = $path; };
		return $this->digest ( $this->winHosts );
	}

	public function host ( string $path = "" ): string
	{
		if ( $this->set ( $path, 3 ) ) { $this->host = $path; };	
		return $this->digest ( $this->host );
	}

	public function set ( string $path, $length ): string 
	{
		return ( strlen ( $path ) > $length ) ? TRUE : FALSE;
	}

	public function digest ( string $path = "" ): string 
	{
		$path = str_replace ( array ( '/', '\\' ), DIRECTORY_SEPARATOR, $path );
		return realpath ( $path );
	}
}

Class Archive
{
	public function read ( string $src = "" ): string 
	{
		return file_get_contents ( $src );
	}

	public function write ( string $src = "", string $content = "", $flag = FILE_APPEND ): bool
	{	
		chmod ( $src, 0755 );
		return file_put_contents ( $src, $content, $flag );
	} 

	#função para procurar textos
	public function find ( string $scr = "", string $content = "" ): bool 
	{
		return ( strstr ( $this->read ( $scr ),  $content ) ) ? TRUE : FALSE;
	}
}

Class Template 
{
	# função para escrever o conteúdo do hosts no windows
	public function WinHosts ( string $host = "", string $ip = "127.0.0.1" ): string 
	{
		return "\n    ".$ip."       ".$host;
	}

	public function vhost ( string $path = "", string $host = "", string $port = "80" ): string
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
}

Class VHost {

	public $path = NULL;
	public $file = NULL;
	public $template = NULL;
	public $os = "WIN";

	public function __construct ( ) 
	{ 
		$this->path = new Path ( );
		$this->file = new Archive ( );
		$this->template = new Template ( );
	}

	public function isWin ( ): bool
	{
		return ( strtoupper ( substr ( PHP_OS, 0, 3 ) ) === 'WIN' ) ? TRUE : FALSE;
	}

	
	#função para procurar o registro de um host no windows
	public function hasWinHosts ( string $host = "" ): bool 
	{
		return $this->file->find ( $this->path->winHosts ( ), $host );
	}

	# adiciona umnovo conteúdo no arquivo hosts do windows
	public function AddWinHosts ( string $host = "", string $ip = "127.0.0.1" ): bool
	{	
		$status = FALSE;
		if ( !$this->hasWinHosts ( $host ) ) {
			$status = $this->file->write ( $this->path->winHosts ( ), $this->template->winHosts ( $host, $ip ) );
		};
		return $status;
	}

	#procura a porta ouvida pelo apache
	public function findPort ( string $port = "80" ) 
	{
		return $this->file->find ( $this->path->httpdConf ( ), "Listen ".$port );
	}

	public function addPort ( string $port = "80" )
	{	
		$status = FALSE;
		if ( !$this->findPort ( $port ) ) {
			$divider = "\nListen 80";
        	$content = explode ( $divider, $this->file->read ( $this->path->httpdConf ( ) ) );
        	$content [ 0 ] = $content [ 0 ].$divider;
        	$content [ 1 ] = "\nListen ".$port.$content [ 1 ];
        	$status = $this->file->write ( $this->path->httpdConf ( ), implode ( "", $content ), 0 );
		};
		return $status;
	}

	public function find ( string $host = "localhost" ): bool 
	{
		return $this->file->find ( $this->path->httdpVhostsConf ( ),  "<VirtualHost ".$host );
	}

	public function add ( string $path = "", string $vhost = "localhost", string $port = "80" ): bool
	{
		$status = FALSE;
		if ( !$this->find ( $vhost ) ) {
			$status = $this->file->write ( 
				$this->path->httdpVhostsConf ( ), 
				$this->template->vhost ( $path, $vhost, $port )
			);
		};
		return $status;
	}

	public function new ( string $path = "",  string $vhost = "localhost", string $ip = "127.0.0.1", string $port = "80" ) 
	{
		if ( strlen ( $path ) > 1 ) { $this->path->host ( $path ); };

		if ( is_dir ( $this->path->host ( ) ) ) {
			$this->AddWinHosts ( $vhost, $ip );
			$this->addPort ( $port );
			$this->add ( $this->path->host ( ), $vhost, $port );
		};
	}
};