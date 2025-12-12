<?php
session_start();

// DB 연결 (운영서버 lib.php 사용)
// /web/new/admin/ 에서 /web/lib.php 로 접근
@include_once $_SERVER['DOCUMENT_ROOT'].'/web/lib.php';

$user_id = htmlspecialchars(trim($_POST['user_id']));
$password = trim($_POST['user_pw']);

// 입력값 검증
if(!$user_id || !$password) {
  header("Location: login.php?error=empty");
  exit;
}

// DB 연결 확인
if(!isset($member_table) || !function_exists('mysql_query')) {
  // 로컬 테스트용: DB 없으면 하드코딩 계정으로 로그인
  // 운영서버 배포 시 이 부분 삭제 또는 주석처리
  if($user_id === 'admin' && $password === 'admin123') {
    $_SESSION['logged_no'] = 1;
    $_SESSION['logged_id'] = 'admin';
    $_SESSION['logged_name'] = '관리자';
    $_SESSION['logged_ip'] = $_SERVER['REMOTE_ADDR'];
    header("Location: index.php");
    exit;
  }
  header("Location: login.php?error=db");
  exit;
}

// 회원 로그인 체크
$sql = "SELECT * FROM $member_table WHERE user_id='$user_id' AND user_pw=password('$password')";
$result = mysql_query($sql);

if(!$result) {
  header("Location: login.php?error=query");
  exit;
}

$row = mysql_fetch_array($result);

if($row && $row['user_level'] == '1') {
  // 관리자 로그인 성공
  $_SESSION['logged_no'] = $row['user_no'];
  $_SESSION['logged_id'] = $row['user_id'];
  $_SESSION['logged_name'] = $row['user_name'];
  $_SESSION['logged_ip'] = $_SERVER['REMOTE_ADDR'];

  header("Location: index.php");
  exit;
} else {
  header("Location: login.php?error=invalid");
  exit;
}

@mysql_close($connect);
?>
