<?php 
require('../models/citaModel.php');

class CitaController extends CitaModel{
    public function crearCita(){
        $idmascota = $_POST["mascotaNuevaCitaModal"];
        $fecha_atencion = $_POST["fechaNuevaCitaModal"];
        $hora_programada = $_POST["horaNuevaCitaModal"];
        $idveterinario = $_POST["veterinarioNuevaCitaModal"];
        $idservicios = $_POST["idservicios"];
        $hora_terminacion_esperada = $_POST["hora_terminacion_esperada"];
        
        $response = $this->crearCitaModel($idmascota,$fecha_atencion,$hora_programada,$idveterinario,$idservicios,$hora_terminacion_esperada);

        if($response>0){
            $arrData = array('status'=>true,'msg'=>'Cita generada correctamente.');
        }else{
            $arrData = array('status'=>false,'msg'=>'No se pudo generar la cita.');
        }
        echo json_encode($arrData);
    }

    public function editarCita(){
        $fecha_atencion = $_POST["fechaEditarCitaModal"];
        $hora_programada = $_POST["horaEditarCitaModal"];
        $idveterinario = $_POST["veterinarioNuevaCitaModal"];
        $idservicios = $_POST["idservicios"];
        $hora_terminacion_esperada = $_POST["hora_terminacion_esperada"];
        $idcita = $_POST["idcita"];

        $response = $this->editarCitaModel($fecha_atencion,$hora_programada,$idveterinario,$idservicios,$hora_terminacion_esperada,$idcita);

        if($response>0){
            $arrData = array('status'=>true,'msg'=>'Cita actualizada correctamente.');
        }else{
            $arrData = array('status'=>false,'msg'=>'No se pudo actualizar la cita.');
        }
        echo json_encode($arrData);
    }



    public function obtenerCitas(){
        $data = $this->obtenerCitasModel();
        echo json_encode($data);
    }

    public function obtenerCitasPorFecha(){
        $fecha_atencion = $_POST['fecha_atencion'];
        $response = $this->obtenerCitasPorFechaModel($fecha_atencion);
        echo json_encode($response);
    }

    public function obtenerCitasRelacionadas(){
        $data = $this->obtenerCitasRelacionadasModel();
        for ($i=0; $i < count($data) ; $i++) { 

            if($data[$i]['estado']==2){
            $data[$i]['opciones']='<div class="dropdown">
            <button type="button" class="btn p-0 dropdown-toggle hide-arrow show" data-bs-toggle="dropdown" aria-expanded="true">
              <i class="ti ti-dots-vertical"></i>
            </button>
            <div class="dropdown-menu " data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(-106px, 23px);">
              <button class="dropdown-item" onclick="abrirModalEditarCita('.$data[$i]['idcita'].')"><i class="ti ti-pencil me-1"></i> Edit</button>
            </div>
          </div>';
        }else if($data[$i]['estado']==1){
            $data[$i]['opciones']='<div class="dropdown">
            <button type="button" class="btn p-0 dropdown-toggle hide-arrow show" data-bs-toggle="dropdown" aria-expanded="true">
              <i class="ti ti-dots-vertical"></i>
            </button>
            <div class="dropdown-menu " data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(-106px, 23px);">
              <button class="dropdown-item" onclick="abrirModalAgregarDetallesCita('.$data[$i]['idcita'].')"><i class="ti ti-pencil me-1"></i> Agregar detalles</button>
            </div>
          </div>';
        }else{
            $data[$i]['opciones']='';
        }

            switch ($data[$i]['estado']) {
                case '3': $data[$i]['estado']='<span  class=" badge bg-label-success">Cita realizada</span>'; break;
                case '2': $data[$i]['estado']='<span onclick="abrirModalCambiarEstado('.$data[$i]['idcita'].')" class="cursor-pointer  badge bg-label-primary">Cita pendiente</span>'; break;
                case '0': $data[$i]['estado']='<span  class=" badge bg-label-danger">Cita cancelada</span>'; break;
                case '1': $data[$i]['estado']='<span  class=" badge bg-label-success">Cita realizada</span>'; break;
            }
        }
        echo json_encode($data);
    }

    public function cambiarEstadoCita(){
        $idcita = $_POST["idcita"];
        $estado = $_POST["estado"];
        $data = $this->cambiarEstadoCitaModel($idcita,$estado);
        if($data!=0){
            echo json_encode(array('status'=>true,'msg'=>'Se actualizó correctamente el estado de la cita.'));
        }else{
            echo json_encode(array('status'=>false,'msg'=>'Surgio un error al quere actualizar la cita.'));
        }
    }

    public function obtenerDatosConIdCita(){
        $idcita = $_POST["idcita"];
        $data = $this->obtenerDatosConIdCitaModel($idcita);
        echo json_encode($data);

    }

    public function obtenerCitasConIdMascota(){
        $idmascota = $_POST["idmascota"];
        $data = $this->obtenerCitasConIdMascotaModel($idmascota);
        echo json_encode($data);
    }

    public function agregarDetalleCita(){
        $medicinas = $_POST["medicinasAplicadas"];
        $antecedentes = $_POST["antecedentes"];
        $tratamiento = $_POST["tratamiento"];
        $motivo = $_POST["motivo"];
        $idcita = $_POST["idcita"];

        $data = $this->agregarDetalleCitaModel($medicinas,$antecedentes,$tratamiento,$motivo,$idcita);

        if($data!=0){
            echo json_encode(array('status'=>true,'msg'=>'Se agregó los detalles adicionales de la cita.'));
        }else{
            echo json_encode(array('status'=>false,'msg'=>'Surgio un error al querer agregar detalles de la cita.'));
        }
    }
}

$cita = new CitaController();
switch ($_GET['opc']) {
    case 'crearCita': $cita->crearCita(); break;
    case 'obtenerCitas': $cita->obtenerCitas(); break;
    case 'obtenerCitasPorFecha': $cita->obtenerCitasPorFecha(); break;
    case 'obtenerCitasRelacionadas': $cita->obtenerCitasRelacionadas(); break;
    case 'cambiarEstadoCita': $cita->cambiarEstadoCita(); break;
    case 'obtenerDatosConIdCita': $cita->obtenerDatosConIdCita(); break;
    case 'editarCita': $cita->editarCita(); break;
    case 'obtenerCitasConIdMascota': $cita->obtenerCitasConIdMascota(); break;
    case 'agregarDetalleCita': $cita->agregarDetalleCita(); break;
}
?>