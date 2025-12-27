<?php
$pageTitle = '메인 뉴스 관리';
include 'header.php';

// 순서 변경 처리
if(isset($_POST['update_order']) && isset($board_table)) {
  $orders = $_POST['order'];
  foreach($orders as $bno => $order) {
    $order = (int)$order;
    $bno = (int)$bno;
    @mysql_query("UPDATE $board_table SET bpw='$order' WHERE bno='$bno'");
  }
  echo "<script>alert('순서가 저장되었습니다.');</script>";
}

$bid = 'mainnews';

$result = null;
if(isset($board_table)) {
  $sql = "SELECT * FROM $board_table WHERE bid='$bid' ORDER BY bpw ASC, bno DESC";
  $result = @mysql_query($sql);
}
?>

<div class="page_actions">
  <a href="mainnews_form.php?mode=write" class="btn primary">+ 새 뉴스</a>
</div>

<p style="color: #888; font-size: 13px; margin-bottom: 15px;">* 메인 페이지 뉴스 섹션, Who We Are 페이지, News 페이지에 노출됩니다.</p>

<form method="post">
<input type="hidden" name="update_order" value="1">

<div class="table_section full">
  <div class="table_header">
    <h3>뉴스 목록</h3>
    <button type="submit" class="btn">순서 저장</button>
  </div>
  <table class="data_table">
    <thead>
      <tr>
        <th width="60">순서</th>
        <th width="100">썸네일</th>
        <th width="130">카테고리</th>
        <th>제목</th>
        <th width="100">우측 이미지</th>
        <th width="100">노출</th>
        <th width="120" style="text-align:center">등록일</th>
        <th width="80">관리</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if($result && @mysql_num_rows($result) > 0) {
        while($row = @mysql_fetch_array($result)) {
      ?>
      <?php
        // 카테고리 라벨 매핑
        $cate_labels = array('recruit' => '수강생 모집', 'success' => '합격 소식', 'etc' => 'ETC');
        $cate_label = isset($cate_labels[$row['bcate']]) ? $cate_labels[$row['bcate']] : 'ETC';
      ?>
      <tr>
        <td><input type="number" name="order[<?=$row['bno']?>]" value="<?=$row['bpw']?>" style="width: 50px; padding: 4px; text-align: center;"></td>
        <td>
          <?php if($row['bimg']): ?>
          <img src="<?=$_url?>thumb/mainnews/<?=$row['bimg']?>" style="width: 80px; height: 52px; object-fit: cover; border-radius: 4px;">
          <?php else: ?>
          <span style="color: #ccc;">-</span>
          <?php endif; ?>
        </td>
        <td><span class="status"><?=$cate_label?></span></td>
        <td style="text-align: left;">
          <a href="mainnews_form.php?mode=modify&bno=<?=$row['bno']?>">
            <?=htmlspecialchars($row['btitle']) ? htmlspecialchars($row['btitle']) : '(제목없음)'?>
          </a>
        </td>
        <td>
          <?php if($row['bimg2']): ?>
          <img src="<?=$_url?>thumb/mainnews/<?=$row['bimg2']?>" style="width: 80px; height: 52px; object-fit: cover; border-radius: 4px;">
          <?php else: ?>
          <span style="color: #ccc;">-</span>
          <?php endif; ?>
        </td>
        <td><?=$row['is_hidden'] == 'N' ? '<span class="status done">노출</span>' : '<span class="status">숨김</span>'?></td>
        <td><?=date('Y-m-d', strtotime($row['bregdate']))?></td>
        <td><a href="mainnews_form.php?mode=modify&bno=<?=$row['bno']?>" class="btn" style="padding: 6px 12px; font-size: 11px;">수정</a></td>
      </tr>
      <?php
        }
      } else {
      ?>
      <tr>
        <td colspan="8" class="empty">등록된 뉴스가 없습니다.</td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
</form>

<p style="margin-top: 16px; color: #666; font-size: 13px;">* 순서는 숫자가 작을수록 먼저 표시됩니다.</p>

<?php include 'footer.php'; ?>
