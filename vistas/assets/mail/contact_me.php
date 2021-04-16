<?php
$nombre = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$telefono = $_POST['phone'];
$mensaje = $_POST['message'];
$string="<br> Usuario:".$nombre." <br>Correo de Contacto: ".$email."<br>Telefono de contacto: ".$telefono."<br>Mensaje:  " .$mensaje;

set_time_limit(0);
ignore_user_abort(true);
/*RECOGER VALORES ENVIADOS DESDE INDEX.PHP*/
$email = "mm_marco_mar@hotmail.com";
$sDestino = $email;
        // Create the email and send the message
        $to = $email; // Add your email address inbetween the '' replacing yourname@yourdomain.com - Aquí es donde el formulario enviará un mensaje a.
        $email_subject = "".$subject."";
        $email_body = $string;
        $headers = "From:CONTACTO | RIFAS <dekkerapp@sanfranciscodekkerlab.com>\n";
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
                        return true; 
                    } else {
                        $errorMessage = error_get_last()['message'];
                        echo $errorMessage;
                    }

                    

                    ?>