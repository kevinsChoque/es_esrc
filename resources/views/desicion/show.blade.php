@extends('layout.layout')
@section('nombreContenido', '----')
@section('pageTitle')
{{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2-bootstrap4.min.css" rel="stylesheet"> --}}

<div class="content-header pb-0 pt-2">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"><h1 class="m-0">Resoluciones</h1></div>
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
                                        <th class="text-center" data-priority="3">Identificador</th>
                                        <th class="text-center" data-priority="4">Reclamante</th>
                                        <th class="text-center" data-priority="4">Ubicacion del predio</th>
                                        <th class="text-center" data-priority="4">Tipo</th>
                                        <th class="text-center" data-priority="4">Inspeccion</th>
                                        <th class="text-center" data-priority="4">Desde</th>
                                        <th class="text-center" data-priority="1">Opc.</th>
                                    </tr>
                                </thead>
                                <tbody id="data">
                                </tbody>
                                <tfoot class="thead-light">
                                    <tr>
                                        <th class="text-center" data-priority="3">Identificador</th>
                                        <th class="text-center" data-priority="4">Reclamante</th>
                                        <th class="text-center" data-priority="4">Ubicacion del predio</th>
                                        <th class="text-center" data-priority="4">Tipo</th>
                                        <th class="text-center" data-priority="4">Inspeccion</th>
                                        <th class="text-center" data-priority="4">Desde</th>
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
                    <input type="hidden" name="residFo2" id="residFo2">
                    <input type="hidden" name="resins" id="resins">
                    <div class="row">
                        <div class="px-1 conteinerMessageRes">
                            <div class="row">
                                <div class="col-lg-9 mb-1">
                                    <div class="callout callout-warning py-2">
                                        <h5 class="font-weight-bold">Ten en cuenta!</h5>
                                        <p>Este formato es para resumir el Acta
                                            de Reunion de Conciliacion, en caso de actualizar el formato 4, subo otro archivo el cual reemplazara el actual.</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 mb-1 d-flex justify-content-center align-items-center">
                                    <a class="btn btn-link py-1 font-weight-bold linkFileRes" target="_blank"><i class="fa fa-file"></i> Formato 4</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <div class="alert text-center boxFile h-100 d-flex flex-column justify-content-center" style="border: 4px dashed #000;background: #ebeff5;">
                                <h5 class="font-italic font-weight-bold m-auto nameFile">ARCHIVO DE FORMATO 4</h5>
                                <p class="font-italic m-0 msgClick">Realiza click aki, para subir el archivo</p>
                                <p class="m-auto"><i class="fa fa-upload fa-2x"></i></p>
                            </div>
                            <input type="file" id="resfile" name="resfile" class="pdfFile" style="display: none;" data-name="ARCHIVO DE RESOLUCION">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary saveResFile">Guardar resolucion</button>
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
    $('.saveResFile').on('click',function(){
        saveResFile();
    });
    function validateF4()
    {
        if($('#fvf4').valid()==false)
        {return true;}
        return false;
    }
    function validateFile()
    {
        if($('#resfile')[0].files.length==0)
        {alert("No se subio el documento del formato 4.");return true;}
        return false;
    }
    function saveResFile()
    {
        // console.log($('#f5idFo2').val())
        // alert($(ele).html())
        if(validateFile())
            return;
        var formData = new FormData($("#fvfile")[0]);
        // formData.append('f4idFo2',$('#residFo2').val());
        // formData.append('f4ins',$('#resins').val());

        $('.saveResFile').prop('disabled',true);
        $('.olFile').css("display","flex");
        jQuery.ajax({
            url: "{{ url('format2/saveFileRes') }}",
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
                    $('.saveResFile').prop('disabled',false);
                    $('#mLoadFile').modal('hide');
                    // $('#residFo2').val()
                    // $('.'+$('#residFo2').val()).find('.f4').html('<i class="fa fa-file"></i> F4');
                }
                msgForm(r);
                $('.olFile').css("display","none");
            },
            error: function (xhr, status, error) {
                alert("Algo salio mal, porfavor contactese con el Administrador.");
                console.log(error)
                $('.olFile').css("display","none");
                $('.saveResFile').prop('disabled',false);
            }
        });
    }

    function fillRecords()
    {
        $('.containerRecords').css('display','block');
        jQuery.ajax(
        {
            url: "{{ url('desicion/list') }}",
            method: 'get',
            success: function(r)
            {
                let html = '';
                let iconoF6;
                let change;
                for (var i = 0; i < r.data.length; i++)
                {
                    change = r.data[i].f4 == '1'
                        ?'<button type="button" class="btn text-info py-0 pr-0" title="Declarar reclamo como" onclick="changeProcess(\''+r.data[i].codRec+'\');"><i class="fa fa-edit"></i></button>'
                        :'';
                    html += '<tr class="'+r.data[i].idFo2+'">' +
                        '<td class="align-middle">' + frecordsId(r.data[i]) + '</td>' +
                        '<td class="align-middle">' + fuserClaimant(r.data[i]) + '</td>' +
                        '<td class="align-middle">' + flocationPredio(r.data[i]) +'</td>' +
                        '<td class="align-middle">' + novDato(r.data[i].tipoReclamo) +'</td>' +
                        '<td class="align-middle">' + fdateInspection(r.data[i]) +'</td>' +
                        '<td class="align-middle text-center">'+
                            '<span class="badge badge-info">Resolucion</span>'+change+
                        '</td>' +
                        '<td class="align-middle text-center">' +
                            '<div class="btn-group btn-group-sm" role="group">'+
                                '<a class="btn text-info" title="Descargar resolucion" target="_blank" href="'+'{{ route('desicion') }}/'+r.data[i].idFo2+'"><i class="fa fa-download"></i></a>' +
                                '<button type="button" class="btn text-info f4" title="Subir resolucion" onclick="mfile(\''+r.data[i].idFo2+'\',\''+r.data[i].pnumIns+'\');"><i class="fa fa-upload"></i></button>'+
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
        title: "Esta seguro de finalizar el proceso de reclamo?",
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
    function mfile(idFo2,ins)
    {
        jQuery.ajax({
            url: "{{ url('format2/fileRes') }}",
            method: 'POST',
            data: {idFo2:idFo2,ins:ins},
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
            success: function (r) {
                $('.conteinerMessageRes').css('display','none');
                if(!isEmpty(r.data.fileRes))
                {
                    $('.conteinerMessageRes').css('display','block');
                    let href = "{{ url('format2/showFileRes') }}"
                    $('.linkFileRes').attr("href",href+"/"+r.data.idFo2)
                }
                $('#mLoadFile').modal('show')
                $('#residFo2').val(idFo2)
                $('#resins').val(ins)
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
