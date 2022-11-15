<div class="modal fade" id="measurementConfirmModal{{ $measurement->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="measurementConfirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="width: auto !important;">
            <div class="modal-header" style="padding: 10px !important;">
                <h5 class="modal-title" id="measurementConfirmDeleteLabel">Confirmación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Está seguro que desea eliminar la unidad de medida ?
                <div style="display:flex;justify-content:center;">
                    <button type="button" class="btn btn-theme" style="margin:0px 15px" data-bs-dismiss="modal">No</button>
                    <a type="button" class="btn btn-theme" href="{{ route('measurementDelete',array('id'=>$measurement->id)) }}">Si</a>
                </div>
            </div>
        </div>
    </div>
</div>
