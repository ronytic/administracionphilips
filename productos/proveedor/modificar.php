<?php
include_once '../../login/check.php';
$folder="../../";
$titulo="Modificar Datos de Proveedor";
$id=$_GET['id'];
include_once '../../class/proveedor.php';
$proveedor=new proveedor;
$prov=$proveedor->mostrar($id);
$prov=array_shift($prov);
/*include_once("../../class/proveedor.php");
$proveedor=new proveedor;
$prov=todolista($proveedor->mostrarTodo(),"codproveedor","nombre","");*/

include_once '../../funciones/funciones.php';
include_once '../../cabecerahtml.php';
?>
<?php include_once '../../cabecera.php';?>
<div class="col-lg-12">

	<div class="row imagenfondo">
    	<div class="col-lg-offset-4 col-lg-4 alpha">
			<fieldset>
				<div class="titulo"><?php echo $titulo?></div>
                <form action="actualizar.php" method="post" enctype="multipart/form-data">
                <?php campos("","id","hidden",$id);?>
				<table class="tablareg">
					<tr>
						<td><?php campos("Nombre","nombre","text",$prov['nombre'],1,array("required"=>"required"));?></td>
					</tr>
					<tr>
						<td><?php campos("Dirección","direccion","text",$prov['direccion']);?></td>
					</tr>
                    <tr>
						<td><?php campos("Teléfono","telefono","text",$prov['telefono']);?></td>
					</tr>
                    <tr>
						<td><?php campos("Nro de Cuenta","ncuenta","text",$prov['ncuenta']);?></td>
					</tr>
                    <tr>
						<td><?php campos("Observación","observacion","textarea",$prov['observacion']);?></td>
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