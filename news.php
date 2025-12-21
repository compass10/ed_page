<?php
$pageTitle = 'News';
$isSubPage = true;
$pageCss = 'news';
$bodyClass = 'news-list';

// DB 연결 (운영서버 lib.php 사용)
include_once('../lib.php');

// 뉴스 데이터 조회 (여러 게시판에서 가져오기 + 날짜순 정렬)
// notice: 수강생 모집 / review: 합격 소식 / guide: ETC
$news_sql = "SELECT * FROM $board_table
             WHERE bid IN ('notice', 'review', 'guide')
             AND is_hidden='N'
             ORDER BY bregdate DESC
             LIMIT 0, 30";
$news_result = mysql_query($news_sql);

// bid별 카테고리 매핑
$category_map = array(
    'notice' => 'recruit',   // 수강생 모집
    'review' => 'success',   // 합격 소식
    'guide'  => 'etc'        // ETC
);

// bid별 썸네일 경로 매핑
$thumb_path_map = array(
    'notice' => 'thumb/notice/',
    'review' => 'thumb/review/',
    'guide'  => 'thumb/guide/'
);

// bid별 상세페이지 pcode 매핑
$pcode_map = array(
    'notice' => '1000002',
    'review' => '3000012',
    'guide'  => '5000020'
);
?>
<?php include 'includes/header.php'; ?>

  <main>
    <div class="page_title">
      <span class="num">06</span>
      <span class="title">News</span>
    </div>
    <section class="section page_content">
      <div class="sec_title_row">
        <h2 class="sec_title">
          <span class="avenir">Latest</span>
          <span class="instru">News</span>
        </h2>
        <h2 class="sec_title">
          <span class="avenir">oF</span>
        </h2>
        <h2 class="sec_title">
          <span class="instru">ED</span>
        </h2>
      </div>
      <div class="top_menu_line">
        <div class="news_filter">
        <button class="filter_btn active" data-filter="all">All</button>
        <button class="filter_btn" data-filter="recruit">수강생 모집</button>
        <button class="filter_btn" data-filter="success">합격 소식</button>
        <button class="filter_btn" data-filter="etc">ETC</button>
      </div>
      <div class="slide_page_nation">
        <div class="btn_prev pn_btn">
          <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="20" cy="20" r="19.5" transform="rotate(180 20 20)" stroke="black" />
            <path d="M23 12L15 20L23 28" stroke="black" stroke-width="3" />
          </svg>
        </div>
        <div class="btn_next pn_btn">
          <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="20" cy="20" r="19.5" stroke="black" />
            <path d="M17 28L25 20L17 12" stroke="black" stroke-width="3" />
          </svg>
        </div>
      </div>
      </div>
      <div class="news_area news_swiper">
        <ul class="news_list swiper-wrapper">
          <?php
          if(mysql_num_rows($news_result) > 0) {
            while($news = mysql_fetch_array($news_result)) {
              // bid에 따라 카테고리, 썸네일 경로, pcode 설정
              $bid = $news['bid'];
              $category = $category_map[$bid];
              $thumb_path = $thumb_path_map[$bid];
              $pcode = $pcode_map[$bid];
              $thumb_img = $news['bimg'] ? $_url . $thumb_path . $news['bimg'] : "./asset/images/main/02_01.png";
          ?>
          <li class="swiper-slide" data-category="<?=$category?>">
            <a href="news_detail.php?bno=<?=$news['bno']?>">
              <img src="<?=$thumb_img?>" alt="<?=htmlspecialchars($news['btitle'])?>" />
              <div class="news_info">
                <span class="news_date"><?=substr($news['bregdate'], 0, 10)?></span>
                <span class="news_title"><?=htmlspecialchars($news['btitle'])?></span>
              </div>
            </a>
          </li>
          <?php
            }
          } else {
            // 데이터 없을 때 기본 이미지 표시
          ?>
          <li class="swiper-slide">
            <a href="#">
              <img src="./asset/images/main/02_01.png" alt="뉴스 준비중" />
            </a>
          </li>
          <?php } ?>
        </ul>
      </div>
      
    </section>
  </main>

<?php include 'includes/footer.php'; ?>
<script src="js/news.js"></script>
