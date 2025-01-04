@extends('layouts.plantilla')

@section('content')
    <div class="container mt-3">
        <div class="accordion" id="accordionPanelsStayOpenExample">
            <form action="/actualizacionCambios" method="POST" class="mt-3 container">
                @csrf
                <input class="form-control" type="hidden" name="paciente_id" value="{{$paciente->id}}">
                <input class="form-control" type="hidden" name="id" value="{{$hospitalizacion->id}}">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                        <button class="accordion-button collapsed btn-secundario" type="button"
                            data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-ingresos" aria-expanded="false"
                            aria-controls="panelsStayOpen-ingresos">
                            Ingresos
                        </button>
                    </h2>
                    <div id="panelsStayOpen-ingresos" class="accordion-collapse collapse"
                        aria-labelledby="panelsStayOpen-headingTwo">
                        <div class="card">
                            <div class="card-body">
                                <!-- Fecha de Ingreso -->
                                <div class="row">
                                    <label for="fecha_ingreso">Fecha de Ingreso:</label>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <input class="form-control" type="text" value="{{$ingresos->ingreso_dia}}" readonly>
                                    </div>
                                    <div class="col-4">
                                        <input class="form-control" type="text" value="{{$ingresos->ingreso_mes}}" readonly>
                                    </div>
                                    <div class="col-4">
                                        <input class="form-control" type="text" value="{{$ingresos->ingreso_año}}" readonly>
                                    </div>
                                </div>

                                <!-- Hora de Ingreso -->
                                <div class="form-group">
                                    <label for="hora_ingreso">Hora de Ingreso:</label>
                                    <div class="row">
                                        <div class="col-4">
                                            <input class="form-control" type="text" value="{{$ingresos->ingreso_hora}}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <!-- Diagnóstico de Ingreso -->
                                        <div class="form-group">
                                            <label for="diagnostico_ingreso">Diagnóstico de Ingreso:</label>
                                            <div class="row">
                                                <div class="col-4">
                                                    <input class="form-control" type="text" value="{{$ingresos->diagnostico}}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <!-- Servicio -->
                                            <div class="form-group">
                                                <label for="servicio">Servicio:</label>
                                                <select class="form-select" id="servicio" name="servicio" required>
                                                    <option value="" selected disabled>Selecciona un servicio...
                                                    </option>
                                                    @foreach ($servicios as $servicio)
                                                        <option value="{{ $servicio->id }}" @if($servicio->id == $ingresos->id_servicio) selected @endif>{{ $servicio->servicio }}
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
                                                    <option value="" selected disabled>Selecciona una via de
                                                        administración...</option>
                                                    @foreach ($camas as $cama)
                                                        <option value="{{ $cama->id }}" @if($cama->id == $ingresos->id_cama) selected @endif>{{ $cama->cama }}</option>
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
                                <div class="row">
                                    <!-- Frecuencia Cardíaca -->
                                    <div class="col-md-6 form-group">
                                        <label for="frecuencia_cardiaca">Frecuencia Cardíaca:</label>
                                        <input type="number"  id="frecuencia_cardiaca"
                                            class="form-control" placeholder="Latidos por minuto" value="{{$signos->frecuencia_cardiaca}}" readonly>
                                    </div>

                                    <!-- Tensión Arterial -->
                                    <div class="col-md-6 form-group">
                                        <label for="tension_arterial">Tensión Arterial:</label>
                                        <input type="text"  id="tension_arterial"
                                            class="form-control" placeholder="Ejemplo: 120/80" value="{{$signos->tension_arterial}}" readonly>
                                    </div>

                                    <!-- Pulso -->
                                    <div class="col-md-6 form-group">
                                        <label for="pulso">Pulso:</label>
                                        <input type="number"  id="pulso" class="form-control"
                                            placeholder="Pulsaciones por minuto" value="{{$signos->pulso}}" readonly>
                                    </div>

                                    <!-- Temperatura -->
                                    <div class="col-md-6 form-group">
                                        <label for="temperatura">Temperatura:</label>
                                        <input type="number"  id="temperatura" class="form-control"
                                            placeholder="En grados Celsius" value="{{$signos->frecuencia_respiratoria}}" readonly>
                                    </div>

                                    <!-- Frecuencia Respiratoria -->
                                    <div class="col-md-6 form-group">
                                        <label for="frecuencia_respiratoria">Frecuencia Respiratoria:</label>
                                        <input type="number"  id="frecuencia_respiratoria"
                                            class="form-control" placeholder="Respiraciones por minuto" value="{{$signos->frecuencia_respiratoria}}" readonly>
                                    </div>

                                    <!-- Oxigenación -->
                                    <div class="col-md-6 form-group">
                                        <label for="oxigenacion">Oxigenación:</label>
                                        <input type="number" id="oxigenacion" class="form-control"
                                            placeholder="Porcentaje de oxígeno" value="{{$signos->oxigenacion}}" readonly>
                                    </div>

                                    <!-- Peso -->
                                    <div class="col-md-6 form-group">
                                        <label for="peso">Peso:</label>
                                        <input type="number" id="peso" class="form-control"
                                            placeholder="En kilogramos" value="{{$signos->peso}}" readonly>
                                    </div>

                                    <!-- Talla -->
                                    <div class="col-md-6 form-group">
                                        <label for="talla">Talla:</label>
                                        <input type="number" id="talla" class="form-control"
                                            placeholder="En centímetros" value="{{$signos->talla}}" readonly>
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
                                                <select class="form-select" id="medicoTratante" name="medicoTratante" disabled>
                                                    @foreach ($medicos as $medico)
                                                        <option value="{{ $medico->id }}" @if($tratamiento->id_medico == $medico->id) selected @endif>{{ $medico->nombre }}</option>
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
                                                <textarea class="form-control" id="diagnosticoAgregado" rows="2" required readonly>{{{$tratamiento->diagnostico_agregado}}}</textarea>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="diagnosticoEgreso" class="col-sm-2 col-form-label">Diagnóstico
                                                Egreso:</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" id="diagnosticoEgreso"  rows="2" required readonly> {{{$tratamiento->diagnostico_egreso}}}</textarea>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="laboratorios" class="col-sm-2 col-form-label">Laboratorios:</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" id="laboratorios" rows="2" required readonly>{{{$tratamiento->laboratorios}}}</textarea>
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
                        <button type="submit" class="btn btn-principal" style="font-style: oblique;">Siguiente</button>
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
