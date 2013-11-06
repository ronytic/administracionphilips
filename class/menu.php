<?php 
include_once("bd.php");
class menu extends bd{
	var $tabla="menu";
	function mostrarMenu($Nivel){
		$this->campos=array("*");
		switch ($Nivel) {
			case 1:{return $this->getRecords("superadmin=1 and activo=1","orden");}break;
			case 2:{return $this->getRecords("direccion=1 and activo=1","orden");}break;
			case 3:{return $this->getRecords("unidadtrafico=1 and activo=1","orden");}break;
			case 4:{return $this->getRecords("tecnico=1 and activo=1","orden");}break;
			case 5:{return $this->getRecords("secretaria=1 and activo=1","orden");}break;
		}
	}
}
?>