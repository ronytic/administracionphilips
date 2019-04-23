<?php
include_once("bd.php");
class logusuarios extends bd{
	var $tabla="logusuarios";
	function estadoTabla(){
		return $this->statusTable();
	}
	function insertarRegistro($Values){
		$this->insertRow($Values,1,0);
	}
}
?>