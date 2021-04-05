<header class="header-area">
        <div class="navbar-area navbar-two">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg">
                            <a class="navbar-brand" href="index.html">
                                <img src="vistas/assets/images/logo.png" alt="Logo">
                            </a>

                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTwo" aria-controls="navbarTwo" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarTwo">
                                <ul class="navbar-nav m-auto">
                                    <li class="nav-item active">
                                        <a class="page-scroll" href="#home">Inicio</a>
                                    </li>
                                    
                                    <li class="nav-item">
                                        <a class="page-scroll" href="#pasos">Pasos</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="#premios">Premios</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="#contacto">Contactanos</a>

                                    </li>
                                    <li class="nav-item">

                                        <?php 

                                            if (isset($_SESSION["validarSesionBackend"]) && $_SESSION["validarSesionBackend"] === "ok") {

                                                echo "<a class='page-scroll' href='dashboard'>Mi Perfil</a>";

                                            }else{

                                                echo "<a class='page-scroll' href='#' data-toggle='modal' data-target='#modalRegistro'>Registrarme</a>";

                                            }
                                        ?>
                                      

                                    </li>
                                    <li class="nav-item">
                                        <?php 

                                            if (isset($_SESSION["validarSesionBackend"]) && $_SESSION["validarSesionBackend"] === "ok") {
                                                
                                            }else{

                                                echo "<a class='page-scroll' href='#' data-toggle='modal' data-target='#modalAcceso'>Acceder</a>";

                                            }
                                        ?>
                                        
                                        
                                    </li>
                                   
                                </ul>
                            </div>

                           
                        </nav> <!-- navbar -->
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
        </div>

       
    </header>