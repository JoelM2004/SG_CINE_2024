<?php

namespace app\core\controller;

use app\core\controller\base\Controller;
use app\libs\pay\MercadoPago;
use app\libs\request\Request;
use app\libs\response\Response;


final class PayController extends Controller
{

    public function __construct()
    {
        parent::__construct([
            "app/js/pay/payController.js",
              "app/js/pay/payService.js",
              "assets/libs/js/viewPay.js",
              "assets/libs/css/viewPay.css"

        ]);
    }


    public function index(): void
    {
        $this->view = "pay/mercadopago.php";
        $breadcrumbActual="Pagos";
        $breadcrumbLink=APP_FRONT."inicio/index";
        $breadcrumbPasada="Menú Principal";
        // $titulo = "Bienvenido";
        // $breadcrumb = "Menú Principal";
        require_once APP_TEMPLATE . "template.php";
    }

    public function success(): void
    {
        $this->view = "pay/success.php";
        $breadcrumbActual="Pagos";
        $breadcrumbLink=APP_FRONT."inicio/index";
        $breadcrumbPasada="Menú Principal";
        // $titulo = "Bienvenido";
        // $breadcrumb = "Menú Principal";
        require_once APP_TEMPLATE . "template.php";
    }

    

    public function generarPago(Request $request, Response $response): void{
        $data = $request->getData();

        MercadoPago::generarPago($data);

        $response->setMessage("OK");
        $response->send();
    }

  
}