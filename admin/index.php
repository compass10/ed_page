<?php
$pageTitle = '대시보드';
include 'header.php';

// 통계 데이터 조회 (DB 연결 시에만)
$inquiry_total = 0;
$inquiry_new = 0;
$review_total = 0;
$notice_total = 0;
$recent_inquiry = null;
$recent_review = null;

if(isset($inquiry_table) && isset($board_table)) {
  $result = @mysql_query("SELECT ino FROM $inquiry_table");
  $inquiry_total = $result ? @mysql_num_rows($result) : 0;

  $result = @mysql_query("SELECT ino FROM $inquiry_table WHERE isw='5'");
  $inquiry_new = $result ? @mysql_num_rows($result) : 0;

  $result = @mysql_query("SELECT bno FROM $board_table WHERE bid='review' AND is_hidden='N'");
  $review_total = $result ? @mysql_num_rows($result) : 0;

  $result = @mysql_query("SELECT bno FROM $board_table WHERE bid='notice' AND is_hidden='N'");
  $notice_total = $result ? @mysql_num_rows($result) : 0;

  // 최근 상담문의 5개
  $recent_inquiry = @mysql_query("SELECT * FROM $inquiry_table ORDER BY ino DESC LIMIT 5");

  // 최근 합격수기 5개
  $recent_review = @mysql_query("SELECT * FROM $board_table WHERE bid='review' AND is_hidden='N' ORDER BY bno DESC LIMIT 5");
}
?>

<!-- 통계 카드 -->
<div class="stat_cards">
  <div class="stat_card">
    <div class="stat_icon">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M20 4H4C2.9 4 2.01 4.9 2.01 6L2 18C2 19.1 2.9 20 4 20H20C21.1 20 22 19.1 22 18V6C22 4.9 21.1 4 20 4ZM20 8L12 13L4 8V6L12 11L20 6V8Z" fill="currentColor"/>
      </svg>
    </div>
    <div class="stat_info">
      <p class="stat_label">전체 상담문의</p>
      <p class="stat_value"><?=$inquiry_total?></p>
    </div>
  </div>

  <div class="stat_card highlight">
    <div class="stat_icon">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm-1-7v2h2v-2h-2zm0-8v6h2V7h-2z" fill="currentColor"/>
      </svg>
    </div>
    <div class="stat_info">
      <p class="stat_label">신규 상담</p>
      <p class="stat_value"><?=$inquiry_new?></p>
    </div>
  </div>

  <div class="stat_card">
    <div class="stat_icon">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" fill="currentColor"/>
      </svg>
    </div>
    <div class="stat_info">
      <p class="stat_label">합격수기</p>
      <p class="stat_value"><?=$review_total?></p>
    </div>
  </div>

  <div class="stat_card">
    <div class="stat_icon">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M14 2H6C4.9 2 4 2.9 4 4V20C4 21.1 4.9 22 6 22H18C19.1 22 20 21.1 20 20V8L14 2ZM16 18H8V16H16V18ZM16 14H8V12H16V14ZM13 9V3.5L18.5 9H13Z" fill="currentColor"/>
      </svg>
    </div>
    <div class="stat_info">
      <p class="stat_label">공지사항</p>
      <p class="stat_value"><?=$notice_total?></p>
    </div>
  </div>
</div>

<!-- 최근 데이터 테이블 -->
<div class="dashboard_tables">
  <div class="table_section">
    <div class="table_header">
      <h3>최근 상담문의</h3>
      <a href="inquiry_list.php" class="view_all">전체보기</a>
    </div>
    <table class="data_table">
      <thead>
        <tr>
          <th>번호</th>
          <th>이름</th>
          <th>제목</th>
          <th>등록일</th>
          <th>상태</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if($recent_inquiry && @mysql_num_rows($recent_inquiry) > 0) {
          while($row = @mysql_fetch_array($recent_inquiry)) {
            $status_class = $row['isw'] == '5' ? 'new' : ($row['isw'] == '10' ? 'done' : '');
            $status_text = function_exists('data_sw_msg') ? data_sw_msg($row['isw']) : $row['isw'];
        ?>
        <tr>
          <td><?=$row['ino']?></td>
          <td><?=$row['iname']?></td>
          <td><a href="inquiry_form.php?mode=modify&ino=<?=$row['ino']?>"><?=mb_strimwidth($row['isubject'], 0, 30, '...')?></a></td>
          <td><?=date('Y-m-d', strtotime($row['reg_date']))?></td>
          <td><span class="status <?=$status_class?>"><?=$status_text?></span></td>
        </tr>
        <?php
          }
        } else {
        ?>
        <tr>
          <td colspan="5" class="empty">등록된 상담문의가 없습니다.</td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>

  <div class="table_section">
    <div class="table_header">
      <h3>최근 합격수기</h3>
      <a href="review_list.php" class="view_all">전체보기</a>
    </div>
    <table class="data_table">
      <thead>
        <tr>
          <th>번호</th>
          <th>제목</th>
          <th>등록일</th>
          <th>조회</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if($recent_review && @mysql_num_rows($recent_review) > 0) {
          while($row = @mysql_fetch_array($recent_review)) {
        ?>
        <tr>
          <td><?=$row['bno']?></td>
          <td><a href="review_form.php?mode=modify&bno=<?=$row['bno']?>"><?=mb_strimwidth($row['btitle'], 0, 30, '...')?></a></td>
          <td><?=date('Y-m-d', strtotime($row['bregdate']))?></td>
          <td><?=$row['bview']?></td>
        </tr>
        <?php
          }
        } else {
        ?>
        <tr>
          <td colspan="4" class="empty">등록된 합격수기가 없습니다.</td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>

<?php include 'footer.php'; ?>
