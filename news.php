<?php
$pageTitle = 'News';
$isSubPage = true;
$pageCss = 'news';
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
      <div class="news_filter">
        <button class="filter_btn active" data-filter="all">All</button>
        <button class="filter_btn" data-filter="recruit">수강생 모집</button>
        <button class="filter_btn" data-filter="success">합격 소식</button>
        <button class="filter_btn" data-filter="etc">ETC</button>
      </div>
      <div class="news_area news_swiper">
        <ul class="news_list swiper-wrapper">
          <li class="swiper-slide">
            <a href="#">
              <img src="./asset/images/main/02_01.png" alt="" />
            </a>
          </li>
          <li class="swiper-slide">
            <a href="#">
              <img src="./asset/images/main/02_02.png" alt="" />
            </a>
          </li>
          <li class="swiper-slide">
            <a href="#">
              <img src="./asset/images/main/02_03.png" alt="" />
            </a>
          </li>
          <li class="swiper-slide">
            <a href="#">
              <img src="./asset/images/main/02_04.png" alt="" />
            </a>
          </li>
          <li class="swiper-slide">
            <a href="#">
              <img src="./asset/images/main/02_05.png" alt="" />
            </a>
          </li>
          <li class="swiper-slide">
            <a href="#">
              <img src="./asset/images/main/02_01.png" alt="" />
            </a>
          </li>
          <li class="swiper-slide">
            <a href="#">
              <img src="./asset/images/main/02_02.png" alt="" />
            </a>
          </li>
          <li class="swiper-slide">
            <a href="#">
              <img src="./asset/images/main/02_03.png" alt="" />
            </a>
          </li>
          <li class="swiper-slide">
            <a href="#">
              <img src="./asset/images/main/02_04.png" alt="" />
            </a>
          </li>
          <li class="swiper-slide">
            <a href="#">
              <img src="./asset/images/main/02_05.png" alt="" />
            </a>
          </li>
        </ul>
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
    </section>
  </main>

<?php include 'includes/footer.php'; ?>
<script src="js/news.js"></script>
