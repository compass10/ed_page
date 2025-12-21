// 탭 전환
document.querySelectorAll('.tab_btn').forEach(btn => {
  btn.addEventListener('click', function() {
    const tabNum = this.dataset.tab;

    // 모든 탭 컨텐츠 비활성화
    document.querySelectorAll('.tab_content').forEach(content => {
      content.classList.remove('active');
    });

    // 모든 탭 버튼 비활성화
    document.querySelectorAll('.tab_btn').forEach(button => {
      button.classList.remove('active');
    });

    // 선택한 탭 활성화
    document.querySelector(`.tab_content[data-tab="${tabNum}"]`).classList.add('active');

    // 선택한 탭의 버튼들 활성화
    document.querySelectorAll(`.tab_btn[data-tab="${tabNum}"]`).forEach(button => {
      button.classList.add('active');
    });
  });
});

// 아코디언 토글 (core_value_item)
document.querySelectorAll('.core_value_item .item_header').forEach(header => {
  header.addEventListener('click', function() {
    const item = this.closest('.core_value_item');
    const isMobile = window.innerWidth <= 1024;

    if (isMobile) {
      // 모바일: 하나만 열리도록 다른 아이템 닫기
      const isCurrentlyActive = item.classList.contains('active');
      document.querySelectorAll('.core_value_item').forEach(otherItem => {
        otherItem.classList.remove('active');
      });
      if (!isCurrentlyActive) {
        item.classList.add('active');
      }
    } else {
      // 데스크톱: 기존 토글 방식
      item.classList.toggle('active');
    }
  });
});

// 모바일 아코디언 토글 (right_col_mobile)
document.querySelectorAll('.right_col_mobile .accordion_header').forEach(header => {
  header.addEventListener('click', function() {
    const btn = this.querySelector('.accordion_btn');
    const content = this.nextElementSibling;
    const isExpanded = btn.getAttribute('aria-expanded') === 'true';

    // 토글
    btn.setAttribute('aria-expanded', !isExpanded);
    content.classList.toggle('active');
  });
});
