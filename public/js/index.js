/* 
 * @author Thyago Henrique Pacher - thyago.pacher@gmail.com
 */
$(function () {
    
    $("#btnCadastrar").click(function(){
        $.ajax({
            url : "/inserir_cliente",
            type: "POST",
            data: $("#fcadastro").serialize(),
            dataType: 'json',
            success: function(data, textStatus, jqXHR){
                if(data.situacao == true){
                    swal("Cadastro", data.mensagem, "success");
                }else if(data.situacao == false){
                    swal("Erro", data.mensagem, "error");
                }
            },error: function (jqXHR, textStatus, errorThrown){
                swal("Erro", "Erro causado por:" + errorThrown, "error");
            }
        });          
    });    
    
    $("#btLocalizar").click(function () {
        $.ajax({
            url: "/recuperar_senha",
            type: "POST",
            data: $("#frecuperarSenha").serialize(),
            dataType: 'json',
            success: function (data, textStatus, jqXHR) {
                if (data.enviosenha != null && data.enviosenha == true) {
                    swal("Atenção", data.mensagem, "info");
                } else {
                    if (data.email != null && data.email != "") {
                        $("#btLocalizar").html('Enviar');
                        $("#email_achado").show();
                        $("#email_recuperar").hide();
                        $("#email_achado2").append("Envie uma senha provisória para:<br>" + data.email);
                    } else {
                        $("#btLocalizar").click(function () {
                            location.href = "/cliente/cadastro";
                        });
                        $("#emailRecuperarSenha").hide();
                        $("#btCancelar").hide();
                        $("#label1").html('Não localizamos sua conta. Abra uma conta e junte-se a nós.');
                        $("#btLocalizar").html('Abrir uma conta');
                        $("#email_achado").hide();
                        $("#email_recuperar").show();
                    }
                }
            }, error: function (jqXHR, textStatus, errorThrown) {
                swal("Erro", "Erro causado por:" + errorThrown, "error");
            }
        });
    });
    $("#btLogin").click(function () {
        $.ajax({
            url: "/login_app",
            type: "POST",
            data: $("#fLogin").serialize(),
            dataType: 'json',
            success: function (data, textStatus, jqXHR) {
                if (data.situacao != null && data.situacao == true) {
                    location.href='/home';
                } else {
                    swal("Atenção", 'E-mail ou senha inválidos!', "info");
                }
            }, error: function (jqXHR, textStatus, errorThrown) {
                swal("Erro", "Erro causado por:" + errorThrown, "error");
            }
        });
    });
});