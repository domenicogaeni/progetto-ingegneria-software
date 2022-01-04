$(document).ready(function(){
    $("#alert_uncomplete").hide();
    $("#buttonSell").click(function(){
        $("#myModal").modal('show');
    })
    $(".closeModal").click(function(){
        $("#myModal").modal('hide');
    })
    $("#buttonActionSell").click(function(){
        if(
            $("#input_titolo").val().length>0 &&
            $("#input_autore").val().length>0 &&
            $("#input_genere").val().length>0 &&
            $("#input_ISBN").val().length>0 &&
            $("#input_price").val().length>0
        ){
            alert("ok");
            //add book request
        }else{
            $("#alert_uncomplete").show();
        }
    })
})