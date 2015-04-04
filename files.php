<?php 
//if(get_called_class()=="Factory"){
	foreach (glob("modelos/models/*.php") as $filename)
	{
		if($filename!="Factory")
		{
	    require_once $filename;
	    //echo$filename;
		}
	}
//}
 ?>	