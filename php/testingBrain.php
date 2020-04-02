//Collections 
$person = [
    'nombre' => 'paco',
    'apellido' => 'sin fortuna', 
    'casas' => [
        'casa1' => '450 anos', 
        'casa2' => 'populandoia'
    ],
    'familiares' => [
        'tios' => [
            '1' => 'Carlos',
            '2' => 'Carlos',
            '3' => 'Carlos',
            '4' => 'Carlos',
            '5' => 'Carlos',
        ], 
        'hermanos' => null
    ]
 ]
 // En php. Con clases previamentes definidas
 //  $person['familiares']['tios']['4'];
$person->nombre->familiares->tios;
// En php. Collection dinamicas
$person['nombre']['familiares']['tios'];


fase 4 eliminacion de libros.
cada registro al consultarlo debe tener una opcion dentro de la columna eliminacion para proceder a remover el libro por codigo.
el sistema debe preguntarle al usuario primero si el desea confirmar.
tips :
utilizar comfirm function de javascript.
ejecutar la sentencia delete para eliminar un libro por codigo,