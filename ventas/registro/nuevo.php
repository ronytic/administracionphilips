<?php
include_once '../../login/check.php';
$folder="../../";
$titulo="Registro de Venta";
include_once("../../class/compra.php");
$compra=new compra;
include_once("../../class/productos.php");
$productos=new productos;
$pro=todolista($productos->mostrarTodo("","nombre"),"codproductos","nombre","");

include_once("../../class/distribuidor.php");
$distribuidor=new distribuidor;
$dist=todolista($distribuidor->mostrarTodo("","nombre"),"coddistribuidor","nombre,departamento","-");

include_once("../../class/cliente.php");
$cliente=new cliente;
$cli=todolista($cliente->mostrarTodo("","nombre"),"codcliente","nombre","-");

include_once '../../funciones/funciones.php';
include_once '../../cabecerahtml.php';
?>
<script language="javascript">
$(document).on("ready",function(){
	$("#cantidad,#preciounitario").change(function(e){
		var cantidad=$("#cantidad").val();
		var preciounitario=$("#preciounitario").val();
		var total=(cantidad*preciounitario).toFixed(2);
		$("#total").val(total);
	});	
});
</script>
<?php include_once '../../cabecera.php';?>
<div class="grid_12">
	<div class="contenido">
    	<div class="prefix_3 grid_4 alpha">
			<fieldset>
				<div class="titulo"><?php echo $titulo?></div>
                <form action="guardar.php" method="post" enctype="multipart/form-data">
				<table class="tablareg">
                	<tr>
						<td><?php campos("Fecha de Venta","fechaventa","date",date("Y-m-d"),0,array("required"=>"required"));?></td>
					</tr>
					<tr>
						<td><select name="codproductos" rel-linea="1" class="productos p">									
                	<option value="">Seleccionar</option>
                	<?php foreach($productos->mostrarTodo("","nombre") as $pr){$i++;
					$sum=array_shift($compra->sumar($pr['codproductos']));
					$sumatotal=$sum['cantidadtotalstock']!=""?$sum['cantidadtotalstock']:'0';?>
                    <option value="<?php echo $pr['codproductos']?>" rel="<?php echo $sumatotal;?>"><?php echo $pr['nombre']." - Cantidad Stock: ".$sumatotal;?></option>
                    <?php }?>
                </select></td>
					</tr>
					<tr>
						<td><?php campos("Cantidad","cantidad","number","0",0,array("class"=>"der","min"=>0));?></td>
					</tr>
                    <tr>
						<td><?php campos("Precio Unitario","preciounitario","number","0.00",0,array("step"=>"0.1","min"=>0,"class"=>"der"));?>Bs</td>
					</tr>
                    <tr>
						<td><?php campos("Total","total","text","0.00",0,array("class"=>"der","readonly"=>"readonly"));?>Bs</td>
					</tr>
                    <tr>
						<td><?php campos("Cliente","codcliente","select",$cli);?></td>
					</tr>
                    <tr>
						<td><?php campos("Distribuidor","coddistribuidor","select",$dist);?></td>
					</tr>
                    
                    <tr>
						<td><?php campos("Observación","observacion","textarea");?></td>
					</tr>
					<tr><td><div class="rojoC pequeno">La Cantidad Introducida se utilizará para descontar del inventario, Revíselo antes de Registrarlo, Posteriormente no se podra modificar la CANTIDAD y PRECIO de venta</div><?php campos("Guardar","guardar","submit");?></td><td></td></tr>
				</table>
                </form>
			</fieldset>
		</div>
    	<div class="clear"></div>
    </div>
</div>
<?php include_once '../../piepagina.php';?>