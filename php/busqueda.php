<?php
    require("databaseConnection.php");
    $connection=OpenCon();
    $q = $_POST['texto'];
        $query = '';

    if (isset($q) && $q != '') {
        //Executar la consulta con criterios
        $query = "SELECT CODIGO_LIBRO,AUTOR,NOMBRE_LIBRO,FECHA_EXPEDICION,DISPONIBILIDAD,PRECIO_PUBLICO,PRECIO_INTERNO,RESERVADO,CANTIDAD FROM LIBROS WHERE CODIGO_LIBRO LIKE '%" . $q . "%' OR NOMBRE_LIBRO LIKE '%" . $q . "%' ";
    } else {
        //Executar la consulta sin criterios
        $query = "SELECT * FROM LIBROS ORDER BY CODIGO_LIBRO";
    }


    $result = $connection->query($query);
    $arrayList = [];
    $isSuccess = false; //VARAIBALE QUE VAMOS A USAR PARA INDICARLE AL FRONT SI EXISTEN COICIDENCIAS O NO

    if (isset($result->num_rows) &&  $result->num_rows > 0) {

         while ($item = $result->fetch_assoc()) {
            array_push($arrayList, $item);

        }
     $isSuccess = true;
   
    } 

    // Version: Responsidento en formato JSON
    $response = array('success' => $isSuccess, 'result' => $arrayList);
    header('content-type: application/json'); // This line makes no difference.
    echo json_encode($response);


    // Cerrar conection al final
    CloseCon($connection);

?>
