<?php
$pageTitle = '강사진';
include 'header.php';

// 페이지네이션
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$per_page = 15;
$offset = ($page - 1) * $per_page;

$total_count = 0;
$total_pages = 0;
$result = null;

if(isset($tutor_table)) {
  // 전체 개수
  $count_result = @mysql_query("SELECT COUNT(*) as cnt FROM $tutor_table");
  if($count_result) {
    $count_row = mysql_fetch_array($count_result);
    $total_count = $count_row['cnt'];
    $total_pages = ceil($total_count / $per_page);
  }

  // 데이터 조회
  $sql = "SELECT * FROM $tutor_table ORDER BY torder ASC, tno DESC LIMIT $offset, $per_page";
  $result = @mysql_query($sql);
}
?>

<div class="page_actions">
  <a href="tutor_form.php?mode=write" class="btn primary">+ 새 강사</a>
</div>

<!-- 테이블 -->
<div class="table_section full">
  <table class="data_table">
    <thead>
      <tr>
        <th width="60">번호</th>
        <th width="80">사진</th>
        <th>이름</th>
        <th>직책</th>
        <th width="80">순서</th>
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
        <td><?=$row['tno']?></td>
        <td>
          <?php if($row['tphoto']): ?>
          <img src="<?=$_url?>tutor/<?=$row['tphoto']?>" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
          <?php else: ?>
          -
          <?php endif; ?>
        </td>
        <td><a href="tutor_form.php?mode=modify&tno=<?=$row['tno']?>"><?=$row['tname']?></a></td>
        <td><?=$row['tposition']?></td>
        <td><?=$row['torder']?></td>
        <td><?=$row['is_hidden'] == 'N' ? '<span class="status done">노출</span>' : '<span class="status">숨김</span>'?></td>
        <td><a href="tutor_form.php?mode=modify&tno=<?=$row['tno']?>" class="btn" style="padding: 6px 12px; font-size: 11px;">수정</a></td>
      </tr>
      <?php
        }
      } else {
      ?>
      <tr>
        <td colspan="7" class="empty">등록된 강사가 없습니다.</td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<!-- 페이지네이션 -->
<?php if($total_pages > 1): ?>
<div class="pagination">
  <?php if($page > 1): ?>
  <a href="tutor_list.php?page=<?=$page - 1?>">←</a>
  <?php endif; ?>

  <?php
  $start_page = max(1, $page - 4);
  $end_page = min($total_pages, $page + 4);
  for($i = $start_page; $i <= $end_page; $i++):
  ?>
  <?php if($i == $page): ?>
  <span class="active"><?=$i?></span>
  <?php else: ?>
  <a href="tutor_list.php?page=<?=$i?>"><?=$i?></a>
  <?php endif; ?>
  <?php endfor; ?>

  <?php if($page < $total_pages): ?>
  <a href="tutor_list.php?page=<?=$page + 1?>">→</a>
  <?php endif; ?>
</div>
<?php endif; ?>

<?php include 'footer.php'; ?>
