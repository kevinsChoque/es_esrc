<div class="modal fade" id="mderivo" tabindex="-1" role="dialog" aria-labelledby="mderivoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="overlay olderivo" style="display: none;">
                <div class="spinner"></div>
            </div>
            <div class="overlay olF3" style="display: none;">
                <div class="spinner"></div>
            </div>
            <div class="modal-header">
                <h5 class="modal-title" id="mderivoLabel"><i class="fa fa-file"></i> El expediente fue derivado a...</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="fvderivo">
                    <input type="hidden" class="deridPro" id="deridPro">
                    <input type="hidden" class="derins" id="derins">
                    <div class="row">
                        <div class="form-group col-lg-12">
                            <label for="oficina" class="m-0">Oficina donde se derivo expediente: <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text font-weight-bold"><i class="fa fa-hashtag"></i></span>
                                </div>
                                <input type="text" name="oficina" id="oficina" class="form-control input">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="px-1 conteinerMessageFileDerivo">
                            <div class="row">
                                <div class="col-lg-9 mb-1">
                                    <div class="callout callout-warning py-2">
                                        <h5 class="font-weight-bold">Ten en cuenta!</h5>
                                        <p>Este formato es para resumir el acta
                                            de inspeccion interna, en caso de actualizar el formato 5, subo otro archivo el cual reemplazara el actual.</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 mb-1 d-flex justify-content-center align-items-center">
                                    <a class="btn btn-link py-1 font-weight-bold linkFileDerivo" target="_blank" href=""><i class="fa fa-file"></i> Archivo de inspeccion</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <div class="alert text-center boxFile h-100 d-flex flex-column justify-content-center" style="border: 4px dashed #000;background: #ebeff5;">
                                <h5 class="font-italic font-weight-bold m-auto nameFile">ARCHIVO DE INSPECCION</h5>
                                <p class="font-italic m-0 msgClick">Realiza click aki, para subir el archivo</p>
                                <p class="m-auto"><i class="fa fa-upload fa-2x"></i></p>
                            </div>
                            <input type="file" id="fileDerivo" name="fileDerivo" class="pdfFile" style="display: none;" data-name="ARCHIVO DE INSPECCION">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary saveDerivo">Guardar</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready( function () {

    });
    $('.saveDerivo').on('click',function(){saveDerivo();})
    function saveDerivo()
    {
        if($('#fileDerivo')[0].files.length==0)
        {alert("No se subio el documento de la inspeccion.");return;}
        var formData = new FormData($("#fvderivo")[0]);
        formData.append('idPro',$('#deridPro').val());
        formData.append('ins',$('#derins').val());
        $('.saveDerivo').prop('disabled',true);
        $('.olderivo').css("display","flex");
        jQuery.ajax({
            url: "{{ url('inspection/saveDerivo') }}",
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
                    $('.saveDerivo').prop('disabled',false);
                    $('#mderivo').modal('hide');
                    buildTable();
                    fillRecords();
                }
                msgForm(r);
                $('.olderivo').css("display","none");
            },
            error: function (xhr, status, error) {
                alert("Algo salio mal, porfavor contactese con el Administrador.");
                console.log(error)
                $('.olderivo').css("display","none");
                $('.saveDerivo').prop('disabled',false);
            }
        });
    }
    function mDerivar(idPro,ins)
    {
        // $('#mderivo').modal('show')
        // $('#deridPro').val(idPro)
        // $('#derins').val(ins)

        loadFile($('#fileDerivo'),false);
        jQuery.ajax({
            url: "{{ url('inspection/fileDerivo') }}",
            method: 'POST',
            data: {idPro:idPro,ins:ins},
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
            success: function (r) {
                $('.conteinerMessageFileDerivo').css('display','none');
                if(r.data.fileDerivo!==null)
                {
                    $('.conteinerMessageFileDerivo').css('display','block');
                    let href = "{{ url('inspection/showFileDerivo') }}"
                    $('.linkFileDerivo').attr("href",href+"/"+r.data.idPro)
                }
                $('#mderivo').modal('show')
                $('#deridPro').val(idPro)
                $('#derins').val(ins)
                $('#oficina').val(r.data.oficina)
            },
            error: function (xhr, status, error) {
                alert("Algo salio mal, porfavor contactese con el Administrador.");
                console.log(error)
                $('.overlayForm').css("display","none");
            }
        });
    }
</script>
