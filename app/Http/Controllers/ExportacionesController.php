<?php

namespace App\Http\Controllers;

use App\Models\Hospitalizacion;
use App\Models\Ingresos;
use App\Models\Pacientes;
use App\Models\SignosVitales;
use App\Models\Tratatamiento;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Response;

class ExportacionesController extends Controller
{
    public function exportToExcel($tipo)
    {
        // Crea un nuevo archivo Excel
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        // Define las cabeceras segun el tipo
        switch ($tipo) {
            case 'Pacientes':
                $headers = [
                    "Nombre",
                    "Dia de nacimiento",
                    "Mes de nacimiento",
                    "Año de nacimiento",
                    "Edad",
                    "Genero",
                    "Id Enfermedad",
                    "Telefono",
                    "Alergias"
                ];
                $sheet->fromArray($headers, null, 'A1'); // Inserta las cabeceras en la primera fila
                // Recupera los datos
                $datos = Pacientes::select(
                    "nombre",
                    "fecha_nac_dia",
                    "fecha_nac_mes",
                    "fecha_nac_año",
                    "edad",
                    "genero",
                    "id_enfermedad_cronica",
                    "telefono",
                    "alergias"
                )->get();
                break;
            case 'Ingresos':
                $headers = [
                    "Paciente Id",
                    "Dia de ingreso",
                    "Mes de ingreso",
                    "Año de Ingreso",
                    "Hora",
                    "Diagnostico",
                    "Id servicio",
                    "Id Cama"
                ];
                $sheet->fromArray($headers, null, 'A1'); // Inserta las cabeceras en la primera fila
                // Recupera los datos
                $datos = Ingresos::select(
                    "paciente_id",
                    "ingreso_dia",
                    "ingreso_mes",
                    "ingreso_año",
                    "ingreso_hora",
                    "diagnostico",
                    "id_servicio",
                    "id_cama"
                )->get();
                break;
            case 'Signos':
                $headers = [
                    "Paciente id",
                    "Fecuencia cardiaca",
                    "Tension arterial",
                    "Pulso",
                    "Temperatura",
                    "Frecuencia respiratoria",
                    "Oxigenación",
                    "Peso",
                    "Talla"
                ];
                $sheet->fromArray($headers, null, 'A1'); // Inserta las cabeceras en la primera fila
                // Recupera los datos
                $datos = SignosVitales::select(
                    "paciente_id",
                    "frecuencia_cardiaca",
                    "tension_arterial",
                    "pulso",
                    "temperatura",
                    "frecuencia_respiratoria",
                    "oxigenacion",
                    "peso",
                    "talla"
                )->get();
                break;
            case 'Tratamientos':
                $headers = [
                    "Paciente id",
                    "Medico Id",
                    "Diagnostico",
                    "Diagnostico de egreso",
                    "Laboratorios",
                ];
                $sheet->fromArray($headers, null, 'A1'); // Inserta las cabeceras en la primera fila
                // Recupera los datos
                $datos = Tratatamiento::select(
                    "paciente_id",
                    "id_medico",
                    "diagnostico_agregado",
                    "diagnostico_egreso",
                    "laboratorios",
                )->get();
                break;
            case 'Hospitalizaciones':
                $headers = [
                    "Paciente id",
                    "Medicamento",
                    "Dosis maxima",
                    "Dosis adminitrada",
                    "Id via e administracion",
                    "Intervalo",
                    "Servicio",
                    "Horario",
                    "Dia de inicio",
                    "Mes de inicio",
                    "Año de inicio",
                    "Dia termino",
                    "Mes termino",
                    "Año termino",
                    "Intervencion",
                    "Interacciones",
                    "Contraindicaciones",
                    "Recomendación",
                    "Otros",
                    "Acciones tomadas",
                ];
                $sheet->fromArray($headers, null, 'A1'); // Inserta las cabeceras en la primera fila
                // Recupera los datos
                $datos = Hospitalizacion::select(
                    "paciente_id",
                    "medicamento",
                    "dosis_max",
                    "dosis_administrada",
                    "id_via_administracion",
                    "intervalo",
                    "servicio",
                    "horario",
                    "diaInicio",
                    "mesInicio",
                    "anioInicio",
                    "diaTermino",
                    "mesTermino",
                    "anioTermino",
                    "intervencion",
                    "interacciones",
                    "contraindicaciones",
                    "recomendacion",
                    "otros",
                    "accion_tomada"
                )->get();
                break;

            default:
                break;
        }
        // Agrega los datos al archivo Excel
        $data = $datos->toArray(); // Convierte los datos en un array
        $sheet->fromArray($data, null, 'A2'); // Inserta los datos desde la segunda fila

        // Crea el archivo Excel
        $fileName = $tipo . '.xlsx';
        $writer = new Xlsx($spreadsheet);

        // Guarda el archivo en el servidor temporalmente
        $tempFile = tempnam(sys_get_temp_dir(), $fileName);
        $writer->save($tempFile);

        // Descarga el archivo
        return Response::download($tempFile, $fileName)->deleteFileAfterSend(true);
    }
}
