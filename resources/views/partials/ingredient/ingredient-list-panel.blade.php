@if($errors->any())

    @foreach($errors->all() as $error)
        <script>
            toastr.error('{{$error}}');
        </script>
    @endforeach
@endif
@if(Session::has('tipo_msg') && Session::has('msg'))
    @if(Session::get('tipo_msg') == 'ok')
        <script>
            toastr.success('{{Session::get('msg')}}');
        </script>
    @endif
    @if(Session::get('tipo_msg') == 'error')
        <script>
            toastr.error('{{Session::get('msg')}}');
        </script>
    @endif
@endif
@if($ingredients->isEmpty())
    <div id="empty-list-panel" class="card">
        <div class="card-body">
            <span>No existen datos para mostrar.</span>
        </div>
    </div>
@endif

<div class="row g-3">
    @foreach($ingredients as $ingredient)
        @include('partials.ingredient.window-confirm-ingredient',array("ingredient"=>$ingredient))
        <div class="col-sm-3">
            <div id="items-list-panel" class="card" style="width:200px;">
                @if($ingredient->picture_url == "img/ingredientDefault.png")
                    <img src="{{ asset('img/ingredientDefault.png') }}" class="card-img-top" style="width:auto;height: 100px;" alt="...">
                @else
                    <img src="{{ asset($ingredient->picture_url) }}" class="card-img-top" style="width:auto;height: 100px;" alt="...">
                @endif
                <div class="card-header">
                  <div>{{$ingredient->name}}</div>
                  <div>
                    {{-- <a type="button">
                        <svg class="card-opcion" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                        </svg>
                    </a> --}}
                    <a type="button" data-bs-toggle="modal" data-bs-target="#ingredientConfirmModal{{ $ingredient->id }}">
                        <svg class="card-opcion" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                        </svg>
                    </a>
                  </div>
                 </div>
                <ul class="list-group list-group-flush">
                <li class="list-group-item card-list"><b>Descripción: </b>{{$ingredient->description}}</li>
                  <li class="list-group-item card-list"><b>Unidad Medida: </b>{{$ingredient->um()->first()->name}}</li>
                  <li class="list-group-item card-list"><b>Cantidad Mínima: </b>{{$ingredient->min_quantity}}</li>
                  <li class="list-group-item card-list"><b>Precio: </b>{{$ingredient->price}} $</li>
                </ul>
              </div>
        </div>
    @endforeach
</div>







<div class="nav_page">
    {{$ingredients->links()}}
</div>
