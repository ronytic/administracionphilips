<?php
include_once '../../login/check.php';
$folder="../../";
$titulo="Registro de Compra";
include_once("../../class/producto.php");
$producto=new producto;
$pro=todolista($producto->mostrarTodo("","nombre"),"codproducto","nombre","");

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
    	<div class="prefix_3 grid_4 alpha">
			<fieldset>
				<div class="titulo"><?php echo $titulo?></div>
                <form action="guardar.php" method="post" enctype="multipart/form-data">
				<table class="tablareg">
                	<tr>
						<td><?php campos("Fecha de Compra","fechacompra","date",date("Y-m-d"),1,array("required"=>"required"));?></td>
					</tr>
					<tr>
						<td><?php campos("Producto","codproductos","select",$pro,1,array("required"=>"required"));?></td>
					</tr>
					<tr>
						<td><?php campos("Cantidad","cantidad","number","0",0,array("class"=>"der","min"=>0));?></td>
					</tr>
                    <tr>
						<td><?php campos("Precio Unitario","preciounitario","number","0.00",0,array("step"=>"0.1","min"=>0,"class"=>"der"));?>Bs</td>
					</tr>
                    <tr>
						<td><?php campos("Total","total","text","0.00",0,array("class"=>"der","readonly"=>"readonly"));?>Bs</td>
					</tr>
                    <tr>
						<td><?php campos("Proveedor","codproveedor","select",$prov);?></td>
					</tr>
                    <tr>
						<td><?php campos("Fecha de Vencimiento","fechavencimiento","date",date("Y-m-d",strtotime(date("Y-m-d")." +30 day")),0,array("required"=>"required"));?></td>
					</tr>
                    <tr>
						<td><?php campos("Observación","observacion","textarea");?></td>
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