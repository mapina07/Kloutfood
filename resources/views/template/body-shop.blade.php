@extends('template.base')
@section('content')
    @include('partials.navegador')
    <div id="work-panel" class="card">
        <div class="card-body">
            @yield('content-body')
        </div>
    </div>
@endsection
