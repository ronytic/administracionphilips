<?php
include_once("../../login/check.php");
$titulo="Listado de Ventas";
$folder="../../";
include_once("../../class/producto.php");
$producto=new producto;
$prod=todolista($producto->mostrarTodo("","nombre"),"codproducto","nombre","");

/*include_once("../../class/distribuidor.php");
$distribuidor=new distribuidor;
$dis=todolista($distribuidor->mostrarTodo("","nombre"),"coddistribuidor","nombre,departamento","-");*/

/*include_once("../../class/cliente.php");
$cliente=new cliente;
$cli=todolista($cliente->mostrarTodo("","nombre"),"codcliente","nombre","-");*/

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
                        <!--<td><?php campos("Producto","codproducto","select",$prod);?></td>-->
                        <td><?php campos("Cliente","cliente","text","","");?></td>
                        <td><?php campos("C.I. o Nit","ci","text","","");?></td>
                        <!--<td><?php campos("Observación","observacion","text","","");?></td>
                        <td><?php campos("Distribuidor","coddistribuidor","select",$dis,"");?></td>-->

                   	</tr>
                   	<tr>
                    	<td><?php campos("Fecha de Venta","fechaventa","date","");?></td>
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
