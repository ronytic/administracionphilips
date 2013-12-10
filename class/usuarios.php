<?php
include_once("bd.php");
class usuarios extends bd{
	var $tabla="usuarios";
	function loginUsuarios($Usuario,$Password){
		$this->campos=array("count(*) as Can,codusuarios,nivel");	
		return $this->getRecords("usuario='$Usuario' and password=MD5('$Password') and activo=1");
	}
	function mostrars($cod){
		$this->campos=array("*");	
		return $this->getRecords("codusuarios='$cod' and activo=1");
	}
}
?>