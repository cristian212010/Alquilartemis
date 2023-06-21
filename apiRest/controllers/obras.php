<?php

header('Content-Type: application/json');

require_once("../config/Conectar.php");
require_once("../models/obra.php");

$obra = new Obra();

$body = json_decode(file_get_contents("php://input"),true);

switch ($_GET['op']) {
    case 'GetAll':
        $datos = $obra->get_obra();
        echo json_encode($datos);
        break;
    case 'GetId':
        $datos = $obra->get_obra_id($body['obra_id']);
        echo json_encode($datos);
        break;
    case 'insert':
        $datos = $obra->insert_obra($body['cliente_id'], $body['nombre_obra'], $body['direccion'], $body['fechaInicio'], $body['fechaFin'], $body['presupuesto'], $body['estado']);
        echo json_encode("Insertado correctamente");
        break;
    case 'delete':
        $datos = $obra->delete_obra($body['obra_id']);
        echo json_encode("Obra eliminado");
         break;
    case 'update':
        $datos = $obra->update_obra($body['obra_id'], $body['cliente_id'], $body['nombre_obra'], $body['direccion'], $body['fechaInicio'], $body['fechaFin'], $body['presupuesto'], $body['estado']);
        echo json_encode("obra actualizado");
    break;
    default:
        break;
}

?>