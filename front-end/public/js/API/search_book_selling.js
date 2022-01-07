$(document).ready(function (){
  $.ajax({
      type: 'GET',
      url: 'https://ingegneria-software.herokuapp.com/public/book/on_sale',
      crossDomain: true,
      contentType:"application/json; charset=utf-8",
      dataType:"json",
      beforeSend: function(xhr) {
        if (localStorage.token) {
          xhr.setRequestHeader('Authorization', 'Bearer ' + localStorage.token);
        }
      },
      success: function(data) {
        $("#libriVendita").empty();
        var data = data.data;
        var html_book = "";
        for (let index = 0; index < data.length; index++) {
          const element = data[index];
          if(index%4==0)
            html_book += '<div class="row">';
          html_book += '<div class="col-xl-3 col-md-6 mb-4">\
                              <div class="card card_color">\
                                  <div class="card-body">\
                                      <h5 class="card-title">' + element.title + '</h5>\
                                      <h7 class="card-subtitle mb-2 text-muted">' + element.authors + ' - ' + element.gender + '</h7>\
                                      <h6 class="card-subtitle mb-2 text-muted">Price: ' + element.price + '€</h6>\
                                      <h8 class="card-subtitle mb-2 text-muted"></h8>\
                                      <p class="card-text">';
                                      if(element.description != null) 
                                        html_book += element.description;
                        html_book += '</p>\
                                      <a class="btn btn-danger" onclick=\'deleteBook(' + element.id + ',"' + element.title + '","' + element.isbn + '","' + element.authors + '",' + element.price + ',"' + element.gender + '")\'>Interrompi Vendita</a>\
                                  </div>\
                              </div>\
                          </div>';
          if(index%4==3 || index == data.length-1)
            html_book += '</div>';
        }
        $("#libriVendita").append(html_book);
      },
      error: function(data) {
          alert("Error");
      }
    });
})