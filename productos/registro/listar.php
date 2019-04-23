<?php
include_once("../../login/check.php");
$titulo="Listado de Productos";
$folder="../../";

include_once("../../class/tipo.php");
$tipo=new tipo;
$tip=todolista($tipo->mostrarTodo(),"codtipo","nombre","");

$dest=array("Procesado"=>"Procesado","Directo"=>"Directo");
include_once("../../funciones/funciones.php");
include_once "../../cabecerahtml.php";
?>
<?php include_once "../../cabecera.php";?>
<div class="col-lg-12">
	<div class="row imagenfondo">
    	<div class="col-lg-offset-2 col-lg-8 alpha">
        	<fieldset>
        	<div class="titulo"><?php echo $titulo?> - Criterio de Búsqueda</div>
            <form id="busqueda" action="busqueda.php" method="post" >
                <table class="tablabus">
                    <tr>
                        <td><?php campos("Nombre","nombre","text","",1,array("size"=>15));?></td>
                        <td width="250"><?php campos("Tipo de Producto","codtipo","select",$tip);?></td>
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
