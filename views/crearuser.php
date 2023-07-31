<?php 
    require('../core/Mysql.php');
    $password = 'administrador56';
    $passwordHash = password_hash($password,true);

    $sql = "INSERT INTO usuarios(nombres,apellidos,correo,password,token,status) VALUES (?,?,?,?,?,?)";

    $array = array('Raciel Antonio','Levano Pachas','administrador@orejotasycolitas.com',$passwordHash,'',1);

    $mysql = new Mysql();

    // $status = $mysql->insert($sql,$array);
    $email = 'administrador@orejotasycolitas.com';
    $sql = "SELECT * FROM usuarios WHERE correo='$email'";
    $usuario = $mysql->select($sql);
    $password = 'administrador56';

    $vali = password_verify($password,$usuario['password']);
    echo "<pre>";
    print_r($usuario);
    echo "</pre>";

    echo $usuario['password'];
    echo "<br>";
    echo $vali

    
?>