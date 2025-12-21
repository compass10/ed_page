<?php
$pageTitle = '상담문의';
include 'header.php';

// 필터
$sw = isset($_GET['sw']) ? $_GET['sw'] : '';
$sw_sql = $sw ? " WHERE isw='$sw' " : "";

// 페이지네이션
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$per_page = 15;
$offset = ($page - 1) * $per_page;

// 전체 개수
$count_result = mysql_query("SELECT COUNT(*) as cnt FROM $inquiry_table $sw_sql");
$count_row = mysql_fetch_array($count_result);
$total_count = $count_row['cnt'];
$total_pages = ceil($total_count / $per_page);

// 데이터 조회
$sql = "SELECT * FROM $inquiry_table $sw_sql ORDER BY ino DESC LIMIT $offset, $per_page";
$result = mysql_query($sql);
?>

<!-- 필터 탭 -->
<div class="filter_tabs">
  <a href="inquiry_list.php" class="filter_tab <?=$sw == '' ? 'active' : ''?>">전체</a>
  <?php foreach($data_sw_arr as $item): ?>
  <a href="inquiry_list.php?sw=<?=$item[1]?>" class="filter_tab <?=$sw == $item[1] ? 'active' : ''?>">
    <?=$item[0]?>
    <?php
    $cnt = mysql_num_rows(mysql_query("SELECT ino FROM $inquiry_table WHERE isw='{$item[1]}'"));
    if($cnt > 0): ?>
    <span>(<?=$cnt?>)</span>
    <?php endif; ?>
  </a>
  <?php endforeach; ?>
</div>

<!-- 테이블 -->
<div class="table_section full">
  <table class="data_table">
    <thead>
      <tr>
        <th width="60">번호</th>
        <th width="80">환경</th>
        <th>제목</th>
        <th width="100">작성자</th>
        <th width="150">이메일</th>
        <th width="100">등록일</th>
        <th width="80">상태</th>
        <th width="80">관리</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if(mysql_num_rows($result) > 0) {
        while($row = mysql_fetch_array($result)) {
          $status_class = $row['isw'] == '5' ? 'new' : ($row['isw'] == '10' ? 'done' : '');
      ?>
      <tr>
        <td><?=$row['ino']?></td>
        <td><?=$row['idevice']?></td>
        <td><a href="inquiry_form.php?mode=modify&ino=<?=$row['ino']?>"><?=$row['isubject']?></a></td>
        <td><?=$row['iname']?></td>
        <td><?=$row['iemail']?></td>
        <td><?=date('Y-m-d', strtotime($row['reg_date']))?></td>
        <td><span class="status <?=$status_class?>"><?=data_sw_msg($row['isw'])?></span></td>
        <td><a href="inquiry_form.php?mode=modify&ino=<?=$row['ino']?>" class="btn" style="padding: 6px 12px; font-size: 11px;">상세</a></td>
      </tr>
      <?php
        }
      } else {
      ?>
      <tr>
        <td colspan="8" class="empty">등록된 상담문의가 없습니다.</td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<!-- 페이지네이션 -->
<?php if($total_pages > 1): ?>
<div class="pagination">
  <?php if($page > 1): ?>
  <a href="inquiry_list.php?sw=<?=$sw?>&page=<?=$page - 1?>">←</a>
  <?php endif; ?>

  <?php
  $start_page = max(1, $page - 4);
  $end_page = min($total_pages, $page + 4);
  for($i = $start_page; $i <= $end_page; $i++):
  ?>
  <?php if($i == $page): ?>
  <span class="active"><?=$i?></span>
  <?php else: ?>
  <a href="inquiry_list.php?sw=<?=$sw?>&page=<?=$i?>"><?=$i?></a>
  <?php endif; ?>
  <?php endfor; ?>

  <?php if($page < $total_pages): ?>
  <a href="inquiry_list.php?sw=<?=$sw?>&page=<?=$page + 1?>">→</a>
  <?php endif; ?>
</div>
<?php endif; ?>

<?php include 'footer.php'; ?>
