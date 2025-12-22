<?php
header('Content-Type: text/html; charset=utf-8');
@include_once $_SERVER['DOCUMENT_ROOT'].'/web/lib.php';

if(!isset($_SESSION['logged_no']) || !$_SESSION['logged_no']) {
  header("Location: login.php");
  exit;
}

$mode = $_REQUEST['mode'];
$bno = isset($_REQUEST['bno']) ? $_REQUEST['bno'] : '';
$bid = 'portfolio';
$thumb_dir = 'portfolio';

$is_hidden = isset($_POST['is_hidden']) ? 'Y' : 'N';
$bpw = isset($_POST['bpw']) ? (int)$_POST['bpw'] : 0;

// 삭제
if($mode == 'delete') {
  $row = @mysql_fetch_array(@mysql_query("SELECT bimg FROM $board_table WHERE bno='$bno'"));
  if($row && $row['bimg']) {
    @unlink($_SERVER['DOCUMENT_ROOT'] . '/web/thumb/' . $thumb_dir . '/' . $row['bimg']);
  }
  mysql_query("DELETE FROM $board_table WHERE bno='$bno'");
  echo "<script>alert('삭제되었습니다.'); location.href='portfolio_list.php';</script>";
  exit;
}

// 등록
if($mode == 'write' || $mode == '') {
  $sql = "INSERT INTO $board_table (bid, is_hidden, bpw, bregdate)
    VALUES ('$bid', '$is_hidden', '$bpw', NOW())";
  mysql_query($sql);
  $bno = mysql_insert_id();

// 수정
} else if($mode == 'modify') {
  $sql = "UPDATE $board_table SET
    is_hidden='$is_hidden',
    bpw='$bpw'
    WHERE bno='$bno'";
  mysql_query($sql);
}

// 업로드 디렉토리 확인/생성
$updir = $_SERVER['DOCUMENT_ROOT'] . '/web/thumb/' . $thumb_dir . '/';
if(!is_dir($updir)) mkdir($updir, 0755, true);

// 이미지 업로드
if(isset($_FILES['bimg']) && $_FILES['bimg']['size'] > 0) {
  $file = $_FILES['bimg'];
  // 기존 이미지 삭제
  if($mode == 'modify') {
    $data = @mysql_fetch_array(@mysql_query("SELECT bimg FROM $board_table WHERE bno='$bno'"));
    if($data && $data['bimg']) {
      @unlink($updir . $data['bimg']);
    }
  }
  $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
  if(in_array($ext, array('jpg', 'jpeg', 'gif', 'png', 'webp'))) {
    $new_filename = 'port_' . $bno . '_' . time() . '.' . $ext;
    if(move_uploaded_file($file['tmp_name'], $updir . $new_filename)) {
      @mysql_query("UPDATE $board_table SET bimg='$new_filename' WHERE bno='$bno'");
    }
  }
}

echo "<script>alert('저장되었습니다.'); location.href='portfolio_list.php';</script>";
@mysql_close($connect);
?>
