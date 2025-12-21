const newsSwiper = new Swiper('.news_swiper', {
  loop: true,
  slidesPerView: 'auto',
  // centeredSlides: true,
  allowTouchMove: true,
  navigation: {
    nextEl: '.btn_next.pn_btn',
    prevEl: '.btn_prev.pn_btn',
    clickable: true,
  },
  breakpoints : {
    1024: {
      allowTouchMove:false
    },
  }
});

// 슬라이드 hover 시 1.15배 확대 및 간격 유지 (vw 단위)
const slides = document.querySelectorAll('.news_swiper .swiper-slide');

let isMobile2 = window.innerWidth < 1024;



const baseWidthVw = (415 / 1920) * 100; // 기본 width vw 값
const baseHeightVw = (500 / 1920) * 100; // 기본 height vw 값
const hoverWidthVw = baseWidthVw * 1.15; // hover 시 1.15배
const hoverHeightVw = baseHeightVw * 1.15; // hover 시 1.15배

const baseMobileWidthVw = (167.65 / 375) * 100;
const baseMobileHeightVw = (200 / 375) * 100;
const hoverMobileWidthVw = baseMobileWidthVw * 1.15; // hover 시 1.15배
const hoverMobileHeightVw = baseMobileHeightVw * 1.15; // hover 시 1.15배
let wVw = isMobile2 ? baseMobileWidthVw : baseWidthVw;
let hVw = isMobile2 ? baseMobileHeightVw : baseHeightVw;
let hwVw = isMobile2 ? hoverMobileWidthVw : hoverWidthVw;
let hhVw = isMobile2 ? hoverMobileHeightVw :hoverHeightVw;
window.addEventListener('resiez', ()=>{
  isMobile2 = window.innerWidth < 1024;
 wVw = isMobile2 ? baseMobileWidthVw : baseWidthVw;
hVw = isMobile2 ? baseMobileHeightVw : baseHeightVw;
 hwVw = isMobile2 ? hoverMobileWidthVw : hoverWidthVw;
hhVw = isMobile2 ? hoverMobileHeightVw :hoverHeightVw;

})





slides.forEach((slide) => {
  slide.addEventListener('mouseenter', () => {
    slide.style.width = `${hwVw}vw`;
    slide.style.height = `${hhVw}vw`;
  });

  slide.addEventListener('mouseleave', () => {
    slide.style.width = `${wVw}vw`;
    slide.style.height = `${hVw}vw`;
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


inView('#textEd .text_flex .center_text .star', (el)=> {
  el.classList.add('active');
  setTimeout(()=>{
    el.classList.remove('active')
  },3000)
}, {once:false})

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
}, { rootMargin: '0px 0px -10% 0px', threshold: 0 });

// #ourStory .sliding_cont_mobile 애니메이션 (모바일)
inView('#ourStory .sliding_cont_mobile', (el) => {
  el.classList.add('active');
}, { rootMargin: '0px 0px -10% 0px', threshold: 0 });


inView('#portfolio', (el)=> {
  const header = document.querySelector('#header');
  header.style.filter = 'invert(1)';
},{once:false, rootMargin: '0px 0px -90% 0px', threshold: 0 })
inView('#opportunity', (el)=> {
  const header = document.querySelector('#header');
  header.style.filter = '';
},{once:false})