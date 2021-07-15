$(document).ready(function(){

   let btnPedido = $("#btn-pedidos");
   let btnCliente = $("#btn-cliente");

   btnCliente.click(function(){
       btnPedido.removeClass('btn-primary');
       btnPedido.addClass('btn-secondary')

       btnCliente.removeClass('btn-secondary');
       btnCliente.addClass('btn-primary');

       $("#div-cliente").show();
       $("#div-pedidos").hide();
   });

   btnPedido.click(function(){
       btnCliente.removeClass('btn-primary');
       btnCliente.addClass('btn-secondary')

       btnPedido.removeClass('btn-secondary');
       btnPedido.addClass('btn-primary');

       $("#div-pedidos").show();
       $("#div-cliente").hide();
   });
    
});

function confirmExcluir(url){
        if(confirm('Deseja realmente excluir este cliente?')){
            $(location).attr('href', url);
        }
}

function ordenar(){
    $("#form-ordenar").submit();
}

