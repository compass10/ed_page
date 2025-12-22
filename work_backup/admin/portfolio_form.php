<?php
$mode = isset($_GET['mode']) ? $_GET['mode'] : 'write';
$pageTitle = $mode == 'write' ? '포트폴리오 등록' : '포트폴리오 수정';
include 'header.php';

$row = array();
if($mode == 'modify' && isset($_GET['bno']) && isset($board_table)) {
  $sql = "SELECT * FROM $board_table WHERE bno='{$_GET['bno']}'";
  $result = @mysql_query($sql);
  $row = @mysql_fetch_array($result);
  if(!$row) {
    echo "<script>alert('데이터가 없습니다.'); location.href='portfolio_list.php';</script>";
    exit;
  }
}
?>

<div class="page_actions">
  <a href="portfolio_list.php" class="btn">← 목록으로</a>
</div>

<div class="form_section">
  <form method="post" action="portfolio_ok.php" enctype="multipart/form-data">
    <input type="hidden" name="mode" value="<?=$mode?>">
    <?php if($mode == 'modify'): ?>
    <input type="hidden" name="bno" value="<?=$row['bno']?>">
    <?php endif; ?>

    <div class="form_row">
      <div class="form_group">
        <label>순서</label>
        <input type="number" name="bpw" value="<?=isset($row['bpw']) ? $row['bpw'] : '0'?>" style="width: 100px;">
        <p style="font-size: 12px; color: #999; margin-top: 4px;">숫자가 작을수록 먼저 표시</p>
      </div>
      <div class="form_group">
        <label>
          <input type="checkbox" name="is_hidden" value="Y" <?=isset($row['is_hidden']) && $row['is_hidden'] == 'Y' ? 'checked' : ''?>> 숨김처리
        </label>
      </div>
    </div>

    <div class="form_group">
      <label>이미지 *</label>
      <?php if(isset($row['bimg']) && $row['bimg']): ?>
      <div style="margin-bottom: 10px;">
        <img src="<?=$_url?>thumb/portfolio/<?=$row['bimg']?>" style="max-width: 400px;">
        <p style="font-size: 12px; color: #666; margin-top: 4px;">현재 이미지: <?=$row['bimg']?></p>
      </div>
      <?php endif; ?>
      <input type="file" name="bimg" accept="image/*" <?=$mode == 'write' ? 'required' : ''?>>
    </div>

    <div class="form_actions">
      <button type="submit" class="btn primary">저장</button>
      <a href="portfolio_list.php" class="btn">취소</a>
      <?php if($mode == 'modify'): ?>
      <button type="button" class="btn danger" onclick="if(confirm('정말 삭제하시겠습니까?')) location.href='portfolio_ok.php?mode=delete&bno=<?=$row['bno']?>'">삭제</button>
      <?php endif; ?>
    </div>
  </form>
</div>

<?php include 'footer.php'; ?>
