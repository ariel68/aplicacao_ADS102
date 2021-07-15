$(document).ready(function(){
    $("#tipo").change(function(){
        if($("#tipo").val() == 'data'){
            $("#texto").attr('type', 'date');
        }else{
            $("#texto").attr('type', 'text');
        }
    });
});

function ordenar(){
    $("#form-ordenar").submit();
}