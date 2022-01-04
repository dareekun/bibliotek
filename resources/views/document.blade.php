@extends('layouts.app')
@section('content')
<livewire:document :condition="$value"/>
@stop
@push('scripts')
@endpush