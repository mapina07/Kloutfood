
require('./bootstrap');

// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
    .forEach(function (form) {
        form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
        }

        form.classList.add('was-validated')
        }, false)
    });

    console.log( "ready!" );




})()

$(document).ready(function() {


    $('#btn-add-ingredient').click(function() {
        console.log('add ingredient to recipe');
        var ingredients = [];

        $.ajax({
            url: '/ingredients',
            method: 'GET'
        }).done(function(data) {
                console.log(data);  // imprimimos la respuesta
                ingredients = data;
        }).fail(function() {
            toastr.error('Error al consultar los ingredientes');
            return;
        }).always(function() {
            console.log(`cantidad ingredientes: `+ingredients.length);

            if(ingredients.length <= 0){
                toastr.error('No existen ingredientes, consulte a un administrador');
            }
            if(ingredients.length>0){
               html = `
                <div class="row ing-item" style="margin-top:2px">
                    <div class="col-md-7">
                        <select class="form-select" id="ingredientesToRecipe" name="ingredientes[]" aria-label="Selecciona una Unidad de Medida">
                            <option selected>Seleccione</option>`;
                            $.map( ingredients, function( ingredient, i ) {
                                html += `<option value=`+ ingredient.id +`>`+ingredient.description+`</option>`;
                            });
                html +=`</select>
                    </div>
                    <div class="col-md-3">
                        <input type="number" class="form-control" name="quantitys[]" id="quantityIngredientRecipe" min="1" required>
                    </div>
                    <div class="col-md-1">
                        <a type="button"  class="btn-delete-ingredient" onClick="(function(){console.log('eliminar div');$('div').remove('.ing-item:last'); })()">
                            <svg class="card-opcion" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                            </svg>
                        </a>
                    </div>
                </div>
                `;

                $('#listIngredients').append(html);
            }
        });
    });






    $('#filterCategory').change(function(){
        console.log('Se selecciono');
        var cat = $(this).val();
        var search = $('#inputRecipeSearch').val();
        $('#formShopSearch').submit();
    });

    $("#btn-perfil-usuario").click(function(){
        if($("#perfilCard").css("visibility") == "hidden"){
            $("#perfilCard").css("visibility","visible");
        }else{
            $("#perfilCard").css("visibility","hidden");
        }
    });

    $("#btn-cart-usuario").click(function(){
        cartList();
    });

    $("#btn-close-cart").click(function(){
        $("#backDropShoppingCard").css("visibility","hidden");
    });




    $("#btnAddToCarr").click(function(){
        var recipe_id = $('#recipeId').val();
        console.log('add to cart '+ recipe_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/cart',
            type: 'POST',
            dataType : 'json',
            data:{
                recipe_id:recipe_id
            },
            success : function(data) {
                if(data.tipo_msg == 'ok'){
                    toastr.success(data.msg);
                    $("#item-count").html(data.cant_pedidos);
                    cartList();
                    console.log('ok');
                }
                if(data.tipo_msg == 'error'){
                    toastr.error(data.msg);
                    console.log('error');
                }
            },
            error : function(jqXHR, status, error) {
                toastr.error(error);
            }
            // complete : function(jqXHR, status) {

            //  }
        });
    });


    function cartList(){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/shopping-cart',
            type: 'POST',
            dataType : 'json',
            success : function(data) {
                if(data.error == false){
                    //Codigo aqui.
                    if(data.carts.length>0){
                        $("#cart-container").empty();
                        $("#num-recetas").html("");
                        $("#monto-total").empty("");
                        var total = 0;
                        for(var i=0;i<data.carts.length;i++){
                            var cart = data.carts[i];
                            total += parseFloat(cart.costo);
                            //console.log('costo: '+cart.costo);
                            var html = `
                            <div id="cart-item" class="card">
                                <div class="card-body" style="padding: 5px;">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div>
                                                <img src="`+cart.picture_url+`"  class="cart-pic" style="width:auto;height: 50px;" alt="...">
                                                <p class="card-title">`+cart.name+`</p>
                                                <p class="card-title">$ `+cart.costo+`</p>
                                            </div>
                                        </div>
                                        <div class="col-md-10 ">
                                            <div class="wrapper-9 title">
                                                <p class="card-text title"><small class="text-muted" style="color:black !important;font-weight: bold;">Nombre </small></p>
                                                <p class="card-text title"><small class="text-muted" style="color:black !important;font-weight: bold;">Precio</small></p>
                                                <p class="card-text title"><small class="text-muted" style="color:black !important;font-weight: bold;">Cant.Min</small></p>
                                                <p class="card-text title"><small class="text-muted" style="color:black !important;font-weight: bold;">Cant.Receta</small></p>
                                                <p class="card-text title"><small class="text-muted" style="color:black !important;font-weight: bold;">Sobrante</small></p>
                                                <p class="card-text title"><small class="text-muted" style="color:black !important;font-weight: bold;">Necesita</small></p>
                                                <p class="card-text title"><small class="text-muted" style="color:black !important;font-weight: bold;">Comprado</small></p>
                                                <p class="card-text title"><small class="text-muted" style="color:black !important;font-weight: bold;">N.Sobrante</small></p>
                                                <p class="card-text title"><small class="text-muted" style="color:black !important;font-weight: bold;">Costo</small></p>
                                            </div>`;
                                            for(var k=0;k<cart.ingredients.length;k++){
                                                var ing = cart.ingredients[k];
                                                var unidad_medida = ing.um;
                                                html += `
                                                <div class="wrapper-9">
                                                    <p class="card-text"><small class="text-muted">`+ing.name+`</small></p>
                                                    <p class="card-text"><small class="text-muted"> $ `+ing.price+`</small></p>
                                                    <p class="card-text"><small class="text-muted">`+ing.min_quantity+' '+unidad_medida+`</small></p>
                                                    <p class="card-text"><small class="text-muted">`+ing.recipe_quantity+' '+unidad_medida+`</small></p>
                                                    <p class="card-text"><small class="text-muted">`+ing.sobrante+' '+unidad_medida+`</small></p>
                                                    <p class="card-text"><small class="text-muted">`+ing.real_compra+' '+unidad_medida+`</small></p>
                                                    <p class="card-text"><small class="text-muted">`+ing.sale+`</small></p>
                                                    <p class="card-text"><small class="text-muted">`+ing.new_sobrante+' '+unidad_medida+`</small></p>
                                                    <p class="card-text"><small class="text-muted">$ `+ing.costo+`</small></p>
                                                 </div>
                                                `;
                                            }

                            html +=    `</div>
                                    </div>
                                </div>
                            </div>
                            `;
                            $("#cart-container").append(html);
                        }
                        $("#num-recetas").append(data.carts.length+' Recetas');
                        $("#monto-total").append('$ '+total);
                    }else{
                        var html = `
                        <div id="empty-list-panel" class="card">
                            <div class="card-body">
                                <span>No existen datos para mostrar.</span>
                            </div>
                        </div>
                        `;
                        $("#cart-container").append(html);
                        $("#num-recetas").append('0 Recetas');
                        $("#monto-total").append('$ 0.00');
                    }

                    if($("#backDropShoppingCard").css("visibility") == "hidden"){
                        $("#backDropShoppingCard").css("visibility","visible");
                    }else{
                        $("#backDropShoppingCard").css("visibility","hidden");
                    }
                    console.log('ok');
                }
                if(data.error == true){
                    toastr.error(data.msg);
                    console.log('error');
                }
            },
            error : function(jqXHR, status, error) {
                toastr.error(error);
            }
            // complete : function(jqXHR, status) {

            // }
        });
    }

});












