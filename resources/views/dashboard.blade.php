@extends('layouts.app')
@section('content')
<livewire:dashboardtable />
@stop
@push('scripts')
<script>
var rcData  = Array();

for (x = 0; x < 5; x++) {
    rcData[x]  = document.getElementsByClassName("rcData")[x].innerHTML;
}

const bgColor = [
    '#19875499',
    '#dc354599',
    '#ffc10799',
    '#0dcaf099',
    '#6c757d99',
];
const labels = [
    'Valid',
    'Pending',
    'Ongoing',
    'Waiting',
    'Deactive',
];

const data = {
    labels: labels,
    datasets: [{
        backgroundColor: bgColor,
        borderColor: bgColor,
        data: rcData,
    }]
};

const config = {
    type: 'bar',
    data: data,
    options: {
    maintainAspectRatio: false,
    plugins: {
      legend: {
          display: false,
      }
    }
    }
};
const myChart = new Chart(
    document.getElementById('myChart'),
    config
);
</script>
@endpush