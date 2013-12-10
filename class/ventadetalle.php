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
}
?>