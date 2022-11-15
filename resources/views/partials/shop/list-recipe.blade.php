<div class="row">
    @if($recipes->isEmpty())
        <div id="empty-list-panel" class="card">
            <div class="card-body">
                <span>No existen datos para mostrar.</span>
            </div>
        </div>
    @endif
    <div class="col">
        <?php
            $i = 0;
        ?>
        @foreach ($recipes as $recipe)
            @if($i%4==0)
                <div class="row">
            @endif
                    <div class="col-md-3">
                        @include('partials.shop.card-item-recipe')
                    </div>
            @if($i==4)
                </div>
            @endif
            @php
                $i++;
            @endphp
        @endforeach
    </div>
</div>
