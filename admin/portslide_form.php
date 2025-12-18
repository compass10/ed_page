<?php
$mode = isset($_GET['mode']) ? $_GET['mode'] : 'write';
$pageTitle = $mode == 'write' ? '포트폴리오 슬라이드 등록' : '포트폴리오 슬라이드 수정';
include 'header.php';

$row = array();
if($mode == 'modify' && isset($_GET['bno']) && isset($board_table)) {
  $sql = "SELECT * FROM $board_table WHERE bno='{$_GET['bno']}'";
  $result = @mysql_query($sql);
  $row = @mysql_fetch_array($result);
  if(!$row) {
    echo "<script>alert('데이터가 없습니다.'); location.href='portslide_list.php';</script>";
    exit;
  }
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
  <a href="portslide_list.php" class="btn">← 목록으로</a>
</div>

<div class="form_section">
  <form method="post" action="portslide_ok.php" enctype="multipart/form-data">
    <input type="hidden" name="mode" value="<?=$mode?>">
    <?php if($mode == 'modify'): ?>
    <input type="hidden" name="bno" value="<?=$row['bno']?>">
    <?php endif; ?>

    <div class="form_row">
      <div class="form_group">
        <label>카테고리 *</label>
        <select name="bcate" required style="width: 200px; padding: 8px;">
          <option value="">선택하세요</option>
          <?php foreach($categories as $key => $name): ?>
          <option value="<?=$key?>" <?=isset($row['bcate']) && $row['bcate'] == $key ? 'selected' : ''?>><?=$name?></option>
          <?php endforeach; ?>
        </select>
      </div>
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
      <label>문구 * (3줄 이내 권장)</label>
      <textarea name="btitle" rows="3" required placeholder="예: BRAND DESIGN&#10;BATHE CAMPAIGN, 2025"><?=isset($row['btitle']) ? htmlspecialchars($row['btitle']) : ''?></textarea>
      <p style="font-size: 12px; color: #999; margin-top: 4px;">줄바꿈이 그대로 적용됩니다.</p>
    </div>

    <div class="form_group">
      <label>이미지 *</label>
      <?php if(isset($row['bimg']) && $row['bimg']): ?>
      <div style="margin-bottom: 10px;">
        <img src="<?=$_url?>thumb/portslide/<?=$row['bimg']?>" style="max-width: 400px;">
        <p style="font-size: 12px; color: #666; margin-top: 4px;">현재 이미지: <?=$row['bimg']?></p>
      </div>
      <?php endif; ?>
      <input type="file" name="bimg" accept="image/*" <?=$mode == 'write' ? 'required' : ''?>>
    </div>

    <div class="form_actions">
      <button type="submit" class="btn primary">저장</button>
      <a href="portslide_list.php" class="btn">취소</a>
      <?php if($mode == 'modify'): ?>
      <button type="button" class="btn danger" onclick="if(confirm('정말 삭제하시겠습니까?')) location.href='portslide_ok.php?mode=delete&bno=<?=$row['bno']?>'">삭제</button>
      <?php endif; ?>
    </div>
  </form>
</div>

<?php include 'footer.php'; ?>
