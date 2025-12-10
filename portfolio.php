<?php
$pageTitle = 'Portfolio';
$isSubPage = true;
$pageCss = 'portfolio';
$darkTheme = true;
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
            <button class="filter_btn active" data-filter="all">All</button>
            <button class="filter_btn" data-filter="branding">Branding</button>
            <button class="filter_btn" data-filter="poster">Poster</button>
            <button class="filter_btn" data-filter="editorial">Editorial</button>
            <button class="filter_btn" data-filter="illustration">Illustration</button>
            <button class="filter_btn" data-filter="motion">Motion</button>
            <button class="filter_btn" data-filter="uiux">UI/UX</button>
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
              <li class="swiper-slide">
                <img src="./asset/images/main/sec_07_port_img_01.gif" alt="portfolio_img">
                <div class="right_text">
                  <span class="cate">BRAND DEsign</span><br/>
                  <span class="when">BATHE CAMPAIGN, 2025</span>
                </div>
              </li>
              <li class="swiper-slide">
                <img src="./asset/images/main/sec_07_port_img_02.png" alt="portfolio_img">
                <div class="right_text">
                  <span class="cate">BRAND DEsign</span><br/>
                  <span class="when">BATHE CAMPAIGN, 2025</span>
                </div>
              </li>
              <li class="swiper-slide">
                <img src="./asset/images/main/sec_07_port_img_03.png" alt="portfolio_img">
                <div class="right_text">
                  <span class="cate">BRAND DEsign</span><br/>
                  <span class="when">BATHE CAMPAIGN, 2025</span>
                </div>
              </li>
              <li class="swiper-slide">
                <img src="./asset/images/main/sec_07_port_img_04.png" alt="portfolio_img">
                <div class="right_text">
                  <span class="cate">BRAND DEsign</span><br/>
                  <span class="when">BATHE CAMPAIGN, 2025</span>
                </div>
              </li>
              <li class="swiper-slide">
                <img src="./asset/images/main/sec_07_port_img_05.png" alt="portfolio_img">
                <div class="right_text">
                  <span class="cate">BRAND DEsign</span><br/>
                  <span class="when">BATHE CAMPAIGN, 2025</span>
                </div>
              </li>
              <li class="swiper-slide">
                <img src="./asset/images/main/sec_07_port_img_06.png" alt="portfolio_img">
                <div class="right_text">
                  <span class="cate">BRAND DEsign</span>
                  <span class="when">BATHE CAMPAIGN, 2025</span>
                </div>
              </li>
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
const portSwiper = new Swiper('.port_slide', {
  loop: true,
  slidesPerView: 'auto',
  allowTouchMove: false,
  navigation: {
    nextEl: '.port_next_btn',
    clickable: true,
  },
});
</script>
