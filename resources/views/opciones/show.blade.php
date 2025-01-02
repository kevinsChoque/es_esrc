@extends('layout.layout')
@section('nombreContenido', '----')
@section('pageTitle')
{{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2-bootstrap4.min.css" rel="stylesheet"> --}}

<div class="content-header pb-0 pt-2">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"><h1 class="m-0">Opciones de recursos</h1></div>
            <div class="col-sm-6">
                {{-- <a href="{{url('format2/form')}}" class="btn btn-success float-right"><i class="fa fa-plus"></i> Nueva reclamo</a> --}}
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
                                        {{-- <th class="text-center" data-priority="3">Cod.reclamo</th> --}}
                                        <th class="text-center" data-priority="4">Num.suministro</th>
                                        <th class="text-center" data-priority="4">Reclamante</th>
                                        <th class="text-center" data-priority="4">Ubicacion del predio</th>
                                        <th class="text-center" data-priority="4">Tipo</th>
                                        <th class="text-center" data-priority="4">Inspeccion</th>
                                        <th class="text-center" data-priority="4">Estado</th>
                                        <th class="text-center" data-priority="1">Opc.</th>
                                    </tr>
                                </thead>
                                <tbody id="data">
                                </tbody>
                                <tfoot class="thead-light">
                                    <tr>
                                        {{-- <th class="text-center" data-priority="3">Cod.reclamo</th> --}}
                                        <th class="text-center" data-priority="4">Num.suministro</th>
                                        <th class="text-center" data-priority="4">Reclamante</th>
                                        <th class="text-center" data-priority="4">Ubicacion del predio</th>
                                        <th class="text-center" data-priority="4">Tipo</th>
                                        <th class="text-center" data-priority="4">Inspeccion</th>
                                        <th class="text-center" data-priority="4">Estado</th>
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
<div class="modal fade" id="apelar" tabindex="-1" role="dialog" aria-labelledby="apelarLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="overlay olF4" style="display: none;">
                <div class="spinner"></div>
            </div>
            <div class="modal-header">
                <h5 class="modal-title" id="apelarLabel"><i class="fa fa-file"></i> FORMATO 9: Recurso de apelacion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="fvf9">
                    <input type="hidden" name="f9idFo2" id="f9idFo2">
                    {{-- <input type="hidden" name="f4ins" id="f4ins"> --}}
                    <div class="row">
                        <div class="col-lg-12">
                            {{-- <button class="btn btn-link px-0"><i class="fa fa-file-pdf"></i> Descargar formato 9</button> --}}
                            <button class="btn btn-link showFormat9 px-0"><i class="fa fa-file-pdf"></i> Descargar formato 9</button>
                        </div>
                        <div class="form-group col-lg-12">
                            <label for="f9fundamento" class="m-0">Propuesta de la empresa prestadora: <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text font-weight-bold"><i class="fa fa-clock"></i></span>
                                </div>
                                <textarea name="f9fundamento" id="f9fundamento" class="form-control input" rows="3" placeholder="Fundamento del recurso de apelacion ..."></textarea>
                            </div>
                        </div>
                        <div class="px-1 conteinerMessageF9">
                            <div class="row">
                                <div class="col-lg-9 mb-1">
                                    <div class="callout callout-warning py-2">
                                        <h5 class="font-weight-bold">Ten en cuenta!</h5>
                                        <p>Este formato es para resumir el Formato 9: Recurso de apelacion, en caso de actualizar, suba otro archivo el cual reemplazara el actual.</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 mb-1 d-flex justify-content-center align-items-center">
                                    <a class="btn btn-link py-1 font-weight-bold linkFileF9" target="_blank"><i class="fa fa-file"></i> Formato 9</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <div class="alert text-center boxFile h-100 d-flex flex-column justify-content-center" style="border: 4px dashed #000;background: #ebeff5;">
                                <h5 class="font-italic font-weight-bold m-auto nameFile">ARCHIVO DE FORMATO 4</h5>
                                <p class="font-italic m-0 msgClick">Realiza click aki, para subir el archivo</p>
                                <p class="m-auto"><i class="fa fa-upload fa-2x"></i></p>
                            </div>
                            <input type="file" id="f9file" name="f9file" class="pdfFile" style="display: none;" data-name="ARCHIVO DE FORMATO 9">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary saveF9"><i class="fa fa-save"></i> Guardar formato 9</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="reconsideracion" tabindex="-1" role="dialog" aria-labelledby="reconsideracionLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="overlay olF4" style="display: none;">
                <div class="spinner"></div>
            </div>
            <div class="modal-header">
                <h5 class="modal-title" id="reconsideracionLabel"><i class="fa fa-file"></i> FORMATO 8: Recurso de reconsideracion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="fvf8">
                    <input type="hidden" name="f8idFo2" id="f8idFo2">
                    {{-- <input type="hidden" name="f4ins" id="f4ins"> --}}
                    <div class="row">
                        <div class="col-lg-12">
                            {{-- <button class="btn btn-link px-0"><i class="fa fa-file-pdf"></i> Descargar formato 8</button> --}}
                            <button class="btn btn-link showFormat8 px-0"><i class="fa fa-file-pdf"></i> Descargar formato 8</button>
                        </div>
                        <div class="form-group col-lg-12">
                            <label for="f8fundamento" class="m-0">Propuesta de la empresa prestadora: <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text font-weight-bold"><i class="fa fa-clock"></i></span>
                                </div>
                                <textarea name="f8fundamento" id="f8fundamento" class="form-control input" rows="3" placeholder="Ingrese la propuesta aki . . ."></textarea>
                            </div>
                        </div>
                        <div class="px-1 conteinerMessageF8">
                            <div class="row">
                                <div class="col-lg-9 mb-1">
                                    <div class="callout callout-warning py-2">
                                        <h5 class="font-weight-bold">Ten en cuenta!</h5>
                                        <p>Este formato es para resumir el Formato 8: Recurso de reconsideracion, en caso de actualizar, suba otro archivo el cual reemplazara el actual.</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 mb-1 d-flex justify-content-center align-items-center">
                                    <a class="btn btn-link py-1 font-weight-bold linkFileF8" target="_blank"><i class="fa fa-file"></i> Formato 8</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <div class="alert text-center boxFile h-100 d-flex flex-column justify-content-center" style="border: 4px dashed #000;background: #ebeff5;">
                                <h5 class="font-italic font-weight-bold m-auto nameFile">ARCHIVO DE FORMATO 8</h5>
                                <p class="font-italic m-0 msgClick">Realiza click aki, para subir el archivo</p>
                                <p class="m-auto"><i class="fa fa-upload fa-2x"></i></p>
                            </div>
                            <input type="file" id="f8file" name="f8file" class="pdfFile" style="display: none;" data-name="ARCHIVO DE FORMATO 8">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary saveF8"><i class="fa fa-save"></i> Guardar formato 8</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="mLoadFile" tabindex="-1" role="dialog" aria-labelledby="mLoadFileLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="overlay olFile" style="display: none;">
                <div class="spinner"></div>
            </div>
            <div class="modal-header">
                <h5 class="modal-title" id="mLoadFileLabel"><i class="fa fa-file"></i> Subir formato 4</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="fvfile">
                    <input type="hidden" name="ff4idFo2" id="ff4idFo2">
                    <input type="hidden" name="ff4ins" id="ff4ins">
                    <div class="row">
                        <div class="px-1 conteinerMessageF4">
                            <div class="row">
                                <div class="col-lg-9 mb-1">
                                    <div class="callout callout-warning py-2">
                                        <h5 class="font-weight-bold">Ten en cuenta!</h5>
                                        <p>Este formato es para resumir el Acta
                                            de Reunion de Conciliacion, en caso de actualizar el formato 4, subo otro archivo el cual reemplazara el actual.</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 mb-1 d-flex justify-content-center align-items-center">
                                    <a class="btn btn-link py-1 font-weight-bold linkFileF4" target="_blank"><i class="fa fa-file"></i> Formato 4</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <div class="alert text-center boxFile h-100 d-flex flex-column justify-content-center" style="border: 4px dashed #000;background: #ebeff5;">
                                <h5 class="font-italic font-weight-bold m-auto nameFile">ARCHIVO DE FORMATO 4</h5>
                                <p class="font-italic m-0 msgClick">Realiza click aki, para subir el archivo</p>
                                <p class="m-auto"><i class="fa fa-upload fa-2x"></i></p>
                            </div>
                            <input type="file" id="f4file" name="f4file" class="pdfFile" style="display: none;" data-name="ARCHIVO DE FORMATO 4">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary saveF4File">Guardar archivo</button>
            </div>
        </div>
    </div>
</div>
<script>
    localStorage.setItem("sbd",0);
    localStorage.setItem("sba",2);
    var tableRecords;
    $(document).ready( function () {
        // $('.containerRecords').css('display','block');
        // cascç
        tableRecords=$('.containerRecords').html();
        fillRecords();
        $('.overlayAllPage').css("display","none");
        initFv('fvf8',rules8());
        initFv('fvf9',rules9());
    });
    $('.saveF8').on('click',function(){saveF8();});
    $('.saveF9').on('click',function(){saveF9();});
    $('.saveF4File').on('click',function(){
        saveF4File();
    });
    $('.showFormat8').on('click',function(e){showFormat8(e);});
    function showFormat8(e)
    {e.preventDefault();window.open('{{ route('f8') }}/' + $('#f8idFo2').val(), '_blank');}
    $('.showFormat9').on('click',function(e){showFormat9(e);});
    function showFormat9(e)
    {e.preventDefault();window.open('{{ route('f9') }}/' + $('#f9idFo2').val(), '_blank');}
    function rules9()
    {
        return {f9fundamento: {required: true,},};
    }
    function rules8()
    {
        return {f8fundamento: {required: true,},};
    }
    function validateF9()
    {
        if($('#fvf9').valid()==false)
        {return true;}
        if($('#f9file')[0].files.length==0)
        {alert("No se subio el documento del formato 9.");return true;}
        return false;
    }
    function validateF8()
    {
        if($('#fvf8').valid()==false)
        {return true;}
        if($('#f8file')[0].files.length==0)
        {alert("No se subio el documento del formato 8.");return true;}
        return false;
    }
    function validateFile()
    {
        if($('#f4file')[0].files.length==0)
        {alert("No se subio el documento del formato 4.");return true;}
        return false;
    }
    function saveF4()
    {
        // console.log($('#f5idFo2').val())
        // alert($(ele).html())
        if(validateF4())
            return;
        var formData = new FormData($("#fvf9")[0]);
        formData.append('f4idFo2',$('#f4idFo2').val());
        formData.append('f4ins',$('#f4ins').val());

        $('.saveF4').prop('disabled',true);
        $('.olF4').css("display","flex");
        jQuery.ajax({
            url: "{{ url('format4/save') }}",
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
                    $('.saveF4').prop('disabled',false);
                    $('#mf4').modal('hide');
                    $('#f4idFo2').val()
                    $('.'+$('#f4idFo2').val()).find('.f4').html('<i class="fa fa-file"></i> F4');
                }
                msgForm(r);
                $('.olF4').css("display","none");
            },
            error: function (xhr, status, error) {
                alert("Algo salio mal, porfavor contactese con el Administrador.");
                console.log(error)
                $('.olF4').css("display","none");
                $('.saveF4').prop('disabled',false);
            }
        });
    }
    function saveF8()
    {
        if(validateF8())
            return;
        var formData = new FormData($("#fvf8")[0]);
        formData.append('f8idFo2',$('#f8idFo2').val());
        // formData.append('f4ins',$('#f4ins').val());
        $('.saveF8').prop('disabled',true);
        // $('.olF4').css("display","flex");
        $('.overlayAllPage').css("display","flex");
        jQuery.ajax({
            url: "{{ url('format8/save') }}",
            method: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
            success: function (r) {
                if (r.state)
                {
                    $('.saveF8').prop('disabled',false);
                    $('#apelar').modal('hide');
                    // $('#f4idFo2').val()
                    // $('.'+$('#f4idFo2').val()).find('.f4').html('<i class="fa fa-file"></i> F4');
                }
                msgForm(r);
                $('.overlayAllPage').css("display","none");
            },
            error: function (xhr, status, error) {
                alert("Algo salio mal, porfavor contactese con el Administrador.");
                console.log(error)
                // $('.olF4').css("display","none");
                $('.overlayAllPage').css("display","none");
                $('.saveF8').prop('disabled',false);
            }
        });
    }
    function saveF9()
    {
        if(validateF9())
            return;
        var formData = new FormData($("#fvf9")[0]);
        formData.append('f9idFo2',$('#f9idFo2').val());
        // formData.append('f4ins',$('#f4ins').val());
        $('.saveF9').prop('disabled',true);
        // $('.olF4').css("display","flex");
        $('.overlayAllPage').css("display","flex");
        jQuery.ajax({
            url: "{{ url('format9/save') }}",
            method: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
            success: function (r) {
                if (r.state)
                {
                    $('.saveF9').prop('disabled',false);
                    $('#apelar').modal('hide');
                    // $('#f4idFo2').val()
                    // $('.'+$('#f4idFo2').val()).find('.f4').html('<i class="fa fa-file"></i> F4');
                }
                msgForm(r);
                $('.overlayAllPage').css("display","none");
            },
            error: function (xhr, status, error) {
                alert("Algo salio mal, porfavor contactese con el Administrador.");
                console.log(error)
                // $('.olF4').css("display","none");
                $('.overlayAllPage').css("display","none");
                $('.saveF9').prop('disabled',false);
            }
        });
    }
    function saveF4File()
    {
        // console.log($('#f5idFo2').val())
        // alert($(ele).html())
        if(validateFile())
            return;
        var formData = new FormData($("#fvfile")[0]);
        // formData.append('f4idFo2',$('#ff4idFo2').val());
        // formData.append('f4ins',$('#ff4ins').val());

        $('.saveF4File').prop('disabled',true);
        $('.olFile').css("display","flex");
        jQuery.ajax({
            url: "{{ url('format4/saveFile') }}",
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
                    $('.saveF4File').prop('disabled',false);
                    $('#mLoadFile').modal('hide');
                    // $('#ff4idFo2').val()
                    // $('.'+$('#ff4idFo2').val()).find('.f4').html('<i class="fa fa-file"></i> F4');
                }
                msgForm(r);
                $('.olFile').css("display","none");
            },
            error: function (xhr, status, error) {
                alert("Algo salio mal, porfavor contactese con el Administrador.");
                console.log(error)
                $('.olFile').css("display","none");
                $('.saveF4File').prop('disabled',false);
            }
        });
    }

    function fillRecords()
    {
        $('.containerRecords').css('display','block');
        jQuery.ajax(
        {
            url: "{{ url('opciones/list') }}",
            method: 'get',
            success: function(r)
            {
                console.log(r)
                let html = '';
                let locationProperty;
                let inspection;
                // let formats;
                // let options;
                let iconoF4;
                let iconoF6;
                let change;
                let opciones;
                let estadoReg;
                for (var i = 0; i < r.data.length; i++)
                {
                    locationProperty = r.data[i].upcjb+' '+r.data[i].upn+' '+r.data[i].upmz+' '+r.data[i].uplote;
                    inspection=r.data[i].dateIns+' | '+ r.data[i].startTime+' '+r.data[i].endTime;

                    iconoF4 = r.data[i].idFo4===null?'plus':'file';
                    iconLoad = r.data[i].idFo4===null?'':'<button type="button" class="btn text-info f4" title="Subir Formato 4" onclick="mfile(\''+r.data[i].idFo2+'\',\''+r.data[i].pnumIns+'\');"><i class="fa fa-upload"></i></button>';
                    change = r.data[i].f4 == '1'?
                        '<button type="button" class="btn text-info py-0 pr-0" title="Declarar reclamo como" onclick="changeProcess(\''+r.data[i].codRec+'\');"><i class="fa fa-edit"></i></button>':
                        '';
                    change = '<button type="button" class="btn text-info py-0 pr-0" title="Declarar reclamo como" onclick="changeProcess(\''+r.data[i].codRec+'\');"><i class="fa fa-edit"></i></button>';

                    if(r.data[i].idFo8===null && r.data[i].idFo9===null)
                    {
                        opciones = '<button type="button" class="btn text-info py-0" onclick="apelar(\''+r.data[i].idFo2+'\');"><i class="fa fa-gavel"></i> Apelar</button><br>'+
                        '<button type="button" class="btn text-info py-0" onclick="reconsideracion(\''+r.data[i].idFo2+'\');"><i class="fa fa-retweet"></i> Reconsideracion</button>';
                        estadoReg = '<span class="badge badge-info">Finalizados</span>';
                    }
                    else
                    {
                        opciones = r.data[i].idFo8===null?'<button type="button" class="btn text-info py-0" onclick="apelar(\''+r.data[i].idFo2+'\');"><i class="fa fa-gavel"></i> Apelar</button><br>':
                        '<button type="button" class="btn text-info py-0" onclick="reconsideracion(\''+r.data[i].idFo2+'\');"><i class="fa fa-retweet"></i> Reconsideracion</button>';
                        estadoReg = (r.data[i].idFo8===null?'<span class="badge badge-info">En Apelacion</span>':'<span class="badge badge-info">En Reconsideracion</span>')+change;
                    }
                    html += '<tr class="'+r.data[i].idFo2+'">' +
                        // '<td class="align-middle">' + novDato(r.data[i].codRec) + '</td>' +
                        '<td class="align-middle">CR: ' + novDato(r.data[i].codRec)+'<br>'+recordsId(r.data[i]) + '</td>' +
                        '<td class="align-middle">' + userClaimant(r.data[i]) + '</td>' +
                        '<td class="align-middle">' + locationProperty +'</td>' +
                        '<td class="align-middle">' + novDato(r.data[i].tipoReclamo) +'</td>' +
                        '<td class="align-middle">' + inspection +'</td>' +
                        '<td class="align-middle text-center">'+
                            // '<span class="badge badge-info">Finalizar</span>'+change+
                            // '<span class="badge badge-info">Finalizados</span>'+
                            estadoReg+
                        '</td>' +
                        '<td class="align-middle text-center">' +
                            // '<div class="btn-group btn-group-sm" role="group">'+
                                // '<button type="button" class="btn text-info f4" title="Formato 4" onclick="mf4(\''+r.data[i].idFo2+'\',\''+r.data[i].pnumIns+'\');"><i class="fa fa-'+iconoF4+'"></i> F4</button>'+
                                // iconLoad +

                                // '<button type="button" class="btn text-info py-0" onclick="apelar(\''+r.data[i].idFo2+'\');"><i class="fa fa-gavel"></i> Apelar</button><br>'+
                                // '<button type="button" class="btn text-info py-0" onclick="reconsideracion(\''+r.data[i].idFo2+'\');"><i class="fa fa-retweet"></i> Reconsideracion</button>'+
                                opciones+
                                // '<button type="button" class="btn text-info" title="Descargar resolucion"><i class="fa fa-download"></i></button>'+
                                // '<button type="button" class="btn text-info f4" title="Subir Formato 4" onclick="mfile(\''+r.data[i].idFo2+'\',\''+r.data[i].pnumIns+'\');"><i class="fa fa-upload"></i></button>'+
                            // '</div>'+
                        '</td>' +
                        '</tr>';
                }
                $('#data').html(html);
                initDatatable('records');
                $('.overlayRegistros').css('display','none');
            }
        });
    }
    // function changeProcess(codRec)
    // {
    //     event.preventDefault();

    //     Swal.fire({
    //         title: "El reclamo se declara como:",
    //         input: "select",
    //         inputOptions: {
    //             fundado: "Reclamo FUNDADO",
    //             infundado: "Reclamo INFUNDADO",
    //             reconsideracion: "Solicito RECONSIDERACION",
    //         },
    //         inputPlaceholder: "Seleccione estado del reclamo",
    //         showCancelButton: true,
    //         inputValidator: (value) => {
    //             return new Promise((resolve) =>
    //             {
    //                 if (value === "fundado" || value === "infundado" || value === "reconsideracion")
    //                 {
    //                     // alert('send')
    //                     $(".containerSpinner").removeClass("d-none");
    //                     $(".containerSpinner").addClass("d-flex");
    //                     jQuery.ajax({
    //                         url: "{{ url('format4/changeProcess') }}",
    //                         method: 'POST',
    //                         data: {state: value, codRec:codRec},
    //                         dataType: 'json',
    //                         headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
    //                         success: function (r) {
    //                             console.log(r)
    //                             msgImportant(r)
    //                             // buildTable();
    //                             // fillRecords();
    //                         },
    //                         error: function (xhr, status, error) {alert("Algo salio mal, porfavor contactese con el Administrador.");}
    //                     });
    //                     Swal.fire(`El reclamo se cambio a: un estado`);
    //                 }
    //                 else
    //                     resolve("Seleccione un estado del reclamo");
    //             });
    //         }
    //     });
    //     // if (fruit)
    //     // {
    //     //     Swal.fire(`El reclamo se cambio a: ${fruit}`);
    //     // }
    // }
    function changeProcess(codRec)
    {
        event.preventDefault();
        Swal.fire({
        title: "Esta seguro de actualizar el estado del registro?",
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
                    url: "{{ url('desicion/changeProcess') }}",
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
            // else
                // $(ele).prop('checked', false);
        });
    }
    function download()
    {
        alert('descargando formato4')
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
    function cleanF9()
    {
        console.log('entro  a f9')
        $('#fvf9 .input').val('');
        $('.conteinerMessageF9').css('display','none');
        loadFile($('#f9file'),false);
    }
    function cleanF8()
    {
        console.log('entro  a f8')
        $('#fvf8 .input').val('');
        $('.conteinerMessageF8').css('display','none');
        loadFile($('#f8file'),false);
    }
    function apelar(idFo2)
    {
        jQuery.ajax({
            url: "{{ url('format9/edit') }}",
            method: 'POST',
            data: {idFo2:idFo2},
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
            success: function (r) {
                cleanF9()
                if(r.state)
                {
                    if(!isEmpty(r.data.url))
                    {
                        $('.conteinerMessageF9').css('display','block');
                        let href = "{{ url('format9/file') }}"
                        $('.linkFileF9').attr("href",href+"/"+r.data.idFo9)
                    }
                    $('#f9idFo2').val(r.data.idFo2)
                    $('#f9fundamento').val(r.data.fundamento)
                }

                $('#apelar').modal('show')
            },
            error: function (xhr, status, error) {
                alert("Algo salio mal, porfavor contactese con el Administrador.");
                console.log(error)
                $('.overlayForm').css("display","none");
            }
        });

    }
    function reconsideracion(idFo2)
    {
        // alert('ver reconsideracion')
        // $('#reconsideracion').modal('show')
        jQuery.ajax({
            url: "{{ url('format8/edit') }}",
            method: 'POST',
            data: {idFo2:idFo2},
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
            success: function (r) {
                cleanF8()
                if(r.state)
                {
                    if(!isEmpty(r.data.url))
                    {
                        $('.conteinerMessageF8').css('display','block');
                        let href = "{{ url('format8/file') }}"
                        $('.linkFileF8').attr("href",href+"/"+r.data.idFo8)
                    }
                    $('#f8idFo2').val(r.data.idFo2)
                    $('#f8fundamento').val(r.data.fundamento)
                }
                $('#reconsideracion').modal('show')
            },
            error: function (xhr, status, error) {
                alert("Algo salio mal, porfavor contactese con el Administrador.");
                console.log(error)
                $('.overlayForm').css("display","none");
            }
        });
    }
    function mfile(idFo2,ins)
    {
        jQuery.ajax({
            url: "{{ url('format4/f4') }}",
            method: 'POST',
            data: {idFo2:idFo2,ins:ins},
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
            success: function (r) {
                $('.conteinerMessageF4').css('display','none');
                if(!isEmpty(r.data.url))
                {
                    $('.conteinerMessageF4').css('display','block');
                    let href = "{{ url('format4/file') }}"
                    $('.linkFileF4').attr("href",href+"/"+r.data.idFo4)
                }
                $('#mLoadFile').modal('show')
                $('#ff4idFo2').val(idFo2)
                $('#ff4ins').val(ins)
            },
            error: function (xhr, status, error) {
                alert("Algo salio mal, porfavor contactese con el Administrador.");
                console.log(error)
                $('.overlayForm').css("display","none");
            }
        });
    }
    function mf4(idFo2,ins)
    {
        // $('#mf4').modal('show')
        // $('#f4idFo2').val(idFo2)
        // $('#f4ins').val(ins)
        cleanF4();
        jQuery.ajax({
            url: "{{ url('format4/f4') }}",
            method: 'POST',
            data: {idFo2:idFo2,ins:ins},
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
            success: function (r) {
                // $('.conteinerMessageF4').css('display','none');
                if(r.data!==null)
                {
                    $('#hourStart').val(r.data.hourStart);
                    $('#hourEnd').val(r.data.hourEnd);
                    $('#proEps').val(r.data.proEps);
                    $('#proRec').val(r.data.proRec);
                    $('#agreement').val(r.data.agreement);
                    $('#disagreement').val(r.data.disagreement);
                    // $('.conteinerMessageF4').css('display','block');
                    // let href = "{{ url('format5/file') }}"
                    // $('.linkFileF5').attr("href",href+"/"+r.data.idFo5)
                }
                $('#mf4').modal('show')
                $('#f4idFo2').val(idFo2)
                $('#f4ins').val(ins)
            },
            error: function (xhr, status, error) {
                alert("Algo salio mal, porfavor contactese con el Administrador.");
                console.log(error)
                $('.overlayForm').css("display","none");
            }
        });
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