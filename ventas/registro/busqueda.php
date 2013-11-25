<?php 
include_once '../../login/check.php';
if (!empty($_POST)) {
	$folder="../../";
	//include_once '../../class/productos.php';
	include_once '../../class/venta.php';
	//include_once '../../class/cliente.php';
	extract($_POST);
	
	
	//$productos=new productos;
	$venta=new venta;
	//$cliente=new cliente;
		
	$ci=$ci!=""?$ci:'%';
	$observacion=$observacion!=""?$observacion:'%';
	$cliente=$cliente!=""?$cliente:'%';
	$fechaventa=$fechaventa!=""?$fechaventa:'%';
	
	foreach($venta->mostrarTodo("cliente LIKE '$cliente' and ci LIKE '$ci' and observacion LIKE '$observacion' and fechaventa LIKE '$fechaventa'","fechaventa")as $mp){$i++;
				
		$datos[$i]['codventa']=$mp['codventa'];
		$datos[$i]['cliente']=$mp['cliente'];
		$datos[$i]['fechaventa']=$mp['fechaventa'];
		$datos[$i]['ci']=$mp['ci'];
		$datos[$i]['pagado']=$mp['pagado'];
		$datos[$i]['devolucion']=$mp['devolucion'];
		$datos[$i]['total']=$mp['total'];
		$datos[$i]['observacion']=$mp['observacion'];
	}
	
	
	
	$titulo=array("fechaventa"=>"Fecha de Venta","cliente"=>"Cliente","ci"=>"C.I.","pagado"=>"Pagado","devolucion"=>"Cambio","total"=>"Total","observacion"=>"Observación");
	listadoTabla($titulo,$datos,1,"modificar.php","","",array("Ver Nota"=>"vernota.php","Ver Factura"=>"verfactura.php"),"","_blank");
}
?>