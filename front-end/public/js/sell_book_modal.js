$(document).ready(function(){
    $("#alert_uncomplete").hide();
    $("#buttonSell").click(function(){
        $("#myModal").modal('show');
    })
    $(".closeModal").click(function(){
        $("#myModal").modal('hide');
    })
    $("#buttonDelete").click(function(){
        alert("elimina libro");
    })
})