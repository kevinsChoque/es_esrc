@extends('layout.layout')
@section('nombreContenido', '----')
@section('pageTitle')
<div class="content-header pb-0 pt-2">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"><h1 class="m-0"><i class="fa fa-users"></i> Usuarios</h1></div>
            <div class="col-sm-6">
                {{-- <a href="{{url('format2/form')}}" class="btn btn-success float-right" data-toggle="modal" data-target="#modalRegistrar"><i class="fa fa-plus"></i> Nueva usuario</a> --}}
                <button class="btn btn-success float-right" data-toggle="modal" data-target="#mregister">
	                <i class="fa fa-plus"></i>
	                Nuevo Usuario
	            </button>
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
                {{-- <div class="card-header border-transparent py-2">
                    <h3 class="card-title m-0 font-weight-bold"><i class="fa fa-chart-bar"></i> Lista de reclamos</h3>
                </div> --}}
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 containerRecords table-responsive" style="display: none;">
                            <table id="records" class="table table-hover table-striped table-bordered dt-responsive nowrap">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="text-center" data-priority="3">DNI</th>
                                        <th class="text-center" data-priority="4">Nombre</th>
                                        <th class="text-center" data-priority="4">Celular</th>
                                        <th class="text-center" data-priority="4">Correo</th>
                                        <th class="text-center" data-priority="4">Tipo</th>
                                        <th class="text-center" data-priority="4">Estado</th>
                                        <th class="text-center" data-priority="4">f.r.</th>
                                        <th class="text-center" data-priority="1">Opc.</th>
                                    </tr>
                                </thead>
                                <tbody id="data">
                                </tbody>
                                <tfoot class="thead-light">
                                    <tr>
                                        <th class="text-center" data-priority="3">DNI</th>
                                        <th class="text-center" data-priority="4">Nombre</th>
                                        <th class="text-center" data-priority="4">Celular</th>
                                        <th class="text-center" data-priority="4">Correo</th>
                                        <th class="text-center" data-priority="4">Tipo</th>
                                        <th class="text-center" data-priority="4">Estado</th>
                                        <th class="text-center" data-priority="4">f.r.</th>
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
<div class="modal fade" id="mregister" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header py-1 border-transparent" style="background-color: rgba(0, 0, 0, 0.03);">
                <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-user"></i> Nuevo usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="fvuser">
                <div class="row contenedorFormularioRegistrar">
                    <div class="form-group col-lg-6">
                        <label for="dni" class="m-0">DNI: <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text font-weight-bold"><i class="fa fa-angle-right"></i></span>
                            </div>
                            <input type="text" class="form-control soloNumeros input" id="dni" name="dni" maxlength="8">
                        </div>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="nombres" class="m-0">Nombres: <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text font-weight-bold"><i class="fa fa-angle-right"></i></span>
                            </div>
                            <input type="text" class="form-control input" id="nombres" name="nombres">
                        </div>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="apellidos" class="m-0">Apellidos: <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text font-weight-bold"><i class="fa fa-angle-right"></i></span>
                            </div>
                            <input type="text" class="form-control input" id="apellidos" name="apellidos">
                        </div>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="celular" class="m-0">Celular:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text font-weight-bold"><i class="fa fa-angle-right"></i></span>
                            </div>
                            <input type="text" class="form-control input" id="celular" name="celular">
                        </div>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="correo" class="m-0">Correo:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text font-weight-bold"><i class="fa fa-angle-right"></i></span>
                            </div>
                            <input type="text" class="form-control input" id="correo" name="correo">
                        </div>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="" class="m-0">Tipo de usuario: <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text font-weight-bold"><i class="fa fa-angle-right"></i></span>
                            </div>
                            <select name="tipo" id="tipo" class="form-control">
                                <option disabled selected>Seleccione tipo de usuario</option>
                                <option value="administrador">Administrador</option>
                                <option value="recepcion">Recepcion</option>
                                <option value="conciliador">Conciliador</option>
                                <option value="decision">Decision</option>
                            </select>
                        </div>
                    </div>
                </div>
                </form>
            </div>
            <div class="modal-footer py-1 border-transparent">
                <button type="button" class="btn btn-light" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                <button type="button" class="btn btn-success save"><i class="fa fa-save"></i> Guardar usuario</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="medit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header py-1 border-transparent" style="background-color: rgba(0, 0, 0, 0.03);">
                <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-user"></i> Editar usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="fvuserEdit">
                <input type="hidden" id="idUse" name="idUse">
                <div class="row contenedorFormularioRegistrar">
                    <div class="form-group col-lg-6">
                        <label for="dni" class="m-0">DNI: <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text font-weight-bold"><i class="fa fa-angle-right"></i></span>
                            </div>
                            <input type="text" class="form-control soloNumeros input" id="dni" name="dni" maxlength="8">
                        </div>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="nombres" class="m-0">Nombres: <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text font-weight-bold"><i class="fa fa-angle-right"></i></span>
                            </div>
                            <input type="text" class="form-control input" id="nombres" name="nombres">
                        </div>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="apellidos" class="m-0">Apellidos: <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text font-weight-bold"><i class="fa fa-angle-right"></i></span>
                            </div>
                            <input type="text" class="form-control input" id="apellidos" name="apellidos">
                        </div>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="celular" class="m-0">Celular:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text font-weight-bold"><i class="fa fa-angle-right"></i></span>
                            </div>
                            <input type="text" class="form-control input" id="celular" name="celular">
                        </div>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="correo" class="m-0">Correo:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text font-weight-bold"><i class="fa fa-angle-right"></i></span>
                            </div>
                            <input type="text" class="form-control input" id="correo" name="correo">
                        </div>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="" class="m-0">Tipo de usuario: <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text font-weight-bold"><i class="fa fa-angle-right"></i></span>
                            </div>
                            <select name="tipo" id="tipo" class="form-control">
                                <option disabled>Seleccione tipo de usuario</option>
                                <option value="administrador">Administrador</option>
                                <option value="recepcion" selected>Recepcion</option>
                                <option value="conciliador">Conciliador</option>
                                <option value="decision">Decision</option>
                            </select>
                        </div>
                    </div>
                </div>
                </form>
            </div>
            <div class="modal-footer py-1 border-transparent">
                <button type="button" class="btn btn-light" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                <button type="button" class="btn btn-success saveChange"><i class="fa fa-save"></i> Guardar cambios</button>
            </div>
        </div>
    </div>
