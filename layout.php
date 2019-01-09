<?php 

function addLink ( string $name, string $link ) {
	echo '<a href="'.$link.'">'.$name.'</a>'; 
};

echo '
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
	<link rel="icon" href="vhost/server.png" sizes="32x32">
	<title>Localhost</title>

<style>
	html, body {
		padding: 0;
		margin: 0;
		background-color: #E8F5E9;
		color: #000;
		font-family: Verdana, ssans-serif;
		boxing-size: border-box;
	}

	body > * {
		margin: 0;
		padding: 8px 16px;
		boxing-size: border-box;
	}

	body h1 {
		background-color: #009688;
		border-bottom: solid 3px #004D40;
		color: #FFF;
		margin-bottom: 16px;
		padding: 16px 24px;
	}

	body a {
		background-color: #00695C;
		border: solid 1px #FFF;
		color: #FFF;
		display: block;
		max-width: 320px;
		position: relative;
		margin: 0 0 2px 16px;
		text-decoration: none;
		-webkit-transition: all 0.1s ease-in-out;
		-moz-transition: all 0.1s ease-in-out;
		-ms-transition: all 0.1s ease-in-out;
		-o-transition: all 0.1s ease-in-out;
		transition: all 0.1s ease-in-out;
		width: 100%;
		will-change: transition, transform, scale;
	}

	body a:hover {
		background-color: #00897B;
		-webkit-transform: scale( 1.01 );
		-moz-transform: scale( 1.01 );
		-ms-transform: scale( 1.01 );
		-o-transform: scale( 1.01 );
		transform: scale( 1.01 );
	}
</style>
</head>
<body>
<h1>Localhost</h1>';