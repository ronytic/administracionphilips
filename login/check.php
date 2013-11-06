<?php
session_start();
$archivo=$_SERVER['SCRIPT_NAME'];
$folderFile=explode("/",$archivo);
$subfolder=$folderFile[1];

include_once($_SERVER['DOCUMENT_ROOT']."/".$subfolder."/config.php");
if(!(isset($_SESSION["login"]) && $_SESSION['login']==1)){
	header("Location:$url$directory/login/?u=".$_SERVER['PHP_SELF']);
}
?>