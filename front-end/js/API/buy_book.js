$(document).ready(function(){
    $(".closeModal").click(function(){
        $('#myModal').modal('hide');
    })
});

function openModal(price, book_id){
    $('#myModal').modal('show');
    $('#price_value').append(price);
    //id book of save inot request
    console.log(book_id);
}