<?php 

require('../models/vacunaModel.php');

class VacunaController extends VacunaModel{

    public function buscarVacunas(){
        $data = $this->buscarVacunasModel();
        echo json_encode($data);
    }

    public function obtenerVacunaPorID(){
        $idservicio = $_POST['idservicio'];
        $data = $this->obtenerVacunaPorIDModel($idservicio);
        echo json_encode($data);
    }

    public function buscarMascotaOmascotas(){
        $idDueño = $_POST['idDueño'];
        $data = $this->buscarMascotaOmascotasModel($idDueño);
        if(empty($data)){
            echo json_encode(array('status'=>false,'msg'=>'No hay mascotas asociadas al DNI ingresado.'));
        }else{
            echo json_encode(array('status'=>true,'arrData'=>$data));
        }
    }

    public function buscarDatosVacunacionConID(){
        $idmascota = $_POST['idmascota'];
        $idservicio = $_POST['idservicio'];
        $data = $this->buscarDatosVacunacionConIDModel($idmascota,$idservicio);
        echo json_encode($data);
    }

    public function actualizarEstadoDeVacuna(){
        $idmascota = $_POST['idmascota'];
        $idservicio = $_POST['idservicio'];
        $numerodosis = $_POST['numerodosis'];
        $data = $this->actualizarEstadoDeVacunaModel($idmascota,$idservicio,$numerodosis);
        if($data>0){
            echo json_encode(array('status'=>true,'msg'=>'Se actualizó el estado de la dosis correctamente.'));
        }else{
            echo json_encode(array('status'=>false,'msg'=>'Sucedió un error al querer actualizar el estado'));
        }
    }

    public function obtenerUltimaVacunacion(){
        $idmascota = $_POST['idmascota'];
        $data = $this->obtenerUltimaVacunacionModel($idmascota);
        echo json_encode($data);
    }

}

$vacuna = new VacunaController();

switch ($_GET['opc']) {
    case 'buscarVacunas': $vacuna->buscarVacunas();  break;
    case 'buscarMascotaOmascotas': $vacuna->buscarMascotaOmascotas();  break;
    case 'buscarDatosVacunacionConID': $vacuna->buscarDatosVacunacionConID();  break;
    case 'actualizarEstadoDeVacuna': $vacuna->actualizarEstadoDeVacuna();  break;
    case 'obtenerVacunaPorID': $vacuna->obtenerVacunaPorID();  break;
    case 'obtenerUltimaVacunacion': $vacuna->obtenerUltimaVacunacion();  break;
}


?>