<?php 
include_once '../../login/check.php';
if (!empty($_POST)) {
	$folder="../../";
	include_once '../../class/proveedor.php';
	extract($_POST);

	$proveedor=new proveedor;
	$prov=$proveedor->mostrarTodo("nombre LIKE '%$nombre%'");
	$titulo=array("nombre"=>"Nombre","direccion"=>"Dirección","telefono"=>"Teéfono","observacion"=>"Observación");
	listadoTabla($titulo,$prov,1,"modificar.php","eliminar.php","ver.php");
}
?>