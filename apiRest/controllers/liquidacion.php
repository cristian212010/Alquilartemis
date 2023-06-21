<?php

header('Content-Type: application/json');

require_once("../config/Conectar.php");
require_once("../models/liquidacion.php");

$liquidacion = new Liquidacion();

$body = json_decode(file_get_contents("php://input"),true);

switch ($_GET['op']) {
    case 'GetAll':
        $datos=$liquidacion->get_liquidacion();
        echo json_encode($datos);
        break;
    case 'GetId':
        $datos = $liquidacion->get_liquidacion_id($body['liquidacion_id']);
        echo json_encode($datos);
        break;
    case 'insert':
        $datos = $liquidacion->insert_liquidacion($body['cliente_id'], $body['empleado_id'], $body['salida_id'], $body['entrada_id'], $body['obra_id'], $body['producto_id']);
        echo json_encode("Insertado correctamente");
        break;
     case 'delete':
        $datos = $liquidacion->delete_liquidacion($body['liquidacion_id']);
        echo json_encode("Liquidacion eliminado");
        break;
    case 'update':
        $datos = $liquidacion->update_liquidacion($body['liquidacion_id'],$body['cliente_id'], $body['empleado_id'], $body['salida_id'], $body['entrada_id'], $body['obra_id'],$body['producto_id']);
        echo json_encode("Liquidacion actualizado");
        break;
    default:
        break;
}

?>