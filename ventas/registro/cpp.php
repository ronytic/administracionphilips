<?php

include_once("../../login/check.php");
$CodProducto=$_POST['codproducto'];
// $CodProducto=1;
$consulta="SELECT cantidadstock,preciounitario FROM `compra` WHERE codproducto=$CodProducto and cantidadstock>0";
include_once("../../class/compra.php");
$compra=new compra;
$com=$compra->sql($consulta);
$pu=0;
$cant=0;
$sumpu=0;
foreach ($com as $c) {$cant+=$c['cantidadstock'];
    $pu=$c['preciounitario']*$c['cantidadstock'];
    $sumpu+=$pu;
}
$cpp=number_format($sumpu/$cant,2,".","");
echo $cpp;
?>