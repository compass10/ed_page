<?php
header('Content-Type: text/html; charset=utf-8');
@include_once $_SERVER['DOCUMENT_ROOT'].'/web/lib.php';

if(!isset($_SESSION['logged_no']) || !$_SESSION['logged_no']) {
  header("Location: login.php");
  exit;
}

$mode = $_REQUEST['mode'];
$bid = 'youtube';
$bno = isset($_REQUEST['bno']) ? $_REQUEST['bno'] : '';

$is_hidden = isset($_POST['is_hidden']) ? 'Y' : 'N';

// 유튜브 URL에서 코드만 추출하는 함수
function extractYoutubeCode($url) {
  $url = trim($url);

  // 이미 코드만 있는 경우
  if(preg_match('/^[a-zA-Z0-9_-]{11}$/', $url)) {
    return $url;
  }

  // youtube.com/watch?v= 형식
  if(preg_match('/[?&]v=([a-zA-Z0-9_-]{11})/', $url, $matches)) {
    return $matches[1];
  }

  // youtu.be/ 형식
  if(preg_match('/youtu\.be\/([a-zA-Z0-9_-]{11})/', $url, $matches)) {
    return $matches[1];
  }

  // youtube.com/embed/ 형식
  if(preg_match('/embed\/([a-zA-Z0-9_-]{11})/', $url, $matches)) {
    return $matches[1];
  }

  return $url;
}

if($mode == 'write' || $mode == '') {
  $btitle = mysql_real_escape_string($_POST['btitle']);
  $blink_raw = $_POST['blink'];
  $blink = mysql_real_escape_string(extractYoutubeCode($blink_raw));
  $bpw = isset($_POST['bpw']) ? (int)$_POST['bpw'] : 0;

  $sql = "INSERT INTO $board_table (bid, bpw, is_hidden, btitle, blink, bregdate)
    VALUES ('$bid', '$bpw', '$is_hidden', '$btitle', '$blink', NOW())";
  mysql_query($sql);
  $bno = mysql_insert_id();

} else if($mode == 'modify') {
  $btitle = mysql_real_escape_string($_POST['btitle']);
  $blink_raw = $_POST['blink'];
  $blink = mysql_real_escape_string(extractYoutubeCode($blink_raw));
  $bpw = isset($_POST['bpw']) ? (int)$_POST['bpw'] : 0;

  $sql = "UPDATE $board_table SET
    bpw='$bpw',
    is_hidden='$is_hidden',
    btitle='$btitle',
    blink='$blink'
    WHERE bno='$bno'";
  mysql_query($sql);

} else if($mode == 'delete') {
  $row = @mysql_fetch_array(@mysql_query("SELECT bimg FROM $board_table WHERE bno='$bno'"));
  if($row && $row['bimg']) {
    @unlink($_SERVER['DOCUMENT_ROOT'] . '/web/thumb/youtube/' . $row['bimg']);
  }
  mysql_query("DELETE FROM $board_table WHERE bno='$bno'");
  echo "<script>alert('삭제되었습니다.'); location.href='youtube_list.php';</script>";
  exit;
}

// 이미지 업로드
if(isset($_FILES['bimg']) && $_FILES['bimg']['size'] > 0) {
  $file = $_FILES['bimg'];

  // 기존 이미지 삭제
  if($mode == 'modify') {
    $data = @mysql_fetch_array(@mysql_query("SELECT bimg FROM $board_table WHERE bno='$bno'"));
    if($data && $data['bimg']) {
      @unlink($_SERVER['DOCUMENT_ROOT'] . '/web/thumb/youtube/' . $data['bimg']);
    }
  }

  $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
  if(in_array($ext, array('jpg', 'jpeg', 'gif', 'png', 'webp'))) {
    $updir = $_SERVER['DOCUMENT_ROOT'] . '/web/thumb/youtube/';
    if(!is_dir($updir)) mkdir($updir, 0755, true);
    $new_filename = 'youtube_' . $bno . '_' . time() . '.' . $ext;
    if(move_uploaded_file($file['tmp_name'], $updir . $new_filename)) {
      @mysql_query("UPDATE $board_table SET bimg='$new_filename' WHERE bno='$bno'");
    }
  }
}

echo "<script>alert('저장되었습니다.'); location.href='youtube_list.php';</script>";
@mysql_close($connect);
?>
