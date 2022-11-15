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
        <form   action="{{ route('userAuthenticate') }}"  accept-charset="UTF-8" method="POST">
            {{ csrf_field() }}
          <div><h6 class="fw-normal text-lg font-black mb-3 me-3 login-title">Kloutfood</h6></div>
          <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
            <p class="lead fw-normal mb-0 me-3">Sign</p>
            <button type="button" class="btn btn-primary btn-floating mx-1 w-2 bg-first" style="border:none;">
              <i class="fab fa-facebook-f"></i>
            </button>

            <button type="button" class="btn btn-primary btn-floating mx-1 bg-first" style="border:none;">
              <i class="fab fa-twitter"></i>
            </button>

            <button type="button" class="btn btn-primary btn-floating mx-1 bg-first" style="border:none;">
              <i class="fab fa-linkedin-in"></i>
            </button>
          </div>

          <div class="divider d-flex align-items-center my-4">
            <p class="text-center fw-bold mx-3 mb-0"></p>
          </div>

          <!-- Email input -->
          <div class="form-outline mb-4">
            <label class="form-label" for="user">Usuario</label>
            <input type="email" id="user" name="user" value="{{ old('user') }}" class="form-control form-control-lg"  style="width:300px;"
              placeholder="Entre una dirección de correo." />
          </div>

          <!-- Password input -->
          <div class="form-outline mb-3">
            <label class="form-label" for="password">Contraseña</label>
            <input type="password" id="password" name="password" value="{{ old('password') }}" class="form-control form-control-lg" style="width:300px;"
              placeholder="Entre una contraseña" />
          </div>

          <div class="text-center text-lg-start mt-4 pt-2">
            <button type="submit" class="btn btn-primary btn-lg bg-first"
              style="padding-left: 2.5rem; padding-right: 2.5rem;border:none;">Entrar</button>
            <p class="small fw-bold mt-2 pt-1 mb-0">No tiene cuenta? <a href="{{ route('userRegister') }}" class="link-danger">Regístrese</a></p>
          </div>
        </form>
      </div>
    </div>
  </div>
  {{-- <div
    class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-first">
    <!-- Copyright -->
    <div class="text-white mb-3 mb-md-0">
        Kloutfood Copyright © 2020. All rights reserved.
    </div>
    <!-- Copyright -->
  </div> --}}
</section>
@endsection

