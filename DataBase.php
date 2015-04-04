<?php
 //clase que crea la coneccion ala BD
require_once('./config.php'); 

class DataBase 
{
		//coneccion de la base de datos
		public function conectar() {

			
			$coneccion = new PDO(DB_TYPE.":"."host=".DB_HOST.";dbname=".DB_NAME,DB_USER,DB_PASS);
			return $coneccion;
		}

		public function estado_bd()
		{
			if ($coneccion != null)
			{

				return true;

			}
			return false;
		}//true si esta conectado ala database


public function delete($class,$id)
{
	$coneccion=$this->conectar();
	$consulta ="DELETE FROM $class WHERE id = :id" ;
	$sql=$coneccion->prepare($consulta);
		$sql->bindParam("id",$id);
		$sql->execute();
	
}
public function update($class,$atributes)
	{	
		$names = array_keys($atributes);
		$coneccion=$this->conectar();//creando coneccion BD

		$values= "";
		//$keys;

		$id= $atributes["id"];	//ere it foudn the id
		for ($i=0; $i <count($names) ; $i++)//in this cycle i got the values an his respectives key with : in the begining of the word
		{ 
			if($names[$i]!="id")
			{
				if ($i!=count($names)-1) {
				$values = $values.$names[$i]."="." ".":".$names[$i].",";
				
				}
				else{
				$values= $values.$names[$i]."="." ".":".$names[$i];
				
				} 
			
			}
		}
		//$values = $values.")";//closing the instruction
//var_dump($values);

		//$keys= $keys.")";////closing the instruction
//print_r($keys);
//var_dump($atributes);
		$consulta="UPDATE $class set $values Where id = :id" ;//Creating the Sql full intruction
		
		var_dump($consulta);
		//binding the params for later execute
		$sql=$coneccion->prepare($consulta);
		$sql->bindParam("id",$id);
		for ($i=0; $i <count($names) ; $i++) 
		{ 	
			if($names[$i]!="id"){
				//var_dump($names[$i]);

			$sql->bindParam($names[$i],$atributes[$names[$i]]);
			}

		}

		
		$signal=$sql->execute();//execution the sql
		///var_dump($signal."hola");
		if ($signal ==1) {
			return true;
		}
		
			return false;
		

		/*
			
		*/
	}


public function insert($class,$atributes)
	{	
		$names = array_keys($atributes);
		$coneccion=$this->conectar();

		$values = "(";
		$keys = "(";
		for ($i=0; $i <count($names) ; $i++)
		{ 
			if($names[$i]!="id")
			{
				if ($i!=count($names)-1) {
				$values= $values.$names[$i].",";
				$keys = $keys.":".$names[$i].",";
				}
				else{
				$values= $values.$names[$i];
				$keys = $keys.":". $names[$i];
				} 
			
			}
		}
		$values = $values.")";
//var_dump($values);

		$keys= $keys.")";
//print_r($keys);
//var_dump($atributes);
		$consulta="INSERT INTO $class  $values VALUES $keys";
		var_dump($consulta);
		$sql=$coneccion->prepare($consulta);
		for ($i=0; $i <count($names) ; $i++) 
		{ 	
			if($names[$i]!="id"){
				//var_dump($names[$i]);

			$sql->bindParam($names[$i],$atributes[$names[$i]]);
			}

		}

		
		$signal=$sql->execute();
		///var_dump($signal."hola");
		if ($signal ==1) {
			return true;
		}
		
			return false;
		

		/*
			
		*/
	}

public function select($class,$atribute,$consult_atribute,$value) //if value is null returns all
{		/*
			$class : the name of the class and the table
			$atribute : the name of the atributes of select
			$consult_atribute : the attribute of the table or class
			$value : the value of the consult

		*/
		$coneccion=$this->conectar();
	if ($atribute=='') {
		
		$atribute='*';
	}
	if($value==null){

		$sql="SELECT $atribute FROM $class";

	}
	else
	{
		$sql="SELECT $atribute FROM $class WHERE $consult_atribute = $value";
	}
		$res=$coneccion->prepare($sql);
		$res->execute();///ejecuto para lrelizar la consulta

	    $resultado = $res->fetchAll();
	    return $resultado;
		}

}//fin clase

 ?>