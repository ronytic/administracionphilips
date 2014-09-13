<?php
include_once '../../login/check.php';
$folder="../../";
$titulo="Registro de Compra";
include_once("../../class/producto.php");
$producto=new producto;
$pro=todolista($producto->mostrarTodo("","nombre"),"codproducto","nombre,descripcion,codbarra","-");

include_once("../../class/proveedor.php");
$proveedor=new proveedor;
$prov=todolista($proveedor->mostrarTodo("","nombre"),"codproveedor","nombre,origen","-");

include_once '../../funciones/funciones.php';
include_once '../../cabecerahtml.php';
?>
<script language="javascript">
$(document).on("ready",function(){
	$("#cantidad,#preciounitario").change(function(e){
		var cantidad=$("#cantidad").val();
		var preciounitario=$("#preciounitario").val();
		var total=(cantidad*preciounitario).toFixed(2);
		$("#total").val(total);
	});	
});
</script>
<?php include_once '../../cabecera.php';?>
<div class="grid_12">
	<div class="contenido imagenfondo">
    	<div class="prefix_2 grid_4 alpha">
			<fieldset>
				<div class="titulo"><?php echo $titulo?></div>
                <form action="guardar.php" method="post" enctype="multipart/form-data">
				<table class="tablareg">
                	<tr>
						<td><?php campos("Fecha de Compra","fechacompra","date",date("Y-m-d"),0,array("required"=>"required"));?></td>
					</tr>
					<tr>
						<td colspan="3"><?php campos("Producto","codproducto","select",$pro,1,array("required"=>"required"));?></td>
					</tr>
					<tr>
						<td><?php campos("Cantidad","cantidad","number","0",0,array("class"=>"der enlinea","min"=>0,"required"=>"required"));?></td>
					
						<td><?php campos("Precio Unitario en <strong>Bs</strong>","preciounitario","number","0.00",0,array("step"=>"0.1","min"=>0,"class"=>"der enlinea"));?></td>
					
						<td><?php campos("Total","total","text","0.00",0,array("class"=>"der","readonly"=>"readonly"));?>Bs</td>
					</tr>
                    <tr>
						<td colspan="2"><?php campos("Proveedor","codproveedor","select",$prov);?></td>
						<td><?php campos("Modelo","modelo","text","",0,array("size"=>30));?></td>
					</tr>
                    <tr>
						<td colspan="3"><?php campos("Observación","observacion","textarea","",0,array("rows"=>5,"cols"=>80));?></td>
					</tr>
					<tr><td colspan="3"><div class="rojoC pequeno">La cantidad introducida se contará para el inventario, Revíselo antes de Registrarlo, Posteriormente no se podrá modificar la CANTIDAD ni el PRECIO</div><?php campos("Guardar","guardar","submit");?></td><td></td></tr>
				</table>
                </form>
			</fieldset>
		</div>
    	<div class="clear"></div>
    </div>
</div>
<?php include_once '../../piepagina.php';?>