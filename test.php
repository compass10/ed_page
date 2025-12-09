<?php
$pageTitle = 'Test';
$isSubPage = true;
$pageCss = 'test';
$darkTheme = true;
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
    </div>
  </section>
</main>

<!-- GSAP -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/MotionPathPlugin.min.js"></script>
<script>
  gsap.registerPlugin(MotionPathPlugin);

  const fanWrap = document.querySelector('.fan_wrap');
  const path = document.querySelector('#motionPath');
  const pathLength = path.getTotalLength();
  const gap = 5;
  const duration = 20;

  // 원본 이미지 소스 배열
  const imageSources = [
    './asset/images/main/02_01.png',
    './asset/images/main/02_02.png',
    './asset/images/main/02_03.png',
    './asset/images/main/02_04.png',
    './asset/images/main/02_05.png'
  ];

  let itemSpacing = 510;

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
      const offsetTime = (i * spacingRatio) * duration;

      gsap.to(item, {
        motionPath: {
          path: "#motionPath",
          align: "#motionPath",
          alignOrigin: [0.5, 1],
          autoRotate: 0
        },
        duration: duration,
        ease: "none",
        repeat: -1,
        delay: -offsetTime,
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
    });
  }

  init();

  // fan_item에 호버 시 전체 멈춤 (이벤트 위임)
  fanWrap.addEventListener('mouseenter', (e) => {
    if (e.target.closest('.fan_item')) {
      gsap.globalTimeline.pause();
    }
  }, true);

  fanWrap.addEventListener('mouseleave', (e) => {
    if (e.target.closest('.fan_item')) {
      gsap.globalTimeline.resume();
    }
  }, true);
</script>

<?php include 'includes/footer.php'; ?>