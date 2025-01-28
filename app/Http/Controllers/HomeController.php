<?php

namespace App\Http\Controllers;

use App\Exports\HospitalizacionExport;
use App\Exports\IngresosExport;
use App\Exports\PacientesExport;
use App\Exports\SignosExport;
use App\Exports\TratamientoExport;
use App\Models\User;
use App\Models\CatalogoCamas;
use App\Models\CatalogoEnfermedadesCronicas;
use App\Models\CatalogoMedicos;
use App\Models\CatalogoServicios;
use App\Models\CatalogoViaAdministracion;
use App\Models\Hospitalizacion;
use App\Models\Ingresos;
use App\Models\Pacientes;
use App\Models\SignosVitales;
use App\Models\tablaHospital;
use App\Models\Tratatamiento;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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
        $ultimoId = Pacientes::max('id_paciente');
        $id = $ultimoId + 1;
        //Seccion de los catalogos a mostrar
        $enfermedades = CatalogoEnfermedadesCronicas::all();
        $servicios = CatalogoServicios::all();
        $camas = CatalogoCamas::all();
        $pacientes = Pacientes::all();
        return view("seguimiento", compact("pacientes", "id", "enfermedades", "servicios", "camas"));
    }
    public function registrarSeguimiento(Request $request)
    {
        $rules = [
            'nombre' => 'required',
            'id' => 'required',
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
            'temperatura' => 'required',
            'frecuencia_respiratoria' => 'required',
            'oxigenacion' => 'required',
            'peso' => 'required',
            'talla' => 'required',
        ];

        $messages = [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'id.required' => 'El campo Id del paciete no puede estar vacio y es obligatorio.',
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

        $paciente = Pacientes::updateOrCreate(
            // Condición para buscar el registro existente
            ['id_paciente' => $request->id],
            // Datos para actualizar o crear
            [
                'nombre' => $request->nombre,
                'fecha_nac_dia' => $request->fecha_nac_dia,
                'fecha_nac_mes' => $request->fecha_nac_mes,
                'fecha_nac_año' => $request->fecha_nac_año,
                'edad' => $request->edad,
                'genero' => $request->genero,
                'id_enfermedad_cronica' => json_encode($request->enfermedades_cronicas),
                'telefono' => $request->telefono,
                'alergias' => $request->alergias,
            ]
        );

        // Respuesta para indicar éxito o fallo
        if ($paciente->wasRecentlyCreated) {
            array_push($respuesta, ["paciente" => 1, "mensaje" => "Paciente creado exitosamente."]);
        } else {
            array_push($respuesta, ["paciente" => 1, "mensaje" => "Paciente actualizado exitosamente."]);
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

        //Se genera el registro para en hospital
        $serv = CatalogoServicios::find($request->servicio);
        $ca = CatalogoCamas::find($request->cama);
        $tabla = new tablaHospital();
        $tabla->paciente =  $request->nombre;
        $tabla->id_paciente = $request->id;
        $tabla->fecha =  date(now());
        $tabla->hora =  date("H:i:s");
        $tabla->servicio =  $serv->servicio;
        $tabla->id_servicio =  $serv->id;
        $tabla->estatus =  "Activo";
        $tabla->id_estatus =  1;
        $tabla->cama =  $ca->cama;
        $tabla->id_cama =  $ca->id;
        $tabla->save();

        //Registro de signos vitales
        $signos = new SignosVitales();
        $signos->paciente_id = $paciente->id;
        $signos->frecuencia_cardiaca = $request->frecuencia_cardiaca;
        $signos->tension_arterial = $request->tension_arterial;
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
        $hospitalizados = tablaHospital::where("id_Estatus", "=", 1)->orderBy('fecha', 'desc')->get();
        return view("enHospital", compact("hospitalizados"));
    }
    public function reporteServicio(Request $request)
    {
        $hospitalizados = tablaHospital::select("tabla_hospitals.*", "p.id as pacienteSQL")
            ->join("pacientes as p", "p.id_paciente", "=", "tabla_hospitals.id_paciente")
            ->where("id_estatus", "=", 1)
            ->orderBy('fecha', 'desc')
            ->get();

        return view("reporteServicio", compact("hospitalizados"));
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
            'via' => 'required',
            'intervalo' => 'required',
            'horario' => 'required',
            'diaInicio' => 'required',
            'mesInicio' => 'required',
            'anioInicio' => 'required',
        ];

        $messages = [
            'pacienteId.required' => 'El campo Paciente es un campo obligatorio.',
            'medicoTratante.required' => 'El campo Medico tratante es un campo obligatorio.',
            'diagnosticoAgregado.required' => 'El campo diagnostico agregado es un campo obligatorio.',
            'laboratorios.required' => 'El campo Laboratorios es un campo obligatorio.',
            'medicamento.required' => 'El campo Medicamento es un campo obligatorio.',
            'dosisMaxima.required' => 'El campo Dosis maxima es un campo obligatorio.',
            'dosisAdministrada.required' => 'El campo Dosis administrada es un campo obligatorio.',
            'via.required' => 'El campo Via de administración es un campo obligatorio.',
            'intervalo.required' => 'El campo Intervalo es un campo obligatorio.',
            'horario.required' => 'El campo Horario es un campo obligatorio.',
            'diaInicio.required' => 'El campo Dia de inicio es un campo obligatorio.',
            'mesInicio.required' => 'El campo Mes de inicio es un campo obligatorio.',
            'anioInicio.required' => 'El campo Año de inicio es un campo obligatorio.',
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
        $hospitalizacion->id_via_administracion = $request->via;
        $hospitalizacion->interacciones = $request->interacciones ? $request->interacciones : '';
        $hospitalizacion->intervalo = $request->intervalo;
        $hospitalizacion->contraindicaciones = $request->contraindicaciones ? $request->interacciones : '';
        $hospitalizacion->horario = $request->horario;
        $hospitalizacion->recomendacion = $request->recomendacion ? $request->recomendacion : '';
        $hospitalizacion->diaInicio = $request->diaInicio;
        $hospitalizacion->mesInicio = $request->mesInicio;
        $hospitalizacion->anioInicio = $request->anioInicio;
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
            array_push($respuesta, ["hospitalizacion" => 1]);
            return redirect()->route('enHospital')->with('success', 'Registro correcto de Tratamiento y hospitalización');
        }
    }
    public function agregarMedicamento2(Request $request)
    {
        try {
            //Registro de Hospitalización
            $hospitalizacion = new Hospitalizacion();
            $hospitalizacion->paciente_id = $request->paciente_id ? $request->paciente_id : 0;
            $hospitalizacion->medicamento = $request->medicamento ? $request->medicamento : '';
            $hospitalizacion->dosis_max = $request->dosis_max ? $request->dosis_max : 0;
            $hospitalizacion->dosis_administrada = $request->dosis_administrada ? $request->dosis_administrada : 0;
            $hospitalizacion->id_via_administracion = $request->id_via_administracion ? $request->id_via_administracion : 0;
            $hospitalizacion->intervalo = $request->intervalo ? $request->intervalo : '';
            $hospitalizacion->horario = $request->horario ? $request->horario : '';
            $hospitalizacion->diaInicio = $request->diaInicio ? $request->diaInicio : '';
            $hospitalizacion->mesInicio = $request->mesInicio ? $request->mesInicio : '';
            $hospitalizacion->anioInicio = $request->anioInicio ? $request->anioInicio : '';
            $hospitalizacion->diaTermino = $request->diaTermino ? $request->diaTermino : null;
            $hospitalizacion->mesTermino = $request->mesTermino ? $request->mesTermino : null;
            $hospitalizacion->anioTermino = $request->anioTermino ? $request->anioTermino : null;
            $hospitalizacion->opcion_duplicidad = !$request->opcion_duplicidad ? null : $request->opcion_duplicidad;
            $hospitalizacion->opcion_intervencion = !$request->opcion_intervencion ? null : $request->opcion_intervencion;
            $hospitalizacion->opcion_aceptacion = !$request->opcion_aceptacion ? null : $request->opcion_aceptacion;
            $hospitalizacion->opcion_sin_cambios = !$request->opcion_sin_cambios ? 'Sin Cambios' : $request->opcion_sin_cambios;
            $hospitalizacion->estatus = 1;
            $hospitalizacion->interacciones = $request->interacciones ? $request->interacciones : '';
            $hospitalizacion->contraindicaciones = $request->contraindicaciones ? $request->contraindicaciones : '';
            $hospitalizacion->recomendacion = $request->recomendacion ? $request->recomendacion : '';
            $hospitalizacion->intervencion = $request->intervencion ? $request->intervencion : '';
            $hospitalizacion->otros = $request->otros ? $request->otros : '';
            $hospitalizacion->accion_tomada = $request->accion_tomada ? $request->accion_tomada : '';


            if ($hospitalizacion->save()) {
                return 1;
            } else {
                return 0;
            }
        } catch (\Throwable $th) {
            return $th;
        }
    }
    public function cambios($paciente_id, $id_hospital)
    {
        //Seccion de los
        $pacientes = Pacientes::where("id_paciente", "=", $paciente_id)->first();
        $hospitalizacion = Hospitalizacion::where("paciente_id", "=", $pacientes->id)->first();
        $tabla = tablaHospital::find($id_hospital);
        $ingresos = Ingresos::where('paciente_id', '=', $pacientes->id)->first();
        $signos = SignosVitales::where('paciente_id', '=', $pacientes->id)->first();
        $tratamiento = Tratatamiento::where("paciente_id", "=", $pacientes->id)->first();
        $enfermedades = CatalogoEnfermedadesCronicas::all();
        $servicios = CatalogoServicios::all();
        $camas = CatalogoCamas::all();
        $medicos = CatalogoMedicos::all();
        $vias = CatalogoViaAdministracion::all();
        return view("cambios", compact("pacientes", "signos", "tratamiento", "enfermedades", "servicios", "camas", "medicos", "vias", "ingresos", "hospitalizacion", "tabla"));
    }
    public function actualizacionCambios(Request $request)
    {
        $rules = [
            //Datos de los ingresos
            'dia' => 'required',
            'mes' => 'required',
            'anio' => 'required',
            'hora_ingreso' => 'required',
            'diagnostico_ingreso' => 'required',
            'servicio' => 'required',
            'cama' => 'required',

            'frecuencia_cardiaca' => 'required',
            'tension_arterial' => 'required',
            'temperatura' => 'required',
            'frecuencia_respiratoria' => 'required',
            'oxigenacion' => 'required',
            'peso' => 'required',
            'talla' => 'required',

            //Campos del tratamiento
            'medicoTratante' => 'required',
            'diagnosticoAgregado' => 'required',
            'diagnosticoEgreso' => 'required',
            'laboratorios' => 'required',
        ];

        $messages = [
            'dia.required' => 'El campo día es obligatorio.',
            'mes.required' => 'El campo mes es obligatorio.',
            'anio.required' => 'El campo año es obligatorio.',
            'hora_ingreso.required' => 'El campo hora de ingreso es obligatorio.',
            'diagnostico_ingreso.required' => 'El campo diagnóstico de ingreso es obligatorio.',
            'servicio.required' => 'El campo servicio es obligatorio.',
            'cama.required' => 'El campo cama es obligatorio.',

            'frecuencia_cardiaca.required' => 'El campo frecuencia cardíaca es obligatorio.',
            'tension_arterial.required' => 'El campo tensión arterial es obligatorio.',
            'temperatura.required' => 'El campo temperatura es obligatorio.',
            'frecuencia_respiratoria.required' => 'El campo frecuencia respiratoria es obligatorio.',
            'oxigenacion.required' => 'El campo oxigenación es obligatorio.',
            'peso.required' => 'El campo peso es obligatorio.',
            'talla.required' => 'El campo talla es obligatorio.',

            'medicoTratante.required' => 'El campo Delk medico tratante es un campo obligatorio,',
            'diagnosticoAgregado.required' => 'El campo del diagnostico agregado es un campo Obligatorio',
            'diagnosticoEgreso.required' => "El campo de Diagnostico de egreso es un campo Obligatirio",
            'laboratorios.required' => "El campo de los laboratorios es un campo obligatorio"

        ];
        $respuesta = [];
        $this->validate($request, $rules, $messages);
        $paciente = Pacientes::find($request->paciente_id);

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

        //Se genera el registro para en hospital
        $serv = CatalogoServicios::find($request->servicio);
        $ca = CatalogoCamas::find($request->cama);

        $tabla = new tablaHospital();
        $tabla->paciente =  $paciente->nombre;
        $tabla->id_paciente = $paciente->id_paciente;
        $tabla->fecha =  date(now());
        $tabla->hora =  date("H:i:s");
        $tabla->servicio =  $serv->servicio;
        $tabla->id_servicio =  $serv->id;
        $tabla->estatus =  "Activo";
        $tabla->id_estatus =  1;
        $tabla->cama =  $ca->cama;
        $tabla->id_cama =  $ca->id;
        $tabla->save();

        //Registro de signos vitales
        $signos = new SignosVitales();
        $signos->paciente_id = $paciente->id;
        $signos->frecuencia_cardiaca = $request->frecuencia_cardiaca;
        $signos->tension_arterial = $request->tension_arterial;
        $signos->temperatura = $request->temperatura;
        $signos->frecuencia_respiratoria = $request->frecuencia_respiratoria;
        $signos->oxigenacion = $request->oxigenacion;
        $signos->peso = $request->peso;
        $signos->talla = $request->talla;

        if ($signos->save()) {
            try {
                //Registro de Tratamiento
                $tratamiento = new Tratatamiento();
                $tratamiento->paciente_id = $paciente->id;
                $tratamiento->id_medico = $request->medicoTratante ? $request->medicoTratante : '';
                $tratamiento->diagnostico_agregado = $request->diagnosticoAgregado ? $request->diagnosticoAgregado : '';
                $tratamiento->diagnostico_egreso = !$request->diagnosticoEgreso ? '' : $request->diagnosticoEgreso;
                $tratamiento->laboratorios = $request->laboratorios ? $request->laboratorios : '';
                if ($tratamiento->save()) {
                    try {
                        $hospitalizacion = new Hospitalizacion();
                        $hospitalizacion->paciente_id = $paciente->id;
                        $hospitalizacion->medicamento = $request->medicamento ? $request->medicamento : '';
                        $hospitalizacion->dosis_max = $request->dosisMaxima ? $request->dosisMaxima : '';
                        $hospitalizacion->dosis_administrada = $request->dosisAdministrada ? $request->dosisAdministrada : '';
                        $hospitalizacion->id_via_administracion = $request->via ? $request->via : '';
                        $hospitalizacion->interacciones = $request->interacciones ? $request->interacciones : '';
                        $hospitalizacion->intervalo = $request->intervalo ? $request->intervalo : '';
                        $hospitalizacion->contraindicaciones = $request->contraindicaciones ? $request->interacciones : '';
                        $hospitalizacion->horario = $request->horario ? $request->horario : '';
                        $hospitalizacion->recomendacion = $request->recomendacion ? $request->recomendacion : '';
                        $hospitalizacion->diaInicio = $request->diaInicio ? $request->diaInicio : '';
                        $hospitalizacion->mesInicio = $request->mesInicio ? $request->mesInicio : '';
                        $hospitalizacion->anioInicio = $request->anioInicio ? $request->anioInicio : '';
                        $hospitalizacion->diaTermino = $request->diaTermino ? $request->diaTermino : '';
                        $hospitalizacion->mesTermino = $request->mesTermino ? $request->mesTermino : '';
                        $hospitalizacion->anioTermino = $request->anioTermino ? $request->anioTermino : '';
                        $hospitalizacion->intervencion = $request->intervencion ? $request->intervencion : '';
                        $hospitalizacion->otros = $request->otros ? $request->otros : '';
                        $hospitalizacion->accion_tomada = $request->accionTomada ? $request->accionTomada : '';
                        $hospitalizacion->opcion_duplicidad = !$request->opcion_duplicidad ? '' : $request->opcion_duplicidad;
                        $hospitalizacion->opcion_intervencion = !$request->opcion_intervencion ? '' : $request->opcion_intervencion;
                        $hospitalizacion->opcion_aceptacion = !$request->opcion_aceptacion ? '' : $request->opcion_aceptacion;
                        $hospitalizacion->opcion_sin_cambios = !$request->opcion_sin_cambios ? 'Sin cambios' : $request->opcion_sin_cambios;
                        $hospitalizacion->estatus = 1;
                        if ($hospitalizacion->save()) {
                            return redirect()->route('enHospital')->with('success', "Se registro el nuevo dia del paciente");
                        } else {
                            return redirect()->back()->withErrors(['error' => "Error al tratar de registrar el medicamento..."]);
                        }
                    } catch (\Exception $e) {
                        dd($e);
                        return redirect()->back()->withErrors(['error' => $e]);
                    }
                }
            } catch (\Exception $exception) {
                dd($exception);
                return redirect()->back()->withErrors(['error' => $exception]);
            }
        } else {
            return 0;
        }
    }
    public function datosPaciente($paciente_id, $hospital)
    {
        $enfermedades = [];
        try {
            $id_hospital = $hospital;
            $paciente = Pacientes::where("id_paciente", "=", $paciente_id)->first();
            if (!$paciente) {
                return redirect()->back()->withErrors(['error' => 'Paciente no encontrado']);
            } else {
                $datos = json_decode($paciente->id_enfermedad_cronica, true);
                if (empty($datos) || !is_array($datos)) {
                    $enfermedades = CatalogoEnfermedadesCronicas::all();
                } else {
                    foreach ($datos as $enf) {
                        $enfermedades = CatalogoEnfermedadesCronicas::whereIn('id', $datos)->get();
                    };
                }
                return view("datosPaciente", compact("paciente", "enfermedades", "id_hospital"));
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th]);
        }
    }
    public function salidaHospitalizacion($id)
    {
        //Cambiamos el estatus de la hospitalizacion
        $hospitalizacion = tablaHospital::find($id);
        $hospitalizacion->estatus = "Salio";
        $hospitalizacion->id_estatus = 0;
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
    public function actulizarPaciente(Request $request)
    {
        $rules = [
            'Id' => 'required',
            "id_hospital" => 'required',
            "nombre" => "required",
            "fecha_nac_dia" => "required",
            "fecha_nac_mes" => 'required',
            "fecha_nac_año" => "required",
            "edad" => "required",
            "genero" => "required",
            "telefono" => "required",
            "alergias" => 'required',
        ];

        $messages = [
            'id_hospital.required' => "El campo referencia del hospital es obligatorio",
            'nombre.required' => 'El campo Nombre es un campo obligatorio.',
            'Id.required' => 'No se recibio el id del paciente... Fvor de validar.',
            'fecha_nac_dia.required' => 'El campo del dia de la fecha de nacimiento es un campo obligatorio.',
            'fecha_nac_mes.required' => 'El campo del mes de la fech de nacimiento es un campo obligatorio.',
            'fecha_nac_año.required' => 'El campo año de naacimiento es un campo obligatorio.',
            'edad.required' => 'Laa edad es un campo obligatorio.',
            'genero.required' => 'El campo Genero administrada es un campo obligatorio.',
            'telefono.required' => 'El campo  Telefono es un campo obligatorio.',
            'alergias.required' => 'El campo Alergias es un campo obligatorio.',
        ];
        $this->validate($request, $rules, $messages);

        $paciente = Pacientes::find($request->Id);
        $paciente->nombre = $request->nombre;
        $paciente->fecha_nac_dia = $request->fecha_nac_dia;
        $paciente->fecha_nac_mes = $request->fecha_nac_mes;
        $paciente->fecha_nac_año = $request->fecha_nac_año;
        $paciente->edad = $request->edad;
        $paciente->genero = $request->genero;
        $paciente->telefono = $request->telefono;
        $paciente->alergias = $request->alergias;
        if ($paciente->save()) {
            $hospital = tablaHospital::find($request->id_hospital);
            $hospital->paciente = $request->nombre;
            if ($hospital->save()) {
                return redirect()->route('enHospital')->with('success', 'Los datos del paaciente se actualizarón correctamente.');
            } else {
                return redirect()->back()->withErrors(['error' => 'No se pudo actualizar el registro']);
            }
        } else {
            return redirect()->back()->withErrors(['error' => 'No se pudo actaalizr el paciente']);
        }
    }
    public function actualizarContra(Request $request)
    {
        if (!$request->contra || $request->contra == '' || $request->contra == null) {
            return redirect()->back()->withErrors(['error' => 'Tienes que ingresar la nueva contraseña']);
        } else {
            try {
                $id = auth()->user()->id;
                $usuario = User::find($id);
                $usuario->password = Hash::make($request->contra);
                if ($usuario->save()) {
                    auth()->logout();
                    return redirect('/login')->with('success', 'Contraseña actualizada correctamente');
                }
            } catch (\Exception $e) {
                dd($e);
            }
        }
    }
    public function filtro($filtro)
    {
        return Excel::download(new HospitalizacionExport($filtro), 'Hospitalizaciones.xlsx');
    }
}
