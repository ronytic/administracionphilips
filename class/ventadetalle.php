<?php
include_once("bd.php");
class ventadetalle extends bd{
	var $tabla="ventadetalle";
	function sumarProducto($codproducto){
		$this->campos=array("sum(cantidad) as cantidadventatotal,sum(subtotal) as total");
		return $this->getRecords("codproducto=$codproducto and activo=1");	
	}
	function masMenosVendido($where,$mas=1){
		
		$this->campos=array("sum(cantidad) as cantidadVendida,codproducto,sum(preciounitario),sum(`subtotal`) as subtotal,id");
		return $this->getRecords($where." and activo=1","sum(cantidad)","codproducto",0,0,$mas);	
	}
    function totalventames($mes=1,$anio){
		$this->campos=array("*,count(*) as Cantidad,MONTH(`fecha`) as Mes");
		return $this->getRecords("MONTH(`fecha`) = '$mes' and YEAR(`fecha`)='$anio' and activo=1");	
	}
    function totalventadia($dia){
		$this->campos=array("*,count(*) as Cantidad,MONTH(`fecha`) as Mes");
		return $this->getRecords("`fecha`='$dia' and activo=1");	
	}
}
?>