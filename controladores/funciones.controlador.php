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
			if (
				preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $correo) &&
				preg_match('/^[a-zA-Z0-9]+$/', $password)
			) {

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

		$tabla = "facturas";

		$respuesta = ModeloFunciones::mdlBuscarCompraRegistrada($tabla, $serie, $folio);

		return $respuesta;
	}
	static public function ctrRegistrarCompra($serie, $folio)
	{

		$tabla = "facturas";

		$respuesta = ModeloFunciones::mdlRegistrarCompra($tabla, $serie, $folio);

		return $respuesta;
	}
	static public function ctrObtenerDatosFactura($serie, $folio)
	{

		$tabla = "facturas";

		$respuesta = ModeloFunciones::mdlObtenerDatosFactura($tabla, $serie, $folio);

		return $respuesta;
	}
	static public function ctrObtenerDatosParticipante($idParticipante)
	{

		$tabla = "participantes";

		$respuesta = ModeloFunciones::mdlObtenerDatosParticipante($tabla, $idParticipante);

		return $respuesta;
	}
	static public function ctrActualizarParticipante($idParticipante, $comprasRegistradas, $montoAcumulado)
	{

		$tabla = "participantes";

		$respuesta = ModeloFunciones::mdlActualizarParticipante($tabla, $idParticipante, $comprasRegistradas, $montoAcumulado);

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
}
