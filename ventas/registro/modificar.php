<?php
include_once '../../login/check.php';
$folder="../../";
$titulo="Modificar Venta de Producto";
$id=$_GET['id'];
include_once '../../class/venta.php';
$venta=new venta;
$ven=array_shift($venta->mostrar($id));

include_once '../../class/ventadetalle.php';
$ventadetalle=new ventadetalle;

include_once("../../class/producto.php");
$producto=new producto;

include_once '../../funciones/funciones.php';
include_once '../../cabecerahtml.php';
?>
<?php include_once '../../cabecera.php';?>
<div class="grid_12">
	<div class="contenido imagenfondo">
    	<form action="actualizar.php" method="post" enctype="multipart/form-data" id="formulario">
        <?php campos("","id","hidden",$id)?>
    	<div class="prefix_3 grid_4 alpha">
			<fieldset>
				<div class="titulo"><?php echo $titulo?></div>
                
				<table class="tablareg">
                	<tr>
						<td><?php campos("Fecha de Venta","fechaventa","date",$ven['fechaventa'],0,array("required"=>"required"));?></td>						<td><?php campos("Vendedor","vendedor","text",$us['nombre']." ".$us['paterno']." ".$us['materno'],0,array("required"=>"required","readonly"=>"readonly","size"=>40));?></td>
					</tr>
                    <tr>
						<td><?php campos("Cliente","cliente","text",$ven['cliente'],0,array("required"=>"required","size"=>40));?></td>										
                        <td><?php campos("C.I. o NIT","ci","text",$ven['ci'],0,array("size"=>30));?></td>
					</tr>
                </table>
                
                
			</fieldset>
		</div>
        <div class="prefix_0 grid_10 alpha">
        	<fieldset>
            	<!--<div class="titulo"><?php echo $titulo?></div>-->
                <table class="tablareg">
					<tr class="titulo"><td>N</td><td style="width:600px !important">Producto</td><td>Cantidad</td><td>Precio Unitario</td><td>SubTotal</td><td>Observación</td></tr>
                    <?php $i=0; foreach($ventadetalle->mostrarTodo("codventa=".$id) as $vd){$i++;
						$prod=array_shift($producto->mostrar($vd['codproducto']));
						?>
                    <tr>
                    	<td class="der"><?php echo $i?></td>
                        <td><input type="text" value="<?php echo $prod['nombre']?>" readonly size="40"></td>
                        <td><input type="number" name="pro[<?php echo $l?>][cantidad]" value="<?php echo $vd['cantidad']?>" min="0" max="0" size="5" maxlength="5" style="width:50px" class="cantidad der" readonly></td>
                        <td><input type="number" name="pro[<?php echo $l?>][preciounitario]" value="<?php echo $vd['preciounitario']?>" min="0" size="5" maxlength="5" style="width:70px" class="preciounitario der" readonly></td>
                        <td><input type="text" name="pro[<?php echo $l?>][subtotal]" value="<?php echo $vd['subtotal']?>" size="10" min="0" maxlength="10" style="width:100px" class="subtotal der" readonly ></td>
                        <td><input type="text" name="pro[<?php echo $l?>][observacion]" value="<?php echo $vd['observacion']?>" size="10" maxlength="10" style="width:120px" class="der" readonly></td>
                    </tr>
                    <?php }?>
                    
                    <tr class="contenido"><td colspan="3">
                    Observación:<br>
                    <textarea name="observacion" cols="50" rows="4"><?php echo $ven['observacion']?></textarea>
                    </td><td class="der">Total<br><br>Cancelado<br><br>Monto a Devolver</td><td>
                    <input type="text" name="supertotal" class="der supertotal" value="<?php echo $ven['total']?>" readonly size="10" style="width:100px">
                    <input type="text" name="pagado" class="der pagado" value="<?php echo $ven['pagado']?>"  size="10" style="width:100px" readonly>
                    <input type="text" name="devolucion" class="der devolucion" value="<?php echo $ven['devolucion']?>" readonly size="10" style="width:100px"></td><td></td></tr>
                    
				</table>
                <div class="rojoC">Por seguridad no se permite la modificación de los productos vendidos</div>
                <input type="submit" value="Modificar Datos de Venta">
            </fieldset>
        </div>
        </form>
    	<div class="clear"></div>
    </div>
</div>
<?php include_once '../../piepagina.php';?>