<div class="modal fade" id="createIngredientModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ingredientModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ingredientModalLabel">Nuevo Ingrediente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('ingredientStore') }}" enctype="multipart/form-data" accept-charset="UTF-8" method="POST" class="needs-validation" novalidate>
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col">
                            <label for="ingredientName" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="ingredientName" id="ingredientName" required>
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
                            <label for="ingredientDescription" class="form-label">Descripcion</label>
                            <input type="text" class="form-control" name="ingredientDescription" id="ingredientDescription" required>
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
                            <label for="ingredientUm" class="form-label">Unidad de Medida</label>
                            <select class="form-select" id="ingredientUm" name="ingredientUm" aria-label="Selecciona una Unidad de Medida">
                                <option selected>Selecciona una Unidad de Medida</option>
                                @foreach($measurements as $measurement)
                                    <option value={{$measurement->id}}>{{$measurement->description}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="ingredientMinQuantity" class="form-label">Cantidad Mínima</label>
                            <input type="number" class="form-control" name="ingredientMinQuantity" id="ingredientMinQuantity" min="1" required>
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
                            <label for="ingredientPrice" class="form-label">Precio</label>
                            <input type="number" class="form-control" name="ingredientPrice" id="ingredientPrice" min="1" required>
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
                            <div class="input-group mb-3">
                                 <input type="file" class="form-control pictureLoad" id="ingredientPicture" name="ingredientPicture">
                            </div>
                        </div>
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
