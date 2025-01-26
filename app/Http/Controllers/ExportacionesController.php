<?php

namespace App\Http\Controllers;

use App\Models\CatalogoServicios;
use App\Models\Hospitalizacion;
use App\Models\Ingresos;
use App\Models\Pacientes;
use App\Models\SignosVitales;
use App\Models\Tratatamiento;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB as FacadesDB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

class ExportacionesController extends Controller
{
    public function exportToExcel($tipo,$fecha_inicio,$fecha_fin)
    {
        // Crea un nuevo archivo Excel
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        // Define las cabeceras segun el tipo
        switch ($tipo) {
            case 'PACIENTE-INGRESO':
                $headers = [
                    "Fecha",
                    "Id Paciente",
                    "Nombre",
                    "Fecha de nacimiento",
                    "Edad",
                    "Genero",
                    "Enfermedades Cronicas",
                    "Telefono",
                    "Alergias",
                    "Fecha de ingreso",
                    "Hora de ingreso",
                    "Diagnostico de Ingreso",
                    "Servicio",
                    "Cama",
                    "FC",
                    "FR",
                    "TA",
                    "Temperatura",
                    "So2",
                    "Peso",
                    "Talla",
                    "Medico tratante",
                    "Laboratorios",
                    "Diagnostico Agregado",
                    "Diagnostico Egreso"
                ];
                $sheet->fromArray($headers, null, 'A1'); // Inserta las cabeceras en la primera fila
                // Recupera los datos

                        $datos = Pacientes::select(
                            DB::raw("DATE_FORMAT(hospital.fecha, '%d-%m-%Y') as fecha"),
                            "pacientes.id_paciente as id_paciente",
                            DB::raw("CONCAT(LPAD(pacientes.fecha_nac_dia, 2, '0'), '-', LPAD(pacientes.fecha_nac_mes, 2, '0'), '-', pacientes.fecha_nac_año) as fecha_nacimiento"),
                            "pacientes.nombre as nombre",
                            'pacientes.edad',
                            "pacientes.genero",
                            "pacientes.id_enfermedad_cronica",
                            "pacientes.telefono",
                            "pacientes.alergias",
                            DB::raw("CONCAT(LPAD(ing.ingreso_dia, 2, '0'), '-', LPAD(ing.ingreso_mes, 2, '0'), '-', ing.ingreso_año) as fecha_ingreso"),
                            "ing.ingreso_hora",
                            "ing.diagnostico",
                             "servicio.servicio as servicio",
                             "camas.cama",
                             "signos.frecuencia_cardiaca as fc",
                             "signos.frecuencia_respiratoria as fr",
                             "signos.tension_arterial as ta",
                             "signos.temperatura as temperatura",
                             "signos.oxigenacion",
                             "signos.peso",
                             "signos.talla",
                             "medico.nombre as medico",
                             "tr.diagnostico_agregado",
                             "tr.diagnostico_egreso",
                             "tr.laboratorios"

                            )
                            ->join("tabla_hospitals as hospital","hospital.id_paciente","=","pacientes.id_paciente")
                            ->join("ingresos as ing","ing.paciente_id","=","pacientes.id")
                            ->join("catalogo_servicios as servicio","servicio.id","=","ing.id_servicio")
                            ->join("catalogo_camas as camas","camas.id","=","ing.id_cama")
                            ->join("signos_vitales as signos","signos.paciente_id","=","pacientes.id")
                            ->join("tratatamientos as tr","tr.paciente_id","=","pacientes.id")
                            ->join("catalogo_medicos as medico","medico.id","=","tr.id_medico")
                            ->where("hospital.fecha",">=",$fecha_inicio)
                            ->where("hospital.fecha","<=",$fecha_fin)
                            ->get();
                            
                break;
            case 'REPORTE SERVICIO':
                $headers = [
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
                    "accion_tomada",
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
                    "accion_tomada")->get();
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
    public function exportToExcelFiltrado(Request $request)
    {
        $rules = [
            'fecha' => 'required',
            'fecha_fin' => 'required',
        ];

        $messages = [
            'fecha.required' => 'El campo de la fecha de inicio es un campo requerido.',
            'fecha_fin.required' => 'El campo de la fecha fin es un campo requerido.',
        ];
        $respuesta = [];
        $this->validate($request, $rules, $messages);
        // Crea un nuevo archivo Excel
        try {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            // Define las cabeceras segun el tipo
            $tipo = "REPORTE SERVICIO";
            $headers = [
                "paciente_id",
                "medicamento",
                "dosis_max",
                "dosis_administrada",
                "id_via_administracion",
                "opcion_duplicidad",
                "opcion_intervencion",
                "opcion_aceptacion",
                "opcion_sin_cambios",
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
                "accion_tomada",
                "estatus"
            ];
            $sheet->fromArray($headers, null, 'A1'); // Inserta las cabeceras en la primera fila
            // Recupera los datos
            $startDate = Carbon::parse($request->fecha)->startOfDay();
            $endDate = Carbon::parse($request->fecha_fin)->endOfDay();
            $datosF = Hospitalizacion::where("created_at",">=",$startDate)->where("created_at","<=",$endDate)->orderBy('created_at', 'DESC')->get();
            
            $datos = $datosF;
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
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
