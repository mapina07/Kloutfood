<div id="perfilCard" class="card" style="width: 12rem;">
    <img id="imgPerfil" src="{{ asset('img/perfilDefault.png') }}" class="card-img-top" alt="...">
    <div class="card-body">
        <div class="name-perfil">
        <?php
            if(Session::has('LoginUser')){
                $user = Session::get('LoginUser');
        ?>
                <h6>{{ $user->name." ".$user->lastname }}</h6>
        <?php
            }else{
        ?>
                <h6>Jhon Doe</h6>
        <?php
            }
        ?>
        </div>
        <div class="menu-perfil">
            <a href="{{ route('userLogout') }}" class="salir" type="button">Salir</a>
        </div>

    </div>
</div>
