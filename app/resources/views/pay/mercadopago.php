<?php

use app\libs\pay\MercadoPago;

// Datos de prueba para generar la preferencia
$datos = [
    "id" => "1234",
    "title" => "Entrada para Los Pollos Hermanos",
    "quantity" => 1,
    "unit_price" => 1,
    "external_reference" => "REF12345"
];

// Generar la preferencia de pago usando la clase MercadoPago y guardar el ID de la preferencia
$mp = MercadoPago::generarPago($datos);

?>

<div class="payment-section">
    <h2>Finalizar Compra</h2>
    <p id="texto">Confirma tu compra y procede con el pago seguro a través de Mercado Pago.</p>

    <div id="wallet_container"></div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Usar la clave pública definida en el servidor
            const mp = new MercadoPago(<?= '"' . MP_PUBLICA . '"' ?>, {
                locale: "es-MX"
            });

            const pagos = () => {
                mp.bricks().create("wallet", "wallet_container", {
                    initialization: {
                        preferenceId: "<?= $mp->id ?>" // ID de preferencia generado en PHP
                    },
                    customization: {
                        texts: {
                            action: "buy",
                            valueProp: "security_safety"
                        },
                        visual: {
                            buttonBackground: 'black',
                            valuePropColor:"black",
                        }
                    }
                });
            };

            pagos(); // Ejecutar la función pagos al cargar el DOM
        });
    </script>
</div>



