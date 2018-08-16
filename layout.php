<?php 

function addLink ( string $name, string $link ) {
	echo '<a href="'.$link.'">'.$name.'</a>'; 
};

function report ( ) {
	echo "<ul>";
	array_map ( function ( $item ) {
		echo "<li>MSG::".$item."</li>";
	}, $GLOBALS[ "report" ]  );
	echo "</ul";
};

echo '
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
	<title>Localhost</title>
</head>
<style>
	body {
		padding: 0;
		margin: 0;
		background-color: #E8F5E9;
		color: #FFF;
		font-family: Verdana, ssans-serif;
	}

	body h1 {
		display: block;
		background-color: #009688;
		color: #FFF;
		padding: 20px;
		border-bottom: solid 3px #004D40;
	}

	body a {
		background-color: #00695C;
		border: solid 1px #FFF;
		color: #FFF;
		display: block;
		margin: 2px 8px;
		max-width: 320px;
		padding: 8px 16px;
		position: relative;
		text-decoration: none;
		-webkit-transition: all 0.1s ease-in-out;
		-moz-transition: all 0.1s ease-in-out;
		-ms-transition: all 0.1s ease-in-out;
		-o-transition: all 0.1s ease-in-out;
		transition: all 0.1s ease-in-out;
		width: calc( 100% - 48px );
	}

	body a:hover {
		background-color: #00897B;
		-webkit-transform: scale(1.02);
		-moz-transform: scale(1.02);
		-ms-transform: scale(1.02);
		-o-transform: scale(1.02);
		transform: scale(1.02);
	}

	body ul {
		display: block;
		padding: 14px;
		max-width: 600px;
		width:100%;
		background-color: #FFF;
	}

	body ul > li {
		padding: 7px 7px 7px 14px;
		border: solid 1px #DDD;
		color: #424242;
	}
</style>';
echo '<h1>Localhost</h1>';