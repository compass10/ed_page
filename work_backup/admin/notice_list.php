<?php
$pageTitle = '공지사항';
include 'header.php';

// 페이지네이션
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$per_page = 15;
$offset = ($page - 1) * $per_page;

$total_count = 0;
$total_pages = 0;
$result = null;

if(isset($board_table)) {
  // 전체 개수
  $count_result = @mysql_query("SELECT COUNT(*) as cnt FROM $board_table WHERE bid='notice'");
  if($count_result) {
    $count_row = mysql_fetch_array($count_result);
    $total_count = $count_row['cnt'];
    $total_pages = ceil($total_count / $per_page);
  }

  // 데이터 조회
  $sql = "SELECT * FROM $board_table WHERE bid='notice' ORDER BY bno DESC LIMIT $offset, $per_page";
  $result = @mysql_query($sql);
}
?>

<div class="page_actions">
  <a href="notice_form.php?mode=write" class="btn primary">+ 새 공지사항</a>
</div>

<!-- 테이블 -->
<div class="table_section full">
  <table class="data_table">
    <thead>
      <tr>
        <th width="60">번호</th>
        <th>제목</th>
        <th width="100">등록일</th>
        <th width="80">조회</th>
        <th width="80">노출</th>
        <th width="80">관리</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if($result && @mysql_num_rows($result) > 0) {
        while($row = @mysql_fetch_array($result)) {
      ?>
      <tr>
        <td><?=$row['bno']?></td>
        <td><a href="notice_form.php?mode=modify&bno=<?=$row['bno']?>"><?=$row['btitle']?></a></td>
        <td><?=date('Y-m-d', strtotime($row['bregdate']))?></td>
        <td><?=$row['bview']?></td>
        <td><?=$row['is_hidden'] == 'N' ? '<span class="status done">노출</span>' : '<span class="status">숨김</span>'?></td>
        <td><a href="notice_form.php?mode=modify&bno=<?=$row['bno']?>" class="btn" style="padding: 6px 12px; font-size: 11px;">수정</a></td>
      </tr>
      <?php
        }
      } else {
      ?>
      <tr>
        <td colspan="6" class="empty">등록된 공지사항이 없습니다.</td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<!-- 페이지네이션 -->
<?php if($total_pages > 1): ?>
<div class="pagination">
  <?php if($page > 1): ?>
  <a href="notice_list.php?page=<?=$page - 1?>">←</a>
  <?php endif; ?>

  <?php
  $start_page = max(1, $page - 4);
  $end_page = min($total_pages, $page + 4);
  for($i = $start_page; $i <= $end_page; $i++):
  ?>
  <?php if($i == $page): ?>
  <span class="active"><?=$i?></span>
  <?php else: ?>
  <a href="notice_list.php?page=<?=$i?>"><?=$i?></a>
  <?php endif; ?>
  <?php endfor; ?>

  <?php if($page < $total_pages): ?>
  <a href="notice_list.php?page=<?=$page + 1?>">→</a>
  <?php endif; ?>
</div>
<?php endif; ?>

<?php include 'footer.php'; ?>
