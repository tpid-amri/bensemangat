var swiper = new Swiper('.swiper-container', {
  cssMode: true,
  // height:680,
  // autoHeight:true,
  loop: true,
  autoplay:true,
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  pagination: {
    el: '.swiper-pagination'
  },
  mousewheel: true,
  keyboard: true,
});

window.onscroll = function() {myFunction()};

var navbar = document.getElementById("wrapper-navbar");
var sticky = navbar.offsetTop;

function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}