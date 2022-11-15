
@extends('template.base')
@section('content')
    @include('partials.navegador')
    @include('partials.perfil')
    @include('partials.window-cart')
    <div id="work-panel-shop" class="card">
        <div class="card-body" style="display: flex; align-items: center;">
            <div class="row" style="margin:0 auto;">
                <div class="col-md-12">
                    <div class="card mb-3" style="max-width: 800px;max-height: 600px;">
                        <div class="row g-0">
                            <div class="col-md-12">
                                <div class="card-body" style="width:auto;">
                                    <input type="hidden" id="recipeId" name="recipeId" value="{{ $recipe->id }}"/>
                                    <div class="wrapper-2">
                                        <div>
                                            <h5 class="card-title">{{ $recipe->name }}</h5>
                                            <p class="card-text"><b>Categoría: </b><small class="text-muted">{{ $recipe->category()->first()->name }}</small></p>
                                            <p class="card-text"><b>Precio Máximo: </b><small class="text-muted">{{ $recipe->maxPrice() }} $</small></p>
                                            <p class="card-text"><b>Ingredientes: </b></p>
                                            <div class="wrapper-2">
                                                @foreach ($recipe->ingredientes as $ingrediente)
                                                    <p class="card-text"><small class="text-muted">{{  $ingrediente->name}}</small></p>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div>
                                            <img src="{{ asset($recipe->picture_url) }}" class="img-fluid rounded-start" alt="...">
                                            <button class="btn btn-primary" type="button"  id="btnAddToCarr" name="btnAddToCarr">Agregar al Carrito</button>
                                        </div>
                                    </div>
                                    <p class="card-text"><b>Preparación: </b></p>
                                    <div class="description-item">
                                        <p class="card-text">{{ $recipe->instructions }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection






