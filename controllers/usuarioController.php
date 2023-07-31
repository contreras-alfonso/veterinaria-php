<?php 

require('../models/usuarioModel.php');

class UsuarioController extends UsuarioModel{
    public function buscarUsuario(){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $respuestaStatus = $this->buscarUsuarioModel($email,$password);
        if(!$respuestaStatus){
            $arrData = array('status'=>false,'msg'=>'Email o contraseña incorrecta.');
            echo json_encode($arrData);
            return;
        }
        session_start();
        $_SESSION['nombresUser'] = $respuestaStatus['nombres'];
        $_SESSION['apellidosUser'] = $respuestaStatus['apellidos'];
        $_SESSION['correoUser'] = $respuestaStatus['correo'];
        $_SESSION['login'] = 1;
        $arrData = array('status'=>true,'msg'=>'Bienvenido a Orejotas y Colitas.');
        echo json_encode($arrData);
    }
}

$usuario = new UsuarioController();
switch ($_GET['opc']) {
    case 'buscarUsuario': $usuario->buscarUsuario(); break;
}

?>