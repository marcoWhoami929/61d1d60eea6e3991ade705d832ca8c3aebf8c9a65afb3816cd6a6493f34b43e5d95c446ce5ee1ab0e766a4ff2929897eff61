<?php
session_start();
require_once "../../controladores/funciones.controlador.php";
require_once "../../modelos/funciones.modelo.php";
set_time_limit(0);
ignore_user_abort(true);

		$serie = $_POST["serieCompraSend"];
		$folio = $_POST["folioCompraSend"];
		$respuesta = ControladorFunciones::ctrObtenerDatosFactura($serie,$folio);
		$idFactura = $respuesta["id"];

		$idParticipante = $_SESSION["id"];

		$buscarBoletosGanados = ControladorFunciones::ctrObtenerBoletosGanados($idParticipante,$idFactura);

			$string="<br> Gracias por haber registrado tu compra, a continuación se detallarán los boletos registrados:";
			
			foreach ($buscarBoletosGanados as $key => $value) {
				
				$value = $value["folioBoleto"];
			}
			
			$string2 = $value;

			
			
			$correo = "mm_marco_mar@hotmail.com";
			$email = $correo;
			$sDestino = $email;
			        // Create the email and send the message
			        $to = $email; // Add your email address inbetween the '' replacing yourname@yourdomain.com - Aquí es donde el formulario enviará un mensaje a.
			        $email_subject = "Hola ".$_SESSION["nombre"]."";
			        $subject = $email_subject;
			        $email_body = $string.$string2;
			        $headers = "From:MIS BOLETOS | RIFA <dekkerapp@sanfranciscodekkerlab.com>\n"; 
			        $headers .= "MIME-Version: 1.0r\n";
			        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

			          $rcss = "../../../complementos/plantilla/estilo.css";//ruta de archivo css
                    $fcss = fopen ($rcss, "r");//abrir archivo css
                    $scss = fread ($fcss, filesize ($rcss));//leer contenido de css
                    fclose ($fcss);//cerrar archivo css

                //reemplazar sección de plantilla html con el css cargado y mensaje creado
                    $shtml = file_get_contents('../../../complementos/plantilla/contacto.html');
                    $incss  = str_replace('<style id="estilo"></style>',"<style>$scss</style>",$shtml);
                    $cuerpo = str_replace('<p id="mensaje"></p>',$email_body,$incss);


                   	 if(mail($to, $subject, $cuerpo, $headers)) {
                        $accion = "enviado";
                    } else {
                        $errorMessage = error_get_last()['message'];
                        $accion = $errorMessage;
                    }

					echo json_encode($accion);

?>