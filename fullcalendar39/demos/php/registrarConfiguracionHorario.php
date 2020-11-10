<?php

$desde =$_GET['desde'];
$hasta=$_GET['hasta'];
$instructor=$_GET['instructor'];

$conexion = new mysqli("localhost", "root", "", " localhost");
$sql = "INSERT INTO tblconfiguracionhorario VALUES(0,'$desde', '$hasta', '$instructor')";
if(mysqli_query($conexion, $sql))
{
	echo 1;
	return true;
}
else
{
		echo 0;
		return false;
}
?>