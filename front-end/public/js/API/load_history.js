$(document).ready(function () {
  $.ajax({
    type: "GET",
    url: "https://ingegneria-software.herokuapp.com/public/order",
    crossDomain: true,
    contentType: "application/json; charset=utf-8",
    dataType: "json",
    beforeSend: function (xhr) {
      if (localStorage.token) {
        xhr.setRequestHeader("Authorization", "Bearer " + localStorage.token);
      }
    },
    success: function (data_get) {
      //story of bought book section
      $("#books_search").empty();
      var data = data_get.data.bought_books;
      var html_book = "";
      for (let index = 0; index < data.length; index++) {
        const element = data[index];
        if (index % 4 == 0) html_book += '<div class="row">';
        html_book +=
          '<div class="col-xl-3 col-md-6 mb-4">\
                                <div class="card buy_card">\
                                <div class="card-header text-center fw-bold">' +
          element.book_info.title +
          ' </div>\
                                    <div class="card-body">\
                                    <h6 class="card-subtitle mb-2 text-muted">ISBN: ' +
          element.book_info.isbn.toUpperCase() +
          '</h6>\
                                        <h6 class="card-subtitle mb-2 text-muted">Autore: ' +
          element.book_info.authors
            .toLowerCase()
            .replace(/\b[a-z]/g, function (letter) {
              return letter.toUpperCase();
            }) +
          '</h6>\
                                        <h6 class="card-subtitle mb-2 text-muted">Genere: ' +
          element.book_info.gender
            .toLowerCase()
            .replace(/\b[a-z]/g, function (letter) {
              return letter.toUpperCase();
            }) +
          '</h6>\
                                        <h6 class="card-subtitle mb-2 text-muted">Prezzo: ' +
          element.book_info.price +
          '€</h6>\
                                        \
                                        <section class="p-4 d-flex justify-content-center text-center w-100">\
                                                <i id="star0" class="far fa-star fa-sm text-primary" onclick="selStar(0)"></i>\
                                                <i id="star1" class="far fa-star fa-sm text-primary" onclick="selStar(1)"></i>\
                                                <i id="star2" class="far fa-star fa-sm text-primary" onclick="selStar(2)"></i>\
                                                <i id="star3" class="far fa-star fa-sm text-primary" onclick="selStar(3)"></i>\
                                                <i id="star4" class="far fa-star fa-sm text-primary" onclick="selStar(4)"></i>\
                                        </section>\
                                        <div class="col-md-12 text-center">\
                                            <button type="button" class="btn btn-primary" onclick="vote(' +
          element.book_info.id +
          ')">Vota</button>\
                                        </div>\
                                    </div>\
                                    <div class="card-footer text-muted text-center"> Venduto da: ' +
          element.book_info.reseller_info.name
            .toLowerCase()
            .replace(/\b[a-z]/g, function (letter) {
              return letter.toUpperCase();
            }) +
          " " +
          element.book_info.reseller_info.last_name
            .toLowerCase()
            .replace(/\b[a-z]/g, function (letter) {
              return letter.toUpperCase();
            }) +
          "</div>\
                                </div>\
                            </div>";
        if (index % 4 == 3 || index == data.length - 1) html_book += "</div>";
      }
      $("#books_search").append(html_book);

      //story of sold book section <campi mancano>
      $("#books_sell").empty();
      var data = data_get.data.sold_books;
      var html_book = "";
      for (let index = 0; index < data.length; index++) {
        const element = data[index];
        if (index % 4 == 0) html_book += '<div class="row">';
        html_book +=
          '<div class="col-xl-3 col-md-6 mb-4">\
                                <div class="card sell_card">\
                                <div class="card-header text-center fw-bold">' +
          element.book_info.title +
          ' </div>\
                                    <div class="card-body">\
                                    <h6 class="card-subtitle mb-2 text-muted">ISBN: ' +
          element.book_info.isbn.toUpperCase() +
          '</h6>\
                                    <h6 class="card-subtitle mb-2 text-muted">Autore: ' +
          element.book_info.authors
            .toLowerCase()
            .replace(/\b[a-z]/g, function (letter) {
              return letter.toUpperCase();
            }) +
          '</h6>\
                                                                  <h6 class="card-subtitle mb-2 text-muted">Genere: ' +
          element.book_info.gender
            .toLowerCase()
            .replace(/\b[a-z]/g, function (letter) {
              return letter.toUpperCase();
            }) +
          '</h6>\
                                        <h6 class="card-subtitle mb-2 text-muted">Prezzo: ' +
          element.book_info.price +
          '€</h6>\
                                        <h8 class="card-subtitle mb-2 text-muted"></h8>\
                                        <p class="card-text">Comprato da: ' +
          element.buyer_info.name
            .toLowerCase()
            .replace(/\b[a-z]/g, function (letter) {
              return letter.toUpperCase();
            }) +
          " " +
          element.buyer_info.last_name
            .toLowerCase()
            .replace(/\b[a-z]/g, function (letter) {
              return letter.toUpperCase();
            }) +
          "</p>\
                                    </div>\
                                </div>\
                            </div>";
        if (index % 4 == 3 || index == data.length - 1) html_book += "</div>";
      }
      $("#books_sell").append(html_book);
    },
    error: function (data) {
      alert("Error");
    },
  });
});
var value = 0;
function selStar(num) {
  value = num + 1;
  for (var i = 0; i < 5; i++) {
    if (i <= num) $("#star" + i).addClass("fas active");
    else
      $("#star" + i)
        .removeClass("fas active")
        .addClass("far");
  }
}
function vote(id_book) {
  if (value == 0) alert("Error");
  else {
    var json_obj = {
      vote: value,
      description: "Interessante",
    };
    var data = JSON.stringify(json_obj);
    //http POST request
    $.ajax({
      type: "POST",
      url:
        "https://ingegneria-software.herokuapp.com/public/book/" +
        id_book +
        "/vote",
      crossDomain: true,
      contentType: "application/json; charset=utf-8",
      dataType: "json",
      data: data,
      beforeSend: function (xhr) {
        if (localStorage.token) {
          xhr.setRequestHeader("Authorization", "Bearer " + localStorage.token);
        }
      },
      success: function (data_get) {
        console.log("ok");
      },
      error: function () {
        alert("Error!");
      },
    });
  }
}
