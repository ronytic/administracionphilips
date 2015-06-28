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
	function mostrarCompraGrupo($where){
		$this->campos=array("sum(cantidad) as cantidad,sum(cantidadstock) as cantidadstock, sum(total) as total,codproducto");
		return $this->getRecords($where,"fechacompra","codproducto");	
	}
    function totalcomprames($mes=1,$anio){
		$this->campos=array("*,count(*) as Cantidad,MONTH(`fechacompra`) as Mes");
		return $this->getRecords("MONTH(`fechacompra`) = '$mes' and YEAR(`fechacompra`)='$anio' and activo=1");	
	}
    function totalcompradia($dia){
		$this->campos=array("*,count(*) as Cantidad,MONTH(`fechacompra`) as Mes");
		return $this->getRecords("`fechacompra`='$dia' and activo=1");	
	}
}
?>