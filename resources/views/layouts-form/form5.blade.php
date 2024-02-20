@extends('layouts.landingsinslider')
@section('title', 'Historial Académico')
@section('content')

<div class="section margin-top_50">
    <div class="container mb-4 bg-cremita pt-3 rounded">
      <div class="container">
        <h2 class="text-center fw-bold">HISTORIAL ACADEMICO</h2>
        <form id="miFormulario">
            @csrf <!-- Directiva de Blade para protección CSRF -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nivel">Nivel:</label>
                        <select class="form-control" id="nivel" name="nivel">
                            <option value="0">Seleccione:</option>
                            <option value="inicial">Inicial</option>
                            <option value="primaria">Primaria</option>
                            <option value="secundaria">Secundaria</option>
                            <option value="bachillerato">Bachillerato</option>
                            <option value="licenciatura">Licenciatura</option>
                            <option value="posgrado">Posgrado</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="escuela">Nombre de la Escuela:</label>
                        <input type="text" class="form-control" id="escuela" name="escuela" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tipo">Tipo:</label>
                        <select class="form-control" id="tipo" name="tipo">
                            <option value="0">Seleccione:</option>
                            <option value="publico">Público</option>
                            <option value="privado">Privado</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="promedio">Promedio:</label>
                        <input type="number" class="form-control" id="promedio" name="promedio" oninput="this.value = this.value.replace(/[^0-9]/g, '').substring(0, 3)">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="estado_nac">Estado donde nació:</label>
                        <select class="form-control" id="estado" name="estado">
                            <option value="">Selecciona un estado</option>
                            @foreach($estados as $IdEstado => $NombreEstado)
                                <option value="{{ $IdEstado }}" {{ ($consultaEstado == $NombreEstado) ? 'selected' : '' }}>
                                    {{ $NombreEstado }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="municipio_nac">Municipio donde nació:</label>
                        <select class="form-control" id="municipio" name="municipio">
                            <option value="">Selecciona un municipio</option>
                            <option value="" selected>{{ $consultaMunicipio }}</option>
                        </select>
                        @error('municipio')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <script>
                            cargarMunicipios('estado', 'municipio');
                        </script>
                    </div>
                </div>
            </div>
            <div class="text-end">
              <button type="submit" class="btn btn-primary">Agregar Registro</button>
            </div>
        </form>
        <hr>
        <table class="table">
            <thead>
                <tr>
                    <th>Nivel</th>
                    <th>Escuela</th>
                    <th>Tipo</th>
                    <th>Promedio</th>
                    <th>Municipio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="tablaRegistros">
                @isset($registros)
                @foreach($registros as $registro)
                <tr id="tr_{{$registro->idtd}}">          
                    <td>{{ $registro->nivel }}</td>
                    <td>{{ $registro->escuela }}</td>
                    <td>{{ $registro->tipo }}</td>
                    <td>{{ $registro->promedio }}</td>
                    <td>{{ $registro->Municipio->NombreMunicipio }}</td>
                    <td>
                        <a href="{{ url('delete/'.$registro->idtd) }}" class="btn btn-danger btn-form">Eliminar</button>
                    </td>
                </tr>
                @endforeach
                @endisset
            </tbody>
        </table>
    </div>
    

    </div>
</div>

 <div class="row mt-4 pl-5 pr-5">
  <div class="col-md-6 text-left mb-3"> <!-- Botón izquierdo -->
    <button type="button" class="boton btn-lg btn-form" onclick="window.location.href='{{ route('form4-formulario') }}'">Regresar</button>
  </div>
  <div class="col-md-6 text-right mb-3"> <!-- Botón derecho -->
    <button type="button" class="boton btn-lg btn-form" onclick="window.location.href='{{ route('form6') }}'">Siguiente</button>
  </div>
</div>  

@endsection