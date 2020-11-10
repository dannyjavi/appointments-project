<?php
declare (strict_types = 1);
// Si no se ha enviado nada por el POST y se intenta acceder al archivo se retornará a la página de inicio
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    require_once '../models/Personas.php';
    $persona = new Personas();
    $opcion  = $_POST['opcion'];
    $idPaciente      = intval($_POST['idPaciente']);
    $idDiagnostico      = intval($_POST['idDiagnostico']);
    $nombre  = $persona->Limpiar($_POST['nombre']);
    $apellido  = $persona->Limpiar($_POST['apellido']);
    $apellido2  = $persona->Limpiar($_POST['apellido2']);
    $nacimiento  = $persona->Limpiar($_POST['nacimiento']);
    $nif  = $persona->Limpiar($_POST['nif']);
    $direccion  = $persona->Limpiar($_POST['direccion']);
    $cp  = $persona->Limpiar($_POST['cp']);
    $telefono  = $persona->Limpiar($_POST['telefono']);
    $profesion  = $persona->Limpiar($_POST['profesion']);
    $email  = $persona->Limpiar($_POST['email']);
    $antecedentes  = $persona->Limpiar($_POST['antecedentes']);
    $ttoprevio  = $persona->Limpiar($_POST['ttoprevio']);
    $diagnostico  = $persona->Limpiar($_POST['diagnostico']);
    $tratamiento  = $persona->Limpiar($_POST['tratamiento']);
    $tipo   =   $persona->Limpiar($_POST['tipo']);
    $agravante   =   $persona->Limpiar($_POST['agravante']);
    $hernia   =   $persona->Limpiar($_POST['hernia']);
    $restriccion   =   $persona->Limpiar($_POST['restriccion']);
    $antialgica   =   $persona->Limpiar($_POST['antialgica']);
    $territorio   =   $persona->Limpiar($_POST['territorio']);
    $testing   =   $persona->Limpiar($_POST['testing']);
    $reflejos   =   $persona->Limpiar($_POST['reflejos']);
    $lasegue   =   $persona->Limpiar($_POST['lasegue']);
    $palpacion   =   $persona->Limpiar($_POST['palpacion']);
    $balanceart   =   $persona->Limpiar($_POST['balanceart']);
    $balancemusc   =   $persona->Limpiar($_POST['balancemusc']);
    $alteraciones   =   $persona->Limpiar($_POST['alteraciones']);
    $referido   =   $persona->Limpiar($_POST['referido']);
    
    if (!empty($opcion)) {
        switch ($opcion){
            case 'insertar':
                if (!empty($nombre) && !empty($apellido) && !empty($nif) && !empty($telefono)) {
                    $persona->insert($nombre,$apellido,$apellido2,$nacimiento,$nif,$direccion,$cp,$telefono,$profesion,$email,$antecedentes,$ttoprevio,$diagnostico,$tratamiento,$tipo,$agravante,$hernia,$restriccion,$antialgica,$territorio,$testing,$reflejos,$lasegue,$palpacion,$balanceart,$balancemusc,$alteraciones,$referido);
                } else {
                    echo 'VACIO';
                }
                break;
            case 'editar':
               if (!empty($idPaciente) && !empty($nombre) && !empty($apellido) && !empty($nif) && !empty($telefono) ) {
                    $persona->edit($idPaciente,$nombre,$apellido,$apellido2,$nacimiento,$nif,$direccion,$cp,$telefono,$profesion,$email,$antecedentes,$ttoprevio,$diagnostico,$tratamiento,$tipo,$agravante,$hernia,$restriccion,$antialgica,$territorio,$testing,$reflejos,$lasegue,$palpacion,$balanceart,$balancemusc,$alteraciones,$referido);
                            
                } else {
                    echo 'VACIO';
                }
                break;
            case 'eliminar':
                if (!empty($idPaciente)) {
                    $persona->delete($idPaciente);
                } else {
                    echo 'VACIO';
                }
                break;
        }
    }else{
        echo $opcion;
    }
}else{
    // Retornar
    header('Location:../');
}
