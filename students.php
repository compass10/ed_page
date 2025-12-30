<?php
$pageTitle = 'Our Students';
$isSubPage = true;
$pageCss = 'students';
$darkTheme = true;

// DB 연결
include_once('./web/lib.php');

// 포트폴리오 이미지 조회 (순서대로)
$portfolio_sql = "SELECT * FROM $board_table WHERE bid='portfolio' AND is_hidden='N' ORDER BY bpw ASC, bno DESC";
$portfolio_result = mysql_query($portfolio_sql);

// 이미지 경로 배열 생성
$imageSources = array();
while($row = mysql_fetch_array($portfolio_result)) {
    if($row['bimg']) {
        $imageSources[] = $_url . 'thumb/portfolio/' . $row['bimg'];
    }
}

// 이미지가 없으면 기본 이미지 사용
if(empty($imageSources)) {
    $imageSources = array(
        './asset/images/student/01.JPG',
        './asset/images/student/02.png',
        './asset/images/student/03.JPG',
        './asset/images/student/04.png',
        './asset/images/student/05.jpeg'
    );
}
?>
<?php include 'includes/header.php'; ?>

<main>
  <div class="page_title">
    <span class="num">04</span>
    <span class="title">Our Students</span>
  </div>
  <section class="section page_content">
    <div class="section_wrap">

      <div class="fan_wrap">
        <!-- 곡선 path (숨김) -->
        <svg class="curve_path" viewBox="0 0 1928 208" preserveAspectRatio="none">
          <path id="motionPath"
            d="M0.286133 207.5C123.286 121.5 556.686 0.5 970.286 0.5C1383.89 0.5 1810.29 117 1926.79 207.5" fill="none"
            stroke="transparent" />
        </svg>

        <!-- 요소들은 JS에서 동적으로 생성됨 -->
      </div>

      <div class="sec_title_row center">
        <h2 class="sec_title">
          <span class="avenir">Together,</span>
          <span class="instru">we create.</span>
        </h2>
        <h2 class="sec_title" >
          <div class="line_box">
            <p class="left_text">We dream,<br>we draw,<br>we cheer<br>for each other.</p>
            <p class="right_text">We share<br>dreams,<br>colors,<br>and laughter.</p>
          </div>
          <div class="text_box">
            <span class="avenir">Together, we</span>
          <span class="instru">grow.</span>
          </div>
        </h2>
      </div>

      <!-- 모바일 전용 이미지 스택 애니메이션 -->
      <div class="mobile_image_stack">
        <div class="stack_container">
          <?php
          $mobileImages = array_slice($imageSources, 0, 5); // 최대 5개만 사용
          foreach($mobileImages as $idx => $imgSrc):
          ?>
          <div class="stack_item" data-index="<?=$idx?>">
            <img src="<?=$imgSrc?>" alt="student<?=$idx + 1?>">
          </div>
          <?php endforeach; ?>
          <p class="stack_text_left">We dream,<br>we draw,<br>we cheer<br>for each other.</p>
          <p class="stack_text_right">We share<br>dreams,<br>colors,<br>and laughter.</p>
          <div class="stack_title">
            <span class="avenir">together,</span><br/>
            <span class="instru">we grow.</span>
          </div>
        </div>
      </div>

    </div>
  </section>
</main>

