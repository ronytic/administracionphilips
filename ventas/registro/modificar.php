<?php
include_once '../../login/check.php';
$folder="../../";
$titulo="Modificar Compra de Producto";
$id=$_GET['id'];
include_once '../../class/venta.php';
$venta=new venta;
$mp=array_shift($venta->mostrar($id));

include_once("../../class/productos.php");
$productos=new productos;
$pro=todolista($productos->mostrarTodo("","nombre"),"codproductos","nombre","");

include_once("../../class/distribuidor.php");
$distribuidor=new distribuidor;
$dist=todolista($distribuidor->mostrarTodo("","nombre"),"coddistribuidor","nombre,departamento","-");

include_once("../../class/cliente.php");
$cliente=new cliente;
$cli=todolista($cliente->mostrarTodo("","nombre"),"codcliente","nombre","-");


include_once '../../funciones/funciones.php';
include_once '../../cabecerahtml.php';
?>
<?php include_once '../../cabecera.php';?>
<div class="grid_12">
	<div class="contenido">
    	<div class="prefix_3 grid_4 alpha">
			<fieldset>
				<div class="titulo"><?php echo $titulo?></div>
                <form action="actualizar.php" method="post" enctype="multipart/form-data">
                <?php campos("","id","hidden",$id);?>
				<table class="tablareg">
                	<tr>
						<td><?php campos("Fecha de Venta","fechaventa","date",$mp['fechaventa'],0,array("required"=>"required"));?></td>
					</tr>
					<tr>
						<td><?php campos("Producto","codproductos","select",$pro,1,array("required"=>"required","disabled"=>"disabled","class"=>"disabled"),$mp['codproductos']);?><br><div class="rojoC pequeno">Por seguridad no se permite la modificación</div></td>
					</tr>
					<tr>
						<td><?php campos("Cantidad","cantidad","number",$mp['cantidad'],0,array("class"=>"der","min"=>0,"readonly"=>"readonly"));?><br><div class="rojoC pequeno">Por seguridad no se permite la modificación</div></td>
					</tr>
                    <tr>
						<td><?php campos("Precio Unitario","preciounitario","number",$mp['preciounitario'],0,array("step"=>"0.1","min"=>0,"class"=>"der","readonly"=>"readonly"));?>Bs<br><div class="rojoC pequeno">Por seguridad no se permite la modificación</div></td>
					</tr>
                    <tr>
						<td><?php campos("Total","total","text",$mp['total'],0,array("class"=>"der","readonly"=>"readonly"));?>Bs</td>
					</tr>
                    <tr>
						<td><?php campos("Cliente","codcliente","select",$cli,0,"",$mp['codcliente']);?></td>
					</tr>
                    <tr>
						<td><?php campos("Distribuidor","coddistribuidor","select",$dist,0,"",$mp['coddistribuidor']);?></td>
					</tr>
                    
                    <tr>
						<td><?php campos("Observación","observacion","textarea",$mp['observacion']);?></td>
					</tr>
					<tr><td><div class="rojoC pequeno">La Cantidad Introducida se utilizará para descontar de el inventario, Revíselo antes de Registrarlo, Posteriormente no se podra modificar la CANTIDAD y PRECIO de venta</div><?php campos("Guardar","guardar","submit");?></td><td></td></tr>
				</table>
                </form>
			</fieldset>
		</div>
    	<div class="clear"></div>
    </div>
</div>
<?php include_once '../../piepagina.php';?>