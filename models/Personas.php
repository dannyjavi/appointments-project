<?php

declare(strict_types=1);
require_once 'conexion.php';

/**
 */
class Personas extends Conexion
{

    public function __construct()
    {
        parent::__construct();
    }

    public function insert(
        $nombre,
        $apellido,
        $apellido2,
        $nacimiento,
        $nif,
        $direccion,
        $cp,
        $telefono,
        $profesion,
        $email,
        $antecedentes,
        $ttoprevio,
        $diagnostico,
        $tratamiento,
        $tipo,
        $agravante,
        $hernia,
        $restriccion,
        $antialgica,
        $territorio,
        $testing,
        $reflejos,
        $lasegue,
        $palpacion,
        $balanceart,
        $balancemusc,
        $alteraciones,
        $referido
    ) {
        error_reporting(0);
        $this->db->beginTransaction();
        try {

            $query = "INSERT INTO pacientes SET nombre =    :nombre,
                                                apellido    =   :apellido,
                                                apellido2   =   :apellido2,
                                                nacimiento  =   :nacimiento,
                                                nif =   :nif,
                                                direccion   =   :direccion,
                                                cp  =   :cp,
                                                telefono    =   :telefono,
                                                profesion   =   :profesion,
                                                email   =   :email,
                                                referido =  :referido   ";
            $result = $this->db->prepare($query);
            $result->execute(
                array(
                    ':nombre' => $nombre,
                    ':apellido' => $apellido,
                    ':apellido2' => $apellido2,
                    ':nacimiento' => $nacimiento,
                    ':nif' => $nif,
                    ':direccion' => $direccion,
                    ':cp' => $cp,
                    ':telefono' => $telefono,
                    ':profesion' => $profesion,
                    ':email' => $email,
                    ':referido' => $referido
                )
            );
            if ($result->rowCount()) {
                $lastid = $this->db->lastInsertId();


                $query  = "INSERT INTO evaluacion SET antecedentes  =   :antecedentes,
                                                     ttoprevio  =   :ttoprevio,
                                                     diagnostico    =   :diagnostico,
                                                     tratamiento    =   :tratamiento,
                                                     tipo    =   :tipo,
                                                     agravante    =   :agravante,
                                                     hernia    =   :hernia,
                                                     restriccion    =   :restriccion,
                                                     antialgica    =   :antialgica,
                                                     territorio    =   :territorio,
                                                     testing    =   :testing,
                                                     reflejos    =   :reflejos,
                                                     lasegue    =   :lasegue,
                                                     palpacion    =   :palpacion,
                                                     balanceart    =   :balanceart,
                                                     balancemusc    =   :balancemusc,
                                                     alteraciones    =   :alteraciones,
                                                     idPaciente =   :idPaciente";
                $result = $this->db->prepare($query);
                $result->execute(
                    array(
                        ':antecedentes' =>  $antecedentes,
                        ':ttoprevio'    =>  $ttoprevio,
                        ':diagnostico'  =>  $diagnostico,
                        ':tratamiento'  =>  $tratamiento,
                        ':tipo'  =>  $tipo,
                        ':agravante'  =>  $agravante,
                        ':hernia'  =>  $hernia,
                        ':restriccion'  => $restriccion,
                        ':antialgica'   =>  $antialgica,
                        ':territorio'   =>  $territorio,
                        ':testing'  =>  $testing,
                        ':reflejos' =>  $reflejos,
                        ':lasegue' =>  $lasegue,
                        ':palpacion' =>  $palpacion,
                        ':balanceart' =>  $balanceart,
                        ':balancemusc' =>  $balancemusc,
                        ':alteraciones' =>  $alteraciones,
                        ':idPaciente'   =>  $lastid
                    )
                );
                $this->db->commit();
                echo 'BIEN';
            } else {
                echo 'IGUAL';
            }
        } catch (PDOException $e) {
            $this->db->rollback();
            echo 'ERROR' . $e->getMessage();
        }
    }

