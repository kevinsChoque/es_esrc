<script src="{{asset('js/calendar/index.global.js')}}"></script>

<div class="modal fade" id="changeInspectionsModal" tabindex="-1" role="dialog" aria-labelledby="changeInspectionsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changeInspectionsModalLabel"><i class="fa fa-calendar-alt"></i> Cambiar fecha de inspeccion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <button class="btn btn-link px-0" data-toggle="modal" data-target="#calendarModal"><i class="fa fa-calendar-check"></i> Ver inspecciones de tecnicos y horarios libres</button>
                    </div>
                    <div class="form-group col-lg-12">
                        <label class="m-0">Inspeccion interna y externa: <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text font-weight-bold"><i class="fas fa-id-card"></i></span>
                            </div>
                            <input type="text" id="fechaIns" name="fechaIns" class="form-control flatpickr input" placeholder="Selecciona una fecha">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary checkAvailability validate" type="button"><i class="fa fa-search"></i> Verificar disponibilidad de tecnico</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-lg-6 conteinerHoursAvailable" style="display: none;">
                        <label for="hoursAvailable" class="m-0">Horas disponibles:</label>
                        <select id="hoursAvailable" name="hoursAvailable" class="form-control hoursAvailable"></select>
                    </div>
                    <div class="form-group col-lg-3 conteinerHourIns" style="display: none;">
                        <label for="hourInsInicio" class="m-0">Hora de inicio: <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text font-weight-bold"><i class="fa fa-calendar"></i></span>
                            </div>
                            <input type="time" id="hourInsInicio" name="hourInsInicio" class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-lg-3 conteinerHourIns" style="display: none;">
                        <label for="hourInsFin" class="m-0">Hora de finalizacion: <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text font-weight-bold"><i class="fa fa-calendar"></i></span>
                            </div>
                            <input type="time" id="hourInsFin" name="hourInsFin" class="form-control">
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
<div class="modal fade" id="calendarModal" tabindex="-1" role="dialog" aria-labelledby="calendarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 96% !important;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="calendarModalLabel"><i class="fa fa-calendar-alt"></i> Fechas de inspecciones y horarios libres</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="form-group col-lg-4">
                        <label class="m-0">Seleccione mes:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text font-weight-bold"><i class="fas fa-calendar-day"></i></span>
                            </div>
                            <input type="month" id="monthPicker" class="form-control" style="width: 200px;"/>
                        </div>
                    </div>
                    <div class="form-group col-lg-2">
                        <label class="m-0"></label>
                        <div class="form-control p-0" style="border: none;">
                            <button class="btn btn-outline-secondary w-100 showCalendars"><i class="fa fa-search"></i> Buscar calendario</button>
                        </div>
                    </div>
                </div>
                <div class="row containerCalendarios" style="display: none;">
                    <div class="col-lg-12">
                        <div class="alert alert-primary containerDateMonth">
                            <h3 class="m-0 text-center">-</h3>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="font-weight-bold alert alert-info py-1">
                            <h3 class="m-0 text-center">Horarios de inspeccion</h3>
                        </div>
                        <div id="calendar" style="width: 100%; height: 900px;"></div>
                    </div>
                    <div class="col-lg-6">
                        <div class="font-weight-bold alert alert-info py-1">
                            <h3 class="m-0 text-center">Horarios disponibles</h3>
                        </div>
                        <div id="calendarMes" style="width: 100%; height: 700px;"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<script>
    $('.saveChangeIns').on('click',function(){
        saveChangeIns()
    });
    $('.hoursAvailable').on('change',function(){
        $('.conteinerHourIns').css('display','block');
        hourSelected = $(this).val();
        $('#hourInsInicio').val('')
        $('#hourInsFin').val('')
    });
    $('#hourInsInicio, #hourInsFin').on('change', function () {
        const startHour = $('#hourInsInicio').val(); // Hora de inicio
        const endHour = $('#hourInsFin').val(); // Hora de finalización
        const interval = $('#hoursAvailable').val(); // Obtener el valor del select
        const [sinvalor ,intervalStart, intervalEnd] = interval.split('-'); // Dividir el intervalo en hora de inicio y fin
        // Validar que las horas estén dentro del intervalo
        if (startHour && (startHour < intervalStart || startHour > intervalEnd))
        {
            $('#errorHourMessage').text(`La hora de inicio debe estar entre ${intervalStart} y ${intervalEnd}.`);
            $('#hourInsInicio').val(''); // Limpiar hora de inicio
            return;
        }
        if (endHour && (endHour < intervalStart || endHour > intervalEnd))
        {
            $('#errorHourMessage').text(`La hora de finalización debe estar entre ${intervalStart} y ${intervalEnd}.`);
            $('#hourInsFin').val(''); // Limpiar hora de finalización
            return;
        }
        // Validar que la hora final sea mayor que la inicial
        if (startHour && endHour && endHour <= startHour)
        {
            $('#errorHourMessage').text('La hora de finalización debe ser mayor que la hora de inicio.');
            $('#hourInsFin').val(''); // Limpiar hora final
            return;
        }
        // Si todo es válido, limpiar mensajes de error
        $('#errorHourMessage').text('');
    });


    $('.showCalendars').on('click',function(){
        $('.containerCalendarios').css('display','flex');
        $('.overlayAllPage').css('display','flex');
        var ajax1 = inspectionsDisponiblesMes();
        var ajax2 = inspectionsProgramadasMes();
        // Esperar a que ambas terminen
        $.when(ajax1, ajax2)
            .done(function (response1, response2) {
                // alert('Ambos calendarios se han cargado correctamente.');

                // let monthNumber = parseInt($('#monthPicker').val().split('-')[1]) - 1;
                // let monthNames = [
                //     'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                //     'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                // ];
                // $('.containerDateMonth>h3').html('Mes seleccionado: ' + monthNames[monthNumber])
                let [year, month] = $('#monthPicker').val().split('-'); // "2024" y "11"
                let monthNumber = parseInt(month) - 1; // Convertir a índice (0-11)
                let monthNames = [
                    'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                    'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                ];
                $('.containerDateMonth>h3').html(`Fecha seleccionada: ${monthNames[monthNumber]} ${year}`)
                $('.overlayAllPage').css("display","none")
                // $('.containerCalendarios').css('display','flex');
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                // Manejar errores de cualquiera de las solicitudes
                $('.containerCalendarios').css('display','none');
                alert('Ocurrió un error al cargar los calendarios.');
                console.error(textStatus, errorThrown);
            });
    });
    function saveChangeIns()
    {
        $.ajax({
            url: "{{ url('ins/saveChangeIns') }}",
            method: 'POST',
            data: {
                codRec: $('#codRec').val(),
                fechaIns: $('#fechaIns').val(),
                hoursAvailable: $('#hoursAvailable').val(),
                hourInsInicio: $('#hourInsInicio').val(),
                hourInsFin: $('#hourInsFin').val(),
            },
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
            success: function (r) {
                // console.log(r)
                msgImportant(r)
                $('#changeInspectionsModal').modal('hide')
            },
            error: function (xhr) {
                alert('Error al obtener los horarios disponibles');
            }
        });
    }
    function inspectionsDisponiblesMes()
    {
        return $.ajax({
            url: "{{ url('ins/obtenerHorariosDisponiblesPorMes') }}",
            type: 'GET',
            data: { mes: $('#monthPicker').val() },
            success: function (response) {
                if (response.data)
                    renderCalendarLibres(response.data);
            },
            error: function (xhr) {
                alert('Error al obtener los horarios disponibles');
            }
        });
    }
    function inspectionsProgramadasMes()
    {
        return $.ajax({
            url: "{{ url('ins/obtenerInspecciones') }}",
            type: 'GET',
            data: { mes: $('#monthPicker').val() }, // Enviar el mes como parámetro
            success: function (response) {
                if (response.data)
                    renderCalendarProgramadas(response.data);
                else
                    alert("No se encontraron datos para el mes seleccionado.");
            },
            error: function (xhr) {
                console.error(xhr.responseText);
                alert('Error al obtener las inspecciones programadas.');
            }
        });
    }
    function renderCalendarLibres(horarios)
    {
        var calendarElMes = document.getElementById('calendarMes');
        var eventsMes = horarios.map(function (horario) {
            return {
                title: `${horario.tecnico}`,
                start: `${horario.date}T${horario.hora_inicio}:00`,
                end: `${horario.date}T${horario.hora_fin}:00`,
                color: '#00cc99', // Color para los intervalos libres
            };
        });
        var calendarMes = new FullCalendar.Calendar(calendarElMes, {
            initialView: 'dayGridMonth',
            initialDate: $('#monthPicker').val()+'-01',
            // headerToolbar: {left: '',center: 'title',right: ''},
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: eventsMes,
            eventClick: function(info)
            {
                alert(
                    'Inicio: ' + FullCalendar.formatDate(info.event.start, {
                        hour: '2-digit',
                        minute: '2-digit',
                        hour12: true
                    }) +
                    '\nFin: ' + FullCalendar.formatDate(info.event.end, {
                        hour: '2-digit',
                        minute: '2-digit',
                        hour12: true
                    })
                );
            },
            eventContent: function(arg) {
                let timeRange = document.createElement('div');
                let title = document.createElement('div');
                timeRange.innerText = FullCalendar.formatDate(arg.event.start, {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: true
                }) + ' - ' + FullCalendar.formatDate(arg.event.end, {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: true
                })+' - '+arg.event.title;
                return { domNodes: [timeRange] };
                // title.innerText = ' | '+arg.event.title;
                // return { domNodes: [timeRange, title] };
            },
            eventDidMount: function (info) {
                // Alternar colores
                const colors = ['#a3e97f', '#a3e97f']; // Colores suaves (rojo y amarillo claro)
                info.el.style.backgroundColor = colors[info.event.id % colors.length];
                info.el.style.color = '#000'; // Texto negro para contraste
                info.el.style.borderRadius = '5px';
            }
        });
        calendarMes.render();
    }

    var calendarMesPro; // Variable global para el calendario
    function renderCalendarProgramadas(horarios)
    {
        var calendarElMesPro = document.getElementById('calendar');
        if (calendarMesPro)
            calendarMesPro.destroy();
        var eventsMesPro = horarios.map(function (horario) {
            return {
                title: horario.title,
                start: horario.start,
                end: horario.end,
                color: '#00cc99', // Color por defecto
            };
        });
        calendarMesPro = new FullCalendar.Calendar(calendarElMesPro, {
            initialView: 'dayGridMonth',
            initialDate: $('#monthPicker').val()+'-01',
            // headerToolbar: { left: '', right: '' },
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: eventsMesPro,
            eventClick: function(info)
            {
                alert(
                    'Inicio: ' + FullCalendar.formatDate(info.event.start, {
                        hour: '2-digit',
                        minute: '2-digit',
                        hour12: true
                    }) +
                    '\nFin: ' + FullCalendar.formatDate(info.event.end, {
                        hour: '2-digit',
                        minute: '2-digit',
                        hour12: true
                    })
                );
            },
            eventContent: function (arg) {
                let timeRange = document.createElement('div');
                timeRange.innerText =
                    FullCalendar.formatDate(arg.event.start, {
                        hour: '2-digit',
                        minute: '2-digit',
                        hour12: true,
                    }) +
                    ' - ' +
                    FullCalendar.formatDate(arg.event.end, {
                        hour: '2-digit',
                        minute: '2-digit',
                        hour12: true,
                    }) +' - '+arg.event.title;
                return { domNodes: [timeRange] };
            },
            eventDidMount: function (info) {
                const colors = ['#c5c5fa', '#cefef3']; // Colores suaves alternados
                info.el.style.backgroundColor = colors[info.event.id % colors.length];
                info.el.style.color = '#000'; // Texto negro
                info.el.style.borderRadius = '5px';
            },
        });

        calendarMesPro.render();
    }



