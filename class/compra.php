<?php
include_once("bd.php");
class compra extends bd{
	var $tabla="compra";
	function sumar($codproducto){
		$this->campos=array("sum(cantidadstock) as cantidadtotalstock");
		return $this->getRecords("codproducto=$codproducto and activo=1");	
	}
	function sumarProducto($codproductos){
		$this->campos=array("sum(cantidad) as cantidadcompratotal");
		return $this->getRecords("codproductos=$codproductos and activo=1");	
	}
	function sumarTotalProducto($codproductos){
		$this->campos=array("sum(cantidadstock) as cantidadtotalstock");
		return $this->getRecords("codproducto=$codproductos and activo=1");	
	}
}
?>