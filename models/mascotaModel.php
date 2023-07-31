<?php 

require('../core/Mysql.php');

class MascotaModel extends Mysql{
    public function agregarMascotaModel($nacimiento,$raza,$especie,$peso,$nombre,$info_adicional,$idcliente){
        $sql = "INSERT INTO mascotas(nacimiento,raza,especie,peso,nombre,informacion_adicional,idcliente) VALUES (?,?,?,?,?,?,?)";
        $arrData = array($nacimiento,$raza,$especie,$peso,$nombre,'',$idcliente);
        $respuesta = $this->insert($sql,$arrData);
        return $respuesta;
    }

    public function obtenerMascotasModel(){
        $sql = "SELECT * FROM mascotas";
        $respuesta = $this->select_all($sql);
        return $respuesta;
    }

    public function obtenerMascotaModel($idmascota){
        $sql = "SELECT * FROM mascotas WHERE idmascota= $idmascota";
        $data = $this->select($sql);
        return $data;
    }

    public function editarMascotaModel($nacimiento,$raza,$especie,$peso,$nombre,$info_adicional,$idcliente,$idmascota){
        $sql = "UPDATE mascotas SET nacimiento=?, raza=?,especie=?,peso=?,nombre=?,informacion_adicional=?, idcliente=? WHERE idmascota=$idmascota";
        $arrData = array($nacimiento,$raza,$especie,$peso,$nombre,'',$idcliente);
        $respuesta = $this->update($sql,$arrData);
        return $respuesta;
    }

    public function obtenerMascotasYSusDueñosModel(){
        $sql = "SELECT  m.idmascota, m.nacimiento, m.raza,m.especie,m.peso,m.nombre, c.dni,c.nombres FROM mascotas m INNER JOIN clientes c ON m.idcliente = c.idcliente";
        $respuesta = $this->select_all($sql);
        return $respuesta;
    }

    public function obtenerMascotaYSusDueñoModel($idmascota){
        $sql = "SELECT  m.idmascota, m.nacimiento, m.raza,m.especie,m.peso,m.nombre, c.dni,c.nombres,c.apellidos,c.telefono,c.direccion,c.correo FROM mascotas m INNER JOIN clientes c ON m.idcliente = c.idcliente WHERE idmascota = $idmascota ";
        $respuesta = $this->select($sql);
        return $respuesta;
    }

}
?>