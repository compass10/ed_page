<?php
// /web/new/admin/ 에서 /web/lib.php 로 접근
@include_once $_SERVER['DOCUMENT_ROOT'].'/web/lib.php';

// 로그인 체크
if(!isset($_SESSION['logged_no']) || !$_SESSION['logged_no']) {
  header("Location: login.php");
  exit;
}

$mode = $_REQUEST['mode'];
$ino = $_REQUEST['ino'];

if($mode == 'modify') {
  $isw = $_POST['isw'];
  $ianswer = $_POST['ianswer'];
  $email_send = $_POST['email_send'];

  // 업데이트
  $sql = "UPDATE $inquiry_table SET isw='$isw', ianswer='$ianswer' WHERE ino='$ino'";
  mysql_query($sql);

  // 이메일 발송
  if($email_send == 'send') {
    $row = mysql_fetch_array(mysql_query("SELECT * FROM $inquiry_table WHERE ino='$ino'"));
    if($row['iemail']) {
      // 이메일 발송 로직 (필요시 구현)
      // mailer2(1, $row['iemail'], $row['iname'], 'info@edillust.co.kr', '이드미술학원', '문의 답변', $ianswer);
    }
  }

  echo "<script>alert('저장되었습니다.'); location.href='inquiry_form.php?mode=modify&ino=$ino';</script>";

} else if($mode == 'delete') {
  $sql = "DELETE FROM $inquiry_table WHERE ino='$ino'";
  mysql_query($sql);

  echo "<script>alert('삭제되었습니다.'); location.href='inquiry_list.php';</script>";
}

@mysql_close($connect);
?>
