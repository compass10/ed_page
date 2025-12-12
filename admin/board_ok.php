<?php
// /web/new/admin/ 에서 /web/lib.php 로 접근
@include_once $_SERVER['DOCUMENT_ROOT'].'/web/lib.php';

// 로그인 체크
if(!isset($_SESSION['logged_no']) || !$_SESSION['logged_no']) {
  header("Location: login.php");
  exit;
}

$mode = $_REQUEST['mode'];
$bid = $_REQUEST['bid'];
$bno = isset($_REQUEST['bno']) ? $_REQUEST['bno'] : '';

$list_page = $bid . '_list.php';

if($mode == 'write') {
  $btitle = mysql_real_escape_string($_POST['btitle']);
  $bcontent = mysql_real_escape_string($_POST['bcontent']);
  $bwriter = isset($_POST['bwriter']) ? mysql_real_escape_string($_POST['bwriter']) : '';
  $is_hidden = isset($_POST['is_hidden']) ? 'Y' : 'N';

  // 썸네일 업로드
  $bthumb = '';
  if(isset($_FILES['bthumb']) && $_FILES['bthumb']['name']) {
    $ext = pathinfo($_FILES['bthumb']['name'], PATHINFO_EXTENSION);
    $bthumb = $bid . '_' . time() . '.' . $ext;
    move_uploaded_file($_FILES['bthumb']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/web/board_thumb/' . $bthumb);
  }

  $sql = "INSERT INTO $board_table (bid, btitle, bcontent, bwriter, bthumb, is_hidden, bregdate)
    VALUES ('$bid', '$btitle', '$bcontent', '$bwriter', '$bthumb', '$is_hidden', NOW())";
  mysql_query($sql);

  echo "<script>alert('등록되었습니다.'); location.href='$list_page';</script>";

} else if($mode == 'modify') {
  $btitle = mysql_real_escape_string($_POST['btitle']);
  $bcontent = mysql_real_escape_string($_POST['bcontent']);
  $bwriter = isset($_POST['bwriter']) ? mysql_real_escape_string($_POST['bwriter']) : '';
  $is_hidden = isset($_POST['is_hidden']) ? 'Y' : 'N';

  // 썸네일 업로드
  $thumb_sql = '';
  if(isset($_FILES['bthumb']) && $_FILES['bthumb']['name']) {
    $ext = pathinfo($_FILES['bthumb']['name'], PATHINFO_EXTENSION);
    $bthumb = $bid . '_' . time() . '.' . $ext;
    move_uploaded_file($_FILES['bthumb']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/web/board_thumb/' . $bthumb);
    $thumb_sql = ", bthumb='$bthumb'";
  }

  $sql = "UPDATE $board_table SET
    btitle='$btitle',
    bcontent='$bcontent',
    bwriter='$bwriter',
    is_hidden='$is_hidden'
    $thumb_sql
    WHERE bno='$bno'";
  mysql_query($sql);

  echo "<script>alert('저장되었습니다.'); location.href='{$bid}_form.php?mode=modify&bno=$bno';</script>";

} else if($mode == 'delete') {
  $sql = "DELETE FROM $board_table WHERE bno='$bno'";
  mysql_query($sql);

  echo "<script>alert('삭제되었습니다.'); location.href='$list_page';</script>";
}

@mysql_close($connect);
?>
