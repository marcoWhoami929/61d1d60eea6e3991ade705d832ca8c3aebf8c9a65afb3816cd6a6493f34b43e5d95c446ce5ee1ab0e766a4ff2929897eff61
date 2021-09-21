<?php
header("Access-Control-Allow-Origin: *");

//Conexión a la base de datos
$conn = mysqli_connect("localhost", "sanfranc_matriz", "rootWhoami929") or die("could not connect server");
//$conn = mysqli_connect("localhost", "root", "") or die("could not connect server");
mysqli_set_charset($conn, 'utf8');
mysqli_select_db($conn, "sanfranc_rifa") or die("could not connect database");


if (isset($_POST['cargarFacturasRifa'])) {


	$lista = $_POST["listaFacturas"];

	$arregloFacturasRifa = json_decode($lista, true);

	foreach ($arregloFacturasRifa as $key => $value) {

		$consulta1 = "SELECT * FROM facturasacumula WHERE folio = '" . str_replace(',', '', $value["folio"]) . "' and serie = '" . $value["serie"] . "'";

		$ejecutar = mysqli_query($conn, $consulta1) or die("database error:" . mysqli_error($conn));

		$filas = mysqli_num_rows($ejecutar);

		if (is_null($value["acumulado1"])) {
			$acumulado1 = 0;
		}else{
			$acumulado1 = $value["acumulado1"];
		}

		if (is_null($value["acumulado2"])) {
			$acumulado2 = 0;
		}else{
			$acumulado2 = $value["acumulado2"];
		}

		if (is_null($value["acumulado3"])) {
			$acumulado3 = 0;
		}else{
			$acumulado3 = $value["acumulado3"];
		}

		if (is_null($value["acumulado4"])) {
			$acumulado4 = 0;
		}else{
			$acumulado4 = $value["acumulado4"];
		}

		if ($filas) {
			$fechaFactura = substr($value["fecha"]["date"], 0, 10);
			$actualizarFactura = "UPDATE facturasacumula set total = '" . $value["total"] . "',fechaFactura = '" . $fechaFactura . "',cancelado = '" . $value["cancelado"] . "',clasificacion1 = '" . $acumulado1 . "',clasificacion2 = '" . $acumulado2 . "',clasificacion3 = '" . $acumulado3 . "',clasificacion4 = '" . $acumulado4 . "' where serie = '" . $value["serie"] . "' and folio = '" . str_replace(',', '', $value["folio"]) . "'";
			$actualizar = mysqli_query($conn, $actualizarFactura) or die("database error:" . mysqli_error($conn));
		} else {

			$fechaFactura = substr($value["fecha"]["date"], 0, 10);
			$insertarFactura = "INSERT INTO facturasacumula (`cliente`, `serie`,`folio`,`total`,`fechaFactura`,`elegida`,`cancelado`,`clasificacion1`,`clasificacion2`,`clasificacion3`,`clasificacion4`,`usuarioAsignado`) VALUES ('" . $value["cliente"] . "','" . $value["serie"] . "','" . str_replace(',', '', $value["folio"]) . "','" . $value["total"] . "','" . $fechaFactura . "','0','" . $value["cancelado"] . "','" . $acumulado1 . "','" . $acumulado2 . "','" . $acumulado3 . "','" . $acumulado4 . "',0)";
			$insertar = mysqli_query($conn, $insertarFactura) or die("database error:" . mysqli_error($conn));
		}
	}
	echo "finalizado";
}
