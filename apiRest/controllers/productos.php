<?php

header('Content-Type: application/json');

require_once("../config/Conectar.php");
require_once("../models/producto.php");

$producto = new Producto();

$body = json_decode(file_get_contents("php://input"),true);

switch ($_GET['op']) {
    case 'GetAll':
        $datos = $producto->get_producto();
        echo json_encode($datos);
        break;
    case 'GetId':
        $datos = $producto->get_producto_id($body['producto_id']);
        echo json_encode($datos);
        break;
    case 'insert':
        $datos = $producto->insert_producto($body['nombre'], $body['descripcion'], $body['precio'], $body['stock'], $body['categoria']);
        echo json_encode("Insertado correctamente");
        break;
    case 'delete':
         $datos = $producto->delete_producto($body['producto_id']);
        echo json_encode("Producto eliminado");
        break;
    case 'update':
        $datos = $producto->update_producto($body['producto_id'], $body['nombre'], $body['descripcion'], $body['precio'], $body['stock'], $body['categoria']);
        echo json_encode("Producto actualizado");
        break;
    default:
        break;
}

?>