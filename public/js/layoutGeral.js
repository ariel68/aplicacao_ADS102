$(document).ready(function($){

    $(".btn-menu-lateral").click(function(){
        let barraLateral = $("#barra-menu-lateral");
        if(barraLateral.is(":visible")){
           barraLateral.hide();
        }else{
           barraLateral.show();
        }
    });
    

$('.money').mask('000.000.000.000.000,00', {reverse: true});
});

