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
                                        <th class="text-center" data-priority="3">Cod.reclamo</th>
                                        <th class="text-center" data-priority="4">Num.suministro</th>
                                        <th class="text-center" data-priority="4">Reclamante</th>
                                        <th class="text-center" data-priority="4">Ubicacion del predio</th>
                                        <th class="text-center" data-priority="4">Tipo</th>
                                        <th class="text-center" data-priority="4">Inspeccion</th>
                                        <th class="text-center" data-priority="4">Conciliacion</th>
                                        <th class="text-center" data-priority="4">Resolucion</th>
                                        <th class="text-center" data-priority="4">Desde</th>
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
                                        <th class="text-center" data-priority="4">Conciliacion</th>
                                        <th class="text-center" data-priority="4">Resolucion</th>
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

<script>
    localStorage.setItem("sbd",0);
    localStorage.setItem("sba",2);
    var tableRecords;
    $(document).ready( function () {
        // $('.containerRecords').css('display','block');
        // cascç
        tableRecords=$('.containerRecords').html();
        fillRecords();
        $('.overlayPagina').css("display","none");
    });
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
                let nombres;
                let locationProperty;
                let inspection;
                let from;
                let options;
                for (var i = 0; i < r.data.length; i++)
                {
                    nombres=r.data[i].numIde+' '+r.data[i].nombres+' '+r.data[i].app+' '+r.data[i].apm;
                    locationProperty = r.data[i].upcjb+' '+r.data[i].upn+' '+r.data[i].upmz+' '+r.data[i].uplote;
                    inspection=r.data[i].dateIns+' | '+ r.data[i].startTime+' '+r.data[i].endTime;
                    // from = r.data[i].verify=='1'?'<pan class="badge badge-info">aprobado</span>':'<pan class="badge badge-warning">web</span>';
                    if(r.data[i].verify=='1')
                    {
                        from = '<pan class="badge badge-info">aprobado</span>';
                        options = '<button type="button" class="btn text-info" title="Formato 3" onclick="format3(\''+r.data[i].pnumIns+'\');"><i class="fa fa-file-pdf"></i></button>'+
                        '<button type="button" class="btn text-info" title="Editar registro" onclick="edit(\''+r.data[i].pnumIns+'\');"><i class="fa fa-edit"></i></button>'+
                        '<button type="button" class="btn text-danger" title="Eliminar registro" onclick="eliminar(\''+r.data[i].pnumIns+'\');"><i class="fa fa-trash"></i></button>';
                    }
                    else
                    {
                        from = '<pan class="badge badge-warning">web</span>';
                        options = '<button type="button" class="btn text-danger" title="Eliminar registro" onclick="eliminar(\''+r.data[i].pnumIns+'\');"><i class="fa fa-trash"></i></button>';
                    }
                    html += '<tr>' +
                        '<td class="align-middle">' + novDato(r.data[i].codRec) + '</td>' +
                        '<td class="align-middle">' + novDato(r.data[i].numSum) + '</td>' +
                        '<td class="align-middle">' + nombres + '</td>' +
                        '<td class="align-middle">' + locationProperty +'</td>' +
                        '<td class="align-middle">' + novDato(r.data[i].tipoReclamo) +'</td>' +
                        '<td class="align-middle">' + inspection +'</td>' +
                        '<td class="align-middle">' + novDato(r.data[i].reunion) +'</td>' +
                        '<td class="align-middle">' + novDato(r.data[i].notificacion) +'</td>' +
                        '<td class="align-middle">' + from +'</td>' +
                        '<td class="align-middle text-center">' +
                            '<div class="btn-group btn-group-sm" role="group">'+
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
    function edit(ins)
    {
        localStorage.setItem("ins",ins);
        window.open('{{ url('format2/edit') }}');
    }
</script>

@endsection
