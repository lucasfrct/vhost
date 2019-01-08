<?php

$GLOBALS [ "report" ] = [ "Message Reprots" ];

function permission ( string $src = "") { chmod ( $src, 0777 ); }

function addReport ( string $msg = "" ) { array_push ( $GLOBALS[ "report" ] , $msg ); };

function digest ( string $url = "" ) {
    $element = array ( "\xa", "\e" );
    $digest = array ( "\\xa", "\\e" );
    return str_replace ( $element, $digest, $url );
};

$GLOBALS [ "path" ] = digest ( "c:\xampp" );

#### alterando o arquivo hosts #######################################################
$GLOBALS [ "windowsHosts" ] = digest ( "c:\Windows\System32\drivers\etc\hosts" );

function indexOfAddWindowsHosts ( string $host = "" ): bool {
    return ( strstr ( fileRead ( $GLOBALS [ "windowsHosts" ] ),  $host ) ) ? TRUE : FALSE;
};

function templateWindowsHosts ( string $host = "" ): string {
    return "\n    127.0.0.1       ".$host." \n    ::1             ".$host;
};

function addWindowsHosts ( string $host = "" ) {
    if ( !indexOfAddWindowsHosts ( $host ) ) {
        fileWrite ( $GLOBALS [ "windowsHosts" ], templateWindowsHosts ( $host ) );
        addReport ( "Write Winbdows file hosts!" );
    };
};

#### alterando o arquivo apache conf ##############################################
$GLOBALS [ "apacheConf" ] = $GLOBALS [ "path" ].digest ( "\apache\conf\httpd.conf" );

$GLOBALS [ "httdpConf" ] = fileRead ( $GLOBALS [ "apacheConf" ] );

function indexOfApacheConfListenPort ( string $port = "80" ) {
    return ( strstr ( $GLOBALS [ "httdpConf" ],  "Listen ".$port ) ) ? TRUE : FALSE;
}

function addApacheConfListenPort ( string $port = "80" ) {
    if ( !indexOfApacheConfListenPort ( $port ) ) {
        $glue = "\nListen 80";
        $content = explode ( $glue, $GLOBALS [ "httdpConf" ] );
        $content [ 0 ] = $content [ 0 ].$glue;
        $content [ 1 ] = "\nListen 81".$content [ 1 ]; 
        fileWrite ( $GLOBALS [ "apacheConf" ], implode ( "", $content ), 0 );
        addReport ( "Write Apache file httpd.conf!" );
    };
}

#### alterandoo arquivo do apache virtual hosts ##################################
$GLOBALS [ "apacheConfVhosts" ] = $GLOBALS [ "path" ].digest ( "\apache\conf\extra\httpd-vhosts.conf" ); 

function indexOfApacheConfVhosts ( string $host = "localhost" ) {
    return ( strstr ( fileRead ( $GLOBALS [ "apacheConfVhosts" ] ),  $host ) ) ? TRUE : FALSE;
}

function templateVHost ( string $path = "", string $vhost = "localhost", string $port = "80" ): string {
    $pathPattern = $GLOBALS [ "path" ]."\htdocs".$path;
    return '

<VirtualHost *:'.$port.'>
    ServerAdmin admin@'.$vhost.'
    ServerName '.$vhost.'
    ServerAlias '.$vhost.'
    DocumentRoot "'.$pathPattern.'"
    <Directory "'.$pathPattern.'">
        DirectoryIndex index.php index.html index.htm
        Allow from all
        AllowOverride All
    </Directory>
</VirtualHost>';
};

function addApacheConfVhosts ( string $path = "", string $vhost = "localhost", string $port = "80" ) {
    $tpl = templateVHost ( $path, $vhost, $port );
    if ( !indexOfApacheConfVhosts ( $tpl ) ) {
        fileWrite ( $GLOBALS [ "apacheConfVhosts" ], $tpl );
        addReport ( "Write file apache conf vhosts!" );
    };
}

#### Add New Host ######################################################################
function newVHost ( string $path = "", string $vhost = "localhost", $port = "80" ) {
    permission ( $GLOBALS [ "windowsHosts" ] );
    permission ( $GLOBALS [ "apacheConf" ] );
    permission ( $GLOBALS [ "apacheConfVhosts" ] );
    addWindowsHosts ( $vhost );
    addApacheConfListenPort ( $port );
    addApacheConfVhosts ( $path, $vhost, $port );
};

function fileRead ( string $src = "" ): string {
    return file_get_contents ( $src ); 
};

function fileWrite ( string $src = "", string $content = "", $flag = FILE_APPEND ): bool {
    return file_put_contents ( $src, $content, $flag );
};

#newVHost ( "\appliber", "appliber", "81" );