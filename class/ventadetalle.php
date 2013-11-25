<?php
include_once("bd.php");
class ventadetalle extends bd{
	var $tabla="ventadetalle";
	function sumarProducto($codproductos){
		$this->campos=array("sum(cantidad) as cantidadventatotal");
		return $this->getRecords("codproductos=$codproductos and activo=1");	
	}
}
?>