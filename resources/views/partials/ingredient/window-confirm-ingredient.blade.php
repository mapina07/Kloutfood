<div class="modal fade" id="ingredientConfirmModal{{ $ingredient->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ingredientConfirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="width: auto !important;">
            <div class="modal-header" style="padding: 10px !important;">
                <h5 class="modal-title" id="ingredientConfirmDeleteLabel">Confirmación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Está seguro que desea eliminar el ingrediente ?
                <div style="display:flex;justify-content:center;">
                    <button type="button" class="btn btn-theme" style="margin:0px 15px" data-bs-dismiss="modal">No</button>
                    <a type="button" class="btn btn-theme" href="{{ route('ingredientDelete',array('id'=>$ingredient->id)) }}">Si</a>
                </div>
            </div>
        </div>
    </div>
</div>
