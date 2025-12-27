<?php
$pageTitle = 'News';
$isSubPage = true;
$pageCss = 'news';

// DB 연결
include_once('./web/lib.php');

// bno 파라미터 확인
$bno = isset($_GET['bno']) ? (int)$_GET['bno'] : 0;

if($bno == 0) {
    header('Location: news.php');
    exit;
}

// 게시물 조회 (mainnews 게시판)
$news_sql = "SELECT * FROM $board_table WHERE bno='$bno' AND bid='mainnews'";
$news_result = mysql_query($news_sql);
$news = mysql_fetch_array($news_result);

if(!$news) {
    header('Location: news.php');
    exit;
}

// 조회수 증가
mysql_query("UPDATE $board_table SET bview = bview + 1 WHERE bno='$bno'");

// 우측 이미지: bimg2 필드 사용, 없으면 bcontents에서 첫 번째 이미지 추출
$right_img = '';
if($news['bimg2']) {
    $right_img = $_url . 'thumb/mainnews/' . $news['bimg2'];
} else if(preg_match('/<img[^>]+src=["\']([^"\']+)["\']/', $news['bcontents'], $matches)) {
    $right_img = $matches[1];
}

// 내용에서 이미지 태그 제거 및 이스케이프 문자 제거
$content_text = preg_replace('/<img[^>]*>/', '', $news['bcontents']);
$content_text = stripslashes($content_text);
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
            <?php if($right_img): ?>
            <div class="detail_image">
              <img src="<?=$right_img?>" alt="<?=htmlspecialchars($news['btitle'])?>">
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
