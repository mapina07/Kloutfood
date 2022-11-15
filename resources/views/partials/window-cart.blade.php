<div id="backDropShoppingCard">
    <div id="shoppingCard" class="card" style="width: 80%; height:70%;max-height: 600px;">
        <div class="card-body">
            <div class="row">
                <div id="cart-container" class="col-md-8"></div>
                <div class="col-md-4">
                    <div class="card resumen">
                        <div class="card-header">
                            <h5>Resumen de su Compra</h5>
                        </div>
                        <div class="card-body">
                            <div class="wrapper-2">
                                    <p class="card-text"><small id="num-recetas" class="text-muted" style="color:black !important;font-weight: bold;"></small></p>
                                    <p class="card-text"><small id="monto-total" class="text-muted" style="color:black !important;font-weight: bold;"></small></p>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary bg-first" type="button" style="width:100%;border:none;">Ir a Pagar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="cart-footer shopping">
            <a type="button" href="{{ route("store") }}" class="btn btn-primary btn-cart" >Ver más Recetas</a>
            <a type="button"  id="btn-close-cart" class="btn btn-primary btn-cart">Cerrar</a>
        </div>
    </div>
</div>

