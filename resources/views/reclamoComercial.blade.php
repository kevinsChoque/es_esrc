<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EMUSAP</title>
    <!-- icono de la pagina -->
    <link rel="icon" href="{{asset('img/emusap_logo.png')}}" type="image/x-icon">
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
    {{-- ------------------------------------------------------------ --}}
    {{-- ------------------------------------------------------------ --}}
    {{-- ------------------------------------------------------------ --}}
       <!-- Flatpickr CSS -->
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.css"> --}}

    <!-- Flatpickr JS -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.js"></script> --}}

    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/index.js"></script> --}}

    {{-- ---------------------------- --}}
    {{-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> --}}

<!-- Development -->
<script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.min.js"></script>
<script src="https://unpkg.com/tippy.js@6/dist/tippy-bundle.umd.js"></script>

</head>
<body class="hold-transition sidebar-mini">
    {{-- <div class="overlayPagina">
        <div class="loadingio-spinner-spin-i3d1hxbhik m-auto">
            <div class="ldio-onxyanc9oyh">
                <div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div>
            </div>
        </div>
    </div> --}}
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
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand" href="#">
                <img src="{{asset('img/emusap_logo.png')}}" style="width: 25px;">
                <span class="m-0">EMUSAP </span>
                <span class="m-0 font-weight-bold font-italic"> ABANCAY S.A.</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"><i class="fa fa-bars"></i></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link font-weight-bold" href="{{url('login/login')}}">Login Funcionario</a></li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="container-fluid pt-3" style="background-image: url('{{asset('img/bgg.jpg')}}')">
        <div class="row justify-content-center">

            <div class="col-lg-10">
                <div class="card">
                    <div class="overlay overlayForm">
                        <div class="spinner"></div>
                    </div>
                    <div class="card-body">
                        <form id="fvclaim">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="callout callout-info py-2">
                                        <h6 class="font-weight-bold"><i class="icon fas fa-info"></i> REGISTRAR RECLAMO:</h6>
                                        <ul class="m-0">
                                            <li>1.-Ingrese numero de inscripcion</li>
                                            <li>2.-Ingrese numero de identidad</li>
                                            <li>3.-Complete los datos del formulario</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label class="m-0">Numero de inscripcion: <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text font-weight-bold"><i class="fa fa-hashtag"></i></span>
                                        </div>
                                        <input type="text" class="form-control onlyNumbers input" id="ins" name="ins" maxlength="8">
                                    </div>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label class="m-0">Documento de identidad: <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text font-weight-bold"><i class="fas fa-id-card"></i></span>
                                        </div>
                                        <input type="text" class="form-control onlyNumbers input" placeholder="00000000" id="docIde" name="docIde">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary searchDocIde" type="button"><i class="fa fa-search"></i> Buscar</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label class="m-0">Nombres: <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text font-weight-bold"><i class="fa fa-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control input inputName" id="nombres" name="nombres" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-lg-3">
                                    <label class="m-0">Apellido paterno: <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text font-weight-bold"><i class="fa fa-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control input inputName" id="app" name="app" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-lg-3">
                                    <label class="m-0">Apellido materno: <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text font-weight-bold"><i class="fa fa-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control input inputName" id="apm" name="apm" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-lg-3">
                                    <label class="m-0">Correo electronico: <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text font-weight-bold"><i class="fa fa-envelope"></i></span>
                                        </div>
                                        <input type="text" class="form-control input validate" id="correo" name="correo">
                                    </div>
                                </div>
                                <div class="form-group col-lg-3">
                                    <label class="m-0">Celular: <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text font-weight-bold"><i class="fa fa-phone"></i></span>
                                        </div>
                                        <input type="text" class="form-control onlyNumbers input validate" id="celular" name="celular" maxlength="9">
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <div class="callout callout-info">
                                        <h6 class=""><i class="icon fas fa-info"></i> DECLARACION DEL RECLAMANTE (Fijacion de correo electronico como domicilio procesal):</h6>
                                        <p class="m-0">Solicito que las notificaciones de los actos administrativos del presente procedimiento de <br>
                                            reclamo se realicen en la dirección de correo electrónico consignado para lo cual brindo mi autorización expresa</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 d-flex justify-content-center align-items-center">
                                    <div class="col-sm-6">
                                        <div class="form-group clearfix">
                                            <div class="icheck-primary d-inline float-right">
                                                <input type="radio" id="radioDrn" name="dro" value="1" checked>
                                                <label for="radioDrn">SI</label>
                                            </div>
                                            <div class="icheck-primary d-inline float-left">
                                                <input type="radio" id="radioDrs" name="dro" value="0">
                                                <label for="radioDrs">NO</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-lg-7">
                                    <label class="m-0">Tipo del reclamo: <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text font-weight-bold"><i class="fa fa-list"></i></span>
                                        </div>
                                        <select name="tipo" id="tipo" class="form-control validate">
                                            <option value="0" selected disabled>== SELECCIONE ==</option>
                                            <optgroup label="PROBLEMAS EN EL REGIMEN DE FACTURACION Y EL NIVEL DE CONSUMO">
                                                {{-- <option value="1">CONSUMO MEDIDO</option> --}}
                                                <optgroup label="Consumo medido: El usuario considera que">
                                                    <option value="1">El regimen de facturacion no es aplicable</option>
                                                    <option value="2">Ha efectuado un consumo menor al volumen registrado por el medidor</option>
                                                </optgroup>
                                                <optgroup label="Consumo promedio: El usuario considera que">
                                                    <option value="3">El regimen de facturacion no es aplicable</option>
                                                    <option value="4">El monto facturado esta mal calculado</option>
                                                </optgroup>
                                                <optgroup label="Asignacion de consumo: El usuario considera que">
                                                    <option value="5">El regimen de facturacion no es aplicable</option>
                                                    <option value="6">El volumen facturado esta por encima del valor que corresponde segun las normas y la estructura tarifaria vigente</option>
                                                    <option value="7">El volumen facturado es mayor por considerarse un numero mayor de unidades de uso al que corresponde</option>
                                                </optgroup>
                                                <option value="8">CONSUMO PROMEDIO</option>
                                                <option value="9">ASIGNACION DE CONSUMO</option>
                                                <option value="10">CONSUMO NO FACTURADO OPORTUNAMENTE</option>
                                                <option value="11">CONSUMO NO REALIZADO POR SERVICIO REALIZADO</option>
                                                <option value="12">CONSUMO ATRIBUIBLE A USUARIO ANTERIOR DEL SUMINISTRO</option>
                                                <option value="13">CONSUMO ATRIBUIBLE A OTRO SUMINISTRO</option>
                                                <option value="14">REFACTURACION</option>
                                            </optgroup>
                                            <optgroup label="PROBLEMAS EN LA TARIFA APLICADA AL USUARIO">
                                                <option value="15">TIPO DE TARIFA</option>
                                            </optgroup>
                                            <optgroup label="PROBLEMAS EN OTROS CONCEPTOS FACTURADOS AL USUARIO">
                                                <option value="16">CONCEPTOS EMITIDOS</option>
                                                <option value="17">NUMERO DE UNIDADES DE USO MAYOR AL QUE CORRESPONDE</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-lg-5">
                                    <label class="m-0" for="meses">Meses de reclamo:</label>
                                    <select class="form-control validate" id="meses" name="meses[]" multiple="multiple">
                                        <option value="0" disabled>Seleccione meses</option>
                                        <option value="Enero">Enero</option>
                                        <option value="Febrero">Febrero</option>
                                        <option value="Marzo">Marzo</option>
                                        <option value="Abril">Abril</option>
                                        <option value="Mayo">Mayo</option>
                                        <option value="Junio">Junio</option>
                                        <option value="Julio">Julio</option>
                                        <option value="Agosto">Agosto</option>
                                        <option value="Septiembre">Septiembre</option>
                                        <option value="Octubre">Octubre</option>
                                        <option value="Noviembre">Noviembre</option>
                                        <option value="Diciembre">Diciembre</option>
                                    </select>
                                </div>
                                {{-- <div class="form-group col-lg-5">
                                    <label class="m-0">Meses de reclamo: <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text font-weight-bold"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        <input type="text" class="form-control input" id="meseso" name="meseso">
                                    </div>
                                </div> --}}

                                <div class="form-group col-lg-6 d-none">
                                    <label class="m-0">Ubicacion del predio/referencia: <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text font-weight-bold"><i class="fa fa-map-marker-alt"></i></span>
                                        </div>
                                        <input type="text" class="form-control input" id="referencia" name="referencia">
                                    </div>
                                </div>
                                <div class="form-group col-lg-6 d-none">
                                    <label class="m-0">Ubicacion a notificar: (opcional) <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text font-weight-bold"><i class="fa fa-map-marker-alt"></i></span>
                                        </div>
                                        <input type="text" class="form-control input" id="notificar" name="notificar">
                                    </div>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label class="m-0">Fundamento del reclamo: <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text font-weight-bold"><i class="fa fa-keyboard"></i></span>
                                        </div>
                                        <input type="text" class="form-control input validate" id="fundamento" name="fundamento">
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <div class="callout callout-info">
                                        <h6 class=""><i class="icon fas fa-info"></i> DECLARACION DEL RECLAMANTE (Aplicable a reclamos por consumo medido):</h6>
                                        <p class="m-0">solicitó la realización de prueba de verificación posterior y acepto asumir su costo, si el resultado de la prueba indica que el medidor no sobreregistra.</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 d-flex justify-content-center align-items-center">
                                    <div class="col-sm-6">
                                        <div class="form-group clearfix">
                                            <div class="icheck-primary d-inline float-right">
                                                <input type="radio" id="radio1Drn" name="dro1" value="1">
                                                <label for="radio1Drn">SI</label>
                                            </div>
                                            <div class="icheck-primary d-inline float-left">
                                                <input type="radio" id="radio1Drs" name="dro1" value="0" checked>
                                                <label for="radio1Drs">NO</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="form-group">
                                    <label for="fechaInso">Fecha de inspección:</label>
                                    <input type="text" id="fechaInso" name="fechaInso" class="form-control flatpickr" placeholder="Selecciona una fecha">
                                </div> --}}
                                {{-- <div class="form-group col-lg-6">
                                    <label for="fechaIns" class="m-0">Inspeccion interna y externa: <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text font-weight-bold"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        <input type="text" id="fechaIns" name="fechaIns" class="form-control flatpickr" placeholder="Selecciona una fecha">
                                    </div>
                                </div> --}}
                                <div class="form-group col-lg-6">
                                    <label class="m-0">Inspeccion interna y externa: <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text font-weight-bold"><i class="fas fa-id-card"></i></span>
                                        </div>
                                        <input type="text" id="fechaIns" name="fechaIns" class="form-control flatpickr input" placeholder="Selecciona una fecha">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary checkAvailability validate" type="button"><i class="fa fa-search"></i> Verificar disponibilidad de tecnico</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-lg-3 conteinerHoursAvailable" style="display: none;">
                                    <label for="hoursAvailable" class="m-0">Horas disponibles:</label>
                                    <select id="hoursAvailable" name="hoursAvailable" class="form-control hoursAvailable">
                                        <option disabled selected>Seleccione una opción</option>
                                        <option value="08:00AM - 10:00AM">08:00AM - 10:00AM</option>
                                        <option value="10:00AM - 12:00AM">10:00AM - 12:00AM</option>
                                        <option value="02:00PM - 04:00PM">02:00PM - 04:00PM</option>
                                        <option value="03:00PM - 05:00PM">03:00PM - 05:00PM</option>
                                    </select>
                                </div>
                                <div class="form-group col-lg-3 conteinerHourIns" style="display: none;">
                                    <label for="hourIns" class="m-0">Hora (rango de 2 horas): <span class="text-danger">*</span> <i class="fa fa-info-circle text-info" id="ihorasInspeccion"></i></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text font-weight-bold"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        <input type="time" id="hourIns" name="hourIns" class="form-control hourIns">
                                    </div>
                                </div>
                                <hr>
                                <div class="col-lg-12"></div>
                                <div class="form-group col-lg-6">
                                    <label class="m-0">Citacion a reunion: <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text font-weight-bold"><i class="fas fa-id-card"></i></span>
                                        </div>
                                        <input type="text" id="fechaReu" name="fechaReu" class="form-control flatpickr input" placeholder="Selecciona una fecha">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary checkAvailabilityReu validate" type="button"><i class="fa fa-search"></i> Verificar disponibilidad</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-lg-3 conteinerHoursAvailableReu" style="display: none;">
                                    <label for="hoursAvailableReu" class="m-0">Horas dispnibles:</label>
                                    <select id="hoursAvailableReu" name="hoursAvailableReu" class="form-control hoursAvailableReu">
                                        <option value="0" selected disabled>Seleccione una opcion</option>
                                        {{-- <option value="08:00AM - 10:00AM">08:00AM - 10:00AM</option>
                                        <option value="09:00AM - 11:00AM">09:00AM - 11:00AM</option>
                                        <option value="10:00AM - 12:00AM">10:00AM - 12:00AM</option>
                                        <option value="11:00AM - 01:00PM">11:00AM - 01:00PM</option>
                                        <option value="02:00PM - 03:30PM">02:00PM - 03:30PM</option> --}}
                                    </select>
                                </div>
                                <div class="col-lg-12"></div>
                                <div class="form-group col-lg-6">
                                    <label class="m-0">Fecha maxima de notificacion de la resolucion: <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text font-weight-bold"><i class="fa fa-envelope"></i></span>
                                        </div>
                                        <input type="date" class="form-control input" id="fechaNot" name="fechaNot" disabled="disabled">
                                    </div>
                                </div>
                                <div class="col-lg-12"></div>
                                {{-- <div class="col-lg-6">
                                    <div class="callout callout-info">
                                        <h6 class=""><i class="icon fas fa-info"></i> Documentos personales:</h6>
                                        <p class="m-0">Si la persona quien realiza el reclamo es el titular subir el la copia de DNI<br>
                                            Si la persona es el representante subir la copia de DNI y la carta poder</p>
                                    </div>
                                </div> --}}
                                <div class="col-lg-6 mb-3 containerDi" style="display: none;">
                                    <div class="alert text-center boxFile h-100 d-flex flex-column justify-content-center" style="border: 4px dashed #000;background: #ebeff5;">
                                        <h5 class="font-italic font-weight-bold m-auto nameFile">DOCUMENTO DE IDENTIDAD</h5>
                                        <p class="font-italic m-0 msgClick">Realiza click aki, para subir el archivo</p>
                                        <p class="m-auto"><i class="fa fa-upload fa-2x"></i></p>
                                    </div>
                                    <input type="file" id="fileDocPer" name="fileDocPer" class="pdfFile" style="display: none;" data-name="ARCHIVO DE DOCUMENTO DE IDENTIDAD">
                                </div>
                                <div class="col-lg-6 mb-3 containerCp" style="display: none;">
                                    <div class="alert text-center boxFile h-100 d-flex flex-column justify-content-center" style="border: 4px dashed #000;background: #ebeff5;">
                                        <h5 class="font-italic font-weight-bold m-auto nameFile">CARTA PODER</h5>
                                        <p class="font-italic m-0 msgClick">Realiza click aki, para subir el archivo</p>
                                        <p class="m-auto"><i class="fa fa-upload fa-2x"></i></p>
                                    </div>
                                    <input type="file" id="fileCarPod" name="fileCarPod" class="pdfFile" style="display: none;" data-name="ARCHIVO DE CARTA PODER">
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <div class="alert text-center boxFile h-100 d-flex flex-column justify-content-center" style="border: 4px dashed #000;background: #ebeff5;">
                                        <h5 class="font-italic font-weight-bold m-auto nameFile">ARCHIVO DE EVIDENCIA</h5>
                                        <p class="font-italic m-0 msgClick">Realiza click aki, para subir el archivo</p>
                                        <p class="m-auto"><i class="fa fa-upload fa-2x"></i></p>
                                    </div>
                                    <input type="file" id="fileEvidence" name="fileEvidence" class="pdfFile" style="display: none;" data-name="ARCHIVO DE EVIDENCIA">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer py-1 border-transparent">
                        <button type="button" class="btn btn-success float-right saveClaim ml-2 w-100 validate"><i class="fa fa-save"></i> Guardar Reclamo</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.css">

