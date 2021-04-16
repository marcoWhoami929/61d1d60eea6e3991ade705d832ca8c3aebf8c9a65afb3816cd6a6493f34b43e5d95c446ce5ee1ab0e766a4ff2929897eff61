<?php
header("Access-Control-Allow-Origin: *");

//Conexión a la base de datos
$conn = mysqli_connect("localhost","sanfranc_matriz","rootWhoami929") or die("could not connect server");
mysqli_set_charset($conn, 'utf8');
mysqli_select_db($conn,"sanfranc_rifa") or die("could not connect database");

//****SOLICITAR LA CANCELACION DE LA FACTURA EN VENTAS CRM
if(isset($_POST['cargarFacturasRifa']))
{	
	

	  	$lista = $_POST["listaFacturas"];

		$arregloFacturasRifa = json_decode($lista,true);
		
		foreach ($arregloFacturasRifa as $key => $value) {
				
				$consulta1 = "SELECT * FROM facturas WHERE folio = '".str_replace(',','',$value["folio"])."' and serie = '".$value["serie"]."'";

				$ejecutar = mysqli_query($conn, $consulta1) or die("database error:". mysqli_error($conn));

				$filas = mysqli_num_rows($ejecutar);
			

				if ($filas) {
					$fechaFactura = substr($value["fecha"]["date"],0,10);
					$actualizarFactura = "UPDATE facturas set total = '".$value["total"]."',fechaFactura = '".$fechaFactura."',cancelado = '".$value["cancelado"]."' where serie = '".$value["serie"]."' and folio = '".str_replace(',','',$value["folio"])."'";
					$actualizar = mysqli_query($conn, $actualizarFactura) or die("database error:". mysqli_error($conn));

					/*
					if($actualizar){

						echo "success";

					}else{

						echo "failed";
					}

					echo mysqli_error($conn);
					*/

				}else{

					$fechaFactura = substr($value["fecha"]["date"],0,10);
					$insertarFactura = "INSERT INTO facturas (`cliente`, `serie`,`folio`,`total`,`fechaFactura`,`elegida`,`cancelado`) VALUES ('".$value["razonSocial"]."','".$value["serie"]."','".str_replace(',','',$value["folio"])."','".$value["total"]."','".$fechaFactura."','0','".$value["cancelado"]."')";
					$insertar = mysqli_query($conn, $insertarFactura) or die("database error:". mysqli_error($conn));
					/*
					if($insertar){

						echo "success";

					}else{

						echo "failed";
					}
					
					echo mysqli_error($conn);
					*/

			}
		}
		echo "finalizado";


}

?>