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
                        <input type="text" id="dataSearch" name="dataSearch" class="form-control" placeholder="Ingrese la informacion" value="00131291">
                    </div>
                </div>
                <div class="form-group col-lg-5">
                    <label class="m-0">Ingrese numero de suministro:</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Mzn:</span>
                        </div>
                        <input type="text" name="smzn" id="smzn" class="form-control onlyNumbers" maxlength="2">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Lote</span>
                        </div>
                        <input type="text" name="slote" id="slote" class="form-control onlyNumbers" maxlength="4">
                    </div>
                </div>
                <div class="form-group col-lg-3">
                    <label class="m-0"></label>
                    <div class="form-control p-0" style="border: none;">
                        <button class="btn btn-outline-secondary w-100"><i class="fa fa-search"></i> Buscar usuario</button>
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
            <table class="table table-bordered">
                <tr>
                    <td colspan="8" class="align-middle"><strong>CÓDIGO DE RECLAMO N°</strong></td>
                    <td colspan="4" class="p-1"><input type="text" name="codRec" id="codRec" class="form-control w-100" disabled></td>
                </tr>
                <tr>
                    <td colspan="2" class="align-middle"><strong>N° DE SUMINISTRO</strong></td>
                    <td colspan="4" class="p-1"><input type="text" name="suministro" id="suministro" class="form-control w-100" disabled></td>
                    <td colspan="2" class="align-middle"><strong>Teléfono</strong></td>
                    <td colspan="4" class="p-1"><input type="text" class="form-control w-100 dptelefono" disabled></td>
                </tr>
                <tr>
                    <td colspan="4" class="p-1"><input type="text" name="nombres" id="nombres" class="form-control w-100"></td>
                    <td colspan="6" class="p-1"><input type="text" name="app" id="app" class="form-control w-100"></td>
                    <td colspan="2" class="p-1"><input type="text" name="apm" id="apm" class="form-control w-100"></td>
                </tr>
                <tr>
                    <td colspan="4" class="align-middle"><strong>nombres</strong></td>
                    <td colspan="6" class="align-middle"><strong>apellido paterno</strong></td>
                    <td colspan="2" class="align-middle"><strong>apellido materno</strong></td>
                </tr>
                <tr>
                    <td colspan="8" class="align-middle"><strong>Numero de documento de identidad (DNI, LE, CI) razon social</strong></td>
                    <td colspan="4" class="align-middle p-1"><input type="text" name="numIde" id="numIde" class="form-control w-100"></td>
                </tr>
                <tr>
                    <td colspan="4" class="align-middle"><strong>Razon social</strong></td>
                    <td colspan="8" class="p-1"><input type="text" class="form-control w-100"></td>
                </tr>
                <tr>
                    <td colspan="12" class="align-middle"><strong>Ubicacion del predio</strong></td>
                </tr>
                <tr>
                    <td colspan="9" class="p-1"><input type="text" name="upcjb" id="upcjb" class="form-control w-100 urbanizacion"></td>
                    <td colspan="1" class="p-1"><input type="text" class="form-control w-100"></td>
                    <td colspan="1" class="p-1"><input type="text" class="form-control w-100"></td>
                    <td colspan="1" class="p-1"><input type="text" class="form-control w-100"></td>
                </tr>
                <tr>
                    <td colspan="9" class="align-middle"><strong>(calle, jiron, avenida)</strong></td>
                    <td colspan="1" class="align-middle"><strong>Nª</strong></td>
                    <td colspan="1" class="align-middle"><strong>Mz.</strong></td>
                    <td colspan="1" class="align-middle"><strong>Lote</strong></td>
                </tr>
                <tr>
                    <td colspan="4" class="p-1"><input type="text" class="form-control w-100 urbanizacion"></td>
                    <td colspan="6" class="p-1"><input type="text" class="form-control w-100" value="Abancay"></td>
                    <td colspan="2" class="p-1"><input type="text" class="form-control w-100" value="Abancay"></td>
                </tr>
                <tr>
                    <td colspan="4" class="align-middle"><strong>(urbanizacion, barrio)</strong></td>
                    <td colspan="6" class="align-middle"><strong>provincia</strong></td>
                    <td colspan="2" class="align-middle"><strong>distrito</strong></td>
                </tr>
                {{-- --- --}}
                <tr>
                    <td colspan="12"><strong>Domicilio procesal</strong></td>
                </tr>
                <tr>
                    <td colspan="9" class="p-1"><input type="text" class="form-control w-100 urbanizacion"></td>
                    <td colspan="1" class="p-1"><input type="text" class="form-control w-100"></td>
                    <td colspan="1" class="p-1"><input type="text" class="form-control w-100"></td>
                    <td colspan="1" class="p-1"><input type="text" class="form-control w-100"></td>
                </tr>
                <tr>
                    <td colspan="9" class="align-middle"><strong>(calle, jiron, avenida)</strong></td>
                    <td colspan="1" class="align-middle"><strong>Nª</strong></td>
                    <td colspan="1" class="align-middle"><strong>Mz.</strong></td>
                    <td colspan="1" class="align-middle"><strong>Lote</strong></td>
                </tr>
                <tr>
                    <td colspan="4" class="p-1"><input type="text" class="form-control w-100 urbanizacion"></td>
                    <td colspan="6" class="p-1"><input type="text" class="form-control w-100" value="Abancay"></td>
                    <td colspan="2" class="p-1"><input type="text" class="form-control w-100" value="Abancay"></td>
                </tr>
                <tr>
                    <td colspan="4" class="align-middle"><strong>(urbanizacion, barrio)</strong></td>
                    <td colspan="6" class="align-middle"><strong>provincia</strong></td>
                    <td colspan="2" class="align-middle"><strong>distrito</strong></td>
                </tr>
                <tr>
                    <td colspan="4" class="p-1"><input type="text" class="form-control w-100" value="03001"></td>
                    <td colspan="6" class="p-1"><input type="text" name="dptelefono" id="dptelefono" class="form-control w-100 dptelefono"></td>
                    <td colspan="2" class="p-1"><input type="text" name="dpcorreo" id="dpcorreo" class="form-control w-100"></td>
                </tr>
                <tr>
                    <td colspan="4" class="align-middle"><strong>Codigo postal</strong></td>
                    <td colspan="6" class="align-middle"><strong>Telefono / Celular</strong></td>
                    <td colspan="2" class="align-middle"><strong>Correo electronico</strong></td>
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
                                <label class="form-check-label" for="radio1">SI</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sendNotify" id="sendNotifyNo" value="2">
                                <label class="form-check-label" for="radio2">NO</label>
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
                        <div class="form-group m-0">
                            <textarea class="form-control" name="descripcion" id="descripcion" rows="4" placeholder="Descripcion aquí..."></textarea>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" class="align-middle"><strong>SUCURSAL / ZONAL</strong></td>
                    <td colspan="8" class="p-1"><input type="text" class="form-control w-100" value="Abancay"></td>
                </tr>
                <tr>
                    <td colspan="4" class="align-middle"><strong>ATENDIDO POR</strong></td>
                    <td colspan="6" class="p-1"><input type="text" name="atendido" id="atendido" class="form-control w-100" value="jamilet cruz" disabled></td>
                    <td colspan="1" class="align-middle"><strong>FIRMA</strong></td>
                    <td colspan="1" class="p-1"><input type="text" class="form-control w-100"></td>
                </tr>
                <tr>
                    <td colspan="12" class="align-middle"><strong>FUNDAMENTO DEL RECLAMO (En caso de ser necesario, se podran adjuntar paginas adicionales)</strong></td>
                </tr>
                <tr>
                    <td colspan="12" class="p-1">
                        <div class="form-group m-0">
                            <textarea class="form-control" name="fundamento" id="fundamento" rows="4" placeholder="Fundamento aquí..."></textarea>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="12" class="align-middle"><strong>RELACION DE PRUEBAS QUE SE PRESENTAN ADJUNTAS</strong></td>
                </tr>
                <tr>
                    <td colspan="12" class="p-1"><strong>AQUI LA CARGA DE ARCHIVOS cascsacasc</strong></td>
                </tr>
                <tr>
                    <td colspan="10" class="align-middle"><strong>LA EMPRESA PRESTADORA ENTREGA CARTILLA INFORMATIVA</strong>
                    </td>
                    <td colspan="2" class="text-center">
                        <div class="form-group m-0">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sendBooklet" id="sendBookletSi" value="1" checked>
                                <label class="form-check-label" for="radio1">SI</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sendBooklet" id="sendBookletNo" value="2">
                                <label class="form-check-label" for="radio2">NO</label>
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
                                <input class="form-check-input" type="radio" name="sendBooklet" id="sendBookletSi" value="1" checked>
                                <label class="form-check-label" for="radio1">SI</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sendBooklet" id="sendBookletNo" value="2">
                                <label class="form-check-label" for="radio2">NO</label>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="12" class="align-middle"><strong>INFORMACION A SER COMPLETADA POR LA EMPRESA PRESTADORA</strong></td>
                </tr>
                <tr>
                    <td colspan="3" class="align-middle"><strong style="font-size: .8rem">INSPECCION INTERNA Y EXTERNA, FECHA:</strong></td>
                    <td colspan="5" class="align-middle p-1"><input type="date" name="dateIns" id="dateIns" class="form-control w-100"></td>
                    <td colspan="2" class="align-middle"><strong style="font-size: .8rem">HORA (RANGO DE 2 HORAS):</strong></td>
                    <td colspan="2" class="align-middle p-1">
                        <span class="badge badge-info hourInspection"></span>
                        <input type="text" name="startTime" id="startTime" class="form-control w-100">
                    </td>
                </tr>
                <tr>
                    <td colspan="3" class="align-middle"><strong style="font-size: .8rem">CITACION A REUNION DE CONCILIACION, FECHA:</strong></td>
                    <td colspan="5" class="align-middle p-1"><input type="text" class="form-control w-100"></td>
                    <td colspan="2" class="align-middle"><strong style="font-size: .8rem">HORA:</strong></td>
                    <td colspan="2" class="align-middle p-1"><input type="text" class="form-control w-100"></td>
                </tr>
                <tr>
                    <td colspan="9" class="align-middle"><strong>FECHA MAXIMA DE NOTIFICACION DE LA RESOLUCION</strong></td>
                    <td colspan="1" class="align-middle"><strong>(DD/MM/AA)</strong></td>
                    <td colspan="2" class="p-1"><input type="text" class="form-control w-100"></td>
                </tr>
                {{-- <tr class="shaded">
                    <td><input type="text" placeholder="apellido paterno"></td>
                    <td><input type="text" placeholder="apellido materno"></td>
                    <td colspan="2"><input type="text"></td>
                </tr>
                <tr class="shaded">
                    <td>Apellido Paterno</td>
                    <td>Apellido Materno</td>
                    <td colspan="2">Nombres</td>
                </tr> --}}
                {{-- <tr>
                    <td colspan="4"><input type="text" style="width: 100%"></td>
                </tr> --}}
                {{-- <tr>
                    <td>NÚMERO DE DOCUMENTO DE IDENTIDAD (DNI, LE, CI)</td>
                    <td colspan="3"><input type="text"></td>
                </tr>
                <tr>
                    <td colspan="4">RAZÓN SOCIAL</td>
                </tr>
                <tr>
                    <td colspan="4"><input type="text" style="width: 100%"></td>
                </tr> --}}
            </table>
            </form>
        </div>
        <div class="card-footer">
            <button type="button" class="btn btn-success w-100 saveClaim">Guardar Reclamo</button>
        </div>
    </div>
