<?php
$mode = isset($_GET['mode']) ? $_GET['mode'] : 'write';
$pageTitle = $mode == 'write' ? '합격자 명단 작성' : '합격자 명단 수정';
include 'header.php';

$row = array();
if($mode == 'modify' && isset($_GET['bno']) && isset($board_table)) {
  $sql = "SELECT * FROM $board_table WHERE bno='{$_GET['bno']}'";
  $result = @mysql_query($sql);
  $row = @mysql_fetch_array($result);
  if(!$row) {
    echo "<script>alert('데이터가 없습니다.'); location.href='passlist_list.php';</script>";
    exit;
  }
}
?>

<div class="page_actions">
  <a href="passlist_list.php" class="btn">← 목록으로</a>
</div>

<div class="form_section">
  <form method="post" action="passlist_ok.php" enctype="multipart/form-data">
    <input type="hidden" name="mode" value="<?=$mode?>">
    <?php if($mode == 'modify'): ?>
    <input type="hidden" name="bno" value="<?=$row['bno']?>">
    <?php endif; ?>

    <div class="form_row">
      <div class="form_group">
        <label>
          <input type="checkbox" name="is_hidden" value="Y" <?=isset($row['is_hidden']) && $row['is_hidden'] == 'Y' ? 'checked' : ''?>> 숨김처리
        </label>
      </div>
      <div class="form_group" style="width: 150px;">
        <label>순서</label>
        <input type="number" name="bpw" value="<?=isset($row['bpw']) ? $row['bpw'] : '0'?>" min="0" style="width: 100%;">
      </div>
    </div>

    <div class="form_group">
      <label>제목 *</label>
      <input type="text" name="btitle" value="<?=isset($row['btitle']) ? htmlspecialchars($row['btitle']) : ''?>" required placeholder="예: 2024학년도 합격자 명단">
    </div>

    <div class="form_group">
      <label>썸네일 이미지 (목록용)</label>
      <?php if(isset($row['bimg']) && $row['bimg']): ?>
      <div style="margin-bottom: 10px;">
        <img src="<?=$_url?>thumb/passlist/<?=$row['bimg']?>" style="max-width: 200px;">
        <p style="font-size: 12px; color: #666; margin-top: 4px;">현재 썸네일</p>
      </div>
      <?php endif; ?>
      <input type="file" name="bimg" accept="image/*">
      <p style="font-size: 12px; color: #999; margin-top: 4px;">권장 크기: 450 x 296 px</p>
    </div>

    <div class="form_group">
      <label>내용 이미지 (상세페이지용)</label>
      <?php if(isset($row['bimg2']) && $row['bimg2']): ?>
      <div style="margin-bottom: 10px;">
        <img src="<?=$_url?>thumb/passlist/<?=$row['bimg2']?>" style="max-width: 400px;">
        <p style="font-size: 12px; color: #666; margin-top: 4px;">현재 내용 이미지</p>
      </div>
      <?php endif; ?>
      <input type="file" name="bimg2" accept="image/*">
      <p style="font-size: 12px; color: #999; margin-top: 4px;">상세 페이지에 표시될 큰 이미지</p>
    </div>

    <div class="form_actions">
      <button type="submit" class="btn primary">저장</button>
      <a href="passlist_list.php" class="btn">취소</a>
      <?php if($mode == 'modify'): ?>
      <button type="button" class="btn danger" onclick="if(confirm('정말 삭제하시겠습니까?')) location.href='passlist_ok.php?mode=delete&bno=<?=$row['bno']?>'">삭제</button>
      <?php endif; ?>
    </div>
  </form>
</div>

<?php include 'footer.php'; ?>
