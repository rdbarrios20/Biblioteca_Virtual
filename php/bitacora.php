<?php
    //funcion para insertar datos a la tabla bitac4ora.
    require("databaseConnection.php");

    //include 'databaseConnection.php';
    //Comprobamos que el valor funcion no venga vacío
    if(isset($_POST['funcion']) && !empty($_POST['funcion'])) {
        $funcion = $_POST['funcion'];
        //$fecha=$_POST['fecha'];

        switch($funcion) {
            case 'listar': 
                    $result = read_bitacora();
                    echo json_encode($result);
                break;
            case 'eliminar': 
                    $fecha = $_POST['_fecha'];
                    $result = eliminar($fecha);
                break;
        }
    }

    
    function insert_bitacora($rol,$id_usuario,$accion,$detalle){
        
        $connection = OpenCon();
        $connection->set_charset('utf8');
        date_default_timezone_set('America/Bogota');
        $fecha_creacion = date('y-m-d H:i:s');
        $query = $connection->prepare("INSERT INTO bitacora (rol,id_usuario,accion,fecha,detalle) VALUES
        (?,?,?,?,?)");
        $query->bind_param("sisss",$rol,$id_usuario,$accion,$fecha_creacion,$detalle);
        $query->execute();
      
        CloseCon($connection);
    }
    
    //Funcion para leer los datos ubicados en la tabla bitacora.
    function read_bitacora(){
        $connection = OpenCon();
        $connection->set_charset('utf8');
    
        $query = $connection->prepare("SELECT * FROM bitacora ORDER BY fecha DESC");
        $query->execute();
        
        $array=[];
        $success=false;
        $result=$query->get_result();
        if(isset($result->num_rows)&& $result->num_rows>0){
            while($item=$result->fetch_assoc()){
                array_push($array,$item);
            }
            $success=true;
        }
        
       CloseCon($connection);
       
       return (array('success'=>$success,'result'=>$array));
    
    } 

    function eliminar($fecha){
        $connection = OpenCon();
        $connection->set_charset('utf8');

        if(isset($fecha) && !empty($fecha)){
    
            $query = $connection->prepare("DELETE FROM bitacora WHERE fecha < ?");
            $query->bind_param("s",$fecha);
            $query->execute();

            session_start();
            $rol=$_SESSION['usuario']['tipo_usuario'];
            $id_usuario=$_SESSION['usuario']['id_usuario'];
            $accion="Eliminación";
            $detalle="Eliminación bitacora fecha:'".$fecha."'";
            insert_bitacora($rol,$id_usuario,$accion,$detalle);
            
            echo "Datos eliminados exitosamente";
        }else{
            echo "ingrese una fecha valida";
        }
        CloseCon($connection);   
    }
   

?>