@extends('template.body')
@section('content-body')
    <div class="row">
        <div class="col-sm-6">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Categorias</li>
                </ol>
            </nav>
        </div>
    </div>
    @include('partials.category.category-tool-panel')
    @include('partials.category.category-list-panel')
    @include('partials.category.window-create-category')
@endsection
