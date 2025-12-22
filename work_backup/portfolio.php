<?php
$pageTitle = 'Portfolio';
$isSubPage = true;
$pageCss = 'portfolio';
$darkTheme = true;

// DB 연결
include_once('../lib.php');

// 포트폴리오 슬라이드 조회 (순서대로)
$portslide_sql = "SELECT * FROM $board_table WHERE bid='portslide' AND is_hidden='N' ORDER BY bpw ASC, bno DESC";
$portslide_result = mysql_query($portslide_sql);

// 슬라이드 데이터 배열 생성
$slides = array();
while($row = mysql_fetch_array($portslide_result)) {
    $slides[] = array(
        'bno' => $row['bno'],
        'img' => $row['bimg'] ? $_url . 'thumb/portslide/' . $row['bimg'] : '',
        'category' => $row['bcate'],
        'text' => $row['btitle']
    );
}

// 슬라이드가 없으면 기본 데이터 사용
if(empty($slides)) {
    $slides = array(
        array('bno' => 0, 'img' => './asset/images/main/sec_07_port_img_01.gif', 'category' => 'branding', 'text' => "BRAND DESIGN\nBATHE CAMPAIGN, 2025"),
        array('bno' => 0, 'img' => './asset/images/main/sec_07_port_img_02.png', 'category' => 'branding', 'text' => "BRAND DESIGN\nBATHE CAMPAIGN, 2025"),
        array('bno' => 0, 'img' => './asset/images/main/sec_07_port_img_03.png', 'category' => 'poster', 'text' => "BRAND DESIGN\nBATHE CAMPAIGN, 2025"),
        array('bno' => 0, 'img' => './asset/images/main/sec_07_port_img_04.png', 'category' => 'editorial', 'text' => "BRAND DESIGN\nBATHE CAMPAIGN, 2025"),
        array('bno' => 0, 'img' => './asset/images/main/sec_07_port_img_05.png', 'category' => 'illustration', 'text' => "BRAND DESIGN\nBATHE CAMPAIGN, 2025"),
        array('bno' => 0, 'img' => './asset/images/main/sec_07_port_img_06.png', 'category' => 'motion', 'text' => "BRAND DESIGN\nBATHE CAMPAIGN, 2025"),
    );
}

// 카테고리 목록
$categories = array(
    'all' => 'All',
    'branding' => 'Branding',
    'poster' => 'Poster',
    'editorial' => 'Editorial',
    'illustration' => 'Illustration',
    'motion' => 'Motion',
    'uiux' => 'UI/UX'
);
?>
<?php include 'includes/header.php'; ?>

  <main>
    <div class="page_title">
      <span class="num">05</span>
      <span class="title">Portfolio</span>
    </div>
    <section class="section page_content">
      <div class="section_wrap">
        <div class="sec_title_row">
          <h2 class="sec_title">
            <span class="avenir">From</span>
            <span class="instru">Practice,</span>
          </h2>
          <svg class="star_icon" width="72" height="77" viewBox="0 0 72 77" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M30.7628 76.8126L31.5177 46.0498L5.19004 62.1861L0 53.1271L27.1769 38.5007L0 23.6855L5.19004 14.6265L31.5177 30.7628L30.7628 0H41.1429L40.3879 30.7628L66.81 14.6265L72 23.6855L44.9174 38.5007L72 53.1271L66.81 62.1861L40.3879 46.0498L41.1429 76.8126H30.7628Z" fill="white"/>
          </svg>
        </div>
        <div class="mobile_sub_title">
          <p class="left_text">Where passion<br>meets friendship.</p>
          <div class="right_text">
            <span class="avenir">to</span>
            <span class="instru">Masterpiece</span>
          </div>
        </div>
        <div class="filter_video_wrap">
          <div class="portfolio_filter">
            <?php foreach($categories as $key => $name): ?>
            <button class="filter_btn <?=$key == 'all' ? 'active' : ''?>" data-filter="<?=$key?>"><?=$name?></button>
            <?php endforeach; ?>
          </div>
          <div class="portfolio_video">
            <video autoplay muted loop playsinline>
              <source src="./asset/video/portfolio/port_vd_01.mp4" type="video/mp4">
            </video>
          </div>
        </div>
        <div class="port_box">
          <div class="port_slide">
            <ul class="port_list swiper-wrapper">
              <?php foreach($slides as $slide): ?>
              <li class="swiper-slide" data-category="<?=$slide['category']?>">
                <img src="<?=$slide['img']?>" alt="portfolio_img">
                <div class="right_text">
                  <?=nl2br(htmlspecialchars($slide['text']))?>
                </div>
              </li>
              <?php endforeach; ?>
            </ul>
          </div>
          <div class="port_next_btn">
            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M17 28L25 20L17 12" stroke="white" stroke-width="3"/>
              <circle cx="20" cy="20" r="19.5" stroke="white"/>
            </svg>
          </div>
        </div>
        <div class="port_bottom_row">
          <div class="left_box">
            <p>Where passion<br>meets friendship.</p>
            <div class="right_align">
              <p>We dream,<br>we draw,<br>we cheer<br>for each other.</p>
            </div>
          </div>
          <div class="right_box">
            <span class="avenir">to</span>
            <span class="instru">Masterpiece</span>
          </div>
        </div>
      </div>
    </section>
  </main>

