$(document).ready(function () {
  $("#btnSearch").click(function () {
    $.ajax({
      type: "GET",
      url:
        "https://ingegneria-software.herokuapp.com/public/book?value=" +
        $("#inputSearch").val(),
      crossDomain: true,
      contentType: "application/json; charset=utf-8",
      dataType: "json",
      beforeSend: function (xhr) {
        if (localStorage.token) {
          xhr.setRequestHeader("Authorization", "Bearer " + localStorage.token);
        }
      },
      success: function (data) {
        $("#books_searched").empty();
        var data = data.data;
        var html_book = "";
        for (let index = 0; index < data.length; index++) {
          const element = data[index];
          if (index % 4 == 0) html_book += '<div class="row">';
          html_book +=
          '<div class="col-xl-3 col-md-6 mb-4">\
            <div class="card">\
                <div class="card-body">\
                    <h5 class="card-title">' +
          element.title +
          '</h5>\
          <h7 class="card-subtitle mb-2 text-muted"> ISBN: ' +
          element.isbn +
          '</h7><br/>\
          <h7 class="card-subtitle mb-2 text-muted">' +
          element.authors +
          " - " +
          element.gender +
          '</h7>\
          <h6 class="card-subtitle mb-2 text-muted">Prezzo: ' +
          element.price +
          '€</h6>\
           <h8 class="card-subtitle mb-2 text-muted"></h8>';
          if (element.description != null) 
            html_book += '<p class="card-text">' + element.description + '</p>';
          if(element.average_vote != null){

            html_book += '<section class="p-4 d-flex justify-content-center text-center w-100">';
            
            for(var i=0; i<5; i++){
              if((i+0.5)<=parseInt(element.average_vote)){
                html_book +='<i class="far fa-star fa-sm text-primary fas active"</i>';
              }else{
                html_book +='<i class="far fa-star fa-sm text-primary"</i>';
                console.log("NO");
              }
            }

            html_book += '</section>';
          }
          html_book += '<a class="btn btn-primary buttonBuy" onclick="openModal(' +
          element.price +
          "," +
          element.id +
          ')">Compra</a>\
                </div>\
            </div>\
          </div>';
          if (index % 4 == 3 || index == data.length - 1) html_book += "</div>";
        }
        $("#books_searched").append(html_book);
      },
      error: function (data) {
        alert("Error");
      },
    });
  });
});
