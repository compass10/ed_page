<?php
header('Content-Type: text/html; charset=utf-8');

// /web/new/admin/ 에서 /web/lib.php 로 접근
@include_once $_SERVER['DOCUMENT_ROOT'].'/web/lib.php';

// 로그인 체크
if(!isset($_SESSION['logged_no']) || !$_SESSION['logged_no']) {
  header("Location: login.php");
  exit;
}

$mode = isset($_REQUEST['mode']) ? $_REQUEST['mode'] : '';
$ino = isset($_REQUEST['ino']) ? $_REQUEST['ino'] : '';

if($mode == 'modify') {
  $isw = isset($_POST['isw']) ? $_POST['isw'] : '';
  $ianswer = isset($_POST['ianswer']) ? $_POST['ianswer'] : '';
  $email_send = isset($_POST['email_send']) ? $_POST['email_send'] : '';

  // 업데이트
  $sql = "UPDATE $inquiry_table SET isw='".addslashes($isw)."', ianswer='".addslashes($ianswer)."' WHERE ino='".addslashes($ino)."'";
  mysql_query($sql);

  // 이메일 발송
  $email_result = '';
  if($email_send == 'send') {
    $row = mysql_fetch_array(mysql_query("SELECT * FROM $inquiry_table WHERE ino='".addslashes($ino)."'"));
    if($row['iemail']) {
      // 이메일 발송
      $to = $row['iemail'];
      $subject = '=?UTF-8?B?'.base64_encode('[이드미술학원] 문의 답변').'?=';

      // 이메일 본문
      $message = '<html><head><meta charset="UTF-8"></head><body>';
      $message .= '<div style="max-width:600px;margin:0 auto;padding:20px;font-family:Malgun Gothic,맑은고딕,sans-serif;">';
      $message .= '<h2 style="color:#333;border-bottom:2px solid #333;padding-bottom:10px;">이드미술학원 문의 답변</h2>';
      $message .= '<p style="color:#666;margin:20px 0;">안녕하세요, <strong>'.$row['iname'].'</strong>님.</p>';
      $message .= '<p style="color:#666;margin:20px 0;">문의해 주셔서 감사합니다. 아래와 같이 답변 드립니다.</p>';
      $message .= '<div style="background:#f5f5f5;padding:20px;margin:20px 0;border-left:4px solid #333;">';
      $message .= '<strong>문의 제목:</strong> '.htmlspecialchars($row['isubject']).'<br><br>';
      $message .= '<strong>답변 내용:</strong><br>'.$ianswer;
      $message .= '</div>';
      $message .= '<p style="color:#999;font-size:12px;margin-top:30px;">본 메일은 발신 전용입니다.</p>';
      $message .= '<p style="color:#999;font-size:12px;">이드미술학원 | www.edillust.co.kr</p>';
      $message .= '</div></body></html>';

      // 헤더
      $headers = "MIME-Version: 1.0\r\n";
      $headers .= "Content-type: text/html; charset=UTF-8\r\n";
      $headers .= "From: =?UTF-8?B?".base64_encode('이드미술학원')."?= <info@edillust.co.kr>\r\n";
      $headers .= "Reply-To: info@edillust.co.kr\r\n";

      // 메일 발송
      if(@mail($to, $subject, $message, $headers)) {
        $email_result = ' 이메일이 발송되었습니다.';
      } else {
        $email_result = ' (이메일 발송 실패)';
      }
    }
  }

  echo "<script>alert('저장되었습니다.".$email_result."'); location.href='inquiry_form.php?mode=modify&ino=$ino';</script>";

} else if($mode == 'delete') {
  $sql = "DELETE FROM $inquiry_table WHERE ino='".addslashes($ino)."'";
  mysql_query($sql);

  echo "<script>alert('삭제되었습니다.'); location.href='inquiry_list.php';</script>";
}

@mysql_close($connect);
?>
