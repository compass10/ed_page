// 메인 탭 전환 (상담문의 / 위치안내)
document.querySelectorAll('.tab_btn').forEach((btn) => {
  btn.addEventListener('click', function () {
    const tabNum = this.dataset.tab;

    document.querySelectorAll('.tab_content').forEach((content) => {
      content.classList.remove('active');
    });

    document.querySelectorAll('.tab_btn').forEach((button) => {
      button.classList.remove('active');
    });

    document
      .querySelector(`.tab_content[data-tab="${tabNum}"]`)
      .classList.add('active');

    document
      .querySelectorAll(`.tab_btn[data-tab="${tabNum}"]`)
      .forEach((button) => {
        button.classList.add('active');
      });
  });
});

// 우측 탭 전환 (Contact / Board)
document.querySelectorAll('.right_tab').forEach((btn) => {
  btn.addEventListener('click', function () {
    const tabName = this.dataset.rightTab;

    document.querySelectorAll('.right_tab').forEach((button) => {
      button.classList.remove('active');
    });

    document.querySelectorAll('.right_content').forEach((content) => {
      content.classList.remove('active');
    });

    this.classList.add('active');
    document
      .querySelector(`.right_content[data-right-tab="${tabName}"]`)
      .classList.add('active');

    // URL 해시 업데이트
    history.replaceState(null, '', `#${tabName}`);
  });
});

// URL 해시에 따라 탭 자동 활성화
function activateTabByHash() {
  const hash = window.location.hash;
  let targetTab = null;

  if (hash === '#board') {
    targetTab = 'board';
  } else if (hash === '#contact') {
    targetTab = 'contact';
  }

  if (targetTab) {
    document.querySelectorAll('.right_tab').forEach((btn) => {
      btn.classList.remove('active');
    });
    document.querySelectorAll('.right_content').forEach((content) => {
      content.classList.remove('active');
    });

    const tab = document.querySelector(
      `.right_tab[data-right-tab="${targetTab}"]`,
    );
    const content = document.querySelector(
      `.right_content[data-right-tab="${targetTab}"]`,
    );

    if (tab) tab.classList.add('active');
    if (content) content.classList.add('active');
  }
}

// 페이지 로드 시 해시 확인
activateTabByHash();

// 해시 변경 시에도 탭 전환 (브라우저 뒤로가기/앞으로가기 대응)
window.addEventListener('hashchange', activateTabByHash);

// 개인정보 동의함 선택 시 하위 체크박스 자동 체크
const privacyRadios = document.querySelectorAll('input[name="privacy"]');
const privacySubCheckboxes = document.querySelectorAll(
  'input[name="privacy_detail[]"]',
);

privacyRadios.forEach((radio) => {
  radio.addEventListener('change', function () {
    if (this.value === '동의함' && this.checked) {
      // 동의함 선택 시 모든 하위 체크박스 체크
      privacySubCheckboxes.forEach((checkbox) => {
        checkbox.checked = true;
      });
    } else if (this.value === '동의안함' && this.checked) {
      // 동의안함 선택 시 모든 하위 체크박스 해제
      privacySubCheckboxes.forEach((checkbox) => {
        checkbox.checked = false;
      });
    }
  });
});

