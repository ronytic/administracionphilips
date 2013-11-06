<?php
include_once '../login/check.php';
$folder="../";
$titulo="Modificar Contraseña";
$narchivo="usuarios";
include_once("../class/".$narchivo.".php");
${$narchivo}=new $narchivo;
$cod=$_SESSION['idusuario'];
$us1=array_shift(${$narchivo}->mostrar($cod));
include_once '../funciones/funciones.php';
include_once '../cabecerahtml.php';
?>
<?php include_once '../cabecera.php';?>
    	<div class="prefix_3 grid_4 suffix_3">
			<fieldset>
				<div class="titulo"><?php echo $titulo;?></div>
                <form action="cambiarco.php" method="post">
                <?php campos("","cod","hidden",$cod)?>
				<table class="tablareg">
                	<tr>
						<td><?php campos("Usuario","usuario","text",$us1['usuario'],0,array("required"=>"required","size"=>30,"readonly"=>"readonly"));?></td>
                    </tr>
                    <tr>
						<td><?php campos("Contraseña nueva","password","password","",1,array("required"=>"required","size"=>30));?></td>
                        <td><?php campos("Repite Contraseña nueva","password2","password","",0,array("required"=>"required","size"=>30));?></td>
					</tr>
                    <tr>
						<td><?php campos("Contraseña Actual","passwordant","password","",0,array("required"=>"required","size"=>30));?></td>
                       
					</tr>
					<tr><td><?php campos("Guardar Usuario","guardar","submit");?></td><td></td></tr>
				</table>
                </form>
			</fieldset>
		</div>

<?php include_once '../piepagina.php';?>