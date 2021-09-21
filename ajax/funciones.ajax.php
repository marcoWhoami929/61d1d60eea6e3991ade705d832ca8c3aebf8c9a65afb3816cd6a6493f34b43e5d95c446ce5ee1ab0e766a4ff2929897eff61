<?php

require_once "../controladores/funciones.controlador.php";
require_once "../modelos/funciones.modelo.php";

class AjaxFuncionesSorteo
{

	public $nombre;
	public $apellidoP;
	public $apellidoM;
	public $correo;
	public $password;
	public $telefono;
	public $celular;
	public $calle;
	public $numInterior;
	public $numExterior;
	public $colonia;
	public $municipio;
	public $estado;
	public $ciudad;
	public $cp;
	public $coordenadas;

	public function ajaxRegistrarParticipantes()
	{

		$tabla = "participantes";

		$array = array(
			'nombre' => $this->nombre,
			'apellidoP' => $this->apellidoP,
			'apellidoM' => $this->apellidoM,
			'correo' => $this->correo,
			'password' => $this->password,
			'telefono' => $this->telefono,
			'celular' => $this->celular,
			'calle' => $this->calle,
			'numInterior' => $this->numInterior,
			'numExterior' => $this->numExterior,
			'colonia' => $this->colonia,
			'municipio' => $this->municipio,
			'estado' => $this->estado,
			'cp' => $this->cp,
			'coordenadas' => $this->coordenadas,
			'ciudad' => $this->ciudad
		);

		$respuesta = ControladorFunciones::ctrRegistrarParticipantes($tabla, $array);

		echo json_encode($respuesta);
	}
	public $correoRegistro;
	public function ajaxValidarCorreo()
	{

		$tabla = "participantes";
		$item = "correo";
		$valor = $this->correoRegistro;
		$respuesta = ControladorFunciones::ctrValidarUsuario($tabla, $item, $valor);

		echo json_encode($respuesta);
	}

	public $correoAcceso;
	public $passwordAcceso;
	public function ajaxAccesoParticipante()
	{

		$tabla = "participantes";

		$correo = $this->correoAcceso;
		$password = $this->passwordAcceso;
		$respuesta = ControladorFunciones::ctrIngresoAdministrador($tabla, $correo, $password);

		echo json_encode($respuesta);
	}
	public $serieCompra;
	public $folioCompra;
	public function ajaxBuscarFactura()
	{

		$serie = $this->serieCompra;
		$folio = $this->folioCompra;
		$respuesta = ControladorFunciones::ctrBuscarCompraRegistrada($serie, $folio);

		echo json_encode($respuesta);
	}
	public $serieCompraRegistro;
	public $folioCompraRegistro;
	public function ajaxRegistrarCompra()
	{
		session_start();

		$idParticipante = $_SESSION["id"];
		$serie = $this->serieCompraRegistro;
		$folio = $this->folioCompraRegistro;
		/*
		VALIDAR SI EL MONTO PERMITE GENERAR UN BOLETO
		 */
		$obtenerDatosFactura = ControladorFunciones::ctrObtenerDatosFactura($serie, $folio);
		$totalFactura = $obtenerDatosFactura["total"];
		$totalClasificacion1 = $obtenerDatosFactura["clasificacion1"];
		$totalClasificacion2 = $obtenerDatosFactura["clasificacion2"];
		$totalClasificacion3 = $obtenerDatosFactura["clasificacion3"];
		$totalClasificacion4 = $obtenerDatosFactura["clasificacion4"];
		$idFactura = $obtenerDatosFactura["id"];

		$respuesta = ControladorFunciones::ctrRegistrarCompra($serie, $folio, $idParticipante);

		if ($respuesta == "ok") {



			$obtenerDatosParticipante = ControladorFunciones::ctrObtenerDatosParticipante($idParticipante);
			$premiosGanados = ControladorFunciones::ctrBuscarPremiosGanados($idParticipante);
			$ganado = $premiosGanados["premio"];

			$compras = $obtenerDatosParticipante["facturasRegistradas"];
			$premio1 = $obtenerDatosParticipante["premio1"];
			$premio2 = $obtenerDatosParticipante["premio2"];
			$premio3 = $obtenerDatosParticipante["premio3"];
			$premio4 = $obtenerDatosParticipante["premio4"];

			$comprasRegistradas = $compras + 1;
			$acumuladoPremio1 = $premio1 + $totalClasificacion1;
			$acumuladoPremio2 = $premio2 + $totalClasificacion2;
			$acumuladoPremio3 = $premio3 + $totalClasificacion3;
			$acumuladoPremio4 = $premio4 + $totalClasificacion4;
			$total = $totalFactura + $obtenerDatosParticipante["montoAcumuladoFacturas"];


			$actualizarParticipante = ControladorFunciones::ctrActualizarParticipante($idParticipante, $comprasRegistradas, $acumuladoPremio1, $acumuladoPremio2, $acumuladoPremio3, $acumuladoPremio4, $total);

			if ($acumuladoPremio1 >= 2500 and $acumuladoPremio1 < 5000) {
				$idPremio = 1;
				$ganador = ControladorFunciones::ctrNuevoGanador($idParticipante, $idFactura, $idPremio);
			} else if ($acumuladoPremio1 >= 5000 and $acumuladoPremio1 < 7000) {
				$idPremio = 2;
				$ganador = ControladorFunciones::ctrNuevoGanador($idParticipante, $idFactura, $idPremio);
			} else if ($acumuladoPremio1 >= 7000 and $ganado = 2) {
				$idPremio = 3;
				$ganador = ControladorFunciones::ctrNuevoGanador($idParticipante, $idFactura, $idPremio);
			}


			$response = "exito";
		} else {
			$response = "errorregistro";
		}



		echo json_encode($response);
	}

