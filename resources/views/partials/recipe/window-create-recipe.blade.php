<div class="modal fade" id="createRecipeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="recipeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="recipeModalLabel">Nueva Receta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('recipeStore') }}" enctype="multipart/form-data" accept-charset="UTF-8" method="POST" class="needs-validation" novalidate>
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col">
                            <label for="recipeName" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="recipeName" id="recipeName" required>
                            <div class="valid-feedback">
                              Correcto!
                            </div>
                            <div class="invalid-feedback">
                                Valor incorrecto!
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="recipeCategory" class="form-label">Categoria</label>
                            <select class="form-select" id="recipeCategory" name="recipeCategory" aria-label="Selecciona una Categoria">
                                <option selected>Seleccione</option>
                                @foreach($categorys as $category)
                                    <option value={{$category->id}}>{{$category->description}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="recipeInstruction" class="form-label">Instrucciones</label>
                            <textarea class="form-control" id="recipeInstruction" name="recipeInstruction" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="input-group mb-3">
                                 <input type="file" class="form-control pictureLoad" id="recipePicture" name="recipePicture">
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header ingredient">
                            <div>Agregar Ingrediente</div>
                            <div>
                                <a type="button" id="btn-add-ingredient">
                                    <svg class="card-opcion" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square-fill" viewBox="0 0 16 16">
                                        <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <div class="card-body" id="listIngredients"></div>
                    </div>
                    <hr class="divider">
                    <div class="row">
                        <div class="col">
                            <div class="form-footer">
                                <button type="button" class="btn btn-theme" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-theme">Salvar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- <?php
dd($ingredients);
?> --}}
