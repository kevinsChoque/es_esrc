<div class="modal fade" id="changeReunionesModal" tabindex="-1" role="dialog" aria-labelledby="changeReunionesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changeReunionesModalLabel"><i class="fa fa-calendar-alt"></i> Cambiar fecha de inspeccion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        {{-- <button class="btn btn-link px-0" data-toggle="modal" data-target="#calendarModal"><i class="fa fa-calendar-check"></i> Ver inspecciones de tecnicos y horarios libres</button> --}}
                    </div>
                    <div class="form-group col-lg-12">
                        <label class="m-0">Inspeccion interna y externa: <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text font-weight-bold"><i class="fas fa-id-card"></i></span>
                            </div>
                            <input type="text" id="fechaInso" name="fechaInso" class="form-control flatpickr input" placeholder="Selecciona una fecha">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary checkAvailability validate" type="button"><i class="fa fa-search"></i> Verificar disponibilidad de tecnico</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-lg-6 conteinerHoursAvailableo" style="display: none;">
                        <label for="hoursAvailableo" class="m-0">Horas disponibles:</label>
                        <select id="hoursAvailableo" name="hoursAvailableo" class="form-control hoursAvailableo"></select>
                    </div>
                    <div class="form-group col-lg-3 conteinerHourInso" style="display: none;">
                        <label for="hourInsInicioo" class="m-0">Hora de inicio: <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text font-weight-bold"><i class="fa fa-calendar"></i></span>
                            </div>
                            <input type="time" id="hourInsInicioo" name="hourInsInicioo" class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-lg-3 conteinerHourInso" style="display: none;">
                        <label for="hourInsFino" class="m-0">Hora de finalizacion: <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text font-weight-bold"><i class="fa fa-calendar"></i></span>
                            </div>
                            <input type="time" id="hourInsFino" name="hourInsFino" class="form-control">
                        </div>
                        <small id="errorHourMessage" class="text-danger"></small>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary saveChangeIns"><i class="fa fa-save"></i> Guardar nueva fecha de inspeccion</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready( function () {
        flatpickr("#fechaInso", {
            dateFormat: "Y-m-d"
        });
    });
    $('.changeReunion').on('click',function()
    {
        $('#changeReunionesModal').modal('show')
        // jQuery.ajax(
        // {
        //     url: "{{ url('reu/getdate') }}",
        //     method: 'get',
        //     data:{name:'casc'},
        //     dataType: 'json',
        //     headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
        //     success: function(r){
        //         console.log(r)
        //         flatpickr("#fechaInso", {
        //             dateFormat: "Y-m-d",
        //             onDayCreate: function (dObj, dStr, fp, dayElem) {
        //                 // itera sobre las fechas que necesito resaltar
        //                 r.data.forEach(function (date) {
        //                     if (dayElem.dateObj.toISOString().slice(0, 10) === date)
        //                         dayElem.classList.add('highlighted-day');
        //                 });
        //             },
        //         });
        //         $('#changeReunionesModal').modal('show')
        //     },
        //     error: function (xhr, status, error) {
        //         msgImportant({'state':false,'message':'Algo salio mal, porfavor contactese con el Administrador.'})
        //         $('.overlayAllPage').css("display","none")
        //     }
        // });
    });
</script>
