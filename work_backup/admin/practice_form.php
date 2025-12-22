<?php
$mode = isset($_GET['mode']) ? $_GET['mode'] : 'write';
$pageTitle = $mode == 'write' ? '대학별실기 작성' : '대학별실기 수정';
include 'header.php';

$row = array();
if($mode == 'modify' && isset($_GET['bno']) && isset($board_table)) {
  $sql = "SELECT * FROM $board_table WHERE bno='{$_GET['bno']}'";
  $result = @mysql_query($sql);
  $row = @mysql_fetch_array($result);
  if(!$row) {
    echo "<script>alert('데이터가 없습니다.'); location.href='practice_list.php';</script>";
    exit;
  }
}
?>

<div class="page_actions">
  <a href="practice_list.php" class="btn">← 목록으로</a>
</div>

<div class="form_section">
  <form method="post" action="content_ok.php" enctype="multipart/form-data">
    <input type="hidden" name="mode" value="<?=$mode?>">
    <input type="hidden" name="bid" value="practice">
    <input type="hidden" name="thumb_dir" value="practice">
    <?php if($mode == 'modify'): ?>
    <input type="hidden" name="bno" value="<?=$row['bno']?>">
    <?php endif; ?>

    <div class="form_row">
      <div class="form_group">
        <label>
          <input type="checkbox" name="is_notice" value="Y" <?=isset($row['is_notice']) && $row['is_notice'] == 'Y' ? 'checked' : ''?>> 최상위로 올리기
        </label>
      </div>
      <div class="form_group">
        <label>
          <input type="checkbox" name="is_hidden" value="Y" <?=isset($row['is_hidden']) && $row['is_hidden'] == 'Y' ? 'checked' : ''?>> 숨김처리
        </label>
      </div>
    </div>

    <div class="form_group">
      <label>제목 *</label>
      <input type="text" name="btitle" value="<?=isset($row['btitle']) ? htmlspecialchars($row['btitle']) : ''?>" required>
    </div>

    <div class="form_group">
      <label>썸네일 이미지</label>
      <?php if(isset($row['bimg']) && $row['bimg']): ?>
      <div style="margin-bottom: 10px;">
        <img src="<?=$_url?>thumb/practice/<?=$row['bimg']?>" style="max-width: 200px;">
      </div>
      <?php endif; ?>
      <input type="file" name="bimg">
    </div>

    <div class="form_group">
      <label>내용</label>
      <textarea name="bcontents" id="bcontents"><?=isset($row['bcontents']) ? htmlspecialchars($row['bcontents']) : ''?></textarea>
    </div>

    <div class="form_actions">
      <button type="submit" class="btn primary">저장</button>
      <a href="practice_list.php" class="btn">취소</a>
      <?php if($mode == 'modify'): ?>
      <button type="button" class="btn danger" onclick="if(confirm('정말 삭제하시겠습니까?')) location.href='content_ok.php?mode=delete&bid=practice&bno=<?=$row['bno']?>'">삭제</button>
      <?php endif; ?>
    </div>
  </form>
</div>

<script src="<?=$_url?>ckeditor/ckeditor.js"></script>
<script>
if(typeof CKEDITOR !== 'undefined') {
  CKEDITOR.replace('bcontents', {
    width: '100%',
    height: '400px',
    filebrowserBrowseUrl: '<?=$_url?>ckfinder/ckfinder.html',
    filebrowserImageBrowseUrl: '<?=$_url?>ckfinder/ckfinder.html?Type=Images',
    filebrowserUploadUrl: '<?=$_url?>ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
    filebrowserImageUploadUrl: '<?=$_url?>ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
    language: 'ko'
  });
}
</script>

<?php include 'footer.php'; ?>
