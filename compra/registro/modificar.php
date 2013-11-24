<?php
include_once '../../login/check.php';
$folder="../../";
$titulo="Modificar Compra de Producto";
$id=$_GET['id'];
include_once '../../class/compra.php';
$compra=new compra;
$mp=array_shift($compra->mostrar($id));

include_once("../../class/producto.php");
$producto=new producto;
$pro=todolista($producto->mostrarTodo("","nombre"),"codproducto","nombre,descripcion,codbarra","-");

include_once("../../class/proveedor.php");
$proveedor=new proveedor;
$prov=todolista($proveedor->mostrarTodo("","nombre"),"codproveedor","nombre,origen","-");


include_once '../../funciones/funciones.php';
include_once '../../cabecerahtml.php';
?>
<?php include_once '../../cabecera.php';?>
<div class="grid_12">
	<div class="contenido imagenfondo">
    	<div class="prefix_2 grid_4 alpha">
			<fieldset>
				<div class="titulo"><?php echo $titulo?></div>
                <form action="actualizar.php" method="post" enctype="multipart/form-data">
                <?php campos("","id","hidden",$id);?>
				<table class="tablareg">
                	<tr>
						<td><?php campos("Fecha de Compra","fechacompra","date",$mp['fechacompra'],1,array("required"=>"required"));?></td>
					</tr>
					<tr>
						<td colspan="3"><?php campos("Producto","codproducto","select",$pro,1,array("required"=>"required","disabled"=>"disabled","class"=>"disabled"),$mp['codproducto']);?><br><div class="rojoC pequeno">Por seguridad no se permite la modificación</div></td>
					</tr>
					<tr>
						<td><?php campos("Cantidad","cantidad","number",$mp['cantidad'],0,array("class"=>"der","min"=>0,"readonly"=>"readonly"));?><br><div class="rojoC pequeno">Por seguridad no se permite la modificación</div></td>
						<td><?php campos("Precio Unitario en <strong>Bs</strong>","preciounitario","number",$mp['preciounitario'],0,array("step"=>"0.1","min"=>0,"class"=>"der","readonly"=>"readonly","required"=>"required"));?><br><div class="rojoC pequeno">Por seguridad no se permite la modificación</div></td>

						<td><?php campos("Total","total","text",$mp['total'],0,array("class"=>"der","readonly"=>"readonly"));?>Bs<br><div class="rojoC pequeno">Por seguridad no se permite la modificación</div></td>
					</tr>
                    <tr>
						<td colspan="2"><?php campos("Proveedor","codproveedor","select",$prov,0,"",$mp['codproveedor']);?></td>
						<td><?php campos("Modelo","modelo","text",$mp['modelo'],0,array("size"=>40));?></td>
					</tr>
                    <tr>
						<td colspan="3"><?php campos("Observación","observacion","textarea",$mp['observacion'],0,array("rows"=>5,"cols"=>80));?></td>
					</tr>
					<tr><td><?php campos("Guardar","guardar","submit");?></td><td></td></tr>
				</table>
                </form>
			</fieldset>
		</div>
    	<div class="clear"></div>
    </div>
</div>
<?php include_once '../../piepagina.php';?>