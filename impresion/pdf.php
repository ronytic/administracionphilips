<?php
include_once("fpdf/fpdf.php");
include_once(dirname(__FILE__).DIRECTORY_SEPARATOR."../config.php");
include_once(dirname(__FILE__).DIRECTORY_SEPARATOR."../funciones/funciones.php");
php_start(0);
	$logo="logo.jpg";
	class PPDF extends FPDF{
		var $ancho=176;
		function Header(){
			global $idioma;
			if($this->CurOrientation=="P"){$this->ancho=$this->w-34;}else{$this->ancho=$this->w-40;}	
			$this->SetAuthor("Sistema Desarrollado por Ronald Nina Layme. Cel: 73230568 - Soluciones Tecnológicas de Sistemas");
			$this->SetSubject("Sistema Desarrollado por Ronald Nina Layme. Cel: 73230568 - Soluciones Tecnológicas de Sistemas");
			$this->SetCreator("Sistema Desarrollado por Ronald Nina Layme. Cel: 73230568 - Soluciones Tecnológicas de Sistemas");
			$this->SetLeftMargin(18);
			$this->SetAutoPageBreak(true,15);
			global $title,$lema2,$titulo,$logo,$idioma;
			$fecha=date("d-m-Y");
			
			$this->Image(dirname(__FILE__)."/../imagenes/cabecera2pdf.jpg",10,10,195,30);
			$this->Fuente("",10);
			$this->SetXY(10,35);
			//$this->Cell(55,4,utf8_decode($title),0,0,"L");
			$this->Fuente("B",8);
			$this->SetXY(45,16);
			$this->Cell(55,4,utf8_decode($lema2),0,0,"L");
			$this->ln(10);	
			$this->SetXY(50,12);
			$this->Fuente("B",18);
			$this->Cell($this->ancho-30,8,utf8_decode($titulo),0,5,"C");
			
			$this->ln(14);
			$this->CuadroCabecera($this->ancho-75 ,"" ,20,"");
			$this->CuadroCabecera(12 ,"Fecha: ",20,$fecha);
			$this->Pagina();
			$this->ln(5);
			if(in_array("Cabecera",get_class_methods($this))){
				$this->Cabecera();	
			}
			$this->ln();
			
			$this->Cell($this->ancho,0,"",1,1);
			$this->Ln(0.1);
		}
		function Pagina(){
			global $idioma;
			$this->AliasNbPages();
			$this->CuadroCabecera(15,"Página: ",20,$this->PageNo()." de {nb}");
		}
		function Fuente($tipo="B",$tam=10){
			$this->SetFillColor(234,234,234);
			$this->SetFont("Arial",$tipo,$tam);	
		}
		function CuadroCabecera($txt1Ancho,$txt1,$txt2Ancho,$txt2){
			$this->Fuente("B");
			$this->Cell($txt1Ancho,4,utf8_decode($txt1),0,0,"L");
			$this->Fuente("");
			$this->Cell($txt2Ancho,4,utf8_decode($txt2),0,0,"L");
		}
		function TituloCabecera($txtAncho,$txt,$tam=10,$borde=1,$align="C"){
			$this->Fuente("B",$tam);
			$this->Cell($txtAncho,4,utf8_decode($txt),$borde,0,$align);	
		}
		function CuadroCuerpo($txtAncho,$txt,$relleno=0,$align="L",$borde=0,$tam=9){
			$this->Fuente("",$tam);
			$this->Cell($txtAncho,5,utf8_decode($txt),$borde,0,$align,$relleno);	
		}
		function CuadroCuerpoMulti($txtAncho,$txt,$relleno=0,$align="L",$borde=0,$tam=9){
			$this->Fuente("",$tam);
			$this->MultiCell($txtAncho,5,utf8_decode($txt),$borde,$align,$relleno);	
		}
		function CuadroCuerpoPersonalizado($txtAncho,$txt,$relleno=0,$align="L",$borde=0,$tipo=""){
			$this->Fuente($tipo);
			$this->Cell($txtAncho,5,utf8_decode($txt),$borde,0,$align,$relleno);	
		}
		function CuadroCuerpoResaltar($txtAncho,$txt,$relleno=0,$align="L",$borde=0,$resaltar=2){
			$this->Fuente("");
			switch($resaltar){
				//case 1:{$this->SetFillColor(179,179,179);}break;
				//case 2:{$this->SetFillColor(135,135,135);}break;
				case 2:{$this->SetFillColor(190,190,190);}break;
				case 1:{$this->SetFillColor(210,210,210);}break;
			}
			$this->Cell($txtAncho,5,utf8_decode($txt),$borde,0,$align,$relleno);	
		}
		function CuadroNombre($txtAncho,$Paterno,$Materno,$Nombres,$Full=0,$relleno){
			if($Full){
				$this->CuadroCuerpo($txtAncho,ucwords($Paterno." ".$Materno." ".$Nombres),$relleno);
			}else{
				$Nombre=array_shift(explode(" ",$Nombres));
				$this->CuadroCuerpo($txtAncho,ucwords($Paterno." ".$Materno." ".$Nombre),$relleno);
			}		
		}
		function CuadroNombreSeparado($txtAnchoP,$Paterno,$txtAnchoM,$Materno,$txtAnchoN,$Nombres,$Full,$relleno){
			if($Full){
				$this->CuadroCuerpo($txtAnchoP,ucwords($Paterno),$relleno);
				$this->CuadroCuerpo($txtAnchoM,ucwords($Materno),$relleno);
				$this->CuadroCuerpo($txtAnchoN,ucwords($Nombres),$relleno);
			}else{
				$Nombre=array_shift(explode(" ",$Nombres));
				$this->CuadroCuerpo($txtAnchoP,ucwords($Paterno),$relleno);
				$this->CuadroCuerpo($txtAnchoM,ucwords($Materno),$relleno);
				$this->CuadroCuerpo($txtAnchoN,ucwords($Nombre),$relleno);
			}
		}
		function Linea(){
			$this->Cell($this->ancho,0,"",1,1);
			$this->Ln();	
		}
		function Footer()
		{	global $lema,$idioma;
			// Cell($this->ancho,0,"",1,1);
			// Posición: a 1,5 cm del final
			$this->SetY(-15);
			// Arial italic 8
			$this->Fuente("I",8);
			// Número de página
			$this->Cell($this->ancho,0,"",1,1);
			$anio=date("Y");
			$this->Cell(60,4,utf8_decode('Reporte Generado: ').date('d-m-Y H:i:s'),0,0,"L");
			$this->Cell($this->ancho-60,4,utf8_decode($lema),0,0,"R");
			//$this->Cell(60,4,utf8_decode($idioma['ReporteGenerado']).": ".date('d-m-Y H:i:s'),0,0,"R");
			
			if(in_array("Pie",get_class_methods($this))){
				$this->Pie();	
			}
		}
	}
?>