// 첨부파일 선택 시 파일명 표시
document.querySelectorAll('.form_file').forEach((fileInput) => {
  fileInput.addEventListener('change', function () {
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

// 게시판 비밀번호 폼 토글
(function () {
  const boardBody = document.querySelector('.board_body');
  if (!boardBody) return;

  // 게시판 아이템 클릭 이벤트
  boardBody.addEventListener('click', function (e) {
    console.log('click');
    const boardItem = e.target.closest('.board_item');
    console.log('click2');
    if (!boardItem) return;

    const ino = boardItem.dataset.ino;
    if (!ino) return;

    const passwordForm = boardBody.querySelector(
      `.board_password_form[data-ino="${ino}"]`,
    );
    if (!passwordForm) return;

    // 현재 열려있는 폼 닫기
    const activeForm = boardBody.querySelector('.board_password_form.active');
    if (activeForm && activeForm !== passwordForm) {
      activeForm.classList.remove('active');
      activeForm.querySelector('.password_input').value = '';
      activeForm.querySelector('.password_error').classList.remove('show');
    }

    // 클릭한 아이템의 폼 토글
    if (passwordForm.classList.contains('active')) {
      passwordForm.classList.remove('active');
      passwordForm.querySelector('.password_input').value = '';
      passwordForm.querySelector('.password_error').classList.remove('show');
    } else {
      passwordForm.classList.add('active');
      passwordForm.querySelector('.password_input').focus();
    }
  });

  // 비밀번호 확인 버튼 클릭
  boardBody.addEventListener('click', function (e) {
    const submitBtn = e.target.closest('.password_submit');
    if (!submitBtn) return;

    const passwordForm = submitBtn.closest('.board_password_form');
    const ino = passwordForm.dataset.ino;
    const passwordInput = passwordForm.querySelector('.password_input');
    const passwordError = passwordForm.querySelector('.password_error');
    const password = passwordInput.value.trim();

    if (!password) {
      passwordError.classList.add('show');
      passwordError.textContent = '비밀번호를 입력해주세요.';
      passwordInput.focus();
      return;
    }

    // 버튼 비활성화
    submitBtn.disabled = true;
    const originalText = submitBtn.textContent;
    submitBtn.textContent = '확인중...';

    // AJAX로 비밀번호 확인 및 상세 내용 가져오기
    fetch('contact_check_password.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: `ino=${encodeURIComponent(ino)}&password=${encodeURIComponent(
        password,
      )}`,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          // 비밀번호 일치 - 같은 페이지에서 상세보기로 이동
          submitBtn.textContent = '이동중...';
          setTimeout(() => {
            window.location.href = `contact.php?ino=${ino}#board`;
          }, 100);
          return;
        }
        // 비밀번호 불일치
        passwordError.textContent =
          data.message || '비밀번호가 일치하지 않습니다.';
        passwordError.classList.add('show');
        passwordInput.value = '';
        passwordInput.focus();
        submitBtn.disabled = false;
        submitBtn.textContent = originalText;
      })
      .catch((error) => {
        console.error('Error:', error);
        passwordError.textContent = '오류가 발생했습니다. 다시 시도해주세요.';
        passwordError.classList.add('show');
        submitBtn.disabled = false;
        submitBtn.textContent = originalText;
      });
  });

  // 비밀번호 입력 필드에서 엔터키 처리
  boardBody.addEventListener('keypress', function (e) {
    if (e.key === 'Enter' && e.target.classList.contains('password_input')) {
      e.preventDefault();
      const passwordForm = e.target.closest('.board_password_form');
      const submitBtn = passwordForm.querySelector('.password_submit');
      submitBtn.click();
    }
  });

  // 상세보기 닫기 버튼
  boardBody.addEventListener('click', function (e) {
    const closeBtn = e.target.closest('.detail_close');
    if (!closeBtn) return;

    const passwordForm = closeBtn.closest('.board_password_form');
    const ino = passwordForm.dataset.ino;

    // 원래 비밀번호 폼으로 복원
    passwordForm.classList.remove('detail_view');
    passwordForm.innerHTML = `
      <div class="password_form_inner">
        <span class="password_label">비밀번호</span>
        <input type="password" class="password_input" placeholder="비밀번호 입력">
        <button type="button" class="password_submit">확인</button>
      </div>
      <div class="password_error">비밀번호가 일치하지 않습니다.</div>
    `;
  });
})();

// 상담문의 폼 제출 처리
const contactForm = document.getElementById('contactForm');
if (contactForm) {
  contactForm.addEventListener('submit', function (e) {
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
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
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
      .catch((error) => {
        console.error('Error:', error);
        alert('문의 접수 중 오류가 발생했습니다. 다시 시도해주세요.');
      })
      .finally(() => {
        submitBtn.disabled = false;
        submitBtn.textContent = originalText;
      });
  });
}
