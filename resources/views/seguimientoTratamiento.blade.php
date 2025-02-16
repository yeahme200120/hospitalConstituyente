@extends('layouts.plantilla')

@section('content')
    <div class="row text-center">
        <h3>SEGUIMIENTO FARMACOTERAPÉUTICO</h3>
    </div>
    <div class="container mt-3">
        <div class="accordion" id="accordionPanelsStayOpenExample">
            {{-- <form id="redirect-form" action="{{ route('returnHome') }}" method="POST">
                @csrf
                <div class="row justify-content-end p-1" title="Sin cambios">
                    <div class="col-3">
                        <button type="submit" class="btn btn-success" style="border-radius: 2rem">
                            <label for="">Sin cambios en el medicamento</label>
                            <input name="mensaje" id="mensaje" type="hidden"
                                value="Registro correcto de Tratamiento y hospitalización">
                        </button>
                    </div>
                </div>
            </form> --}}
            <form action="/registrarSeguimiento2" method="POST" class="mt-3 container">
                @csrf   
                <div class="accordion-item">
                    <h2 class="accordion-header " id="panelsStayOpen-headingOne">
                        <button class="accordion-button btn-secundario" type="button" data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                            aria-controls="panelsStayOpen-collapseOne">
                            Tratamiento
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
                        aria-labelledby="panelsStayOpen-headingOne">
                        <div class="card">
                            <div class="card-body">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <input type="hidden" id="pacienteId" name="pacienteId" value="{{ $paciente }}">
                                        <input type="hidden" id="fechaGlobal" name="fechaGlobal" value="{{ $fechaG }}">

                                        @error('pacienteId')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        
                                        <div class="row mb-3">
                                            <label for="fecha_registro" class="col-sm-2 col-form-label">Fecha de Registro:</label>
                                            <div class="col-12 col-md-10">
                                                <div class="form-group">
                                                    <input type="date" class="form-control" id="fecha_registro", name="fecha_registro">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="medicoTratante" class="col-sm-2 col-form-label">Médico
                                                Tratante:</label>
                                            <div class="col-sm-10">
                                                <select class="form-select" id="medicoTratante" name="medicoTratante"
                                                    required>
                                                    <option value="" disabled
                                                        {{ old('medicoTratante') ? '' : 'selected' }}>Selecciona una
                                                        medico...</option>
                                                    @foreach ($medicos as $medico)
                                                        <option value="{{ $medico->id }}">{{ $medico->nombre }} -- Cedula:  {{$medico->cedula}}</option>
                                                    @endforeach
                                                </select>
                                                @error('medicoTratante')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="diagnosticoAgregado" class="col-sm-2 col-form-label">Diagnóstico
                                                Agregado:</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="diagnosticoAgregado"
                                                    name="diagnosticoAgregado" rows="2" required
                                                    value="{{ old('diagnosticoAgregado', null) }}" />
                                                @error('diagnosticoAgregado')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="diagnosticoEgreso" class="col-sm-2 col-form-label">Diagnóstico
                                                Egreso:</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="diagnosticoEgreso"
                                                    name="diagnosticoEgreso" rows="2"
                                                    value="{{ old('diagnosticoEgreso') }}" required />
                                                @error('diagnosticoEgreso')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="laboratorios" class="col-sm-2 col-form-label">Laboratorios:</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="laboratorios"
                                                    name="laboratorios" rows="2" required
                                                    value="{{ old('laboratorios') }}" />
                                                @error('laboratorios')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <h5  class="btn-secundario text-center p-2" id="panelsStayOpen-headingTwo" style="border-radius:0%">
                        INGRESO DE MEDICAMENTO  
                    </h2>
                        <!-- Hospitalización - Urgencias - Quirófano -->
                        <div class="card mb-4 " style="border: none">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <label for="medicamento" class="col-sm-2 col-form-label">Medicamento:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="medicamento" name="medicamento"
                                            required value="{{ old('medicamento') }}">
                                        @error('medicamento')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="dosisMaxima" class="col-sm-2 col-form-label">Dosis Máxima:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="dosisMaxima" name="dosisMaxima"
                                            required value="{{ old('dosisMaxima') }}">
                                        @error('dosisMaxima')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="dosisAdministrada" class="col-sm-2 col-form-label">Dosis
                                        Administrada:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="dosisAdministrada"
                                            name="dosisAdministrada" required value="{{ old('dosisAdministrada') }}">
                                        @error('dosisAdministrada')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="viaAdministracion" class="col-sm-2 col-form-label">Vía de Administración</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" id="via" name="via" required>
                                            <option value="" disabled {{ old('via') ? '' : 'selected' }}>Selecciona
                                                una via de Administración...</option>
                                            @foreach ($vias as $via)
                                                <option value="{{ $via->id }}">{{ $via->via }}</option>
                                            @endforeach
                                        </select>
                                        @error('via')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="intervalo" class="col-sm-2 col-form-label">Intervalo</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="intervalo" name="intervalo"
                                        required value="{{ old('intervalo') }}">
                                    @error('intervalo')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    </div>
                                </div>  
                                <div class="row mb-3">
                                    <label for="horario" class="col-sm-2 col-form-label">Horario</label>
                                    <div class="col-sm-10">
                                        <input type="time" class="form-control" id="horario" name="horario"
                                        required value="{{ old('horario', date('H:i')) }}">
                                    @error('time')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    </div>
                                </div> 
                                @php
                                    $mesActual = date('n');
                                    $diaActual = date('j');
                                    $añoActual = date('Y');
                                @endphp 
                                <div class="row mb-3">
                                    <label for="horario" class="col-sm-2 col-form-label">Fecha de Inicio</label>
                                    <div class="col-sm-10">
                                        <div class="row g-2">
                                            <div class="col">
                                                <select class="form-select" id="diaInicio" name="diaInicio" required>
                                                    @for ($i = 1; $i <= 31; $i++)
                                                        <option value="{{ $i }}"
                                                            {{ $i == $diaActual ? 'selected' : '' }}>
                                                            {{ $i }}</option>
                                                    @endfor
                                                </select>
                                                @error('diaInicio')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col">
                                                <select name="mesInicio" id="mesInicio" class="form-control">
                                                    <option value="" disabled
                                                        {{ old('mesInicio') ? '' : 'selected' }}>Selecciona una opción...
                                                    </option>
                                                    @foreach (['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'] as $index => $mes)
                                                        <option value="{{ $index + 1 }}"
                                                            {{ old('mesInicio') == $index + 1 || (empty(old('mesInicio')) && $index + 1 == date('n')) ? 'selected' : '' }}>
                                                            {{ $mes }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('mesInicio')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col">
                                                <select class="form-select" id="anioInicio" name="anioInicio" required>
                                                    @for ($i = date('Y') + 10; $i >= 1900; $i--)
                                                        <option value="{{ $i }}"
                                                            {{ $i == $añoActual ? 'selected' : '' }}>
                                                            {{ $i }}</option>
                                                    @endfor
                                                </select>
                                                @error('anioInicio')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                <div class="row mb-3">
                                    <label for="horario" class="col-sm-2 col-form-label">Fecha Termino</label>
                                    <div class="col-sm-10">
                                        <div class="row g-2">
                                            <div class="col">
                                                <select class="form-select" id="diaTermino" name="diaTermino">
                                                    <option value="" selected disabled>Selecciona el dia</option>
                                                    @for ($i = 1; $i <= 31; $i++)
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="col">
                                                <select class="form-select" id="mesTermino" name="mesTermino">
                                                    <option value="" selected disabled>Selecciona el mes...</option>
                                                    @foreach (['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'] as $index => $mes)
                                                        <option value="{{ $index + 1 }}">{{ $mes }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col">
                                                <select class="form-select" id="anioTermino" name="anioTermino">
                                                    <option value="" disabled selected>Selecciona el año</option>
                                                    @for ($i = date('Y') + 10; $i >= 1900; $i--)
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                <div class="fondo-principal mt-5 mb-5" style="border-radius: 2rem">
                                    <label for=""></label>
                                </div>
                        
                                <div class="row mb-3">
                                    <!-- Interacciones -->
                                    <div class="row">
                                        <div class="col-2">
                                            <label for="interacciones" class="form-label">Interacciones</label>
                                    </div>
                                    <divv class="col-10">
                                        <input type="text" class="form-control col-10" id="interacciones"
                                            name="interacciones" value="{{ old('interacciones') }}">
                                        @error('interacciones')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </divv>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <!-- Contraindicaciones -->
                                    <div class="row">
                                        <div class="col-2">
                                            <label for="contraindicaciones" class="form-label">Contraindicaciones</label>

                                        </div>
                                        <div class="col-10">
                                            <input type="text" class="form-control" id="contraindicaciones"
                                                name="contraindicaciones" value="{{ old('contraindicaciones') }}">
                                            @error('contraindicaciones')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <!-- Recomendación -->
                                    <div class="row">
                                        <div class="col-2">
                                            <label for="recomendacion" class="form-label">Recomendación</label>
                                        </div>
                                        <div class="col-10">
                                            <input type="text" class="form-control" id="recomendacion"
                                                name="recomendacion" value="{{ old('recomendacion') }}">
                                            @error('recomendacion')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                            
                                    <!-- Intervención -->
                                    <div class="row"> 
                                        <div class="col-2">
                                            <label for="intervencion" class="form-label">Intervención</label>
                                    </div>
                                    <div class="col-10">
                                        <input type="text" class="form-control" id="intervencion" name="intervencion"
                                             value="{{ old('intervencion') }}">
                                        @error('intervencion')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <!-- Otros -->
                                    <div class="row"> 
                                        <div class="col-2">
                                            <label for="otros" class="form-label">Otros</label>

                                    </div>
                                    <div class="col-10">
                                        <input type="text" class="form-control" id="otros" name="otros"
                                         value="{{ old('otros') }}">
                                        @error('otros')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <!-- Acción Tomada -->
                                    <div class="row"> 
                                        <div class="col-2">
                                            <label for="accionTomada" class="form-label">Acción Tomada</label>
                                    </div>
                                    <div class="col-10">
                                        <input class="form-control" id="accionTomada" name="accionTomada" rows="2"
                                             value="{{ old('accionTomada') }}">
                                        @error('accionTomada')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    </div>
                                </div>

                                <!-- Botones -->
                                <div class="d-flex justify-content-center gap-2">
                                    <button type="submit" class="btn btn-principal p-3">GUARDAR</button>
                                    <button type="button" class="btn btn-principal p-3"
                                        onclick="agregarMedicamento()">AGREGAR MEDICAMENTO</button>
                                    <button type="button" class="btn btn-principal p-3" disabled>SALIDA PACIENTE</button>
                                </div>
                            </div>
                        </div>

                </div>
            </form>
        </div>
    </div>
    <script>
        @if (session('success'))
            toastr.success('{{ session('success') }}');
        @endif

        @if (session('error'))
            toastr.error('{{ session('error') }}');
        @endif
        function agregarMedicamento() {
            console.log("Agregar medicamento");
            try {
                let paciente_id = $("#pacienteId").val() ? $("#pacienteId").val() : ''
                let medicamento = $("#medicamento").val() ? $("#medicamento").val() : ''
                let dosis_max = $("#dosisMaxima").val() ? $("#dosisMaxima").val() : ''
                let dosis_administrada = $("#dosisAdministrada").val() ? $("#dosisAdministrada").val() : ''
                let id_via_administracion = $("#via").val() ? $("#via").val() : ''
                let intervalo = $("#intervalo").val() ? $("#intervalo").val() : ''
                let horario = $("#horario").val() ? $("#horario").val() : ''
                let diaInicio = $("#diaInicio").val() ? $("#diaInicio").val() : ''
                let mesInicio = $("#mesInicio").val() ? $("#mesInicio").val() : ''
                let anioInicio = $("#anioInicio").val() ? $("#anioInicio").val() : ''
                let diaTermino = $("#diaTermino").val() ? $("#diaTermino").val() : ''
                let mesTermino = $("#mesTermino").val() ? $("#mesTermino").val() : ''
                let anioTermino = $("#anioTermino").val() ? $("#anioTermino").val() : ''
                let intervencion = $("#intervencion").val() ? $("#intervencion").val() : ''
                let interacciones = $("#interacciones").val() ? $("#interacciones").val() : ''
                let contraindicaciones = $("#contraindicaciones").val() ? $("#contraindicaciones").val() : ''
                let recomendacion = $("#recomendacion").val() ? $("#recomendacion").val() : ''
                let otros = $("#otros").val() ? $("#otros").val() : ''
                let accion_tomada = $("#accionTomada").val() ? $("#accionTomada").val() : ''
                const token = '{{ csrf_token() }}';

                let dataMedicamento = {
                    paciente_id: paciente_id ? paciente_id : '',
                    medicamento: medicamento ? medicamento : '',
                    dosis_max: dosis_max ? dosis_max : '',
                    dosis_administrada: dosis_administrada ? dosis_administrada : '',
                    id_via_administracion: id_via_administracion ? id_via_administracion : '',
                    intervalo: intervalo ? intervalo : '',
                    horario: horario ? horario : '',
                    diaInicio: diaInicio ? diaInicio : '',
                    mesInicio: mesInicio ? mesInicio : '',
                    anioInicio: anioInicio ? anioInicio : '',
                    diaTermino: diaTermino ? diaTermino : '',
                    mesTermino: mesTermino ? mesTermino : '',
                    anioTermino: anioTermino ? anioTermino : '',
                    intervencion: intervencion ? intervencion : '',
                    interacciones: interacciones ? interacciones : '',
                    contraindicaciones: contraindicaciones ? contraindicaciones : '',
                    recomendacion: recomendacion ? recomendacion : '',
                    otros: otros ? otros : '',
                    accion_tomada: accion_tomada ? accion_tomada : '',
                    '_token': "{{ csrf_token() }}",
                };
                console.log("Datos del medicamento a registrar: ", dataMedicamento);
                $.ajax({
                    type: "post",
                    url: "{{ route('agregarMedicamento') }}",
                    data: dataMedicamento,
                    success: function(msg) {
                        console.log(msg);
                        try {
                            limpiarFormulario();
                        } catch (error) {
                            console.log("Error al limpiar el formulario", error);
                            
                        }
                        
                    },
                    error: function(request, status, errorThrown) {
                        console.log(request, status, errorThrown);
                    }
                });
            } catch (error) {
                console.log("Error al generar la data");
            }
        }
         function limpiarFormulario() {
            console.log("Limpiando el formulario");
            try {
                $("#medicamento").val('')
                $("#dosisMaxima").val('')
                $("#dosisAdministrada").val('')
                $("#intervalo").val('')
                $("#horario").val('')
                $("#diaInicio").val('')
                $("#mesInicio").val('')
                $("#anioInicio").val('')
                $("#diaTermino").val('')
                $("#mesTermino").val('')
                $("#anioTermino").val('')
                $("#intervencion").val('')
                $("#interacciones").val('')
                $("#contraindicaciones").val('')
                $("#recomendacion").val('')
                $("#otros").val('')
                $("#accionTomada").val('')
            } catch (error) {
                console.log("Error: ", error);
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    toastr.error("{{ $error }}");
                @endforeach
            @endif
            const today = new Date();

            // Establecer la fecha como el valor 'YYYY-MM-DD'
            const localDate = today.getFullYear() + '-' 
                            + String(today.getMonth() + 1).padStart(2, '0') + '-' 
                            + String(today.getDate()).padStart(2, '0');

            // Asignar la fecha actual al campo de fecha
            document.getElementById("fecha_registro").value = localDate;
        });
    </script>
@endsection
