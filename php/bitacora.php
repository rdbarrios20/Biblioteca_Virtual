<?php
  require_once('../php/databaseConnection.php');
  $connection->set_charset('utf8');

  date_default_timezone_set('America/Bogota');
  $rol="Administrador";
  $id_user="1";
  $accion="modificacion";
  $fecha=date('y-m-d H:i:s'); 
  $detalle="Se modifico el registro 2089 las aventuras de felipe";

  $query=$connection->prepare("INSERT INTO bitacora (rol,id_usuario,accion,fecha,detalle) VALUES
  ('".$rol."','".$id_user."','".$accion."','".$fecha."','".$detalle."')");
  
  $query->execute();

  $connection->close();
?>