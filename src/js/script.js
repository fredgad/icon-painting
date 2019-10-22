
$(function () {

window.addEventListener('scroll', ()=> {
    if($(window).width() < 910) {
        let scrolled = window.pageYOffset || document.scrollTop;
        if (scrolled > 150) {
            
        } else {
           
        }
   }
});

$(window).click((e) => {
    if($(e.target).hasClass('nav') || $(e.target).parents().hasClass('nav')) {
        
    } else {
        $('.nav-bar').removeClass('active');
        $('.nav-cont').removeClass('down');

    }
});

$('.nav-bar').click((e) => {
    $('.nav-bar').toggleClass('active');
    $('.nav-cont').toggleClass('down');
    $('.nav-cont').css('top', $('.nav-bar').offset().top + 29 + 'px');
});


});