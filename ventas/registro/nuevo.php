<?php
include_once '../../login/check.php';
$folder="../../";
$titulo="Registro de Venta";


include_once '../../funciones/funciones.php';
include_once '../../cabecerahtml.php';
?>
<script language="javascript">
$(document).on("ready",function(){
	var linea=0;
	
	$(document).on("click",".aumentar",function(e){
		e.preventDefault();
		var posi=$(this).parent().parent();
		$.post("aumentar.php",{'l':linea},function(data){
			posi.before(data);
			$("select").select2({'placeholder':'Búsqueda no encontrada','loadMorePadding':0});
			
			linea++;
		});
	})
	
	$(".aumentar").click();
	$(document).on("change",".producto",function(){
		var l=$(this).attr("rel-linea");
		var stock=$(".producto[rel-linea="+l+"]>option:selected").attr("rel-cantidad");
		$("input[rel-stock="+l+"]").val(stock);
		$("input[rel-cantidad="+l+"]").attr("max",stock);
		
		
	});
	$(document).on("change",".cantidad,.preciounitario",function(e){
		
		var l=$(this).attr("rel-linea");
		var cantidad=$("input[rel-cantidad="+l+"]").val();
		var preciounitario=$("input[rel-preciounitario="+l+"]").val();
		var total=(cantidad*preciounitario).toFixed(2);
		$("input[rel-subtotal="+l+"]").val(total);

		
		var stotal=0;
		for(i=1;i<=linea;i++){
		stotal+=parseFloat($("input[rel-subtotal="+i+"]").val());
		}
		$(".supertotal").val(stotal.toFixed(2))
		
	});
	$(document).on("change","#ci",function(){
		var ci=$(this).val();
		$.post("sacarnombre.php",{"nit":ci},function(data){$("#cliente").val(data)});
	});
	
	$(document).on("change",".pagado",function(){
		var supertotal=parseFloat($(".supertotal").val());
		var pagado=parseFloat($(".pagado").val());	
		$(".pagado").val((pagado).toFixed(2));
		$(".devolucion").val((pagado-supertotal).toFixed(2));
		
	});
	$("#formulario").submit(function(e) {
		if(confirm("¿Seguro que los Datos registrados estan Correctos, NO SE PODRAN MODIFICAR POSTERIORMENTE?")){
			//$(this).submit();	
		}else{
        	e.preventDefault();
			return false;
		}
    });
});
</script>
<?php include_once '../../cabecera.php';?>
<div class="grid_12">
	<div class="contenido imagenfondo">
    	<form action="guardar.php" method="post" enctype="multipart/form-data" id="formulario">
    	<div class="prefix_2 grid_4 alpha">
			<fieldset>
				<div class="titulo"><?php echo $titulo?></div>
                
				<table class="tablareg">
                	<tr>
						<td><?php campos("Fecha de Venta","fechaventa","date",date("Y-m-d"),0,array("required"=>"required"));?></td>						<td><?php campos("Vendedor","vendedor","text",$us['nombre']." ".$us['paterno']." ".$us['materno'],0,array("required"=>"required","readonly"=>"readonly","size"=>40));?></td>
					</tr>
                    <tr>
						<td><?php campos("C.I. o NIT","ci","text","",0,array("size"=>30));?></td>
                        <td><?php campos("Cliente","cliente","text","",0,array("required"=>"required","size"=>40));?></td>										
                        
					</tr>
                </table>
                
                
			</fieldset>
		</div>
        <div class="prefix_0 grid_10 alpha">
        	<fieldset>
            	<!--<div class="titulo"><?php echo $titulo?></div>-->
                <table class="tablareg">
					<tr class="titulo"><td>N</td><td style="width:600px !important">Producto</td><td>Stock</td><td>Cantidad</td><td>Precio Unitario</td><td>SubTotal</td><td>Observación</td></tr>
                    
                    <tr class="contenido"><td colspan="4"><a href="#" class="aumentar"><img src="../../imagenes/ico/nuevo1.png" height="15"> Aumentar</a><br>
                    Observación:<br>
                    <textarea name="observacion" cols="50" rows="4"></textarea>
                    </td><td class="der">Total<br><br>Cancelado<br><br>Monto a Devolver</td><td>
                    <input type="text" name="supertotal" class="der supertotal" value="0" readonly size="10" style="width:100px">
                    <input type="text" name="pagado" class="der pagado" value="0"  size="10" style="width:100px">
                    <input type="text" name="devolucion" class="der devolucion" value="0" readonly size="10" style="width:100px"></td><td></td></tr>
                    
				</table>
                <div class="rojoC">Revise los Datos, no se Podrán modificar posteriormente</div>
                <input type="submit" value="Confirmar Compra">
            </fieldset>
        </div>
        </form>
    	<div class="clear"></div>
    </div>
</div>
<?php include_once '../../piepagina.php';?>