<ul class="nav">
    <div class="r-menu">
        <li class="nav-item title">
            <div class="nav-link" href="#"><span>Kloutfood</span></div>
        </li>
        <?php
            if(Session::has('LoginUser')){
                $user = Session::get('LoginUser');
                $rutaName = Route::currentRouteName();
                if($user->rol == 1){
        ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Nomencladores
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{route('categoryList')}}">Categorías</a></li>
                            <li><a class="dropdown-item" href="{{route('measurementList')}}">Unidades de Medida</a></li>
                            <li><a class="dropdown-item" href="{{route('ingredientList')}}">Ingredientes</a></li>
                            <li><a class="dropdown-item" href="{{route('recipeList')}}">Recetas</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('store')}}"  aria-disabled="false">Tienda</a>
                    </li>
        <?php
                }
                if($user->rol == 2 && $rutaName == 'storeDetail'){
        ?>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('store')}}"  aria-disabled="false">Tienda</a>
                    </li>
        <?php
                }
            }
        ?>
    </div>
    <div class="l-menu">
        <li class="nav-item">
            <a id="btn-cart-usuario" type="button" class="nav-link">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
                    <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
                </svg>
                <span id="item-count" class="badge cart-badge">{{ Session::get('cant_pedidos') }}</span>
            </a>
        </li>
        <li  class="nav-item">
            <a id="btn-perfil-usuario" type="button" class="nav-link">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                    <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z"/>
                </svg>
            </a>
        </li>
    </div>
  </ul>
