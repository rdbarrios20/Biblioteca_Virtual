<?php

    function abrirCon(){
        $server="localhost";
        $user="root";
        $password="";
        $database="biblioteca";
        
        $connection =mysqli_connect($server,$user,$password,$database);
        
        if($connection==false){
            die('No se pudo hacer la conexion');
        }

        return $connection;
    }

    function cerrarCon($c){
        $c->close();
    }

?>