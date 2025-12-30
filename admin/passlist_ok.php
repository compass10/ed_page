<?php
header('Content-Type: text/html; charset=utf-8');
@include_once $_SERVER['DOCUMENT_ROOT'].'/web/lib.php';

if(!isset($_SESSION['logged_no']) || !$_SESSION['logged_no']) {
  header("Location: login.php");
  exit;
}

$mode = $_REQUEST['mode'];
$bno = isset($_REQUEST['bno']) ? $_REQUEST['bno'] : '';
$bid = 'passlist';
$thumb_dir = 'passlist';

$is_hidden = isset($_POST['is_hidden']) ? 'Y' : 'N';

// 순서 변경
if($mode == 'order') {
  $dir = isset($_GET['dir']) ? $_GET['dir'] : '';
  $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

  // 현재 항목 정보
  $current = @mysql_fetch_array(@mysql_query("SELECT bno, bpw FROM $board_table WHERE bno='$bno'"));
  if($current) {
    $current_bpw = (int)$current['bpw'];

    if($dir == 'up') {
      // 위로 이동: 현재보다 bpw가 작은 것 중 가장 큰 것과 교환
      $target = @mysql_fetch_array(@mysql_query("SELECT bno, bpw FROM $board_table WHERE bid='passlist' AND bpw < $current_bpw ORDER BY bpw DESC LIMIT 1"));
      if(!$target) {
        // bpw가 같거나 더 작은 항목이 없으면 bno 기준으로
        $target = @mysql_fetch_array(@mysql_query("SELECT bno, bpw FROM $board_table WHERE bid='passlist' AND bpw = $current_bpw AND bno < $bno ORDER BY bno DESC LIMIT 1"));
      }
    } else {
      // 아래로 이동: 현재보다 bpw가 큰 것 중 가장 작은 것과 교환
      $target = @mysql_fetch_array(@mysql_query("SELECT bno, bpw FROM $board_table WHERE bid='passlist' AND bpw > $current_bpw ORDER BY bpw ASC LIMIT 1"));
      if(!$target) {
        // bpw가 같거나 더 큰 항목이 없으면 bno 기준으로
        $target = @mysql_fetch_array(@mysql_query("SELECT bno, bpw FROM $board_table WHERE bid='passlist' AND bpw = $current_bpw AND bno > $bno ORDER BY bno ASC LIMIT 1"));
      }
    }

    if($target) {
      // bpw 값 교환
      $target_bpw = (int)$target['bpw'];
      // 같은 값이면 하나를 조정
      if($current_bpw == $target_bpw) {
        if($dir == 'up') {
          @mysql_query("UPDATE $board_table SET bpw = bpw + 1 WHERE bid='passlist' AND bpw >= $current_bpw AND bno != $bno");
          @mysql_query("UPDATE $board_table SET bpw = $current_bpw WHERE bno = '$bno'");
        } else {
          @mysql_query("UPDATE $board_table SET bpw = $target_bpw WHERE bno = '$bno'");
          @mysql_query("UPDATE $board_table SET bpw = $current_bpw WHERE bno = '{$target['bno']}'");
        }
      } else {
        @mysql_query("UPDATE $board_table SET bpw = $target_bpw WHERE bno = '$bno'");
        @mysql_query("UPDATE $board_table SET bpw = $current_bpw WHERE bno = '{$target['bno']}'");
      }
    }
  }

  header("Location: passlist_list.php?page=$page");
  exit;
}

// 삭제
if($mode == 'delete') {
  $row = @mysql_fetch_array(@mysql_query("SELECT bimg, bimg2 FROM $board_table WHERE bno='$bno'"));
  if($row) {
    if($row['bimg']) {
      @unlink($_SERVER['DOCUMENT_ROOT'] . '/web/thumb/' . $thumb_dir . '/' . $row['bimg']);
    }
    if($row['bimg2']) {
      @unlink($_SERVER['DOCUMENT_ROOT'] . '/web/thumb/' . $thumb_dir . '/' . $row['bimg2']);
    }
  }
  mysql_query("DELETE FROM $board_table WHERE bno='$bno'");
  echo "<script>alert('삭제되었습니다.'); location.href='passlist_list.php';</script>";
  exit;
}

// 등록
if($mode == 'write' || $mode == '') {
  $btitle = mysql_real_escape_string($_POST['btitle']);
  $bpw = isset($_POST['bpw']) ? (int)$_POST['bpw'] : 0;

  $sql = "INSERT INTO $board_table (bid, is_hidden, btitle, bpw, bregdate)
    VALUES ('$bid', '$is_hidden', '$btitle', '$bpw', NOW())";
  mysql_query($sql);
  $bno = mysql_insert_id();

// 수정
} else if($mode == 'modify') {
  $btitle = mysql_real_escape_string($_POST['btitle']);
  $bpw = isset($_POST['bpw']) ? (int)$_POST['bpw'] : 0;

  $sql = "UPDATE $board_table SET
    is_hidden='$is_hidden',
    btitle='$btitle',
    bpw='$bpw'
    WHERE bno='$bno'";
  mysql_query($sql);
}

// 업로드 디렉토리 확인/생성
$updir = $_SERVER['DOCUMENT_ROOT'] . '/web/thumb/' . $thumb_dir . '/';
if(!is_dir($updir)) mkdir($updir, 0755, true);

// 썸네일 이미지 업로드 (bimg)
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
    $new_filename = 'thumb_' . $bid . '_' . $bno . '.' . $ext;
    if(move_uploaded_file($file['tmp_name'], $updir . $new_filename)) {
      @mysql_query("UPDATE $board_table SET bimg='$new_filename' WHERE bno='$bno'");
    }
  }
}

// 내용 이미지 업로드 (bimg2)
if(isset($_FILES['bimg2']) && $_FILES['bimg2']['size'] > 0) {
  $file = $_FILES['bimg2'];
  // 기존 이미지 삭제
  if($mode == 'modify') {
    $data = @mysql_fetch_array(@mysql_query("SELECT bimg2 FROM $board_table WHERE bno='$bno'"));
    if($data && $data['bimg2']) {
      @unlink($updir . $data['bimg2']);
    }
  }
  $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
  if(in_array($ext, array('jpg', 'jpeg', 'gif', 'png', 'webp'))) {
    $new_filename = 'content_' . $bid . '_' . $bno . '.' . $ext;
    if(move_uploaded_file($file['tmp_name'], $updir . $new_filename)) {
      @mysql_query("UPDATE $board_table SET bimg2='$new_filename' WHERE bno='$bno'");
    }
  }
}

echo "<script>alert('저장되었습니다.'); location.href='passlist_list.php';</script>";
@mysql_close($connect);
?>
