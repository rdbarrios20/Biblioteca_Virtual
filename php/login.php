 <?php
    //Realizamos una peticion ajax 
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        //Requerimos el archivo que contine la connexion asi que lo llamamos
        require_once("../php/databaseConnection.php");
        //Sleep nos permite retardar el acceso de la validacion unos segundos para hacerlo mas modal 
        sleep(1);

        session_start();

        //Aqui le damos a la conexion un escape de caracteres de tipo utf8
        $connection->set_charset('utf8');
        //creamos dos variables para almacenar los datos con los que validaremos y los escapamos con la api de real_escape_string
        $usser = $connection->real_escape_string($_POST['user']);
        $pass = $connection->real_escape_string($_POST['pasword']);

        //Creamos una variable que llamaremos nueva consulta y esta asu vez le enviamos parametros por bind_param y en la consulta cambiamos las variables por ?
        if ($new_query = $connection->prepare("SELECT nombre_apellido,tipo_usuario FROM usuarios WHERE usuario =? AND pasword=?")) {
            //new_query tiene por parametro dos ss por que ambas variables son de tipo string
            $new_query->bind_param('ss', $usser, $pass);
            //Ejecutamos la consulta
            $new_query->execute();
            //Creamos lavariable result que nos guarde la consulta que asu vez la obtenga
            $result = $new_query->get_result();

            if ($result->num_rows == 1) {
                $datos = $result->fetch_assoc();
                $_SESSION['usuario'] = $datos;
                echo json_encode(array('validation' => false, 'tipo' => $datos['tipo_usuario']));
            } else {
                $message = "Usuario o Contraseña errados";
                echo json_encode(array('validation' => true, 'message' => $message));
            }
            //cerramos la conexion de la consulta
            $new_query->close();
        }
    }
    //Cerramos todas las conexiones
    $connection->close();
    ?>