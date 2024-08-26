<?php

use app\core\model\dao\PeliculaDAO;
use app\core\model\dao\UsuarioDAO;
use app\core\model\dao\FuncionDAO;
use app\core\model\dao\EntradaDAO;

use app\libs\connection\Connection;

$conn = Connection::get();

$daoPelicula = new PeliculaDAO($conn);

$daoUsuario = new UsuarioDAO($conn);
$datosUsuario = $daoUsuario->list();

$daoFuncion = new FuncionDAO($conn);
$datosFuncion = $daoFuncion->list();
$datosFuncion = array_reverse($datosFuncion);

$daoEntrada = new EntradaDAO($conn);
$datoEntrada = $daoEntrada->load($_GET["id"]);

function formatDate($date) {
    // Verificar si el formato contiene una hora
    if (strpos($date, ' ') !== false) {
        // Separar la fecha y la hora
        list($datePart, $timePart) = explode(' ', $date);
        $dateParts = explode('-', $datePart);
        $timeParts = explode(':', $timePart);

        // Verificar y formatear la fecha
        $formattedDate = isset($dateParts[2], $dateParts[1], $dateParts[0]) ? "{$dateParts[2]}/{$dateParts[1]}/{$dateParts[0]}" : $datePart;

        // Verificar y formatear la hora
        $formattedTime = isset($timeParts[0], $timeParts[1]) ? " a las {$timeParts[0]}:{$timeParts[1]}" : $timePart;

        return "{$formattedDate} {$formattedTime}";
    } else {
        // Si no hay hora, solo formatear la fecha
        $parts = explode('-', $date);
        return isset($parts[2], $parts[1], $parts[0]) ? "{$parts[2]}/{$parts[1]}/{$parts[0]}" : $date;
    }
}
?>
<div class="container-fluid row">
    <!-- Tabla de Entradas -->
    <div class="col-lg-12 p-4">
        <h4 class="text-secondary">Listado de Entradas</h4>

        <table id="tablaEntradas" class="table table-light">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Número de Función</th>
                    <th scope="col">Fecha y Hora de la Función</th>
                    <th scope="col">Fecha y Hora de la Venta</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Número de Ticket</th>
                    <th scope="col">Cuenta del Cliente</th>
                    <th scope="col">Estado</th>
                </tr>
            </thead>
            <tbody id="tbodyEntradas" data-id=<?=$_GET["id"]?> data-funcion=<?=$datoEntrada->getFuncionId()?>>
                <tr>
                    <td scope="col">1</td>
                    <td scope="col"><?= $daoFuncion->load($datoEntrada->getFuncionId())->getNumeroFuncion() ?></td>
                    <td scope="col"><?= formatDate($datoEntrada->getHoraFuncion()) ?></td>
                    <td scope="col"><?= formatDate($datoEntrada->getHoraVenta()) ?></td>
                    <td scope="col"><?= $datoEntrada->getPrecio() ?></td>
                    <td scope="col"><?= $datoEntrada->getNumeroTicket() ?></td>
                    <td scope="col"><?= $daoUsuario->load($datoEntrada->getUsuarioId())->getCuenta() ?></td>
                    <td scope="col">
                        <?php
                        if ($datoEntrada->getEstado() == 1) {
                            echo "<i class='fas fa-circle text-success' title='Activo'></i>";
                        } else {
                            echo "<i class='fas fa-circle text-danger' title='Desactivado'></i>";
                        }
                        ?>
                    </td>

                </tr>
            </tbody>
        </table>

        <div class="d-flex justify-content-end mt-3">
            <button type="button" id="btnToggleEntrada" value="<?php
                        if ($datoEntrada->getEstado() == 0) {
                            echo 1;
                        } else {
                            echo 0;
                        }
                        ?>
                        
                    </button>" class="btn btn-primary">
                        
                        <?php
                        if ($datoEntrada->getEstado() == 0) {
                            echo "Activar Entrada";
                        } else {
                            echo "Desactivar Entrada";
                        }
                        ?></button>
        </div>
    </div>
</div>