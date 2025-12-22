<?php
$pageTitle = 'News';
$isSubPage = true;
$pageCss = 'news';
$bodyClass = 'news-list';

// DB 연결
include_once('./web/lib.php');

// 메인 뉴스 데이터 조회 (mainnews 게시판)
$news_sql = "SELECT * FROM $board_table
             WHERE bid='mainnews'
             AND is_hidden='N'
             ORDER BY bpw ASC, bno DESC
             LIMIT 0, 30";
$news_result = mysql_query($news_sql);
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
          if($news_result && mysql_num_rows($news_result) > 0) {
            while($news = mysql_fetch_array($news_result)) {
              // bcate 필드에서 카테고리 가져오기
              $category = $news['bcate'] ? $news['bcate'] : 'etc';
              $thumb_img = $news['bimg'] ? $_url . 'thumb/mainnews/' . $news['bimg'] : "./asset/images/main/02_01.png";
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
