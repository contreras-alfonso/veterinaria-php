<?php 
require('../core/Mysql.php');

class VeterinarioModel extends Mysql{
    public function agregarVeterinarioModel($nombres,$apellidos,$email,$nacimiento,$dni,$telefono){
        $sql = "INSERT INTO veterinarios(nombres,apellidos,dni,correo,telefono,nacimiento) VALUES (?,?,?,?,?,?)";
        $arrData = array($nombres,$apellidos,$dni,$email,$telefono,$nacimiento);
        $response = $this->insert($sql,$arrData);
        return $response;
    }

    public function obtenerVeterinariosModel(){
        $sql = "SELECT * FROM veterinarios";
        $response = $this->select_all($sql);
        return $response;
    }

    public function obtenerVeterinarioModal($idveterinario){
        $sql = "SELECT * FROM veterinarios WHERE idveterinario = $idveterinario";
        $response = $this->select($sql);
        return $response;
    }

    public function editarVeterinarioModel($nombres,$apellidos,$email,$nacimiento,$dni,$telefono,$idveterinario){
        $sql = "UPDATE veterinarios SET nombres=?, apellidos=?,correo=?,nacimiento=?,dni=?,telefono=? WHERE idveterinario=$idveterinario";
        $arrData = array($nombres,$apellidos,$email,$nacimiento,$dni,$telefono);
        $response = $this->update($sql,$arrData);
        return $response;
    }

}


?>