<?php
include_once '../../login/check.php';
$folder="../../";
$titulo="Modificar Producto";
$id=$_GET['id'];
include_once '../../class/producto.php';
$producto=new producto;
$prod=$producto->mostrar($id);
$prod=array_shift($prod);

include_once("../../class/tipo.php");
$tipo=new tipo;
$tip=todolista($tipo->mostrarTodo(),"codtipo","nombre","");
/*include_once("../../class/proveedor.php");
$proveedor=new proveedor;
$prov=todolista($proveedor->mostrarTodo(),"codproveedor","nombre","");*/

include_once '../../funciones/funciones.php';
include_once '../../cabecerahtml.php';
?>
<?php include_once '../../cabecera.php';?>
<div class="col-lg-12">
	<div class="row imagenfondo">
    	<div class="col-lg-offset-4 col-lg-5 alpha">
			<fieldset>
				<div class="titulo"><?php echo $titulo?></div>
                <form action="actualizar.php" method="post" enctype="multipart/form-data">
                <?php campos("","id","hidden",$id);?>
				<table class="tablareg">
					<tr>
						<td><?php campos("Nombre","nombre","text",$prod['nombre'],1,array("required"=>"required"));?></td>
					</tr>
					<tr>
						<td><?php campos("Descripción","descripcion","text",$prod['descripcion']);?></td>
					</tr>
                    <tr>
						<td><?php campos("Tipo de Producto","codtipo","select",$tip,0,"",$prod['codtipo']);?></td>
					</tr>
                    <tr>
						<td><?php campos("Observación","observacion","textarea",$prod['observacion']);?></td>
					</tr>
                    <tr>
						<td><?php campos("Código de Barra","codbarra","text",$prod['codbarra'],0,array("size"=>"40"));?></td>
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