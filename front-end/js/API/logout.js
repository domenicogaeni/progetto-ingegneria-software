$(document).ready(function (){
    $("#inputLogout").click( function(){
        $.ajax({
            type: 'GET',
            url: 'https://ingegneria-software.herokuapp.com/public/auth/logout',
            beforeSend: function(xhr) {
              if (localStorage.token) {
                alert(localStorage.token);
                xhr.setRequestHeader('Authorization', 'Bearer ' + localStorage.token);
              }
            },
            success: function(data) {
              alert('Hello! You have successfully accessed to /api/profile.');
            },
            error: function(data) {
              alert("Sorry, you are not logged in.");
            }
          });
    })
})