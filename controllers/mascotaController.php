<?php 
require('../models/mascotaModel.php');
class MascotaController extends MascotaModel{

    public function agregarMascota(){
        $nacimiento = $_POST["modalMascotaNacimiento"];
        $raza = $_POST["modalMascotaRaza"];
        $especie = $_POST["modalMascotaEspecie"];
        $peso = $_POST["modalMascotaPeso"];
        $nombre = $_POST["modalMascotaNombre"];
        $info_adicional = '';
        $idcliente = $_POST["modalMascotaSelectClientes"];

        $response = $this->agregarMascotaModel($nacimiento,$raza,$especie,$peso,$nombre,$info_adicional,$idcliente);
        if($response>0){
            $arrData = array('status'=>true,'msg'=>'Mascota agregada correctamente.');
        }else{
            $arrData = array('status'=>false,'msg'=>'Ocurrio un error.');
        }
        echo json_encode($arrData);
    }

    public function obtenerMascotas(){
        $data = $this->obtenerMascotasModel();
        for ($i=0; $i < count($data); $i++) { 
            //    $data[$i]['opciones']='<button type="button" onclick="editarCliente('.$data[$i]['idcliente'].')" class="btn rounded-pill btn-primary waves-effect waves-light">Editar</button>';
               $data[$i]['opciones']='<div class="dropdown">
               <button type="button" class="btn p-0 dropdown-toggle hide-arrow show" data-bs-toggle="dropdown" aria-expanded="true">
                 <i class="ti ti-dots-vertical"></i>
               </button>
               <div class="dropdown-menu " data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(-106px, 23px);">
                 <button class="dropdown-item" onclick="abrirModalEditarMascota('.$data[$i]['idmascota'].')"><i class="ti ti-pencil me-1"></i> Edit</button>
               </div>
             </div>';
            }
        echo json_encode($data);
    }

    public function obtenerMascotasYSusDueños(){
        $data = $this->obtenerMascotasYSusDueñosModel();
        for ($i=0; $i < count($data); $i++) { 
            //    $data[$i]['opciones']='<button type="button" onclick="editarCliente('.$data[$i]['idcliente'].')" class="btn rounded-pill btn-primary waves-effect waves-light">Editar</button>';
               $data[$i]['opciones']='<div class="dropdown">
               <button type="button" class="btn p-0 dropdown-toggle hide-arrow show" data-bs-toggle="dropdown" aria-expanded="true">
                 <i class="ti ti-dots-vertical"></i>
               </button>
               <div class="dropdown-menu " data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(-106px, 23px);">
                 <button class="dropdown-item" onclick="abrirModalEditarMascota('.$data[$i]['idmascota'].')"><i class="fa-solid fa-pencil"></i> Edit</button>
                 <button class="dropdown-item" onclick="verHistorialMedico('.$data[$i]['idmascota'].')"><i class="fa-solid fa-file-waveform"></i> Historial</button>
               </div>
             </div>';
            }
        echo json_encode($data);
    }

    public function obtenerMascotaYSusDueño(){
        $idmascota = $_POST['idmascota'];
        $data = $this->obtenerMascotaYSusDueñoModel($idmascota);
        echo json_encode($data);
    }

    public function obtenerMascota(){
        $idmascota = $_POST['idmascota'];
        $data = $this->obtenerMascotaModel($idmascota);
        if(empty($data)){
            $arrResponse = array('msg'=>'Surgio un error al obtener las mascotas.','status'=>false);
        }else{
            $arrResponse = $data;
        }
        echo json_encode($arrResponse);
    }

    public function editarMascota(){
        $nacimiento = $_POST["modalMascotaNacimiento"];
        $raza = $_POST["modalMascotaRaza"];
        $especie = $_POST["modalMascotaEspecie"];
        $peso = $_POST["modalMascotaPeso"];
        $nombre = $_POST["modalMascotaNombre"];
        $info_adicional = '';
        $idcliente = $_POST["modalMascotaSelectClientes"];
        $idmascota = $_POST["idmascota"];

        $response = $this->editarMascotaModel($nacimiento,$raza,$especie,$peso,$nombre,$info_adicional,$idcliente,$idmascota);
        if($response){
            $arrData = array('status'=>true,'msg'=>'Información de la mascota editada correctamente.');
        }else{
            $arrData = array('status'=>false,'msg'=>'Ocurrio un error.');
        }
        echo json_encode($arrData);
    }
}

$mascota = new MascotaController();
switch ($_GET['opc']) {
    case 'agregarMascota': $mascota->agregarMascota(); break;
    case 'obtenerMascotas': $mascota->obtenerMascotas(); break;
    case 'obtenerMascota': $mascota->obtenerMascota(); break;
    case 'editarMascota': $mascota->editarMascota(); break;
    case 'obtenerMascotasYSusDueños': $mascota->obtenerMascotasYSusDueños(); break;
    case 'obtenerMascotaYSusDueño': $mascota->obtenerMascotaYSusDueño(); break;
}

?>