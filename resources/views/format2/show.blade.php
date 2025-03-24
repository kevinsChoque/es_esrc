@extends('layout.layout')
@section('nombreContenido', '----')
@section('pageTitle')
{{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2-bootstrap4.min.css" rel="stylesheet"> --}}

<div class="content-header pb-0 pt-2">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"><h1 class="m-0">Reclamos</h1></div>
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
                    <h3 class="card-title m-0 font-weight-bold"><i class="fa fa-chart-bar"></i> Lista de formato 2</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 containerRecords table-responsive" style="display: none;">
                            <table id="records" class="table table-hover table-striped table-bordered dt-responsive nowrap">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="text-center" data-priority="3">Identificador</th>
                                        {{-- <th class="text-center" data-priority="4">Num.suministro</th> --}}
                                        <th class="text-center" data-priority="4">Reclamante</th>
                                        <th class="text-center" data-priority="4">Ubicacion del predio</th>
                                        <th class="text-center" data-priority="4">Tipo</th>
                                        <th class="text-center" data-priority="4">Inspeccion</th>
                                        <th class="text-center" data-priority="4">Conciliacion</th>
                                        <th class="text-center" data-priority="4">Resolucion</th>
                                        <th class="text-center" data-priority="4">Desde</th>
                                        <th class="text-center" data-priority="4">Formatos</th>
                                        <th class="text-center" data-priority="1">Opc.</th>
                                    </tr>
                                </thead>
                                <tbody id="data">
                                </tbody>
                                <tfoot class="thead-light">
                                    <tr>
                                        <th class="text-center" data-priority="3">Identificador</th>
                                        {{-- <th class="text-center" data-priority="4">Num.suministro</th> --}}
                                        <th class="text-center" data-priority="4">Reclamante</th>
                                        <th class="text-center" data-priority="4">Ubicacion del predio</th>
                                        <th class="text-center" data-priority="4">Tipo</th>
                                        <th class="text-center" data-priority="4">Inspeccion</th>
                                        <th class="text-center" data-priority="4">Conciliacion</th>
                                        <th class="text-center" data-priority="4">Resolucion</th>
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
<div class="modal fade" id="mFileFormat2" tabindex="-1" role="dialog" aria-labelledby="mFileFormat2Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="overlay olFile" style="display: none;">
                <div class="spinner"></div>
            </div>
            <div class="modal-header">
                <h5 class="modal-title" id="mFileFormat2Label"><i class="fa fa-file"></i> FORMATO 6: Resumen del acta de inspeccion externa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="fvfile">
                    <input type="hidden" class="fileidFo2" id="fileidFo2">
                    {{-- <input type="hidden" class="fileins" id="fileins"> --}}
                    <div class="row">
                        <div class="px-1 conteinerMessageFile">
                            <div class="row">
                                <div class="col-lg-9 mb-1">
                                    <div class="callout callout-warning py-2">
                                        <h5 class="font-weight-bold">Ten en cuenta!</h5>
                                        <p>Este formato es para resumir el acta
                                            de inspeccion interna, en caso de actualizar el formato 5, subo otro archivo el cual reemplazara el actual.</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 mb-1 d-flex justify-content-center align-items-center">
                                    <a class="btn btn-link py-1 font-weight-bold linkFile" target="_blank" href=""><i class="fa fa-file"></i> Archivo de inspeccion</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <div class="alert text-center boxFile h-100 d-flex flex-column justify-content-center" style="border: 4px dashed #000;background: #ebeff5;">
                                <h5 class="font-italic font-weight-bold m-auto nameFile">ARCHIVO DE INSPECCION</h5>
                                <p class="font-italic m-0 msgClick">Realiza click aki, para subir el archivo</p>
                                <p class="m-auto"><i class="fa fa-upload fa-2x"></i></p>
                            </div>
                            <input type="file" id="fileFormat2Full" name="fileFormat2Full" class="pdfFile" style="display: none;" data-name="ARCHIVO DE INSPECCION">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary saveFile">Guardar archivo</button>
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
    });
    $('.saveFile').on('click',function(){saveFile();})
    function fillRecords()
    {
        $('.containerRecords').css('display','block');
        jQuery.ajax(
        {
            url: "{{ url('format2/list') }}",
            method: 'get',
            success: function(r)
            {
                console.log(r)
                let html = '';
                // let nombres;
                // let locationProperty;
                // let inspection;
                let from;
                let options;
                let evidence;
                for (var i = 0; i < r.data.length; i++)
                {
                    // nombres=r.data[i].numIde+' '+r.data[i].nombres+' '+r.data[i].app+' '+r.data[i].apm;
                    // locationProperty = r.data[i].upcjb+' '+r.data[i].upn+' '+r.data[i].upmz+' '+r.data[i].uplote;
                    // inspection=r.data[i].dateIns+' | '+ r.data[i].startTime+' '+r.data[i].endTime;
                    // from = r.data[i].verify=='1'?'<pan class="badge badge-info">aprobado</span>':'<pan class="badge badge-warning">web</span>';
                    evidence = isEmpty(r.data[i].ppdfFile)?
                        '':
                        '<a class="btn btn-link" title="Ver evidencias" target="_blank" href="'+'{{ route('detalle-archivo') }}/'+r.data[i].idFo2+'"><i class="fa fa-file"></i></a>';
                    if(r.data[i].verify=='1')
                    {
                        from = r.data[i].process >= '2'?
                            '<pan class="badge badge-info">Investigacion</span>':
                            '<span class="badge badge-info">Recibido</span><button type="button" class="btn text-info py-0 pr-0" title="Enviar a actas de inspeccion" onclick="changeProcess(\''+r.data[i].codRec+'\');"><i class="fa fa-edit"></i></button>';
                        options = r.data[i].process >= '2'?
                            '<button type="button" class="btn text-danger" title="Eliminar registro" onclick="deleteRecords(\''+r.data[i].pnumIns+'\');"><i class="fa fa-trash"></i></button>':
                            '<button type="button" class="btn text-info" title="Subir formato 2" onclick="mFileFormat2(\''+r.data[i].idFo2+'\');"><i class="fa fa-upload"></i></button>'+
                            '<button type="button" class="btn text-info" title="Formato 3" onclick="format3(\''+r.data[i].pnumIns+'\');"><i class="fa fa-file-pdf"></i></button>'+
                            '<button type="button" class="btn text-info" title="Editar registro" onclick="edit(\''+r.data[i].codRec+'\');"><i class="fa fa-edit"></i></button>'+
                            '<button type="button" class="btn text-danger" title="Eliminar registro" onclick="deleteRecords(\''+r.data[i].pnumIns+'\');"><i class="fa fa-trash"></i></button>';
                    }
                    else
                    {
                        from = '<pan class="badge badge-warning">Web</span>';
                        options = '<button type="button" class="btn text-danger" title="Eliminar registro" onclick="deleteRecords(\''+r.data[i].pnumIns+'\');"><i class="fa fa-trash"></i></button>';
                    }

                    html += '<tr>' +
                        // '<td class="align-middle">' + novDato(r.data[i].codRec) + '</td>' +
                        '<td class="align-middle">' + frecordsId(r.data[i]) + '</td>' +
                        // '<td class="align-middle">' + novDato(r.data[i].numSum) + '</td>' +
                        '<td class="align-middle">' + fuserClaimant(r.data[i]) + '</td>' +
                        '<td class="align-middle">' + flocationPredio(r.data[i]) +'</td>' +
                        '<td class="align-middle text-center">' + novDato(r.data[i].tipoReclamo) +'</td>' +
                        '<td class="align-middle">' + fdateInspection(r.data[i]) +'</td>' +
                        '<td class="align-middle">' + novDato(r.data[i].reunion) +'</td>' +
                        '<td class="align-middle">' + novDato(r.data[i].notificacion) +'</td>' +
                        '<td class="align-middle">' + from +'</td>' +
                        '<td class="align-middle text-center">' +
                            '<a class="btn btn-secondary py-0 px-1" target="_blank" href="'+'{{ route('f2') }}/'+r.data[i].idFo2+'"><i class="fa fa-file-pdf"></i> F2</a>' +
                        '</td>' +
                        '<td class="align-middle text-center">' +
                            '<div class="btn-group btn-group-sm" role="group">'+
                                evidence+
                                options+
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

    function saveFile()
    {
        if($('#fileFormat2Full')[0].files.length==0)
        {alert("No se subio el documento del format 2.");return;}
        var formData = new FormData($("#fvfile")[0]);
        formData.append('idFo2',$('#fileidFo2').val());
        // formData.append('fileins',$('#fileins').val());
        $('.saveFile').prop('disabled',true);
        $('.olFile').css("display","flex");
        jQuery.ajax({
            url: "{{ url('format2/saveFileFormat2Full') }}",
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
                    $('.saveFile').prop('disabled',false);
                    $('#mFileFormat2').modal('hide');
                    // $('#fileidFo2').val()
                    // $('.'+$('#fileidFo2').val()).find('.f5').html('<i class="fa fa-file"></i> F5');
                    // if(r.load)
                    // {
                    //     buildTable();
                    //     fillRecords();
                    // }
                }
                msgForm(r);
                $('.olFile').css("display","none");
            },
            error: function (xhr, status, error) {
                alert("Algo salio mal, porfavor contactese con el Administrador.");
                console.log(error)
                $('.olFile').css("display","none");
                $('.saveFile').prop('disabled',false);
            }
        });
    }
    function mFileFormat2(idFo2)
    {
        cleanFile();
        // $('#mFileFormat2').modal('show')
        jQuery.ajax({
            url: "{{ url('format2/fileFormat2Full') }}",
            method: 'POST',
            data: {idFo2:idFo2},
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
            success: function (r) {
                $('.conteinerMessageFile').css('display','none');
                if(r.data.fileFormat2Full!==null)
                {
                    $('.conteinerMessageFile').css('display','block');
                    let href = "{{ url('format2/showFileFormat2Full') }}"
                    $('.linkFile').attr("href",href+"/"+r.data.idFo2)
                }
                $('#mFileFormat2').modal('show')
                $('#fileidFo2').val(idFo2)
                // $('#fileins').val(ins)
            },
            error: function (xhr, status, error) {
                alert("Algo salio mal, porfavor contactese con el Administrador.");
                console.log(error)
                $('.overlayForm').css("display","none");
            }
        });
    }
    function cleanFile()
    {
        loadFile($('#fileFormat2Full'),false);
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
            $(ele).parent().find('.nameFile').html('ARCHIVO DE FORMATO');
            $(ele).parent().find('.msgClick').css('display','block');
            $(ele).parent().find('i').removeClass('fa fa-file-pdf fa-lg');
            $(ele).parent().find('i').addClass('fa fa-upload fa-lg');
            $(ele).parent().find('.boxFile').css('border','4px dashed #000');
            $(ele).val('');
        }
    }
    function deleteRecords(codRec)
    {
        event.preventDefault();
        Swal.fire({
        title: "Esta seguro de pasar el reclamo a investigacion?",
        text: "Confirme la accion",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, confirmar"
        }).then((result) => {
            if (result.isConfirmed)
                alert('eliminar registro')
            else
                alert('no!')
        });
    }
    function changeProcess(codRec)
    {
        event.preventDefault();
        Swal.fire({
        title: "Esta seguro de pasar el reclamo a investigacion?",
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
                    url: "{{ url('format2/changeProcess') }}",
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
    function buildTable()
    {
        $('.containerRecords>div').remove();
        $('.containerRecords').html(tableRecords);
    }
    function format3(ins)
    {
        // jQuery.ajax(
        // {
        //     url: "{{ url('format3/show') }}",
        //     method: 'get',
        //     success: function(r)
        //     {
        //         console.log(r)
        //     }
        // });
        window.open('{{ url('format3/show') }}/' + ins, '_blank');
    }
    function edit(codRec)
    {
        localStorage.setItem("codRec",codRec);
        // window.open('{{ url('format2/edit') }}');
        window.location.href = '{{ url('format2/edit') }}';
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
