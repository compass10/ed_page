<?php
$menu_names = array(
  '1' => '학원소개',
  '2' => '시각디자인',
  '3' => '공업디자인',
  '4' => '입시정보',
  '5' => '합격자',
  '6' => '커뮤니티'
);

$mode = isset($_GET['mode']) ? $_GET['mode'] : 'write';
$menucode = isset($_GET['menucode']) ? $_GET['menucode'] : '';
$pageTitle = $mode == 'write' ? '페이지 작성' : '페이지 수정';
include 'header.php';

$row = array();
if($mode == 'modify' && isset($_GET['page_no']) && isset($page_table)) {
  $sql = "SELECT * FROM $page_table WHERE page_no='{$_GET['page_no']}'";
  $result = @mysql_query($sql);
  $row = @mysql_fetch_array($result);
  if(!$row) {
    echo "<script>alert('데이터가 없습니다.'); location.href='page_list.php';</script>";
    exit;
  }
}
?>

<div class="page_actions">
  <a href="page_list.php<?=$menucode ? '?menucode='.$menucode : ''?>" class="btn">← 목록으로</a>
</div>

<div class="form_section">
  <form method="post" action="page_ok.php" enctype="multipart/form-data">
    <input type="hidden" name="mode" value="<?=$mode?>">
    <input type="hidden" name="menucode" value="<?=$menucode?>">
    <?php if($mode == 'modify'): ?>
    <input type="hidden" name="page_no" value="<?=$row['page_no']?>">
    <?php endif; ?>

    <div class="form_row">
      <div class="form_group">
        <label>상위메뉴 *</label>
        <select name="page_parent" required>
          <option value="">선택</option>
          <?php foreach($menu_names as $key => $name): ?>
          <option value="<?=$key?>" <?=isset($row['page_parent']) && $row['page_parent'] == $key ? 'selected' : ''?>><?=$name?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="form_group">
        <label>페이지코드 *</label>
        <input type="text" name="page_code" value="<?=isset($row['page_code']) ? htmlspecialchars($row['page_code']) : ''?>" required placeholder="영문숫자 (예: about, team)">
      </div>
    </div>

    <div class="form_group">
      <label>페이지 타이틀 *</label>
      <input type="text" name="page_title" value="<?=isset($row['page_title']) ? htmlspecialchars($row['page_title']) : ''?>" required>
    </div>

    <div class="form_group">
      <label>우선순위</label>
      <input type="number" name="page_rank" value="<?=isset($row['page_rank']) ? $row['page_rank'] : '0'?>" style="width: 120px;">
      <span style="color: #888; font-size: 12px; margin-left: 10px;">* 높을수록 메뉴에서 먼저 표시됩니다.</span>
    </div>

    <div class="form_group">
      <label>내용</label>
      <textarea name="page_content" id="page_content"><?=isset($row['page_content']) ? htmlspecialchars($row['page_content']) : ''?></textarea>
    </div>

    <div class="form_actions">
      <button type="submit" class="btn primary">저장</button>
      <a href="page_list.php<?=$menucode ? '?menucode='.$menucode : ''?>" class="btn">취소</a>
      <?php if($mode == 'modify'): ?>
      <button type="button" class="btn danger" onclick="if(confirm('정말 삭제하시겠습니까?')) location.href='page_ok.php?mode=delete&page_no=<?=$row['page_no']?><?=$menucode ? '&menucode='.$menucode : ''?>'">삭제</button>
      <?php endif; ?>
    </div>
  </form>
</div>

<script src="<?=$_url?>ckeditor/ckeditor.js"></script>
<script>
if(typeof CKEDITOR !== 'undefined') {
  CKEDITOR.replace('page_content', {
    width: '100%',
    height: '500px',
    filebrowserBrowseUrl: '<?=$_url?>ckfinder/ckfinder.html',
    filebrowserImageBrowseUrl: '<?=$_url?>ckfinder/ckfinder.html?Type=Images',
    filebrowserUploadUrl: '<?=$_url?>ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
    filebrowserImageUploadUrl: '<?=$_url?>ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
    language: 'ko'
  });
}
</script>

<?php include 'footer.php'; ?>
