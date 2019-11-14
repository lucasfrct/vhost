<?php 
#VHost.php
/*
* Lucas Costa
* Ago 2019
*/

require_once ( "Path.php" );
require_once ( "Archive.php" );
require_once ( "Template.php" );

Class VHost {

	public $path = null;
	public $file = null;
	public $template = null;
	public $os = "WIN";

	public function __construct ( ) 
	{ 
		$this->path = new Path ( );
		$this->file = new Archive ( );
		$this->template = new Template ( );
	}

	public function isWin ( ): bool
	{
		return ( strtoupper ( substr ( PHP_OS, 0, 3 ) ) === 'WIN' ) ? true : false;
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