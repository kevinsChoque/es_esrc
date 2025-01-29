@extends('layout.layout')
@section('nombreContenido', '----')
@section('pageTitle')
{{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2-bootstrap4.min.css" rel="stylesheet"> --}}

<div class="content-header pb-0 pt-2">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"><h1 class="m-0">Conciliaciones</h1></div>
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
                                        {{-- <th class="text-center" data-priority="4">Num.suministro</th> --}}
                                        <th class="text-center" data-priority="4">Reclamante</th>
                                        <th class="text-center" data-priority="4">Ubicacion del predio</th>
                                        <th class="text-center" data-priority="4">Tipo</th>
                                        <th class="text-center" data-priority="4">Inspeccion</th>
                                        <th class="text-center" data-priority="4">Desde</th>
                                        <th class="text-center" data-priority="4">Formatos</th>
                                        <th class="text-center" data-priority="1">Opc.</th>
                                    </tr>
                                </thead>
                                <tbody id="data">
                                </tbody>
                                <tfoot class="thead-light">
                                    <tr>
                                        <th class="text-center" data-priority="3">Cod.reclamo</th>
                                        {{-- <th class="text-center" data-priority="4">Num.suministro</th> --}}
                                        <th class="text-center" data-priority="4">Reclamante</th>
                                        <th class="text-center" data-priority="4">Ubicacion del predio</th>
                                        <th class="text-center" data-priority="4">Tipo</th>
                                        <th class="text-center" data-priority="4">Inspeccion</th>
                                        <th class="text-center" data-priority="4">Desde</th>
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
<div class="modal fade" id="mf4" tabindex="-1" role="dialog" aria-labelledby="mf4Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="overlay olF4" style="display: none;">
                <div class="spinner"></div>
            </div>
            <div class="modal-header">
                <h5 class="modal-title" id="mf4Label"><i class="fa fa-file"></i> FORMATO 4: Acta de reunion de conciliacion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="fvf4">
                    <input type="hidden" name="f4idPro" id="f4idPro">
                    <input type="hidden" name="f4ins" id="f4ins">
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="hourStart" class="m-0">Hora de inicio: <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text font-weight-bold"><i class="fa fa-hashtag"></i></span>
                                </div>
                                <input type="time" name="hourStart" id="hourStart" class="form-control input">
                            </div>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="hourEnd" class="m-0">Hora de termino: <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text font-weight-bold"><i class="fa fa-hashtag"></i></span>
                                </div>
                                <input type="time" name="hourEnd" id="hourEnd" class="form-control input">
                            </div>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="proEps" class="m-0">Propuesta de la empresa prestadora: <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text font-weight-bold"><i class="fa fa-clock"></i></span>
                                </div>
                                <textarea name="proEps" id="proEps" class="form-control input" rows="3" placeholder="Ingrese la propuesta aki . . ."></textarea>
                            </div>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="proRec" class="m-0">Propuesta del reclamante: <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text font-weight-bold"><i class="fa fa-arrow-right"></i></span>
                                </div>
                                <textarea name="proRec" id="proRec" class="form-control input" rows="3" placeholder="Ingrese la propuesta aki . . ."></textarea>
                            </div>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="agreement" class="m-0">Puntos de acuerdo: <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text font-weight-bold"><i class="fa fa-clock"></i></span>
                                </div>
                                <textarea name="agreement" id="agreement" class="form-control input" rows="3" placeholder="Ingrese la propuesta aki . . ."></textarea>
                            </div>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="disagreement" class="m-0">Puntos de desacuerdo: <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text font-weight-bold"><i class="fa fa-arrow-right"></i></span>
                                </div>
                                <textarea name="disagreement" id="disagreement" class="form-control input" rows="3" placeholder="Ingrese la propuesta aki . . ."></textarea>
                            </div>
                        </div>
                        {{-- <div class="px-1 conteinerMessageF4">
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
                        </div> --}}
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary saveF4">Guardar formato 4</button>
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
                    <input type="hidden" name="ff4idPro" id="ff4idPro">
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
        initFv('fvf4',rules());
    });
    $('.saveF4').on('click',function(){
        saveF4();
    });
    $('.saveF4File').on('click',function(){
        saveF4File();
    });
    function rules()
    {
        return {
            hourStart: {required: true,},
            hourEnd: {required: true,},
            proEps: {required: true,},
            proRec: {required: true,},
            agreement: {required: true,},
            disagreement: {required: true,},
            subsists: {required: true,},
        };
    }
    function validateF4()
    {
        if($('#fvf4').valid()==false)
        {return true;}
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
        if(validateF4())
            return;
        var formData = new FormData($("#fvf4")[0]);
        formData.append('f4idPro',$('#f4idPro').val());
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
                if (r.state)
                {
                    $('.saveF4').prop('disabled',false);
                    $('#mf4').modal('hide');
                    $('.'+$('#f4idPro').val()).find('.f4').html('<i class="fa fa-file"></i> F4');
                    let iconLoad = '<button class="btn text-info" title="Subir Formato 4" onclick="mfile(\''+$('#f4idPro').val()+'\',\''+$('#f4ins').val()+'\');"><i class="fa fa-upload"></i></button>'
                    $('.'+$('#f4idPro').val()).find('.f4').parent().parent().append(iconLoad)
                    let iconF4 = '<a class="btn btn-secondary py-0 px-1 mr-1" target="_blank" href="'+'{{ route('f4') }}/'+$('#f4idPro').val()+'"><i class="fa fa-file-pdf"></i> F4</a>';
                    $('.'+$('#f4idPro').val()).find('.containerDownload').html(iconF4)
                    let iconChange = '<span class="badge badge-info">Conciliacion</span><button class="btn text-info py-0 pr-0" onclick="changeProcess(\''+$('#f4idPro').val()+'\');"><i class="fa fa-edit"></i></button>';
                    $('.'+$('#f4idPro').val()).find('.containerChangeState').html(iconChange)
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
                    loadFile($('#f4file'),false);
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
            url: "{{ url('format4/list') }}",
            method: 'get',
            success: function(r)
            {
                let html = '';
                let iconoF4;
                let iconoF6;
                let change;
                for (var i = 0; i < r.data.length; i++)
                {
                    iconoPdf = r.data[i].idFo4===null?'-':'<a class="btn btn-secondary py-0 px-1 mr-1" target="_blank" href="'+'{{ route('f4') }}/'+r.data[i].idPro+'"><i class="fa fa-file-pdf"></i> F4</a>';
                    iconoF4 = r.data[i].idFo4===null?'plus':'file';
                    iconLoad = r.data[i].idFo4===null?'':'<button class="btn text-info" title="Subir Formato 4" onclick="mfile(\''+r.data[i].idPro+'\',\''+r.data[i].pnumIns+'\');"><i class="fa fa-upload"></i></button>';
                    change = r.data[i].f4 == '1'
                        ?'<button type="button" class="btn text-info py-0 pr-0" title="Declarar reclamo como" onclick="changeProcess(\''+r.data[i].idPro+'\');"><i class="fa fa-edit"></i></button>'
                        :'';
                    html += '<tr class="'+r.data[i].idPro+'">' +
                        '<td class="align-middle">' + frecordsId(r.data[i]) + '</td>' +
                        '<td class="align-middle">' + fuserClaimant(r.data[i]) + '</td>' +
                        '<td class="align-middle">' + flocationPredio(r.data[i]) +'</td>' +
                        '<td class="align-middle text-center">' + novDato(r.data[i].tipoReclamo) +'</td>' +
                        '<td class="align-middle">' + fdateInspection(r.data[i]) +'</td>' +
                        '<td class="align-middle text-center containerChangeState">'+
                            '<span class="badge badge-info">Conciliacion</span>'+change+
                        '</td>' +
                        '<td class="align-middle text-center containerDownload">' +
                            iconoPdf +
                        '</td>' +
                        '<td class="align-middle text-center">' +
                            '<div class="btn-group btn-group-sm" role="group">'+
                                '<button type="button" class="btn text-info f4" title="Formato 4" onclick="mf4(\''+r.data[i].idPro+'\',\''+r.data[i].pnumIns+'\');"><i class="fa fa-'+iconoF4+'"></i> F4</button>'+
                                iconLoad +
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
    function changeProcess(idPro)
    {
        event.preventDefault();
        Swal.fire({
            title: "El reclamo se declara como:",
            input: "select",
            inputOptions: {
                fundado: "Reclamo FUNDADO",
                infundado: "Reclamo INFUNDADO",
            },
            inputPlaceholder: "Seleccione estado del reclamo",
            showCancelButton: true,
            inputValidator: (value) => {
                return new Promise((resolve) =>
                {
                    if (value === "fundado" || value === "infundado" || value === "reconsideracion")
                    {
                        $(".containerSpinner").removeClass("d-none");
                        $(".containerSpinner").addClass("d-flex");
                        jQuery.ajax({
                            url: "{{ url('format4/changeProcess') }}",
                            method: 'POST',
                            data: {stateConciliation: value, idPro:idPro},
                            dataType: 'json',
                            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
                            success: function (r) {
                                msgImportant(r)
                                buildTable();
                                fillRecords();
                            },
                            error: function (xhr, status, error) {alert("Algo salio mal, porfavor contactese con el Administrador.");}
                        });
                        Swal.fire(`El reclamo se cambio a: un estado`);
                    }
                    else
                        resolve("Seleccione un estado del reclamo");
                });
            }
        });
        // if (fruit)
        // {
        //     Swal.fire(`El reclamo se cambio a: ${fruit}`);
        // }
    }
    function buildTable()
    {
        $('.containerRecords>div').remove();
        $('.containerRecords').html(tableRecords);
    }
    // function download()
    // {
    //     alert('descargando formato4')
    // }
    // function userClaimant(reg)
    // {
    //     return '<span class="badge badge-light"><i class="fa fa-id-card"></i> dni: '+reg.numIde+'</span><br>' +
    //     '<span class="badge badge-light"><i class="fa fa-user"></i> nombre: '+reg.nombres+' '+reg.app+' '+reg.apm+'</span>';
    // }
    // function recordsId(reg)
    // {
    //     return '<span class="badge badge-light"><i class="fa fa-id-card"></i> Sum: '+reg.numSum+'</span><br>' +
    //     '<span class="badge badge-light"><i class="fa fa-user"></i> Ins: '+reg.pnumIns+'</span>';
    // }
    function cleanF4()
    {
        $('#fvf4 .input').val('');
        // loadFile($('#f5file'),false);
    }
    function mfile(idPro,ins)
    {
        jQuery.ajax({
            url: "{{ url('format4/f4') }}",
            method: 'POST',
            data: {idPro:idPro,ins:ins},
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
            success: function (r) {
                console.log(r)
                $('.conteinerMessageF4').css('display','none');
                if(!isEmpty(r.data.url))
                {
                    $('.conteinerMessageF4').css('display','block');
                    let href = "{{ url('format4/file') }}"
                    $('.linkFileF4').attr("href",href+"/"+r.data.idFo4)
                }
                $('#mLoadFile').modal('show')
                $('#ff4idPro').val(idPro)
                $('#ff4ins').val(ins)
            },
            error: function (xhr, status, error) {
                alert("Algo salio mal, porfavor contactese con el Administrador.");
                console.log(error)
                $('.overlayForm').css("display","none");
            }
        });
    }
    function mf4(idPro,ins)
    {
        cleanF4();
        jQuery.ajax({
            url: "{{ url('format4/f4') }}",
            method: 'POST',
            data: {idPro:idPro,ins:ins},
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
                $('#f4idPro').val(idPro)
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
