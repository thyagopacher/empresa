/* 
 * @author Thyago Henrique Pacher - thyago.pacher@gmail.com
 */


function updateCoords(c) {
    $("#btCortarImagem").show();
    $('#x').val(c.x);
    $('#y').val(c.y);
    $('#w').val(c.w);
    $('#h').val(c.h);
}

function checkCoords(){
    if (parseInt($('#w').val()) || $('#w').val() == "0") {
        return true;
    }
    swal("Atenção", 'Por favor selecione a área para cortar a imagem antes de submeter', "info");
    return false;
}

$(function () {
    
    $("#enviarToken").click(function(){
        $.ajax({
            url : "/ativar",
            type: "POST",
            data: $("#fenvio").serialize(),
            dataType: 'json',
            success: function(data, textStatus, jqXHR){
                if(data.situacao == true){
                    swal("Envio Token", data.mensagem, "success");
                }else if(data.situacao == false){
                    swal("Erro", data.mensagem, "error");
                }
            },error: function (jqXHR, textStatus, errorThrown){
                swal("Erro", "Erro causado por:" + errorThrown, "error");
            }
        });          
    });
    
    $("#reenvioToken").click(function(){
        $.ajax({
            url : "/reenvio/token",
            type: "POST",
            data: $("#freenvio").serialize(),
            dataType: 'json',
            success: function(data, textStatus, jqXHR){
                if(data.situacao == true){
                    swal("Reenvio Token", "Um e-mail com o seu token será enviado!", "success");
                }else if(data.situacao == false){
                    swal("Erro", "Token não pode ser enviado!", "error");
                }
            },error: function (jqXHR, textStatus, errorThrown){
                swal("Erro", "Erro causado por:" + errorThrown, "error");
            }
        });          
    });
    
    $("#painel_foto_background").mouseover(function(){
        $("#alterarFoto").show();
    });
    $("#painel_foto_background").mouseout(function(){
        $("#alterarFoto").hide();
    });
    
    $(".list-group-item").click(function(){
        $(".list-group-item").removeClass('active');
        $(this).addClass('active');
    });
    
    var jaTemCrop = '';

    $("#painel_capa_background").click(function () { 
        if (jaTemCrop == '') {
            $("#painel_capa_background").prepend('<img id="img_capa" style="width: 100%;height: 370px;z-index: -4;margin-bottom: -370px;" src="' + $("#urlCapa").val() + '"/>');
            $('#img_capa').Jcrop({
                aspectRatio: 1,
                onSelect: updateCoords
            });
            jaTemCrop = 's';
        }
        $(".panel-body").hide();
    });

    $("#btCortarImagem").click(function () {
        $("#img_capa").remove();
        jaTemCrop = '';
        $(".panel-body").show();
        $("#btCortarImagem").hide();
    });

    $("#tipo").change(function () {
        if ($("#tipo option:selected").val() == "Matriz") {
            $(".abacode").css("display", '');
            $("#abacode").prop("disabled", true);
        } else if ($("#tipo option:selected").val() == "Filial") {
            $(".abacode").css("display", '');
            $("#abacode").val('');
            $("#abacode").prop("disabled", false);
        } else {
            $(".abacode").css("display", 'none');
        }
    });

    $("#btZerarImagem").click(function () {
        $("#x").val('0');
        $("#y").val('0');
        $("#w").val('0');
        $("#h").val('0');
    });

});