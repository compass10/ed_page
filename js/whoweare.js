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

// 아코디언 토글
document.querySelectorAll('.core_value_item .item_header').forEach(header => {
  header.addEventListener('click', function() {
    const item = this.closest('.core_value_item');
    item.classList.toggle('active');
  });
});
