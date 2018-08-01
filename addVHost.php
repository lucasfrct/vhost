<?php

#host = c:\Windows\System32\drivers\\etc\hosts
#vhost = c:\Server\apache\conf\\extra\httpd-vhosts.conf
#vhostconf = c:Server\htdocs\\vhost\vhost.conf

$GLOBALS [ "report" ] = [ "Message Reprots" ];
$GLOBALS [ "hostexec" ] = "c:\Server\htdocs\\vhost\\addHost.bat";
$GLOBALS [ "host" ] = "c:\Windows\System32\drivers\\etc\hosts";
$GLOBALS [ "vhost" ] = "c:\Server\apache\conf\\extra\httpd-vhosts.conf";

function addMsg ( string $message = "" ): array {
    array_push ( $GLOBALS[ "report" ] , $message );
    return $GLOBALS[ "report" ];
};
#addMsg ( "teste" );

function indexOfHostExec ( string $host = "" ): bool {
    return ( strlen ( strpos ( fileRead ( $GLOBALS [ "hostexec" ] ), templateHostExec ( $host ) ) ) ) ? TRUE : FALSE;
};

function indexOfHost ( string $host = "" ): bool {
    return ( strlen ( strpos ( fileRead ( $GLOBALS[ "host" ] ), templateHost ( $host ) ) ) ) ? TRUE : FALSE;
};


function indexOfVHost ( string $vhost = "", string $path = "" ): bool {
    return ( strlen ( strpos ( fileRead ( $GLOBALS[ "vhost" ] ) , templateVHost ( $vhost, $path ) ) ) ) ? TRUE : FALSE ;
};

function templateHostExec ( string $host = "" ): string {
    return "echo     ".templateHost ( $host )." >> c:\Windows\System32\drivers\\etc\hosts \ntype c:\Windows\System32\drivers\\etc\hosts \npause";
};

function templateHost ( string $host = "" ): string {
    return "127.0.0.1       ".$host;
};

function templateVHost ( string $vhost = "", string $path = "" ): string {

    return '

    <VirtualHost *:80>
        ServerName '.$vhost.'
        ServerAlias '.$vhost.'
        DocumentRoot "'.$path.'"
        ErrorLog "logs/'.$vhost.'-error.log"
        CustomLog "logs/'.$vhost.'-access.log" common
        <Directory "'.$path.'">
            DirectoryIndex index.php index.html index.htm
            AllowOverride All
            Order allow,deny
            Allow from all
        </Directory>
    </VirtualHost>';

};

function addHostExec ( string $host = "" ): bool {
    fileWrite ( $GLOBALS [ "hostexec" ], templateHostExec ( $host ) );
    return indexOfHostExec ( $host );
};

function addHost ( string $host = "" ): bool {
    if ( addHostExec ( $host ) && file_exists ( $GLOBALS [ "host" ] ) && !indexOfHost ( $host ) ) {
        exec ( $GLOBALS [ "hostexec" ] );
    };
    fileWrite ( $GLOBALS [ "hostexec" ], "#" );

    return  indexOfHost ( $host );
};

function addVHost ( string $vhost = "", string $path = "" ): bool {
    if ( file_exists ( $GLOBALS [ "vhost" ] ) &&  !indexOfVHost ( $vhost, $path ) ) {
        fileWrite ( $GLOBALS [ "vhost" ], templateVHost ( $vhost, $path ), "a+" );
    };
    return indexOfVHost ( $vhost, $path );
};

function newHost ( string $domain = "" , string $path = "" ) {
    if ( addHost ( $domain ) ) {
        if ( addVHost ( $domain, $path ) ) { 
            addMsg ( "<b>Vitual Host:</b> ".$domain." | ".$path );
        } else { 
            addMsg ( "<b>Erro:</b> ".$domain." | ".$path );
        };
    };
};

function fileRead ( string $src = "" ): string {
    $file = fopen ( $src, 'r' );
    $content = fread ( $file, ( 10 * 1024 ) );
    fclose ( $file );
    return $content;
};

function fileWrite ( string $src = "", string $content = "", string $param = "w" ): bool {
    $file = fopen ( $src, $param );
    fwrite ( $file, $content );
    fclose ( $file );
    return ( strlen ( strpos ( fileRead ( $src ), $content ) ) ) ? TRUE : FALSE;
};

#newHost ( "domain", "c:\Server\htdocs\path" );