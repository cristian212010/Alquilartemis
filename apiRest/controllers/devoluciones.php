<?php

header('Content-Type: application/json');

require_once("../config/Conectar.php");
require_once("../models/devolucion.php");

$devolucion = new Devolucion();

$body = json_decode(file_get_contents("php://input"),true);

switch ($_GET['op']) {
    case 'GetAll':
        $datos = $devolucion->get_devolucion();
        echo json_encode($datos);
        break;
    case 'GetId':
        $datos = $devolucion->get_devolucion_id($body['entrada_id']);
        echo json_encode($datos);
        break;
    case 'insert':
        $datos = $devolucion->insert_devolucion($body['salida_id'],$body['empleado_id'], $body['cliente_id'], $body['fecha_entrada'], $body['hora_entrada'], $body['observaciones']);
        echo json_encode("Insertado correctamente");
        break;
    case 'delete':
        $datos = $devolucion->delete_devolucion($body['entrada_id']);
        echo json_encode("Devolucion eliminado");
        break;
    case 'update':
        $datos = $devolucion->update_devolucion($body['entrada_id'],$body['salida_id'], $body['empleado_id'], $body['cliente_id'], $body['fecha_entrada'], $body['hora_entrada'], $body['observaciones']);
        echo json_encode("devolucion actualizado");
        break;
    default:
        break;
}

?>