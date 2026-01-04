<?php
// 세션 먼저 시작 (lib.php 충돌 방지)
@session_start();

// Output buffering 시작 (lib.php의 출력 차단)
ob_start();

// Fatal 에러 핸들러
function fatalErrorHandler() {
    $error = error_get_last();
    if ($error !== null && ($error['type'] == E_ERROR || $error['type'] == E_PARSE || $error['type'] == E_CORE_ERROR || $error['type'] == E_COMPILE_ERROR)) {
        @ob_end_clean();
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(array('success' => false, 'message' => "Fatal Error: " . $error['message'] . " in " . $error['file'] . " on line " . $error['line']));
    }
}
register_shutdown_function('fatalErrorHandler');

// 일반 에러 핸들러
function jsonErrorHandler($errno, $errstr, $errfile, $errline) {
    // 경고는 무시
    if ($errno == E_WARNING || $errno == E_NOTICE || $errno == E_DEPRECATED || $errno == E_STRICT) {
        return true;
    }
    @ob_end_clean();
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(array('success' => false, 'message' => "PHP Error: $errstr in $errfile on line $errline"));
    exit;
}
set_error_handler('jsonErrorHandler');

// DB 연결 (운영서버 lib.php 사용)
$libPath = $_SERVER['DOCUMENT_ROOT'].'/web/lib.php';
if(!file_exists($libPath)) {
    @ob_end_clean();
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(array('success' => false, 'message' => 'lib.php 파일을 찾을 수 없습니다.'));
    exit;
}
@include_once($libPath);

// lib.php 출력 버리기
@ob_end_clean();

header('Content-Type: application/json; charset=utf-8');

// DB 연결 확인
if(!isset($inquiry_table) || !$inquiry_table) {
    echo json_encode(array('success' => false, 'message' => 'DB 연결에 실패했습니다.'));
    exit;
}

// POST 요청만 허용
if($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(array('success' => false, 'message' => '잘못된 요청입니다.'));
    exit;
}

// 파라미터 검증
$ino = isset($_POST['ino']) ? intval($_POST['ino']) : 0;
$password = isset($_POST['password']) ? trim($_POST['password']) : '';

if($ino <= 0) {
    echo json_encode(array('success' => false, 'message' => '잘못된 요청입니다.'));
    exit;
}

if(empty($password)) {
    echo json_encode(array('success' => false, 'message' => '비밀번호를 입력해주세요.'));
    exit;
}

// 세션 UID로 비밀번호 확인 (원본 방식)
// 세션 UID가 일치하면 본인 글
$sql = "SELECT * FROM $inquiry_table WHERE ino='$ino'";
$result = @mysql_query($sql);

if(!$result || @mysql_num_rows($result) == 0) {
    echo json_encode(array('success' => false, 'message' => '존재하지 않는 글입니다.'));
    exit;
}

$inquiry = @mysql_fetch_assoc($result);

// 비밀번호 확인 (세션 UID와 비교)
// 원본 시스템에서는 iuid 컬럼에 세션 UID를 저장함
if($inquiry['iuid'] !== $password) {
    echo json_encode(array('success' => false, 'message' => '비밀번호가 일치하지 않습니다.'));
    exit;
}

// 비밀번호 일치 - 상세 내용 반환
$content = nl2br(htmlspecialchars($inquiry['imemo']));
$file = '';
$fileName = '';

if(!empty($inquiry['ifile'])) {
    $file = '/upload/inquiry/' . $inquiry['ifile'];
    $fileName = $inquiry['ifile'];
}

// 답변 내용 (ireply 컬럼이 있다면)
$reply = '';
if(isset($inquiry['ireply']) && !empty($inquiry['ireply'])) {
    $reply = nl2br(htmlspecialchars($inquiry['ireply']));
}

echo json_encode(array(
    'success' => true,
    'content' => $content,
    'file' => $file,
    'fileName' => $fileName,
    'reply' => $reply
));

@mysql_close($connect);
?>
