<?php
$pageTitle = 'News';
$isSubPage = true;
$pageCss = 'news';

// DB 연결
include_once('../lib.php');

// bno 파라미터 확인
$bno = isset($_GET['bno']) ? (int)$_GET['bno'] : 0;
$bid = isset($_GET['bid']) ? $_GET['bid'] : '';

if($bno == 0) {
    header('Location: news.php');
    exit;
}

// 게시물 조회
$news_sql = "SELECT * FROM $board_table WHERE bno='$bno'";
$news_result = mysql_query($news_sql);
$news = mysql_fetch_array($news_result);

if(!$news) {
    header('Location: news.php');
    exit;
}

// 조회수 증가
mysql_query("UPDATE $board_table SET bview = bview + 1 WHERE bno='$bno'");

// bid별 썸네일 경로 매핑
$thumb_path_map = array(
    'notice' => 'thumb/notice/',
    'review' => 'thumb/review/',
    'guide'  => 'thumb/guide/'
);
$thumb_path = $thumb_path_map[$news['bid']];
$thumb_img = $news['bimg'] ? $_url . $thumb_path . $news['bimg'] : '';

// 게시글 내용에서 첫 번째 이미지 추출
$content_img = '';
if(preg_match('/<img[^>]+src=["\']([^"\']+)["\']/', $news['bcontents'], $matches)) {
    $content_img = $matches[1];
}

// 첫 번째 이미지가 없으면 썸네일 이미지 사용
if(!$content_img && $thumb_img) {
    $content_img = $thumb_img;
}

// 내용에서 이미지 태그 제거
$content_text = preg_replace('/<img[^>]*>/', '', $news['bcontents']);
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
      <!-- 상세 콘텐츠 영역 -->
      <div class="news_detail">
        <a href="news.php" class="back_btn">
          <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="20" cy="20" r="19.5" transform="rotate(180 20 20)" fill="white" stroke="black"/>
            <path d="M23 12L15 20L23 28" stroke="black" stroke-width="3"/>
          </svg>
        </a>
        <div class="detail_content">
          <div class="detail_left">
            <h3 class="detail_title"><?=htmlspecialchars($news['btitle'])?></h3>
            <div class="detail_text">
              <div class="text"><?=$content_text?></div>
              <span class="detail_date"><?=substr($news['bregdate'], 0, 10)?></span>
            </div>
          </div>
          <div class="detail_right">
            <?php if($content_img): ?>
            <div class="detail_image">
              <img src="<?=$content_img?>" alt="<?=htmlspecialchars($news['btitle'])?>">
            </div>
            <?php else: ?>
            <div class="detail_image"></div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </section>
  </main>

<?php include 'includes/footer.php'; ?>
