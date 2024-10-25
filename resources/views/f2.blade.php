<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formulario dos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetime-picker/4.17.47/css/bootstrap-datetimepicker.min.css">
</head>
<body>
    <div class="container" style="background-color: rgb(227, 237, 252)">
        <h1>Formato Nro 2</h1>
        <br>
        <form class="row g-3 needs-validation">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="exampleInputEmail1" class="form-label">Numero de Inscripcion*</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="nunInscripcion" id="nunInscripcion"
                            aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2">Button</button>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="exampleInputEmail1" class="form-label">Persona*</label>
                    <select class="form-select" name="tipoPersona" id="tipoPersona" aria-label="Default select example">
                        <option selected>Seleccione una opcion</option>
                        <option value="1">Natural</option>
                        <option value="2">Juridica</option>
                    </select>
                </div>
                <div class="col-md-8">
                    <label for="exampleInputEmail1" class="form-label">Nombre Completo*</label>
                    <input type="text" class="form-control" name="nombreCompleto" id="nombreCompleto"
                        aria-label="Last name">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="exampleInputEmail1" class="form-label">Tipo de Documento*</label>
                    <select class="form-select" name="tipoDocumento" id="tipoDocumento"
                        aria-label="Default select example">
                        <option selected>Seleccione una opcion</option>
                        <option value="1">DNI</option>
                        <option value="2">Carnet Ext.</option>
                        <option value="3">RUC</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="exampleInputEmail1" class="form-label">Numero de Documento*</label>
                    <input type="text" class="form-control" name="nroDocumento" id="nroDocumento"
                        placeholder="Last name" aria-label="Last name">
                </div>
                <div class="col-md-4">
                    <label for="exampleInputEmail1" class="form-label">Imagen del Documento(Legible)*</label>
                    <input class="form-control" name="imgDocumento" id="imgDocumento" type="file" id="formFile">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="exampleInputEmail1" class="form-label">Correo Electronico*</label>
                    <input type="text" class="form-control" name="correo" id="correo" aria-label="Last name">
                </div>
                <div class="col-md-3">
                    <label for="exampleInputEmail1" class="form-label">Celular*</label>
                    <input type="text" class="form-control" name="celular" id="celular" aria-label="Last name">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="exampleInputEmail1" class="form-label">Ubicación del Predio / Referencia*</label>
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Leave a comment here" name="txtUbicacion" id="txtUbicacion"
                            style="height: 100px"></textarea>
                        <label for="floatingTextarea2"></label>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="exampleInputEmail1" class="form-label">Ubicación a notificar (Opcional)*</label>
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Leave a comment here" name="txtNotificacion" id="txtNotificacion"
                            style="height: 100px"></textarea>
                        <label for="floatingTextarea2"></label>
                    </div>
                </div>
            </div>

            <h2>Detalle del reclamo</h2>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="exampleInputEmail1" class="form-label">Tipo de Reclamo*</label>
                    <select class="form-select" name="tipoReclamo" id="tipoReclamo"
                        aria-label="Default select example">
                        <option selected>Seleccione una opcion</option>
                        <option value="1">CONSUMO MEDIDO/ELEVADO</option>
                        <option value="2">TIPO DE TARIFA</option>
                        <option value="3">NUMERO DE UNIDADES DE USO</option>
                        <option value="4">CONSUMO ATRIBUIBLE A OTRO SERVICIO</option>
                        <option value="5">CONSUMO ATRIBUIBLE A USUARIO ANTERIOR</option>
                        <option value="6">CONSUMO NO REALIZADO POR SERVICIO CERRADO</option>
                        <option value="7">CONSUMO NO FACTURADO OPORTUNAMENTO</option>
                        <option value="8">CONSUMO PROMEDIO</option>
                        <option value="9">ASIGNACION DE CONSUMOS</option>
                        <option value="10">CONCEPTOS EMITIDOS</option>
                        <option value="11">CORTE INDEBIDO</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="exampleInputEmail1" class="form-label">Mes(es) reclamado(s)*</label>
                    <input type="month" name="mesReclamo" id="mesReclamo" class="form-control" multiple>
                </div>
            </div>
            <div class="row input-group mb-3">
                <label for="exampleInputEmail1" class="form-label">Fundamentos del reclamo*</label>
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Leave a comment here" name="txtFundamento" id="txtFundamento"
                        style="height: 100px"></textarea>
                    <label for="floatingTextarea2"></label>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="exampleInputEmail1" class="form-label">Recibo (Opcional)</label>
                    <input class="form-control" name="recibo" id="recibo" type="file">
                </div>
                <div class="col-md-6">
                    <label for="exampleInputEmail1" class="form-label">Evidencia (Opcional)</label>
                    <input class="form-control" name="evidencia" id="evidencia" type="file">
                </div>
            </div>

            <div class="row mb-3">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-secondary">Limpiar</button>
                    <button class="btn btn-primary" type="submit">Registrar</button>
                </div>
            </div>

        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>

</html>
