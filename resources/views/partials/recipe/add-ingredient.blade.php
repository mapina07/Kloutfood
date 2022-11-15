@foreach($ingredients as $ingredient)
    <option value={{$ingredient->id}}>{{$ingredient->description}}</option>
@endforeach

