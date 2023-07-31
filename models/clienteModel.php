<?php 
require('../core/Mysql.php');
class Cliente extends Mysql{

    public function buscarDuenoPorDNIModel($dniDueño){
        $sql = "SELECT * FROM clientes WHERE dni = '$dniDueño'";
        $data = $this->select($sql);
        return $data;
    }

    public function obtenerClientesModel(){
        $sql = "SELECT * FROM clientes";
        $data = $this->select_all($sql);
        return $data;
    }

    public function agregarClienteModel($nombres,$apellidos,$email,$direccion,$celar,$dni){
        $sql = "INSERT INTO clientes(nombres,apellidos,dni,telefono,direccion,correo) VALUES (?,?,?,?,?,?)";
        $arrData = array($nombres,$apellidos,$dni,$celar,$direccion,$email);
        $data = $this->insert($sql,$arrData);
        return $data;
    }

    public function obtenerClienteModel($idcliente){
        $sql = "SELECT * FROM clientes WHERE idcliente = $idcliente";
        $data = $this->select($sql);
        return $data;
    }

    public function editarClienteModel($nombres,$apellidos,$email,$direccion,$celar,$dni,$idcliente){
        $sql = "UPDATE clientes SET nombres=?, apellidos=?,dni=?,telefono=?,direccion=?,correo=? WHERE idcliente=$idcliente";
        $arrData = array($nombres,$apellidos,$dni,$celar,$direccion,$email);
        $data = $this->insert($sql,$arrData);
        return $data;
    }

}




?>