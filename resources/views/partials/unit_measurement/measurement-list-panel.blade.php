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
@if($measurements->isEmpty())
    <div id="empty-list-panel" class="card">
        <div class="card-body">
            <span>No existen datos para mostrar.</span>
        </div>
    </div>
@endif

<div class="row g-3">
    @foreach($measurements as $measurement)
        @include('partials.unit_measurement.window-confirm-measurement',array("measurement"=>$measurement))
        <div class="col-sm-3">
            <div id="items-list-panel" class="card">
                <div class="card-header">
                    <div>{{$measurement->name}}</div>
                    <a type="button" data-bs-toggle="modal" data-bs-target="#measurementConfirmModal{{ $measurement->id }}">
                        <svg class="card-opcion" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                        </svg>
                    </a>
                </div>
                <div class="card-body">
                    <p><b>Descripción: </b>{{$measurement->description}}</p>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="nav_page">
    {{$measurements->links()}}
</div>
