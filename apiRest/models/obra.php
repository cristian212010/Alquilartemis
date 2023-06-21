<?php

class Obra extends Conectar{
    private $obra_id;
    private $cliente_id;
    private $nombre_obra;
    private $direccion;
    private $fechaInicio;
    private $fechaFin;
    private $presupuesto;
    private $estado;  

    public function __construct($obra_id=0, $cliente_id=0, $nombre_obra='', $direccion='', $fechaInicio ='', $fechaFin='', $presupuesto='', $estado=''){
        $this->obra_id = $obra_id;
        $this->cliente_id = $cliente_id;
        $this->nombre_obra = $nombre_obra;
        $this->direccion = $direccion;
        $this->fechaInicio = $fechaInicio;
        $this->fechaFin = $fechaFin;
        $this->presupuesto = $presupuesto;
        $this->estado = $estado;
    }




    public function get_obra(){
        $conectar = parent::conexion();
        parent::set_name();
        $stm = $conectar->prepare("SELECT * FROM obras");
        $stm -> execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_obra_id($obra_id){
        $conectar = parent::conexion();
        parent::set_name();
        $stm = $conectar->prepare("SELECT * FROM obras WHERE obra_id=?");
        $stm -> bindvalue(1,$obra_id);
        $stm -> execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert_obra($cliente_id, $nombre_obra, $direccion, $fechaInicio, $fechaFin, $presupuesto, $estado){
        $conectar=parent::conexion();
        parent::set_name();
        $stm="INSERT INTO obras(cliente_id,nombre_obra,direccion,fechaInicio,fechaFin, presupuesto, estado) VALUES(?,?,?,?,?,?,?)";
        $stm=$conectar->prepare($stm);
        $stm->bindValue(1,$cliente_id);
        $stm->bindValue(2,$nombre_obra);
        $stm->bindValue(3,$direccion);
        $stm->bindValue(4,$fechaInicio);
        $stm->bindValue(5,$fechaFin);
        $stm->bindValue(6,$presupuesto);
        $stm->bindValue(7,$estado);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);

    }

    public function delete_obra($obra_id){
        $conectar=parent::conexion();
        parent::set_name();
        $stm=$conectar->prepare("DELETE FROM obras WHERE obra_id=?");
        $stm->bindValue(1,$obra_id);
        $stm->execute();
    }

    public function update_obra($obra_id, $cliente_id, $nombre_obra, $direccion, $fechaInicio, $fechaFin, $presupuesto, $estado){
        $conectar = parent::Conexion();
        parent::set_name();
        $stm = $conectar->prepare("UPDATE obras SET cliente_id=?, nombre_obra=?, direccion=?, fechaInicio=?, fechaFin=?, presupuesto=?, estado=? WHERE obra_id=?");
        $stm->bindValue(1,$cliente_id);
        $stm->bindValue(2,$nombre_obra);
        $stm->bindValue(3,$direccion);
        $stm->bindValue(4,$fechaInicio);
        $stm->bindValue(5,$fechaFin);
        $stm->bindValue(6,$presupuesto);
        $stm->bindValue(7,$estado);
        $stm->bindValue(8,$obra_id);
        $stm->execute();
    }
}
?>