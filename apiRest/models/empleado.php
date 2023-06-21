<?php

class Empleado extends Conectar{
    private $empleado_id;
    private $nombre;
    private $direccion;
    private $telefono;
    private $email;
    private $cargo;
    private $salario;

    public function __construct($empleado_id=0, $nombre='', $direccion='', $telefono='', $email ='', $cargo='', $salario=0){
        $this->empleado_id = $empleado_id;
        $this->nombre = $nombre;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
        $this->email = $email;
        $this->cargo = $cargo;
        $this->salario = $salario;
    }


    public function get_empleado(){
        $conectar = parent::conexion();
        parent::set_name();
        $stm = $conectar->prepare("SELECT * FROM empleado");
        $stm -> execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_empleado_id($empleado_id){
        $conectar = parent::conexion();
        parent::set_name();
        $stm = $conectar->prepare("SELECT * FROM empleado WHERE empleado_id=?");
        $stm -> bindvalue(1,$empleado_id);
        $stm -> execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert_empleado($nombre, $direccion, $telefono, $email, $cargo, $salario){
        $conectar=parent::Conexion();
        parent::set_name();
        $stm="INSERT INTO empleado(nombre,direccion,telefono,email,cargo,salario) VALUES(?,?,?,?,?,?)";
        $stm=$conectar->prepare($stm);
        $stm->bindValue(1,$nombre);
        $stm->bindValue(2,$direccion);
        $stm->bindValue(3,$telefono);
        $stm->bindValue(4,$email);
        $stm->bindValue(5,$cargo);
        $stm->bindValue(6,$salario);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete_empleado($empleado_id){
        $conectar=parent::Conexion();
        parent::set_name();
        $stm=$conectar->prepare("DELETE FROM Empleado WHERE empleado_id=?");
        $stm->bindValue(1,$empleado_id);
        $stm->execute();
    }

    public function update_empleado($empleado_id, $nombre, $direccion, $telefono, $email, $cargo, $salario){
        $conectar = parent::Conexion();
        parent::set_name();
        $stm = $conectar->prepare("UPDATE empleado SET nombre=?, direccion=?, telefono=?, email=?, cargo=?, salario=? WHERE empleado_id=?");
        $stm->bindValue(1, $nombre);
        $stm->bindValue(2, $direccion);
        $stm->bindValue(3, $telefono);
        $stm->bindValue(4, $email);
        $stm->bindValue(5, $cargo);
        $stm->bindValue(6, $salario);
        $stm->bindValue(7, $empleado_id);
        $stm->execute();
    }
}
?>