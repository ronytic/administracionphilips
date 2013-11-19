<?php 
include_once '../../login/check.php';
if (!empty($_POST)) {
	$folder="../../";
	include_once '../../class/productos.php';
	include_once '../../class/venta.php';
	include_once '../../class/cliente.php';
	extract($_POST);
	
	
	$productos=new productos;
	$venta=new venta;
	$cliente=new cliente;
	
	
	$codproductos=$codproductos!=""?$codproductos:'%';
	$coddistribuidor=$coddistribuidor!=""?$coddistribuidor:'%';
	$codcliente=$codcliente!=""?$codcliente:'%';
	$fechaventa=$fechaventa!=""?$fechaventa:'%';
	
	foreach($venta->mostrarTodo("codcliente LIKE '$codcliente' and coddistribuidor LIKE '$coddistribuidor' and codproductos LIKE '$codproductos' and fechaventa LIKE '$fechaventa'")as $mp){$i++;
	$pro=array_shift($productos->mostrar($mp['codproductos']));
	$cli=array_shift($cliente->mostrar($mp['codcliente']));
	$datos[$i]['codventa']=$mp['codventa'];
	$datos[$i]['producto']=$pro['nombre'];
	$datos[$i]['fechaventa']=$mp['fechaventa'];
	$datos[$i]['nombre']=$cli['nombre'];
	$datos[$i]['cantidad']=$mp['cantidad'];
	$datos[$i]['preciounitario']=$mp['preciounitario'];
	$datos[$i]['observacion']=$mp['observacion'];
	}
	
	
	
	$titulo=array("fechaventa"=>"Fecha de Venta","producto"=>"Producto","cantidad"=>"Cantidad","preciounitario"=>"Precio Unitario","nombre"=>"Cliente","observacion"=>"Observación");
	listadoTabla($titulo,$datos,1,"modificar.php","","ver.php");
}
?>