var id_book;

$(document).ready(function () {
  $(".closeModal").click(function () {
    $("#myModal").modal("hide");
  });
  $("#buyButton").click(function () {
    if ($("#input_indConsegna").val().length > 0) {
      var body = {
        book_id: id_book,
        address: $("#input_indConsegna").val(),
      };
      var data = JSON.stringify(body);
      $.ajax({
        type: "POST",
        url: "https://ingegneria-software.herokuapp.com/public/order",
        crossDomain: true,
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        data: data,
        beforeSend: function (xhr) {
          if (localStorage.token) {
            xhr.setRequestHeader(
              "Authorization",
              "Bearer " + localStorage.token
            );
          }
        },
        success: function (data) {
          alert("Acquisto avvenuto con successo!");
          location.reload();
        },
      });
    } else {
      alert("Compilare tutti i campi");
    }
  });
});

function openModal(price, book_id) {
  $("#myModal").modal("show");
  $("#price_value").append(price);
  //id book of save inot request
  id_book = book_id;
}
