<?php
include_once("../../login/check.php");
$l=$_POST['l'];
$l++;
include_once("../../class/producto.php");
$producto=new producto;
include_once("../../class/compra.php");
$compra=new compra;
?>
<tr>
<td class="der"><?php echo $l;?></td>
<td><select name="pro[<?php echo $l?>][codproducto]" rel-linea="<?php echo $l?>" class="producto p" style="width:250px">
<option value="">Seleccionar</option>
<?php foreach($producto->mostrarTodo("","nombre") as $pr){$i++;
$sum=array_shift($compra->sumar($pr['codproducto']));
$sumatotal=$sum['cantidadtotalstock']!=""?$sum['cantidadtotalstock']:'0';?>
<option value="<?php echo $pr['codproducto']?>" rel="<?php echo $sumatotal;?>" rel-cantidad="<?php echo $sumatotal;?>"><?php echo $pr['nombre']." - ".$pr['codbarra']?></option>
<?php }?>
</select></td>
<td><input type="text" name="pro[<?php echo $l?>][stock]" value="0" size="5" maxlength="5" style="width:50px" class="der" readonly rel-linea="<?php echo $l?>" rel-stock="<?php echo $l?>"></td>
<td><input type="number" name="pro[<?php echo $l?>][cantidad]" value="0" min="0" max="0" size="5" maxlength="5" style="width:50px" class="cantidad der" rel-linea="<?php echo $l?>" rel-cantidad="<?php echo $l?>"></td>
<td><input type="number" name="pro[<?php echo $l?>][preciounitario]" value="0" min="0" step="0.01" size="5" maxlength="5" style="width:70px" class="preciounitario der" rel-linea="<?php echo $l?>" rel-preciounitario="<?php echo $l?>"></td>
<td><input type="text" name="pro[<?php echo $l?>][subtotal]" value="0" size="10" min="0" maxlength="10" style="width:100px" class="subtotal der" readonly rel-linea="<?php echo $l?>" rel-subtotal="<?php echo $l?>"></td>
<td><input type="text" name="pro[<?php echo $l?>][observacion]" value="" size="10" maxlength="10" style="width:120px" class="der" ></td>

</tr>
<?php
?>