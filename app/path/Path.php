<?php 
#Path.php
/*
* Lucas Costa
* Ago 2019
*/

Class Path
{	
	public $httpdConf 		= "C:/xampp/apache/conf/httpd.conf";
	public $httpdVhostsConf = "C:/xampp/apache/conf/extra/httpd-vhosts.conf";
	public $WinHosts 		= "C:/Windows/System32/drivers/etc/hosts";
	public $host 			= "C:/xampp/htdocs";
	
	# @param $path : string
	# @return : string
	public function httpdConf ( string $path = "" ) : string
	{
		if ( $this->set ( $path, 12 ) ) { $this->httpdConf = $path; };
		return $this->digest ( $this->httpdConf );
	}

	# @param $path : string
	# @return : string
	public function httdpVhostsConf ( string $path = "" ): string 
	{
		if ( $this->set ( $path, 10 ) ) { $this->httpdVhostsConf = $path; };
		return $this->digest ( $this->httpdVhostsConf );
	}

	# @param $path : string
	# @return : string
	public function winHosts ( string $path = "" ): string
	{
		if ( $this->set ( $path, 10 ) ) { $this->winHosts = $path; };
		return $this->digest ( $this->winHosts );
	}

	# @param $path : string
	# @return : string
	public function host ( string $path = "" ): string
	{
		if ( $this->set ( $path, 3 ) ) { $this->host = $path; };	
		return $this->digest ( $this->host );
	}

	# @param $path : string
	# @param $length : any
	# @return : bool
	public function set ( string $path, $length ): bool 
	{
		return ( strlen ( $path ) > $length ) ? true : false;
	}

	# @param $path : string
	# @return : string (type directory)
	public function digest ( string $path = "" ): string 
	{
		$path = str_replace ( array ( '/', '\\' ), DIRECTORY_SEPARATOR, $path );
		return realpath ( $path );
	}

	public function find ( $diretory ) 
	{
		$files = [];
		$dir = dir ( $diretory );

		while ( $file = $dir->read()) {
			if ($file !== "." && $file !== "..") {
				array_push ( $files, $file );
			}
		};

		return $files;
	}
}