$(document).ready(function(){
    
    $("#buttonActionSell").click(function(){
        console.log($("#input_price").val().replace(',','.'));
        if(
            $("#input_titolo").val().length>0 &&
            $("#input_autore").val().length>0 &&
            $("#input_genere").val().length>0 &&
            $("#input_ISBN").val().length>0 &&
            $("#input_price").val().length>0
        ){
            //ok -> create book request
            var json_ob = {
                title: $("#input_titolo").val(),
                isbn: $("#input_ISBN").val(),
                authors: $("#input_autore").val(),
                price: $("#input_price").val().replace(',','.'),
                gender: $("#input_genere").val()
            }
            if(localStorage.token){
                $.ajax({
                    type: 'POST',
                    url: 'https://ingegneria-software.herokuapp.com/public/book',
                    crossDomain: true,
                    contentType:"application/json; charset=utf-8",
                    dataType:"json",
                    data: JSON.stringify(json_ob),
                    beforeSend: function(xhr) {
                      if (localStorage.token) {
                        xhr.setRequestHeader('Authorization', 'Bearer ' + localStorage.token);
                      }
                    },
                    success: function(data){
                        console.log("ok");
                    },
                    error: function(data) {   
                        alert("Error, retry!")
                    }
                });
            }
              //convert string in json object
              var data = JSON.stringify(json_ob);
        }else{
            $("#alert_uncomplete").show();
        }
    })
})