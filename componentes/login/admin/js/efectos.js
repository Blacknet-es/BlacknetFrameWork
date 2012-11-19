$(document).ready(function(){

    $('#form-login').keypress(function(event) {
        if (event.keyCode == '13') {
            $("#enviar-login").click();
        }
    });



    $("#enviar-login").click(
        function(){
            $.ajax({
                type: "POST",
                url: $("#form-login").attr("action"),
                data: $("#form-login").serialize(),
                success: function(msg){
                    mostrar_mensaje(1,"Los datos introducidos son correctos.<br/>Creando credenciales. . .");
                    setTimeout("location.reload()",3000);
                },
                error: function(msg){
                    mostrar_mensaje(2,"Los datos introducidos no son válidos");
                }
            });
        }
        );
});

