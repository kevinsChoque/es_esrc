@extends('layout.layout')
@section('nombreContenido', '----')
@section('pageTitle')
{{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2-bootstrap4.min.css" rel="stylesheet"> --}}
<div class="content-header pb-0 pt-2">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"><h1 class="m-0">Editar reclamo</h1></div>
            <div class="col-sm-6">
                <a href="{{url('format2/form')}}" class="btn btn-success float-right ml-1"><i class="fa fa-plus"></i> Nuevo reclamo</a>
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
                            <input type="file" id="evidenceFileReg" name="evidenceFileReg" style="display: none;">

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
                    <td colspan="3" class="align-middle"><strong style="font-size: .8rem">
                        <a class="btn btn-link p-0 changeInspections"><i class="fa fa-edit fa-2x text-info"></i></a>
                         INSPECCION INTERNA Y EXTERNA, FECHA:</strong>
                    </td>
                    <td colspan="5" class="align-middle p-1"><input type="date" name="dateIns" id="dateIns" class="form-control w-100 input" disabled></td>
                    <td colspan="2" class="align-middle"><strong style="font-size: .8rem">HORA (RANGO DE 2 HORAS):</strong></td>
                    <td colspan="2" class="align-middle p-1">
                        {{-- <span class="badge badge-info hourInspection"></span> --}}
                        <input type="text" name="startTime" id="startTime" class="form-control w-100 input" disabled>
                    </td>
                </tr>
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
            <button type="button" class="btn btn-success w-100 saveChangeClaim">Guardar Cambios del Reclamo</button>
        </div>
    </div>
</div>
@include('format2.changeInspection')
<script>
    localStorage.setItem("sbd",0);
    localStorage.setItem("sba",2);
    var tableRecords;
    $(document).ready( function () {
        tableRecords=$('.containerRecords').html();
        // $('.overlayPagina').css("display","none");
        $('.oveCard').css("display","none");
        loadClaim();
        initFv('fvclaim',rules());
        $('#meses').select2({
            placeholder: 'Selecciona los meses',
            allowClear: true,
        });
    });
    $('.saveChangeClaim').on('click',function(){saveChangeClaim()})
    $('.boxFile').on('click',function(){$(this).parent().find('input.pdfFile').click();})
    $('.pdfFile').on('change',function(){
        loadFile(this,true);
    });
    $('.cleanEvidence').on('click',function(){
        loadFile($('#evidenceFile'),false);
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
    function loadClaim()
    {
        jQuery.ajax({
            url: "{{ url('format2/loadClaim') }}",
            method: 'POST',
            data: { codRec: localStorage.getItem('codRec') },
            dataType: 'json',
            headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
            success: function (r) {
                $('#codRec').val(r.data.codRec)
                $('#suministro').val(r.data.numSum)
                $('#nombres').val(r.data.nombres)
                $('#app').val(r.data.app)
                $('#apm').val(r.data.apm)
                $('#numIde').val(r.data.numIde)
                $('#razonSocial').val(r.data.razonSocial)
                $('#upcjb').val(r.data.upcjb)
                $('#upn').val(r.data.upn)
                $('#upmz').val(r.data.upmz)
                $('#uplote').val(r.data.uplote)
                $('#upub').val(r.data.upub)
                $('#upp').val(r.data.upp)
                $('#upd').val(r.data.upd)
                $('#dpcja').val(r.data.dpcja)
                $('#dpn').val(r.data.dpn)
                $('#dpmz').val(r.data.dpmz)
                $('#dplote').val(r.data.dplote)
                $('#dpub').val(r.data.dpub)
                $('#dpp').val(r.data.dpp)
                $('#dpd').val(r.data.dpd)
                $('#dpcp').val(r.data.dpcp)
                $('#dptelefono').val(r.data.dptelefono)
                $('#dpcorreo').val(r.data.dpcorreo)
                if (r.data.declaracionReclamo == '0')
                    $('#sendNotifyNo').prop('checked', true)
                else
                    $('#sendNotifySi').prop('checked', true)
                $('#tipoReclamo').val(r.data.tipoReclamo)
                $('#meses').val(r.data.pmeses.split(",")).trigger('change');
                $('#descripcion').val(r.data.descripcion)
                $('#sucursal').val(r.data.sucursal)
                $('#atendido').val(r.data.atendido)
                $('#fundamento').val(r.data.fundamento)
                let link ='<a class="btn btn-link" target="_blank" href="'+'{{ route('detalle-archivo') }}/'+r.data.idFo2+'"><i class="fa fa-file-pdf"></i> Ver evidencias cargadas por el usuario</a>';
                $('.containerEvidence').append(link)
                if (r.data.declaracion == '0')
                    $('#sendReclaimNo').prop('checked', true)
                else
                    $('#sendReclaimSi').prop('checked', true)
                $('#dateIns').val(r.ins.dateIns)
                $('#startTime').val(r.ins.startTime+'-'+r.ins.endTime)
                $('#reunion').val(r.data.reunion)
                $('#horaReunion').val(r.data.horaReunion)
                $('#notificacion').val(r.data.notificacion)
                if (r.pdf)
                {
                    const pdfBlob = new Blob([Uint8Array.from(atob(r.pdf), c => c.charCodeAt(0))], { type: 'application/pdf' });
                    const pdfUrl = URL.createObjectURL(pdfBlob);
                    const link = `<a class="btn btn-link pdfReg" target="_blank" href="${pdfUrl}"><i class="fa fa-file-pdf"></i> Ver PDF</a>`;
                    $('.containerEvidence').append(link);
                    // Asignar el archivo al input file si existe en el DOM
                    const fileInput = document.getElementById('evidenceFileReg');
                    if (fileInput)
                    {
                        const dataTransfer = new DataTransfer();
                        const file = new File([pdfBlob], "archivo.pdf", { type: "application/pdf" });
                        dataTransfer.items.add(file);
                        fileInput.files = dataTransfer.files;
                    }
                    else
                        console.warn('El input con ID evidenceFileReg no se encontró en el DOM.');
                }
                $('.overlayAllPage').css("display", "none");
            },
            error: function (xhr, status, error) {
                console.error('Error en la carga de datos:', error);
                msgImportant({ 'state': false, 'message': 'Algo salió mal, por favor contáctese con el Administrador.' });
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
        return false;

    }
    function saveChangeClaim()
    {
        if(validateForm())
        {return;}
        var formData = new FormData($("#fvclaim")[0]);
        formData.append('codRec', $('#codRec').val());
        formData.append('suministro', $('#suministro').val());
        formData.append('atendido', $('#atendido').val());
        // formData.append('according', according);

        $('.saveChangeClaim').prop('disabled',true);
        $('.oveCard').css("display","flex");
        jQuery.ajax({
            url: "{{ url('format2/saveChangeClaim') }}",
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
                    // clearForm()
                    // $('#fvclaim').find('.form-control').removeClass('is-valid is-invalid')
                    Swal.fire({
                        title: r.message,
                        text: 'Haz clic para ir a otra página',
                        icon: 'success',
                        confirmButtonText: 'Lista de reclamos',
                        allowOutsideClick: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '{{ url('format2/show') }}'
                        }
                    });
                    // msgImportant(r)
                }
                else
                {
                    msgImportant(r)
                }
                // $('.oveCard').css("display","none");
                // $('.saveChangeClaim').prop('disabled',false);
            },
            error: function (xhr, status, error) {
                alert("Algo salio mal, porfavor contactese con el Administrador.");
                $('.oveCard').css("display","none");
                $('.saveChangeClaim').prop('disabled',false);
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
