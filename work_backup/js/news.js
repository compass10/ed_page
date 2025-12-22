// 필터링 함수
function filterSlides() {
  const activeFilters = document.querySelectorAll('.filter_btn.active');
  const isAll = document.querySelector('.filter_btn[data-filter="all"]').classList.contains('active');
  const slides = document.querySelectorAll('.news_swiper .swiper-slide');

  // 선택된 필터 목록
  const selectedFilters = [];
  activeFilters.forEach(btn => {
    if (btn.dataset.filter !== 'all') {
      selectedFilters.push(btn.dataset.filter);
    }
  });

  // 슬라이드 표시/숨김
  slides.forEach(slide => {
    const category = slide.dataset.category;
    if (isAll || selectedFilters.includes(category)) {
      slide.style.display = '';
    } else {
      slide.style.display = 'none';
    }
  });

  // Swiper 업데이트
  if (typeof newsSwiper !== 'undefined') {
    newsSwiper.update();
  }
}

// 필터 버튼 토글
document.querySelectorAll('.filter_btn').forEach(btn => {
  btn.addEventListener('click', function() {
    const filter = this.dataset.filter;

    if (filter === 'all') {
      // All 클릭 시 다른 버튼 모두 해제, All만 활성화
      document.querySelectorAll('.filter_btn').forEach(b => b.classList.remove('active'));
      this.classList.add('active');
    } else {
      // 개별 필터 클릭 시 All 해제
      document.querySelector('.filter_btn[data-filter="all"]').classList.remove('active');
      this.classList.toggle('active');

      // 아무것도 선택 안되면 All 활성화
      const activeFilters = document.querySelectorAll('.filter_btn.active:not([data-filter="all"])');
      if (activeFilters.length === 0) {
        document.querySelector('.filter_btn[data-filter="all"]').classList.add('active');
      }
    }

    // 필터링 적용
    filterSlides();
  });
});

// News Swiper 초기화
const newsSwiper = new Swiper('.news_swiper', {
  loop: true,
  slidesPerView: 'auto',
  allowTouchMove: false,
  navigation: {
    nextEl: '.btn_next.pn_btn',
    prevEl: '.btn_prev.pn_btn',
    clickable: true,
  },
});

// 슬라이드 hover 시 1.15배 확대 (vw 단위)
const newsSlides = document.querySelectorAll('.news_swiper .swiper-slide');
const baseWidthVw = (415 / 1920) * 100; // 기본 width vw 값
const baseHeightVw = (500 / 1920) * 100; // 기본 height vw 값
const hoverWidthVw = baseWidthVw * 1.15; // hover 시 1.15배
const hoverHeightVw = baseHeightVw * 1.15; // hover 시 1.15배

newsSlides.forEach((slide) => {
  slide.addEventListener('mouseenter', () => {
    slide.style.width = `${hoverWidthVw}vw`;
    slide.style.height = `${hoverHeightVw}vw`;
  });

  slide.addEventListener('mouseleave', () => {
    slide.style.width = `${baseWidthVw}vw`;
    slide.style.height = `${baseHeightVw}vw`;
  });
});
