<?php 
require('../core/Mysql.php');
class CitaModel extends Mysql{

    public function crearCitaModel($idmascota,$fecha_atencion,$hora_programada,$idveterinario,$idservicios,$hora_terminacion_esperada){

        $sql = "INSERT INTO citas(idmascota,fecha_atencion,hora_programada,idveterinario,motivo,servicios,hora_terminacion_esperada,estado) VALUES (?,?,?,?,?,?,?,?)";

        $data = array($idmascota,$fecha_atencion,$hora_programada,$idveterinario,'',$idservicios,$hora_terminacion_esperada,'2');

        $response = $this->insert($sql,$data);

        return $data;
    }

    public function editarCitaModel($fecha_atencion,$hora_programada,$idveterinario,$idservicios,$hora_terminacion_esperada,$idcita){

        $sql = "UPDATE citas SET fecha_atencion=?,hora_programada=?,idveterinario=?,servicios=?,hora_terminacion_esperada=? WHERE idcita=$idcita";

        $data = array($fecha_atencion,$hora_programada,$idveterinario,$idservicios,$hora_terminacion_esperada);

        $response = $this->update($sql,$data);

        return $data;
    }

    public function obtenerCitasModel(){
        $sql = "SELECT * FROM citas";
        $data = $this->select_all($sql);
        return $data;
    }

    public function obtenerCitasRelacionadasModel(){
        $sql = "SELECT c.idcita, c.motivo, c.fecha_atencion,c.hora_programada,c.hora_terminacion_esperada, c.estado, c.servicios,c.idveterinario , m.nombre FROM citas c INNER JOIN mascotas m ON c.idmascota = m.idmascota";
        $data = $this->select_all($sql);
        return $data;
    }

    public function obtenerCitasPorFechaModel($fecha_atencion){
        $sql = "SELECT * FROM citas WHERE fecha_atencion='$fecha_atencion' AND (estado=1 OR estado=2)";
        $data = $this->select_all($sql);
        return $data;
    }

    public function cambiarEstadoCitaModel($idcita,$estado){
        $sql = "UPDATE citas SET estado=? WHERE idcita=$idcita";
        $arrData = array($estado);
        $response = $this->update($sql,$arrData);
        return $response;
    }

    public function obtenerDatosConIdCitaModel($idcita){
        $sql = "SELECT * FROM citas WHERE idcita=$idcita";
        $response = $this->select($sql);
        return $response;
    }

    public function obtenerCitasConIdMascotaModel($idmascota){
        $sql = "SELECT * FROM citas WHERE idmascota=$idmascota";
        $response = $this->select_all($sql);
        return $response;
    }

    public function agregarDetalleCitaModel($medicinas,$antecedentes,$tratamiento,$motivo,$idcita){
        $sql = "UPDATE citas SET medicinas_aplicadas=?,antecedentes=?,tratamiento=?,motivo=?,estado=? WHERE idcita=$idcita";
        $arrData = array($medicinas,$antecedentes,$tratamiento,$motivo,'3');
        $response = $this->update($sql,$arrData);
        return $response;
    }

}


?>