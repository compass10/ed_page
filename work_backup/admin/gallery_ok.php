<?php
// /web/new/admin/ 에서 /web/lib.php 로 접근
@include_once $_SERVER['DOCUMENT_ROOT'].'/web/lib.php';

// 로그인 체크
if(!isset($_SESSION['logged_no']) || !$_SESSION['logged_no']) {
  header("Location: login.php");
  exit;
}

$mode = $_REQUEST['mode'];
$type = isset($_REQUEST['type']) ? $_REQUEST['type'] : '1';
$bid = isset($_REQUEST['bid']) ? $_REQUEST['bid'] : 'gallery' . $type;
$bno = isset($_REQUEST['bno']) ? $_REQUEST['bno'] : '';

// 체크박스 처리
$is_hidden = isset($_POST['is_hidden']) ? 'Y' : 'N';
$is_notice = isset($_POST['is_notice']) ? 'Y' : 'N';

if($mode == 'write' || $mode == '') {
  $btitle = mysql_real_escape_string($_POST['btitle']);
  $bcontents = mysql_real_escape_string($_POST['bcontents']);
  $bpw = isset($_POST['bpw']) ? (int)$_POST['bpw'] : 0;

  // 기본값 넣기
  $sql = "INSERT INTO $board_table (bid, is_notice, bpw, is_hidden, btitle, bcontents, bregdate)
    VALUES ('$bid', '$is_notice', '$bpw', '$is_hidden', '$btitle', '$bcontents', NOW())";
  mysql_query($sql);

  $bno = mysql_insert_id();

} else if($mode == 'modify') {
  // 기존 데이터 확인
  $is_check = @mysql_num_rows(@mysql_query("SELECT bno FROM $board_table WHERE bno='$bno'"));

  if($is_check < 1) {
    echo "<script>alert('해당 글이 없습니다.'); history.back();</script>";
    exit;
  }

  $btitle = mysql_real_escape_string($_POST['btitle']);
  $bcontents = mysql_real_escape_string($_POST['bcontents']);
  $bpw = isset($_POST['bpw']) ? (int)$_POST['bpw'] : 0;

  $sql = "UPDATE $board_table SET
    is_notice='$is_notice',
    bpw='$bpw',
    is_hidden='$is_hidden',
    btitle='$btitle',
    bcontents='$bcontents',
    bregdate=NOW()
    WHERE bno='$bno'";
  mysql_query($sql);

} else if($mode == 'delete') {
  // 이미지 파일 삭제
  $row = @mysql_fetch_array(@mysql_query("SELECT bimg FROM $board_table WHERE bno='$bno'"));
  if($row && $row['bimg']) {
    $file_path = $_SERVER['DOCUMENT_ROOT'] . '/web/thumb/gallery/' . $row['bimg'];
    if(file_exists($file_path)) {
      @unlink($file_path);
    }
  }

  $sql = "DELETE FROM $board_table WHERE bno='$bno'";
  mysql_query($sql);

  echo "<script>alert('삭제되었습니다.'); location.href='gallery_list.php?type=$type';</script>";
  exit;
}

// 이미지 업로드 처리
if(isset($_FILES['bimg']) && $_FILES['bimg']['size'] > 0) {
  $file = $_FILES['bimg'];

  // 기존 이미지 삭제 (수정 모드일 때)
  if($mode == 'modify') {
    $data = @mysql_fetch_array(@mysql_query("SELECT bimg FROM $board_table WHERE bno='$bno'"));
    if($data && $data['bimg']) {
      $old_file = $_SERVER['DOCUMENT_ROOT'] . '/web/thumb/gallery/' . $data['bimg'];
      if(file_exists($old_file)) {
        @unlink($old_file);
      }
    }
  }

  // 확장자 검사
  $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
  $allowed_ext = array('jpg', 'jpeg', 'gif', 'png');

  if(in_array($ext, $allowed_ext)) {
    // 디렉토리 확인
    $updir = $_SERVER['DOCUMENT_ROOT'] . '/web/thumb/gallery/';
    if(!is_dir($updir)) {
      mkdir($updir, 0755, true);
    }

    // 파일명 생성
    $new_filename = 'thumb_gallery_' . $bno . '.' . $ext;
    $upload_path = $updir . $new_filename;

    if(move_uploaded_file($file['tmp_name'], $upload_path)) {
      @chmod($upload_path, 0706);
      @mysql_query("UPDATE $board_table SET bimg='$new_filename' WHERE bno='$bno'");
    }
  }
}

echo "<script>alert('처리되었습니다.'); location.href='gallery_list.php?type=$type';</script>";

@mysql_close($connect);
?>
