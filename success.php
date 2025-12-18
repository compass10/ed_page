<?php
$pageTitle = 'Success Stories';
$isSubPage = true;
$pageCss = 'success';

// DB 연결 (운영서버 lib.php 사용)
include_once('../lib.php');

// 페이지네이션 설정
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$per_page = 8; // 한 페이지당 8개
$offset = ($page - 1) * $per_page;

// 전체 게시물 수 조회 (합격자 명단 = passlist)
$count_sql = "SELECT COUNT(*) as cnt FROM $board_table WHERE bid='passlist' AND is_hidden='N'";
$count_result = mysql_query($count_sql);
$count_row = mysql_fetch_array($count_result);
$total_count = $count_row['cnt'];
$total_pages = ceil($total_count / $per_page);

// 합격자 명단 데이터 조회 (최신순 = bno DESC)
$success_sql = "SELECT * FROM $board_table
                WHERE bid='passlist'
                AND is_hidden='N'
                ORDER BY bno DESC
                LIMIT $offset, $per_page";
$success_result = mysql_query($success_sql);

// 업로드 이미지 경로
$upload_path = 'thumb/passlist/';
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
        <h2 class="sec_title">
          <span class="avenir">tells a</span>
          <span class="instru">story.</span>
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
      <!-- 모바일 전용 설명 -->
      <div class="mobile_desc">
        <p class="desc_kr">모든 합격의 뒤에는 도전과 성장의 이야기가 있습니다.<br/>이드에서는 결과뿐 아니라 그 여정 자체를 함께 축하합니다.</p>
        <p class="desc_en">Behind every success is a story of challenge and growth.<br/>At ED, we celebrate not just results, but the journey itself.</p>
      </div>
      <div class="success_grid">
        <?php
        if(mysql_num_rows($success_result) > 0) {
          while($row = mysql_fetch_array($success_result)) {
            // 썸네일 이미지 경로
            $thumb_img = $row['bimg'] ? $_url . $upload_path . $row['bimg'] : '';
        ?>
        <?php if($thumb_img): ?>
        <a href="success_detail.php?bno=<?=$row['bno']?>" class="success_item" style="background-image: url('<?=$thumb_img?>'); background-repeat: no-repeat; background-size: cover; background-position: center;"></a>
        <?php else: ?>
        <a href="success_detail.php?bno=<?=$row['bno']?>" class="success_item no_image"><p>이미지 없음</p></a>
        <?php endif; ?>
        <?php
          }
        } else {
        ?>
        <p class="empty_msg">등록된 합격자 명단이 없습니다.</p>
        <?php
        }
        ?>
      </div>
      <?php if($total_pages > 1):
        // 5개씩 페이지 그룹
        $page_group_size = 5;
        $current_group = ceil($page / $page_group_size);
        $start_page = ($current_group - 1) * $page_group_size + 1;
        $end_page = min($current_group * $page_group_size, $total_pages);
      ?>
      <div class="pagination">
        <?php if($current_group > 1): ?>
        <button class="page_btn prev" onclick="location.href='success.php?page=<?=$start_page - 1?>'">←</button>
        <?php else: ?>
        <button class="page_btn prev" disabled>←</button>
        <?php endif; ?>
        <?php for($i = $start_page; $i <= $end_page; $i++): ?>
        <button class="page_num <?php if($i == $page): ?>active<?php endif; ?>" onclick="location.href='success.php?page=<?=$i?>'"><?=$i?></button>
        <?php endfor; ?>
        <?php if($end_page < $total_pages): ?>
        <button class="page_btn next" onclick="location.href='success.php?page=<?=$end_page + 1?>'">→</button>
        <?php else: ?>
        <button class="page_btn next" disabled>→</button>
        <?php endif; ?>
      </div>
      <?php endif; ?>
    </section>
  </main>

<?php include 'includes/footer.php'; ?>
