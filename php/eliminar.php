
<?php
    include 'databaseConnection';
    require_once('bitacora.php');

    $id_rol= $_SESSION['id_usuario'];
    $rol=$_SESSION['tipo_usuario'];
    $accion="Eliminacion";
    $ide=$_POST['id_libro'];

    $detalle="Eliminacion libro codigo:'".$ide."'";

    insert_bitacora($id_rol,$rol,$accion,$detalle);

    $query="DELETE FROM libros WHERE CODIGO_LIBRO ='$ide'";

    $result = $connection->query($query);

    echo "Registro eliminado con exito";

?>