</script>

<style>
    .flatpickr-day.flatpickr-disabled {
        background-color: red !important;
        color: white !important;
        opacity: 0.8;
    }
    .fc-event {
        white-space: normal; /* Permitir que el texto se ajuste al recuadro */
        word-wrap: break-word; /* Ajustar las palabras largas */
        line-height: 1.2; /* Ajustar el espacio entre líneas */
        padding: 5px; /* Espaciado interno */
    }

    .fc-event-title,
    .fc-event-time {
        display: block; /* Forzar que cada elemento esté en una nueva línea */
        text-align: center; /* Centrar el texto */
        font-size: 12px; /* Tamaño de fuente ajustado */
    }
    .fc-header-toolbar.fc-toolbar.fc-toolbar-ltr{
        display: none;
    }
    .highlighted-day {
        background-color: #ffcccc; /* Fondo rojo claro */
        color: #000; /* Texto negro */
        border-radius: 50%; /* Hacerlo circular (opcional) */
    }
</style>
<script>
    $(document).ready( function () {
        flatpickr("#fechaIns", {
            dateFormat: "Y-m-d"
        });
    });
    $('.changeInspections').on('click',function(){
        jQuery.ajax(
        {
            url: "{{ url('ins/getdate') }}",
            method: 'get',
            data:{name:'casc'},
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
            success: function(r){
                console.log(r)
                flatpickr("#fechaIns", {
                    dateFormat: "Y-m-d",
                    onDayCreate: function (dObj, dStr, fp, dayElem) {
                        // itera sobre las fechas que necesito resaltar
                        r.data.forEach(function (date) {
                            if (dayElem.dateObj.toISOString().slice(0, 10) === date)
                                dayElem.classList.add('highlighted-day');
                        });
                    },
                });
                $('#changeInspectionsModal').modal('show')
            },
            error: function (xhr, status, error) {
                msgImportant({'state':false,'message':'Algo salio mal, porfavor contactese con el Administrador.'})
                $('.overlayAllPage').css("display","none")
            }
        });
    });
