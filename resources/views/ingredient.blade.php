@extends('template.body')
@section('content-body')
    <div class="row">
        <div class="col-sm-6">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Ingredientes</li>
                </ol>
            </nav>
        </div>
    </div>
    @include('partials.ingredient.ingredient-tool-panel')
    @include('partials.ingredient.ingredient-list-panel')
    @include('partials.ingredient.window-create-ingredient')
@endsection
