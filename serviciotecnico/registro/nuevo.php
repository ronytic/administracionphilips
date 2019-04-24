<?php
include_once '../../login/check.php';
$folder="../../";
$titulo="Registro de Nuevo Servicio Técnico";

$garantia=array(1=>"Si",0=>"No");
include_once("../../class/producto.php");
$producto=new producto;
$prod=todolista($producto->mostrarTodo(),"codproducto","nombre,descripcion"," - ");

include_once '../../funciones/funciones.php';
include_once '../../cabecerahtml.php';
?>
<script language="javascript">
$(document).ready(function(e) {
    $("#acuenta,#saldo,#total").change(function(e) {
        var acuenta=$("#acuenta").val();
		var saldo=$("#saldo").val();
		var total=$("#total").val();
		$("#saldo").val(total-acuenta);
    });
});
</script>
<?php include_once '../../cabecera.php';?>
<div class="col-lg-12">
	<div class="row imagenfondo">
    	<div class="col-lg-offset-3 col-lg-5 alpha">
			<fieldset>
				<div class="titulo"><?php echo $titulo?></div>
                <form action="guardar.php" method="post" enctype="multipart/form-data">
				<table class="tablareg">
                	<tr>
						<td><?php campos("Solucionado","estado","select",$garantia);?></td>
					</tr>
                    <tr>
						<td><?php campos("Garantía","estadogarantia","select",$garantia);?></td>
					</tr>
                    <tr>
						<td><?php campos("Producto","codproducto","select",$prod);?></td>
					</tr>
                    <tr>
						<td><?php campos("Nº Serie","nserie","text","",1,array("required"=>"required","size"=>50));?></td>
					</tr>
                    <tr>
						<td><?php campos("Indicación Cliente","indicacioncliente","textarea","",0,array("cols"=>40,"rows"=>5));?></td>
					</tr>
                    <tr>
						<td><?php campos("Accesorios","accesorios","textarea","",0,array("cols"=>40,"rows"=>5));?></td>
					</tr>
                    <tr>
						<td><?php campos("Centro","centro","text","",0,array("size"=>"40"));?></td>
					</tr>
                    <tr>
						<td><?php campos("Nombre","nombre","text","",0,array("size"=>"40"));?></td>
					</tr>
                    <tr>
						<td><?php campos("C.I.","ci","text","",0,array("size"=>"40"));?></td>
					</tr>
                    <tr>
						<td><?php campos("Teléfono","telefono","text","",0,array("size"=>"40"));?></td>
					</tr>
                    <tr>
						<td><?php campos("Total","total","number","0",0,array("size"=>"40","min"=>0));?></td>
					</tr>
                    <tr>
						<td><?php campos("A Cuenta","acuenta","number","0",0,array("size"=>"40","min"=>0));?></td>
					</tr>
                    <tr>
						<td><?php campos("Saldo","saldo","number","",0,array("size"=>"40","readonly"=>"readonly"));?></td>
					</tr>
                    <tr>
						<td><?php campos("Fecha Entrega","fechaentrega","date","",0,array("size"=>"40"));?></td>
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