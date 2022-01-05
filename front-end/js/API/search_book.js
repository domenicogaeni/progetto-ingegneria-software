$(document).ready(function (){
    $("#btnSearch").click( function(){
        alert($("#inputSearch").val());
        $.ajax({
            type: 'GET',
            url: 'https://ingegneria-software.herokuapp.com/public/book?value=' + $("#inputSearch").val(),
            crossDomain: true,
            contentType:"application/json; charset=utf-8",
            dataType:"json",
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
                alert(data.data);
              alert("Sorry, you are not logged in.");
            }
          });
    })
})