<?php include 'includes/footer.php'; ?>
<script>
// 슬라이드 데이터 (PHP에서 전달)
const allSlides = <?=json_encode($slides)?>;

// Swiper 인스턴스
let portSwiper = null;

// Swiper 초기화 함수
function initSwiper(slides) {
  // 기존 Swiper 제거
  if(portSwiper) {
    portSwiper.destroy(true, true);
  }

  // 슬라이드 HTML 생성
  const wrapper = document.querySelector('.port_list');
  wrapper.innerHTML = slides.map(slide => `
    <li class="swiper-slide" data-category="${slide.category}">
      <img src="${slide.img}" alt="portfolio_img">
      <div class="right_text">
        ${slide.text.replace(/\n/g, '<br>')}
      </div>
    </li>
  `).join('');

  // 슬라이드가 있을 때만 Swiper 초기화
  if(slides.length > 0) {
    portSwiper = new Swiper('.port_slide', {
      loop: slides.length > 1,
      slidesPerView: 'auto',
      allowTouchMove: false,
      navigation: {
        nextEl: '.port_next_btn',
        clickable: true,
      },
    });
  }
}

// 활성화된 필터 목록
let activeFilters = ['all'];

// 필터링 함수
function filterSlides() {
  let filteredSlides;

  if(activeFilters.includes('all')) {
    filteredSlides = allSlides;
  } else {
    filteredSlides = allSlides.filter(slide => activeFilters.includes(slide.category));
  }

  // Swiper 재초기화
  initSwiper(filteredSlides);
}

// 필터 버튼 클릭 이벤트
document.querySelectorAll('.filter_btn').forEach(btn => {
  btn.addEventListener('click', function() {
    const filter = this.dataset.filter;

    if(filter === 'all') {
      // All 클릭 시 다른 필터 모두 해제
      activeFilters = ['all'];
      document.querySelectorAll('.filter_btn').forEach(b => b.classList.remove('active'));
      this.classList.add('active');
    } else {
      // All 버튼 비활성화
      const allBtn = document.querySelector('.filter_btn[data-filter="all"]');
      allBtn.classList.remove('active');
      activeFilters = activeFilters.filter(f => f !== 'all');

      // 토글 방식으로 활성화/비활성화
      if(this.classList.contains('active')) {
        this.classList.remove('active');
        activeFilters = activeFilters.filter(f => f !== filter);
      } else {
        this.classList.add('active');
        activeFilters.push(filter);
      }

      // 아무것도 선택 안 되면 All 활성화
      if(activeFilters.length === 0) {
        activeFilters = ['all'];
        allBtn.classList.add('active');
      }
    }

    filterSlides();
  });
});

// 초기 로드
filterSlides();
</script>
