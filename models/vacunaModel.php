<?php 
require('../core/Mysql.php');

class VacunaModel extends Mysql{

    public function buscarVacunasModel(){
        $sql = "SELECT * FROM servicios WHERE statusVacuna = 1";
        $response = $this->select_all($sql);
        return $response;
    }

    public function obtenerVacunaPorIDModel($idservicio){
        $sql = "SELECT * FROM servicios WHERE idservicio = $idservicio";
        $response = $this->select($sql);
        return $response;
    }

    public function buscarMascotaOmascotasModel($idDueño){
        $sql = "SELECT * FROM mascotas WHERE idcliente = $idDueño";
        $data = $this->select_all($sql);
        return $data;
    }

    public function buscarDatosVacunacionConIDModel($idmascota,$idservicio){
        $sql = "SELECT m.idmascota , m.nombre AS nombre_mascota, hv.fecha_aplicada,hv.numero_dosis, s.idservicio, s.nombre AS nombre_vacuna, s.cantidad_dosis,s.dias_espera
        FROM mascotas m
        INNER JOIN historial_vacunas hv ON m.idmascota = hv.idmascota 
        INNER JOIN servicios s ON hv.idservicio = s.idservicio 
        WHERE m.idmascota = $idmascota AND s.idservicio = $idservicio";

        $data = $this->select_all($sql);

        return $data;
    }

    public function actualizarEstadoDeVacunaModel($idmascota,$idservicio,$numerodosis){
        $sql = "INSERT INTO historial_vacunas(idmascota,idservicio,numero_dosis) VALUES (?,?,?)";
        $arrData = array($idmascota,$idservicio,$numerodosis);
        $data = $this->insert($sql,$arrData);
        return $data;
    }

    public function obtenerUltimaVacunacionModel($idmascota){
        $sql = "SELECT hv.numero_dosis, hv.fecha_aplicada, s.nombre
        FROM historial_vacunas hv
        INNER JOIN servicios s ON hv.idservicio = s.idservicio
        WHERE hv.idmascota = $idmascota
          AND hv.fecha_aplicada = (
            SELECT MAX(fecha_aplicada)
            FROM historial_vacunas
            WHERE idmascota = $idmascota
        )";
        $data = $this->select($sql);
        return $data;
    }
}

?>