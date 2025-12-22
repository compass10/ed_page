<?php
$video_types = array(
  '1' => '학원소개',
  '2' => '시각디자인',
  '3' => '공업디자인'
);

$type = isset($_GET['type']) ? $_GET['type'] : '1';
$bid = 'video' . $type;
$type_title = isset($video_types[$type]) ? $video_types[$type] : '학원소개';

$mode = isset($_GET['mode']) ? $_GET['mode'] : 'write';
$pageTitle = $mode == 'write' ? $type_title . ' 영상 작성' : $type_title . ' 영상 수정';
include 'header.php';

$row = array();
if($mode == 'modify' && isset($_GET['bno']) && isset($board_table)) {
  $sql = "SELECT * FROM $board_table WHERE bno='{$_GET['bno']}'";
  $result = @mysql_query($sql);
  $row = @mysql_fetch_array($result);
  if(!$row) {
    echo "<script>alert('데이터가 없습니다.'); location.href='video_list.php?type=$type';</script>";
    exit;
  }
}
?>

<div class="page_actions">
  <a href="video_list.php?type=<?=$type?>" class="btn">← <?=$type_title?> 목록으로</a>
</div>

<div class="form_section">
  <form method="post" action="video_ok.php" enctype="multipart/form-data">
    <input type="hidden" name="mode" value="<?=$mode?>">
    <input type="hidden" name="bid" value="<?=$bid?>">
    <input type="hidden" name="type" value="<?=$type?>">
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
      <label>우선출력 가중치</label>
      <input type="number" name="bpw" value="<?=isset($row['bpw']) ? $row['bpw'] : '0'?>" style="width: 120px;">
      <span style="color: #888; font-size: 12px; margin-left: 10px;">* 높을수록 우선출력됩니다.</span>
    </div>

    <div class="form_group">
      <label>제목 *</label>
      <input type="text" name="btitle" value="<?=isset($row['btitle']) ? htmlspecialchars($row['btitle']) : ''?>" required>
    </div>

    <div class="form_group">
      <label>썸네일 이미지</label>
      <?php if(isset($row['bimg']) && $row['bimg']): ?>
      <div style="margin-bottom: 10px;">
        <img src="<?=$_url?>thumb/gallery/<?=$row['bimg']?>" style="max-width: 200px;">
      </div>
      <?php endif; ?>
      <input type="file" name="bimg">
    </div>

    <div class="form_group">
      <label>유튜브 영상 코드</label>
      <input type="text" name="blink" value="<?=isset($row['blink']) ? htmlspecialchars($row['blink']) : ''?>" placeholder="예: dQw4w9WgXcQ">
      <span style="color: #888; font-size: 12px; display: block; margin-top: 5px;">* 유튜브 주소에서 v= 뒤의 코드만 입력 (예: https://youtube.com/watch?v=<strong>dQw4w9WgXcQ</strong>)</span>
    </div>

    <div class="form_group">
      <label>내용</label>
      <textarea name="bcontents" id="bcontents"><?=isset($row['bcontents']) ? htmlspecialchars($row['bcontents']) : ''?></textarea>
    </div>

    <div class="form_actions">
      <button type="submit" class="btn primary">저장</button>
      <a href="video_list.php?type=<?=$type?>" class="btn">취소</a>
      <?php if($mode == 'modify'): ?>
      <button type="button" class="btn danger" onclick="if(confirm('정말 삭제하시겠습니까?')) location.href='video_ok.php?mode=delete&type=<?=$type?>&bno=<?=$row['bno']?>'">삭제</button>
      <?php endif; ?>
    </div>
  </form>
</div>

<script src="<?=$_url?>ckeditor/ckeditor.js"></script>
<script>
if(typeof CKEDITOR !== 'undefined') {
  CKEDITOR.replace('bcontents', {
    width: '100%',
    height: '300px',
    filebrowserBrowseUrl: '<?=$_url?>ckfinder/ckfinder.html',
    filebrowserImageBrowseUrl: '<?=$_url?>ckfinder/ckfinder.html?Type=Images',
    filebrowserUploadUrl: '<?=$_url?>ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
    filebrowserImageUploadUrl: '<?=$_url?>ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
    language: 'ko'
  });
}
</script>

<?php include 'footer.php'; ?>
