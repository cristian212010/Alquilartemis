<?php

header('Content-Type: application/json');

require_once("../config/Conectar.php");
require_once("../models/cliente.php");

$cliente = new Cliente();

$body = json_decode(file_get_contents("php://input"),true);

switch ($_GET['op']) {
    case 'GetAll':
        $datos = $cliente->get_cliente();
        echo json_encode($datos);
        break;
    case 'GetId':
        $datos = $cliente->get_cliente_id($body['cliente_id']);
        echo json_encode($datos);
        break;
    case 'insert':
        $datos = $cliente->insert_cliente($body['nombre'],$body['direccion'], $body['telefono'], $body['email']);
        echo json_encode("Insertado correctamente");
        break;
    case 'delete':
        $datos = $cliente->delete_cliente($body['cliente_id']);
        echo json_encode("Cliente eliminado");
        break;
    case 'update':
        $datos = $cliente->update_cliente($body['cliente_id'],$body['nombre'], $body['direccion'], $body['telefono'], $body['email']);
        echo json_encode("Cliente actualizado");
        break;
    default:
        break;
}

?>