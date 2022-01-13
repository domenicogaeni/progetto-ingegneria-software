$(document).ready(function (){
    $.ajax({
        type: 'GET',
        url: 'https://ingegneria-software.herokuapp.com/public/order',
        crossDomain: true,
        contentType:"application/json; charset=utf-8",
        dataType:"json",
        beforeSend: function(xhr) {
            if (localStorage.token) {
            xhr.setRequestHeader('Authorization', 'Bearer ' + localStorage.token);
            }
        },
        success: function(data_get) {
            //story of bought book section
            $("#books_search").empty();
            var data = data_get.data.bought_books;
            var html_book = "";
            for (let index = 0; index < data.length; index++) {
            const element = data[index];
            if(index%4==0)
                html_book += '<div class="row">';
            html_book += '<div class="col-xl-3 col-md-6 mb-4">\
                                <div class="card buy_card">\
                                    <div class="card-body">\
                                        <h5 class="card-title">' + element.book_info.title + '</h5>\
                                        <h7 class="card-subtitle mb-2 text-muted">' + element.book_info.authors + ' - ' + element.book_info.gender + '</h7>\
                                        <h6 class="card-subtitle mb-2 text-muted">Prezzo: ' + element.book_info.price + '€</h6>\
                                        <h8 class="card-subtitle mb-2 text-muted"></h8>\
                                        <p class="card-text">Comprato da: ' + element.book_info.reseller_info.name + ' ' + element.book_info.reseller_info.last_name + '</p>\
                                    </div>\
                                </div>\
                            </div>';
            if(index%4==3 || index == data.length-1)
                html_book += '</div>';
            }
            $("#books_search").append(html_book);

            //story of sold book section <campi mancano>
            $("#books_sell").empty();
            var data = data_get.data.sold_books;
            var html_book = "";
            for (let index = 0; index < data.length; index++) {
            const element = data[index];
            if(index%4==0)
                html_book += '<div class="row">';
            html_book += '<div class="col-xl-3 col-md-6 mb-4">\
                                <div class="card sell_card">\
                                    <div class="card-body">\
                                        <h5 class="card-title">' + element.book_info.title + '</h5>\
                                        <h7 class="card-subtitle mb-2 text-muted">' + element.book_info.authors + ' - ' + element.book_info.gender + '</h7>\
                                        <h6 class="card-subtitle mb-2 text-muted">Prezzo: ' + element.book_info.price + '€</h6>\
                                        <h8 class="card-subtitle mb-2 text-muted"></h8>\
                                        <p class="card-text">Comprato da: ' + element.buyer_info.name + ' ' + element.buyer_info.last_name + '</p>\
                                        <section class="p-4 d-flex justify-content-center text-center w-100">\
                                            <ul class="rating" data-mdb-toggle="rating" data-mdb-readonly="true" data-mdb-value="3">\
                                                <li>\
                                                <i class="fa-star fa-sm text-primary fas active"></i>\
                                                </li>\
                                                <li>\
                                                <i class="fa-star fa-sm text-primary fas active"></i>\
                                                </li>\
                                                <li>\
                                                <i class="fa-star fa-sm text-primary fas active"></i>\
                                                </li>\
                                                <li>\
                                                <i class="far fa-star fa-sm text-primary"></i>\
                                                </li>\
                                                <li>\
                                                <i class="far fa-star fa-sm text-primary"></i>\
                                                </li>\
                                            </ul>\
                                       </section>\
                                    </div>\
                                </div>\
                            </div>';
            if(index%4==3 || index == data.length-1)
                html_book += '</div>';
            }
            $("#books_sell").append(html_book);
        },
        error: function(data) {
            alert("Error");
        }
        });
})