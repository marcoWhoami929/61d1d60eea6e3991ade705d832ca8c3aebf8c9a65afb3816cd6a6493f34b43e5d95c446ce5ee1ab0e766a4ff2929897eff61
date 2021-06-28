<?php
require_once "conexion.php";

/**
 * 
 */
class ModeloFunciones
{

	static public function mdlRegistrarParticipantes($tabla,$array){

		require_once "encriptador.php";

		$passwordEncrypt = $encriptar($array["password"]);

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(`nombre`,`apellidoPaterno`,`apellidoMaterno`,`correo`,`password`,`celular`,`telefono`,`calle`,`numeroInterior`,`numeroExterior`,`colonia`,`municipio`,`estado`,`ciudad`,`pais`,`cp`,`coordenadas`,`comprasRegistradas`,`montoAcumulado`,`clasificacion`) values(:nombre,:apellidoP,:apellidoM,:correo,'".$passwordEncrypt."',:celular,:telefono,:calle,:numInterior,:numExterior,:colonia,:municipio,:estado,:ciudad,'MEXICO',:cp,:coordenadas,'0','0','0')");
	

			$stmt -> bindParam(":nombre", $array["nombre"],PDO::PARAM_STR);
			$stmt -> bindParam(":apellidoP", $array["apellidoP"],PDO::PARAM_STR);
			$stmt -> bindParam(":apellidoM", $array["apellidoM"],PDO::PARAM_STR);
			$stmt -> bindParam(":correo", $array["correo"],PDO::PARAM_STR);
			$stmt -> bindParam(":telefono", $array["telefono"],PDO::PARAM_STR);
			$stmt -> bindParam(":celular", $array["celular"],PDO::PARAM_STR);
			$stmt -> bindParam(":calle", $array["calle"],PDO::PARAM_STR);
			$stmt -> bindParam(":numInterior", $array["numInterior"],PDO::PARAM_STR);
			$stmt -> bindParam(":numExterior", $array["numExterior"],PDO::PARAM_STR);
			$stmt -> bindParam(":colonia", $array["colonia"],PDO::PARAM_STR);
			$stmt -> bindParam(":municipio", $array["municipio"],PDO::PARAM_STR);
			$stmt -> bindParam(":estado", $array["estado"],PDO::PARAM_STR);
			$stmt -> bindParam(":ciudad", $array["ciudad"],PDO::PARAM_STR);
			$stmt -> bindParam(":cp", $array["cp"],PDO::PARAM_STR);
			$stmt -> bindParam(":coordenadas", $array["coordenadas"],PDO::PARAM_STR);

			if ($stmt -> execute()) {
				return "ok";
			}else{
				return "error";
			}

			$stmt -> close();

			$stmt = null;
			
	}
	static public function mdlValidarUsuario($tabla,$item,$valor){

		$stmt = Conexion::conectar()->prepare("SELECT correo FROM $tabla WHERE $item = :$item");
		
		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt -> execute();

		$cuenta = $stmt->rowCount();

		if ($cuenta > 0) {
			return "existe";
		}else{
			return "no existe";
		}

		$stmt -> close();

		$stmt = null;
	}
	static public function mdlMostrarAdministradores($tabla, $item, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt-> close();

		$stmt = null;

	}
	static public function mdlMostrarTotalBoletos($tabla,$idParticipante){

		$stmt = Conexion::conectar()->prepare("SELECT count(id) as total FROM $tabla WHERE idParticipante = $idParticipante");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt-> close();

		$stmt = null;

	}
	static public function mdlMostrarTotalCompras($tabla,$idParticipante){

		$stmt = Conexion::conectar()->prepare("SELECT comprasRegistradas,montoAcumulado FROM $tabla WHERE id = $idParticipante");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt-> close();

		$stmt = null;

	}
	static public function mdlMostrarBoletosObtenidos($tabla,$idParticipante){

		$stmt = Conexion::conectar()->prepare("SELECT fecha,folioBoleto  FROM $tabla WHERE idParticipante = $idParticipante");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt-> close();

		$stmt = null;

	}
	static public function mdlMostrarCompras($tabla,$idParticipante){
		$consulta = Conexion::conectar()->prepare("SELECT COUNT(id) as total from boletos where idParticipante = $idParticipante");

		$consulta -> execute();
		$total = $consulta->fetch();
		$totalBoletos = $total["total"];
		if ($totalBoletos == 0) {
			$stmt = Conexion::conectar()->prepare("SELECT fac.serie,fac.folio,fac.total,fac.fechaFactura FROM $tabla as bol INNER JOIN facturas as fac ON bol.idFactura = fac.id WHERE bol.idParticipante = $idParticipante");
		}else{

			$stmt = Conexion::conectar()->prepare("SELECT fac.serie,fac.folio,fac.total,fac.fechaFactura FROM $tabla as bol INNER JOIN facturas as fac ON bol.idFactura = fac.id WHERE bol.idParticipante = $idParticipante GROUP by fac.serie,fac.folio,fac.total,fac.fechaFactura");

		}
		

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt-> close();

		$stmt = null;

	}

