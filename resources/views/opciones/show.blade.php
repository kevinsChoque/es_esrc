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
                    <input type="hidden" name="f9idPro" id="f9idPro">
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
                <p>aka tambien ingresar la resolucion el check box y creo q es mejor ingresar por documento uno a uno con el nombre y el plugin</p>
                <form id="fvf8">
                    <input type="hidden" name="f8idPro" id="f8idPro">
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
<script>
    localStorage.setItem("sbd",0);
    localStorage.setItem("sba",2);
    var tableRecords;
    $(document).ready( function () {
        // $('.containerRecords').css('display','block');
        tableRecords=$('.containerRecords').html();
        fillRecords();
        $('.overlayAllPage').css("display","none");
        initFv('fvf8',rules8());
        initFv('fvf9',rules9());
    });
    $('.saveF8').on('click',function(){saveF8();});
    $('.saveF9').on('click',function(){saveF9();});
    $('.showFormat8').on('click',function(e){showFormat8(e);});
    function showFormat8(e)
    {e.preventDefault();window.open('{{ route('f8') }}/' + $('#f8idFo2').val(), '_blank');}
    $('.showFormat9').on('click',function(e){showFormat9(e);});
    function showFormat9(e)
    {e.preventDefault();window.open('{{ route('f9') }}/' + $('#f9idFo2').val(), '_blank');}
    function rules9()
    {return {f9fundamento: {required: true,},};}
    function rules8()
    {return {f8fundamento: {required: true,},};}
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
    function saveF8()
    {
        if(validateF8())
            return;
        var formData = new FormData($("#fvf8")[0]);
        formData.append('f8idPro',$('#f8idPro').val());
        $('.saveF8').prop('disabled',true);
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
                    $('#reconsideracion').modal('hide');
                    let iconChange = '<span class="badge badge-info">En Reconsideracion</span> <button type="button" class="btn text-info py-0 pr-0" title="Declarar reclamo como" onclick="changeProcess(\''+r.f2.codRec+'\');"><i class="fa fa-edit"></i></button>';
                    $('.'+$('#f8idPro').val()).find('.containerState').html(iconChange);
                    $('.'+$('#f8idPro').val()).find('.apelar').remove();
                }
                msgForm(r);
                $('.overlayAllPage').css("display","none");
            },
            error: function (xhr, status, error) {
                alert("Algo salio mal, porfavor contactese con el Administrador.");
                console.log(error)
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
        formData.append('f9idPro',$('#f9idPro').val());
        $('.saveF9').prop('disabled',true);
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
                    let iconChange = '<span class="badge badge-info">En Apelacion</span>';
                    $('.'+$('#f9idPro').val()).find('.containerState').html(iconChange);
                    $('.'+$('#f9idPro').val()).find('.reconsideracion').remove();
                }
                msgForm(r);
                $('.overlayAllPage').css("display","none");
            },
            error: function (xhr, status, error) {
                alert("Algo salio mal, porfavor contactese con el Administrador.");
                console.log(error)
                $('.overlayAllPage').css("display","none");
                $('.saveF9').prop('disabled',false);
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
                let html = '';
                let change;
                let changeEnd;
                let opciones;
                let estadoReg;
                for (var i = 0; i < r.data.length; i++)
                {
                    change = '<button class="btn text-info py-0 pr-0" title="Declarar reclamo como" onclick="changeProcess(\''+r.data[i].idFo2+'\');"><i class="fa fa-edit"></i></button>';
                    changeEnd = '<button class="btn text-info py-0 pr-0" title="Declarar reclamo como" onclick="changeProcessEnd(\''+r.data[i].codRec+'\');"><i class="fa fa-edit"></i></button>';

                    if(r.data[i].idFo8===null && r.data[i].idFo9===null)
                    {
                        opciones = '<button class="btn text-info py-0 apelar" onclick="apelar(\''+r.data[i].idPro+'\');"><i class="fa fa-gavel"></i> Apelar</button><br>'+
                        '<button class="btn text-info py-0 reconsideracion" onclick="reconsideracion(\''+r.data[i].idPro+'\');"><i class="fa fa-retweet"></i> Reconsideracion</button>';
                        estadoReg = '<span class="badge badge-info">Finalizados</span> '+changeEnd;
                    }
                    else
                    {
                        opciones = r.data[i].idFo8===null?'<button class="btn text-info py-0 apelar" onclick="apelar(\''+r.data[i].idPro+'\');"><i class="fa fa-gavel"></i> Apelar</button><br>':
                        '<button class="btn text-info py-0 reconsideracion" onclick="reconsideracion(\''+r.data[i].idPro+'\');"><i class="fa fa-retweet"></i> Reconsideracion</button>';
                        estadoReg = (r.data[i].idFo8===null?'<span class="badge badge-info">En Apelacion</span>':'<span class="badge badge-info">En Reconsideracion</span>'+change);
                    }
                    html += '<tr class="'+r.data[i].idPro+'">' +
                        '<td class="align-middle">' + frecordsId(r.data[i]) + '</td>' +
                        '<td class="align-middle">' + fuserClaimant(r.data[i]) + '</td>' +
                        '<td class="align-middle">' + flocationPredio(r.data[i]) +'</td>' +
                        '<td class="align-middle">' + novDato(r.data[i].tipoReclamo) +'</td>' +
                        '<td class="align-middle">' + fdateInspection(r.data[i]) +'</td>' +
                        '<td class="align-middle text-center containerState">'+
                            estadoReg+
                        '</td>' +
                        '<td class="align-middle text-center">' +
                            opciones+
                        '</td>' +
                        '</tr>';
                }
                $('#data').html(html);
                initDatatable('records');
                $('.overlayRegistros').css('display','none');
            }
        });
    }
    function changeProcessEnd(codRec)
    {
        event.preventDefault();
        Swal.fire({
        title: "ESTA SEGURO EN CERRAR ESTE PROCESO DE RECLAMO?",
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
                    url: "{{ url('opciones/changeProcessEnd') }}",
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
    function changeProcess(idFo2)
    {
        event.preventDefault();
        Swal.fire({
            title: "Seleccione una acción para el registro",
            text: "Confirme su decisión",
            icon: "question",
            showCancelButton: true,
            showDenyButton: true,
            showConfirmButton: true,
            confirmButtonText: "Enviar a investigación",
            denyButtonText: "Solución rápida",
            cancelButtonText: "Cancelar",
            confirmButtonColor: "#3085d6",
            denyButtonColor: "#4caf50",
            cancelButtonColor: "#d33",
        }).then((result) => {
            if (result.isConfirmed) {
                // Acción para "Enviar a investigación"
                $(".containerSpinner").removeClass("d-none").addClass("d-flex");
                jQuery.ajax({
                    url: "{{ url('opciones/investigate') }}",
                    method: 'POST',
                    data: { idFo2: idFo2 },
                    dataType: 'json',
                    headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
                    success: function (r) {
                        console.log(r);
                        msgImportant(r);
                        buildTable();
                        fillRecords();
                    },
                    error: function (xhr, status, error) {
                        alert("Algo salió mal. Por favor contacte al administrador.");
                    },
                    complete: function () {
                        $(".containerSpinner").removeClass("d-flex").addClass("d-none");
                    }
                });
            } else if (result.isDenied) {
                // Acción para "Solución rápida"
                Swal.fire({
                    title: "Agregar comentario",
                    text: "Escriba un comentario para finalizar el reclamo:",
                    input: 'textarea',
                    inputPlaceholder: 'Escriba su comentario aquí...',
                    showCancelButton: true,
                    cancelButtonText: "Cancelar",
                    confirmButtonText: "Finalizar reclamo",
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    preConfirm: (comment) => {
                        if (!comment) {
                            Swal.showValidationMessage("El comentario no puede estar vacío.");
                        }
                        return comment;
                    }
                }).then((result) => {
                    if (result.isConfirmed)
                    {
                        $(".containerSpinner").removeClass("d-none").addClass("d-flex");
                        jQuery.ajax({
                            url: "{{ url('opciones/quickSolution') }}", // Cambia según la ruta
                            method: 'POST',
                            data: {
                                idFo2: idFo2,
                                comentario: result.value // Enviamos el comentario con la solicitud
                            },
                            dataType: 'json',
                            headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
                            success: function (r) {
                                console.log(r);
                                msgImportant(r);
                                buildTable();
                                fillRecords();
                            },
                            error: function (xhr, status, error) {
                                alert("Algo salió mal. Por favor contacte al administrador.");
                            },
                            complete: function () {
                                $(".containerSpinner").removeClass("d-flex").addClass("d-none");
                            }
                        });
                    }
                });
            }
        });
    }
    function cleanF9()
    {
        $('#fvf9 .input').val('');
        $('.conteinerMessageF9').css('display','none');
        loadFile($('#f9file'),false);
    }
    function cleanF8()
    {
        $('#fvf8 .input').val('');
        $('.conteinerMessageF8').css('display','none');
        loadFile($('#f8file'),false);
    }
    function apelar(idPro)
    {
        jQuery.ajax({
            url: "{{ url('format9/edit') }}",
            method: 'POST',
            data: {idPro:idPro},
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
                    $('#f9idPro').val(r.data.idPro)
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
    function reconsideracion(idPro)
    {
        jQuery.ajax({
            url: "{{ url('format8/edit') }}",
            method: 'POST',
            data: {idPro:idPro},
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
                    $('#f8idPro').val(r.data.idPro)
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
