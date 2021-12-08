<!-- <script src="{{ mix('js/app.js') }}"></script> -->
<script src="{{ asset('/js/jquery.min.js') }}"></script>
<script src="{{ asset('/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('/vendors/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('/js/fontawesome.min.js') }}"></script>
@livewireScripts
<script src="{{ asset('/js/main.js') }}"></script>
{{ $script ?? ''}}
<script>
    $(document).ready(function() {
    $('#example').DataTable();
} );
</script>