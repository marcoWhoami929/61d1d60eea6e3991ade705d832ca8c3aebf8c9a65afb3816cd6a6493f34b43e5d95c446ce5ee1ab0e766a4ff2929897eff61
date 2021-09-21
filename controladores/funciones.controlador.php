<?php


/**
 * 
 */
class ControladorFunciones
{

	static public function ctrRegistrarParticipantes($tabla, $array)
	{

		$respuesta = ModeloFunciones::mdlRegistrarParticipantes($tabla, $array);

		return $respuesta;
	}
	static public function ctrValidarUsuario($tabla, $item, $valor)
	{

		$respuesta = ModeloFunciones::mdlValidarUsuario($tabla, $item, $valor);

		return $respuesta;
	}
	static public function ctrIngresoAdministrador($tabla, $correo, $password)
	{
		require_once "../modelos/encriptador.php";

		if (isset($correo)) {
			session_start();
			
				$encriptado = $encriptar($password);

				$item = "correo";
				$valor = $correo;
				$respuesta = ModeloFunciones::mdlMostrarAdministradores($tabla, $item, $valor);

				if ($respuesta["correo"] == $correo && $respuesta["password"] == $encriptado) {

					$_SESSION["validarSesionBackend"] = "ok";
					$_SESSION["id"] = $respuesta["id"];
					$_SESSION["nombre"] = $respuesta["nombre"];
					$_SESSION["apellidoPaterno"] = $respuesta["apellidoPaterno"];
					$_SESSION["apellidoMaterno"] = $respuesta["apellidoMaterno"];
					$_SESSION["correo"] = $respuesta["correo"];

					return "correcto";
				} else {

					return "error";
				}
			
		}
	}
	static public function ctrMostrarTotalBoletos($idParticipante)
	{

		$tabla = "boletos";

		$respuesta = ModeloFunciones::mdlMostrarTotalBoletos($tabla, $idParticipante);

		return $respuesta;
	}
	static public function ctrMostrarTotalCompras($idParticipante)
	{

		$tabla = "participantes";

		$respuesta = ModeloFunciones::mdlMostrarTotalCompras($tabla, $idParticipante);

		return $respuesta;
	}
	static public function ctrMostrarBoletosObtenidos($idParticipante)
	{

		$tabla = "boletos";

		$respuesta = ModeloFunciones::mdlMostrarBoletosObtenidos($tabla, $idParticipante);

		return $respuesta;
	}
	static public function ctrMostrarCompras($idParticipante)
	{

		$tabla = "boletos";

		$respuesta = ModeloFunciones::mdlMostrarCompras($tabla, $idParticipante);

		return $respuesta;
	}
	static public function ctrBuscarCompraRegistrada($serie, $folio)
	{

		$tabla = "facturasacumula";

		$respuesta = ModeloFunciones::mdlBuscarCompraRegistrada($tabla, $serie, $folio);

		return $respuesta;
	}
	static public function ctrRegistrarCompra($serie, $folio, $idParticipante)
	{

		$tabla = "facturasacumula";

		$respuesta = ModeloFunciones::mdlRegistrarCompra($tabla, $serie, $folio, $idParticipante);

		return $respuesta;
	}
	static public function ctrObtenerDatosFactura($serie, $folio)
	{

		$tabla = "facturasacumula";

		$respuesta = ModeloFunciones::mdlObtenerDatosFactura($tabla, $serie, $folio);

		return $respuesta;
	}
	static public function ctrObtenerDatosParticipante($idParticipante)
	{

		$tabla = "participantes";

		$respuesta = ModeloFunciones::mdlObtenerDatosParticipante($tabla, $idParticipante);

		return $respuesta;
	}
	static public function ctrActualizarParticipante($idParticipante, $comprasRegistradas, $acumuladoPremio1, $acumuladoPremio2, $acumuladoPremio3, $acumuladoPremio4, $total)
	{

		$tabla = "participantes";

		$respuesta = ModeloFunciones::mdlActualizarParticipante($tabla, $idParticipante, $comprasRegistradas, $acumuladoPremio1, $acumuladoPremio2, $acumuladoPremio3, $acumuladoPremio4, $total);

		return $respuesta;
	}
	static public function ctrRegistrarBoleto($idParticipante, $idFactura)
	{

		$tabla = "boletos";

		$respuesta = ModeloFunciones::mdlRegistrarBoleto($tabla, $idParticipante, $idFactura);

		return $respuesta;
	}
	static public function ctrObtenerBoletosGanados($idParticipante, $idFactura)
	{

		$tabla = "boletos";

		$respuesta = ModeloFunciones::mdlObtenerBoletosGanados($tabla, $idParticipante, $idFactura);

		return $respuesta;
	}
	static public function ctrMostrarTotalAcumulado($idParticipante)
	{

		$tabla = "participantes";

		$respuesta = ModeloFunciones::mdlMostrarTotalAcumulado($tabla, $idParticipante);

		return $respuesta;
	}
	static public function ctrBuscarPremios()
	{

		$tabla = "premios";

		$respuesta = ModeloFunciones::mdlBuscarPremios($tabla);

		return $respuesta;
	}
	static public function ctrNuevoGanador($idParticipante, $idFactura, $idPremio)
	{

		$tabla = "premios";

		$respuesta = ModeloFunciones::mdlNuevoGanador($tabla, $idParticipante, $idFactura, $idPremio);

		return $respuesta;
	}
	static public function ctrMostrarFacturasRegistradas($idParticipante)
	{

		$tabla = "facturasacumula";

		$respuesta = ModeloFunciones::mdlMostrarFacturasRegistradas($tabla, $idParticipante);

		return $respuesta;
	}
	static public function ctrBuscarPremiosGanados($idParticipante)
	{

		$tabla = "ganadores";

		$respuesta = ModeloFunciones::mdlBuscarPremiosGanados($tabla, $idParticipante);

		return $respuesta;
	}
	static public function ctrBuscarPremiosGanadosLista($idParticipante)
	{

		$tabla = "ganadores";

		$respuesta = ModeloFunciones::mdlBuscarPremiosGanadosLista($tabla, $idParticipante);

		return $respuesta;
	}
}
