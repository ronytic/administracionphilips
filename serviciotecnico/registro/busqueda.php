<?php
include_once '../../login/check.php';
if (!empty($_POST)) {
	$folder="../../";
	include_once '../../class/serviciotecnico.php';
	include_once '../../class/producto.php';
	extract($_POST);
	$producto=new producto;
	$codproducto=$codproducto?"codproducto='$codproducto'":"codproducto LIKE '%'";
	$estado=$estado!=""?"estado='$estado'":"estado LIKE '%'";
	$estadogarantia=($estadogarantia!="")?"estadogarantia='$estadogarantia'":"estadogarantia LIKE '%'";
	$serviciotecnico=new serviciotecnico;
	$sertec=$serviciotecnico->mostrarTodo("nombre LIKE '%$nombre%' and ci LIKE '%$ci%' and nserie LIKE '%$nserie%' and fechaentrega LIKE '%$fechaentrega%' and $codproducto and $estado and $estadogarantia");
	$i=0;
	foreach($sertec as $st){$i++;
		$prod=$producto->mostrar($st['codproducto']);
		$prod=array_shift($prod);

		$datos[$i]['codserviciotecnico']=$st['codserviciotecnico'];
		$datos[$i]['producto']=$prod['nombre'];
		$datos[$i]['nombre']=$st['nombre'];
		$datos[$i]['ci']=$st['ci'];
		$datos[$i]['telefono']=$st['telefono'];
		$datos[$i]['nserie']=$st['nserie'];
		$datos[$i]['fechaentrega']=$st['fechaentrega'];
		$datos[$i]['total']=$st['total'];
		$datos[$i]['estadogarantia']=$st['estadogarantia']?"Si":"No";
		$datos[$i]['estado']=$st['estado']?"Si":"No";
		$datos[$i]['codserviciotecnico']=$st['codserviciotecnico'];
	}

	$titulo=array("producto"=>"Producto","nombre"=>"Nombre","ci"=>"C.I.","telefono"=>"Teléfono","nserie"=>"N Serie","fechaentrega"=>"Fecha de Entrega","total"=>"Total","estado"=>"Solucionado","estadogarantia"=>"Estado de Garantia");
	listadoTabla($titulo,$datos,1,"modificar.php","eliminar.php","ver.php");
}
?>