
<?php
//eventospor arreglar porque no funcionaba la edicion y el dragDrop
session_start();
header('Content-Type: application/json');
try{
    $pdo= new PDO("mysql:dbname= localhost;host=localhost","proyecto-one","root");
}catch(PDOException $e){
    echo 'error ' . $e->getMessage();    
}

$accion= (isset($_GET['accion'])) ? $_GET['accion']  : 'leer';
$idUsuario= $_SESSION['id_Paciente'];

switch($accion){
        case 'agregar':        
            if ($privilegio <= 1) {
                $sentenciaSQL = $pdo->prepare("INSERT INTO citas SET titulo =   :titulo,
                                                                 start  =   :start,
                                                                 end    =   :end,
                                                                 sesion =   :sesion,
                                                                 idPaciente =   :idPaciente");
                $sentenciaSQL->execute(array(
                ":titulo" =>$_POST['titulo'],
                ":start" =>$_POST['start'],
                ":end" =>$_POST['end'],
                ":sesion" => $_POST['sesion'],
                ":idPaciente" => $_POST['idPaciente']
                ));
            }else{
                $sentenciaSQL = $pdo->prepare("INSERT INTO citas SET titulo =   :titulo,
                                                                 start  =   :start,
                                                                 end    =   :end,
                                                                 sesion =   :sesion,
                                                                 idPaciente =   :idPaciente"
                                                             );
                $sentenciaSQL->execute(array(
                ":titulo" =>$_POST['titulo'],
                ":start" =>$_POST['start'],
                ":end" =>$_POST['end'],
                ":sesion" => $_POST['sesion'],
                ":idPaciente" => $idUsuario
                ));
            }
            //instruccion de agregar      
            
                    
            $respuesta['msg'] = 'Insertado correctamente' ;
            echo json_encode($respuesta, true);
            break;
        case 'eliminar':
            $respuesta=false;

        if(isset($_POST['id'])){
            $sentenciaSQL = $pdo->prepare("DELETE FROM citas WHERE ID= :ID");
            $respuesta = $sentenciaSQL->execute(array("ID"=>$_POST['id']));
        };
        //si le respuesta es true,se va a la funcion enviarinformacion
        echo json_encode($respuesta);
        break;

        case 'modificar':
            //instruccion de MODIFICAR UN EVENTO 
            if ($privilegio == 2) {
                if(isset($_POST['id'])){

                $sentenciaSQL=$pdo->prepare("UPDATE citas SET titulo= :titulo,
                             start = :start,end = :end, sesion = :sesion, idPaciente = :idPaciente
                WHERE idPaciente = :idPaciente");
                }
                
                $respuesta= $sentenciaSQL->execute(array("id" =>$_POST['id'],
                            ":titulo" =>$_POST['titulo'],
                            ":start" =>$_POST['start'],
                            ":end" =>$_POST['end'],
                            ":sesion" =>$_POST['sesion'],
                            ":idPaciente" =>$idUsuario));

            }
                echo json_encode($respuesta);

                break;
            
            
        break;
        default:    
        //seleccionar los eventos del calendario
        if ($privilegio == 2) {
            $sentenciaSQL= $pdo->prepare("SELECT * FROM citas where idPaciente = ?");
            $sentenciaSQL->bindParam(1,$idUsuario,PDO::PARAM_INT);
        }else{
            $sentenciaSQL= $pdo->prepare("SELECT * FROM citas");
        }
            
        $sentenciaSQL->execute();

        $resultado= $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($resultado);          
        break;

}