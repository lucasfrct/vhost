<?php

/*
 * Classe para confugurar o hosts do Windows
 * Autor: Lucas Costa
 * Data: Abr 2020
 */

require_once ( "../archive/Archive.php" );

class Windows 
{
    public $src = "C:/Windows/System32/drivers/etc/hosts";

    # Template do hosts no windows
	public function hosts ( string $host = "", string $ip = "127.0.0.1" ): string 
	{
		return "    ".$ip."       ".$host;
    }
    
    #função para procurar o registro de um host no windows
	public function hasHosts ( string $host ): bool 
	{
		return Archive::find ( $this->src, $host );
    }
    
    # adiciona umnovo conteúdo no arquivo hosts do windows
	public function addHosts ( string $host = "", string $ip = "127.0.0.1" ): bool
	{	
		$status = false;
		if ( !$this->hasHosts ( $host ) ) {
			$status = Archive::write ( $this->src, $this->hosts ( $host, $ip ), "end" );
		};
		return $status;
	}

	public function removeHosts ( $host, $ip = "127.0.0.1" ) 
	{
		$status = false;
		if ( $this->hasHosts ( $host ) ) {
			$buffer = explode ( $this->hosts ( $host, $ip ), Archive::read ( $this->src ) );
			$status = Archive::write ( $this->src, implode ( "\n", $buffer ) );
		}

		return $status;
	}

	function ping ( string $domain = "127.0.0.1" ) {
		exec ( "ping -n 1 -w 1 {$domain}", $output, $result );    
		return ( !$result && count ( $output ) > 2 ) ? true : false;
	}

}

#$w = new Windows ();
#var_dump ( $w->addHosts ( "lc.dev.com" ) );
#var_dump ( $w->removeHosts ( "lc.dev.com" ) );