@extends('layouts.plantilla')

@section('content')
    <div class="container mt-3">
        <div class="accordion" id="accordionPanelsStayOpenExample">
            <form action="/registrarSeguimiento" method="POST" class="mt-3 container">
                @csrf
                <div class="accordion-item">
                    <h2 class="accordion-header " id="panelsStayOpen-headingOne">
                        <button class="accordion-button btn-secundario" type="button" data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                            aria-controls="panelsStayOpen-collapseOne">
                            Información Personal
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
                        aria-labelledby="panelsStayOpen-headingOne">
                        <div class="card">
                            <div class="card-body">
                                <!-- Nombre completo -->
                                <div class="form-group">
                                    <label for="nombre">Nombre completo:</label>
                                    <input type="text" name="nombre" id="nombre" class="form-control" required>
                                    @error('nombre')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row p-2">
                                    <div class="col-12 col-md-8">
                                        <div class="row justify-content-md-center">
                                            <div class="col-12 col-md-3">
                                                <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                                            </div>
                                            <div class="d-flex">
                                                <select name="fecha_nac_dia" id="fecha_nac_dia" class="form-control col-2"
                                                    style="width: 25%;">
                                                    @for ($i = 1; $i <= 31; $i++)
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                                </select>
                                                @error('fecha_nac_dia')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                <select name="fecha_nac_mes" id="fecha_nac_mes" class="form-control mx-2"
                                                    style="width: 40%;">
                                                    @foreach (['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'] as $index => $mes)
                                                        <option value="{{ $index + 1 }}">{{ $mes }}</option>
                                                    @endforeach
                                                </select>
                                                @error('fecha_nac_mes')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                <select name="fecha_nac_año" id="fecha_nac_año" class="form-control"
                                                    style="width: 35%;" onchange="calculaEdad()">
                                                    @for ($i = date('Y'); $i >= 1900; $i--)
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                                </select>
                                                @error('fecha_nac_año')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="row">
                                            <div class="col-3 mt-1">
                                                <label for="edad">Edad:</label>
                                            </div>
                                            <div class="col-9 mt-1">
                                                <input type="text" id="edad" name="edad" class="form-control"
                                                    readonly>
                                                @error('edad')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row m-1">
                                    <div class="col-12 col-md-6">
                                        <!-- Género -->
                                        <div class="row">
                                            <div class="col">
                                                <label>Género:</label>
                                            </div>
                                            <div class="col">
                                                <input type="radio" name="genero" value="Hombre" id="hombre">
                                                <label for="hombre">Hombre</label>
                                                <input type="radio" name="genero" value="Mujer" id="mujer"
                                                    class="ml-2">
                                                <label for="mujer">Mujer</label>
                                                @error('genero')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 mt-1">
                                        <div class="row">
                                            <div class="col">
                                                <label for="enfermedades_cronicas">Enfermedades crónicas:</label>
                                            </div>
                                            <div class="col">
                                                <select name="enfermedades_cronicas" id="enfermedades_cronicas"
                                                    class="form-control" name="enfermedades">
                                                    <option value="1">Diabetes</option>
                                                    <option value="2">Hipertensión</option>
                                                    <option value="3">Asma</option>
                                                    <option value="4">Otra</option>
                                                </select>
                                                @error('enfermedades_cronicas')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-1">
                                    <div class="col-12 col-md-6">
                                        <div class="row mt-1">
                                            <div class="col mt-1">
                                                <label for="telefono">Número telefónico:</label>
                                            </div>
                                            <div class="col mt-1">
                                                <input type="text" name="telefono" id="telefono" class="form-control"
                                                    required>
                                                @error('telefono')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="row mt-1">
                                            <div class="col mt-1">
                                                <label for="alergias">Alergias:</label>
                                            </div>
                                            <div class="col mt-1">
                                                <textarea name="alergias" id="alergias" class="form-control"></textarea>
                                                @error('alergias')
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
                        <button class="accordion-button collapsed btn-secundario" type="button"
                            data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                            aria-controls="panelsStayOpen-collapseTwo">
                            Ingresos
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse"
                        aria-labelledby="panelsStayOpen-headingTwo">
                        <div class="card">
                            <div class="card-body">
                                <!-- Fecha de Ingreso -->
                                <div class="form-group">
                                    <label for="fecha_ingreso">Fecha de Ingreso:</label>
                                    <div class="d-flex">
                                        <select name="dia" id="dia" class="form-control" style="width: 25%;">
                                            @for ($i = 1; $i <= 31; $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                        @error('dia')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <select name="mes" id="mes" class="form-control mx-2"
                                            style="width: 40%;">
                                            @foreach (['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'] as $index => $mes)
                                                <option value="{{ $index + 1 }}">{{ $mes }}</option>
                                            @endforeach
                                        </select>
                                        @error('mes')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <select name="anio" id="anio" class="form-control" style="width: 35%;">
                                            @for ($i = date('Y'); $i >= 1900; $i--)
                                                <option value="{{ $i }}">{{ $i }}</option>
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
                                        value="{{ date('H:i') }}">
                                    @error('hora_ingreso')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Diagnóstico de Ingreso -->
                                <div class="form-group">
                                    <label for="diagnostico_ingreso">Diagnóstico de Ingreso:</label>
                                    <textarea name="diagnostico_ingreso" id="diagnostico_ingreso" class="form-control" rows="3"></textarea>
                                    @error('diagnostico_ingreso')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Servicio -->
                                <div class="form-group">
                                    <label for="servicio">Servicio:</label>
                                    <select name="servicio" id="servicio" class="form-control">
                                        <option value="1">Hospitalización</option>
                                        <option value="2">Urgencia</option>
                                        <option value="3">Quirofano</option>
                                    </select>
                                    @error('servicio')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Cama -->
                                <div class="form-group">
                                    <label for="cama">Cama:</label>
                                    <select name="cama" id="cama" class="form-control">
                                        <option value="1">Cama 1</option>
                                        <option value="2">Cama 2</option>
                                        <option value="3">Cama 3</option>
                                        <option value="4">Cama 4</option>
                                    </select>
                                    @error('cama')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                        <button class="accordion-button collapsed btn-secundario" type="button"
                            data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree"
                            aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                            Signos Vitales
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse"
                        aria-labelledby="panelsStayOpen-headingThree">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <!-- Frecuencia Cardíaca -->
                                    <div class="col-md-6 form-group">
                                        <label for="frecuencia_cardiaca">Frecuencia Cardíaca:</label>
                                        <input type="number" name="frecuencia_cardiaca" id="frecuencia_cardiaca"
                                            class="form-control" placeholder="Latidos por minuto">
                                        @error('frecuencia_cardiaca')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Tensión Arterial -->
                                    <div class="col-md-6 form-group">
                                        <label for="tension_arterial">Tensión Arterial:</label>
                                        <input type="text" name="tension_arterial" id="tension_arterial"
                                            class="form-control" placeholder="Ejemplo: 120/80">
                                        @error('tension_arterial')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Pulso -->
                                    <div class="col-md-6 form-group">
                                        <label for="pulso">Pulso:</label>
                                        <input type="number" name="pulso" id="pulso" class="form-control"
                                            placeholder="Pulsaciones por minuto">
                                        @error('pulso')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Temperatura -->
                                    <div class="col-md-6 form-group">
                                        <label for="temperatura">Temperatura:</label>
                                        <input type="number" name="temperatura" id="temperatura" class="form-control"
                                            placeholder="En grados Celsius">
                                        @error('temperatura')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Frecuencia Respiratoria -->
                                    <div class="col-md-6 form-group">
                                        <label for="frecuencia_respiratoria">Frecuencia Respiratoria:</label>
                                        <input type="number" name="frecuencia_respiratoria" id="frecuencia_respiratoria"
                                            class="form-control" placeholder="Respiraciones por minuto">
                                        @error('frecuencia_respiratoria')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Oxigenación -->
                                    <div class="col-md-6 form-group">
                                        <label for="oxigenacion">Oxigenación:</label>
                                        <input type="number" name="oxigenacion" id="oxigenacion" class="form-control"
                                            placeholder="Porcentaje de oxígeno">
                                        @error('oxigenacion')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Peso -->
                                    <div class="col-md-6 form-group">
                                        <label for="peso">Peso:</label>
                                        <input type="number" name="peso" id="peso" class="form-control"
                                            placeholder="En kilogramos">
                                        @error('peso')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Talla -->
                                    <div class="col-md-6 form-group">
                                        <label for="talla">Talla:</label>
                                        <input type="number" name="talla" id="talla" class="form-control"
                                            placeholder="En centímetros">
                                        @error('talla')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-end mt-3">
                    <div class="col-2">
                        <button type="submit" class="btn btn-principal" style="font-style: oblique;">Siguiente</button>
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
