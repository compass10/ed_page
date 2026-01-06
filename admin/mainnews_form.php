<?php
header('Content-Type: text/html; charset=utf-8');
$bid = 'mainnews';

$mode = isset($_GET['mode']) ? $_GET['mode'] : 'write';
$pageTitle = $mode == 'write' ? '뉴스 등록' : '뉴스 수정';
include 'header.php';

$row = array();
if($mode == 'modify' && isset($_GET['bno']) && isset($board_table)) {
  $sql = "SELECT * FROM $board_table WHERE bno='{$_GET['bno']}'";
  $result = @mysql_query($sql);
  $row = @mysql_fetch_array($result);
  if(!$row) {
    echo "<script>alert('데이터가 없습니다.'); location.href='mainnews_list.php';</script>";
    exit;
  }
}
?>

<div class="page_actions">
  <a href="mainnews_list.php" class="btn">&larr; 목록으로</a>
</div>

<div class="form_section">
  <form method="post" action="mainnews_ok.php" enctype="multipart/form-data">
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
        <label>카테고리 *</label>
        <select name="bcate" required style="width: 150px;">
          <option value="recruit" <?=isset($row['bcate']) && $row['bcate'] == 'recruit' ? 'selected' : ''?>>수강생 모집</option>
          <option value="success" <?=isset($row['bcate']) && $row['bcate'] == 'success' ? 'selected' : ''?>>합격 소식</option>
          <option value="etc" <?=isset($row['bcate']) && $row['bcate'] == 'etc' ? 'selected' : ''?>>ETC</option>
        </select>
      </div>
      <div class="form_group">
        <label>
          <input type="checkbox" name="is_hidden" value="Y" <?=isset($row['is_hidden']) && $row['is_hidden'] == 'Y' ? 'checked' : ''?>> 숨김처리
        </label>
      </div>
      <div class="form_group">
        <label>
          <input type="checkbox" name="is_whoweare" value="Y" <?=isset($row['bext1']) && $row['bext1'] == 'Y' ? 'checked' : ''?>> Who We Are 페이지 노출
        </label>
        <p style="font-size: 12px; color: #999; margin-top: 4px;">체크 시 Who We Are 페이지에 노출 (최대 4개)</p>
      </div>
    </div>

    <div class="form_group">
      <label>제목 *</label>
      <input type="text" name="btitle" value="<?=isset($row['btitle']) ? htmlspecialchars($row['btitle']) : ''?>" required placeholder="뉴스 제목">
    </div>

    <div class="form_group">
      <label>썸네일 이미지 * (목록에 표시)</label>
      <?php if(isset($row['bimg']) && $row['bimg']): ?>
      <div style="margin-bottom: 10px;">
        <img src="<?=$_url?>thumb/mainnews/<?=$row['bimg']?>" style="max-width: 300px; border-radius: 4px;">
        <p style="font-size: 12px; color: #666; margin-top: 4px;">현재 이미지: <?=$row['bimg']?></p>
      </div>
      <?php endif; ?>
      <input type="file" name="bimg" accept="image/*" <?=$mode == 'write' ? 'required' : ''?>>
      <p style="font-size: 12px; color: #999; margin-top: 4px;">* 권장 사이즈: 400x300px</p>
    </div>

    <div class="form_group">
      <label>우측 이미지 (상세페이지에 표시)</label>
      <?php if(isset($row['bimg2']) && $row['bimg2']): ?>
      <div style="margin-bottom: 10px;">
        <img src="<?=$_url?>thumb/mainnews/<?=$row['bimg2']?>" style="max-width: 300px; border-radius: 4px;">
        <p style="font-size: 12px; color: #666; margin-top: 4px;">현재 이미지: <?=$row['bimg2']?></p>
      </div>
      <?php endif; ?>
      <input type="file" name="bimg2" accept="image/*">
      <p style="font-size: 12px; color: #999; margin-top: 4px;">* 상세페이지 우측에 표시될 이미지</p>
    </div>

    <div class="form_group">
      <label>내용</label>
      <textarea name="bcontents" id="bcontents"><?=isset($row['bcontents']) ? stripslashes($row['bcontents']) : ''?></textarea>
    </div>

    <div class="form_actions">
      <button type="submit" class="btn primary">저장</button>
      <a href="mainnews_list.php" class="btn">취소</a>
      <?php if($mode == 'modify'): ?>
      <button type="button" class="btn danger" onclick="if(confirm('정말 삭제하시겠습니까?')) location.href='mainnews_ok.php?mode=delete&bno=<?=$row['bno']?>'">삭제</button>
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
    language: 'ko',
    entities: false,
    basicEntities: false,
    entities_greek: false,
    entities_latin: false
  });
}
</script>

<?php include 'footer.php'; ?>
