<?php
$mode = isset($_GET['mode']) ? $_GET['mode'] : 'write';
$pageTitle = $mode == 'write' ? '강사 등록' : '강사 수정';
include 'header.php';

$row = array();
if($mode == 'modify' && isset($_GET['tno']) && isset($tutor_table)) {
  $sql = "SELECT * FROM $tutor_table WHERE tno='{$_GET['tno']}'";
  $result = @mysql_query($sql);
  $row = @mysql_fetch_array($result);
  if(!$row) {
    echo "<script>alert('데이터가 없습니다.'); location.href='tutor_list.php';</script>";
    exit;
  }
}
?>

<div class="page_actions">
  <a href="tutor_list.php" class="btn">← 목록으로</a>
</div>

<div class="form_section">
  <form method="post" action="tutor_ok.php" enctype="multipart/form-data">
    <input type="hidden" name="mode" value="<?=$mode?>">
    <?php if($mode == 'modify'): ?>
    <input type="hidden" name="tno" value="<?=$row['tno']?>">
    <?php endif; ?>

    <div class="form_row">
      <div class="form_group">
        <label>이름 *</label>
        <input type="text" name="tname" value="<?=isset($row['tname']) ? htmlspecialchars($row['tname']) : ''?>" required>
      </div>
      <div class="form_group">
        <label>직책</label>
        <input type="text" name="tposition" value="<?=isset($row['tposition']) ? htmlspecialchars($row['tposition']) : ''?>">
      </div>
    </div>

    <div class="form_group">
      <label>소개</label>
      <textarea name="tintro" rows="5"><?=isset($row['tintro']) ? htmlspecialchars($row['tintro']) : ''?></textarea>
    </div>

    <div class="form_group">
      <label>프로필 사진</label>
      <?php if(isset($row['tphoto']) && $row['tphoto']): ?>
      <div style="margin-bottom: 10px;">
        <img src="<?=$_url?>tutor/<?=$row['tphoto']?>" style="max-width: 150px; border-radius: 50%;">
      </div>
      <?php endif; ?>
      <input type="file" name="tphoto">
    </div>

    <div class="form_row">
      <div class="form_group">
        <label>정렬순서</label>
        <input type="number" name="torder" value="<?=isset($row['torder']) ? $row['torder'] : 0?>" style="width: 100px;">
      </div>
      <div class="form_group">
        <label>
          <input type="checkbox" name="is_hidden" value="Y" <?=isset($row['is_hidden']) && $row['is_hidden'] == 'Y' ? 'checked' : ''?>> 숨김처리
        </label>
      </div>
    </div>

    <div class="form_actions">
      <button type="submit" class="btn primary">저장</button>
      <a href="tutor_list.php" class="btn">취소</a>
      <?php if($mode == 'modify'): ?>
      <button type="button" class="btn danger" onclick="if(confirm('정말 삭제하시겠습니까?')) location.href='tutor_ok.php?mode=delete&tno=<?=$row['tno']?>'">삭제</button>
      <?php endif; ?>
    </div>
  </form>
</div>

<?php include 'footer.php'; ?>
