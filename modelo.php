<?php 
//clase base para los modelo
require_once('DataBase.php');
require_once('Factory.php');
abstract class modelo
{
	//public $pk==null;//if pk is null, the pk is the "id"


		public static function find($id)
		{	
			//get_called_class() obteain the class name where this method is called.
			$bd = new DataBase ();
			$consulta = $bd->select(get_called_class(),'','id',$id);
			

			/*foreach ($consulta as $row) {// los exploro
				
				//$arreglo[] = $row[$atributos[$cont]]."<br> ";
				
				}*/
				$f= new Factory();
				var_dump($consulta[0]);
				return $f->crear(get_called_class(),$consulta[0]);
			
		}


		public function destroy()
		{
			$bd = new DataBase ();
			$bd->delete(get_called_class(),$this->id);
		}

		public function update()
		{	
			$aux=get_object_vars($this); 
			//$aux = array_keys($aux);
			$bd = new DataBase ();
			$bd->update(get_called_class(),$aux);
		}

		public function save()
		{	
			$aux=get_object_vars($this); 
			//$aux = array_keys($aux);
			$bd = new DataBase ();
			$bd->insert(get_called_class(),$aux);
		}

		public function __call($name, $arguments)
   		{
        // Nota: el valor $name es sensible a mayúsculas.
        echo "Llamando al método de objeto '$name' "
             . implode(', ', $arguments). "\n";
   		}






		//public abstract function nombre();
		//public abstract function clase();

/*public function __construct() {
	
}
public function __construct() {
	
}*/
/*public static function hola()
{
	echo 'holaa';
}*/
/*
FACTORY CLASS FOR CREATING OBJECTS DYNAMIC

*/
}
 ?>