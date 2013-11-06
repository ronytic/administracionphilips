<?php
include_once '../login/check.php';
$folder="../";
$titulo="Nuevo Usuario";
include_once '../funciones/funciones.php';
include_once $folder.'cabecerahtml.php';
?>
<?php include_once $folder.'cabecera.php';?>
<div class="prefix_3 grid_4 suffix_3 ">
	<div class="">
    <fieldset class="contenido">
        <div class="titulo"><?php echo $titulo;?></div>
        <form action="guardar.php" method="post">
        <table class="tablareg">
            <tr>
                <td><?php campos("Usuario","usuario","text","",1,array("required"=>"required","size"=>30));?></td>
                <td><?php campos("Contraseña","password","text","",0,array("required"=>"required","size"=>30));?></td>
            </tr>
            <tr>
                <td><?php campos("Nombres","nombres","text","",0,array("required"=>"required","size"=>30));?></td>
                <td><?php campos("Paterno","paterno","text","",0,array("required"=>"required","size"=>30));?></td>
            </tr>
            <tr>
            	<td><?php campos("Materno","materno","text","",0,array("required"=>"required","size"=>30));?></td>
                <td><?php campos("Ci","ci","text","",0,array("size"=>30));?></td>
            </tr>
            <tr>
                <td><?php campos("Email","email","text","",0,array("size"=>30));?></td>
                <td><?php campos("Nivel","nivel","select",array("2"=>"Dirección","3"=>"Unidad de Tráfico","4"=>"Técnico","5"=>"Secretaria"));?></td>
            </tr>
            <tr>
                <td colspan="2"><?php campos("Observación","observacion","textarea","","",array("rows"=>5,"cols"=>50,"size"=>30));?></td>
            </tr>
            <tr><td><?php campos("Guardar Usuario","guardar","submit");?></td><td></td></tr>
        </table>
        </form>
    </fieldset>
    </div>
</div>

<?php include_once $folder.'piepagina.php';?>