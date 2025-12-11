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

// #andMore .img_list hover 시 이미지 표시
const articleItems = document.querySelectorAll('#andMore .article_list li');
const imgItems = document.querySelectorAll('#andMore .img_list li');

articleItems.forEach((item, index) => {
  item.addEventListener('mouseenter', () => {
    imgItems.forEach(img => img.classList.remove('active'));
    if (imgItems[index]) {
      imgItems[index].classList.add('active');
    }
  });
  item.addEventListener('mouseleave', () => {
    imgItems.forEach(img => img.classList.remove('active'));
  });
});

// #opportunity .bottom_area .hiding_text가 화면에 보일 때 active 추가 + counting 애니메이션
inView('#opportunity .bottom_area .hiding_text', (el) => {
  el.classList.add('active');
  // counting 애니메이션
countUp('#opportunity .bottom_area .counting');
});

// #success .content_body.mob_only (accordion)
const accordionHeaders = document.querySelectorAll('.accordion_header');

accordionHeaders.forEach(function(header) {
  header.addEventListener('click', function() {
    const btn = header.querySelector('.accordion_btn');
    const content = header.nextElementSibling;

    const isExpanded = btn.getAttribute('aria-expanded') === 'true';
    btn.setAttribute('aria-expanded', String(!isExpanded));

    content.classList.toggle('active');
  });
});

// #ourStory .sliding_cont 애니메이션 - 섹션 상단이 화면 상단에 붙었을 때 트리거 (PC)
inView('#ourStory .sliding_cont.pc_only', (el) => {
  el.classList.add('active');
}, { rootMargin: '0px 0px -80% 0px', threshold: 0 });

// #ourStory .sliding_cont_mobile 애니메이션 (모바일)
inView('#ourStory .sliding_cont_mobile', (el) => {
  el.classList.add('active');
}, { rootMargin: '0px 0px -50% 0px', threshold: 0 });
