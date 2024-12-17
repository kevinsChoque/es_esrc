<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EMUSAP</title>
    <!-- icono de la pagina -->
    {{-- <link rel="icon" href="{{asset('img/admin/funcionarios/icono.jpg')}}" type="image/x-icon"> --}}
    <!-- jQuery -->
    <script src="{{asset('adminlte3/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('adminlte3/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- IonIcons -->
    <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
    <link rel="stylesheet" href="{{asset('css/ionicons.min.css')}}">
    <!-- estilos del tema -->
    <link rel="stylesheet" href="{{asset('adminlte3/dist/css/adminlte.min.css')}}">
    <!-- estilos de spinner -->
    <link rel="stylesheet" href="{{asset('css/spinersAdmin.css')}}">
    <!-- alertas sweetalert2 -->
    <link rel="stylesheet" href="{{asset('adminlte3/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
    <script src="{{asset('adminlte3/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
    <!-- estilos de datatable -->
    <!-- <link rel="stylesheet" href="{{asset('cdn/jquery.dataTables.min.css')}}"> -->
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css"> -->
    <link rel="stylesheet" href="{{asset('datatable/css/dataTables.dataTables.css')}}">
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.1/css/buttons.dataTables.css"> -->
    <link rel="stylesheet" href="{{asset('datatable/css/buttons.dataTables.css')}}">
    <!-- para estilos de hora -->
    <link rel="stylesheet" href="{{asset('adminlte3/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- libreria para fechas -->
    <link rel="stylesheet" href="{{asset('adminlte3/plugins/daterangepicker/daterangepicker.css')}}">
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.css">

    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.js"></script>
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @include('layout.sections.navbar')
        @include('layout.sections.sidebar')
        <div class="content-wrapper">
            <div class="content-header" style="display: none;">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6"><h1 class="m-0">Dashboard v3</h1></div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                              <li class="breadcrumb-item"><a href="#">Home</a></li>
                              <li class="breadcrumb-item active">Dashboard v3</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            @yield('pageTitle')
<!-- --------------- -->
@if(!Session::has('usuario'))
{{-- <small>-</small> --}}
<script>
    // window.location.href = "{{url('login/login')}}";
</script>
@else
<small style="display: none;">.</small>
@endif
<!-- --------------- -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        {{-- <div class="overlayPagina">
                            <div class="loadingio-spinner-spin-i3d1hxbhik m-auto">
                                <div class="ldio-onxyanc9oyh">
                                    <div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div>
                                </div>
                            </div>
                        </div> --}}
                        {{-- new overlay --}}
                        <div class="overlayAllPage">
                            <div class="overlay-content">
                                {{-- <h2>Este es el overlay</h2>
                                <p>Puedes añadir aquí cualquier contenido.</p> --}}
                                {{-- <button onclick="closeOverlay()">Cerrar</button> --}}
                                <div class="loadingio-spinner-spin-i3d1hxbhik m-auto">
                                    <div class="ldio-onxyanc9oyh">
                                        <div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
        <aside class="control-sidebar control-sidebar-dark">
        </aside>
        @include('layout.sections.footer')
    </div>
<!-- jQuery -->
<script src="{{asset('adminlte3/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('adminlte3/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE -->
<script src="{{asset('adminlte3/dist/js/adminlte.js')}}"></script>
<!-- jquery validate -->
<script src="{{asset('adminlte3/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<!-- transJQV -->
<script src="{{asset('js/translateValidate.js')}}"></script>
<!-- helpers -->
<script src="{{asset('js/helper.js')}}"></script>
<!-- datatable -->
<!-- <script src="{{asset('cdn/jquery.dataTables.min.js')}}"></script> -->
<!-- <script src="https://code.jquery.com/jquery-3.7.1.js"></script> -->

<!-- <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script> -->
<script src="{{asset('datatable/js/dataTables.js')}}"></script>
<!-- <script src="https://cdn.datatables.net/buttons/3.0.1/js/dataTables.buttons.js"></script> -->
<script src="{{asset('datatable/js/dataTables.buttons.js')}}"></script>
<!-- <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.dataTables.js"></script> -->
<script src="{{asset('datatable/js/buttons.dataTables.js')}}"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script> -->
<script src="{{asset('datatable/js/jszip.min.js')}}"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script> -->
<script src="{{asset('datatable/js/pdfmake.min.js')}}"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script> -->
<script src="{{asset('datatable/js/vfs_fonts.js')}}"></script>
<!-- <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.html5.min.js"></script> -->
<script src="{{asset('datatable/js/buttons.html5.min.js')}}"></script>
<!-- <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.print.min.js"></script> -->
<script src="{{asset('datatable/js/buttons.print.min.js')}}"></script>
<!-- estilos de select2 -->
<link href="{{asset('plugins/select2/select2.min.css')}}" rel="stylesheet" />
<script src="{{asset('plugins/select2/select2.min.js')}}"></script>
<!-- trabaja con datapicker -->
<script src="{{asset('adminlte3/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('adminlte3/plugins/daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('adminlte3/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<script>
$(document).ready( function () {
    // sideBarCollapse();
    // sideBarActive();
} );
</script>
</body>
</html>
