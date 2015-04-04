<?php 
function array_only_keys($value)
{
	$temp = array();
		for ($i=0; $i < count($value); $i++) { 
			if($i%2==0){
						$temp[] = $value[$i];
					
					}
		}
return $temp;
}//fin function



 ?>	