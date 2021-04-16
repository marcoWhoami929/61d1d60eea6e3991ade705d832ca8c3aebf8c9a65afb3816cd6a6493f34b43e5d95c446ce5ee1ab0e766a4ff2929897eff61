// Contact Form Scripts

$(function() {

    $("#contact-form input,#contact-form textarea").jqBootstrapValidation({
        preventSubmit: true,
        submitError: function($form, event, errors) {
            // additional error messages or events
        },
        submitSuccess: function($form, event) {
            event.preventDefault(); // prevent default submit behaviour
            // get values from FORM
            var name = $("input#name").val();
            
            var email = $("input#email").val();

            var subject = $("input#subject").val();
            var phone = $("input#number").val();
            var message = $("textarea#message").val();
            var firstName = name; // For Success/Failure Message
            // Check for white space in name for Success/Fail message
            if (firstName.indexOf(' ') >= 0) {
                firstName = name.split(' ').slice(0, -1).join(' ');
            }

            
            $.ajax({
                url: "vistas/assets/mail/contact_me.php",
                type: "POST",
                data: {
                    name: name,
                    phone: phone,
                    email: email,
                    message: message,
                    subject: subject
                },
                cache: false,
                success: function() {
                    // Success message
                    $('#success').html("<div class='alert alert-success'>");
                    $('#success > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                        .append("</button>");
                    $('#success > .alert-success')
                        .append("<strong>Su mensaje ha sido enviado correctamente </strong>");
                    $('#success > .alert-success')
                        .append('</div>');

                    //clear all fields
                    $('#contact-form').trigger("reset");
                },
                error: function() {
                    // Fail message
                    $('#success').html("<div class='alert alert-danger'>");
                    $('#success > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                        .append("</button>");
                    $('#success > .alert-danger').append($("<strong>").text("Lo siento" + firstName + ", el servidor de correos no responde . Porfavor intente despues!"));
                    $('#success > .alert-danger').append('</div>');
                    //clear all fields
                    $('#contact-form').trigger("reset");
                },
            });
            
        },
        filter: function() {
            return $(this).is(":visible");
        },
    });

    $("#formRegister input").jqBootstrapValidation({
        preventSubmit: true,
        submitError: function($form, event, errors) {
            // additional error messages or events
        },
        submitSuccess: function($form, event) {
            event.preventDefault(); // prevent default submit behaviour
            // get values from FORM
            var nombre = $("input#nombre").val();
            var apellidoP = $("input#apellidoP").val();
            var apellidoM = $("input#apellidoM").val();
            var correo = $("input#correo").val();
            var password = $("input#password").val();
            var telefono = $("input#telefono").val();
            var celular = $("input#celular").val();
            var calle = $("input#route").val();
            var numInterior = $("input#street_number").val();
            var numExterior = $("input#numExterior").val();
            var colonia = $("input#sublocality_level_1").val();
            var municipio = $("input#administrative_area_level_1").val();
            var estado = $("input#administrative_area_level_1").val();
            var ciudad = $("input#locality").val();
            var cp = $("input#postal_code").val();
            var coordenadas = $("input#coordenadas").val();
            
            if (nombre.indexOf(' ') >= 0) {
                //nombre = name.split(' ').slice(0, -1).join(' ');
            }
            var isChecked = document.getElementById('aceptarTerminos').checked;
            if(isChecked){
            $.ajax({
                url: "ajax/funciones.ajax.php",
                type: "POST",
                data: {
                    correoRegistro:correo

                },
                cache: false,
                success: function(response) {

                    var respuesta = response;
                    var respuestaFinal = respuesta.replace(/['"]+/g, '');
                    if (respuestaFinal == "no existe") {

                          $.ajax({
                            url: "ajax/funciones.ajax.php",
                            type: "POST",
                            data: {
                                nombre: nombre.toUpperCase(),
                                apellidoP: apellidoP.toUpperCase(),
                                apellidoM: apellidoM.toUpperCase(),
                                correo: correo,
                                password: password,
                                telefono: telefono,
                                celular: celular,
                                calle: calle.toUpperCase(),
                                numInterior: numInterior,
                                numExterior: numExterior,
                                colonia: colonia.toUpperCase(),
                                municipio: municipio.toUpperCase(),
                                estado: estado.toUpperCase(),
                                ciudad: ciudad.toUpperCase(),
                                cp: cp,
                                coordenadas:coordenadas
                            },
                            cache: false,
                            success: function(respuesta) {

                                var response = respuesta;
                                var responseFinal = response.replace(/['"]+/g, '');
                                if (responseFinal == "ok") {


                                    // Success message
                                    $('#successRegister').html("<div class='alert alert-success'>");
                                    $('#successRegister > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                                        .append("</button>");
                                    $('#successRegister > .alert-success')
                                        .append("<strong>Registro exitoso, de click en acceder para registrar su compra </strong>");
                                    $('#successRegister > .alert-success')
                                        .append('</div>');

                                    //clear all fields
                                    $('#formRegister').trigger("reset");
                                    setTimeout(function(){  $("#btnCerrarRegistro").click();  }, 3000);
                                   

                                }else{

                                     // Fail message
                                    $('#successRegister').html("<div class='alert alert-danger'>");
                                    $('#successRegister > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                                        .append("</button>");
                                    $('#successRegister > .alert-danger').append($("<strong>").text("Los datos no se registraron. Porfavor intente despues!"));
                                    $('#successRegister > .alert-danger').append('</div>');
                                    //clear all fields
                                    $('#formRegister').trigger("reset");
                                    setTimeout(function(){  $("#btnCerrarRegistro").click();  }, 3000);
                                  

                                }

                            }
                        });


                    }else{

                         // Fail message
                        $('#successRegister').html("<div class='alert alert-danger'>");
                        $('#successRegister > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                            .append("</button>");
                        $('#successRegister > .alert-danger').append($("<strong>").text("Ya se encuentra registrada una cuenta con ese correo"));
                        $('#successRegister > .alert-danger').append('</div>');
                        //clear all fields
                        //$('#formRegister').trigger("reset");
                        setTimeout(function(){  $("#btnCerrarRegistro").click();  }, 2000);
                      

                    }

                }
            });
            
             }else{

                  
            $('#successRegister').html("<div class='alert alert-danger'>");
            $('#successRegister > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;").append("</button>");
            $('#successRegister > .alert-danger').append($("<strong>").text("Debes aceptar los términos y condiciones, para completar tu registro."));
            $('#successRegister > .alert-danger').append('</div>');

            }

            /***/
            
        },
        filter: function() {
            return $(this).is(":visible");
        },
    });

    $("#formAccess input").jqBootstrapValidation({
        preventSubmit: true,
        submitError: function($form, event, errors) {
            // additional error messages or events
        },
        submitSuccess: function($form, event) {
            event.preventDefault(); // prevent default submit behaviour
            // get values from FORM
            var correoAcceso = $("input#correoAcceso").val();
            var passwordAcceso = $("input#passwordAcceso").val();
            
            $.ajax({
                 url: "ajax/funciones.ajax.php",
                type: "POST",
                data: {
                    correoAcceso: correoAcceso,
                    passwordAcceso: passwordAcceso
                    
                },
                cache: false,
                success: function(resp) {
                      var response = resp;
                      var responseFinal = response.replace(/['"]+/g, '');
                      if (responseFinal == "correcto") {

                         // Success message
                        $('#successAcces').html("<div class='alert alert-success'>");
                        $('#successAcces > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                            .append("</button>");
                        $('#successAcces > .alert-success')
                            .append("<strong>Datos correctos redireccionando al perfil.</strong>");
                        $('#successAcces > .alert-success')
                            .append('</div>');

                        //clear all fields
                        $('#formAccess').trigger("reset");
                        setTimeout(function(){  location.href = "dashboard"}, 1000);

                      }else{

                        // Fail message
                        $('#successAcces').html("<div class='alert alert-danger'>");
                        $('#successAcces > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                            .append("</button>");
                        $('#successAcces > .alert-danger').append($("<strong>").text("Contraseña incorrecta vuelve a ingresarla."));
                        $('#successAcces > .alert-danger').append('</div>');
                        //clear all fields
                        

                      }
                   
                }
            });
            
        },
        filter: function() {
            return $(this).is(":visible");
        },
    });

    $("#formRegisterSale input").jqBootstrapValidation({
        preventSubmit: true,
        submitError: function($form, event, errors) {
            // additional error messages or events
        },
        submitSuccess: function($form, event) {
            event.preventDefault(); // prevent default submit behaviour
            // get values from FORM
            var serieCompra = $("#serieCompra").val();
            var folioCompra = $("input#folioCompra").val();
            document.getElementById("btnRegister").style.display = "none";
            document.getElementById("spinner").style.display = "";
            
            $.ajax({
                 url: "ajax/funciones.ajax.php",
                type: "POST",
                data: {
                    serieCompra: serieCompra,
                    folioCompra: folioCompra
                    
                },
                cache: false,
                success: function(resp) {
                      var response = resp;
                      var responseFinal = response.replace(/['"]+/g, '');
                      if (responseFinal == "registrada") {
                        document.getElementById("btnRegister").style.display = "";
                        $('#successRegisterSale').html("<div class='alert alert-danger'>");
                        $('#successRegisterSale > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                            .append("</button>");
                         $('#successRegisterSale > .alert-danger').append("La compra ya se encuentra registrada.");
                        $('#successRegisterSale > .alert-danger').append('</div>');
                        
                        document.getElementById("spinner").style.display = "none";
                    
                      }else if(responseFinal == "no registrada"){
                        
                        $.ajax({
                             url: "ajax/funciones.ajax.php",
                            type: "POST",
                            data: {
                                 serieCompraRegistro: serieCompra,
                                 folioCompraRegistro: folioCompra
                                
                            },
                            cache: false,
                            success: function(response) {
                                  var respuesta = response;
                                  var responseRegistro = respuesta.replace(/['"]+/g, '');
                            
                                  if (responseRegistro == "exito") {

                                        $('#successRegisterSale').html("<div class='alert alert-success'>");
                                        $('#successRegisterSale > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                                            .append("</button>");
                                        $('#successRegisterSale > .alert-success')
                                            .append("Compra Registrada,Enviando correo electrónico de confirmación.");
                                        $('#successRegisterSale > .alert-success')
                                            .append('</div>');
                                        
                                        $.ajax({
                                             url: "vistas/assets/mail/confirmBoletos.php",
                                            type: "POST",
                                            data: {
                                                serieCompraSend: serieCompra,
                                                folioCompraSend: folioCompra
                                                
                                            },
                                            cache: false,
                                            success: function(resp) {
                                                 // Success message
                                                    $('#successAcces').html("<div class='alert alert-success'>");
                                                    $('#successAcces > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                                                        .append("</button>");
                                                    $('#successAcces > .alert-success')
                                                        .append("<strong>Correo enviado exitosamente..</strong>");
                                                    $('#successAcces > .alert-success')
                                                        .append('</div>');

                                                    //clear all fields
                                                    $('#formRegisterSale').trigger("reset");
                                                    document.getElementById("btnRegister").style.display = "";
                                                    document.getElementById("spinner").style.display = "none";
                                                    setTimeout(function(){  location.href = "dashboard"}, 1000);
                                               
                                            }
                                        });
                                      

                                  }else if(responseRegistro == "errorregistro"){

                                        document.getElementById("btnRegister").style.display = "";
    
                                        $('#successRegisterSale').html("<div class='alert alert-danger'>");
                                        $('#successRegisterSale > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                                            .append("</button>");
                                        $('#successRegisterSale > .alert-danger').append("La factura aun no pudo ser registrada, intentelo mas tarde.");
                                        
                                        $('#successRegisterSale > .alert-danger').append('</div>');

                                        $('#formRegisterSale').trigger("reset");
                                        document.getElementById("spinner").style.display = "none";  
                                       

                                  }else if(responseRegistro == "errormonto"){

                                        document.getElementById("btnRegister").style.display = "";
                                        $('#successRegisterSale').html("<div class='alert alert-danger'>");
                                        $('#successRegisterSale > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                                            .append("</button>");
                                        $('#successRegisterSale > .alert-danger').append("No se pudo registrar porque el monto es inferior a la compra mínima.");
                                        
                                        $('#successRegisterSale > .alert-danger').append('</div>');
                                        $('#formRegisterSale').trigger("reset");
                                        document.getElementById("spinner").style.display = "none";  

                                    

                                  }
                               
                            }
                        });


                      }else if(responseFinal == "no existe"){
                        document.getElementById("btnRegister").style.display = "";
                        $('#successRegisterSale').html("<div class='alert alert-danger'>");
                        $('#successRegisterSale > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                            .append("</button>");
                        $('#successRegisterSale > .alert-danger').append("La factura aun no se encuentra disponible para ser registrada, intentelo mas tarde.");
                        
                        $('#successRegisterSale > .alert-danger').append('</div>');
                        
                        document.getElementById("spinner").style.display = "none";


                      }
                   
                }
            });
            
            
        },
        filter: function() {
            return $(this).is(":visible");
        },
    });
    
});


