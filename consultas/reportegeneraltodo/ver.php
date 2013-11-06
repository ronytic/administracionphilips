<?php
include_once("../../login/check.php");
include_once("../../impresion/pdf.php");
$titulo="Reporte General de Lineas de Sindicato";
extract($_GET);

$codsindicato=$codsindicato!=''?" codsindicato='$codsindicato'":'';
$codmodalidad=$codmodalidad!=''?" and codmodalidad='$codmodalidad'":'';
$codservicio=$codservicio!=''?" and codservicio='$codservicio'":'';

//$codproductos=$codproductos!=""?$codproductos:"%";

/*$existente=$existente=="1"?'and cantidadstock>0':'';
if($fechainicio!="" && $fechafin!=""){
	$fechainicio=$fechainicio!=""?$fechainicio:"%";
	$fechafin=$fechafin!=""?$fechafin:"%";
	$fechas=" and  (fechacompra BETWEEN '$fechainicio' and '$fechafin')";
}*/
include_once '../../class/linea.php';
include_once '../../class/sindicato.php';
include_once '../../class/servicio.php';
include_once '../../class/modalidad.php';
$linea=new linea;
$modalidad=new modalidad;
$servicio=new servicio;
$sindicato=new sindicato;

$where="$codsindicato $codmodalidad $codservicio";
/*if(!empty($fechacontrato)){
	$where="`fechacontrato`<='$fechacontrato'";
}
if(!empty($codobra)){
	$where=(empty($fechacontrato))?"`codobra`=$codobra":$where." and `codobra`=$codobra";
}
if(!empty($tipocontrato)){
	$where=(empty($where))?$where."`tipocontrato` LIKE '%$tipocontrato%'":$where." and `tipocontrato` LIKE '%$tipocontrato%'";
}*/

class PDF extends PPDF{
	function Cabecera(){
		global $fechasalida;
		/*if($fechasalida!="%"){
		$this->CuadroCabecera(30,"Fecha Salida:",20,fecha2Str($fechasalida));
		}*/
		$this->Ln();
		$this->TituloCabecera(10,"N");
		$this->TituloCabecera(50,"Sindicato");
		$this->TituloCabecera(40,"Modalidad");
		$this->TituloCabecera(40,"Servicio");
		$this->TituloCabecera(40,"Número de Linea");
		$this->TituloCabecera(40,"Color");
	}	
}
$pdf=new PDF("L","mm","legal");
$pdf->AddPage();
$totales=array();
foreach($linea->mostrarTodos($where,"numerolinea") as $l){$i++;
	$mod=array_shift($modalidad->mostrar($l['codmodalidad']));
	$sin=array_shift($sindicato->mostrar($l['codsindicato']));
	$ser=array_shift($servicio->mostrar($l['codservicio']));


	$pdf->CuadroCuerpo(10,$i,0,"R");
	$pdf->CuadroCuerpo(50,$sin['nombre']);
	$pdf->CuadroCuerpo(40,$mod['nombre']);
	$pdf->CuadroCuerpo(40,$ser['nombre']);
	$pdf->CuadroCuerpo(40,$l['numerolinea']);
	$pdf->CuadroCuerpo(40,$l['color']);
	
	$pdf->ln();
}
$pdf->Linea();


$pdf->Output();
?>