<!-- Flatpickr JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.js"></script>

{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script> --}}

{{-- <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/index.js"></script> --}}

{{-- --------------------------------------------------------------------------------------------------------- --}}


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
{{-- C:\xampp\htdocs\esrc2\public\plugins\select2 --}}
<link href="{{asset('plugins/select2/select2.min.css')}}" rel="stylesheet" />
<script src="{{asset('plugins/select2/select2.min.js')}}"></script>
<!-- trabaja con datapicker -->
<script src="{{asset('adminlte3/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('adminlte3/plugins/daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('adminlte3/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<style>
    .flatpickr-day.flatpickr-disabled {
    /* background-color: red !important; */
    background-color: rgba(255,0,0,.5) !important;
    color: white !important;
    opacity: 0.8;
}
</style>
<script>
    $('#meses').select2({
        // theme: 'bootstrap4',
        placeholder: 'Selecciona los meses',
        allowClear: true, // Para permitir limpiar la selección
        // width: '100%',
    });
</script>

<script>
    var ppp;
    var hourSelected = null;
    var validateCarPod=false;
    var tecnicosDisponibles = false;

    $(document).ready( function () {
        fechaMaxNotificacion()
        $('.validate').attr('disabled',true)
        $('.overlayAllPage').css("display","none");
        $('.overlayForm').css("display","none");
        initFv('fvclaim',rules());
        // flatpickr("#fechaReu", {
        //     dateFormat: "Y-m-d"
        // });
        // $('#buscarHorarios').on('click',function(){
        //     var fecha = $('#fechaIns').val();
        //     var hora = $('#hora').val();
        // })
        getDate();
        tippy('#ihorasInspeccion', {
            arrow: true,
            content: "El horario de inspecciones es de 8am - 12pm y de 1:30pm a 5pm",
        });
    });
    $('.hourIns').on('change', function() {
        if(hourSelected==null)
            validateHour(this)
        else
            validateHourAvailable(this)
    });
    function getDate()
    {
        jQuery.ajax({
            url: "{{ url('ins/getdate') }}",
            method: 'get',
            success: function (r) {
                // ---
                let tomorrow = new Date();
                tomorrow.setDate(tomorrow.getDate() + 1);
                let minDate = tomorrow.toISOString().split('T')[0];
                // ---
                // flatpickr("#fechaIns", {
                //     dateFormat: "Y-m-d",
                //     disable: r.data,
                //     minDate: minDate,
                //     maxDate: $("#fechaNot").val()
                // });
                flatpickr("#fechaIns", {
                    dateFormat: "Y-m-d",
                    disable: [
                        ...r.data, // Bloquea las fechas que vienen del backend
                        function(date) {
                            // Calcula dos días después de hoy
                            let today = new Date();
                            let maxDate = new Date(today);
                            maxDate.setDate(today.getDate() + 2);
                            maxDate.setHours(0, 0, 0, 0);
                            // Bloquea cualquier fecha después de maxDate
                            // return date > maxDate;
                            // Bloquea cualquier fecha después de maxDate o si es domingo
                            return date > maxDate || date.getDay() === 0;
                        }
                    ],
                    dateFormat: "Y-m-d",
                    minDate: minDate,
                    maxDate: $("#fechaNot").val()
                });

            },
            error: function (xhr, status, error)
            {msgImportantShow("Algo salio mal, porfavor contactese con el Administrador.",'Administrador','error')}
        });
    }
    // $('#ins').on('blur',function(){
    //     // alert('verificr')
    // });
    $(document).ready(function () {
        function getNextBusinessDays(count, skipDays)
        {
            let dates = [];
            let date = new Date(); // Fecha de hoy
            let addedDays = 0;
            let skipped = 0;
            while (addedDays < count)
            {
                date.setDate(date.getDate() + 1); // Avanzar un día
                let day = date.getDay(); // 0 = Domingo, 6 = Sábado
                if (day !== 0 && day !== 6)
                { // Solo lunes a viernes
                    if (skipped < skipDays)
                        skipped++; // Saltar los primeros 3 días hábiles
                    else
                    {
                        dates.push(date.toISOString().split('T')[0]); // Guardar en formato YYYY-MM-DD
                        addedDays++;
                    }
                }
            }

            return dates;
        }

        let availableDates = getNextBusinessDays(7, 3); // Obtener los próximos 10 días hábiles, omitiendo los 3 primeros

        flatpickr("#fechaReu", {
            dateFormat: "Y-m-d",
            enable: availableDates // Solo permitir las fechas calculadas
        });
    });


    function validateHour(ele)
    {
    console.log('llego a validateHour')
        var horaSeleccionada = $(ele).val();
        var horaSeleccionadaDate = new Date('1970-01-01T' + horaSeleccionada + ':00');

        // Definir los rangos permitidos
        var horaInicio1 = new Date('1970-01-01T08:00:00');
        var horaFin1 = new Date('1970-01-01T12:00:00');
        var horaInicio2 = new Date('1970-01-01T13:30:00');
        var horaFin2 = new Date('1970-01-01T17:00:00');

        // Duración mínima de 1 hora
        var duracionMinima = 60 * 60 * 1000; // 1 hora en milisegundos

        // Verificar si la hora seleccionada está en el intervalo permitido
        if (
            (horaSeleccionadaDate >= horaInicio1 && horaSeleccionadaDate <= horaFin1) ||
            (horaSeleccionadaDate >= horaInicio2 && horaSeleccionadaDate <= horaFin2)
        ) {
            // Verificar si la hora seleccionada permite un mínimo de 1 hora de trabajo
            var horaFinSeleccionada = new Date(horaSeleccionadaDate.getTime() + duracionMinima);
            if (
                (horaSeleccionadaDate >= horaInicio1 && horaFinSeleccionada <= horaFin1) ||
                (horaSeleccionadaDate >= horaInicio2 && horaFinSeleccionada <= horaFin2)
            ) {
                console.log('Hora válida: ' + horaSeleccionada);
            } else {
                alert('Debe seleccionar una hora que permita al menos 1 hora de trabajo dentro del horario laboral.');
                $(ele).val(''); // Limpiar el input
            }
        } else {
            // alert('Hora fuera del horario laboral. Seleccione un horario entre 8am-12pm o 1:30pm-5pm.');
            msgImportantShow('Hora fuera del horario laboral. Seleccione un horario entre 8am-12pm o 1:30pm-5pm.','Reclamo','warning')
            $(ele).val(''); // Limpiar el input
        }
    }

    function validateHourAvailable(ele)
    {
        console.log('llego validateHourAvailable')
        const selectedTime = new Date(`1970-01-01T${$(ele).val()}:00`);

        // Horarios laborales
        const startMorning = new Date('1970-01-01T08:00:00');
        const endMorning = new Date('1970-01-01T12:00:00');
        const startAfternoon = new Date('1970-01-01T13:30:00');
        const endAfternoon = new Date('1970-01-01T17:00:00');

        var horas = hourSelected.split('-');
        // Obtener el intervalo seleccionado por el usuario (modificar según tu lógica)
        const startInterval = new Date('1970-01-01T'+horas[1]+':00'); // Ejemplo de 8:00 AM
        const endInterval = new Date('1970-01-01T'+horas[2]+':00');  // Ejemplo de 14:00 PM
        // const startInterval = new Date('1970-01-01T'+hourSelected.split('-')[1]+':00'); // Ejemplo de 8:00 AM
        // const endInterval = new Date('1970-01-01T'+hourSelected.split('-')[1]+':00');  // Ejemplo de 14:00 PM

        // Duración mínima de 1 hora
        const duracionMinimaMs = 60 * 60 * 1000 * 2; // 1 hora en milisegundos el 2 de 2 horas
        // const duracionMinimaMs = 60 * 60 * 1000; // 1 hora en milisegundos el 2 de 2 horas
        const endSelectedTime = new Date(selectedTime.getTime() + duracionMinimaMs); // Hora de fin

        // Verificar si la hora ingresada está dentro del horario laboral
        const isValidMorning = selectedTime >= startMorning && endSelectedTime <= endMorning;
        const isValidAfternoon = selectedTime >= startAfternoon && endSelectedTime <= endAfternoon;

        // Verificar si la hora ingresada está dentro del intervalo seleccionado por el usuario
        const isWithinInterval = selectedTime >= startInterval && endSelectedTime <= endInterval;

        // Verificar si la hora cumple con los requisitos
        if ((isValidMorning || isValidAfternoon) && isWithinInterval) {
            console.log('Hora válida');
            // Aquí puedes agregar tu lógica si la hora es válida (enviar el formulario, etc.)
        } else {
            // alert('Hora fuera de rango permitido, fuera del intervalo seleccionado o no cumple con la duración mínima de 2 hora');
            msgImportantShow("Hora fuera de rango permitido, fuera del intervalo seleccionado o no cumple con la duración mínima de 2 hora.",'Advertencia','warning')
            $(ele).val(''); // Limpiar el input si no es válido
        }
    }


    $('.hoursAvailable').on('change',function(){
        $('.conteinerHourIns').css('display','block');
        hourSelected = $(this).val();
        $('#hourIns').val('')
    });
    $('.checkAvailabilityReu').on('click',function()
    {
        $('.conteinerHoursAvailableReu').css('display','none')
        // $('.conteinerHoursAvailable').css('display','none');
        jQuery.ajax({
            url: "{{ url('reu/getavailable') }}",
            method: 'get',
            data: {dateReu:$('#fechaReu').val()},
            dataType: 'json',
            success: function (r) {
                // hourSelected = null;
                if(r.data.length>0)
                    $('.conteinerHoursAvailableReu').css('display','block');
                else
                    $('.conteinerHoursAvailableReu').css('display','none')
                let select = $('#hoursAvailableReu');
                select.empty().append('<option value="0" selected disabled>Seleccione una opción</option>');
                $.each(r.data, function (index, value) {
                    select.append(`<option value="${value}">${value}</option>`);
                });
                console.log(r)
            },
            error: function (xhr, status, error) {
                msgImportantShow("Algo salio mal, porfavor contactese con el Administrador.",'Administrador','error')
            }
        });
    });
    $('.checkAvailability').on('click',function(){
        $('.conteinerHourIns').css('display','none')
        $('.conteinerHoursAvailable').css('display','none');
        var fecha = $('#fechaIns').val();
        jQuery.ajax({
            url: "{{ url('ins/getavailable') }}",
            method: 'get',
            data: {dateIns:$('#fechaIns').val()},
            dataType: 'json',
            success: function (r) {
                $('#hourIns').val('')
                hourSelected = null;
                if(r.data.length>0)
                {
                    // $('.conteinerHourIns').css('display','block');
                    // $('.conteinerHoursAvailable').css('display','none');
                    $('.conteinerHourIns').css('display','none')
                    $('.conteinerHoursAvailable').css('display','block');
                    tecnicosDisponibles=true;
                }
                else
                {
                    $('.conteinerHourIns').css('display','none')
                    $('.conteinerHoursAvailable').css('display','block');
                    tecnicosDisponibles=false;
                    getAvailableHours($('#fechaIns').val());
                }
                // getAvailableHours($('#fechaIns').val());
                console.log('available')
                console.log(r)
            },
            error: function (xhr, status, error) {
                msgImportantShow("Algo salio mal, porfavor contactese con el Administrador.",'Administrador','error')
            }
        });

    });

    function fechaMaxNotificacion()
    {
        var fecha = new Date();
        let dias = 30;
        let contador = 0;
        while (contador < dias)
        {
            fecha.setDate(fecha.getDate() + 1);
            let diaSemana = fecha.getDay();
            if (diaSemana !== 0 && diaSemana !== 6)
                contador++;
        }
        let fechaFormateada = fecha.toISOString().split('T')[0];
        $('#fechaNot').val(fechaFormateada);
        // defineIntervalIns()
    }
    // function defineIntervalIns()
    // {
    //     // Obtener la fecha de reunión establecida en #fechaReu
    //     let fechaNot = $("#fechaNot").val();
    //     // Si la fecha de reunión está definida
    //     if (fechaNot)
    //     {
    //         let tomorrow = new Date();
    //         tomorrow.setDate(tomorrow.getDate() + 1); // Día siguiente
    //         let minDate = tomorrow.toISOString().split('T')[0];

    //         // Configurar flatpickr para #fechaIns
    //         flatpickr("#fechaIns", {
    //             dateFormat: "Y-m-d",
    //             minDate: minDate,  // Permitir selección desde mañana
    //             maxDate: fechaNot  // Hasta la fecha de reunión
    //         });
    //     } else {
    //         console.warn("No se ha definido una fecha en date not.");
    //     }
    // }
    // function defineIntervalIns() {
    //     let fechaNot = $("#fechaNot").val(); // Obtener la fecha de notificación

    //     if (!fechaNot) {
    //         console.warn("No se ha definido una fecha en #fechaNot.");
    //         return;
    //     }

    //     let tomorrow = new Date();
    //     tomorrow.setDate(tomorrow.getDate() + 1);
    //     let minDate = tomorrow.toISOString().split('T')[0];

    //     flatpickr("#fechaIns", {
    //         dateFormat: "Y-m-d",
    //         minDate: minDate,
    //         maxDate: fechaNot
    //     });
    // }


    function getAvailableHours(fecha)
    {
        jQuery.ajax({
            url: "{{ url('ins/gethora') }}",
            method: 'POST',
            data: {dateIns:$('#fechaIns').val()},
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
            success: function (r) {
                ppp=r
                console.log(r)
                var horarioSelect = $('#hoursAvailable');
                horarioSelect.empty();
                if (r.data.length > 0) {
                    horarioSelect.append("<option value='0' disabled selected>Seleccione un horario de inspeccion disponible</option>");
                    $.each(r.data, function(index, horario) {
                        var option = $('<option></option>')
                            .val(`${horario.tecnical}-${horario.horario}`)
                            .text(`Tecnico ${horario.tecnical} | ${horario.horario}`);
                        horarioSelect.append(option);
                    });
                } else {
                    var option = $('<option></option>').val("").text("No hay técnicos disponibles");
                    horarioSelect.append(option);
                }
            },
            error: function (xhr, status, error) {
                alert("Algo salio mal, porfavor contactese con el Administrador.");
            }
        });
    }

    $('.searchInscription').on('click',function(){
        jQuery.ajax({
            url: "{{ url('format2/searchInscription') }}",
            method: 'POST',
            data: {inscription:$('#inscription').val()},
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
            success: function (r) {
                console.log(r)
                $('#numSum').val(r.data.suministro);
                // r.data
            },
            error: function (xhr, status, error) {
                alert("Algo salio mal, porfavor contactese con el Administrador.");
            }
        });
    });
    $('.saveClaim').on('click',function(){saveClaim();});
    $('.boxFile').on('click',function(){
        $(this).parent().find('input.pdfFile').click();
    });
    $('.pdfFile').on('change',function(){
        loadFile(this,true);
        // let nameFile = $(this).val().split('\\').pop();
        // if (/\.(pdf)$/i.test(nameFile))
        // {
        //     $(this).parent().find('.nameFile').html($(this).attr('data-name')+': '+nameFile);
        //     $(this).parent().find('.msgClick').remove();
        //     $(this).parent().find('i').removeClass('fa fa-upload fa-lg');
        //     $(this).parent().find('i').addClass('fa fa-file-pdf fa-lg');
        //     $(this).parent().find('.boxFile').css('border','4px solid #000');
        // }
        // else
        // {
        //     $(this).val('');
        //     alert('Selecciona un archivo PDF válido.');
        // }
    });
    function loadFile(ele,ban)
    {
        if(ban)
        {
            let nameFile = $(ele).val().split('\\').pop();
            if (/\.(pdf)$/i.test(nameFile))
            {
                $(ele).parent().find('.nameFile').html($(ele).attr('data-name')+': '+nameFile);
                // $(ele).parent().find('.msgClick').remove();
                // $(ele).parent().find('.msgClick').css('display','none');
                $(ele).parent().find('i').removeClass('fa fa-upload fa-lg');
                $(ele).parent().find('i').addClass('fa fa-file-pdf fa-lg');
                $(ele).parent().find('.boxFile').css('border','4px solid #000');
            }
            else
            {
                $(ele).val('');
                alert('Selecciona un archivo PDF válido.');
            }
        }
        else
        {
            // $(ele).parent().find('.nameFile').html('ARCHIVO DE EVIDENCIA');
            $(ele).parent().find('.nameFile').html($(ele).attr('data-name'));
            // $(ele).parent().find('.msgClick').css('display','block');
            $(ele).parent().find('i').removeClass('fa fa-file-pdf fa-lg');
            $(ele).parent().find('i').addClass('fa fa-upload fa-lg');
            $(ele).parent().find('.boxFile').css('border','4px dashed #000');
            $(ele).val('');
        }
    }
    $('.searchDocIde').on('click',function(){
        if(isEmpty($('#ins').val()))
        {
            msgImportantShow('Primero debe ingresar el numero de inscripcion.','Numero de inscripcion','info');
            return;
        }
        if($('#docIde').val().length != 8)
        {
            msgImportantShow('Ingrese un numero de identidad valido.','Documento de identidad','info');
            return;
        }
        $('.overlayAllPage').css("display","flex");
        jQuery.ajax({
            url: "{{ url('pformat2/verifyData') }}",
            method: 'POST',
            data: {inscription:$('#ins').val(),dni:$('#docIde').val()},
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
            success: function (r) {
                $('.inputName').val('')
                if(r.state)
                {
                    if(r.found)
                    {
                        let nameString = r.reg['Clinomx'].trim()
                        nameString = nameString.split(',')
                        let name = nameString[1]
                        let lastName = nameString[0].split(' ')
                        $('#nombres').val(name)
                        $('#app').val(lastName[0])
                        $('#apm').val(lastName[1])
                        $('.validate').attr('disabled',false)
                        $('.containerDi').removeClass('col-lg-6').addClass('col-lg-12')
                        $('.containerDi').css('display','block')
                        $('.containerCp').css('display','none')
                        $('.overlayAllPage').css("display","none");
                        $('.inputName').attr('disabled',true)
                        validateCarPod=false
                    }
                    else
                    {
                        $.ajax({
                            url: "https://dniruc.apisperu.com/api/v1/dni/"+$('#docIde').val(),
                            method: "GET",
                            data: {
                                token: "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6Imtldmlucy5jaG9xdWVAZ21haWwuY29tIn0.3TXCDSPb9Db392-2yR8M3wDOxctai_TBj4pn4OMi-as"
                            },
                            success: function(r) {
                                if(r.success)
                                {
                                    $('#app').val(r.apellidoPaterno)
                                    $('#apm').val(r.apellidoMaterno)
                                    $('#nombres').val(r.nombres)
                                    $('.inputName').attr('disabled',true)
                                }
                                else
                                {
                                    $('.inputName').attr('disabled',false)
                                }
                                validateCarPod=true
                                $('.containerDi').removeClass('col-lg-12').addClass('col-lg-6')
                                $('.containerDi').css('display','block')
                                $('.containerCp').css('display','block')
                                $('.validate').attr('disabled',false)
                                $('.overlayAllPage').css("display","none")
                            },
                            error: function(error) {
                                msgImportantShow('No fue posible establecer conexion en la busqueda.','No se encontro','error')
                            }
                        });
                    }
                }
                else
                {
                    $('.overlayAllPage').css("display","none");
                    msgImportant(r)
                }

            },
            error: function (xhr, status, error) {
                msgImportantShow("Algo salio mal, porfavor contactese con el Administrador.",'Administrador','error')
            }
        });

        // if($('#docIde').val().length == 8)
        // {
        //     $.ajax({
        //         url: "https://dniruc.apisperu.com/api/v1/dni/"+$('#docIde').val(),
        //         method: "GET",
        //         data: {
        //             token: "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6Imtldmlucy5jaG9xdWVAZ21haWwuY29tIn0.3TXCDSPb9Db392-2yR8M3wDOxctai_TBj4pn4OMi-as"
        //         },
        //         success: function(r) {
        //             $('#app').val(r.apellidoPaterno)
        //             $('#apm').val(r.apellidoMaterno)
        //             $('#nombres').val(r.nombres)
        //         },
        //         error: function(error) {
        //             $('#resultado').html('<p>Ocurrió un error al realizar la consulta.</p>');
        //             console.error("Error:", error);
        //         }
        //     });
        // }
        // else
        //     alert('mal')
    })
    function saveClaim()
    {
        if(validateConditions())
            return;
        var formData = new FormData($("#fvclaim")[0]);
        formData.append('nombres',$('#nombres').val());
        formData.append('app',$('#app').val());
        formData.append('apm',$('#apm').val());
        formData.append('validateCarPod',validateCarPod);
        formData.append('notificacion',$('#fechaNot').val());
        formData.append('tecnicosDisponibles',tecnicosDisponibles);
        $('.save').prop('disabled',true);
        $('.overlayForm').css("display","flex");
        jQuery.ajax({
            url: "{{ url('format2/savePortal') }}",
            method: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
            success: function (r) {
                if (r.state)
                {
                    cleanForm();
                    $('.save').prop('disabled',false);
                }
                msgImportant(r);
                $('.overlayForm').css("display","none");

            },
            error: function (xhr, status, error) {
                msgImportantShow('Algo salio mal, porfavor contactese con el Administrador.','-','error')
                console.log(error)
                $('.overlayForm').css("display","none");
            }
        });
    }
    function validateConditions()
    {
        if($('#fvclaim').valid()==false)
        {return true;}
        if(isEmpty($('#meses').val()))
        {msgImportant({'state':false,'message':'Seleccione los meses de reclamo.'});return true;}
        if(isEmpty($('#fechaIns').val()))
        {msgImportant({'state':false,'message':'Ingrese la fecha de inspeccion.'});return true;}
        // if(isEmpty($('#hourIns').val()))
        // {msgImportant({'state':false,'message':'Ingrese la hora de inspeccion.'});return true;}
        if($('#fileDocPer')[0].files.length==0)
        {msgImportantShow("No se subio los Documentos Personales.",'Reclamo','warning');return true;}
        if(validateCarPod && $('#fileCarPod')[0].files.length==0)
        {msgImportantShow("No se subio la CARTA PODER.",'Reclamo','warning');return true;}
        if($('#fileEvidence')[0].files.length==0)
        {msgImportantShow("No se subio el Documento de la EVIDENCIA.",'Reclamo','warning');return true;}


        return false;
    }
    function rules()
    {
        return {
            ins: {required: true,},
            docIde: {required: true,},
            nombres: {required: true,},
            app: {required: true,},
            apm: {required: true,},
            correo: {required: true,},
            celular: {required: true,},
            tipo: {required: true,},
            meses: {required: true,},
            referencia: {required: true,},
            fundamento: {required: true,},
            // hourIns: {required: true,},
        };
    }
    function cleanForm()
    {
        $('.input').val('');
        $('#tipo').val('0');
        $('#meses').val('').change()
        $('.conteinerHourIns').css('display','none')
        $('.conteinerHoursAvailable').css('display','none');
        loadFile($('#fileEvidence'),false);
        loadFile($('#fileDocPer'),false);
        loadFile($('#fileCarPod'),false);
        $('.validate').attr('disabled',true)

    }
</script>
</body>
</html>
