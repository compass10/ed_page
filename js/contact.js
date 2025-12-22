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

// 개인정보 동의함 선택 시 하위 체크박스 자동 체크
const privacyRadios = document.querySelectorAll('input[name="privacy"]');
const privacySubCheckboxes = document.querySelectorAll('input[name="privacy_detail[]"]');

privacyRadios.forEach(radio => {
  radio.addEventListener('change', function() {
    if (this.value === '동의함' && this.checked) {
      // 동의함 선택 시 모든 하위 체크박스 체크
      privacySubCheckboxes.forEach(checkbox => {
        checkbox.checked = true;
      });
    } else if (this.value === '동의안함' && this.checked) {
      // 동의안함 선택 시 모든 하위 체크박스 해제
      privacySubCheckboxes.forEach(checkbox => {
        checkbox.checked = false;
      });
    }
  });
});

// 첨부파일 선택 시 파일명 표시
document.querySelectorAll('.form_file').forEach(fileInput => {
  fileInput.addEventListener('change', function() {
    const fileName = this.files.length > 0 ? this.files[0].name : '';
    // 기존 파일명 표시 요소 제거
    const existingSpan = this.parentNode.querySelector('.file_name');
    if (existingSpan) {
      existingSpan.remove();
    }
    // 파일이 선택된 경우 파일명 표시
    if (fileName) {
      const fileNameSpan = document.createElement('span');
      fileNameSpan.className = 'file_name';
      fileNameSpan.textContent = fileName;
      this.parentNode.appendChild(fileNameSpan);
    }
  });
});

// 상담문의 폼 제출 처리
const contactForm = document.getElementById('contactForm');
if (contactForm) {
  contactForm.addEventListener('submit', function(e) {
    e.preventDefault();

    // 필수 입력 검증
    const name = this.querySelector('input[name="name"]').value.trim();
    const email = this.querySelector('input[name="email"]').value.trim();
    const title = this.querySelector('input[name="title"]').value.trim();
    const message = this.querySelector('textarea[name="message"]').value.trim();
    const privacy = this.querySelector('input[name="privacy"]:checked');

    if (!name) {
      alert('이름을 입력해주세요.');
      this.querySelector('input[name="name"]').focus();
      return;
    }
    if (!email) {
      alert('이메일을 입력해주세요.');
      this.querySelector('input[name="email"]').focus();
      return;
    }
    if (!title) {
      alert('제목을 입력해주세요.');
      this.querySelector('input[name="title"]').focus();
      return;
    }
    if (!message) {
      alert('메세지를 입력해주세요.');
      this.querySelector('textarea[name="message"]').focus();
      return;
    }
    if (!privacy || privacy.value !== '동의함') {
      alert('개인정보 수집·이용에 동의해주세요.');
      return;
    }

    // 제출 버튼 비활성화
    const submitBtn = this.querySelector('.submit_btn');
    const originalText = submitBtn.textContent;
    submitBtn.disabled = true;
    submitBtn.textContent = 'SUBMITTING...';

    // FormData로 전송
    const formData = new FormData(this);

    fetch('contact_submit.php', {
      method: 'POST',
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        alert(data.message);
        contactForm.reset();
        // Board 탭으로 전환하고 페이지 새로고침
        window.location.href = 'contact.php#board';
        window.location.reload();
      } else {
        alert(data.message);
      }
    })
    .catch(error => {
      console.error('Error:', error);
      alert('문의 접수 중 오류가 발생했습니다. 다시 시도해주세요.');
    })
    .finally(() => {
      submitBtn.disabled = false;
      submitBtn.textContent = originalText;
    });
  });
}
