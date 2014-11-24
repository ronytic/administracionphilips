<?php
include_once("../../login/check.php");
include_once("../../class/venta.php");
$venta=new venta;
$nit=$_POST['nit'];
$ven=$venta->mostrarTodos("ci='$nit'");
$ven=array_shift($ven);
echo $ven['cliente'];

?>