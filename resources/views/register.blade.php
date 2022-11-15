@extends('template.base')
@section('content')
<section class="vh-100 login">
    @if($errors->any())
        @foreach($errors->all() as $error)
            <script>
                toastr.error('{{$error}}');
            </script>
        @endforeach
    @endif
    @if(Session::has('tipo_msg') && Session::has('msg'))
        @if(Session::get('tipo_msg') == 'ok')
            <script>
                toastr.success('{{Session::get('msg')}}');
            </script>
        @endif
        @if(Session::get('tipo_msg') == 'error')
            <script>
                toastr.error('{{Session::get('msg')}}');
            </script>
        @endif
    @endif
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="{{ asset("/img/draw.webp") }}"
          class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1 login-panel">
        <form action="{{ route('userCreate') }}"  accept-charset="UTF-8" method="POST">
            {{ csrf_field() }}
            <div><h6 class="fw-normal text-lg font-black mb-3 me-3 login-title">Kloutfood</h6></div>
            <!-- 2 column grid layout with text inputs for the first and last names -->
            <div class="row">
                <div class="col-md-6 mb-4">
                <div class="form-outline">
                    <label class="form-label" for="userName">Nombre</label>
                    <input type="text" id="userName" name="userName" value="{{ old('userName') }}" class="form-control" />
                </div>
                </div>
                <div class="col-md-6 mb-4">
                <div class="form-outline">
                    <label class="form-label" for="userLastname">Apellidos</label>
                    <input type="text" id="userLastname" name="userLastname" value="{{ old('userLastname') }}" class="form-control" />
                </div>
                </div>
            </div>
            <!-- Rol select -->
            <div class="form-outline mb-4">
                <label for="rol" class="form-label">Rol</label>
                <select class="form-select" id="userRol" name="userRol" aria-label="Seleccione">
                    <option value=2>consumidor</option>
                    <option value=1>Administrador</option>
                </select>
            </div>
            <!-- Email input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="userEmail">Correo</label>
                <input type="email" id="userEmail" name="userEmail" value="{{ old('userEmail') }}" class="form-control" />
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="usaerPasss">Contraseña</label>
                <input type="password" id="userPass" name="userPass" value="{{ old('userPass') }}" class="form-control" />
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block mb-4 w-100 bg-first" style="border:none;">
                Registrar
            </button>
            <p class="small fw-bold mt-2 pt-1 mb-0">Si ya tiene cuenta? <a href="{{ route('userLogin') }}" class="link-danger">Autentiquese</a></p>
            {{-- <div class="text-center text-lg-start mt-4 pt-2">

            </div> --}}
        </form>
      </div>
    </div>
  </div>
</section>
@endsection
