
function novDato(dato){return dato!==null && dato!=''?dato:'--';}
function initFv(id,rules)
{
    $('#'+id).validate({
        rules: rules,
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
            $(element).addClass('is-valid');
        }
    });
}
$('.onlyNumbers').on('input', function () {
    this.value = this.value.replace(/[^0-9]/g,'');
});
function initDatatable(idTabla)
{
    $('#'+idTabla).DataTable( {
        "autoWidth":false,
        "responsive":true,
        "ordering": false,
        "lengthMenu": [[5, 10,25, -1], [5, 10,25, "Todos"]],
        // "order": [[ 1, 'desc' ]],
        "language": {
            "info": "Mostrando la pagina _PAGE_ de _PAGES_. (Total: _MAX_)",
            "search":"",
            "infoFiltered": "(filtrando)",
            "infoEmpty": "No hay registros disponibles",
            "sEmptyTable": "No tiene registros guardados.",
            "lengthMenu":"Mostrar registros _MENU_ .",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        },

    } );

    $('input[type=search]').parent().css('width','100%');
    $('input[type=search]').css('width','100%');
    $('input[type=search]').css('margin','0');
    $('input[type=search]').prop('placeholder','Escriba para buscar en las columnas.');
}

function msgImportant(r)
{
    Swal.fire({
        title: r.message,
        text: r.state?"La informacion fue registrada":'Ocurrio un error!',
        icon: r.state? "success" : "error",
    });
}
function msgImportantShow(a,b,c)
{
    Swal.fire({
        title: a,
        text: b,
        icon: c,
    });
}
function msgForm(result)
{
    var Toast = Swal.mixin({
        toast: true,
        position: 'top',
        showConfirmButton: false,
        // timer: 3000
        timer:3000
    });
    if(result.state)
    {
        Toast.fire({
            icon: 'success',
            title: result.message
        });
    }
    else
    {
        if(result.validator)
        {
            let verifyObject = JSON.parse(result.message);
            if(typeof verifyObject === 'object')
            {
                var message='';
                for (const property in verifyObject)
                {
                    // console.log(`${property}: ${verifyObject[property]}`);
                    message=message+`${verifyObject[property]}`+'<br>';
                }
                Toast.fire({
                    icon: 'error',
                    title: message
                });
            }
        }
        else
        {
            Toast.fire({
                icon: 'error',
                title: result.message
            });
        }
    }
}
function isEmpty(value) {
    // Verifica si es null o undefined
    if (value === null || value === undefined) return true;

    // Verifica si es una cadena vacía
    if (typeof value === 'string' && value.trim() === '') return true;

    // Verifica si es un array vacío
    if (Array.isArray(value) && value.length === 0) return true;

    // Verifica si es un objeto vacío
    if (typeof value === 'object' && Object.keys(value).length === 0) return true;

    // Si no está vacío, retorna false
    return false;
}
