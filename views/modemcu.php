<?php 

    require('../core/Mysql.php');

    $mysql = new Mysql();

    $temperatura = $_GET['temperatura'];
    $humedad = $_GET['humedad'];

    $sql = "INSERT INTO modemcu(temperatura,humedad) VALUES (?,?)";

    $arrData = array('53','10');
    $arrData = array($temperatura,$humedad);

    $response = $mysql->insert($sql,$arrData);

    echo "hola mundooo";


?>