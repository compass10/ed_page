<?php
$pageTitle = '사이트설정';
include 'header.php';

$setup = array();
if(isset($setup_table)) {
  $result = @mysql_query("SELECT * FROM $setup_table WHERE sno=1");
  $setup = @mysql_fetch_array($result);
}

// 저장 처리
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($setup_table)) {
  $site_name = mysql_real_escape_string($_POST['site_name']);
  $site_tel = mysql_real_escape_string($_POST['site_tel']);
  $site_email = mysql_real_escape_string($_POST['site_email']);
  $site_addr = mysql_real_escape_string($_POST['site_addr']);
  $site_footer = mysql_real_escape_string($_POST['site_footer']);

  if($setup) {
    $sql = "UPDATE $setup_table SET
      site_name='$site_name',
      site_tel='$site_tel',
      site_email='$site_email',
      site_addr='$site_addr',
      site_footer='$site_footer'
      WHERE sno=1";
  } else {
    $sql = "INSERT INTO $setup_table (site_name, site_tel, site_email, site_addr, site_footer)
      VALUES ('$site_name', '$site_tel', '$site_email', '$site_addr', '$site_footer')";
  }

  if(@mysql_query($sql)) {
    echo "<script>alert('저장되었습니다.'); location.reload();</script>";
  } else {
    echo "<script>alert('저장 실패');</script>";
  }
}
?>

<div class="form_section">
  <form method="post">
    <div class="form_group">
      <label>사이트명</label>
      <input type="text" name="site_name" value="<?=isset($setup['site_name']) ? htmlspecialchars($setup['site_name']) : ''?>">
    </div>

    <div class="form_row">
      <div class="form_group">
        <label>대표전화</label>
        <input type="text" name="site_tel" value="<?=isset($setup['site_tel']) ? htmlspecialchars($setup['site_tel']) : ''?>">
      </div>
      <div class="form_group">
        <label>대표이메일</label>
        <input type="email" name="site_email" value="<?=isset($setup['site_email']) ? htmlspecialchars($setup['site_email']) : ''?>">
      </div>
    </div>

    <div class="form_group">
      <label>주소</label>
      <input type="text" name="site_addr" value="<?=isset($setup['site_addr']) ? htmlspecialchars($setup['site_addr']) : ''?>">
    </div>

    <div class="form_group">
      <label>푸터 문구</label>
      <textarea name="site_footer" rows="3"><?=isset($setup['site_footer']) ? htmlspecialchars($setup['site_footer']) : ''?></textarea>
    </div>

    <div class="form_actions">
      <button type="submit" class="btn primary">저장</button>
    </div>
  </form>
</div>

<?php include 'footer.php'; ?>
