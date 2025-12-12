<?php
$pageTitle = '메인배너';
include 'header.php';

$result = null;
if(isset($banner_table)) {
  $result = @mysql_query("SELECT * FROM $banner_table ORDER BY border ASC, bno DESC");
}

// 저장 처리
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($banner_table)) {
  $mode = $_POST['mode'];

  if($mode == 'write') {
    $btitle = mysql_real_escape_string($_POST['btitle']);
    $blink = mysql_real_escape_string($_POST['blink']);
    $border = (int)$_POST['border'];

    // 이미지 업로드
    $bimg = '';
    if($_FILES['bimg']['name']) {
      $ext = pathinfo($_FILES['bimg']['name'], PATHINFO_EXTENSION);
      $bimg = 'banner_' . time() . '.' . $ext;
      move_uploaded_file($_FILES['bimg']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/web/banner/' . $bimg);
    }

    $sql = "INSERT INTO $banner_table (btitle, bimg, blink, border) VALUES ('$btitle', '$bimg', '$blink', '$border')";
    @mysql_query($sql);
    echo "<script>alert('등록되었습니다.'); location.reload();</script>";
  }
}
?>

<div class="form_section" style="margin-bottom: 30px;">
  <h3 style="margin-bottom: 15px;">새 배너 등록</h3>
  <form method="post" enctype="multipart/form-data">
    <input type="hidden" name="mode" value="write">

    <div class="form_row">
      <div class="form_group">
        <label>배너 제목</label>
        <input type="text" name="btitle" required>
      </div>
      <div class="form_group">
        <label>링크 URL</label>
        <input type="text" name="blink" placeholder="https://">
      </div>
    </div>

    <div class="form_row">
      <div class="form_group">
        <label>배너 이미지 *</label>
        <input type="file" name="bimg" required>
      </div>
      <div class="form_group">
        <label>순서</label>
        <input type="number" name="border" value="0" style="width: 100px;">
      </div>
    </div>

    <div class="form_actions">
      <button type="submit" class="btn primary">등록</button>
    </div>
  </form>
</div>

<!-- 테이블 -->
<div class="table_section full">
  <table class="data_table">
    <thead>
      <tr>
        <th width="60">번호</th>
        <th width="150">이미지</th>
        <th>제목</th>
        <th>링크</th>
        <th width="80">순서</th>
        <th width="100">관리</th>
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
          <img src="<?=$_url?>banner/<?=$row['bimg']?>" style="width: 120px; height: 60px; object-fit: cover;">
          <?php else: ?>
          -
          <?php endif; ?>
        </td>
        <td><?=$row['btitle']?></td>
        <td><?=$row['blink'] ? '<a href="'.$row['blink'].'" target="_blank">'.$row['blink'].'</a>' : '-'?></td>
        <td><?=$row['border']?></td>
        <td>
          <button type="button" class="btn danger" style="padding: 6px 12px; font-size: 11px;" onclick="if(confirm('삭제하시겠습니까?')) location.href='banner_ok.php?mode=delete&bno=<?=$row['bno']?>'">삭제</button>
        </td>
      </tr>
      <?php
        }
      } else {
      ?>
      <tr>
        <td colspan="6" class="empty">등록된 배너가 없습니다.</td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<?php include 'footer.php'; ?>
