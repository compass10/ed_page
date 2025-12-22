<?php
header('Content-Type: text/html; charset=utf-8');
$bid = 'youtube';

$mode = isset($_GET['mode']) ? $_GET['mode'] : 'write';
$pageTitle = $mode == 'write' ? '유튜브 영상 등록' : '유튜브 영상 수정';
include 'header.php';

$row = array();
if($mode == 'modify' && isset($_GET['bno']) && isset($board_table)) {
  $sql = "SELECT * FROM $board_table WHERE bno='{$_GET['bno']}'";
  $result = @mysql_query($sql);
  $row = @mysql_fetch_array($result);
  if(!$row) {
    echo "<script>alert('데이터가 없습니다.'); location.href='youtube_list.php';</script>";
    exit;
  }
}
?>

<div class="page_actions">
  <a href="youtube_list.php" class="btn">&larr; 목록으로</a>
</div>

<div class="form_section">
  <form method="post" action="youtube_ok.php" enctype="multipart/form-data">
    <input type="hidden" name="mode" value="<?=$mode?>">
    <input type="hidden" name="bid" value="<?=$bid?>">
    <?php if($mode == 'modify'): ?>
    <input type="hidden" name="bno" value="<?=$row['bno']?>">
    <?php endif; ?>

    <div class="form_row">
      <div class="form_group">
        <label>
          <input type="checkbox" name="is_hidden" value="Y" <?=isset($row['is_hidden']) && $row['is_hidden'] == 'Y' ? 'checked' : ''?>> 숨김처리
        </label>
      </div>
    </div>

    <div class="form_group">
      <label>우선출력 가중치</label>
      <input type="number" name="bpw" value="<?=isset($row['bpw']) ? $row['bpw'] : '0'?>" style="width: 120px;">
      <span style="color: #888; font-size: 12px; margin-left: 10px;">* 높을수록 먼저 출력됩니다.</span>
    </div>

    <div class="form_group">
      <label>제목</label>
      <input type="text" name="btitle" value="<?=isset($row['btitle']) ? htmlspecialchars($row['btitle']) : ''?>" placeholder="영상 제목 (선택사항)">
    </div>

    <div class="form_group">
      <label>썸네일 이미지 *</label>
      <?php if(isset($row['bimg']) && $row['bimg']): ?>
      <div style="margin-bottom: 10px;">
        <img src="<?=$_url?>thumb/youtube/<?=$row['bimg']?>" style="max-width: 200px; border-radius: 4px;">
        <p style="font-size: 12px; color: #888; margin-top: 5px;">현재 이미지: <?=$row['bimg']?></p>
      </div>
      <?php endif; ?>
      <input type="file" name="bimg" accept="image/*" <?=$mode == 'write' ? 'required' : ''?>>
      <span style="color: #888; font-size: 12px; display: block; margin-top: 5px;">* 권장 사이즈: 320x180px (16:9 비율)</span>
    </div>

    <div class="form_group">
      <label>유튜브 URL *</label>
      <input type="text" name="blink" value="<?=isset($row['blink']) ? htmlspecialchars($row['blink']) : ''?>" placeholder="https://www.youtube.com/watch?v=xxxxxx 또는 영상코드" required>
      <span style="color: #888; font-size: 12px; display: block; margin-top: 5px;">
        * 전체 URL 또는 영상코드만 입력 가능<br>
        예: https://www.youtube.com/watch?v=dQw4w9WgXcQ 또는 dQw4w9WgXcQ
      </span>
    </div>

    <div class="form_actions">
      <button type="submit" class="btn primary">저장</button>
      <a href="youtube_list.php" class="btn">취소</a>
      <?php if($mode == 'modify'): ?>
      <button type="button" class="btn danger" onclick="if(confirm('정말 삭제하시겠습니까?')) location.href='youtube_ok.php?mode=delete&bno=<?=$row['bno']?>'">삭제</button>
      <?php endif; ?>
    </div>
  </form>
</div>

<?php include 'footer.php'; ?>
