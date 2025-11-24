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


const portSwiper = new Swiper('.port_slide', {
  loop:true,
  slidesPerView:'auto',
  allowTouchMove: false,
    navigation: {
    nextEl: '.port_next_btn',
    clickable: true,
  },
})

// article_list hover 시 img_list에 active 클래스 추가
const articleItems = document.querySelectorAll('.article_list > li');
const imgItems = document.querySelectorAll('.pass_list .img_list > li');

articleItems.forEach((item, index) => {
  item.addEventListener('mouseenter', () => {
    imgItems.forEach((img) => img.classList.remove('active'));
    if (imgItems[index]) {
      imgItems[index].classList.add('active');
    }
  });

  item.addEventListener('mouseleave', () => {
    imgItems.forEach((img) => img.classList.remove('active'));
  });
});

// #opportunity .bottom_area .hiding_text가 화면에 보일 때 active 추가 + counting 애니메이션
inView('#opportunity .bottom_area .hiding_text', (el) => {
  el.classList.add('active');
  // counting 애니메이션
countUp('#opportunity .bottom_area .counting');
});


