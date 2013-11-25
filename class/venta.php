<?php
include_once("bd.php");
class venta extends bd{
	var $tabla="venta";
	function sumarProducto($codproductos){
		$this->campos=array("sum(cantidad) as cantidadventatotal");
		return $this->getRecords("codproductos=$codproductos and activo=1");	
	}
}
?>