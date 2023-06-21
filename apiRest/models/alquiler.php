<?php

class Alquiler extends Conectar{
    private $salida_id;
    private $cliente_id;
    private $empleado_id;
    private $fecha_salida;
    private $hora_salida;
    private $subtotalPeso;
    private $placatransporte;
    private $observaciones;  

    public function __construct($salida_id=0, $cliente_id=0, $empleado_id=0, $fecha_salida='', $hora_salida ='', $subtotalPeso='', $placatransporte='', $observaciones='',){
        $this->salida_id = $salida_id;
        $this->cliente_id = $cliente_id;
        $this->empleado_id = $empleado_id;
        $this->fecha_salida = $fecha_salida;
        $this->hora_salida = $hora_salida;
        $this->subtotalPeso = $subtotalPeso;
        $this->placatransporte = $placatransporte;
        $this->observaciones = $observaciones;
    }




    public function get_alquiler(){
        $conectar = parent::conexion();
        parent::set_name();
        $stm = $conectar->prepare("SELECT * FROM salida");
        $stm -> execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_alquiler_id($salida_id){
        $conectar = parent::conexion();
        parent::set_name();
        $stm = $conectar->prepare("SELECT * FROM salida WHERE salida_id=?");
        $stm -> bindvalue(1,$salida_id);
        $stm -> execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert_alquiler($cliente_id, $empleado_id, $fecha_salida, $hora_salida, $subtotalPeso, $placatransporte, $observaciones){
        $conectar=parent::Conexion();
        parent::set_name();
        $stm="INSERT INTO salida(cliente_id,empleado_id,fecha_salida,hora_salida,subtotalPeso, placatransporte, observaciones) VALUES(?,?,?,?,?,?,?)";
        $stm=$conectar->prepare($stm);
        $stm->bindValue(1,$cliente_id);
        $stm->bindValue(2,$empleado_id);
        $stm->bindValue(3,$fecha_salida);
        $stm->bindValue(4,$hora_salida);
        $stm->bindValue(5,$subtotalPeso);
        $stm->bindValue(6,$placatransporte);
        $stm->bindValue(7,$observaciones);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);

    }

    public function delete_alquiler($salida_id){
        $conectar=parent::Conexion();
        parent::set_name();
        $stm=$conectar->prepare("DELETE FROM salida WHERE salida_id=?");
        $stm->bindValue(1,$salida_id);
        $stm->execute();
    }

    public function update_alquiler($salida_id, $cliente_id, $empleado_id, $fecha_salida, $hora_salida, $subtotalPeso, $placatransporte, $observaciones){
        $conectar = parent::Conexion();
        parent::set_name();
        $stm = $conectar->prepare("UPDATE salida SET cliente_id=?, empleado_id=?, fecha_salida=?, hora_salida=?, subtotalPeso=?, placatransporte=?, observaciones=? WHERE salida_id=?");
        $stm->bindValue(1, $cliente_id);
        $stm->bindValue(2, $empleado_id);
        $stm->bindValue(3, $fecha_salida);
        $stm->bindValue(4, $hora_salida);
        $stm->bindValue(5, $subtotalPeso);
        $stm->bindValue(6, $placatransporte);
        $stm->bindValue(7, $observaciones);
        $stm->bindValue(8, $salida_id);
        $stm->execute();
    }
}



?>