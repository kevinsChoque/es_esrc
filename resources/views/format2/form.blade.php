@extends('layout.layout')
@section('nombreContenido', '----')
@section('pageTitle')
{{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2-bootstrap4.min.css" rel="stylesheet"> --}}

<div class="content-header pb-0 pt-2">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"><h1 class="m-0">Registrar reclamo</h1></div>
            <div class="col-sm-6">
                <a href="{{url('format2/show')}}" class="btn btn-success float-right"><i class="fa fa-list"></i> Ver reclamos</a>
                <ol class="breadcrumb float-sm-right" style="display: none;">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard v3</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-3">
            <div class="info-box mb-3 bg-info canalInfo canalInfoWeb" data-canal="web">
                <span class="info-box-icon"><i class="fas fa-globe"></i></span>
                <div class="info-box-content">
                    <h1 class="info-box-text font-weight-bolder m-0">WEB</h1>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="info-box mb-3 bg-light canalInfo canalInfoNew" data-canal="new">
                <span class="info-box-icon"><i class="fas fa-plus"></i></span>
                <div class="info-box-content">
                    <h1 class="info-box-text font-weight-bolder m-0">NUEVO</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="card cardWeb" style="display: block;">
        <div class="card-body">
            <div class="row">
                {{-- <div class="form-group col-lg-12">
                    <label class="m-0">Ingrese informacion para buscar: <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text font-weight-bold"><i class="fas fa-id-card"></i></span>
                        </div>
                        <input type="text" id="dataSearch" name="dataSearch" class="form-control" placeholder="Ingrese la informacion" value="00131291">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary searchReclaim" type="button"><i class="fa fa-search"></i> Buscar reclamo</button>
                        </div>
                    </div>
                </div> --}}
                <div class="form-group col-lg-9">
                    <label for="" class="m-0">Reclamos realizados desde el portal:</label>
                    <select name="claims" id="claims" class="form-control select2" style="width: 100%;">
                        <option selected disabled value="0">Buscar reclamo (DNI - Nombre y apellidos - reclamo)</option>
                    </select>
                </div>
                <div class="form-group col-lg-3">
                    <label class="m-0"></label>
                    <div class="form-control p-0" style="border: none;">
                        <button class="btn btn-outline-secondary w-100 searchReclaim"><i class="fa fa-search"></i> Buscar reclamo</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card cardNew" style="display: none;">
        <div class="card-body">
            <div class="row">
                <div class="form-group col-lg-4">
                    <label class="m-0">Ingrese numero de inscripcion:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text font-weight-bold"><i class="fas fa-id-card"></i></span>
                        </div>
                        <input type="text" id="dins" name="dins" class="form-control onlyNumbers" placeholder="Ingrese la informacion" maxlength="8">
                    </div>
                </div>
                <div class="form-group col-lg-5">
                    <label class="m-0">Ingrese numero de suministro:</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Mzn:</span>
                        </div>
                        <input type="text" name="dmzn" id="dmzn" class="form-control onlyNumbers" maxlength="2">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Lote</span>
                        </div>
                        <input type="text" name="dlote" id="dlote" class="form-control onlyNumbers" maxlength="4">
                    </div>
                </div>
                <div class="form-group col-lg-3">
                    <label class="m-0"></label>
                    <div class="form-control p-0" style="border: none;">
                        <button class="btn btn-outline-secondary w-100 searchData"><i class="fa fa-search"></i> Buscar usuario</button>
                    </div>
                </div>
                <div class="form-group col-lg-9">
                    <label class="m-0">Usuario:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text font-weight-bold"><i class="fas fa-id-card"></i></span>
                        </div>
                        <input type="text" id="userSearch" name="userSearch" class="form-control" placeholder="Ingrese el nombre y apellidos">
                    </div>
                </div>
                <div class="form-group col-lg-3">
                    <label class="m-0"></label>
                    <div class="form-control p-0" style="border: none;">
                        <button class="btn btn-outline-secondary w-100 searchName"><i class="fa fa-search"></i> Buscar usuario</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="overlay oveCard">
            <div class="spinner"></div>
        </div>
        <div class="card-boy">
            <form id="fvclaim">
                {{-- <input type="hidden" name="idFo2" id="idFo2"> --}}
            <table class="table table-bordered">
                <tr>
                    <td colspan="8" class="align-middle"><strong>CÓDIGO DE RECLAMO N°</strong></td>
                    <td colspan="4" class="p-1"><input type="text" name="codRec" id="codRec" class="form-control w-100 input" disabled></td>
                </tr>
                <tr>
                    <td colspan="2" class="align-middle"><strong>N° DE SUMINISTRO</strong></td>
                    <td colspan="4" class="p-1"><input type="text" name="suministro" id="suministro" class="form-control w-100 input" disabled></td>
                    <td colspan="2" class="align-middle"><strong>Teléfono</strong></td>
                    <td colspan="4" class="p-1"><input type="text" class="form-control w-100 dptelefono input" disabled></td>
                </tr>
                <tr>
                    <td colspan="4" class="p-1"><input type="text" name="nombres" id="nombres" class="form-control w-100 input"></td>
                    <td colspan="6" class="p-1"><input type="text" name="app" id="app" class="form-control w-100 input"></td>
                    <td colspan="2" class="p-1"><input type="text" name="apm" id="apm" class="form-control w-100 input"></td>
                </tr>
                <tr>
                    <td colspan="4" class="align-middle py-0"><strong>nombres</strong></td>
                    <td colspan="6" class="align-middle py-0"><strong>apellido paterno</strong></td>
                    <td colspan="2" class="align-middle py-0"><strong>apellido materno</strong></td>
                </tr>
                <tr>
                    <td colspan="8" class="align-middle"><strong>Numero de documento de identidad (DNI, LE, CI) razon social</strong></td>
                    <td colspan="4" class="align-middle p-1"><input type="text" name="numIde" id="numIde" class="form-control w-100 input"></td>
                </tr>
                <tr>
                    <td colspan="4" class="align-middle"><strong>Razon social</strong></td>
                    <td colspan="8" class="p-1"><input type="text" name="razonSocial" id="razonSocial" class="form-control w-100 input"></td>
                </tr>
                <tr>
                    <td colspan="12" class="align-middle"><strong>Ubicacion del predio</strong></td>
                </tr>
                <tr>
                    <td colspan="9" class="p-1"><input type="text" name="upcjb" id="upcjb" class="form-control w-100 urbanizacion input"></td>
                    <td colspan="1" class="p-1"><input type="text" name="upn" id="upn" class="form-control w-100 input"></td>
                    <td colspan="1" class="p-1"><input type="text" name="upmz" id="upmz" class="form-control w-100 input"></td>
                    <td colspan="1" class="p-1"><input type="text" name="uplote" id="uplote" class="form-control w-100 input"></td>
                </tr>
                <tr>
                    <td colspan="9" class="align-middle py-0"><strong>(calle, jiron, avenida)</strong></td>
                    <td colspan="1" class="align-middle py-0"><strong>Nª</strong></td>
                    <td colspan="1" class="align-middle py-0"><strong>Mz.</strong></td>
                    <td colspan="1" class="align-middle py-0"><strong>Lote</strong></td>
                </tr>
                <tr>
                    <td colspan="4" class="p-1"><input type="text" name="upub" id="upub" class="form-control w-100 urbanizacion input"></td>
                    <td colspan="6" class="p-1"><input type="text" name="upp" id="upp" class="form-control w-100 input" value="Abancay"></td>
                    <td colspan="2" class="p-1"><input type="text" name="upd" id="upd" class="form-control w-100 input" value="Abancay"></td>
                </tr>
                <tr>
                    <td colspan="4" class="align-middle py-0"><strong>(urbanizacion, barrio)</strong></td>
                    <td colspan="6" class="align-middle py-0"><strong>provincia</strong></td>
                    <td colspan="2" class="align-middle py-0"><strong>distrito</strong></td>
                </tr>
                {{-- --- --}}
                <tr>
                    <td colspan="12"><strong>Domicilio procesal</strong></td>
                </tr>
                <tr>
                    <td colspan="9" class="p-1"><input type="text" name="dpcja" id="dpcja" class="form-control w-100 urbanizacion input"></td>
                    <td colspan="1" class="p-1"><input type="text" name="dpn" id="dpn" class="form-control w-100 input"></td>
                    <td colspan="1" class="p-1"><input type="text" name="dpmz" id="dpmz" class="form-control w-100 input"></td>
                    <td colspan="1" class="p-1"><input type="text" name="dplote" id="dplote" class="form-control w-100 input"></td>
                </tr>
                <tr>
                    <td colspan="9" class="align-middle py-0"><strong>(calle, jiron, avenida)</strong></td>
                    <td colspan="1" class="align-middle py-0"><strong>Nª</strong></td>
                    <td colspan="1" class="align-middle py-0"><strong>Mz.</strong></td>
                    <td colspan="1" class="align-middle py-0"><strong>Lote</strong></td>
                </tr>
                <tr>
                    <td colspan="4" class="p-1"><input type="text" name="dpub" id="dpub" class="form-control w-100 urbanizacion input"></td>
                    <td colspan="6" class="p-1"><input type="text" name="dpp" id="dpp" class="form-control w-100 input" value="Abancay"></td>
                    <td colspan="2" class="p-1"><input type="text" name="dpd" id="dpd" class="form-control w-100 input" value="Abancay"></td>
                </tr>
                <tr>
                    <td colspan="4" class="align-middle py-0"><strong>(urbanizacion, barrio)</strong></td>
                    <td colspan="6" class="align-middle py-0"><strong>provincia</strong></td>
                    <td colspan="2" class="align-middle py-0"><strong>distrito</strong></td>
                </tr>
                <tr>
                    <td colspan="4" class="p-1"><input type="text" name="dpcp" id="dpcp" class="form-control w-100 input onlyNumbers" value="03001" maxlength="5"></td>
                    <td colspan="6" class="p-1"><input type="text" name="dptelefono" id="dptelefono" class="form-control w-100 input dptelefono"></td>
                    <td colspan="2" class="p-1"><input type="text" name="dpcorreo" id="dpcorreo" class="form-control w-100 input"></td>
                </tr>
                <tr>
                    <td colspan="4" class="align-middle py-0"><strong>Codigo postal</strong></td>
                    <td colspan="6" class="align-middle py-0"><strong>Telefono / Celular</strong></td>
                    <td colspan="2" class="align-middle py-0"><strong>Correo electronico</strong></td>
                </tr>
                <tr>
                    <td colspan="12" class="align-middle"><strong>Declaracion del reclamante (Fijacion de correo electronico como domicilio procesal)</strong></td>
                </tr>
                <tr>
                    <td colspan="10" class="align-middle"><strong style="font-size: .8rem">Solicito que las notificaciones de los actos administrativos del presente
                        procedimiento de reclamo se realicen en la direccion de correo electronico consignado para lo cual brindo mi autorizacion expresa</strong>
                    </td>
                    <td colspan="2" class="text-center">
                        <div class="form-group m-0">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sendNotify" id="sendNotifySi" value="1" checked>
                                <label class="form-check-label" for="sendNotifySi">SI</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sendNotify" id="sendNotifyNo" value="0">
                                <label class="form-check-label" for="sendNotifyNo">NO</label>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="12" class="align-middle"><strong>TIPO DE RECLAMO (Indique la letra del tipo de reclamo) Tipo de reclamo (Ver lista en reverso)</strong></td>
                </tr>
                <tr>
                    <td colspan="6" class="align-middle"><strong style="font-size: .9rem">Tipo de reclamo (Ver lista en reverso)</strong>
                    </td>
                    <td colspan="6" class="p-1">
                        <div class="input-group m-0">
                            <div class="input-group-prepend">
                                <span class="input-group-text font-weight-bold"><i class="fa fa-list"></i></span>
                            </div>
                            <select name="tipoReclamo" id="tipoReclamo" class="form-control">
                                <option value="0" selected="" disabled="">== SELECCIONE ==</option>
                                <optgroup label="PROBLEMAS EN EL REGIMEN DE FACTURACION Y EL NIVEL DE CONSUMO">
                                    <option value="1">CONSUMO MEDIDO</option>
                                    <option value="2">CONSUMO PROMEDIO</option>
                                    <option value="3">ASIGNACION DE CONSUMO</option>
                                    <option value="4">CONSUMO NO FACTURADO OPORTUNAMENTE</option>
                                    <option value="5">CONSUMO NO REALIZADO POR SERVICIO REALIZADO</option>
                                    <option value="6">CONSUMO ATRIBUIBLE A USUARIO ANTERIOR DEL SUMINISTRO</option>
                                    <option value="7">CONSUMO ATRIBUIBLE A OTRO SUMINISTRO</option>
                                    <option value="8">REFACTURACION</option>
                                </optgroup>
                                <optgroup label="PROBLEMAS EN LA TARIFA APLICADA AL USUARIO">
                                    <option value="9">TIPO DE TARIFA</option>
                                </optgroup>
                                <optgroup label="PROBLEMAS EN OTROS CONCEPTOS FACTURADOS AL USUARIO">
                                    <option value="10">CONCEPTOS EMITIDOS</option>
                                    <option value="11">NUMERO DE UNIDADES DE USO MAYOR AL QUE CORRESPONDE</option>
                                </optgroup>
                            </select>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="12" class="align-middle"><strong>BREVE DESCRIPCION DEL RECLAMO (Meses reclamados, montos, etc. En lo aplicable)</strong></td>
                </tr>
                <tr>
                    <td colspan="12" class="p-1">
                        <div class="form-group col-lg-12 p-0 mb-1">
                            <select class="form-control w-100" id="meses" name="meses[]" multiple="multiple">
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
                        <div class="form-group m-0">
                            <textarea class="form-control input" name="descripcion" id="descripcion" rows="4" placeholder="Descripcion aquí..."></textarea>
                        </div>

                    </td>
                </tr>
                <tr>
                    <td colspan="4" class="align-middle"><strong>SUCURSAL / ZONAL</strong></td>
                    <td colspan="8" class="p-1"><input type="text" name="sucursal" id="sucursal" class="form-control w-100" value="Abancay"></td>
                </tr>
                <tr>
                    <td colspan="4" class="align-middle"><strong>ATENDIDO POR</strong></td>
                    <td colspan="6" class="p-1"><input type="text" name="atendido" id="atendido" class="form-control w-100" value="jamilet cruz" disabled></td>
                    {{-- <td colspan="1" class="align-middle"><strong>FIRMA</strong></td>
                    <td colspan="1" class="p-1"><input type="text" class="form-control w-100"></td> --}}
                </tr>
                <tr>
                    <td colspan="12" class="align-middle"><strong>FUNDAMENTO DEL RECLAMO (En caso de ser necesario, se podran adjuntar paginas adicionales)</strong></td>
                </tr>
                <tr>
                    <td colspan="12" class="p-1">
                        <div class="form-group m-0">
                            <textarea class="form-control input" name="fundamento" id="fundamento" rows="4" placeholder="Fundamento aquí..."></textarea>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="12" class="align-middle"><strong>RELACION DE PRUEBAS QUE SE PRESENTAN ADJUNTAS</strong></td>
                </tr>
                <tr>
                    <td colspan="12">
                        <strong>AQUI LA CARGA DE ARCHIVOS <i class="fas fa-broom text-info cleanEvidence"></i></strong>
                        <div class="col-lg-12 containerEvidence">
                            {{-- <button class="btn btn-link showEvidence"><i class="fa fa-file"></i> Ver evidencias cargadas por el usuario</button> --}}
                        </div>
                        <div class="col-lg-12 mb-3">
                            <div class="alert text-center boxFile h-100 d-flex flex-column justify-content-center" style="border: 4px dashed #000;background: #ebeff5;">
                                <h5 class="font-italic font-weight-bold m-auto nameFile">Subir evidencias</h5>
                                <p class="font-italic m-0 msgClick">Realiza click aki, para subir el archivo</p>
                                <p class="m-auto"><i class="fa fa-upload fa-2x"></i></p>
                            </div>
                            <input type="file" id="evidenceFile" name="evidenceFile" class="pdfFile" style="display: none;" data-name="ARCHIVO DE EVIDENCIAS">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="10" class="align-middle"><strong>LA EMPRESA PRESTADORA ENTREGA CARTILLA INFORMATIVA</strong>
                    </td>
                    <td colspan="2" class="text-center">
                        <div class="form-group m-0">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sendBooklet" id="sendBookletSi" value="1" checked>
                                <label class="form-check-label" for="sendBookletSi">SI</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sendBooklet" id="sendBookletNo" value="0">
                                <label class="form-check-label" for="sendBookletNo">NO</label>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="10" class="align-middle"><strong style="font-size: .9rem">DECLARACION DEL RECLAMANTE (Aplicable a reclamos por consumo medido).
                        Solicito la realizacion de prueba de verificacion posterior y acepto asumir su costo, si el resultado de la prueba indica que el medidor no sobreregistra.</strong>
                    </td>
                    <td colspan="2" class="text-center">
                        <div class="form-group m-0">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sendReclaim" id="sendReclaimSi" value="1" checked>
                                <label class="form-check-label" for="sendReclaimSi">SI</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sendReclaim" id="sendReclaimNo" value="0">
                                <label class="form-check-label" for="sendReclaimNo">NO</label>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="12" class="align-middle"><strong>INFORMACION A SER COMPLETADA POR LA EMPRESA PRESTADORA</strong></td>
                </tr>
                <tr>
                    <td colspan="3" class="align-middle py-0">
                        <strong style="font-size: .8rem">
                            <a class="btn btn-link p-0 changeInspections" style="display: none;"><i class="fa fa-edit fa-2x text-info"></i></a>
                             INSPECCION INTERNA Y EXTERNA, FECHA:
                        </strong>
                    </td>
                    <td colspan="5" class="align-middle p-1">
                        <input type="date" name="dateIns" id="dateIns" class="form-control w-100 input" disabled>
                        {{-- new --}}
                        <div class="form-group m-0 nconteinerDate" style="display: none;">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text font-weight-bold"><i class="fas fa-id-card"></i></span>
                                </div>
                                <input type="text" id="nfechaIns" name="nfechaIns" class="form-control flatpickr input" placeholder="Selecciona una fecha">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary ncheckAvailability validate" type="button"><i class="fa fa-search"></i> Verificar disponibilidad de tecnico</button>
                                </div>
                            </div>
                        </div>
                        {{-- new --}}
                    </td>
                    <td colspan="2" class="align-middle"><strong style="font-size: .8rem">HORA (RANGO DE 2 HORAS):</strong></td>
                    <td colspan="2" class="align-middle p-1">
                        <input type="text" name="startTime" id="startTime" class="form-control w-100 input" disabled>
                        {{-- new --}}
                        <div class="form-group nconteinerHoursAvailable" style="display: none;">
                            <label for="nhoursAvailable" class="m-0">Horas disponibles:</label>
                            <select id="nhoursAvailable" name="nhoursAvailable" class="form-control nhoursAvailable"></select>
                        </div>
                        <div class="form-group nconteinerHourIns" style="display: none;">
                            <label for="nhourInsInicio" class="m-0">Hora de inicio: <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text font-weight-bold"><i class="fa fa-calendar"></i></span>
                                </div>
                                <input type="time" id="nhourInsInicio" name="nhourInsInicio" class="form-control">
                            </div>
                        </div>
                        <div class="form-group nconteinerHourIns" style="display: none;">
                            <label for="nhourInsFin" class="m-0">Hora de finalizacion: <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text font-weight-bold"><i class="fa fa-calendar"></i></span>
                                </div>
                                <input type="time" id="nhourInsFin" name="nhourInsFin" class="form-control">
                            </div>
                            <small id="nerrorHourMessage" class="text-danger"></small>
                        </div>
                        {{-- new --}}
                    </td>
                </tr>
                {{-- <tr>
                    <td colspan="3" class="align-middle py-0"><strong style="font-size: .8rem"><button class="btn btn-link p-0"><i class="fa fa-edit fa-2x text-info"></i></button> INSPECCION INTERNA Y EXTERNA, FECHA:</strong></td>
                    <td colspan="5" class="align-middle p-1"><input type="date" class="form-control w-100 input"></td>
                    <td colspan="2" class="align-middle"><strong style="font-size: .8rem">HORA (RANGO DE 2 HORAS):</strong></td>
                    <td colspan="2" class="align-middle p-1">
                        <input type="text" class="form-control w-100 input">
                    </td>
                </tr> --}}
                <tr>
                    <td colspan="3" class="align-middle"><strong style="font-size: .8rem">CITACION A REUNION DE CONCILIACION, FECHA:</strong></td>
                    <td colspan="5" class="align-middle p-1"><input type="date" name="reunion" id="reunion" class="form-control w-100 input"></td>
                    <td colspan="2" class="align-middle"><strong style="font-size: .8rem">HORA:</strong></td>
                    <td colspan="2" class="align-middle p-1"><input type="time" id="horaReunion" name="horaReunion" class="form-control w-100 input"></td>
                </tr>
                <tr>
                    <td colspan="9" class="align-middle"><strong>FECHA MAXIMA DE NOTIFICACION DE LA RESOLUCION</strong></td>
                    <td colspan="1" class="align-middle"><strong>(DD/MM/AA)</strong></td>
                    <td colspan="2" class="p-1"><input type="date" name="notificacion" id="notificacion" class="form-control w-100 input"></td>
                </tr>
            </table>
            </form>
        </div>
        <div class="card-footer">
            <button type="button" class="btn btn-success w-100 saveClaim"><i class="fa fa-save"></i> Guardar Reclamo</button>
        </div>
    </div>
</div>
<div class="modal fade" id="searchResultsModal" tabindex="-1" role="dialog" aria-labelledby="searchResultsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="searchResultsModalLabel"><i class="fa fa-list"></i> Resultados de la búsqueda</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12 containerRecords table-responsive">
                    <table id="records" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Identificadores</th>
                                <th>Apellidos y Nombres</th>
                                <th>Direccion</th>
                                <th>Opc.</th>
                            </tr>
                        </thead>
                        <tbody id="data"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@include('format2.changeInspection')
<script>
    localStorage.setItem("sbd",0);
    localStorage.setItem("sba",2);
    var according=true;
    var tableRecords;
    $(document).ready( function () {
        tableRecords=$('.containerRecords').html();
        $('.overlayAllPage').css("display","none");
        // $('.oveCard').css("display","none");
        initFv('fvclaim',rules());
        // fillReclaim();
        fillReclaimWeb();
        $('#meses').select2({
            placeholder: 'Selecciona los meses',
            allowClear: true,
        });
        flatpickr("#nfechaIns", {
            dateFormat: "Y-m-d"
        });
    });
    // ins new
    $('.nhoursAvailable').on('change',function(){
        $('.nconteinerHourIns').css('display','block');
        hourSelected = $(this).val();
        $('#nhourInsInicio').val('')
        $('#nhourInsFin').val('')
    });
    $('.ncheckAvailability').on('click',function(){
        $('.nconteinerHourIns').css('display','none')
        $('.nconteinerHoursAvailable').css('display','none');
        var fecha = $('#nfechaIns').val();
        jQuery.ajax({
            url: "{{ url('ins/getavailable') }}",
            method: 'get',
            data: {dateIns:$('#nfechaIns').val()},
            dataType: 'json',
            success: function (r) {
                $('#nhourIns').val('')
                hourSelected = null;
                if(r.data.length>0)
                {
                    $('.nconteinerHourIns').css('display','block');
                    $('.nconteinerHoursAvailable').css('display','none');
                }
                else
                {
                    $('.nconteinerHourIns').css('display','none')
                    $('.nconteinerHoursAvailable').css('display','block');
                    ngetAvailableHours($('#nfechaIns').val());

                }
            },
            error: function (xhr, status, error) {
                msgImportantShow("Algo salio mal, porfavor contactese con el Administrador.",'Administrador','error')
            }
        });
    });
    $('#nhourInsInicio, #nhourInsFin').on('change', function () {
        const startHour = $('#nhourInsInicio').val(); // Hora de inicio
        const endHour = $('#nhourInsFin').val(); // Hora de finalización
        const interval = $('#nhoursAvailable').val(); // Obtener el valor del select
        const [sinvalor ,intervalStart, intervalEnd] = interval.split('-'); // Dividir el intervalo en hora de inicio y fin
        // Validar que las horas estén dentro del intervalo
        if (startHour && (startHour < intervalStart || startHour > intervalEnd))
        {
            $('#nerrorHourMessage').text(`La hora de inicio debe estar entre ${intervalStart} y ${intervalEnd}.`);
            $('#nhourInsInicio').val(''); // Limpiar hora de inicio
            return;
        }
        if (endHour && (endHour < intervalStart || endHour > intervalEnd))
        {
            $('#nerrorHourMessage').text(`La hora de finalización debe estar entre ${intervalStart} y ${intervalEnd}.`);
            $('#nhourInsFin').val(''); // Limpiar hora de finalización
            return;
        }
        // Validar que la hora final sea mayor que la inicial
        if (startHour && endHour && endHour <= startHour)
        {
            $('#nerrorHourMessage').text('La hora de finalización debe ser mayor que la hora de inicio.');
            $('#nhourInsFin').val(''); // Limpiar hora final
            return;
        }
        // Si todo es válido, limpiar mensajes de error
        $('#nerrorHourMessage').text('');
    });
    function ngetAvailableHours(fecha)
    {
        jQuery.ajax({
            url: "{{ url('ins/gethora') }}",
            method: 'POST',
            data: {dateIns:$('#nfechaIns').val()},
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
            success: function (r) {
                ppp=r
                console.log(r)
                var horarioSelect = $('#nhoursAvailable');
                horarioSelect.empty();
                if (r.data.length > 0) {
                    horarioSelect.append("<option value='0' disabled selected>Seleccione un horario de inspeccion disponible</option>");
                    $.each(r.data, function(index, horario) {
                        var option = $('<option></option>')
                            .val(`${horario.tecnical}-${horario.hora_inicio}-${horario.hora_fin}`)
                            .text(`Tecnico ${horario.tecnical} | ${horario.hora_inicio} a ${horario.hora_fin}`);
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
    // ins new
    $('.searchReclaim').on('click',function(){searchReclaim()})
    $('.searchData').on('click',function(){searchData()})
    $('.searchName').on('click',function(){searchName()})
    $('.saveClaim').on('click',function(){saveClaim()})
    $('.canalInfo').on('click',function(){
        clearForm()
        if($(this).attr('data-canal')=='web')
        {
            $('.cardWeb').css('display','block')
            $('.cardNew').css('display','none')
            $('.canalInfoNew').removeClass('bg-info').addClass('bg-light')
            $('.canalInfoWeb').removeClass('bg-light').addClass('bg-info')
            $('.nconteinerDate').css('display','none')
            $('#dateIns').css('display','block');
            $('#startTime').css('display','block')
            $('.nconteinerHoursAvailable').css('display','none')
            $('.nconteinerHourIns').css('display','none')
            $('.oveCard').css("display","flex");
            according=true
        }
        else
        {
            $('.cardWeb').css('display','none')
            $('.cardNew').css('display','block')
            $('.canalInfoWeb').removeClass('bg-info').addClass('bg-light')
            $('.canalInfoNew').removeClass('bg-light').addClass('bg-info')

            $('.containerEvidence').html('')
            $('.nconteinerDate').css('display','block')
            $('#dateIns').css('display','none');
            $('#startTime').css('display','none')
            $('.oveCard').css("display","none");
            according=false
            showDateRed()
        }
        $('.changeInspections').css('display','none')
    });
    $('.boxFile').on('click',function(){
        $(this).parent().find('input.pdfFile').click();
    });

    $('.pdfFile').on('change',function(){
        loadFile(this,true);
    });
    $('.cleanEvidence').on('click',function(){
        loadFile($('#evidenceFile'),false);
    });
    function showDateRed()
    {
        jQuery.ajax(
        {
            url: "{{ url('ins/getdate') }}",
            method: 'get',
            data:{name:'casc'},
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
            success: function(r){
                console.log(r)
                flatpickr("#nfechaIns", {
                    dateFormat: "Y-m-d",
                    onDayCreate: function (dObj, dStr, fp, dayElem) {
                        // itera sobre las fechas que necesito resaltar
                        r.data.forEach(function (date) {
                            if (dayElem.dateObj.toISOString().slice(0, 10) === date)
                                dayElem.classList.add('highlighted-day');
                        });
                    },
                });
            },
            error: function (xhr, status, error) {
                msgImportant({'state':false,'message':'Algo salio mal, porfavor contactese con el Administrador.'})
                $('.overlayAllPage').css("display","none")
            }
        });
    }
    function loadFile(ele,ban)
    {
        if(ban)
        {
            let nameFile = $(ele).val().split('\\').pop();
            if (/\.(pdf)$/i.test(nameFile))
            {
                $(ele).parent().find('.nameFile').html($(ele).attr('data-name')+': '+nameFile);
                // $(ele).parent().find('.msgClick').remove();
                $(ele).parent().find('.msgClick').css('display','none');
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
            $(ele).parent().find('.nameFile').html('ARCHIVO DE EVIDENCIAS');
            $(ele).parent().find('.msgClick').css('display','block');
            $(ele).parent().find('i').removeClass('fa fa-file-pdf fa-lg');
            $(ele).parent().find('i').addClass('fa fa-upload fa-lg');
            $(ele).parent().find('.boxFile').css('border','4px dashed #000');
            $(ele).val('');
        }
    }
    function buildTable()
    {
        $('.containerRecords>div').remove();
        $('.containerRecords').html(tableRecords);
    }
    function searchName()
    {
        if(isEmpty($('#userSearch').val()))
            msgImportantShow('Advertencia!','Ingrese el nombre y apellidos','warning')
        $('.overlayAllPage').css("display","flex");
        jQuery.ajax(
        {
            url: "{{ url('format2/searchName') }}",
            method: 'post',
            data:{name:$('#userSearch').val()},
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
            success: function(r){
                clearForm()
                buildTable();
                if(r.state)
                {
                    let html
                    for (var i = 0; i < r.data.length; i++)
                    {
                        html += '<tr class="'+r.data[i].InscriNro+'">' +
                            '<td class="align-middle">(' + novDato(r.data[i].PreMzn) + '-' + novDato(r.data[i].PreLote) +') '+ novDato(r.data[i].InscriNro) + '</td>' +
                            '<td class="align-middle">' + novDato(r.data[i].Clilelx) + ' ' + novDato(r.data[i].Clinomx) + '</td>' +
                            '<td class="align-middle">' + novDato(r.data[i].CalTip) + ' ' + novDato(r.data[i].CalDes) + '</td>' +
                            '<td class="align-middle text-center">' +
                                '<div class="btn-group btn-group-sm" role="group">'+
                                    '<button type="button" class="btn text-info f4" title="Formato 4" ondblclick="userSelected(\''+r.data[i].InscriNro+'\');"><i class="fa fa-hand-pointer"></i> Elegir</button>'+
                                '</div>'+
                            '</td>' +
                        '</tr>';
                    }
                    $('#data').html(html);
                    initDatatable('records');
                    $('#searchResultsModal').modal('show')
                }
                else
                    msgImportantShow(r.message,'','warning')
                $('.overlayAllPage').css("display","none");
            },
            error: function (xhr, status, error) {
                msgImportant({'state':false,'message':'Algo salio mal, porfavor contactese con el Administrador.'})
                $('.overlayAllPage').css("display","none")
            }
        });
    }
    function userSelected(ins)
    {
        $('.overlayAllPage').css("display","flex");
        jQuery.ajax(
        {
            url: "{{ url('format2/searchIns') }}",
            method: 'post',
            data:{ins:ins},
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
            success: function(r){
                clearForm()
                if(r.state)
                {
                    let arrayName = r.data.Clinomx.split(',')
                    let nameAp = arrayName[0].split(' ')
                    let name = arrayName[1].trim()
                    $('#codRec').val(r.codRec)
                    $('#suministro').val(r.data.PreMzn+'-'+r.data.PreLote)
                    $('.dptelefono ').val(r.data.Clitelx)
                    $('#nombres').val(name)
                    $('#app').val(nameAp[0].trim())
                    $('#apm').val(nameAp[1].trim())
                    $('#numIde').val(r.data.Clilelx.trim())
                    $('.urbanizacion').val(r.data.CalTip+' '+r.data.CalDes)
                    $('#searchResultsModal').modal('hide')
                }
                else
                    msgImportantShow(r.message,'','error')
                $('.overlayAllPage').css("display","none");
            },
            error: function (xhr, status, error) {
                msgImportant({'state':false,'message':'Algo salio mal, porfavor contactese con el Administrador.'})
                $('.overlayAllPage').css("display","none")
            }
        });
    }
    function searchData()
    {
        // if(isEmpty($('#dins').val()) && isEmpty($('#dmzn').val()) && isEmpty($('#dlote').val()))
        if((isEmpty($('#dins').val()) && isEmpty($('#dmzn').val()) && isEmpty($('#dlote').val())) ||
            (isEmpty($('#dins').val()) && !isEmpty($('#dmzn').val()) && isEmpty($('#dlote').val())) ||
            (isEmpty($('#dins').val()) && isEmpty($('#dmzn').val()) && !isEmpty($('#dlote').val())))
            msgImportantShow('Advertencia!','Ingrese la informacion','warning')
        $('.overlayAllPage').css("display","flex");
        jQuery.ajax(
        {
            url: "{{ url('format2/searchData') }}",
            method: 'post',
            data:{inscription:$('#dins').val(),preMzn:$('#dmzn').val(),preLote:$('#dlote').val()},
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
            success: function(r){
                clearForm()
                // 00193808
                let arrayName,name,app,apm;
                if(r.state)
                {
                    // let clinomx = String(r.data.Clinomx); // Asegurarse de que sea una cadena
                    // let arrayName;
                    // let name = '', app = '', apm = '';

                    // if (clinomx.includes(',')) {
                    //     // Caso con coma
                    //     arrayName = clinomx.split(',');
                    //     let nameAp = arrayName[0].trim().split(' ');
                    //     name = arrayName[1].trim();
                    //     app = nameAp[0] ? nameAp[0].trim() : '';
                    //     apm = nameAp[1] ? nameAp[1].trim() : '';
                    // } else {
                    //     // Caso sin coma
                    //     arrayName = clinomx.trim().split(' ');
                    //     app = arrayName[0] ? arrayName[0].trim() : '';
                    //     apm = arrayName[1] ? arrayName[1].trim() : '';
                    //     name = arrayName.slice(2).join(' '); // El resto de la cadena
                    // }

                    // // Asignar valores a los inputs
                    // $('#codRec').val(r.codRec);
                    // $('#suministro').val(r.data.PreMzn + '-' + r.data.PreLote);
                    // $('.dptelefono').val(r.data.Clitelx);
                    // $('#nombres').val(name);
                    // $('#app').val(app);
                    // $('#apm').val(apm);
                    // $('#numIde').val(r.data.Clilelx.trim());
                    // $('.urbanizacion').val(r.data.CalTip + ' ' + r.data.CalDes);
                    try
                    {
                        let clinomx = String(r.data.Clinomx); // Asegurarse de que sea una cadena
                        let arrayName;
                        let name = '', app = '', apm = '';

                        if (clinomx.includes(',')) {
                            // Caso con coma
                            arrayName = clinomx.split(',');
                            let nameAp = arrayName[0].trim().split(' ');
                            name = arrayName[1].trim();
                            app = nameAp[0] ? nameAp[0].trim() : '';
                            apm = nameAp[1] ? nameAp[1].trim() : '';
                        } else {
                            // Caso sin coma
                            arrayName = clinomx.trim().split(' ');
                            app = arrayName[0] ? arrayName[0].trim() : '';
                            apm = arrayName[1] ? arrayName[1].trim() : '';
                            name = arrayName.slice(2).join(' '); // El resto de la cadena
                        }

                        // Asignar valores a los inputs relacionados con el nombre
                        $('#nombres').val(name);
                        $('#app').val(app);
                        $('#apm').val(apm);

                    } catch (error) {
                        console.error('Error procesando el nombre:', error);
                        // Puedes asignar valores predeterminados si ocurre un error
                        $('#nombres').val('');
                        $('#app').val('');
                        $('#apm').val('');
                    }

                    // Continuar con el resto del código
                    $('#codRec').val(r.codRec);
                    $('#suministro').val(r.data.PreMzn + '-' + r.data.PreLote);
                    $('.dptelefono').val(r.data.Clitelx);
                    $('#numIde').val(r.data.Clilelx.trim());
                    $('.urbanizacion').val(r.data.CalTip + ' ' + r.data.CalDes);


                }
                else
                    msgImportantShow('Usuario: '+$('#dins').val()+' '+$('#dmzn').val()+'-'+$('#dlote').val(),'No se encontro al usuario','warning')
                $('.overlayAllPage').css("display","none");
            },
            error: function (xhr, status, error) {
                msgImportant({'state':false,'message':'Algo salio mal, porfavor contactese con el Administrador.'})
                $('.overlayAllPage').css("display","none")
            }
        });
    }
    function clearForm()
    {
        $('.input').val('');
        $('#tipoReclamo').val(0)
        $('#meses').val(null).trigger('change');
        $('input[name="sendNotify"][value="1"]').prop('checked', true);
        $('input[name="sendBooklet"][value="1"]').prop('checked', true);
        $('input[name="sendReclaim"][value="1"]').prop('checked', true);

        $('#upp,#upd,#dpp,#dpd').val('Abancay');
        $('#dpcp').val('03001');
    }
    function fillReclaimWeb()
    {
        jQuery.ajax({
            url: "{{ url('format2/fillReclaimWeb') }}",
            method: 'POST',
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
            success: function (r) {
                let name;
                $.each(r.data,function(indice,fila){
                    name = fila.nombres+' '+fila.app+' '+fila.apm;
                    $('#claims').append("<option value='"+fila.pnumIns+"'>"+fila.pnumIns+' | '+name+' | Tipo reclamo: '+fila.tipoReclamo+"</option>");
                });
                $('#claims').select2();
            },
            error: function (xhr, status, error) {
                msgImportant({'state':false,'message':'Algo salio mal, porfavor contactese con el Administrador.'})
            }
        });
    }
    function validateForm()
    {
        if(isEmpty($('#codRec').val()) || isEmpty($('#suministro').val()))
        {msgImportantShow('Seleccione o busque un registro de conexion.','Advertencia','warning');return true;}
        if(isEmpty($('#meses').val()))
        {msgImportantShow('Seleccione los meses de reclamo.','Advertencia','warning');return true;}
        if($('#fvclaim').valid()==false) {return true;}
        if(!according && (isEmpty($('#nfechaIns').val()) || isEmpty($('#nhourInsInicio').val()) || isEmpty($('#nhourInsFin').val())))
        {msgImportantShow('Seleccione la fecha de inspeccion.','Advertencia','warning');return true;}
        if(!according && $('#evidenceFile')[0].files.length==0)
        {msgImportantShow("No se subio ningun archivo.",'Reclamo','warning');return true;}
        return false;

    }
    function saveClaim()
    {
        if(validateForm())
        {return;}
        var formData = new FormData($("#fvclaim")[0]);
        formData.append('codRec', $('#codRec').val());
        formData.append('suministro', $('#suministro').val());
        formData.append('atendido', $('#atendido').val());
        formData.append('according', according);

        $('.saveClaim').prop('disabled',true);
        $('.oveCard').css("display","flex");
        jQuery.ajax({
            url: "{{ url('format2/saveClaim') }}",
            method: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
            success: function (r) {
                console.log(r)
                if (r.state)
                {
                    clearForm()
                    $('#fvclaim').find('.form-control').removeClass('is-valid is-invalid')
                    msgImportant(r)
                }
                else
                {
                    msgImportant(r)
                }
                $('.oveCard').css("display","none");
                $('.saveClaim').prop('disabled',false);
            },
            error: function (xhr, status, error) {
                alert("Algo salio mal, porfavor contactese con el Administrador.");
                $('.oveCard').css("display","none");
                $('.saveClaim').prop('disabled',false);
            }
        });
    }
    function searchReclaim()
    {
        // alert('aki e')
        if(isEmpty($('#claims').val()))
            msgImportantShow('Advertencia!','Seleccione reclamo','warning')
        $('.overlayAllPage').css("display","flex");
        jQuery.ajax(
        {
            url: "{{ url('format2/searchReclaim') }}",
            method: 'post',
            data:{dataSearch:$('#claims').val()},
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
            success: function(r){
                clearForm()
                // $('#idFo2').val(r.fo2.idFo2)
                $('#codRec').val(r.fo2.codRec)
                $('#nombres').val(r.fo2.nombres)
                $('#app').val(r.fo2.app)
                $('#apm').val(r.fo2.apm)
                $('#numIde').val(r.fo2.numIde)
                $('.dptelefono').val(r.fo2.dptelefono)
                $('#dpcorreo').val(r.fo2.dpcorreo)
                if (r.fo2.declaracionReclamo == '0')
                    $('#sendNotifyNo').prop('checked', true)
                else
                    $('#sendNotifySi').prop('checked', true)
                $('#tipoReclamo').val(r.fo2.tipoReclamo)
                $('#meses').val(r.fo2.pmeses.split(",")).trigger('change');
                $('#fundamento').val(r.fo2.fundamento)
                var ttt ='<a class="btn btn-link" target="_blank" href="'+'{{ route('detalle-archivo') }}/'+r.fo2.idFo2+'"><i class="fa fa-file-pdf"></i> Ver evidencias cargadas por el usuario</a>';
                $('.containerEvidence').html(ttt)
                if (r.fo2.declaracion == '0')
                    $('#sendReclaimNo').prop('checked', true)
                else
                    $('#sendReclaimSi').prop('checked', true)
                $('#dateIns').val(r.ins.dateIns)
                $('#dateIns').prop('disabled', true);
                // $('.hourInspection').html(r.ins.startTime+'-'+r.ins.endTime)
                $('#startTime').val(r.ins.startTime+'-'+r.ins.endTime)
                $('#startTime').prop('disabled', true);
                $('#suministro').val(r.data.PreMzn+'-'+r.data.PreLote)
                $('.urbanizacion').val(r.data.CalTip+' '+r.data.CalDes)

                $('.changeInspections').css("display","inline");
                $('.overlayAllPage').css("display","none");
                $('.oveCard').css("display","none");

                // $.each(r.data,function(indice,fila){
                //     $('#reclaimPortal').append("<option value='"+fila.idFo2+"'>"+fila.app+' '+fila.apm+' '+fila.nombres+"</option>");
                // });
                // $('#reclaimPortal').select2();

            }
        });
    }
    // esta funcion ya no sirve
    $('.save').on('click',function(){save();});
    function save()
    {
        if($('#fvclaim').valid()==false)
        {return;}
        var formData = new FormData($("#fvclaim")[0]);
        $('.save').prop('disabled',true);
        $('.overlayRegistros').css("display","flex");
        jQuery.ajax({
            url: "{{ url('format2/savePortal') }}",
            method: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
            success: function (r) {
                console.log(r)
                // if (r.estado)
                //     redirectUrlMsj("{{url('cotizacion/ver')}}",r.message);
                // else
                // {
                //     $('.overlayRegistros').css("display","none");
                //     msjRee(r);
                // }
                // $('.guardar').prop('disabled',false);
            },
            error: function (xhr, status, error) {
                alert("Algo salio mal, porfavor contactese con el Administrador.");
            }
        });
    }
    function rules()
    {
        return {
            nombres: {required: true,},
            app: {required: true,},
            apm: {required: true,},
            numIde: {required: true,},
            upcjb: {required: true,},
            upub: {required: true,},
            upp: {required: true,},
            upd: {required: true,},
            dpcja: {required: true,},
            dpub: {required: true,},
            dpp: {required: true,},
            dpd: {required: true,},
            dpcp: {required: true,},
            dptelefono: {required: true,},
            // dpcorreo: {required: true,},
            tipoReclamo: {required: true,},
            descripcion: {required: true,},
            sucursal: {required: true,},
            fundamento: {required: true,},
            reunion: {required: true,},
            horaReunion: {required: true,},
            notificacion: {required: true,},
        };
    }
</script>

@endsection
