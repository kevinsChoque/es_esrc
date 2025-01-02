<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{asset('/')}}" class="brand-link">
        {{-- <img src="{{asset('img/admin/funcionarios/icono.jpg')}}" alt="esrc" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
        <span class="brand-text font-weight-light">esrc</span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <span class="text-info"><i class="fa fa-user-tie fa-2x"></i></span>
            </div>
            <div class="info">
                <a href="#" class="d-block text-uppercase">
                    {{
                        Session::has('usuario')?
                            Session::get('usuario')->tipo:
                            '--';
                    }}
                </a>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{url('home/home')}}" class="nav-link sba2">
                        <i class="nav-icon fas fa-tachometer-alt"></i><p>Dashboard</p>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a href="{{url('format2/form')}}" class="nav-link sba6">
                        <i class="nav-icon fas fa-building"></i><p>Formato a</p>
                    </a>
                </li> --}}

                <li class="sbd1 nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-file"></i>
                        <p>Formato 2<i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('format2/form')}}" class="nav-link sba4">
                                <i class="far fa-file-alt nav-icon"></i><p>Registrar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('format2/show')}}" class="nav-link sba5">
                                <i class="fa fa-list nav-icon"></i><p>Listar</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{url('inspection/show')}}" class="nav-link sba6">
                        <i class="nav-icon fas fa-file"></i><p>Actas de inspeccion</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('format4/show')}}" class="nav-link sba7">
                        <i class="nav-icon fas fa-file"></i><p>Acta de conciliacion</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('desicion/show')}}" class="nav-link sba7">
                        <i class="nav-icon fas fa-file"></i><p>Resoluciones</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('opciones/show')}}" class="nav-link sba7">
                        <i class="nav-icon fas fa-file"></i><p>Opciones de recursos</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link logout">
                        <i class="nav-icon fas fa-sign-out-alt"></i><p>cerrar sesion</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>
<script>
    $('.logout').on('click',function(){
        Swal.fire({
            title: "Finalizar Sesion",
            text: "¿Esta seguro de cerrar sesion?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#28a745",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, cerrar sesion!",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                $('.overlayPagina').css("display","flex");
                window.location.href = "{{url('login/logout')}}";
            }
        });
    });
</script>
