<?php
namespace app\libs\pay;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Resources\Preference;

final class MercadoPago {

    public static function generarPago(array $datos) : Preference {
        MercadoPagoConfig::setAccessToken(MP_PRIVADA);

        $client = new PreferenceClient();
        $backUrls=[
            "success"=> APP_FRONT."pay/success.php",
            "failure"=> APP_FRONT."pay/fail.php",
            "pending"=> APP_FRONT."pay/pending.php"
        ];
        // Configurar la preferencia usando los datos del array $datos
        $preference = $client->create([
            "items" => [
                [
                    "id" => $datos['id'] ?? "",
                    "title" => $datos['title'] ?? "",
                    "quantity" => $datos['quantity'] ?? 0, // Valor por defecto: 1
                    "unit_price" => $datos['unit_price'] ?? 0.0 // Valor por defecto: 0.0
                ]
            ],

            "back_urls"=>$backUrls,
            "auto_return"=>"approved",

            "statement_descriptor" => "Los Pollos Hermanos",
            "external_reference" => $datos['external_reference'] ?? ""
        ]);

        return $preference;
    }
}

