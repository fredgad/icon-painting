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
  $('.navbar').click(function (e) {
    $('.navbar-button').toggleClass('active');
    $('.navbar-menu').toggleClass('down');
    $('.navbar-menu').css('top', $('.nav-bar').offset().top + 29 + 'px');
  });
});