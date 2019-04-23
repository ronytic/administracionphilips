<?php
include_once '../../login/check.php';
if (!empty($_POST)) {
	$folder="../../";
	include_once '../../class/pedido.php';
	include_once '../../class/producto.php';
	extract($_POST);
	$producto=new producto;
	$codproducto=$codproducto?"codproducto='$codproducto'":"codproducto LIKE '%'";
	// $estado=$estado!=""?"estado='$estado'":"estado LIKE '%'";
	$entregado=($entregado!="")?"entregado='$entregado'":"entregado LIKE '%'";
	$pedido=new pedido;
	$ped=$pedido->mostrarTodo("nombre LIKE '%$nombre%' and ci LIKE '%$ci%' and fechaentrega LIKE '%$fechaentrega%' and $codproducto and $entregado");
	$i=0;
	foreach($ped as $st){$i++;
		$prod=$producto->mostrar($st['codproducto']);
		$prod=array_shift($prod);

		$datos[$i]['codpedido']=$st['codpedido'];
		$datos[$i]['producto']=$prod['nombre'];
		$datos[$i]['nombre']=$st['nombre'];
		$datos[$i]['ci']=$st['ci'];
		$datos[$i]['telefono']=$st['telefono'];
		$datos[$i]['cantidad']=$st['cantidad'];
		$datos[$i]['fechaentrega']=$st['fechaentrega'];
		$datos[$i]['total']=$st['total'];
		$datos[$i]['preciocotizacion']=$st['preciocotizacion'];
		// $datos[$i]['estadogarantia']=$st['estadogarantia']?"Si":"No";
		$datos[$i]['entregado']=$st['entregado']?"Si":"No";
	}

	$titulo=array("producto"=>"Producto","nombre"=>"Nombre","ci"=>"C.I.","telefono"=>"Teléfono","fechaentrega"=>"Fecha de Entrega","cantidad"=>"Cantidad","preciocotizacion"=>"Precio","total"=>"Total","entregado"=>"Entregado");
	listadoTabla($titulo,$datos,1,"modificar.php","eliminar.php","ver.php");
}
?>