<!-- GSAP -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/MotionPathPlugin.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
<script>
  gsap.registerPlugin(MotionPathPlugin);

  const fanWrap = document.querySelector('.fan_wrap');
  const path = document.querySelector('#motionPath');
  const pathLength = path.getTotalLength();
  const gap = 5;
  const duration = 20;

  // 원본 이미지 소스 배열 (PHP에서 전달)
  const imageSources = <?=json_encode($imageSources)?>;

  let itemSpacing = 510;
  let isInitialized = false;

  // 이미지 프리로드
  function preloadImages() {
    return Promise.all(imageSources.map(src => {
      return new Promise((resolve) => {
        const img = new Image();
        img.onload = resolve;
        img.onerror = resolve;
        img.src = src;
      });
    }));
  }

  // 초기화
  async function init() {
    // 이미 초기화되었으면 애니메이션만 재개
    if (isInitialized) {
      gsap.globalTimeline.resume();
      return;
    }

    // globalTimeline이 pause 상태일 수 있으므로 resume
    gsap.globalTimeline.resume();

    await preloadImages();

    // 임시 요소로 너비 계산
    const tempItem = document.createElement('div');
    tempItem.className = 'fan_item';
    tempItem.style.visibility = 'hidden';
    tempItem.innerHTML = `<img src="${imageSources[0]}" />`;
    fanWrap.appendChild(tempItem);
    await new Promise(resolve => setTimeout(resolve, 100));

    const measuredWidth = tempItem.offsetWidth;
    // offsetWidth가 0이면 기본값 사용
    itemSpacing = (measuredWidth > 0 ? measuredWidth : 490) + gap;
    console.log('measuredWidth:', measuredWidth, 'itemSpacing:', itemSpacing, 'pathLength:', pathLength);
    tempItem.remove();

    // 화면에 보이는 요소 개수
    const itemCount = 8;
    // 간격 비율
    const spacingRatio = 1 / itemCount;
    console.log('itemCount:', itemCount, 'spacingRatio:', spacingRatio);

    // 현재 이미지 인덱스 (전체 이미지 순환용)
    let currentImageIndex = 0;

    // 요소들 생성 (초기 이미지 할당)
    const items = [];
    for (let i = 0; i < itemCount; i++) {
      const item = document.createElement('div');
      item.className = 'fan_item';
      item.innerHTML = `<img src="${imageSources[currentImageIndex]}" alt="student${currentImageIndex + 1}" />`;
      item.dataset.imgIndex = currentImageIndex;
      fanWrap.appendChild(item);
      items.push(item);
      currentImageIndex = (currentImageIndex + 1) % imageSources.length;
    }

    // 각 요소에 독립적인 무한 반복 애니메이션
    items.forEach((item, i) => {
      // 각 요소의 시작 오프셋 (균등 분포)
      const startProgress = i / itemCount;

      const tween = gsap.to(item, {
        motionPath: {
          path: "#motionPath",
          align: "#motionPath",
          alignOrigin: [0.5, 1],
          autoRotate: 0
        },
        duration: duration,
        ease: "none",
        repeat: -1,
        paused: true,
        onRepeat: function () {
          // 한 바퀴 돌 때마다 다음 이미지로 교체
          const img = item.querySelector('img');
          img.src = imageSources[currentImageIndex];
          img.alt = `student${currentImageIndex + 1}`;
          item.dataset.imgIndex = currentImageIndex;
          currentImageIndex = (currentImageIndex + 1) % imageSources.length;
        },
        onUpdate: function () {
          const rect = item.getBoundingClientRect();
          const windowWidth = window.innerWidth;
          if (rect.right < 0 || rect.left > windowWidth) {
            item.style.visibility = 'hidden';
          } else {
            item.style.visibility = 'visible';
          }
        }
      });

      // 초기 위치로 progress 설정 후 재생
      tween.progress(startProgress);
      tween.play();
    });

    isInitialized = true;
  }

  // DOM 로드 완료 후 초기화 (렌더링 안정화를 위해 지연)
  function startInit() {
    // 여러 번의 렌더링 사이클 후 실행
    requestAnimationFrame(() => {
      requestAnimationFrame(() => {
        setTimeout(() => {
          init();
        }, 1000);
      });
    });
  }

  if (document.readyState === 'complete') {
    startInit();
  } else {
    window.addEventListener('load', startInit);
  }

  // bfcache에서 복원될 때 애니메이션 재개 (뒤로가기/앞으로가기)
  window.addEventListener('pageshow', (event) => {
    if (event.persisted) {
      gsap.globalTimeline.resume();
    }
  });

  // 페이지 visibility 변경 시 처리 (탭 전환)
  document.addEventListener('visibilitychange', () => {
    if (document.visibilityState === 'visible') {
      gsap.globalTimeline.resume();
    }
  });

  // fan_item에 호버 시 전체 멈춤 (이벤트 위임)
  fanWrap.addEventListener('mouseenter', (e) => {
    if (e.target.closest('.fan_item')) {
      // gsap.globalTimeline.pause();
    }
  }, true);

  fanWrap.addEventListener('mouseleave', (e) => {
    if (e.target.closest('.fan_item')) {
      // gsap.globalTimeline.resume();
    }
  }, true);

  // 모바일 이미지 스택 애니메이션
  function initMobileImageStack() {
    if (window.innerWidth > 1024) return;

    gsap.registerPlugin(ScrollTrigger);

    const stackContainer = document.querySelector('.stack_container');
    const stackItems = document.querySelectorAll('.stack_item');
    const totalItems = stackItems.length;

    if (!stackContainer || totalItems === 0) return;

    const imageStack = document.querySelector('.mobile_image_stack');

    // 각 전환(1→2, 2→3, 3→4, 4→5)마다 2단계: 현재 이미지 사라짐 + 다음 이미지 올라옴
    // totalItems=5일 때 전환 4번, 각 전환에 2단계 = 총 8단계
    const transitions = totalItems - 1; // 전환 횟수
    const segmentSize = 1 / transitions; // 각 전환당 progress 범위

    // 상태 업데이트 함수
    function updateStackState(progress) {
      // 현재 어떤 전환 중인지 계산
      const currentTransition = Math.min(Math.floor(progress / segmentSize), transitions - 1);
      const transitionProgress = (progress - currentTransition * segmentSize) / segmentSize;

      stackItems.forEach((item, index) => {
        if (index < currentTransition) {
          // 이미 지나간 이미지 - 숨김
          item.style.transform = 'translate3d(0, -120%, 0) scale(1)';
          item.style.opacity = '0';
          item.style.visibility = 'hidden';
        } else if (index === currentTransition) {
          // 현재 사라지는 중인 이미지
          if (progress <= 0 && index === 0) {
            // 초기 상태
            item.style.transform = 'translate3d(0, 0, 0) scale(1)';
            item.style.opacity = '1';
            item.style.visibility = 'visible';
          } else {
            // 위로 사라지는 중
            const p = transitionProgress;
            item.style.transform = `translate3d(0, ${-p * 120}%, 0) scale(1)`;
            item.style.opacity = String(Math.max(0, 1 - p));
            item.style.visibility = p < 1 ? 'visible' : 'hidden';
          }
        } else if (index === currentTransition + 1) {
          // 다음 이미지 - 올라오는 중
          const p = transitionProgress;
          if (p <= 0) {
            // 대기 상태
            item.style.transform = 'translate3d(30%, 100%, 0) scale(0.32)';
            item.style.opacity = '0';
            item.style.visibility = 'hidden';
          } else {
            // 올라오는 중
            item.style.transform = `translate3d(${(1 - p) * 30}%, ${(1 - p) * 100}%, 0) scale(${0.32 + p * 0.68})`;
            item.style.opacity = String(p);
            item.style.visibility = p > 0.01 ? 'visible' : 'hidden';
          }
        } else {
          // 아직 차례 안 된 이미지 - 숨김
          item.style.transform = 'translate3d(30%, 100%, 0) scale(0.32)';
          item.style.opacity = '0';
          item.style.visibility = 'hidden';
        }
      });
    }

    // 초기 상태 설정
    updateStackState(0);

    // 스크롤 트리거 설정
    ScrollTrigger.create({
      trigger: imageStack,
      start: 'top top',
      end: 'bottom bottom',
      scrub: 0.3,
      onUpdate: (self) => updateStackState(self.progress)
    });
  }

  // 모바일에서만 실행
  if (window.innerWidth <= 1024) {
    initMobileImageStack();
  }

  // 리사이즈 시 재초기화 (디바운스 적용)
  let resizeTimeout;
  window.addEventListener('resize', () => {
    clearTimeout(resizeTimeout);
    resizeTimeout = setTimeout(() => {
      ScrollTrigger.getAll().forEach(t => t.kill());
      // 인라인 스타일 초기화
      document.querySelectorAll('.stack_item').forEach(item => {
        item.style.transform = '';
        item.style.opacity = '';
        item.style.visibility = '';
      });
      if (window.innerWidth <= 1024) {
        initMobileImageStack();
      }
    }, 100);
  });
</script>

<?php include 'includes/footer.php'; ?>
