$(document).ready(function(){
  function isEmail($email) {
    if($email.length!=0){
        emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        return emailReg.test( $email );
    }
  }
  $('#registerButton').click(function(){
      //chech if two values of password are equal e not null
      if($('#inputPassword').val() == $('#inputPasswordConfirm').val() && $('#inputPassword').val().length>11){
          $('#inputPasswordConfirm').removeClass('btn-danger');

          //check if fname is not null
          if($('#inputFirstName').val().length >0 ){
              $('#inputFirstName').removeClass('btn-danger');

              //check if lname is not null
              if($('#inputLastName').val().length >0 ){
                  $('#inputLastName').removeClass('btn-danger');

                  //check if email is not null
                  if(isEmail($('#inputEmail').val())){
                      $('#inputEmail').removeClass('btn-danger');
                      //json object to send
                      var json_ob = {
                        name : $("#inputFirstName").val(),
                        last_name : $("#inputLastName").val(),
                        email : $("#inputEmail").val(),
                        password : $("#inputPassword").val(),
                        phone: $("#inputNumPhone").val(),
                        address: 'via Dante Alighieri'
                      };
                      //convert string in json object
                      var data = JSON.stringify(json_ob);
                      $.ajax({
                        url:"https://ingegneria-software.herokuapp.com/public/auth/register",
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
                      $('#inputEmail').addClass('btn-danger');
                  }
              }else{
                  //cognome vuoto
                  $('#inputLastName').addClass('btn-danger');
              }
          }else{
              ////nome vuoto
              $('#inputFirstName').addClass('btn-danger');
          }
      }else{
          //password sbagliate
          $('#inputPasswordConfirm').addClass('btn-danger');
      }
  })
});