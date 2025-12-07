// 메인 탭 전환 (상담문의 / 위치안내)
document.querySelectorAll('.tab_btn').forEach(btn => {
  btn.addEventListener('click', function() {
    const tabNum = this.dataset.tab;

    document.querySelectorAll('.tab_content').forEach(content => {
      content.classList.remove('active');
    });

    document.querySelectorAll('.tab_btn').forEach(button => {
      button.classList.remove('active');
    });

    document.querySelector(`.tab_content[data-tab="${tabNum}"]`).classList.add('active');

    document.querySelectorAll(`.tab_btn[data-tab="${tabNum}"]`).forEach(button => {
      button.classList.add('active');
    });
  });
});

// 우측 탭 전환 (Contact / Board)
document.querySelectorAll('.right_tab').forEach(btn => {
  btn.addEventListener('click', function() {
    const tabName = this.dataset.rightTab;

    document.querySelectorAll('.right_tab').forEach(button => {
      button.classList.remove('active');
    });

    document.querySelectorAll('.right_content').forEach(content => {
      content.classList.remove('active');
    });

    this.classList.add('active');
    document.querySelector(`.right_content[data-right-tab="${tabName}"]`).classList.add('active');
  });
});
