<?php
include_once '../../login/check.php';
$folder="../../";
$titulo="Modificar Compra de Producto";
$id=$_GET['id'];
include_once '../../class/compra.php';
$compra=new compra;
$mp=array_shift($compra->mostrar($id));

include_once("../../class/productos.php");
$productos=new productos;
$pro=todolista($productos->mostrarTodo("","nombre"),"codproductos","nombre","");

include_once("../../class/proveedor.php");
$proveedor=new proveedor;
$prov=todolista($proveedor->mostrarTodo("","nombre"),"codproveedor","nombre,origen","-");


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
						<td><?php campos("Fecha de Compra","fechacompra","date",$mp['fechacompra'],1,array("required"=>"required"));?></td>
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
						<td><?php campos("Total","total","text",$mp['total'],0,array("class"=>"der","readonly"=>"readonly"));?>Bs<br><div class="rojoC pequeno">Por seguridad no se permite la modificación</div></td>
					</tr>
                    <tr>
						<td><?php campos("Proveedor","codproveedor","select",$prov,0,"",$mp['codproveedor']);?></td>
					</tr>
                    <tr>
						<td><?php campos("Fecha de Vencimiento","fechavencimiento","date",$mp['fechavencimiento'],0,array("required"=>"required"));?></td>
					</tr>
                    <tr>
						<td><?php campos("Observación","observacion","textarea",$mp['observacion']);?></td>
					</tr>
					<tr><td><div class="rojoC pequeno">La Cantidad Introducida se contará para el inventario, Reviselo antes de Registrarlo, Posteriormente no se podra modificar la CANTIDAD y PRECIO</div><?php campos("Guardar","guardar","submit");?></td><td></td></tr>
				</table>
                </form>
			</fieldset>
		</div>
    	<div class="clear"></div>
    </div>
</div>
<?php include_once '../../piepagina.php';?>