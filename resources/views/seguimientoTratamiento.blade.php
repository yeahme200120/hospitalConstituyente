@extends('layouts.plantilla')

@section('content')
    <div class="container mt-3">
        <div class="accordion" id="accordionPanelsStayOpenExample">
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
                                        <div class="row mb-3">
                                            <label for="pacienteId" class="col-sm-2 col-form-label">Paciente:</label>
                                            <div class="col-sm-10">
                                                <select class="form-select" id="pacienteId" name="pacienteId" required>
                                                    <option value="" selected disabled>Selecciona un paciente...
                                                    </option>
                                                    @foreach ($pacientes as $paciente)
                                                        <option value="{{ $paciente->id }}">{{ $paciente->nombre }}</option>
                                                    @endforeach
                                                </select>
                                                @error('pacienteId')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="medicoTratante" class="col-sm-2 col-form-label">Médico
                                                Tratante:</label>
                                            <div class="col-sm-10">
                                                <select class="form-select" id="medicoTratante" name="medicoTratante" required>
                                                    <option value="" selected disabled>Selecciona un medico...
                                                    </option>
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
                                                <textarea class="form-control" id="diagnosticoAgregado" name="diagnosticoAgregado" rows="2" required></textarea>
                                                @error('diagnosticoAgregado')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="diagnosticoEgreso" class="col-sm-2 col-form-label">Diagnóstico
                                                Egreso:</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" id="diagnosticoEgreso" name="diagnosticoEgreso" rows="2" required></textarea>
                                                @error('diagnosticoEgreso')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="laboratorios" class="col-sm-2 col-form-label">Laboratorios:</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" id="laboratorios" name="laboratorios" rows="2" required></textarea>
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
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                        <button class="accordion-button collapsed btn-secundario" type="button" data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                            aria-controls="panelsStayOpen-collapseTwo">
                            HOSPITALIZACION - URGENCIAS - QUIROFANO
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse show"
                        aria-labelledby="panelsStayOpen-headingTwo">
                        <!-- Hospitalización - Urgencias - Quirófano -->
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <label for="medicamento" class="col-sm-2 col-form-label">Medicamento:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="medicamento" name="medicamento" required>
                                        @error('medicamento')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="dosisMaxima" class="col-sm-2 col-form-label">Dosis Máxima:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="dosisMaxima" name="dosisMaxima" required>
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
                                            name="dosisAdministrada" required>
                                        @error('dosisAdministrada')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Botones de selección -->
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="servicio"
                                                id="urgencias" value="1" required>
                                            <label class="form-check-label" for="urgencias">Urgencias</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="servicio"
                                                id="hospitalizacion" value="2" required>
                                            <label class="form-check-label" for="hospitalizacion">Hospitalización</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="servicio"
                                                id="quirofano" value="3" required>
                                            <label class="form-check-label" for="quirofano">Quirófano</label>
                                        </div>
                                    </div>
                                    @error('servicio')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row mb-3">
                                    <!-- Vía de Administración -->
                                    <div class="col-md-6">
                                        <label for="viaAdministracion" class="form-label">Vía de Administración</label>
                                        <select class="form-select" id="via" name="via" required>
                                            <option value="" selected disabled>Selecciona una via de
                                                administración...</option>
                                            @foreach ($vias as $via)
                                                <option value="{{ $via->id }}">{{ $via->via }}</option>
                                            @endforeach
                                        </select>
                                        @error('via')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Interacciones -->
                                    <div class="col-md-6">
                                        <label for="interacciones" class="form-label">Interacciones</label>
                                        <input type="text" class="form-control" id="interacciones"
                                            name="interacciones" required>
                                        @error('interacciones')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <!-- Intervalo -->
                                    <div class="col-md-6">
                                        <label for="intervalo" class="form-label">Intervalo</label>
                                        <input type="text" class="form-control" id="intervalo" name="intervalo" required>
                                        @error('intervalo')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Contraindicaciones -->
                                    <div class="col-md-6">
                                        <label for="contraindicaciones" class="form-label">Contraindicaciones</label>
                                        <input type="text" class="form-control" id="contraindicaciones"
                                            name="contraindicaciones" required>
                                        @error('contraindicaciones')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <!-- Horario -->
                                    <div class="col-md-6">
                                        <label for="horario" class="form-label">Horario</label>
                                        <input type="time" class="form-control" id="horario" name="horario" required>
                                        @error('time')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Recomendación -->
                                    <div class="col-md-6">
                                        <label for="recomendacion" class="form-label">Recomendación</label>
                                        <input type="text" class="form-control" id="recomendacion"
                                            name="recomendacion" required>
                                        @error('recomendacion')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <!-- Fecha de Inicio -->
                                    <div class="col-md-6">
                                        <label for="fechaInicio" class="form-label">Fecha de Inicio</label>
                                        <div class="row g-2">
                                            <div class="col">
                                                <select class="form-select" id="diaInicio" name="diaInicio" required>
                                                    @for ($i = 1; $i <= 31; $i++)
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                                </select>
                                                @error('diaInicio')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col">
                                                <select class="form-select" id="mesInicio" name="mesInicio" required>
                                                    @foreach (['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'] as $index => $mes)
                                                        <option value="{{ $index + 1 }}">{{ $mes }}</option>
                                                    @endforeach
                                                </select>
                                                @error('mesInicio')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col">
                                                <select class="form-select" id="anioInicio" name="anioInicio" required>
                                                    @for ($i = date('Y'); $i >= 1900; $i--)
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                                </select>
                                                @error('anioInicio')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Intervención -->
                                    <div class="col-md-6">
                                        <label for="intervencion" class="form-label">Intervención</label>
                                        <input type="text" class="form-control" id="intervencion"
                                            name="intervencion" required>
                                            @error('intervencion')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <!-- Fecha de Término -->
                                    <div class="col-md-6">
                                        <label for="fechaTermino" class="form-label">Fecha de Término</label>
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
                                                    @for ($i = date('Y'); $i >= 1900; $i--)
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Otros -->
                                    <div class="col-md-6">
                                        <label for="otros" class="form-label">Otros</label>
                                        <input type="text" class="form-control" id="otros" name="otros" required>
                                        @error('otros')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <!-- Acción Tomada -->
                                    <div class="col-md-6">
                                        <label for="accionTomada" class="form-label">Acción Tomada</label>
                                        <textarea class="form-control" id="accionTomada" name="accionTomada" rows="2" required></textarea>
                                        @error('accionTomada')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    </div>
                                </div>

                                <!-- Botones -->
                                <div class="d-flex justify-content-center gap-2">
                                    <button type="submit" class="btn btn-principal p-3">GUARDAR</button>
                                    <button type="button" class="btn btn-principal p-3">AGREGAR MEDICAMENTO</button>
                                    <button type="button" class="btn btn-principal p-3">SALIDA PACIENTE</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
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
