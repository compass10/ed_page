<?php
header('Content-Type: text/html; charset=utf-8');
$bid = 'andmore';

$mode = isset($_GET['mode']) ? $_GET['mode'] : 'write';
$pageTitle = $mode == 'write' ? 'And More 등록' : 'And More 수정';
include 'header.php';

$row = array();
if($mode == 'modify' && isset($_GET['bno']) && isset($board_table)) {
  $sql = "SELECT * FROM $board_table WHERE bno='{$_GET['bno']}'";
  $result = @mysql_query($sql);
  $row = @mysql_fetch_array($result);
  if(!$row) {
    echo "<script>alert('데이터가 없습니다.'); location.href='andmore_list.php';</script>";
    exit;
  }
}
?>

<div class="page_actions">
  <a href="andmore_list.php" class="btn">&larr; 목록으로</a>
</div>

<div class="form_section">
  <form method="post" action="andmore_ok.php" enctype="multipart/form-data">
    <input type="hidden" name="mode" value="<?=$mode?>">
    <input type="hidden" name="bid" value="<?=$bid?>">
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
      <label>제목 *</label>
      <input type="text" name="btitle" value="<?=isset($row['btitle']) ? htmlspecialchars($row['btitle']) : ''?>" required placeholder="예: 2025 합격자 바로가기">
    </div>

    <div class="form_group">
      <label>링크 URL *</label>
      <input type="url" name="blink" value="<?=isset($row['blink']) ? htmlspecialchars($row['blink']) : ''?>" required placeholder="https://...">
      <p style="font-size: 12px; color: #999; margin-top: 4px;">클릭 시 이동할 링크 주소</p>
    </div>

    <div class="form_group">
      <label>설명 텍스트</label>
      <textarea name="bcontents" rows="3" placeholder="마우스 오버 시 표시될 설명 텍스트"><?=isset($row['bcontents']) ? htmlspecialchars($row['bcontents']) : ''?></textarea>
      <p style="font-size: 12px; color: #999; margin-top: 4px;">마우스 오버 시 표시되는 추가 설명</p>
    </div>

    <div class="form_group">
      <label>이미지 <?=$mode == 'write' ? '*' : ''?> (왼쪽 이미지 목록에 표시)</label>
      <?php if(isset($row['bimg']) && $row['bimg']): ?>
      <div style="margin-bottom: 10px;">
        <img src="<?=$_url?>thumb/andmore/<?=$row['bimg']?>" style="max-width: 300px; border-radius: 4px;">
        <p style="font-size: 12px; color: #666; margin-top: 4px;">현재 이미지: <?=$row['bimg']?></p>
      </div>
      <?php endif; ?>
      <input type="file" name="bimg" accept="image/*" <?=$mode == 'write' ? 'required' : ''?>>
      <p style="font-size: 12px; color: #999; margin-top: 4px;">* PC 왼쪽에 표시될 이미지, 권장 사이즈: 세로 이미지</p>
    </div>

    <div class="form_actions">
      <button type="submit" class="btn primary">저장</button>
      <a href="andmore_list.php" class="btn">취소</a>
      <?php if($mode == 'modify'): ?>
      <button type="button" class="btn danger" onclick="if(confirm('정말 삭제하시겠습니까?')) location.href='andmore_ok.php?mode=delete&bno=<?=$row['bno']?>'">삭제</button>
      <?php endif; ?>
    </div>
  </form>
</div>

<?php include 'footer.php'; ?>
