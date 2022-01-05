@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap5.min.css') }}">
@section('content')
<div>
    <div class="row mt-4 me-4">
        <div class="col-12">
            <table id="myTable" class="display table border table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>User</th>
                        <th>IP</th>
                        <th>Last Login</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($logs) == 0)
                    <tr>
                        <td class="text-center" colspan="6">No data yet.</td>
                    </tr>
                    @else 
                    @foreach ($logs as $index => $log)
                    <tr>
                        <td>{{$index + 1}}</td>
                        <td>{{$log->name}}</td>
                        <td>{{$log->ip_address}}</td>
                        <td>{{date('Y/m/d - H:i:s', $log->last_activity)}}</td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop
@push('scripts')
<script src="{{ asset('/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/js/dataTables.bootstrap5.min.js') }}"></script>
<script>
$(document).ready(function() {
    $('#myTable').DataTable();
});
</script>
@endpush