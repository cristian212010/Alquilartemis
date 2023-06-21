<?php

header('Content-Type: application/json');

require_once("../config/Conectar.php");
require_once("../models/salidaDetalle.php");

$salida = new SalidaDetalle();

$body = json_decode(file_get_contents("php://input"),true);

switch ($_GET['op']) {
    case 'GetAll':
        $datos = $salida->get_salidaDetalle();
        echo json_encode($datos);
        break;
    case 'GetId':
        $datos = $salida->get_salidaDetalle_id($body['salida_detalle_id']);
        echo json_encode($datos);
        break;
    case 'insert':
        $datos = $salida->insert_salidaDetalle($body['salida_id'], $body['producto_id'], $body['empleado_id'], $body['obra_id'], $body['cantidad_salida'], $body['cantidad_propia'],$body['cantidad_subalquilada'], $body['valorUnidad'], $body['fecha_standBye'], $body['estado'], $body['valorTotal']);
        echo json_encode("Insertado correctamente");
        break;
    case 'delete':
        $datos = $salida->delete_salidaDetalle($body['salida_detalle_id']);
        echo json_encode("Detalle alquiler eliminado");
        break;
    case 'update':
        $datos = $salida->update_salidaDetalle($body['salida_detalle_id'],$body['salida_id'],$body['producto_id'],$body['empleado_id'],$body['obra_id'],$body['cantidad_salida'],$body['cantidad_propia'],$body['cantidad_subalquilada'],$body['valorUnidad'],$body['fecha_standBye'],$body['estado'],$body['valorTotal']);
        echo json_encode("Detalle alquiler actualizado");
        break;
    default:
        break;
}

?>