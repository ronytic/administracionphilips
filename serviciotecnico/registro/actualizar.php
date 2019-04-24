<?php
include_once("../../login/check.php");
if(!empty($_POST)):
include_once("../../class/serviciotecnico.php");
$serviciotecnico=new serviciotecnico;
extract($_POST);
//empieza la copia de archivos
$valores=array(	"estado"=>"'$estado'",
				"estadogarantia"=>"'$estadogarantia'",
				"codproducto"=>"'$codproducto'",
				"nserie"=>"'$nserie'",
				"indicacioncliente"=>"'$indicacioncliente'",
				"accesorios"=>"'$accesorios'",
				"centro"=>"'$centro'",
				"nombre"=>"'$nombre'",
				"ci"=>"'$ci'",
				"telefono"=>"'$telefono'",
				"acuenta"=>"'$acuenta'",
				"saldo"=>"'$saldo'",
				"total"=>"'$total'",
				"fechaentrega"=>"'$fechaentrega'",

				);
				$serviciotecnico->actualizar($valores,$id);
				$mensaje[]="SUS DATOS SE GUARDARON CORRECTAMENTE";


				$listar=0;
				$nuevo=0;
$titulo="Mensaje de Respuesta";
$folder="../../";
include_once '../../mensajeresultado.php';
endif;?>