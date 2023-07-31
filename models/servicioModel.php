<?php 

require('../core/Mysql.php');

class ServicioModel extends Mysql{
    public function agregarServicioModel($nombre,$duracion,$precio,$descripcion){
        $sql = "INSERT INTO servicios(nombre,duracion,precio,descripcion) VALUES (?,?,?,?)";
        $arrData = array($nombre,$duracion,$precio,$descripcion);
        $response = $this->insert($sql,$arrData);
        return $response;
    }

    public function obtenerServiciosModel(){
        $sql = "SELECT * FROM servicios";
        $response = $this->select_all($sql);
        return $response;
    }

    public function obtenerServicioModal($idservicio){
        $sql = "SELECT * FROM servicios WHERE idservicio = $idservicio";
        $response = $this->select($sql);
        return $response;
    }

    public function editarServicioModel($nombre,$duracion,$precio,$descripcion,$idservicio){
        $sql = "UPDATE servicios SET nombre=?, duracion=?,precio=?,descripcion=? WHERE idservicio=$idservicio";
        $arrData = array($nombre,$duracion,$precio,$descripcion);
        $response = $this->insert($sql,$arrData);
        return $response;
    }
}


?>