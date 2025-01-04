<?php

namespace App\Http\Controllers;

use App\Models\Hospitalizacion;
use App\Models\Ingresos;
use App\Models\Pacientes;
use App\Models\SignosVitales;
use App\Models\Tratatamiento;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
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
            case 'PACIENTE-INGRESO':
                $headers = [
                    "Fecha",
                    "id",
                    "nombre",
                    "fecha_nac_dia",
                    "fecha_nac_mes",
                    "fecha_nac_año",
                    "edad",
                    "genero",
                    "enfermedad",
                    "telefono",
                    "alergias",
                    "ingreso_dia",
                    "ingreso_mes",
                    "ingreso_año",
                    "ingreso_hora",
                    "diagnostico",
                    "servicio",
                    "cama",
                    "frecuencia_cardiaca",
                    "pulso",
                    "frecuencia_respiratoria",
                    "tencion_arterial",
                    "temperatura",
                    "oxigenacion",
                    "peso",
                    "talla",
                    "nombre",
                    "laboratorios",
                    "diagnostico_agregado",
                    "diagnostico_egreso"
                ];
                $sheet->fromArray($headers, null, 'A1'); // Inserta las cabeceras en la primera fila
                // Recupera los datos
                $datos = Ingresos::select(
                            "pa.created_at",
                            "pa.id",
                            "pa.nombre",
                            "pa.fecha_nac_dia",
                            "pa.fecha_nac_mes",
                            "pa.fecha_nac_año",
                            "pa.edad",
                            "pa.genero",
                            "enfermedades.enfermedad",
                            "pa.telefono",
                            "pa.alergias",
                            "ingresos.ingreso_dia",
                            "ingresos.ingreso_mes",
                            "ingresos.ingreso_año",
                            "ingresos.ingreso_hora",
                            "ingresos.diagnostico",
                            "servicio.servicio",
                            "camas.cama",
                            "signos.frecuencia_cardiaca",
                            "signos.pulso",
                            "signos.frecuencia_respiratoria",
                            "signos.tension_arterial",
                            "signos.temperatura",
                            "signos.oxigenacion",
                            "signos.peso",
                            "signos.talla",
                            "medicos.nombre",
                            "tra.laboratorios",
                            "tra.diagnostico_agregado",
                            "tra.diagnostico_egreso"
                            )
                        ->join("pacientes as pa","pa.id","=","ingresos.paciente_id")
                        ->join("signos_vitales as signos","signos.paciente_id","=","ingresos.paciente_id")
                        ->join("tratatamientos as tra","tra.paciente_id","=","ingresos.paciente_id")
                        ->join("catalogo_medicos as medicos","medicos.id","=","tra.id_medico")
                        ->join("catalogo_servicios as servicio","servicio.id","=","ingresos.id_servicio")
                        ->join("catalogo_camas as camas","camas.id","=","ingresos.id_cama")
                        ->join("catalogo_enfermedades_cronicas as enfermedades","enfermedades.id","=","pa.id_enfermedad_cronica")
                        ->get();
                        $datos[0]->created_at = Carbon::parse($datos[0]->created_at)->format('d-m-Y');
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
        // Crea un nuevo archivo Excel
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
        if($request->fecha){
            if($request->paciente){
                $datosF = Hospitalizacion::where("paciente_id","=",$request->paciente)->where("created_at","=",$request->fecha)->orderBy('created_at', 'DESC')->get();
            }else{
                $datosF = Hospitalizacion::where("created_at","=",$request->fecha)->orderBy('created_at', 'DESC')->get();
            }
        }else{
            if($request->paciente){
                $datosF = Hospitalizacion::where("paciente_id","=",$request->paciente)->orderBy('created_at', 'DESC')->get();
            }else{
                $datosF = Hospitalizacion::all();
            }
        };

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
    }
}
