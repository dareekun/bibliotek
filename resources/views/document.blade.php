@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap5.min.css') }}">
@section('content')
<livewire:document :condition="$value"/>
@stop
@push('scripts')
<script src="{{ asset('/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/js/dataTables.bootstrap5.min.js') }}"></script>
<script>
$(document).ready(function() {
    $('#example').DataTable();
});
</script>
@endpush