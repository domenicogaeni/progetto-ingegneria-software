$(document).ready(function(){
    if(localStorage.token){
        $.ajax({
            type: 'GET',
            url: 'https://ingegneria-software.herokuapp.com/public/auth/me',
            crossDomain: true,
            contentType:"application/json; charset=utf-8",
            dataType:"json",
            beforeSend: function(xhr) {
              if (localStorage.token) {
                xhr.setRequestHeader('Authorization', 'Bearer ' + localStorage.token);
              }
            },
            success: function(data){
                window.location.href = './user/index.html';
            },
            error: function(data) {   
                window.location.href = './login.html';
            }
        });
    }else{
        window.location.href = './login.html';
    }
})