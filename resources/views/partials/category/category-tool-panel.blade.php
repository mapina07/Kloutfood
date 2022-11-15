<div class="row rowToolsBar">
    <div class="col">
        <div id="basic-tool-panel" class="card">
            <div class="card-body">
                <a type="button" data-bs-toggle="modal" data-bs-target="#createCategoryModal">
                    <svg class="btn-add" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square-fill" viewBox="0 0 16 16">
                        <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0z"/>
                    </svg>
                </a>
                <form class="form-inline ml-3" method="GET" role="search" action="{{ route('categorySearch') }}">
                    {!! csrf_field() !!}
                    <div class="input-group">
                        <div class="input-group-text">
                            <svg class="btn-search" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                            </svg>
                        </div>
                        @if(isset($criterio))
                            <input type="text" id="inputCategorySearch" name="searchCategory" value="{{ $criterio }}" class="form-control" placeholder="Nombre categoría..." aria-label="Buscar...">
                        @else
                            <input type="text" id="inputCategorySearch" name="searchCategory" class="form-control" placeholder="Nombre categoría..." aria-label="Buscar...">
                        @endif
                            <button type="submit" id="btnCategorySearch" class="input-group-text btnSearch">
                            Buscar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
