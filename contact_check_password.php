<?php
// 세션 먼저 시작
@session_start();

// Output buffering 시작
ob_start();

// 에러 핸들러
function jsonErrorHandler($errno, $errstr, $errfile, $errline)
{
    if ($errno == E_WARNING || $errno == E_NOTICE || $errno == E_DEPRECATED || $errno == E_STRICT) {
        return true;
    }
    @ob_end_clean();
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(array('success' => false, 'message' => '서버 오류가 발생했습니다.'));
    exit;
}
set_error_handler('jsonErrorHandler');

// DB 연결
$libPath = $_SERVER['DOCUMENT_ROOT'] . '/web/lib.php';
if (!file_exists($libPath)) {
    @ob_end_clean();
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(array('success' => false, 'message' => '서버 설정 오류입니다.'));
    exit;
}
@include_once($libPath);

// lib.php 출력 버리기
@ob_end_clean();

header('Content-Type: application/json; charset=utf-8');

// DB 연결 확인
if (!isset($inquiry_table) || !$inquiry_table) {
    echo json_encode(array('success' => false, 'message' => 'DB 연결에 실패했습니다.'));
    exit;
}

// POST 요청만 허용
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(array('success' => false, 'message' => '잘못된 요청입니다.'));
    exit;
}

// 필수 파라미터 검증
$ino = isset($_POST['ino']) ? intval($_POST['ino']) : 0;
$password = isset($_POST['password']) ? trim($_POST['password']) : '';

if (!$ino) {
    echo json_encode(array('success' => false, 'message' => '잘못된 요청입니다.'));
    exit;
}

if (empty($password)) {
    echo json_encode(array('success' => false, 'message' => '비밀번호를 입력해주세요.'));
    exit;
}

// DB에서 비밀번호 확인
$sql = "SELECT ipw FROM $inquiry_table WHERE ino='$ino'";
$result = @mysql_query($sql);

if (!$result) {
    echo json_encode(array('success' => false, 'message' => '조회 중 오류가 발생했습니다.'));
    exit;
}

$row = @mysql_fetch_array($result);

if (!$row) {
    echo json_encode(array('success' => false, 'message' => '해당 문의를 찾을 수 없습니다.'));
    exit;
}

// 비밀번호 비교
if ($row['ipw'] === $password) {
    // 비밀번호 일치 - 세션에 인증 정보 저장
    if (!isset($_SESSION['inquiry_auth'])) {
        $_SESSION['inquiry_auth'] = array();
    }
    $_SESSION['inquiry_auth'][$ino] = true;

    echo json_encode(array('success' => true, 'message' => '인증되었습니다.'));
} else {
    echo json_encode(array('success' => false, 'message' => '비밀번호가 일치하지 않습니다.'));
}

@mysql_close($connect);
?>