    public function edit($idPaciente, $nombre, $apellido, $apellido2, $nacimiento, $nif, $direccion, $cp, $telefono, $profesion, $email, $antecedentes, $ttoprevio, $diagnostico, $tratamiento, $tipo, $agravante, $hernia, $restriccion, $antialgica, $territorio, $testing, $reflejos, $lasegue, $palpacion, $balanceart, $balancemusc, $alteraciones, $referido)
    {
        error_reporting(0);
        $this->db->beginTransaction();
        try {
            $query = "UPDATE pacientes INNER JOIN evaluacion ON pacientes.idPaciente = evaluacion.idPaciente SET                    pacientes.nombre= :nombre,
                                    pacientes.apellido    =   :apellido,
                                    pacientes.apellido2   =   :apellido2,
                                    pacientes.nacimiento  =   :nacimiento,
                                    pacientes.nif =   :nif,
                                    pacientes.direccion   =   :direccion,
                                    pacientes.cp  =   :cp,
                                    pacientes.telefono    =   :telefono,
                                    pacientes.profesion   =   :profesion,
                                    pacientes.email   =   :email,
                                    pacientes.referido      = :referido,
                                    evaluacion.antecedentes  =   :antecedentes,
                                    evaluacion.ttoprevio       =    :ttoprevio,
                                    evaluacion.diagnostico      =   :diagnostico,
                                    evaluacion.tratamiento      =   :tratamiento,
                                    evaluacion.tipo             =   :tipo,
                                    evaluacion.agravante    =   :agravante,
                                    evaluacion.hernia   =   :hernia,
                                    evaluacion.restriccion   =   :restriccion,
                                    evaluacion.antialgica   =   :antialgica,
                                    evaluacion.territorio   =   :territorio,
                                    evaluacion.testing   =   :testing,
                                    evaluacion.reflejos   =   :reflejos,
                                    evaluacion.lasegue   =   :lasegue,
                                    evaluacion.palpacion   =   :palpacion,
                                    evaluacion.balanceart   =   :balanceart,
                                    evaluacion.balancemusc   =   :balancemusc,
                                    evaluacion.alteraciones   =   :alteraciones
                                    WHERE pacientes.idPaciente = :idPaciente";

            $result = $this->db->prepare($query);
            $result->execute(
                array(
                    ':idPaciente' => $idPaciente,
                    ':nombre' => $nombre,
                    ':apellido' => $apellido,
                    ':apellido2' => $apellido2,
                    ':nacimiento' => $nacimiento,
                    ':nif' => $nif,
                    ':direccion' => $direccion,
                    ':cp' => $cp,
                    ':telefono' => $telefono,
                    ':profesion' => $profesion,
                    ':email' => $email,
                    ':referido' =>  $referido,
                    ':antecedentes' => $antecedentes,
                    ':ttoprevio'    =>  $ttoprevio,
                    ':diagnostico'  =>  $diagnostico,
                    ':tratamiento'  =>  $tratamiento,
                    ':tipo'     =>      $tipo,
                    ':agravante'     =>      $agravante,
                    ':hernia'     =>      $hernia,
                    ':restriccion'     =>      $restriccion,
                    ':antialgica'     =>      $antialgica,
                    ':territorio'     =>      $territorio,
                    ':testing'     =>      $testing,
                    ':reflejos'     =>      $reflejos,
                    ':lasegue'     =>      $lasegue,
                    ':palpacion'     =>      $palpacion,
                    ':balanceart'     =>      $balanceart,
                    ':balancemusc'     =>      $balancemusc,
                    ':alteraciones'     =>      $alteraciones
                )
            );

            if ($result->rowCount()) {

                $this->db->commit();
                echo 'BIEN';
            } else {
                echo 'IGUAL';
            }
        } catch (PDOException $e) {
            $this->db->rollback();
            echo 'ERROR' . $e->getMessage();
        }
    }

    public function delete(int $idPaciente)
    {
        error_reporting(0);
        try {
            $query  = "DELETE FROM pacientes WHERE idPaciente=:idPaciente;";
            $result = $this->db->prepare($query);
            $result->execute(array(':idPaciente' => $idPaciente));
            echo 'BIEN';
        } catch (PDOException $e) {
            echo 'ERROR';
        }
    }

    public function getAll(int $desde, int $filas): array
    {
        $query = "SELECT * FROM  pacientes INNER JOIN evaluacion ON pacientes.idPaciente = evaluacion.idPaciente ORDER by 
        nombre LIMIT {$desde},{$filas}";
        return $this->ConsultaSimple($query);
    }

