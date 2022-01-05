$(document).ready(function (){
    $("#inputLogout").click( function(){
      $.ajax({
        type: 'POST',
        url: 'https://ingegneria-software.herokuapp.com/public/auth/logout',
        crossDomain: true,
        contentType:"application/json; charset=utf-8",
        dataType:"json",
        beforeSend: function(xhr) {
          if (localStorage.token) {
            xhr.setRequestHeader('Authorization', 'Bearer ' + localStorage.token);
          }
        },
        success: function(data) {
          window.location.href = '../login.html';
        },
        error: function(data) {
          alert("Error!");
        }
      });
    })
})