	public $serieCompraSend;
	public $folioCompraSend;
	public function ajaxEnviarCorreoConfirmacion()
	{
		session_start();
		$serie = $this->serieCompraSend;
		$folio = $this->folioCompraSend;
		$respuesta = ControladorFunciones::ctrObtenerDatosFactura($serie, $folio);
		$idFactura = $respuesta["id"];

		$idParticipante = $_SESSION["id"];

		$buscarBoletosGanados = ControladorFunciones::ctrObtenerBoletosGanados($idParticipante, $idFactura);

		$string = "<br> Gracias por haber registrado tu compra, a continuación se detallarán los boletos registrados:";

		foreach ($buscarBoletosGanados as $key => $value) {

			$value = $value["folioBoleto"];
		}

		$string2 = $value;

		set_time_limit(0);
		ignore_user_abort(true);

		$correo = "mm_marco_mar@hotmail.com";
		$email = $correo;
		$sDestino = $email;
		// Create the email and send the message
		$to = $email; // Add your email address inbetween the '' replacing yourname@yourdomain.com - Aquí es donde el formulario enviará un mensaje a.
		$email_subject = "Hola " . $_SESSION["nombre"] . "";
		$subject = $email_subject;
		$email_body = $string . $string2;
		$headers = "From:MIS BOLETOS | RIFA <dekkerapp@sanfranciscodekkerlab.com>\n";
		$headers .= "MIME-Version: 1.0r\n";
		$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

		$rcss = "../complementos/plantilla/estilo.css"; //ruta de archivo css
		$fcss = fopen($rcss, "r"); //abrir archivo css
		$scss = fread($fcss, filesize($rcss)); //leer contenido de css
		fclose($fcss); //cerrar archivo css

		//reemplazar sección de plantilla html con el css cargado y mensaje creado
		$shtml = file_get_contents('../complementos/plantilla/contacto.html');
		$incss  = str_replace('<style id="estilo"></style>', "<style>$scss</style>", $shtml);
		$cuerpo = str_replace('<p id="mensaje"></p>', $email_body, $incss);


		if (mail($to, $subject, $cuerpo, $headers)) {
			$accion = "enviado";
		} else {
			$errorMessage = error_get_last()['message'];
			$accion = $errorMessage;
		}

		echo json_encode($accion);
	}
}
if (isset($_POST["nombre"])) {

	$registrar = new AjaxFuncionesSorteo();
	$registrar->nombre = $_POST["nombre"];
	$registrar->apellidoP = $_POST["apellidoP"];
	$registrar->apellidoM = $_POST["apellidoM"];
	$registrar->correo = $_POST["correo"];
	$registrar->password = $_POST["password"];
	$registrar->telefono = $_POST["telefono"];
	$registrar->celular = $_POST["celular"];
	$registrar->calle = $_POST["calle"];
	$registrar->numInterior = $_POST["numInterior"];
	$registrar->numExterior = $_POST["numExterior"];
	$registrar->colonia = $_POST["colonia"];
	$registrar->municipio = $_POST["municipio"];
	$registrar->estado = $_POST["estado"];
	$registrar->ciudad = $_POST["ciudad"];
	$registrar->cp = $_POST["cp"];
	$registrar->coordenadas = $_POST["coordenadas"];
	$registrar->ajaxRegistrarParticipantes();
}
if (isset($_POST["correoRegistro"])) {

	$validar = new AjaxFuncionesSorteo();
	$validar->correoRegistro = $_POST["correoRegistro"];
	$validar->ajaxValidarCorreo();
}
if (isset($_POST["correoAcceso"])) {

	$acceder = new AjaxFuncionesSorteo();
	$acceder->correoAcceso = $_POST["correoAcceso"];
	$acceder->passwordAcceso = $_POST["passwordAcceso"];
	$acceder->ajaxAccesoParticipante();
}
if (isset($_POST["serieCompra"])) {

	$buscarCompra = new AjaxFuncionesSorteo();
	$buscarCompra->serieCompra = $_POST["serieCompra"];
	$buscarCompra->folioCompra = $_POST["folioCompra"];
	$buscarCompra->ajaxBuscarFactura();
}
if (isset($_POST["serieCompraRegistro"])) {

	$registrarCompra = new AjaxFuncionesSorteo();
	$registrarCompra->serieCompraRegistro = $_POST["serieCompraRegistro"];
	$registrarCompra->folioCompraRegistro = $_POST["folioCompraRegistro"];
	$registrarCompra->ajaxRegistrarCompra();
}
if (isset($_POST["serieCompraSend"])) {

	$envioCorreo = new AjaxFuncionesSorteo();
	$envioCorreo->serieCompraSend = $_POST["serieCompraSend"];
	$envioCorreo->folioCompraSend = $_POST["folioCompraSend"];
	$envioCorreo->ajaxEnviarCorreoConfirmacion();
}
