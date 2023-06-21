<?php

class Producto extends Conectar{
    private $producto_id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $stock;
    private $categoria;
  

    public function __construct($producto_id=0, $nombre='', $descripcion='', $precio='', $stock ='', $categoria=''){
        $this->producto_id = $producto_id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
        $this->stock = $stock;
        $this->categoria = $categoria;
    }




    public function get_producto(){
        $conectar = parent::conexion();
        parent::set_name();
        $stm = $conectar->prepare("SELECT * FROM producto");
        $stm -> execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_producto_id($producto_id){
        $conectar = parent::conexion();
        parent::set_name();
        $stm = $conectar->prepare("SELECT * FROM producto WHERE producto_id=?");
        $stm -> bindvalue(1,$producto_id);
        $stm -> execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert_producto($nombre, $descripcion, $precio, $stock, $categoria){
        $conectar=parent::Conexion();
        parent::set_name();
        $stm="INSERT INTO producto(nombre, descripcion, precio, stock, categoria) VALUES(?,?,?,?,?)";
        $stm=$conectar->prepare($stm);
        $stm->bindValue(1,$nombre);
        $stm->bindValue(2,$descripcion);
        $stm->bindValue(3,$precio);
        $stm->bindValue(4,$stock);
        $stm->bindValue(5,$categoria);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);

    }

    public function delete_producto($producto_id){
        $conectar=parent::Conexion();
        parent::set_name();
        $stm=$conectar->prepare("DELETE FROM producto WHERE producto_id=?");
        $stm->bindValue(1,$producto_id);
        $stm->execute();
    }

    public function update_producto($producto_id, $nombre, $descripcion, $precio, $stock, $categoria){
        $conectar = parent::Conexion();
        parent::set_name();
        $stm = $conectar->prepare("UPDATE producto SET nombre=?, descripcion=?, precio=?, stock=?, categoria=? WHERE producto_id=?");
        $stm->bindValue(1,$nombre);
        $stm->bindValue(2,$descripcion);
        $stm->bindValue(3,$precio);
        $stm->bindValue(4,$stock);
        $stm->bindValue(5,$categoria);
        $stm->bindValue(6,$producto_id);
        $stm->execute();
    }
}
?>