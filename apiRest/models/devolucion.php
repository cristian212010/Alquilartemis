<?php

class Devolucion extends Conectar{
    private $salida_id;
    private $empleado_id;
    private $cliente_id;
    private $fecha_entrada;
    private $hora_entrada;
    private $observaciones;
  

    public function __construct($salida_id=0, $empleado_id=0, $cliente_id=0, $fecha_entrada='', $hora_entrada ='', $observaciones=''){
        $this->salida_id = $salida_id;
        $this->empleado_id = $empleado_id;
        $this->cliente_id = $cliente_id;
        $this->fecha_entrada = $fecha_entrada;
        $this->hora_entrada = $hora_entrada;
        $this->observaciones = $observaciones;
    
    }

    public function get_devolucion(){
        $conectar = parent::conexion();
        parent::set_name();
        $stm = $conectar->prepare("SELECT * FROM Entrada");
        $stm -> execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_devolucion_id($entrada_id){
        $conectar = parent::conexion();
        parent::set_name();
        $stm = $conectar->prepare("SELECT * FROM Entrada WHERE entrada_id=?");
        $stm -> bindvalue(1,$entrada_id);
        $stm -> execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert_devolucion($salida_id, $empleado_id, $cliente_id, $fecha_entrada, $hora_entrada, $observaciones){
        $conectar=parent::Conexion();
        parent::set_name();
        $stm="INSERT INTO Entrada(salida_id, empleado_id, cliente_id, fecha_entrada, hora_entrada, observaciones) VALUES(?,?,?,?,?,?)";
        $stm=$conectar->prepare($stm);
        $stm->bindValue(1,$salida_id);
        $stm->bindValue(2,$empleado_id);
        $stm->bindValue(3,$cliente_id);
        $stm->bindValue(4,$fecha_entrada);
        $stm->bindValue(5,$hora_entrada);
        $stm->bindValue(6,$observaciones);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);

    }

    public function delete_devolucion($entrada_id){
        $conectar=parent::Conexion();
        parent::set_name();
        $stm=$conectar->prepare("DELETE FROM entrada WHERE entrada_id=?");
        $stm->bindValue(1,$entrada_id);
        $stm->execute();
    }
    public function update_devolucion($entrada_id, $salida_id, $empleado_id, $cliente_id, $fecha_entrada, $hora_entrada, $observaciones){
        $conectar = parent::Conexion();
        parent::set_name();
        $stm = $conectar->prepare("UPDATE entrada SET salida_id=?, empleado_id=?, cliente_id=?, fecha_entrada=?, hora_entrada=?, observaciones=? WHERE entrada_id=?");
        $stm->bindValue(1, $salida_id);
        $stm->bindValue(2, $empleado_id);
        $stm->bindValue(3, $cliente_id);
        $stm->bindValue(4, $fecha_entrada);
        $stm->bindValue(5, $hora_entrada);
        $stm->bindValue(6, $observaciones);
        $stm->bindValue(7, $entrada_id);
        $stm->execute();
    }
}
?>