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

// 슬라이드 hover 시 1.05배 확대
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
