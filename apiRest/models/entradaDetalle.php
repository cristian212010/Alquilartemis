<?php

class EntradaDetalle extends Conectar{
    private $entrada_detalle_id;
    private $entrada_id;
    private $producto_id;
    private $obra_id;
    private $entrada_cantidad;
    private $entrada_cantidad_propia;
    private $entrada_cantidad_subalquilada;
    private $estado;    

    public function __construct($entrada_detalle_id=0, $entrada_id=0, $producto_id=0, $obra_id=0, $entrada_cantidad='', $entrada_cantidad_propia ='', $entrada_cantidad_subalquilada='', $estado=''){
        $this->entrada_detalle_id = $entrada_detalle_id;
        $this->entrada_id = $entrada_id;
        $this->producto_id = $producto_id;
        $this->obra_id = $obra_id;
        $this->entrada_cantidad = $entrada_cantidad;
        $this->entrada_cantidad_propia = $entrada_cantidad_propia;
        $this->entrada_cantidad_subalquilada = $entrada_cantidad_subalquilada;
        $this->estado = $estado;
    }


    public function get_entradaDetalle(){
        $conectar = parent::conexion();
        parent::set_name();
        $stm = $conectar->prepare("SELECT * FROM entrada_detalle");
        $stm -> execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_entradaDetalle_id($entrada_detalle_id){
        $conectar = parent::conexion();
        parent::set_name();
        $stm = $conectar->prepare("SELECT * FROM entrada_detalle WHERE entrada_detalle_id=?");
        $stm -> bindvalue(1,$entrada_detalle_id);
        $stm -> execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert_entradaDetalle($entrada_id,$producto_id, $obra_id, $entrada_cantidad, $entrada_cantidad_propia, $entrada_cantidad_subalquilada, $estado){
        $conectar=parent::Conexion();
        parent::set_name();
        $stm="INSERT INTO entrada_detalle(entrada_id,producto_id,obra_id,entrada_cantidad,entrada_cantidad_propia,entrada_cantidad_subalquilada, estado) VALUES(?,?,?,?,?,?,?)";
        $stm=$conectar->prepare($stm);
        $stm->bindValue(1,$entrada_id);
        $stm->bindValue(2,$producto_id);
        $stm->bindValue(3,$obra_id);
        $stm->bindValue(4,$entrada_cantidad);
        $stm->bindValue(5,$entrada_cantidad_propia);
        $stm->bindValue(6,$entrada_cantidad_subalquilada);
        $stm->bindValue(7,$estado);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete_entradaDetalle($entrada_detalle_id){
        $conectar=parent::Conexion();
        parent::set_name();
        $stm=$conectar->prepare("DELETE FROM entrada_detalle WHERE entrada_detalle_id=?");
        $stm->bindValue(1,$entrada_detalle_id);
        $stm->execute();
    }

    public function update_entradaDetalle($entrada_detalle_id,$entrada_id,$producto_id, $obra_id, $entrada_cantidad, $entrada_cantidad_propia, $entrada_cantidad_subalquilada, $estado){
        $conectar = parent::Conexion();
        parent::set_name();
        $stm = $conectar->prepare("UPDATE entrada_detalle SET entrada_id=?, producto_id=?, obra_id=?, entrada_cantidad=?, entrada_cantidad_propia=?, entrada_cantidad_subalquilada=?, estado=? WHERE entrada_detalle_id=?");
        $stm->bindValue(1, $entrada_id);
        $stm->bindValue(2, $producto_id);
        $stm->bindValue(3, $obra_id);
        $stm->bindValue(4, $entrada_cantidad);
        $stm->bindValue(5, $entrada_cantidad_propia);
        $stm->bindValue(6, $entrada_cantidad_subalquilada);
        $stm->bindValue(7, $estado);
        $stm->bindValue(8, $entrada_detalle_id);
        $stm->execute();
    }
}
?>