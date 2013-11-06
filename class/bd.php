<?php
$archivo=$_SERVER['SCRIPT_NAME'];
$carpeta=explode("/",$archivo);
$subcarpeta=$carpeta[1];
include_once($_SERVER['DOCUMENT_ROOT']."/".$subcarpeta."/basedatos.php");
include_once($_SERVER['DOCUMENT_ROOT']."/".$subcarpeta."/funciones/funciones.php");
class bd{
	var $l;
	var $tabla;
	var $resultado;
	var $campos=array();
	function __construct(){
		global $bost,$user,$pass,$database;
		@$link=mysql_connect($host,$user,$pass);
		if($link){
			if(@mysql_select_db($database,$link)){
				mysql_query("SET NAMES utf8");
				$this->l=$link;
			}
			else{
				echo "No se pudo encontrar la Base de Datos ";
				exit();
			}
		}else{
			echo "No se Puede Conectar a la Base de Datos";
			exit();
		}
		if($this->tabla=="" && empty($this->tabla)){
			$this->tabla=mb_strtolower(get_class($this),"utf8");
		}
	}
	function __destruct(){
		@mysql_close($this->l);
	}
	function getTables(){
		global $database;
		return $this->sql("SHOW TABLES FROM ".$database);	
	}
	function get_db(){
		global $database;
		return $database;	
	}
	function sql($consulta){
		//echo mysql_real_escape_string ($consulta);
		$consQ =mysql_query (($consulta));
		$resultado =array ();
		if ($consQ)
		{
			while ($consF =mysql_fetch_assoc ($consQ))
				array_push ($resultado, $consF);
		}
		return $resultado;
	}
	function queryE($data,$f){
		//echo $data;
		if($f=="lock" && md5("lock")==md5($f))
		{	
			mysql_query($data); //or die(mysql_error($this->l));
		}
	}
	function statusTable(){
		$query ="SHOW TABLE STATUS LIKE '$this->tabla'";
		$res=mysql_query($query);
		return mysql_fetch_array($res);
	}
	function getRecords($where_str=false, $order_str=false,$group_str=false, $count=false, $start=0, $order_strDesc=false){
		$where =$where_str ? "WHERE $where_str" : "";
		$order =$order_str ? "ORDER BY $order_str ASC" : "";
		$order =$order_strDesc ? "ORDER BY $order_str DESC" : $order;
		$group =$group_str ? "GROUP BY $group_str":"";
		$count = $count ? "LIMIT $start, $count" : "";
		$camposs =implode (', ', $this->campos);
		$query ="SELECT $camposs FROM {$this->tabla} $where $group $order $count ";
		//echo $query."<br>";
		return $this->sql ($query);
	}
	function last_id(){
		return mysql_insert_id($this->l);	
	} 
	
	public function insertRow ($data,$sw=1,$swadicional=1){
		$key=array();
		$val=array();	
		foreach($data as $k => $v){
			$key[]=$k;
			$val[]=$v;
		}
		if($swadicional==1){
			$codusuario=$_SESSION['codusuario'];
			if(empty($codusuario)){$codusuario=1;};
			$fecha=date("Y-m-d");
			$hora=date("H:i:s");
			array_push($key, "id");
			array_push($key,"fecha");
			array_push($key,"hora");
			array_push($key, "activo");
			array_push($val,$codusuario);
			array_push($val,"'$fecha'");
			array_push($val,"'$hora'");
			array_push($val,"1");
		}
		$campos=implode(",",$key);
		$datos= implode(",",$val);
		////
		if($sw==0)
			$query ="INSERT INTO {$this->tabla} VALUES ($datos)";
		else
			$query ="INSERT INTO {$this->tabla} ($campos) VALUES ($datos)";
		//echo $query."<br>";
		return mysql_query($query);
	}
	function deleteRecord($where_str){
		$where =$where_str ? "WHERE $where_str" : "";
		mysql_query ("DELETE FROM {$this->tabla} $where");
//		return $this->validateOperation ();
	}
	function updateRow($dataValues,$where_str){
		$where =$where_str ? "WHERE $where_str" : "";
		$data=array();
		foreach($dataValues as $k =>$v){
			array_push($data,$k."=".$v);
		}
		$datos=implode(",",$data);
		//echo "UPDATE {$this->tabla} SET $datos $where";
		mysql_query ("UPDATE {$this->tabla} SET $datos $where");
	}
	/*Metodos de gestion de usuarios*/ 
	function insertar($Values,$swadicional=1){
		$this->insertRow($Values,1,$swadicional);
	}
	function mostrar($Cod){
		$this->campos=array("*");
		return $this->getRecords("cod".$this->tabla."=$Cod");
	}
	
	function mostrarTodo($where='',$orden=false,$cantidad=0){
		$this->campos=array('*');
		$orden=$orden?$orden:"cod".$this->tabla;
		$condicion=$where?$where.' and ':'';
		if($cantidad==0)

			return $this->getRecords($condicion."activo=1",$orden,0,0,0,0);
		else
			return $this->getRecords($condicion."activo=1",$orden,0,$cantidad,0,0);
	}
	function mostrarTodoDesactivados($where='',$orden=false,$cantidad=0){
		$this->campos=array('*');
		$orden=$orden?$orden:"cod".$this->tabla;
		$condicion=$where?$where.' and ':'';
		if($cantidad==0)
			return $this->getRecords($condicion."activo=0",$orden,0,0,0,0);
		else
			return $this->getRecords($condicion."activo=0",$orden,0,$cantidad,0,0);
	}
	function mostrarTodos($where='',$orden=false,$cantidad=0){
		$this->campos=array('*');
		$orden=$orden?$orden:"cod".$this->tabla;
		$condicion=$where?$where.' and ':'';
		if($cantidad==0)
			return $this->getRecords($condicion."activo=1",$orden,0,0,0,0);
		else
			return $this->getRecords($condicion."activo=1",$orden,0,$cantidad,0,0);
	}
	function mostrarTodoUnion($tablas='',$campos='*',$orden="",$where='',$activo='',$cantidad=0){
//		echo "asd".$orden;
		$this->tabla=$tablas;
		$this->campos=array($campos);
		//$orden=$orden?$orden:"cod".$this->tabla;
		$condicion=$where?$where.' and ':'';
		if($cantidad==0)
			return $this->getRecords($condicion.$activo."activo=1",$orden,0,0,0,0);
		else
			return $this->getRecords($condicion.$activo."activo=1",$orden,0,$cantidad,0,0);
	}
	function mostrarUltimo($where=''){
		$this->campos=array('*');
		$condicion=$where?$where.' and ':'';
		return array_shift($this->getRecords($condicion."activo=1","cod".$this->tabla,0,1,0,1));
	}
	function actualizar($values,$Cod){
		$this->updateRow($values,"cod".$this->tabla."=$Cod");	
	}
	function eliminar($Cod){
		$this->updateRow(array("activo"=>0),"cod".$this->tabla."=$Cod");	
	}
	/*Fin de Metodos*/
}
?>