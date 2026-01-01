// 로딩 스피너 처리
(function () {
  const pageLoader = document.getElementById('pageLoader');
  if (!pageLoader) return;

  const spinner = pageLoader.querySelector('.loader_spinner');
  let contentShownAt = null;
  let pageLoaded = false;
  let imagesLoaded = false;

  // data-duration 속성에서 유지 시간 읽기 (기본값 2000ms)
  const minDuration = parseInt(pageLoader.dataset.duration) || 2000;
  // 이미지 로드 대기 여부
  const waitForImages = pageLoader.dataset.waitForImages === 'true';

  // 콘텐츠 바로 노출
  pageLoader.classList.add('show_content');
  contentShownAt = Date.now();

  // 로더 숨김 조건 체크
  function canHideLoader() {
    if (waitForImages) {
      return pageLoaded && imagesLoaded;
    }
    return pageLoaded;
  }

  function hideLoader() {
    const now = Date.now();
    const elapsed = contentShownAt ? now - contentShownAt : 0;
    // 이미지 대기 모드일 때는 이미지 로드 후 8초 더 대기
    const duration = waitForImages ? 8000 : minDuration;
    const delay = Math.max(0, duration - elapsed);

    setTimeout(function () {
      // 스피너 서서히 멈추기
      if (spinner) {
        const computedStyle = window.getComputedStyle(spinner);
        const matrix = computedStyle.transform;
        let currentAngle = 0;

        if (matrix !== 'none') {
          const values = matrix.split('(')[1].split(')')[0].split(',');
          const a = values[0];
          const b = values[1];
          currentAngle = Math.round(Math.atan2(b, a) * (180 / Math.PI));
          if (currentAngle < 0) currentAngle += 360;
        }

        spinner.style.animation = 'none';
        spinner.style.transform = `translate(-50%, -50%) rotate(${currentAngle}deg)`;
        spinner.style.transition = 'transform 0.8s cubic-bezier(0.25, 0.1, 0.25, 1)';

        setTimeout(function () {
          spinner.style.transform = `translate(-50%, -50%) rotate(${currentAngle + 90}deg)`;
        }, 50);
      }

      // 페이드아웃
      setTimeout(function () {
        pageLoader.classList.add('hidden');
      }, 500);

      // 애니메이션 완료 후 DOM에서 제거
      setTimeout(function () {
        pageLoader.style.display = 'none';
        window.dispatchEvent(new CustomEvent('pageLoaderHidden'));
      }, 900);
    }, delay);
  }

  // 페이지 로드 완료 시
  window.addEventListener('load', function () {
    pageLoaded = true;

    // 콘텐츠가 이미 보이는 상태라면 숨기기 시작
    if (contentShownAt && canHideLoader()) {
      hideLoader();
    }
  });

  // 이미지 로드 완료 이벤트 (students.php에서 발생)
  window.addEventListener('studentsImagesLoaded', function () {
    imagesLoaded = true;

    // 콘텐츠가 이미 보이는 상태이고 페이지도 로드되었으면 숨기기 시작
    if (contentShownAt && canHideLoader()) {
      hideLoader();
    }
  });
})();

const titleArea = document.querySelectorAll('.title_area');
const footer = document.querySelector('#footer');
const menuBtn = document.querySelector('#header .menu');
const sideMenu = document.querySelector('.side_menu');
const sideClose = document.querySelector('.side_menu .top_area .right');
const header = document.querySelector('#header');

// 모바일 체크 함수
function isMobile() {
  return window.innerWidth <= 1024;
}

titleArea.forEach((item) => {
  item.addEventListener('click', () => {
    if (isMobile()) {
      // 모바일: 개별 아코디언 토글
      const parentLi = item.closest('li');
      const footerInfoList = document.querySelector('.footer_info_list');

      if (parentLi) {
        // by_ed 클릭 시 다른 메뉴들도 보이게
        if (parentLi.classList.contains('by_ed')) {
          footer.classList.toggle('menu_open');
        }
        parentLi.classList.toggle('accordion_open');
      }
    } else {
      // PC: 전체 푸터 토글
      // const toggleIcons = footer.querySelectorAll('.title_area span:last-child');
      // if(footer.classList.contains('show_content')){
      //   footer.classList.remove('show_content');
      //   toggleIcons.forEach(icon => icon.textContent = '+');
      // }else{
      //   footer.classList.add('show_content');
      //   toggleIcons.forEach(icon => icon.textContent = '-');
      // }
    }
  });
});
// 푸터 전체 토글
footer.addEventListener('click', (e) => {
  // floating_btn 클릭 시 토글 방지
  if (e.target.closest('.floating_btn')) {
    return;
  }

  if (isMobile()) {
  } else {
    const toggleIcons = footer.querySelectorAll('.title_area span:last-child');
    if (footer.classList.contains('show_content')) {
      footer.classList.remove('show_content');
    } else {
      footer.classList.add('show_content');
    }
  }
});

menuBtn.addEventListener('click', () => {
  sideMenu.classList.add('open');
});
sideClose.addEventListener('click', () => {
  sideMenu.classList.remove('open');
});

window.addEventListener('wheel', (e) => {
  if (e.deltaY > 0) {
    header.classList.remove('down');
  } else {
    header.classList.add('down');
  }
});
