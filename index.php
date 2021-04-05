<?php

require_once "controladores/plantilla.controlador.php";
require_once "controladores/funciones.controlador.php";


require_once "modelos/funciones.modelo.php";
require_once "modelos/rutas.php";

$plantilla = new ControladorPlantilla();
$plantilla -> plantilla();