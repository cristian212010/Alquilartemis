<?php

class SalidaDetalle extends Conectar{
    private $salida_id;
    private $producto_id;
    private $empleado_id;
    private $obra_id;
    private $cantidad_salida;
    private $cantidad_propia;
    private $cantidad_subalquilada;
    private $valorUnidad;
    private $fecha_standBye;
    private $estado;  
    private $valorTotal;      

    public function __construct($salida_id=0, $producto_id=0, $empleado_id=0, $obra_id=0, $cantidad_salida =0, $cantidad_propia=0, $cantidad_subalquilada=0, $valorUnidad=0, $fecha_standBye='', $estado='', $valorTotal=0,){
        $this->salida_id = $salida_id;
        $this->producto_id = $producto_id;
        $this->empleado_id = $empleado_id;
        $this->obra_id = $obra_id;
        $this->cantidad_salida = $cantidad_salida;
        $this->cantidad_propia = $cantidad_propia;
        $this->cantidad_subalquilada = $cantidad_subalquilada;
        $this->valorUnidad = $valorUnidad;
        $this->fecha_standBye = $fecha_standBye;
        $this->estado = $estado;
        $this->valorTotal = $valorTotal;

    }


    public function get_salidaDetalle(){
        $conectar = parent::conexion();
        parent::set_name();
        $stm = $conectar->prepare("SELECT * FROM salida_detalle");
        $stm -> execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_salidaDetalle_id($salida_detalle_id){
        $conectar = parent::conexion();
        parent::set_name();
        $stm = $conectar->prepare("SELECT * FROM salida_detalle WHERE salida_detalle_id=?");
        $stm -> bindvalue(1,$salida_detalle_id);
        $stm -> execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert_salidaDetalle($salida_id,$producto_id, $empleado_id, $obra_id, $cantidad_salida, $cantidad_propia, $cantidad_subalquilada, $valorUnidad, $fecha_standBye, $estado, $valorTotal){
        $conectar=parent::Conexion();
        parent::set_name();
        $stm="INSERT INTO salida_detalle(salida_id,producto_id,empleado_id,obra_id,cantidad_salida,cantidad_propia, cantidad_subalquilada,valorUnidad,fecha_standBye,estado,valorTotal) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
        $stm=$conectar->prepare($stm);
        $stm->bindValue(1,$salida_id);
        $stm->bindValue(2,$producto_id);
        $stm->bindValue(3,$empleado_id);
        $stm->bindValue(4,$obra_id);
        $stm->bindValue(5,$cantidad_salida);
        $stm->bindValue(6,$cantidad_propia);
        $stm->bindValue(7,$cantidad_subalquilada);
        $stm->bindValue(8,$valorUnidad);
        $stm->bindValue(9,$fecha_standBye);
        $stm->bindValue(10,$estado);
        $stm->bindValue(11,$valorTotal);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);

    }

    public function delete_salidaDetalle($salida_detalle_id) {
        $conectar = parent::Conexion();
        parent::set_name();
        $stm = $conectar->prepare("DELETE FROM salida_detalle WHERE salida_detalle_id=?");
        $stm->bindValue(1, $salida_detalle_id);
        $stm->execute();
    }

    public function update_salidaDetalle($salida_detalle_id, $salida_id, $producto_id, $empleado_id, $obra_id, $cantidad_salida, $cantidad_propia, $cantidad_subalquilada, $valorUnidad, $fecha_standBye, $estado, $valorTotal) {
        $conectar = parent::Conexion();
        parent::set_name();
        $stm = $conectar->prepare("UPDATE salida_detalle SET salida_id=?, producto_id=?, empleado_id=?, obra_id=?, cantidad_salida=?, cantidad_propia=?, cantidad_subalquilada=?, valorUnidad=?, fecha_standBye=?, estado=?, valorTotal=? WHERE salida_detalle_id=?");
        $stm->bindValue(1, $salida_id);
        $stm->bindValue(2, $producto_id);
        $stm->bindValue(3, $empleado_id);
        $stm->bindValue(4, $obra_id);
        $stm->bindValue(5, $cantidad_salida);
        $stm->bindValue(6, $cantidad_propia);
        $stm->bindValue(7, $cantidad_subalquilada);
        $stm->bindValue(8, $valorUnidad);
        $stm->bindValue(9, $fecha_standBye);
        $stm->bindValue(10, $estado);
        $stm->bindValue(11, $valorTotal);
        $stm->bindValue(12, $salida_detalle_id);
        $stm->execute();
    }
}
?>