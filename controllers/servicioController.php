<?php 

require('../models/servicioModel.php');

class ServicioController extends ServicioModel{
    public function agregarServicio(){
        $nombre = $_POST["agregarServicioModalNombre"];
        $duracion = $_POST["agregarServicioModalDuracion"];
        $precio = $_POST["agregarServicioModalPrecio"];
        $descripcion = $_POST["agregarServicioModalPrecioDescri"];

        $response = $this->agregarServicioModel($nombre,$duracion,$precio,$descripcion);

        if($response>0){
            $arrData = array('msg'=>'Se agregó correctamente el servicio.','status'=>true);
        }else{
            $arrData = array('msg'=>'Ocurrió un error al agregar el servicio.','status'=>false);
        }
        echo json_encode($arrData);
    }

    public function obtenerServicios(){
        $data = $this->obtenerServiciosModel();
        if(empty($data)){
            $arrData = array('status'=>false,'msg'=>'No se pudieron obtener los servicios.');
        }else{
            for ($i=0; $i < count($data); $i++) { 
                $data[$i]['opciones']='<div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow show" data-bs-toggle="dropdown" aria-expanded="true">
                  <i class="ti ti-dots-vertical"></i>
                </button>
                <div class="dropdown-menu " data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(-106px, 23px);">
                  <button class="dropdown-item" onclick="abrirModalEditarServicio('.$data[$i]['idservicio'].')"><i class="ti ti-pencil me-1"></i> Edit</button>
                </div>
              </div>';
             }
            $arrData = $data;
        }
        echo json_encode($arrData);
    }

    public function obtenerServicio(){
        $idservicio = $_POST['idservicio'];
        $data = $this->obtenerServicioModal($idservicio);
        if(empty($data)){
            $arrData = array('status'=>false,'msg'=>'No se pudo obtener el dato del servicio.');
        }else{
            $arrData = $data;
        }
        echo json_encode($arrData);
    }

    public function editarServicio(){
        $nombre = $_POST["editarServicioModalNombre"];
        $duracion = $_POST["editarServicioModalDuracion"];
        $precio = $_POST["editarServicioModalPrecio"];
        $descripcion = $_POST["editarServicioModalPrecioDescri"];
        $idservicio = $_POST["idservicio"];

        $response = $this->editarServicioModel($nombre,$duracion,$precio,$descripcion,$idservicio);

        if(!$response){
            $arrData = array('msg'=>'Se editó correctamente el servicio.','status'=>true);
        }else{
            $arrData = array('msg'=>'Ocurrió un error al editar el servicio.','status'=>false);
        }
        echo json_encode($arrData);
    }

    public function obtenerServiciosCheck(){
        $data = $this->obtenerServiciosModel();
        if(empty($data)){
            $arrData = array('status'=>false,'msg'=>'No se pudieron obtener los servicios.');
        }else{
            for ($i=0; $i < count($data); $i++) { 
                $data[$i]['opciones']='<input class="form-check-input checkServicio" type="checkbox" value="" id="defaultCheck3" data-nombre="'.$data[$i]['nombre'].'" data-precio="'.$data[$i]['precio'].'" data-duracion="'.$data[$i]['duracion'].'" data-id="'.$data[$i]['idservicio'].'" >';
             }
            $arrData = $data;
        }
        echo json_encode($arrData);
    }

    public function obtenerServiciosEditarCheck(){
        $data = $this->obtenerServiciosModel();
        if(empty($data)){
            $arrData = array('status'=>false,'msg'=>'No se pudieron obtener los servicios.');
        }else{
            for ($i=0; $i < count($data); $i++) { 
                $data[$i]['opciones']='<input class="form-check-input checkEditServicio" type="checkbox" value="" id="defaultCheck3" data-nombre="'.$data[$i]['nombre'].'" data-precio="'.$data[$i]['precio'].'" data-duracion="'.$data[$i]['duracion'].'" data-id="'.$data[$i]['idservicio'].'" >';
             }
            $arrData = $data;
        }
        echo json_encode($arrData);
    }
}

$servicio = new ServicioController();

switch ($_GET['opc']) {
    case 'agregarServicio': $servicio->agregarServicio(); break;
    case 'obtenerServicios': $servicio->obtenerServicios(); break;
    case 'obtenerServicio': $servicio->obtenerServicio(); break;
    case 'editarServicio': $servicio->editarServicio(); break;
    case 'obtenerServiciosCheck': $servicio->obtenerServiciosCheck(); break;
    case 'obtenerServiciosEditarCheck': $servicio->obtenerServiciosEditarCheck(); break;
}


?>