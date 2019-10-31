
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

$('.navbar').click((e) => {
    $('.navbar-button').toggleClass('active');
    $('.navbar-menu').toggleClass('down');
    $('.navbar-menu').css('top', $('.nav-bar').offset().top + 29 + 'px');
});


});