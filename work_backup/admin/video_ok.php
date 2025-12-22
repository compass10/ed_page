<?php
@include_once $_SERVER['DOCUMENT_ROOT'].'/web/lib.php';

if(!isset($_SESSION['logged_no']) || !$_SESSION['logged_no']) {
  header("Location: login.php");
  exit;
}

$mode = $_REQUEST['mode'];
$type = isset($_REQUEST['type']) ? $_REQUEST['type'] : '1';
$bid = isset($_REQUEST['bid']) ? $_REQUEST['bid'] : 'video' . $type;
$bno = isset($_REQUEST['bno']) ? $_REQUEST['bno'] : '';

$is_hidden = isset($_POST['is_hidden']) ? 'Y' : 'N';
$is_notice = isset($_POST['is_notice']) ? 'Y' : 'N';

if($mode == 'write' || $mode == '') {
  $btitle = mysql_real_escape_string($_POST['btitle']);
  $bcontents = mysql_real_escape_string($_POST['bcontents']);
  $blink = mysql_real_escape_string($_POST['blink']);
  $bpw = isset($_POST['bpw']) ? (int)$_POST['bpw'] : 0;

  $sql = "INSERT INTO $board_table (bid, is_notice, bpw, is_hidden, btitle, bcontents, blink, bregdate)
    VALUES ('$bid', '$is_notice', '$bpw', '$is_hidden', '$btitle', '$bcontents', '$blink', NOW())";
  mysql_query($sql);
  $bno = mysql_insert_id();

} else if($mode == 'modify') {
  $btitle = mysql_real_escape_string($_POST['btitle']);
  $bcontents = mysql_real_escape_string($_POST['bcontents']);
  $blink = mysql_real_escape_string($_POST['blink']);
  $bpw = isset($_POST['bpw']) ? (int)$_POST['bpw'] : 0;

  $sql = "UPDATE $board_table SET
    is_notice='$is_notice',
    bpw='$bpw',
    is_hidden='$is_hidden',
    btitle='$btitle',
    bcontents='$bcontents',
    blink='$blink',
    bregdate=NOW()
    WHERE bno='$bno'";
  mysql_query($sql);

} else if($mode == 'delete') {
  $row = @mysql_fetch_array(@mysql_query("SELECT bimg FROM $board_table WHERE bno='$bno'"));
  if($row && $row['bimg']) {
    @unlink($_SERVER['DOCUMENT_ROOT'] . '/web/thumb/gallery/' . $row['bimg']);
  }
  mysql_query("DELETE FROM $board_table WHERE bno='$bno'");
  echo "<script>alert('삭제되었습니다.'); location.href='video_list.php?type=$type';</script>";
  exit;
}

// 이미지 업로드
if(isset($_FILES['bimg']) && $_FILES['bimg']['size'] > 0) {
  $file = $_FILES['bimg'];
  if($mode == 'modify') {
    $data = @mysql_fetch_array(@mysql_query("SELECT bimg FROM $board_table WHERE bno='$bno'"));
    if($data && $data['bimg']) {
      @unlink($_SERVER['DOCUMENT_ROOT'] . '/web/thumb/gallery/' . $data['bimg']);
    }
  }
  $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
  if(in_array($ext, array('jpg', 'jpeg', 'gif', 'png'))) {
    $updir = $_SERVER['DOCUMENT_ROOT'] . '/web/thumb/gallery/';
    if(!is_dir($updir)) mkdir($updir, 0755, true);
    $new_filename = 'thumb_video_' . $bno . '.' . $ext;
    if(move_uploaded_file($file['tmp_name'], $updir . $new_filename)) {
      @mysql_query("UPDATE $board_table SET bimg='$new_filename' WHERE bno='$bno'");
    }
  }
}

echo "<script>alert('저장되었습니다.'); location.href='video_list.php?type=$type';</script>";
@mysql_close($connect);
?>
