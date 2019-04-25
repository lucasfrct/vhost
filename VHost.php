<?php 
#VHost.php

Class VHost {

	public $pathServer = "c:/xampp/"; #pasta do servidor
	public $fileWinHosts = "c:/Windows/System32/drivers/etc/hosts"; #arquivo de hosts do windows 
	public $fileApacheConf = "apache/conf/httpd.conf"; 
	public $fileApacheVhost = "apache/conf/extra/httpd-vhosts.conf";
	public $publicFolder = "htdocs/";

	public function __construct ( string $pathServer = "c:/xampp/" ) 
	{
		$this->pathServer = $this->digestPath ( $pathServer );
		$this->fileWinHosts = $this->digestPath ( $this->fileWinHosts );
		$this->fileApacheConf = $this->digestPath ( $this->pathServer."/".$this->fileApacheConf );
		$this->fileApacheVhost = $this->digestPath ( $this->pathServer."/".$this->fileApacheVhost );
		$this->publicFolder = $this->digestPath ( $this->pathServer."/".$this->publicFolder );
	}

	#funcção para normalizar o formato de diretório
	protected function digestPath ( string $path ): string 
	{
		$path = str_replace ( array ( '/', '\\' ), DIRECTORY_SEPARATOR, $path );
		return realpath ( $path );
	}

	# funcão que ler um arquivo
	private function readFile ( string $src = "" ): string 
	{
    	return file_get_contents ( $src ); 
	}
	# funcção para escrevewr um arquivo
	private function writeFile ( string $src = "", string $content = "", $flag = FILE_APPEND ): bool 
	{
    	return file_put_contents ( $src, $content, $flag );
	}

	#função para procurar o registro de um host no windows
	private function findIndexWinHost ( string $host = "" ): bool 
	{
		return ( strstr ( $this->readFile ( $this->fileWinHosts ),  $host ) ) ? TRUE : FALSE;
	}

	# função apra escrever o conteúdo do hosts no windows
	private function makeTemplateForWinHost ( string $host = "" ) 
	{
		return "\n    127.0.0.1       ".$host." \n    ::1             ".$host;
	}

	# adiciona umnovo conteúdo no arquivo hosts do windows
	protected function addOnWinHost ( string $host = "" ): bool
	{	
		$status = FALSE;
		if ( !$this->findIndexWinHost ( $host ) ) {
			$status = $this->writeFile ( $this->fileWinHosts, $this->makeTemplateForWinHost ( $host ) );
		};
		return $status;
	}

	#procura a porta ouvida pelo apache
	private function findListenedPort ( string $port = "80" ) 
	{
		return ( strstr ( $this->readFile ( $this->fileApacheConf ),  "Listen ".$port ) ) ? TRUE : FALSE;
	}

	private function addPortInApacheConf ( string $port = "80" )
	{	
		$status = FALSE;
		if ( !$this->findListenedPort ( $port ) ) {
			$divider = "\nListen 80";
        	$content = explode ( $divider, $this->readFile ( $this->fileApacheConf ) );
        	$content [ 0 ] = $content [ 0 ].$divider;
        	$content [ 1 ] = "\nListen ".$port.$content [ 1 ];
        	$status = $this->writeFile ( $this->fileApacheConf, implode ( "", $content ), 0 );
		};
		return $status;
	}

	private function findVHostInApacheHostConf ( string $host = "localhost" ): bool 
	{
		return ( strstr ( $this->readFile ( $this->fileApacheVhost ),  $host ) ) ? TRUE : FALSE;
	}

	private function makeTemplateForVHost ( string $path = "", string $vhost = "localhost", string $port = "80" ): string
	{
		$path = $this->digestpath ( $path ) ;
		return '

<VirtualHost '.$vhost.':'.$port.'>
    ServerAdmin admin@'.$vhost.'
    ServerName '.$vhost.':'.$port.'
    ServerAlias www.'.$vhost.'
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

	private function addVHostToApacheHostConf ( string $path = "", string $vhost = "localhost", string $port = "80" ): bool
	{
		$status = FALSE;
		$tpl = $this->makeTemplateForVHost ( $path, $vhost, $port );
		if ( !$this->findVHostInApacheHostConf ( $tpl ) ) {
			$status = $this->writeFile ( $this->fileApacheVhost, $tpl );
		};
		return $status;
	}

	public function new ( string $path = "",  string $vhost = "localhost", string $port = "80" ) 
	{
		$path = $this->digestPath ( $this->publicFolder."/".$path );
		if ( $path ) {
			$this->addOnWinHost ( $vhost );
			$this->addPortInApacheConf ( $port );
			$this->addVHostToApacheHostConf ( $path, $vhost, $port );
		};
	}
};