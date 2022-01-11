@extends('layouts.app')
@section('content')
<livewire:add-document/>
@stop
@push('scripts')
<script>
    $(function () {
    $('#docat').on('change', function () {
        axios.post('{{ route('subcatdrop') }}', {cat: $(this).val()})
            .then(function (response) {
                $('#forsubcat').empty();
                $('#forsubcat').append("<option>Select Sub-Category</option>")
                $.each(response.data, function (id, desc) {
                $('#forsubcat').append(new Option(id, desc))
                })
            });
    });
});
</script>
@endpush