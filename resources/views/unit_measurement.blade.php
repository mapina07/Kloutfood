@extends('template.body')
@section('content-body')
    <div class="row">
        <div class="col-sm-6">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Unidades de Medida</li>
                </ol>
            </nav>
        </div>
    </div>
    @include('partials.unit_measurement.measurement-tool-panel',['criterio'=>$criterio])
    @include('partials.unit_measurement.measurement-list-panel')
    @include('partials.unit_measurement.window-create-measurement')
@endsection
