<?php
/*
* Lucas Costa
* Ago 2019
*/
Class Archive
{
	public function read ( string $src = "" ): string 
	{
		return file_get_contents ( $src );
	}

	public function write ( string $src = "", string $content = "", $flag = FILE_APPEND ): bool
	{	
		chmod ( $src, 0755 );
		return file_put_contents ( $src, $content, $flag );
	} 

	#função para procurar textos
	public function find ( string $scr = "", string $content = "" ): bool 
	{
		return ( strstr ( $this->read ( $scr ),  $content ) ) ? TRUE : FALSE;
	}
}