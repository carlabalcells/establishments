@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" 
        integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="" />

    <link
      rel="stylesheet"
      href="https://unpkg.com/esri-leaflet-geocoder/dist/esri-leaflet-geocoder.css"
    />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/6.0.0-beta.2/dropzone.min.css" 
        integrity="sha512-qkeymXyips4Xo5rbFhX+IDuWMDEmSn7Qo7KpPMmZ1BmuIA95IPVYsVZNn8n4NH/N30EY7PUZS3gTeTPoAGo1mA==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />

@endsection

@section('content')

    <div class="container" >
        <h1 class="mt-4 text-center"> Registrar Establecimiento</h1>
        
        <div class="mt-5 row justify-content-center">
            <form class="col-md-9 col-xs-12 card card-body" method="POST" action="{{ route('establecimiento.create')}}">
                @csrf
                <fieldset class="border p-4">
                    <legend class="text-primary" >Nombre, Categoría e Imagen Principal</legend>
                    <div class="form-group">
                        <label for="name" > Nombre Establecimiento </label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                        placeholder="Nombre Establecimiento" name="" value="{{ old('name') }}" >
                        @error('name')
                            <div class="invalid-feedback" > {{ $message }} </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="categoria">Categoria </label>
                       <select class="form-control @error('categoria_id') is-invalid @enderror" name="categoria_id" id="categoria">
                           <option value=" " selected disabled> Seleccione </option>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id}}" {{ old('categoria') == $categoria->id ? 'selected' : '' }}>{{ $categoria->name }}</option>
                            @endforeach
                       </select>
                    </div>

                    <div class="form-group">
                        <label for="image_principal" > Imagen Principal </label>
                        <input id="image_principal" type="file" class="form-control @error('image_principal') is-invalid @enderror" 
                         name="image_principal" value="{{ old('image_principal') }}" >
                        @error('image_principal')
                            <div class="invalid-feedback" > {{ $message }} </div>
                        @enderror
                    </div>
                </fieldset>

                <fieldset class="border p-4 mt-5">
                    <legend class="text-primary " >Ubicación:</legend>
                   
                    <div class="form-group">
                        <label for="formbuscador" > Coloca la dirección del establecimiento </label>
                        <input id="formbuscador" type="text" class="form-control" placeholder="Calle del establecimiento">
                        <p class="text-secondary mt-5 mb-3 text-center">El asistente colocará una dirección estimada o mueve el pin hasta la ubicación correcta </p>
                    </div>

                    <div class="form-group">
                        <div id="mapa" style="height: 400px;"></div>
                    </div>

                    <p class="informacion">Confirma que los siguientes campos son correctos </p>

                    <div class="form-group">
                        <label for="direccion"> Dirección </label>
                        <input type="text" name="direccion" id="direccion" class="form-control" @error('direccion') is-invalid @enderror 
                                placeholder="Direccion" value="{{ old('direccion')}}">
                        @error('direccion')
                            <div class="invalid-feedback" > {{ $message }} </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="city"> City </label>
                        <input type="text" name="city" id="city" class="form-control" @error('city') is-invalid @enderror 
                                placeholder="City" value="{{ old('city')}}">
                        @error('city')
                            <div class="invalid-feedback" > {{ $message }} </div>
                        @enderror
                    </div>

                    <input type="hidden" name="lat" id="lat" value="{{ old('lat')}}">
                    <input type="hidden" name="lng" id="lng" value="{{ old('lng')}}">
                </fieldset>

                <fieldset class="border p-4 mt-5">
                    <legend  class="text-primary">Información Establecimiento: </legend>
                        <div class="form-group">
                            <label for="nombre">Teléfono</label>
                            <input 
                                type="tel" 
                                class="form-control @error('telefono')  is-invalid  @enderror" 
                                id="telefono" 
                                placeholder="Teléfono Establecimiento"
                                name="telefono"
                                value="{{ old('telefono') }}"
                            >
    
                                @error('telefono')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                        </div>
    
                        
    
                        <div class="form-group">
                            <label for="nombre">Descripción</label>
                            <textarea
                                class="form-control  @error('descripcion')  is-invalid  @enderror" 
                                name="descripcion"
                            >{{ old('descripcion') }}</textarea>
    
                                @error('descripcion')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                        </div>
    
                        <div class="form-group">
                            <label for="nombre">Hora Apertura:</label>
                            <input 
                                type="time" 
                                class="form-control @error('apertura')  is-invalid  @enderror" 
                                id="apertura" 
                                name="apertura"
                                value="{{ old('apertura') }}"
                            >
                            @error('apertura')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
    
                        <div class="form-group">
                            <label for="nombre">Hora Cierre:</label>
                            <input 
                                type="time" 
                                class="form-control @error('cierre')  is-invalid  @enderror" 
                                id="cierre" 
                                name="cierre"
                                value="{{ old('cierre') }}"
                            >
                            @error('cierre')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                </fieldset>

                <fieldset class="border p-4 mt-5">
                    <legend  class="text-primary">Información Establecimiento: </legend>
                        <div class="form-group">
                            <label for="imagenes" >Imagenes </label>
                            <div id="dropzone" class="dropzone form-control"></div>
                        </div>
                </fieldset>

                <input type="hidden" id="uuid" name="uuid" value="{{ Str::uuid()->toString() }} ">
                <input type="submit" class="btn btn-primary mt-3 d-block" value="Registrat Establecimiento">



            </form>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" 
            integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" 
            crossorigin="">
    </script>

    <script src="https://unpkg.com/esri-leaflet" defer></script>
    <script src="https://unpkg.com/esri-leaflet-geocoder" defer></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/6.0.0-beta.2/dropzone.min.js" 
        integrity="sha512-Ky7SgifG9Q4ANAFvK3k7zkfdrkbM+jBJyT6kgS2cdl8VbNNo2X+kKmq73xieujm0C6HEaXDA5po3r6lmwe4sMg==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>
@endsection