<?php
$pageTitle = 'Success Stories';
$isSubPage = true;
$pageCss = 'success';

// DB 연결
include_once('../lib.php');

// bno 파라미터 확인
$bno = isset($_GET['bno']) ? (int)$_GET['bno'] : 0;

if($bno == 0) {
    header('Location: success.php');
    exit;
}

// 게시물 조회
$success_sql = "SELECT * FROM $board_table WHERE bno='$bno' AND bid='review'";
$success_result = mysql_query($success_sql);
$success = mysql_fetch_array($success_result);

if(!$success) {
    header('Location: success.php');
    exit;
}

// 조회수 증가
mysql_query("UPDATE $board_table SET bview = bview + 1 WHERE bno='$bno'");

// 업로드 이미지 경로
$upload_path = 'data/review/';
$upload_img = $success['bimg'] ? $_url . $upload_path . $success['bimg'] : '';

// 게시글 내용에서 첫 번째 이미지 추출
$content_img = '';
if(preg_match('/<img[^>]+src=["\']([^"\']+)["\']/', $success['bcontents'], $matches)) {
    $content_img = $matches[1];
}

// 첫 번째 이미지가 없으면 업로드 이미지 사용
if(!$content_img && $upload_img) {
    $content_img = $upload_img;
}
?>
<?php include 'includes/header.php'; ?>

  <main>
    <div class="page_title">
      <span class="num">03</span>
      <span class="title">Success Stories</span>
    </div>
    <section class="section page_content">
      <div class="sec_title_row">
        <h2 class="sec_title">
          <span class="avenir">Every</span>
          <span class="instru">name</span>
        </h2>
      </div>
      <div class="sec_title_row">
        <div class="left_col">
          <p class="desc">
            Behind every success is a story of challenge and growth.<br/>
            At ED, we celebrate not just results, but the journey itself.
          </p>
          <div class="bottom_row">
            <div class="star">
              <svg width="36" height="39" viewBox="0 0 36 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M15.3814 38.4063L15.7588 23.0249L2.59502 31.0931L0 26.5636L13.5885 19.2503L0 11.8427L2.59502 7.31324L15.7588 15.3814L15.3814 0H20.5714L20.194 15.3814L33.405 7.31324L36 11.8427L22.4587 19.2503L36 26.5636L33.405 31.0931L20.194 23.0249L20.5714 38.4063H15.3814Z" fill="black"/>
              </svg>
            </div>
            <p class="desc_kr">
              모든 합격의 뒤에는 도전과 성장의 이야기가 있습니다.<br/>
              이드에서는 결과뿐 아니라 그 여정 자체를 함께 축하합니다.
            </p>
          </div>
        </div>
        <h2 class="sec_title">
          <span class="avenir">tells a</span>
          <span class="instru">story.</span>
        </h2>
      </div>
      <!-- 상세 콘텐츠 영역 -->
      <div class="success_detail">
        <a href="success.php" class="back_btn">
          <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="20" cy="20" r="19.5" transform="rotate(180 20 20)" fill="white" stroke="black"/>
            <path d="M23 12L15 20L23 28" stroke="black" stroke-width="3"/>
          </svg>
        </a>
        <?php if($content_img): ?>
        <div class="detail_image">
          <img src="<?=$content_img?>" alt="<?=htmlspecialchars($success['btitle'])?>">
        </div>
        <?php else: ?>
        <div class="detail_image no_image">
          <p>업로드된 이미지가 없습니다.</p>
        </div>
        <?php endif; ?>
      </div>
    </section>
  </main>

<?php include 'includes/footer.php'; ?>
