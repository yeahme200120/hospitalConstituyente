@extends('layouts.plantilla')

@section('content')
    <div class="container mt-3">
        <div class="accordion" id="accordionPanelsStayOpenExample">
            <form action="/actualizacionCambios" method="POST" class="mt-3 container">
                @csrf
                <input class="form-control" type="hidden" name="paciente_id" id="paciente_id" value="{{$pacientes->id}}">
                <input class="form-control" type="hidden" name="id" id="id" value="{{$hospitalizacion->id}}">
                <input type="hidden" name="id_hospital" value="{{$tabla->id}}">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                        <button class="accordion-button collapsed btn-secundario" type="button"
                            data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-ingresos" aria-expanded="false"
                            aria-controls="panelsStayOpen-ingresos">
                            Ingresos
                        </button>
                    </h2>
                    @php
                    $mesActual = date("n");
                    $diaActual = date("j");
                    $añoActual = date("Y");
                    $arrayMeses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'] ;
                @endphp
                    <div id="panelsStayOpen-ingresos" class="accordion-collapse collapse"
                        aria-labelledby="panelsStayOpen-headingTwo">
                        <div class="card">
                            <div class="card-body">
                                <!-- Fecha de Ingreso -->
                                <div class="form-group">
                                    <label for="fecha_ingreso">Fecha de Ingreso:</label>
                                    <div class="d-flex">
                                            <input class="form-control" name="dia" id="dia" value="{{ $diaActual }}" readonly>
                                        @error('dia')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <input class="form-control" name="mes" id="mes" type="text" class="form-control" value="{{$mesActual+1}}" readonly>
                                        @error('mes')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <input class="form-control" type="text" id="anio" name="anio" value="{{$añoActual}}" readonly>
                                        @error('anio')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Hora de Ingreso -->
                                <div class="form-group">
                                    <label for="hora_ingreso">Hora de Ingreso:</label>
                                    <input type="time" name="hora_ingreso" id="hora_ingreso" class="form-control"
                                        value="{{ old('hora_ingreso', date('H:i')) }}" readonly>
                                    @error('hora_ingreso')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-6 d-none">
                                        <!-- Diagnóstico de Ingreso -->
                                        <div class="form-group">
                                            <label for="diagnostico_ingreso">Diagnóstico de Ingreso:</label>
                                            <input name="diagnostico_ingreso" id="diagnostico_ingreso" class="form-control" rows="3" value="{{old('diagnostico_ingreso')}}">
                                            @error('diagnostico_ingreso')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="row">
                                            <!-- Servicio -->
                                            <div class="form-group">
                                                <label for="servicio">Servicio:</label>
                                                <select class="form-select" id="servicio" name="servicio">
                                                    <option value="" disabled {{ old('servicio') ? '' : 'selected' }}>Selecciona un Servicio...</option>
                                                    @foreach ($servicios as $servicio)
                                                        <option value="{{ $servicio->id }}" @if($servicio->id == $tabla->id_servicio) selected @endif>{{ $servicio->servicio }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('servicio')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="row">
                                            <!-- Cama -->
                                            <div class="form-group">
                                                <label for="cama">Cama:</label>
                                                <select class="form-select" id="cama" name="cama">
                                                    <option value="" disabled {{ old('cama') ? '' : 'selected' }}>Selecciona una cama...</option>
                                                    @foreach ($camas as $cama)
                                                        <option value="{{ $cama->id }}"  @if($cama->id == $tabla->id_cama) selected @endif {{ old('cama') == $cama->id ? 'selected' : '' }}>
                                                            {{ $cama->cama }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('cama')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <!-- Diagnóstico de Ingreso -->
                                        <div class="form-group">
                                            <label for="diagnostico_ingreso">Diagnóstico de Ingreso:</label>
                                            <input name="diagnostico_ingreso" id="diagnostico_ingreso" class="form-control" rows="3" value="{{old('diagnostico_ingreso')}}">
                                            @error('diagnostico_ingreso')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                        <button class="accordion-button collapsed btn-secundario" type="button"
                            data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-signos"
                            aria-expanded="false" aria-controls="panelsStayOpen-signos">
                            Signos Vitales
                        </button>
                    </h2>
                    <div id="panelsStayOpen-signos" class="accordion-collapse collapse"
                        aria-labelledby="panelsStayOpen-headingThree">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-body">
                                    <div class="row">
                                        <!-- Frecuencia Cardíaca -->
                                        <div class="col-md-6 form-group">
                                            <label for="frecuencia_cardiaca">Frecuencia Cardíaca:</label>
                                            <input type="text" name="frecuencia_cardiaca" id="frecuencia_cardiaca"
                                                class="form-control" placeholder="Latidos por minuto" value="{{old('frecuencia_cardiaca')}}">
                                            @error('frecuencia_cardiaca')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
    
                                        <!-- Tensión Arterial -->
                                        <div class="col-md-6 form-group">
                                            <label for="tension_arterial">Tensión Arterial:</label>
                                            <input type="text" name="tension_arterial" id="tension_arterial"
                                                class="form-control" placeholder="Ejemplo: 120/80" value="{{old('tension_arterial')}}">
                                            @error('tension_arterial')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
    
                                        <!-- Temperatura -->
                                        <div class="col-md-6 form-group">
                                            <label for="temperatura">Temperatura:</label>
                                            <input type="text" name="temperatura" id="temperatura" class="form-control"
                                                placeholder="En grados Celsius" value="{{old('temperatura')}}">
                                            @error('temperatura')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
    
                                        <!-- Frecuencia Respiratoria -->
                                        <div class="col-md-6 form-group">
                                            <label for="frecuencia_respiratoria">Frecuencia Respiratoria:</label>
                                            <input type="text" name="frecuencia_respiratoria" id="frecuencia_respiratoria"
                                                class="form-control" placeholder="Respiraciones por minuto" value="{{old('frecuencia_respiratoria')}}">
                                            @error('frecuencia_respiratoria')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
    
                                        <!-- Oxigenación -->
                                        <div class="col-md-6 form-group">
                                            <label for="oxigenacion">Oxigenación:</label>
                                            <input type="text" name="oxigenacion" id="oxigenacion" class="form-control"
                                                placeholder="Porcentaje de oxígeno" value="{{old('oxigenacion')}}">
                                            @error('oxigenacion')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
    
                                        <!-- Peso -->
                                        <div class="col-md-6 form-group">
                                            <label for="peso">Peso:</label>
                                            <input type="text" name="peso" id="peso" class="form-control"
                                                placeholder="En kilogramos" value="{{old('peso')}}">
                                            @error('peso')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
    
                                        <!-- Talla -->
                                        <div class="col-md-6 form-group">
                                            <label for="talla">Talla:</label>
                                            <input type="text" name="talla" id="talla" class="form-control"
                                                placeholder="En centímetros" value="{{old('talla')}}">
                                            @error('talla')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header " id="panelsStayOpen-headingOne">
                        <button class="accordion-button btn-secundario" type="button" data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-tratamiento" aria-expanded="true"
                            aria-controls="panelsStayOpen-tratamiento">
                            Tratamiento
                        </button>
                    </h2>
                    <div id="panelsStayOpen-tratamiento" class="accordion-collapse collapse show"
                        aria-labelledby="panelsStayOpen-headingOne">
                        <div class="card">
                            <div class="card-body">
                                <div class="card mb-4">
                                    <div class="card-body">
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
                                                        <option value="{{ $medico->id }}">{{ $medico->nombre }} -- Cedula: {{ $medico->cedula }} </option>
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
                                                    value="{{ old('diagnosticoEgreso') }}" />
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
                                </div>
                            </div>
    
                    </div>
                </div>
                {{-- Seccion de medicamento --}}
                <div class="row justify-content-end mt-3">
                    <div class="col-2">
                        <a href="/salidaHospitalizacion/{{$hospitalizacion->id}}" class="btn btn-principal" disabled>SALIDA PACIENTE</a>
                    </div>
                    <div class="col-3">
                        <button type="button" class="btn btn-principal"
                                            onclick="agregarMedicamento()">AGREGAR MEDICAMENTO</button>
                    </div>
                    <div class="col-2">
                        <button type="submit" class="btn btn-principal" style="font-style: oblique;">Registrar nuevo día</button>
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
    </script>
    <script>
        $(document).ready(function() {
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    toastr.error("{{ $error }}");
                @endforeach
            @endif

            @if (session('success'))
                toastr.success("{{ session('success') }}");
            @endif
        });

        function calculaEdad() {
            let año = $("#fecha_nac_año").val()
            let fecha = new Date()
            let edad = (fecha.getFullYear() - año);
            $("#edad").val(edad);

        }
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
    
@endsection
