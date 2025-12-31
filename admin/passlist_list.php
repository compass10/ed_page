<?php
$pageTitle = '합격자 명단';
include 'header.php';

// 순서 변경 처리
if(isset($_POST['update_order']) && isset($board_table)) {
  $orders = $_POST['order'];
  $success = true;
  foreach($orders as $bno => $order) {
    $order = (int)$order;
    $bno = (int)$bno;
    $result = mysql_query("UPDATE $board_table SET bpw='$order' WHERE bno='$bno'");
    if(!$result) {
      $success = false;
    }
  }
  if($success) {
    echo "<script>alert('순서가 저장되었습니다.'); location.href='passlist_list.php';</script>";
  } else {
    echo "<script>alert('순서 저장 중 오류가 발생했습니다.');</script>";
  }
  exit;
}

// 페이지네이션
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$per_page = 15;
$offset = ($page - 1) * $per_page;

$total_count = 0;
$total_pages = 0;
$result = null;

if(isset($board_table)) {
  // 전체 개수
  $count_result = @mysql_query("SELECT COUNT(*) as cnt FROM $board_table WHERE bid='passlist'");
  if($count_result) {
    $count_row = mysql_fetch_array($count_result);
    $total_count = $count_row['cnt'];
    $total_pages = ceil($total_count / $per_page);
  }

  // 데이터 조회 (bpw 순서로 정렬)
  $sql = "SELECT * FROM $board_table WHERE bid='passlist' ORDER BY bpw ASC, bno DESC LIMIT $offset, $per_page";
  $result = @mysql_query($sql);
}
?>

<div class="page_actions">
  <a href="passlist_form.php?mode=write" class="btn primary">+ 새 합격자 명단</a>
</div>

<form method="post">
<input type="hidden" name="update_order" value="1">

<div class="table_section full">
  <div class="table_header">
    <h3>합격자 명단</h3>
    <button type="submit" class="btn">순서 저장</button>
  </div>
  <table class="data_table">
    <thead>
      <tr>
        <th width="60">순서</th>
        <th width="100">썸네일</th>
        <th>제목</th>
        <th width="100">노출</th>
        <th width="120" style="text-align:center">등록일</th>
        <th width="100">관리</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if($result && @mysql_num_rows($result) > 0) {
        while($row = @mysql_fetch_array($result)) {
      ?>
      <tr>
        <td><input type="number" name="order[<?=$row['bno']?>]" value="<?=$row['bpw']?>" style="width: 50px; padding: 4px; text-align: center;"></td>
        <td>
          <?php if($row['bimg']): ?>
          <img src="<?=$_url?>thumb/passlist/<?=$row['bimg']?>" style="width: 80px; height: 52px; object-fit: cover;">
          <?php else: ?>
          <span style="color: #ccc;">-</span>
          <?php endif; ?>
        </td>
        <td style="text-align: left;"><a href="passlist_form.php?mode=modify&bno=<?=$row['bno']?>"><?=$row['btitle']?></a></td>
        <td><?=$row['is_hidden'] == 'N' ? '<span class="status done">노출</span>' : '<span class="status">숨김</span>'?></td>
        <td><?=date('Y-m-d', strtotime($row['bregdate']))?></td>
        <td><a href="passlist_form.php?mode=modify&bno=<?=$row['bno']?>" class="btn" style="padding: 6px 12px; font-size: 11px;">수정</a></td>
      </tr>
      <?php
        }
      } else {
      ?>
      <tr>
        <td colspan="6" class="empty">등록된 합격자 명단이 없습니다.</td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
</form>

<p style="margin-top: 16px; color: #666; font-size: 13px;">* 순서는 숫자가 작을수록 먼저 표시됩니다.</p>

<!-- 페이지네이션 -->
<?php if($total_pages > 1): ?>
<div class="pagination">
  <?php if($page > 1): ?>
  <a href="passlist_list.php?page=<?=$page - 1?>">←</a>
  <?php endif; ?>

  <?php
  $start_page = max(1, $page - 4);
  $end_page = min($total_pages, $page + 4);
  for($i = $start_page; $i <= $end_page; $i++):
  ?>
  <?php if($i == $page): ?>
  <span class="active"><?=$i?></span>
  <?php else: ?>
  <a href="passlist_list.php?page=<?=$i?>"><?=$i?></a>
  <?php endif; ?>
  <?php endfor; ?>

  <?php if($page < $total_pages): ?>
  <a href="passlist_list.php?page=<?=$page + 1?>">→</a>
  <?php endif; ?>
</div>
<?php endif; ?>

<?php include 'footer.php'; ?>
