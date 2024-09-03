@extends("manage.menu")

@section('content')
{{--  <script>
    window.livewire.on('addType' => {
        $('#add').modal('hide');
    })
</script>  --}}

@livewire('create-university-type')
@livewire('university-type')

@endsection
