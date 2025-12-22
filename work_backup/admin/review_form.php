<?php
$mode = isset($_GET['mode']) ? $_GET['mode'] : 'write';
$pageTitle = $mode == 'write' ? '합격수기 작성' : '합격수기 수정';
include 'header.php';

$row = array();
if($mode == 'modify' && isset($_GET['bno']) && isset($board_table)) {
  $sql = "SELECT * FROM $board_table WHERE bno='{$_GET['bno']}'";
  $result = @mysql_query($sql);
  $row = @mysql_fetch_array($result);
  if(!$row) {
    echo "<script>alert('데이터가 없습니다.'); location.href='review_list.php';</script>";
    exit;
  }
}
?>

<div class="page_actions">
  <a href="review_list.php" class="btn">← 목록으로</a>
</div>

<div class="form_section">
  <form method="post" action="board_ok.php" enctype="multipart/form-data">
    <input type="hidden" name="mode" value="<?=$mode?>">
    <input type="hidden" name="bid" value="review">
    <?php if($mode == 'modify'): ?>
    <input type="hidden" name="bno" value="<?=$row['bno']?>">
    <?php endif; ?>

    <div class="form_row">
      <div class="form_group">
        <label>제목 *</label>
        <input type="text" name="btitle" value="<?=isset($row['btitle']) ? htmlspecialchars($row['btitle']) : ''?>" required>
      </div>
      <div class="form_group">
        <label>작성자</label>
        <input type="text" name="bwriter" value="<?=isset($row['bwriter']) ? htmlspecialchars($row['bwriter']) : ''?>">
      </div>
    </div>

    <div class="form_group">
      <label>내용</label>
      <textarea name="bcontent" id="bcontent"><?=isset($row['bcontent']) ? htmlspecialchars($row['bcontent']) : ''?></textarea>
    </div>

    <div class="form_group">
      <label>썸네일 이미지</label>
      <?php if(isset($row['bthumb']) && $row['bthumb']): ?>
      <div style="margin-bottom: 10px;">
        <img src="<?=$_url?>board_thumb/<?=$row['bthumb']?>" style="max-width: 200px;">
      </div>
      <?php endif; ?>
      <input type="file" name="bthumb">
    </div>

    <div class="form_group">
      <label>
        <input type="checkbox" name="is_hidden" value="Y" <?=isset($row['is_hidden']) && $row['is_hidden'] == 'Y' ? 'checked' : ''?>> 숨김처리
      </label>
    </div>

    <div class="form_actions">
      <button type="submit" class="btn primary">저장</button>
      <a href="review_list.php" class="btn">취소</a>
      <?php if($mode == 'modify'): ?>
      <button type="button" class="btn danger" onclick="if(confirm('정말 삭제하시겠습니까?')) location.href='board_ok.php?mode=delete&bid=review&bno=<?=$row['bno']?>'">삭제</button>
      <?php endif; ?>
    </div>
  </form>
</div>

<!-- CKEditor (선택사항) -->
<script src="<?=$_url?>ckeditor/ckeditor.js"></script>
<script>
if(typeof CKEDITOR !== 'undefined') {
  CKEDITOR.replace('bcontent', {
    width: '100%',
    height: '400px',
    language: 'ko'
  });
}
</script>

<?php include 'footer.php'; ?>
