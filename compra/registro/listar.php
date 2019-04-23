<?php
include_once("../../login/check.php");
$titulo="Listado de Compras";
$folder="../../";
include_once("../../class/producto.php");
$producto=new producto;
$prod=todolista($producto->mostrarTodo("","nombre"),"codproducto","nombre,descripcion","-");

include_once("../../class/proveedor.php");
$proveedor=new proveedor;
$prov=todolista($proveedor->mostrarTodo("","nombre"),"codproveedor","nombre","-");

include_once("../../funciones/funciones.php");
include_once "../../cabecerahtml.php";
?>
<?php include_once "../../cabecera.php";?>
<div class="col-lg-12">
	<div class="row imagenfondo">
    	<div class="col-lg-8 col-lg-offset-2 alpha">
        	<fieldset>
        	<div class="titulo"><?php echo $titulo?> - Criterio de Busqueda</div>
            <form id="busqueda" action="busqueda.php" method="post" >
                <table class="tablabus">
                    <tr>
                        <td colspan="3"><?php campos("Producto","codproducto","select",$prod);?></td>
                    </tr>
                    <tr>
                    	<td width="400"><?php campos("Proveedor","codproveedor","select",$prov,"");?></td>
                        <td><?php campos("Fecha de Compra","fecha","date","");?></td>
                        <td><?php campos("Modelo","modelo","text","");?></td>
                        <td><?php campos("Buscar","enviar","submit","",0,array("size"=>15));?></td>
                    </tr>
                </table>
            </form>
            </fieldset>
        </div>
        <div class="clearfix"></div>
        <div id="respuesta" class="table-responsive"></div>
    </div>
</div>
<?php include_once "../../piepagina.php";?>
