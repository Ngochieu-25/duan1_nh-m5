$(document).ready(function () {
  $(".my-slickSilder").slick({
    accessibility: true,
    speed: 500,
    slidesToShow: 4,
    infinite: false,
    slidesToScroll: 1,
    nextArrow: '<i class="fa-solid fa-angle-right slick-next"></i>',
    prevArrow: '<i class="fa-solid fa-angle-left slick-prev"></i>',
  });
  
  $(".slider-for").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    asNavFor: ".slider-nav",
    infinite: true,
    nextArrow: '<i class="fa-solid fa-angle-right slick-next-list"></i>',
    prevArrow: '<i class="fa-solid fa-angle-left slick-prev-list"></i>',
  });
  $(".slider-nav").slick({
    accessibility: true,
    slidesToShow: 4,
    vertical:true,
    slidesToScroll: 1,
    arrows: false,
    asNavFor: ".slider-for",
    infinite: true,
    centerMode: true,
    focusOnSelect: true,
  });
});
