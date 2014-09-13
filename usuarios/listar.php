<?php
include_once("../login/check.php");
$titulo="Listado de Usuarios";
$folder="../";
include_once("../funciones/funciones.php");
include_once "../cabecerahtml.php";
?>
<?php include_once "../cabecera.php";?>
    	<div class="grid_8 prefix_1 alpha">
        	<fieldset>
        	<div class="titulo"><?php echo $titulo;?> - Criterio de Búsqueda</div>
            <form id="busqueda" action="busqueda.php" method="post" >
                <table class="tablabus">
                    <tr>
                        <td><?php campos("Nombre","nombre","text","",1,array("size"=>25));?></td>
						<td><?php campos("Apellido Paterno","paterno","text","",0,array("size"=>25));?></td>
                        <td><?php campos("Apellido Materno","materno","text","",0,array("size"=>25));?></td>
                        <td><?php campos("Buscar","enviar","submit","",0,array("size"=>15));?></td>
                    </tr>
                </table>
            </form>
            </fieldset>
             <div id="respuesta"></div>
        </div>
       
<?php include_once "../piepagina.php";?>