<?php
/*
* Lucas Costa
* Ago 2019
*/
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