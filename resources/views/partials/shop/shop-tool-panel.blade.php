<div class="row rowToolsBar">
    <div class="col">
        <div id="basic-tool-panel-shop" class="card">
            <div class="card-body">
                <form id="formShopSearch" class="form form-search" method="POST" role="search" action="{{ route('storeSearch') }}">
                    {!! csrf_field() !!}
                    <div class="search-panel">
                        <div class="input-group input-group-search">
                            <div class="input-group-text">
                                Categoria
                            </div>
                            <select class="form-select" id="filterCategory" name="filterCategory" aria-label="Selecciona una Categoria">
                                <option selected>Seleccione</option>
                                @foreach($categorys as $category)
                                    @if($category->id == $filter)
                                        <option value={{$category->id}} selected>{{$category->description}}</option>
                                    @else
                                        <option value={{$category->id}}>{{$category->description}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group input-group-search">
                            <div class="input-group-text">
                                <svg class="btn-search" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                </svg>
                            </div>
                            @if(isset($criterio))
                                <input type="text" id="inputRecipeSearch" name="searchRecipe" value="{{ $criterio }}" class="form-control" placeholder="Nombre receta..." aria-label="Buscar...">
                            @else
                                <input type="text" id="inputRecipeSearch" name="searchRecipe" class="form-control" placeholder="Nombre receta..." aria-label="Buscar...">
                            @endif
                                <button type="submit" id="btnRecipeSearch" class="input-group-text btnSearch">
                                Buscar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
