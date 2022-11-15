<a href="/store/{{ $recipe->id }}"><div class="card" style="width: 90%">
    <img src="{{ asset($recipe->picture_url) }}" class="card-img-top" style="height:10rem" alt="{{ $recipe->name }}"/>
    <div class="card-body" style="height:8rem">
      <h5 class="card-title item">{{ $recipe->name }}</h5>
      <h6 class="card-title item"><b>Categoria: </b>{{ $recipe->category()->first()->name }}</h6>
      {{-- <div class="description-item">
        <p class="card-text">{{ $recipe->instructions }}</p>
      </div> --}}
    </div>
    {{-- <h6 class="card-title"><b>Ingredientes: </b></h6> --}}
        {{-- <?php
            $i = 0;
        ?>
        @foreach ($recipe->ingredientes() as $ingrediente)
            @if($i%2==0)
                <div class="row">
            @endif
                    <div class="col-md-3">
                      {{  $ingrediente->name}}
                    </div>
            @if($i==2)
                </div>
            @endif
            @php
                $i++;
            @endphp
        @endforeach --}}
    {{-- <div class="card-footer">
        <a href="#" class="btn btn-primary">Go somewhere</a>
    </div> --}}
  </div>
</a>
