<?php

class Inventario extends Conectar{
    private $inventario_id;
    private $producto_id;
    private $CantidadInicial;
    private $CantidadIngresos;
    private $CantidadSalidas;
    private $CantidadFinal;
    private $FechaInventario;
    private $TipoOperacion;

    public function __construct($inventario_id=0, $producto_id=0, $CantidadInicial='', $CantidadIngresos='', $CantidadSalidas='', $CantidadFinal ='', $FechaInventario='', $TipoOperacion=''){
        $this->inventario_id = $inventario_id;
        $this->producto_id = $producto_id;
        $this->CantidadInicial = $CantidadInicial;
        $this->CantidadIngresos = $CantidadIngresos;
        $this->CantidadSalidas = $CantidadSalidas;
        $this->CantidadFinal = $CantidadFinal;
        $this->FechaInventario = $FechaInventario;
        $this->TipoOperacion = $TipoOperacion;
    }


    public function get_inventario(){
        $conectar = parent::conexion();
        parent::set_name();
        $stm = $conectar->prepare("SELECT * FROM inventario");
        $stm -> execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_inventario_id($inventario_id){
        $conectar = parent::conexion();
        parent::set_name();
        $stm = $conectar->prepare("SELECT * FROM inventario WHERE inventario_id=?");
        $stm -> bindvalue(1,$inventario_id);
        $stm -> execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert_inventario($producto_id,$CantidadInicial, $CantidadIngresos, $CantidadSalidas, $CantidadFinal, $FechaInventario, $TipoOperacion){
        $conectar=parent::Conexion();
        parent::set_name();
        $stm="INSERT INTO inventario(producto_id,CantidadInicial,CantidadIngresos,CantidadSalidas,CantidadFinal,FechaInventario,TipoOperacion) VALUES(?,?,?,?,?,?,?)";
        $stm=$conectar->prepare($stm);
        $stm->bindValue(1,$producto_id);
        $stm->bindValue(2,$CantidadInicial);
        $stm->bindValue(3,$CantidadIngresos);
        $stm->bindValue(4,$CantidadSalidas);
        $stm->bindValue(5,$CantidadFinal);
        $stm->bindValue(6,$FechaInventario);
        $stm->bindValue(7,$TipoOperacion);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);

    }

    public function delete_inventario($inventario_id){
        $conectar=parent::Conexion();
        parent::set_name();
        $stm=$conectar->prepare("DELETE FROM inventario WHERE inventario_id=?");
        $stm->bindValue(1,$inventario_id);
        $stm->execute();
    }

    public function update_inventario($inventario_id, $producto_id, $CantidadInicial, $CantidadIngresos, $CantidadSalidas, $CantidadFinal, $FechaInventario, $TipoOperacion){
        $conectar = parent::Conexion();
        parent::set_name();
        $stm = $conectar->prepare("UPDATE inventario SET producto_id=?, CantidadInicial=?, CantidadIngresos=?, CantidadSalidas=?, CantidadFinal=?, FechaInventario=?, TipoOperacion=? WHERE inventario_id=?");
        $stm->bindValue(1,$producto_id);
        $stm->bindValue(2,$CantidadInicial);
        $stm->bindValue(3,$CantidadIngresos);
        $stm->bindValue(4,$CantidadSalidas);
        $stm->bindValue(5,$CantidadFinal);
        $stm->bindValue(6,$FechaInventario);
        $stm->bindValue(7,$TipoOperacion);
        $stm->bindValue(8,$inventario_id);
        $stm->execute();
    }
}
?>