<?php
include_once '../../login/check.php';
$folder="../../";
$titulo="Modificar Sindicato";
$id=$_GET['id'];
include_once '../../class/sindicato.php';
$sindicato=new sindicato;
$sin=array_shift($sindicato->mostrar($id));
/*include_once("../../class/proveedor.php");
$proveedor=new proveedor;
$prov=todolista($proveedor->mostrarTodo(),"codproveedor","nombre","");*/

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
						<td><?php campos("Nombre","nombre","text",$sin['nombre'],1,array("required"=>"required"));?></td>
					</tr>
					<tr>
						<td><?php campos("Personería Jurídica","personeriajuridica","text",$sin['personeriajuridica']);?></td>
					</tr>
                    <tr>
						<td><?php campos("Nombre del Responsable","nombreresponsable","text",$sin['nombreresponsable']);?></td>
					</tr>
                    <tr>
						<td><?php campos("Teléfono","telefono","text",$sin['telefono']);?></td>
					</tr>
                    <tr>
						<td><?php campos("Dirección","direccion","text",$sin['direccion']);?></td>
					</tr>
                    <tr>
						<td><?php campos("Observación","observacion","textarea",$sin['observacion']);?></td>
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