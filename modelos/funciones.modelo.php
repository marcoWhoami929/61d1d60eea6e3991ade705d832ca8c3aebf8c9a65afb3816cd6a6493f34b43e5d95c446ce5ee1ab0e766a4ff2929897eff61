<?php
require_once "conexion.php";

/**
 *
 */
class ModeloFunciones
{

	static public function mdlRegistrarParticipantes($tabla, $array)
	{

		require_once "encriptador.php";

		$passwordEncrypt = $encriptar($array["password"]);

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(`nombre`,`apellidoPaterno`,`apellidoMaterno`,`correo`,`password`,`celular`,`telefono`,`calle`,`numeroInterior`,`numeroExterior`,`colonia`,`municipio`,`estado`,`ciudad`,`pais`,`cp`,`coordenadas`,`comprasRegistradas`,`montoAcumulado`,`clasificacion`,`montoAcumuladoFacturas`,`facturasRegistradas`,`premio1`,`premio2`,`premio3`,`premio4`) values(:nombre,:apellidoP,:apellidoM,:correo,'" . $passwordEncrypt . "',:celular,:telefono,:calle,:numInterior,:numExterior,:colonia,:municipio,:estado,:ciudad,'MEXICO',:cp,:coordenadas,'0','0','0','0','0','0','0','0','0')");


		$stmt->bindParam(":nombre", $array["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":apellidoP", $array["apellidoP"], PDO::PARAM_STR);
		$stmt->bindParam(":apellidoM", $array["apellidoM"], PDO::PARAM_STR);
		$stmt->bindParam(":correo", $array["correo"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $array["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":celular", $array["celular"], PDO::PARAM_STR);
		$stmt->bindParam(":calle", $array["calle"], PDO::PARAM_STR);
		$stmt->bindParam(":numInterior", $array["numInterior"], PDO::PARAM_STR);
		$stmt->bindParam(":numExterior", $array["numExterior"], PDO::PARAM_STR);
		$stmt->bindParam(":colonia", $array["colonia"], PDO::PARAM_STR);
		$stmt->bindParam(":municipio", $array["municipio"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $array["estado"], PDO::PARAM_STR);
		$stmt->bindParam(":ciudad", $array["ciudad"], PDO::PARAM_STR);
		$stmt->bindParam(":cp", $array["cp"], PDO::PARAM_STR);
		$stmt->bindParam(":coordenadas", $array["coordenadas"], PDO::PARAM_STR);

		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}

		$stmt->close();

		$stmt = null;
	}
	static public function mdlValidarUsuario($tabla, $item, $valor)
	{

		$stmt = Conexion::conectar()->prepare("SELECT correo FROM $tabla WHERE $item = :$item");

		$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

		$stmt->execute();

		$cuenta = $stmt->rowCount();

		if ($cuenta > 0) {
			return "existe";
		} else {
			return "no existe";
		}

		$stmt->close();

		$stmt = null;
	}
	static public function mdlMostrarAdministradores($tabla, $item, $valor)
	{

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

		$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();

		$stmt = null;
	}
	static public function mdlMostrarTotalBoletos($tabla, $idParticipante)
	{

		$stmt = Conexion::conectar()->prepare("SELECT count(id) as total FROM $tabla WHERE idParticipante = $idParticipante");

		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();

		$stmt = null;
	}
	static public function mdlMostrarTotalCompras($tabla, $idParticipante)
	{

		$stmt = Conexion::conectar()->prepare("SELECT comprasRegistradas,montoAcumulado FROM $tabla WHERE id = $idParticipante");

		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();

		$stmt = null;
	}
	static public function mdlMostrarBoletosObtenidos($tabla, $idParticipante)
	{

		$stmt = Conexion::conectar()->prepare("SELECT fecha,folioBoleto  FROM $tabla WHERE idParticipante = $idParticipante");

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();

		$stmt = null;
	}
	static public function mdlMostrarCompras($tabla, $idParticipante)
	{
		$consulta = Conexion::conectar()->prepare("SELECT COUNT(id) as total from boletos where idParticipante = $idParticipante");

		$consulta->execute();
		$total = $consulta->fetch();
		$totalBoletos = $total["total"];
		if ($totalBoletos == 0) {
			$stmt = Conexion::conectar()->prepare("SELECT fac.serie,fac.folio,fac.total,fac.fechaFactura FROM $tabla as bol INNER JOIN facturas as fac ON bol.idFactura = fac.id WHERE bol.idParticipante = $idParticipante");
		} else {

			$stmt = Conexion::conectar()->prepare("SELECT fac.serie,fac.folio,fac.total,fac.fechaFactura FROM $tabla as bol INNER JOIN facturas as fac ON bol.idFactura = fac.id WHERE bol.idParticipante = $idParticipante GROUP by fac.serie,fac.folio,fac.total,fac.fechaFactura");
		}


		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();

		$stmt = null;
	}

	static public function mdlBuscarCompraRegistrada($tabla, $serie, $folio)
	{

		$stmt = Conexion::conectar()->prepare("SELECT elegida FROM $tabla WHERE serie = '$serie' and folio = $folio");

		$stmt->execute();

		if ($stmt->rowCount() > 0) {

			$results = $stmt->fetch();
			$elegida = $results["elegida"];
			if ($elegida == 1) {

				return "registrada";
			} else {

				return "no registrada";
			}
		} else {

			return "no existe";
		}

		$stmt->close();

		$stmt = null;
	}
	static public function mdlRegistrarCompra($tabla, $serie, $folio, $idParticipante)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET elegida = 1,usuarioAsignado = '$idParticipante' WHERE serie = '$serie' and folio = $folio");

		$stmt->execute();

		$cuenta = $stmt->rowCount();

		if ($cuenta > 0) {

			return "ok";
		} else {

			return "error";
		}
		$stmt->close();

		$stmt = null;
	}
	static public function mdlObtenerDatosFactura($tabla, $serie, $folio)
	{

		$stmt = Conexion::conectar()->prepare("SELECT id,total,clasificacion1,clasificacion2,clasificacion3,clasificacion4 FROM $tabla WHERE serie = '$serie' and folio = $folio");

		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();

		$stmt = null;
	}
	static public function mdlObtenerDatosParticipante($tabla, $idParticipante)
	{

		$stmt = Conexion::conectar()->prepare("SELECT montoAcumulado,montoAcumuladoFacturas,comprasRegistradas,facturasRegistradas,premio1,premio2,premio3,premio4 FROM $tabla WHERE id = $idParticipante");

		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();

		$stmt = null;
	}
	static public function mdlActualizarParticipante($tabla, $idParticipante, $comprasRegistradas, $acumuladoPremio1, $acumuladoPremio2, $acumuladoPremio3, $acumuladoPremio4, $total)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET facturasRegistradas = $comprasRegistradas,premio1 = $acumuladoPremio1,premio2=$acumuladoPremio2,premio3 = $acumuladoPremio3,premio4 = $acumuladoPremio4,montoAcumuladoFacturas = $total WHERE id = $idParticipante");

		$stmt->execute();

		$cuenta = $stmt->rowCount();

		if ($cuenta > 0) {

			return "ok";
		} else {

			return "error";
		}
		$stmt->close();

		$stmt = null;
	}
	static public function mdlRegistrarBoleto($tabla, $idParticipante, $idFactura)
	{

		$ultimoFolio = Conexion::conectar()->prepare("SELECT if(MAX(folioBoleto)+1 IS NULL,1001,MAX(folioBoleto)+1) as folio FROM $tabla");
		$ultimoFolio->execute();
		$results = $ultimoFolio->fetch();
		$folioBoleto = $results["folio"];

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(`idParticipante`,`idFactura`,`folioBoleto`) values($idParticipante,$idFactura,$folioBoleto)");

		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}

		$stmt->close();

		$stmt = null;
	}
	static public function mdlObtenerBoletosGanados($tabla, $idParticipante, $idFactura)
	{

		$stmt = Conexion::conectar()->prepare("SELECT folioBoleto FROM $tabla WHERE idParticipante = $idParticipante and idFactura = $idFactura");

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();

		$stmt = null;
	}
	static public function mdlMostrarTotalAcumulado($tabla, $idParticipante)
	{

		$stmt = Conexion::conectar()->prepare("SELECT facturasRegistradas,premio1,premio2,premio3,premio4 FROM $tabla WHERE id = $idParticipante");

		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();

		$stmt = null;
	}
	static public function mdlBuscarPremios($tabla)
	{

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();

		$stmt = null;
	}
	static public function mdlNuevoGanador($tabla, $idParticipante, $idFactura, $idPremio)
	{
		$existePremio = Conexion::conectar()->prepare("SELECT id FROM ganadores where idParticipante = '$idParticipante' and idPremio = '$idPremio'");
		$existePremio->execute();
		$resultados = $existePremio->rowCount();

		if ($resultados > 0) {
			return "ok";
		} else {

			$ganados = Conexion::conectar()->prepare("SELECT ganados,stockPremios-ganados as stock,ganadosSinStock FROM $tabla where id = '$idPremio'");
			$ganados->execute();
			$results = $ganados->fetch();
			$ganadosActualmente = $results["ganados"] + 1;
			$ganadosSinStock = $results["ganadosSinStock"] + 1;
			$stock = $results["stock"];

			if ($stock != 0) {

				$actualizarPremio = Conexion::conectar()->prepare("UPDATE $tabla SET ganados = $ganadosActualmente WHERE id = '$idPremio'");
				$actualizarPremio->execute();
				$stmt = Conexion::conectar()->prepare("INSERT INTO ganadores(`idParticipante`,`idFactura`,`idPremio`,`ganado`) values($idParticipante,$idFactura,$idPremio,'1')");
			} else {
				$actualizarPremio = Conexion::conectar()->prepare("UPDATE $tabla SET ganadosSinStock = $ganadosSinStock WHERE id = '$idPremio'");
				$actualizarPremio->execute();
				$stmt = Conexion::conectar()->prepare("INSERT INTO ganadores(`idParticipante`,`idFactura`,`idPremio`,`ganado`) values($idParticipante,$idFactura,$idPremio,'0')");
			}
			if ($stmt->execute()) {
				return "ok";
			} else {
				return "error";
			}
		}


		$stmt->close();

		$stmt = null;
	}
	static public function mdlMostrarFacturasRegistradas($tabla, $idParticipante)
	{

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla where usuarioAsignado = '$idParticipante'");

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();

		$stmt = null;
	}
	static public function mdlBuscarPremiosGanados($tabla, $idParticipante)
	{

		$stmt = Conexion::conectar()->prepare("SELECT IF(MAX(idPremio) IS NULL,0,MAX(idPremio)) as premio FROM `ganadores` WHERE idParticipante = '$idParticipante'");

		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();

		$stmt = null;
	}
	static public function mdlBuscarPremiosGanadosLista($tabla, $idParticipante)
	{

		$stmt = Conexion::conectar()->prepare("SELECT idPremio,ganado FROM `ganadores` WHERE idParticipante = '$idParticipante'");

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();

		$stmt = null;
	}
}
