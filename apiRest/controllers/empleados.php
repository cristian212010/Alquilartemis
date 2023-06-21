<?php

header('Content-Type: application/json');

require_once("../config/Conectar.php");
require_once("../models/empleado.php");

$empleado = new Empleado();

$body = json_decode(file_get_contents("php://input"),true);

switch ($_GET['op']) {
    case 'GetAll':
        $datos = $empleado->get_empleado();
        echo json_encode($datos);
        break;
    case 'GetId':
        $datos = $empleado->get_empleado_id($body['empleado_id']);
        echo json_encode($datos);
        break;
    case 'insert':
        $datos = $empleado->insert_empleado($body['nombre'], $body['direccion'], $body['telefono'], $body['email'], $body['cargo'], $body['salario']);
        echo json_encode("Insertado correctamente");
        break;
    case 'delete':
        $datos = $empleado->delete_empleado($body['empleado_id']);
        echo json_encode("Empleado eliminado");
        break;
    case 'update':
        $datos = $empleado->update_empleado($body['empleado_id'],$body['nombre'], $body['direccion'], $body['telefono'], $body['email'], $body['cargo'], $body['salario']);
        echo json_encode("Empleado actualizado");
        break;
    default:
        break;
}

?>