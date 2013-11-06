<?php 
include_once '../../login/check.php';
if (!empty($_POST)) {
	$folder="../../";
	include_once '../../class/sindicato.php';
	extract($_POST);

	$sindicato=new sindicato;
	$sin=$sindicato->mostrarTodo("nombre LIKE '%$nombre%'");
	$titulo=array("nombre"=>"Nombre","personeriajuridica"=>"Personería Jurídica","nombreresponsable"=>"Nombre Responsable","telefono"=>"Teléfono","direccion"=>"Dirección");
	listadoTabla($titulo,$sin,1,"modificar.php","eliminar.php","ver.php");
}
?>