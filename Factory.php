<?php 
/**
* 
*/
//require_once('files.php');
include_once('models/Usuarios.php');
include_once('Utilidades.php');
class Factory
{
	public function crear($name,$atribs)
	{	
		$array_ke=array_keys($atribs);//here i got the keys of the array $attribs
		$aux = new $name();//here i create a new instace of the class
		$temp = array_only_keys($array_ke);//here i took only the important keys
		
			for ($i=0; $i <(count($atribs)/2); $i++) { 
	
					$aux->$temp[$i] = $atribs[$i];//I asgin dinacmilly the attribs an his value
				}

				return $aux;//return the object
	}
}



 ?>