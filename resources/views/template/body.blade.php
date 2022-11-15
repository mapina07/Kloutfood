@extends('template.base')
@section('content')
    @include('partials.navegador')
    @include('partials.perfil')
    @include('partials.window-cart')
    <div id="work-panel" class="card">
        <div class="card-body">
            @yield('content-body')
        </div>
    </div>
@endsection