</div>

<script>
    localStorage.setItem("sbd",0);
    localStorage.setItem("sba",2);
    $(document).ready( function () {
        $('.overlayPagina').css("display","none");
        $('.oveCard').css("display","none");
        initFv('fvclaim',rules());
        // fillReclaim();
        fillReclaimWeb();
    });
    $('.searchReclaim').on('click',function(){searchReclaim()})
    $('.saveClaim').on('click',function(){saveClaim()})
    $('.canalInfo').on('click',function(){
        if($(this).attr('data-canal')=='web')
        {
            $('.cardWeb').css('display','block')
            $('.cardNew').css('display','none')
            $('.canalInfoNew').removeClass('bg-info').addClass('bg-light')
            $('.canalInfoWeb').removeClass('bg-light').addClass('bg-info')
        }
        else
        {
            $('.cardWeb').css('display','none')
            $('.cardNew').css('display','block')
            $('.canalInfoWeb').removeClass('bg-info').addClass('bg-light')
            $('.canalInfoNew').removeClass('bg-light').addClass('bg-info')
        }
    });
    function fillReclaimWeb()
    {
        jQuery.ajax({
            url: "{{ url('format2/fillReclaimWeb') }}",
            method: 'POST',
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
            success: function (r) {
                console.log(typeof r.data)
                // if (r.state)
                //     msgForm(r);
                // else
                // {
                //     msgForm(r);
                // }
                // $('.oveCard').css("display","none");
                // $('.saveClaim').prop('disabled',false);
// ------------------------
                let name;
                $.each(r.data,function(indice,fila){
                    name = fila.nombres+' '+fila.app+' '+fila.apm;
                    // let name = fila.nombres;
                    $('#claims').append("<option value='"+fila.pnumIns+"'>"+fila.pnumIns+' | '+name+' | Tipo reclamo: '+fila.tipoReclamo+"</option>");
                });
                $('#claims').select2();
            },
            error: function (xhr, status, error) {
                alert("Algo salio mal, porfavor contactese con el Administrador.");
            }
        });
    }
    function saveClaim()
    {
        if($('#fvclaim').valid()==false)
        {return;}
        var formData = new FormData($("#fvclaim")[0]);
        formData.append('codRec', $('#codRec').val());
        formData.append('suministro', $('#suministro').val());

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
                    msgForm(r);
                else
                {
                    msgForm(r);
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
        if(isEmpty($('#claims').val()))
        {
            msgImportantShow('Advertencia!','Seleccione reclamo','warning')
        }
        jQuery.ajax(
        {
            url: "{{ url('format2/searchReclaim') }}",
            method: 'post',
            data:{dataSearch:$('#claims').val()},
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
            success: function(r){
                console.log(r)
                console.log('aki ajax')
                $('#codRec').val(r.fo2.codRec)
                $('#nombres').val(r.fo2.nombres)
                $('#app').val(r.fo2.app)
                $('#apm').val(r.fo2.apm)
                $('#numIde').val(r.fo2.numIde)
                $('.dptelefono').val(r.fo2.dptelefono)
                $('.dptelefono').val(r.fo2.dptelefono)
                $('.dptelefono').val(r.fo2.dptelefono)
                $('#dpcorreo').val(r.fo2.dpcorreo)
                $('#tipoReclamo').val(r.fo2.tipoReclamo)
                $('#fundamento').val(r.fo2.fundamento)

                $('#dateIns').val(r.ins.dateIns)
                $('.hourInspection').html(r.ins.startTime+'-'+r.ins.endTime)

                // console.log(r)
                $('#suministro').val(r.data.PreMzn+'-'+r.data.PreLote)
                $('.urbanizacion').val(r.data.CalTip+' '+r.data.CalDes)



                // dptelefono
                // dpcorreo


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
            dptelefono: {required: true,},
            descripcion: {required: true,},
        };
    }
</script>

@endsection
