<?php
include_once '../../login/check.php';
$folder="../../";
$titulo="Modificar Servicio Técnico";
$id=$_GET['id'];
include_once '../../class/serviciotecnico.php';
$serviciotecnico=new serviciotecnico;
$sertec=array_shift($serviciotecnico->mostrar($id));

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
<div class="grid_12">
	<div class="contenido imagenfondo">
    	<div class="prefix_4 grid_4 alpha">
			<fieldset>
				<div class="titulo"><?php echo $titulo?></div>
                <form action="actualizar.php" method="post" enctype="multipart/form-data">
                <?php campos("","id","hidden",$id);?>
				<table class="tablareg">
                	<tr>
						<td><?php campos("Solucionado","estado","select",$garantia,0,"",$sertec['estado']);?></td>
					</tr>
                    <tr>
						<td><?php campos("Garantía","estadogarantia","select",$garantia,0,"",$sertec['estadogarantia']);?></td>
					</tr>
                    <tr>
						<td><?php campos("Producto","codproducto","select",$prod,0,"",$sertec['codproducto']);?></td>
					</tr>
                    <tr>
						<td><?php campos("Nº Serie","nserie","text",$sertec['nserie'],1,array("required"=>"required","size"=>50));?></td>
					</tr>
                    <tr>
						<td><?php campos("Indicación Cliente","indicacioncliente","textarea",$sertec['indicacioncliente'],0,array("cols"=>40,"rows"=>5));?></td>
					</tr>
                    <tr>
						<td><?php campos("Accesorios","accesorios","textarea",$sertec['accesorios'],0,array("cols"=>40,"rows"=>5));?></td>
					</tr>
                    <tr>
						<td><?php campos("Centro","centro","text",$sertec['centro'],0,array("size"=>"40"));?></td>
					</tr>
                    <tr>
						<td><?php campos("Nombre","nombre","text",$sertec['nombre'],0,array("size"=>"40"));?></td>
					</tr>
                    <tr>
						<td><?php campos("C.I.","ci","text",$sertec['ci'],0,array("size"=>"40"));?></td>
					</tr>
                    <tr>
						<td><?php campos("Teléfono","telefono","text",$sertec['telefono'],0,array("size"=>"40"));?></td>
					</tr>
                    <tr>
						<td><?php campos("Total","total","number",$sertec['total'],0,array("size"=>"40","min"=>0));?></td>
					</tr>
                    <tr>
						<td><?php campos("A Cuenta","acuenta","number",$sertec['acuenta'],0,array("size"=>"40","min"=>0));?></td>
					</tr>
                    <tr>
						<td><?php campos("Saldo","saldo","number",$sertec['saldo'],0,array("size"=>"40","readonly"=>"readonly"));?></td>
					</tr>
                    <tr>
						<td><?php campos("Fecha Entrega","fechaentrega","date",$sertec['fechaentrega'],0,array("size"=>"40"));?></td>
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