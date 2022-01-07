function deleteBook(title, isbn, authors, price, gender){
    //elimina libro
    var json_ob = {
        title: title,
        isbn : isbn,
        authors: authors,
        price: price,
        gender : gender
    };
    console.log(JSON.stringify(json_ob));
    $.ajax({
        type: 'DELETE',
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
            location.reload();
        },
        error: function(data) {   
            alert("Error, retry!")
        }
    });
}