<?php
$pageTitle = '상담문의 상세';
include 'header.php';

if($_GET['mode'] != 'modify' || !$_GET['ino']) {
  header("Location: inquiry_list.php");
  exit;
}

$sql = "SELECT * FROM $inquiry_table WHERE ino='{$_GET['ino']}'";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);

if(!$row) {
  header("Location: inquiry_list.php");
  exit;
}
?>

<div class="page_actions">
  <a href="inquiry_list.php" class="btn">← 목록으로</a>
</div>

<div class="form_section">
  <form method="post" action="inquiry_ok.php">
    <input type="hidden" name="mode" value="modify">
    <input type="hidden" name="ino" value="<?=$row['ino']?>">

    <!-- 문의 정보 (읽기 전용) -->
    <div class="form_group">
      <label>문의 정보</label>
      <div class="info_box">
        <div class="info_row">
          <span class="info_label">등록일시</span>
          <span class="info_value"><?=$row['reg_date']?></span>
        </div>
        <div class="info_row">
          <span class="info_label">접속환경</span>
          <span class="info_value"><?=$row['idevice']?></span>
        </div>
        <div class="info_row">
          <span class="info_label">IP</span>
          <span class="info_value"><?=$row['ip']?></span>
        </div>
      </div>
    </div>

    <div class="form_row">
      <div class="form_group">
        <label>성명</label>
        <div class="info_box"><?=$row['iname']?></div>
      </div>
      <div class="form_group">
        <label>이메일</label>
        <div class="info_box"><?=$row['iemail']?></div>
      </div>
    </div>

    <div class="form_group">
      <label>제목</label>
      <div class="info_box"><?=$row['isubject']?></div>
    </div>

    <div class="form_group">
      <label>문의내용</label>
      <div class="info_box"><?=nl2br($row['imemo'])?></div>
    </div>

    <?php if($row['ifile']): ?>
    <div class="form_group">
      <label>첨부파일</label>
      <div class="info_box">
        <?php
        // 파일 경로 확인 (새 경로 또는 기존 경로)
        $file_path_new = $_SERVER['DOCUMENT_ROOT'] . '/upload/inquiry/' . $row['ifile'];
        $file_path_old = $_SERVER['DOCUMENT_ROOT'] . '/web/inquiry_attachment/' . $row['ifile'];

        if(file_exists($file_path_new)) {
          $file_url = '/upload/inquiry/' . $row['ifile'];
        } else if(file_exists($file_path_old)) {
          $file_url = '/web/inquiry_attachment/' . $row['ifile'];
        } else {
          $file_url = '';
        }

        // 이미지 파일인 경우 미리보기
        $ext = strtolower(pathinfo($row['ifile'], PATHINFO_EXTENSION));
        if($file_url == ''):
        ?>
        <span style="color: #999;">파일을 찾을 수 없습니다: <?=$row['ifile']?></span>
        <?php elseif(in_array($ext, array('jpg', 'jpeg', 'gif', 'png', 'webp'))): ?>
        <img src="<?=$file_url?>" style="max-width: 100%;">
        <?php else: ?>
        <a href="<?=$file_url?>" target="_blank" style="color: #007bff;"><?=$row['ifile']?> (다운로드)</a>
        <?php endif; ?>
      </div>
    </div>
    <?php endif; ?>

    <hr style="border: none; border-top: 1px solid #eee; margin: 32px 0;">

    <!-- 답변 영역 -->
    <div class="form_group">
      <label>처리상태</label>
      <select name="isw" style="width: auto; min-width: 200px;">
        <?php foreach($data_sw_arr as $item): ?>
        <option value="<?=$item[1]?>" <?=$row['isw'] == $item[1] ? 'selected' : ''?>><?=$item[0]?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="form_group">
      <label>답변</label>
      <textarea name="ianswer" id="ianswer"><?=htmlspecialchars($row['ianswer'])?></textarea>
    </div>

    <div class="form_group">
      <label>
        <input type="checkbox" name="email_send" value="send"> 답변 이메일 발송 (체크하고 저장하면 문의자 이메일로 답변이 전송됩니다)
      </label>
    </div>

    <div class="form_actions">
      <button type="submit" class="btn primary">저장</button>
      <a href="inquiry_list.php" class="btn">취소</a>
      <button type="button" class="btn danger" onclick="if(confirm('정말 삭제하시겠습니까?')) location.href='inquiry_ok.php?mode=delete&ino=<?=$row['ino']?>'">삭제</button>
    </div>
  </form>
</div>

<!-- CKEditor (선택사항) -->
<script src="<?=$_url?>ckeditor/ckeditor.js"></script>
<script>
if(typeof CKEDITOR !== 'undefined') {
  CKEDITOR.replace('ianswer', {
    width: '100%',
    height: '300px',
    language: 'ko'
  });
}
</script>

<?php include 'footer.php'; ?>
