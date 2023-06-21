<?php
class Liquidacion extends Conectar {
    private $liquidacion_id;
    private $cliente_id;
    private $empleado_id;
    private $salida_id;
    private $entrada_id;
    private $obra_id;
    private $producto_id;

    public function __construct($liquidacion_id = 0,$cliente_id = 0,$empleado_id = 0,$salida_id = 0,$entrada_id = 0,$obra_id = 0,$producto_id = 0
    ) {
        $this->liquidacion_id = $liquidacion_id;
        $this->cliente_id = $cliente_id;
        $this->empleado_id = $empleado_id;
        $this->salida_id = $salida_id;
        $this->entrada_id = $entrada_id;
        $this->obra_id = $obra_id;
        $this->producto_id = $producto_id;
    }

    public function get_liquidacion() {
        $conectar = parent::conexion();
        parent::set_name();
        $stm = $conectar->prepare("SELECT * FROM Liquidacion");
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_liquidacion_id($liquidacion_id) {
        $conectar = parent::conexion();
        parent::set_name();
        $stm = $conectar->prepare("SELECT * FROM Liquidacion WHERE liquidacion_id = ?");
        $stm->bindValue(1, $liquidacion_id);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert_liquidacion($cliente_id, $empleado_id, $salida_id, $entrada_id, $obra_id, $producto_id) {
        $conectar = parent::Conexion();
        parent::set_name();
        $stm = "INSERT INTO Liquidacion (cliente_id, empleado_id, salida_id, entrada_id, obra_id, producto_id) VALUES (?, ?, ?, ?, ?, ?)";
        $stm = $conectar->prepare($stm);
        $stm->bindValue(1, $cliente_id);
        $stm->bindValue(2, $empleado_id);
        $stm->bindValue(3, $salida_id);
        $stm->bindValue(4, $entrada_id);
        $stm->bindValue(5, $obra_id);
        $stm->bindValue(6, $producto_id);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete_liquidacion($liquidacion_id) {
        $conectar = parent::Conexion();
        parent::set_name();
        $stm = $conectar->prepare("DELETE FROM Liquidacion WHERE liquidacion_id = ?");
        $stm->bindValue(1, $liquidacion_id);
        $stm->execute();
    }

    public function update_liquidacion($liquidacion_id, $cliente_id, $empleado_id, $salida_id, $entrada_id, $obra_id, $producto_id) {
        $conectar = parent::Conexion();
        parent::set_name();
        $stm = $conectar->prepare("UPDATE Liquidacion SET cliente_id = ?, empleado_id = ?, salida_id = ?, entrada_id = ?, obra_id = ?, producto_id = ? WHERE liquidacion_id = ?");
        $stm->bindValue(1, $cliente_id);
        $stm->bindValue(2, $empleado_id);
        $stm->bindValue(3, $salida_id);
        $stm->bindValue(4, $entrada_id);
        $stm->bindValue(5, $obra_id);
        $stm->bindValue(6, $producto_id);
        $stm->bindValue(7, $liquidacion_id);
        $stm->execute();
    }
}
?>