</div>
<script>
    localStorage.setItem("sbd",0);
    localStorage.setItem("sba",2);
    var tableRecords;
    var flip=0;
    $(document).ready( function () {
        tableRecords=$('.containerRecords').html();
        fillRecords();
        $('.overlayAllPage').css("display","none");
        initFv('fvuser',rules());
        initFv('fvuserEdit',rules());
    });
    $('.save').on('click',function(){
        save();
    });
    $('.saveChange').on('click',function(){
        saveChange();
    });
    function save()
    {
        if($('#fvuser').valid()==false)
        {return;}
        var formData = new FormData($("#fvuser")[0]);
        $('.save').prop('disabled',true);
        jQuery.ajax(
        {
            url: "{{ url('users/save') }}",
            method: 'post',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
            success: function(r){
                if (r.state)
                {
                    limpiarForm();
                    $( ".overlayRegistros" ).toggle( flip++ % 2 === 0 );
                    buildTable();
                    fillRecords();
                }
                cleanFv('fvuser');
                $('.save').prop('disabled',false);
                $('#mregister').modal('hide');
                msgForm(r);
            },
            error: function (xhr, status, error) {
                msjError("Algo salio mal, porfavor contactese con el Administrador.");
                $('.save').prop('disabled',false);
            }
        });
    }
    function saveChange()
    {
        if($('#fvuserEdit').valid()==false)
        {return;}
        var formData = new FormData($("#fvuserEdit")[0]);
        $('.saveChange').prop('disabled',true);
        jQuery.ajax(
        {
            url: "{{ url('users/saveChange') }}",
            data: formData,
            method: 'post',
            dataType: 'json',
            processData: false,
            contentType: false,
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
            success: function(r){
                if (r.state)
                {
                    $( ".overlayRegistros" ).toggle( flip++ % 2 === 0 );
                    buildTable();
                    fillRecords();
                    $('#medit').modal('hide');
                }
                $('.saveChange').prop('disabled',false);
                msgForm(r);
            },
            error: function (xhr, status, error) {
                alert("Algo salio mal, porfavor contactese con el Administrador.");
                console.log(error)
                // $('.olFile').css("display","none");
                $('.saveChange').prop('disabled',false);
            }
        });
    }
    function limpiarForm()
    {
        cleanFv('fvuser');
        $('#fvuser .input').val('');
    }
    function buildTable()
    {
        $('.containerRecords>div').remove();
        $('.containerRecords').html(tableRecords);
    }
    function fillRecords()
    {
        $('.containerRecords').css('display','block');
        jQuery.ajax(
        {
            url: "{{ url('users/list') }}",
            method: 'get',
            success: function(r)
            {
                let html = '';
                for (var i = 0; i < r.data.length; i++)
                {
                    change = '<button class="btn text-info py-0 pr-0" onclick="changeAccess(\''+r.data[i].idUse+'\',\''+r.data[i].state+'\');"><i class="fa fa-edit"></i></button>'
                    html += '<tr>' +
                        '<td class="align-middle text-center font-weight-bold"><i class="fa fa-id-card"></i> ' + r.data[i].dni + '</td>' +
                        '<td class="align-middle font-italic">' + r.data[i].nombres + ' '+r.data[i].apellidos + '</td>' +
                        '<td class="align-middle text-center">' + r.data[i].celular +'</td>' +
                        '<td class="align-middle text-center">' + r.data[i].correo +'</td>' +
                        '<td class="align-middle text-center"><span class="badge badge-info">' + r.data[i].tipo +'</span></td>' +
                        '<td class="align-middle text-center">' + stateUse(r.data[i].state) +change+'</td>' +
                        '<td class="align-middle text-center">'+ fdateTime(r.data[i].fr) + '</td>' +
                        '<td class="align-middle text-center">' +
                            '<div class="btn-group btn-group-sm" role="group">'+
                                '<button class="btn text-info" onclick="edit(\''+r.data[i].idUse+'\');"><i class="fa fa-edit"></i></button>'+
                                '<button class="btn text-danger" onclick="delete(\''+r.data[i].idUse+'\');"><i class="fa fa-trash"></i></button>'+
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
    function stateUse(state)
    {
        return state=='1'
        ? '<span class="badge badge-success">Con acceso</span>'
        :'<span class="badge badge-warning">Sin acceso</span>'

    }
    function edit(idUse)
    {
        jQuery.ajax(
        {
            url: "{{ url('users/edit') }}",
            data: {idUse:idUse},
            method: 'post',
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
            success: function(r){
                $('#fvuserEdit #dni').val(r.data.dni);
                $('#fvuserEdit #nombres').val(r.data.nombres);
                $('#fvuserEdit #apellidos').val(r.data.apellidos);
                $('#fvuserEdit #celular').val(r.data.celular);
                $('#fvuserEdit #correo').val(r.data.correo);
                $('#fvuserEdit #tipo').val(r.data.tipo);
                $('#fvuserEdit #idUse').val(r.data.idUse);
                $('#medit').modal('show');
            }
        });
    }
    function changeAccess(idUse,state)
    {
        event.preventDefault();
        Swal.fire({
        title: state=='1'
            ?"Quitar acceso a la plataforma de reclamos?"
            :"Dar acceso a la plataforma de reclamos?",
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
                    url: "{{ url('users/changeAccess') }}",
                    method: 'POST',
                    data: {idUse: idUse},
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
    function rules()
    {
        return {
            dni: {required: true,},
            nombres: {required: true,},
            apellidos: {required: true,},
            tipo: {required: true,},
        };
    }
</script>
@endsection
