<?php
include_once("../../login/check.php");
$titulo="Listado de Pedidos";
$folder="../../";

include_once("../../class/producto.php");
$producto=new producto;
$prod=todolista($producto->mostrarTodo(),"codproducto","nombre,descripcion","-");

$sino=array(1=>"Si",0=>"No");
include_once("../../funciones/funciones.php");
include_once "../../cabecerahtml.php";
?>
<?php include_once "../../cabecera.php";?>
<div class="grid_12">
	<div class="contenido imagenfondo">
    	<div class="grid_8 prefix_2 alpha">
        	<fieldset>
        	<div class="titulo"><?php echo $titulo?> - Criterio de Búsqueda</div>
            <form id="busqueda" action="busqueda.php" method="post" >
                <table class="tablabus">
                    <tr>
                        <td><?php campos("Nombre Cliente","nombre","text","",1,array("size"=>15));?></td>
                        <td><?php campos("C.I.","ci","text","",0,array("size"=>"40"));?></td>
                       
                        
                    </tr>
                    <tr><td width="250" colspan="3"><?php campos("Producto","codproducto","select",$prod);?></td></tr>
                    <tr>
                        <td><?php campos("Entregado","entregado","select",$sino);?></td>
						<td><?php campos("Fecha Entrega","fechaentrega","date","",0,array("size"=>"40"));?></td>
                        <td><?php campos("Buscar","enviar","submit","",0,array("size"=>15));?></td>
                    </tr>
                </table>
            </form>
            </fieldset>
        </div>
        <div class="clear"></div>
        <div id="respuesta"></div>
    </div>
</div>
<?php include_once "../../piepagina.php";?>
