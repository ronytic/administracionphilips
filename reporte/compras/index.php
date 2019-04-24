<?php
include_once("../../login/check.php");
$titulo="Reporte de Compra de Productos";
$folder="../../";
include_once("../../funciones/funciones.php");

include_once("../../class/producto.php");
$producto=new producto;
$prod=todolista($producto->mostrarTodos("","nombre"),"codproducto","nombre","");

include_once "../../cabecerahtml.php";
?>
<?php include_once "../../cabecera.php";?>
<div class="col-lg-12">
	<div class="row imagenfondo">
    	<div class="col-lg-8 col-lg-offset-2 alpha">
        	<fieldset>
        	<div class="titulo"><?php echo $titulo;?></div>
            <form id="busqueda" action="busqueda.php" method="post">
                <table class="tablabus">
                    <tr>
                        <td colspan="4" width="500"><?php campos("Producto","codproducto","select",$prod,0)?></td>
                    </tr>
                    <tr>
                        <td><?php campos("Fecha de Inicio","fechainicio","date","")?></td>
                        <td><?php campos("Fecha Fin","fechafin","date","")?></td>
                        <td><?php campos("Producto Existente","existente","select",array("0"=>"No","1"=>"Si"),0,"",1)?></td>
                    </tr>
                    <tr>
                        <td><?php campos("Ver Reporte","enviar","submit","",0,array("size"=>15));?></td>
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