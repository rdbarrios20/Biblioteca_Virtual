
<?php
    include("bitacora.php");
    require_once("databaseConnection.php");
    $connection = OpenCon();
    $ide=$_POST['ide_libro'];

    session_start();
    $rol=$_SESSION['usuario']['tipo_usuario'];
    $id_usuario=$_SESSION['usuario']['id_usuario'];
    $accion="Eliminación";
    $detalle="Eliminación libro código:'".$ide."'";
    insert_bitacora($rol,$id_usuario,$accion,$detalle);

    $query=$connection->prepare("DELETE FROM libros WHERE CODIGO_LIBRO =?");
    $query->bind_param("s",$ide);
    $query->execute();
    echo "Registro eliminado con exito";
    CloseCon($connection);
?>