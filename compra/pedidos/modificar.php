<?php
include_once '../../login/check.php';
$folder="../../";
$titulo="Modificar Pedido";
$id=$_GET['id'];
include_once '../../class/pedido.php';
$pedido=new pedido;
$sertec=array_shift($pedido->mostrar($id));

$sino=array(1=>"Si",0=>"No");
include_once("../../class/producto.php");
$producto=new producto;
$prod=todolista($producto->mostrarTodo(),"codproducto","nombre,descripcion"," - ");

include_once '../../funciones/funciones.php';
include_once '../../cabecerahtml.php';
?>
<script language="javascript">
$(document).ready(function(e) {
    $("#cantidad,#preciocotizacion,#total").change(function(e) {
        var cantidad=$("#cantidad").val();
		var preciocotizacion=$("#preciocotizacion").val();
		$("#total").val(cantidad*preciocotizacion);
    });
});
</script>
<?php include_once '../../cabecera.php';?>
<div class="grid_12">
	<div class="contenido imagenfondo">
    	<div class="prefix_4 grid_4 alpha">
			<fieldset>
				<div class="titulo"><?php echo $titulo?></div>
                <form action="actualizar.php" method="post" enctype="multipart/form-data">
                <?php campos("","id","hidden",$id);?>
				<table class="tablareg">
                    <tr>
						<td><?php campos("Producto","codproducto","select",$prod,0,"",$sertec['codproducto']);?></td>
					</tr>
                    <tr>
						<td><?php campos("Cantidad","cantidad","number",$sertec['cantidad'],0,array("size"=>"40","min"=>0));?></td>
					</tr>
                    <tr>
						<td><?php campos("Precio Cotización","preciocotizacion","number",$sertec['preciocotizacion'],0,array("size"=>"40"));?></td>
					</tr>
                    <tr>
						<td><?php campos("Total","total","number",$sertec['total'],0,array("size"=>"40","min"=>0,"readonly"=>"readonly"));?></td>
					</tr>
                   
                    <tr>
						<td><?php campos("Fecha Entrega","fechaentrega","date",$sertec['fechaentrega'],0,array("size"=>"40"));?></td>
					</tr>
                    <tr>
						<td><?php campos("Nombre Cliente","nombre","text",$sertec['nombre'],0,array("size"=>"40"));?></td>
					</tr>
                    <tr>
						<td><?php campos("C.I.","ci","text",$sertec['ci'],0,array("size"=>"40"));?></td>
					</tr>
                    <tr>
						<td><?php campos("Teléfono","telefono","text",$sertec['telefono'],0,array("size"=>"40"));?></td>
					</tr>
                    <tr>
						<td><?php campos("Entregado","entregado","select",$sino,0,array("size"=>"40"),$sertec['entregado']);?></td>
					</tr>
					<tr><td><?php campos("Guardar","guardar","submit");?></td></tr>
				</table>
                </form>
			</fieldset>
		</div>
    	<div class="clear"></div>
    </div>
</div>
<?php include_once '../../piepagina.php';?>