    public function getPagination(): array
    {
        $query = "SELECT COUNT(*) FROM pacientes";
        return array(
            'filasTotal'  => intval($this->db->query($query)->fetch(PDO::FETCH_BOTH)[0]),
            'filasPagina' => 9,
        );
    }

    public function getSearch(string $termino): array
    {
        $where = "WHERE nombre LIKE :nombre || apellido LIKE :apellido || nif LIKE :nif ORDER BY nombre ASC";
        $array = array(
            ':nombre' => '%' . $termino . '%',
            ':apellido' => '%' . $termino . '%',
            ':nif' => '%' . $termino . '%'
        );
        return $this->ConsultaCompleja($where, $array);
    }

    public function showTable(array $array): string
    {
        $html = '';
        if (count($array)) {
            $html = '   <table class="table table-striped" id="table">
                        <thead>
                            <th class="d-none"></th>
                            <th>NOMBRES</th>
                            <th>APELLIDO</th>
                            <th class="hidden-xs">APELLIDO 2</th>
                            <th class="hidden-xs hidden-sm">F.NAC</th>
                            <th class="hidden-xs hidden-sm">DNI</th>
                            <th class="hidden-xs">DIRECCION</th>
                            <th class="hidden-xs hidden-sm">C.P</th>
                            <th>TELEFONO</th>
                            <th class="hidden-xs hidden-sm">PROFESION</th>
                            <th class="hidden-xs">EMAIL</th>
                            <th>OPCIONES</th>
                        </thead>

                        <tbody>
                     ';
            foreach ($array as $value) {
                $html .= '  <tr>
                        <td class="d-none">' . $value['idPaciente'] . '</td>
                        <td>' . $value['nombre'] . '</td>
                        <td>' . $value['apellido'] . '</td>
                        <td class="hidden-xs">' . $value['apellido2'] . '</td>
                        <td class="hidden-xs hidden-sm">' . $value['nacimiento'] . '</td>
                        <td class="hidden-xs hidden-sm">' . $value['nif'] . '</td>
                        <td class="hidden-xs">' . $value['direccion'] . '</td>
                        <td class="hidden-xs hidden-sm">' . $value['cp'] . '</td>
                        <td>' . $value['telefono'] . '</td>
                        <td class="hidden-xs hidden-sm">' . $value['profesion'] . '</td>
                        <td class="hidden-xs">' . $value['email'] . '</td>
                        <td class="d-none">' . $value['referido'] . '</td>
                        <td class="d-none">' . $value['antecedentes'] . '</td>
                        <td class="d-none">' . $value['ttoprevio'] . '</td>
                        <td class="d-none">' . $value['diagnostico'] . '</td>
                        <td class="d-none">' . $value['tratamiento'] . '</td>
                        <td class="d-none">' . $value['tipo'] . '</td>
                        <td class="d-none">' . $value['agravante'] . '</td>
                        <td class="d-none">' . $value['hernia'] . '</td>
                        <td class="d-none">' . $value['restriccion'] . '</td>
                        <td class="d-none">' . $value['antialgica'] . '</td>
                        <td class="d-none">' . $value['territorio'] . '</td>
                        <td class="d-none">' . $value['testing'] . '</td>
                        <td class="d-none">' . $value['reflejos'] . '</td>
                        <td class="d-none">' . $value['lasegue'] . '</td>
                        <td class="d-none">' . $value['palpacion'] . '</td>
                        <td class="d-none">' . $value['balanceart'] . '</td>
                        <td class="d-none">' . $value['balancemusc'] . '</td>
                        <td class="d-none">' . $value['alteraciones'] . '</td>
                        <td class="text-center">
                            <button title="Editar este usuario" class="editar btn btn-secondary" data-toggle="modal" data-target="#ventanaModal">
                                 <i class="fa fa-pencil-square-o"></i>
                            </button>

                            <button title="Eliminar este usuario" type="button" class="eliminar btn btn-danger" data-toggle="modal" data-target="#ventanaModal">
                                <i class="fa fa-trash-o"></i>
                            </button>
                        </td>
                        </tr>
                         ';
            }
            $html .= '  </tbody>
                    </table>';
        } else {
            $html = '<h4 class="text-center">No hay datos...</h4>';
        }
        return $html;
    }
    public function Limpiar($datos)
    {
        $datos  =   trim($datos);
        $datos  =   stripcslashes($datos);
        $datos  =   htmlspecialchars($datos);
        return $datos;
    }
}
