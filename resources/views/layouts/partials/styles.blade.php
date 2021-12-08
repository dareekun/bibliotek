<!-- Vendors -->
<link rel="stylesheet" href="{{ asset('/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">

<!-- Styles -->
<link rel="stylesheet" href="{{ mix('css/bootstrap.css') }}">
<link rel="stylesheet" href="{{ mix('css/app.css') }}">
<link rel="stylesheet" href="{{ asset('css/all.css') }}">
<link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap5.min.css') }}">
@livewireStyles

{{ $style ?? '' }}