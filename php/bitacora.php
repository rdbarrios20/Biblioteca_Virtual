<?php
  require_once('../php/databaseConnection.php');
  $connection->set_charset('utf8');

  $rol="Administrador";
  $id_user="1";
  $accion="modificacion";
  $fecha="2020/03/22";
  $detalles="Se modifico el registro 2089 las aventuras de felipe";

  
  $query=$connection->prepare("INSERT INTO bitacora (rol,id_usuario,accion,fecha,detalle) VALUES
  ('".$rol."','".$id_user."','".$accion."','".$fecha."','".$detalle."')");

  

?>