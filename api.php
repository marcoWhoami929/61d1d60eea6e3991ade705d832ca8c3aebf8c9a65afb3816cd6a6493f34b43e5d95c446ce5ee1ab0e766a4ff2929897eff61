<?php
header("Access-Control-Allow-Origin: *");

//Conexión a la base de datos
$conn = mysqli_connect("localhost","sanfranc_matriz","rootWhoami929") or die("could not connect server");
mysqli_set_charset($conn, 'utf8');
mysqli_select_db($conn,"sanfranc_rifa") or die("could not connect database");

//****SOLICITAR LA CANCELACION DE LA FACTURA EN VENTAS CRM
if(isset($_POST['cancelarFacturaVenta']))
{	
	

	  	$serieFactura = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['serieFactura'])));
	  	$folioFactura = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST['folioFactura'])));
	  	$motivoCancelacion = mysqli_real_escape_string($conn,htmlspecialchars(trim($_POST["motivoCancelacion"])));
	  	$fechaCancelacion = date('Y-m-d h:m:s');
        

		$cancelacion = mysqli_query($conn,"UPDATE `ventas` SET `cancelado` = '1',`estatus` = 'Cancelada',`motivoCancelacion` = '$motivoCancelacion',`fechaCancelacion` = '$fechaCancelacion',`estatusVenta` = '0'  WHERE  `serie` = '$serieFactura' and `folio` = '$folioFactura'");

		
		if($cancelacion){

			echo "success";

		}else{

			echo "failed";
		}

		echo mysqli_error($conn);
}

?>