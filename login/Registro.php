<?php
require_once("Conectar.php");

class Registro extends Conectar{
    protected $empleado_id;
    protected $nombre;
    protected $direccion;
    protected $telefono;
    protected $cargo;
    protected $salario;
    protected $password;
    protected $email;

    public function __construct($empleado_id=0, $nombre='',$direccion='',$telefono=0,$cargo='',$salario='',$password='', $email='', $dbCnx=''){
        $this->empleado_id = $empleado_id;
        $this->nombre = $nombre;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
        $this->cargo = $cargo;
        $this->salario = $salario;
        $this->email = $email;
        $this->password = $password;
        parent::__construct($dbCnx);
    }

    public function __get($Property)
    {
        if(property_exists($this,$Property)){
            return $this->$Property;
        }
    }

    public function __set($Property, $value)
    {
        if(property_exists($this,$Property)){
            $this->$Property=$value;
        }
    }  

    public function insertData(){
        try {
            $stm = $this-> dbCnx -> prepare("INSERT INTO empleado(nombre,direccion,telefono,cargo,salario,password,email) values (?,?,?,?,?,?,?)");
            $stm -> execute([$this->nombre,$this->direccion,$this->telefono,$this->cargo,$this->salario, $this->password, $this->email]);
        } catch (Exeption $e) {
            return $e->getMessage();
        }
    }


    public function verificacionLogin(){
        try {
            $stm = $this->dbCnx -> prepare("SELECT email, password FROM empleado");
            $stm -> execute();
            return $stm -> fetchAll();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
?>