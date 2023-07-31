<?php 

require('../models/veterinarioModel.php');

class VeterinarioController extends VeterinarioModel{
    public function agregarVeterinario(){

        $nombres = $_POST['agregarVetModalNombre'];
        $apellidos = $_POST['agregarVetModalApellidos'];
        $email = $_POST['agregarVetModalEmail'];
        $nacimiento = $_POST['agregarVetModalNacimiento'];
        $dni = $_POST['agregarVetModalDNI'];
        $telefono = $_POST['agregarVetModalTelefono'];

        $response = $this->agregarVeterinarioModel($nombres,$apellidos,$email,$nacimiento,$dni,$telefono);

        if($response>0){
            $arrData = array('msg'=>'Se agregó correctamente al veterinario.','status'=>true);
        }else{
            $arrData = array('msg'=>'Ocurrió un error al agregar al veterinario.','status'=>false);
        }
        echo json_encode($arrData);
    }

    public function obtenerVeterinarios(){
        $data = $this->obtenerVeterinariosModel();
        for ($i=0; $i < count($data); $i++) { 
               $data[$i]['opciones']='<div class="dropdown">
               <button type="button" class="btn p-0 dropdown-toggle hide-arrow show" data-bs-toggle="dropdown" aria-expanded="true">
                 <i class="ti ti-dots-vertical"></i>
               </button>
               <div class="dropdown-menu " data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(-106px, 23px);">
                 <button class="dropdown-item" onclick="abrirModalEditarVeterinario('.$data[$i]['idveterinario'].')"><i class="ti ti-pencil me-1"></i> Edit</button>
               </div>
             </div>';
            }
        echo json_encode($data);
    }

    public function obtenerVeterinario(){
        $idveterinario = $_POST['idveterinario'];
        $data = $this->obtenerVeterinarioModal($idveterinario);
        if(empty($data)){
            $arrData = array('status'=>false,'msg'=>'No se pudo obtener el veterinario seleccionado.');
        }else{
            $arrData = $data;
        }
        echo json_encode($arrData);

    }

    public function editarVeterinario(){
        $nombres = $_POST['editarVetModalNombre'];
        $apellidos = $_POST['editarVetModalApellidos'];
        $email = $_POST['editarVetModalEmail'];
        $nacimiento = $_POST['editarVetModalNacimiento'];
        $dni = $_POST['editarVetModalDNI'];
        $telefono = $_POST['editarVetModalTelefono'];
        $idveterinario = $_POST['idveterinario'];

        $response = $this->editarVeterinarioModel($nombres,$apellidos,$email,$nacimiento,$dni,$telefono,$idveterinario);

        if($response){
            $arrData = array('msg'=>'Se editó correctamente.','status'=>true);
        }else{
            $arrData = array('msg'=>'Ocurrió un error al editar al veterinario.','status'=>false);
        }
        echo json_encode($arrData);
    }
}

$veterinario = new VeterinarioController();

switch ($_GET['opc']) {
    case 'agregarVeterinario': $veterinario->agregarVeterinario(); break; 
    case 'obtenerVeterinarios': $veterinario->obtenerVeterinarios(); break; 
    case 'obtenerVeterinario': $veterinario->obtenerVeterinario(); break; 
    case 'editarVeterinario': $veterinario->editarVeterinario(); break; 
}

?>