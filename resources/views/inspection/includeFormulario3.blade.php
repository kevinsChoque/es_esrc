<div class="modal fade" id="mf3" tabindex="-1" role="dialog" aria-labelledby="mf3Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="overlay olF3" style="display: none;">
                <div class="spinner"></div>
            </div>
            <div class="modal-header">
                <h5 class="modal-title" id="mf3Label"><i class="fa fa-file"></i> FORMULARIO 3: Acta de contrastacion en laboratorio del medidor de agua potable.</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="fvf3">
                    <input type="hidden" class="f3idPro" id="f3idPro">
                    <input type="hidden" class="f3ins" id="f3ins">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="alert alert-info py-0">
                                <p class="m-0">Informacion del medidor:</p>
                            </div>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="f3medidor" class="m-0">Nª de medidor: <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text font-weight-bold"><i class="fa fa-hashtag"></i></span>
                                </div>
                                <input type="text" name="f3medidor" id="f3medidor" class="form-control input">
                            </div>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="f3diametro" class="m-0">Diametro: <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text font-weight-bold"><i class="fa fa-clock"></i></span>
                                </div>
                                <input type="text" name="f3diametro" id="f3diametro" class="form-control input">
                            </div>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="f3marca" class="m-0">Marca del medidor: <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text font-weight-bold"><i class="fa fa-clock"></i></span>
                                </div>
                                <input type="text" name="f3marca" id="f3marca" class="form-control input">
                            </div>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="f3clase" class="m-0">Clase metrologica: <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text font-weight-bold"><i class="fa fa-clock"></i></span>
                                </div>
                                <input type="text" name="f3clase" id="f3clase" class="form-control input">
                            </div>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="f3modelo" class="m-0">Modelo del medidor: <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text font-weight-bold"><i class="fa fa-clock"></i></span>
                                </div>
                                <input type="text" name="f3modelo" id="f3modelo" class="form-control input">
                            </div>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="f3capacidad" class="m-0">Capacidad del medidor: <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text font-weight-bold"><i class="fa fa-clock"></i></span>
                                </div>
                                <input type="text" name="f3capacidad" id="f3capacidad" class="form-control input">
                            </div>
                        </div>
                        <div class="form-group col-lg-9">
                            <label for="f3volumen" class="m-0">Estado de registro: El medidor registra un volumen de......: <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text font-weight-bold"><i class="fa fa-clock"></i></span>
                                </div>
                                <input type="text" name="f3volumen" id="f3volumen" class="form-control input">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="alert alert-info py-0">
                                <p class="m-0">Resultado de la contrastacion:</p>
                            </div>
                        </div>
                        <style>
                            td>input{width: 100px !important;}
                        </style>
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped table-bordered">
                                    <tbody>
                                        <tr class="text-center">
                                            <td rowspan="2" colspan="2">Caudal de ensayo (Q) (L/h)</td>
                                            <td rowspan="2">Presion (bar)</td>
                                            <td rowspan="2">Temperatura (ªC)</td>
                                            <td rowspan="2">Volumen patron (L) (1)</td>
                                            <td rowspan="2">Lectura inicial (2)</td>
                                            <td rowspan="2">Lectura final (3)</td>
                                            <td rowspan="2">Diferencia (4)=(3)-(2)</td>
                                            <td rowspan="1" colspan="2">Error (%)</td>
                                        </tr>
                                        <tr>
                                            <td>Relativo (5)</td>
                                            <td>Permisible</td>
                                        </tr>
                                        <tr>
                                            <td colspan="1">Q3</td>
                                            <td colspan="1"><input type="text" class="datosTabla"></td>
                                            <td colspan="1"><input type="text" class="datosTabla"></td>
                                            <td colspan="1"><input type="text" class="datosTabla"></td>
                                            <td colspan="1"><input type="text" class="datosTabla"></td>
                                            <td colspan="1"><input type="text" class="datosTabla"></td>
                                            <td colspan="1"><input type="text" class="datosTabla"></td>
                                            <td colspan="1"><input type="text" class="datosTabla"></td>
                                            <td colspan="1"><input type="text" class="datosTabla"></td>
                                            <td colspan="1" class="text-center">+- 4%</td>
                                        </tr>
                                        <tr>
                                            <td colspan="1">Q2</td>
                                            <td colspan="1"><input type="text" class="datosTabla"></td>
                                            <td colspan="1"><input type="text" class="datosTabla"></td>
                                            <td colspan="1"><input type="text" class="datosTabla"></td>
                                            <td colspan="1"><input type="text" class="datosTabla"></td>
                                            <td colspan="1"><input type="text" class="datosTabla"></td>
                                            <td colspan="1"><input type="text" class="datosTabla"></td>
                                            <td colspan="1"><input type="text" class="datosTabla"></td>
                                            <td colspan="1"><input type="text" class="datosTabla"></td>
                                            <td colspan="1" class="text-center">+- 4%</td>
                                        </tr>
                                        <tr>
                                            <td colspan="1">Q1</td>
                                            <td colspan="1"><input type="text" class="datosTabla"></td>
                                            <td colspan="1"><input type="text" class="datosTabla"></td>
                                            <td colspan="1"><input type="text" class="datosTabla"></td>
                                            <td colspan="1"><input type="text" class="datosTabla"></td>
                                            <td colspan="1"><input type="text" class="datosTabla"></td>
                                            <td colspan="1"><input type="text" class="datosTabla"></td>
                                            <td colspan="1"><input type="text" class="datosTabla"></td>
                                            <td colspan="1"><input type="text" class="datosTabla"></td>
                                            <td colspan="1" class="text-center">+- 10%</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <label class="d-block">CALIFICACION DEL MEDIDOR: ¿El resultado de la contrastacion indica que el medidor sobreregistra?.</label>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="calificacionSi" name="calificacionMedidor" class="custom-control-input" value="si">
                                <label class="custom-control-label" for="calificacionSi">SI</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="calificacionNo" name="calificacionMedidor" class="custom-control-input" value="no" checked>
                                <label class="custom-control-label" for="calificacionNo">NO</label>
                            </div>
                        </div>
                        <div class="form-group col-lg-12">
                            <label for="f3obs" class="m-0">Observaciones:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text font-weight-bold"><i class="fa fa-arrow-right"></i></span>
                                </div>
                                <textarea name="f3obs" id="f3obs" class="form-control input" rows="3" placeholder="Ingrese la observacion aki . . ."></textarea>
                            </div>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="f3hora" class="m-0">Hora de finalizacion de la contrastacion: <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text font-weight-bold"><i class="fa fa-clock"></i></span>
                                </div>
                                <input type="time" name="f3hora" id="f3hora" class="form-control input">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary saveF3">Guardar FORMULARIO 3</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready( function () {
        initFv('fvf3',rulesF3());
    });
    $('.saveF3').on('click',function(){saveF3();})
    function rulesF3()
    {
        return {
            f3medidor: {required: true,},
            f3diametro: {required: true,},
            f3marca: {required: true,},
            f3clase: {required: true,},
            f3modelo: {required: true,},
            f3capacidad: {required: true,},
            f3volumen: {required: true,},

            calificacionMedidor: {required: true,},
            f3obs: {required: true,},
            f3hora: {required: true,},
        };
    }
    function cleanF3()
    {
        $('#fvf3 .input').val('');
    }
    function mf3(idPro,ins)
    {
        // $('#mf3').modal('show')
        // $('#f3idPro').val(idPro)
        // $('#f3ins').val(ins)

        // cleanF3();
        jQuery.ajax({
            url: "{{ url('form3/f3') }}",
            method: 'POST',
            data: {idPro:idPro,ins:ins},
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
            success: function (r)
            {
                if(r.data!==null)
                {
                    $('#f3medidor').val(r.data.medidor);
                    $('#f3diametro').val(r.data.diametro);
                    $('#f3marca').val(r.data.marca);
                    $('#f3clase').val(r.data.clase);
                    $('#f3modelo').val(r.data.modelo);
                    $('#f3capacidad').val(r.data.capacidad);
                    $('#f3volumen').val(r.data.volumen);
                    // ---
                    let datos = JSON.parse(r.data.resultado);
                    $('.datosTabla').each(function (index) {
                        $(this).val(datos[index]);
                    });
                    // ---
                    $('#f3obs').val(r.data.obs);
                    $('#f3hora').val(r.data.hora);
                }
                $('#mf3').modal('show')
                $('#f3idPro').val(idPro)
                $('#f3ins').val(ins)
            },
            error: function (xhr, status, error) {
                alert("Algo salio mal, porfavor contactese con el Administrador.");
                console.log(error)
                $('.overlayForm').css("display","none");
            }
        });
    }
    function validateF3()
    {
        if($('#fvf3').valid()==false)
        {return true;}
        return false;
    }
    function saveF3()
    {
        if(validateF3())
            return;
        let datosTabla = [];
        $('.datosTabla').each(function () {datosTabla.push($(this).val());});
        var formData = new FormData($("#fvf3")[0]);
        formData.append('f3idPro',$('#f3idPro').val());
        formData.append('f3ins',$('#f3ins').val());
        formData.append('resultado',JSON.stringify(datosTabla));
        $('.saveF3').prop('disabled',true);
        $('.olF3').css("display","flex");
        jQuery.ajax({
            url: "{{ url('form3/save') }}",
            method: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
            success: function (r) {
                if (r.state)
                {
                    $('.saveF3').prop('disabled',false);
                    $('#mf3').modal('hide');
                    // $('.'+$('#f3idPro').val()).find('.f5').html('<i class="fa fa-file"></i> F5');
                    buildTable();
                    fillRecords();
                }
                msgForm(r);
                $('.olF3').css("display","none");
            },
            error: function (xhr, status, error) {
                alert("Algo salio mal, porfavor contactese con el Administrador.");
                console.log(error)
                $('.olF3').css("display","none");
                $('.saveF3').prop('disabled',false);
            }
        });
    }
</script>
