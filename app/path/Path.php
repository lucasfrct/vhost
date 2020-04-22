<?php 
#Path.php
/*
* Autor: Lucas Costa
* Data: Abril 2020
*/

Class Path
{	
	# @param $path : string
	# @return : string (type directory)
	public function digest ( string $path = "" ): string 
	{
		$path = str_replace ( array ( '/', '\\' ), DIRECTORY_SEPARATOR, $path );
		return realpath ( $path );
	}

	# lista arquivos em diretório
	public function list ( $diretory ) 
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

	public function check ( string $directory = "" ) {
		return ( realpath ( $directory ) && is_dir ( $directory ) ) ? true : false;
	}
}

#$path = new Path ( );
#$out = $path->digest ( "d:/lc/" );
#$out = $path->check ( "d:/lc/" );
#$out = $path->list ( "d:/lc/" );
#var_dump ( $out );