@extends('template.body')
@section('content-body')
    <div class="row">
        <div class="col-sm-6">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Recetas</li>
                </ol>
            </nav>
        </div>
    </div>
    @include('partials.recipe.recipe-tool-panel')
    @include('partials.recipe.recipe-list-panel')
    @include('partials.recipe.window-create-recipe')
@endsection



