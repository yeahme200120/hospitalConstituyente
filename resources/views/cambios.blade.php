@extends('layouts.plantilla')

@section('content')
    <div class="container mt-3">
        <div class="accordion" id="accordionPanelsStayOpenExample">
            <form action="/actualizacionCambios" method="POST" class="mt-3 container">
                @csrf
                <input class="form-control" type="hidden" name="paciente_id" value="{{$pacientes->id}}">
                <input class="form-control" type="hidden" name="id" value="{{$hospitalizacion->id}}">
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
                @endphp
                    <div id="panelsStayOpen-ingresos" class="accordion-collapse collapse"
                        aria-labelledby="panelsStayOpen-headingTwo">
                        <div class="card">
                            <div class="card-body">
                                <!-- Fecha de Ingreso -->
                                <div class="form-group">
                                    <label for="fecha_ingreso">Fecha de Ingreso:</label>
                                    <div class="d-flex">
                                        <select name="dia" id="dia" class="form-control" style="width: 25%;">
                                            @for ($i = 1; $i <= 31; $i++)
                                                <option value="{{ $i }}" value="{{ $i }}" {{ $i == ($diaActual ) ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                        @error('dia')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <select name="mes" id="mes" class="form-control mx-2"
                                            style="width: 40%;">
                                            @foreach (['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'] as $index => $mes)
                                                <option value="{{ $index + 1 }}"  {{ ($index + 1) == $mesActual ? 'selected' : '' }}>{{ $mes }}</option>
                                            @endforeach
                                        </select>
                                        @error('mes')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <select name="anio" id="anio" class="form-control" style="width: 35%;">
                                            @for ($i = date('Y') + 10; $i >= 1900; $i--)
                                                <option value="{{ $i }}"  {{ $i == $añoActual ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                        @error('anio')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Hora de Ingreso -->
                                <div class="form-group">
                                    <label for="hora_ingreso">Hora de Ingreso:</label>
                                    <input type="time" name="hora_ingreso" id="hora_ingreso" class="form-control"
                                        value="{{ old('hora_ingreso', date('H:i')) }}">
                                    @error('hora_ingreso')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
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
                                            <input type="number" name="frecuencia_cardiaca" id="frecuencia_cardiaca"
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
                                            <input type="number" name="temperatura" id="temperatura" class="form-control"
                                                placeholder="En grados Celsius" value="{{old('temperatura')}}">
                                            @error('temperatura')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
    
                                        <!-- Frecuencia Respiratoria -->
                                        <div class="col-md-6 form-group">
                                            <label for="frecuencia_respiratoria">Frecuencia Respiratoria:</label>
                                            <input type="number" name="frecuencia_respiratoria" id="frecuencia_respiratoria"
                                                class="form-control" placeholder="Respiraciones por minuto" value="{{old('frecuencia_respiratoria')}}">
                                            @error('frecuencia_respiratoria')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
    
                                        <!-- Oxigenación -->
                                        <div class="col-md-6 form-group">
                                            <label for="oxigenacion">Oxigenación:</label>
                                            <input type="number" name="oxigenacion" id="oxigenacion" class="form-control"
                                                placeholder="Porcentaje de oxígeno" value="{{old('oxigenacion')}}">
                                            @error('oxigenacion')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
    
                                        <!-- Peso -->
                                        <div class="col-md-6 form-group">
                                            <label for="peso">Peso:</label>
                                            <input type="number" name="peso" id="peso" class="form-control"
                                                placeholder="En kilogramos" value="{{old('peso')}}">
                                            @error('peso')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
    
                                        <!-- Talla -->
                                        <div class="col-md-6 form-group">
                                            <label for="talla">Talla:</label>
                                            <input type="number" name="talla" id="talla" class="form-control"
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
                                                        <option value="{{ $medico->id }}">{{ $medico->nombre }}</option>
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
                </div>
                <div class="row justify-content-end mt-3">
                    <div class="col-2">
                        <a href="/salidaHospitalizacion/{{$hospitalizacion->id}}" class="btn btn-principal" disabled>SALIDA PACIENTE</a>
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
    </script>
@endsection