$('.checkAvailability').on('click',function(){
    $('.conteinerHourIns').css('display','none')
    $('.conteinerHoursAvailable').css('display','none');
    var fecha = $('#fechaIns').val();
    jQuery.ajax({
        url: "{{ url('ins/getavailable') }}",
        method: 'get',
        data: {dateIns:$('#fechaIns').val()},
        dataType: 'json',
        success: function (r) {
            $('#hourIns').val('')
            hourSelected = null;
            if(r.data.length>0)
            {
                $('.conteinerHourIns').css('display','block');
                $('.conteinerHoursAvailable').css('display','none');
            }
            else
            {
                $('.conteinerHourIns').css('display','none')
                $('.conteinerHoursAvailable').css('display','block');
                getAvailableHours($('#fechaIns').val());
            }
            // getAvailableHours($('#fechaIns').val());
            console.log('available')
            console.log(r)
        },
        error: function (xhr, status, error) {
            msgImportantShow("Algo salio mal, porfavor contactese con el Administrador.",'Administrador','error')
        }
    });
});
function getAvailableHours(fecha)
{
    jQuery.ajax({
        url: "{{ url('ins/gethora') }}",
        method: 'POST',
        data: {dateIns:$('#fechaIns').val()},
        dataType: 'json',
        headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
        success: function (r) {
            ppp=r
            console.log(r)
            var horarioSelect = $('#hoursAvailable');
            horarioSelect.empty();
            if (r.data.length > 0) {
                horarioSelect.append("<option value='0' disabled selected>Seleccione un horario de inspeccion disponible</option>");
                $.each(r.data, function(index, horario) {
                    var option = $('<option></option>')
                        .val(`${horario.tecnical}-${horario.hora_inicio}-${horario.hora_fin}`)
                        .text(`Tecnico ${horario.tecnical} | ${horario.hora_inicio} a ${horario.hora_fin}`);
                    horarioSelect.append(option);
                });
            } else {
                var option = $('<option></option>').val("").text("No hay técnicos disponibles");
                horarioSelect.append(option);
            }
        },
        error: function (xhr, status, error) {
            alert("Algo salio mal, porfavor contactese con el Administrador.");
        }
    });
}

</script>
