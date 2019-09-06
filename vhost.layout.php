<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" sizes="32x32" href="vhost/img/server-online.png">
	<title>Local Host</title>
	<style type="text/css">
		@font-face {
  			font-family: Roboto;
  			src: url(vhost/fonts/Roboto-Regular.ttf);
		}
		
		html, 
		body,
		header,
		main,
		footer,
		div,
		section {
			display: block;
			margin: 0;
			padding: 0;
			box-sizing: border-box;
			font-family: 'Roboto', sans-serif;
			position: relative;
			font-size: 12pt;
		}

		body {
			background-image: url('vhost/img/server.jpg');
		}

		body::before {
			content: "";
			display: block;
			width: 100%;
			height: 100vh;
			position: absolute;
			top: 0;
			left: 0;
			z-index: 0;
			overflow: hidden;
			background-color: rgba( 0, 0, 0, 0.4 );

		}


		html .img {
			background-size: cover cover;
			background-repeat: no-repeat;
			background-position: center center;
		}

		header, 
		a {
			background-color: rgba( 245, 245, 245, 0.9 );
			box-sizing: border-box;
			border: solid 1px #CCC;
		}

		header > * {
			margin: 12px 0;
			padding: 0 16px;
			box-sizing: border-box;
		}

		header small {
			color: #AAA;
			font-size: 0.6em;
			padding: 0 0 0 8px;
		}

		main {
			text-align: left;
			padding: 32px 0;
		}

		main a {
			display: inline-block;
			color: #424242;
			text-decoration: none;
			margin: 0;
			padding: 0;
			width: calc( 50% - ( 32px + 4px ) );
			margin: 0px 16px 16px 16px;
			cursor: pointer;
			border-radius: 4px;
		}

		main a:hover,
		main a:focus {
			box-shadow: 0px 0px 16px 4px rgba( 255, 255, 255, 0.3 ), 0 0 2px 2px #2222;
		}

		section {
			border-radius: 4px;
			width: 100%;
			display: inline-block;
			vertical-align: top;
			text-align: left;
			background-color: transparent;
		}

		section > * {
			padding: 12px;
			border-bottom: solid 1px #CCC;
			
		}

		section > div.domain {
			display: grid;
			grid-template-columns: 32px 1fr;
			grid-template-rows: 32px;
			align-items: center;
		}

		section > div.config {
			display: grid;
			grid-template-columns: 32px 2fr 32px 1fr;
			grid-template-rows: 1fr;
			align-items: center;
		}

		section span {
			display: inline-block;
			width: 32px;
			height: 32px;
		}

		section  strong {
			padding: 0 16px;
		}

		section span.server-on {
			background-image: url('vhost/img/server-on.png');
		}

		section span.server-off {
			background-image: url('vhost/img/server-off.png');
		}

		div.server-off,
		div.folder-off {
			background-color: rgba( 176, 0, 32, 0.1 );
		}

		section span.folder-on {
			background-image: url('vhost/img/folder-on.png');
		}

		section span.folder-off {
			background-image: url('vhost/img/folder-off.png');
		}

		section span.config {
			background-image: url('vhost/img/config.png');
		}

	</style>
</head>
<body class="img">
	<header>
		<h2>Running Server <small><?php echo $_SERVER['HTTP_HOST']; ?></small></h2>
	</header>
	<main>

<?php 

function addLink ( string $path, string $domain, string $port = "80" ) {

		$server = ( ping ( $domain ) ) ? "server-on" : "server-off";
		$folder = ( checkDir ( $path ) ) ? "folder-on" : "folder-off";

	if ( checkDir ( $path ) ) { 


		echo '<a href="http://'.$domain.':'.$port.'">
				<section>
					<div class="domain '.$server.'">
						<span class="img '.$server.'"></span>
						<strong>http://'.$domain.':'.$port.'</strong>
					</div>
					<div class="config '.$folder.'">
						<span class="img '.$folder.'"></span>
						<strong>/'.$path.'</strong>
					</div>
				</section>
			</a>';
	} else {
		echo '<a href="http://localhost">
				<section>
					<div class="domain '.$server.'">
						<span class="img '.$server.'"></span>
						<strong>http://localhost</strong>
					</div>
					<div class="config '.$folder.'">
						<span class="img '.$folder.'"></span>
						<strong>NO DIR</strong>
					</div>
				</section>
			</a>';
	}
};

function ping ( string $domain = "localhost" ) {
	$status = FALSE;
	exec ( "ping -n 1 -w 1 " . $domain, $output, $result );
	$status =  ( !$result && count ( $output ) > 2 ) ? TRUE : FALSE;
	return $status;
}

function checkDir ( string $dir = "" ) {
	return ( realpath ( $dir ) && is_dir ( $dir ) ) ? TRUE : FALSE;
};

function GetDirectorySize ( $path ) {
    $bytestotal = 0;
    $path = realpath ( $path );
    if ( $path!==false && $path!='' && file_exists ( $path ) ) {
        foreach (new RecursiveIteratorIterator ( new RecursiveDirectoryIterator ( $path, FilesystemIterator::SKIP_DOTS ) ) as $object ) {
            $bytestotal += $object->getSize ( );
        }
    }
    return round ( ( $bytestotal / 1024 ) / 1024 );
};