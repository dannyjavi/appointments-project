<?php
session_start();
header('Content-Type: application/json');
$pdo= new PDO("mysql:dbname= localhost;host=localhost","root","");

$accion= (isset($_GET['accion']))? $_GET['accion']:'leer';
$privilegio =   $_SESSION['tipo_paciente'];

switch($accion){
    case 'agregar':
        
        $sentenciaSQL = $pdo->prepare("INSERT INTO misEventos (titulo,start,end)
        VALUES(:titulo,:start,:end");
        
        if ($privilegio === 1) {
            $respuesta=$sentenciaSQL->execute(array("titulo" =>$_POST['titulo'],
                                                "start"    => $_POST['start'],
                                                "end"  =>  $_POST['end'],
                                                
                    ));
         }
        
        echo json_encode($respuesta);

        break;
    case 'modificar':

        if (isset($_POST['id'])) {
            $sentenciaSQL = $pdo->prepare("UPDATE misEventos SET titulo = :titulo,
                                                            start   =   :start,
                                                            end     =   :end
                                                            
                                                         WHERE id = :id");
          
        }
        
        echo json_encode($respuesta);        

        break;
    case 'eliminar':
        $respuesta=false;

        if(isset($_POST['id'])){
            $sentenciaSQL = $pdo->prepare("DELETE FROM misEventos WHERE id = :id");
            $respuesta = $sentenciaSQL->execute(array("id"=>$_POST['id']));
        };
        
        echo json_encode($respuesta);//si le respuesta es true,se va a la funcion enviarinformacion

        break;        
    default:    
        if ($privilegio == 1) {
            
        //seleccionar los eventos del calendario
        $sentenciaSQL= $pdo->prepare("SELECT * FROM misEventos");
       }

        $sentenciaSQL->execute();

        $resultado= $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($resultado);          
        break;
}
?>
