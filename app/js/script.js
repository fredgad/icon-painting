"use strict";

$(function () {
  window.addEventListener('scroll', function () {
    if ($(window).width() < 910) {
      var scrolled = window.pageYOffset || document.scrollTop;

      if (scrolled > 150) {} else {}
    }
  });
  $(window).click(function (e) {
    if ($(e.target).hasClass('nav') || $(e.target).parents().hasClass('nav')) {} else {
      $('.nav-bar').removeClass('active');
      $('.nav-cont').removeClass('down');
    }
  });
  $('.nav-bar').click(function (e) {
    $('.nav-bar').toggleClass('active');
    $('.nav-cont').toggleClass('down');
    $('.nav-cont').css('top', $('.nav-bar').offset().top + 29 + 'px');
  });
});