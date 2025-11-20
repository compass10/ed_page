const newsSwiper = new Swiper('.news_swiper', {
  loop: true,
  slidesPerView: 'auto',
  // centeredSlides: true,
  allowTouchMove: false,
  navigation: {
    nextEl: '.btn_next.pn_btn',
    prevEl: '.btn_prev.pn_btn',
    clickable: true,
  },
});

// 슬라이드 hover 시 1.05배 확대 및 간격 유지
const slides = document.querySelectorAll('.news_swiper .swiper-slide');
slides.forEach((slide) => {
  const baseWidth = slide.offsetWidth;

  slide.addEventListener('mouseenter', () => {
    slide.style.width = `${baseWidth * 1.05}px`;
  });

  slide.addEventListener('mouseleave', () => {
    slide.style.width = `${baseWidth}px`;
  });
});
