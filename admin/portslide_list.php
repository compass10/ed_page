<?php
$pageTitle = '포트폴리오 슬라이드';
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

// 카테고리 필터
$category = isset($_GET['category']) ? $_GET['category'] : '';
$where_category = $category ? "AND bcate='$category'" : "";

$result = null;
if(isset($board_table)) {
  $sql = "SELECT * FROM $board_table WHERE bid='portslide' $where_category ORDER BY bpw ASC, bno DESC";
  $result = @mysql_query($sql);
}

// 카테고리 목록
$categories = array(
  'branding' => 'Branding',
  'poster' => 'Poster',
  'editorial' => 'Editorial',
  'illustration' => 'Illustration',
  'motion' => 'Motion',
  'uiux' => 'UI/UX'
);
?>

<div class="page_actions">
  <a href="portslide_form.php?mode=write" class="btn primary">+ 새 슬라이드</a>
</div>

<!-- 카테고리 필터 -->
<div style="margin-bottom: 16px;">
  <a href="portslide_list.php" class="btn <?=!$category ? 'primary' : ''?>" style="margin-right: 4px;">전체</a>
  <?php foreach($categories as $key => $name): ?>
  <a href="portslide_list.php?category=<?=$key?>" class="btn <?=$category == $key ? 'primary' : ''?>" style="margin-right: 4px;"><?=$name?></a>
  <?php endforeach; ?>
</div>

<form method="post">
<input type="hidden" name="update_order" value="1">

<div class="table_section full">
  <div class="table_header">
    <h3>포트폴리오 슬라이드 목록</h3>
    <button type="submit" class="btn">순서 저장</button>
  </div>
  <table class="data_table">
    <thead>
      <tr>
        <th width="60">순서</th>
        <th width="120">이미지</th>
        <th width="100">카테고리</th>
        <th>문구</th>
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
        <td><input type="number" name="order[<?=$row['bno']?>]" value="<?=$row['bpw']?>" style="width: 50px; padding: 4px; text-align: center;"></td>
        <td>
          <?php if($row['bimg']): ?>
          <img src="<?=$_url?>thumb/portslide/<?=$row['bimg']?>" style="width: 100px; height: 66px; object-fit: cover;">
          <?php else: ?>
          -
          <?php endif; ?>
        </td>
        <td><?=isset($categories[$row['bcate']]) ? $categories[$row['bcate']] : $row['bcate']?></td>
        <td style="text-align: left;"><?=nl2br(htmlspecialchars($row['btitle']))?></td>
        <td><?=$row['is_hidden'] == 'N' ? '<span class="status done">노출</span>' : '<span class="status">숨김</span>'?></td>
        <td><?=date('Y-m-d', strtotime($row['bregdate']))?></td>
        <td><a href="portslide_form.php?mode=modify&bno=<?=$row['bno']?>" class="btn" style="padding: 6px 12px; font-size: 11px;">수정</a></td>
      </tr>
      <?php
        }
      } else {
      ?>
      <tr>
        <td colspan="7" class="empty">등록된 슬라이드가 없습니다.</td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
</form>

<p style="margin-top: 16px; color: #666; font-size: 13px;">* 순서는 숫자가 작을수록 먼저 표시됩니다.</p>

<?php include 'footer.php'; ?>
