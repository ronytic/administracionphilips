<?php 
include_once '../../login/check.php';
if (!empty($_POST)) {
	$folder="../../";
	include_once '../../class/productos.php';
	include_once '../../class/compra.php';
	extract($_POST);
	
	
	$productos=new productos;
	$compra=new compra;
	
	
	$codproductos=$codproductos!=""?$codproductos:'%';
	$codproveedor=$codproveedor!=""?$codproveedor:'%';
	$fechavencimiento=$fechavencimiento!=""?$fechavencimiento:'%';
	
	foreach($compra->mostrarTodo("codproveedor LIKE '$codproveedor' and codproductos LIKE '$codproductos' and fechavencimiento LIKE '$fechavencimiento'")as $mp){$i++;
	$pro=array_shift($productos->mostrar($mp['codproductos']));
	$datos[$i]['codcompra']=$mp['codcompra'];
	$datos[$i]['producto']=$pro['nombre'];
	$datos[$i]['fechacompra']=$mp['fechacompra'];
	$datos[$i]['fechavencimiento']=$mp['fechavencimiento'];
	$datos[$i]['cantidad']=$mp['cantidad'];
	$datos[$i]['cantidadstock']=$mp['cantidadstock'];
	$datos[$i]['observacion']=$mp['observacion'];
	}
	
	
	
	$titulo=array("fechacompra"=>"Fecha de Compra","producto"=>"Producto","cantidad"=>"Cantidad","cantidadstock"=>"Cantidad Stock","fechavencimiento"=>"Fecha de Vencimiento","observacion"=>"Observación");
	if($_SESSION['Nivel']==1 || $_SESSION['Nivel']==2){
		$eliminar="eliminar.php";
	}else{
		$eliminar="";
	}
	listadoTabla($titulo,$datos,1,"modificar.php",$eliminar,"ver.php");
}
?>