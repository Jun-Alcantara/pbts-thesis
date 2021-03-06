// Custom Modal
var btn = document.getElementsByClassName("show-instructions");
var span = document.getElementsByClassName("close-btn");

$('.show-instructions').click(function(e){
    $('#modal-instructions').fadeIn();
    $('.custom-modal-content').slideDown();
});

$('.close-btn').click(function(e){
    $('#modal-instructions').hide();
});

$('.close-on-this-device').click(function(){
    $('#modal-instructions').hide();
    let itemname = $(this).data('item');
    localStorage.setItem(itemname,'shown')
});

window.onclick = function(event) {
    if (event.target == modal) {
        $('#modal-instructions').hide();
    }
}
// END: Custom Modal