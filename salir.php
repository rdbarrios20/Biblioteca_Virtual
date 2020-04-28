<?php
    include("./php/bitacora.php");
    session_start();
    $rol=$_SESSION['usuario']['tipo_usuario'];
    $id_usuario=$_SESSION['usuario']['id_usuario'];
    $accion="Cerrar Sesión";
    $detalle="Cerro Sesión";
    insert_bitacora($rol,$id_usuario,$accion,$detalle);

    session_destroy();

    header('location: index.php');
?>