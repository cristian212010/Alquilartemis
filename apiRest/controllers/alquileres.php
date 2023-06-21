<?php

header('Content-Type: application/json');

require_once("../config/Conectar.php");
require_once("../models/alquiler.php");

$alquiler = new Alquiler();

$body = json_decode(file_get_contents("php://input"),true);

switch ($_GET['op']) {
    case 'GetAll':
        $datos=$alquiler->get_alquiler();
        echo json_encode($datos);
        break;
    case 'GetId':
        $datos = $alquiler->get_alquiler_id($body['salida_id']);
        echo json_encode($datos);
        break;
    case 'insert':
        $datos = $alquiler->insert_alquiler($body['cliente_id'], $body['empleado_id'], $body['fecha_salida'], $body['hora_salida'], $body['subtotalPeso'], $body['placatransporte'], $body['observaciones']);
        echo json_encode("Insertado correctamente");
        break;
     case 'delete':
        $datos = $alquiler->delete_alquiler($body['salida_id']);
        echo json_encode("Alquiler eliminado");
        break;
    case 'update':
        $datos = $alquiler->update_alquiler($body['salida_id'],$body['cliente_id'], $body['empleado_id'], $body['fecha_salida'], $body['hora_salida'], $body['subtotalPeso'], $body['placatransporte'],$body['observaciones']);
        echo json_encode("Alquiler actualizado");
        break;
    default:
        break;
}

?>