<?php 
include_once '../../login/check.php';
if (!empty($_POST)) {
	$folder="../../";
	include_once '../../class/producto.php';
	include_once '../../class/compra.php';
	extract($_POST);
	
	
	$producto=new producto;
	$compra=new compra;
	
	
	$codproducto=$codproducto!=""?$codproducto:'%';
	$codproveedor=$codproveedor!=""?$codproveedor:'%';
	$modelo=$modelo!=""?$modelo:'%';
	$fecha=$fecha!=""?$fecha:'%';
	
	
	foreach($compra->mostrarTodo("codproveedor LIKE '$codproveedor' and codproducto LIKE '$codproducto' and modelo LIKE '$modelo' and fecha LIKE '$fecha'")as $mp){$i++;
	$pro=array_shift($producto->mostrar($mp['codproducto']));
	$datos[$i]['codcompra']=$mp['codcompra'];
	$datos[$i]['producto']=$pro['nombre'];
	$datos[$i]['fechacompra']=$mp['fechacompra'];
	$datos[$i]['modelo']=$mp['modelo'];
	$datos[$i]['cantidad']=$mp['cantidad'];
	$datos[$i]['cantidadstock']=$mp['cantidadstock'];
	$datos[$i]['observacion']=$mp['observacion'];
	}
	
	
	
	$titulo=array("fechacompra"=>"Fecha de Compra","producto"=>"Producto","cantidad"=>"Cantidad","cantidadstock"=>"Cantidad Stock","modelo"=>"Modelo","observacion"=>"Observación");
	if($_SESSION['Nivel']==1 || $_SESSION['Nivel']==2){
		$eliminar="eliminar.php";
	}else{
		$eliminar="";
	}
	listadoTabla($titulo,$datos,1,"modificar.php",$eliminar,"ver.php");
}
?>