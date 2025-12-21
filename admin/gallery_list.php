<?php
$pageTitle = '갤러리';
include 'header.php';

// 갤러리 타입
$gallery_types = array(
  '1' => '일러스트',
  '2' => '제품렌더링',
  '3' => '금속렌더링',
  '4' => '도자렌더링',
  '5' => '색채정밀',
  '6' => '연필정밀',
  '7' => '선생님작품'
);

$type = isset($_GET['type']) ? $_GET['type'] : '1';
$bid = 'gallery' . $type;
$type_title = isset($gallery_types[$type]) ? $gallery_types[$type] : '일러스트';

// 페이지네이션
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$per_page = 15;
$offset = ($page - 1) * $per_page;

$total_count = 0;
$total_pages = 0;
$result = null;

if(isset($board_table)) {
  // 전체 개수
  $count_result = @mysql_query("SELECT COUNT(*) as cnt FROM $board_table WHERE bid='$bid'");
  if($count_result) {
    $count_row = mysql_fetch_array($count_result);
    $total_count = $count_row['cnt'];
    $total_pages = ceil($total_count / $per_page);
  }

  // 데이터 조회
  $sql = "SELECT * FROM $board_table WHERE bid='$bid' ORDER BY is_notice DESC, bpw DESC, bno DESC LIMIT $offset, $per_page";
  $result = @mysql_query($sql);
}
?>

<!-- 갤러리 타입 탭 -->
<div class="filter_tabs">
  <?php foreach($gallery_types as $key => $name): ?>
  <a href="gallery_list.php?type=<?=$key?>" class="filter_tab <?=$type == $key ? 'active' : ''?>"><?=$name?></a>
  <?php endforeach; ?>
</div>

<div class="page_actions">
  <a href="gallery_form.php?mode=write&type=<?=$type?>" class="btn primary">+ 새 <?=$type_title?></a>
</div>

<!-- 테이블 -->
<div class="table_section full">
  <table class="data_table">
    <thead>
      <tr>
        <th width="60">번호</th>
        <th width="100">썸네일</th>
        <th>제목</th>
        <th width="60">상위</th>
        <th width="60">가중치</th>
        <th width="80">노출</th>
        <th width="100">등록일</th>
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
        <td>
          <?php if($row['bimg']): ?>
          <img src="<?=$_url?>thumb/gallery/<?=$row['bimg']?>" style="width: 80px; height: 52px; object-fit: cover;">
          <?php else: ?>
          -
          <?php endif; ?>
        </td>
        <td><a href="gallery_form.php?mode=modify&type=<?=$type?>&bno=<?=$row['bno']?>"><?=$row['btitle']?></a></td>
        <td><?=$row['is_notice'] == 'Y' ? '<span class="status new">Y</span>' : '-'?></td>
        <td><?=$row['bpw'] ? $row['bpw'] : '-'?></td>
        <td><?=$row['is_hidden'] == 'N' ? '<span class="status done">노출</span>' : '<span class="status">숨김</span>'?></td>
        <td><?=date('Y-m-d', strtotime($row['bregdate']))?></td>
        <td><a href="gallery_form.php?mode=modify&type=<?=$type?>&bno=<?=$row['bno']?>" class="btn" style="padding: 6px 12px; font-size: 11px;">수정</a></td>
      </tr>
      <?php
        }
      } else {
      ?>
      <tr>
        <td colspan="8" class="empty">등록된 <?=$type_title?> 갤러리가 없습니다.</td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<!-- 페이지네이션 -->
<?php if($total_pages > 1): ?>
<div class="pagination">
  <?php if($page > 1): ?>
  <a href="gallery_list.php?type=<?=$type?>&page=<?=$page - 1?>">←</a>
  <?php endif; ?>

  <?php
  $start_page = max(1, $page - 4);
  $end_page = min($total_pages, $page + 4);
  for($i = $start_page; $i <= $end_page; $i++):
  ?>
  <?php if($i == $page): ?>
  <span class="active"><?=$i?></span>
  <?php else: ?>
  <a href="gallery_list.php?type=<?=$type?>&page=<?=$i?>"><?=$i?></a>
  <?php endif; ?>
  <?php endfor; ?>

  <?php if($page < $total_pages): ?>
  <a href="gallery_list.php?type=<?=$type?>&page=<?=$page + 1?>">→</a>
  <?php endif; ?>
</div>
<?php endif; ?>

<?php include 'footer.php'; ?>
