<?php

function addHost ( string $domain = "" ) {
    if ( !empty ( $domain ) ) {
    	$winHostText = "echo   127.0.0.1       ".$domain." >> c:\Windows\System32\drivers\\etc\hosts \ntype c:\Windows\System32\drivers\\etc\hosts \npause";

    	//$winHost = fopen ( "c:\Server\htdocs\\vhost\addHost.bat", 'w' );
    	//fwrite ( $winHost, $winHostText );
    	//fclose ( $winHost );
        writeFile ( "c:\Server\htdocs\\vhost\addHost.bat", $winHost, "w" );

        //$listHost = fopen ( "c:Server\htdocs\\vhost\listhost.txt", 'a+' );
        //fwrite ( $listHost, ",".$domain );
        //fclose ( $listHost );
        writeFile ( "c:Server\htdocs\\vhost\listhost.txt", ",".$domain, "a+" );

        exec ( 'c:\Server\htdocs\vhost\addHost.bat' );
    };
};

function addVHost ( string $domain = "", string $path = "" ) {

	$virtualHost = '

    <VirtualHost *:80>
        ServerName '.$domain.'
        ServerAlias '.$domain.'
        DocumentRoot "'.$path.'"
        ErrorLog "logs/'.$domain.'-error.log"
        CustomLog "logs/'.$domain.'-access.log" common
        <Directory "'.$path.'">
            DirectoryIndex index.php index.html index.htm
            AllowOverride All
            Order allow,deny
            Allow from all
        </Directory>
    </VirtualHost>';

	$virtual = fopen ( "c:\Server\apache\conf\\extra\httpd-vhosts.conf", "a+" );
	fwrite ( $virtual, $virtualHost );
	fclose ( $virtual );
};

function checkHost ( string $domain = "" ) {
    $contentArr = explode ( ",", openFile ( "c:\Server\htdocs\\vhost\listhost.txt" ) );
    $arr = count ( array_filter ( $contentArr, function ( $item ) use ( $domain ) {
        return  ( $domain === trim ( $item ) ) ? $item : false;
    } ) );

    return ( $arr > 0 ) ? true : false;
}

function newHost ( string $domain = "" , string $path = "" ) {
    if ( !empty ( $domain ) && !empty ( $path ) && !checkHost ( $domain ) ) {
        addVHost ( $domain, $path );
        addHost ( $domain );
        echo "New Host: ".$domain."<br>";
    };
};

function resetListHost ( ) {
    file_put_contents ( "listhost.txt", "" );
};

function openFile ( $src = "" ) {
    $file = fopen ( $src, 'r' );
    $content = fread ( $file, ( 10 * 1024 ) );
    fclose ( $file );

    return $content;
};

function writeFile ( $src = "", $content = "", $param = "w" ) {
    $file = fopen ( $content, $param );
    fwrite ( $file, $content );
    $get = fread ( $file, ( 10 * 1024 ) );
    fclose ( $file );
    
    return $get;
};

#newHost ( "domain", "c:\Server\htdocs\path" );