	static public function mdlBuscarCompraRegistrada($tabla,$serie,$folio){

		$stmt = Conexion::conectar()->prepare("SELECT elegida FROM $tabla WHERE serie = '$serie' and folio = $folio");

		$stmt -> execute();

		if ($stmt ->rowCount() > 0) {
			
			$results = $stmt->fetch();
			$elegida = $results["elegida"];
			if ($elegida == 1) {
				
				return "registrada";

			}else{

				return "no registrada";

			}

		}else{

			return "no existe";


		}
		
		$stmt-> close();

		$stmt = null;

	}
	static public function mdlRegistrarCompra($tabla,$serie,$folio){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET elegida = 1 WHERE serie = '$serie' and folio = $folio");

		$stmt ->execute();

		$cuenta = $stmt->rowCount();

		if($cuenta > 0){

			return "ok";

		}else{

			return "error";

		}
		$stmt-> close();

		$stmt = null;

	}
	static public function mdlObtenerDatosFactura($tabla,$serie,$folio){

		$stmt = Conexion::conectar()->prepare("SELECT id,total FROM $tabla WHERE serie = '$serie' and folio = $folio");

		$stmt ->execute();

		return $stmt -> fetch();

		$stmt-> close();

		$stmt = null;
	
	}
	static public function mdlObtenerDatosParticipante($tabla,$idParticipante){

		$stmt = Conexion::conectar()->prepare("SELECT montoAcumulado,comprasRegistradas FROM $tabla WHERE id = $idParticipante");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt-> close();

		$stmt = null;

	}
	static public function mdlActualizarParticipante($tabla,$idParticipante,$comprasRegistradas,$montoAcumulado){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET comprasRegistradas = $comprasRegistradas,montoAcumulado = $montoAcumulado WHERE id = $idParticipante");

		$stmt ->execute();

		$cuenta = $stmt->rowCount();

		if($cuenta > 0){

			return "ok";

		}else{

			return "error";

		}
		$stmt-> close();

		$stmt = null;

	}
	static public function mdlRegistrarBoleto($tabla,$idParticipante,$idFactura){

		$ultimoFolio = Conexion::conectar()->prepare("SELECT if(MAX(folioBoleto)+1 IS NULL,1001,MAX(folioBoleto)+1) as folio FROM $tabla");
		$ultimoFolio -> execute();
		$results = $ultimoFolio->fetch();
		$folioBoleto = $results["folio"];

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(`idParticipante`,`idFactura`,`folioBoleto`) values($idParticipante,$idFactura,$folioBoleto)");

		if ($stmt -> execute()) {
				return "ok";
		}else{
				return "error";
		}

		$stmt-> close();

		$stmt = null;

	}
	static public function mdlObtenerBoletosGanados($tabla,$idParticipante,$idFactura){

		$stmt = Conexion::conectar()->prepare("SELECT folioBoleto FROM $tabla WHERE idParticipante = $idParticipante and idFactura = $idFactura");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt-> close();

		$stmt = null;

	}
	static public function mdlMostrarTotalAcumulado($tabla,$idParticipante){

		$stmt = Conexion::conectar()->prepare("SELECT facturasRegistradas,premio1,premio2,premio3,premio4 FROM $tabla WHERE id = $idParticipante");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt-> close();

		$stmt = null;

	}
	static public function mdlBuscarPremios($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt-> close();

		$stmt = null;

	}

}
