<?php
// /web/new/admin/ 에서 /web/lib.php 로 접근
@include_once $_SERVER['DOCUMENT_ROOT'].'/web/lib.php';

// 로그인 체크
if(!isset($_SESSION['logged_no']) || !$_SESSION['logged_no']) {
  header("Location: login.php");
  exit;
}

$mode = $_REQUEST['mode'];
$bno = isset($_REQUEST['bno']) ? $_REQUEST['bno'] : '';

if($mode == 'delete') {
  // 이미지 파일 삭제
  $row = @mysql_fetch_array(@mysql_query("SELECT bimg FROM $banner_table WHERE bno='$bno'"));
  if($row && $row['bimg']) {
    @unlink($_SERVER['DOCUMENT_ROOT'] . '/web/banner/' . $row['bimg']);
  }

  $sql = "DELETE FROM $banner_table WHERE bno='$bno'";
  mysql_query($sql);

  echo "<script>alert('삭제되었습니다.'); location.href='mainbanner_list.php';</script>";
}

@mysql_close($connect);
?>
