<?php require_once("../php/databaseConnection.php") ?>

<?php

$q = $_POST['texto'];
$query = '';

if (isset($q) && $q != '') {
    //Executar la consulta con criterios
    $query = "SELECT CODIGO_LIBRO,AUTOR,NOMBRE_LIBRO,FECHA_EXPEDICION,DISPONIBILIDAD,PRECIO_PUBLICO,PRECIO_INTERNO,RESERVADO,CANTIDAD FROM LIBROS WHERE CODIGO_LIBRO LIKE '%" . $q . "%' OR NOMBRE_LIBRO LIKE '%" . $q . "%' ";
} else {
    //Executar la consulta sin criterios
    $query = "SELECT * FROM LIBROS ORDER BY CODIGO_LIBRO";
}

//TARIA: Estudiar el principo KISS:
// Capa 8.


// $resultado = $link->query($query);
$tableEnHtml = "<script>

function eliminar(ide){
    var opcion = confirm('Realemente desea eliminar el registro');
    if (opcion == true) {
     $.ajax({
        url:'php/eliminar.php',
        type:'POST',
        data:{
            ide_libro: ide,
        },
        success:function(response){
            alert(response);
            location.reload();
        },
        error:function(response){

        }
      });  

    } 
      else {
	    return false;
	  }
    
}
    </script>";
$result = $connection->query($query);

if (isset($result->num_rows) &&  $result->num_rows > 0) {

    // Ejercicio de concatenacion
    // $a = 'rafa';
    // $c = $a . ' '. 'barrios';
    // $b = ' david ';
    // $c .= $b; 
    // echo($c);

    $tableEnHtml .= "
    <table class='table table-striped table-bordered'>
                <thead class='thead-light'>
                    <tr>
                        <td>código Libro</td>
                        <td>Autor</td>
                        <td>Nombre Libro</td>
                        <td>Fecha Expedición</td>
                        <td>Disponibilidad</td>
                        <td>Precio Publico</td>
                        <td>Precio Interno</td>
                        <td>Reservado</td>
                        <td>Cantidad</td>
                        <td>Eliminar</td>
                        <td>Editar</td>
                    </tr>
                </thead>
                <tbody>";
     while ($item = $result->fetch_assoc()) {
        $codigo = $item['CODIGO_LIBRO'];
        $tableEnHtml .= "<tr>
                    <td>" . $item['CODIGO_LIBRO'] . "</td>
                    <td>" . $item['AUTOR'] . "</td>
                    <td>" . $item['NOMBRE_LIBRO'] . "</td>
                    <td>" . $item['FECHA_EXPEDICION'] . "</td>
                    <td>" . $item['DISPONIBILIDAD'] . "</td>
                    <td>" . '$' . $item['PRECIO_PUBLICO'] . "</td>
                    <td>" . '$ ' . $item['PRECIO_INTERNO'] . "</td>
                    <td>" . $item['RESERVADO'] . "</td>
                    <td>" . $item['CANTIDAD'] . "</td>
                    <td> <button id='btn_busqueda' onclick='eliminar($codigo)' class='btn btn-danger' ><i class='glyphicon glyphicon-trash'></i></button></td>
                    <td> <button id='btn_busqueda' onclick='' class='btn btn-success' ><i class='glyphicon glyphicon-pencil'></i></button></td>
            </tr>";
     }
      
         $tableEnHtml .= "</tbody>
    </table>";
} else {
    $tableEnHtml = "No se encontraron coincidencias";
}



// Version mostrar un documento html independie
// echo $tableEnHtml;

// Version: Responsidento en formato JSON
$response = array('success' => true, 'result' => $tableEnHtml);
header('content-type: application/json'); // This line makes no difference.
echo json_encode($response);


// Cerrar conection al final
$connection->close();
?>
