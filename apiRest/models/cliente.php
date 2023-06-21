<?php

class Cliente extends Conectar{
    private $cliente_id;
    private $nombre;
    private $direccion;
    private $telefono;
    private $email;
  

    public function __construct($cliente_id=0, $nombre='', $direccion='', $telefono='', $email =''){
        $this->cliente_id = $cliente_id;
        $this->nombre = $nombre;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
        $this->email = $email;
    }




    public function get_cliente(){
        $conectar = parent::conexion();
        parent::set_name();
        $stm = $conectar->prepare("SELECT * FROM cliente");
        $stm -> execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_cliente_id($cliente_id){
        $conectar = parent::conexion();
        parent::set_name();
        $stm = $conectar->prepare("SELECT * FROM cliente WHERE cliente_id=?");
        $stm -> bindvalue(1,$cliente_id);
        $stm -> execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert_cliente($nombre, $direccion, $telefono, $email){
        $conectar=parent::Conexion();
        parent::set_name();
        $stm="INSERT INTO cliente(nombre, direccion, telefono, email) VALUES(?,?,?,?)";
        $stm=$conectar->prepare($stm);
        $stm->bindValue(1,$nombre);
        $stm->bindValue(2,$direccion);
        $stm->bindValue(3,$telefono);
        $stm->bindValue(4,$email);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);

    }

    public function delete_cliente($cliente_id){
        $conectar=parent::Conexion();
        parent::set_name();
        $stm=$conectar->prepare("DELETE FROM cliente WHERE cliente_id=?");
        $stm->bindValue(1,$cliente_id);
        $stm->execute();
    }
    public function update_cliente($cliente_id, $nombre, $direccion, $telefono, $email){
        $conectar = parent::Conexion();
        parent::set_name();
        $stm = $conectar->prepare("UPDATE cliente SET nombre=?, direccion=?, telefono=?, email=? WHERE cliente_id=?");
        $stm->bindValue(1, $nombre);
        $stm->bindValue(2, $direccion);
        $stm->bindValue(3, $telefono);
        $stm->bindValue(4, $email);
        $stm->bindValue(5, $cliente_id);
        $stm->execute();
    }
}
?>