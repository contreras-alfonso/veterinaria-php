<?php 

require('../core/Mysql.php');

class UsuarioModel extends Mysql{
    public function buscarUsuarioModel($email,$password){
        //buscar el email
        $sql = "SELECT * FROM usuarios WHERE correo='$email'";
        $usuario = $this->select($sql);

        if(empty($usuario)){
            return false;
        }
        //validar las contraseñas
        $vali = password_verify($password,$usuario['password']);
        if($vali){
            return $usuario;
        }
        
    }
}


?>