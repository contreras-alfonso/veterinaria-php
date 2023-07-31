<?php 
require('../models/clienteModel.php');

switch ($_GET['opc']) {
    case 'obtenerClientes':obtenerClientes(); break;
    case 'agregarCliente': agregarCliente(); break;
    case 'obtenerCliente': obtenerCliente(); break;
    case 'editarCliente': editarCliente(); break;
    case 'buscarDuenoPorDNI': buscarDuenoPorDNI(); break;
}

    function buscarDuenoPorDNI(){
        $cliente = new Cliente();
        $dniDueño = $_POST['dniDueño'];
        $data = $cliente->buscarDuenoPorDNIModel($dniDueño);
        if(empty($data)){
            echo json_encode(array('status'=>false,'msg'=>'No existe un cliente con el DNI ingresado.'));
        }else{
            echo json_encode(array('status'=>true,'arrData'=>$data));
        }
    }

    function obtenerClientes(){
        $cliente = new Cliente();
        $data = $cliente->obtenerClientesModel();
        for ($i=0; $i < count($data); $i++) { 
        //    $data[$i]['opciones']='<button type="button" onclick="editarCliente('.$data[$i]['idcliente'].')" class="btn rounded-pill btn-primary waves-effect waves-light">Editar</button>';
           $data[$i]['opciones']='<div class="dropdown">
           <button type="button" class="btn p-0 dropdown-toggle hide-arrow show" data-bs-toggle="dropdown" aria-expanded="true">
             <i class="ti ti-dots-vertical"></i>
           </button>
           <div class="dropdown-menu " data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(-106px, 23px);">
             <button class="dropdown-item" onclick="abrirModalEditarCliente('.$data[$i]['idcliente'].')"><i class="ti ti-pencil me-1"></i> Edit</button>
           </div>
         </div>';
        }
        echo json_encode($data);
    }
    
     function agregarCliente(){

        $cliente = new Cliente();
        $nombres = $_POST['modalEditUserFirstName'];
        $apellidos = $_POST['modalEditUserLastName'];
        $email = $_POST['modalEditUserEmail'];
        $direccion = $_POST['modalEditDireccion'];
        $celar = $_POST['modalEditUserPhone'];
        $dni = $_POST['modalEditDNI'];


        $data = $cliente->agregarClienteModel($nombres,$apellidos,$email,$direccion,$celar,$dni);

        if($data>0){
            $arrData = array('status'=>true,'msg'=>'Usuario agregado correctamente.');
        }else{
            $arrData = array('status'=>false,'msg'=>'Surgio un error.');
        }
        echo json_encode($arrData);

    }

    function editarCliente(){
        $cliente = new Cliente();
        $nombres = $_POST['modalEditUserFirstName'];
        $apellidos = $_POST['modalEditUserLastName'];
        $email = $_POST['modalEditUserEmail'];
        $direccion = $_POST['modalEditDireccion'];
        $celar = $_POST['modalEditUserPhone'];
        $dni = $_POST['modalEditDNI'];
        $idcliente = $_POST['idcliente'];

        $data = $cliente->editarClienteModel($nombres,$apellidos,$email,$direccion,$celar,$dni,$idcliente);

        if($data==0){
            $arrData = array('status'=>true,'msg'=>'Usuario editado correctamente.');
        }else{
            $arrData = array('status'=>false,'msg'=>'Surgio un error.');
        }
        echo json_encode($arrData);

    }

    function obtenerCliente(){
        $cliente = new Cliente();
        $idcliente = $_POST['idcliente'];
        $data = $cliente->obtenerClienteModel($idcliente);
        if(empty($data)){
            $arrResponse = array('status'=>false,'msg'=>'No se pudo obtener los datos del cliente.');
            echo json_encode($arrResponse);
        }else{
            echo json_encode($data);
        }

    }





?>