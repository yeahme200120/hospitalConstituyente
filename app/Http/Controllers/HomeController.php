<?php

namespace App\Http\Controllers;

use App\Exports\HospitalizacionExport;
use App\Exports\IngresosExport;
use App\Exports\PacientesExport;
use App\Exports\SignosExport;
use App\Exports\TratamientoExport;
use App\Models\CatalogoCamas;
use App\Models\CatalogoEnfermedadesCronicas;
use App\Models\CatalogoMedicos;
use App\Models\CatalogoServicios;
use App\Models\CatalogoViaAdministracion;
use App\Models\Hospitalizacion;
use App\Models\Ingresos;
use App\Models\Pacientes;
use App\Models\SignosVitales;
use App\Models\Tratatamiento;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
        //return view('/login');
    }
    public function index2(Request $request)
    {
        return redirect()->route('home')->with('success', $request->mensaje);
    }
    public function master()
    {
        return "Vista master";
    }
    public function seguimiento()
    {
        $ultimoId = Pacientes::max('id');
        $id = $ultimoId + 1;
        //Seccion de los catalogos a mostrar
        $enfermedades = CatalogoEnfermedadesCronicas::all();
        $servicios = CatalogoServicios::all();
        $camas = CatalogoCamas::all();
        return view("seguimiento", compact("id", "enfermedades", "servicios", "camas"));
    }
    public function registrarSeguimiento(Request $request)
    {
        $rules = [
            'nombre' => 'required',
            'fecha_nac_dia' => 'required',
            'fecha_nac_mes' => 'required',
            'fecha_nac_año' => 'required',
            'edad' => 'required',
            'genero' => 'required',
            'enfermedades_cronicas' => 'required',
            'telefono' => 'required',
            'alergias' => 'required',
            'dia' => 'required',
            'mes' => 'required',
            'anio' => 'required',
            'hora_ingreso' => 'required',
            'diagnostico_ingreso' => 'required',
            'servicio' => 'required',
            'cama' => 'required',
            'frecuencia_cardiaca' => 'required',
            'tension_arterial' => 'required',
            'pulso' => 'required',
            'temperatura' => 'required',
            'frecuencia_respiratoria' => 'required',
            'oxigenacion' => 'required',
            'peso' => 'required',
            'talla' => 'required',
        ];

        $messages = [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'fecha_nac_dia.required' => 'El campo día de nacimiento es obligatorio.',
            'fecha_nac_mes.required' => 'El campo mes de nacimiento es obligatorio.',
            'fecha_nac_año.required' => 'El campo año de nacimiento es obligatorio.',
            'edad.required' => 'El campo edad es obligatorio.',
            'genero.required' => 'El campo género es obligatorio.',
            'enfermedades_cronicas.required' => 'El campo enfermedades crónicas es obligatorio.',
            'telefono.required' => 'El campo teléfono es obligatorio.',
            'alergias.required' => 'El campo alergias es obligatorio.',

            'dia.required' => 'El campo día es obligatorio.',
            'mes.required' => 'El campo mes es obligatorio.',
            'anio.required' => 'El campo año es obligatorio.',
            'hora_ingreso.required' => 'El campo hora de ingreso es obligatorio.',
            'diagnostico_ingreso.required' => 'El campo diagnóstico de ingreso es obligatorio.',
            'servicio.required' => 'El campo servicio es obligatorio.',
            'cama.required' => 'El campo cama es obligatorio.',

            'frecuencia_cardiaca.required' => 'El campo frecuencia cardíaca es obligatorio.',
            'tension_arterial.required' => 'El campo tensión arterial es obligatorio.',
            'pulso.required' => 'El campo pulso es obligatorio.',
            'temperatura.required' => 'El campo temperatura es obligatorio.',
            'frecuencia_respiratoria.required' => 'El campo frecuencia respiratoria es obligatorio.',
            'oxigenacion.required' => 'El campo oxigenación es obligatorio.',
            'peso.required' => 'El campo peso es obligatorio.',
            'talla.required' => 'El campo talla es obligatorio.',
        ];
        $respuesta = [];
        $this->validate($request, $rules, $messages);
        //Si todo Ok 
        //Informacion Personal
        $paciente = new Pacientes();

        $paciente->nombre = $request->nombre;
        $paciente->fecha_nac_dia = $request->fecha_nac_dia;
        $paciente->fecha_nac_mes = $request->fecha_nac_mes;
        $paciente->fecha_nac_año = $request->fecha_nac_año;
        $paciente->edad = $request->edad;
        $paciente->genero = $request->genero;
        $paciente->id_enfermedad_cronica = json_encode($request->enfermedades_cronicas);
        $paciente->telefono = $request->telefono;
        $paciente->alergias = $request->alergias;

        if ($paciente->save()) {
            array_push($respuesta, ["paciente" => 1]);
        } else {
            array_push($respuesta, ["paciente" => 0]);
        }
        //Registro de ingresos
        $ingreso = new Ingresos();
        $ingreso->paciente_id = $paciente->id;
        $ingreso->ingreso_dia = $request->dia;
        $ingreso->ingreso_mes = $request->mes;
        $ingreso->ingreso_año = $request->anio;
        $ingreso->ingreso_hora = $request->hora_ingreso;
        $ingreso->diagnostico = $request->diagnostico_ingreso;
        $ingreso->id_servicio = $request->servicio;
        $ingreso->id_cama = $request->cama;

        if ($ingreso->save()) {
            array_push($respuesta, ["ingreso" => 1]);
        } else {
            array_push($respuesta, ["ingreso" => 0]);
        }
        //Registro de signos vitales
        $signos = new SignosVitales();
        $signos->paciente_id = $paciente->id;
        $signos->frecuencia_cardiaca = $request->frecuencia_cardiaca;
        $signos->tension_arterial = $request->tension_arterial;
        $signos->pulso = $request->pulso;
        $signos->temperatura = $request->temperatura;
        $signos->frecuencia_respiratoria = $request->frecuencia_respiratoria;
        $signos->oxigenacion = $request->oxigenacion;
        $signos->peso = $request->peso;
        $signos->talla = $request->talla;

        if ($signos->save()) {
            return redirect()->route('seguimientoTratamiento', ['paciente' => $paciente->id])
                ->with('success', 'Registro correcto de Informacion personal, Ingresos y Signos Vitales');
        } else {
            return 0;
        }
    }
    public function enHospital(Request $request)
    {
        $hospitalizados = Hospitalizacion::join('pacientes as p', 'p.id', '=', 'hospitalizacions.paciente_id')
            ->join('catalogo_servicios as c', 'c.id', '=', 'hospitalizacions.paciente_id')
            ->join('ingresos as i', 'i.paciente_id', '=', 'hospitalizacions.paciente_id')
            ->join('catalogo_camas as camas', 'camas.id', '=', 'i.id_cama')
            ->where("hospitalizacions.estatus", "=", 1)
            ->select('hospitalizacions.*', 'c.servicio', 'p.nombre', 'camas.cama')
            ->paginate(5);

        return view("enHospital", compact("hospitalizados"));
    }
    public function seguimientoTratamiento()
    {
        //Seccion de los
        $pacientes = Pacientes::all();
        $medicos = CatalogoMedicos::all();
        $vias = CatalogoViaAdministracion::all();
        return view("seguimientoTratamiento", compact("pacientes", "medicos", "vias"));
    }
    public function seguimientoTratamientoId($id)
    {
        //Seccion de los

        $paciente = $id;
        $medicos = CatalogoMedicos::all();
        $vias = CatalogoViaAdministracion::all();
        return view("seguimientoTratamiento", compact("paciente", "medicos", "vias"));
    }
    public function registrarSeguimiento2(Request $request)
    {
        $rules = [
            'pacienteId' => 'required',
            'medicoTratante' => 'required',
            'diagnosticoAgregado' => 'required',
            'laboratorios' => 'required',
            'medicamento' => 'required',
            'dosisMaxima' => 'required',
            'dosisAdministrada' => 'required',
            'servicio' => 'required',
            'via' => 'required',
            'interacciones' => 'required',
            'intervalo' => 'required',
            'contraindicaciones' => 'required',
            'horario' => 'required',
            'recomendacion' => 'required',
            'diaInicio' => 'required',
            'mesInicio' => 'required',
            'anioInicio' => 'required',
            'intervencion' => 'required',
            'otros' => 'required',
            'accionTomada' => 'required',
        ];

        $messages = [
            'pacienteId.required' => 'El campo Paciente es un campo obligatorio.',
            'medicoTratante.required' => 'El campo Medico tratante es un campo obligatorio.',
            'diagnosticoAgregado.required' => 'El campo diagnostico agregado es un campo obligatorio.',
            'laboratorios.required' => 'El campo Laboratorios es un campo obligatorio.',
            'medicamento.required' => 'El campo Medicamento es un campo obligatorio.',
            'dosisMaxima.required' => 'El campo Dosis maxima es un campo obligatorio.',
            'dosisAdministrada.required' => 'El campo Dosis administrada es un campo obligatorio.',
            'servicio.required' => 'El campo Servicio es un campo obligatorio.',
            'via.required' => 'El campo Via de administración es un campo obligatorio.',
            'interacciones.required' => 'El campo Interacciones es un campo obligatorio.',
            'intervalo.required' => 'El campo Intervalo es un campo obligatorio.',
            'contraindicaciones.required' => 'El campo Contraindicaciones es un campo obligatorio.',
            'horario.required' => 'El campo Horario es un campo obligatorio.',
            'recomendacion.required' => 'El campo Recomendacion es un campo obligatorio.',
            'diaInicio.required' => 'El campo Dia de inicio es un campo obligatorio.',
            'mesInicio.required' => 'El campo Mes de inicio es un campo obligatorio.',
            'anioInicio.required' => 'El campo Año de inicio es un campo obligatorio.',
            'intervencion.required' => 'El campo Intervencion es un campo obligatorio.',
            'otros.required' => 'El campo Otros es un campo obligatorio.',
            'accionTomada.required' => 'El campo Accion tomada es un campo obligatorio.',
        ];
        $respuesta = [];
        $this->validate($request, $rules, $messages);

        //Registro de Tratamiento
        $tratamiento = new Tratatamiento();
        $tratamiento->paciente_id = $request->pacienteId;
        $tratamiento->id_medico = $request->medicoTratante;
        $tratamiento->diagnostico_agregado = $request->diagnosticoAgregado;
        $tratamiento->diagnostico_egreso = !$request->diagnosticoEgreso ? '' : $request->diagnosticoEgreso;
        $tratamiento->laboratorios = $request->laboratorios;

        if ($tratamiento->save()) {
            array_push($respuesta, ["tratamiento" => 1]);
        } else {
            array_push($respuesta, ["tratamiento" => 0]);
        }

        //Registro de Hospitalización
        $hospitalizacion = new Hospitalizacion();
        $hospitalizacion->paciente_id = $request->pacienteId;
        $hospitalizacion->medicamento = $request->medicamento;
        $hospitalizacion->dosis_max = $request->dosisMaxima;
        $hospitalizacion->dosis_administrada = $request->dosisAdministrada;
        $hospitalizacion->servicio = $request->servicio;
        $hospitalizacion->id_via_administracion = $request->via;
        $hospitalizacion->interacciones = $request->interacciones;
        $hospitalizacion->intervalo = $request->intervalo;
        $hospitalizacion->contraindicaciones = $request->contraindicaciones;
        $hospitalizacion->horario = $request->horario;
        $hospitalizacion->recomendacion = $request->recomendacion;
        $hospitalizacion->diaInicio = $request->diaInicio;
        $hospitalizacion->mesInicio = $request->mesInicio;
        $hospitalizacion->anioInicio = $request->anioInicio;
        $hospitalizacion->diaTermino = $request->diaTermino ? $request->diaTermino : null;
        $hospitalizacion->mesTermino = $request->mesTermino ? $request->mesTermino : null;
        $hospitalizacion->anioTermino = $request->anioTermino ? $request->anioTermino : null;
        $hospitalizacion->intervencion = $request->intervencion;
        $hospitalizacion->otros = $request->otros;
        $hospitalizacion->accion_tomada = $request->accionTomada;
        $hospitalizacion->opcion_duplicidad = !$request->opcion_duplicidad ? null : $request->opcion_duplicidad;
        $hospitalizacion->opcion_intervencion = !$request->opcion_intervencion ? null : $request->opcion_intervencion;
        $hospitalizacion->opcion_aceptacion = !$request->opcion_aceptacion ? null : $request->opcion_aceptacion;
        $hospitalizacion->opcion_sin_cambios = !$request->opcion_sin_cambios ? null : $request->opcion_sin_cambios;
        $hospitalizacion->estatus = 1; 



        if ($hospitalizacion->save()) {
            array_push($respuesta, ["hospitalizacion" => 1]);
            return redirect()->route('enHospital')->with('success', 'Registro correcto de Tratamiento y hospitalización');
        }
    }
    public function agregarMedicamento2(Request $request)
    {
        try {
            //Registro de Hospitalización
            $hospitalizacion = new Hospitalizacion();
            $hospitalizacion->paciente_id = $request->pacienteId ? $request->pacienteId : 0;
            $hospitalizacion->medicamento = $request->medicamento ? $request->medicamento : '';
            $hospitalizacion->dosis_max = $request->dosisMaxima ? $request->dosisMaxima : 0;
            $hospitalizacion->dosis_administrada = $request->dosisAdministrada ? $request->dosisAdministrada : 0;
            $hospitalizacion->servicio = $request->servicio ? $request->servicio : 0;
            $hospitalizacion->id_via_administracion = $request->via ? $request->via : 0;
            $hospitalizacion->interacciones = $request->interacciones ? $request->interacciones : '';
            $hospitalizacion->intervalo = $request->intervalo ? $request->intervalo : '';
            $hospitalizacion->contraindicaciones = $request->contraindicaciones ? $request->contraindicaciones : '';
            $hospitalizacion->horario = $request->horario ? $request->horario : '';
            $hospitalizacion->recomendacion = $request->recomendacion ? $request->recomendacion : '';
            $hospitalizacion->diaInicio = $request->diaInicio ? $request->diaInicio : '';
            $hospitalizacion->mesInicio = $request->mesInicio ? $request->mesInicio : '';
            $hospitalizacion->anioInicio = $request->anioInicio ? $request->anioInicio : '';
            $hospitalizacion->diaTermino = $request->diaTermino ? $request->diaTermino : null;
            $hospitalizacion->mesTermino = $request->mesTermino ? $request->mesTermino : null;
            $hospitalizacion->anioTermino = $request->anioTermino ? $request->anioTermino : null;
            $hospitalizacion->intervencion = $request->intervencion ? $request->intervencion : '';
            $hospitalizacion->otros = $request->otros ? $request->otros : '';
            $hospitalizacion->accion_tomada = $request->accionTomada ? $request->accionTomada : '';
            $hospitalizacion->opcion_duplicidad = !$request->opcion_duplicidad ? null : $request->opcion_duplicidad;
            $hospitalizacion->opcion_intervencion = !$request->opcion_intervencion ? null : $request->opcion_intervencion;
            $hospitalizacion->opcion_aceptacion = !$request->opcion_aceptacion ? null : $request->opcion_aceptacion;
            $hospitalizacion->opcion_sin_cambios = !$request->opcion_sin_cambios ? null : $request->opcion_sin_cambios;
            $hospitalizacion->estatus = 1;


            if ($hospitalizacion->save()) {
                return 1;
            } else {
                return 0;
            }
        } catch (\Throwable $th) {
            return $th;
        }
    }
    public function cambios($paciente_id)
    {
        //Seccion de los
        $hospitalizacion = Hospitalizacion::find($paciente_id);
        $paciente = Pacientes::find($hospitalizacion->paciente_id);
        $ingresos = Ingresos::where('paciente_id', '=',$hospitalizacion->paciente_id)->first();
        $signos = SignosVitales::where('paciente_id', '=',$hospitalizacion->paciente_id)->first();
        $tratamiento = Tratatamiento::where("paciente_id", "=",$hospitalizacion->paciente_id)->first();
        $enfermedades = CatalogoEnfermedadesCronicas::all();
        $servicios = CatalogoServicios::all();
        $camas = CatalogoCamas::all();
        $medicos = CatalogoMedicos::all();
        $vias = CatalogoViaAdministracion::all();
        return view("cambios", compact("paciente", "signos", "tratamiento", "enfermedades", "servicios", "camas", "medicos", "vias", "ingresos","hospitalizacion"));
    }
    public function actualizacionCambios(Request $request)
    {
        $ingreso = Ingresos::find($request->paciente_id);
        $ingreso->id_servicio = $request->servicio;
        $ingreso->id_cama = $request->cama;
        if ($ingreso->save()) {
            return redirect()->route('enHospital')->with('success', 'Datos actualizados correctamente');
        } else {
        }
    }
    public function datosPaciente($paciente_id)
    {
        $paciente = Pacientes::find($paciente_id);
        $enfermedades =[];
        if(!$paciente){
            return redirect()->route('errorPage')->with('error', 'Paciente no encontrado');
        }else{
            $datos = json_decode($paciente->id_enfermedad_cronica);
            if(!$paciente->id_enfermedad_cronica || $paciente->id_enfermedad_cronica == null || $paciente->id_enfermedad_cronica = ''){
                $enfermedades = CatalogoEnfermedadesCronicas::all();
            }else{
                foreach($datos as $enf){
                    array_push($enfermedades,CatalogoEnfermedadesCronicas::where("id", "=", $enf)->first());
                };
                //$enfermedades = CatalogoEnfermedadesCronicas::where("id", "=", $paciente->id_enfermedad_cronica)->first();
            }
            return view("datosPaciente", compact("paciente", "enfermedades"));
        }
    }
    public function salidaHospitalizacion($id)
    {
        //Cambiamos el estatus de la hospitalizacion
        $hospitalizacion = Hospitalizacion::find($id);
        $hospitalizacion->estatus = 0;
        if ($hospitalizacion->save()) {
            return redirect()->route('enHospital')->with('success', 'El paciente ya salió del hospital y solo estará disponible para su vista en la tabla de reporte de paciente-ingresos.');
        }
    }
    public function exportar()
    {
        return view("reportes");
    }
    public function exportarPacientes()
    {
        return Excel::download(new PacientesExport, 'PACIENTE-INGRESO.xlsx');
    }
    public function exportarIngresos()
    {
        return Excel::download(new IngresosExport, 'Ingresos.xlsx');
    }
    public function exportarSignos()
    {
        return Excel::download(new SignosExport, 'Signos.xlsx');
    }
    public function exportarTratamiento()
    {
        return Excel::download(new TratamientoExport, 'Tratamientoes.xlsx');
    }
    public function exportarHospitalizacion()
    {
        return Excel::download(new HospitalizacionExport, 'Hospitalizaciones.xlsx');
    }
}
