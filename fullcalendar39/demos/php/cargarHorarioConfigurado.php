<?php

//$instructor =$_GET['instructor'];
$conexion = new mysqli("localhost", "root", "", " localhost");

$sql="SELECT*FROM tblconfiguracionhorario";// WHERE instructor =$instructor";

if($resultado=mysqli_query($conexion,$sql))
{
	if(mysqli_num_rows($resultado)>0)
	{
		while($hora=mysqli_fetch_object($resultado))
		{
		$datos[] = array('desde' => $hora->desde, 'hasta' => $hora->hasta);

		header('Content-Type: application/json');
		echo json_encode($datos, JSON_FORCE_OBJECT);
		return false;
		}
	}
	else
	{
		$null="";

		$datos[] = array('desde' => $null, 'hasta' => $null);

		header('Content-Type: application/json');
		echo json_encode($datos, JSON_FORCE_OBJECT);
		return false;
	}

}
?>