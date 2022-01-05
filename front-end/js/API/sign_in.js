$(document).ready(function(){
    $('#loginButton').on('click', function(){
        if($('#inputEmail').val().length>0){
            $('#inputEmail').removeClass('btn-danger');
            if($('#inputPassword').val().length>0){
                $('#inputPassword').removeClass('btn-danger');
                //ok send request
                var json_ob = {
                    email : $("#inputEmail").val(),
                    password : $("#inputPassword").val()
                  };
                  //convert string in json object
                  var data = JSON.stringify(json_ob);
                  alert(data);
                  $.ajax({
                    url:"https://ingegneria-software.herokuapp.com/public/auth/login",
                    type:"POST",
                    data:data,
                    contentType:"application/json; charset=utf-8",
                    dataType:"json",
                    success: function(data_value){
                      var auth_token  = data_value.data.auth_token.auth_token;
                      var name = data_value.data.name;

                      localStorage.token = auth_token;
                      localStorage.name = name;

                      window.location.href = './user/index.html'; 
                    },
                    error: function(){
                      alert("There's some error! Try Again.");
                    }
                  })
            }else{
                $('#inputPassword').addClass('btn-danger');
            }
        }else{
            $('#inputEmail').addClass('btn-danger');
        }
    })
});