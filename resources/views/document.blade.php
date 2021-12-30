@extends('layouts.app')
@section('content')
<livewire:document :pass="$condition"/>
@stop
@push('scripts')
@endpush