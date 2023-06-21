<?php

header('Content-Type: application/json');

require_once("../config/Conectar.php");
require_once("../models/entradaDetalle.php");

$entradaDetalle = new EntradaDetalle();

$body = json_decode(file_get_contents("php://input"),true);

switch ($_GET['op']) {
    case 'GetAll':
        $datos = $entradaDetalle->get_entradaDetalle();
        echo json_encode($datos);
        break;
    case 'GetId':
        $datos = $entradaDetalle->get_entradaDetalle_id($body['entrada_detalle_id']);
        echo json_encode($datos);
        break;
    case 'insert':
        $datos = $entradaDetalle->insert_entradaDetalle($body['entrada_id'], $body['producto_id'], $body['obra_id'], $body['entrada_cantidad'], $body['entrada_cantidad_propia'], $body['entrada_cantidad_subalquilada'], $body['estado']);
        echo json_encode("Insertado correctamente");
        break;
    case 'delete':
        $datos = $entradaDetalle->delete_entradaDetalle($body['entrada_detalle_id']);
        echo json_encode("entradaDetalle eliminado");
        break;
    case 'update':
        $datos = $entradaDetalle->update_entradaDetalle($body['entrada_detalle_id'],$body['entrada_id'], $body['producto_id'], $body['obra_id'], $body['entrada_cantidad'], $body['entrada_cantidad_propia'], $body['entrada_cantidad_subalquilada'], $body['estado']);
        echo json_encode("entradaDetalle actualizado");
        break;
    default:
        break;
}

?>