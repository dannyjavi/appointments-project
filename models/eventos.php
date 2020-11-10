<?php
session_start();
header('Content-Type: application/json');
$pdo= new PDO("mysql:dbname= localhost;host=localhost","root","");

$accion= (isset($_GET['accion']))? $_GET['accion']:'leer';
$privilegio =   $_SESSION['tipo_paciente'];
$idUsuario = $_SESSION['id_Paciente'];
require '../funcs/funcs.php';
$titulo = Limpiar($_POST['titulo']);
$start = Limpiar($_POST['start']);
$end = Limpiar($_POST['end']);
$sesion = Limpiar($_POST['sesion']);
$id = Limpiar($_POST['id']);

switch($accion){
    case 'agregar':
        
        $sentenciaSQL = $pdo->prepare("INSERT INTO citas (titulo,start,end,sesion,idPaciente)
        VALUES(:titulo,:start,:end,:sesion,:idPaciente)");
        
        if ($privilegio === 1) {
            $respuesta=$sentenciaSQL->execute(array("titulo" =>$_POST['titulo'],
                                                "start"    => $_POST['start'],
                                                "end"  =>  $_POST['end'],
                                                "sesion"  =>  $_POST['sesion'],
                                                "idPaciente"    => $_POST['idPaciente']
                    ));
         }else{
            $respuesta=$sentenciaSQL->execute(array("titulo" =>$titulo,
                                                "start"    => $start,
                                                "end"   => $end,
                                                "sesion"  =>  $sesion,
                                                "idPaciente"  =>  $idUsuario
                    ));
         }
        
        echo json_encode($respuesta);

        break;
    case 'modificar':

        if (isset($_POST['id'])) {
            $sentenciaSQL = $pdo->prepare("UPDATE citas SET titulo = :titulo,
                                                            start   =   :start,
                                                            end     =   :end,
                                                            sesion  =   :sesion,
                                                            idPaciente  =   :idPaciente
                                                         WHERE id = :id");
          
        }
        
        if ($privilegio == 2) {
                 $respuesta=$sentenciaSQL->execute(array("titulo" =>$titulo,
                                                "id"    => $id,
                                                "start"    =>   $start,
                                                "end"   => $end,
                                                "sesion"  =>  $sesion,
                                                "idPaciente"  =>  $idUsuario
                                                ));
             }else{
                $respuesta=$sentenciaSQL->execute(array("titulo" =>$_POST['titulo'],
                                                "id"    => $_POST['id'],
                                                "start"    => $_POST['start'],
                                                "end"   => $_POST['end'],
                                                "sesion"  =>  $_POST['sesion'],
                                                "idPaciente"  => $_POST['idPaciente']
                                                ));
        }

        echo json_encode($respuesta);        

        break;
    case 'eliminar':
        $respuesta=false;

        if(isset($_POST['id'])){
            $sentenciaSQL = $pdo->prepare("DELETE FROM citas WHERE id = :id");
            $respuesta = $sentenciaSQL->execute(array("id"=>$id));
        };
        
        echo json_encode($respuesta);//si le respuesta es true,se va a la funcion enviarinformacion

        break;        
    default:    
        //seleccionar los eventos del calendario
       $sentenciaSQL= $pdo->prepare("SELECT pacientes.idPaciente,pacientes.nombre,citas.id,citas.start,citas.end,citas.titulo,citas.sesion,citas.idPaciente FROM citas inner join pacientes ON citas.idPaciente = pacientes.idPaciente");
        $sentenciaSQL->execute();

        $resultado= $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($resultado);          
        break;
}
?>
