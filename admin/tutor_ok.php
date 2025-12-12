<?php
// /web/new/admin/ 에서 /web/lib.php 로 접근
@include_once $_SERVER['DOCUMENT_ROOT'].'/web/lib.php';

// 로그인 체크
if(!isset($_SESSION['logged_no']) || !$_SESSION['logged_no']) {
  header("Location: login.php");
  exit;
}

$mode = $_REQUEST['mode'];
$tno = isset($_REQUEST['tno']) ? $_REQUEST['tno'] : '';

if($mode == 'write') {
  $tname = mysql_real_escape_string($_POST['tname']);
  $tposition = mysql_real_escape_string($_POST['tposition']);
  $tintro = mysql_real_escape_string($_POST['tintro']);
  $torder = (int)$_POST['torder'];
  $is_hidden = isset($_POST['is_hidden']) ? 'Y' : 'N';

  // 사진 업로드
  $tphoto = '';
  if(isset($_FILES['tphoto']) && $_FILES['tphoto']['name']) {
    $ext = pathinfo($_FILES['tphoto']['name'], PATHINFO_EXTENSION);
    $tphoto = 'tutor_' . time() . '.' . $ext;
    move_uploaded_file($_FILES['tphoto']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/web/tutor/' . $tphoto);
  }

  $sql = "INSERT INTO $tutor_table (tname, tposition, tintro, tphoto, torder, is_hidden)
    VALUES ('$tname', '$tposition', '$tintro', '$tphoto', '$torder', '$is_hidden')";
  mysql_query($sql);

  echo "<script>alert('등록되었습니다.'); location.href='tutor_list.php';</script>";

} else if($mode == 'modify') {
  $tname = mysql_real_escape_string($_POST['tname']);
  $tposition = mysql_real_escape_string($_POST['tposition']);
  $tintro = mysql_real_escape_string($_POST['tintro']);
  $torder = (int)$_POST['torder'];
  $is_hidden = isset($_POST['is_hidden']) ? 'Y' : 'N';

  // 사진 업로드
  $photo_sql = '';
  if(isset($_FILES['tphoto']) && $_FILES['tphoto']['name']) {
    $ext = pathinfo($_FILES['tphoto']['name'], PATHINFO_EXTENSION);
    $tphoto = 'tutor_' . time() . '.' . $ext;
    move_uploaded_file($_FILES['tphoto']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/web/tutor/' . $tphoto);
    $photo_sql = ", tphoto='$tphoto'";
  }

  $sql = "UPDATE $tutor_table SET
    tname='$tname',
    tposition='$tposition',
    tintro='$tintro',
    torder='$torder',
    is_hidden='$is_hidden'
    $photo_sql
    WHERE tno='$tno'";
  mysql_query($sql);

  echo "<script>alert('저장되었습니다.'); location.href='tutor_form.php?mode=modify&tno=$tno';</script>";

} else if($mode == 'delete') {
  $sql = "DELETE FROM $tutor_table WHERE tno='$tno'";
  mysql_query($sql);

  echo "<script>alert('삭제되었습니다.'); location.href='tutor_list.php';</script>";
}

@mysql_close($connect);
?>
