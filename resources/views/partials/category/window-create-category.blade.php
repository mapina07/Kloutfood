<div class="modal fade" id="createCategoryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="categoryModalLabel">Nueva Categoría</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('categoryStore') }}" enctype="multipart/form-data" accept-charset="UTF-8" method="POST" class="needs-validation" novalidate>
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col">
                            <label for="categoryName" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="categoryName" id="categoryName" required>
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
                            <label for="categoryDescription" class="form-label">Descripcion</label>
                            <input type="text" class="form-control" name="categoryDescription" id="categoryDescription" required>
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
                                 <input type="file" class="form-control pictureLoad" id="categoryPicture" name="categoryPicture">
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
