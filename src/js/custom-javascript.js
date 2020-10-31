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