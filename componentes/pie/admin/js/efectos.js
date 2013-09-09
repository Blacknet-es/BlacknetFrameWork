$(document).ready(function(){

    //Adjust panel height
    $.fn.adjustPanel = function(){
        $(this).find("ul, .subpanel").css({
            'height' : 'auto'
        }); //Reset sub-panel and ul height

        var windowHeight = $(window).height(); //Get the height of the browser viewport
        var panelsub = $(this).find(".subpanel").height(); //Get the height of sub-panel
        var panelAdjust = windowHeight - 100; //Viewport height - 100px (Sets max height of sub-panel)
        var ulAdjust =  panelAdjust - 25; //Calculate ul size after adjusting sub-panel

        if ( panelsub > panelAdjust ) {	 //If sub-panel is taller than max height...
            $(this).find(".subpanel").css({
                'height' : panelAdjust
            }); //Adjust sub-panel to max height
            $(this).find("ul").css({
                'height' : panelAdjust
            }); ////Adjust subpanel ul to new size
        }
        else { //If sub-panel is smaller than max height...
            $(this).find("ul").css({
                'height' : 'auto'
            }); //Set sub-panel ul to auto (default size)
        }
    };

    /* EFECTOS PARA LOS BOTONES */
    $("#pie .boton-pie").mousemove(
        function () {
            $(this).addClass("ui-state-hover");
        }
        );
    $("#pie .boton-pie").mouseout(
        function () {
            $(this).removeClass("ui-state-hover");
        }
    );

    /* CARGA LAS OPCIONES DEL REGISTRO */
    $("#registro-link").click(function(){

        $("#registro").load("<? echo $app->ruta_admin; ?>/entorno.php?seccion=pie&accion=registro");
        $("#regpanel").adjustPanel(); //Run the adjustPanel function on #alertpanel
    });
    
    /* FUNCION DE LOGOU */
    $("#usuario-logout").click(function(){
        $.ajax({
            type: "POST",
            url: "<? echo $app->ruta_admin; ?>/entorno.php?seccion=login&accion=logout",
            success: function(msg){
                mostrar_mensaje(1,"Cerrando panel de administración.<br/>Eliminando credenciales. . .");
                setTimeout("location.reload()",3000);
            },
            error: function(msg){
                mostrar_mensaje(2,"No se ha podido realizar la operación");
            }
        });
    });


    /* FUNCIONES TIPO FACEBOOK */
    //Execute function on load
	$("#chatpanel").adjustPanel(); //Run the adjustPanel function on #chatpanel
	$("#alertpanel").adjustPanel(); //Run the adjustPanel function on #alertpanel
        $("#userpanel").adjustPanel(); //Run the adjustPanel function on #alertpanel

	//Each time the viewport is adjusted/resized, execute the function
	$(window).resize(function () {
		$("#chatpanel").adjustPanel();
		$("#alertpanel").adjustPanel();
                $("#userpanel").adjustPanel();
	});

	//Click event on Chat Panel + Alert Panel
	$("#chatpanel a:first, #alertpanel a:first, #userpanel a:first").click(function() { //If clicked on the first link of #chatpanel and #alertpanel...
		if($(this).next(".subpanel").is(':visible')){ //If subpanel is already active...
			$(this).next(".subpanel").hide(); //Hide active subpanel
			$("#footpanel li a").removeClass('active'); //Remove active class on the subpanel trigger
		}
		else { //if subpanel is not active...
			$(".subpanel").hide(); //Hide all subpanels
			$(this).next(".subpanel").toggle(); //Toggle the subpanel to make active
			$("#footpanel li a").removeClass('active'); //Remove active class on all subpanel trigger
			$(this).toggleClass('active'); //Toggle the active class on the subpanel trigger
		}
		return false; //Prevent browser jump to link anchor
	});

	//Click event outside of subpanel
	$(document).click(function() { //Click anywhere and...
		$(".subpanel").hide(); //hide subpanel
		$("#footpanel li a").removeClass('active'); //remove active class on subpanel trigger
	});
	$('.subpanel ul').click(function(e) {
		e.stopPropagation(); //Prevents the subpanel ul from closing on click
	});

	//Delete icons on Alert Panel
	$("#alertpanel li, #userpanel li").hover(function() {
		$(this).find("a.delete").css({'visibility': 'visible'}); //Show delete icon on hover
	},function() {
		$(this).find("a.delete").css({'visibility': 'hidden'}); //Hide delete icon on hover out
	});

});
