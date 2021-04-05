<?php
require_once "../controladores/funciones.controlador.php";
require_once "../modelos/funciones.modelo.php";

class AjaxFuncionesSorteo{

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

	public function ajaxRegistrarParticipantes(){

		$tabla = "participantes";

		$array = array('nombre' => $this->nombre,
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
						'ciudad' => $this->ciudad);

		$respuesta = ControladorFunciones::ctrRegistrarParticipantes($tabla,$array);

		echo json_encode($respuesta);

	}
	public $correoRegistro;
	public function ajaxValidarCorreo(){

		$tabla = "participantes";
		$item = "correo";
		$valor = $this->correoRegistro;
		$respuesta = ControladorFunciones::ctrValidarUsuario($tabla,$item,$valor);

		echo json_encode($respuesta);

	}

	public $correoAcceso;
	public $passwordAcceso;
	public function ajaxAccesoParticipante(){

		$tabla = "participantes";

		$correo = $this->correoAcceso;
		$password = $this->passwordAcceso;
		$respuesta = ControladorFunciones::ctrIngresoAdministrador($tabla,$correo,$password);

		echo json_encode($respuesta);

	}
	public $serieCompra;
	public $folioCompra;
	public function ajaxBuscarFactura(){

		$serie = $this->serieCompra;
		$folio = $this->folioCompra;
		$respuesta = ControladorFunciones::ctrBuscarCompraRegistrada($serie,$folio);

		echo json_encode($respuesta);

	}


}
if (isset($_POST["nombre"])) {

	$registrar = new AjaxFuncionesSorteo();
	$registrar -> nombre = $_POST["nombre"];
	$registrar -> apellidoP = $_POST["apellidoP"];
	$registrar -> apellidoM = $_POST["apellidoM"];
	$registrar -> correo = $_POST["correo"];
	$registrar -> password = $_POST["password"];
	$registrar -> telefono = $_POST["telefono"];
	$registrar -> celular = $_POST["celular"];
	$registrar -> calle = $_POST["calle"];
	$registrar -> numInterior = $_POST["numInterior"];
	$registrar -> numExterior = $_POST["numExterior"];
	$registrar -> colonia = $_POST["colonia"];
	$registrar -> municipio = $_POST["municipio"];
	$registrar -> estado = $_POST["estado"];
	$registrar -> ciudad = $_POST["ciudad"];
	$registrar -> ajaxRegistrarParticipantes();
}
if (isset($_POST["correoRegistro"])) {

	$validar = new AjaxFuncionesSorteo();
	$validar -> correoRegistro = $_POST["correoRegistro"];
	$validar -> ajaxValidarCorreo();
	
}
if (isset($_POST["correoAcceso"])) {

	$acceder = new AjaxFuncionesSorteo();
	$acceder -> correoAcceso = $_POST["correoAcceso"];
	$acceder -> passwordAcceso = $_POST["passwordAcceso"];
	$acceder -> ajaxAccesoParticipante();
	
}
if (isset($_POST["serieCompra"])) {

	$buscarCompra = new AjaxFuncionesSorteo();
	$buscarCompra -> serieCompra = $_POST["serieCompra"];
	$buscarCompra -> folioCompra = $_POST["folioCompra"];
	$buscarCompra -> ajaxBuscarFactura();
	
}

?>