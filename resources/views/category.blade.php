@extends('layouts.app')
@section('content')
<livewire:category/>
@stop
@push('scripts')
<script>
    $(function () {
    $('#locmaster').on('change', function () {
        axios.post('{{ route('catdrop') }}', {loc: $(this).val()})
            .then(function (response) {
                $('#fordev').empty();
                $('#fordev').append("<option>Select Category</option>")
                $.each(response.data, function (id, desc) {
                $('#fordev').append(new Option(id, desc))
                })
            });
    });
});
</script>
@endpush
