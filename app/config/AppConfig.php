<?php

//En esta parte determino las configuraciones y constantes que usaré a lo largo del programa

define("APP_URI", $_SERVER["DOCUMENT_ROOT"]."/SG_CINE_2024/app/");
define("APP_FRONT","http://localhost/SG_CINE_2024/public/");
define("APP_URL", $_SERVER["DOCUMENT_ROOT"]."/lp_practica_php/public/");
define("APP_TEMPLATE", APP_URI."resources/template/");
define("APP_VIEWS",APP_URI. "resources/views/");
define("APP_CONTROLLERS",APP_URI. "core/controller/");


const CORREO="caletaolivia675@gmail.com";
CONST CLAVECORREO="gtub kjcq ycvp aaln";
CONST APP_TOKEN="CLAVE_SECRETA";
CONST APP_DEFAULT_CONTROLLER = "inicio";
CONST APP_DEFAULT_ACTION = "index";