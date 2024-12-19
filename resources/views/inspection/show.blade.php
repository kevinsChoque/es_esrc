@extends('layout.layout')
@section('nombreContenido', '----')
@section('pageTitle')
{{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2-bootstrap4.min.css" rel="stylesheet"> --}}

<div class="content-header pb-0 pt-2">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"><h1 class="m-0">Inspecciones</h1></div>
            <div class="col-sm-6">
                <a href="{{url('format2/form')}}" class="btn btn-success float-right"><i class="fa fa-plus"></i> Nueva reclamo</a>
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
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="overlay overlayRegistros" style="display: none;">
                    <div class="spinner"></div>
                </div>
                <div class="card-header border-transparent py-2">
                    <h3 class="card-title m-0 font-weight-bold"><i class="fa fa-chart-bar"></i> Lista de reclamos</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 containerRecords table-responsive" style="display: none;">
                            <table id="records" class="table table-hover table-striped table-bordered dt-responsive nowrap">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="text-center" data-priority="3">Cod.reclamo</th>
                                        <th class="text-center" data-priority="4">Num.suministro</th>
                                        <th class="text-center" data-priority="4">Reclamante</th>
                                        <th class="text-center" data-priority="4">Ubicacion del predio</th>
                                        <th class="text-center" data-priority="4">Tipo</th>
                                        <th class="text-center" data-priority="4">Inspeccion</th>
                                        <th class="text-center" data-priority="4">Estado</th>
                                        <th class="text-center" data-priority="4">Formatos</th>
                                        <th class="text-center" data-priority="1">Opc.</th>
                                    </tr>
                                </thead>
                                <tbody id="data">
                                </tbody>
                                <tfoot class="thead-light">
                                    <tr>
                                        <th class="text-center" data-priority="3">Cod.reclamo</th>
                                        <th class="text-center" data-priority="4">Num.suministro</th>
                                        <th class="text-center" data-priority="4">Reclamante</th>
                                        <th class="text-center" data-priority="4">Ubicacion del predio</th>
                                        <th class="text-center" data-priority="4">Tipo</th>
                                        <th class="text-center" data-priority="4">Inspeccion</th>
                                        <th class="text-center" data-priority="4">Estado</th>
                                        <th class="text-center" data-priority="4">Formatos</th>
                                        <th class="text-center" data-priority="1">Opc.</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="modal fade" id="mf5" tabindex="-1" role="dialog" aria-labelledby="mf5Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="overlay olF5" style="display: none;">
                <div class="spinner"></div>
            </div>
            <div class="modal-header">
                <h5 class="modal-title" id="mf5Label">FORMATO 5: Resumen del acta de inspeccion interna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="fvf5">
                    <input type="hidden" class="f5idFo2" id="f5idFo2">
                    <input type="hidden" class="f5ins" id="f5ins">
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="f5date" class="m-0">Fecha de la inspeccion: <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text font-weight-bold"><i class="fa fa-hashtag"></i></span>
                                </div>
                                <input type="date" name="f5date" id="f5date" class="form-control input">
                            </div>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="f5hora" class="m-0">Hora: <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text font-weight-bold"><i class="fa fa-clock"></i></span>
                                </div>
                                <input type="time" name="f5hora" id="f5hora" class="form-control input">
                            </div>
                        </div>
                        <div class="form-group col-lg-12">
                            <label for="f5obs" class="m-0">Observaciones: <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text font-weight-bold"><i class="fa fa-arrow-right"></i></span>
                                </div>
                                <textarea name="f5obs" id="f5obs" class="form-control input" rows="3" placeholder="Ingrese la observacion aki . . ."></textarea>
                            </div>
                        </div>
                        <div class="px-1 conteinerMessageF5">
                            <div class="row">
                                <div class="col-lg-9 mb-1">
                                    <div class="callout callout-warning py-2">
                                        <h5 class="font-weight-bold">Ten en cuenta!</h5>
                                        <p>Este formato es para resumir el acta
                                            de inspeccion interna, en caso de actualizar el formato 5, subo otro archivo el cual reemplazara el actual.</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 mb-1 d-flex justify-content-center align-items-center">
                                    <a class="btn btn-link py-1 font-weight-bold linkFileF5" target="_blank" href=""><i class="fa fa-file"></i> Formato 5</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <div class="alert text-center boxFile h-100 d-flex flex-column justify-content-center" style="border: 4px dashed #000;background: #ebeff5;">
                                <h5 class="font-italic font-weight-bold m-auto nameFile">ARCHIVO DE FORMATO 5</h5>
                                <p class="font-italic m-0 msgClick">Realiza click aki, para subir el archivo</p>
                                <p class="m-auto"><i class="fa fa-upload fa-2x"></i></p>
                            </div>
                            <input type="file" id="f5file" name="f5file" class="pdfFile" style="display: none;" data-name="ARCHIVO DE FORMATO 5">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary saveF5">Guardar formato 5</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="mf6" tabindex="-1" role="dialog" aria-labelledby="mf6Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="overlay olF6" style="display: none;">
                <div class="spinner"></div>
            </div>
            <div class="modal-header">
                <h5 class="modal-title" id="mf6Label">FORMATO 6: Resumen del acta de inspeccion externa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="fvf6">
                    <input type="hidden" class="f6idFo2" id="f6idFo2">
                    <input type="hidden" class="f6ins" id="f6ins">
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="f6date" class="m-0">Fecha de la inspeccion: <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text font-weight-bold"><i class="fa fa-hashtag"></i></span>
                                </div>
                                <input type="date" name="f6date" id="f6date" class="form-control input">
                            </div>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="f6hora" class="m-0">Hora: <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text font-weight-bold"><i class="fa fa-clock"></i></span>
                                </div>
                                <input type="time" name="f6hora" id="f6hora" class="form-control input">
                            </div>
                        </div>
                        <div class="form-group col-lg-12">
                            <label for="f6obs" class="m-0">Observaciones: <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text font-weight-bold"><i class="fa fa-arrow-right"></i></span>
                                </div>
                                <textarea name="f6obs" id="f6obs" class="form-control input" rows="3" placeholder="Ingrese la observacion aki . . ."></textarea>
                            </div>
                        </div>
                        <div class="px-1 conteinerMessageF6">
                            <div class="row">
                                <div class="col-lg-9 mb-1">
                                    <div class="callout callout-warning py-2">
                                        <h5 class="font-weight-bold">Ten en cuenta!</h5>
                                        <p>Este formato es para resumir el acta
                                            de inspeccion interna, en caso de actualizar el formato 5, subo otro archivo el cual reemplazara el actual.</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 mb-1 d-flex justify-content-center align-items-center">
                                    <a class="btn btn-link py-1 font-weight-bold linkFileF6" target="_blank" href=""><i class="fa fa-file"></i> Formato 6</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <div class="alert text-center boxFile h-100 d-flex flex-column justify-content-center" style="border: 4px dashed #000;background: #ebeff5;">
                                <h5 class="font-italic font-weight-bold m-auto nameFile">ARCHIVO DE FORMATO 6</h5>
                                <p class="font-italic m-0 msgClick">Realiza click aki, para subir el archivo</p>
                                <p class="m-auto"><i class="fa fa-upload fa-2x"></i></p>
                            </div>
                            <input type="file" id="f6file" name="f6file" class="pdfFile" style="display: none;" data-name="ARCHIVO DE FORMATO 6">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary saveF6">Guardar formato 6</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="mf7" tabindex="-1" role="dialog" aria-labelledby="mf7Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="overlay olF7" style="display: none;">
                <div class="spinner"></div>
            </div>
            <div class="modal-header">
                <h5 class="modal-title" id="mf7Label">FORMATO 7: Solicitud de contrastacion de medidor de agua potable</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="fvf7">
                    <input type="hidden" class="f7idFo2" id="f7idFo2">
                    <input type="hidden" class="f7ins" id="f7ins">
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="f7date" class="m-0">Fecha de la inspeccion: <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text font-weight-bold"><i class="fa fa-hashtag"></i></span>
                                </div>
                                <input type="date" name="f7date" id="f7date" class="form-control input">
                            </div>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="f7hora" class="m-0">Hora: <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text font-weight-bold"><i class="fa fa-clock"></i></span>
                                </div>
                                <input type="time" name="f7hora" id="f7hora" class="form-control input">
                            </div>
                        </div>
                        <div class="form-group col-lg-12">
                            <label for="f7obs" class="m-0">Observaciones: <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text font-weight-bold"><i class="fa fa-arrow-right"></i></span>
                                </div>
                                <textarea name="f7obs" id="f7obs" class="form-control input" rows="3" placeholder="Ingrese la observacion aki . . ."></textarea>
                            </div>
                        </div>
                        {{-- <div class="px-1 conteinerMessageF7">
                            <div class="row">
                                <div class="col-lg-9 mb-1">
                                    <div class="callout callout-warning py-2">
                                        <h5 class="font-weight-bold">Ten en cuenta!</h5>
                                        <p>Este formulario es para resumir la solicitud de contrastacion, en caso de actualizar el formato 7, subo otro archivo el cual reemplazara el actual.</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 mb-1 d-flex justify-content-center align-items-center">
                                    <a class="btn btn-link py-1 font-weight-bold linkFileF7" target="_blank" href=""><i class="fa fa-file"></i> Formato 7</a>
                                </div>
                            </div>
                        </div> --}}
                        {{-- <div class="col-lg-12 mb-3">
                            <div class="alert text-center boxFile h-100 d-flex flex-column justify-content-center" style="border: 4px dashed #000;background: #ebeff5;">
                                <h5 class="font-italic font-weight-bold m-auto nameFile">ARCHIVO DE FORMATO 7</h5>
                                <p class="font-italic m-0 msgClick">Realiza click aki, para subir el archivo</p>
                                <p class="m-auto"><i class="fa fa-upload fa-2x"></i></p>
                            </div>
                            <input type="file" id="f7file" name="f7file" class="pdfFile" style="display: none;" data-name="ARCHIVO DE FORMATO 7">
                        </div> --}}
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary saveF7">Guardar formato 7</button>
            </div>
        </div>
    </div>
</div>
<script>
    localStorage.setItem("sbd",0);
    localStorage.setItem("sba",2);
    var tableRecords;
    // console.log("{{ Storage::url('format5/20241001_173405_M-O_Inteligencia_artificial_esp_(1).pdf') }}")
    $(document).ready( function () {
        // $('.containerRecords').css('display','block');
        // cascç
        tableRecords=$('.containerRecords').html();
        fillRecords();
        // $('.overlayPagina').css("display","none");
        $('.overlayAllPage').css("display","none");
    });
    $('.saveF5').on('click',function(){
        saveF5();
    })
    $('.saveF6').on('click',function(){
        saveF6();
    })
    function saveF5()
    {
        // console.log($('#f5idFo2').val())
        // alert($(ele).html())
        if(validateF5())
            return;
        var formData = new FormData($("#fvf5")[0]);
        formData.append('f5idFo2',$('#f5idFo2').val());
        formData.append('f5ins',$('#f5ins').val());

        $('.saveF5').prop('disabled',true);
        $('.olF5').css("display","flex");
        jQuery.ajax({
            url: "{{ url('format5/save') }}",
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
                    $('.saveF5').prop('disabled',false);
                    $('#mf5').modal('hide');
                    $('#f5idFo2').val()
                    $('.'+$('#f5idFo2').val()).find('.f5').html('<i class="fa fa-file"></i> F5');
                }
                msgForm(r);
                $('.olF5').css("display","none");
            },
            error: function (xhr, status, error) {
                alert("Algo salio mal, porfavor contactese con el Administrador.");
                console.log(error)
                $('.olF5').css("display","none");
                $('.saveF5').prop('disabled',false);
            }
        });
    }
    function saveF6()
    {
        // console.log($('#f5idFo2').val())
        // alert($(ele).html())
        if(validateF6())
            return;
        var formData = new FormData($("#fvf6")[0]);
        formData.append('f6idFo2',$('#f6idFo2').val());
        formData.append('f6ins',$('#f6ins').val());

        $('.saveF6').prop('disabled',true);
        $('.olF6').css("display","flex");
        jQuery.ajax({
            url: "{{ url('format6/save') }}",
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
                    $('.saveF6').prop('disabled',false);
                    $('#mf6').modal('hide');
                    $('#f6idFo2').val()
                    $('.'+$('#f6idFo2').val()).find('.f6').html('<i class="fa fa-file"></i> F6');
                }
                msgForm(r);
                $('.olF6').css("display","none");
            },
            error: function (xhr, status, error) {
                alert("Algo salio mal, porfavor contactese con el Administrador.");
                console.log(error)
                $('.olF6').css("display","none");
                $('.saveF6').prop('disabled',false);
            }
        });
    }
    function validateF5()
    {
        if($('#fvf5').valid()==false)
        {return true;}
        if($('#f5file')[0].files.length==0)
        {alert("No se subio el documento del formato 5.");return true;}
        return false;
    }
    function validateF6()
    {
        if($('#fvf6').valid()==false)
        {return true;}
        if($('#f6file')[0].files.length==0)
        {alert("No se subio el documento del formato 6.");return true;}
        return false;
    }
    function fillRecords()
    {
        $('.containerRecords').css('display','block');
        jQuery.ajax(
        {
            url: "{{ url('inspection/list') }}",
            method: 'get',
            success: function(r)
            {
                console.log(r)
                let html = '';
                let locationProperty;
                let inspection;
                // let formats;
                // let options;
                let iconoF5;
                let iconoF6;
                let change;
                let iconoF7;
                for (var i = 0; i < r.data.length; i++)
                {
                    locationProperty = r.data[i].upcjb+' '+r.data[i].upn+' '+r.data[i].upmz+' '+r.data[i].uplote;
                    inspection=r.data[i].dateIns+' | '+ r.data[i].startTime+' '+r.data[i].endTime;
                    // from = r.data[i].verify=='1'?'<pan class="badge badge-info">aprobado</span>':'<pan class="badge badge-warning">web</span>';
                    iconoF5 = r.data[i].idFo5===null?'plus':'file';
                    iconoF6 = r.data[i].idFo6===null?'plus':'file';
                    iconoF7 = r.data[i].idFo7===null?'plus':'file';

                    change = r.data[i].f5 == '1' && r.data[i].f6 == '1'?
                        '<button type="button" class="btn text-info py-0 pr-0" title="Enviar a conciliacion" onclick="changeProcess(\''+r.data[i].codRec+'\');"><i class="fa fa-edit"></i></button>':
                        '';
                        console.log(change)
                    // if(r.data[i].idFo5===null)
                    // {
                    //     options = '<button type="button" class="btn text-info f5" title="Formato 5" onclick="mf5(\''+r.data[i].idFo2+'\',\''+r.data[i].pnumIns+'\');"><i class="fa fa-plus"></i> F5</button>'+
                    //     '<button type="button" class="btn text-info f6" title="Formato 6" onclick="mf6(\''+r.data[i].idFo2+'\',\''+r.data[i].pnumIns+'\');"><i class="fa fa-plus"></i> F6</button>';
                    // }
                    // else
                    // {
                    //     options = '<button type="button" class="btn text-info f5" title="Formato 5" onclick="mf5(\''+r.data[i].idFo2+'\',\''+r.data[i].pnumIns+'\');"><i class="fa fa-file"></i> F5</button>'+
                    //     '<button type="button" class="btn text-info f6" title="Formato 6" onclick="mf6(\''+r.data[i].idFo2+'\',\''+r.data[i].pnumIns+'\');"><i class="fa fa-file"></i> F6</button>';
                    // }
                    html += '<tr class="'+r.data[i].idFo2+'">' +
                        '<td class="align-middle">' + novDato(r.data[i].codRec) + '</td>' +
                        '<td class="align-middle">' + recordsId(r.data[i]) + '</td>' +
                        '<td class="align-middle">' + userClaimant(r.data[i]) + '</td>' +
                        '<td class="align-middle">' + locationProperty +'</td>' +
                        '<td class="align-middle">' + novDato(r.data[i].tipoReclamo) +'</td>' +
                        '<td class="align-middle">' + inspection +'</td>' +
                        '<td class="align-middle">' +
                            '<span class="badge badge-info">Investigacion</span>'+change+
                        '</td>'+
                        '<td class="align-middle text-center">' +
                            '<a class="btn btn-secondary py-0 px-1 mr-1" target="_blank" href="'+'{{ route('f5') }}/'+r.data[i].idFo2+'"><i class="fa fa-file-pdf"></i> F5</a>' +
                            '<a class="btn btn-secondary py-0 px-1 mr-1" target="_blank" href="'+'{{ route('f6') }}/'+r.data[i].idFo2+'"><i class="fa fa-file-pdf"></i> F6</a>' +
                            '<a class="btn btn-secondary py-0 px-1" target="_blank" href="'+'{{ route('f7') }}/'+r.data[i].idFo2+'"><i class="fa fa-file-pdf"></i> F7</a>' +
                            // '<button class="btn btn-secondary py-0 px-1 mr-1"><i class="fa fa-file-pdf"></i> F5</button>' +
                            // '<button class="btn btn-secondary py-0 px-1 mr-1"><i class="fa fa-file-pdf"></i> F6</button>' +
                            // '<button class="btn btn-secondary py-0 px-1"><i class="fa fa-file-pdf"></i> F7</button>' +
                        '</td>' +
                        '<td class="align-middle text-center">' +
                            '<div class="btn-group btn-group-sm" role="group">'+

                                '<button type="button" class="btn text-info f5" title="Formato 5" onclick="mf5(\''+r.data[i].idFo2+'\',\''+r.data[i].pnumIns+'\');"><i class="fa fa-'+iconoF5+'"></i> F5</button>'+
                                '<button type="button" class="btn text-info f6" title="Formato 6" onclick="mf6(\''+r.data[i].idFo2+'\',\''+r.data[i].pnumIns+'\');"><i class="fa fa-'+iconoF6+'"></i> F6</button>'+
                                '<button type="button" class="btn text-info f7" title="Formato 7" onclick="mf7(\''+r.data[i].idFo2+'\',\''+r.data[i].pnumIns+'\');"><i class="fa fa-'+iconoF7+'"></i> F7</button>'+
                                // options+
                            '</div>'+
                        '</td>' +
                        '</tr>';
                }
                $('#data').html(html);
                initDatatable('records');
                $('.overlayRegistros').css('display','none');
            }
        });
    }
    function changeProcess(codRec)
    {
        event.preventDefault();
        Swal.fire({
        title: "Esta seguro de pasar el reclamo "+codRec+" a conciliacion?",
        text: "Confirme la accion",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, confirmar"
        }).then((result) => {
            if (result.isConfirmed)
            {
                $(".containerSpinner").removeClass("d-none");
                $(".containerSpinner").addClass("d-flex");
                jQuery.ajax({
                    url: "{{ url('inspection/changeProcess') }}",
                    method: 'POST',
                    data: {codRec: codRec},
                    dataType: 'json',
                    headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
                    success: function (r) {
                        console.log(r)
                        msgImportant(r)
                        buildTable();
                        fillRecords();
                    },
                    error: function (xhr, status, error) {
                        alert("Algo salio mal, porfavor contactese con el Administrador.");
                    }
                });
            }
        });
    }
    function buildTable()
    {
        $('.containerRecords>div').remove();
        $('.containerRecords').html(tableRecords);
    }
    function cleanF5()
    {
        $('#fvf5 .input').val('');
        loadFile($('#f5file'),false);
    }
    function cleanF6()
    {
        $('#fvf6 .input').val('');
        loadFile($('#f6file'),false);
    }
    function mf5(idFo2,ins)
    {
        cleanF5();
        jQuery.ajax({
            url: "{{ url('format5/f5') }}",
            method: 'POST',
            data: {idFo2:idFo2,ins:ins},
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
            success: function (r) {

                console.log('akita');
                console.log(r)
                $('.conteinerMessageF5').css('display','none');
                if(r.data!==null)
                {
                    $('#f5date').val(r.data.date);
                    $('#f5hora').val(r.data.hour);
                    $('#f5obs').val(r.data.obs);
                    $('.conteinerMessageF5').css('display','block');
                    // let href = $('.linkFileF5').attr("href");
                    let href = "{{ url('format5/file') }}"
                    $('.linkFileF5').attr("href",href+"/"+r.data.idFo5)
                    // alert(r.data.url)

                }
                $('#mf5').modal('show')
                $('#f5idFo2').val(idFo2)
                $('#f5ins').val(ins)
            },
            error: function (xhr, status, error) {
                alert("Algo salio mal, porfavor contactese con el Administrador.");
                console.log(error)
                $('.overlayForm').css("display","none");
            }
        });
    }
    function mf6(idFo2,ins)
    {
        cleanF6();
        jQuery.ajax({
            url: "{{ url('format6/f6') }}",
            method: 'POST',
            data: {idFo2:idFo2,ins:ins},
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
            success: function (r) {
                console.log('akita');
                console.log(r)
                $('.conteinerMessageF6').css('display','none');
                if(r.data!==null)
                {
                    $('#f6date').val(r.data.date);
                    $('#f6hora').val(r.data.hour);
                    $('#f6obs').val(r.data.obs);
                    $('.conteinerMessageF6').css('display','block');
                    // let href = $('.linkFileF5').attr("href");
                    let href = "{{ url('format6/file') }}"
                    $('.linkFileF6').attr("href",href+"/"+r.data.idFo6)
                    // alert(r.data.url)

                }
                $('#mf6').modal('show')
                $('#f6idFo2').val(idFo2)
                $('#f6ins').val(ins)
            },
            error: function (xhr, status, error) {
                alert("Algo salio mal, porfavor contactese con el Administrador.");
                console.log(error)
                $('.overlayForm').css("display","none");
            }
        });
    }
    function mf7(idFo2,ins)
    {
        $('#mf7').modal('show')
        // cleanF7();
        // jQuery.ajax({
        //     url: "{{ url('format7/f7') }}",
        //     method: 'POST',
        //     data: {idFo2:idFo2,ins:ins},
        //     dataType: 'json',
        //     headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
        //     success: function (r) {
        //         console.log('akita');
        //         console.log(r)
        //         $('.conteinerMessageF6').css('display','none');
        //         if(r.data!==null)
        //         {
        //             $('#f6date').val(r.data.date);
        //             $('#f6hora').val(r.data.hour);
        //             $('#f6obs').val(r.data.obs);
        //             $('.conteinerMessageF6').css('display','block');
        //             // let href = $('.linkFileF5').attr("href");
        //             let href = "{{ url('format6/file') }}"
        //             $('.linkFileF6').attr("href",href+"/"+r.data.idFo6)
        //             // alert(r.data.url)

        //         }
        //         $('#mf6').modal('show')
        //         $('#f6idFo2').val(idFo2)
        //         $('#f6ins').val(ins)
        //     },
        //     error: function (xhr, status, error) {
        //         alert("Algo salio mal, porfavor contactese con el Administrador.");
        //         console.log(error)
        //         $('.overlayForm').css("display","none");
        //     }
        // });
    }
    function userClaimant(reg)
    {
        return '<span class="badge badge-light"><i class="fa fa-id-card"></i> dni: '+reg.numIde+'</span><br>' +
        '<span class="badge badge-light"><i class="fa fa-user"></i> nombre: '+reg.nombres+' '+reg.app+' '+reg.apm+'</span>';
    }
    function recordsId(reg)
    {
        return '<span class="badge badge-light"><i class="fa fa-id-card"></i> Sum: '+reg.numSum+'</span><br>' +
        '<span class="badge badge-light"><i class="fa fa-user"></i> Ins: '+reg.pnumIns+'</span>';
    }

</script>
<script>
    $('.boxFile').on('click',function(){
        $(this).parent().find('input.pdfFile').click();
    });
    $('.pdfFile').on('change',function(){
        loadFile(this,true);
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
            $(ele).parent().find('.nameFile').html('ARCHIVO DE FORMATO');
            $(ele).parent().find('.msgClick').css('display','block');
            $(ele).parent().find('i').removeClass('fa fa-file-pdf fa-lg');
            $(ele).parent().find('i').addClass('fa fa-upload fa-lg');
            $(ele).parent().find('.boxFile').css('border','4px dashed #000');
            $(ele).val('');
        }
    }
</script>
@endsection
