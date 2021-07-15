$(document).ready(function(){
    calculaTotal(); 
    
    $("#select-status").change(function(){
        $("#form-troca-status").submit(); 
    });
});

let baseURL = $("#baseURL").val();

function trocarQuantidade(numeroPedido, idProduto, quantidade, valorUnit){
    $.ajax({
        url: baseURL+'pedidos/edit/itempedido/'+numeroPedido+'/'+idProduto+'/'+quantidade,
        })
        .done(function( data ) {
            
        });
    
    $(".valorTotal"+idProduto).html((quantidade * valorUnit).toFixed(2).replace('.',','));
    $(".valorTotal"+idProduto).val((quantidade * valorUnit));
    calculaTotal();
}

function calculaTotal(){
    let valor = 0;
    $(".valor-total-class").each(function(){
        valor += parseFloat($(this).val());
    });
    $("#totalPedido").html(valor.toFixed(2).replace('.',','));
}

function confirmaExcluir(numeroPedido){
    if(confirm('Deseja excluir este pedido, seus itens e seu histórico?')){
        $(location).attr('href', baseURL+'pedido/excluir/'+numeroPedido);
    }
}

    
